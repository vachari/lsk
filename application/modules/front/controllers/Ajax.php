<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax extends CI_Controller 
{
        public function __construct()
        {
                parent::__construct();
                $this->load->model('Ajax_model');
                //$this->load->helper('url_helper');
                  $this->user_id = $this->session->userdata('user_id');
        }

        public function form ()
        {
            $data['title'] = 'Ajax search';

            $this->load->view('includes/header');
        }
        // function ends

  public function getdata()
  {
    $param= $this->input->post('search');
    $data='';
      if(!empty( $param))
      {
          // Get data from db 
         $result = $this->Ajax_model->search($param);
          // Pass data to view
        $res= json_decode($result); 

            foreach ($res->serach_result as $sv) 
            {
              $data .= '<li> <a href="'.base_url().'productDetails/'.$sv->id.'">'.'<img src="'.base_url().'uploads/products/'.$sv->prod_image.'" width="30px"> '. $sv->prod_name.'</a></li>';
            }

            echo $data;
      }
  }
  public function getFollow()
  {
    $param= $this->input->post('search');
    $data='';
      if(!empty( $param))
      {
          // Get data from db 
         $result = $this->Ajax_model->searchFollow($param,$this->user_id);
          // Pass data to view
        $res= json_decode($result); 
        // print_r($res);
        if($res->code == 200 )
        {
            foreach ($res->follower_result as $fr) 
            {
              $data .='<li class="text-left"> <a href="'. base_url().'viewFollowers" >'. ucfirst($fr->user_name) .' - '. $fr->user_email .' - '. $fr->user_mobile .'</a> </li>';
            }

            echo $data;
        }
            
          
      }
  }

}