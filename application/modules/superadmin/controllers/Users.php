<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->admin_id=$this->session->userdata('admin_id');
        if((!isset($this->admin_id) || $this->admin_id != true) )
            {
                redirect(base_url().'superadmin/login');
            } 
        $this->data = array();
        $this->product_view_path = 'Product/';
        $this->load->model(array('Super_model', 'Settings_model', 'User_model','Orders_model'));
}
public function viewStandardUsers(){
        $where = array('user_type !=' => 2);
        $cols = 'user_id,user_name,user_email,user_password,user_mobile,user_status,user_type,created_on,trash';
        $search =  $this->input->post('search');
        $table_name = 'ga_users_tbl';
        $order_by_col = 'user_id';
        $config["base_url"] = base_url() . 'superadmin/Users/viewStandardUsers';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*         * Pagination code end* */
        $like_col = 'user_name';
        $like_col2 = 'user_mobile';
        $orderby = 'user_id';
        $this->data['common_result'] = $this->User_model->paging_list($cols, $table_name, $like_col,$like_col2, $orderby, $config["per_page"], $page, $search, $where);
        $this->load->view('users/viewStandardUser', $this->data);
}
public function viewGuestUsers(){
        $where = array('user_type' => 3);
        $cols = 'user_id,user_name,user_email,user_password,user_mobile,user_status,user_type,created_on,trash';
        $search =  $this->input->post('search');
        $table_name = 'ga_users_tbl';
        $order_by_col = 'user_id';
        $config["base_url"] = base_url() . 'superadmin/Users/viewStandardUsers';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*         * Pagination code end* */
        $like_col = 'user_name';
        $orderby = 'user_id';
        $this->data['common_result'] = $this->User_model->common_list_paging($cols, $table_name, $like_col, $orderby, $config["per_page"], $page, $search, $where);
        $this->load->view('users/viewGuestUser', $this->data);
}
public function viewPowerUsers(){
        $where = array('user_type' => 2);
        $cols = 'user_id,user_name,user_email,power_approved,verified_email,user_password,user_mobile,user_status,user_type,latitude,longitude,created_on,fb_link,trash,user_address';
        $search =  $this->input->post('search');
        $table_name = 'ga_users_tbl';
        $order_by_col = 'user_id';
        $config["base_url"] = base_url() . 'superadmin/Users/viewStandardUsers';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*         * Pagination code end* */
        $like_col = 'user_name';
        $like_col2 = 'user_mobile';
        $orderby = 'user_id';
        $this->data['common_result'] = $this->User_model->paging_list($cols, $table_name, $like_col,$like_col2, $orderby, $config["per_page"], $page, $search, $where);
        $this->data['followers_count']=$this->Super_model->get_alldata('ga_followers_tbl',array('trash'=>0));
         $this->data['followers_limit']=$this->Super_model->get_alldata('ga_follower_limit_tbl',array('trash'=>0));
        $this->load->view('users/viewPowerUser', $this->data);
}
public function viewFollower(){

        $udi=base64_decode($this->uri->segment(3));
        $where = array('power_user_id' =>$udi);
        $cols = 'user_id,user_name,user_email,fb_link,user_password,user_mobile,user_status,user_type,created_on,trash';
        $search =  $this->input->post('search');
        $table_name = 'ga_users_tbl';
        $order_by_col = 'user_id';
        $config["base_url"] = base_url() . 'superadmin/Users/viewStandardUsers';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*         * Pagination code end* */
        $like_col = 'user_name';
        $orderby = 'user_id';
        $this->data['common_result'] = $this->User_model->common_list_paging($cols, $table_name, $like_col, $orderby, $config["per_page"], $page, $search, $where);
        $this->load->view('users/view_followers', $this->data);
}
 public function commonStatus()
    {
        //print_r($_POST);
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
            case 'standard':   // need to refer name for table name
              $table='ga_users_tbl';   // table name 
              $setcolumns='user_status';
              $updatevalue=$activity;
              $wherecondition="user_id  IN  (" .$updatelist. ")";
              break;
            case 'guest':   // need to refer name for table name
              $table='ga_users_tbl';   // table name 
              $setcolumns='user_status';
              $updatevalue=$activity;
              $wherecondition="user_id  IN  (" .$updatelist. ")";
              break;
            case 'power':   // need to refer name for table name
              $table='ga_users_tbl';   // table name 
              $setcolumns='power_approved';
              $updatevalue=$activity;
              $wherecondition="user_id  IN  (" .$updatelist. ")";
              break;
            case 'orders':   // need to refer name for table name
              $table='ga_orders_tbl';   // table name 
              $setcolumns='orderstatus';
              $updatevalue=$activity;
              $wherecondition="orderid  IN  (" .$updatelist. ")";
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
            
            case 'standard':
                $table = 'ga_users_tbl';
                $wherecondition = "user_id IN  (" . $updatelist . ")";
                break;
            case 'guest':
                $table = 'ga_users_tbl';
                $wherecondition = "user_id IN  (" . $updatelist . ")";
                break;
            case 'power':
                $table = 'ga_users_tbl';
                $wherecondition = "user_id IN  (" . $updatelist . ")";
                break;
            }
            $update = $this->Crud->commonDelete($table,$wherecondition,$relationname);
            echo $update;
            exit;
        }
        echo json_encode($response);
    }

    //   public function powerApprovel(){
    //     $ud = base64_decode($this->uri->segment(4));
    //     $follower_count = base64_decode($this->uri->segment(5));
    //     $app_dis = base64_decode($this->uri->segment(6));
    //     $fd=json_decode($this->Super_model->get_alldata('ga_follower_limit_tbl',array('trash'=>0)));
    //     //echo  $follower_count;
    //     $follower_count_db = $fd->data_result[0]->follower_limit;
    //     //echo $follower_count_db;exit;
    //     $user_data=json_decode($this->Super_model->get_alldata('ga_users_tbl',array('trash'=>0,'user_id'=>$ud)));
    //     //print_r($user_data->data_result[0]->user_email);exit;
    //     $follower_data=json_decode($this->Super_model->get_alldata('ga_followers_tbl',array('trash'=>0,'power_user_id'=>$ud)));
    //     if($follower_count_db <= $follower_count )
    //     { 
        
    //     if($app_dis==1){
    //         //echo "hi";exit;
    //     for ($i = 0; $i < count($follower_data->data_result); $i++) {
    //         $update_follower=array('table_name'=>'ga_users_tbl','update_data'=>array("user_status"=>1),'update_condition'=>array('user_email'=>$follower_data->data_result[$i]->email));
    //         $upd = json_decode($this->Crud->common_update($update_follower));
    //     //     if($upd->code == 200){
    //     //       //echo "sent";exit;
    //     //     }else{
    //     //      $this->session->set_flashdata('failed', 'Follower approved failed');
    //     //     }
    //       }

    //          $update=array('table_name'=>'ga_users_tbl','update_data'=>array('power_approved'=>1,"user_status"=>1,"verified_email"=>1),'update_condition'=>array('user_id'=>$ud));
    //         // print_r($update);exit;
    //              $up = json_decode($this->Crud->common_update($update));
    //               //print_r($up);exit;
    //              if($up->code == 200 )
    //              {
                     
    //                  /*  Mail Code */
    //                 $uid=array('user_id'=>$ud);
    //                 $send=json_decode($this->User_model->commonGetAll('ga_users_tbl', $uid));
    //                 $user_email=$send->result->user_email;
    //                 $data=array(
    //                         'name'=>$send->result->user_email,
    //                         'email'=>$send->result->user_email,
    //                         'mobile'=>$send->result->user_email,
    //                         'user_status'=>$send->result->user_status,
    //                         'subject'=>'Power User Registration Approvel',
    //                         'link'=>base_url().'signin',
    //                         );
    //                 if($send->result->user_status == 1 ){
    //                     $mail_array = $this->sendmail->sendEmail(
    //                                 array(
    //                                     'to' =>array($user_email),
    //                                     'cc' => array('info@' . SITE_DOMAIN),
    //                                     'bcc' => array(BCC_EMAIL),
    //                                     'subject' => 'Power User Registration Approved Successfully. ',
    //                                     'data' => array('email_content'=>$data),
    //                                     'template' => EMAIL_TEMPLATE_FOLDER.'poweruser_approvel',
    //                                 )
    //                             );
    //                     $this->session->set_flashdata('success', 'Power User Approved Successfully.');
    //                  redirect('/superadmin/Users/viewPowerUsers');
    //                 }
    //                 $this->session->set_flashdata('success', 'Power User Approved Successfully.');
    //                  redirect('/superadmin/Users/viewPowerUsers');
    //              }else{
    //                  //$this->session->set_flashdata('failed', 'Failed');
    //                  redirect('/superadmin/Users/viewPowerUsers');

    //              }
    //          }else{
    //              //echo "hi";exit;
    //      for ($i = 0; $i < count($follower_data->data_result); $i++) 
    //                      {
    //                         $data=array(
    //                             'name'=>$user_data->data_result[$i]->user_name,
    //                             'email'=>$user_data->data_result[0]->user_email,
    //                             'mobile'=>$follower_data->data_result[$i]->mobile,
    //                             'subject'=>"Your power user has been disapproved",
    //                             );           
    //         $from=SITE_EMAIL; 
    //         $message=$this->load->view('templates/disapproved_power_follower',$data,TRUE);  
    //         $e_resp=$this->send_user_email($follower_data->data_result[$i]->email,$from,"Your power user has been disapproved",$message);  
    //         //echo $ud;exit;
    //         $update_follower=array('table_name'=>'ga_users_tbl','update_data'=>array("user_status"=>0),'update_condition'=>array('user_email'=>$follower_data->data_result[$i]->email));
    //         $upd = json_decode($this->Crud->common_update($update_follower));
    //         if($e_resp==true && $upd->code == 200){
    //           //echo "sent";exit;
    //         }else{
    //          $this->session->set_flashdata('failed', 'Email send failed ');
    //         }
    //       }
    //          $update=array('table_name'=>'ga_users_tbl','update_data'=>array('power_approved'=>0,"user_status"=>0,"verified_email"=>1),'update_condition'=>array('user_id'=>$ud));
    //         // print_r($update);exit;
    //              $up = json_decode($this->Crud->common_update($update));
    //               //print_r($up);exit;
    //              if($up->code == 200 )
    //              {
                     
    //                  /*  Mail Code */
    //                 $uid=array('user_id'=>$ud);
    //                 $send=json_decode($this->User_model->commonGetAll('ga_users_tbl', $uid));
    //                 $user_email=$send->result->user_email;
    //                 $data=array(
    //                         'name'=>$send->result->user_email,
    //                         'email'=>$send->result->user_email,
    //                         'mobile'=>$send->result->user_email,
    //                         'user_status'=>$send->result->user_status,
    //                         'subject'=>'Power User Registration Disapprovel',
    //                         'link'=>base_url().'signin',
    //                         );
    //                 if($send->result->user_status == 1 ){
    //                     $mail_array = $this->sendmail->sendEmail(
    //                                 array(
    //                                     'to' =>array($user_email),
    //                                     'cc' => array('info@' . SITE_DOMAIN),
    //                                     'bcc' => array(BCC_EMAIL),
    //                                     'subject' => 'Power User Registration Disapproved. ',
    //                                     'data' => array('email_content'=>$data),
    //                                     'template' => EMAIL_TEMPLATE_FOLDER.'poweruser_disapprovel',
    //                                 )
    //                             );
    //                     $this->session->set_flashdata('success', 'Power User Disapproved Successfully.');
    //                  redirect('/superadmin/Users/viewPowerUsers');
    //                 }
    //                 $this->session->set_flashdata('success', 'Power User Disapproved Successfully.');
    //                  redirect('/superadmin/Users/viewPowerUsers');
    //              }else{
    //                  //$this->session->set_flashdata('failed', 'Failed');
    //                  redirect('/superadmin/Users/viewPowerUsers');

    //              }


    //          }

    //     }else{
    //         $this->session->set_flashdata('failed', 'Not Approved.Minimum '.$fd->data_result[0]->follower_limit.' followers need');
    //         redirect('superadmin/Users/viewPowerUsers');

    //     }

    // }
    
    public function powerApprovel(){
        $ud = base64_decode($this->uri->segment(4));
        //echo $ud;exit;
        $follower_count = base64_decode($this->uri->segment(5));
        $app_dis = base64_decode($this->uri->segment(6));
        $fd=json_decode($this->Super_model->get_alldata('ga_follower_limit_tbl',array('trash'=>0)));
       // print_r($follower_data->data_result[0]->email);exit;
        $follower_count_db = $fd->data_result[0]->follower_limit;
        $user_data=json_decode($this->Super_model->get_alldata('ga_users_tbl',array('trash'=>0,'user_id'=>$ud)));
        //print_r($user_data->data_result[0]->user_email);exit;
        $follower_data=json_decode($this->Super_model->get_alldata('ga_followers_tbl',array('trash'=>0,'power_user_id'=>$ud)));
       //print_r($follower_data->data_result[1]->email);exit;
        if($follower_count_db <= $follower_count )
        { 
        $from=SITE_EMAIL;         
        if($app_dis==1){
          //for power user get email
              $data=array(
                  'name'=>$user_data->data_result[0]->user_name,
                  'email'=>$user_data->data_result[0]->user_email,
                  'subject'=>"Your power user has been Approved",
                  ); 
        $power_message=$this->load->view('templates/new_temp/poweruser_approvel',$data,TRUE);  
        $resp=$this->send_user_email($user_data->data_result[0]->user_email,$from,"Your power user has been Approved",$power_message);
        //power user email end
         for ($i = 0; $i < count($follower_data->data_result); $i++) {  

                  $data=array(
                  'name'=>$user_data->data_result[0]->user_name,
                  'email'=>$user_data->data_result[0]->user_email,
                  'mobile'=>$follower_data->data_result[$i]->mobile,
                  'subject'=>"Your power user has been Approved",
                  ); 

            $from=SITE_EMAIL; 
            $message=$this->load->view('templates/approved_power_follower',$data,TRUE);  
            $e_resp=$this->send_user_email($follower_data->data_result[$i]->email,$from,"Your power user has been Approved",$message);
            $update_data=array("user_status"=>1,'power_approved'=>1);
            $where=array('user_email'=>$follower_data->data_result[$i]->email);
            $upd=$this->User_model->ArrayUpdate($update_data,"ga_users_tbl",$where,"user_id");
          }
           
            $where1=array("user_id"=>$ud);
            $update_data1=array("user_status"=>1,'power_approved'=>1);
            $upd=$this->User_model->ArrayUpdate($update_data1,"ga_users_tbl",$where1,"user_id");
            if($upd== true && $resp==true){
                    $this->session->set_flashdata('success', 'Power User Approved Successfully.');
                     redirect('/superadmin/Users/viewPowerUsers');
            }else{
             $this->session->set_flashdata('failed', 'Power user approved failed');
             redirect('/superadmin/Users/viewPowerUsers');
            }
             }else{

        $data=array(
                  'name'=>$user_data->data_result[0]->user_name,
                  'email'=>$user_data->data_result[0]->user_email,
                  'subject'=>"Your power user has been Approved",
                  ); 
        $power_message=$this->load->view('templates/new_temp/poweruser_disapprovel',$data,TRUE);  
       // echo $message;exit;
        $resp=$this->send_user_email($user_data->data_result[0]->user_email,$from,"Your power user account has been Disapproved",$power_message);

         for ($i = 0; $i < count($follower_data->data_result); $i++){
                            $data=array(
                                'name'=>$user_data->data_result[0]->user_name,
                                'email'=>$user_data->data_result[0]->user_email,
                                'mobile'=>$follower_data->data_result[$i]->mobile,
                                'subject'=>"Your power user has been disapproved",
                                );           
            $from=SITE_EMAIL; 
            $message=$this->load->view('templates/new_temp/disapproved_power_follower',$data,TRUE);  
            $e_resp=$this->send_user_email($follower_data->data_result[$i]->email,$from,"Your account has been disapproved",$message); 

            $update_data=array("user_status"=>0,'power_approved'=>0);
            $where=array('user_email'=>$follower_data->data_result[$i]->email);
            $upd=$this->User_model->ArrayUpdate($update_data,"ga_users_tbl",$where,"user_id");
            }
            $where1=array("user_id"=>$ud);
            $update_data1=array("user_status"=>0,'power_approved'=>0);
            $upd=$this->User_model->ArrayUpdate($update_data1,"ga_users_tbl",$where1,"user_id");

            if($e_resp==true && $upd== true){
                    $this->session->set_flashdata('success', 'Power User Disapproved Successfully.');
                     redirect('/superadmin/Users/viewPowerUsers');
            }else{
              $this->session->set_flashdata('failed', 'Failed');
                redirect('/superadmin/Users/viewPowerUsers');
            }
           } 

        }else{
            $this->session->set_flashdata('failed', 'Not Approved.Minimum '.$fd->data_result[0]->follower_limit.' followers need');
            redirect('superadmin/Users/viewPowerUsers');

        }

    }
    
    public function send_user_email($to,$from,$subject,$message){ 
    $config=array(
                // 'protocol' => 'smtp', 
                // 'smtp_host' => 'ssl://smtp.googlemail.com', 
                // 'smtp_port' => 465, 
                // 'smtp_user' => '', 
                // 'smtp_pass' => '',
                'charset'=>'utf-8',
                'newline'=> "\r\n",
                'mailtype'=>'html',
                'validation'=> true
     );
                $this->load->library('email');
                $this->email->initialize($config);
                $this->email->to($to);
                $this->email->from($from);
                $this->email->subject($subject);
                $this->email->message($message);
      if($this->email->send())
      {
       return true;
      }
      else
      {
       return false;
      }
    }

    public function sendApporvel(){
        $uid=array('user_id'=>$this->input->post('user_id'));
        $send=json_decode($this->User_model->commonGetA('ga_users_tbl', $uid));
        $user_email=$send->result->user_email;
        $data=array(
                'name'=>$send->result->user_email,
                'email'=>$send->result->user_email,
                'mobile'=>$send->result->user_email,
                'user_status'=>$send->result->user_status,
                'subject'=>'Power User Registration Approvel',
                'link'=>base_url().'signin',
                );
        if($send->result->user_status == 1 ){
            $mail_array = $this->sendmail->sendEmail(
                        array(
                            'to' =>array($user_email),
                            'cc' => array('info@' . SITE_DOMAIN),
                            'bcc' => array(BCC_EMAIL),
                            'subject' => 'Power User Registration Approved Successfully. ',
                            'data' => array('email_content'=>$data),
                            'template' => EMAIL_TEMPLATE_FOLDER.'poweruser_approvel',
                        )
                    );
        print_r($mail_array);exit;

        }
    }


    public function setLimit(){
        $this->data['limit_data']= json_decode($this->User_model->get_Fetch('ga_follower_limit_tbl'));
        $res= $this->data['limit_data'];
        if(isset($res->data_result['0']->id)){
       $reg_id=$res->data_result['0']->id;
       }
        $this->form_validation->set_rules('follower_limit','Follower Limit','required|numeric');
        if($this->form_validation->run() === false){
        $this->load->view('users/set_limit_followers',$this->data);
        }else{

             $fl=$this->input->post('follower_limit',$this);

            if(empty($reg_id)){
                $insert_array = array(
                    'follower_limit' =>$fl,
                );
                $insert = json_decode($this->Crud->commonInsert('ga_follower_limit_tbl', $insert_array));
                if($insert->code == 200 ){
                     $this->session->set_flashdata('success', 'Your data inserted Successfully.');
                     redirect('/superadmin/Users/setLimit');

                }else{
                     $this->session->set_flashdata('error', 'Your data not inserted.');

                }
            }
            else{
                  $update=array('table_name'=>'ga_follower_limit_tbl','update_data'=>array('follower_limit'=>$fl),'update_condition'=>array('id'=>$reg_id));
                 $up = json_decode($this->Crud->common_update($update));
                 if($up->code == 200 ){
                     $this->session->set_flashdata('success', 'Your data updated Successfully.');
                     redirect('/superadmin/Users/setLimit');

                 }else{
                     $this->session->set_flashdata('error', 'Your data not updated.');
                     redirect('/superadmin/Users/setLimit');

                 }

            }
        }   
    }
    
    public function orderUpdateStatus()
    {
        $response = array();
        $tablename = $this->input->post('tablename');
        $updatelist = $this->input->post('updatelist');
        $activity = $this->input->post('activity');
        if ($tablename != '' && $updatelist != '' && $activity != '' && ($activity == 0 || $activity == 1 || $activity == 2 || $activity == 3 || $activity == 4 || $activity == 5)) {
            $table= '';
            $setcolumns = '';
            $wherecondition = '';
            $updatevalue = '';
            switch ($tablename) {
            
            case 'orders':   // need to refer name for table name
              $table='ga_orders_tbl';   // table name 
              $setcolumns='orderstatus';
              $updatevalue=$activity;
              $wherecondition="orderid  IN  (" .$updatelist. ")";
              break;
            }
           $common = $this->Crud->commonStatusActivity($table, $setcolumns, $updatevalue, $wherecondition);
            echo $common;
            exit;
        }
        echo json_encode($response);
        }


    public function orderStatusMail(){

        /* Orderplaced - 1  Approve - 2  Dispatch  - 3  Deliver - 4 Cancel - 5   */
        $subject='Order Status';
        $orderid = $this->input->post('orderid');                                            
        $orderstatus =  $this->input->post('orderstatus');
        $email_array = '';
        $orderid = explode(',', $orderid);
       
        if( $orderstatus == 2){
            $subject = 'Order Confirmed'; }elseif ($orderstatus == 3) {
            $subject = 'Order Dispatched';}elseif ($orderstatus == 4) {
            $subject = 'Order Delivered'; }elseif ($orderstatus == 5) {
            $subject = 'Order Cancelled'; }

        for ($i=0; $i < count($orderid) ; $i++) { 
            $orderdate  = json_decode($this->Crud->common_get_allrec('ga_orders_tbl',array('orderid'=> $orderid[$i])));
            foreach ($orderdate->common_result as $csd) 
            {
                $data=array(
                                        'order_number'=>$csd->ordernumber,
                                        'order_status'=>$subject,
                                        'order_date'=>DATE, // canceled date 
                                        );      
                $result = $this->sendmail->sendEmail(
                        array(
                            'to' => array($csd->email),
                            'cc' => array('info@' . SITE_DOMAIN),
                            'bcc' => array(BCC_EMAIL),
                            'subject' => $subject,
                            'data' => array('orderdata'=>$data),
                            'template' => EMAIL_TEMPLATE_FOLDER_SUPER.'/order_cancel_page',
                        ));
              

            }

        }
                if($result['code']==1){
                      //$this->pdf($orderid);
                    echo 'Mail Sent Success';

                }
    }

    // public function pdf($orderid)
    // {
    //         for ($i=0; $i < count($orderid) ; $i++) 
    //         { 
    //             $this->load->library('M_pdf');
    //             $order_user=json_decode($this->Orders_model->commonGetAll('ga_orders_tbl',array('orderid'=>$order_id[$i])));
    //             $user_id=$order_user->result[0]->userid;
    //             $newChek = array('user_id'=>$user_id,'order_id'=>$order_user->result->orderid);
    //             $this->data['sharecart_result']= $this->Orders_model->checkoutResult($newChek);
    //             $where=array('trash'=>0,'orderid'=> $order_id);
    //             $this->data['ordersdata']=$this->Orders_model->commonGetAll('ga_orders_tbl',$where);
    //             $orderdata=array('order_id'=>$order_user->result->orderid);
    //             $this->data['cartList']=  $this->Orders_model->cartList($orderdata);
    //             $filename = time()."_order.pdf";
    //             $html = $this->load->view('orders/orders_view_down', $this->data,true);
    //             $this->m_pdf->pdf->WriteHTML($html);
    //             $this->m_pdf->pdf->Output(base_url()."/uploads/orders".$filename, "D");

    //         }

    //     // pdf download 
                
    // }
	//Update Part
	/**
	 Admin Will Set If A Normal User Can Order Or Not 
	*/
	public function individual_user_order_status(){
		$this->data['individual_user_order_status']= json_decode($this->User_model->get_Fetch('individual_user_order_tbl'));
		$status= $this->data['individual_user_order_status'];
		if(isset($status->data_result['0']->status)){
			$individual_user_order_status=$status->data_result['0']->status;
		}
        if(isset($status->data_result['0']->id)){
        $id=$status->data_result['0']->id;
		}
		$this->form_validation->set_rules('individual_user_order_status','Individual User Can Order','required');
		if($this->form_validation->run() === false){
			//load the view
			$this->load->view('users/setIndividualUserCanOrder',$this->data);			
		}else{
			//get the form checkbox data
			$status=$this->input->post('individual_user_order_status',$this);
			if(empty($id)){
                $insert_array = array(
                    'status' =>$status
                );
                $insert = json_decode($this->Crud->commonInsert('individual_user_order_tbl', $insert_array));
                if($insert->code == 200 ){
                     $this->session->set_flashdata('success', 'Your data inserted Successfully.');
                     redirect('/superadmin/Users/individual_user_order_status');

                }else{
                     $this->session->set_flashdata('error', 'Your data not inserted.');
                }
            }
            else{
                  $update=array('table_name'=>'individual_user_order_tbl','update_data'=>array('status'=>$status),'update_condition'=>array('id'=>$id));
                 $up = json_decode($this->Crud->common_update($update));
                 if($up->code == 200 ){
                     $this->session->set_flashdata('success', 'Your data updated Successfully.');
                     redirect('/superadmin/Users/individual_user_order_status');

                 }else{
                     $this->session->set_flashdata('error', 'Your data not updated.');
                     redirect('/superadmin/Users/individual_user_order_status');

                 }
			}
           }
	}    
}

