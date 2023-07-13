<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends RestApi_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['api/UserModel' => 'user']);
        $this->load->library('api_auth');
    }

    //Professions List
    public function professionList()
    {
        $this->user->professionsList();
    }

    //Registration
    public function userRegister(Type $var = null)
    {
        $response = array();
        $error_message = '';
        $error = 0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) {
            httpResponse([CODE => VALIDATION_CODE, MESSAGE => 'fail', DESCRIPTION => 'Input data should be in JSON format only'], 206);
        } else {
            $req_response = json_decode($req_input);
            $username = (isset($req_response->username)) ? input_data($req_response->username) : '';
            $mobile = (isset($req_response->mobile)) ? input_data($req_response->mobile) : '';
            $email = (isset($req_response->email)) ? input_data($req_response->email) : '';
            $password = (isset($req_response->password)) ? input_data($req_response->password) : '';

            $errorMsg = '';
            if ($username == '') {
                $error = 1;
                $errorMsg .= '* User name is missing,';
            }
            if (!mobile_check($mobile)) {
                $errorMsg .= '* invalid mobile ,';
                $error = 1;
            }
            if (!email_check($email)) {
                $errorMsg .= '* invalid email ,';
                $error = 1;
            }

            if (strlen($password) < 6) {
                $errorMsg .= '* password length should be minimum 6 required.';
                $error = 1;
            }



            if ($error == 1) {
                httpResponse([CODE => VALIDATION_CODE, MESSAGE => 'fail', DESCRIPTION => $errorMsg], 206);
            } else {
                $insert_array = array(
                    'user_name' => $username,
                    'user_email' =>  $email,
                    'user_mobile' =>  $mobile,
                    'user_password' =>  md5($password),

                    'user_reigster_id' => 'LSKG' . date('dmy') . rand(1, 99),
                    'user_type' => 3,
                    'user_status' => 1,
                    'created_on' => DATE
                );

                $insert_user = json_decode($this->Crud->commonInsert('ga_users_tbl', $insert_array, 'Register Successfully done'));
                if ($insert_user->code == SUCCESS_CODE) {
                    $user_id = $insert_user->inserted_id;
                    $link = base_url() . 'user/activeUserAccount/' . base64_encode($user_id);
                    $user_data = array('user_name' => $username, 'link' => $link);
                    if (SITE_MODE == 1) {
                        $mail_array = $this->sendmail->sendEmail(
                            array(
                                'to' => array($email),
                                'cc' => array('info@' . SITE_DOMAIN),
                                'bcc' => array(BCC_EMAIL),
                                'subject' => 'Shoperative User Verification Link',
                                'data' => array('user_data' => $user_data),
                                'template' => EMAIL_TEMPLATE_FOLDER . 'verification_user',
                            )
                        );
                    } else {
                        $mail_array['code'] = 1;
                    }

                    if ($mail_array['code'] == 1) {
                        httpResponse([CODE => SUCCESS_CODE, MESSAGE => 'success', DESCRIPTION => 'Registration successfully done & verification link sent to your email ID'], 200);
                    } else {
                        httpResponse([CODE => SUCCESS_CODE, MESSAGE => 'fail', DESCRIPTION => 'Data Inserted successfully but unabled to send verification link'], 200);
                    }
                } else {
                    httpResponse([CODE => FAIL_CODE, MESSAGE => 'fail', DESCRIPTION => 'OOPs something went wrong.'], 206);
                }
            }
        }
    }

    public function userLogin()
    {

        $response = array();
        $error_message = '';
        $error = 0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) {
            httpResponse([CODE => VALIDATION_CODE, MESSAGE => 'fail', DESCRIPTION => 'Input data should be in JSON format only'], 206);
        } else {
            $req_response = json_decode($req_input);
            $username = (isset($req_response->loginusername)) ? input_data($req_response->loginusername) : '';
            $password = (isset($req_response->loginpassword)) ? input_data($req_response->loginpassword) : '';
            $devicetoken = (isset($req_response->devicetoken)) ? input_data($req_response->devicetoken) : '';
            $appType = (isset($req_response->appType)) ? input_data($req_response->appType) : '';
            /*Validatio Section */
            if ($username == '') {
                $error_message .= '* Enter email/mobile ,';
                $error = 1;
            }
            if ($password == '') {
                $error_message .= '* password is missing ,';
                $error = 1;
            }
            if ($password != '' && strlen($password) < 6) {
                $error_message .= '* password length should be minimum 6 required.';
                $error = 1;
            }
            if ($devicetoken == '') {
                $error_message .= '* token is missing.';
                $error = 1;
            }
            /*Validation Section ends here*/
            if ($error == 1) {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] = rtrim($error_message, ',');
                httpResponse([CODE => VALIDATION_CODE, MESSAGE => 'Validation', DESCRIPTION => rtrim($error_message, ',')], 206);
            } else {
                //No errors we can proceeed
                $loginData = [
                    'username' => $username,
                    'password' => $password,
                    'devicetoken' => $devicetoken,
                ];
                $loginResponse =  $this->user->userLogin($loginData);


                $logReq = json_decode($loginResponse);
                if ($logReq->code == SUCCESS_CODE) {

                    $userInfo = $logReq->user_details;

                    $userId = $userInfo->user_id;
                    $username = $userInfo->user_name;
                    $email = $userInfo->email;
                    $mobile = $userInfo->mobile;
                    $profile_status = $userInfo->profile_status;
                    if ($appType == 'WEB') {
                        $session_data = array(
                            'user_id' => $userId,
                            'user_name' => $username,
                            'user_email' => $email,
                            'user_mobile' => $mobile,
                        );

                        $this->session->set_userdata($session_data);
                    }

                    if ($userId && $profile_status == 1) {
                        $bearerToken = $this->api_auth->generateToken($userId);
                        $response[CODE] = SUCCESS_CODE;
                        $response[MESSAGE] = 'Login Success';
                        $response[DESCRIPTION] = 'Login success. Please wait..';
                        $response['token'] = $bearerToken;
                        $userInfo->token = $bearerToken;
                        httpResponse([CODE => SUCCESS_CODE, MESSAGE => 'success', DESCRIPTION => 'Login success. Please wait..', 'user_details' => $userInfo, 'token' => $bearerToken], 200);
                    } else {
                        $status_msg = '';
                        switch ($profile_status) {
                            case 0:
                                $status_msg = 'Your account blocked';
                                break;
                            case 2:
                                $status_msg = 'Account de-activated';
                                break;
                            case 3:
                                $status_msg = 'Please verify the email / Mobile to activate account';
                                break;
                            case 4:
                                $status_msg = 'Account under forgot password state.Please check the mail and reset the password';
                                break;
                        }

                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'FAIL';
                        $response[DESCRIPTION] = $status_msg;
                        $response['user_details'] = (object)(null);
                        httpResponse([CODE => FAIL_CODE, MESSAGE => 'fail', DESCRIPTION => $status_msg, 'user_details' => (object)(null)], 206);
                    }
                } else {
                    //Login fail condition
                    httpResponse([CODE => FAIL_CODE, MESSAGE => 'fail', DESCRIPTION => 'Invalid login details', 'user_details' => (object)(null)], 206);
                }
            }
        }
        // echo json_encode($response);
    }

    public function userProfile()
    {
        if ($this->api_auth->isNotAuthenticated()) {
            $err = array(
                'status' => false,
                'message' => 'unauthorised',
                'data' => []
            );
            $this->response($err);
        }
        $userId = $this->api_auth->getUserId();
        $this->user->profileDetails(['userid' => $userId]);
    }

    //Forgot password
    public function forgotPassword()
    {
        $response = array();
        $error_message = '';
        $error = 0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) {
            httpResponse([CODE => VALIDATION_CODE, MESSAGE => 'fail', DESCRIPTION => 'Input data should be in JSON format only'], 206);
        } else {
            $req_response = json_decode($req_input);
            $emailID = (isset($req_response->email)) ? input_data($req_response->email) : '';
            /*Validatio Section */
            if (!email_check($emailID)) {
                $error_message .= '* invalid email ,';
                $error = 1;
            }
            /*Validation Section ends here*/
            if ($error == 1) {
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Validation';
                $response[DESCRIPTION] = rtrim($error_message, ',');
                httpResponse([CODE => VALIDATION_CODE, MESSAGE => 'Validation', DESCRIPTION => rtrim($error_message, ',')], 206);
            } else {
                //No errors we can proceeed
                $forgotRequest = [
                    'email' => $emailID,
                ];
                $response =  $this->user->forgotPasswordRequest($forgotRequest);
                $curResponse = json_decode($response);
                if ($curResponse->code == SUCCESS_CODE) {
                    $verificationcode = $curResponse->verificationcode;
                    /*Email related code start */
                    if (SITE_MODE == 1) {
                        $user_data['subject'] = "Reset Password on date('d,M Y')";
                        $user_data['email'] = $emailID;
                        $user_data['link'] = base_url() . 'reset-password/' . $verificationcode;
                        $mail_array = $this->sendmail->sendEmail(
                            array(
                                'to' => array($emailID),
                                'cc' => array('info@' . SITE_DOMAIN),
                                'bcc' => array(BCC_EMAIL),
                                'subject' => 'Reset Password',
                                'data' => array('email_content' => $user_data),
                                'template' => EMAIL_TEMPLATE_FOLDER . 'forgot_password',
                            )
                        );
                        if ($mail_array['code'] == 1) {
                            httpResponse([CODE => SUCCESS_CODE, MESSAGE => 'Success', DESCRIPTION => "Verification code sent to $emailID"], 200);
                        } else {
                            httpResponse([CODE => SUCCESS_CODE, MESSAGE => 'Success', DESCRIPTION => "Unable to send email"], 206);
                        }
                    }
                    /*Email related code End */
                    httpResponse([CODE => SUCCESS_CODE, MESSAGE => 'Success', DESCRIPTION => "Verification code sent to $emailID"], 200);
                } else {
                    httpResponse([CODE => FAIL_CODE, MESSAGE => 'fail', DESCRIPTION => "$emailID no account found"], 206);
                }
            }
        }
    }

    //Change Password
    public function changePassword()
    {
        if ($this->api_auth->isNotAuthenticated()) {
            $err = array(
                'status' => false,
                'message' => 'unauthorised',
                'data' => []
            );
            $this->response($err);
        }
        $response = array();
        $error_message = '';
        $error = 0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) {
            httpResponse([CODE => VALIDATION_CODE, MESSAGE => 'fail', DESCRIPTION => 'Input data should be in JSON format only'], 206);
        } else {
            $req_response = json_decode($req_input);

            $password = (isset($req_response->password)) ? input_data($req_response->password) : '';
            $confirm_password = (isset($req_response->confirm_password)) ? input_data($req_response->confirm_password) : '';
            $old_password = (isset($req_response->old_password)) ? input_data($req_response->old_password) : '';
            $errorMsg = '';

            if (strlen($old_password) < 6) {
                $errorMsg .= '* old password length should be minimum 6 required.';
                $error = 1;
            }

            if (strlen($password) < 6) {
                $errorMsg .= '* password length should be minimum 6 required.';
                $error = 1;
            }

            if ($password != $confirm_password) {
                $errorMsg .= '* password & confirm password not matched.';
                $error = 1;
            }

            if ($error == 1) {
                httpResponse([CODE => VALIDATION_CODE, MESSAGE => 'fail', DESCRIPTION => $errorMsg], 206);
            } else {
                $userId = $this->api_auth->getUserId();
                $changePasswordRequest = array(
                    'new_password' =>  md5($password),
                    'old_password' => md5($old_password),
                    'userid' => $userId
                );
                $this->user->changePassworMethod($changePasswordRequest);
            }
        }
    }

    //Update Profiel
    public function updateProfile()
    {
        if ($this->api_auth->isNotAuthenticated()) {
            $err = array(
                'status' => false,
                'message' => 'unauthorised',
                'data' => []
            );
            $this->response($err);
        }
        $response = array();
        $error_message = '';
        $error = 0;
        $req_input = file_get_contents('php://input');
        if (!isJson($req_input)) {
            httpResponse([CODE => VALIDATION_CODE, MESSAGE => 'fail', DESCRIPTION => 'Input data should be in JSON format only'], 206);
        } else {
            $req_response = json_decode($req_input);

            $username = (isset($req_response->username)) ? input_data($req_response->username) : '';
            $address = (isset($req_response->address)) ? input_data($req_response->address) : '';
            $city = (isset($req_response->city)) ? input_data($req_response->city) : '';
            $state = (isset($req_response->state)) ? input_data($req_response->state) : '';
            $latitude = (isset($req_response->latitude)) ? input_data($req_response->latitude) : '';
            $longitude = (isset($req_response->longitude)) ? input_data($req_response->longitude) : '';
            $user_profession = (isset($req_response->user_profession)) ? input_data($req_response->user_profession) : null;
            $income = (isset($req_response->income)) ? input_data($req_response->income) : null;
            $fb_link = (isset($req_response->fb_link)) ? input_data($req_response->fb_link) : null;
            $errorMsg = '';

            if (strlen($username) < 3) {
                $errorMsg .= '* username length should be minimum 3 required.';
                $error = 1;
            }

            if ($address == '') {
                $errorMsg .= '* address required.';
                $error = 1;
            }
            if ($city == '') {
                $errorMsg .= '* city required.';
                $error = 1;
            }

            if ($state == '') {
                $errorMsg .= '* state required.';
                $error = 1;
            }

            if ($latitude == '') {
                $errorMsg .= '* latitude required.';
                $error = 1;
            }

            if ($longitude == '') {
                $errorMsg .= '* longitude required.';
                $error = 1;
            }

            if (strlen($username) > 60) {
                $errorMsg .= '* User name allows 60 characters only.';
                $error = 1;
            }

            if (strlen($city) > 30) {
                $errorMsg .= '* city allows 30 characters only.';
                $error = 1;
            }

            if (strlen($state) > 30) {
                $errorMsg .= '* state allows 30 characters only.';
                $error = 1;
            }


            if ($error == 1) {
                httpResponse([CODE => VALIDATION_CODE, MESSAGE => 'fail', DESCRIPTION => $errorMsg], 206);
            } else {
                $userId = $this->api_auth->getUserId();
                $updateProfileRequest = array(
                    'user_name' =>  $username,
                    'user_address' => $address,
                    'state' => $state,
                    'user_city' => $city,
                    'latitude' => $latitude,
                    'longitude' => $longitude
                );
                if ($user_profession != null) {
                    $updateProfileRequest['user_profession'] = $user_profession;
                }
                if ($income != null) {
                    $updateProfileRequest['user_income'] = $income;
                }
                if ($fb_link != null) {
                    $updateProfileRequest['fb_link'] = $fb_link;
                }
                $this->user->updateUserprofile($updateProfileRequest, $userId);
            }
        }
    }

    //User Logout
    public function logoutUserFromDevice()
    {
        /*
            - Update receord in sessions trcking Table
            - Delete record in Device token table
        */
        if ($this->api_auth->isNotAuthenticated()) {
            $err = array(
                'status' => false,
                'message' => 'unauthorised',
                'data' => []
            );
            $this->response($err);
        }

        $headers = null;

        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }

        if ($headers) {
            $userId = $this->api_auth->getUserId();
            $this->user->logoutUser($userId, $headers);
        } else {
            httpResponse([CODE => VALIDATION_CODE, MESSAGE => 'fail', DESCRIPTION => 'Auth Token required'], 206);
        }
    }

    public function emailTest()
    {
        $to = ["achariphp@gmail.com"];
        $username = 'venkateswara Achari';
        $email = 'achariphp@gmail.com';
        $bookingLink = 'http://google.com/';
        $mobile = '9182900940';
        $body = "Dear Achari, <br/> Account created successfully. Please find user detail below.<br/>";
        $body .= 'User Details: ' . "<br/>" . 'Name: ' . $username . "<br/>" . 'Email: ' . $email . "<br/>" . 'Mobile:' . $mobile . "<br/>" . 'Link: <a href=' . $bookingLink . '>Click Here</a>';
        $this->load->library('email');
        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.hostinger.com',
            'smtp_port' => 465,
            'smtp_user' => 'info@lskoffers.com',
            'smtp_pass' => 'LSKOffers@info#2023',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'starttls'  => true,
            'newline'   => "\r\n",
            'smtp_crypto' => 'ssl'
        );
        $subject = "Welcome to LSK";
        $this->email->initialize($config);
        $this->email->from('info@lskoffers.com', 'LSK Enterprises');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($body);
        $result = $this->email->send();
        print_r( $result);
        if( $result){
            echo "Mail Sent";
        }else{
            echo "Mail Failed";
        }
    }
}
