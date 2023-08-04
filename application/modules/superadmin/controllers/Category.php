<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Category extends CI_Controller
{
    public $data;
    public $admin_id;
    public function __construct()
    {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if ((!isset($this->admin_id) || $this->admin_id != true)) {
            redirect(base_url() . 'superadmin/login');
        }
        $this->load->model('Super_model');
        $this->ipaddress = $_SERVER['REMOTE_ADDR'];
        $this->date = date('Y-m-d H:i:s');
        $this->admin_id = $this->session->userdata('admin_id');
    }


    public function createCategory()
    {

        $this->form_validation->set_rules('menu_title', 'Your Menu Title', 'required|trim|is_unique[menu_tbl.menu_title]|min_length[3]', array('is_unique' => 'Already exists try other'));
        if ($this->form_validation->run() == false) {

            $this->load->view('categories/create_category');
        } else {
            $menu_bb = $_FILES['image']['name'];

            $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
            $extension = $this->getFileExtensions($_FILES['image']['name']);
            $upload_picture = '';
            if (!empty($menu_bb)) {
                if (in_array($extension, $imageextension)) {
                    $upload_pic = sha1(time() . rand(00000000, 999999999));
                    $filename = stripslashes($_FILES['image']['name']);
                    $upload_file = $_FILES['image']['tmp_name'];
                    $imagesize = $_FILES['image']['size'];
                    $upload_picture = $upload_pic . '.' . $extension;
                    $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                    $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/menu/" . $upload_picture;
                    $filename = $this->compress_image($upload_file, $url, 30);
                }
            }

            $ins_data = array(
                'menu_title' => ucwords($this->input->post('menu_title')),
                'offer_price' => $this->input->post('offer_price'),
                'created_ipaddress' => $this->ipaddress,
                'flag_status' => 1,
                'image' => $upload_picture,
                'created_date' => DATE
            );

            $responce = $this->Super_model->addmenu('menu_tbl', $ins_data);
            if ($responce) {
                $latinsert_id = array('menu_id' => $this->db->insert_id());
                $myStr = trim($this->input->post('menu_title'));
                $menu_name = substr($myStr, 0, 3) . $this->db->insert_id();
                $up = array('menu_code' => $menu_name);
                $menu_code_up = $this->Super_model->updateMenuCode('menu_tbl', $up, $latinsert_id);
                if ($menu_code_up == true) {
                    $this->session->set_flashdata('Success', 'Category inserted Successfully..');
                } else {
                    $this->session->set_flashdata('Failed', 'Something went wrong, please try again');
                    $this->Crud->commonDelete('menu_tbl', ['menu_id' => $latinsert_id]);
                }
            } else {
                $this->session->set_flashdata('Failed', 'Something went wrong, please try again');
            }
            redirect('superadmin/Category/createCategory');
        }
    }



    public function manageCategory()
    {

        /* page nation code starts from hear */
        $cols = 'menu_id,menu_title,image,menu_code,front_enable,flag_status,trash,offer_price';
        $search = $this->input->post('search');
        $table_name = 'menu_tbl';
        $order_by_col = 'menu_id';
        $config["base_url"] = base_url() . 'superadmin/Category/manageCategory/';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*         * Pagination code end* */
        $like_col = 'menu_title';
        $orderby = 'menu_id';
        $this->data['common_result'] = $this->Crud->common_list_paging($cols, $table_name, $like_col, $orderby, $config["per_page"], $page, $search);

        $this->load->view('categories/manage_category', $this->data);
    }


    public function get_menu()
    {
        $uid = $this->uri->segment(3);

        $this->load->model('Super_model');
        $res['result'] = $this->Super_model->get_data('menu_tbl', $uid);
        $this->load->view('categories/update_category', $res);
    }

    public function update_menu()
    {

        $menu_bb = $_FILES['image']['name'];
        //if($menu_bb!=""){
        $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
        $extension = $this->getFileExtensions($_FILES['image']['name']);
        $upload_picture = '';
        if (!empty($menu_bb)) {
            if (in_array($extension, $imageextension)) {
                $upload_pic = sha1(time() . rand(00000000, 999999999));
                $filename = stripslashes($_FILES['image']['name']);
                $upload_file = $_FILES['image']['tmp_name'];
                $imagesize = $_FILES['image']['size'];
                $upload_picture = $upload_pic . '.' . $extension;
                $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/menu/" . $upload_picture;
                $filename = $this->compress_image($upload_file, $url, 30);
            }
        }
        if (empty($upload_picture)) {
            $update_data = array('menu_title' => ucwords($this->input->post('menu_title')), 'offer_price' => $this->input->post('offer_price'));
        } else {
            $update_data = array('menu_title' => ucwords($this->input->post('menu_title')), 'image' => $upload_picture, 'offer_price' => $this->input->post('offer_price'));
        }
        // print_r($update_data);exit;
        $update_where = $this->input->post('menu_id');
        $up_in = $this->Super_model->up_data('menu_tbl', $update_data, $update_where);
        if ($up_in) {
            $this->session->set_flashdata('Success', 'Data Updated successfully!');
        } else {
            $this->session->set_flashdata('Failed', 'Data not modified');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_menu()
    {
        $uid = $this->uri->segment(4);

        $responce = $this->Super_model->menu_delete('menu_tbl', $uid);
        if ($responce) {
            $this->session->set_flashdata('Success', 'Category Deleted successfully!');
        } else {
            $this->session->set_flashdata('Failed', 'Failed to delete category');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    # create submenu 
    public function createsubCategory()
    {
        $this->form_validation->set_rules('menu_id', 'Menu Name ', 'required');
        $this->form_validation->set_rules('submenu_title', 'Subcategory Title', 'required|is_unique[submenu_tbl.submenu_title]|min_length[3]', array('is_unique' => 'Already exists try other'));
        $res['result'] = $this->Super_model->addsubmenu();

        if ($this->form_validation->run() == false) {

            $this->load->view('categories/create_sub_category', $res);
        } else {
            $submenuimage = $_FILES['image']['name'];
            //if($submenuimage!=""){
            $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
            $extension = $this->getFileExtensions($_FILES['image']['name']);
            $upload_picture = '';
            if (!empty($submenuimage)) {
                if (in_array($extension, $imageextension)) {
                    $upload_pic = sha1(time() . rand(00000000, 999999999));
                    $filename = stripslashes($_FILES['image']['name']);
                    $upload_file = $_FILES['image']['tmp_name'];
                    $imagesize = $_FILES['image']['size'];
                    $upload_picture = $upload_pic . '.' . $extension;
                    $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                    $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/submenu/" . $upload_picture;
                    $filename = $this->compress_image($upload_file, $url, 30);
                }
            }
            //}
            $iconimage = $_FILES['icon']['name'];
            //if($iconimage!=""){

            $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
            $extension = $this->getFileExtensions($_FILES['icon']['name']);
            $upload_picture1 = '';
            if (!empty($iconimage)) {
                if (in_array($extension, $imageextension)) {
                    $upload_pic = sha1(time() . rand(00000000, 999999999));
                    $filename = stripslashes($_FILES['icon']['name']);
                    $upload_file = $_FILES['icon']['tmp_name'];
                    $imagesize = $_FILES['icon']['size'];
                    $upload_picture1 = $upload_pic . '.' . $extension;
                    $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                    $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/submenu/" . $upload_picture1;
                    $filename = $this->compress_image($upload_file, $url, 30);
                    //}
                }
            }
            /*             * *compression code** */

            $ins_sub = array(
                'menu_id' => $this->input->post('menu_id'),
                'submenu_title' => ucwords($this->input->post('submenu_title')),
                'submenu_banner' => $upload_picture,
                'submenu_app_icon' => $upload_picture1,
                'created_ipaddress' => $this->ipaddress,
                'flag_status' => 1,
                'created_date' => DATE,
                'offer_price' => $this->input->post('offer_price')
            );
            $ins_sume = $this->Super_model->ins_submenu('submenu_tbl', $ins_sub);
            if ($ins_sume) {
                $this->session->set_flashdata('Success', 'Sub Category inserted Successfully..');
            } else {
                $this->session->set_flashdata('Failed', 'Something went wrong, please try again');
            }
            redirect('superadmin/Category/createsubCategory');
        }
    }

    public function managesubCategory()
    {
        $this->data['menu_result'] = $this->Super_model->commonGetAll('menu_tbl');
        $cols = 'menu_id,submenu_id,submenu_title,submenu_code,submenu_banner,submenu_app_icon,created_date,created_ipaddress,flag_status,priority,offer_price';
        $search =  $this->input->post('search');
        $category =  $this->input->post('category');
        if ($category != '') {
            $search = $this->input->post('category');
        }
        $table_name = 'submenu_tbl';
        $order_by_col = 'submenu_id';

        $config["base_url"] = base_url() . 'superadmin/Category/managesubCategory/';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*         * Pagination code end* */
        $like_col = 'submenu_title';
        if ($category != '') {
            $like_col = 'menu_id';
        }
        $orderby = 'submenu_id';
        $this->data['category'] = $this->Super_model->getCategories();
        $this->data['common_result'] = $this->Super_model->get_records($cols, $table_name, $like_col, $orderby, $config["per_page"], $page, $search);

        $this->load->view('categories/manage_sub_category', $this->data);
    }

    public function delete_sub_menu()
    {
        $uid = $this->uri->segment(3);

        $responce = $this->Super_model->submenu_delete('submenu_tbl', $uid);
        if ($responce) {
            $this->session->set_flashdata('Success', 'Sub Category Deleted successfully!');
        } else {
            $this->session->set_flashdata('Failed', 'Failed to delete Sub Category');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function get_sub_menu()
    {
        $uid = $this->uri->segment(4);
        $where = array('submenu_id' => $uid);
        $res['rlt'] = $this->Super_model->get_subdata('submenu_tbl', $where);
        $res['result'] = $this->Super_model->getmenu_data();
        $this->load->view('categories/update_sub_category', $res);
    }

    public function updatesubCategory()
    {
        $submenuimage = $_FILES['image']['name'];
        //if($submenuimage!=""){
        $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
        $extension = $this->getFileExtensions($_FILES['image']['name']);
        $upload_picture = '';
        if (!empty($submenuimage)) {
            if (in_array($extension, $imageextension)) {
                $upload_pic = sha1(time() . rand(00000000, 999999999));
                $filename = stripslashes($_FILES['image']['name']);
                $upload_file = $_FILES['image']['tmp_name'];
                $imagesize = $_FILES['image']['size'];
                $upload_picture = $upload_pic . '.' . $extension;
                $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/submenu/" . $upload_picture;
                $filename = $this->compress_image($upload_file, $url, 30);
            }
        }
        //}
        $iconimage = $_FILES['icon']['name'];
        //if($iconimage!=""){
        $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
        $extension = $this->getFileExtensions($_FILES['icon']['name']);
        $upload_picture1 = '';
        if (!empty($iconimage)) {
            if (in_array($extension, $imageextension)) {
                $upload_pic = sha1(time() . rand(00000000, 999999999));
                $filename = stripslashes($_FILES['icon']['name']);
                $upload_file = $_FILES['icon']['tmp_name'];
                $imagesize = $_FILES['icon']['size'];
                $upload_picture1 = $upload_pic . '.' . $extension;
                $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/submenu/" . $upload_picture1;
                $filename = $this->compress_image($upload_file, $url, 30);
                //}
            }
        }
        $update_where = $this->input->post('sub_id');
        if (empty($upload_picture)) {
            $upload_picture = $this->input->post('old_banner');
        }
        if (empty($upload_picture1)) {
            $upload_picture1 = $this->input->post('old_app_icon');
        }
        $this->form_validation->set_rules('menu_id', ' Choose Menu', 'required');
        $data_submenu = array(
            'menu_id' => $this->input->post('menu_id'),
            'submenu_title' => ucwords($this->input->post('submenu_title')),
            'submenu_banner' => $upload_picture,
            'submenu_app_icon' => $upload_picture1,
            'offer_price' => $this->input->post('offer_price')
        );


        $up_ins = $this->Super_model->up_subdata('submenu_tbl', $data_submenu, $update_where);
        if ($up_ins) {
            $this->session->set_flashdata('Success', 'Data Updated successfully!');
        } else {
            $this->session->set_flashdata('Failed', 'Data not modified');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    # sublist menu starts hear

    public function createlistsubCategory()
    {
        $this->form_validation->set_rules('submenu_id', ' Choose Submenu  ', 'required');
        $this->form_validation->set_rules('listsubmenu_title', ' List Sub Menu Title', 'required|is_unique[listsubmenu_tbl.listsubmenu_title]|min_length[3]|trim', array('is_unique' => 'Already exists try other'));
        /* geting data form db */
        $data['menu_result'] = $this->Super_model->get_catdata('menu_tbl');

        $data['submenu_result'] = $this->Super_model->get_catdata('submenu_tbl');

        if ($this->form_validation->run() == false) {
            $this->load->view('categories/create_subsub_category', $data);
        } else {
            $sublistmenu = $_FILES['image']['name'];
            //if($sublistmenu!=""){
            $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
            $extension = $this->getFileExtensions($_FILES['image']['name']);
            $upload_picture = '';
            if (!empty($sublistmenu)) {
                if (in_array($extension, $imageextension)) {
                    $upload_pic = sha1(time() . rand(00000000, 999999999));
                    $filename = stripslashes($_FILES['image']['name']);
                    $upload_file = $_FILES['image']['tmp_name'];
                    $imagesize = $_FILES['image']['size'];
                    $upload_picture = $upload_pic . '.' . $extension;
                    $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                    $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/listsubmenu/" . $upload_picture;
                    $filename = $this->compress_image($upload_file, $url, 30);
                }
            }
            //}
            $iconimage = $_FILES['icon']['name'];
            //if($iconimage!=""){
            $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
            $extension = $this->getFileExtensions($_FILES['icon']['name']);
            $upload_picture1 = '';
            if (!empty($iconimage)) {
                if (in_array($extension, $imageextension)) {
                    $upload_pic = sha1(time() . rand(00000000, 999999999));
                    $filename = stripslashes($_FILES['icon']['name']);
                    $upload_file = $_FILES['icon']['tmp_name'];
                    $imagesize = $_FILES['icon']['size'];
                    $upload_picture1 = $upload_pic . '.' . $extension;
                    $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                    $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/listsubmenu/" . $upload_picture1;
                    $filename = $this->compress_image($upload_file, $url, 30);
                    //}
                }
            }
            /*             * *compression code** */


            $ins_listsub = array(
                'submenu_id' => $this->input->post('submenu_id'),
                'menu_id' => $this->input->post('menu_id'),
                'listsubmenu_title' => ucwords($this->input->post('listsubmenu_title')),
                'listsubmenu_banner' => $upload_picture,
                'listsubmenu_app_icon' => $upload_picture1,
                'created_ipaddress' => $this->ipaddress,
                'flag_status' => 1,
                'created_date' => DATE,
                'offer_price' => $this->input->post('offer_price')
            );

            $ins_listsubme = $this->Super_model->ins_listsubmenu('listsubmenu_tbl', $ins_listsub);
            if ($ins_listsubme) {
                $this->session->set_flashdata('Success', 'Sub-Sub Category inserted Successfully..');
            } else {
                $this->session->set_flashdata('Failed', 'Something went wrong, please try again');
            }
            redirect('superadmin/Category/createlistsubCategory');
        }
    }

    public function managelistsubCategory()
    {
        $this->data['category'] = $this->Super_model->getCategories();
        $this->data['submenu_result'] = $this->Super_model->commonGetAll('submenu_tbl');
        $cols = 'listsubmenu_id,menu_id,submenu_id,listsubmenu_title,listsubmenu_banner,listsubmenu_app_icon,created_date,created_ipaddress,flag_status,priority,offer_price';
        $search =  $this->input->post('search');
        $category =  $this->input->post('category');
        if ($category != '') {
            $search = $this->input->post('category');
        }
        $table_name = 'listsubmenu_tbl';
        $order_by_col = 'listsubmenu_id';

        $config["base_url"] = base_url() . 'superadmin/Category/managelistsubCategory/';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*         * Pagination code end* */
        $like_col = 'listsubmenu_title';
        if ($category != '') $like_col = 'menu_id';
        $orderby = 'listsubmenu_id';
        $this->data['common_result'] = $this->Super_model->get_records($cols, $table_name, $like_col, $orderby, $config["per_page"], $page, $search);
        $this->load->view('categories/manage_subsub_category', $this->data);
    }


    public function delete_listsubmenu()
    {
        $uid = $this->uri->segment(3);

        $responce = $this->Super_model->listsubmenu_delete('listsubmenu_tbl', $uid);
        if ($responce) {
            $this->session->set_flashdata('Success', 'Sub-sub Category Deleted successfully!');
        } else {
            $this->session->set_flashdata('Failed', 'Failed to delete Sub-sub Category');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    /* update code goes hear */

    public function get_listsubCategory()
    {
        $uid = $this->uri->segment(4);

        $where1 = array('listsubmenu_id' => $uid);
        $data['menu_result'] = $this->Super_model->getdatasub('menu_tbl');

        $where = array('listsubmenu_id' => $uid);
        $data['rlt'] = $this->Super_model->get_subdata('listsubmenu_tbl', $where);
        $data['result'] = $this->Super_model->getdatasub('submenu_tbl');

        $this->load->view('categories/update_subsub_category', $data);
    }

    public function updatesublistCategory()
    {

        $sublistmenu = $_FILES['image']['name'];
        //if($sublistmenu!=""){
        $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
        $extension = $this->getFileExtensions($_FILES['image']['name']);
        $upload_picture = '';
        if (!empty($sublistmenu)) {
            if (in_array($extension, $imageextension)) {
                $upload_pic = sha1(time() . rand(00000000, 999999999));
                $filename = stripslashes($_FILES['image']['name']);
                $upload_file = $_FILES['image']['tmp_name'];
                $imagesize = $_FILES['image']['size'];
                $upload_picture = $upload_pic . '.' . $extension;
                $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/listsubmenu/" . $upload_picture;
                $filename = $this->compress_image($upload_file, $url, 30);
            }
        }
        //}
        $iconimage = $_FILES['icon']['name'];
        //if($iconimage!=""){
        $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
        $extension = $this->getFileExtensions($_FILES['icon']['name']);
        $upload_picture1 = '';
        if (!empty($iconimage)) {
            if (in_array($extension, $imageextension)) {
                $upload_pic = sha1(time() . rand(00000000, 999999999));
                $filename = stripslashes($_FILES['icon']['name']);
                $upload_file = $_FILES['icon']['tmp_name'];
                $imagesize = $_FILES['icon']['size'];
                $upload_picture1 = $upload_pic . '.' . $extension;
                $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/listsubmenu/" . $upload_picture1;
                $filename = $this->compress_image($upload_file, $url, 30);
                //}
            }
        }
        /*             * *compression code** */


        $update_where = $this->input->post('listsubmenu_id');

        if (empty($upload_picture)) {
            $upload_picture = $this->input->post('old_banner');
        }
        if (empty($upload_picture1)) {
            $upload_picture1 = $this->input->post('old_app_ico');
        }
        $data_listsubmenu = array(
            'menu_id' => $this->input->post('menu_id'),
            'submenu_id' => $this->input->post('submenu_id'),
            'listsubmenu_title' => ucwords($this->input->post('listsubmenu_title')),
            'listsubmenu_banner' => $upload_picture,
            'listsubmenu_app_icon' => $upload_picture1,
            'offer_price' => $this->input->post('offer_price')
        );
        $up_ins = $this->Super_model->up_listsubdata('listsubmenu_tbl', $data_listsubmenu, $update_where);
        if ($up_ins) {
            $this->session->set_flashdata('Success', 'Data Updated successfully!');
        } else {
            $this->session->set_flashdata('Failed', 'Data not modified');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    #slider code goes hear 
    public function createslider()
    {
        $this->form_validation->set_rules('slider_title', ' Enter Slider Title', 'required', array('required' => 'Please Enter Slider Title'));
        $this->form_validation->set_rules('slider_url', ' Enter Slider URL', 'required', array('required' => 'Please Enter Slider Url'));

        if ($this->form_validation->run() == false) {
            $this->load->view('sliders/create_slider');
        } else {


            $sublistmenu = $_FILES['image']['name'];
            if ($sublistmenu != "") {
                $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
                $extension = $this->getFileExtensions($_FILES['image']['name']);
                if (!empty($sublistmenu)) {
                    if (in_array($extension, $imageextension)) {
                        $upload_pic = sha1(time() . rand(00000000, 999999999));
                        $filename = stripslashes($_FILES['image']['name']);
                        $upload_file = $_FILES['image']['tmp_name'];
                        $imagesize = $_FILES['image']['size'];
                        $upload_picture = $upload_pic . '.' . $extension;
                        $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                        $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/slider/" . $upload_picture;
                        $filename = $this->compress_image($upload_file, $url, 30);
                    }
                }
            } else {
                $upload_picture = '';
            }
            $iconimage = $_FILES['icon']['name'];
            if ($iconimage != "") {
                $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
                $extension = $this->getFileExtensions($_FILES['icon']['name']);
                if (!empty($iconimage)) {
                    if (in_array($extension, $imageextension)) {
                        $upload_pic = sha1(time() . rand(00000000, 999999999));
                        $filename = stripslashes($_FILES['icon']['name']);
                        $upload_file = $_FILES['icon']['tmp_name'];
                        $imagesize = $_FILES['icon']['size'];
                        $upload_picture1 = $upload_pic . '.' . $extension;
                        $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                        $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/slider/" . $upload_picture1;
                        $filename = $this->compress_image($upload_file, $url, 30);
                    }
                }
            } else {
                $upload_picture1 = '';
            }
            /*             * *compression code** */

            $data = array(
                'slider_title' => $this->input->post('slider_title'),
                'slider_url' => $this->input->post('slider_url'),
                'slider_image' => $upload_picture,
                'slider_app_image' => $upload_picture1,
                'created_date' => DATE,
                'flag_status' => 1,
                'created_ipaddress' => $this->ipaddress
            );
            $ins_slider = $this->Super_model->ins_slider('slider_tbl', $data);
            if ($ins_slider) {
                $this->session->set_flashdata('Success', 'Data inserted Successfully..');
            } else {
                $this->session->set_flashdata('Failed', 'Something went wrong, please try again');
            }
            redirect('superadmin/Category/createslider');
        }
    }

    public function manageslider()
    {
        $this->data['result'] = $this->Super_model->getlistsubmenu();

        $this->data['result']  = $this->Super_model->get_slider();
        $cols = 'id,slider_title,slider_url,slider_image,slider_app_image,slider_description,slider_priority,flag_status,created_date,created_ipaddress';
        $search =  $this->input->post('search');
        $table_name = 'slider_tbl';
        $order_by_col = 'id';
        $config["base_url"] = base_url() . 'superadmin/Category/manageslider/';
        $config["total_rows"] = $this->Crud->common_record_count($cols, $table_name, $order_by_col);
        $config["per_page"] = PER_PAGE;
        $config["uri_segment"] = 4;
        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*         * Pagination code end* */
        $like_col = 'slider_title';
        $orderby = 'id';
        $this->data['common_result'] = $this->Super_model->get_records($cols, $table_name, $like_col, $orderby, $config["per_page"], $page, $search);
        // print_r($this->data['common_result']);exit;

        $this->load->view('sliders/manage_slider', $this->data);
    }

    public function delete_slider()
    {
        $uid = $this->uri->segment(4);
        $del_slider = $this->Super_model->slider_delete('slider_tbl', $uid);
        if ($del_slider) {
            $res['result'] = $this->Super_model->get_slider();

            $this->load->view('manage_slider', $res);
            echo "<script> </script>";
            redirect('superadmin/Category/manageslider');
        }
    }
    /* update code goes hear for slider */
    public function getsliderdata()
    {
        $uid = $this->uri->segment(4);


        $where = array('id' => $uid);
        $data['result'] = $this->Super_model->get_subdata('slider_tbl', $where);
        $this->load->view('sliders/update_slider', $data);
    }
    public function updateSlider()
    {

        $submenuimage = $_FILES['image']['name'];
        //if($submenuimage!=""){
        $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
        $extension = $this->getFileExtensions($_FILES['image']['name']);
        $upload_picture = '';
        if (!empty($submenuimage)) {
            if (in_array($extension, $imageextension)) {
                $upload_pic = sha1(time() . rand(00000000, 999999999));
                $filename = stripslashes($_FILES['image']['name']);
                $upload_file = $_FILES['image']['tmp_name'];
                $imagesize = $_FILES['image']['size'];
                $upload_picture = $upload_pic . '.' . $extension;
                $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/slider/" . $upload_picture;
                $filename = $this->compress_image($upload_file, $url, 30);
            }
        }
        //}
        $iconimage = $_FILES['icon']['name'];
        //if($iconimage!=""){

        $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
        $extension = $this->getFileExtensions($_FILES['icon']['name']);
        $upload_picture1 = '';
        if (!empty($iconimage)) {
            if (in_array($extension, $imageextension)) {
                $upload_pic = sha1(time() . rand(00000000, 999999999));
                $filename = stripslashes($_FILES['icon']['name']);
                $upload_file = $_FILES['icon']['tmp_name'];
                $imagesize = $_FILES['icon']['size'];
                $upload_picture1 = $upload_pic . '.' . $extension;
                $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
                $url = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectpath . "/uploads/slider/" . $upload_picture1;
                $filename = $this->compress_image($upload_file, $url, 30);
                //}
            }
        }
        /*             * *compression code** */




        $update_where = $this->input->post('slider_id');
        if (empty($upload_picture)) {
            $upload_picture = $this->input->post('old_image');
        }
        if (empty($upload_picture1)) {
            $upload_picture1 = $this->input->post('old_app_icon');
        }
        $data_listsubmenu = array(
            'slider_title' => $this->input->post('slider_title'),
            'slider_url' => $this->input->post('slider_url'),
            'slider_image' => $upload_picture,
            'slider_app_image' => $upload_picture1
        );
        $up_ins = $this->Super_model->update_slider('slider_tbl', $data_listsubmenu, $update_where);
        if ($up_ins) {
            $this->session->set_flashdata('Success', 'Data Updated successfully!');
        } else {
            $this->session->set_flashdata('Failed', 'Data not modified');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }







    #image code for starts hear 
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
            $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/JPG')
            $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/PNG')
            $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/GIF')
            $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/JPEG')
            $image = imagecreatefrompng($source_url);

        imagejpeg($image, $destination_url, $quality);
        return $destination_url;
    }




    public function createproduct()
    {
        $this->data['menu_result'] = $this->Super_model->getMenuList();
        $this->load->view('create_product', $this->data);
    }

    public function manageproducts()
    {
        $this->data['prod_result'] = $this->Super_model->getProductDetails();
        $this->load->view('manage_products', $this->data);
    }

    public function orders()
    {
        $this->load->view('manage_orders');
    }

    public function orderdetails()
    {
        $this->load->view('view_orders');
    }

    public function commonStatusActivity()
    {
        //echo "test";exit;
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
                case 'faqs':
                    $table = 'faq_tbl';
                    $setcolumns = 'reply_status';
                    $updatevalue = $activity;
                    $wherecondition = "faq_id  IN  (" . $updatelist . ")";
            }
            $update = $this->Super_model->commonStatusActivity($table, $setcolumns, $updatevalue, $wherecondition);
            echo $update;
            exit;
        }
        echo json_encode($response);
    }


    /* code for getting submneu list based on menu starts here */

    public function submenuWithMenu()
    {
        $submenu_data = '<option value="0">------- Choose Sub Category ------- </option>';
        $menu_id = $this->input->post('menu');
        if (num_check($menu_id)) {
            $submenu_qry = $this->Super_model->subMenu(array('menu_id' => $menu_id));
            $request = json_decode($submenu_qry);
            if ($request->code == SUCCESS_CODE) {
                foreach ($request->submenu_result as $response) {
                    $submenu_data .= '<option value="' . $response->id . '">' . $response->title . '</option>';
                }
            } else {
                $submenu_data .= '<option value="0">No results found</option>';
            }
        } else {
            $submenu_data .= '<option value="0">No results found</option>';
        }
        echo $submenu_data;
    }

    /* code for getting submneu list based on menu ends here */

    /* code for getting submenu list based on submenu starts here */

    public function listSubMenuWithMenu()
    {
        $data = '<option value="0">List Sub Menu</option>';
        $submenu_id = $this->input->post('submenu');
        if (num_check($submenu_id)) {
            $listsubmenu_qry = $this->Super_model->listSubMenu(array('submenu_id' => $submenu_id));
            $request = json_decode($listsubmenu_qry);
            if ($request->code == SUCCESS_CODE) {
                foreach ($request->listsubmenu_result as $response) {
                    $data .= '<option value="' . $response->id . '">' . $response->title . '</option>';
                }
            } else {
                $data .= '<option value="">No results found</option>';
            }
        } else {
            $data .= '<option value="">No results found</option>';
        }
        echo $data;
    }

    /* code for getting submenu list based on submenu endsf here */

    public function insertProduct()
    {
        # validations hear
        $response = array();
        $menu = $this->input->post('menu_id');
        $submenu = $this->input->post('submenu_id');
        $listsubmenu = $this->input->post('listsubmenu');
        $prodcode = $this->input->post('product_code');
        $prodtitle = $this->input->post('product_title');
        $prod_desc = $this->input->post('product_description');
        $sku_qty = $this->input->post('sku_qty');
        $ordqtyfrom = $this->input->post('qty_from');
        $ordqtyto = $this->input->post('qty_to');
        $proddisfromdate = $this->input->post('prod_from_date');
        $proddistodate = $this->input->post('prod_to_date');
        $prodmrp = $this->input->post('mrp');
        $prodsp = $this->input->post('selling_price');
        $stock = $this->input->post('stock');
        $moq = $this->input->post('moq');
        $truckloadqty = $this->input->post('truckqty');
        $seller = $this->input->post('seller');
        $dpdesc = $this->input->post('description');
        $image = $_FILES['image']['name'];
        $imageextension = array("jpg", "JPG", "GIF", "PCO", "PNG", "png", "gif", "jPEG", "jpeg");
        if (
            $image != '' && $menu != '' && $submenu != '' && $listsubmenu != '' && $prodcode != '' && $prodtitle != '' &&
            $prod_desc != '' && $sku_qty != '' && $ordqtyfrom != '' && $ordqtyto != '' &&
            $proddisfromdate != '' && $proddistodate != '' && $prodmrp != '' && $prodsp != '' &&
            $stock != '' && $moq != '' && $truckloadqty != '' && $seller != '' && $dpdesc != ''
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
                $insert_array = array(
                    'listsubmenu_id' => $listsubmenu,
                    'prod_code' => $prodcode,
                    'prod_title' => $prodtitle,
                    'prod_desc' => $prod_desc,
                    'prod_skuqty' => $sku_qty,
                    'total_order_qty_from' => $ordqtyfrom,
                    'total_order_qty_to' => $ordqtyto,
                    'mrp' => $prodmrp,
                    'sellingprice' => $prodsp,
                    'stock' => $stock,
                    'moq' => $moq,
                    'truckloadqty' => $truckloadqty,
                    'image' => $upload_picture,
                    'vendor' => $seller,
                    'distributiondesc' => $dpdesc,
                    'createdon' => DATE,
                );

                $insert = $this->Crud->commonInsert('product_tbl', $insert_array, 'Product Added Successfully');
                $insert_res = json_decode($insert);
                if ($insert_res->code == SUCCESS_CODE) {
                    $last_inserted_prod_id = $insert_res->inserted_id;
                    if (num_check($last_inserted_prod_id)) {
                        $insert = array(
                            'prod_id' => $last_inserted_prod_id,
                            'prod_avail_from_date' => date('Y-m-d H:i:s', strtotime($proddisfromdate)),
                            'prod_avail_to_date' => date('Y-m-d H:i:s', strtotime($proddistodate)),
                            'createdon' => $this->date,
                        );
                        $prod_params = array(
                            'table_name' => 'prod_display_timing_tbl',
                            'insert_data' => $insert,
                            'success_message' => 'Product Added Successfully',
                            'error_message' => '',
                            'debug' => 0
                        );
                        $insert_details = $this->Crud->common_insert($prod_params);
                        $response[CODE] = SUCCESS_CODE;
                        $response[MESSAGE] = 'success';
                        $response[DESCRIPTION] = 'Product added successfully';
                        echo json_encode($response);
                    } else {
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Something error occured';
                        $response[DESCRIPTION] = 'Something error occured';
                    }
                }
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

    public function prodDelete()
    {

        $id = $this->uri->segment(4);
        $conditionarray = array('prod_id' => $id);
        $delete_row = $this->Super_model->common_delete('product_tbl', $conditionarray);
        $res = json_decode($delete_row);
        //print_r($res->code);exit;
        if ($res->code == 200) {
            $this->session->set_flashdata('Success', 'Record deleted successfully');
            redirect('superadmin/Category/manageproducts');
        } else {
            $this->session->set_flashdata('Failed', $res->description);
            redirect('superadmin/Category/manageproducts');
        }
    }
    public function getProducts()
    {
        $id = $this->uri->segment(4);
        $data['menu_result'] = $this->Super_model->getdatasub('menu_tbl');
        $this->load->view('update_product', $data);
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
                case 'submenu':   // need to refer name for table name
                    $table = 'submenu_tbl';   // table name 
                    $setcolumns = 'flag_status';
                    $updatevalue = $activity;
                    $wherecondition = "submenu_id  IN  (" . $updatelist . ")";
                    break;
                case 'slider':   // need to refer name for table name
                    $table = 'slider_tbl';   // table name 
                    $setcolumns = 'flag_status';
                    $updatevalue = $activity;
                    $wherecondition = "id  IN  (" . $updatelist . ")";
                    break;
                case 'listsubmenu':   // need to refer name for table name
                    $table = 'listsubmenu_tbl';   // table name 
                    $setcolumns = 'flag_status';
                    $updatevalue = $activity;
                    $wherecondition = "listsubmenu_id  IN  (" . $updatelist . ")";
                    break;
                case 'product':   // need to refer name for table name
                    $table = 'ga_main_prod_details_tbl';   // table name 
                    $setcolumns = 'active_status';
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
                case 'slider':
                    $table = 'slider_tbl';
                    $wherecondition = "id IN  (" . $updatelist . ")";
                    break;
                case 'listsubmenu':
                    $table = 'listsubmenu_tbl';
                    $wherecondition = "listsubmenu_id IN  (" . $updatelist . ")";
                    break;
                case 'submenu':
                    $table = 'submenu_tbl';
                    $wherecondition = "submenu_id IN  (" . $updatelist . ")";
                    break;
                case 'menu':
                    $table = 'menu_tbl';
                    $wherecondition = "menu_id IN  (" . $updatelist . ")";
                    break;
                case 'product':
                    $table = 'ga_main_prod_details_tbl';
                    $wherecondition = "id IN  (" . $updatelist . ")";
                    break;
                case 'faq':
                    $table = 'faq_tbl';
                    $wherecondition = "faq_id IN  (" . $updatelist . ")";
                    break;
            }
            //print_r($wherecondition);
            $update = $this->Crud->commonDelete($table, $wherecondition, $relationname);
            echo $update;
            exit;
        }
        echo json_encode($response);
    }
}
