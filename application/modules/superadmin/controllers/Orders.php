<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Orders extends CI_Controller
{
  public $data;
  public $admin_id;
  public function __construct()
  {
    parent::__construct();
    $this->admin_id = $this->session->userdata('admin_id');
    if ((!isset($this->admin_id) || $this->admin_id != true)) {
      redirect(base_url() . 'superadmin/login');
    }
    $this->load->model('Orders_model');
    $this->load->model('User_model');
    $this->admin_id = $this->session->userdata('admin_id');
    $this->user_id = $this->session->userdata('user_id');
    $this->load->library('pagination');
  }

  public function index()
  {
    
    $config = array();
    $fromdate = '';
    $todate = '';
    $search = $this->input->post('search_name');
    $order_status = $this->input->post('order_status');
    $form_date = $this->input->post('from_date');
    $to_date = $this->input->post('to_date');
    if (!empty($form_date) && !empty($to_date)) {
      $fromdate = date("Y-m-d", strtotime($form_date));
      $todate = date("Y-m-d", strtotime($to_date));
    }
    $where = array('fromdate' => $fromdate, 'todate' => $todate, 'orderstatus' => $order_status);
    /**Pagination code starts**/
    // $where=array('from_date'=>$fromdate,'to_date'=>$todate);
    $config["base_url"] = base_url() . "superadmin/Orders/";
    $config["total_rows"] = $this->Crud->common_record_count('orderid', 'ga_orders_tbl', 'orderid');
    $config["per_page"] = 20;
    $config["uri_segment"] = 3;
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

    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ?  $this->uri->segment(3) : 0;
    $this->data["links"] = $this->pagination->create_links();
    /**Pagination code end**/
    $this->data['orderstatus'] = $this->Orders_model->commonGetAll('ga_orders_status_tbl', array('trash' => 0));
    $this->data['ordersdata'] = $this->Orders_model->cartOrderData($config["per_page"], $page, $where, $search);
    // print_r($this->data['ordersdata']);
    $this->load->view('orders/manage_orders', $this->data);
  }


  public function viewOrderDetails()
  {
    $order_id = base64_decode($this->uri->segment(4));

    $order_user = json_decode($this->Orders_model->commonGetAll('ga_orders_tbl', array('orderid' => $order_id)));
    $user_id = $order_user->result[0]->userid;
    $newChek = array('user_id' => $user_id, 'order_id' => $order_id);
    $this->data['sharecart_result'] = $this->Orders_model->checkoutResult($newChek);
    $where = array('trash' => 0, 'orderid' => $order_id);
    $this->data['ordersdata'] = $this->Orders_model->commonGetAll('ga_orders_tbl', $where);
    $orderdata = array('order_id' => $order_id);
    $this->data['cartList'] =  $this->Orders_model->cartList($orderdata);
    // $this->data['cartStatistics']=$this->Orders_model->checkoutStatistics($orderdata);
    // $this->data['byuser']=  $this->Orders_model->shareCartByUser($orderdata);
    // $this->data['byitem']=  $this->Orders_model->shareCartByItem($orderdata);
    $this->load->view('orders/orders_view', $this->data);
  }


  public function pdf()
  {
    $this->load->library('M_pdf');
    $order_id = base64_decode($this->uri->segment(4));
    $order_user = json_decode($this->Orders_model->commonGetAll('ga_orders_tbl', array('orderid' => $order_id)));
    $user_id = $order_user->result[0]->userid;
    $newChek = array('user_id' => $user_id, 'order_id' => $order_id);
    $this->data['sharecart_result'] = $this->Orders_model->checkoutResult($newChek);
    $where = array('trash' => 0, 'orderid' => $order_id);
    $this->data['ordersdata'] = $this->Orders_model->commonGetAll('ga_orders_tbl', $where);
    $orderdata = array('order_id' => $order_id);
    $this->data['cartList'] =  $this->Orders_model->cartList($orderdata);

    $filename = time() . "_order.pdf";
    // $html = $this->load->view('unpaid_voucher',$data,true);
    $html = $this->load->view('orders/orders_view_down', $this->data, false);
    // unpaid_voucher is unpaid_voucher.php file in view directory and $data variable has infor mation that you want to render on view.
    exit;

    $this->m_pdf->pdf->WriteHTML($html);

    //download it D save F.

    $this->m_pdf->pdf->Output(base_url() . "/uploads/orders" . $filename, "D");

    redirect($_SERVER['HTTP_REFERER']);
  }




  public function manage_cancelled_orders()
  {
    $config = array();
    $fromdate = '';
    $todate = '';
    $search = $this->input->post('search_name');
    $order_status = $this->input->post('order_status');
    $form_date = $this->input->post('from_date');
    $to_date = $this->input->post('to_date');
    if (!empty($form_date) && !empty($to_date)) {
      $fromdate = date("Y-m-d", strtotime($form_date));
      $todate = date("Y-m-d", strtotime($to_date));
    }
    $where = array('fromdate' => $fromdate, 'todate' => $todate, 'orderstatus' => 5);
    /**Pagination code starts**/
    // $where=array('from_date'=>$fromdate,'to_date'=>$todate);
    $config["base_url"] = base_url() . "superadmin/manage_cancelled_orders/";
    $config["total_rows"] = $this->Crud->common_record_count('cart_id', 'ga_cart_tbl', 'cart_id');
    $config["per_page"] = 10;
    $config["uri_segment"] = 3;
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

    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ?  $this->uri->segment(3) : 0;
    $this->data["links"] = $this->pagination->create_links();
    /**Pagination code end**/
    $this->data['orderstatus'] = $this->Orders_model->commonGetAll('ga_orders_status_tbl', array('trash' => 0));
    $this->data['ordersdata'] = $this->User_model->myWalletData();
    // print_r($this->data['ordersdata']);
    $this->load->view('orders/cancelled_orders', $this->data);
  }

 
}
