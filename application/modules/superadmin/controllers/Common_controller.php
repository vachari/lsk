<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Common_controller extends CI_Controller {

		public $data;
	public function __construct() {
        parent::__construct();
        $this->admin_id=$this->session->userdata('admin_id');
        if((!isset($this->admin_id) || $this->admin_id != true) )
            {
                redirect(base_url().'superadmin/login');
            } 
        $this->data=array();        
       

    }
	/*code for common active and inactive starts here*/
	public function commonStatus(){
     $table = strtolower(trim($this->input->post('tablename')));
     $updateidlist = $this->input->post('upldatelist');
	$activity = $this->input->post('activity');
	if ($table != '' && $updateidlist != '' && ($activity == 0 || $activity == 1)) {
	    $tablename = '';
	    $setcolumns = '';
	    $wherecondition = '';
	    $updatevalue = '';
	    switch ($table) {
			case 'menu_list':
			$tablename = 'menu_tbl';
		    $setcolumns = 'flag_status';
		    $updatevalue = $activity;
		    $wherecondition = "menu_id IN  (" . $updateidlist . ")";
		    break;
		    case 'front_enable':
			$tablename = 'menu_tbl';
		    $setcolumns = 'front_enable';
		    $updatevalue = $activity;
		    $wherecondition = "menu_id IN  (" . $updateidlist . ")";
		    break;
			case 'item_list':
			$tablename = 'ga_prod_item_pricing_tbl';
		    $setcolumns = 'item_status';
		    $updatevalue = $activity;
		    $wherecondition = "id IN  (" . $updateidlist . ")";
		    break;
		    }
		$update=$this->Crud->commonStatusActivity($tablename,$setcolumns,$updatevalue,$wherecondition);
		echo $update;exit;
	} else {
	    $response[code] = validationcode;
	    $response[message] = 'Validations';
	    $response[description] = 'Please enter manditory feilds';
	}
	echo json_encode($response);
	/*code for common active and inactive ends here*/
	}
	public function commonDelete()
	{	
		$response = array();
		$tablename = $this->input->post('tablename');
		$updatelist = $this->input->post('updatelist');
		if ($tablename != '') {
		    $table = '';
		    $wherecondition = '';
		    switch ($tablename) {
		    case 'menu':
			    $table = 'menu_tbl';
			    $wherecondition = "menu_id IN  (" . $updatelist . ")";
			    break;
			case 'item':
			    $table = 'ga_prod_item_pricing_tbl';
			    $wherecondition = "id IN  (" . $updatelist . ")";
			    break;
			    }
		    $update = $this->Crud->commonDelete($table,$wherecondition);
		   echo $update;
		   exit;
		}
		echo json_encode($response);
    }

	}