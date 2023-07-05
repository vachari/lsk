<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * FileName :Orders.php
 * PageType : Controller
 * PagePath : front/Orders.php
 * Page Purpose : Orders  related  quries
 * Created Date : 5-07-2017
 * Created by : Jithendra Kumar
 */
class Orders extends CI_Controller {	

				public $user_id;	
				public $cart_session_id;
				public $item_data;
				public function __construct() {


			parent::__construct();
			$this->vendor_id = $this->session->userdata('vendor_id');
	        if(!empty($this->vendor_id)){
	        	redirect(base_url().'vendor/dashboard');
	        }
	   		 $this->load->library('Sendmail');
					$this->load->model(array('Cart_model'=>'cart','User_model'=>'user','Checkout_model'=>'checkout'));
					$this->load->model('Orders_model');
				$this->cart_session_id=$this->session->userdata('cart_session_id');
					$this->user_id=$this->session->userdata('user_id');
						#loading menus  here 
					$this->data['menuList']=$this->Common->mainMenuList();
						#getting cart details 
					$this->data['sharecart_result']= $this->checkout->checkoutResult(array('cart_session'=> $this->cart_session_id));
					$c_ses=$this->cart_session_id;
					$this->data['cartList']=$this->cart->cartList($c_ses);
					$this->data['cartStatistics']=$this->checkout->checkoutStatistics($c_ses);
					$this->data['cartUStatistics']=$this->checkout->checkoutUserStatistics($c_ses);
			}
		public function orders(){
			//Getting the tot_wallet_amount of current user from ga_wallet_tbl
			//Storing into Session for further use
			$tot_wallet_amount=$this->db->select("userid,SUM(totalpayableprice) as tot_wallet_amount")->from('ga_orders_tbl')
			->where(array('userid'=>$this->user_id,'orderstatus'=>'5'))->get();
			$tot_wallet_amount=$tot_wallet_amount->row()->tot_wallet_amount;
				$this->session->set_userdata(array('tot_wallet_amount'=>$tot_wallet_amount));									
			// Validations goes here 
			 /*  Generate Order Id   */ 
						 $ordernumber='SHPRTV'.time('t-s-m').rand(0,222);
						 //$ordernumber='S'.date('m-d').rand(0,222);
						 $user_id= $this->user_id;
						 $where=array('user_id'=>$user_id);
						 //getting user data
						 $user_data_raw=$this->user->getUserDetails($this->user_id);
						 $user_data=json_decode($user_data_raw);
						 $power_user = $user_data->result->power_user_id;
						 if($power_user==0){$power_user=$this->user_id;} 
						 $email = $user_data->result->user_email;

						 // Geting cart statics 
						 $cartStatisticsReq=json_decode($this->data['cartUStatistics']);
						 $orderitems=$cartStatisticsReq->cart_count;
						 $orderqty=$cartStatisticsReq->cart_qty;
						 $delivery_due_date=date('Y-m-d', strtotime(' + 2 days'));
							// Post data 
									$name=$this->input->post('name');
									$mobile=$this->input->post('mobile');
									// $address=ucfirst($name).','.$this->input->post('address');
									$address=$this->input->post('address');
									$state=$this->input->post('state');
									$city=$this->input->post('city');
									$pincode=$this->input->post('pincode');
									$payment_mod=$this->input->post('mod');
									// if(strtolower(trim($payment_mod)) =="cod"){$payment_mod=1;$orderstatus=1;}
									if(strtolower(trim($payment_mod)) =="online"){$payment_mod=2;$orderstatus=0;}

								 if(!empty($name) &&  !empty($mobile) && !empty($address) && !empty($state) && !empty($city) && !empty($pincode) && !empty($payment_mod) ){
								 		if($cartStatisticsReq->cart_amount && $cartStatisticsReq->cart_shipping && $cartStatisticsReq->cart_grand_total != 0 ){
												$insert_array = array(
													'ordernumber'       =>$ordernumber,
													'orderqty'          =>$orderqty,
													'ordertype'			=> $payment_mod,
													'ordertotalitems'   =>$orderitems,
													'ordercartsession'  =>$this->cart_session_id,
													'email'             =>$email,
													'mobile'            =>$mobile,
													'address'           =>$address,
													'city'				=>$city,
													'pincode'           =>$pincode,
													'orderprice'        =>$cartStatisticsReq->cart_amount,
													'shippingprice'     =>$cartStatisticsReq->cart_shipping,
													'totalpayableprice' =>$cartStatisticsReq->cart_grand_total,
													'orderstatus'       =>$orderstatus,
													'orderdate'         =>DATE,
													'delivery_due_date' => $delivery_due_date,
													'expected_delivery_date' => $delivery_due_date,
														'userid'          =>$this->user_id,
														'poweruserid' => $power_user
												);
											// print_r($insert_array);exit;
											/**
											* Update By	:Zabihullah
											* fetching tot_wallet_amount for the current user and store into session 
											*/
											$insert_data = $this->Crud->commonInsert('ga_orders_tbl', $insert_array, 'Order Placed Successfully');
											$insert_data = json_decode($insert_data);
											if($payment_mod==2){
												$total_wallet_amount=$this->session->userdata('tot_wallet_amount');
												$current_pay_amount=$cartStatisticsReq->cart_grand_total;
												/////////////Payment gateway start///////////
												$this->session->set_userdata('order_no',$ordernumber);
												$this->session->set_userdata('pay_email',$email);
												$this->data['pay_name']=$name;
												/**
												* Update By	Zabihullah
												* logic for the final amount to be paid by calculating the wallet amount
												* 
												*/
												//If there is amount in wallet
												//Either that amount is lessthan new pay amount or greater than
												if($tot_wallet_amount>0){
													//if there is some amount in wallet
													if($current_pay_amount >= $tot_wallet_amount){
														$tot_wallet_amount=0;
														$this->data['pay_amount'] = $current_pay_amount-$tot_wallet_amount;
														//unset the session('tot_wallet_amount')
														$this->session->unset_userdata('tot_wallet_amount');
														//Update ga_orders_tbl change status = 6 for this->user_id
														$this->Crud->commonUpdate('ga_orders_tbl',array('orderstatus'=>6),array('orderstatus'=>5,'userid'=>$this->user_id));
														//Update ga_wallet_tbl
														$this->Crud->commonUpdate('ga_wallet_tbl',array('tot_wallet_amount'=>$tot_wallet_amount),array('user_id'=>$this->user_id));
													}elseif($current_pay_amount < $tot_wallet_amount){
														$this->data['pay_amount']=1;
														$tot_wallet_amount = $tot_wallet_amount-$current_pay_amount;
														//here i cant decide how which item order status must be changed 
														//by now i will keep it like that
														$this->Crud->commonUpdate('ga_wallet_tbl',array('tot_wallet_amount'=>$tot_wallet_amount),array('user_id'=>$this->user_id));
														//Update the session for tot_wallet_amount!
														$this->session->set_userdata(array('tot_wallet_amount'=>$tot_wallet_amount));
													}else{
													//if there is no amount in wallet
													$this->data['pay_amount']=$current_pay_amount;
													}
												}//end mod
												$this->load->view('razorPay',$this->data);
											}																								
										}else{
											$this->session->set_flashdata('failed', 'Empty the cart please add items');
											redirect('/');
										}			
											/////////////Placing order end////////////////// 										
									}else{
										$this->session->set_flashdata('failed', 'Please fill all  fields');
										redirect('/shipping');
									}
		}
	// public function test(){
	// 	$order_id=16;
	// 	$vendor_id=json_decode($this->Orders_model->get_order_vendor($order_id));
	// 	$due_days=$this->Crud->checkAndReturn('no_of_days_credit_from_delivery_date','ga_payment_terms_tbl',['vendor_id'=>$vendor_id]);
	// }
	public function payment(){
		if($_POST['razorpay_payment_id']){
		/* >> Cart status and Order id update */
			$ordernumber=$this->session->userdata('order_no');
			$email=$this->session->userdata('pay_email');
			$payment_id=$_POST['razorpay_payment_id'];

			$where_cond=array('ordercartsession'=>$this->cart_session_id);
			$order_data_raw=$this->db->select('orderid')->from('ga_orders_tbl')->where($where_cond)->order_by('orderid','DESC')->limit(1,0)->get()->row();
			// $order_data_raw=$this->Orders_model->commonGetWhere('ga_orders_tbl',$where_cond);
			// $order_data = json_decode($order_data_raw);
			// $order = $order_data->result;
			$order_id = $order_data_raw->orderid;
			$updatedata=array('orderstatus'=>1,'payment_status'=>1,'payment_id'=>$payment_id);
			$update=$this->Crud->commonUpdate('ga_orders_tbl',$updatedata,['orderid'=>$order_id]);
			$update_data=array('order_id'=>$order_id,'cart_status'=>1);
			$update_condition=array('cart_session_id'=>$this->cart_session_id,'user_id'=> $this->user_id,'order_id'=>0);
			$update=$this->Crud->commonUpdate('ga_cart_tbl',$update_data,$update_condition);
			$update=json_decode($update);
			unset($_SESSION['cart_session_id']);
			if($update->code == 200){
				$vendor_id=json_decode($this->Orders_model->get_order_vendor($order_id));
				if($vendor_id!=null){
					$up_data=array('vendor_id'=>$vendor_id);
					$update_vendor=$this->Crud->commonUpdate('ga_orders_tbl',$up_data,['orderid'=>$order_id]);
					$vendor_pay_order=json_decode($this->Orders_model->get_vendor_pay_order($order_id));
					$due_days=$this->Crud->checkAndReturn('no_of_days_credit_from_delivery_date','ga_payment_terms_tbl',['vendor_id'=>$vendor_id]);
					if($vendor_pay_order!=null){
						$vendor_pay_data=array(
							'vendor_id' => $vendor_id,
							'order_id' => $order_id,
							'delivery_date' => $vendor_pay_order->delivery_due_date,
							'total_value_of_delivery' => $vendor_pay_order->totalpayableprice,
							'due_amount' => $vendor_pay_order->totalpayableprice,
							'due_days' => $due_days,
							'created_on' => DATE
						);
						$insert_vp=$this->Crud->commonInsert('ga_vendor_payment_table',$vendor_pay_data);
					}
					
				}
				$this->session->set_flashdata('success', 'Your  Order ( #'.$ordernumber.' )   Successfully Placed.');
				$orderdata=array('order_id'=>$order_id,'user_id'=>$this->user_id);
				
				$cartList=	$this->Orders_model->cartList($orderdata,$cart_type=2);
				$checkoutStatistics =$this->Orders_model->checkoutStatistics($orderdata);
				// $shareCartByUser=	$this->Orders_model->shareCartByUser($orderdata);
				// $shareCartByItem=	$this->Orders_model->shareCartByItem($orderdata);
				//for find usertype means poweruser or standard user
				$resp=json_decode($this->Orders_model->commonGetWhere("ga_users_tbl",['user_id'=>$this->user_id]));
				//print_r($resp->result->user_type);exit;
				/* poweruser user_type is 2,standard user user_type is 3,followers user_type is 1*/

								$data=array(
							        	'order_number'=>$ordernumber,
							        	'order_date'=>DATE,
							        	'order_status'=>1,
							        	);
				if($resp->result->user_type==2){
			     $from=SITE_EMAIL; 
			     $message=$this->load->view(EMAIL_TEMPLATE_FOLDER.'/order_status_temp_poweruser',$data,TRUE);  
			     $email_send=$this->send_user_email($email,$from,"Order Successfully Placed",$message);  
			    if($email_send==true){
                }else{
		        $this->session->set_flashdata('failed', 'Email send failed ');
			    }
				}

				if($resp->result->user_type==1){
				$resp=json_decode($this->Orders_model->commonGetWhere("ga_users_tbl",['user_id'=>$this->user_id]));	
				$power_userid=$resp->result->power_user_id;
				//echo $power_userid;
				$resp_power_user=json_decode($this->Orders_model->commonGetWhere("ga_users_tbl",['user_id'=>$power_userid]));
				$power_username=$resp_power_user->result->user_name;
				//echo $power_username;exit;	
									$data1=array(
							        	'order_number'=>$ordernumber,
							        	'order_date'=>DATE,
							        	'order_status'=>1,
							        	'power_username'=>$power_username
							        	);
			     $from=SITE_EMAIL; 
			     $message=$this->load->view(EMAIL_TEMPLATE_FOLDER.'/order_status_temp_followers',$data1,TRUE);  
			     $email_send=$this->send_user_email($email,$from,"Order Successfully Placed",$message);  
			    if($email_send==true){
                }else{
		        $this->session->set_flashdata('failed', 'Email send failed ');
			    }
				}

				if($resp->result->user_type==3){
				/*    Email code stats    */
				$subject="Order Successfully Placed";
				$this->data['order_data']=array(
							        	'order_number'=>$ordernumber,
							        	'order_date'=>DATE,
							        	'order_status'=>1,
							        	);
							
				$result = $this->sendmail->sendEmail(
									array(
										'to' => array($email),
										'cc' => array('info@' . SITE_DOMAIN),
										'bcc' => array(BCC_EMAIL),
										'subject' => $subject,
										'data' => array('order_data'=>$this->data['order_data'],'cartList'=>$cartList,'checkoutStatistics'=>$checkoutStatistics),
										'template' => EMAIL_TEMPLATE_FOLDER.'/order_status_temp',
									)
								);
			    }
				$this->load->view('order_status/order_success',$this->data);
				}
				else{
					$this->session->set_flashdata('failed', 'Order Failed ');
					$this->load->view('order_status/order_success',$this->data);
				}
				$this->session->unset_userdata('order_no');
				$this->session->unset_userdata('pay_email');
			}
			else{
				$this->session->set_flashdata('failed', 'Order Failed ');
				$this->load->view('order_status/order_success',$this->data);
			}
	}
	public function orderEmail(){
	$orderdata=array('order_id'=>$this->session->userdata('order_id'),'user_id'=>$this->user_id);
			$this->data['mycart']=	$this->order->cartList($orderdata);
			$this->data['byuser']=	$this->order->shareCartByUser($orderdata);
			$this->data['byitem']=	$this->order->shareCartByItem($orderdata);
			// print_r($this->data['byitem']);
	}

	public function cancelOrder(){
		  	$order_id= $this->uri->segment(2);
		  	$update_data=array('orderid'=>$order_id,'userid'=> $this->user_id,'orderstatus'=>5);
			// print_r($update_data);exit;
			$update_condition=array('userid'=> $this->user_id,'orderid'=>$order_id);
			$update=$this->Crud->commonUpdate('ga_orders_tbl',$update_data,$update_condition);
			$update=json_decode($update);
			if($update->code == SUCCESS_CODE){
				
					$this->session->set_flashdata('success', 'Order Canceled Successfully');
					$user_data_raw=$this->user->commonGetWhere('ga_users_tbl',array('user_id'=>$this->user_id));
					$user_data=json_decode($user_data_raw);
					// print_r($user_data);exit;
					$email = $user_data->result->user_email;
					$order = json_decode($this->user->commonGetWhere('ga_orders_tbl',array('orderid'=>$order_id)));
					 $ordernumber=$order->result->ordernumber;
					$this->data['order_data']=array(
										'name' =>$user_data->result->user_name,
							        	'order_number'=>$ordernumber,
							        	'order_date'=>DATE, // canceled date 
							        	);		
				$result = $this->sendmail->sendEmail(
						array(
							'to' => array($email),
							'cc' => array('info@' . SITE_DOMAIN),
							'bcc' => array(BCC_EMAIL),
							'subject' => 'Order Cancellation ',
							'data' => array('orderdata'=>$this->data['order_data']),
							'template' => EMAIL_TEMPLATE_FOLDER.'/order_cancel_page',
						));
				/**
				* Update By	:Zabihullah
				* Date		:01-04-2021
				* issue		:wallet_tbl	
				*/
				//tot_wallet_amount has been taken from db and stored into session in $this->orders() funtion.
					$update_wallet_data=array(
						'user_id'=>$this->user_id,
						'tot_wallet_amount'=>$this->session->userdata('tot_wallet_amount')						
					);
				//check if the user has already canceled order or not
				$is_user_in_wallet=$this->Crud->commonCheck('user_id','ga_wallet_tbl',array('user_id'=>$this->user_id));
				//this function returns 1 if exist 0 if not
				if($is_user_in_wallet){
					//Do Update
					$update=$this->Crud->commonUpdate('ga_wallet_tbl',$update_wallet_data,['user_id'=>$this->user_id]);
				}else{
					//Do Insert
					$insert_data = $this->Crud->commonInsert('ga_wallet_tbl', $update_wallet_data);
				}
				/*if($result['code'] == 1 ){
				redirect('/myorders');	
				}*/
			}
			redirect('/myorders');
	}
	
	
		public function send_user_email($to,$from,$subject,$message){ 
        $config=array(
                // 'protocol' => 'smtp', 
                // 'smtp_host' => 'ssl://smtp.googlemail.com', 
                // 'smtp_port' => 465, 
                // 'smtp_user' => '', 
                // 'smtp_pass' => '',
                'charset'=>'utf-8',
                'newline'=> "\r\n",
                'mailtype'=>'html',
                'validation'=> true
     );
                $this->load->library('email');
                $this->email->initialize($config);
                $this->email->to($to);
                $this->email->from($from);
                $this->email->subject($subject);
                $this->email->message($message);
      if($this->email->send())
      {
       return true;
      }
      else
      {
       return false;
      }
    }


}
