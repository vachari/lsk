<?php 
class Vendor_model extends CI_Model{
	
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
     public function commonUpdate($table, $update_data, $update_condition, $displaymessage = NULL, $debug = NULL,$failmessage=NULL) {
        $response = array();
        if (is_array($update_data) && is_array($update_condition)) {
            $sql = $this->db->update_string($table, $update_data, $update_condition);
            if (isset($debug) && $debug == 'debug') {
                $response[QUERY_MESSAGE] = $sql;
            } else {
                $update = $this->db->query($sql);
                $error = $this->db->error();
                $error_message = $error['message'];
                if ($error['code'] == 0) {
                    try {
                        $count = $this->db->affected_rows();
                        if ($count > 0) {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $displaymessage;
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] =!empty($failmessage)?$failmessage:'Data not updated';
                        }
                    } catch (Exception $ex) {
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Fail';
                        $response[DESCRIPTION] = 'Some thing error occured';
                    }
                } else {
                    $response[CODE] = DB_ERROR_CODE;
                    $response[MESSAGE] = 'Database Error';
                    $response[DESCRIPTION] = $error_message;
                }
                if (QUERY_DEBUG == 1) {
                    $response[QUERY_DEBUG_MESSAGE] = $error_message;
                    $response[QUERY_MESSAGE] = $sql;
                }
            }
        } else {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Invalid format';
            $response[DESCRIPTION] = 'Input data is in invalid format';
        }
        return json_encode($response);
    }

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
    public function get_accounts_receivable($search=null,$limit=null,$offset=null){
        $response=array();
        $vendor_id=$this->session->userdata('vendor_id');
        $commonwhere=array('vp.vendor_id'=>$vendor_id,'c.cart_status'=>1);
        $this->db->distinct()->select('vp.*,o.ordernumber as order_number,o.city,o.pincode,o.poweruserid as power_user_id,u.user_name as power_user_name')
                    ->from('ga_orders_tbl o')
                    ->join('ga_cart_tbl c','c.order_id=o.orderid')
                    ->join('ga_vendor_payment_table vp','vp.order_id=o.orderid')
                    ->join('ga_users_tbl u','o.poweruserid=u.user_id')
                    ->where($commonwhere)
                    ->group_by('c.order_id');
        if(is_array($search)){
            if(isset($search['search_name']) && $search['search_name']!=null){
                if(is_numeric($search['search_name'])){
                    $this->db->where('o.pincode',$search['search_name']);
                }else{
                    $this->db->group_start();
                    $this->db->like('o.ordernumber',$search['search_name']);
                    $this->db->or_like('o.city',$search['search_name'],'after');
                    $this->db->group_end();
                }
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

    public function update_shipper($id)
    {
      $this->db->select("shipper_id,shipper_code,shipper_name,mobile,email,plot,street,area,city,state,pincode,website,gst,pan,tds")->from("ga_shippers_table")->where("shipper_id",$id);
      $query=$this->db->get();
      $count=$query->num_rows();
      return ($count > 0)?$query->row():array();
    }
    public function update_product($id)
    {
      $this->db->select("*")->from("ga_main_prod_details_tbl")->where("id",$id);
      $query=$this->db->get();
      $count=$query->num_rows();
      return ($count > 0)?$query->row():array();
    }
    public function update_product_price($id)
    {
      $this->db->select("*")->from("ga_prod_item_pricing_tbl")->where("id",$id);
      $query=$this->db->get();
      $count=$query->num_rows();
      return ($count > 0)?$query->row():array();
    }
    public function update_product_group_price($id)
    {
      $this->db->select("*")->from("ga_prod_group_pricing_tbl")->where("id",$id);
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
public function get_products($search=null,$limit=null,$offset=null){
    $response=array();
    $vendor_id=$this->session->userdata('vendor_id');
    $commonwhere=array('p.vendor_id'=>$vendor_id);
    $this->db->select('p.id,p.vendor_item_code,p.prod_code,p.prod_name,p.prod_desc,p.prod_image,p.active_status,p.feature_product,p.sku,p.stock,p.hsn_code,p.shelf_life_no,p.shelf_life_unit,p.last_modified_stock,g.group_name as prod_group,g.group_code as prod_group_code,u.unit_code as unit,m.menu_title as cat_title,sm.submenu_title as subcat_title,lsm.listsubmenu_title as listsubcat_title')->from('ga_main_prod_details_tbl p')->join('ga_prod_units_tbl u','u.id=p.unit','left')->join('ga_prod_groups_tbl g','p.prod_group=g.id','left')->join('menu_tbl m','p.category=m.menu_id','left')->join('submenu_tbl sm','p.sub_category=sm.submenu_id','left')->join('listsubmenu_tbl lsm','p.listsubmenu_id=lsm.listsubmenu_id','left')->where($commonwhere);
    if(is_array($search)){
        if(isset($search['search_group']) && $search['search_group']!=null){
            $this->db->where('p.prod_group',$search['search_group']);
        }
        if(isset($search['search_category']) && $search['search_category']!=null){
            $this->db->where('p.category',$search['search_category']);
        }
        if(isset($search['search_name']) && $search['search_name']!=null){
            $this->db->group_start();
            $this->db->like('p.prod_code',$search['search_name']);
            $this->db->or_like('p.vendor_item_code',$search['search_name']);
            $this->db->or_like('p.prod_name',$search['search_name']);
            $this->db->group_end();
        }
    }
    $this->db->order_by('p.id','DESC');
    $this->db->limit($limit,$offset);
    $res=$this->db->get();
    $count=$res->num_rows();
    // echo $this->db->last_query();
    $response[CODE]=($count>0)?SUCCESS_CODE:FAIL_CODE;
    $response[MESSAGE]=($count>0)?'Success':'Fail';
    if($count==1){$msg="1 product found";}
    if($count>1){$msg="$count products found";}
    $response[DESCRIPTION]=($count>0)?$msg:'Products not found';
    $response['num_rows']=$count;
    $response['result']=($count>0)?$res->result():null;
    return json_encode($response);
}
public function get_product_prices($search=null,$limit=null,$offset=null){
    $response=array();
    $vendor_id=$this->session->userdata('vendor_id');
    $commonwhere=array('p.vendor_id'=>$vendor_id);
    $this->db->select("pp.id,p.id as product_id,p.vendor_item_code,p.prod_code,p.prod_name,p.sku,u.unit_code as unit,pp.qty_range_from,pp.qty_range_to,DATE_FORMAT(pp.form_date,'%d-%m-%Y') as from_date,DATE_FORMAT(pp.to_date,'%d-%m-%Y') as to_date,pp.buying_price,pp.selling_price,pp.item_status as status")->from('ga_main_prod_details_tbl p')->join('ga_prod_units_tbl u','u.id=p.unit')->join('ga_prod_item_pricing_tbl pp','p.id=pp.prod_id')->where($commonwhere);
    if(is_array($search)){
        if(isset($search['search_name']) && $search['search_name']!=null){
            $this->db->like('p.prod_name',$search['search_name']);
            $this->db->or_like('p.prod_code',$search['search_name']);
            $this->db->or_like('p.vendor_item_code',$search['search_name']);
        }
    }
    $this->db->order_by('p.id','DESC');
    $this->db->limit($limit,$offset);
    $res=$this->db->get();
    $count=$res->num_rows();
    // echo $this->db->last_query();
    $response[CODE]=($count>0)?SUCCESS_CODE:FAIL_CODE;
    $response[MESSAGE]=($count>0)?'Success':'Fail';
    if($count==1){$msg="1 product found";}
    if($count>1){$msg="$count products found";}
    $response[DESCRIPTION]=($count>0)?$msg:'Products not found';
    $response['num_rows']=$count;
    $response['result']=($count>0)?$res->result():null;
    return json_encode($response);
}
public function get_product_group_prices($search=null,$limit=null,$offset=null){
    $response=array();
    $vendor_id=$this->session->userdata('vendor_id');
    $commonwhere=array('p.vendor_id'=>$vendor_id);
    $this->db->select("pp.id,p.id as product_id,p.vendor_item_code,p.prod_code,p.prod_name,u.unit_code as unit,pp.prod_group as group_id,pg.group_code,pg.group_name,pp.qty_range_from,pp.qty_range_to,DATE_FORMAT(pp.from_date,'%d-%m-%Y') as from_date,DATE_FORMAT(pp.to_date,'%d-%m-%Y') as to_date,pp.buyingprice,pp.sellingprice,pp.discount,pp.active_status as status")->from('ga_main_prod_details_tbl p')->join('ga_prod_units_tbl u','u.id=p.unit')->join('ga_prod_group_pricing_tbl pp','p.id=pp.prod_id')->join('ga_prod_groups_tbl pg','pp.prod_group=pg.id')->where($commonwhere);
    if(is_array($search)){
        if(isset($search['search_name']) && $search['search_name']!=null){
            $this->db->like('p.prod_name',$search['search_name']);
            $this->db->or_like('p.prod_code',$search['search_name']);
            $this->db->or_like('p.vendor_item_code',$search['search_name']);
        }
        if(isset($search['search_group']) && $search['search_group']!=null){
            $this->db->where('pp.prod_group',$search['search_group']);
        }

    }
    $this->db->order_by('p.id','DESC');
    $this->db->limit($limit,$offset);
    $res=$this->db->get();
    $count=$res->num_rows();
    // echo $this->db->last_query();
    $response[CODE]=($count>0)?SUCCESS_CODE:FAIL_CODE;
    $response[MESSAGE]=($count>0)?'Success':'Fail';
    if($count==1){$msg="1 product found";}
    if($count>1){$msg="$count products found";}
    $response[DESCRIPTION]=($count>0)?$msg:'Products not found';
    $response['num_rows']=$count;
    $response['result']=($count>0)?$res->result():null;
    return json_encode($response);
}
public function getProdDetails() {
        $response = array();
        $where = array('p.trash' => 0,'p.active_status'=> 1);
        $sql = $this->db->select('p.id,p.prod_code,g.group_code as prod_group,p.sku,p.unit,p.prod_name,p.prod_desc,p.listsubmenu_id,p.prod_image,p.other_image,p.active_status,p.feature_product,p.ip_address,p.created_by,p.created_on,p.trash')->from('ga_main_prod_details_tbl p')->join('ga_prod_groups_tbl g','p.prod_group=g.id','left')->where($where)->order_by('p.id','desc')->get();
        $count = $sql->num_rows();
        $response['code'] = ($count > 0) ? 200 : 204;
        $response['message'] = ($count > 0) ? 'Success' : 'Fail';
        $response['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $response['product_details'] = ($count > 0) ? $sql->result() : array();
        return json_encode($response);
    }
public function getProductCodeList()
    {
        $response = array();
        $where = array('active_status' => 1,'trash'=>0,'vendor_id'=>$this->session->userdata('vendor_id'));
        $sql = $this->db->select("id,prod_code,prod_name")->from('ga_main_prod_details_tbl')->where($where)->order_by('prod_name','ASC')->get();
        $count = $sql->num_rows();
        $resposne['code'] = ($count > 0) ? 200 : 204;
        $resposne['message'] = ($count > 0) ? 'Success' : 'Fail';
        $resposne['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $resposne['result'] = ($count > 0) ? $sql->result() : array();
        return json_encode($resposne);
    }
public function getUnitOfMeasureList()
    {
        $response = array();
        $where = array('active_status' => 1,'trash'=>0);
        $sql = $this->db->select("id,unit_code,unit_of_measure")->from('ga_prod_units_tbl')->where($where)->order_by('unit_code','ASC')->get();
        $count = $sql->num_rows();
        $resposne['code'] = ($count > 0) ? 200 : 204;
        $resposne['message'] = ($count > 0) ? 'Success' : 'Fail';
        $resposne['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $resposne['result'] = ($count > 0) ? $sql->result() : array();
        return json_encode($resposne);
    }
    public function getGroups(){
        $response = array();
        $sql = $this->db->select('id,group_code,group_name')->from('ga_prod_groups_tbl')->where(['trash'=>0,'active_status'=>1])->order_by('group_name', 'ASC')->get();
        $count = $sql->num_rows();
        $response = ($count > 0) ? $sql->result() : null;
        return json_encode($response);
    }
public function getProductGroupList()
    {
        $response = array();
        $where = array('active_status' => 1,'trash'=>0);
        $sql = $this->db->select("id,group_code,group_name")->from('ga_prod_groups_tbl')->where($where)->order_by('group_name','ASC')->get();
        $count = $sql->num_rows();
        $resposne['code'] = ($count > 0) ? 200 : 204;
        $resposne['message'] = ($count > 0) ? 'Success' : 'Fail';
        $resposne['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $resposne['result'] = ($count > 0) ? $sql->result() : array();
        return json_encode($resposne);
    }
public function getCategoryList()
    {
        $response = array();
        $where = array('flag_status' => 1,'trash'=>0);
        $sql = $this->db->select("menu_id,menu_title")->from('menu_tbl')->where($where)->order_by('menu_title','ASC')->get();
        $count = $sql->num_rows();
        $resposne['code'] = ($count > 0) ? 200 : 204;
        $resposne['message'] = ($count > 0) ? 'Success' : 'Fail';
        $resposne['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $resposne['result'] = ($count > 0) ? $sql->result() : array();
        return json_encode($resposne);
    }
public function getSubCategoryList($cat_id=null)
    {
        $response = array();
        $where = array('menu_id'=>$cat_id,'flag_status' => 1,'trash'=>0);
        $sql = $this->db->select("submenu_id,submenu_title")->from('submenu_tbl')->where($where)->order_by('submenu_title','ASC')->get();
        $count = $sql->num_rows();
        $resposne['code'] = ($count > 0) ? 200 : 204;
        $resposne['message'] = ($count > 0) ? 'Success' : 'Fail';
        $resposne['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $resposne['result'] = ($count > 0) ? $sql->result() : array();
        return json_encode($resposne);
    }
public function getListSubCategoryList($subcat_id=null)
    {
        $response = array();
        $where = array('submenu_id'=>$subcat_id,'flag_status' => 1,'trash'=>0);
        $sql = $this->db->select("listsubmenu_id,listsubmenu_title")->from('listsubmenu_tbl')->where($where)->order_by('listsubmenu_title','ASC')->get();
        $count = $sql->num_rows();
        $resposne['code'] = ($count > 0) ? 200 : 204;
        $resposne['message'] = ($count > 0) ? 'Success' : 'Fail';
        $resposne['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $resposne['result'] = ($count > 0) ? $sql->result() : array();
        return json_encode($resposne);
    }
    public function non_assigned_products($search=null,$limit=null,$si=null){
        $result=array();
        $this->db->select('p.id,p.prod_code,p.prod_group,p.prod_name,p.prod_image');
        $this->db->from('ga_main_prod_details_tbl p');
        if(is_array($search)){
            if($search['product']!=null){
                $this->db->group_start();
                $this->db->like('p.prod_code',$search['product'],'after');
                $this->db->or_like('p.prod_name',$search['product'],'after');
                $this->db->group_end();
            }   
        }
        $this->db->where('p.active_status',1);
        $this->db->where('p.prod_group',0);
        $this->db->where('p.vendor_id',$this->session->userdata('vendor_id'));
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
public function non_assigned_orders($search=null,$limit=null,$offset=null){
    $response=array();
    $commonwhere=array('o.orderstatus'=>1,'o.shipper_id'=>0);
    $vendor_id=$this->session->userdata('vendor_id');
    $this->db->select('p.id as prod_id,c.cart_id,c.order_id,o.*,u.user_name as power_user_name')->from('ga_main_prod_details_tbl p')->join('ga_cart_tbl c','c.prod_id=p.id','right')->join('ga_orders_tbl o','o.orderid=c.order_id','right')->join('ga_users_tbl u','o.poweruserid=u.user_id','right');
    if(is_array($search)){
        if($search['due_date']!=null){
                $due_date=date('Y-m-d',strtotime($search['due_date']));
                $this->db->where('o.delivery_due_date',$due_date);
            }
        if($search['power_user']!=null){
                $this->db->where('o.poweruserid',$search['power_user']);
            } 
        if($search['order']!=null){
            if(is_numeric($search['order'])){
                $this->db->where('pincode',$search['order']);
            }else{
                $this->db->group_start();
                $this->db->like('ordernumber',$search['order'],'after');
                $this->db->or_like('city',$search['order'],'after');
                $this->db->group_end(); 
            } 
        }
        if(isset($search['overdue']) && $search['overdue']==1){
            $this->db->where('DATE(o.orderdate) <',date('Y-m-d'));
        }
        if(isset($search['delivery_due_date']) && $search['delivery_due_date']==1){
            $this->db->where('DATE(o.orderdate) >',date('Y-m-d'));
        }
    }
    $this->db->where($commonwhere)->where('p.vendor_id',$vendor_id);
    $this->db->group_by('c.order_id');
    if(isset($search['overdue']) && $search['overdue']==1){
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
    public function getProdSku($product_id)
    {
        $response = array();
        $where = array('id' => $product_id);
        $sql = $this->db->select('p.sku,p.unit,p.vendor_item_code,v.vendor_name')->from('ga_main_prod_details_tbl p')->join('ga_vendors_table v','p.vendor_id=v.vendor_id','left')->where($where)->get();
        $count = $sql->num_rows();
        $response['code'] = ($count > 0) ? 200 : 204;
        $response['message'] = ($count > 0) ? 'Success' : 'Fail';
        $response['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $response['product_details'] = ($count > 0) ? $sql->row() : array();
        return json_encode($response);
    }
public function group_products($groupid=null,$search=null,$limit=null,$si=null){
        $result=array();
        $this->db->select('p.id,p.prod_code,p.prod_group,p.prod_name,p.prod_image');
        $this->db->from('ga_main_prod_details_tbl p');
        if(is_array($search)){
           
            if($search['product']!=null){
                $this->db->group_start();
                $this->db->like('p.prod_code',$search['product'],'after');
                $this->db->or_like('p.prod_name',$search['product'],'after');
                $this->db->group_end();
            }
        }
        $this->db->where('p.active_status',1);
        $this->db->where('p.vendor_id',$this->session->userdata('vendor_id'));
        if($groupid!=null){
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
public function shipper_orders($shipper=null,$search=null,$limit=null,$offset=null){
    $response=array();
    $commonwhere=array('o.orderstatus'=>1);
    $vendor_id=$this->session->userdata('vendor_id');
    $this->db->select('p.id as prod_id,c.cart_id,c.order_id,o.*,u.user_name as power_user_name')->from('ga_main_prod_details_tbl p')->join('ga_cart_tbl c','c.prod_id=p.id','right')->join('ga_orders_tbl o','o.orderid=c.order_id','right')->join('ga_users_tbl u','o.poweruserid=u.user_id','right');
    if(is_array($search)){
        if($search['due_date']!=null){
                $due_date=date('Y-m-d',strtotime($search['due_date']));
                $this->db->where('o.delivery_due_date',$due_date);
            }
        if($search['power_user']!=null){
                $this->db->where('o.poweruserid',$search['power_user']);
            } 
        if($search['order']!=null){
            if(is_numeric($search['order'])){
                $this->db->where('pincode',$search['order']);
            }else{
                $this->db->group_start();
                $this->db->like('ordernumber',$search['order'],'after');
                $this->db->or_like('city',$search['order'],'after');
                $this->db->group_end();
            } 
        }
        if(isset($search['overdue']) && $search['overdue']==1){
            $this->db->where('DATE(o.orderdate) <',date('Y-m-d'));
        }
        if(isset($search['delivery_due_date']) && $search['delivery_due_date']==1){
            $this->db->where('DATE(o.orderdate) >',date('Y-m-d'));
        }
    }
    if($shipper!=null){
        $this->db->where('o.shipper_id',$shipper);
    }
    $this->db->where($commonwhere);
    if(isset($vendor_id) && $vendor_id!=null)
    $this->db->where('p.vendor_id',$vendor_id);
    $this->db->group_by('c.order_id');
    if(isset($search['overdue']) && $search['overdue']==1){
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
public function groupProductsUpdate($tablename,$setcolumns,$updatevalue,$wherecondition)
    {
        $response=array();
        $update_sql=$this->db->update_string($tablename,array($setcolumns=>$updatevalue),$wherecondition);
        $qry=$this->db->query($update_sql);
        $update=$this->db->affected_rows();
        $response['code']=($update > 0)?200:204;
        $response['message']=($update > 0)?'Success':'Fail';
        $response['description']=($update > 0)? 'Products assigned to group successfully!' : "Failed, Products could not be assigned";
        return json_encode($response);
    }
public function shipperOrdersUpdate($tablename,$setcolumns,$updatevalue,$wherecondition)
    {
        $response=array();
        $update_sql=$this->db->update_string($tablename,array($setcolumns=>$updatevalue),$wherecondition);
        $qry=$this->db->query($update_sql);
        $update=$this->db->affected_rows();
        $response['code']=($update > 0)?200:204;
        $response['message']=($update > 0)?'Success':'Fail';
        $response['description']=($update > 0)? 'Orders assigned to Shipper successfully!' : "Failed, Orders could not be assigned";
        return json_encode($response);
    }
public function get_all_open_orders($search=null,$limit=null,$offset=null,$order_status=null){
    $response=array();
    $commonwhere=array('o.orderstatus'=>$order_status);
    $vendor_id=$this->session->userdata('vendor_id');
    $today=date('Y-m-d');
    $this->db->select('p.id as prod_id,c.cart_id,c.order_id,o.*,u.power_user_id,u.user_name')->from('ga_main_prod_details_tbl p')->join('ga_cart_tbl c','c.prod_id=p.id','right')->join('ga_orders_tbl o','o.orderid=c.order_id','right')->join('ga_users_tbl u','o.userid=u.user_id','right')->where($commonwhere)->where('p.vendor_id',$vendor_id);
    if(is_array($search)){
        if($search['search_name']!=null){
            if(is_numeric($search['search_name'])){
                $this->db->where('pincode',$search['search_name']);
            }else{
                $this->db->like('city',$search['search_name'],'after');
            } 
        }
        if($search['delivery_due_date']!=null && $search['delivery_due_date'] <= 0){
            $this->db->where('o.delivery_due_date <',date('Y-m-d'));
        }
        elseif($search['delivery_due_date']!=null && $search['delivery_due_date'] == 14){
            $this->db->where('o.delivery_due_date >=',date('Y-m-d'));   
            $this->db->where('o.delivery_due_date <=', date('Y-m-d',strtotime($today.' + 14 days')));
        }
        elseif($search['delivery_due_date']!=null && $search['delivery_due_date'] == 7){
            $this->db->where('o.delivery_due_date >=',date('Y-m-d')); 
            $this->db->where('o.delivery_due_date <=', date('Y-m-d',strtotime($today.' + 7 days')));
        }
        elseif($search['delivery_due_date']!=null && $search['delivery_due_date'] == 3){
            $this->db->where('o.delivery_due_date >=',date('Y-m-d')); 
            $this->db->where('o.delivery_due_date <=', date('Y-m-d',strtotime($today.' + 3 days')));
        }
        elseif($search['delivery_due_date']!=null && $search['delivery_due_date'] == 1){
            $this->db->where('o.delivery_due_date >=',date('Y-m-d')); 
            $this->db->where('o.delivery_due_date <=', date('Y-m-d',strtotime($today.' + 1 days')));
        }
    }
    $this->db->group_by('c.order_id');
    if($search['overdue']!=null && $search['overdue']==1){
        $this->db->order_by('DATE(o.delivery_due_date)','ASC');
    }elseif($search['overdue']!=null && $search['overdue']==2){
        $this->db->order_by('DATE(o.delivery_due_date)','DESC');
    }else{
        $this->db->order_by('o.orderid','ASC');
    }
    $this->db->limit($limit,$offset);
    $res=$this->db->get();
    $count=$res->num_rows();
      // echo $this->db->last_query();exit;
    $response[CODE]=($count>0)?SUCCESS_CODE:FAIL_CODE;
    $response[MESSAGE]=($count>0)?'Success':'Fail';
    if($count==1){$msg="1 order found";}
    if($count>1){$msg="$count orders found";}
    $response[DESCRIPTION]=($count>0)?$msg:'Open orders not found';
    $response['num_rows']=$count;
    $response['result']=($count>0)?$res->result():null;
    return json_encode($response);
}

public function get_all_shippers($search=null,$limit=null,$offset=null){
    $response=array();
    $vendor_id=$this->session->userdata('vendor_id');
    $commonwhere=array('vendor_id'=>$vendor_id);
    $this->db->select('*')->from('ga_shippers_table')->where($commonwhere);
    if(is_array($search)){
        if($search['search_name']!=null){
            if(is_numeric($search['search_name'])){
                $this->db->where('mobile',$search['search_name']);
            }else{
                $this->db->like('shipper_code',$search['search_name'],'after');
                $this->db->or_like('shipper_name',$search['search_name'],'after');
            } 
        }
    }
    $this->db->order_by('shipper_id','DESC');
    $this->db->limit($limit,$offset);
    $res=$this->db->get();
    $count=$res->num_rows();
    // echo $this->db->last_query();
    $response[CODE]=($count>0)?SUCCESS_CODE:FAIL_CODE;
    $response[MESSAGE]=($count>0)?'Success':'Fail';
    if($count==1){$msg="1 shipper found";}
    if($count>1){$msg="$count shippers found";}
    $response[DESCRIPTION]=($count>0)?$msg:'Shippers data not found';
    $response['num_rows']=$count;
    $response['result']=($count>0)?$res->result():null;
    return json_encode($response);
}
public function get_all_shipping_cost($search=null,$limit=null,$offset=null){
    $response=array();
    $vendor_id=$this->session->userdata('vendor_id');
    $commonwhere=array('sc.vendor_id'=>$vendor_id);
    $this->db->select('sc.*,s.shipper_code,s.shipper_name')->from('ga_shipping_cost_tbl sc')->join('ga_shippers_table s','s.shipper_id=sc.shipper_id','left')->where($commonwhere);
    if(is_array($search)){
        if($search['search_name']!=null){
            $this->db->like('s.shipper_code',$search['search_name'],'after');
            $this->db->or_like('s.shipper_name',$search['search_name'],'after');
        }
    }
    $this->db->order_by('sc.shipping_cost_id','DESC');
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
public function get_shippers($vendor_id){
    $response=array();
    $commonwhere=array('vendor_id'=>$vendor_id,'shipper_status'=>1);
    $this->db->select('shipper_id,shipper_code,shipper_name')->from('ga_shippers_table')->where($commonwhere);
    $this->db->order_by('shipper_name','ASC');
    $res=$this->db->get();
    $count=$res->num_rows();
    // echo $this->db->last_query();
    $response[CODE]=($count>0)?SUCCESS_CODE:FAIL_CODE;
    $response[MESSAGE]=($count>0)?'Success':'Fail';
    if($count==1){$msg="1 shipper found";}
    if($count>1){$msg="$count shippers found";}
    $response[DESCRIPTION]=($count>0)?$msg:'Shippers data not found';
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
 }