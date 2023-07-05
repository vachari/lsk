<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * FileName :Sharecart.php
 * PageType : Controller
 * PagePath : front/Sharecart.php
 * Page Purpose : Sharecart  related to Add Sharecart related quries
 * Created Date : 09-06-2017
 * Created by : Jithendra Kumar
 */
class Sharecart extends CI_Controller {	
		public $user_id;	
		public $ipaddress;	
		public $cart_session_id;
		public function __construct(){
			parent::__construct();
			$this->vendor_id = $this->session->userdata('vendor_id');
	        if(!empty($this->vendor_id)){
	        	redirect(base_url().'vendor/dashboard');
	        }

				$this->load->model(array('Cart_model','Pages_model','Sharecart_model'));

				$this->user_id=$this->session->userdata('user_id');
				$this->cart_session_id=$this->session->userdata('cart_session_id');

				if(empty($this->cart_session_id))
				{
					$this->cart_session_id= time().rand(00,99999).session_id();
					$this->session->set_userdata('cart_session_id',$this->cart_session_id);
				}

		}

	public function index(){

		$product_id= $this->input->post('id');
		if(!empty($product_id)){

			$qty=1;
			$up_qty='';
			//geting data form data base 
			$whereproduct=array('id'=>$product_id);
			$this->data['product']=$this->Cart_model->commonGetWhere('ga_main_prod_details_tbl',$whereproduct);
			$whereprice=array('prod_id'=>$product_id);
			$this->data['price']=$this->Cart_model->commonGetWhere('ga_prod_item_pricing_tbl',$whereprice);

			$price=json_decode($this->data['price']);
			$unit_price=$price->result->selling_price;
			$total_amount=round($qty*$unit_price);
			// checking existance 
			$whereprod=array('prod_id'=>$product_id,'cart_session_id'=>$this->cart_session_id,'cart_status'=>0,'cart_type'=>2);
		 $check_prod=$this->Crud->commonCheck('cart_id','ga_cart_tbl',$whereprod);	
 			 if($check_prod == 0 && is_numeric($check_prod))
 			 {
					$data=array(
								'prod_id'=>$product_id,
								'qty'=>$qty,
								'cart_type'=>2,
								'unit_price'=>$unit_price,
								'total_amount'=>$total_amount,
								'cart_session_id'=>$this->cart_session_id,
								'created_date'=>DATE,
								);
					$result=$this->Crud->commonInsert('ga_cart_tbl', $data);
				if($result){
					$response[CODE] = SUCCESS_CODE;
	                $response[MESSAGE] = 'Success';
	                $response[DESCRIPTION] = 'Item Added to Cart Successfully';

				}
				else
				{
					$response[CODE] = FAIL_CODE;
	                $response[MESSAGE] = 'Fail';
	                $response[DESCRIPTION] = 'Product not added to card';
				}
				
			}
			else
				{

				//product update qty starts form here
				$this->db->select('qty');
				$this->db->from('ga_cart_tbl');
				$this->db->where('prod_id',$this->input->post('id'));
				$reault_array = $this->db->get()->row();
				json_encode($reault_array );

				$up_qty=$reault_array->qty+1;
				$total_price=$up_qty*$unit_price;
				$update_condition=array('prod_id'=>$product_id,'cart_session_id'=>$this->cart_session_id,'cart_type'=>2);
					$update_data=array(
								'qty'=>$up_qty,
								'total_amount'=>$total_price,
								'created_date'=>DATE,
								);
					$result=$this->Crud->commonUpdate('ga_cart_tbl', $update_data,$update_condition);
				if($result){
					$response[CODE] = SUCCESS_CODE;
	                $response[MESSAGE] = 'Success';
	                $response[DESCRIPTION] = 'Share Item updated to Cart Successfully';
			
		}
		
		echo json_encode($response);
		$this->data['curres']=$response;
		$this->data['cartList']=$this->Cart_model->cartList($this->cart_session_id,2);

		$this->load->view('cart_ajax',$this->data);

	}
	
}
}

	 public function checkOut()
	{
		$this->load->view('checkout',$this->data);
	}

	 public function sharecartList(){
	 		 $respose['sharecartList'] = $this->Cart_model->cartList($this->cart_session_id,2);

    }
   
  

}