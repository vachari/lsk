<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Payments extends CI_Controller {

		public function __construct() 
        {
        parent::__construct();
        $this->admin_id=$this->session->userdata('admin_id');
        if((!isset($this->admin_id) || $this->admin_id != true) )
            {
                redirect(base_url().'superadmin/login');
            } 
	        $this->load->model('Vendor_model');
	       $this->load->model('Super_model');
        $this->load->library("pagination");
        $this->load->library('paginate');
 
    }
    public function manage_vendor_payments(){
        $config = array();
        $search=array();
        $orders=json_decode($this->Vendor_model->get_vendor_payments($search));
        $total_rows=$orders->num_rows;
        $base_url = base_url()."superadmin/payments/manage_vendor_payments/";
        $per_page = PER_PAGE;
        $uri_segment = 4;
        $config=$this->paginate($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $this->uri->segment(4,0);
        $this->data["links"] = $this->pagination->create_links();
        $this->data["total_rows"] = $total_rows;
        $this->data['vendor_result'] = $this->Super_model->getVendorList();
        $this->data['power_users'] = $this->Vendor_model->get_power_users();
        $this->data['payments']=$this->Vendor_model->get_vendor_payments($search,$config["per_page"],$page);
         // print_r($this->data['payments']);exit;
        
     $this->load->view('vendors/manage_vendor_payments', $this->data);
    }  
    public function vendorPaymentsAjax($pageno=0){
        $response=array();
        $search=array();
        $search['search_name']=$this->input->post('search_name');
        $search['vendor']=$this->input->post('vendor');
        $search['power_user']=$this->input->post('power_user');
        $search['delivery_date']=$this->input->post('delivery_date');
        $payments= json_decode($this->Vendor_model->get_vendor_payments($search));
        $total_rows=count($payments->result);
        $base_url = base_url().'superadmin/payments/manage_vendor_payments/';
        $per_page = PER_PAGE;
        if($pageno > 0){
              $si= $per_page * ($pageno-1);
         }else{$si=0;}
        $config = $this->paginate->pagination($base_url,$total_rows,$per_page);
        $config['use_page_numbers']=TRUE;
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $payment_list = json_decode($this->Vendor_model->get_vendor_payments($search,$per_page,$si));
        $html="";
        if($payment_list->code==200){
          foreach ($payment_list->result as $ol) {
            $html .= '<tr><td><input type="checkbox" name="multiple[]" value="'.$ol->vendor_payment_id.'"></td>';
            $html .= '<td>'.$ol->order_number.'</td>';
            $html .= '<td>'.$ol->vendor_name.' ('.$ol->vendor_code.')</td>';
            $html .= '<td> Phone: '.$ol->mobile.'<br> Email: '.$ol->email.'</td>';
            $html .= '<td>'.$ol->power_user_name.'</td>';
            $html .= '<td>'.$ol->total_value_of_delivery.'</td>';
            $html .= '<td>'.$ol->collected_amount.'</td>';
            $html .= '<td>'.$ol->due_amount.'</td>';
            $html .= '<td>'.$ol->due_days.'</td>';
            if(strtotime($ol->delivery_date) > 0){
              $html .= '<td>'.date("d-M-Y ", strtotime($ol->delivery_date)).'</td>';
            }else{
              $html .= '<td></td>';  
            }
            $html .= '<td>'.$ol->city.'</td>';
            $html .= '<td>'.$ol->pincode.'</td>';
            $html .= '<td></td>';
            $html .= '</tr>';                      
          }
        }
        $response['html']=$html;
        $msg=' payments found';
        if($total_rows ==1){$msg=' payment found';}
        $response['total_rows']=($total_rows > 0)?$total_rows.$msg:'';
        $response['pagination']=$links;
  //       print_r($response);exit;
        echo json_encode($response);
        
}
    public function paginate($base_url,$total_rows,$per_page,$uri_segment){
        $config["base_url"] = $base_url;
        $config["total_rows"] = $total_rows;
        $config["per_page"] = $per_page;
        $config["uri_segment"] = $uri_segment;
        $config['full_tag_open'] = '<ul class="pagination">';        
        $config['full_tag_close'] = '</ul>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li>';        
        $config['first_tag_close'] = '</li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="prev">';        
        $config['prev_tag_close'] = '</li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li>';        
        $config['next_tag_close'] = '</li>';        
        $config['last_tag_open'] = '<li>';        
        $config['last_tag_close'] = '</li>';        
        $config['cur_tag_open'] = '<li class="active"><a href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li>';        
        $config['num_tag_close'] = '</li>';
        return $config;
  }       
                
            
}