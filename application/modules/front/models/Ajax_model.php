<?php if (! defined('BASEPATH')) exit('No direct script access');

class Ajax_model extends CI_Model
{
    public function __construct()
        {
                $this->load->database();
        }

    public function search ($title)
    {
        // echo $title;exit;

        $this->db->select('id');
        $this->db->select('prod_image');
        $this->db->select('prod_name');
        $this->db->select('prod_group');
         // $this->db->like('prod_name',$title,'after'); 
        // $this->db->or_like('prod_group',$title,'after'); 
        $this->db->like('prod_name', $title, 'both');
        $sql= $this->db->get('ga_main_prod_details_tbl');
          $db_error=  $this->db->error();
            if($db_error['code']==0)
            {
                   $count=$sql->num_rows();
                   // $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                   // $response[MESSAGE]=($count > 0)?'Success':'Fail';
                   // $response[DESCRIPTION]=($count > 0)?$count.' search list found':'Not found';
                   // $response['serach_count']=($count > 0)?$count:'Not found';
                   $response['serach_result']=($count > 0)?$sql->result():array();
            }
            else
            {
                $response[CODE]=DB_ERROR_CODE;
                $response[MESSAGE]='Db error';
                $response[DESCRIPTION]=(QUERY_DEBUG==1)?$db_error['message']:'Something error occured';
            }

            return  json_encode($response);
    }

     public function searchFollow ($title,$power)
    {
        if(!empty($power))
        {
          $this->db->select('user_id,user_name,user_email,user_mobile,power_user_id');
           $this->db->like('user_name',$title,'both'); 
          // $this->db->or_like('user_mobile',$title,'both'); 
          // $this->db->or_like('user_email',$title,'after'); 
          $this->db->where(array('power_user_id'=> $power,'user_type'=>1)); 
          // $this->db->like('prod_name', $title, 'both');
          $sql= $this->db->get('ga_users_tbl');
          // echo $this->db->last_query();exit;
            $db_error=  $this->db->error();
              if($db_error['code']==0)
              {
                     $count=$sql->num_rows();
                     $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
                     // $response[MESSAGE]=($count > 0)?'Success':'Fail';
                     // $response[DESCRIPTION]=($count > 0)?$count.' search list found':'Not found';
                     // $response['serach_count']=($count > 0)?$count:'Not found';
                     $response['follower_result']=($count > 0)?$sql->result():array();
              }
              else
              {
                  $response[CODE]=DB_ERROR_CODE;
                  $response[MESSAGE]='Db error';
                  $response[DESCRIPTION]=(QUERY_DEBUG==1)?$db_error['message']:'Something error occured';
              }
        }else{ 
                  $response[CODE]=FAIL_CODE;
                  $response[MESSAGE]='Please Login ';

        }

            return  json_encode($response);

    }

}

?>