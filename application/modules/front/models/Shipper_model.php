<?php 
class Shipper_model extends CI_Model{
	
	public function commonGetWhere($tablename,$wherecondition) {
        $response = array();
        $this->db->where($wherecondition);
        $get_row = $this->db->get($tablename);
        $update = $this->db->affected_rows();
        if($update > 0 ){
        	$response['result']=$get_row->result();
        }else{
        	$response['result']=null;
        }
        return json_encode($response);
    }  

    public function update_shipper($id)
    {
      $this->db->select("shipper_id,shipper_code,shipper_name,mobile,email,plot,street,area,city,state,pincode,website,gst,pan,tds")->from("ga_shippers_table")->where("shipper_id",$id);
      $query=$this->db->get();
      $count=$query->num_rows();
      return ($count > 0)?$query->row():array();
    }
    public function update_shipping_cost($id)
    {
      $this->db->select("*")->from("ga_shipping_cost_tbl")->where("shipping_cost_id",$id);
      $query=$this->db->get();
      $count=$query->num_rows();
      return ($count > 0)?$query->row():array();
    }
    public function update_shipping_order($id)
    {
      $this->db->select("*")->from("ga_orders_tbl")->where("orderid",$id);
      $query=$this->db->get();
      $count=$query->num_rows();
      return ($count > 0)?$query->row():array();
    }

 public function batchUpdate($table,$updatedata,$condition,$displaymessage=NULL)
    {
        $response=array();
        $sql=$this->db->update_batch($table,$updatedata,$condition);
        //echo $this->db->last_query(); exit;
        $affected_rows=$this->db->affected_rows();
        $response[CODE]=($sql > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($sql > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($sql > 0)?" $affected_rows records updated successfully":'Data not modified';
        return json_encode($response);
    }
public function update_data($table, $up, $uid) {

        $this->db->set($up);
        $this->db->where($uid);
        $updata = $this->db->update($table);
        $up=$this->db->affected_rows();
        if ($up > 0) {
            return true;
        } 
        else
         {
            return false;
        }
    }

public function get_all_open_orders($search=null,$limit=null,$offset=null){
    $response=array();
    $commonwhere=array('o.orderstatus'=>1);
    $vendor_id=$this->session->userdata('vendor_id');
    $this->db->select('p.id as prod_id,c.cart_id,c.order_id,o.*,u.power_user_id,u.user_name')->from('ga_main_prod_details_tbl p')->join('ga_cart_tbl c','c.prod_id=p.id','right')->join('ga_orders_tbl o','o.orderid=c.order_id','right')->join('ga_users_tbl u','o.userid=u.user_id','right')->where($commonwhere)->where('p.vendor_id',$vendor_id);
    if(is_array($search)){
        if($search['search_name']!=null){
            if(is_numeric($search['search_name'])){
                $this->db->where('pincode',$search['search_name']);
            }else{
                $this->db->like('address',$search['search_name'],'both');
                $this->db->or_like('city',$search['search_name'],'after');
            } 
        }
        if($search['overdue']!=null && $search['overdue']==1){
            $this->db->where('DATE(o.orderdate) <',date('Y-m-d'));
        }
        if($search['delivery_due_date']!=null && $search['delivery_due_date']==1){
            $this->db->where('DATE(o.orderdate) >',date('Y-m-d'));
        }
    }
    $this->db->group_by('c.order_id');
    if($search['overdue']!=null && $search['overdue']==1){
        $this->db->order_by('DATE(o.orderdate)','ASC');
    }else{
        $this->db->order_by('o.orderid','ASC');
    }
    $this->db->limit($limit,$offset);
    $res=$this->db->get();
    $count=$res->num_rows();
    // echo $this->db->last_query();
    $response[CODE]=($count>0)?SUCCESS_CODE:FAIL_CODE;
    $response[MESSAGE]=($count>0)?'Success':'Fail';
    if($count==1){$msg="1 order found";}
    if($count>1){$msg="$count orders found";}
    $response[DESCRIPTION]=($count>0)?$msg:'Open orders not found';
    $response['num_rows']=$count;
    $response['result']=($count>0)?$res->result():null;
    return json_encode($response);
}
public function get_all_shipping_cost($search=null,$limit=null,$offset=null){
    $response=array();
    $shipper_id=$this->session->userdata('shipper_id');
    $commonwhere=array('shipper_id'=>$shipper_id);
    $this->db->select('*')->from('ga_shipping_cost_tbl')->where($commonwhere);
    if(is_array($search)){
        if($search['search_name']!=null){
            // search query
        }
    }
    $this->db->order_by('shipping_cost_id','DESC');
    $this->db->limit($limit,$offset);
    $res=$this->db->get();
    $count=$res->num_rows();
    // echo $this->db->last_query();
    $response[CODE]=($count>0)?SUCCESS_CODE:FAIL_CODE;
    $response[MESSAGE]=($count>0)?'Success':'Fail';
    if($count==1){$msg="1 shipping cost found";}
    if($count>1){$msg="$count shipping costs found";}
    $response[DESCRIPTION]=($count>0)?$msg:'Shipping cost data not found';
    $response['num_rows']=$count;
    $response['result']=($count>0)?$res->result():null;
    return json_encode($response);
}


 }