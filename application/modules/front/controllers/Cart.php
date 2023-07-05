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
	public function cartUpdate()
	{
		$cart_id = $this->input->post('cart_id');
		$qty = $this->input->post('qty');
		$update_condition = array('cart_id' => $cart_id);
		$resil = $this->Cart_model->commonGetWhere('ga_cart_tbl', $update_condition);
		$res = json_decode($resil);
		$prod_id = $res->result->prod_id;
		$prod_qty = $res->result->qty;
		$unit_price1 = $res->result->unit_price;
		$where = array('prod_id' => $prod_id, 'qty_range_from <=' => $qty, 'qty_range_to >=' => $qty);

		$get_item_pricing = json_decode($this->Cart_model->commonGetWhere('ga_prod_item_pricing_tbl', $where));
		if ($get_item_pricing->result) {
			$res2 = $get_item_pricing->result;
			$unit_price2 = $res2->selling_price;
		} else {
			$where2 = array('prod_id' => $prod_id);
			$get_item_pricing2 = $this->Cart_model->commonGetWhere2('ga_prod_item_pricing_tbl', $where2);
			$ress = json_decode($get_item_pricing2);
			$unit_price2 = $ress->result->selling_price;
		}
		$total1 = $res->result->unit_price * $qty;
		$total2 = $unit_price2 * $qty;
		$discount = $total1 - $total2;
		$update_data = array('qty' => $qty, 'discount' => $discount, 'total_amount' => $total1);
		$res_update = $this->Crud->commonUpdate('ga_cart_tbl', $update_data, $update_condition);
		echo $res_update;
		exit;
	}
	public function getCartData()
	{
		// $cart_id=$this->input->post('cart_id');
		// $params=array('cart_session_id'=>$this->cart_session_id);
		$res = $this->checkout->checkoutStatistics($this->cart_session_id);
		echo $res;
		exit;
	}

	public function addsharecart()
	{
		$response = array();
		$end_date = stripslashes(strtoupper(trim($this->input->post('datepicker'))));
		$this->session->set_userdata("share_cart_date", $end_date);
		$data = array(
			'user_id' => $this->user_id,
			'session_id' => $this->cart_session_id,
			'start_date' => DATE,
			'end_date' => date("Y-m-d", strtotime($end_date))
		);
		$session_id = $this->cart_session_id;
		$shared_data = array(
			'session_id' => $session_id,
			'shared_by'  => $this->user_id,
			'shared_on'  => DATE,
			'end_date'	 => date("Y-m-d", strtotime($end_date)),
			'status'     => 1
		);
		//echo $session_id;exit;
		$whereconditionss = array('session_id' => $session_id);
		$sharedcartCheckData = $this->Crud->commonCheck('id', 'ga_sharecart_displaydate_tbl', $whereconditionss);
		if ($sharedcartCheckData == 0) {
			$url = base_url() . 'front/cart/follower_session_id/' . $session_id;
			$where = array('user_id' => $this->user_id);
			$where2 = array('power_user_id' => $this->user_id);
			$powerUser = $this->user->commonGetAll('ga_users_tbl', $where);
			$powerUser = json_decode($powerUser);
			foreach ($powerUser->result as $powerUser) {
				$powerUserName = $powerUser->user_name;
			}
			$followers = $this->user->commonGetAll('ga_followers_tbl', $where2);
			$followers = json_decode($followers);
			$email = array();
			foreach ($followers->result as $follower) {
				$email[] = $follower->email;
			}
			$to = implode(',', $email);
			$subject = "Share Cart details from Power User";
			/*$result = $this->sendmail->sendEmail(
								array(
									'to' => array($to),
									'cc' => array('info@' . SITE_DOMAIN),
									'bcc' => array(BCC_EMAIL),
									'subject' => $subject,
									'data' => array('powerUserName'=>$powerUserName,'end_date'=>$end_date,'link'=>$url),
									'template' => EMAIL_TEMPLATE_FOLDER.'/shareCart',
								)
							);*/
			$result['code'] = 1;
			if ($result['code'] == 1) {
				$sharedCart = $this->Crud->commonInsert('ga_shared_cart_tbl', $shared_data, 'Cart shared Successfully');
				$sharecartDisplayDate = $this->Crud->commonInsert('ga_sharecart_displaydate_tbl', $data, 'Shared cart inserted Successfully');
				$response[CODE] = SUCCESS_CODE;
				$response[MESSAGE] = 'Success';
				$response[DESCRIPTION] = 'You have shared this cart to your followers Successfully';
				echo json_encode($response);
			} else {
				$response[CODE] = FAIL_CODE;
				$response[MESSAGE] = 'Failed';
				$response[DESCRIPTION] = 'Unabled to share this cart, please try again';
				echo json_encode($response);
			}
		} else {
			$response[CODE] = FAIL_CODE;
			$response[MESSAGE] = 'Failed';
			$response[DESCRIPTION] = 'You have already shared this cart to your followers';
			echo json_encode($response);
		}
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
}
