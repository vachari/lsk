<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Checkout extends CI_Controller
{

  public $user_id;
  public $cart_session_id;
  public function __construct()
  {
    parent::__construct();
    $this->vendor_id = $this->session->userdata('vendor_id');
    if (!empty($this->vendor_id)) {
      redirect(base_url() . 'vendor/dashboard');
    }
    $this->cart_session_id = $this->session->userdata('cart_session_id');

    if (empty($this->cart_session_id)) {
      $this->cart_session_id = time() . rand(00, 99999) . session_id();
      $this->session->set_userdata('cart_session_id', $this->cart_session_id);
    }
    $this->user_id = $this->session->userdata('user_id');
    if (empty($this->user_id)) {
      redirect(base_url() . 'register');
    }
    $this->load->model(array('Cart_model' => 'cart', 'User_model' => 'user'));
    $this->load->model(array('Checkout_model' => 'checkout'));
    $this->load->model(array('Orders_model' => 'orders'));
    #loading menus here 
    $this->data['menuList'] = $this->Common->mainMenuList();
    #getting cart details 
    $this->data['sharecart_result'] = $this->checkout->checkoutResult(array('cart_session' => $this->cart_session_id));
    $c_ses = $this->cart_session_id;
    $this->data['cartList'] = $this->cart->cartList($c_ses);
    $this->data['cartStatistics'] = $this->checkout->checkoutStatistics($c_ses);
    $this->data['cartUStatistics'] = $this->checkout->checkoutUserStatistics($c_ses);
    $colssss = ('cart_id');
    $whereconditionss = array('cart_session_id' => $this->cart_session_id);
    $this->data['cartCheckData'] = $this->Crud->commonCheck($colssss, 'ga_cart_tbl', $whereconditionss);
  }


  public function index()
  {
    if ($this->data['cartCheckData'] == 1) {
      $search = array();
      $search['cart_session'] = $this->cart_session_id;
      //share cart list
      $this->data['checkout_result'] =  $this->checkout->checkoutResult($search);
      //mycart list
      $this->data['cartList'] = $this->cart->cartList($this->cart_session_id);
      $this->load->view('checkout', $this->data);
    } else {
      redirect('/');
    }
  }

  public function shipping()
  {
    $use_wallet = base64_decode($this->uri->segment(2));
    if (!empty($this->user_id)) {
      $this->data['use_wallet'] = $use_wallet;
      $where = array('status' => 1, 'trash' => 0, 'user_id' => $this->user_id);
      $this->data['address_list'] = $this->user->commonGetAll('ga_address_tbl', $where);
      $this->data['userinfo'] = $this->user->commonGetWhere('ga_users_tbl', array('user_status' => 1, 'trash' => 0, 'user_id' => $this->user_id));
      $last_address = $this->db->select('address,city,pincode')
        ->from('ga_orders_tbl')
        ->where(array('userid' => $this->user_id, 'orderstatus' => 1))
        ->order_by('orderdate', 'desc')->limit(1)->get();
      if ($last_address->num_rows() > 0) {
        $last_address = $last_address->row();
        $this->data['last_address'] = $last_address;
      }
      $this->load->view('shipping_view', $this->data);
    } else {
      redirect('/register');
    }
  }
  public function getAddress()
  {

    $id = $this->input->post('address_id');

    if (num_check($id)) {
      $where = array('status' => 1, 'trash' => 0, 'id' => $id);
      $add_qry = $this->user->commonAddress('ga_address_tbl', $where);
      echo $add_qry;
    }
  }

  public function getCartProperties()
  {

    $carttype = $this->input->post('carttype');
    $result = $this->checkout->checkoutStatistics($this->cart_session_id, $carttype);
    echo $result;
  }
  public function test()
  {

    $this->session->unset_userdata('cart_session_id');
    $this->session->userdata('cart_session_id');
  }
 
 
}
