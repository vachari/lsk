<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Shipper extends CI_Controller {	
		public $user_id,$vendor_id,$shipper_id,$shipper_name,$shipper_email,$ipaddress,$data;
		public function __construct(){
			parent::__construct();
			$this->data=array();
			$this->user_id = $this->session->userdata('user_id');
	        if(!empty($this->user_id)){
	        	redirect(base_url());
	        }
      $this->vendor_id = $this->session->userdata('vendor_id');
            if(!empty($this->vendor_id)){
                redirect(base_url().'vendor/dashboard');
            } 
			 //load models here
	        $this->load->model(array('Pages_model','Orders_model','Vendor_model','Shipper_model'));
	        //helper loads here for xss_clean
	        $this->load->helper('security');
          $this->load->library('pagination');
	        // accessing the session data form the Userdata 
	        $this->shipper_id = $this->session->userdata('shipper_id');
	        $this->shipper_name = $this->session->userdata('shipper_name');
	        $this->shipper_email = $this->session->userdata('shipper_email');
	        $this->ipaddress = $_SERVER['REMOTE_ADDR'];
		}

///////////////// Shipper Accessing code start here /////////////////////

		public function index(){
	        if(isset($this->shipper_id) && !empty($this->shipper_id)){
				redirect('shipper/dashboard');	
			}else{
				redirect('shipper/login');
			}
		}
		public function dashboard(){
			if(!isset($this->shipper_id) && empty($this->shipper_id)){
				redirect('shipper/login');	
			}
			$this->load->view('shipper/dashboard');
		}
		public function login(){
			if(isset($this->shipper_id) && !empty($this->shipper_id)){
				redirect('shipper/dashboard');	
			}
			$this->load->view('shipper/login');
		}
		public function logging_in(){
		        $this->form_validation->set_rules('login_email','Email','required|valid_email',array('required'=>'Please enter email'));
		        $this->form_validation->set_rules('login_password','Password','required|min_length[6]|max_length[20]',array('required'=>'Please enter password'));
		        if($this->form_validation->run()==false){ 
	    			$this->load->view('shipper/login');
		        }
		        else{
		        	$email=$this->input->post('login_email');
		        	$password=$this->input->post('login_password');
		        	
		            $where=array(
		                                'email'=>$email,
		                                'password'=>md5($password)
		                );

		            $result=$this->Pages_model->can_shipperlogin($where);
		            $login_data=json_decode($result);
		            $row=$login_data->common_result;
		            if($login_data->code==SUCCESS_CODE){
		            	$email_verified=$row->verify_email;
			        	if($email_verified==0){
			        		$this->session->set_flashdata('failed','Email not verified, please check your mail');
			                 redirect('shipper/login');
			        	}
		                $session_data=array(
		                                    'shipper_id'=>$row->shipper_id,
		                                    'shipper_name'=>$row->shipper_name,
		                                    'shipper_email'=>$row->email
		                                    );
		                $this->session->set_userdata($session_data);
		                $check_verified_code=$this->Crud->checkAndReturn('verificationcode','ga_shippers_table',$where);
		                if($check_verified_code!=''){
		                	$this->session->set_flashdata('success','Successfully Logged in. Please change your password');
		                	redirect('shipper/change-password');
		                }else{
		                	$this->session->set_flashdata('success','Successfully Logged in.');
		                	redirect('shipper/dashboard');
		                }
		                
		            }else{
		               
		                $this->session->set_flashdata('failed','Invalid login credentials');
		                 redirect('shipper/login');
		                 
		                }
		        }
		    
    }
		 public function verification(){
	        $verificationcode = $this->uri->segment(3,0);
	        $where = array('verificationcode'=>$verificationcode);
	        $existcheck = $this->Crud->commonCheck('shipper_id','ga_shippers_table',$where);
	        if($existcheck==1){
                $check_email_verify=$this->Crud->checkAndReturn('verify_email','ga_shippers_table',$where);
                if($check_email_verify==0){
    	            $update_data=array('verify_email'=>1);
    	            $update = json_decode($this->Crud->commonUpdate('ga_shippers_table', $update_data, $where)); 
    	            if($update->code==200){
    	                redirect('shipper/login');
    	            }else{
    	            	redirect(base_url());
    	            }
                }else{
                    redirect('shipper/login');
                }
		    }else{
		      $this->session->set_flashdata('failed','You are not authorize user.');
		      redirect(base_url().'register');
		    }
	    }
///////////////// Shipper Accessing code end here /////////////////////

///////////////// Shipper Change password code start here /////////////////////
	   public function changePassword(){
			if(!empty($this->shipper_id)){
				$this->load->view('shipper/changePassword');
			}else{
				redirect('shipper/login');
			}
		}
	public function changging_password(){
             $this->form_validation->set_rules('old_password','Old password','required|trim|min_length[5]');
            $this->form_validation->set_rules('new_password','New password','required|trim');
            $this->form_validation->set_rules('confirm_password','Confirm password','required|trim|matches[new_password]');
            if($this->form_validation->run() == false){
                $this->load->view('shipper/changePassword');
            }
            else{
                $old_password=$this->input->post('old_password');
                $new_password=$this->input->post('new_password');
                $confirm_password=$this->input->post('confirm_password');

                $cols=array('password');
                $wherecondition=array('password'=>md5($old_password),'shipper_id'=>$this->shipper_id);
                $common_check=$this->Crud->commonCheck($cols,'ga_shippers_table', $wherecondition);
                if($common_check ==1){
                        
                    if($new_password == $confirm_password){
                        $update_data=array('password'=>md5($new_password));

                        $update_condition=array('shipper_id'=>$this->shipper_id);
                        
            $update=$this->Crud->commonUpdate('ga_shippers_table',$update_data,$update_condition);
                             $update=json_decode($update);

                            if($update->code == SUCCESS_CODE){
                            	$check_verified_code=$this->Crud->checkAndReturn('verificationcode','ga_shippers_table',$update_condition);
				                if($check_verified_code!=''){
				                	$update=$this->Crud->commonUpdate('ga_shippers_table',['verificationcode'=>''],$update_condition);
				                }
                                $this->session->set_flashdata('success', 'Password has been changed successfully!');
                            }
                            else{
                                $this->session->set_flashdata('failed', 'Oops! Unabled to change password');    
                            }
                            redirect('shipper/change-password');
                    }
                }
            }
    }
///////////////// Shipper Change password code end here /////////////////////

///////////////// Shipper Profile code start here /////////////////////
    public function profile(){
    	if(!isset($this->shipper_id) && empty($this->shipper_id)){
				redirect('shipper/login');	
			}
      $this->data['shipper_details'] = $this->Shipper_model->update_shipper($this->shipper_id);
    	$this->load->view('shipper/profile',$this->data);
    }
    public function profileUpdate(){
    	if(!isset($this->shipper_id) && empty($this->shipper_id)){
        redirect('shipper/login');  
      }
      $this->data['shipper_details'] = $this->Shipper_model->update_shipper($this->shipper_id);
    	$this->load->view('shipper/profileUpdate',$this->data);
    }
    public function profileUpdating(){
       $update_count=0;
       $update_data = array(
                    'shipper_code' =>$this->input->post('shipper_code'),
                     'shipper_name' => ucfirst($this->input->post('shipper_name')) ,
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
         $update_where = array('shipper_id'=>$this->input->post('shipper_id'));
         $check_email_exist=$this->Crud->commonCheck('email','ga_shippers_table',['email'=>$this->input->post('email'),'shipper_id !='=>$this->input->post('shipper_id')]);
         if($check_email_exist){
                $this->session->set_flashdata('Failed','Email was already existed, try other');
                redirect($_SERVER['HTTP_REFERER']);
         }
         $update = $this->Shipper_model->update_data('ga_shippers_table', $update_data, $update_where);
         if($update){
          $this->session->set_flashdata('Success','Data Updated successfully!');
         }
        else{
            $this->session->set_flashdata('Failed','Data not modified');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

///////////////// Shipper Profile code end here /////////////////////

///////////////// Shipper Forgot Password code start here /////////////////////
    public function forgotPassword(){
        if(isset($this->shipper_id) && !empty($this->shipper_id)){
                redirect('shipper/dashboard');   
            }

        $this->load->view('shipper/forgotPassword');    
    }
    public function sendingResetPasswordLink(){
        $this->form_validation->set_rules('email','Email','required|valid_email',array('required'=>'Please enter email','valid_email'=>'Please enter valid email'));
        if($this->form_validation->run()==false){ 
            $this->load->view('shipper/forgotPassword');
        }
        else{
            $email=$this->input->post('email');
            $check_email=$this->Crud->commonCheck('email','ga_shippers_table',['email'=>$email]);
            $shipper_data=array();
            $verificationcode=sha1('ShoperativeShipper'.rand(100,999));
            if($check_email){
                $update_shipper=json_decode($this->Crud->commonUpdate('ga_shippers_table',['verificationcode'=>$verificationcode],['email'=>$email]));
                if($update_shipper->code==200){
                    $shipper_data['subject']='Reset Password';
                    $shipper_data['email']=$email;
                    $shipper_data['link']=base_url().'shipper/reset-password/'.$verificationcode;
                    // sending email for reset password
                    $mail_array = $this->sendmail->sendEmail(
                                        array(
                                            'to' =>array($email),
                                            'cc' => array('info@' . SITE_DOMAIN),
                                            'bcc' => array(BCC_EMAIL),
                                            'subject' => 'Reset Password',
                                            'data' => array('email_content'=>$shipper_data),
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
         redirect('shipper/forgot-password'); 
        }
    }
    public function resetPassword(){
        if(isset($this->shipper_id) && !empty($this->shipper_id)){
                redirect('shipper/dashboard');   
            }

        $this->load->view('shipper/resetPassword');    
    }
    public function resettingPassword(){
            $this->form_validation->set_rules('new_password','New password','required|trim|min_length[6]|max_length[20]');
            $this->form_validation->set_rules('confirm_password','Confirm password','required|trim|matches[new_password]');
            if($this->form_validation->run() == false){
                $this->load->view('shipper/resetPassword');
            }
            else{
                $verificationcode=$this->input->post('verificationcode');
                $new_password=$this->input->post('new_password');
                $confirm_password=$this->input->post('confirm_password');

                $cols=array('password');
                $wherecondition=array('verificationcode'=>$verificationcode);
                $common_check=$this->Crud->commonCheck($cols,'ga_shippers_table', $wherecondition);
                if($common_check ==1){
                    $update_data=array('password'=>md5($new_password),'verificationcode'=>'','verify_email'=>1);
                    $update=$this->Crud->commonUpdate('ga_shippers_table',$update_data,$wherecondition);
                    $update=json_decode($update);
                            if($update->code == SUCCESS_CODE){
                                $this->session->set_flashdata('success', 'Password has been reset successfully!');
                                redirect('shipper/login');
                            }
                            else{
                                $this->session->set_flashdata('failed', 'Oops! Unabled to reset password');  
                                redirect('shipper/reset-password/'.$verificationcode);  
                            }
                }else{
                    $this->session->set_flashdata('failed', 'Oops! Unabled to reset password');  
                    redirect('shipper/forgot-password');  
                }
            }
    }
///////////////// shipper Forgot Password code end here /////////////////////
 //////////////// Shipping cost code start here ///////////////////////
public function manage_shipping_cost(){
        if(!isset($this->shipper_id) && empty($this->shipper_id)){
          redirect('shipper/login'); 
        }
        $config = array();
        $search['search_name']=$this->input->post('search_name');
        $shipping_cost=json_decode($this->Shipper_model->get_all_shipping_cost($search));
        $total_rows=$shipping_cost->num_rows;
        $base_url = base_url()."shipper/manage-shipping-cost/";
        $per_page = 20;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['shippingcostdata']=$this->Shipper_model->get_all_shipping_cost($search,$config["per_page"],$page);
        $this->data['search']=$search;
        $this->load->view('shipper/manage_shipping_cost',$this->data);
    }
     public function search_shipping_cost(){
        if(!isset($this->shipper_id) && empty($this->shipper_id)){
          redirect('shipper/login'); 
        }
        $config = array();
        $search_name=($this->input->post('search_name') !=null)?$this->input->post('search_name'):'';
        $sess_search_name='';
        $sess_search_name=$this->session->userdata('sess_search_name');
        if($search_name=='' && !empty($sess_search_name) && isset($_POST['search_btn']))
          $this->session->unset_userdata('sess_search_name');
        if(!empty($search_name) && ($this->session->userdata('sess_search_name') == null))
         $this->session->set_userdata('sess_search_name',$search_name);
        $sess_search_name=$this->session->userdata('sess_search_name');
        $search['search_name']=($search_name !='')?$search_name:$sess_search_name;
        $shipping_cost=json_decode($this->Shipper_model->get_all_shipping_cost($search));
        $total_rows=$shipping_cost->num_rows;
        $base_url = base_url()."shipper/search-shipping-cost/";
        $per_page = 20;
        $uri_segment = 3;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['shippingcostdata']=$this->Shipper_model->get_all_shipping_cost($search,$config["per_page"],$page);
        $this->data['search']=$search;
        $this->load->view('shipper/manage_shipping_cost',$this->data);
    }
    public function edit_shipping_cost(){
      if(!isset($this->shipper_id) && empty($this->shipper_id)){
        redirect('shipper/login'); 
      }
      $shipping_cost_id=$this->uri->segment(3,0);
      if($shipping_cost_id){
        $shipping_cost_id=base64_decode($shipping_cost_id);
        $this->data['shipping_cost'] = $this->Shipper_model->update_shipping_cost($shipping_cost_id);
        $this->load->view('shipper/edit_shipping_cost',$this->data);
      }else{
        redirect('shipper/manage-shipping-cost'); 
      }
    }
    public function shippingCostUpdating(){
       $update_data=array(
                      'distance_range_from' => $this->input->post('distance_range_from'),
                      'distance_range_to' => $this->input->post('distance_range_to'),
                      'cost_per_kg' => $this->input->post('cost_per_kg'),
                      'std_delivery_days_from_order_date' => $this->input->post('std_delivery_days_from_order_date'),
                      'special_conditions' => $this->input->post('special_conditions')
              );
         $update_where = array('shipping_cost_id'=>$this->input->post('shipping_cost_id'));
         $update = $this->Shipper_model->update_data('ga_shipping_cost_tbl', $update_data, $update_where);
         if($update){ 
          $this->session->set_flashdata('Success','Data Updated successfully!');
        }else{
            $this->session->set_flashdata('Failed','Data not modified');
            }
        redirect($_SERVER['HTTP_REFERER']);
    }
  //////////////// Shipping cost code end here ///////////////////////
 //////////////// Shipping orders code start here ///////////////////////
public function manage_shipping_orders(){
        if(!isset($this->shipper_id) && empty($this->shipper_id)){
          redirect('shipper/login'); 
        }
        $config = array();
        $search=array();
        $shipper=$this->shipper_id;
        $search['order']=$this->input->post('order');
        $search['power_user']=$this->input->post('power_user');
        $search['due_date']=$this->input->post('due_date');
        $this->data['power_users'] = json_decode($this->Vendor_model->get_power_users());
        $this->data['orders']=$this->Vendor_model->shipper_orders($shipper);
        $this->load->view('shipper/manage_shipping_orders',$this->data);
    }
    public function assignedShipperOrdersAjax($pageno=0){
        $response=array();
        $search=array();
        $shipper=$this->shipper_id;
        $search['order']=$this->input->post('order');
        $search['power_user']=$this->input->post('power_user');
        $search['due_date']=$this->input->post('due_date');
        $orders= json_decode($this->Vendor_model->shipper_orders($shipper,$search));
        $total_rows=count($orders->result);
        $base_url = base_url().'shipper/manage_shipping_orders/';
        $per_page = 20;
        if($pageno > 0){
             $si= ($pageno - 1) * $per_page;
         }else{$si=0;}
        $config = $this->paginate($base_url,$total_rows,$per_page);
        $this->load->library('pagination');
        $config['use_page_numbers']=TRUE;
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $order_list = json_decode($this->Vendor_model->shipper_orders($shipper,$search,$per_page,$si));
        $html="";
        if($order_list->code==200){
          foreach ($order_list->result as $order) {
            $html .= '<tr class=""><td><input type="checkbox" class="inline-checkbox checkSingle" name="order_id[]" value="'.$order->orderid.'"></td>';
            $html .= '<td><a href="'.base_url().'shipper/order-details/'.base64_encode($order->orderid).'">'.$order->ordernumber.'</a></td>';
            $html .= '<td>'.ucwords($order->power_user_name).'</td>';
            $html .= '<td>'.date("d-M-Y ", strtotime($order->delivery_due_date)).'</td>';
            if(strtotime($order->expected_delivery_date)>0)
            $html .= '<td>'.date("d-M-Y ", strtotime($order->expected_delivery_date)).'</td>';
            else
            $html .= '<td>--</td>';
            $html .= '<td>'.$order->ordertotalitems.'</td>';
            $html .= '<td>'.$order->orderqty.'</td>';
            $html .= '<td>'.$order->totalpayableprice.'</td>';
            $html .= '<td>'.$order->city.'</td>';
            $html .= '<td>'.$order->pincode.'</td>';
            $html .= '<td>'.$order->shipping_ref_number.'</td>';
            $html .= '<td>'.$order->shipper_name.'</td>';
            $html .= '<td>'.$order->lr.'</td>';
            $html .= '<td> <a href="'.base_url().'shipper/edit-shipping-order/'.base64_encode($order->orderid).'" class="btn btn-xs btn-primary">Edit</a></td>';
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
public function viewOrderDetails(){
         $order_id= base64_decode($this->uri->segment(3,0));
         $order_user=json_decode($this->Orders_model->commonGetAll('ga_orders_tbl',array('orderid'=>$order_id)));
          $user_id=$order_user->result[0]->userid;
         $newChek = array('user_id'=>$user_id,'order_id'=>$order_id);
          $this->data['sharecart_result']= $this->Orders_model->ordercheckoutResult($newChek);
          $where=array('trash'=>0,'orderid'=> $order_id);
            $this->data['ordersdata']=$this->Orders_model->commonGetAll('ga_orders_tbl',$where);
            $orderdata=array('order_id'=>$order_id);
            $this->data['cartList']=  $this->Orders_model->ordercartList($orderdata);
        $this->load->view('shipper/orders_view',$this->data);
    }
    
    public function edit_shipping_order(){
      if(!isset($this->shipper_id) && empty($this->shipper_id)){
        redirect('shipper/login'); 
      }
      $this->session->set_userdata("ship_url",current_url());
      $order_id=$this->uri->segment(3,0);
      if($order_id){
        $order_id=base64_decode($order_id);
        $this->data['shipping_order'] = $this->Shipper_model->update_shipping_order($order_id);
        $this->load->view('shipper/edit_shipping_order',$this->data);
      }else{
        redirect('shipper/manage-shipping-orders'); 
      }
    }
    public function shippingOrderUpdating(){
        $this->form_validation->set_rules('shipping_ref_number','Shipping reference number','trim|required|numeric');
        $this->form_validation->set_rules('shipper_name','Shipper name','trim|valid_email|required|regex_match[/^[a-zA-Z .]+$/]');
        $this->form_validation->set_rules('date','Date','trim|required|numeric||regex_match[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]');
       if($this->form_validation->run() == false){
           $this->session->set_flashdata("ship_error",validation_errors());
          $url= $this->session->userdata("ship_url");
          redirect("$url");
        }
        else{
        extract($_POST);
        $exp_del_date=$this->input->post('expected_delivery_date');
        $edd=date('Y-m-d',strtotime($exp_del_date));
       $update_data=array(
                        'shipping_ref_number' => $shipping_ref_number,
                        'shipper_name' => $shipper_name,
                        'expected_delivery_date' => $edd,
                        'lr' => $lr
              );
         $update_where = array('orderid'=>$orderid);
         $update = $this->Shipper_model->update_data('ga_orders_tbl', $update_data, $update_where);
         if($update){ 
          $this->session->set_flashdata('Success','Data Updated successfully!');
        }else{
            $this->session->set_flashdata('Failed','Data not modified');
            }
        redirect($_SERVER['HTTP_REFERER']);
        }
    }
  //////////////// Shipping cost code end here ///////////////////////


  public function paginate($base_url,$total_rows,$per_page,$uri_segment=null){
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
            case 'shipping_cost':   // need to refer name for table name
              $table='ga_shipping_cost_tbl';   // table name 
              $setcolumns='status';
              $updatevalue=$activity;
              $wherecondition="shipping_cost_id  IN  (" .$updatelist. ")";
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
            case 'shipping_cost':
                $table = 'ga_shipping_cost_tbl';
                $wherecondition = "shipping_cost_id IN  (" . $updatelist . ")";
                break;
            }
            $delete = $this->Crud->commonDelete($table,$wherecondition,$relationname);
            echo $delete;
            exit;
        }
        echo json_encode($response);
    }
	public function logout() {
        $this->session->unset_userdata('shipper_id');
        $this->session->unset_userdata('shipper_name');
        $this->session->unset_userdata('shipper_email');
       redirect(base_url().'shipper/login');
    }
         

}

