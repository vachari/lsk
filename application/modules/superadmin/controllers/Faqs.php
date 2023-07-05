<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends CI_Controller {
	public $data;
	public function __construct(){
		parent::__construct();
		$this->admin_id=$this->session->userdata('admin_id');
        if((!isset($this->admin_id) || $this->admin_id != true) )
            {
                redirect(base_url().'superadmin/login');
            } 
		$this->data=array();
		$this->faq_view_path='faq/';
		$this->load->model('Super_model');


	}

	public function index()
	{
		
			$this->data['URL_TITLE']='FAQ List';
			$this->data['PAGE_TITLE']='FAQ List';
			$breadcrumb_array = array(
	            array('title' => 'FAQ List', 'link' => 'javascript:void(0);', 'class' => 'active'),
	            array('title' => 'Create FAQ', 'link' => SUPER_ADMIN_FOLDER_PATH.'Faqs/createFaq', 'class' => ''),
	        );
	        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
		    $search=$this->input->post('search');
		    /**Pagination code starts**/
		    $cols='faq_id as id,faq_ref_no as ref_no,query as query,description as description,created_date as qry_date,reply_status as status,faq_option as faq_option';
		    $table_name='faq_tbl';
		    $order_by_col='faq_id';
		    $config["base_url"] = SUPER_ADMIN_FOLDER_PATH.'Faqs/index';
			$config["total_rows"] = $this->Crud->common_record_count($cols,$table_name,$order_by_col);
			$config["per_page"] = PER_PAGE;
			$config["uri_segment"] = 4;
			$this->load->library('pagination',$config);
			$page = ($this->uri->segment(4)) ?  $this->uri->segment(4) : 0;
			$this->data["links"] = $this->pagination->create_links();
	        /**Pagination code end**/
	        $like_col='query';
	        $orderby='faq_id';
	         $this->data['common_result']=$this->Crud->common_list_paging($cols,$table_name,$like_col,$orderby,$config["per_page"],$page,$search);
	        $this->load->view($this->faq_view_path.'faq_list_view',$this->data);
	    	
	}

	public function createFaq()
	{
			$this->data['URL_TITLE']='Create FAQ';
			$this->data['PAGE_TITLE']='Create FAQ';
			$breadcrumb_array = array(
	            array('title' => 'FAQ List', 'link' => SUPER_ADMIN_FOLDER_PATH.'Faqs', 'class' => ''),
	            array('title' => 'Create FAQ', 'link' => 'javascript:void(0);', 'class' => 'active'),
	        );
	        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
	       	$this->load->view($this->faq_view_path.'create_faq_view',$this->data);		
	}

	public function insertFaq()
	{
	    $this->form_validation->set_rules('faq_select','Faq select','required|trim|numeric',array('required'=>'Please enter select box'));
		$this->form_validation->set_rules('question','Question','required|regex_match[/^[a-zA-Z ]*$/]',array('required'=>'Please enter question!','regex_match'=>'Please enter valid question!'));
		$this->form_validation->set_rules('description','Description','required',array('required'=>'Please enter description!'));
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if($this->form_validation->run()==false){
			$this->data['URL_TITLE']='Create FAQ';
			$this->data['PAGE_TITLE']='Create FAQ';
			$breadcrumb_array = array(
	            array('title' => 'FAQ List', 'link' => SUPER_ADMIN_FOLDER_PATH.'Faqs', 'class' => ''),
	            array('title' => 'Create FAQ', 'link' => 'javascript:void(0);', 'class' => 'active'),
	        );
	        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
	       	$this->load->view($this->faq_view_path.'create_faq_view',$this->data);
		}
		else{
			$data=array(
				'faq_ref_no'=>'FAQ'.date('dmy').rand(2,99),
				'query'=>trim($this->input->post('question')),
				'description'=>strtolower(trim($this->input->post('description'))),
				'created_date'=>date('Y-m-d H:i:s'),
				'faq_option'=>trim($this->input->post('faq_select')),
				'reply_status'=>0,
				);
			$faq_data=array(
					'table_name'=>'faq_tbl',
					'insert_data'=>$data,
					'success_message'=>$data['query']. ' added successfully',
					'error_message'=>'Unable to add '.$data['query'],
					'debug'=>0,
					);
			$faq_data=$this->Crud->common_insert($faq_data);
			$faq=json_decode($faq_data);
			//print_r($faq);exit;
			if($faq->code==200){
					$this->session->set_flashdata('success',$faq->description);
					redirect(SUPER_ADMIN_FOLDER_PATH.'Faqs/');
				}
				else{
					$this->session->set_flashdata('failure',$faq->description);
					$this->data['URL_TITLE']='Create FAQ';
					$this->data['PAGE_TITLE']='Create FAQ';
					$breadcrumb_array = array(
				            array('title' => 'FAQ List', 'link' => SUPER_ADMIN_FOLDER_PATH.'Faqs', 'class' => ''),
				            array('title' => 'Create FAQ', 'link' => 'javascript:void(0);', 'class' => 'active'),
				        );
			    	$this->data['breadcrumb'] = json_encode($breadcrumb_array);
					$this->load->view($this->faq_view_path.'faq_list_view',$this->data);
				}
		}
	}

	public function help(){

			$this->data['URL_TITLE']='Help List';
			$this->data['PAGE_TITLE']='Help List';
			$breadcrumb_array = array(
	            array('title' => 'Help List', 'link' => 'javascript:void(0);', 'class' => 'active'),
	            array('title' => 'Create Help', 'link' => SUPER_ADMIN_FOLDER_PATH.'Faqs/createFaq', 'class' => ''),
	        );
	        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
		    $search=$this->input->post('search_name');
		    /**Pagination code starts**/
		    $cols='id,name,email,mobile,,message,user_id,created_on,active_status,trash';
		    $table_name='ga_help_tbl';
		    $order_by_col='	id';
		    $config["base_url"] = SUPER_ADMIN_FOLDER_PATH.'Faqs/help';
			$config["total_rows"] = $this->Crud->common_record_count($cols,$table_name,$order_by_col);
			$config["per_page"] = PER_PAGE;
			$config["uri_segment"] = 4;
			$this->load->library('pagination',$config);
			$page = ($this->uri->segment(4)) ?  $this->uri->segment(4) : 0;
			$this->data["links"] = $this->pagination->create_links();
	        /**Pagination code end**/
	        $like_col='subject';
	        $orderby='id';
	         $this->data['common_result']=$this->Crud->common_list_paging($cols,$table_name,$like_col,$orderby,$config["per_page"],$page,$search);
	         $this->data['users_data']=$this->Super_model->commonGetAll('ga_users_tbl');
	         $this->load->view($this->faq_view_path.'help_list_view',$this->data);

		//$this->load->view($this->faq_view_path.'help_list_view',$this->data);
	}


}

?>