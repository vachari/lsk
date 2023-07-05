<?php 
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
				$vendors_id=json_decode($this->Orders_model->get_order_vendors($order_id));
				if($vendors_id!=null){
					foreach($vendors_id->vendor_id as $vendor_id){
						$vendor_get_amount=$this->Orders_model->get_vendor_pay_order($vendor_id);
						//this not needed
					//instead i prefer to delete this and do any operation from ga_cart not here
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
							'due_amount' => $vendor_pay_data->total_amount,
							'due_days' => $due_days,
							'created_on' => DATE
						);
						$insert_vp=$this->Crud->commonInsert('ga_vendor_payment_table',$vendor_pay_data);
					}
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
	?>