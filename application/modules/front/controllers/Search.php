<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->vendor_id = $this->session->userdata('vendor_id');
            if(!empty($this->vendor_id)){
                redirect(base_url().'vendor/dashboard');
            }
        $this->user_id = $this->session->userdata('user_id');
        $this->cart_session_id=$this->session->userdata('cart_session_id');
        $this->data['menuList'] = $this->Common->mainMenuList();
        $this->load->model('Cart_model');
        $this->data['cartList'] = $this->Cart_model->cartList($this->cart_session_id, 1);
        $this->load->model(array('Checkout_model'=>'checkout'));
        $this->data['sharecart_result']= $this->checkout->checkoutResult(array('cart_session'=> $this->cart_session_id));
        $this->data['cartStatistics']=$this->checkout->checkoutStatistics($this->cart_session_id);
        $this->load->model('Search_model');
    }

    public function index()
    {
        $this->load->view('serach_view',$this->data);
    }

    public function execute_search()
    {
        // Retrieve the posted search term.
      $search_term = $this->input->post('search');
       if($search_term !=''){
            
        // Use a model to retrieve the results.
       $this->data['products'] = $this->Search_model->get_res($search_term);
        // Pass the results to the view.
        $this->load->view('serach_view',$this->data);
         }else{
         $url=base_url();
         redirect($url);
         }


    }
   function test(){
    // echo 'test';exit;
     $search_term = $this->input->post('search');
    $this->data['page_title']='Search';
    $q = strtolower($search_term);
     $this->data['searchdata']= $this->Search_model->get_searchterm($q);
    
   }
  

}