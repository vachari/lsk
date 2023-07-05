<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends CI_Controller {

    public $data;
	public $admin_id;
    public function __construct() {
        parent::__construct();
        $this->load->model('Orders_model');
		$this->admin_id=$this->session->userdata('admin_id');
		$this->user_id = $this->session->userdata('user_id');
    }
    
    public function myCartOrders(){

        $this->data['ordersdata']=$this->Orders_model->cartOrderData();
    	// $this->data['shareordersdata']=$this->Orders_model->shareOrderData();
    	$this->load->view('orders/manage_orders',$this->data);

    }
    public function shareCartOrders(){

        // $this->data['ordersdata']=$this->Orders_model->cartOrderData();
        $this->data['shareordersdata']=$this->Orders_model->shareOrderData();
        $this->load->view('orders/sharecart_manage_orders',$this->data);

    }

    public function viewOrderDetails(){
    	 $order_id= $this->uri->segment(4);
         // echo $order_id;exit;
          $where=array('trash'=>0,'orderid'=> $order_id);
            $this->data['ordersdata']=$this->Orders_model->commonGetAll('ga_orders_tbl',$where);
            $orderdata=array('order_id'=>$order_id);
            $this->data['cartList']=  $this->Orders_model->cartList($orderdata);
             // $this->data['cartStatistics']=$this->Orders_model->checkoutStatistics($orderdata);
      //       $this->data['byuser']=  $this->Orders_model->shareCartByUser($orderdata);
      //       $this->data['byitem']=  $this->Orders_model->shareCartByItem($orderdata);
    	$this->load->view('orders/orders_view',$this->data);
    }



   }