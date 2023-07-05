<?php 
class Checkout_model extends CI_Model{
	public function checkoutResult($params)
	{
		$response=array();	
		$cart_session = $params['cart_session'];
		$response['sharecart_user']=$this->shareCartByUser(array('cart_session'=>$cart_session));
		$response['sharecart_item']=$this->shareCartByItem(array('cart_session'=>$cart_session));
		return json_encode($response);
	}

	public function shareCartByUser($params)
	{
		$result = array('userDeatails'=>array());	
		$cart_session =  $params['cart_session'];	
		$userData = array();
		$where =  array('c.cart_session_id'=>$cart_session,'c.cart_status'=>0,'c.cart_type'=>2);
		$sql = $this->db->select('c.user_id as userid,SUM(c.total_amount) as user_shopping_amount,COUNT(c.cart_id) as user_shopping_count,u.user_reigster_id as usercode,u.user_name as username,u.user_type as usertype')
		->from('ga_cart_tbl c')
		->join('ga_users_tbl u','u.user_id=c.user_id')
		->where($where)->group_by('c.user_id')
		->order_by('u.user_name','ASC')->get();
		$count = $sql->num_rows();
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
						'c.cart_session_id'=>$cart_session,
						'c.cart_status'=>0,
						);
					$itemsql =  $this->db->select('c.cart_id as cartid,c.prod_id as productid,c.qty as qty,c.unit_price as unit_price,c.total_amount as total_amount,p.prod_code as productcode,p.prod_name as productname')
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
		$cart_session =  $params['cart_session'];
		$itemWhere=array('c.cart_session_id'=>$cart_session,'c.cart_status'=>0,'c.cart_type'=>2);	
		$sql =  $this->db->select('c.cart_id as cartid,p.id as product_id,p.prod_name as productname,p.prod_code as productcode,p.prod_group as productgroup,COUNT(c.cart_id) as item_order_count,SUM(c.total_amount) as item_cart_amount')
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
				$userWhere = array('c.cart_session_id'=>$cart_session,'c.prod_id'=>$itemid,'c.cart_status'=>0);
				$usersql=$this->db->select('u.user_id as userid,u.user_reigster_id as usercode,u.user_name as username,c.cart_id as cartid,c.qty as user_qty,c.unit_price as unit_price,c.total_amount as total_amount')
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
	public function checkoutStatistics($cartsession,$carttype=NULL)
	{
		$response = array('cart_count'=>0,'cart_amount'=>0,'cart_shipping'=>0,
			'cart_grand_total'=>0,'cart_service_charge'=>0,'cart_discount'=>0);
		$where = array('cart_session_id'=>$cartsession,'cart_status'=>0);//,'cart_type'=>1
		 $this->db->select('COUNT(cart_id) as cart_count,SUM(total_amount) as cart_amount,SUM(shipping_charges) as cart_shipping_charges,qty as cart_qty, SUM(discount) as cart_discount')
			->from('ga_cart_tbl')->where($where);
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

	public function checkoutUserStatistics($cartsession,$carttype=NULL)
	{
		$response = array('cart_count'=>0,'cart_amount'=>0,'cart_shipping'=>0,
			'cart_grand_total'=>0,'cart_service_charge'=>0,'cart_discount'=>0);
		$where = array('cart_session_id'=>$cartsession,'cart_status'=>0);//,'cart_type'=>1
		 $this->db->select('COUNT(cart_id) as cart_count,SUM(total_amount) as cart_amount,SUM(shipping_charges) as cart_shipping_charges,SUM(qty) as cart_qty, SUM(discount) as cart_discount')
			->from('ga_cart_tbl')->where($where);
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
	
	
	public function wishlist($pid){
		//echo $pid;exit;
        $uid=$this->session->userdata("user_id");
        $res=$this->db->select("id")->from("ga_wishlist_tbl")->where(["user_id"=>$uid,"prod_id"=>$pid])->get();
        $count=$res->num_rows();
        if($count==0){
             $date=date("Y-m-d");
             $data=array("prod_id"=>$pid,"user_id"=>$uid,"created_on"=>$date);
             $this->db->insert("ga_wishlist_tbl",$data);
        }else{
        	$this->db->delete("ga_wishlist_tbl",['user_id'=>$uid,'prod_id'=>$pid]);
        }
        //return 1;
    }

    public function return_wishlist()
    {
      $uid=$this->session->userdata("user_id");
      if(empty($uid))
        $uid=0;
      else
        $uid=$uid;
    	$res=$this->db->select("prod_id")->from("ga_wishlist_tbl")->where("user_id",$uid)->get();
    	$count=$res->num_rows();
    	if($count>0)
    		return $res->result();
    	else
    		return null;
    }
    
    public function ResultWhere($select,$tbl,$where,$orderby_col,$order){
        if($orderby_col){
            $this->db->order_by($orderby_col,$order);
        }
        if($where){
            $this->db->where($where);
        }
        $res=$this->db->select($select)->from($tbl)->get();
        //echo $this->db->last_query();exit;
        $count=$res->num_rows();
        if($count>0)
            return $res->result();
        else
            return null;
    }
}