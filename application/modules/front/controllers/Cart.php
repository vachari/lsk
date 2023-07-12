<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
	public $user_id;
	public $ipaddress;
	public $cart_session_id;
	public $user_type;
	public function __construct()
	{
		parent::__construct();

		$this->cart_session_id = $this->session->userdata('cart_session_id');
		if (empty($this->cart_session_id)) {
			$this->cart_session_id = time() . rand(00, 99999) . session_id();
			$this->session->set_userdata('cart_session_id', $this->cart_session_id);
		}

		$this->user_id = $this->session->userdata('user_id');

		// share cart 
		$this->load->model(array('Product_model', 'Cart_model'));
		$this->load->model(array('Checkout_model' => 'checkout', 'User_model' => 'user'));
		$this->data['menuList'] = $this->Common->mainMenuList();
		$c_ses = $this->cart_session_id;
		$this->data['cartList'] = $this->Cart_model->cartList($c_ses);
		//$this->data['sharecart_result'] = $this->checkout->checkoutResult(array('cart_session' => $this->cart_session_id));
		$this->data['cartStatistics'] = $this->checkout->checkoutStatistics($c_ses);
		$this->data['cartUStatistics'] = $this->checkout->checkoutUserStatistics($c_ses);
	}

	public function cartList()
	{
		$this->load->view('cartList', $this->data);
	}
	public function add_to_mycart()
	{
		//power_approved
		$response = array();
		if (!empty($this->user_id)) {
			$user_id = $this->user_id;
		} else {
			$user_id = 0;
		}
		$product_id = $this->input->post('id');
		$cart_type = $this->input->post('cartType');
		$qty = $this->input->post('qty');
		$cart_data = array(
			'prod_id' => $product_id,
			'qty' => $qty,
			'user_id' => $user_id,
			'cart_type' => $cart_type,
			'cart_session_id' => $this->cart_session_id
		);
		$data = $this->Cart_model->add_mycart($cart_data);
	}
	public function follower_session_id()
	{
		$follower_session = $this->uri->segment(4);
		//$url=base_url().'register';
		$url = base_url() . 'signin';
		$this->session->set_userdata('cart_session_id', $follower_session);
		$this->cart_session_id = $this->session->userdata('cart_session_id');
		redirect($url);
	}
	public function cart_session_id()
	{
		$cartsession = $this->uri->segment(4);
		$url = base_url() . 'checkout';
		$this->session->set_userdata('cart_session_id', $cartsession);
		$this->cart_session_id = $this->session->userdata('cart_session_id');
		redirect($url);
	}

	public function getCartData()
	{
		// $cart_id=$this->input->post('cart_id');
		// $params=array('cart_session_id'=>$this->cart_session_id);
		$res = $this->checkout->checkoutStatistics($this->cart_session_id);
		echo $res;
		exit;
	}



	public function cartItemRemove()
	{
		$response = array();
		$relationname = 'Your data';
		$tablename = $this->input->post('tablename');
		$updatelist = $this->input->post('updatelist');


		if ($tablename != '') {
			$table = '';
			$wherecondition = '';
			switch ($tablename) {

				case 'cart':
					$table = 'ga_cart_tbl';
					$wherecondition = array('cart_id' => $updatelist, 'cart_session_id' => $this->cart_session_id);
					break;
			}
			$delete = $this->Crud->commonDelete($table, $wherecondition, $relationname);
			echo $delete;
			exit;
		}
		echo json_encode($response);
	}

	public function updateCartForm()
	{
		$cartID = $_POST['cartid'];
		$qty = $_POST['qty'];

		for ($i = 0; $i < count($cartID); $i++) {
			$table = 'ga_cart_tbl';

			$wherecondition = array('cart_id' => $cartID[$i], 'cart_session_id' => $this->cart_session_id);
			$cartSql = $this->db->select('unit_price')->from($table)->where($wherecondition)->get();
			$cartCount = $cartSql->num_rows();
			if ($cartCount > 0) {
				$sellingPrice = $cartSql->row()->unit_price;
				$qtyWithPrice = ($qty[$i] * $sellingPrice);
				$this->db->update($table, ['qty' => $qty[$i],'total_amount'=>$qtyWithPrice],$wherecondition);
			}
		}
		echo json_encode(['code' => 200]);
	}
}
