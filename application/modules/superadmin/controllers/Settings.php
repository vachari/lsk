<?php

defined('BASEPATH') OR exit('No direct script access allowed');
    
class Settings extends CI_Controller {


    public function __construct() {

        parent::__construct();
        $this->admin_id=$this->session->userdata('admin_id');
        if((!isset($this->admin_id) || $this->admin_id != true) )
            {
                redirect(base_url().'superadmin/login');
            } 
        $this->load->model(array('Settings_model','Crud'));
        $this->ipaddress = $_SERVER['REMOTE_ADDR'];
        $this->date = date('Y-m-d H:i:s');
        $this->load->library('paginate');
    }

    /* Load View  the untis starts hear   */ 
     public function createUnits()
     {
                 $this->load->view('units/create_unit');
         
             }
     
     /* Load View  the untis ends hear   */ 


 /* inserting the untis starts hear   */ 
public function createUnit(){
    $response=array();
    $uomid=$this->input->post('uomid');
    $state=$this->input->post('state');
    $qty=$this->input->post('quantity');
    $uom=$this->input->post('uom');
    $error=0;
    $err_mesg="";
    
        if(empty($uomid) || empty($state) || empty($qty) || empty($uom)){
            $error=1;
        }
  
if($error == 0){
                 $insertdata = array(
                   'unit_code' => $uom,
                    'uom_id' => $uomid,
                    'state' => $state,
                    'quantity_of_measure' => $qty,
                    'unit_of_measure' => $uom,
                    'created_on'=>DATE,
                    'created_by'=>1,
                    );
            $insert_result= json_decode($this->Settings_model->commonInsert('ga_prod_units_tbl',$insertdata));
          if($insert_result->code==200){
                $this->session->set_flashdata('success', 'Your data submitted Successfully..');
                    redirect('superadmin/Settings/createUnits');
                }
                else{
                     $this->session->set_flashdata('failed', 'Your data Failed to submit..');
                    redirect('superadmin/Settings/createUnits');
                }
        }
        else{
             $this->session->set_flashdata('failed', 'Please enter all fields');
            redirect('superadmin/Settings/createUnits');
        }

       
    }

   /* inserting the untis ends hear   */ 


     /* Manage the untis starts hear   */ 
     public function manageUnits()
     {

        $cols = 'unit_code,id,uom_id,state,quantity_of_measure,unit_of_measure,created_by,created_on,trash,active_status';
        $search = $this->input->post('search');
        $table_name = 'ga_prod_units_tbl';
        $order_by_col = 'id';
        $config["base_url"] = base_url().'superadmin/Settings/manageUnits/';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] =PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        $like_col = 'unit_code';
        $orderby = 'id';
        $this->data['common_result'] = $this->Crud->common_list_paging($cols, $table_name, $like_col, $orderby, $config["per_page"], $page, $search);
        /*         * Pagination code end* */
        $this->load->view('units/manage_units',$this->data);
        
     }
     /* Manage the untis ends hear   */ 

    /*  Delete Units Starts hear   */ 
    public function unitDelete(){

            $id=$this->uri->segment(4);
            $conditionarray=array('id'=>$id);
           $delete_row=$this->Settings_model->common_delete('ga_prod_units_tbl',$conditionarray);
           $res=json_decode($delete_row);
           if($res->code==200){
                $this->session->set_flashdata('Success','Record deleted successfully');
                redirect('superadmin/Settings/manageUnits');
           }
           else{
            $this->session->set_flashdata('Failed',$res->description);
                redirect('superadmin/Settings/manageUnits');
           }

    }
 /* Delete the untis ends hear   */ 

 /*get units data for update starts hear */
     public function getUnitsdata() {
        $uid = $this->uri->segment(4);

        $res['units_res'] = $this->Settings_model->get_unitsdata('ga_prod_units_tbl', $uid);
        $this->load->view('units/update_unit', $res);

    }

/*get units data for update  ends hear */


/*units data for update starts hear */
     public function updateUnits(){
        $update_data = array( 'unit_code' => $this->input->post('uom'),
                              'uom_id' => $this->input->post('uomid'),
                              'state' => $this->input->post('state'),
                              'quantity_of_measure' => $this->input->post('quantity'),
                              'unit_of_measure' => $this->input->post('uom')
                        );
        $update_where = $this->input->post('id');
        $up_in = $this->Settings_model->up_data('ga_prod_units_tbl', $update_data, $update_where);
        if($up_in){
                $this->session->set_flashdata('Success','Data Updated successfully');
                redirect('superadmin/Settings/manageUnits');
            }
            else{
              $this->session->set_flashdata('Failed','Data not modified');
                redirect($_SERVER['HTTP_REFERER']);
            }
        
    }


/* units data for update ends hear */

/* inserting the Groups starts hear   */ 
    public function createGroups(){
        $this->load->view('groups/create_group');
    }
    public function insertGroups(){
         $response=array();
        $code=array_filter($this->input->post('group_code'));
         $name=array_filter($this->input->post('group_name'));
            $error=0;
            $err_mesg="";
            for ($i = 0; $i < count($code); $i++){
            if(empty($code[$i])){
                $error=1;
            $err_mesg="Please enter group code";
            }
            if(empty($name[$i])){
                $error=1;
            $err_mesg="Please enter group name";
            }  
        }
        if($error == 0){
            
             $insertdata=array();
             for ($i = 0; $i < count($code); $i++) {
                 $insertdata[] = array(
                    'group_code' => $code[$i],
                    'group_name' => $name[$i],
                    'created_on'=>DATE,
                    'created_by'=>1,
                    );
             }

            $insert_result = $this->Settings_model->batchInsert('ga_prod_groups_tbl',$insertdata);

            if($insert_result){
               $id=$this->db->insert_id();
                $this->session->set_flashdata('success', 'Group created Successfully..');
                }
                else{
                     $this->session->set_flashdata('failed', 'Your data Failed to submit..');
                }
        }
        else{
             $this->session->set_flashdata('failed', 'Please enter all fields');
            
        }
        redirect('superadmin/Settings/createGroups');
    }

/* inserting the Groups Ends hear   */

  /* Manage the Groups Starts hear   */ 
     public function manageGroups()
     {
        $this->data['groups_result'] = $this->Settings_model->getGroupsList();
          /* page nation code starts from hear */

        $cols = 'id,group_code,group_name,created_by,created_on,trash,active_status';
        $search = $this->input->post('search');
        $table_name = 'ga_prod_groups_tbl';
        $order_by_col = 'id';
        $config["base_url"] = base_url().'superadmin/Settings/manageGroups/';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
         $like_col = 'group_name';
        $orderby = 'id';
        $this->data['common_result'] = $this->Crud->common_list_paging($cols, $table_name, $like_col, $orderby, $config["per_page"], $page, $search);
        /*         * Pagination code end* */
        $this->load->view('groups/manage_group',$this->data);
        
     }
     /* Manage the Groups ends hear   */ 



    /*  Delete Units Starts hear   */ 
    public function groupsDelete(){

            $id=$this->uri->segment(4);
            $conditionarray=array('id'=>$id);
           $delete_row=$this->Settings_model->common_delete('ga_prod_groups_tbl',$conditionarray);
           $res=json_decode($delete_row);
           //print_r($res->code);exit;
           if($res->code==200){
                $this->session->set_flashdata('Success','Record deleted successfully');
                redirect('superadmin/Settings/manageGroups');
           }
           else{
            $this->session->set_flashdata('Failed',$res->description);
                redirect('superadmin/Settings/manageGroups');
           }

    }
 /* Delete the untis ends hear   */ 
  
     public function getGroups() {
        $id = $this->uri->segment(4);
        $res['product_list'] = json_decode($this->Settings_model->group_products($id));
        $res['groups_res'] = $this->Settings_model->get_unitsdata('ga_prod_groups_tbl', $id);
        $this->load->view('groups/update_group', $res);

    }
    public function groupUpdate(){
      $update_count=0;
        $update_data = array('group_code' => $this->input->post('group_code'),
            'group_name' => $this->input->post('group_name'),
             'created_by'=>1);
        $update_where = $this->input->post('id');
        $up_in = $this->Settings_model->up_data('ga_prod_groups_tbl', $update_data, $update_where); 
        if($up_in > 0){
                $this->session->set_flashdata('Success','Data Updated successfully');
                redirect('superadmin/Settings/manageGroups');
            }
            else{
              $this->session->set_flashdata('Failed','Data not modified');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
////////////////////// Assinging products to group ///////////////////////////////////
    public function assignProductsToGroup(){
        $this->data['groups'] = $this->Settings_model->getGroups();
        // $products= json_decode($this->Settings_model->non_assigned_products());
        // $total_rows=count($products);
        // $base_url = base_url().'superadmin/Settings/assignProductsToGroup/';
        // $per_page = PER_PAGE;
        // $si = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // $config = $this->paginate->pagination($base_url,$total_rows,$per_page);
        // $this->load->library('pagination');
        // $this->pagination->initialize($config);
        // $this->data["links"] = $this->pagination->create_links();
        $this->data['products'] = $this->Settings_model->non_assigned_products();
        $this->load->view('groups/assignProductsToGroup',$this->data);
    }
    public function assignProductsToGroupAjax($pageno=0){
        $response=array();
        $search=array();
        $search['product']=$this->input->post('product');
        $search['vendor']=$this->input->post('vendor');
        $products= json_decode($this->Settings_model->non_assigned_products($search));
        $total_rows=count($products);
        $base_url = base_url().'superadmin/Settings/assignProductsToGroup/';
        $per_page = PER_PAGE;
        if($pageno > 0){
              $si= $per_page * ($pageno-1);
         }else{$si=0;}
        $config = $this->paginate->pagination($base_url,$total_rows,$per_page);
        $this->load->library('pagination');
        $config['use_page_numbers']=TRUE;
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $product_list = json_decode($this->Settings_model->non_assigned_products($search,$per_page,$si));
        $html="";
        if($product_list !=null){
          foreach ($product_list as $prod) {
            $html .= '';
            $html .= '<tr class=""><td><input type="checkbox" class="inline-checkbox checkSingle" name="na_product_id[]" value="'.$prod->id.'"></td>';
            $html .= '<td>'.$prod->prod_code.'</td>';
            $html .= '<td>'.$prod->prod_name.'</td>';
            $html .= '<td>'.$prod->vendor_code.'</td>';
            $html .= '<td>'.$prod->vendor_name.'</td>';
            $html .= '<td><img width="50px" src="'.base_url().'uploads/products/'.$prod->prod_image.'"></td></tr>';                      
          }
        }
        $response['html']=$html;
        $msg=' Products Found';
        if($total_rows ==1){$msg=' Product Found';}
        $response['total_rows']=($total_rows > 0)?$total_rows.$msg:'';
        $response['pagination']=$links;
  //       print_r($response);exit;
        echo json_encode($response);
        
}
public function assignedGroupProductsAjax($pageno=0){
        $response=array();
        $search=array();
        $group=$this->input->post('group');
        $search['product']=$this->input->post('product');
        $search['vendor']=$this->input->post('vendor');
        $products= json_decode($this->Settings_model->group_products($group,$search));
        $total_rows=count($products);
        $base_url = base_url().'superadmin/Settings/assignProductsToGroup/';
        $per_page = PER_PAGE;
        if($pageno > 0){
             $si= ($pageno - 1) * $per_page;
         }else{$si=0;}
        $config = $this->paginate->pagination($base_url,$total_rows,$per_page);
        $this->load->library('pagination');
        $config['use_page_numbers']=TRUE;
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $product_list = json_decode($this->Settings_model->group_products($group,$search,$per_page,$si));
        $html="";
        if($product_list !=null){
          foreach ($product_list as $prod) {
            $html .= '';
            $html .= '<tr class=""><td><input type="checkbox" class="inline-checkbox checkSingle" name="product_id[]" value="'.$prod->id.'"></td>';
            $html .= '<td>'.$prod->prod_code.'</td>';
            $html .= '<td>'.$prod->prod_name.'</td>';
            $html .= '<td>'.$prod->vendor_code.'</td>';
            $html .= '<td>'.$prod->vendor_name.'</td>';
            $html .= '<td><img width="50px" src="'.base_url().'uploads/products/'.$prod->prod_image.'"></td></tr>';                      
          }
        }
        $response['html']=$html;
        $msg=' Products Found';
        if($total_rows ==1){$msg=' Product Found';}
        $response['total_rows']=($total_rows > 0)?$total_rows.$msg:'';
        $response['pagination']=$links;
  //       print_r($response);exit;
        echo json_encode($response);
        
}
public function groupProductsUpdate(){
  $response=array();
      $update_count=0;
        $group = $this->input->post('group');
        $products=$this->input->post('products');
        $table='ga_main_prod_details_tbl';
        $setcolumns='prod_group';
        $updatevalue=$group;
        $wherecondition="id  IN  (" .$products. ")";
        if($group !='' && $products!=''){ 
          $update = $this->Settings_model->groupProductsUpdate($table, $setcolumns, $updatevalue, $wherecondition);
            echo $update;exit;
        }
  }

 
    public function assignedProductsGroupUpdate(){
      $update_count=0;
      $id=$this->input->post('id');
        $product=array_filter($this->input->post('product'));
        $count=count($product);
        if($count > 0){
          for ($i=0; $i < $count; $i++) { 
            $update_prod = $this->Settings_model->up_data('ga_main_prod_details_tbl',['prod_group'=>$id], $product[$i]);
            if($update_prod){$update_count+=1;}
          }
        }
        if($update_count > 0){
                $this->session->set_flashdata('Success','Data Updated successfully');
            }
            else{
              $this->session->set_flashdata('Failed','Data not modified');
            }
        redirect('superadmin/Settings/updateAssignedProducts/'.$id);
        }

  public function multipleProductsRemoveFromGroup(){
      $update_count=0;
      $group=$this->input->post('id');
        $product=array_filter($this->input->post('product_id'));
        $count=count($product);
        if($count > 0){
          for ($i=0; $i < $count; $i++) { 
            $where=array('id'=> $product[$i],'prod_group'=>$group);
            $update_data=array('prod_group'=>0);
            $update_prod = $this->Settings_model->update_data('ga_main_prod_details_tbl',$update_data,$where);
            if($update_prod){$update_count+=1;}
          }
        }
        if($update_count > 0){
          if($update_count==1){$msg=$update_count.' Product removed successfully!';}
          else{$msg=$update_count.' Products removed successfully!';}
                $this->session->set_flashdata('success',$msg);
        }else{
              $this->session->set_flashdata('failed','Please select from list');
            }
        redirect('superadmin/Settings/assignProductsToGroup');
        }
public function commonStatus()
    {
       // echo "controller";exit;
        $response = array();
        $tablename = $this->input->post('tablename');
        $updatelist = $this->input->post('updatelist');
        $activity = $this->input->post('activity');
        if ($tablename != '' && $updatelist != '' && $activity != '' && ($activity == 0 || $activity == 1 || $activity == 2)) {
            $table= '';
            $setcolumns = '';
            $wherecondition = '';
            $updatevalue = '';
            switch ($tablename) {
            case 'groups':
              $table='ga_prod_groups_tbl';
              $setcolumns='active_status';
              $updatevalue=$activity;
              $wherecondition="id  IN  (" .$updatelist. ")";
              break;
            case 'units':
              $table='ga_prod_units_tbl';
              $setcolumns='active_status';
              $updatevalue=$activity;
              $wherecondition="id  IN  (" .$updatelist. ")";
              break;
            }
           $update = $this->Settings_model->commonStatusActivity($table, $setcolumns, $updatevalue, $wherecondition);
            echo $update;
            exit;
        }
        echo json_encode($response);
        }

        public function commonDelete()
    {   
        $response = array();
        $relationname='Your data';
        $tablename = $this->input->post('tablename');
        $updatelist = $this->input->post('updatelist');
        if ($tablename != '') {
            $table = '';
            $wherecondition = '';
            switch ($tablename) {
            case 'group':
                $table = 'ga_prod_groups_tbl';
                $wherecondition = "id IN  (" . $updatelist . ")";
                break;
            
            case 'units':
                $table = 'ga_prod_units_tbl';
                $wherecondition = "id IN  (" . $updatelist . ")";
                break;
         
            }
            //print_r($wherecondition);
            $update = $this->Crud->commonDelete($table,$wherecondition,$relationname);
            echo $update;
            exit;
        }
        echo json_encode($response);
    }


}
?>