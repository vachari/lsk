<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends CI_Controller
{
    public $data;
    public function __construct()
    {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if ((!isset($this->admin_id) || $this->admin_id != true)) {
            redirect(base_url() . 'superadmin/login');
        }
        $this->data = array();
        $this->product_view_path = 'Product/';
        $this->load->model(array('Super_model', 'Settings_model', 'Product_model'));
    }
    /* code for creating product starts here */
    public function createProduct()
    {
        $this->data['menu_result'] = $this->Super_model->getMenuList();
        $this->data['vendor_result'] = $this->Super_model->getVendorList();
        $this->data['unit_result'] = $this->Settings_model->getUnitslist();
        $this->data['groups_result'] = $this->Settings_model->getGroupsList();
        $this->load->view('products/create_product', $this->data);
    }
    public function productPricing()
    {
        $this->data['group_code'] = $this->uri->segment('4');
        $this->data['prod_code'] = $this->uri->segment('5');
        $this->data['prod_id'] = $this->uri->segment('6');
        $this->data['unit_result'] = $this->Settings_model->getUnitslist();
        $this->data['product_details'] = $this->Product_model->getProdDetails();
        //print_r($this->data['product_details']);exit;
        $this->load->view('products/product_pricing', $this->data);
    }
    public function get_product_sku()
    {
        $product_id = $this->input->post('product_id');
        echo $this->Product_model->getProdSku($product_id);
    }
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

    public function insertProduct()
    {
        $response = array();
        $menu = $this->input->post('menu_id');
        $submenu = $this->input->post('submenu_id');
        $listsubmenu = $this->input->post('listsubmenu');
        $prodcode = $this->input->post('product_code');
        $prodtitle = $this->input->post('product_title');
        $prod_desc = $this->input->post('product_description');
        $sku_qty = $this->input->post('sku_qty');
        $prod_unit = $this->input->post('unit_id');
        $vendor_id = 1;
        $vendor_item_code = mt_rand(00, 1000);
        $mrp = $this->input->post('mrp');
        $sellingprice = $this->input->post('selling_price');
        $gst = $this->input->post('gst');
        $offerprice = $this->input->post('offerprice');

        $image = $_FILES['image']['name'];
        $alt_image = $_FILES['alt_image']['name'];
        $imageextension = array("jpg", "JPG", "gif", "GIF", "PNG", "png", "JPEG", "jpeg", "webp");
        if (
            $image != '' && $menu != '' && $submenu != '' && $prodcode != '' && $prodtitle != '' &&
            $prod_desc != '' && $sku_qty != '' && $mrp != '' && $gst != '' && $sellingprice != ''
        ) {
            if (!empty($image)) {
                $extension = $this->getFileExtensions($_FILES['image']['name']);
                if (in_array($extension, $imageextension)) {
                    $upload_pic = sha1(time() . rand(00000000, 999999999));
                    $filename = stripslashes($_FILES['image']['name']);
                    $upload_file = $_FILES['image']['tmp_name'];
                    $upload_picture = $upload_pic . '.' . $extension;
                    $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                    $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/products/" . $upload_picture;
                    $filename = $this->compress_image($upload_file, $url, 30);
                }
                if (!empty($alt_image)) {
                    $extension = $this->getFileExtensions($_FILES['alt_image']['name']);
                    if (in_array($extension, $imageextension)) {
                        $upload_pic = sha1(time() . rand(00000000, 999999999));
                        $filename = stripslashes($_FILES['alt_image']['name']);
                        $upload_file = $_FILES['alt_image']['tmp_name'];
                        $upload_alt_picture = $upload_pic . '.' . $extension;
                        $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                        $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/products/other_images/" . $upload_alt_picture;
                        $filename = $this->compress_image($upload_file, $url, 30);
                    }
                } else {
                    $upload_alt_picture = "";
                }
                $insert_array = array(
                    'category' => $menu,
                    'sub_category' => $submenu,
                    'listsubmenu_id' => $listsubmenu,
                    'prod_code' => $prodcode,
                    'prod_name' => $prodtitle,
                    'prod_desc' => $prod_desc,
                    'sku' => $sku_qty,
                    'prod_image' => $upload_picture,
                    'created_on' => DATE,
                    'other_image' => $upload_alt_picture,
                    'vendor_id' => $vendor_id,
                    'vendor_item_code' => $vendor_item_code,
                    'mrp' => $mrp,
                    'gst' => $gst,
                    'selling_price' => $sellingprice,
                    'offer_price' => $offerprice,
                    'unit' => $prod_unit,
                    'stock' => $sku_qty
                );
                $insert = $this->Crud->commonInsert('ga_main_prod_details_tbl', $insert_array);
                echo $insert;
                exit;
            } else {
                $response[CODE] = FAIL_CODE;
                $response[MESSAGE] = 'Please upload the product image';
                $response[DESCRIPTION] = 'Please upload the product image';
                echo json_encode($response);
            }
        } else {
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Validation';
            $response[DESCRIPTION] = 'Please fill mandatory fields';
            echo json_encode($response);
        }
    }

    /* code for creating product ends here */


    /* code for inserting product pricing starts here */

    public function insertProductPricing()
    {
        $response = array();
        $str = 1;
        $prod_code_error = '';
        $prod_code = array_filter($this->input->post('prod_id'));
        $vendor_item_code = array_filter($this->input->post('vpc'));
        $sku_qty = array_filter($this->input->post('sku_qty'));
        $unit_of_measure = array_filter($this->input->post('unit_of_measure'));
        $qty_range_from = array_filter($this->input->post('qty_range_from'));
        $qty_range_to = array_filter($this->input->post('qty_range_to'));
        $form_date = array_filter($this->input->post('form_date'));
        $to_date = array_filter($this->input->post('to_date'));
        $selling_price = array_filter($this->input->post('selling_price'));
        $buying_price = $this->input->post('buying_price');

        // remove the empty values for array
        // for ($i=0; $i<$count($prod_code); $i++)
        //   {
        //     if (empty($prod_code[$i])) unset($prod_code[$i]);
        //   }

        for ($i = 0; $i < count($prod_code); $i++) {
            if ($prod_code[$i] == 0) {
                $str = 0;
                $prod_code_error = "Please select the product code/product name";
            }
        }

        $prod_item_insert = array();
        if ($str == 1) {

            //echo 'testing';exit;
            for ($i = 0; $i < count($prod_code); $i++) {
                if (!empty($qty_range_from[$i]) && !empty($qty_range_to[$i]) && !empty($form_date[$i]) && !empty($selling_price[$i]) && $selling_price[$i] != 0) {

                    $prod_item_insert[] = array(
                        'prod_id' => $prod_code[$i],
                        'prod_code' => $prod_code[$i],
                        'vendor_item_code' => $vendor_item_code[$i],
                        'sku' => $sku_qty[$i],
                        'unit_of_measure' => $unit_of_measure[$i],
                        'qty_range_from' => $qty_range_from[$i],
                        'qty_range_to' => $qty_range_to[$i],
                        'form_date' => $form_date[$i],
                        'to_date' => $to_date[$i],
                        'selling_price' => $selling_price[$i],
                        'buying_price' => $buying_price[$i],
                        'currency' => '1',
                        'created_on' => DATE
                    );
                } else {
                    $this->session->set_flashdata('failed', 'Please enter all fields');
                    redirect('superadmin/Product/productPricing');
                }
            }
            if (!empty($prod_item_insert)) {
                $item_insert = $this->Crud->batchInsert('ga_prod_item_pricing_tbl', $prod_item_insert);
            }


            if ($item_insert) {
                $this->session->set_flashdata('success', 'Your data inserted Successfully..');
                redirect('superadmin/Product/itemPricingList');
            } else {
                $this->session->set_flashdata('failed', 'Your data Failed..');
                redirect('superadmin/Product/productPricing');
            }
        } else {
            $this->load->view('superadmin/Product/productPricing');
        }
    }

    public function updateProductPrice()
    {
        $id = $this->uri->segment(4, 0);
        if ($id != 0) {
            $this->data['unit_result'] = $this->Settings_model->getUnitslist();
            $this->data['product_details'] = $this->Product_model->getProdDetails();
            $this->data['product_price_details'] = $this->Product_model->updateProductPrice($id);
            // print_r($this->data['product_price_details']);exit;
            $this->load->view('products/update_product_price', $this->data);
        } else {
            redirect(base_url() . 'superadmin/Product/itemPricingList');
        }
    }
    public function UpdateProductPricing()
    {
        $response = array();

        $str = 1;
        $prod_code_error = '';
        $id = $this->input->post('id');
        $prod_code = $this->input->post('prod_id');
        $vpc = $this->input->post('vpc');
        $sku_qty = $this->input->post('sku_qty');
        $unit_of_measure = $this->input->post('unit_of_measure');
        $qty_range_from = $this->input->post('qty_range_from');
        $qty_range_to = $this->input->post('qty_range_to');
        $form_date = $this->input->post('form_date');
        $to_date = $this->input->post('to_date');
        $selling_price = $this->input->post('selling_price');
        $buying_price = $this->input->post('buying_price');

        if ($prod_code == 0) {
            $str = 0;
            $prod_code_error = "Please select the product code/product name";
        }


        if ($str == 1) {
            if (!empty($qty_range_from) && !empty($qty_range_to) && !empty($form_date) && !empty($to_date) && !empty($selling_price) && $selling_price != 0) {

                $prod_data = array(
                    'prod_id' => $prod_code,
                    'prod_code' => $prod_code,
                    'vendor_item_code' => $vpc,
                    'sku' => $sku_qty,
                    'unit_of_measure' => $unit_of_measure,
                    'qty_range_from' => $qty_range_from,
                    'qty_range_to' => $qty_range_to,
                    'form_date' => $form_date,
                    'to_date' => $to_date,
                    'selling_price' => $selling_price,
                    'buying_price' => $buying_price
                );

                $update = json_decode($this->Crud->commonUpdate('ga_prod_item_pricing_tbl', $prod_data, ['id' => $id]));

                if ($update->code == 200) {
                    $this->session->set_flashdata('success', 'Data updated Successfully..');
                    redirect('superadmin/Product/itemPricingList');
                } else {
                    $this->session->set_flashdata('failed', 'Data not modified');
                    redirect("superadmin/Product/updateProductPrice/$id");
                }
            } else {
                $this->session->set_flashdata('failed', 'Unabled to update data');
                redirect("superadmin/Product/updateProductPrice/$id");
            }
        } else {
            $this->session->set_flashdata('failed', 'Please enter all fields');
            redirect("superadmin/Product/updateProductPrice/$id");
        }
    }

    /* code for inserting product pricing ends here */
    /* code for 'product stock report start here */

    public function stockReport()
    {
        $response = array();
        $this->data['unit_result'] = $this->Settings_model->getUnitslist();
        $this->data['groups_result'] = $this->Settings_model->getGroupsList();
        $this->load->view('superadmin/products/stockreport', $this->data);
    }

    public function insertProductStock()
    {
        $response = array();
        $stock_insert_array = array();
        $group = $this->input->post('group_id');
        $unit = $this->input->post('unit_id');
        $vendor = $this->input->post('vendor');
        $truckloadqty = $this->input->post('truckload');
        $min_order_qty = $this->input->post('minorderqty');
        $buying_price = $this->input->post('buying_price');
        $ordered_prod_sku = $this->input->post('ord_sku_prod_code');
        if (
            !empty($group) && !empty($unit) && !empty($vendor) && !empty($truckloadqty) &&
            !empty($min_order_qty) && !empty($buying_price) && !empty($ordered_prod_sku)
        ) {
            $stock_insert_array = array(
                'group_code' => $group,
                'unit_id' => $unit,
                'truck_load_qty' => $truckloadqty,
                'vendor' => $vendor,
                'min_order_qty' => $min_order_qty,
                'buying_price' => $buying_price,
                'ordered_prod_sku' => $ordered_prod_sku,
                'created_on' => DATE,
            );
            $insert_stock = $this->Crud->commonInsert('ga_prod_stock_details_tbl', $stock_insert_array, 'Stock Inserted Successfully');
            echo $insert_stock;
            exit;
        } else {
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Validation';
            $response[DESCRIPTION] = 'Please fill mandatory fields';
            echo json_encode($response);
        }
    }

    /* code for product stock report ends here */
    /* code for getting product list for listing starts here */
    public function getProducts()
    {
        $response = array();
        $this->data['prod_data'] = $this->Product_model->getProdDetails();
        $this->load->view('superadmin/products/viewproducts', $this->data);
    }
    public function productDetails()
    {
        $srh = '';
        $like = '';
        if ($this->input->post('search') != '') {
            $srh = $this->input->post('search');
            $like = 'p.prod_name';
        } elseif ($this->input->post('group') != '') {
            $srh = $this->input->post('group');
            $like = 'g.group_code';
        } elseif ($this->input->post('category') != '') {
            $srh = $this->input->post('category');
            $like = 'p.category';
        }

        $this->data['menu_result'] = $this->Super_model->commonGetAll('menu_tbl');
        $this->data['submenu_result'] = $this->Super_model->commonGetAll('submenu_tbl');
        $this->data['listsubmenu_result'] = $this->Super_model->commonGetAll('listsubmenu_tbl');
        $cols = 'id';
        $search =  $srh;
        $table_name = 'ga_main_prod_details_tbl';
        $order_by_col = 'id';
        $config["base_url"] = base_url() . 'superadmin/Product/productDetails';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*         * Pagination code end* */
        $like_col = $like;
        $orderby = 'p.id';
        // $cols = 'id,vendor_item_code,unit,prod_code,prod_group,sku,unit,prod_name,prod_desc,category,sub_category,listsubmenu_id,prod_image,other_image,active_status,feature_product,ip_address,created_by,created_on,trash';
        $cols = 'p.*,g.group_code as prod_group,v.vendor_code,v.vendor_name,u.unit_code as unit';
        $table_name = 'ga_main_prod_details_tbl p';
        $this->data['common_result'] = $this->Super_model->getProductList($cols, $table_name, $like_col, $orderby, $config["per_page"], $page, $search);
        // print_r($this->data['common_result']);exit;

        $this->data['groupprice_details'] = $this->Product_model->getProdGroupDetails();
        $this->data['cat_details'] = $this->Super_model->get_catdata('menu_tbl');
        // print_r($this->data['groupprice_details'] );exit;
        $this->load->view('superadmin/products/viewproducts', $this->data);
    }
    public function product_inventory()
    {
        $srh = $search_key = $vendor = $group = '';
        $like = '';

        if ($this->input->post('search') != '') {
            $srh = $this->input->post('search');
            $search_key = $srh;
            $like = 'p.prod_name';
        } elseif ($this->input->post('vendor') != '') {
            $srh = $this->input->post('vendor');
            $vendor = $srh;
            $like = 'p.vendor_id';
        } elseif ($this->input->post('group') != '') {
            $srh = $this->input->post('group');
            $group = $srh;
            $like = 'g.group_code';
        }
        $cols = 'id';
        $search =  $srh;
        $table_name = 'ga_main_prod_details_tbl';
        $order_by_col = 'id';
        $config["base_url"] = base_url() . 'superadmin/Product/product_inventory';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*         * Pagination code end* */
        $like_col = $like;
        $orderby = 'p.id';
        $cols = 'p.*,g.group_code as prod_group,v.vendor_code,v.vendor_name,u.unit_code as unit';
        $table_name = 'ga_main_prod_details_tbl p';
        $this->data['common_result'] = $this->Super_model->getProductList($cols, $table_name, $like_col, $orderby, $config["per_page"], $page, $search);
        $this->data['vendor_details'] = $this->Super_model->getVendorList();
        $this->data['groupprice_details'] = $this->Product_model->getProdGroupDetails();
        $this->data['search'] = $search_key;
        $this->data['vendor'] = $vendor;
        $this->data['group'] = $group;
        $this->load->view('superadmin/products/productInventory', $this->data);
    }
    public function updatestock()
    {
        $response = array();
        $stock = $this->input->post('stock');
        $product_id = $this->input->post('product_id');
        $response['code'] = 111;
        $response['last_modified_stock'] = '';
        $update_stock = json_decode($this->Crud->commonUpdate('ga_main_prod_details_tbl', ['stock' => $stock, 'last_modified_stock' => DATE], ['id' => $product_id]));
        if ($update_stock->code == 200) {
            $response['last_modified_stock'] = date('d-M-Y h:i:s A');
        }
        $response['code'] = $update_stock->code;
        echo json_encode($response);
    }

    /* code for getting product list for listing ends here */
    /* code for getting product group pricing list starts here */

    public function groupPricingList()
    {
        $cols = 'id,prod_id,prod_group,unit_of_measure,qty_range_from,qty_range_to,from_date,to_date,sellingprice,buyingprice,discount,currency,created_on,active_status';
        $srh = '';
        $like = '';
        if ($this->input->post('search') != '') {
            $srh = $this->input->post('search');
            $like = 'prod_id';
        } elseif ($this->input->post('group') != '') {
            $srh = $this->input->post('group');
            $like = 'prod_group';
        }
        $table_name = 'ga_prod_group_pricing_tbl';
        $order_by_col = 'id';
        $config["base_url"] = base_url() . 'superadmin/Product/groupPricingList';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*         * Pagination code end* */
        $search = $srh;
        $like_col = $like;
        $orderby = 'id';
        $this->data['common_result'] = $this->Super_model->get_records($cols, $table_name, $like_col, $orderby, $config["per_page"], $page, $search);
        $this->data['groupprice_details'] = $this->Product_model->getGroupPricing();

        $this->data['main_pro'] = $this->Product_model->getProdDetails();
        $this->data['group_details'] = $this->Product_model->getProdGroupDetails();
        $this->data['units_details'] = $this->Product_model->getUnits();
        $this->load->view('superadmin/products/view_group_prices', $this->data);
    }

    /* code for getting product group pricing list ends here */
    /* code for getting product item pricing list starts here */

    public function itemPricingList()
    {
        $response = array();

        $cols = 'id,prod_id,prod_code,vendor_item_code,sku,unit_of_measure,qty_range_from,qty_range_to,form_date,to_date,selling_price,buying_price,currency,created_on,item_status';
        $search =  $this->input->post('search');
        $table_name = 'ga_prod_item_pricing_tbl';
        $order_by_col = 'id';
        $config["base_url"] = base_url() . 'superadmin/Product/itemPricingList/';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*         * Pagination code end* */
        $like_col = 'prod_id';
        $orderby = 'id';
        $this->data['common_result'] = $this->Super_model->get_records($cols, $table_name, $like_col, $orderby, $config["per_page"], $page, $search);
        $this->data['itemprice_details'] = $this->Product_model->getItemPricing();
        //print_r($this->data['itemprice_details']);
        $this->data['main_pro'] = $this->Product_model->getProdDetails();
        $this->data['units_details'] = $this->Product_model->getUnits();

        $this->load->view('superadmin/products/view_item_prices', $this->data);
    }

    public function addProductGroupPricing()
    {
        $this->data['units_details'] = $this->Settings_model->getUnitslist();
        $this->data['groupprice_details'] = $this->Product_model->getProdGroupDetails();
        $this->data['product_details'] = $this->Product_model->getProdDetails();
        $this->load->view('products/product_group_pricing', $this->data);
    }

    /* code for getting product item pricing list ends here */
    public function productGroupPricing()
    {
        //echo "cucc";exit;
        $prod_group = $this->input->post('prod_group');
        $unit_of_measure = $this->input->post('unit_of_measure');
        $qty_range_from = $this->input->post('qty_range_from');
        $qty_range_to = $this->input->post('qty_range_to');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $selling_price = $this->input->post('selling_price');
        $buying_price = $this->input->post('buying_price');
        $discount = $this->input->post('discount');
        $insertdata = array();

        if (!empty($selling_price)) {
            //echo 'success';  exit;
            for ($i = 0; $i < count($prod_group); $i++) {
                $insertdata[] = array(
                    'prod_group' => $prod_group[$i],
                    'unit_of_measure' => $unit_of_measure[$i],
                    'qty_range_from' => $qty_range_from[$i],
                    'qty_range_to' => $qty_range_to[$i],
                    'from_date' => $from_date[$i],
                    'to_date' => $to_date[$i],
                    'sellingprice' => $selling_price[$i],
                    'buyingprice' => $buying_price[$i],
                    'discount' => $discount[$i],
                    'created_on' => DATE
                );
            }
            $insert_result = $this->Product_model->batchInsert('ga_prod_group_pricing_tbl', $insertdata);

            if ($insert_result) {
                $this->session->set_flashdata('success', 'Your data submitted Successfully!');
                redirect('superadmin/Product/groupPricingList');
            } else {
                $this->session->set_flashdata('failed', 'Failed to submit..');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            echo 'fail';
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Validation';
            $response[DESCRIPTION] = '';
            $this->session->set_flashdata('failed', ' * Please fill all the fields * ');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function updateProductGroupPrice()
    {
        $id = $this->uri->segment(4, 0);
        if ($id != 0) {
            $this->data['units_details'] = $this->Settings_model->getUnitslist();
            $this->data['group_details'] = $this->Product_model->getProdGroupDetails();
            $this->data['product_details'] = $this->Product_model->getProdDetails();
            $this->data['groupPrice_details'] = $this->Product_model->updateProductGroupPrice($id);
            // print_r($this->data['groupPrice_details']);exit;
            $this->load->view('products/updateProductGroupPrice', $this->data);
        } else {
            redirect(base_url() . 'superadmin/Product/groupPricingList');
        }
    }
    public function UpdateProductGroupPricing()
    {
        $response = array();
        $str = 1;
        $prod_code_error = '';
        $id = $this->input->post('id');
        $prod_group = $this->input->post('prod_group');
        $unit_of_measure = $this->input->post('unit_of_measure');
        $qty_range_from = $this->input->post('qty_range_from');
        $qty_range_to = $this->input->post('qty_range_to');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $selling_price = $this->input->post('selling_price');
        $buying_price = $this->input->post('buying_price');
        $discount = $this->input->post('discount');


        if ($prod_group == '' || $unit_of_measure == '' || $unit_of_measure == 0) {
            $str = 0;
        }
        if ($unit_of_measure == '') {
            $str = 0;
        }

        if ($str == 1) {
            if (!empty($qty_range_from) && !empty($qty_range_to) && !empty($from_date) && !empty($to_date) && !empty($selling_price) && $selling_price != 0 && !empty($buying_price) && $buying_price != 0) {


                $prod_data = array(
                    'prod_group' => $prod_group,
                    'unit_of_measure' => $unit_of_measure,
                    'qty_range_from' => $qty_range_from,
                    'qty_range_to' => $qty_range_to,
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'sellingprice' => $selling_price,
                    'buyingprice' => $buying_price,
                    'discount' => $discount
                );

                $update = json_decode($this->Crud->commonUpdate('ga_prod_group_pricing_tbl', $prod_data, ['id' => $id]));
                if ($update->code == 200) {
                    $this->session->set_flashdata('success', 'Data updated Successfully..');
                    redirect('superadmin/Product/groupPricingList');
                } else {
                    $this->session->set_flashdata('failed', 'Data not modified');
                    redirect("superadmin/Product/updateProductGroupPrice/$id");
                }
            } else {
                $this->session->set_flashdata('failed', 'Unabled to update data');
                redirect("superadmin/Product/updateProductGroupPrice/$id");
            }
        } else {
            $this->session->set_flashdata('failed', 'Please enter all fields');
            redirect("superadmin/Product/updateProductGroupPrice/$id");
        }
    }
    /* Code for getting prod stock details start here */

    public function prodStock()
    {
        $response = array();
        $this->data['stock_details'] = $this->Product_model->getProdStockDetails();

        $this->load->view('superadmin/products/stockdisplay', $this->data);
    }

    /* Code for getting prod stock details ends here */
    /* code for updating both group and item price details starts herE */

    public function updatePricingDetails()
    {
        $respose = array();
        $prod_id = $this->uri->segment(4);
        $this->data['unit_result'] = $this->Settings_model->getUnitslist();
        $this->data['groupprice_details'] = $this->Product_model->getGroupPricing($prod_id);
        $this->data['itemprice_details'] = $this->Product_model->getItemPricing($prod_id);
        $this->load->view('superadmin/products/viewproductpricedetails', $this->data);
    }


    public function update_product()
    {

        $id = $this->uri->segment(4);
        $this->data['unit_result'] = $this->Settings_model->getUnitslist();

        $this->data['groups_result'] = $this->Settings_model->getGroupsList();
        $this->data['menu_result'] = $this->Super_model->get_catdata('menu_tbl');

        $this->data['submenu_result'] = $this->Super_model->get_catdata('submenu_tbl');

        $this->data['listsubmenu_result'] = $this->Super_model->get_catdata('listsubmenu_tbl');
        $this->data['vendor_result'] = $this->Super_model->getVendorList();
        $this->data['product_records'] = $this->Product_model->updateProduct($id);
        $this->load->view('products/update_product', $this->data);
    }
    public function update_product_details()
    {
        $response = array();
        $image = '';
        $alt_image = '';
        $menu = $this->input->post('menu_id');
        $submenu = $this->input->post('submenu_id');
        $listsubmenu = $this->input->post('listsubmenu');
        $prodcode = $this->input->post('product_code');
        $prodtitle = $this->input->post('product_title');
        $prod_desc = $this->input->post('product_description');
        $sku_qty = $this->input->post('sku_qty');
        $prod_unit = $this->input->post('unit_id');
        $mrp = $this->input->post('mrp');
        $sellingprice = $this->input->post('selling_price');
        $gst = $this->input->post('gst');
        $offerprice = $this->input->post('offerprice');
        $image = $_FILES['image']['name'];
        $alt_image = $_FILES['alt_image']['name'];
        $id = $this->input->post('pro_id');
        $where = array('id' => $id);
        $imageextension = array("jpg", "JPG", "gif", "GIF", "PNG", "png", "JPEG", "jpeg", "webp");

        if (!empty($image)) {
            $extension = $this->getFileExtensions($_FILES['image']['name']);
            if (in_array($extension, $imageextension)) {
                $upload_pic = sha1(time() . rand(00000000, 999999999));
                $filename = stripslashes($_FILES['image']['name']);
                $upload_file = $_FILES['image']['tmp_name'];
                $upload_picture = $upload_pic . '.' . $extension;
                $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/products/" . $upload_picture;
                $filename = $this->compress_image($upload_file, $url, 30);
            }
        }
        if (!empty($alt_image)) {
            $extension = $this->getFileExtensions($_FILES['alt_image']['name']);
            if (in_array($extension, $imageextension)) {
                $upload_pic = sha1(time() . rand(00000000, 999999999));
                $filename = stripslashes($_FILES['alt_image']['name']);
                $upload_file = $_FILES['alt_image']['tmp_name'];
                $upload_alt_picture = $upload_pic . '.' . $extension;
                $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/products/other_images/" . $upload_alt_picture;
                $filename = $this->compress_image($upload_file, $url, 30);
            }
        }
        if (empty($upload_picture)) {
            $upload_picture = $this->input->post('img1');
        }
        if (empty($upload_alt_picture)) {
            $upload_alt_picture = $this->input->post('img2');
        }
        $update_array = array(
            'category' => $menu,
            'sub_category' => $submenu,
            'listsubmenu_id' => $listsubmenu,
            'prod_code' => $prodcode,
            'prod_name' => $prodtitle,
            'prod_desc' => $prod_desc,
            'sku' => $sku_qty,
            'mrp' => $mrp,
            'gst' => $gst,
            'selling_price' => $sellingprice,
            'offer_price' => $offerprice,
            'prod_image' => $upload_picture,
            'unit' => $prod_unit,
            'other_image' => $upload_alt_picture,
            'stock' => $sku_qty
        );
        $update = $this->Crud->commonUpdate('ga_main_prod_details_tbl', $update_array, ['id' => $id]);
        echo $update;
        exit;

        //}   
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
            $image = imagecreatefromjpg($source_url);
        // elseif ($info['mime'] == 'image/tiff')
        //     $image = imagecreatefromtiff($source_url);
        elseif ($info['mime'] == 'image/JPG')
            $image = imagecreatefromjpg($source_url);
        elseif ($info['mime'] == 'image/PNG')
            $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/GIF')
            $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/JPEG')
            $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/webp')
            $image = imagecreatefromwebp($source_url);
        // elseif ($info['mime'] == 'image/TIFF')
        //     $image = imagecreatefromtiff($source_url);

        imagejpeg($image, $destination_url, $quality);
        return $destination_url;
    }


    public function commonStatus()
    {
        $response = array();
        $tablename = $this->input->post('tablename');
        $updatelist = $this->input->post('updatelist');
        $activity = $this->input->post('activity');
        if ($tablename != '' && $updatelist != '' && $activity != '' && ($activity == 0 || $activity == 1 || $activity == 2)) {
            $table = '';
            $setcolumns = '';
            $wherecondition = '';
            $updatevalue = '';
            switch ($tablename) {
                case 'group':   // need to refer name for table name
                    $table = 'ga_prod_group_pricing_tbl';   // table name 
                    $setcolumns = 'active_status';
                    $updatevalue = $activity;
                    $wherecondition = "id  IN  (" . $updatelist . ")";
                    break;

                case 'product':   // need to refer name for table name
                    $table = 'ga_main_prod_details_tbl';   // table name 
                    $setcolumns = 'active_status';
                    $updatevalue = $activity;
                    $wherecondition = "id  IN  (" . $updatelist . ")";
                    break;
                case 'item':   // need to refer name for table name
                    $table = 'ga_prod_item_pricing_tbl';   // table name 
                    $setcolumns = 'item_status';
                    $updatevalue = $activity;
                    $wherecondition = "id  IN  (" . $updatelist . ")";
                    break;
                case 'feature':   // need to refer name for table name
                    $table = 'ga_main_prod_details_tbl';   // table name 
                    $setcolumns = 'feature_product';
                    $updatevalue = $activity;
                    $wherecondition = "id  IN  (" . $updatelist . ")";
                    break;
            }
            $common = $this->Crud->commonStatusActivity($table, $setcolumns, $updatevalue, $wherecondition);
            echo $common;
            exit;
        }
        echo json_encode($response);
    }


    public function commonDelete()
    {
        $response = array();
        $relationname = 'Your data';
        $tablename = $this->input->post('tablename');
        $updatelist = $this->input->post('updatelist');
        if ($tablename != '') {
            $table = '';
            $wherecondition = '';
            switch ($tablename) {
                case 'group':
                    $table = 'ga_prod_group_pricing_tbl';
                    $wherecondition = "id IN  (" . $updatelist . ")";
                    break;

                case 'product':
                    $table = 'ga_main_prod_details_tbl';
                    $wherecondition = "id IN  (" . $updatelist . ")";
                    break;
                case 'item':
                    $table = 'ga_prod_item_pricing_tbl';
                    $wherecondition = "id IN  (" . $updatelist . ")";
                    break;
            }
            //print_r($wherecondition);
            $update = $this->Crud->commonDelete($table, $wherecondition, $relationname);
            echo $update;
            exit;
        }
        echo json_encode($response);
    }
    public function bulk_upload_view()
    {
        $this->load->view('products/bulk_upload_view');
    }
    public function bulk_upload()
    {
        $errors = 0;
        $error_messages = array();
        $success_msg = array();
        $csvFile = fopen($_FILES['csv_sheet']['tmp_name'], 'r');
        fgetcsv($csvFile);
        $i = 1;
        while (($emapData = fgetcsv($csvFile)) !== FALSE) {
            $prodcode = $emapData[0];
            $vendor_item_code = $emapData[1];
            $vendor_id = $emapData[2];
            $prodtitle = $emapData[3];
            $sku_qty = $emapData[4];
            $prod_unit = $emapData[5];
            $prod_group = $emapData[6];
            $menu = $emapData[7];
            $submenu = $emapData[8];
            $listsubmenu = $emapData[9];
            $image = $emapData[10];
            $alt_image = $emapData[11];
            $prod_desc = $emapData[12];
            $hsn_code = $emapData[13];
            $shelf_life_no = $emapData[14];
            $shelf_life_unit = $emapData[15];
            $mrp = $emapData[16];
            $gst = $emapData[17];
            $insert_array = array(
                'prod_code' => $prodcode,
                'vendor_item_code' => $vendor_item_code,
                'vendor_id' => $vendor_id,
                'prod_name' => $prodtitle,
                'sku' => $sku_qty,
                'unit' => $prod_unit,
                'prod_group' => $prod_group,
                'category' => $menu,
                'sub_category' => $submenu,
                'listsubmenu_id' => $listsubmenu,
                'prod_image' => $image,
                'other_image' => $image,
                'prod_desc' => $prod_desc,
                'hsn_code' => $hsn_code,
                'shelf_life_no' => $shelf_life_no,
                'shelf_life_unit' => $shelf_life_unit,
                'mrp' => $mrp,
                'gst' => $gst,
                'created_on' => DATE
            );
            //print_r($insert_array);exit;
            $insert = $this->Crud->commonInsert('ga_main_prod_details_tbl', $insert_array);
            $i++;
        }
        echo $i . " Product imported Successfully";
    }
    public function ordinal($number)
    {
        $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
        if ((($number % 100) >= 11) && (($number % 100) <= 13))
            return $number . 'th';
        else
            return $number . $ends[$number % 10];
    }
}
