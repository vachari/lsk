<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	public $user_id;
	public function __construct()
	{
		parent::__construct();
		$this->vendor_id = $this->session->userdata('vendor_id');
		if (!empty($this->vendor_id)) {
			redirect(base_url() . 'vendor/dashboard');
		}
		//loading model to use
		$this->load->model(array('Cart_model', 'Pages_model', 'Product_model'));
		// using the session variable for geting user id
		$this->user_id = $this->session->userdata('user_id');
		$this->cart_session_id = $this->session->userdata('cart_session_id');

		//loading menus for Dispalying 
		$where = array('flag_status' => 1, 'trash' => 0);
		//loading menus ends here 
		$this->data['menuList'] = $this->Common->mainMenuList();
		$order_all = '';
		$whe_pro = array('mp.active_status' => 1, 'mp.trash' => 0);
		$this->data['allproducts'] = $this->Product_model->get_products($whe_pro, $order_all);
		$this->load->model(array('Checkout_model' => 'checkout'));
		//getting cart data form data base  starts from here 
		$this->data['cartList'] = $this->Cart_model->cartList($this->cart_session_id, 1);
		/*>> Loading COmmin listing model code start */
		$this->load->model(array('Checkout_model' => 'checkout'));
		$this->data['sharecart_result'] = $this->checkout->checkoutResult(array('cart_session' => $this->cart_session_id));
		$this->data['cartStatistics'] = $this->checkout->checkoutStatistics($this->cart_session_id);

		/* >> Loading COmmin listing model code end */
	}

	public function getMenus()
	{
		$me = base64_decode($this->uri->segment(3));
		
		$order = '';
		// $order=$this->input->post('order_by');

		$where_prod = array('mp.active_status' => 1, 'mp.trash' => 0, 'mp.category' => $me);
		$this->data['products'] = $this->Product_model->get_products($where_prod, $order);
		$prod = json_decode($this->data['products']);
		if ($prod->code == 200) {
			$p_id = $prod->result[0]->id;
			$where_price = array('item_status' => 1, 'trash' => 0);
			$cols_price = array('id', 'prod_id', 'prod_code', 'unit_of_measure', 'qty_range_from', 'qty_range_to', 'form_date', 'to_date', 'selling_price', 'currency', 'item_status', 'trash');
			$this->data['price'] = $this->Product_model->commonGetAll('ga_prod_item_pricing_tbl', $where_price, $cols_price);
		}
		//check if individual user order status is set to one or not
		$resp_in = json_decode($this->Cart_model->commonGetWhere('individual_user_order_tbl', array('id' => 1)));
		$in_order_status = $resp_in->result->status;
		$this->data['individual_user_order_status'] = $in_order_status;
		$this->data['index_wish_result'] = $this->checkout->return_wishlist();
		$this->load->view('products_view_page', $this->data);
	}


	public function getSub()
	{
		$subCat = base64_decode($this->uri->segment(4));
		// echo $subCat;exit;
		$order = 1;
		$order = $this->input->post('order_by');
		$where_prod = array('mp.active_status' => 1, 'mp.trash' => 0, 'mp.sub_category' => $subCat);
		$this->data['products'] = $this->Product_model->get_products($where_prod, $order);
		//check if individual user order status is set to one or not
		$resp_in = json_decode($this->Cart_model->commonGetWhere('individual_user_order_tbl', array('id' => 1)));
		$in_order_status = $resp_in->result->status;
		$this->data['individual_user_order_status'] = $in_order_status;
		// print_r($this->data['products']);
		$this->load->view('products_view_page', $this->data);
	}


	public function getlistSub()
	{
		$listsubCat = base64_decode($this->uri->segment(5));
		$order = 1;
		$order = $this->input->post('order_by');
		// echo $listsubCat;exit;	
		$where_prod = array('mp.active_status' => 1, 'mp.trash' => 0, 'mp.listsubmenu_id' => $listsubCat);
		$this->data['products'] = $this->Product_model->get_products($where_prod, $order);
		$prod = json_decode($this->data['products']);
		if ($prod->code == 200) {
			$p_id = $prod->result[0]->id;
			$where_price = array('item_status' => 1, 'trash' => 0);
			$cols_price = array('id', 'prod_id', 'prod_code', 'unit_of_measure', 'qty_range_from', 'qty_range_to', 'form_date', 'to_date', 'selling_price', 'currency', 'item_status', 'trash');
			$this->data['price'] = $this->Product_model->commonGetAll('ga_prod_item_pricing_tbl', $where_price, $cols_price);
		}
		//check if individual user order status is set to one or not
		$resp_in = json_decode($this->Cart_model->commonGetWhere('individual_user_order_tbl', array('id' => 1)));
		$in_order_status = $resp_in->result->status;
		$this->data['individual_user_order_status'] = $in_order_status;
		// print_r($this->data['products']);
		$this->load->view('products_view_page', $this->data);
	}

	public function getMenuProducts()
	{


		$cat_id = base64_decode($this->uri->segment(3));
		$subcat_id = base64_decode($this->uri->segment(4));
		$listsubCat = base64_decode($this->uri->segment(5));
		$order = 1;
		$order = $this->input->post('order_by');

		if (is_numeric($cat_id) && !empty($cat_id)) {
			// echo "success";exit;
			$where_prod = array('mp.active_status' => 1, 'mp.trash' => 0, 'mp.category' => $cat_id);
			$this->data['products'] = $this->Product_model->get_products($where_prod, $order);
			$prod = json_decode($this->data['products']);
			if ($prod->code == 200) {
				$p_id = $prod->result[0]->id;
				$where_price = array('item_status' => 1, 'trash' => 0);
				$cols_price = array('id', 'prod_id', 'prod_code', 'unit_of_measure', 'qty_range_from', 'qty_range_to', 'form_date', 'to_date', 'selling_price', 'currency', 'item_status', 'trash');
				$this->data['price'] = $this->Product_model->commonGetAll('ga_prod_item_pricing_tbl', $where_price, $cols_price);
				// $this->load->view('products_view_page',$this->data);
			}
			$this->load->view('products_view_page', $this->data);
			exit;
		} else if (is_numeric($subcat_id && !empty($cat_id))) {
			echo "sub success";
			$where_prod = array('mp.active_status' => 1, 'mp.trash' => 0, 'mp.sub_category' => $subcat_id);
			$this->data['products'] = $this->Product_model->get_products($where_prod, $order);

			// print_r($this->data['products']);
			// $this->load->view('products_view_page',$this->data);
		} else if (is_numeric($listsubCat && !empty($cat_id))) {
			echo "list success";
			$where_prod = array('mp.active_status' => 1, 'mp.trash' => 0, 'mp.listsubmenu_id' => $listsubCat);
			$this->data['products'] = $this->Product_model->get_products($where_prod, $order);
			$prod = json_decode($this->data['products']);
			if ($prod->code == 200) {
				$p_id = $prod->result[0]->id;
				$where_price = array('item_status' => 1, 'trash' => 0);
				$cols_price = array('id', 'prod_id', 'prod_code', 'unit_of_measure', 'qty_range_from', 'qty_range_to', 'form_date', 'to_date', 'selling_price', 'currency', 'item_status', 'trash');
				$this->data['price'] = $this->Product_model->commonGetAll('ga_prod_item_pricing_tbl', $where_price, $cols_price);
			}

			// print_r($this->data['products']);
			// $this->load->view('products_view_page',$this->data);

		}
		$this->load->view('products_view_page', $this->data);
	}



	public function getSortedMenus()
	{

		// $me=base64_decode($this->uri->segment(3));
		$order = $this->input->post('order_by');
		$cat_id = $this->input->post('cat_id');
		$where_prod = array('mp.active_status' => 1, 'mp.trash' => 0, 'mp.category' => $cat_id);
		$this->data['products'] = $this->Product_model->get_products($where_prod, $order);
		$prod = json_decode($this->data['products']);
		if ($prod->code == 200) {
			$p_id = $prod->result[0]->id;
			$where_price = array('item_status' => 1, 'trash' => 0);
			$cols_price = array('id', 'prod_id', 'prod_code', 'unit_of_measure', 'qty_range_from', 'qty_range_to', 'form_date', 'to_date', 'selling_price', 'currency', 'item_status', 'trash');
			$this->data['price'] = $this->Product_model->commonGetAll('ga_prod_item_pricing_tbl', $where_price, $cols_price);
		}
		$this->load->view('ajax_products', $this->data);
	}
	public function productFilter()
	{
		$order = $this->input->post('sort');
		$cat_id = $this->input->post('cat_id');
		$subcat_id = $this->input->post('subcat_id');
		$listsubcat_id = $this->input->post('listsubcat_id');
		$price = $this->input->post('price');
		if ($listsubcat_id != 0) {
			$where_prod = array('mp.active_status' => 1, 'mp.trash' => 0, 'mp.listsubmenu_id' => $listsubcat_id);
		} elseif ($subcat_id != 0) {
			$where_prod = array('mp.active_status' => 1, 'mp.trash' => 0, 'mp.sub_category' => $subcat_id);
		} else {
			$where_prod = array('mp.active_status' => 1, 'mp.trash' => 0, 'mp.category' => $cat_id);
		}

		$this->data['products'] = $this->Product_model->get_ajax_products($where_prod, $order, $price);
		$prod = json_decode($this->data['products']);
		if ($prod->code == 200) {
			$p_id = $prod->result[0]->id;
			$where_price = array('item_status' => 1, 'trash' => 0);
			$cols_price = array('id', 'prod_id', 'prod_code', 'unit_of_measure', 'qty_range_from', 'qty_range_to', 'form_date', 'to_date', 'selling_price', 'currency', 'item_status', 'trash');
			$this->data['price'] = $this->Product_model->commonGetAll('ga_prod_item_pricing_tbl', $where_price, $cols_price);
		}
		$this->load->view('ajax_products', $this->data);
	}


	public function addRemoveWishlist()
	{
		$uid = $this->session->userdata("user_id");
		if (!empty($uid)) {
			$pid = $this->input->post('p_id');
			$this->checkout->wishlist($pid);
		}
		redirect("signin");
	}

	public function product_name()
	{
		extract($_POST);
		if (isset($search)) {
			$like = $search;
			redirect(base_url() . 'products/' . $search);
		} else {
			$like = '';
		}
		$like = urldecode($this->uri->segment(2));
		//echo $like;exit;	 
		$order = '';
		// $order=$this->input->post('order_by');
		$where_prod = array('mp.active_status' => 1, 'mp.trash' => 0);
		$this->data['products'] = $this->Product_model->products_by_name($where_prod, $order, $like);
		//print_r($this->data['products']);exit;
		$prod = json_decode($this->data['products']);
	 
		$this->data['index_wish_result'] = $this->checkout->return_wishlist();
		$this->load->view('products_view_page', $this->data);
	}
}
