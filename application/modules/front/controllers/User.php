<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
    public $user_id, $vendor_id, $shipper_id, $baseurl, $ipaddress, $cart_session_id;
    public function __construct()
    {
        parent::__construct();
        $this->vendor_id = $this->session->userdata('vendor_id');

        //load models here
        $this->load->model(array('Pages_model', 'Cart_model', 'User_model', 'Orders_model'));
        //helper loads here for xss_clean
        $this->load->helper('security');
        // accissing the session data form the Userdata 

        $this->user_id = $this->session->userdata('user_id');
        $this->cart_session_id = $this->session->userdata('cart_session_id');
        //loading menus ends here 
        $this->data['menuList'] = $this->Common->mainMenuList();
        //getting cart data form data base  starts from here 
        $this->data['cartList'] = $this->Cart_model->cartList($this->cart_session_id, 1);

        /*>> Loading COmmin listing model code start */
        $this->load->model(array('Checkout_model' => 'checkout', 'Crud' => 'crud'));
        $this->data['sharecart_result'] = $this->checkout->checkoutResult(array('cart_session' => $this->cart_session_id));
        $this->data['cartStatistics'] = $this->checkout->checkoutStatistics($this->cart_session_id);



        /*>> Loading COmmin listing model code end */
    }


    public function profile()
    {
        if (!empty($this->user_id)) {
            $where = array('user_status' => 1, 'trash' => 0, 'user_id' => $this->user_id);
            $this->data['user_details'] = $this->User_model->commonGetAll('ga_users_tbl', $where);
            $this->data['ordersdata'] = $this->User_model->cartOrderData();
            $this->data['wish_list'] = $this->User_model->wishlist($this->user_id);
            $this->load->view('profile', $this->data);
        } else {
            redirect('/');
        } // empty of user id 
    }

    public function profileUpdate()
    {
        // print_r($_POST);
        $where = array('user_status' => 1, 'trash' => 0, 'user_id' => $this->user_id);
        $this->data['user_details'] = $this->User_model->commonGetAll('ga_users_tbl', $where);

        $this->form_validation->set_rules('user_name', 'user_name', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('user_mobile', 'Mobile', 'required|trim|regex_match[/^[6-9]+[0-9]{9}$/]', array('regex_match' => 'Please enter valid Mobile'));
        $this->form_validation->set_rules('user_city', 'City', 'trim|alpha');
        $this->form_validation->set_rules('state', 'State', 'trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('profile', $this->data);
        } else {
            $update_data = array(
                'user_name' => trim($this->input->post('user_name')),
                // 'user_mobile' => trim($this->input->post('user_mobile')),
                'state' => trim($this->input->post('state')),
                'user_city' => trim($this->input->post('user_city'))
            );
            $update_condition = array('user_id' => $this->user_id);
            $update = $this->Crud->commonUpdate('ga_users_tbl', $update_data, $update_condition);
            $update = json_decode($update);
            if ($update->code == SUCCESS_CODE) {
                if ($this->session->userdata('user_name') == '') {
                    $session_data = array(
                        'user_name' => $this->input->post('user_name')
                    );
                    $this->session->set_userdata($session_data);
                }
                $this->session->set_flashdata('success', 'Your profile updated successfully!');
                redirect('/profile');
            } else {
                $this->session->set_flashdata('failed', 'Data not modified');
                redirect('/profile');
            }
        }
    }
    public function myorders()
    {
        if (!empty($this->user_id)) {
            $where = array('userid' => $this->user_id);
            $this->data['ordersdata'] = $this->User_model->cartOrderData();

            $this->load->view('myorders', $this->data);
        } else {
            redirect('/');
        } // empty of user id 

    }
    public function mywallet()
    {
        if (!empty($this->user_id)) {
            $where = array('userid' => $this->user_id);
            $this->data['ordersdata'] = $this->User_model->myWalletData();
            //echo "<pre>";
            //print_r(json_decode($this->data['ordersdata']));
            //echo "</pre>";exit;
            $this->load->view('mywallet', $this->data);
        } else {
            redirect('/');
        } // empty of user id 

    }
    public function sharedcart()
    {
        if (!empty($this->user_id)) {
            $where = array('userid' => $this->user_id);
            $this->data['sharedcartdata'] = $this->User_model->sharedcartData();
            $this->load->view('sharedcart', $this->data);
        } else {
            redirect('/');
        } // empty of user id 

    }
    public function user_sharedcart()
    {
        if (!empty($this->user_id)) {
            $where = array('userid' => $this->user_id);
            $this->data['sharedcartdata'] = $this->User_model->user_sharedcartData();

            $this->load->view('sharedcart_user', $this->data);
        } else {
            redirect('/');
        } // empty of user id 

    }
    public function mysaving()
    {
        if (!empty($this->user_id)) {
            $where = array('userid' => $this->user_id);
            $this->data['ordersdata'] = $this->User_model->cartOrderData();

            $this->load->view('mysaving', $this->data);
        } else {
            redirect('/');
        } // empty of user id 

    }
    public function myorder_view()
    {
        if (!empty($this->user_id)) {
            $order_id = $this->uri->segment(2);
            $where = array('userid' => $this->user_id, 'orderid' => $order_id);
            $this->data['ordersdata'] = $this->User_model->commonGetAll('ga_orders_tbl', $where);
            $orderdata = array('order_id' => $order_id, 'user_id' => $this->user_id);
            $this->data['cartList'] =  $this->Orders_model->cartList($orderdata);
            $this->load->view('order_view', $this->data);
        } else {
            redirect('/');
        } // empty of user id 
    }

    public function sharecart_view()
    {
        if (!empty($this->user_id)) {
            $search['cart_session'] = $this->uri->segment(2);
            $this->data['checkout_result'] =  $this->checkout->checkoutResult($search);

            $this->load->view('sharecart_view', $this->data);
        } else {
            redirect('/');
        } // empty of user id 
    }
    public function user_sharecart_view()
    {
        if (!empty($this->user_id)) {
            $search['cart_session'] = $this->uri->segment(2);
            $this->data['checkout_result'] =  $this->checkout->checkoutResult($search);

            $this->load->view('user_sharecart_view', $this->data);
        } else {
            redirect('/');
        } // empty of user id 
    }


    public function changepassword()
    {
        if (!empty($this->user_id)) {

            $this->form_validation->set_rules('old_password', 'Old password', 'required|trim|min_length[5]');
            $this->form_validation->set_rules('new_password', 'New password', 'required|trim');
            $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|trim|matches[new_password]');
            if ($this->form_validation->run() == false) {
                $this->load->view('changepassword', $this->data);
            } else {
                $old_password = $this->input->post('old_password');
                $new_password = $this->input->post('new_password');
                $confirm_password = $this->input->post('confirm_password');

                $cols = array('user_password');
                $wherecondition = array('user_password' => md5($old_password), 'user_id' => $this->user_id,);
                $common_check = $this->Crud->commonCheck($cols, 'ga_users_tbl', $wherecondition);
                if ($common_check == 1) {
                    $update_data = array('user_password' => md5($new_password));
                    $update_condition = array('user_id' => $this->user_id);
                    $update = $this->Crud->commonUpdate('ga_users_tbl', $update_data, $update_condition);
                    $update = json_decode($update);

                    if ($update->code == SUCCESS_CODE) {
                        //print_r($update);
                        $this->session->set_flashdata('success', 'Your password has been changed successfully!');
                    } else {
                        $this->session->set_flashdata('failed', 'Oops! Unabled to change password');
                    }
                } else {
                    $this->session->set_flashdata('failed', 'Something went wrong, try again');
                }
                redirect('/changepassword');
            }
        } else {
            redirect('/');
        } // empty of user id 

    }


    public function wishlist()
    {
        if (!empty($this->user_id)) {

            $this->data['wish_list'] = $this->User_model->wishlist($this->user_id);
            //print_r($this->data['wish_list']);exit;
            $this->load->view('wishlist', $this->data);
        } else {
            redirect('/');
        } // empty of user id 


    }
    /* Adding data in wish list     */
    public function addWish()
    {
        $prod_id = $this->input->post('prod_id');
        if (!empty($prod_id)) {
            // validation success
            $insert_array = array(
                'prod_id' => $prod_id,
                'user_id' => $this->user_id,
                'created_on' => DATE
            );
            $insert_wish = $this->Crud->commonInsert('ga_wishlist_tbl', $insert_array, 'Successfully');
            echo $insert_wish;
            exit;
        }
    }
    public function removewishlist()
    {
        $id = $this->uri->segment(2);
        $condition = array('user_id' => $this->user_id, 'prod_id' => $id);

        $del_wish = $this->Crud->commonDelete('ga_wishlist_tbl', $condition, 'Wishlist');
        $del_wish = json_decode($del_wish);
        if ($del_wish->code = 200) {
            $this->session->set_flashdata('success', 'Removed successfully');
            redirect('wishlist');
        }
    }

    public function addressbook()
    {

        if (!empty($this->user_id)) {
            $where = array('status' => 1, 'trash' => 0, 'user_id' => $this->user_id);
            $this->data['address'] = $this->User_model->commonGetWhere('ga_address_tbl', $where);
            $this->data['address_list'] = $this->User_model->commonGetAll('ga_address_tbl', $where);
            // print_r($this->data['address']);exit;
            $this->form_validation->set_rules('title', 'Title', 'required|trim|min_length[3]|regex_match[/^[a-zA-z. ]*$/]', array('regex_match' => 'Please enter valid title'));
            $this->form_validation->set_rules('name', 'Name', 'trim|min_length[3]|regex_match[/^[a-zA-z. ]*$/]', array('regex_match' => 'Please enter valid name'));
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|min_length[10]|max_length[10]|numeric');
            $this->form_validation->set_rules('state', 'State', 'trim|regex_match[/^[a-zA-z. ]*$/]', array('regex_match' => 'Please enter valid state'));
            $this->form_validation->set_rules('city', 'City', 'trim|regex_match[/^[a-zA-z. ]*$/]', array('regex_match' => 'Please enter valid city'));
            $this->form_validation->set_rules('pincode', 'Pincode', 'required|trim|numeric|min_length[6]|regex_match[/^[0-9]{6}$/]', array('regex_match' => 'Please enter valid pincode'));
            $this->form_validation->set_rules('address', 'Address', 'required|trim|min_length[5]');
            if ($this->form_validation->run() == false) {
                $this->load->view('addressbook', $this->data);
            } else {
                // validation success
                $insert_array = array(
                    'title' => trim($this->input->post('title')),
                    'name' => trim($this->input->post('name')),
                    'mobile' => trim($this->input->post('mobile')),
                    'state' => trim($this->input->post('state')),
                    'city' => trim($this->input->post('city')),
                    'pincode' => trim($this->input->post('pincode')),
                    'address' => trim($this->input->post('address')),
                    'user_id' => $this->user_id,
                    'created_on' => DATE
                );

                $insert_user = $this->Crud->commonInsert('ga_address_tbl', $insert_array, 'Successfully');
                $insert_user = json_decode($insert_user);
                if ($insert_user->code == 200) {
                    $this->session->set_flashdata('success', 'Your Address Added Successfully!');
                    $colssss = ('cart_id');
                    $whereconditionss = array('cart_session_id' => $this->cart_session_id);
                    $this->data['cartCheckData'] = $this->Crud->commonCheck($colssss, 'ga_cart_tbl', $whereconditionss);
                    if ($this->data['cartCheckData'] == 1) {
                        redirect('shipping/');
                    } else {
                        redirect('addressbook/');
                    }
                } else {
                    $this->session->set_flashdata('failed', 'Oops! Something went wrong, please try again.');
                    redirect('addressbook/');
                }
            }
        } else {
            redirect('/');
        } // empty of user id 

    }



    public function help()
    {
        if (!empty($this->user_id)) {

            $this->form_validation->set_rules('subject', 'subject', 'required|trim|min_length[2]');
            $this->form_validation->set_rules('message', 'message', 'required|trim|min_length[5]');
            if ($this->form_validation->run() == false) {
                $this->load->view('help', $this->data);
            } else {
                //validation success
                $insert_array = array(
                    'subject' => trim($this->input->post('subject')),
                    'message' => trim($this->input->post('message')),
                    'user_id' => $this->user_id,
                    'created_on' => DATE
                );
                $insert_user = $this->Crud->commonInsert('ga_help_tbl', $insert_array, 'Successfully');
                if ($insert_user) {
                    $this->session->set_flashdata('success', 'Your details added successfully!');
                    redirect('help/');
                } else {
                    $this->session->set_flashdata('failed', 'Oops! Something went wrong, please try again.');
                    redirect('help/');
                }
            }
        } else {
            redirect('/');
        } // empty of user id 
    }
    public function commonDelete()
    {
        $response = array();
        $relationname = 'Your data';
        $tablename = $this->input->post('tablename');
        $updatelist = $this->input->post('updatelist');

        $user_id = $this->session->userdata('user_id');
        if ($tablename != '') {
            $table = '';
            $wherecondition = '';
            switch ($tablename) {
                case 'address':
                    $table = 'ga_address_tbl';
                    $wherecondition = "id=$updatelist";
                    break;
                case 'cart':
                    $table = 'ga_cart_tbl';
                    $wherecondition = array('cart_id' => $updatelist, 'user_id' => $user_id);
                    break;
            }
            $delete = $this->Crud->commonDelete($table, $wherecondition, $relationname);
            echo $delete;
            exit;
        }
        echo json_encode($response);
    }

    public function addFollower()
    {
        $this->form_validation->set_rules('user_name', 'Name', 'required');
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('user_mobile', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('city', 'City', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('add_follower', $this->data);
        } else {
            $user_name = trim($this->input->post('user_name'));
            $user_email = $this->input->post('user_email');
            $user_mobile = $this->input->post('user_mobile');
            $city = $this->input->post('city');

            /* $chek_email = $this->Crud->commonCheck('user_email','ga_users_tbl', array('power_user_id'=>$this->user_id));
                //print_r($chek_email);
                if($chek_email == 1 )
                {

                    $this->session->set_flashdata('failed', 'This Email already exists.Try other ');
                    redirect('addFollowers');
                }
                
                $chek_mobile = $this->Crud->commonCheck('user_mobile','ga_users_tbl', array('power_user_id'=>$this->user_id));
                //print_r($chek_mobile);
                        if($chek_mobile == 1 ){
                            $this->session->set_flashdata('failed', 'This mobile already exists.Try other ');
                            redirect('addFollowers');
                        }
                        
                    if( $chek_email== 0 )
                    {   */
            $follow_pass = 'ga' . rand(00000000, 988899999) . time('t-y-i');
            $insert_array = array(
                'power_user_id' => $this->user_id,
                'user_name' => trim(ucfirst($user_name)),
                'user_email' =>  $user_email,
                'user_password' => md5($follow_pass),
                'user_mobile' =>  $user_mobile,
                'user_city' =>  $city,
                'user_type' => 1,
                'user_status' => 0,
                'created_on' => DATE
            );
            $insert_user = json_decode($this->Crud->commonInsert('ga_users_tbl', $insert_array, 'Your registration successfully done!'));

            if ($insert_user->code == SUCCESS_CODE) {
                $follower = array(
                    'follower_id' => $insert_user->inserted_id,
                    'power_user_id' => $this->user_id,
                    'email' => $user_email,
                    'mobile' => $user_mobile,
                    'created_on' => DATE,
                );
                $follower_data2 = json_decode($this->Crud->commonInsert('ga_followers_tbl', $follower, 'Registration successfully done! Sent mail to follower.'));
                $this->session->set_flashdata('success', 'Follower added successfully! Sent mail to follower.');
                $data = array(
                    'name' => $user_name,
                    'email' => $user_email,
                    'mobile' => $user_mobile,
                    'subject' => 'Follower Registration',
                    'link' => base_url() . 'front/Pages/followerLogin/',
                    'follower_password' => $follow_pass
                );
                $mail_array = $this->sendmail->sendEmail(
                    array(
                        'to' => array($user_email),
                        'cc' => array('info@' . SITE_DOMAIN),
                        'bcc' => array(BCC_EMAIL),
                        'subject' => 'Follower  Registration',
                        'data' => array('email_content' => $data),
                        'template' => EMAIL_TEMPLATE_FOLDER . 'email_temp',
                    )
                );
                redirect('addFollowers');
            }
            //}
        }
    }
    public function viewFollower()
    {
        $where = array('power_user_id' => $this->user_id);
        $this->data['follower'] = $this->User_model->commonGetAll('ga_users_tbl', $where);
        $this->load->view('view_followers', $this->data);
    }
    /* 
        Verification of Power user account 
    */
    public function activeUserAccount()
    {
        $user_id = base64_decode($this->uri->segment(3));
        $update_condition = array('user_id' => $user_id);
        $user_info = json_decode($this->User_model->commonGetWhere('ga_users_tbl', array('user_id' => $user_id)));
        $update_data = array('verified_email' => 1, 'user_status' => 1);
        $up = json_decode($this->Crud->commonUpdate('ga_users_tbl', $update_data, $update_condition));

        if ($up->code == SUCCESS_CODE) {
            //Mail data 
            $subject = 'User verification success @' . SITE_NAME;
            $user_data = array(
                'user_name' => $user_info->result->user_name,
                'user_email' =>  $user_info->result->user_email,
                'user_mobile' =>  $user_info->result->user_mobile,
                'subject' => $subject
            );
            $result = $this->sendmail->sendEmail(
                array(
                    'to' => $user_info->result->user_email,
                    'cc' => array('info@' . SITE_DOMAIN),
                    'bcc' => array(BCC_EMAIL),
                    'subject' => $subject,
                    'data' => array('user_data' => $user_data),
                    'template' => EMAIL_TEMPLATE_FOLDER . 'register_success_page',
                )
            );
            $this->session->set_flashdata('success', 'Account activation successfully done! Please login now.');
            // $this->session->set_flashdata('success', 'Your email verification sucessfully.');
            redirect('register');
        } else {
            $this->session->set_flashdata('failed', 'Unautherized user, unabled to verify user account');
            redirect('register');
        }
    }


    public function PowerUserVerify()
    {
        $user_id = base64_decode($this->uri->segment(3));
        $update_condition = array('user_id' => $user_id);
        $user_info = json_decode($this->User_model->commonGetWhere('ga_users_tbl', array('user_id' => $user_id)));
        $update_data = array('verified_email' => 1);
        $up = json_decode($this->Crud->commonUpdate('ga_users_tbl', $update_data, $update_condition));

        if ($up->code == SUCCESS_CODE) {

            $this->session->set_flashdata('success', 'Your email verification sucessfully.');
            redirect('signin');
        } else {
            $this->session->set_flashdata('failed', 'Unautherized user, unabled to verify user account');
            redirect('register');
        }
    }

    public function followers()
    {
        $where = array('power_user_id' => $this->user_id);
        $keyword = $this->input->post('search');
        if (!empty($keyword)) {
            $user = $this->user_id;
            $this->data['follower'] = $this->User_model->get_search_follower_data($keyword, $user);
        }
        $this->load->view('followers', $this->data);
    }
    public function power_users()
    {
        $where = array('power_user_id' => $this->user_id);
        $keyword = $this->input->post('search');
        if (!empty($keyword)) {
            $user = $this->user_id;
            $this->data['follower'] = $this->User_model->get_search_power_user_data($keyword, $user);
        }
        $this->load->view('powerusers', $this->data);
    }

    public function follower_request()
    {
        $response = array();
        $email = $this->input->post('useremail');
        $followerid = $this->input->post('followerid');
        $username = $this->input->post('username');
        $linkresult = json_decode($this->User_model->send_follow_link($email, $followerid));
        if ($linkresult->code == 200) {
            $email_data = array('link' => $linkresult->verificationlink, 'name' => $username);
            $result_follower = $this->sendmail->sendEmail(
                array(
                    'to' => array($email),
                    'cc' => array('info@' . SITE_DOMAIN),
                    'bcc' => array(BCC_EMAIL),
                    'subject' => 'Follow Up Request.',
                    'data' => array('user_details' => $email_data),
                    'template' => EMAIL_TEMPLATE_FOLDER . 'follow_request_template',
                )
            );
            if ($result_follower[CODE] == 1) {
                $response[CODE] = SUCCESS_CODE;
                $response[MESSAGE] = 'success';
                $response[DESCRIPTION] = 'Link has been sent to follower';
                echo  json_encode($response);
                die;
            } else {
                $response[CODE] = FAIL_CODE;
                $response[MESSAGE] = 'fail';
                $response[DESCRIPTION] = 'Failed to send request';
                echo  json_encode($response);
                die;
            }
        }
    }
    public function poweruser_request()
    {
        $response = array();
        $email = $this->input->post('useremail');
        $followerid = $this->input->post('followerid');
        $username = $this->input->post('username');
        $linkresult = json_decode($this->User_model->send_follow_link($email, $followerid));
        if ($linkresult->code == 200) {
            $email_data = array('link' => $linkresult->verificationlink, 'name' => $username);
            $result_follower = $this->sendmail->sendEmail(
                array(
                    'to' => array($email),
                    'cc' => array('info@' . SITE_DOMAIN),
                    'bcc' => array(BCC_EMAIL),
                    'subject' => 'Follow Up Request.',
                    'data' => array('user_details' => $email_data),
                    'template' => EMAIL_TEMPLATE_FOLDER . 'follow_request_template',
                )
            );

            if ($result_follower[CODE] == 1) {
                $response[CODE] = SUCCESS_CODE;
                $response[MESSAGE] = 'success';
                $response[DESCRIPTION] = 'Link has been sent to power user';
                echo  json_encode($response);
                die;
            } else {
                $response[CODE] = FAIL_CODE;
                $response[MESSAGE] = 'fail';
                $response[DESCRIPTION] = 'Mail Sending Fail';
                echo  json_encode($response);
                die;
            }
        }
    }

    public function follower_request_verify()
    {
        $segment = $this->uri->segment('2');
        $where = array('verified_email' => 3, 'verificationcode' => $segment, 'user_type' => 1);
        $existchek = $this->crud->commonCheck('user_id', 'ga_users_tbl', $where);
        if ($existchek == 1) {
            $update_data = array('verified_email' => 1, 'verificationcode' => '');
            $update = json_decode($this->Crud->commonUpdate('ga_users_tbl', $update_data, $where));
            if ($update->code == 200) {
                redirect('register');
            }
        } else {
            $this->session->set_flashdata('failed', 'You are not authorize user, try again.');
            redirect('register');
        }
    }
    public function poweruser_request_verify()
    {
        $segment = $this->uri->segment('2');
        $where = array('verified_email' => 3, 'verificationcode' => $segment, 'user_type' => 2);
        $existchek = $this->crud->commonCheck('user_id', 'ga_users_tbl', $where);
        if ($existchek == 1) {
            $update_data = array('verified_email' => 1, 'verificationcode' => '');
            $update = json_decode($this->Crud->commonUpdate('ga_users_tbl', $update_data, $where));
            if ($update->code == 200) {
                redirect('register');
            }
        } else {
            $this->session->set_flashdata('failed', 'You are not authorize user, try again.');
            redirect('register');
            //echo 'fail';die;
        }
    }
    // Forgot password code start from here
    public function forgotPassword()
    {
        if (isset($this->user_id) && !empty($this->user_id)) {
            redirect('/');
        }

        $this->load->view('forgotPassword', $this->data);
    }
    public function sendingResetPasswordLink()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('required' => 'Please enter email', 'valid_email' => 'Please enter valid email'));
        if ($this->form_validation->run() == false) {
            $this->load->view('forgotPassword', $this->data);
        } else {
            $email = $this->input->post('email');
            $check_email = $this->Crud->commonCheck('user_email', 'ga_users_tbl', ['user_email' => $email]);
            $user_data = array();
            $verificationcode = sha1('ShoperativeUser' . rand(100, 999));
            if ($check_email) {
                $update_user = json_decode($this->Crud->commonUpdate('ga_users_tbl', ['verificationcode' => $verificationcode], ['user_email' => $email]));
                if ($update_user->code == 200) {
                    $user_data['subject'] = 'Reset Password';
                    $user_data['email'] = $email;
                    $user_data['link'] = base_url() . 'reset-password/' . $verificationcode;
                    // sending email for reset password
                    $mail_array = $this->sendmail->sendEmail(
                        array(
                            'to' => array($email),
                            'cc' => array('info@' . SITE_DOMAIN),
                            'bcc' => array(BCC_EMAIL),
                            'subject' => 'Reset Password',
                            'data' => array('email_content' => $user_data),
                            'template' => EMAIL_TEMPLATE_FOLDER . 'forgot_password',
                        )
                    );
                    // email code end
                    if ($mail_array['code'] == 1) {
                        $this->session->set_flashdata('success', 'Reset password link sent to your email ID');
                    } else {
                        $this->session->set_flashdata('failed', 'Unabled to send reset pasword link, please try again');
                    }
                } else {
                    $this->session->set_flashdata('failed', 'Oops! Something went wrong, please try again');
                }
            } else {
                $this->session->set_flashdata('failed', 'Email not registered, try other');
            }
            redirect('forgot-password');
        }
    }
    public function resetPassword()
    {
        if (isset($this->user_id) && !empty($this->user_id)) {
            redirect('/');
        }

        $this->load->view('resetPassword', $this->data);
    }
    public function resettingPassword()
    {
        $this->form_validation->set_rules('new_password', 'New password', 'required|trim|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|trim|matches[new_password]');
        if ($this->form_validation->run() == false) {
            $this->load->view('resetPassword', $this->data);
        } else {
            $verificationcode = $this->input->post('verificationcode');
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');

            $cols = array('user_password');
            $wherecondition = array('verificationcode' => $verificationcode);
            $common_check = $this->Crud->commonCheck($cols, 'ga_users_tbl', $wherecondition);
            if ($common_check == 1) {
                $update_data = array('user_password' => md5($new_password), 'verificationcode' => '', 'verified_email' => 1);
                $update = $this->Crud->commonUpdate('ga_users_tbl', $update_data, $wherecondition);
                $update = json_decode($update);
                if ($update->code == SUCCESS_CODE) {
                    $this->session->set_flashdata('success', 'Password has been reset successfully!');
                    redirect('register');
                } else {
                    $this->session->set_flashdata('failed', 'Oops! Unabled to reset password');
                    redirect('reset-password/' . $verificationcode);
                }
            } else {
                $this->session->set_flashdata('failed', 'Oops! Unabled to reset password');
                redirect('forgot-password');
            }
        }
    }
    // Forgot password code end here
    /*end*/

    public function updatePassword()
    {
        if (!empty($this->user_id)) {


            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');

            $cols = array('user_password');
            $wherecondition = array('user_password' => md5($old_password), 'user_id' => $this->user_id,);
            $common_check = $this->Crud->commonCheck($cols, 'ga_users_tbl', $wherecondition);
            if ($common_check == 1) {
                $update_data = array('user_password' => md5($new_password));
                $update_condition = array('user_id' => $this->user_id);
                $update = $this->Crud->commonUpdate('ga_users_tbl', $update_data, $update_condition);
                $update = json_decode($update);

                if ($update->code == SUCCESS_CODE) {
                    //print_r($update);
                    $this->session->set_flashdata('success', 'Your password has been changed successfully!');
                } else {
                    $this->session->set_flashdata('failed', 'Oops! Unabled to change password');
                }
            } else {
                $this->session->set_flashdata('failed', 'Something went wrong, try again');
            }
            redirect('/profile');
        } else {
            redirect('/');
        }
    }
}
