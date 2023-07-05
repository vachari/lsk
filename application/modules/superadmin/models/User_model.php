<?php
 
Class User_model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }
 public function common_list_paging($cols,$table_name,$like_col,$orderby,$limit,$start,$search,$where)
    {
        $response=array();
        $sql=$this->db->select($cols)->from($table_name)->where($where);
        if ($search == '') {
            $this->db->limit($limit, $start);
        }
        if ($search != '') {
            ($search != '') ? $this->db->like($like_col,$search,'after') : '';
        }
        //$sql=$this->db->limit($limit, $start);
        $query=$sql->order_by($orderby,'DESC')->get();
        //print_r($this->db->last_query());exit;
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']='575';
            $resposne['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
            $response['code']=($count > 0)?200 :204;
            $response['message']=($count  > 0 )?'Success':'Fail';
            $response['description']=($count  > 0 )?'Getting the list':'No results found';
            $response['result_count']=$count;
            $response['common_result']=($count  > 0 )?$query->result():(object) null;
            $response['search_category'] = array('search' => $search);
         }
        return json_encode($response);       
    }
    public function commonGetA($tablename,$wherecondition) {
        $response = array();
        $this->db->where($wherecondition);
        $get_all = $this->db->get($tablename);
        $update = $this->db->affected_rows();
        if($update > 0 ){
         $response['result']=$get_all->row();
       
        }
        return json_encode($response);
    }
    public function get_Fetch($table) {
        $response=array();
        $query = $this->db->get($table);
        $count = $this->db->affected_rows();
        $db_error =  $this->db->error();
        $respose[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $respose[MESSAGE]=($count > 0)?' success ':' failed ';
        $respose[DESCRIPTION]=($count > 0)? " $count result found ":' No result found ';
        $respose['data_result']=$query->result();
        return json_encode($respose);
      
    } 
    
    public function paging_list($cols,$table_name,$like_col,$like_col2,$orderby,$limit,$start,$search,$where)
    {
        $response=array();
        $sql=$this->db->select($cols)->from($table_name)->where($where);
        if ($search == '') {
            $this->db->limit($limit, $start);
        }
        if ($search != '') {
            ($search != '') ? $this->db->like($like_col,$search,'after') : '';
        }
        if ($search != '') {
            ($search != '') ? $this->db->or_like($like_col2,$search,'after') : '';
        }
        //$sql=$this->db->limit($limit, $start);
        $query=$sql->order_by($orderby,'DESC')->get();
        //print_r($this->db->last_query());
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']='575';
            $resposne['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
            $response['code']=($count > 0)?200 :204;
            $response['message']=($count  > 0 )?'Success':'Fail';
            $response['description']=($count  > 0 )?'Getting the list':'No results found';
            $response['result_count']=$count;
            $response['common_result']=($count  > 0 )?$query->result():(object) null;
            $response['search_category'] = array('search' => $search);
         }
        return json_encode($response);       
    }  
    
    public function commonGetAll($tablename,$wherecondition) {
        $response = array();
        $this->db->where($wherecondition);
        $get_all = $this->db->get($tablename);
        $count = $this->db->affected_rows();
        $db_error =  $this->db->error();

        $respose[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $respose[MESSAGE]=($count > 0)?' success ':' failed ';
        $respose[DESCRIPTION]=($count > 0)? " $count result found ":' No result found ';
        $respose['result']=$get_all->result();
        return json_encode($respose);

    }
    
    
    public function ArrayUpdate($update,$tbl,$where,$select){

        $sql=$this->db->select($select)->from($tbl)->get();
    
    //echo $this->db->last_query();exit;
        $count=$sql->num_rows();
        if($count>0){
        $res=$this->db->update($tbl,$update,$where);
        //echo $this->db->last_query();exit;
       if($this->db->affected_rows())
        if($res);
            return true;
        }else{
            return false;
        }
    }
	
	/**
	* Updated By:Zabih
	* This Function Copied From front/orders_model
	*/
	public function myWalletData(){
		 /*
		 * Update By	:Zabihullah
		 * Changes		:Before We were displaying all the orders which were canceled 
		 * 				 Now We will display each item which has status 5(cancel)
		 * 				 
		 */
         $response = array();
        $this->db->where(array('c.cart_status'=>5));
        $this->db->select("u.user_name,c.cart_id,c.cart_type,o.orderid,o.ordernumber,o.orderdate,c.cancelled_date as item_cancelled_date,o.cancelled_date as order_cancelled_date,c.shipping_charges,c.unit_price,c.total_amount,(c.shipping_charges+c.total_amount)as refund_amount,p.prod_name");    
        $this->db->from('ga_orders_tbl o');
        $this->db->join('ga_cart_tbl c', 'c.order_id = o.orderid');
		$this->db->join('ga_main_prod_details_tbl p','p.id = c.prod_id');
		$this->db->join('ga_users_tbl u','c.user_id=u.user_id');
        $this->db->order_by('c.cart_id', 'DESC');
        $query = $this->db->get();
		//echo $this->db->last_query();exit;
        $itemCount =  $query->num_rows();
        $db_error =  $this->db->error();
        $respose[CODE]=($itemCount > 0)?SUCCESS_CODE:FAIL_CODE;
        $respose[MESSAGE]=($itemCount > 0)?' success ':' failed ';
        $respose[DESCRIPTION]=($itemCount > 0)? " $itemCount result found ":' No result found ';
        $respose['result']=$query->result();
        return json_encode($respose);
    }
}