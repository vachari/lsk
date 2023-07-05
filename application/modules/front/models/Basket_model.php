<?php
Class Basket_model extends CI_Model {

    public function get_product_details($prod_id) {
        $response = array();
        $this->db->where('mp.id',$prod_id);
        $this->db->select('mp.*,max(pi.selling_price) as selling_price,pi.unit_of_measure');    
        $this->db->from('ga_main_prod_details_tbl mp');
        $this->db->join('ga_prod_item_pricing_tbl pi', 'mp.id = pi.prod_id');
        $query = $this->db->get();
        $query->num_rows();
        if($query->num_rows()>0)
        return $query->row_array();
        else
        return false;
    }

   //Checking Cart Item exists or not code start
    public function checkProductInBasket($params)
    {
        $response = array();
        if(!is_array($params))
        {
                $response[CODE]=VALIDATION_CODE;
                $response[MESSAGE]='Validation';
                $response[DESCRIPTION]='Input data format is invalid';
        }
        else
        {

            $product_id = $params['prod_id'];
            $cart_type = $params['cart_type'];
            $basket_session = $params['basket_session_id'];
            $user_id = $params['user_id'];
		    //$is_sharecart =  $params['isShareCart'];
            $where = array('basket_session_id'=>$basket_session,'basket_status'=>0,'prod_id'=>$product_id);
            $this->db->select('basket_id,qty')->from('ga_basket_tbl')->where($where);
            if(!empty($user_id))
            {
                $this->db->where('user_id',$user_id);
            }
            $sql = $this->db->get();
            $count = $sql->num_rows();
           //echo json_encode(['description'=>$count]);exit;
			if($count>0)
			{
               return true;
			}
			else{
				return false;
            }
        }
        return json_encode($response);
    }

    public function add_basket($cart_data)
    {

        $response=array();
        //getting existing product details
        $prod_details=$this->get_product_details($cart_data['prod_id']);

        if($prod_details!=false)
        {

            //checking product is available in cart or not
            $exists=$this->checkProductInBasket($cart_data);
            //echo json_encode(['description'=>$exists]);exit;
           // print_r($exists);exit;
            if($exists==true)
            {
                //updating ga_cart_tbl
                // $update_qty=$exists+1;
                // $update_arr=array(
                // 'qty'=>$update_qty,
                // 'total_amount'=>$update_qty*$prod_details['selling_price'],
                //  );
                // $this->db->where('prod_id',$cart_data['prod_id']);
                // $this->db->where('basket_session_id',$cart_data['basket_session_id']);
                // $update=$this->db->update('ga_basket_tbl',$update_arr);
                // if($update){
                   $response[CODE]=SUCCESS_CODE;
                   $response[MESSAGE]='success';
                   $response[DESCRIPTION]='Item already added in basket';
                // }
                // else{
                //    $response[CODE]=FAIL_CODE_CODE;
                //    $response[MESSAGE]='failed';
                //    $response[DESCRIPTION]='Not updated to basket';
                // }
            }
            else
            {
                //inserting into ga_cart_tbl
                $add_arr=array(
                'cart_type'=>$cart_data['cart_type'],
                'prod_id'=>$cart_data['prod_id'],
                'qty'=>0,
                'user_id'=>$cart_data['user_id'],
                'unit_price'=>$prod_details['selling_price'],
                'shipping_charges'=>20,
                'total_amount'=>$cart_data['qty']*$prod_details['selling_price'],
                'basket_session_id'=>$cart_data['basket_session_id'],
                'created_date'=>DATE,
                'shipping_charges'=>20,
                );
                $insert=$this->db->insert('ga_basket_tbl',$add_arr);
                if($insert){
                   $response[CODE]=SUCCESS_CODE;
                   $response[MESSAGE]='success';
                   $response[DESCRIPTION]='Item added to basket';
                }
                else{
                   $response[CODE]=FAIL_CODE_CODE;
                   $response[MESSAGE]='failed';
                   $response[DESCRIPTION]='Not added to basket';
                }
                
            }
            echo json_encode($response);
        }
        else
        {
            $response[CODE]=FAIL_CODE;
            $response[MESSAGE]='Fail';
            $response[DESCRIPTION]='No item found..!';
        }
        return json_encode($response);
    }

    public function BasketResult($params)
    {
        $response=array();  
        $basket_session = $params['basket_session'];
        $response['sharecart_user']=$this->shareCartByUser(array('basket_session'=>$basket_session));
        $response['sharecart_item']=$this->shareCartByItem(array('basket_session'=>$basket_session));
        return json_encode($response);
    }

    public function shareCartByUser($params)
    {
        $result = array('userDeatails'=>array());   
        $basket_session =  $params['basket_session'];   
        $userData = array();
        $where =  array('b.basket_session_id'=>$basket_session,'b.user_id'=>$this->user_id,'b.basket_status'=>0,'b.cart_type'=>2);
        $sql = $this->db->select('b.user_id as userid,SUM(b.total_amount) as user_shopping_amount,COUNT(b.basket_id) as user_shopping_count,u.user_reigster_id as usercode,u.user_name as username,u.user_type as usertype')
        ->from('ga_basket_tbl b')
        ->join('ga_users_tbl u','u.user_id=b.user_id')
        ->where($where)->group_by('b.user_id')
        ->order_by('u.user_name','ASC')->get();
        $count = $sql->num_rows();
        foreach($sql->result() as $res)
        {
            $userData['basket_result']=array();
            $user_id =  $res->userid;
            foreach($res as $u_key=>$u_val)
            {
                $userData[$u_key]=$u_val;
            }
            /*
                    Item details code
                */
                    $itemArray =  array();
                    $itemWhere =  array(
                        'b.user_id'=>$user_id,
                        'b.basket_session_id'=>$basket_session,
                        'b.basket_status'=>0,
                        );
                    $itemsql =  $this->db->select('b.basket_id as basketid,b.prod_id as productid,b.qty as qty,b.unit_price as unit_price,b.total_amount as total_amount,p.prod_code as productcode,p.prod_name as productname')
                    ->from('ga_basket_tbl b')
                    ->join('ga_main_prod_details_tbl p','p.id=b.prod_id','inner')
                    ->where($itemWhere)->order_by('b.total_amount','ASC')
                    ->get();
                    $itemCount =  $itemsql->num_rows();
                    if($itemCount > 0)
                    {
                        foreach($itemsql->result() as $itemResponse)
                        {
                            foreach($itemResponse as $i_key=>$i_val)
                            {
                                $itemArray[$i_key]  = $i_val;
                            }
                            array_push($userData['basket_result'], $itemArray);
                        }
                    }
                /*
                    Item details End
                */
            array_push($result['userDeatails'],$userData);
        }
        $result[CODE]=($count > 0)?200:204;
        return $result;
        
    }

    public function shareCartByItem($params)
    {
        $result = array('shareItemDeatils'=>array());
        $basket_session =  $params['basket_session'];
        $itemWhere=array('b.basket_session_id'=>$basket_session,'b.basket_status'=>0,'b.cart_type'=>2);   
        $sql =  $this->db->select('b.basket_id as basketid,b.unit_price as unit_price,b.qty as qty, p.id as product_id,p.prod_name as productname,p.prod_code as productcode,p.prod_image as prod_img,p.prod_group as productgroup,COUNT(b.basket_id) as item_order_count,SUM(b.total_amount) as item_cart_amount')
            ->from('ga_basket_tbl b')
            ->join('ga_main_prod_details_tbl p','p.id=b.prod_id','inner')
            ->where($itemWhere)->group_by('b.prod_id')
            ->order_by('b.total_amount','ASC')->get();
        $count = $sql->num_rows();
        if($count > 0)
        {
            $itemArray=array();
            foreach($sql->result() as $itemResponse)
            {
                $itemid = $itemResponse->product_id;
                foreach($itemResponse as $i_key => $i_val)
                {
                    $itemArray[$i_key]=$i_val;
                }
                $itemArray['user_result']=array();
                $userWhere = array('b.basket_session_id'=>$basket_session,'b.prod_id'=>$itemid,'b.basket_status'=>0);
                $usersql=$this->db->select('u.user_reigster_id as usercode,u.user_name as username,b.qty as user_qty,b.unit_price as unit_price,b.total_amount as total_amount')
                ->from('ga_basket_tbl b')
                ->join('ga_users_tbl u','u.user_id=b.user_id','inner')
                ->where($userWhere)
                ->order_by('b.total_amount','asc')
                ->get();
                $usercount=$usersql->num_rows();
                if($usercount > 0)
                {
                    $userPushArray=array();
                    foreach($usersql->result() as $userRes)
                    {
                        foreach($userRes as $u_key => $u_val)
                        {
                            $userPushArray[$u_key]=$u_val;
                        }
                        array_push($itemArray['user_result'],$userPushArray);
                    }
                }
                array_push($result['shareItemDeatils'], $itemArray);
            }
        }

        $result['code']=($count > 0)?200:204;
        return $result;
    }

    public function basketUserStatistics($basketsession,$carttype=NULL)
    {
        $response = array('cart_count'=>0,'cart_amount'=>0,'cart_shipping'=>0,
            'cart_grand_total'=>0,'cart_service_charge'=>0,'cart_discount'=>0);
        $where = array('basket_session_id'=>$basketsession,'basket_status'=>0,'user_id'=>$this->user_id);//,'cart_type'=>1
         $this->db->select('COUNT(basket_id) as cart_count,SUM(total_amount) as cart_amount,SUM(shipping_charges) as cart_shipping_charges,SUM(qty) as cart_qty, SUM(discount) as cart_discount')
            ->from('ga_basket_tbl')->where($where);
                 if(!empty($carttype) && ($carttype == 1 || $carttype == 2))
                 {
                     $this->db->where('cart_type',$carttype);
                 }
                $sql = $this->db->get();
        $count =  $sql->num_rows();
        if($count > 0)
        {
            $res =  $sql->row();
            $response['cart_count']=$res->cart_count;
            $response['cart_qty']=$res->cart_qty;
            $response['cart_amount']=$res->cart_amount;
            $response['cart_discount']=$res->cart_discount;
            $response['cart_shipping']=$res->cart_shipping_charges;
            $response['cart_grand_total']=($res->cart_amount+$res->cart_shipping_charges-$res->cart_discount);
        }
        return json_encode($response);
    }

    public function get_all_item($basket_session_id){
		
       $this->db->select("*");
		$this->db->from("ga_basket_tbl");
		$this->db->where("basket_session_id",$basket_session_id);

		
		 $sql=$this->db->get();
       //echo $this->db->last_query();exit;
        $count=$sql->num_rows();
        if($count>0){
            $response['result']=$sql->result();
             $response['count']=$sql->num_rows();
            $response[CODE]=SUCCESS_CODE;
            $response[DESCRIPTION]="Data is available";
        }else{
            $response[MESSAGE]="Fail";
            $response[CODE]=FAIL_CODE;
            $response[DESCRIPTION]="Data is not available";
        }
          return json_encode($response);
    }

    public function Common_Insert($resp,$cart_session_id,$data1){
		/**
		* Update By :Zabihullah
		* Date		:1-23/21
		* Issues	:Before ,if user wanted to add basket items to cart then
		* he should initialize all the items qty field 
		* minimum to one else gives error saying all fields should be > 0.
		* it is not the case some times users have 20 items in basket but want to buy
		* few among them
		* here I checked if the qty value for a specific item is == 0
		* then ignore loop for this item else get data from basket with the current prod_id 
		* and insert into db(if item already exist in cart) else update .
		*/
        for($i=0;$i<$resp->count;$i++){
			if($data1['qty'][$i]==0){
				continue;
			}

				//cart data start

				//cart dada end
			   $cart_count=$this->common_record_count("cart_id","ga_cart_tbl",['prod_id'=>$data1['product_id'][$i]]);
			   if($cart_count>0){
					$get_cart_data=$this->RowWhere("ga_cart_tbl",['prod_id'=>$data1['product_id'][$i]],null);
					$qty=$data1['qty'][$i];
					$price=$get_cart_data->unit_price;
					$t_amt=$qty*$price;
					$get_cart_qty=$get_cart_data->qty;
					//echo $get_cart_qty.'...';
					$get_cart_tot_amount=$get_cart_data->total_amount;
					// echo $get_cart_unit_price;exit;
					$update=array(
					'cart_session_id'=>$cart_session_id,
					'cart_type'=>$get_cart_data->cart_type,
					'qty'=>$qty+$get_cart_qty,
					'unit_price'=>$get_cart_data->unit_price,
					'shipping_charges'=>$get_cart_data->shipping_charges,
					'discount'=>$get_cart_data->discount,
					'total_amount'=>$t_amt+$get_cart_tot_amount,
					'created_date'=>DATE,
					'cart_status'=>0,
					'order_id'=>$get_cart_data->order_id,
					'user_id'=>$this->user_id,
					'prod_id'=>$data1['product_id'][$i]
					);
					 $up=$this->db->update("ga_cart_tbl",$update,['prod_id'=>$data1['product_id'][$i]]);
					if(!empty($resp->result[$i]->cart_type) && $up==true){
					//$this->db->where("basket_id",$resp->result[$i]->basket_id);
					//$result=$this->db->delete("ga_basket_tbl");
					}
			   }else{
					$get_single_bskt_data=$this->RowWhere("ga_basket_tbl",['prod_id'=>$data1['product_id'][$i]],null);
					$qty=$data1['qty'][$i];
					$price=$get_single_bskt_data->unit_price;
					$t_amt=$qty*$price;
					$data=array(
					'cart_session_id'=>$cart_session_id,
					'cart_type'=>$get_single_bskt_data->cart_type,
					'qty'=>$data1['qty'][$i],
					'unit_price'=>$get_single_bskt_data->unit_price,
					'shipping_charges'=>$get_single_bskt_data->shipping_charges,
					'discount'=>$get_single_bskt_data->discount,
					'total_amount'=>$t_amt,
					'created_date'=>DATE,
					'cart_status'=>0,
					'order_id'=>$get_single_bskt_data->order_id,
					'user_id'=>$this->user_id,
					'prod_id'=>$data1['product_id'][$i]
					);
					$ins=$this->db->insert("ga_cart_tbl",$data);
					if(!empty($resp->result[$i]->cart_type) && $ins==true){
					//$this->db->where("basket_id",$resp->result[$i]->basket_id);
					//$result=$this->db->delete("ga_basket_tbl");
					}
			   }
			
        }
        if($result==true){
           return 1;
        }else{
           return 2;
        }
    }

    public function RowWhere($tbl,$where,$orderby){
        if($orderby){
            $this->db->order_by($orderby);
        }
        if($where){
            $this->db->where($where);
        }
        $res=$this->db->select('*')->from($tbl)->get();
        //echo $this->db->last_query();exit;
        $count=$res->num_rows();
        if($count>0)
            return $res->row();
        else
            return null;
    }

    public function common_record_count($cols,$table_name,$where)
    {   
    if($where){
        $this->db->where($where);
    }    
        $sql=$this->db->select($cols)
                      ->from($table_name)
                      ->get();
    
        $count=$sql->num_rows();
        //echo $this->db->last_query();exit;
        //echo $count;exit;
        return $count;
    }
}
