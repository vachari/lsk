<?php 
class Search_model extends CI_Model {
    public function get_results($search_term='default')
    {
        // Use the Active Record class for safer queries.
        $this->db->select('*');
        $this->db->from('ga_main_prod_details_tbl');
        $this->db->like('prod_name',$search_term);

        // Execute the query.
        $query = $this->db->get();
        // Return the results.
        return $query->result();
    }

    public function get_res($search_term='default'){
        
         $response = array();
        $this->db->select('mp.*,min(pi.selling_price) as selling_price,pi.unit_of_measure');    
        $this->db->from('ga_main_prod_details_tbl mp');
        $this->db->like('prod_name',$search_term);
        // $this->db->where('mp.feature_product',1);
        $this->db->join('ga_prod_item_pricing_tbl pi', 'mp.id = pi.prod_id');
        $this->db->group_by('pi.prod_id');
        $query = $this->db->get();
        $count=$query->num_rows();
        $respose[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $respose[MESSAGE]=($count > 0)?' success ':' failed ';
        $respose[DESCRIPTION]=($count > 0)? " $count result found ":' No result found ';
        $respose['result']=$query->result();
        // print_r($respose['result']);
        return json_encode($respose);
    }


    function get_searchterm($search_term){

         $response = array();
        $this->db->select('mp.*,min(pi.selling_price) as selling_price,pi.unit_of_measure');    
        $this->db->from('ga_main_prod_details_tbl mp');
        $this->db->like('prod_name',$search_term);
        // $this->db->where('mp.feature_product',1);
        $this->db->join('ga_prod_item_pricing_tbl pi', 'mp.id = pi.prod_id');
        $this->db->group_by('pi.prod_id');
        $query = $this->db->get();
        $count=$query->num_rows();

    if($count > 0){
      foreach ($query->result_array() as $row){
        // print_r($row);
        $row_set[] = htmlentities(stripslashes($row['prod_name'])); //build an array
      }
      
     echo json_encode($row_set); //format the array into json data
     } 
     
    }
}