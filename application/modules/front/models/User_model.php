<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
    }

    public function commonGetAll($tablename, $wherecondition)
    {
        $response = array();
        $this->db->where($wherecondition);
        $get_all = $this->db->get($tablename);
        $count = $this->db->affected_rows();
        $db_error =  $this->db->error();

        $respose[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $respose['result'] = $get_all->result();
        return json_encode($respose);
    }


    public function commonGetWhere($tablename, $wherecondition)
    {
        $response = array();
        $this->db->where($wherecondition);
        $get_row = $this->db->get($tablename);
        $update = $this->db->affected_rows();
        if ($update > 0) {
            $response['result'] = $get_row->row();
        }
        return json_encode($response);
    }


    public function wishlist($user_id)
    {
        $response = array();
        $this->db->where('w.user_id', $user_id);
        $this->db->select("w.prod_id,w.user_id,mp.prod_image,mp.prod_name,mp.unit,mp.selling_price");
        $this->db->from('ga_wishlist_tbl w');
        $this->db->join('ga_main_prod_details_tbl mp', 'mp.id = w.prod_id', 'inner');

        //$this->db->group_by('w.prod_id');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $itemCount =  $query->num_rows();
        $db_error =  $this->db->error();
        $respose[CODE] = ($itemCount > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($itemCount > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($itemCount > 0) ? " $itemCount result found " : ' No result found ';
        $respose['result'] = $query->result();
        return json_encode($respose);
    }
    public function commonAddress($tablename, $wherecondition)
    {
        $response = array();
        $this->db->where($wherecondition);
        $get_all = $this->db->get($tablename);
        $count = $this->db->affected_rows();
        $db_error =  $this->db->error();

        // $respose[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        // $respose[MESSAGE]=($count > 0)?' success ':' failed ';
        // $respose[DESCRIPTION]=($count > 0)? " $count result found ":' No result found ';
        $respose = $get_all->row();
        return json_encode($respose);
    }

    public function getUserDetails($user_id)
    {
        $response = array();
        $this->db->where('u.user_id', $user_id);
        $this->db->select("u.power_user_id,u.user_email");
        $this->db->from('ga_users_tbl u');
        // $this->db->group_by('w.prod_id');
        $query = $this->db->get();
        $itemCount =  $query->num_rows();
        $db_error =  $this->db->error();
        $respose[CODE] = ($itemCount > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($itemCount > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($itemCount > 0) ? "result found " : ' No result found ';
        $respose['result'] = $query->row();
        //print_r($respose['result']);
        return json_encode($respose);
    }

    public function cartOrderData()
    {
        $response = array();
        $this->db->where(array('o.userid' => $this->user_id));
        $this->db->select("o.*,c.cart_id,c.cart_type");
        $this->db->from('ga_orders_tbl o');
        $this->db->join('ga_cart_tbl c', 'c.order_id = o.orderid', 'inner');
        $this->db->group_by('c.order_id');
        $this->db->order_by('o.orderid', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $itemCount =  $query->num_rows();
        $db_error =  $this->db->error();
        $respose[CODE] = ($itemCount > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($itemCount > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($itemCount > 0) ? " $itemCount result found " : ' No result found ';
        $respose['result'] = $query->result();
        return json_encode($respose);
    }
    public function myWalletData()
    {
        /*
		 * Update By	:Zabihullah
		 * Changes		:Before We were displaying all the orders which were canceled 
		 * 				 Now We will display each item which has status 5(cancel)
		 * 				 
		 */
        $response = array();
        $this->db->where(array('o.userid' => $this->user_id, 'c.cart_status' => 5));
        $this->db->select("c.cart_id,o.orderid,o.ordernumber,o.orderdate,c.shipping_charges,c.unit_price,c.total_amount,(c.shipping_charges+c.total_amount)as refund_amount,p.prod_name");
        $this->db->from('ga_orders_tbl o');
        $this->db->join('ga_cart_tbl c', 'c.order_id = o.orderid');
        $this->db->join('ga_main_prod_details_tbl p', 'p.id = c.prod_id');
        $this->db->order_by('c.cart_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $itemCount =  $query->num_rows();
        $db_error =  $this->db->error();
        $respose[CODE] = ($itemCount > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($itemCount > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($itemCount > 0) ? " $itemCount result found " : ' No result found ';
        $respose['result'] = $query->result();
        return json_encode($respose);
    }
    public function sharedcartData()
    {
        $response = array();
        $this->db->where(array('shared_by' => $this->user_id));
        $this->db->select("*");
        $this->db->from('ga_shared_cart_tbl');
        $query = $this->db->get();
        $itemCount =  $query->num_rows();
        $db_error =  $this->db->error();
        $respose[CODE] = ($itemCount > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($itemCount > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($itemCount > 0) ? " $itemCount result found " : ' No result found ';
        $respose['result'] = $query->result();
        return json_encode($respose);
    }
    public function user_sharedcartData()
    {
        /*getting power user id for logged in follower to check for shared cart availability*/
        $user_res = $this->db->select('power_user_id')->from('ga_users_tbl')->where('user_id', $this->user_id)->get();
        $user_count = $user_res->num_rows();

        if ($user_count > 0) {
            $row = $user_res->row();
            /**
             * Update By: Zabihullah
             * Problem : Severity error
             * Line : $this->db->where(['shared_by'=>$row->power_user_id]);
             * Changes :I brought all the bellow code which was outside if block inside the if block
             * All following  lines were outside the if block
             */
            $response = array();
            $this->db->select("s.*,u.user_name,o.orderstatus,o.payment_status");
            $this->db->from('ga_shared_cart_tbl s');
            $this->db->join('ga_users_tbl u', 's.shared_by=u.user_id');
            $this->db->join('ga_orders_tbl o', 'o.userid=u.user_id', 'left');
            $this->db->where(['shared_by' => $row->power_user_id]);
            $this->db->limit(1);
            $query = $this->db->get();
            //echo $this->db->last_query();exit;
            $itemCount =  $query->num_rows();
            $db_error =  $this->db->error();
            $respose[CODE] = ($itemCount > 0) ? SUCCESS_CODE : FAIL_CODE;
            $respose[MESSAGE] = ($itemCount > 0) ? ' success ' : ' failed ';
            $respose[DESCRIPTION] = ($itemCount > 0) ? " $itemCount result found " : ' No result found ';
            $respose['result'] = $query->result();
            return json_encode($respose);
        }
    }
    /*vivek model code*/
    public function get_search_follower_data($keyword, $user)
    {
        //print_r($this->session->all_userdata());exit;
        //$this->load->library('session');
        //$user_id=$this->session('user_id');
        $this->db->select('*');
        $this->db->from('ga_users_tbl as gut');
        $this->db->join('ga_followers_tbl as gft', 'gft.follower_id = gut.user_id');
        $this->db->where(array('gut.user_status' => 1));
        /*if(!empty($user)){
            $this->db->where('gft.power_user_id',$user);
            }*/
        /*else{
            $this->db->where('gut.power_user_id','0');
            }*/
        $this->db->group_start();
        $this->db->like('gut.user_address', $keyword);
        $this->db->or_like('gut.state', $keyword);
        $this->db->or_like('gut.user_city', $keyword);
        $this->db->or_like('gut.user_reigster_id', $keyword);
        $this->db->or_like('gut.user_name', $keyword);
        // $this->db->or_like('gut.user_email',$keyword);
        $this->db->or_like('gut.user_mobile', $keyword);
        $this->db->group_end();
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $res = $query->result();
    }
    public function get_search_power_user_data($keyword, $where)
    {
        $this->db->select('*');
        $this->db->from('ga_users_tbl as gut');
        $this->db->join('ga_followers_tbl as gft', 'gft.power_user_id = gut.power_user_id', 'left');
        $this->db->where(array('gut.user_status' => 1));
        $this->db->where('gut.power_user_id', '0');
        /*if(!empty($where)){
            $this->db->where('gft.power_user_id',$where);
        }
        else{
        $this->db->where('gut.power_user_id','0');
        }*/
        //$this->db->where($where1);
        $this->db->group_start();
        $this->db->like('gut.user_address', $keyword);
        $this->db->or_like('gut.state', $keyword);
        $this->db->or_like('gut.user_city', $keyword);
        $this->db->or_like('gut.user_reigster_id', $keyword);
        $this->db->or_like('gut.user_name', $keyword);
        $this->db->or_like('gut.user_email', $keyword);
        $this->db->or_like('gut.user_mobile', $keyword);
        /*if(!empty($keyword['project_type'])){
        $this->db->or_like('pt.project_type_id',$keyword['project_type']);
        }
        if(!empty($keyword['min'])  && !empty($keyword['max'])){
        $this->db->where('pt.price >=',$keyword['min']);
        $this->db->where('pt.price<=',$keyword['max']); 
        }*/
        $this->db->group_end();
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $res = $query->result();
    }
    /*vivek code*/
    public function send_follow_link($email, $userid)
    {
        $response = array();
        $verificationCode = base64_encode($userid . time());
        $updatesql = $this->db->update_string(
            'ga_users_tbl',
            array('verificationcode' => $verificationCode),
            array('user_id' => $userid)
        );
        $update = $this->db->query($updatesql);
        $update_data = array('verified_email' => 3);
        $update_condition = array('user_id' => $userid);
        $res = $this->Crud->commonUpdate('ga_users_tbl', $update_data, $update_condition);
        //print_r($res);exit;
        $resultcount = $this->db->affected_rows();
        //echo $this->db->last_query();exit;
        //echo last_query();
        if ($resultcount > 0) {
            //echo "true data";exit();
            $response[CODE] = SUCCESS_CODE;
            $response[MESSAGE] = 'success';
            $response[DESCRIPTION] = 'Verification link has been sent to ' . $email;
            $response['verificationlink'] =  base_url() . 'follower-request-link/' . $verificationCode;
        } else {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] = 'Internal server error occured. Please inform to technical department';
        }
        return json_encode($response);
    }
    /*end*/
    /*vivek end*/
}
