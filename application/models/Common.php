<?php
defined('BASEPATH') or die('Some thing error occured while loading the common model');
class Common extends CI_Model
{
        public function __construct()
        {
                parent::__construct();
        }


        public function mainMenuList()
        {

                $response = array('menu_result' => array());
                $where = array('flag_status' => 1, 'trash' => 0);
                $catImgPath = base_url() . 'uploads/menu/';
                $cols = "menu_id as menu_id,menu_title as menu_title,created_date as created_date , flag_status as flag_status , trash as trash, concat('" . $catImgPath . "',image) as icon";
                $sql =  $this->db->select($cols)->from('menu_tbl')->where($where)->order_by('menu_id', 'ASC')->get();
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
                                        /*Submenu list */
                                        $submenu_where = array('menu_id' => $menu_id, 'flag_status' => 1);
                                        $submenu_cols = "submenu_id as submenu_id ,menu_id as menu_id,submenu_title as submenu_title,flag_status as flag_status , trash as trash";
                                        $submenu_sql =  $this->db->select($submenu_cols)->from('submenu_tbl')
                                                ->where($submenu_where)->order_by('submenu_id', 'ASC')->get();
                                        $submenu_count = $submenu_sql->num_rows();
                                        if ($submenu_count > 0) {
                                                $submenu_array = array();
                                                foreach ($submenu_sql->result() as $submenu_result) {
                                                        $submenu_id = $submenu_result->submenu_id;
                                                        foreach ($submenu_result as $submenu_key => $submenu_val) {
                                                                $submenu_array[$submenu_key] = $submenu_val;
                                                        }

                                                        $listsubmenu_where = array('submenu_id' => $submenu_id, 'flag_status' => 1);
                                                        $listsubmenu_cols = "listsubmenu_id as listsubmenu_id,menu_id as menu_id,submenu_id as submenu_id,listsubmenu_title as listsubmenu_title,flag_status as flag_status , trash as trash";
                                                        $listsubmenu_sql =  $this->db->select($listsubmenu_cols)->from('listsubmenu_tbl')
                                                                ->where($listsubmenu_where)->order_by('listsubmenu_title', 'ASC')->get();

                                                        $listsubmenu_count = $listsubmenu_sql->num_rows();
                                                        if ($listsubmenu_count > 0) {

                                                                $submenu_array['listsubmenu_list'] = array();
                                                                foreach ($listsubmenu_sql->result() as $listsubmenu_result) {
                                                                        foreach ($listsubmenu_result as $listsubmenu_key => $listsubmenu_val) {
                                                                                $listsubmenu_array[$listsubmenu_key] = $listsubmenu_val;
                                                                        }
                                                                        array_push($submenu_array['listsubmenu_list'], $listsubmenu_array);
                                                                        //print_r( $menu_array);exit;

                                                                }
                                                        }
                                                        array_push($menu_array['submenu_list'], $submenu_array);
                                                }
                                        }
                                        /*Submenu list End*/
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
