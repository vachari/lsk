<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function commonGetAll($tablename, $wherecondition, $cols = null)
    {
        $response = array();
        $this->db->select($cols)->from($tablename)->where($wherecondition);
        $get_all = $this->db->get();
        $count = $this->db->affected_rows();
        $db_error =  $this->db->error();
        // if($update > 0 ){

        $respose[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $respose['result'] = $get_all->result();

        //  
        return json_encode($respose);
    }

    //getting home page featured products -- Seshu
    public function get_products($where, $order)
    {
        // print_r($order);
        if ($order == 1) {
            $order = 'DESC';
        } elseif ($order == 2) {
            $order = 'ASC';
        }
        $response = array();
        $this->db->select('mp.*,u.unit_of_measure');
        $this->db->from('ga_main_prod_details_tbl mp');
        $this->db->where($where);
        if ($order != '') {
            $this->db->order_by("mp.selling_price", 'ASC');
        } else {
            $this->db->order_by("mp.prod_name", 'ASC');
        }

        $this->db->join('ga_prod_units_tbl u', 'u.id = mp.unit', 'left');
        // $this->db->group_by('pi.prod_id');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $count = $query->num_rows();
        $respose[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $respose['result'] = $query->result();
        // print_r($respose['result']);
        return json_encode($respose);
    }
    //ends 
    public function get_ajax_products($where, $order, $price = null)
    {
        $response = array();
        if ($order == 1) {
            $order = 'DESC';
        } elseif ($order == 2) {
            $order = 'ASC';
        }
        $this->db->select('mp.*');
        $this->db->from('ga_main_prod_details_tbl mp');
        $this->db->where($where);
        if ($price != null) {
            $product_price = explode(',', $price);
            $count = count($product_price);
            for ($i = 0; $i < $count; $i++) {
                $range = $product_price[$i];
                if ($range[0] == '<') {
                    $price_exp = explode('-', $range);
                    $val = $price_exp[1];
                    $price_search_array[] = '( mp.selling_price <' . $val . ' )';
                } elseif ($range[0] == '>') {
                    $price_exp = explode('-', $range);
                    $val = $price_exp[1];
                    $price_search_array[] = '( mp.selling_price >' . $val . ' )';
                } else {
                    $price_exp = explode('-', $range);
                    $val1 = $price_exp[0];
                    $val2 = $price_exp[1];
                    $price_search_array[] = '( mp.selling_price BETWEEN ' . $val1 . ' AND ' . $val2 . ' )';
                }
            }
            $price_array = implode(' OR ', $price_search_array);
            $price_array = '(' . $price_array . ')';

            $this->db->where($price_array);
        }
        if ($order != '') {
            $this->db->order_by("min(mp.selling_price)", $order);
        } else {
            $this->db->order_by("mp.prod_name", 'ASC');
        }

        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $count = $query->num_rows();
        $respose[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $respose['result'] = $query->result();
        // print_r($respose['result']);
        return json_encode($respose);
    }

    public function products_by_name($where, $order, $like)
    {
        // print_r($order);
        if ($order == 1) {
            $order = 'DESC';
        } elseif ($order == 2) {
            $order = 'ASC';
        }
        $response = array();
        $this->db->select('mp.*,u.unit_of_measure');
        $this->db->from('ga_main_prod_details_tbl mp');
        //$this->db->where($where);
        if ($order != '') {
            $this->db->order_by("min(mp.selling_price)", $order);
        } else {
            $this->db->order_by("mp.prod_name", 'ASC');
        }

        $this->db->join('ga_prod_units_tbl u', 'u.id = mp.unit', 'left');
        $this->db->like('prod_name', $like, 'both');


        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $count = $query->num_rows();
        $respose[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
        $respose[MESSAGE] = ($count > 0) ? ' success ' : ' failed ';
        $respose[DESCRIPTION] = ($count > 0) ? " $count result found " : ' No result found ';
        $respose['result'] = $query->result();
        // print_r($respose['result']);
        return json_encode($respose);
    }


    public function menuBasedProducts()
    {

        $response = array('menu_result' => array());
        $where = array('flag_status' => 1, 'trash' => 0, 'front_enable' => 1);
        $catImgPath = base_url() . 'uploads/menu/';
        $cols = "menu_id as menu_id,menu_title as menu_title,created_date as created_date , flag_status as flag_status , trash as trash, concat('" . $catImgPath . "',image) as icon";
        $sql =  $this->db->select($cols)->from('menu_tbl')->where($where)->order_by('menu_id', 'ASC')->limit(5)->get();
        $db_error =  $this->db->error();
        if ($db_error['code'] == 0) {
            $count = $sql->num_rows();
            $menu_array = array();
            if ($count > 0) {
                foreach ($sql->result() as $menu_response) {
                    $menu_id = $menu_response->menu_id;
                    foreach ($menu_response as $key => $val) {
                        $menu_array[$key] = $val;
                    }
                    $menu_array['submenu_list'] = array();
                    $menu_array['product_list'] = array();
                    /*Submenu list */
                    $submenu_where = array('menu_id' => $menu_id, 'flag_status' => 1);
                    $submenu_cols = "submenu_id as submenu_id ,menu_id as menu_id,submenu_title as submenu_title,flag_status as flag_status , trash as trash";
                    $submenu_sql =  $this->db->select($submenu_cols)->from('submenu_tbl')
                        ->where($submenu_where)->order_by('submenu_id', 'ASC')->limit(6)->get();
                    $submenu_count = $submenu_sql->num_rows();
                    if ($submenu_count > 0) {
                        $submenu_array = array();
                        foreach ($submenu_sql->result() as $submenu_result) {
                            $submenu_id = $submenu_result->submenu_id;
                            foreach ($submenu_result as $submenu_key => $submenu_val) {
                                $submenu_array[$submenu_key] = $submenu_val;
                            }


                            array_push($menu_array['submenu_list'], $submenu_array);
                        }
                    }
                    /*Submenu list End*/
                    /*Product related Start */

                    $productWhere = array('mp.category' => $menu_id, 'mp.active_status' => 1, 'mp.trash' => 0);
                    $order = 'asc';
                    $this->db->select('mp.*');
                    $this->db->from('ga_main_prod_details_tbl mp');
                    $this->db->where($productWhere);
                    if ($order != '') {
                        $this->db->order_by("mp.selling_price", 'ASC');
                    } else {
                        $this->db->order_by("mp.prod_name", 'ASC');
                    }
                    $this->db->limit(3);
                    $product_query = $this->db->get();

                    $product_count = $product_query->num_rows();

                    if ($product_count > 0) {
                        $productTempArray = [];
                        foreach ($product_query->result() as $prod_result) {

                            foreach ($prod_result as $product_key => $value) {
                                $productTempArray[$product_key] = $value;
                                $productTempArray['productLink'] = base_url() . 'productDetails/' . $prod_result->id;
                            }
                            array_push($menu_array['product_list'], $productTempArray);
                        }
                    }
                    /*Product related end */
                    array_push($response['menu_result'], $menu_array);
                }
            }
            $response[CODE] = ($count > 0) ? SUCCESS_CODE : FAIL_CODE;
            $response[MESSAGE] = ($count > 0) ? 'Success' : 'Fail';
            $response[DESCRIPTION] = ($count > 0) ? 'Getting menu list' : 'No results found';
        } else {
            $response[CODE] = DB_ERROR_CODE;
            $response[MESSAGE] = 'DB Error';
            $response[DESCRIPTION] = $db_error['message'];
        }
        // print_r($response);
        return json_encode($response);
    }
}
