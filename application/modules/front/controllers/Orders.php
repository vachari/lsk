<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Orders extends CI_Controller
{
	public $user_id;
	public $cart_session_id;
	public $item_data;
	public $tot_wallet_amount;
	public $user_wallet_amount;
	public function __construct()
	{
		parent::__construct();


		$this->load->library('Sendmail');
		$this->load->model(array('Cart_model' => 'cart', 'User_model' => 'user', 'Checkout_model' => 'checkout'));
		$this->load->model('Orders_model');
		$this->cart_session_id = $this->session->userdata('cart_session_id');
		$this->user_id = $this->session->userdata('user_id');
		#loading menus  here 
		$this->data['menuList'] = $this->Common->mainMenuList();
		#getting cart details 
		$this->data['sharecart_result'] = $this->checkout->checkoutResult(array('cart_session' => $this->cart_session_id));
		$c_ses = $this->cart_session_id;
		$this->data['cartList'] = $this->cart->cartList($c_ses);
		$this->data['cartStatistics'] = $this->checkout->checkoutStatistics($c_ses);
		$this->data['cartUStatistics'] = $this->checkout->checkoutUserStatistics($c_ses);
		$this->tot_wallet_amount = 0;
	}
	public function orders()
	{
		// echo $this->cart_session_id;
		//  print_r($this->data['cartUStatistics'] );exit;
		/*  Generate Order Id   */
		$tot_wallet_amount = $this->tot_wallet_amount;
		$ordernumber = ORDER_EXT . time() . rand(0, 222);
		$user_id = $this->user_id;
		$where = array('user_id' => $user_id);
		//getting user data
		$user_data_raw = $this->user->getUserDetails($this->user_id);
		$user_data = json_decode($user_data_raw);
		$power_user = $user_data->result->power_user_id;
		if ($power_user == 0) {
			$power_user = $this->user_id;
		}
		$email = $user_data->result->user_email;

		// Geting cart statics 
		$cartStatisticsReq = json_decode($this->data['cartUStatistics']);

		$orderitems = $cartStatisticsReq->cart_count;
		$orderqty = $cartStatisticsReq->cart_qty;
		$delivery_due_date = date('Y-m-d', strtotime(' + 2 days'));
		// Post data 
		$name = $this->input->post('name');
		$mobile = $this->input->post('phone');
		// $address=ucfirst($name).','.$this->input->post('address');
		$address = $this->input->post('address');

		$state = $this->input->post('state');
		$city = $this->input->post('city');
		$pincode = $this->input->post('pincode');
		$inputpayment_mod = $this->input->post('mod');

		if (strtolower(trim($inputpayment_mod)) == "cod") {
			$payment_mod = 1;
			$orderstatus = 1;
		}
		if (strtolower(trim($inputpayment_mod)) == "online") {
			$payment_mod = 2;
			$orderstatus = 0;
		}

		//print_r($_POST);exit;

		if (!empty($name) &&  !empty($mobile) && !empty($address) && !empty($state) && !empty($city) && !empty($pincode) && !empty($payment_mod)) {

			if ($cartStatisticsReq->cart_amount && $cartStatisticsReq->cart_shipping && $cartStatisticsReq->cart_grand_total != 0) {
				$insert_array = array(
					'ordernumber'       => $ordernumber,
					'orderqty'          => $orderqty,
					'ordertype'			=> $payment_mod,
					'ordertotalitems'   => $orderitems,
					'ordercartsession'  => $this->cart_session_id,
					'email'             => $email,
					'mobile'            => $mobile,
					'address'           => $address,
					'city'				=> $city,
					'pincode'           => $pincode,
					'orderprice'        => $cartStatisticsReq->cart_amount,
					'shippingprice'     => $cartStatisticsReq->cart_shipping,
					'totalpayableprice' => $cartStatisticsReq->cart_grand_total,
					'orderstatus'       => $orderstatus,
					'orderdate'         => DATE,
					'delivery_due_date' => $delivery_due_date,
					'expected_delivery_date' => $delivery_due_date,
					'userid'          => $this->user_id,
				);

				$current_pay_amount = $cartStatisticsReq->cart_grand_total;
				$insert_data = $this->Crud->commonInsert('ga_orders_tbl', $insert_array, 'Order Placed Successfully');
				$insert_data = json_decode($insert_data);
				if ($payment_mod == 2) {
					/*Paymentn gateway related variables setup */
					$this->session->set_userdata('order_no', $ordernumber);
					$this->session->set_userdata('pay_email', $email);
					$this->data['pay_name'] = $name;
					$this->data['pay_amount'] = $current_pay_amount;
					$this->load->view('razorPay', $this->data);
					/*Paymentn gateway related variables ENd */
				}
			} else {
				$this->session->set_flashdata('failed', 'Empty the cart please add items');
				redirect('/');
			}
		} else {
			echo "coming to here for firled";
			exit;
			$this->session->set_flashdata('failed', 'Please fill all  fields');
			redirect('/checkout');
		}
	}

	public function payment()
	{
		print_r($_POST);
		if ($_POST['razorpay_payment_id']) {
			/* >> Cart status and Order id update */
			$ordernumber = $this->session->userdata('order_no');
			$email = $this->session->userdata('pay_email');
			$payment_id = $_POST['razorpay_payment_id'];
			$where_cond = array('ordercartsession' => $this->cart_session_id);
			$order_data_raw = $this->db->select('orderid')->from('ga_orders_tbl')->where($where_cond)->order_by('orderid', 'DESC')->limit(1, 0)->get()->row();

			$order_id = $order_data_raw->orderid;
			$updatedata = array('orderstatus' => 1, 'payment_status' => 1, 'payment_id' => $payment_id);
			$update = $this->Crud->commonUpdate('ga_orders_tbl', $updatedata, ['orderid' => $order_id]);
			$update_data = array('order_id' => $order_id, 'cart_status' => 1);
			$update_condition = array('cart_session_id' => $this->cart_session_id, 'order_id' => 0);
			$update = $this->Crud->commonUpdate('ga_cart_tbl', $update_data, $update_condition);
			$update = json_decode($update);
			unset($_SESSION['cart_session_id']);
			if ($update->code == 200) {

				$this->session->set_flashdata('success', 'Your  Order ( #' . $ordernumber . ' )   Successfully Placed.');
				$data = array(
					'order_number' => $ordernumber,
					'order_date' => DATE,
					'order_status' => 1,
				);
				/*    Email code stats    */
				$subject = "Order Successfully Placed";
				$this->data['order_data'] = array(
					'order_number' => $ordernumber,
					'order_date' => DATE,
					'order_status' => 1,
				);
				if (SITE_MODE == 1) {
					$result = $this->sendmail->sendEmail(
						array(
							'to' => array($email),
							'cc' => array('info@' . SITE_DOMAIN),
							'bcc' => array(BCC_EMAIL),
							'subject' => $subject,
							'data' => array('order_data' => $this->data['order_data'], 'cartList' => $cartList, 'checkoutStatistics' => $checkoutStatistics),
							'template' => EMAIL_TEMPLATE_FOLDER . '/order_status_temp',
						)
					);
				}

				$this->load->view('order_status/order_success', $this->data);
			} else {
				$this->session->set_flashdata('failed', 'Order Failed ');
				$this->load->view('order_status/order_success', $this->data);
			}
			$this->session->unset_userdata('order_no');
			$this->session->unset_userdata('pay_email');
		} else {
			$this->session->set_flashdata('failed', 'Order Failed ');
			$this->load->view('order_status/order_success', $this->data);
		}
	}

	public function orderEmail()
	{
		$orderdata = array('order_id' => $this->session->userdata('order_id'), 'user_id' => $this->user_id);
		$this->data['mycart'] =	$this->order->cartList($orderdata);
		$this->data['byuser'] =	$this->order->shareCartByUser($orderdata);
		$this->data['byitem'] =	$this->order->shareCartByItem($orderdata);
		// print_r($this->data['byitem']);
	}

	public function cancelOrder()
	{
		$order_id = $this->uri->segment(2);
		$refund_amount = base64_decode($this->uri->segment(3));
		//---------------------------------
		//Getting total_amount from cart_tbl
		$refund_amount_raw = $this->db->select("SUM(total_amount) + SUM(shipping_charges) as cart_refund_amount")->from('ga_cart_tbl')
			->where(array('user_id' => $this->user_id, 'order_id' => $order_id, 'cart_status' => 5))->get();
		if ($refund_amount_raw->num_rows() > 0) {
			$refund_amount = ($refund_amount) - ($refund_amount_raw->row()->cart_refund_amount);
		}
		$update_data = array('orderid' => $order_id, 'userid' => $this->user_id, 'orderstatus' => 5, 'cancelled_date' => DATE);
		// print_r($update_data);exit;
		$update_condition = array('userid' => $this->user_id, 'orderid' => $order_id);
		$update = $this->Crud->commonUpdate('ga_orders_tbl', $update_data, $update_condition);
		$update = json_decode($update);
		if ($update->code == SUCCESS_CODE) {
			$this->session->set_flashdata('success', 'Order Canceled Successfully');
			/*
					 
					* Updating the cart status to 5(cancel case)
					*/
			$update_data = array('cart_status' => 5);
			$update_condition = array('user_id' => $this->user_id, 'order_id' => $order_id);
			$update = $this->Crud->commonUpdate('ga_cart_tbl', $update_data, $update_condition);
			$user_data_raw = $this->user->commonGetWhere('ga_users_tbl', array('user_id' => $this->user_id));
			$user_data = json_decode($user_data_raw);
			// print_r($user_data);exit;
			$email = $user_data->result->user_email;
			$order = json_decode($this->user->commonGetWhere('ga_orders_tbl', array('orderid' => $order_id)));
			$ordernumber = $order->result->ordernumber;
			$this->data['order_data'] = array(
				'name' => $user_data->result->user_name,
				'order_number' => $ordernumber,
				'order_date' => DATE, // canceled date 
			);
			$result = $this->sendmail->sendEmail(
				array(
					'to' => array($email),
					'cc' => array('info@' . SITE_DOMAIN),
					'bcc' => array(BCC_EMAIL),
					'subject' => 'Order Cancellation ',
					'data' => array('orderdata' => $this->data['order_data']),
					'template' => EMAIL_TEMPLATE_FOLDER . '/order_cancel_page',
				)
			);
			//check if the user has already canceled order or not 
			$is_user_in_wallet = $this->Crud->commonCheck('user_id', 'ga_wallet_tbl', array('user_id' => $this->user_id));
			//this function returns 1 if exist 0 if not
			if ($is_user_in_wallet) {
				//Do Update
				$this->tot_wallet_amount = $tot_wallet_amount = $this->tot_wallet_amount + $refund_amount;
				$update_wallet_data = array(
					'user_id' => $this->user_id,
					'tot_wallet_amount' => $tot_wallet_amount
				);
				$update = $this->Crud->commonUpdate('ga_wallet_tbl', $update_wallet_data, ['user_id' => $this->user_id]);
				//$this->session->set_userdata('$tot_wallet_amount',$tot_wallet_amount);
			} else {

				$insert_wallet_data = array(
					'user_id' => $this->user_id,
					'tot_wallet_amount' => $refund_amount
				);
				//$this->session->set_userdata('tot_wallet_amount',$refund_amount);
				$this->tot_wallet_amount = $this->tot_wallet_amount + $refund_amount;
				$insert_data = $this->Crud->commonInsert('ga_wallet_tbl', $insert_wallet_data);
			}

			/*if($result['code'] == 1 ){
				redirect('/myorders');	
				}*/
		}
		redirect('/myorders');
	}
	/*
	*  
	* Issure	:To delete specific data from an order which already placed
	*/
	public function remove_order_items()
	{
		$cart_id = base64_decode($this->uri->segment(2));
		$refund_amount = base64_decode($this->uri->segment(3)) + 20;
		// print_r($update_data);exit;
		$update_data = array('cart_status' => 5, 'cancelled_date' => DATE);
		$update_condition = array('user_id' => $this->user_id, 'cart_id' => $cart_id);
		$update = $this->Crud->commonUpdate('ga_cart_tbl', $update_data, $update_condition);
		$update = json_decode($update);
		if ($update->code == SUCCESS_CODE) {
			$order_id = $this->db->select('order_id')->from('ga_cart_tbl')->where('cart_id', $cart_id)->limit(1, 0)->get()->row()->order_id;
			$this->session->set_flashdata('success', 'Item Deleted Successfully');

			$email = $user_data->result->user_email;

			//check if the user has already canceled order or not
			$is_user_in_wallet = $this->Crud->commonCheck('user_id', 'ga_wallet_tbl', array('user_id' => $this->user_id));
			//this function returns 1 if exist 0 if not
			if ($is_user_in_wallet) {
				//Do Update
				$tot_wallet_amount = $this->tot_wallet_amount = $this->tot_wallet_amount + $refund_amount;
				$update_wallet_data = array(
					'user_id' => $this->user_id,
					'tot_wallet_amount' => $tot_wallet_amount
				);
				$update = $this->Crud->commonUpdate('ga_wallet_tbl', $update_wallet_data, ['user_id' => $this->user_id]);
				//$this->session->unset_userdata('tot_wallet_amount');
				//$this->session->set_userdata('tot_wallet_amount',$tot_wallet_amount);
			} else {
				//Do Insert
				//$tot_wallet_amount=$this->db->select("SUM(totalpayableprice)as tot_wallet_amount")->from('ga_orders_tbl')
				//->where(array('userid'=>$this->user_id,'orderstatus'=>5))->get();
				//$this->tot_wallet_amount=$tot_wallet_amount->row()->tot_wallet_amount;
				$insert_wallet_data = array(
					'user_id' => $this->user_id,
					'tot_wallet_amount' => $refund_amount
				);
				//$this->session->set_userdata('tot_wallet_amount',$refund_amount);
				$this->tot_wallet_amount = $this->tot_wallet_amount + $refund_amount;
				$insert_data = $this->Crud->commonInsert('ga_wallet_tbl', $insert_wallet_data);
			}

			/*if($result['code'] == 1 ){
				redirect('/myorders');	
				}*/
		}
		redirect('/myorders');
	}
	public function update_order()
	{
	}
	public function send_user_email($to, $from, $subject, $message)
	{
		$config = array(
			// 'protocol' => 'smtp', 
			// 'smtp_host' => 'ssl://smtp.googlemail.com', 
			// 'smtp_port' => 465, 
			// 'smtp_user' => '', 
			// 'smtp_pass' => '',
			'charset' => 'utf-8',
			'newline' => "\r\n",
			'mailtype' => 'html',
			'validation' => true
		);
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->to($to);
		$this->email->from($from);
		$this->email->subject($subject);
		$this->email->message($message);
		if ($this->email->send()) {
			return true;
		} else {
			return false;
		}
	}


	public function tempPayment()
	{

		/* >> Cart status and Order id update */
		$ordernumber = $this->session->userdata('order_no');
		$email = $this->session->userdata('pay_email');
		$payment_id = 'PAYMENT_ID';
		$where_cond = array('ordercartsession' => $this->cart_session_id);
		$order_data_raw = $this->db->select('orderid')->from('ga_orders_tbl')->where($where_cond)->order_by('orderid', 'DESC')->limit(1, 0)->get()->row();

		$order_id = $order_data_raw->orderid;
		$updatedata = array('orderstatus' => 1, 'payment_status' => 1, 'payment_id' => $payment_id);
		$update = $this->Crud->commonUpdate('ga_orders_tbl', $updatedata, ['orderid' => $order_id]);
		$update_data = array('order_id' => $order_id, 'cart_status' => 1);
		$update_condition = array('cart_session_id' => $this->cart_session_id, 'order_id' => 0);
		$update = $this->Crud->commonUpdate('ga_cart_tbl', $update_data, $update_condition);
		$update = json_decode($update);
		unset($_SESSION['cart_session_id']);
		if ($update->code == 200) {
			$this->session->set_flashdata('success', 'Your  Order ( #' . $ordernumber . ' )   Successfully Placed.');

			$data = array(
				'order_number' => $ordernumber,
				'order_date' => DATE,
				'order_status' => 1,
			);





			/*    Email code stats    */
			$subject = "Order Successfully Placed";
			$this->data['order_data'] = array(
				'order_number' => $ordernumber,
				'order_date' => DATE,
				'order_status' => 1,
			);
			if (SITE_MODE == 1) {
				$result = $this->sendmail->sendEmail(
					array(
						'to' => array($email),
						'cc' => array('info@' . SITE_DOMAIN),
						'bcc' => array(BCC_EMAIL),
						'subject' => $subject,
						'data' => array('order_data' => $this->data['order_data'], 'cartList' => $cartList, 'checkoutStatistics' => $checkoutStatistics),
						'template' => EMAIL_TEMPLATE_FOLDER . '/order_status_temp',
					)
				);
			}

			$this->load->view('order_status/order_success', $this->data);
		} else {
			$this->session->set_flashdata('failed', 'Order Failed ');
			$this->load->view('order_status/order_success', $this->data);
		}
		$this->session->unset_userdata('order_no');
		$this->session->unset_userdata('pay_email');
	}
}
