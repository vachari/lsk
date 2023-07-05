<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * FileName :Setting_model.php
 * PageType : Model
 * PagePath : Setting_model.php
 * Page Purpose : Product related settings
 * Created Date : 11-04-17
 * Created By : Jittu
 * Team : Jittu
 */

Class Settings_model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }
    /* code for Insert prod related units starts here */
    public function batchInsert($table,$insertdata,$displaymessage=NULL)
    {
        $response=array();
        $sql=$this->db->insert_batch($table,$insertdata);
        $affected_rows=$this->db->affected_rows();
        $response['code']=($affected_rows > 0)?200:204;
        $response['message']=($affected_rows > 0)?'Success':'Fail';
        $response['description']=($affected_rows > 0)?"$affected_rows  records added successfully":'Unable to insert';
        return json_encode($response);
    }

public function commonInsert($table,$insertdata,$displaymessage=NULL)
    {
        $response=array();
        $sql=$this->db->insert($table,$insertdata);
        $affected_rows=$this->db->affected_rows();
        $response['code']=($affected_rows > 0)?200:204;
        $response['message']=($affected_rows > 0)?'Success':'Fail';
        $response['description']=($affected_rows > 0)?"$affected_rows  records added successfully":'Unable to insert';
        return json_encode($response);
    }
    /* code for Insert prod related units ends here */

    
      /* code for Commaon Delate starts here */
     public function common_delete($table,$conditionarray)
   {
        $response=array();
        $sql=$this->db->delete($table,$conditionarray);
        $action=$this->db->affected_rows();
            $response['code']='200';
            $response['message']='Success';
            $response['description']=$action.' Deleted Succesfully !!!';
         return json_encode($response);
    }
  /* code for Commaon Delate ends here */


    /* code for getting prod related units starts here */

    public function getUnitslist() {
        $response = array();
        $where = array(
            'trash' => 0,
            'active_status' => 1
        );
        $sql = $this->db->select('unit_code,id,created_by,created_on,trash,active_status')->from('ga_prod_units_tbl')->where($where)->order_by('id', 'DESC')->get();
        $count = $sql->num_rows();
        $resposne['code'] = ($count > 0) ? 200 : 204;
        $resposne['message'] = ($count > 0) ? 'Success' : 'Fail';
        $resposne['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $resposne['units_list'] = ($count > 0) ? $sql->result() : array();
        return json_encode($resposne);
    }

    /* code for getting prod related units ends here */

    
    /* code for getting group data started here */

    public function getGroupsList() {
        $response = array();
        $where = array(
            'trash' => 0,
            'active_status' => 1
        );

        $sql = $this->db->select('id,group_code,group_name,created_by,created_on,trash,active_status')->from('ga_prod_groups_tbl')->where($where)->order_by('id', 'DESC')->get();
        $count = $sql->num_rows();
        $resposne['code'] = ($count > 0) ? 200 : 204;
        $resposne['message'] = ($count > 0) ? 'Success' : 'Fail';
        $resposne['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $resposne['groups_list'] = ($count > 0) ? $sql->result() : array();
        return json_encode($resposne);
    }
    public function getGroups(){
        $response = array();
        $sql = $this->db->select('id,group_code,group_name')->from('ga_prod_groups_tbl')->where(['trash'=>0,'active_status'=>1])->order_by('group_name', 'ASC')->get();
        $count = $sql->num_rows();
        $response = ($count > 0) ? $sql->result() : null;
        return json_encode($response);
    }
    /* code for getting group data ends here */

    public function non_assigned_products($search=null,$limit=null,$si=null){
        $result=array();
        $this->db->select('p.id,p.prod_code,p.prod_group,p.prod_name,v.vendor_code,v.vendor_name,p.prod_image');
        $this->db->from('ga_main_prod_details_tbl p')->join('ga_vendors_table v','p.vendor_id=v.vendor_id','left');
        
        
        if(is_array($search)){
            if($search['product']!=null){
                 $this->db->group_start();
                $this->db->like('p.prod_code',$search['product'],'after');
                $this->db->or_like('p.prod_name',$search['product'],'after');
                 $this->db->group_end();
            }
            if($search['vendor']!=null){
                 $this->db->group_start();
                $this->db->like('v.vendor_code',$search['vendor'],'after');
                $this->db->or_like('v.vendor_name',$search['vendor'],'after');
                 $this->db->group_end();
            }   
        }
        $this->db->where('p.active_status',1);
        $this->db->where('p.prod_group',0);
        $this->db->limit($limit,$si);
        $this->db->order_by('p.prod_name','ASC');
        $query = $this->db->get();
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
        }else{
         $result=null;
     }
        return json_encode($result);
    }
    public function group_products($groupid=null,$search=null,$limit=null,$si=null){
        $result=array();
        $this->db->select('p.id,p.prod_code,p.prod_group,p.prod_name,v.vendor_code,v.vendor_name,p.prod_image');
        $this->db->from('ga_main_prod_details_tbl p')->join('ga_vendors_table v','p.vendor_id=v.vendor_id','left');
        
        if(is_array($search)){
           
            if($search['product']!=null){
                 $this->db->group_start();
                $this->db->like('p.prod_code',$search['product'],'after');
                $this->db->or_like('p.prod_name',$search['product'],'after');
                 $this->db->group_end();
            }
            if($search['vendor']!=null){
                 $this->db->group_start();
                $this->db->like('v.vendor_code',$search['vendor'],'after');
                $this->db->or_like('v.vendor_name',$search['vendor'],'after');
                 $this->db->group_end();
            }  
        }
        $this->db->where('p.active_status',1);
        if($groupid!=null){
         $this->db->where_in('p.prod_group',$groupid);
        }
        $this->db->limit($limit,$si);
        $this->db->order_by('p.prod_name','ASC');
        $query = $this->db->get();
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
        }else{
         $result=null;
     }
        return json_encode($result);
    }

public function assigned_group_products($groupid=null,$search=null,$limit=null,$si=null){
    $result=array();
        $this->db->select('p.id,p.prod_code,p.prod_group,p.prod_name,v.vendor_code,v.vendor_name,p.prod_image');
        $this->db->from('ga_main_prod_details_tbl p')->join('ga_vendors_table v','p.vendor_id=v.vendor_id','left');
        $this->db->where('p.active_status',1);
        if(is_array($search) && $search!=null){
            if($search['product']!=null){
                 $this->db->where('p.prod_group',$groupid);
                $this->db->like('p.prod_code',$search['product'],'after');
                $this->db->or_like('p.prod_name',$search['product'],'after');
            }
            if($search['vendor']!=null){
                 $this->db->where('p.prod_group',$groupid);
                $this->db->like('v.vendor_code',$search['vendor'],'after');
                $this->db->or_like('v.vendor_name',$search['vendor'],'after');
            }
        }else{
             $this->db->where('p.prod_group',$groupid);
        }
        $this->db->limit($limit,$si);
        $this->db->order_by('p.prod_name','ASC');
        $query = $this->db->get();
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
        }else{
         $result=null;
     }
        return json_encode($result);
}

      /* code for getting units data Starts here */
    public function get_unitsdata($table, $uid) {
      
        $this->db->where('id', $uid);
        $query = $this->db->get($table);
        $count = $this->db->affected_rows();
        if ($count > 0) {

            $result = $query->row();
        }else{ $result=(object)null;}
          $result= json_encode($result);
        return $result;
        //print_r($result);
       }

       /* code for getting group data ends here */

       /* code for update units data Starts here */
     public function up_data($table, $up, $uid) {

        $this->db->set($up);
        $this->db->where('id', $uid);
        $this->db->update($table);
        $up = $this->db->affected_rows();
        if ($up > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function update_data($table, $update_data, $where) {

        $this->db->set($update_data);
        $this->db->where($where);
        $this->db->update($table);
        $up = $this->db->affected_rows();
        if ($up > 0) {
            return true;
        } else {
            return false;
        }
    }
    /* code for Update units data ends here */

    public function commonStatusActivity($tablename,$setcolumns,$updatevalue,$wherecondition)
    {
        $response=array();
        $update_sql=$this->db->update_string($tablename,array($setcolumns=>$updatevalue),$wherecondition);
        $qry=$this->db->query($update_sql);
        $update=$this->db->affected_rows();
        switch($updatevalue){
            case 0:
            $updatestatus="$update De-Activated Successfully ";
            break;
            case 1:
            $updatestatus="$update Activated Successfully";
            break;
        }
        $response['code']=($update > 0)?200:204;
        $response['message']=($update > 0)?'Success':'Fail';
        $response['description']=($update > 0)?"<b>$updatestatus</b>":'<b style="color:red;font-weight:bold;">Unable to update</b>';
        return json_encode($response);
    }
    public function groupProductsUpdate($tablename,$setcolumns,$updatevalue,$wherecondition)
    {
        $response=array();
        $update_sql=$this->db->update_string($tablename,array($setcolumns=>$updatevalue),$wherecondition);
        $qry=$this->db->query($update_sql);
        $update=$this->db->affected_rows();
        $response['code']=($update > 0)?200:204;
        $response['message']=($update > 0)?'Success':'Fail';
        $response['description']=($update > 0)? 'Products assigned to group successfully!' : "Failed, Products couldn't assigned/removed";
        return json_encode($response);
    }



}

?>