<?php

Class Super_model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function can_login($data){
        $response=array();
        $this->db->where('email',$data['email']);
        $this->db->where('password',md5($data['password']));
        $sql_fetch=$this->db->get('admin');
        //return $query->row();
       // print_r($query);exit;
         $db_error =  $this->db->error();
        if($db_error['code']!=0)
        {
                $response['code']='575';
                $response['message']='DB Error';
                $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {       //if()
                $count=$sql_fetch->num_rows();
                if($count>0){
                    $this->db->set('login_time',DATE);
                    $this->db->where('email',$data['email']);
                    $this->db->where('password',md5($data['password']));
                    $this->db->update('admin');
                }
                $response['code']=($count  > 0 )?200:204;
                $response['message']=($count  > 0 )?'Success':'Fail';
                $response['description']=($count  > 0 )?'Getting the user list':'No results found';
                $response['result_count']=$count;
                $response['common_result']=($count  > 0 )?$sql_fetch->row():(object) null;
        }
        
        return json_encode($response);


    }

    public function login_update() {
        $this->db->set($up);
        $this->db->where($uid);
        $up = $this->db->update($table);
        if ($up) {
            return true;
        } else {
            return false;
        }
    }

    public function addmenu($tbl, $dat) {
        $res = $this->db->insert($tbl, $dat);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function managemenu() {
        $this->db->order_by('menu_id', 'DESC');
        $query = $this->db->get('menu_tbl');
        
    }
    public function get_catdata($table){
        $result=array();
         $query = $this->db->get($table);
          $count = $this->db->affected_rows();

        if ($count > 0) {

            $result = $query->result();
        }else{
            $result = array();
        }
       // print_r($result);exit;
        return $result;

    }
    public function getCategories(){
        $result=array();
        $this->db->select('menu_id,menu_title')->from('menu_tbl')->order_by('menu_title','ASC');
         $query = $this->db->get();
          $count = $this->db->affected_rows();
        if ($count > 0) {
            $result = $query->result();
        }else{
            $result = array();
        }
        return $result;

    }

 public function get_records($cols,$table_name,$like_col,$orderby,$limit,$start,$search)
    {
        $response=array();
        $sql=$this->db->select($cols)->from($table_name);
        if ($search !='') {
            if(is_numeric($search)){
                 $this->db->where($like_col,$search); 
            }else{
              $this->db->like($like_col,$search,'both');
            }
        }else {
            $this->db->limit($limit, $start);
        }
          $query=$sql->order_by($orderby,'DESC')->get();
        //$sql=$this->db->limit($limit, $start);
    
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

    public function addsubmenu() {
        //	$this->db->order_by('menu_title', 'DESC');
        $query = $this->db->get('menu_tbl');
        return $query;
    }

    public function ins_submenu($tbl, $dat) {
        $res = $this->db->insert($tbl, $dat);
        //echo $this->db->last_query();exit;
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function getsubmenu() {
        $this->db->order_by('submenu_id', 'DESC');
        $query = $this->db->get('submenu_tbl');
        return $query;
    }

    public function addlistsubmenu() {
        $this->db->order_by('submenu_title', 'DESC');
        $query = $this->db->get('submenu_tbl');
        return $query;
    }

    public function get_menu_data() {
        $this->db->order_by('submenu_title', 'DESC');
        $query = $this->db->get('submenu_tbl');
        return $query;
    }
    public function ins_listsubmenu($tbl, $dat) {
        $res = $this->db->insert($tbl, $dat);
        //echo $this->db->last_query();exit;
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function ins_slider($tbl, $dat) {
        $res = $this->db->insert($tbl, $dat);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function get_slider() {
        $query = $this->db->get('slider_tbl');
        return $query;
    }
    public function get_alldata($table,$where) {
        $response=array();
        $this->db->where($where);
        $query = $this->db->get($table);
        $count = $this->db->affected_rows();
        $db_error =  $this->db->error();

        $respose[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $respose[MESSAGE]=($count > 0)?' success ':' failed ';
        $respose[DESCRIPTION]=($count > 0)? " $count result found ":' No result found ';
        $respose['data_result']=$query->result();
        return json_encode($respose);
      
    }

    public function slider_delete($table, $id) {
        $this->db->where('id', $id);
        $ress = $this->db->delete($table);
        if ($ress) {
            return true;
        } else {
            return false;
        }
    }

    public function getlistsubmenu() {
          $result =array();
        $query = $this->db->get('listsubmenu_tbl');
         $count = $this->db->affected_rows();
        if ($count > 0) {

            $result = $query->result();
        }
        return $result;
    }
     public function getdatasub($table) {
        $query = $this->db->get($table);
         $count = $this->db->affected_rows();
        if ($count > 0) {

            $result = $query->result();
        }
        return $result;
    }

    public function menu_delete($table, $id) {

        $this->db->where('menu_id', $id);
        $ress = $this->db->delete($table);
        if ($ress) {
            return true;
        } else {
            return false;
        }
    }

    public function get_data($table, $uid) {
        $this->db->where('menu_id', $uid);
        $query = $this->db->get($table);
        $count = $this->db->affected_rows();
        if ($count > 0) {

            $result = $query->row();
        }
        return $result;
    }

    public function up_data($table, $up, $uid) {
        $this->db->set($up);
        $this->db->where('menu_id', $uid);
        $this->db->update($table);
        $up = $this->db->affected_rows();
        if ($up > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function update_slider($table, $up, $uid) {

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
    

    public function submenu_delete($table, $id) {

        $this->db->where('submenu_id', $id);
        $ress = $this->db->delete($table);
        // $this->db->last_query();
        if ($ress) {
            return true;
        } else {
            return false;
        }
    }

    public function listsubmenu_delete($table, $id) {

        $this->db->where('listsubmenu_id', $id);
        $ress = $this->db->delete($table);
        //echo $this->db->last_query();
        if ($ress) {
            return true;
        } else {
            return false;
        }
    }

    public function get_subdata($table, $where) {
         
     $this->db->where($where);
        $query = $this->db->get($table);
        //print_r($query);exit;
        //print_r( $query->row());exit;
        $count = $this->db->affected_rows();
        if ($count > 0) {

            $result = $query->row();
        }
        return $result;
    }


    public function getmenu_data() {
        //	$this->db->order_by('menu_title', 'DESC');
        $sel = array('menu_id', 'menu_title');
        $this->db->select($sel);
        $query = $this->db->get('menu_tbl');
        $count = $this->db->affected_rows();
        if ($count > 0) {

            $result = $query->result();
        }

        return $result;
    }

    public function up_subdata($table, $up, $uid) {

        $this->db->set($up);
        $this->db->where('submenu_id', $uid);
       $this->db->update($table);
        $up = $this->db->affected_rows();
        if ($up > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function up_listsubdata($table, $up, $uid) {

        $this->db->set($up);
        $this->db->where('listsubmenu_id', $uid);
         $this->db->update($table);
        $up = $this->db->affected_rows();
        if ($up > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function updatePassword($table, $up, $uid) {

        $this->db->set($up);
        $this->db->where($uid);
        $up = $this->db->update($table);
        $change=$this->db->affected_rows();
      // print_r($change);exit;
        if($change>0){
            return true;
        }
        else{

            return false;
        }
    }
      public function commonCheckPassword($data) {
        //print_r($data);exit;
         $response=array();
        $this->db->where('id',$data['id']);
        $this->db->where('password',md5($data['password']));
        $query=$this->db->get('admin');
        $chek=$this->db->affected_rows();
       // print_r($chek);
        if($chek>0){
            return true;
        }
        else{

            return false;
        }
        
        }

    
public function commonGetAll($table){
    $query=$this->db->get($table);
    return $query->result();
  }
   public function getProductList($cols,$table_name,$like_col,$orderby,$limit,$start,$search)
    {
        $response=array();
        $sql=$this->db->select($cols)->from($table_name)->join('ga_vendors_table v','v.vendor_id=p.vendor_id','left')->join('ga_prod_units_tbl u','u.id=p.unit','left')->join('ga_prod_groups_tbl g','p.prod_group=g.id','left');
        if ($search == '') {
            $this->db->limit($limit, $start);
        }
        if ($search != '' && is_numeric($search)) {
            $this->db->where($like_col,$search);
        }
        if ($search != '' && !is_numeric($search)) {
            ($search != '') ? $this->db->like($like_col,$search,'after') : '';
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
 

    //Active & De-active for common
    public function commonStatusActivity($tablename, $setcolumns, $updatevalue, $wherecondition) {
        $response = array();
        $update_sql = $this->db->update_string($tablename, array($setcolumns => $updatevalue), $wherecondition);
        $qry = $this->db->query($update_sql);
        $update = $this->db->affected_rows();
        switch ($updatevalue) {
            case 0:
                $updatestatus = "$update De-Activated Successfully ";
                break;
            case 1:
                $updatestatus = "$update Activated Successfully";
                break;
        }
        $response['code'] = ($update > 0) ? 200 : 204;
        $response['message'] = ($update > 0) ? 'Success' : 'Fail';
        $response['description'] = ($update > 0) ? "<b>$updatestatus</b>" : '<b style="color:red;font-weight:bold;">Unable to update</b>';
        return json_encode($response);
    }

    //Delete function for common
    public function getMenuList() {
        $response = array();
        $where = array('flag_status' => 1);
        $sql = $this->db->select("menu_id,menu_title")->from('menu_tbl')->where($where)->get();
        $count = $sql->num_rows();
        $resposne['code'] = ($count > 0) ? 200 : 204;
        $resposne['message'] = ($count > 0) ? 'Success' : 'Fail';
        $resposne['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $resposne['menu_list'] = ($count > 0) ? $sql->result() : array();
        return json_encode($resposne);
    }
    public function getVendorList()
    {
        $response = array();
        $where = array('vendor_status' => 1);
        $sql = $this->db->select("vendor_id,vendor_name,vendor_code")->from('ga_vendors_table')->where($where)->get();
        $count = $sql->num_rows();
        $resposne['code'] = ($count > 0) ? 200 : 204;
        $resposne['message'] = ($count > 0) ? 'Success' : 'Fail';
        $resposne['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $resposne['vendor_list'] = ($count > 0) ? $sql->result() : array();
        return json_encode($resposne);
    }
    public function subMenu($where = NULL) {
        $response = array();
        $common_where = array('flag_status' => 1);
        $this->db->select('submenu_id as id,submenu_title as title,menu_id as menuid')->from('submenu_tbl')->where($common_where);
        ($where != '' && is_array($where)) ? $this->db->where($where) : '';
        $sql = $this->db->order_by('submenu_title', 'ASC')->get();
        $count = $sql->num_rows();
        $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $response[MESSAGE] = ($count > 0 ) ? 'Success' : 'Fail';
        $response[DESCRIPTION] = ($count > 0) ? 'Total ' . $count . 'results found' : 'No results found';
        $response['submenu_result'] = ($count > 0) ? $sql->result() : array();
        return json_encode($response);
    }

    public function listSubMenu($where = NULL) {
        $response = array();
        $common_where = array('flag_status' => 1);
        $this->db->select('listsubmenu_id as id,listsubmenu_title as title,submenu_id as submenuid')->from('listsubmenu_tbl')->where($common_where);
        ($where != '' && is_array($where)) ? $this->db->where($where) : '';
        $sql = $this->db->order_by('listsubmenu_title', 'ASC')->get();
        $count = $sql->num_rows();
        $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $response[MESSAGE] = ($count > 0 ) ? 'Success' : 'Fail';
        $response[DESCRIPTION] = ($count > 0) ? 'Total ' . $count . 'results found' : 'No results found';
        $response['listsubmenu_result'] = ($count > 0) ? $sql->result() : array();
        return json_encode($response);
    }

    public function getProductDetails() {
        $response = array();
        $where = array('flag_status' => 1);
        $this->db->select('*')->from('product_tbl');
        ($where != '' && is_array($where)) ? $this->db->where($where) : '';
        $sql = $this->db->order_by('prod_id', 'DESC')->get();
        $count = $sql->num_rows();
        $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $response[MESSAGE] = ($count > 0 ) ? 'Success' : 'Fail';
        $response[DESCRIPTION] = ($count > 0) ? 'Total ' . $count . 'results found' : 'No results found';
        $response['product_details'] = ($count > 0) ? $sql->result() : array();
        return json_encode($response);
    }

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
    public function getProductData($id){
       /*  $where=array('p.prod_id'=>$id);
        $sql=$this->db->select("m.menu_id as menu_id,s.submenu_id as submenu_id,l.listsubmenu_title as listsubmenu_title,p.prod_id as prod_id,p.listsubmenu_id as listsubmenu_id,p.prod_code as prod_code,p.prod_title as prod_title,p.prod_desc as prod_desc,p.prod_skuqty as prod_skuqty,p.total_order_qty_from as total_order_qty_from,p.total_order_qty_to as total_order_qty_to,p.mrp as mrp,p.sellingprice as sellingprice,p.stock as stock,p.moq as moq,p.truckloadqty as truckloadqty,p.image as image,p.vendor as vendor")->from('product_tbl p')->join('listsubmenu_tbl l','p.listsubmenu_id=l.listsubmenu_id')->join('submenu_tbl s','l.submenu_id=s.submenu_id')->join('menu_tbl m','l.menu_id=m.menu_id')->where($where)->get();
        print_r($this->db->last_query());*/
    }
   
   public function updateMenuCode($table, $up, $uid) {

        $this->db->set($up);
        $this->db->where($uid);
        $up = $this->db->update($table);
        if ($up) {
            return true;
        } else {
            return false;
        }
    }


}

?>