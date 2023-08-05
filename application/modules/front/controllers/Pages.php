<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

	public $user_id;
	public $ipaddress;
	public $cart_session_id;
	public $user_type;

	public function __construct()
	{
		parent::__construct();

		//load models here
		$this->load->model(array('Pages_model', 'Cart_model', 'user_model', 'Product_model'));
		//helper loads here for xss_clean
		$this->load->helper('security');
		$this->load->helper('email');
		// accissing the session data form the Userdata 
		$this->user_id = $this->session->userdata('user_id');
		$this->user_type = $this->session->userdata('user_type');
		$this->cart_session_id = $this->session->userdata('cart_session_id');

		if (empty($this->cart_session_id) && !empty($this->user_type)) {
			if ($this->user_type == 1) {
				$res = $this->Cart_model->getShareCartPowerUser($this->user_id);
				$row = $this->Cart_model->getShareCartSession($res->power_user_id);
			} else {
				$row = $this->Cart_model->getShareCartSession($this->user_id);
			}
			if (!empty($row->session_id)) {
				$this->session->set_userdata('cart_session_id', $row->session_id);
				$this->cart_session_id = $this->session->userdata('cart_session_id');
			}
		}

		$this->load->library('Sendmail');

		//loading menus ends here 
		$this->data['menuList'] = $this->Common->mainMenuList();
		//getting cart data form data base  starts from here 
		$this->data['cartList'] = $this->Cart_model->cartList($this->cart_session_id, 1);
		/*>> Loading COmmin listing model code start */
		$this->load->model(array('Checkout_model' => 'checkout'));
		$this->data['sharecart_result'] = $this->checkout->checkoutResult(array('cart_session' => $this->cart_session_id));
		$this->data['cartStatistics'] = $this->checkout->checkoutStatistics($this->cart_session_id);
	}


	public function index()
	{
		$where_prod = array('mp.active_status' => 1, 'mp.trash' => 0, 'mp.feature_product' => 1);
		$this->data['feature_products'] = $this->Product_model->get_products($where_prod, 'asc');
		$this->data['front_categories'] = $this->Pages_model->get_front_categories();
		$this->data['slider'] = $this->Pages_model->commonWhereFetch(["id", "slider_image", "slider_title", 'slider_url'], "slider_tbl", ['flag_status' => 1], "id", "ASC");
		$this->data['cart_sess_id'] = $this->cart_session_id;
		$this->data['sharedcartdata'] = $this->user_model->user_sharedcartData();
		$this->data['categoryBasedProducts'] = $this->Product_model->menuBasedProducts();
		$this->data['newarrival_products'] = $this->Product_model->newArrivalProducts();
		$this->data['bestseller_products'] = $this->Product_model->newArrivalProducts();
		$this->load->view('index', $this->data);
	}

	// here starts to load the about page 
	public function about()
	{

		$this->load->view('aboutus', $this->data);
	}
	public function template()
	{
		$this->load->view('templates/emailTemplate');
	}

	// here starts to load the register page 
	public function register()
	{
		if (empty($this->user_id)) {

			$this->load->view('register', $this->data);
		} else {
			redirect('/');
		}
	}

	public function createUser()
	{
		$this->form_validation->set_rules('user_name', 'Your Name', 'required|trim|min_length[2]|xss_clean', array('is_unique' => 'This name is already registered try other'));

		$this->form_validation->set_rules('user_email', 'Your Email', 'required|trim|xss_clean|is_unique[ga_users_tbl.user_email]', array('is_unique' => 'This email is already registered, try other'));
		$this->form_validation->set_rules('user_mobile', 'Your Mobile', 'required|trim|xss_clean|numeric|is_unique[ga_users_tbl.user_mobile]', array('is_unique' => 'Mobile is already registered, try other'));
		$this->form_validation->set_rules('user_password', 'Your Password', 'required|trim|xss_clean|min_length[6]|max_length[60]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[6]|matches[user_password]|xss_clean');
		$user_name = $this->input->post('user_name');
		$user_email = $this->input->post('user_email');
		$insert_array = array(
			'user_name' => $user_name,
			'user_email' =>  $user_email,
			'user_mobile' =>  $this->input->post('user_mobile'),
			'user_password' =>  md5($this->input->post('user_password')),
			'user_reigster_id' => 'LSKG' . date('dmy') . rand(1, 99),
			'user_type' => 3,
			'user_status' => 0,
			'created_on' => DATE
		);

		$insert_user = json_decode($this->Crud->commonInsert('ga_users_tbl', $insert_array, 'Register Successfully done'));
		if ($insert_user->code == SUCCESS_CODE) {
			// sending verification link code start here
			$user_id = $insert_user->inserted_id;


			if ($user_id) {
				$this->session->set_flashdata('success', 'Registration successfully done & verification link sent to your email ID');
			} else {
				$this->session->set_flashdata('success', 'Data Inserted successfully but unabled to send verification link');
			}
			// sending verification link code end here
			redirect('register/');
		} else {
			$this->session->set_flashdata('failed', 'Oops! Something went wrong, please try again');
			redirect('register/');
		}
	}

	// here starts to load the terms page 
	public function terms()
	{
		$this->load->view('terms', $this->data);
	}
	// here starts to load the privacy policy page 
	public function privacyPolicy()
	{
		$this->load->view('privacyPolicy', $this->data);
	}
	// here starts to load the refund policy page 
	public function refundPolicy()
	{
		$this->load->view('refundPolicy', $this->data);
	}
	// here starts to load the cancellation and return policy page 
	public function cancellationPolicy()
	{
		$this->load->view('cancellationPolicy', $this->data);
	}

	// here starts to load the arhar page 
	public function product_view()
	{
		$id = $this->uri->segment(2);
		$where3 = array('active_status' => 1, 'trash' => 0, 'id' => $id);
		$this->data['feature_product'] = $this->Pages_model->commonGetWhere('ga_main_prod_details_tbl', $where3);
		$this->data['product_gallery'] = $this->Pages_model->productGallery($id);
		$this->data['related_products'] = $this->Product_model->newArrivalProducts();
		$this->data['index_wish_result'] = $this->checkout->return_wishlist();
		$this->load->view('product_details', $this->data);
	}


	public function productd_view()
	{
		$this->data['prdoctViewDetails'] = $this->Pages_model->productDetails();
		$this->load->view('product_details', $this->data);
	}

	// here starts to load the contact page 

	public function contact()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|xss_clean');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|trim|xss_clean');
		$this->form_validation->set_rules('message', 'Message', 'required|trim|xss_clean');
		if ($this->form_validation->run() == false) {
			$this->load->view('contact', $this->data);
		} else {
			extract($_POST);
			$data = array("name" => $name, "email" => $email, "mobile" => $mobile, "message" => $message, "created_on" => DATE);
			$insert_user = json_decode($this->Crud->commonInsert('ga_help_tbl', $data, 'Register Successfully done'));
			$message = $this->load->view('front/templates/contact_template', $data, TRUE);
			$res = $this->send_user_email(ADMIN_MAIL, $email, "Contact US", $message);
			if ($res == true) {
				$this->session->set_flashdata("success", "Thank you! Your message has been successfully sent. We will contact you very soon!");
				redirect("contact");
			} else {
				$this->session->set_flashdata("failed", "Something error in email send");
				redirect("contact");
			}
		}
	}

	// here ends to load the contact page 

	// here starts to load the faq page 

	public function faq()
	{
		$this->data['URL_TITLE'] = 'FAQ List';
		$this->data['PAGE_TITLE'] = 'FAQ List';
		$breadcrumb_array = array(
			array('title' => 'FAQ List', 'link' => 'javascript:void(0);', 'class' => 'active'),
			array('title' => 'Create FAQ', 'link' => SUPER_ADMIN_FOLDER_PATH . 'Faqs/createFaq', 'class' => ''),
		);
		$this->data['breadcrumb'] = json_encode($breadcrumb_array);
		$search = $this->input->post('search');
		/**Pagination code starts**/
		$cols = 'faq_id as id,faq_ref_no as ref_no,query as query,description as description,created_date as qry_date,reply_status as status';
		$tbl = 'faq_tbl';
		/**Pagination code end**/
		$orderby = 'faq_id';
		$this->data['faq_res1'] = $this->checkout->ResultWhere($cols, $tbl, ['faq_option' => 1, 'reply_status' => 1], "faq_id", "DESC");
		$this->data['faq_res2'] = $this->checkout->ResultWhere($cols, $tbl, ['faq_option' => 2, 'reply_status' => 1], "faq_id", "DESC");
		$this->data['faq_res3'] = $this->checkout->ResultWhere($cols, $tbl, ['faq_option' => 3, 'reply_status' => 1], "faq_id", "DESC");
		$this->load->view('faq', $this->data);
	}


	public function login()
	{
		if (empty($this->user_id)) {
			$this->data['professions'] = $this->Pages_model->get_professions();
			$this->form_validation->set_rules('login_email', 'Your Email', 'required|valid_email', array('required' => 'Please enter email '));
			$this->form_validation->set_rules('login_password', 'Your Password', 'required|min_length[6]');
			if ($this->form_validation->run() == false) {
				$this->load->view('login', $this->data);
			} else {
				$login_data = array(
					'user_email' => $this->input->post('login_email'),
					'user_password' => $this->input->post('login_password')
				);

				$result = $this->Pages_model->can_login($login_data);
				$login_data = json_decode($result);
				//print_r($login_data);exit;
				$row = $login_data->common_result;
				if ($login_data->code == 200) {
					$session_data = array(
						'user_id' => $row->user_id,
						'user_name' => $row->user_name,
						'user_email' => $row->user_email,
						'user_reigster_id' => $row->user_reigster_id,
						'user_type' => $row->user_type,
						'power_approved' => $row->power_approved,
						'power_user_id' => $row->power_user_id
					);

					$this->session->set_userdata($session_data);
					$wherecondition = array('cart_session_id' => $this->cart_session_id);
					$cart_check = $this->Crud->commonCheck('cart_id', 'ga_cart_tbl', $wherecondition);
					$this->session->set_flashdata('success', 'Successfully logged in');
					if ($cart_check == 1) {
						redirect('/checkout');
					} else {
						redirect('/');
					}
				}
				if ($login_data->code == 204) {
					//echo "Invalid details";
					$this->session->set_flashdata('failed', 'Unauthorized user, please check login credentials.');
					redirect('register/');
				}
			}
		} else {
			$this->index();
		}
	}


	public function followerLogin()
	{
		if (empty($this->user_id)) {
			$this->form_validation->set_rules('login_email', 'Your Email', 'required|valid_email', array('required' => 'Please enter email '));
			$this->form_validation->set_rules('login_password', 'Your Password', 'required|min_length[6]');
			if ($this->form_validation->run() === false) {

				$this->load->view('followerlogin', $this->data);
			} else {

				$login_data = array(
					'user_email' => $this->input->post('login_email'),
					'user_password' => $this->input->post('login_password')
				);
				$result = $this->Pages_model->can_followerlogin($login_data);
				$login_data = json_decode($result);
				$row = $login_data->common_result;
				if ($login_data->code == SUCCESS_CODE) {

					$session_data = array(
						'user_id' => $row->user_id,
						'user_email' => $row->user_email,
						'user_type' => $row->user_type
					);
					$this->session->set_userdata($session_data);
					$this->session->set_flashdata('success', 'Successfully logged in. Please change your password ');
					redirect('front/Pages/followerChangePassword');
					exit;
				} else {

					$this->session->set_flashdata('failed', 'Unauthorized user, please check login credentials.');
					redirect('front/Pages/followerLogin');
				}
			}
		} else {
			$this->index();
		}
	}


	public function followerChangePassword()
	{
		$this->form_validation->set_rules('new_password', 'New Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[6]');
		if ($this->form_validation->run() == false) {
			$this->load->view('follower_change_password', $this->data);
		} else {

			$new_password = $this->input->post('new_password');
			$confirm_password = $this->input->post('confirm_password');
			if ($new_password == $confirm_password) {

				$update_data = array('user_password' => md5($new_password), 'user_status' => 1);
				$update_condition = array('user_id' => $this->user_id);
				$update = $this->Crud->commonUpdate('ga_users_tbl', $update_data, $update_condition);
				$update = json_decode($update);

				if ($update->code == SUCCESS_CODE) {
					// print_r($update);
					$this->session->set_flashdata('success', 'Your password changed successfully. Please Edit your Details.');
					redirect('/myprofile');
				} else {
					$this->session->set_flashdata('failed', 'Not updated');
					redirect('front/Pages/followerChangePassword');
				}
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_email');
		$this->session->unset_userdata('user_type');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('cart_session_id');
		redirect('/');
	}
	public function powerUserRegiste()
	{
		$this->load->view('templates/email_temp');
	}
	public function powerUserRegister()
	{

		// print_r($_POST);exit;
		$this->data['professions'] = $this->Pages_model->get_professions();
		$this->data['limit_data'] = json_decode($this->Pages_model->get_Fetch('ga_follower_limit_tbl'));
		$to = "";
		$pass = "";
		//Client side validations starts form Here 
		$this->form_validation->set_rules('user_name', 'Your Name', 'required|trim|min_length[3]|xss_clean', array('is_unique' => 'This name is already registered try other'));
		$this->form_validation->set_rules('user_city', 'Your City', 'required|trim', array('required' => 'Please enter your city'));
		$this->form_validation->set_rules('state', 'Your State', 'required|trim', array('required' => 'Please enter your state'));
		$this->form_validation->set_rules('user_address', 'Your City', 'required|trim', array('required' => 'Please enter your Address'));
		$this->form_validation->set_rules('user_email', 'Your Email', 'required|trim|xss_clean|is_unique[ga_users_tbl.user_email]', array('is_unique' => 'This email is already registered try other'));
		$this->form_validation->set_rules('user_mobile', 'Your Mobile', 'required|trim|xss_clean|numeric|is_unique[ga_users_tbl.user_mobile]', array('is_unique' => 'Mobile is already registered try other'));
		$this->form_validation->set_rules('user_password', 'Your Password', 'required|xss_clean|min_length[6]|max_length[60]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[6]|matches[user_password]|xss_clean');
		// $this->form_validation->set_rules('fb_link','Facebook link','required|trim|',array('required'=>'Facebook link is required'));
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[6]|matches[user_password]|xss_clean');

		$this->form_validation->set_rules('follower_reigster_id[]', '', 'required|trim|xss_clean|is_unique[ga_users_tbl.user_email]', array('is_unique' => 'This email is already registered try other'));
		$this->form_validation->set_rules('follower_mobile[]', 'Your Email', 'required|trim|xss_clean|is_unique[ga_users_tbl.user_mobile]', array('is_unique' => 'This email is already registered try other'));
		$this->form_validation->set_rules('follower_city[]', 'Your Email', 'required|trim|xss_clean');
		$this->form_validation->set_rules('follower_user_name[]', 'User name', 'required|trim|xss_clean');
		//Client side validations starts form Here 
		if ($this->form_validation->run() == false) {
			//echo 'failed';exit;
			$this->load->view('power_user_register', $this->data);
		} else {
			//echo 'success';exit;
			if ($this->input->post('user_password') != $this->input->post('confirm_password')) {
				$err_mesg = "Both passwords not mathched ";
			} else {

				$proof = $_FILES['user_proof']['name'];
				$imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
				$extension = $this->getFileExtensions($_FILES['user_proof']['name']);
				$upload_picture = '';
				if (!empty($proof)) {
					if (in_array($extension, $imageextension)) {
						$upload_pic = sha1(time() . rand(0000, 99999999));
						$filename = stripslashes($_FILES['user_proof']['name']);
						$upload_file = $_FILES['user_proof']['tmp_name'];
						$imagesize = $_FILES['user_proof']['size'];
						$upload_picture = $upload_pic . '.' . $extension;
						$projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
						$url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/users/" . $upload_picture;
						$filename = $this->compress_image($upload_file, $url, 30);
					}
				}
				$insert_array = array(
					'user_name' => $this->input->post('user_name'),
					'user_email' =>  $this->input->post('user_email'),
					'user_mobile' =>  $this->input->post('user_mobile'),
					'user_city' =>  $this->input->post('user_city'),
					'state' => $this->input->post('state'),
					'latitude' => $this->input->post('latitude'),
					'longitude' => $this->input->post('longitude'),
					'user_address' =>  $this->input->post('user_address'),
					'user_password' =>  md5($this->input->post('user_password')),
					'user_reigster_id' => 'SPU' . date('dmy') . rand(17, 99),
					'user_type' => 2,
					'user_proof' => $upload_picture,
					'fb_link' => $this->input->post('fb_link'),
					'user_status' => 0,
					'created_on' => DATE
				);
				if ($this->input->post('profession') != null) {
					$insert_array['user_profession'] = $this->input->post('profession');
				}
				if ($this->input->post('user_income') != null) {
					$insert_array['user_income'] = $this->input->post('user_income');
				}
				$insert_user = json_decode($this->Crud->commonInsert('ga_users_tbl', $insert_array, 'Registration Successfully done'));
				$poweruserid = $insert_user->inserted_id;
				if ($insert_user->code == SUCCESS_CODE) {
					//Mail data 
					$power_data = array(
						'user_name' => $this->input->post('user_name'),
						'user_email' =>  $this->input->post('user_email'),
						'user_mobile' =>  $this->input->post('user_mobile'),
						'link' => base_url() . 'poweruser/PowerUserVerify/' . base64_encode($poweruserid),
						'subject' => '	Activate your Power user account '
					);

					$result = $this->sendmail->sendEmail(
						array(
							'to' => array($this->input->post('user_email')),
							'cc' => array('info@' . SITE_DOMAIN),
							'bcc' => array(BCC_EMAIL),
							'subject' => 'Poweruser Registration',
							'data' => array('user_data' => $power_data),
							'template' => EMAIL_TEMPLATE_FOLDER . 'verification_poweruser.php',
						)
					);

					$follower_reigster_id = '';
					$follower_name = '';
					$follower_city = '';
					$follower_mobile = '';
					$follow_pass = 'ga' . rand(00000000, 988899999) . time('t-y-i');

					$follower_reigster_id = array_filter($this->input->post('follower_reigster_id'));
					$follower_mobile = array_filter($this->input->post('follower_mobile'));
					$follower_name = array_filter($this->input->post('follower_user_name'));
					$follower_city = array_filter($this->input->post('follower_city'));
					//$insert=array();

					$data = array();
					if (!empty($follower_reigster_id) && !empty($follower_mobile)) {
						if (empty($follower_reigster_id)) {
							$follower_reigster_id = $array + array(null);
						}

						$subject = "Account Activation";
						$message = "";
						$email_array = array();
						$follow_pass = "123123";
						for ($i = 0; $i < count($follower_reigster_id); $i++) {
							$insert = array(
								'user_name' => $follower_name[$i],
								'power_user_id' => $poweruserid,
								'user_email' => $follower_reigster_id[$i],
								'user_mobile' => $follower_mobile[$i],
								'user_city' => $follower_city[$i],
								'created_on' => DATE,
								'user_password' => md5($follow_pass),
								'user_type' => 1,
								'user_reigster_id' => 'SF' . date('dmy') . rand(17, 999),
								'user_status' => 1,
								'verified_email' => 1
							);
							$data = array(
								'name' => $follower_name[$i],
								'email' => $follower_reigster_id[$i],
								'mobile' => $follower_mobile[$i],
								'subject' => $subject,
								'link' => base_url() . 'front/Pages/followerLogin/',
								'follower_password' => $follow_pass
							);
							$follower_data = json_decode($this->Crud->commonInsert('ga_users_tbl', $insert, 'Registration Successfully done'));
							$follower = array(
								'follower_id' => $follower_data->inserted_id,
								'power_user_id' => $poweruserid,
								'email' => $follower_reigster_id[$i],
								'mobile' => $follower_mobile[$i],
								'created_on' => DATE,
							);
							$follower_data2 = json_decode($this->Crud->commonInsert('ga_followers_tbl', $follower, 'Registration Successfully done'));
							$from = SITE_EMAIL;
							$message = $this->load->view('templates/haramohan_new_email_temp', $data, TRUE);
							// 			echo $from;
							// 			echo $follower_reigster_id[$i];exit;
							$e_resp = $this->send_user_email($follower_reigster_id[$i], $from, "Your login details", $message);
							if ($e_resp == true) {
							} else {
								$this->session->set_flashdata('failed', 'Email send failed ');
							}
						}
						$insert_res = $follower_data;
						if ($insert_res->code == 200) {

							//            		$mail_array = $this->sendmail->sendEmail(
							// 	array(
							// 		'to' => $follower_reigster_id,
							// 		'cc' => array('info@' . SITE_DOMAIN),
							// 		'bcc' => array(BCC_EMAIL),
							// 		'subject' => 'Follower  Registration',
							// 		'data' => array('email_content'=>$data),
							// 		'template' => EMAIL_TEMPLATE_FOLDER.'email_temp',
							// 	)
							// );
							//$this->session->set_flashdata('success', 'Your registration is successful, Admin will verify your account');
							$this->session->set_flashdata('success', 'You registered as a power user please wait for admin to approve your account.');
							redirect(base_url() . 'power-user-register/');
						} else {
							$this->session->set_flashdata('failed', 'You could not registered');
							redirect('power-user-register/');
						}
					} else {
						$this->session->set_flashdata('success', 'Power User registered Success');
						$this->session->set_flashdata('failed', 'Followers not Added ');
						redirect('power-user-register/');
					}
				} else {
					$this->session->set_flashdata('failed', 'You could not registered');
					redirect('power-user-register/');
				}
			}
		}
	}


	public function common_check_existence()
	{
		echo "hi";
		exit;
		extract($_POST);
		$email = $this->input->post('email');
		$where = array("user_email" => $email);
		$count = $this->crud->common_record_count("user_id", "ga_users_tbl", $where);
		if ($count > 0) {
			echo "Email is already exist";
		} else
			echo "";
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

	public function email_temp()
	{
		$this->load->view('email_temp', $this->data);
	}

	#image code for starts hear 
	public function getFileExtensions($str)
	{
		$i = strrpos($str, ".");
		if (!$i) {
			return "";
		}
		$l = strlen($str) - $i;
		$ext = substr($str, $i + 1, $l);
		return $ext;
	}

	public function compress_image($source_url, $destination_url, $quality)
	{
		$info = getimagesize($source_url);
		if ($info['mime'] == 'image/jpeg')
			$image = imagecreatefromjpeg($source_url);

		elseif ($info['mime'] == 'image/gif')
			$image = imagecreatefromgif($source_url);

		elseif ($info['mime'] == 'image/png')
			$image = imagecreatefrompng($source_url);
		elseif ($info['mime'] == 'image/jpg')
			$image = imagecreatefrompng($source_url);
		elseif ($info['mime'] == 'image/JPG')
			$image = imagecreatefrompng($source_url);
		elseif ($info['mime'] == 'image/PNG')
			$image = imagecreatefrompng($source_url);
		elseif ($info['mime'] == 'image/GIF')
			$image = imagecreatefrompng($source_url);
		elseif ($info['mime'] == 'image/JPEG')
			$image = imagecreatefrompng($source_url);

		imagejpeg($image, $destination_url, $quality);
		return $destination_url;
	}

	public function checkCart()
	{
		$cols = ('cart_id');
		$wherecondition = array('cart_session_id' => $this->cart_session_id);
		$data['cartCheck'] = $this->Crud->commonCheck($cols, 'ga_cart_tbl', $wherecondition);
		return $check;
	}
}
