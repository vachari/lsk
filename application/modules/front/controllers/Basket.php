<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Basket extends CI_Controller
{

  public $user_id;
  public $cart_session_id;
  public function __construct()
  {
    parent::__construct();
    $this->vendor_id = $this->session->userdata('vendor_id');
    if (!empty($this->vendor_id)) {
      redirect(base_url() . 'vendor/dashboard');
    }
    $this->basket_session_id = $this->session->userdata('basket_session_id');
    if (empty($this->basket_session_id)) {
      $this->basket_session_id = time() . rand(00, 99999) . session_id();
      $this->session->set_userdata('basket_session_id', $this->basket_session_id);
    }

    $this->cart_session_id = $this->session->userdata('cart_session_id');
    if (empty($this->cart_session_id)) {
      $this->cart_session_id = time() . rand(00, 99999) . session_id();
      $this->session->set_userdata('cart_session_id', $this->cart_session_id);
    }
    $this->user_id = $this->session->userdata('user_id');
    if (empty($this->user_id)) {
      redirect(base_url() . 'register');
    }
    $this->load->model(array('Basket_model' => 'basket', 'Cart_model' => 'cart', 'Checkout_model' => 'checkout'));
    #loading menus here 
    $this->data['menuList'] = $this->Common->mainMenuList();

    //getting cart data form data base  starts from here 
    $this->data['cartList'] = $this->cart->cartList($this->cart_session_id, 1);
    /*>> Loading COmmin listing model code start */
    $this->data['sharecart_result'] = $this->checkout->checkoutResult(array('cart_session' => $this->cart_session_id));
    $this->data['cartStatistics'] = $this->checkout->checkoutStatistics($this->cart_session_id);
    // $this->data['wishListData']=$this->Pages_model->commonGetAll('ga_wishlist_tbl',array('status'=>1,'trash'=>0));

    $whereconditionss = array('basket_session_id' => $this->basket_session_id);
    $this->data['basketCheckData'] = $this->Crud->commonCheck("basket_id", 'ga_basket_tbl', $whereconditionss);

    //here stop
  }


  public function addtobasket()
  {
    //echo json_encode(['description'=>$this->basket_session_id]);exit;
    //power_approved
    $response = array();
    if (!empty($this->user_id)) {
      $user_id = $this->user_id;
    } else {
      $user_id = 0;
    }
    $product_id = $this->input->post('id');
    $cart_type = $this->input->post('cartType');
    $qty = $this->input->post('qty');
    $cart_data = array(
      'prod_id' => $product_id,
      'qty' => $qty,
      'user_id' => $user_id,
      'cart_type' => $cart_type,
      'basket_session_id' => $this->basket_session_id
    );
    //echo json_encode(['description'=>$cart_type]);exit;
    $data = $this->basket->add_basket($cart_data);
  }


  public function index()
  {
    //if($this->data['basketCheckData'] == 1){
    // share cart list
    $search = array();
    $search['basket_session'] = $this->basket_session_id;
    $this->data['checkout_result'] = $this->basket->BasketResult($search);
    //print_r($this->data['checkout_result'] );exit;
    $this->load->view('myregularbasket', $this->data);
    //   }else{ redirect('/');}
  }

  public function add_all_item()
  {
    $this->form_validation->set_rules('qty[]', 'Qty', 'trim|numeric');
    $this->form_validation->set_rules('product_id[]', 'Product id', 'trim|numeric');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('failed', 'Please enter valid input');
      redirect("basket");
    } else {
      extract($_POST);
      $resp = json_decode($this->basket->get_all_item($this->basket_session_id));
      $cart_session_id = $this->cart_session_id;
      $data = array('qty' => $qty, 'product_id' => $product_id);
      //print_r($data['product_id']);exit;
      $count = count($qty);
      //echo $qty[0];exit;
      $j = 0;
      $k = 0;
      $in = array();

      for ($i = 0; $i < $count; $i++) {
        if ($qty[$i] == 0) {
          $j++;
        } else {


          $k++;
        }
      }

      if ($j == $count) {
        $this->session->set_flashdata('failed', 'Dont enter zero quantity');
        redirect("basket");
      } elseif ($k > 0) {          //check count start
        //    $l=0;
        //  for($i=0;$i<=$count;$i++){
        //   $where=array("prod_id"=>$product_id[$i]);
        //   $p_qty=$this->basket->RowWhere("qty_range_from","ga_prod_item_pricing_tbl",$where,null);
        //   $get_qty=$p_qty->qty_range_from;
        //   //echo $get_qty.'....';
        //   //echo $qty[$i];exit;
        //   if($get_qty>$qty[$i]){
        //    $l++;
        //   }else{
        //      $p_name=$product_name[$i];
        //      $this->session->set_flashdata('failed',$p_name.' is more than available quantity');
        //      redirect("basket");
        //   }
        // }
        //  if($l==$count){
        //    echo "sucess";
        //  }
        // check count end
        if ($resp->code == SUCCESS_CODE) {
          $result = $this->basket->Common_Insert($resp, $cart_session_id, $data);
          if ($result == 1) {
            $this->session->set_flashdata('success', $k . 'item added to cart!');
            redirect("basket");
          } else {
            $this->session->set_flashdata('success', '(' . $k . ') Product added to cart!');
            redirect("basket");
          }
        } else {
          echo "fail";
        }
      } else {
        $this->session->set_flashdata('failed', 'Something went wrong!');
        redirect("basket");
      }
    }
  }

  public function removebasketlist()
  {
    //echo "hi";exit;
    $id = $this->uri->segment(2);
    $condition = array('user_id' => $this->user_id, 'prod_id' => $id);

    $del_wish = $this->Crud->commonDelete('ga_basket_tbl', $condition, 'basket');
    $del_wish = json_decode($del_wish);
    if ($del_wish->code = 200) {
      $this->session->set_flashdata('success', 'Removed successfully');
      redirect('basket');
    }
  }
}
