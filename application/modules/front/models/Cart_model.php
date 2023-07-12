<?php
class Cart_model extends CI_Model
{
    public function commonGetAll($tablename, $wherecondition)
    {
        $response = array();
        $this->db->where($wherecondition);
        $get_all = $this->db->get($tablename);
        $update = $this->db->affected_rows();
        if ($update > 0) {
            $response['result'] = $get_all->result();
        }
        return json_encode($response);
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

    public function commonGetWhere2($tablename, $wherecondition)
    {
        $response = array();
        $this->db->where($wherecondition)->order_by('id', 'DESC')->limit(1, 0);
        $get_row = $this->db->get($tablename);
        $get = $this->db->affected_rows();
        if ($get > 0) {
            $response['result'] = $get_row->row();
        } else {
            $response['result'] = 777;
        }
        return json_encode($response);
    }


    public function can_login($data)
    {
        // print_r($data);exit;
        $response = array();
        $this->db->where('user_email', $data['user_email']);
        $this->db->where('user_password', md5($data['user_password']));
        $query = $sql_fetch = $this->db->get('ga_users_tbl');
        //return $query->row();
        //print_r($query);exit;
        $db_error =  $this->db->error();
        if ($db_error['code'] != 0) {
            $response['code'] = '575';
            $response['message'] = 'DB Error';
            $response['description'] = (QUERY_DEBUG == 1) ? $db_error['message'] : 'Some thing error occured';
        } else {       //if()
            $count = $sql_fetch->num_rows();
            $response['code'] = ($count  > 0) ? 200 : 204;
            $response['message'] = ($count  > 0) ? 'Success' : 'Fail';
            $response['description'] = ($count  > 0) ? 'Getting the user list' : 'No results found';
            $response['result_count'] = $count;
            $response['common_result'] = ($count  > 0) ? $sql_fetch->row() : (object) null;
        }

        return json_encode($response);
    }
    public function cartList($cartsession)
    {
        $response = array();
        $product_folder = PRODCUCT_IMAGE_PATH;
        $where = array('c.cart_session_id' => $cartsession, 'c.cart_status' => 0, 'c.cart_type' => 1);
        $cols = "c.cart_id as cart_id,c.prod_id as prod_id,c.unit_price as selling_price,c.qty,c.shipping_charges,p.id,p.prod_code,p.prod_group,p.prod_name,p.prod_desc,CONCAT('" . $product_folder . "',prod_image) as product_image,p.other_image,p.active_status,p.trash";
        $sql =  $this->db->select($cols, false)->from('ga_cart_tbl c')->join('ga_main_prod_details_tbl p', 'p.id=c.prod_id', 'inner')->where($where)->order_by('c.cart_id', 'ASC')->get();
        $db_error =  $this->db->error();
        if ($db_error['code'] == 0) {
            $count = $sql->num_rows();
            $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
            $response[MESSAGE] = ($count > 0) ? 'Success' : 'Fail';
            $response[DESCRIPTION] = ($count > 0) ? $count . ' cart list found' : 'No items found in your cart';
            $response['item_count'] = ($count > 0) ? $count : 'No items found in your cart';
            $response['cart_result'] = ($count > 0) ? $sql->result() : array();
        } else {
            $response[CODE] = DB_ERROR_CODE;
            $response[MESSAGE] = 'Db error';
            $response[DESCRIPTION] = (QUERY_DEBUG == 1) ? $db_error['message'] : 'Something error occured';
        }

        return  json_encode($response);
    }


    //Checking Cart Item exists or not code start
    public function checkProductInCart($params)
    {
        $response = array();
        if (!is_array($params)) {
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Validation';
            $response[DESCRIPTION] = 'Input data format is invalid';
        } else {
            $product_id = $params['prod_id'];
            $cart_type = $params['cart_type'];
            $cart_session = $params['cart_session_id'];
            $user_id = $params['user_id'];
            //$is_sharecart =  $params['isShareCart'];
            $where = array('cart_session_id' => $cart_session, 'cart_status' => 0, 'prod_id' => $product_id);
            $this->db->select('cart_id,qty')->from('ga_cart_tbl')->where($where);
            if (!empty($user_id)) {
                $this->db->where('user_id', $user_id);
            }
            $sql = $this->db->get();
            $count = $sql->num_rows();
            if ($count) {
                $row = $sql->row_array();
                return  $row['qty'];
            } else
                return false;
        }
        return json_encode($response);
    }
    public function get_cart_product_details($prod_id)
    {
        $response = array();
        $this->db->where('mp.id', $prod_id);
        $this->db->select('mp.*');
        $this->db->from('ga_main_prod_details_tbl mp');
         
        $query = $this->db->get();
        $query->num_rows();
        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }
    //additing items to my cart -- seshu
    public function add_mycart($cart_data)
    {
        $response = array();
        //getting existing product details
        $prod_details = $this->get_cart_product_details($cart_data['prod_id']);
        if ($prod_details != false) {
            //checking product is available in cart or not
            $exists = $this->checkProductInCart($cart_data);
            if ($exists != false) {
                //updating ga_cart_tbl
                $update_qty = $exists + 1;
                $update_arr = array(
                    'qty' => $update_qty,
                    'total_amount' => $update_qty * $prod_details['selling_price'],
                );
                $this->db->where('prod_id', $cart_data['prod_id']);
                $this->db->where('cart_session_id', $cart_data['cart_session_id']);
                $update = $this->db->update('ga_cart_tbl', $update_arr);
                if ($update) {
                    $response[CODE] = SUCCESS_CODE;
                    $response[MESSAGE] = 'success';
                    $response[DESCRIPTION] = 'Item updated to cart';
                } else {
                    $response[CODE] = FAIL_CODE;
                    $response[MESSAGE] = 'failed';
                    $response[DESCRIPTION] = 'Not updated to cart';
                }
            } else {
                //inserting into ga_cart_tbl
                $add_arr = array(
                    'cart_type' => $cart_data['cart_type'],
                    'prod_id' => $cart_data['prod_id'],
                    'qty' => $cart_data['qty'],
                    'user_id' => $cart_data['user_id'],
                    'unit_price' => $prod_details['selling_price'],
                    'shipping_charges' => 20,
                    'total_amount' => $cart_data['qty'] * $prod_details['selling_price'],
                    'cart_session_id' => $cart_data['cart_session_id'],
                    'created_date' => DATE,
                    'shipping_charges' => 20,
                );
                $insert = $this->db->insert('ga_cart_tbl', $add_arr);
                if ($insert) {
                    $response[CODE] = SUCCESS_CODE;
                    $response[MESSAGE] = 'success';
                    $response[DESCRIPTION] = 'Item added to cart';
                } else {
                    $response[CODE] = FAIL_CODE;
                    $response[MESSAGE] = 'failed';
                    $response[DESCRIPTION] = 'Not added to cart';
                }
            }
            echo json_encode($response);
        } else {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] = 'No item found..!';
        }
        return json_encode($response);
    }
    //adding to my cart end
    /*getting shared cart session*/
    public function getShareCartSession($p_user_id)
    {
        $result = $this->db->select('session_id')->from('ga_shared_cart_tbl')->where('shared_by', $p_user_id)->limit(1)->get();
        return $result->row();
    }
    public function getShareCartPowerUser($user_id)
    {
        $result = $this->db->select('power_user_id')->from('ga_users_tbl')->where('user_id', $user_id)->limit(1)->get();
        return $result->row();
    }
}
