<?php
Class Sharecart_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
     public function commonGetAll($tablename,$wherecondition) {
        $response = array();
        $this->db->where($wherecondition);
        $get_all = $this->db->get($tablename);
        $update = $this->db->affected_rows();
        if($update > 0 ){
         $response['result']=$get_all->result();
       
        }
        return json_encode($response);
    } 
    
     public function commonGetWhere($tablename,$wherecondition) {
        $response = array();
        $this->db->where($wherecondition);
        $get_row = $this->db->get($tablename);
        $update = $this->db->affected_rows();
        if($update > 0 ){
         $response['result']=$get_row->row();
       
        }
        return json_encode($response);
    } 


     public function sharecartList($cartsession)
    {
            $response=array();
            $product_folder=PRODCUCT_IMAGE_PATH;
            $where=array('c.cart_session_id'=>$cartsession,'c.cart_status'=>0,'cart_type'=>2);

            $cols="c.prod_id, c.cart_session_id,c.qty,c.shipping_charges,c.cart_status , p.prod_name,p.prod_code,p.prod_group,p.unit,p.prod_desc,p.active_status as product_status, p.prod_image, sp.id,sp.selling_price,u.unit_code as units_of_mesure,CONCAT('".$product_folder."',prod_image) as prod_image,";
            $sql=  $this->db->select($cols)->from('ga_cart_tbl c')->join('ga_main_prod_details_tbl p','p.id=c.prod_id','inner')
                    ->join('ga_prod_item_pricing_tbl sp','sp.id=c.prod_id','inner')->join('ga_prod_units_tbl u','p.unit=u.id','inner')->where($where)->order_by('c.cart_id','ASC')->get();
            $db_error=  $this->db->error();
            if($db_error['code']==0)
            {
                   $count=$sql->num_rows();
                   $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                   $response[MESSAGE]=($count > 0)?'Success':'Fail';
                   $response[DESCRIPTION]=($count > 0)?$count.' cart list found':'No items found in your cart';
                   $response['item_count']=($count > 0)?$count:'No items found in your cart';
                   $response['cart_result']=($count > 0)?$sql->result():array();
            }
            else
            {
                $response[CODE]=DB_ERROR_CODE;
                $response[MESSAGE]='Db error';
                $response[DESCRIPTION]=(QUERY_DEBUG==1)?$db_error['message']:'Something error occured';
            }
          //  echo $this->db->last_query();
           // print_r($response['cart_result']);
            return  json_encode($response);
    }

   
}

?>