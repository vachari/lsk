<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Vendor_model extends CI_MODEL{

 	public function update_vendor($id)
	{
	  $this->db->select("vendor_id,vendor_code,vendor_name,mobile,email,plot,street,area,city,state,pincode,website,gst,pan,tds")->from("ga_vendors_table")->where("vendor_id",$id);
	  $query=$this->db->get();
	  $count=$query->num_rows();
	  return ($count > 0)?$query->row():array();
	}
    public function update_vendor_payment_details($id)
    {
      $this->db->select("*")->from("ga_payment_terms_tbl")->where("vendor_id",$id);
      $query=$this->db->get();
      $count=$query->num_rows();
      return ($count > 0)?$query->row():array();
    }
    public function update_vendor_contacts($id)
    {
      $this->db->select("*")->from("ga_vendor_contacts_tbl")->where("vendor_id",$id);
      $query=$this->db->get();
      $count=$query->num_rows();
      return ($count > 0)?$query->result():array();
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
public function update_vendor_details($table, $up, $uid) {

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
    public function get_vendor_records($cols,$table_name,$like_col=NULL,$orderby,$limit,$start,$search)
    {
        $response=array();
        $sql=$this->db->select($cols)->from($table_name);
        if ($search !='') {
            if(is_numeric($search)){
                 $this->db->where('mobile',$search);
                 $this->db->or_where('plot',$search);
            }else{
                $this->db->group_start();
                $this->db->like('vendor_code',$search,'both');
                $this->db->or_like('vendor_name',$search,'both');
                $this->db->or_like('street',$search,'both');
                $this->db->or_like('area',$search,'both');
                $this->db->or_like('city',$search,'after');
                $this->db->or_like('state',$search,'after');
                $this->db->group_end();
            }
        }else {
            $this->db->limit($limit, $start);
        }
          $query=$sql->order_by($orderby,'DESC')->get();
        //$sql=$this->db->limit($limit, $start);
    
        // print_r($this->db->last_query());exit;
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
            $response['search_vendor'] = array('search' => $search);
         }
        return json_encode($response);       
    }
    public function get_vendor_payments($search=null,$limit=null,$offset=null){
        $response=array();
        $this->db->select('v.vendor_code,v.vendor_name,v.mobile,v.email,v.city,v.pincode,vp.*,o.ordernumber as order_number,o.city,o.pincode,o.poweruserid as power_user_id,u.user_name as power_user_name')->from('ga_vendor_payment_table vp')->join('ga_vendors_table v','vp.vendor_id=v.vendor_id')->join('ga_orders_tbl o','vp.order_id=o.orderid')->join('ga_users_tbl u','o.poweruserid=u.user_id');
        if(is_array($search)){
            if(isset($search['search_name']) && $search['search_name']!=null){
                if(is_numeric($search['search_name'])){
                    $this->db->where('o.pincode',$search['search_name']);
                    $this->db->where('v.mobile',$search['search_name']);
                }else{
                    $this->db->group_start();
                    $this->db->like('o.ordernumber',$search['search_name']);
                    $this->db->or_like('v.email',$search['search_name'],'after');
                    $this->db->or_like('o.city',$search['search_name'],'after');
                    $this->db->group_end();
                }
            }
            if(isset($search['vendor']) && $search['vendor']!=null){
                $this->db->where('vp.vendor_id',$search['vendor']);
            }
            if(isset($search['power_user']) && $search['power_user']!=null){
                $this->db->where('o.poweruserid',$search['power_user']);
            }
            if(isset($search['delivery_date']) && strtotime($search['delivery_date']) > 0){
                $this->db->where('vp.delivery_date',date('Y-m-d',strtotime($search['delivery_date'])));
            }
        }
        $this->db->limit($limit,$offset);
        $res=$this->db->get();
        $count=$res->num_rows();
        // echo $this->db->last_query();
        $response[CODE]=($count>0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($count>0)?'Success':'Fail';
        if($count==1){$msg="1 payment found";}
        if($count>1){$msg="$count payments found";}
        $response[DESCRIPTION]=($count>0)?$msg:'Payments not found';
        $response['num_rows']=$count;
        $response['result']=($count>0)?$res->result():null;
        return json_encode($response); 
    }
    public function get_power_users(){
    $response=array();
    $commonwhere=array('power_user_id'=>0,'user_status'=>1,'power_approved'=>1);
    $this->db->select('user_id,user_name')->from('ga_users_tbl')->where($commonwhere);
    $this->db->order_by('user_name','ASC');
    $res=$this->db->get();
    $count=$res->num_rows();
    // echo $this->db->last_query();
    $response[CODE]=($count>0)?SUCCESS_CODE:FAIL_CODE;
    $response[MESSAGE]=($count>0)?'Success':'Fail';
    if($count==1){$msg="1 power user found";}
    if($count>1){$msg="$count power users found";}
    $response[DESCRIPTION]=($count>0)?$msg:'Power users data not found';
    $response['num_rows']=$count;
    $response['result']=($count>0)?$res->result():null;
    return json_encode($response);
}

 }