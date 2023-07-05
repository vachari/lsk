<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
    public $data;
	public $admin_id;
    public $ipaddress;
    public function __construct() {
        parent::__construct();
        $this->load->model('Super_model');
        $this->ipaddress = $_SERVER['REMOTE_ADDR'];
        $this->date = date('Y-m-d H:i:s');
		    $this->admin_id=$this->session->userdata('admin_id');
        // isSuperAdminLogin();
    }
    
    public function index() {
    	if(empty($this->admin_id)){
         $this->load->view('index');
        }
        else{
            redirect('superadmin/dashboard');
        }
  	}

    public function login() {
      // print_r($_POST);exit;
     
        if(empty($this->admin_id)){
        $this->form_validation->set_rules('email','Your Email','required|valid_email',array('required'=>'Please enter email '));
        $this->form_validation->set_rules('password','Your Password','required|min_length[6]');
        if($this->form_validation->run()==false){
            $this->index();
        }
        else{
            $login_data=array(
                                'email'=>$this->input->post('email'),
                                'password'=>$this->input->post('password')
                );
            $this->session->set_userdata("my_id",1);
           
            $result=$this->Super_model->can_login($login_data);
            $login_data=json_decode($result);
            $row=$login_data->common_result;
            if($login_data->code==200){
                
                $session_data=array(
                                    'admin_id'=>$row->id,
                                    'admin_email'=>$this->input->post('email')
                                
                                    );
                $this->session->set_userdata($session_data);    
                 redirect('superadmin/dashboard');

            }
           
                if($login_data->code==204){
                $this->session->set_flashdata('error','Invalid Email and Password ');
                $this->load->view('index');
                
                }
            
        }
       
    }
    else{
       
        redirect('superadmin/dashboard');
    }

    }

    public function logout() {

        $this->session->unset_userdata('login_data');
        $this->session->unset_userdata('admin_email');
        $this->session->unset_userdata('admin_id');
      
        redirect('superadmin/Admin/index');
    }

    public function dashboard() {
       if(!empty($this->admin_id)){
       
        $this->data['new_orders']=$this->Crud->common_record_count_where('*','ga_orders_tbl',array('orderstatus'=>1));
         $this->data['confirm_orders']=$this->Crud->common_record_count_where('*','ga_orders_tbl',array('orderstatus'=>2));
         $this->data['dispatch_orders']=$this->Crud->common_record_count_where('*','ga_orders_tbl',array('orderstatus'=>3));
        $this->data['deliver_orders']=$this->Crud->common_record_count_where('*','ga_orders_tbl',array('orderstatus'=>4));
        $this->data['cancel_orders']=$this->Crud->common_record_count_where('*','ga_orders_tbl',array('orderstatus'=>5));
         // $this->data['standard_users_count']=$this->Crud->common_record_count_where('*','ga_users_tbl',array('orderstatus'=>0));
          $this->data['standard_users_count']=$this->Crud->common_record_count_where('*','ga_users_tbl',array('user_type !='=>2));
         $this->data['power_users_count']=$this->Crud->common_record_count_where('*','ga_users_tbl',array('user_type'=>2));
         $this->data['followers_users_count']=$this->Crud->common_record_count_where('id','ga_followers_tbl',array('active_status'=>1));
         $this->data['guest_users_count']=$this->Crud->common_record_count_where('user_id','ga_users_tbl',array('user_type'=>3));
        $this->load->view('dashboard',$this->data);
    }
    else{

        redirect('superadmin/');
    }

    }
    // Change password of admin starts from here 
    public function changePassword(){
      if(!empty($this->admin_id)){
        $this->form_validation->set_rules('old_password','Your Old Password','required');
        $this->form_validation->set_rules('new_password','Your New Password','required|min_length[6]');
        $this->form_validation->set_rules('confirm_password','Your Confirm Password','required|min_length[6]|matches[new_password]');
        if($this->form_validation->run()==false){
              $this->load->view('change_password');
         }
         else{
                 $pass_data=array(
                                'id'=>$this->session->userdata('admin_id'),
                                 'password'=>$this->input->post('old_password')
                                 );
                
               $res=$this->Super_model->commonCheckPassword($pass_data);
               
              if($res==true){
                    if($this->input->post('new_password')==$this->input->post('confirm_password')){
                            //both passwords should match
                        $pass_where=array('id'=>$this->session->userdata('admin_id'));
                        $data=array('password'=>md5($this->input->post('new_password')));

                        $pass_change=$this->Super_model->updatePassword('admin',$data,$pass_where);
                        if($pass_change==true){

                            $this->session->set_flashdata('success','Passwords  Changed successfully');
                            redirect('superadmin/Admin/changePassword');
                        }
                        else{
                            $this->session->set_flashdata('error','Passwords Not Changed');
                            redirect('superadmin/Admin/changePassword');
                        }

                    }
                    else{

                    $this->session->set_flashdata('error','Both Passwords should match');
                    redirect('superadmin/Admin/changePassword');
                    }

              }
              else{

                 $this->session->set_flashdata('error','Your old password not matched');
                 redirect('superadmin/Admin/changePassword');
              } 
         }
    }
    else{

        redirect('superadmin/');
    }

    } 



}