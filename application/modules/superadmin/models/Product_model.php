<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * FileName :Setting_model.php
 * PageType : Model
 * PagePath : Setting_model.php
 * Page Purpose : Product related settings
 * Created Date : 11-04-17
 * Created By : Jittu
 * Team : Jittu
 */
class Product_model extends CI_Model
{
    /* Code for getting prod details starts here */

    public function getProdDetails()
    {
        $response = array();
        $where = array('p.trash' => 0, 'p.active_status' => 1);
        $sql = $this->db->select('p.id,p.prod_code,g.group_code as prod_group,p.sku,p.unit,p.prod_name,p.prod_desc,p.listsubmenu_id,p.prod_image,p.other_image,p.active_status,p.feature_product,p.ip_address,p.created_by,p.created_on,p.trash')->from('ga_main_prod_details_tbl p')->join('ga_prod_groups_tbl g', 'p.prod_group=g.id', 'left')->where($where)->order_by('p.id', 'desc')->get();
        $count = $sql->num_rows();
        $response['code'] = ($count > 0) ? 200 : 204;
        $response['message'] = ($count > 0) ? 'Success' : 'Fail';
        $response['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $response['product_details'] = ($count > 0) ? $sql->result() : array();
        return json_encode($response);
    }

    /* Code for getting prod details ends here */

    public function getProdGroupDetails()
    {
        $response = array();
        $where = array('trash' => 0);
        $sql = $this->db->select('id,group_code,group_name,created_by,created_on,trash,active_status')->from('ga_prod_groups_tbl')->where($where)->order_by('id', 'desc')->get();
        $count = $sql->num_rows();
        $response['code'] = ($count > 0) ? 200 : 204;
        $response['message'] = ($count > 0) ? 'Success' : 'Fail';
        $response['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $response['product_details'] = ($count > 0) ? $sql->result() : array();
        return json_encode($response);
    }
    /* code for getting group price details starts here */

    public function getGroupPricing()
    {
        $response = array();
        $sql = $this->db->select('id,prod_id,prod_group,unit_of_measure,qty_range_from,qty_range_to,from_date,to_date,sellingprice,currency,created_on')->from('ga_prod_group_pricing_tbl')
            ->get();
        $count = $sql->num_rows();
        $response['code'] = ($count > 0) ? 200 : 204;
        $response['message'] = ($count > 0) ? 'Success' : 'Fail';
        $response['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $response['groupprice_details'] = ($count > 0) ? $sql->result() : array();
        $response['groupprice_count'] = $count;
        return json_encode($response);
    }

    /* code for getting group price details ends here */
    /* code for getting item price details starts here */

    public function getItemPricing()
    {
        $response = array();
        // $where = array('p.prod_id' => $prod_id);
        $sql = $this->db->select('id,prod_id,prod_code,vendor_item_code,sku,unit_of_measure,qty_range_from,qty_range_to,form_date,to_date,selling_price,currency,created_on')->from('ga_prod_item_pricing_tbl')->get();
        $count = $sql->num_rows();
        $response['code'] = ($count > 0) ? 200 : 204;
        $response['message'] = ($count > 0) ? 'Success' : 'Fail';
        $response['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $response['itemprice_res'] = ($count > 0) ? $sql->result() : array();
        $response['itemprice_count'] = $count;
        return json_encode($response);
    }
    public function updateProductPrice($id)
    {
        $this->db->select("id,prod_id,prod_code,vendor_item_code,sku,unit_of_measure,qty_range_from,qty_range_to,form_date,to_date,buying_price,selling_price")->from("ga_prod_item_pricing_tbl")->where("id", $id);
        $query = $this->db->get();
        $count = $query->num_rows();
        return ($count > 0) ? $query->row() : array();
    }
    public function updateProductGroupPrice($id)
    {
        $this->db->select("id,prod_id,prod_group,unit_of_measure,qty_range_from,qty_range_to,from_date,to_date,buyingprice,sellingprice,discount")->from("ga_prod_group_pricing_tbl")->where("id", $id);
        $query = $this->db->get();
        $count = $query->num_rows();
        return ($count > 0) ? $query->row() : array();
    }

    /* code for getting item price details ends here */

    public function getProdStockDetails()
    {
        $response = array();
        $where = array('trash' => 0);
        $sql = $this->db->select('id,group_code,truck_load_qty,min_order_qty,buying_price,vendor,ordered_prod_sku')->from('ga_prod_stock_details_tbl')->where($where)->get();
        $count = $sql->num_rows();
        $response['code'] = ($count > 0) ? 200 : 204;
        $response['message'] = ($count > 0) ? 'Success' : 'Fail';
        $response['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $response['productstock_details'] = ($count > 0) ? $sql->result() : array();
        return json_encode($response);
    }
    public function updateProduct($id)
    {
        $this->db->select("*")->from("ga_main_prod_details_tbl")->where("id", $id);
        $query = $this->db->get();
        $count = $query->num_rows();
        return ($count > 0) ? $query->row() : array();
    }
    public function getMenulist()
    {
        //$response=array();
        $sql = $this->db->select('menu_id,menu_title,submenu_id,submenu_title,listsubmenu_id,listsubmenu_title')
            ->from('ga_menu_view')->get();
        $count = $sql->num_rows();
        // $response['code']=($count)?'200':'204';
        // $response['message']=($count)?'success':'fail';
        // $response['description']=($count)?'Product listing':'No results found';
        // $response['product_data']=$sql->result();
        // return json_encode($response);
        return ($count > 0) ? $sql->row() : array();
    }

    public function updateProductDetails($id, $data)
    {

        $this->db->where('id', $id);
        $query = $this->db->update("ga_main_prod_details_tbl", $data);
        $updated = $this->db->affected_rows();
        //echo $updated;exit;
        if ($query > 0)
            return true;
        else
            return false;
    }
    public function batchInsert($table, $insertdata)
    {

        $response = array();
        $sql = $this->db->insert_batch($table, $insertdata);
        $affected_rows = $this->db->affected_rows();
        $response['code'] = ($affected_rows > 0) ? 200 : 204;
        $response['message'] = ($affected_rows > 0) ? 'Success' : 'Fail';
        $response['description'] = ($affected_rows > 0) ? "$affected_rows  records added successfully" : 'Unable to insert';
        return json_encode($response);
    }

    /* Code for getting prod details starts here */

    public function getUnits()
    {
        $response = array();
        $where = array('trash' => 0);
        $sql = $this->db->select('id,unit_code,created_by,created_on,trash,active_status')->from('ga_prod_units_tbl')->where($where)->order_by('id', 'desc')->get();
        $count = $sql->num_rows();
        $response['code'] = ($count > 0) ? 200 : 204;
        $response['message'] = ($count > 0) ? 'Success' : 'Fail';
        $response['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $response['units_details'] = ($count > 0) ? $sql->result() : array();
        return json_encode($response);
    }

    /* Code for getting prod details ends here */


    /* Code for getting prod sku qty and product unit starts here */
    public function getProdSku($product_id)
    {
        $response = array();
        $where = array('id' => $product_id);
        $sql = $this->db->select('p.sku,p.unit,p.vendor_item_code,v.vendor_name')->from('ga_main_prod_details_tbl p')->join('ga_vendors_table v', 'p.vendor_id=v.vendor_id', 'left')->where($where)->get();
        $count = $sql->num_rows();
        $response['code'] = ($count > 0) ? 200 : 204;
        $response['message'] = ($count > 0) ? 'Success' : 'Fail';
        $response['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $response['product_details'] = ($count > 0) ? $sql->row() : array();
        return json_encode($response);
    }

    /* Code for getting prod sku qty and product unit ends here */
    public function fetchGalleryList($product_id)
    {
        $response = array();
        $where = array('product_id' => $product_id);
        $sql = $this->db->select('*')->from('product_images_tbl')->where($where)->get();
        $count = $sql->num_rows();
        $response['code'] = ($count > 0) ? 200 : 204;
        $response['message'] = ($count > 0) ? 'Success' : 'Fail';
        $response['description'] = ($count > 0) ? "$count results found" : 'No results found..!';
        $response['result'] = ($count > 0) ? $sql->result() : array();
        return json_encode($response);
    }
}
