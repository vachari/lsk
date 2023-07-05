<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendor extends CI_Controller {	
		public $user_id,$vendor_id,$shipper_id,$vendor_name,$vendor_email,$ipaddress,$data;
		public function __construct(){
			parent::__construct();
			$this->data=array();
			$this->user_id = $this->session->userdata('user_id');
	        if(!empty($this->user_id)){
	        	redirect(base_url());
	        }
      $this->shipper_id = $this->session->userdata('shipper_id');
            if(!empty($this->shipper_id)){
                redirect(base_url().'shipper/dashboard');
            } 
			 //load models here
	        $this->load->model(array('Pages_model','Orders_model','Vendor_model'));
	        //helper loads here for xss_clean
	        $this->load->helper('security');
          $this->load->library('pagination');
          $this->load->library('paginate');
	        // accessing the session data form the Userdata 
	        $this->vendor_id = $this->session->userdata('vendor_id');
	        $this->vendor_name = $this->session->userdata('vendor_name');
	        $this->vendor_email = $this->session->userdata('vendor_email');
          $this->ipaddress = $_SERVER['REMOTE_ADDR'];
		}

///////////////// Vendor Accessing code start here /////////////////////

		public function index(){
	   if(isset($this->vendor_id) && !empty($this->vendor_id)){
				redirect('vendor/dashboard');	
			}else{
				redirect('vendor/login');
			}
		} 
		public function dashboard(){
			if(!isset($this->vendor_id) && empty($this->vendor_id)){
				redirect('vendor/login');	
			}
			$this->load->view('vendor/dashboard');
		}
		public function login(){
			if(isset($this->vendor_id) && !empty($this->vendor_id)){
				redirect('vendor/dashboard');	
			}
			$this->load->view('vendor/login');
		}
		public function logging_in(){
		        $this->form_validation->set_rules('login_email','Email','required|valid_email',array('required'=>'Please enter email'));
		        $this->form_validation->set_rules('login_password','Password','required|min_length[6]|max_length[20]',array('required'=>'Please enter password'));
		        if($this->form_validation->run()==false){ 
	    			$this->load->view('vendor/login');
		        }
		        else{
		        	$email=$this->input->post('login_email');
		        	$password=$this->input->post('login_password');
		        	
		            $where=array(
		                                'email'=>$email,
		                                'password'=>md5($password)
		                );

		            $result=$this->Pages_model->can_vendorlogin($where);
		            $login_data=json_decode($result);
		            $row=$login_data->common_result;
		            if($login_data->code==SUCCESS_CODE){
		            	$email_verified=$row->verify_email;
			        	if($email_verified==0){
			        		$this->session->set_flashdata('failed','Email not verified, please check your mail');
			                 redirect('vendor/login');
			        	}
		                $session_data=array(
		                                    'vendor_id'=>$row->vendor_id,
		                                    'vendor_name'=>$row->vendor_name,
		                                    'vendor_email'=>$row->email
		                                    );
		                $this->session->set_userdata($session_data);
		                $check_verified_code=$this->Crud->checkAndReturn('verificationcode','ga_vendors_table',$where);
		                if($check_verified_code!=''){
		                	$this->session->set_flashdata('success','Successfully Logged in. Please change your password');
		                	redirect('vendor/change-password');
		                }else{
		                	$this->session->set_flashdata('success','Successfully Logged in.');
		                	redirect('vendor/dashboard');
		                }
		                
		            }else{
		               
		                $this->session->set_flashdata('failed','Invalid login credentials');
		                 redirect('vendor/login');
		                 
		                }
		        }
		    
    }
		 public function verification(){
          $verificationcode = $this->uri->segment(3,0);
	        $where = array('verificationcode'=>$verificationcode);
	        $existcheck = $this->Crud->commonCheck('vendor_id','ga_vendors_table',$where);
	        if($existcheck==1){
                $check_email_verify=$this->Crud->checkAndReturn('verify_email','ga_vendors_table',$where);
                if($check_email_verify==0){
    	            $update_data=array('verify_email'=>1);
    	            $update = json_decode($this->Crud->commonUpdate('ga_vendors_table', $update_data, $where)); 
    	            if($update->code==200){
    	                redirect('vendor/login');
    	            }else{
    	            	redirect(base_url());
    	            }
                }else{
                    redirect('vendor/login');
                }
		    }else{
		      $this->session->set_flashdata('failed','You are not authorize user.');
		      redirect(base_url().'register');
		    }
	    }
///////////////// Vendor Accessing code end here /////////////////////

///////////////// Vendor Change password code start here /////////////////////
	   public function changePassword(){
			if(!empty($this->vendor_id)){
				$this->load->view('vendor/changePassword');
			}else{
				redirect('vendor/login');
			}
		}
	public function changging_password(){
             $this->form_validation->set_rules('old_password','Old password','required|trim|min_length[5]');
            $this->form_validation->set_rules('new_password','New password','required|trim');
            $this->form_validation->set_rules('confirm_password','Confirm password','required|trim|matches[new_password]');
            if($this->form_validation->run() == false){
                $this->load->view('vendor/changePassword');
            }
            else{
                $old_password=$this->input->post('old_password');
                $new_password=$this->input->post('new_password');
                $confirm_password=$this->input->post('confirm_password');

                $cols=array('password');
                $wherecondition=array('password'=>md5($old_password),'vendor_id'=>$this->vendor_id);
                $common_check=$this->Crud->commonCheck($cols,'ga_vendors_table', $wherecondition);
                if($common_check ==1){
                        
                    if($new_password == $confirm_password){
                        $update_data=array('password'=>md5($new_password));

                        $update_condition=array('vendor_id'=>$this->vendor_id);
                        
            $update=$this->Crud->commonUpdate('ga_vendors_table',$update_data,$update_condition);
                             $update=json_decode($update);

                            if($update->code == SUCCESS_CODE){
                            	$check_verified_code=$this->Crud->checkAndReturn('verificationcode','ga_vendors_table',$update_condition);
				                if($check_verified_code!=''){
				                	$update=$this->Crud->commonUpdate('ga_vendors_table',['verificationcode'=>''],$update_condition);
				                }
                                $this->session->set_flashdata('success', 'Password has been changed successfully!');
                            }
                            else{
                                $this->session->set_flashdata('failed', 'Oops! Unabled to change password');    
                            }
                            redirect('vendor/change-password');
                    }
                }
            }
    }
///////////////// Vendor Change password code end here /////////////////////

///////////////// Vendor Profile code start here /////////////////////
    public function profile(){
    	if(!isset($this->vendor_id) && empty($this->vendor_id)){
				redirect('vendor/login');	
			}
      $this->data['vendor_details'] = $this->Vendor_model->update_vendor($this->vendor_id);
      $this->data['vendor_contacts'] = $this->Vendor_model->update_vendor_contacts($this->vendor_id);
      $this->data['vendor_payment_details'] = $this->Vendor_model->update_vendor_payment_details($this->vendor_id);
    	$this->load->view('vendor/profile',$this->data);
    }
    public function profileUpdate(){
    	if(!isset($this->vendor_id) && empty($this->vendor_id)){
				redirect('vendor/login');	
			}
      $this->data['vendor_details'] = $this->Vendor_model->update_vendor($this->vendor_id);
      $this->data['vendor_contacts'] = $this->Vendor_model->update_vendor_contacts($this->vendor_id);
    	$this->load->view('vendor/profileUpdate',$this->data);
    }
    public function profileUpdating(){
       $update_count=0;
       $update_data = array(
                    'vendor_code' =>$this->input->post('vendor_code'),
                     'vendor_name' => ucfirst($this->input->post('vendor_name')) ,
                     'mobile' =>$this->input->post('mobile'),
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
                $this->session->set_flashdata('Failed','Email was already existed, try other');
                redirect($_SERVER['HTTP_REFERER']);
         }
         $update = $this->Vendor_model->update_data('ga_vendors_table', $update_data, $update_where);
         if($update){ $update_count= $update_count +1;}
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
    public function contactDelete(){
        $id=base64_decode($this->uri->segment(3,0));
            $wherecondition=array('id'=>$id);
            $delete = json_decode($this->Crud->commonDelete('ga_vendor_contacts_tbl',$wherecondition,'Vendor Contact'));
            if($delete->code==200){
                $this->session->set_flashdata('Success','Contact person removed successfully!');
            }else{
                $this->session->set_flashdata('Failed','Failed to remove contact person');
            }
        redirect($_SERVER['HTTP_REFERER']);  
    }
///////////////// Vendor Profile code end here /////////////////////
    ///////////////// Vendor Payments code start here /////////////////////
public function accountsReceivable(){
  if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search=array();
        $orders=json_decode($this->Vendor_model->get_accounts_receivable($search));
        $total_rows=$orders->num_rows;
        $base_url = base_url()."vendor/accounts-receivable/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data["total_rows"] = $total_rows;
        $this->data['power_users'] = $this->Vendor_model->get_power_users();
        $this->data['payments']=$this->Vendor_model->get_accounts_receivable($search,$config["per_page"],$page);
        // print_r($this->data['payments']);exit;
        $this->load->view('vendor/accounts_receivable',$this->data);
}
public function accountsReceivableAjax($pageno=0){
        $response=array();
        $search=array();
        $search['search_name']=$this->input->post('search_name');
        $search['power_user']=$this->input->post('power_user');
        $search['delivery_date']=$this->input->post('delivery_date');
        $payments= json_decode($this->Vendor_model->get_accounts_receivable($search));
        $total_rows=count($payments->result);
        $base_url = base_url().'vendor/accounts-receivable/';
        $per_page = PER_PAGE;
        if($pageno > 0){
              $si= $per_page * ($pageno-1);
         }else{$si=0;}
        $config = $this->paginate->pagination($base_url,$total_rows,$per_page);
        $this->load->library('pagination');
        $config['use_page_numbers']=TRUE;
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $payment_list = json_decode($this->Vendor_model->get_accounts_receivable($search,$per_page,$si));
        $html="";
        if($payment_list->code==200){
          foreach ($payment_list->result as $ol) {
            $html .= '<tr><td>'.$ol->order_number.'</td>';
            $html .= '<td>'.$ol->power_user_name.'</td>';
            $html .= '<td>'.$ol->total_value_of_delivery.'</td>';
            $html .= '<td>'.$ol->collected_amount.'</td>';
            $html .= '<td>'.$ol->due_amount.'</td>';
            $html .= '<td>'.$ol->due_days.'</td>';
            if(strtotime($ol->delivery_date) > 0){
              $html .= '<td>'.date("d-M-Y ", strtotime($ol->delivery_date)).'</td>';
            }else{
              $html .= '<td></td>';  
            }
            $html .= '<td>'.$ol->city.'</td>';
            $html .= '<td>'.$ol->pincode.'</td>';
            $html .= '</tr>';                      
          }
        }
        $response['html']=$html;
        $msg=' payments found';
        if($total_rows ==1){$msg=' payment found';}
        $response['total_rows']=($total_rows > 0)?$total_rows.$msg:'';
        $response['pagination']=$links;
  //       print_r($response);exit;
        echo json_encode($response);
        
}
///////////////// Vendor Payments code end here /////////////////////

///////////////// Vendor Forgot Password code start here /////////////////////
    public function forgotPassword(){
        if(isset($this->vendor_id) && !empty($this->vendor_id)){
                redirect('vendor/dashboard');   
            }

        $this->load->view('vendor/forgotPassword');    
    }
    public function sendingResetPasswordLink(){
        $this->form_validation->set_rules('email','Email','required|valid_email',array('required'=>'Please enter email','valid_email'=>'Please enter valid email'));
        if($this->form_validation->run()==false){ 
            $this->load->view('vendor/forgotPassword');
        }
        else{
            $email=$this->input->post('email');
            $check_email=$this->Crud->commonCheck('email','ga_vendors_table',['email'=>$email]);
            $vendor_data=array();
            $verificationcode=sha1('ShoperativeVendor'.rand(100,999));
            if($check_email){
                $update_vendor=json_decode($this->Crud->commonUpdate('ga_vendors_table',['verificationcode'=>$verificationcode],['email'=>$email]));
                if($update_vendor->code==200){
                    $vendor_data['subject']='Reset Password';
                    $vendor_data['email']=$email;
                    $vendor_data['link']=base_url().'vendor/reset-password/'.$verificationcode;
                    // sending email for reset password
                    $mail_array = $this->sendmail->sendEmail(
                                        array(
                                            'to' =>array($email),
                                            'cc' => array('info@' . SITE_DOMAIN),
                                            'bcc' => array(BCC_EMAIL),
                                            'subject' => 'Reset Password',
                                            'data' => array('email_content'=>$vendor_data),
                                            'template' => EMAIL_TEMPLATE_FOLDER.'forgot_password',
                                        )
                                    );
                    // email code end
                    if($mail_array['code']==1){
                        $this->session->set_flashdata('success', 'Reset password link sent to your email ID');
                    }else{
                        $this->session->set_flashdata('failed', 'Unabled to send reset pasword link, please try again');
                    }
                }else{
                    $this->session->set_flashdata('failed', 'Something went wrong, please try again');
                }
               
            }else{
                $this->session->set_flashdata('failed', 'Email not registered, try other');
            }
         redirect('vendor/forgot-password'); 
        }
    }
    public function resetPassword(){
        if(isset($this->vendor_id) && !empty($this->vendor_id)){
                redirect('vendor/dashboard');   
            }

        $this->load->view('vendor/resetPassword');    
    }
    public function resettingPassword(){
            $this->form_validation->set_rules('new_password','New password','required|trim|min_length[6]|max_length[20]');
            $this->form_validation->set_rules('confirm_password','Confirm password','required|trim|matches[new_password]');
            if($this->form_validation->run() == false){
                $this->load->view('vendor/resetPassword');
            }
            else{
                $verificationcode=$this->input->post('verificationcode');
                $new_password=$this->input->post('new_password');
                $confirm_password=$this->input->post('confirm_password');

                $cols=array('password');
                $wherecondition=array('verificationcode'=>$verificationcode);
                $common_check=$this->Crud->commonCheck($cols,'ga_vendors_table', $wherecondition);
                if($common_check ==1){
                    $update_data=array('password'=>md5($new_password),'verificationcode'=>'','verify_email'=>1);
                    $update=$this->Crud->commonUpdate('ga_vendors_table',$update_data,$wherecondition);
                    $update=json_decode($update);
                            if($update->code == SUCCESS_CODE){
                                $this->session->set_flashdata('success', 'Password has been reset successfully!');
                                redirect('vendor/login');
                            }
                            else{
                                $this->session->set_flashdata('failed', 'Oops! Unabled to reset password');  
                                redirect('vendor/reset-password/'.$verificationcode);  
                            }
                }else{
                    $this->session->set_flashdata('failed', 'Oops! Unabled to reset password');  
                    redirect('vendor/forgot-password');  
                }
            }
    }
///////////////// Vendor Forgot Password code end here /////////////////////

///////////////// Vendor Products code start here //////////////
  public function products(){
    if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search['search_name']=$this->input->post('search_name');
        $search['search_group']=$this->input->post('group');
        $search['search_category']=$this->input->post('category');
        $products=json_decode($this->Vendor_model->get_products($search));
        $total_rows=$products->num_rows;
        $base_url = base_url()."vendor/products/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['groups'] = json_decode($this->Vendor_model->getProductGroupList());
        $this->data['categories'] = json_decode($this->Vendor_model->getCategoryList());
        $this->data['products']=json_decode($this->Vendor_model->get_products($search,$config["per_page"],$page));
        $this->data['search']=$search;
        // echo "<pre>";
        // print_r($this->data['products']);exit;
        $this->load->view('vendor/products',$this->data);
  }
  public function product_inventory(){
    if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search['search_name']=$this->input->post('search_name');
        $search['search_group']=$this->input->post('group');
        $products=json_decode($this->Vendor_model->get_products($search));
        $total_rows=$products->num_rows;
        $base_url = base_url()."vendor/product-inventory/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['groups'] = json_decode($this->Vendor_model->getProductGroupList());
        $this->data['products']=json_decode($this->Vendor_model->get_products($search,$config["per_page"],$page));
        $this->data['search']=$search;
        // echo "<pre>";
        // print_r($this->data['products']);exit;
        $this->load->view('vendor/product_inventory',$this->data);
  }
  public function updatestock(){
      $response=array();
      $stock=$this->input->post('stock');
      $product_id=$this->input->post('product_id');
      $response['code']=111;
      $response['last_modified_stock']='';
      $update_stock=json_decode($this->Crud->commonUpdate('ga_main_prod_details_tbl',['stock'=>$stock,'last_modified_stock'=>DATE],['id'=>$product_id]));
      if($update_stock->code==200){
        $response['last_modified_stock']=date('d-M-Y h:i:s A');  
      }
      $response['code']=$update_stock->code;
      echo json_encode($response);
    }
  public function search_products(){
    if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
    }
        $config = array();
        $search = array();
        $search_name=($this->input->post('search_name') !=null)?$this->input->post('search_name'):'';
        $group=($this->input->post('group') !=null)?$this->input->post('group'):'';
        $category=($this->input->post('category') !=null)?$this->input->post('category'):'';
        $sess_search_name='';$sess_group='';$sess_category='';
        $sess_search_name=$this->session->userdata('sess_search_prod');
        $sess_group=$this->session->userdata('sess_group');
        $sess_category=$this->session->userdata('sess_category');
        if($search_name=='' && !empty($sess_search_name) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_search_prod');
        if($group=='' && !empty($sess_group) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_group');
        if($category=='' && !empty($sess_category) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_category');

        if(!empty($search_name) && ($this->session->userdata('sess_search_prod') == null))
         $this->session->set_userdata('sess_search_prod',$search_name);
        $sess_search_name=$this->session->userdata('sess_search_prod');
        $search['search_name']=($search_name !='')?$search_name:$sess_search_name;

        if($search_name=='' && $group !=''){
            $this->session->set_userdata('sess_group',$group); 
            if($this->session->userdata('sess_search_prod') != null){
                $search['search_name']=''; $this->session->unset_userdata('sess_search_prod');
            }  
        }
        $sess_group=$this->session->userdata('sess_group');
        $search['search_group']=($group !='')?$group:$sess_group;

        if($search_name=='' && $group=='' && $category !=''){
            $this->session->set_userdata('sess_category',$category);
            $search['search_name']=''; $this->session->unset_userdata('sess_search_prod'); 
            $search['search_group']=''; $this->session->unset_userdata('sess_group');  
        }
        $sess_category=$this->session->userdata('sess_category');
        $search['search_category']=($category !='')?$category:$sess_category;
        $products=json_decode($this->Vendor_model->get_products($search));
        $total_rows=$products->num_rows;
        $base_url = base_url()."vendor/search-products/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['groups'] = json_decode($this->Vendor_model->getProductGroupList());
        $this->data['categories'] = json_decode($this->Vendor_model->getCategoryList());
        $this->data['products']=json_decode($this->Vendor_model->get_products($search,$config["per_page"],$page));
        $this->data['search']=$search;
        // echo "<pre>";
        // print_r($this->data['products']);exit;
        $this->load->view('vendor/products',$this->data);
  }
  public function search_product_inventory(){
    if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
    }
        $config = array();
        $search = array();
        $search_name=($this->input->post('search_name') !=null)?$this->input->post('search_name'):'';
        $group=($this->input->post('group') !=null)?$this->input->post('group'):'';
        $sess_search_name='';$sess_group='';;
        $sess_search_name=$this->session->userdata('sess_search_prod');
        $sess_group=$this->session->userdata('sess_group');
        if($search_name=='' && !empty($sess_search_name) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_search_prod');
        if($group=='' && !empty($sess_group) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_group');
        if(!empty($search_name) && ($this->session->userdata('sess_search_prod') == null))
         $this->session->set_userdata('sess_search_prod',$search_name);
        $sess_search_name=$this->session->userdata('sess_search_prod');
        $search['search_name']=($search_name !='')?$search_name:$sess_search_name;

        if($search_name=='' && $group !=''){
            $this->session->set_userdata('sess_group',$group); 
            if($this->session->userdata('sess_search_prod') != null){
                $search['search_name']=''; $this->session->unset_userdata('sess_search_prod');
            }  
        }
        $sess_group=$this->session->userdata('sess_group');
        $search['search_group']=($group !='')?$group:$sess_group;
        $products=json_decode($this->Vendor_model->get_products($search));
        $total_rows=$products->num_rows;
        $base_url = base_url()."vendor/search-product-inventory/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['groups'] = json_decode($this->Vendor_model->getProductGroupList());
        $this->data['products']=json_decode($this->Vendor_model->get_products($search,$config["per_page"],$page));
        $this->data['search']=$search;
        // echo "<pre>";
        // print_r($this->data['products']);exit;
        $this->load->view('vendor/product_inventory',$this->data);
  }
   public function edit_product(){
      if(!isset($this->vendor_id) && empty($this->vendor_id)){
        redirect('vendor/login'); 
      }
      $prod_id=$this->uri->segment(3,0);
      if($prod_id){
        $product_id=base64_decode($prod_id);
        $this->data['units'] = json_decode($this->Vendor_model->getUnitOfMeasureList());
        $this->data['groups'] = json_decode($this->Vendor_model->getProductGroupList());
        $this->data['categories'] = json_decode($this->Vendor_model->getCategoryList());
        $this->data['product_details'] = $this->Vendor_model->update_product($product_id);
        $cat_id=$this->data['product_details']->category;
        $subcat_id=$this->data['product_details']->sub_category;
        $this->data['sub_categories'] = json_decode($this->Vendor_model->getSubCategoryList($cat_id));
        $this->data['listsub_categories'] = json_decode($this->Vendor_model->getListSubCategoryList($subcat_id));
        $this->load->view('vendor/edit_product',$this->data);
      }else{
        redirect('vendor/products'); 
      }
    }
    public function update_product_details() {
      $response = array();
      $image='';
      $alt_image='';
        $menu = $this->input->post('menu_id');
        $submenu = $this->input->post('submenu_id');
        $listsubmenu = $this->input->post('listsubmenu');
        $prodcode = $this->input->post('product_code');
        $prodtitle = $this->input->post('product_title');
        $prod_desc = $this->input->post('product_description');
        $sku_qty = $this->input->post('sku_qty');
        $prod_group = $this->input->post('group_id');
        $prod_unit = $this->input->post('unit_id');
        $vendor_id = $this->input->post('vendor');
        $vendor_item_code= $this->input->post('vendor_item_code');
        $hsn_code = $this->input->post('hsn_code');
        $shelf_life_no = $this->input->post('shelf_life_no');
        $shelf_life_unit = $this->input->post('shelf_life_unit');
        $image = $_FILES['image']['name'];
        $alt_image = $_FILES['alt_image']['name'];
        $id=$this->input->post('pro_id');
        $where=array('id'=>$id);
              $imageextension = array("jpg","JPG","gif","GIF","PNG","png","JPEG","jpeg");
        // if ($image != '' && $menu != '' && $submenu != '' && $prodcode != '' && $prodtitle != '' &&
        //         $prod_desc != '' && $sku_qty != '') {
            if (!empty($image)) {
                $extension = $this->getFileExtensions($_FILES['image']['name']);
                if (in_array($extension, $imageextension)) {
                    $upload_pic = sha1(time() . rand(00000000, 999999999));
                    $filename = stripslashes($_FILES['image']['name']);
                    $upload_file = $_FILES['image']['tmp_name'];
                    $upload_picture = $upload_pic . '.' . $extension;
                    $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                    $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/products/" . $upload_picture;
                    $filename = $this->compress_image($upload_file, $url, 30);
                }
            }
                if (!empty($alt_image)) {
                    $extension = $this->getFileExtensions($_FILES['alt_image']['name']);
                    if (in_array($extension, $imageextension)) {
                        $upload_pic = sha1(time() . rand(00000000, 999999999));
                        $filename = stripslashes($_FILES['alt_image']['name']);
                        $upload_file = $_FILES['alt_image']['tmp_name'];
                        $upload_alt_picture = $upload_pic . '.' . $extension;
                        $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                        $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/products/other_images/" . $upload_alt_picture;
                        $filename = $this->compress_image($upload_file, $url, 30);
                    }
                }
                if(empty($upload_picture)){
                     $upload_picture=$this->input->post('img1');
                }
                if(empty($upload_alt_picture)){
                     $upload_alt_picture=$this->input->post('img2');
                }
                $update_array = array(
                    'category' => $menu,
                    'sub_category' => $submenu,
                    'listsubmenu_id' => $listsubmenu,
                    'prod_code' => $prodcode,
                    'vendor_id' => $vendor_id,
                    'vendor_item_code' => $vendor_item_code,
                    'prod_name' => $prodtitle,
                    'prod_desc' => $prod_desc,
                    'sku' => $sku_qty,
                    'hsn_code' => $hsn_code,
                    'shelf_life_no' => $shelf_life_no,
                    'shelf_life_unit' => $shelf_life_unit,
                    'prod_image' => $upload_picture,
                    'unit' => $prod_unit,
                    'prod_group' => $prod_group,
                    'other_image'=>$upload_alt_picture
                );
                $update = $this->Crud->commonUpdate('ga_main_prod_details_tbl',$update_array,['id'=>$id]);
                echo $update;exit;
                
           //}   
  }
  public function add_product(){
      if(!isset($this->vendor_id) && empty($this->vendor_id)){
        redirect('vendor/login'); 
      }
        $this->data['units'] = json_decode($this->Vendor_model->getUnitOfMeasureList());
        $this->data['groups'] = json_decode($this->Vendor_model->getProductGroupList());
        $this->data['categories'] = json_decode($this->Vendor_model->getCategoryList());
        $this->load->view('vendor/add_product',$this->data);
      
    }
    public function add_product_details() {
      $image='';
      $alt_image='';
      $upload_picture='';
      $upload_alt_picture='';
        $menu = $this->input->post('menu_id');
        $submenu = $this->input->post('submenu_id');
        $listsubmenu = $this->input->post('listsubmenu');
        $prodcode = $this->input->post('product_code');
        $prodtitle = $this->input->post('product_title');
        $prod_desc = $this->input->post('product_description');
        $sku_qty = $this->input->post('sku_qty');
        $prod_group = $this->input->post('group_id');
        $prod_unit = $this->input->post('unit_id');
        $vendor_item_code= $this->input->post('vendor_item_code');
        $feature_product = $this->input->post('feature_product');
        $hsn_code = $this->input->post('hsn_code');
        $shelf_life_no = $this->input->post('shelf_life_no');
        $shelf_life_unit = $this->input->post('shelf_life_unit');
        $image = $_FILES['image']['name'];
        $alt_image = $_FILES['alt_image']['name'];
        $imageextension = array("jpg","JPG","gif","GIF","PNG","png","JPEG","jpeg");
        // if ($image != '' && $menu != '' && $submenu != '' && $prodcode != '' && $prodtitle != '' &&
        //         $prod_desc != '' && $sku_qty != '') {
            if (!empty($image)) {
                $extension = $this->getFileExtensions($_FILES['image']['name']);
                if (in_array($extension, $imageextension)) {
                    $upload_pic = sha1(time() . rand(00000000, 999999999));
                    $filename = stripslashes($_FILES['image']['name']);
                    $upload_file = $_FILES['image']['tmp_name'];
                    $upload_picture = $upload_pic . '.' . $extension;
                    $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                    $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/products/" . $upload_picture;
                    $filename = $this->compress_image($upload_file, $url, 30);
                }
            }
                if (!empty($alt_image)) {
                    $extension = $this->getFileExtensions($_FILES['alt_image']['name']);
                    if (in_array($extension, $imageextension)) {
                        $upload_pic = sha1(time() . rand(00000000, 999999999));
                        $filename = stripslashes($_FILES['alt_image']['name']);
                        $upload_file = $_FILES['alt_image']['tmp_name'];
                        $upload_alt_picture = $upload_pic . '.' . $extension;
                        $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                        $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/products/other_images/" . $upload_alt_picture;
                        $filename = $this->compress_image($upload_file, $url, 30);
                    }
                }
                $add_array = array(
                    'vendor_id' => $this->vendor_id,
                    'category' => $menu,
                    'sub_category' => $submenu,
                    'listsubmenu_id' => $listsubmenu,
                    'prod_code' => $prodcode,
                    'vendor_item_code' => $vendor_item_code,
                    'prod_name' => $prodtitle,
                    'prod_desc' => $prod_desc,
                    'sku' => $sku_qty,
                    'prod_image' => $upload_picture,
                    'unit' => $prod_unit,
                    'prod_group' => $prod_group,
                    'feature_product' => $feature_product,
                    'other_image'=>$upload_alt_picture,
                    'created_on' => DATE,
                    'hsn_code' => $hsn_code,
                    'shelf_life_no' => $shelf_life_no,
                    'shelf_life_unit' => $shelf_life_unit
                );
                $add = $this->Crud->commonInsert('ga_main_prod_details_tbl',$add_array);
                echo $add;exit;
                
           //}   
  }
  public function add_bulk_products(){
      if(!isset($this->vendor_id) && empty($this->vendor_id)){
        redirect('vendor/login'); 
      }
        $this->load->view('vendor/add_bulk_products',$this->data);
      
    }
//////////////// Assinging products to group /////////////////////
    public function assignProductsToGroup(){
      if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $this->data['groups'] = $this->Vendor_model->getGroups();
        $this->data['products'] = $this->Vendor_model->non_assigned_products();
        $this->load->view('vendor/assignProductsToGroup',$this->data);
    }
    public function assignProductsToGroupAjax($pageno=0){
        $response=array();
        $search=array();
        $search['product']=$this->input->post('product');
        $products= json_decode($this->Vendor_model->non_assigned_products($search));
        $total_rows=count($products);
        $base_url = base_url().'vendor/assign-products-to-group/';
        $per_page = PER_PAGE;
        if($pageno > 0){
              $si= $per_page * ($pageno-1);
         }else{$si=0;}
        $config = $this->paginate->pagination($base_url,$total_rows,$per_page);
        $this->load->library('pagination');
        $config['use_page_numbers']=TRUE;
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $product_list = json_decode($this->Vendor_model->non_assigned_products($search,$per_page,$si));
        $html="";
        if($product_list !=null){
          foreach ($product_list as $prod) {
            $html .= '';
            $html .= '<tr class=""><td><input type="checkbox" class="inline-checkbox checkSingle" name="na_product_id[]" value="'.$prod->id.'"></td>';
            $html .= '<td>'.$prod->prod_code.'</td>';
            $html .= '<td>'.$prod->prod_name.'</td>';
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
        $products= json_decode($this->Vendor_model->group_products($group,$search));
        $total_rows=count($products);
        $base_url = base_url().'vendor/assign-products-to-group/';
        $per_page = PER_PAGE;
        if($pageno > 0){
             $si= ($pageno - 1) * $per_page;
         }else{$si=0;}
        $config = $this->paginate->pagination($base_url,$total_rows,$per_page);
        $this->load->library('pagination');
        $config['use_page_numbers']=TRUE;
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $product_list = json_decode($this->Vendor_model->group_products($group,$search,$per_page,$si));
        $html="";
        if($product_list !=null){
          foreach ($product_list as $prod) {
            $html .= '';
            $html .= '<tr class=""><td><input type="checkbox" class="inline-checkbox checkSingle" name="product_id[]" value="'.$prod->id.'"></td>';
            $html .= '<td>'.$prod->prod_code.'</td>';
            $html .= '<td>'.$prod->prod_name.'</td>';
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
          $update = $this->Vendor_model->groupProductsUpdate($table, $setcolumns, $updatevalue, $wherecondition);
            echo $update;exit;
        }
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
            $update_prod = $this->Vendor_model->update_data('ga_main_prod_details_tbl',$update_data,$where);
            if($update_prod){$update_count+=1;}
          }
        }
        if($update_count > 0){
          if($update_count==1){$msg=$update_count.' Product removed successfully!';}
          else{$msg=$update_count.' Products removed successfully!';}
                $this->session->set_flashdata('Success',$msg);
        }else{
              $this->session->set_flashdata('Failed','Please select from list');
            }
        redirect('vendor/assign-products-to-group');
        }
////////////////////// assign products to group code end here //////////
      public function productPricingList(){
        if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search['search_name']=$this->input->post('search_name');
        $products=json_decode($this->Vendor_model->get_product_prices($search));
        $total_rows=$products->num_rows;
        $base_url = base_url()."vendor/product-wise-prices";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['product_prices']=json_decode($this->Vendor_model->get_product_prices($search,$config["per_page"],$page));
        $this->data['search']=$search;
        // echo "<pre>";
        // print_r($this->data['product_prices']);exit;
        $this->load->view('vendor/manage_product_prices',$this->data);
  }
  public function searchProductPrice(){
        if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search = array();
        $search_name=($this->input->post('search_name') !=null)?$this->input->post('search_name'):'';
        $sess_search_name='';
        $sess_search_name=$this->session->userdata('sess_search_prod_price');
        if($search_name=='' && !empty($sess_search_name) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_search_prod_price');
        if(!empty($search_name) && ($this->session->userdata('sess_search_prod_price') == null))
         $this->session->set_userdata('sess_search_prod_price',$search_name);
        $sess_search_name=$this->session->userdata('sess_search_prod_price');
        $search['search_name']=($search_name !='')?$search_name:$sess_search_name;
        $products=json_decode($this->Vendor_model->get_product_prices($search));
        $total_rows=$products->num_rows;
        $base_url = base_url()."vendor/search-product-wise-price";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['product_prices']=json_decode($this->Vendor_model->get_product_prices($search,$config["per_page"],$page));
        $this->data['search']=$search;
        // echo "<pre>";
        // print_r($this->data['product_prices']);exit;
        $this->load->view('vendor/manage_product_prices',$this->data);
  }
     
    public function editProductPrice(){
        $id=$this->uri->segment(3,0);
        if($id){
          $price_id=base64_decode($id);
            $this->data['product_code_list'] = json_decode($this->Vendor_model->getProductCodeList());
            $this->data['product_price_details'] = $this->Vendor_model->update_product_price($price_id);
            // print_r($this->data['product_price_details']);exit;
            $this->load->view('vendor/edit_product_price', $this->data);
        }else{
            redirect('vendor/product-wise-prices');
        }
    }
    public function get_product_sku()
    {
        $product_id = $this->input->post('product_id');
       echo $this->Vendor_model->getProdSku($product_id);
    }
    public function UpdateProductPricing() {
        $response = array();
        $str=1;
        $id=$this->input->post('id');
        $prod_code=$this->input->post('prod_id');
        $qty_range_from=$this->input->post('qty_range_from');
        $qty_range_to=$this->input->post('qty_range_to');
        $form_date=$this->input->post('form_date');
        $to_date=$this->input->post('to_date');
        $selling_price=$this->input->post('selling_price');
        $buying_price=$this->input->post('buying_price');

           if($prod_code == 0){
             $str=0;
           }
        if($str==1){
          if (!empty($qty_range_from) && !empty($qty_range_to) && !empty($form_date) && !empty($to_date) && !empty($selling_price) && $selling_price !=0) 
          {

            $prod_data=array(
                                        'prod_id'=>$prod_code,
                                         'prod_code'=>$prod_code,
                                         'qty_range_from'=>$qty_range_from,
                                         'qty_range_to'=>$qty_range_to,
                                         'form_date'=>$form_date,
                                         'to_date'=>$to_date,
                                         'selling_price'=>$selling_price,
                                         'buying_price'=>$buying_price
                                         );
             
             $update = json_decode($this->Vendor_model->commonUpdate('ga_prod_item_pricing_tbl',$prod_data,['id'=>$id]));

                if($update->code==200){
                $this->session->set_flashdata('Success', 'Data updated Successfully!');          
                }
                else{
                  $this->session->set_flashdata('Failed', 'Data not modified'); 
                }

            }else{
              $this->session->set_flashdata('Failed', 'Unabled to update data');
            }
        }
        else{
          $this->session->set_flashdata('Failed', 'Please enter all fields');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
  public function productGroupPricingList(){
        if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search['search_name']=$this->input->post('search_name');
        $products=json_decode($this->Vendor_model->get_product_group_prices($search));
        $total_rows=$products->num_rows;
        $base_url = base_url()."vendor/product-group-wise-prices";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['groups'] = json_decode($this->Vendor_model->getProductGroupList());
        $this->data['product_group_prices']=json_decode($this->Vendor_model->get_product_group_prices($search,$config["per_page"],$page));
        $this->data['search']=$search;
        // echo "<pre>";
        // print_r($this->data['product_group_prices']);exit;
        $this->load->view('vendor/manage_product_group_prices',$this->data);
  }
  public function searchProductGroupPrice(){
        if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search = array();
        $search_name=($this->input->post('search_name') !=null)?$this->input->post('search_name'):'';
        $group=($this->input->post('group') !=null)?$this->input->post('group'):'';
        $sess_search_name='';$sess_group='';
        $sess_search_name=$this->session->userdata('sess_search_prod_gp');
        $sess_group=$this->session->userdata('sess_group_gp');
        if($search_name=='' && !empty($sess_search_name) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_search_prod_gp');
        if($group=='' && !empty($sess_group) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_group_gp');
        if(!empty($search_name) && ($this->session->userdata('sess_search_prod_gp') == null))
         $this->session->set_userdata('sess_search_prod_gp',$search_name);
        $sess_search_name=$this->session->userdata('sess_search_prod_gp');
        $search['search_name']=($search_name !='')?$search_name:$sess_search_name;

        if($search_name=='' && $group !=''){
            $this->session->set_userdata('sess_group_gp',$group); 
            if($this->session->userdata('sess_search_prod_gp') != null){
                $search['search_name']=''; $this->session->unset_userdata('sess_search_prod_gp');
            }  
        }
        $sess_group=$this->session->userdata('sess_group_gp');
        $search['search_group']=($group !='')?$group:$sess_group;
        $products=json_decode($this->Vendor_model->get_product_group_prices($search));
        $total_rows=$products->num_rows;
        $base_url = base_url()."vendor/search-product-group-wise-price";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['groups'] = json_decode($this->Vendor_model->getProductGroupList());
        $this->data['product_group_prices']=json_decode($this->Vendor_model->get_product_group_prices($search,$config["per_page"],$page));
        $this->data['search']=$search;
        // echo "<pre>";
        // print_r($this->data['product_group_prices']);exit;
        $this->load->view('vendor/manage_product_group_prices',$this->data);
  }
   public function editProductGroupPrice(){
        $id=$this->uri->segment(3,0);
        if($id){
          $price_id=base64_decode($id);
            $this->data['groups'] = json_decode($this->Vendor_model->getProductGroupList());
            $this->data['units'] = json_decode($this->Vendor_model->getUnitOfMeasureList());
            $this->data['product_group_price_details'] = $this->Vendor_model->update_product_group_price($price_id);
            $this->load->view('vendor/edit_product_group_price', $this->data);
        }else{
            redirect('vendor/product-group-wise-prices');
        }
    }
    public function UpdateProductGroupPricing() {
        $response = array();
        $str=1;
        $id=$this->input->post('id');
        $prod_group=$this->input->post('prod_group');
        $qty_range_from=$this->input->post('qty_range_from');
        $qty_range_to=$this->input->post('qty_range_to');
        $from_date=$this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        $selling_price=$this->input->post('selling_price');
        $buying_price=$this->input->post('buying_price');
        $discount=$this->input->post('discount');

           if($prod_group == 0){
             $str=0;
           }
        if($str==1){
          if (!empty($qty_range_from) && !empty($qty_range_to) && !empty($from_date) && !empty($to_date)) 
          {

            $prod_data=array(
                                        'prod_group'=>$prod_group,
                                         'qty_range_from'=>$qty_range_from,
                                         'qty_range_to'=>$qty_range_to,
                                         'from_date'=>$from_date,
                                         'to_date'=>$to_date,
                                         'discount' => $discount
                                         );
             
             $update = json_decode($this->Vendor_model->commonUpdate('ga_prod_group_pricing_tbl',$prod_data,['id'=>$id]));

                if($update->code==200){
                $this->session->set_flashdata('Success', 'Data updated Successfully!');          
                }
                else{
                  $this->session->set_flashdata('Failed', 'Data not modified'); 
                }

            }else{
              $this->session->set_flashdata('Failed', 'Unabled to update data');
            }
        }
        else{
          $this->session->set_flashdata('Failed', 'Please enter all fields');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
///////////////// Vendor Products code end here ////////////////

///////////////// Vendor Shipping dashboard code start here ////////////////

///////////////// Vendor All Open Orders code start here ////////////////

    public function all_open_orders(){
        if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search['search_name']=$this->input->post('search_name');
        $search['overdue']=$this->input->post('overdue');
        $search['delivery_due_date']=$this->input->post('delivery_due_date');
        $orders=json_decode($this->Vendor_model->get_all_open_orders($search));
        $total_rows=$orders->num_rows;
        $base_url = base_url()."vendor/all-open-orders/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['ordersdata']=$this->Vendor_model->get_all_open_orders($search,$config["per_page"],$page,1);
        $this->data['search']=$search;
        // echo "<pre>";
        // print_r($this->data['orders']);exit;
        $this->load->view('vendor/all_open_orders',$this->data);

    }
    public function all_confirmed_orders(){
      if(!isset($this->vendor_id) && empty($this->vendor_id)){
        redirect('vendor/login'); 
      }
      $config = array();
      $search['search_name']=$this->input->post('search_name');
      $search['overdue']=$this->input->post('overdue');
      $search['delivery_due_date']=$this->input->post('delivery_due_date');
      $orders=json_decode($this->Vendor_model->get_all_open_orders($search));
      $total_rows=$orders->num_rows;
      $base_url = base_url()."vendor/all-open-orders/";
      $per_page = PER_PAGE;
      $uri_segment = 3;
      $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
      $this->pagination->initialize($config);
      $page = $this->uri->segment(3,0);
      $this->data["links"] = $this->pagination->create_links();
      $this->data['ordersdata']=$this->Vendor_model->get_all_open_orders($search,$config["per_page"],$page,2);
      $this->data['search']=$search;
      // echo "<pre>";
      // print_r($this->data['orders']);exit;
      $this->load->view('vendor/all_confirmed_orders',$this->data);

  }
  public function all_dispatched_orders(){
    if(!isset($this->vendor_id) && empty($this->vendor_id)){
      redirect('vendor/login'); 
    }
    $config = array();
    $search['search_name']=$this->input->post('search_name');
    $search['overdue']=$this->input->post('overdue');
    $search['delivery_due_date']=$this->input->post('delivery_due_date');
    $search['order_status']=3;
    $orders=json_decode($this->Vendor_model->get_all_open_orders($search));
    $total_rows=$orders->num_rows;
    $base_url = base_url()."vendor/all-open-orders/";
    $per_page = PER_PAGE;
    $uri_segment = 3;
    $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
    $this->pagination->initialize($config);
    $page = $this->uri->segment(3,0);
    $this->data["links"] = $this->pagination->create_links();
    $this->data['ordersdata']=$this->Vendor_model->get_all_open_orders($search,$config["per_page"],$page,3);
    $this->data['search']=$search;
    // echo "<pre>";
    // print_r($this->data['orders']);exit;
    $this->load->view('vendor/all_dispatched_orders',$this->data);

}
public function all_delivered_orders(){
  if(!isset($this->vendor_id) && empty($this->vendor_id)){
    redirect('vendor/login'); 
  }
  $config = array();
  $search['search_name']=$this->input->post('search_name');
  $search['overdue']=$this->input->post('overdue');
  $search['delivery_due_date']=$this->input->post('delivery_due_date');
  $search['order_status']=4;
  $orders=json_decode($this->Vendor_model->get_all_open_orders($search));
  $total_rows=$orders->num_rows;
  $base_url = base_url()."vendor/all-open-orders/";
  $per_page = PER_PAGE;
  $uri_segment = 3;
  $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
  $this->pagination->initialize($config);
  $page = $this->uri->segment(3,0);
  $this->data["links"] = $this->pagination->create_links();
  $this->data['ordersdata']=$this->Vendor_model->get_all_open_orders($search,$config["per_page"],$page,4);
  $this->data['search']=$search;
  // echo "<pre>";
  // print_r($this->data['orders']);exit;
  $this->load->view('vendor/all_delivered_orders',$this->data);

}
public function all_cancelled_orders(){
  if(!isset($this->vendor_id) && empty($this->vendor_id)){
    redirect('vendor/login'); 
  }
  $config = array();
  $search['search_name']=$this->input->post('search_name');
  $search['overdue']=$this->input->post('overdue');
  $search['delivery_due_date']=$this->input->post('delivery_due_date');
  $search['order_status']=5;
  $orders=json_decode($this->Vendor_model->get_all_open_orders($search));
  $total_rows=$orders->num_rows;
  $base_url = base_url()."vendor/all-open-orders/";
  $per_page = PER_PAGE;
  $uri_segment = 3;
  $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
  $this->pagination->initialize($config);
  $page = $this->uri->segment(3,0);
  $this->data["links"] = $this->pagination->create_links();
  $this->data['ordersdata']=$this->Vendor_model->get_all_open_orders($search,$config["per_page"],$page,5);
  $this->data['search']=$search;
  // echo "<pre>";
  // print_r($this->data['orders']);exit;
  $this->load->view('vendor/all_cancelled_orders',$this->data);

}
    
    public function search_open_orders(){
        if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        // print_r($_POST);exit;
        $search = array();
        $search_name=($this->input->post('search_name') !=null)?$this->input->post('search_name'):'';
        $overdue=($this->input->post('overdue') !=null)?$this->input->post('overdue'):'';
        $delivery_due_date=($this->input->post('delivery_due_date') !=null)?$this->input->post('delivery_due_date'):'';
        $sess_search_name='';$sess_overdue='';$sess_delivery_due_date='';
        $sess_search_name=$this->session->userdata('sess_search_name');
        $sess_overdue=$this->session->userdata('sess_overdue');
        $sess_delivery_due_date=$this->session->userdata('sess_delivery_due_date');
        if($search_name=='' && !empty($sess_search_name) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_search_name');
        if($overdue=='' && !empty($sess_overdue) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_overdue');
        if($delivery_due_date=='' && !empty($sess_delivery_due_date) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_delivery_due_date');

        if(!empty($search_name) && ($this->session->userdata('sess_search_name') == null))
         $this->session->set_userdata('sess_search_name',$search_name);
        $sess_search_name=$this->session->userdata('sess_search_name');
        $search['search_name']=($search_name !='')?$search_name:$sess_search_name;

        if($search_name=='' && $overdue !=''){
            $this->session->set_userdata('sess_overdue',$overdue); 
            if($this->session->userdata('sess_search_name') != null){
                $search['search_name']=''; $this->session->unset_userdata('sess_search_name');
            }  
        }
        $sess_overdue=$this->session->userdata('sess_overdue');
        $search['overdue']=($overdue !='')?$overdue:$sess_overdue;

        if($search_name=='' && $overdue=='' && $delivery_due_date !=''){
            $this->session->set_userdata('sess_delivery_due_date',$delivery_due_date);
            $search['search_name']=''; $this->session->unset_userdata('sess_search_name'); 
            $search['overdue']=''; $this->session->unset_userdata('sess_overdue');  
        }
        $sess_delivery_due_date=$this->session->userdata('sess_delivery_due_date');
        $search['delivery_due_date']=($delivery_due_date !='')?$delivery_due_date:$sess_delivery_due_date;
      
        $orders=json_decode($this->Vendor_model->get_all_open_orders($search));
        $total_rows=$orders->num_rows;
        $base_url = base_url()."vendor/search-open-orders/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['ordersdata']=$this->Vendor_model->get_all_open_orders($search,$config["per_page"],$page,1);
       
        $this->data['search']=$search;
        // echo "<pre>";
        // print_r($this->data['search']);exit;
        $this->load->view('vendor/all_open_orders',$this->data);

    }
    public function orders_due_for_delivery_by_due_date(){
        if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search['search_name']=$this->input->post('search_name');
        $search['overdue']=null;
        $search['delivery_due_date']=1;
        $orders=json_decode($this->Vendor_model->get_all_open_orders($search));
        $total_rows=$orders->num_rows;
        $base_url = base_url()."vendor/orders-due-for-delivery-by-due-date/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['ordersdata']=$this->Vendor_model->get_all_open_orders($search,$config["per_page"],1);
        $this->data['search']=$search;
        // echo "<pre>";
        // print_r($this->data['orders']);exit;
        $this->load->view('vendor/orders_due_for_delivery_by_due_date',$this->data);

    }
    public function search_orders_due_for_delivery_by_due_date(){
        if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        // print_r($_POST);exit;
        $search = array();
        $search_name=($this->input->post('search_name') !=null)?$this->input->post('search_name'):'';
        $sess_search_name='';;
        $sess_search_name=$this->session->userdata('sess_search_name');
        if($search_name=='' && !empty($sess_search_name) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_search_name');
        if(!empty($search_name) && ($this->session->userdata('sess_search_name') == null))
         $this->session->set_userdata('sess_search_name',$search_name);
        $sess_search_name=$this->session->userdata('sess_search_name');
        $search['search_name']=($search_name !='')?$search_name:$sess_search_name;
        $search['overdue']=null;
        $search['delivery_due_date']=1;
        $orders=json_decode($this->Vendor_model->get_all_open_orders($search));
        $total_rows=$orders->num_rows;
        $base_url = base_url()."vendor/search-orders-due-for-delivery-by-due-date/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['ordersdata']=$this->Vendor_model->get_all_open_orders($search,$config["per_page"],$page,1);
       
        $this->data['search']=$search;
        // echo "<pre>";
        // print_r($this->data['search']);exit;
        $this->load->view('vendor/orders_due_for_delivery_by_due_date',$this->data);

    }

    public function viewOrderDetails(){
         $order_id= base64_decode($this->uri->segment(3,0));
         $order_user=json_decode($this->Orders_model->commonGetAll('ga_orders_tbl',array('orderid'=>$order_id)));
          $user_id=$order_user->result[0]->userid;
         $newChek = array('user_id'=>$user_id,'order_id'=>$order_id);
          $this->data['sharecart_result']= $this->Orders_model->ordercheckoutResult($newChek);
          $where=array('trash'=>0,'orderid'=> $order_id);
            $this->data['ordersdata']=$this->Orders_model->vendor_order_details($order_id);
            $orderdata=array('order_id'=>$order_id);
            $this->data['cartList']=  $this->Orders_model->ordercartList($orderdata);
        $this->load->view('vendor/orders_view',$this->data);
    }

///////////////// Vendor All Open Orders code start here ////////////////

/////////////// Shipper management code start here //////////////////////
    public function add_shipper(){
      $this->form_validation->set_rules('shipper_code', 'Shipper Code', 'trim|required|is_unique[ga_shippers_table.shipper_code]',array('is_unique'=>'Shipper Code already exists,try other'));
            $this->form_validation->set_rules('shipper_name', 'Shipper Name', 'trim|required');
            $this->form_validation->set_rules('mobile', 'Mobile No', 'required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('email', 'Email', 'valid_email|is_unique[ga_shippers_table.email]',array('is_unique'=>'Email already exists,try other'));
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
         if ($this->form_validation->run() == false) {
                $this->load->view('vendor/add_shipper');
            }
            else{
                $shipperEmail=$this->input->post('email');
                $temp_password= 'shoperative'.rand(100000,999999);
                $verificationcode=sha1('ShoperativeShipper'.rand(100,999));
                $shipper_data = array(
                    'vendor_id' => $this->vendor_id,
                    'shipper_code' =>$this->input->post('shipper_code'),
                     'shipper_name' => ucfirst($this->input->post('shipper_name')) ,
                     'mobile' =>$this->input->post('mobile') ,
                     'email' =>$shipperEmail,
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
                
                    $insert=$this->Crud->commonInsert('ga_shippers_table',$shipper_data);
                    $insert_decode = json_decode($insert);
                    if($insert_decode->code == SUCCESS_CODE)
                    {
                            $shipper_data['subject']='Shipper Registration';
                            $shipper_data['temp_password']=$temp_password;
                            $shipper_data['link']=base_url().'shipper/verification/'.$verificationcode;
                             
                            // sending email for login credetials
                                $mail_array = $this->sendmail->sendEmail(
                                    array(
                                        'to' =>array($shipperEmail),
                                        'cc' => array('info@' . SITE_DOMAIN),
                                        'bcc' => array(BCC_EMAIL),
                                        'subject' => 'Shipper Registration Successfully Done!',
                                        'data' => array('email_content'=>$shipper_data),
                                        'template' => EMAIL_TEMPLATE_FOLDER.'verification_shipper',
                                    )
                                );
                        
                            // email code end
                                if($mail_array['code']==1){
                                    $this->session->set_flashdata('success', 'Data Inserted successfully & verification link sent to shipper');
                                }else{
                                    $this->session->set_flashdata('failed', 'Data Inserted successfully but unabled to send verification mail');
                                }
                             
                            redirect('vendor/manage-shippers'); 
                    }
                   
                    else
                    {
                        echo "<script>alert('Problem occured while saving data..Please try again')</script>";
                    }
                 }
    }
    public function manage_shippers(){
        if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search['search_name']=$this->input->post('search_name');
        $shippers=json_decode($this->Vendor_model->get_all_shippers($search));
        $total_rows=$shippers->num_rows;
        $base_url = base_url()."vendor/manage-shippers/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['shippersdata']=$this->Vendor_model->get_all_shippers($search,$config["per_page"],$page);
        $this->data['search']=$search;
        $this->load->view('vendor/manage_shippers',$this->data);

    }
    public function search_shippers(){
        if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search_name=($this->input->post('search_name') !=null)?$this->input->post('search_name'):'';
        $sess_search_name='';
        $sess_search_name=$this->session->userdata('sess_search_shipper');
        if($search_name=='' && !empty($sess_search_name) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_search_shipper');
        if(!empty($search_name) && ($this->session->userdata('sess_search_shipper') == null))
         $this->session->set_userdata('sess_search_shipper',$search_name);
        $sess_search_name=$this->session->userdata('sess_search_shipper');
        $search['search_name']=($search_name !='')?$search_name:$sess_search_name;
        $shippers=json_decode($this->Vendor_model->get_all_shippers($search));
        $total_rows=$shippers->num_rows;
        $base_url = base_url()."vendor/search-shippers/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['shippersdata']=$this->Vendor_model->get_all_shippers($search,$config["per_page"],$page);
        $this->data['search']=$search;
        $this->load->view('vendor/manage_shippers',$this->data);

    }
    public function edit_shipper(){
      if(!isset($this->vendor_id) && empty($this->vendor_id)){
        redirect('vendor/login'); 
      }
      $shipper_id=$this->uri->segment(3,0);
      if($shipper_id){
        $shipper_id=base64_decode($shipper_id);
        $this->data['shipper_details'] = $this->Vendor_model->update_shipper($shipper_id);
        $this->load->view('vendor/edit_shipper',$this->data);
      }else{
        redirect('vendor/manage-shippers'); 
      }
    }
    public function shipperUpdating(){
       $update_data = array(
                    'shipper_code' =>$this->input->post('shipper_code'),
                     'shipper_name' => ucfirst($this->input->post('shipper_name')) ,
                     'email' => $this->input->post('email'),
                     'mobile' =>$this->input->post('mobile'),
                     'plot' =>$this->input->post('plot'),
                     'street' =>$this->input->post('street'),
                     'area' =>$this->input->post('area'),
                     'city' =>ucfirst($this->input->post('city')),
                     'state' =>ucfirst($this->input->post('state')),
                     'pincode' =>$this->input->post('pincode'),
                     'website' =>$this->input->post('website'),
                     'gst' =>$this->input->post('gst'),
                     'pan' =>$this->input->post('pan'),
                     'tds' =>$this->input->post('tds')
                     );
         $update_where = array('shipper_id'=>$this->input->post('shipper_id'));
         $check_email_exist=$this->Crud->commonCheck('email','ga_shippers_table',['email'=>$this->input->post('email'),'shipper_id !='=>$this->input->post('shipper_id')]);
         if($check_email_exist){
                $this->session->set_flashdata('Failed','Email was already existed, try other');
                redirect($_SERVER['HTTP_REFERER']);
         }
         $update = $this->Vendor_model->update_data('ga_shippers_table', $update_data, $update_where);
         if($update){ 
          $this->session->set_flashdata('Success','Data Updated successfully!');
        }else{
            $this->session->set_flashdata('Failed','Data not modified');
            }
            redirect($_SERVER['HTTP_REFERER']);
    }
//////////////// Assinging orders to shipper /////////////////////
    public function assignOrdersToShipper(){
      if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $this->data['shippers'] = $this->Vendor_model->get_shippers($this->vendor_id);
        $this->data['power_users'] = $this->Vendor_model->get_power_users();
        $this->data['orders'] = $this->Vendor_model->non_assigned_orders();
        $this->load->view('vendor/assignOrdersToShipper',$this->data);
    }
    public function assignOrdersToShipperAjax($pageno=0){
        $response=array();
        $search=array();
        $search['order']=$this->input->post('order');
        $search['power_user']=$this->input->post('power_user');
        $search['due_date']=$this->input->post('due_date');
        $orders= json_decode($this->Vendor_model->non_assigned_orders($search));
        $total_rows=count($orders->result);
        $base_url = base_url().'vendor/assign-orders-to-shipper/';
        $per_page = PER_PAGE;
        if($pageno > 0){
              $si= $per_page * ($pageno-1);
         }else{$si=0;}
        $config = $this->paginate->pagination($base_url,$total_rows,$per_page);
        $this->load->library('pagination');
        $config['use_page_numbers']=TRUE;
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $order_list = json_decode($this->Vendor_model->non_assigned_orders($search,$per_page,$si));
        $html="";
        if($order_list->code==200){
          foreach ($order_list->result as $order) {
            $html .= '<tr class=""><td><input type="checkbox" class="inline-checkbox checkSingle" name="na_order_id[]" value="'.$order->orderid.'"></td>';
            $html .= '<td><a href="'.base_url().'vendor/order-details/'.base64_encode($order->orderid).'">'.$order->ordernumber.'</a></td>';
            $html .= '<td>'.ucwords($order->power_user_name).'</td>';
            $html .= '<td>'.date("d-M-Y ", strtotime($order->delivery_due_date)).'</td>';
            $html .= '<td>'.$order->ordertotalitems.'</td>';
            $html .= '<td>'.$order->orderqty.'</td>';
            $html .= '<td>'.$order->totalpayableprice.'</td>';
            $html .= '<td>'.$order->city.'</td>';
            $html .= '<td>'.$order->pincode.'</td>';
            $html .= '</tr>';                      
          }
        }
        $response['html']=$html;
        $msg=' Orders Found';
        if($total_rows ==1){$msg=' Order Found';}
        $response['total_rows']=($total_rows > 0)?$total_rows.$msg:'';
        $response['pagination']=$links;
  //       print_r($response);exit;
        echo json_encode($response);
        
}
public function assignedShipperOrdersAjax($pageno=0){
        $response=array();
        $search=array();
        $shipper=$this->input->post('shipper');
        $search['order']=$this->input->post('order');
        $search['power_user']=$this->input->post('power_user');
        $search['due_date']=$this->input->post('due_date');
        $orders= json_decode($this->Vendor_model->shipper_orders($shipper,$search));
        $total_rows=count($orders->result);
        $base_url = base_url().'vendor/assign-orders-to-shipper/';
        $per_page = PER_PAGE;
        if($pageno > 0){
             $si= ($pageno - 1) * $per_page;
         }else{$si=0;}
        $config = $this->paginate->pagination($base_url,$total_rows,$per_page);
        $this->load->library('pagination');
        $config['use_page_numbers']=TRUE;
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $order_list = json_decode($this->Vendor_model->shipper_orders($shipper,$search,$per_page,$si));
        $html="";
        if($order_list->code==200){
          foreach ($order_list->result as $order) {
            $html .= '<tr class=""><td><input type="checkbox" class="inline-checkbox checkSingle" name="order_id[]" value="'.$order->orderid.'"></td>';
            $html .= '<td><a href="'.base_url().'vendor/order-details/'.base64_encode($order->orderid).'">'.$order->ordernumber.'</a></td>';
            $html .= '<td>'.ucwords($order->power_user_name).'</td>';
            $html .= '<td>'.date("d-M-Y ", strtotime($order->delivery_due_date)).'</td>';
            $html .= '<td>'.$order->ordertotalitems.'</td>';
            $html .= '<td>'.$order->orderqty.'</td>';
            $html .= '<td>'.$order->totalpayableprice.'</td>';
            $html .= '<td>'.$order->city.'</td>';
            $html .= '<td>'.$order->pincode.'</td>';
            $html .= '</tr>';                      
          }
        }
        $response['html']=$html;
        $msg=' Orders Found';
        if($total_rows ==1){$msg=' Order Found';}
        $response['total_rows']=($total_rows > 0)?$total_rows.$msg:'';
        $response['pagination']=$links;
  //       print_r($response);exit;
        echo json_encode($response);
        
}
public function shipperOrdersUpdate(){
  $response=array();
      $update_count=0;
        $shipper = $this->input->post('shipper');
        $orders=$this->input->post('orders');
        $table='ga_orders_tbl';
        $setcolumns='shipper_id';
        $updatevalue=$shipper;
        $wherecondition="orderid  IN  (" .$orders. ")";
        $vendor_id=$this->vendor_id;
        if($shipper !='' && $orders!=''){
          $update_vendor = $this->Vendor_model->shipperOrdersUpdate($table, 'vendor_id', $vendor_id, $wherecondition);
          $update_shipper = $this->Vendor_model->shipperOrdersUpdate($table, $setcolumns, $updatevalue, $wherecondition);
            echo $update_shipper;exit;
        }
  }

  public function multipleOrdersRemoveFromShipper(){
      $update_count=0;
      $shipper=$this->input->post('shipper_id');
        $order=array_filter($this->input->post('order_id'));
        $count=count($order);
        if($count > 0){
          for ($i=0; $i < $count; $i++) { 
            $where=array('orderid'=> $order[$i],'shipper_id'=>$shipper);
            $update_data=array('shipper_id'=>0);
            $update_order = $this->Vendor_model->update_data('ga_orders_tbl',$update_data,$where);
            if($update_order){$update_count+=1;}
          }
        }
        if($update_count > 0){
          if($update_count==1){$msg=$update_count.' Order removed successfully!';}
          else{$msg=$update_count.' Orders removed successfully!';}
                $this->session->set_flashdata('Success',$msg);
        }else{
              $this->session->set_flashdata('Failed','Please select from list');
            }
        redirect('vendor/assign-orders-to-shipper');
        }

//////////////// Shipper management code end here ///////////////////////
  //////////////// Shipping cost code start here ///////////////////////
    public function add_shipping_cost(){
      if(!isset($this->vendor_id) && empty($this->vendor_id)){
        redirect('vendor/login'); 
      }
        $this->data['shippers'] = $this->Vendor_model->get_shippers($this->vendor_id);
            $this->form_validation->set_rules('shipper', 'Shipper', 'required');
            $this->form_validation->set_rules('distance_range_from', 'Distance Range From', 'required');
            $this->form_validation->set_rules('distance_range_to', 'Distance Range To', 'required');
            $this->form_validation->set_rules('cost_per_kg', 'Cost Per KG', 'required');
            $this->form_validation->set_rules('std_delivery_days_from_order_date', 'Standard Delivery Days From Order Date', 'required');
            if($this->form_validation->run()==false){
              $this->load->view('vendor/add_shipping_cost',$this->data);
            }else{
              $insert_data=array(
                      'vendor_id' => $this->vendor_id,
                      'shipper_id' => $this->input->post('shipper'),
                      'distance_range_from' => $this->input->post('distance_range_from'),
                      'distance_range_to' => $this->input->post('distance_range_to'),
                      'cost_per_kg' => $this->input->post('cost_per_kg'),
                      'std_delivery_days_from_order_date' => $this->input->post('std_delivery_days_from_order_date'),
                      'special_conditions' => $this->input->post('special_conditions'),
                      'created_on' => DATE,
                      'status' => 1
              );
              $successmsg = 'Data Submitted Successfully!';
              $insert = json_decode($this->Crud->commonInsert('ga_shipping_cost_tbl',$insert_data,$successmsg));
              if($insert->code==SUCCESS_CODE){
                $this->session->set_flashdata('success', $successmsg);
              }else{
                $this->session->set_flashdata('failed', 'Something went wrong, please try again');
              }
             redirect('vendor/manage-shipping-cost'); 
            }
        
    }
     public function manage_shipping_cost(){
        if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search['search_name']=$this->input->post('search_name');
        $shipping_cost=json_decode($this->Vendor_model->get_all_shipping_cost($search));
        $total_rows=$shipping_cost->num_rows;
        $base_url = base_url()."vendor/manage-shipping-cost/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['shippingcostdata']=$this->Vendor_model->get_all_shipping_cost($search,$config["per_page"],$page);
        $this->data['search']=$search;
        $this->load->view('vendor/manage_shipping_cost',$this->data);
    }
     public function search_shipping_cost(){
        if(!isset($this->vendor_id) && empty($this->vendor_id)){
          redirect('vendor/login'); 
        }
        $config = array();
        $search_name=($this->input->post('search_name') !=null)?$this->input->post('search_name'):'';
        $sess_search_name='';
        $sess_search_name=$this->session->userdata('sess_search_scost');
        if($search_name=='' && !empty($sess_search_name) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_search_scost');
        if(!empty($search_name) && ($this->session->userdata('sess_search_scost') == null))
         $this->session->set_userdata('sess_search_scost',$search_name);
        $sess_search_name=$this->session->userdata('sess_search_scost');
        $search['search_name']=($search_name !='')?$search_name:$sess_search_name;
        $shipping_cost=json_decode($this->Vendor_model->get_all_shipping_cost($search));
        $total_rows=$shipping_cost->num_rows;
        $base_url = base_url()."vendor/search-shipping-cost/";
        $per_page = PER_PAGE;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['shippingcostdata']=$this->Vendor_model->get_all_shipping_cost($search,$config["per_page"],$page);
        $this->data['search']=$search;
        $this->load->view('vendor/manage_shipping_cost',$this->data);
    }
    public function edit_shipping_cost(){
      if(!isset($this->vendor_id) && empty($this->vendor_id)){
        redirect('vendor/login'); 
      }
      $shipping_cost_id=$this->uri->segment(3,0);
      if($shipping_cost_id){
        $shipping_cost_id=base64_decode($shipping_cost_id);
        $this->data['shippers'] = $this->Vendor_model->get_shippers($this->vendor_id);
        $this->data['shipping_cost'] = $this->Vendor_model->update_shipping_cost($shipping_cost_id);
        $this->load->view('vendor/edit_shipping_cost',$this->data);
      }else{
        redirect('vendor/manage-shipping-cost'); 
      }
    }
    public function shippingCostUpdating(){
       $update_data=array(
                      'shipper_id' => $this->input->post('shipper'),
                      'distance_range_from' => $this->input->post('distance_range_from'),
                      'distance_range_to' => $this->input->post('distance_range_to'),
                      'cost_per_kg' => $this->input->post('cost_per_kg'),
                      'std_delivery_days_from_order_date' => $this->input->post('std_delivery_days_from_order_date'),
                      'special_conditions' => $this->input->post('special_conditions')
              );
         $update_where = array('shipping_cost_id'=>$this->input->post('shipping_cost_id'));
         $update = $this->Vendor_model->update_data('ga_shipping_cost_tbl', $update_data, $update_where);
         if($update){ 
          $this->session->set_flashdata('Success','Data Updated successfully!');
        }else{
            $this->session->set_flashdata('Failed','Data not modified');
            }
        redirect($_SERVER['HTTP_REFERER']);
    }
  //////////////// Shipping cost code end here ///////////////////////
///////////////// Vendor Shipping dashboard code end here ////////////////
      /* code for getting submneu list based on menu starts here */

    public function submenuWithMenu() {
        $submenu_data = '<option value="">--Choose Sub Category-- </option>';
        $menu_id = $this->input->post('menu');
        if (num_check($menu_id)) {
            $submenu_qry = $this->Vendor_model->subMenu(array('menu_id' => $menu_id));
            $request = json_decode($submenu_qry);
            if ($request->code == SUCCESS_CODE) {
                foreach ($request->submenu_result as $response) {
                    $submenu_data .= '<option value="' . $response->id . '">' . $response->title . '</option>';
                }
            } else {
                $submenu_data .= '<option value="">Sub Category not found</option>';
            }
        } else {
            $submenu_data .= '<option value="">Sub Category not found</option>';
        }
        echo $submenu_data;
    }

    /* code for getting submneu list based on menu ends here */
    
    /* code for getting submenu list based on submenu starts here */

    public function listSubMenuWithMenu() {
        $data = '<option value="">--Choose Listsub Category--</option>';
        $submenu_id = $this->input->post('submenu');
        if (num_check($submenu_id)) {
            $listsubmenu_qry = $this->Vendor_model->listSubMenu(array('submenu_id' => $submenu_id));
            $request = json_decode($listsubmenu_qry);
            if ($request->code == SUCCESS_CODE) {
                foreach ($request->listsubmenu_result as $response) {
                    $data .= '<option value="' . $response->id . '">' . $response->title . '</option>';
                }
            } else {
                $data .= '<option value="">Listsub Category not found</option>';
            }
        } else {
            $data .= '<option value="">Listsub Category not found</option>';
        }
        echo $data;
    }

    /* code for getting submenu list based on submenu endsf here */


  public function paginate($base_url,$total_rows,$per_page,$uri_segment){
        $config["base_url"] = $base_url;
        $config["total_rows"] = $total_rows;
        $config["per_page"] = $per_page;
        $config["uri_segment"] = $uri_segment;
        $config['full_tag_open'] = '<ul class="pagination">';        
        $config['full_tag_close'] = '</ul>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li>';        
        $config['first_tag_close'] = '</li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="prev">';        
        $config['prev_tag_close'] = '</li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li>';        
        $config['next_tag_close'] = '</li>';        
        $config['last_tag_open'] = '<li>';        
        $config['last_tag_close'] = '</li>';        
        $config['cur_tag_open'] = '<li class="active"><a href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li>';        
        $config['num_tag_close'] = '</li>';
        return $config;
  } 
	public function logout() {
        $this->session->unset_userdata('vendor_id');
        $this->session->unset_userdata('vendor_name');
        $this->session->unset_userdata('vendor_email');
       redirect(base_url().'vendor/login');
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
            case 'shipper':   // need to refer name for table name
              $table='ga_shippers_table';   // table name 
              $setcolumns='shipper_status';
              $updatevalue=$activity;
              $wherecondition="shipper_id  IN  (" .$updatelist. ")";
              break;
            case 'shipping_cost':   // need to refer name for table name
              $table='ga_shipping_cost_tbl';   // table name 
              $setcolumns='status';
              $updatevalue=$activity;
              $wherecondition="shipping_cost_id  IN  (" .$updatelist. ")";
              break;
            case 'product':   // need to refer name for table name
              $table='ga_main_prod_details_tbl';   // table name 
              $setcolumns='active_status';
              $updatevalue=$activity;
              $wherecondition="id  IN  (" .$updatelist. ")";
              break;
            case 'productprice':   // need to refer name for table name
              $table='ga_prod_item_pricing_tbl';   // table name 
              $setcolumns='item_status';
              $updatevalue=$activity;
              $wherecondition="id  IN  (" .$updatelist. ")";
              break;
            case 'productgroupprice':   // need to refer name for table name
              $table='ga_prod_group_pricing_tbl';   // table name 
              $setcolumns='active_status';
              $updatevalue=$activity;
              $wherecondition="id  IN  (" .$updatelist. ")";
              break;
            case 'feature':   // need to refer name for table name
              $table='ga_main_prod_details_tbl';   // table name 
              $setcolumns='feature_product';
              $updatevalue=$activity;
              $wherecondition="id  IN  (" .$updatelist. ")";
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
            case 'shipper':
                $table = 'ga_shippers_table';
                $wherecondition = "shipper_id IN  (" . $updatelist . ")";
                break;
            case 'shipping_cost':
                $table = 'ga_shipping_cost_tbl';
                $wherecondition = "shipping_cost_id IN  (" . $updatelist . ")";
                break;
            case 'product':
              $table='ga_main_prod_details_tbl';
              $wherecondition="id  IN  (" .$updatelist. ")";
              break;
            case 'productprice':
              $table='ga_prod_item_pricing_tbl';
              $wherecondition="id  IN  (" .$updatelist. ")";
              break;
            case 'productgroupprice':
              $table='ga_prod_group_pricing_tbl';
              $wherecondition="id  IN  (" .$updatelist. ")";
              break;
            }
            $delete = $this->Crud->commonDelete($table,$wherecondition,$relationname);
            echo $delete;
            exit;
        }
        echo json_encode($response);
    } 

  
    public function compress_image($source_url, $destination_url, $quality){
         $info = getimagesize($source_url);
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source_url);

        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source_url);

        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/jpg')
            $image = imagecreatefromjpg($source_url);
        // elseif ($info['mime'] == 'image/tiff')
        //     $image = imagecreatefromtiff($source_url);
        elseif ($info['mime'] == 'image/JPG')
            $image = imagecreatefromjpg($source_url);
        elseif ($info['mime'] == 'image/PNG')
            $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/GIF')
            $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/JPEG')
            $image = imagecreatefromjpeg($source_url);
        // elseif ($info['mime'] == 'image/TIFF')
        //     $image = imagecreatefromtiff($source_url);

        imagejpeg($image, $destination_url, $quality);
        return $destination_url;
    }
    public function getFileExtensions($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }     
    // public function updateorder(){
    //   $orders=$this->db->select('orderid,DATE(orderdate) as date')->from('ga_orders_tbl')->get()->result();
    //   $count=0;
    //   foreach ($orders as $o) {
    //     $date=date('d-m-Y',strtotime($o->date));
    //     $new_date=date('Y-m-d',strtotime($date.'+2 days'));
    //     $update=json_decode($this->Crud->commonUpdate('ga_orders_tbl',['delivery_due_date'=>$new_date],['orderid'=>$o->orderid]));
    //     if($update->code==200){$count=$count+1;}
    //   }
    //   echo $count;
    // }    
}

