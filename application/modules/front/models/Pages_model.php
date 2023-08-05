<?php
class Pages_model extends CI_Model
{
    public function __construct()
    {

        parent::__construct();
    }

    public function commonGetAll($tablename, $wherecondition)
    {
        $response = array();
        $this->db->where($wherecondition);
        $get_all = $this->db->get($tablename);
        $count = $this->db->affected_rows();
        $db_error =  $this->db->error();;
        // if($update > 0 ){

        $respose[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $respose['result'] = $get_all->result();
        //  
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

    public function can_login($data)
    {
        // print_r($data);exit;
        $response = array();
        $this->db->where('user_email', $data['user_email']);
        $this->db->where('user_password', md5($data['user_password']));
        $this->db->where('user_status', 1);
        $query = $sql_fetch = $this->db->get('ga_users_tbl');
        //return $query->row();
        //print_r($query);exit;
        $db_error =  $this->db->error();
        if ($db_error['code'] != 0) {
            $response['code'] = '575';
            $response['message'] = 'DB Error';
            $response['description'] = (QUERY_DEBUG == 1) ? $db_error['message'] : 'Some thing error occured';
        } else {
            $count = $sql_fetch->num_rows();
            $response['code'] = ($count  > 0) ? 200 : 204;
            $response['message'] = ($count  > 0) ? 'Success' : 'Fail';
            $response['description'] = ($count  > 0) ? 'Getting the user list' : 'No results found';
            $response['result_count'] = $count;
            $response['common_result'] = ($count  > 0) ? $sql_fetch->row() : (object) null;
        }

        return json_encode($response);
    }

    public function can_followerlogin($data)
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
    public function can_vendorlogin($data)
    {
        $response = array();
        $this->db->where('email', $data['email']);
        $this->db->where('password', $data['password']);
        $sql_fetch = $this->db->get('ga_vendors_table');
        $db_error =  $this->db->error();
        if ($db_error['code'] != 0) {
            $response['code'] = '575';
            $response['message'] = 'DB Error';
            $response['description'] = (QUERY_DEBUG == 1) ? $db_error['message'] : 'Some thing error occured';
        } else {       //if()
            $count = $sql_fetch->num_rows();
            $response['code'] = ($count  > 0) ? 200 : 204;
            $response['message'] = ($count  > 0) ? 'Success' : 'Fail';
            $response['description'] = ($count  > 0) ? 'Getting the vendor data' : 'Data not found';
            $response['result_count'] = $count;
            $response['common_result'] = ($count  > 0) ? $sql_fetch->row() : (object) null;
        }

        return json_encode($response);
    }
    public function can_shipperlogin($data)
    {
        $response = array();
        $this->db->where('email', $data['email']);
        $this->db->where('password', $data['password']);
        $sql_fetch = $this->db->get('ga_shippers_table');
        $db_error =  $this->db->error();
        if ($db_error['code'] != 0) {
            $response['code'] = '575';
            $response['message'] = 'DB Error';
            $response['description'] = (QUERY_DEBUG == 1) ? $db_error['message'] : 'Some thing error occured';
        } else {       //if()
            $count = $sql_fetch->num_rows();
            $response['code'] = ($count  > 0) ? 200 : 204;
            $response['message'] = ($count  > 0) ? 'Success' : 'Fail';
            $response['description'] = ($count  > 0) ? 'Getting the shipper data' : 'Data not found';
            $response['result_count'] = $count;
            $response['common_result'] = ($count  > 0) ? $sql_fetch->row() : (object) null;
        }

        return json_encode($response);
    }
    public function get_professions()
    {
        $response = array();
        $this->db->select('p.*');
        $this->db->from('ga_professions_tbl p');
        $this->db->where(array('p.status' => 1, 'p.front_enable' => 1));
        $this->db->order_by('profession', 'ASC');
        $query = $this->db->get();
        $count = $query->num_rows();
        $respose[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $respose['result'] = $query->result();
        return json_encode($respose);
    }
    //getting home page featured products -- Seshu
    public function get_featured_products()
    {
        $response = array();
        $this->db->select('mp.*,max(pi.selling_price) as selling_price,u.unit_of_measure');
        $this->db->from('ga_main_prod_details_tbl mp');
        $this->db->where('mp.feature_product', 1);
        $this->db->join('ga_prod_item_pricing_tbl pi', 'mp.id = pi.prod_id', 'left');
        $this->db->join('ga_prod_units_tbl u', 'u.id = pi.unit_of_measure', 'left');
        $this->db->group_by('pi.prod_id');
        $query = $this->db->get();
        $count = $query->num_rows();
        $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $response[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $response[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $response['result'] = $query->result();
        // print_r($response['result']);
        return json_encode($response);
    }
    public function get_front_categories()
    {
        $response = array();
        $response['categories'] = array();
        $this->db->select('m.menu_id,m.menu_title,m.image');
        $this->db->from('menu_tbl m');
        $this->db->where(['m.front_enable' => 1, 'm.flag_status' => 1]);
        $query = $this->db->get();
        $menus = $query->result();
        $count = $query->num_rows();
        if ($count > 0) {
            $response['categories'] = $menus;
        }
        return json_encode($response);
    }
    public function get_cat_products()
    {
        $response = array();
        $response['categories'] = array();
        $this->db->select('m.menu_id,m.menu_title');
        $this->db->from('menu_tbl m');
        $this->db->where(['m.front_enable' => 1, 'm.flag_status' => 1]);
        $query = $this->db->get();
        $menus = $query->result();
        $count = $query->num_rows();
        $prod_count = 0;
        if ($count > 0) {
            $prod_array = array();
            foreach ($menus as $cats) {
                $category = $cats->menu_id;
                foreach ($cats as $cat_key => $cat_val) {
                    $prod_array[$cat_key] = $cat_val;
                }
                $prod_array['products'] = array();
                $prod_qry = $this->db->select('mp.*,MIN(pi.selling_price) as selling_price,u.unit_of_measure')->from('ga_main_prod_details_tbl mp')->join('ga_prod_item_pricing_tbl pi', 'pi.prod_id=mp.id')->join('ga_prod_units_tbl u', 'u.id=mp.unit')->where(['mp.category' => $category, 'mp.feature_product' => 1, 'mp.active_status' => 1])->limit(5, 0)->group_by('pi.prod_id')->get();
                $prod_count = $this->db->affected_rows();
                if ($prod_count > 0) {
                    $prod_array['products'] = $prod_qry->result();
                }
                array_push($response['categories'], $prod_array);
            }
        }
        $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $response[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $response[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        // echo "<pre>";
        //  print_r($response);exit;
        return json_encode($response);
    }
    //ends

    // Product Details page 
    public function productDetails()
    {

        $response = array();
        $id = $this->uri->segment(2);
        $product_folder = PRODCUCT_IMAGE_PATH;
        $where = array('p.active_status' => 1, 'p.trash' => 0, 'p.id' => $id);
        $cols = "p.mrp,p.id, p.prod_code, p.prod_group, p.sku, p.prod_name, p.prod_desc, p.other_image, p.active_status, p.trash, ip.id, ip.prod_code, ip.form_date, ip.to_date, ip.selling_price, ip.qty_range_from, ip.qty_range_to, u.id, u.unit_code";
        $sql =  $this->db->select($cols, false)->from(' ga_prod_item_pricing_tbl ip')
            ->join('ga_main_prod_details_tbl p', 'ip.prod_id=p.id', 'left')->join('ga_prod_units_tbl u', 'u.id=ip.unit_of_measure', 'left')->where($where)->get();
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


    public  function itemVarity()
    {

        $response = array();
        $this->db->select('m.*');
        $this->db->from('menu_tbl m');
        $this->db->where(array('m.flag_status' => 1, 'm.trash' => 0, 'm.front_enable' => 1));
        //$this->db->join('submenu_tbl s', 'm.flag_status = s.flag_status');
        $query = $this->db->get();
        $count = $query->num_rows();
        $respose[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $respose['result'] = $query->result();
        return json_encode($respose);
    }
    public  function itemSubmenu()
    {

        $response = array();
        $this->db->select('s.*');
        $this->db->from('submenu_tbl s');
        $this->db->where(array('s.flag_status' => 1, 's.trash' => 0));
        $query = $this->db->get();
        $count = $query->num_rows();
        $respose[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $respose['result'] = $query->result();
        return json_encode($respose);
    }
    public  function itemSubmenudown()
    {

        $response = array();
        $this->db->select('m.*');
        $this->db->from('menu_tbl m');
        $this->db->where(array('m.flag_status' => 1, 'm.trash' => 0, 'm.front_enable' => 0));
        //$this->db->join('submenu_tbl s', 'm.flag_status = s.flag_status');
        $query = $this->db->get();
        $count = $query->num_rows();
        $respose[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $respose['result'] = $query->result();
        return json_encode($respose);
    }

    public function get_Fetch($table)
    {
        $response = array();
        $query = $this->db->get($table);
        $count = $this->db->affected_rows();
        $db_error =  $this->db->error();

        $respose[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $respose['data_result'] = $query->result();
        return json_encode($respose);
    }

    public function commonWhereFetch($cols, $table, $where1, $orderbycol, $order)
    {
        if ($where1) {
            $this->db->where($where1);
        }
        $res = $this->db->select($cols)->from($table)->order_by($orderbycol, $order)->get();
        //echo $this->db->last_query();exit;
        $count = $res->num_rows();
        if ($count > 0) {
            return $res->result();
        } else {
            return null;
        }
    }

    public function productGallery($id)
    {
        $sql = $this->db->select('*')->from('product_images_tbl')->where('product_id', $id)->order_by('priority', 'asc')->get();
        return ($sql->num_rows() > 0) ? $sql->result() : [];
    }
}
