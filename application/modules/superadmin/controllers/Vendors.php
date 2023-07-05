<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Vendors extends CI_Controller {

		public function __construct() 
        {
        parent::__construct();
        $this->admin_id=$this->session->userdata('admin_id');
        if((!isset($this->admin_id) || $this->admin_id != true) )
            {
                redirect(base_url().'superadmin/login');
            } 
	        $this->load->model('Vendor_model');
	       
        $this->load->library("pagination");
 
    }
     public function index()
     { 
            
            $this->form_validation->set_rules('vendor_code', 'Vendor Code', 'trim|required');
            $this->form_validation->set_rules('vendor_name', 'vendor Name', 'trim|required');
            $this->form_validation->set_rules('mobile', 'Mobile No', 'required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('email', 'Email', 'valid_email|is_unique[ga_vendors_table.email]',array('is_unique'=>'Email already exists'));
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('plot', 'Plot', 'required');
            $this->form_validation->set_rules('street', 'Street', 'required');
            $this->form_validation->set_rules('area', 'Area', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('pincode', 'Pincode', 'required');
            $this->form_validation->set_rules('website', 'Website', 'required');
            $this->form_validation->set_rules('gst', 'GST', 'required');
            $this->form_validation->set_rules('pan', 'Pan number', 'required');
            $this->form_validation->set_rules('tds', 'TDS', 'required');
            $this->form_validation->set_rules('bank_account_holder', 'Bank Account Holder', 'required');
            $this->form_validation->set_rules('bank_account_number', 'Bank Account Number', 'required');
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
            $this->form_validation->set_rules('bank_branch', 'Bank Branch', 'required');
            $this->form_validation->set_rules('bank_address', 'Bank Address', 'required');
            $this->form_validation->set_rules('bank_account_type', 'Bank Account Type', 'required');
            $this->form_validation->set_rules('bank_ifsc_code', 'Bank IFSC Code', 'required');
            $this->form_validation->set_rules('payment_terms_code', 'Payment Terms Code', 'required');
            $this->form_validation->set_rules('no_of_days_credit_from_delivery_date', 'Credit Days', 'required');
            $this->form_validation->set_rules('payment_terms_description', 'Payment Terms Description', 'required');
            // $this->form_validation->set_rules('vcp_code', 'Contact person code', 'required');
            // $this->form_validation->set_rules('vcp_name', 'Contact person name', 'required');
            // $this->form_validation->set_rules('vcp_email', 'Contact person email', 'required');
            // $this->form_validation->set_rules('vcp_mobile', 'Contact person mobile', 'required|min_length[10]|max_length[10]');
         if ($this->form_validation->run() == false) {
        $this->load->view('vendors/create_vendor');
    }
            else{
                $vendorEmail=$this->input->post('email');
                $temp_password= 'shoperative'.rand(100000,999999);
                $verificationcode=sha1('ShoperativeVendor'.rand(100,999));
                $vendor_data = array(
                    'vendor_code' =>$this->input->post('vendor_code'),
                     'vendor_name' => ucfirst($this->input->post('vendor_name')) ,
                     'mobile' =>$this->input->post('mobile') ,
                     'email' =>$vendorEmail,
                     'password' => md5($temp_password),
                     'plot' =>$this->input->post('plot'),
                     'street' =>$this->input->post('street'),
                     'area' =>$this->input->post('area'),
                     'state' =>ucfirst($this->input->post('state')),
                     'pincode' =>$this->input->post('pincode'),
                     'website' =>$this->input->post('website'),
                     'gst' =>$this->input->post('gst'),
                     'pan' =>$this->input->post('pan'),
                     'tds' =>$this->input->post('tds'),
                     'city' =>ucfirst($this->input->post('city')),
                     'created_on'=>DATE,
                     'verificationcode'=>$verificationcode
                     );
                    // print_r($vendor_data);exit; 
                
                    $insert=$this->Crud->commonInsert('ga_vendors_table',$vendor_data);
                    $insert_decode = json_decode($insert);
                    if($insert_decode->code == SUCCESS_CODE)
                    {
                         $vcontact_person_code = $this->input->post('vcp_code');
                         $vcontact_person_name = $this->input->post('vcp_name');
                         $vcontact_person_email = $this->input->post('vcp_email');
                         $vcontact_person_mobile = $this->input->post('vcp_mobile');
                         $inserted_id = $insert_decode->inserted_id;
                         $pt_data=array(
                                    'vendor_id' => $inserted_id,
                                    'payment_terms_code' => $this->input->post('payment_terms_code'),
                                    'payment_terms_description' => $this->input->post('payment_terms_description'),
                                    'no_of_days_credit_from_delivery_date' => $this->input->post('no_of_days_credit_from_delivery_date'),
                                    'bank_account_holder' => $this->input->post('bank_account_holder'),
                                    'bank_account_number' => $this->input->post('bank_account_number'),
                                    'bank_name' => $this->input->post('bank_name'),
                                    'bank_branch' => $this->input->post('bank_branch'),
                                    'bank_address' => $this->input->post('bank_address'),
                                    'bank_account_type' => $this->input->post('bank_account_type'),
                                    'bank_ifsc_code' => $this->input->post('bank_ifsc_code'),
                                    'created_on' => DATE,
                                    'status' => 1

                                    );
                         $insert_pt=$this->Crud->commonInsert('ga_payment_terms_tbl',$pt_data);
                         $all_contacts = array();
                         for($i=0;$i<count($vcontact_person_code);$i++)
                         {
                            $insert_contacts=array();
                            $insert_contacts['vendor_id']=$inserted_id;
                            $insert_contacts['contact_person_mobile']=$vcontact_person_mobile[$i];
                            $insert_contacts['contact_person_name']=$vcontact_person_name[$i];
                            $insert_contacts['contact_person_code']=$vcontact_person_code[$i];
                            $insert_contacts['contact_person_email']=$vcontact_person_email[$i];
                            array_push($all_contacts,$insert_contacts);
                         }
                        $insert_vendor_contacts = $this->Crud->batchInsert('ga_vendor_contacts_tbl',$all_contacts);
                        if($insert_vendor_contacts)
                        {
                            $vendor_data['subject']='Vendor Registration';
                            $vendor_data['temp_password']=$temp_password;
                            $vendor_data['link']=base_url().'vendor/verification/'.$verificationcode;
                             
                            // sending email for login credetials
                                $mail_array = $this->sendmail->sendEmail(
                                    array(
                                        'to' =>array($vendorEmail),
                                        'cc' => array('info@' . SITE_DOMAIN),
                                        'bcc' => array(BCC_EMAIL),
                                        'subject' => 'Vendor Registration Successfully Done!',
                                        'data' => array('email_content'=>$vendor_data),
                                        'template' => EMAIL_TEMPLATE_FOLDER_SUPER.'verification_vendor',
                                    )
                                );
                        
                            // email code end
                                if($mail_array['code']==1){
                                    $this->session->set_flashdata('message', 'Data Inserted successfully & verification link sent to vendor');
                                }else{
                                    $this->session->set_flashdata('message', 'Data Inserted successfully but unabled to send verification mail');
                                }
                             
                            redirect('superadmin/Vendors/viewVendorDetails'); 
                        }
                    }
                   
                    else
                    {
                        echo "<script>alert('Problem occured while saving data. Please try again')</script>";
                    }
                 }
  }   
  public function viewVendorDetails()
{

     $cols = 'vendor_id,vendor_code,vendor_name,mobile,email,plot,street,area,city,state,created_on,vendor_status,verify_email,trash';
         $search = $this->input->post('search');
        $table_name = 'ga_vendors_table';
        $order_by_col = 'vendor_id';
        $config["base_url"] = base_url().'superadmin/Vendors/viewVendorDetails/';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $like_col = '';
        $this->data['search'] = $search;
        $this->data["common_result"] = $this->Vendor_model->get_vendor_records($cols,$table_name,$like_col,$order_by_col,$config["per_page"],$page,$search);
        /*         * Pagination code end* */
     $this->load->view('vendors/view_vendor_details', $this->data);
}    
public function updateVendor() {
        $vendor_id = $this->uri->segment(4);
        $this->data['vendor_contacts'] = $this->Vendor_model->update_vendor_contacts($vendor_id);
      $this->data['vendor_records'] = $this->Vendor_model->update_vendor($vendor_id);
      $this->data['vendor_payment_details'] = $this->Vendor_model->update_vendor_payment_details($vendor_id);
        $this->load->view('superadmin/vendors/update_vendor_details', $this->data);
    }
    public function updateVendorDetails(){
       $update_count=0;
       $update_data = array(
                    'vendor_code' =>$this->input->post('vendor_code'),
                     'vendor_name' => ucfirst($this->input->post('vendor_name')) ,
                     'mobile' =>$this->input->post('mobile') ,
                     'email' =>$this->input->post('email'),
                     'plot' =>$this->input->post('plot'),
                     'street' =>$this->input->post('street'),
                     'area' =>$this->input->post('area'),
                     'state' =>ucfirst($this->input->post('state')),
                     'pincode' =>$this->input->post('pincode'),
                     'website' =>$this->input->post('website'),
                     'gst' =>$this->input->post('gst'),
                     'pan' =>$this->input->post('pan'),
                     'tds' =>$this->input->post('tds'),
                     'city' =>ucfirst($this->input->post('city'))
                     );
         $update_where = array('vendor_id'=>$this->input->post('vendor_id'));
         $check_email_exist=$this->Crud->commonCheck('email','ga_vendors_table',['email'=>$this->input->post('email'),'vendor_id !='=>$this->input->post('vendor_id')]);
         if($check_email_exist){
                $this->session->set_flashdata('Failed','Vendor Email was already existed, try other');
                redirect($_SERVER['HTTP_REFERER']);
         }
         $update = $this->Vendor_model->update_vendor_details('ga_vendors_table', $update_data, $update_where);
         $pt_data=array(
                                    'payment_terms_code' => $this->input->post('payment_terms_code'),
                                    'payment_terms_description' => $this->input->post('payment_terms_description'),
                                    'no_of_days_credit_from_delivery_date' => $this->input->post('no_of_days_credit_from_delivery_date'),
                                    'bank_account_holder' => $this->input->post('bank_account_holder'),
                                    'bank_account_number' => $this->input->post('bank_account_number'),
                                    'bank_name' => $this->input->post('bank_name'),
                                    'bank_branch' => $this->input->post('bank_branch'),
                                    'bank_address' => $this->input->post('bank_address'),
                                    'bank_account_type' => $this->input->post('bank_account_type'),
                                    'bank_ifsc_code' => $this->input->post('bank_ifsc_code')

                                    );
        $update_pt = $this->Vendor_model->update_vendor_details('ga_payment_terms_tbl', $pt_data, $update_where);
         if($update==true || $update_pt==true){ $update_count= $update_count +1;}
        $vendor_contacts = $this->Vendor_model->update_vendor_contacts($this->input->post('vendor_id'));
            if($vendor_contacts !=null){
                $vcp_code=array_filter($this->input->post('vcp_code'));
                $vcp_name=array_filter($this->input->post('vcp_name'));
                $vcp_email=array_filter($this->input->post('vcp_email'));
                $vcp_mobile=array_filter($this->input->post('vcp_mobile'));
                $count=count($vcp_code);
            $update_c=array();
            for ($i=0; $i < $count; $i++) { 
               $id=$this->input->post('id'.$i);
               $update_c[]=array(
                                    'id' => $id,
                                    'contact_person_code' => $vcp_code[$i],
                                    'contact_person_name' => $vcp_name[$i],
                                    'contact_person_email' => $vcp_email[$i],
                                    'contact_person_mobile' => $vcp_mobile[$i],
                                );

            }

         }

                        $vcontact_person_code = $this->input->post('vcpcode');
                         $vcontact_person_name = $this->input->post('vcpname');
                         $vcontact_person_email = $this->input->post('vcpemail');
                         $vcontact_person_mobile = $this->input->post('vcpmobile');
                         $vendor_id = $this->input->post('vendor_id');
                         $all_contacts = array();
                    if(count($vcontact_person_code) > 0){
                         for($i=0;$i<count($vcontact_person_code);$i++)
                         {
                            if($vcontact_person_code[$i] !=''){
                                $insert_contacts=array();
                                $insert_contacts['vendor_id']=$vendor_id;
                                $insert_contacts['contact_person_mobile']=$vcontact_person_mobile[$i];
                                $insert_contacts['contact_person_name']=$vcontact_person_name[$i];
                                $insert_contacts['contact_person_code']=$vcontact_person_code[$i];
                                $insert_contacts['contact_person_email']=$vcontact_person_email[$i];
                                array_push($all_contacts,$insert_contacts);
                           } 
                         }
                         if($all_contacts !=null){
                            $insert_vendor_contacts = $this->Crud->batchInsert('ga_vendor_contacts_tbl',$all_contacts);
                            if($insert_vendor_contacts)
                            {
                                $update_count= $update_count +1;
                            }
                        }
                }

        if(count($update_c) > 0){
            $update = json_decode($this->Vendor_model->batchUpdate('ga_vendor_contacts_tbl', $update_c, 'id'));
        }
        if($update->code==200){  $update_count= $update_count +1;}
            if($update_count > 0){
                $this->session->set_flashdata('Success','Data Updated successfully!');
            }
            else{
                $this->session->set_flashdata('Failed','Data not modified');
            }
            redirect($_SERVER['HTTP_REFERER']);
    }
    public function delete_vendor_contact(){
        $id=base64_decode($this->uri->segment(4,0));
            $wherecondition=array('id'=>$id);
            $delete = json_decode($this->Crud->commonDelete('ga_vendor_contacts_tbl',$wherecondition,'Vendor Contact'));
            if($delete->code==200){
                $this->session->set_flashdata('Success','Vendor contact removed successfully!');
            }else{
                $this->session->set_flashdata('Failed','Failed to remove vendor contact');
            }
        redirect($_SERVER['HTTP_REFERER']);  
    }
public function commonStatus()
    {
      
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
            case 'vendor':   // need to refer name for table name
              $table='ga_vendors_table';   // table name 
              $setcolumns='vendor_status';
              $updatevalue=$activity;
              $wherecondition="vendor_id  IN  (" .$updatelist. ")";
              break;
            }
           $common = $this->Crud->commonStatusActivity($table, $setcolumns, $updatevalue, $wherecondition);
            echo $common;
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
            
            case 'vendor':
                $table = 'ga_vendors_table';
                $wherecondition = "vendor_id IN  (" . $updatelist . ")";
                break;
            }
            $update = $this->Crud->commonDelete($table,$wherecondition,$relationname);
            echo $update;
            exit;
        }
        echo json_encode($response);
    }          
                
            
}