<?php 
class Orders_model extends CI_Model{
	public function checkoutResult($params)
	{
		$response=array();	
		$user_id = $params['user_id'];
		$response['sharecart_user']=$this->shareCartByUser(array('user_id'=>$user_id));
		$response['sharecart_item']=$this->shareCartByItem(array('user_id'=>$user_id));
		return json_encode($response);
	}
	public function ordercheckoutResult($params)
	{
		$response=array();	
		$user_id = $params['user_id'];
		$order_id =  $params['order_id'];
		$response['sharecart_user']=$this->shareCartByUser(array('user_id'=>$user_id,'order_id'=>$order_id));
		$response['sharecart_item']=$this->shareCartByItem(array('user_id'=>$user_id,'order_id'=>$order_id));
		$this->user_id = $this->session->userdata('user_id');
		return json_encode($response);
	}
	public function cartList($params,$cart_type=null)
    {
            $response=array();
            $user_id =  $params['user_id'];	
			$order_id =  $params['order_id'];	
            $product_folder=PRODCUCT_IMAGE_PATH;
            $where=array('c.user_id'=>$user_id,'c.cart_status'=>1,'c.cart_type'=>1,'order_id'=>$order_id);
            if($cart_type!=null && $cart_type==2){
            	$where=array('c.user_id'=>$user_id,'c.cart_status'=>1,'c.cart_type'=>2,'order_id'=>$order_id);
            }
			//Update by:Zabih
			//cart_id is also selected to place in remove_order_items as parameter.
            $cols="c.cart_id,c.unit_price as selling_price,c.qty,c.shipping_charges,p.id,p.prod_code,p.prod_group,p.prod_name,CONCAT('".$product_folder."',prod_image) as product_image,p.other_image,p.active_status,p.trash";
            $sql=  $this->db->select($cols,false)->from('ga_cart_tbl c')->join('ga_main_prod_details_tbl p','p.id=c.prod_id','inner')->where($where)->order_by('c.cart_id','ASC')->get();
               // echo    
            $db_error=  $this->db->error();
            if($db_error['code']==0)
            {
                   $count=$sql->num_rows();
                   $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                   $response[MESSAGE]=($count > 0)?'Success':'Fail';
                   $response[DESCRIPTION]=($count > 0)?$count.' cart list found':'No items found in your cart';
                   $response['item_count']=($count > 0)?$count:'No items found in your cart';
                   $response['cart_result']=($count > 0)?$sql->result():array();
            }
            else
            {
                $response[CODE]=DB_ERROR_CODE;
                $response[MESSAGE]='Db error';
                $response[DESCRIPTION]=(QUERY_DEBUG==1)?$db_error['message']:'Something error occured';
            }

            return  json_encode($response);
    }
    public function ordercartList($params)
    	{	
    	print_r($params);
            $response=array();
			$order_id =  $params['order_id'];	
            $product_folder=PRODCUCT_IMAGE_PATH;
            $where=array('c.cart_status'=>1,'order_id'=>$order_id);
            $cols="c.cart_id,c.unit_price as selling_price,c.qty,c.shipping_charges,p.id,p.prod_code,p.prod_group,p.prod_name,CONCAT('".$product_folder."',prod_image) as product_image,p.other_image,p.active_status,p.trash";
            $sql=  $this->db->select($cols,false)->from('ga_cart_tbl c')->join('ga_main_prod_details_tbl p','p.id=c.prod_id','inner')->where($where)->order_by('c.cart_id','ASC')->get();
               // echo    
            $db_error=  $this->db->error();
            if($db_error['code']==0)
            {
                   $count=$sql->num_rows();
                   $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                   $response[MESSAGE]=($count > 0)?'Success':'Fail';
                   $response[DESCRIPTION]=($count > 0)?$count.' cart list found':'No items found in the cart';
                   $response['item_count']=($count > 0)?$count:'No items found in the cart';
                   $response['cart_result']=($count > 0)?$sql->result():array();
            }
            else
            {
                $response[CODE]=DB_ERROR_CODE;
                $response[MESSAGE]='Db error';
                $response[DESCRIPTION]=(QUERY_DEBUG==1)?$db_error['message']:'Something error occured';
            }
            // print_r($response['cart_result']);exit;
            return  json_encode($response);
    }
    public function get_order_vendors($order_id){
    	$response=array();
    	$qry=$this->db->select('p.id as prod_id,p.vendor_id as vendor_id,c.cart_id,c.order_id,MAX(c.total_amount) as total')->from('ga_main_prod_details_tbl p')->join('ga_cart_tbl c','c.prod_id=p.id','right')->join('ga_orders_tbl o','o.orderid=c.order_id','right')->where('o.orderid',$order_id)->group_by('c.order_id')->get();
    	if($qry->num_rows() > 0){
    		$response=$qry->row()->vendor_id;
    	}
    	return json_encode($response);
    }
	 public function get_order_vendor($order_id){
    	$response=array();
    	$qry=$this->db->distinct()->select('p.vendor_id as vendor_id')
						->from('ga_main_prod_details_tbl p')
						->join('ga_cart_tbl c','c.prod_id=p.id')
						->join('ga_orders_tbl o','o.orderid=c.order_id')
						->where('c.order_id',$order_id)->get();
		if($qry->num_rows() > 0){
    		$response=$qry->result();
    	}
    	return json_encode($response);
    }
    public function vendor_order_details($order_id){
    	$response=array();
    	$qry=$this->db->select('p.id as prod_id,p.vendor_id as vendor_id,SUM(c.qty)as orderqty ,c.cart_id,c.order_id,(SUM(c.total_amount) + SUM(c.shipping_charges)) as totalpayableprice,SUM(c.total_amount) as orderprice,SUM(c.shipping_charges)as shippingprice ,o.ordernumber,o.address,o.orderdate,o.city as city,o.pincode as pincode,o.mobile as mobile')
					->from('ga_main_prod_details_tbl p')
					->join('ga_cart_tbl c','c.prod_id=p.id','right')
					->join('ga_orders_tbl o','o.orderid=c.order_id','right')
					->where('c.order_id',$order_id)
					->where('p.vendor_id',$_SESSION['vendor_id'])
					->where('c.cart_status !=',0)
					->group_by('c.order_id')
					->get();
    	if($qry->num_rows() > 0){
    		$response['result']=$qry->result();
    	}
    	return json_encode($response);
    }
	//Updated by:Zabih
	public function get_vendor_pay_order($order_id,$vendor_id){
    	$response=array();
    	$qry=$this->db->select('p.id as prod_id,p.vendor_id as vendor_id,c.cart_id,c.order_id,(SUM(c.total_amount)+SUM(c.shipping_charges))as totalpayableprice ,(o.delivery_due_date) as delivery_due_date')
					->from('ga_main_prod_details_tbl p')
					->join('ga_cart_tbl c','c.prod_id=p.id','right')
					->join('ga_orders_tbl o','o.orderid=c.order_id','right')
					->where('c.order_id',$order_id)
					->where('p.vendor_id',$vendor_id)
					->where('c.cart_status =',1)
					->group_by('c.order_id')
					->get();
    	if($qry->num_rows() > 0){
    		$response=$qry->row();
    	}
    	return json_encode($response);
    }
	

	public function shareCartByUser($params)
	{
		$result = array('userDeatails'=>array());	
		$user_id =  $params['user_id'];	
		$order_id =  $params['order_id'];	
		$userData = array();
		$where =  array('c.user_id'=>$user_id,'c.cart_status'=>1,'c.cart_type'=>2,'c.order_id'=>$order_id,'p.vendor_id'=>$_SESSION['vendor_id']);
		 $sql = $this->db->select('c.user_id as userid,SUM(c.total_amount) as user_shopping_amount,COUNT(c.cart_id) as user_shopping_count,u.user_reigster_id as usercode,u.user_name as username')
		->from('ga_cart_tbl c')
		->join('ga_users_tbl u','u.user_id=c.user_id')
		->join('ga_main_prod_details_tbl p','c.prod_id=p.id')
		->where($where)->group_by('c.user_id')
		->order_by('u.user_name','ASC')->get();
		
		$count = $sql->num_rows();
		// print_r($sql);exit;
		foreach($sql->result() as $res)
		{
			$userData['cart_result']=array();
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
						'c.user_id'=>$user_id,
						'c.order_id'=>$order_id,
						'p.vendor_id'=>$_SESSION['vendor_id'],
						'c.cart_status'=>1,
						);
					$itemsql =  $this->db->select('c.cart_status,c.cart_id,c.prod_id as productid,c.qty as qty,c.unit_price as unit_price,c.total_amount as total_amount,p.prod_code as productcode,p.prod_name as productname')
					->from('ga_cart_tbl c')
					->join('ga_main_prod_details_tbl p','p.id=c.prod_id','inner')
					->where($itemWhere)->order_by('c.total_amount','ASC')
					->get();
					$itemCount =  $itemsql->num_rows();
					if($itemCount > 0)
					{
						foreach($itemsql->result() as $itemResponse)
						{
							foreach($itemResponse as $i_key=>$i_val)
							{
								$itemArray[$i_key]	= $i_val;
							}
							array_push($userData['cart_result'], $itemArray);
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
		$user_id =  $params['user_id'];	
		$order_id =  $params['order_id'];
		$itemWhere=array('c.user_id'=>$user_id,'c.cart_status'=>1,'c.cart_type'=>2,'order_id'=>$order_id,'p.vendor_id'=>$_SESSION['vendor_id']);	
		$sql =  $this->db->select('p.id as product_id,p.prod_name as productname,p.prod_code as productcode,p.prod_group as productgroup,c.cart_id,COUNT(c.cart_id) as item_order_count,SUM(c.total_amount) as item_cart_amount')
			->from('ga_cart_tbl c')
			->join('ga_main_prod_details_tbl p','p.id=c.prod_id','inner')
			->where($itemWhere)->group_by('c.prod_id')
			->order_by('c.total_amount','ASC')->get();
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
				$userWhere = array('c.user_id'=>$user_id,'c.prod_id'=>$itemid,'c.cart_status'=>1,'order_id'=>$order_id );
				$usersql=$this->db->select('u.user_reigster_id as usercode,u.user_name as username,c.cart_id,c.qty as user_qty,c.unit_price as unit_price,c.total_amount as total_amount,c.cart_status')
				->from('ga_cart_tbl c')
				->join('ga_users_tbl u','u.user_id=c.user_id','inner')
				->where($userWhere)
				->order_by('c.total_amount','asc')
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



// Checkout statiscts
	public function checkoutStatistics($params)
	{
		$user_id =  $params['user_id'];	
		$order_id =  $params['order_id'];
		$response = array('cart_count'=>0,'cart_amount'=>0,'cart_shipping'=>0,
			'cart_grand_total'=>0,'cart_service_charge'=>0,'cart_discount'=>0);
		$where = array('user_id'=>$user_id,'cart_status'=>1,'order_id'=>$order_id);
		$sql = $this->db->select('COUNT(cart_id) as cart_count,SUM(total_amount) as cart_amount,SUM(shipping_charges) as cart_shipping_charges,SUM(discount) as cart_discount')
			->from('ga_cart_tbl')->where($where)->get();
		$count =  $sql->num_rows();
		if($count > 0)
		{
			$res =  $sql->row();
			$response['cart_count']=$res->cart_count;
			$response['cart_amount']=$res->cart_amount;
			$response['cart_shipping']=$res->cart_shipping_charges;
			$response['cart_discount']=$res->cart_discount;
			$response['cart_grand_total']=($res->cart_amount+$res->cart_shipping_charges-$res->cart_discount);
		}
		return json_encode($response);
	}
	public function commonGetWhere($tablename,$wherecondition) {
        $response = array();
        $this->db->where($wherecondition);
        $get_row = $this->db->get($tablename);
        $count = $this->db->affected_rows();
        if($count > 0 ){
         $response['result']=$get_row->row();
        }
        return json_encode($response);
    } 
    public function commonGetAll($tablename,$wherecondition) {
        $response = array();
        $this->db->where($wherecondition);
        $get_all = $this->db->get($tablename);
        $count = $this->db->affected_rows();
        if($count > 0 ){
         $response['result']=$get_all->result();
       
        }
        return json_encode($response);
    }   
}