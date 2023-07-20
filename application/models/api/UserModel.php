<?php
defined('BASEPATH') or die('Some thing error occured while loading the common model');
class UserModel extends CI_Model
{
    public $user_tbl;
    public function __construct()
    {
        parent::__construct();
        $this->user_tbl = 'ga_users_tbl';
    }

    public function professionsList()
    {
        $response = array();
        $this->db->select('p.*');
        $this->db->from('ga_professions_tbl p');
        $this->db->where(array('p.status' => 1, 'p.front_enable' => 1));
        $this->db->order_by('profession', 'ASC');
        $query = $this->db->get();
        $count = $query->num_rows();
        $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $response[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $response[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $response['profession_result'] = $query->result();
        $response['income_list'] = [
            'Below 100000',
            '100000 to 200000',
            '200000 to 500000',
            'Above 500000'
        ];
        httpResponse($response, ($count > 0) ? 200 : 206);
    }

    public function userLogin($params)
    {
        $username = $params['username'];
        $password = $params['password'];
        $devicetoken = $params['devicetoken'];
        $enc_password =  md5($password);
        $this->db->select("user_id as user_id,user_name as user_name,user_email as email,user_mobile as mobile,	user_status as profile_status");
        $this->db->from($this->user_tbl);
        $this->db->where('user_password', $enc_password);
        $this->db->group_start();
        $this->db->where('user_email', $username);
        $this->db->or_where('user_mobile', $username);
        $this->db->group_end();
        $sql  = $this->db->limit(1)->get();
        //echo $this->db->last_query();exit;  
        $dbError = $this->db->error();
        $count = 0;
        if ($dbError['code'] != 0) {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] = ' Some thing error occured. Please inform to suppot team';
            //Send email of exception pening..
        } else {
            $count = $sql->num_rows();
            if ($count > 0) {
                $ipaddress = $this->input->ip_address();
                $user_id = $sql->row()->user_id;
                $logData = ['login_id' => $user_id, 'log_in_time' => DATE, 'ipaddress' => $ipaddress, 'browser_details' => $_SERVER['HTTP_USER_AGENT'], 'created_on' => DATE, 'module' => 'user'];
                $logInsert = $this->db->insert('profiles_login_history', $logData);
                /*Insert Pushnotification code start*/
                $userReq = $sql->row();

                if (!empty($devicetoken)) {

                    $pushNotificationData = [
                        'user_id' => $user_id,
                        'device_token' => $devicetoken,
                        'mobile_details' => '',
                    ];
                    $logInsert = $this->db->insert('user_device_tokens', $pushNotificationData);
                }
                /*Insert Pushnotification code end*/
            }
            $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
            $response[MESSAGE] = ($count > 0) ? 'success' : 'fail';
            $response[DESCRIPTION] = ($count > 0) ? 'Account login success' : 'Invalid login details';
            $response['user_details'] = ($count > 0) ? $sql->row() : (object)(null);
        }
        return json_encode($response);
    }

    //profile Details
    public function profileDetails($params)
    {
        $response = [];
        $count = 0;
        $userid = $params['userid'];
        $where = ['u.user_id' => $userid, 'u.user_status' => 1, 'u.trash' => 0];
        $cols = "u.user_id as userid,u.user_name as username,u.user_email as email,u.user_mobile as mobile,u.user_address as address,u.user_city as city,u.state as state,u.latitude as latitude,u.longitude as longitude,u.user_profession as user_profession,u.user_income as income,u.user_reigster_id as user_reigster_id,u.fb_link as fb_link";
        $this->db->select($cols)->from($this->user_tbl . ' u')

            ->where($where);
        $sql = $this->db->limit(1)->get();
        $dbError = $this->db->error();
        if ($dbError['code'] != 0) {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] = ' Some thing error occured. Please inform to suppot team';
            $response['wallet_amount'] = 0;
            $response['user_details'] = (object)(null);
            //Send email of exception pening..
        } else {


            $count = $sql->num_rows();
            $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
            $response[MESSAGE] = ($count > 0) ? 'success' : 'fail';
            $response[DESCRIPTION] = ($count > 0) ? 'Getting profile details   ' : 'No user details found';
            $response['user_details'] = ($count > 0) ? $sql->row() : (object)(null);
        }
        httpResponse($response, ($count > 0) ? 200 : 206);
    }

    //Forgot Password 
    public function forgotPasswordRequest($inputReq)
    {
        $email = $inputReq['email'];
        $verificationcode = sha1(USER_SECURE_CODE . rand(100, 999));
        $query = $this->db->update_string($this->user_tbl, ['verificationcode' => $verificationcode], ['user_email' => $email]);
        $request = $this->db->query($query);
        $count  = $this->db->affected_rows();
        $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $response[MESSAGE] = ($count > 0) ? 'success' : 'fail';
        $response[DESCRIPTION] = ($count > 0) ? 'Email Verification code sent successfully' : 'No user details found';
        $response['verificationcode'] = ($count > 0) ? $verificationcode : null;
        return json_encode($response);
    }

    // Change Password 
    public function changePassworMethod($inputReq)
    {
        $userid = $inputReq['userid'];
        $new_password = $inputReq['new_password'];
        $old_password = $inputReq['old_password'];
        $query = $this->db->update_string($this->user_tbl,  ['user_password' => $new_password], ['user_id' => $userid, 'user_password' => $old_password]);
        $request = $this->db->query($query);
        $count  = $this->db->affected_rows();
        $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $response[MESSAGE] = ($count > 0) ? 'success' : 'fail';
        $response[DESCRIPTION] = ($count > 0) ? 'Password updated successfully' : 'Old password not matched';
        httpResponse($response, ($count > 0) ? 200 : 206);
    }

    //Update user profile Data
    public function updateUserprofile($inputReq, $userID)
    {

        $query = $this->db->update_string($this->user_tbl,  $inputReq, ['user_id' => $userID]);
        $request = $this->db->query($query);
        $count  = $this->db->affected_rows();
        $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $response[MESSAGE] = ($count > 0) ? 'success' : 'fail';
        $response[DESCRIPTION] = ($count > 0) ? 'Profile Details updated successfully' : 'Unable to update / profile details not modified';
        httpResponse($response, ($count > 0) ? 200 : 206);
    }

    //Logout User
    public function logoutUser($userID, $authToken)
    {
        $authTokenWithBearerToken = explode('.', $authToken)[0];
        $authToken = str_replace('Bearer ', '', $authTokenWithBearerToken);
        $updateRecord = $this->db->update_string('auth_tokens', ['current_status' => 'LOGOUT'], ['user_id' => $userID, 'token' => $authToken]);
        $updateQuery = $this->db->query($updateRecord);
        $count  = $this->db->affected_rows();
        $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $response[MESSAGE] = ($count > 0) ? 'success' : 'fail';
        $response[DESCRIPTION] = ($count > 0) ? 'Logout Success' : 'Unable to logout user';
        httpResponse($response, ($count > 0) ? 200 : 200);
    }
}
