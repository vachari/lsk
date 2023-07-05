<?php
defined('BASEPATH') or die('Please set up the configuration');

Class crud extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    public function commonCheck($cols, $table, $wherecondition) {
        $count = $this->db->select($cols)->from($table)->where($wherecondition)->get()->num_rows();
      // echo $this->db->last_query();exit;
        return ($count > 0) ? 1 : 0;
    }
     public function commonInsert($table, $insertdata, $displaymessage = NULL, $debug = NULL) {
        $response = array();
        //$sql_show= $this->db->set($insertdata)->get_compiled_insert($table);
        if (is_array($insertdata)) {
           $sql = $this->db->insert_string($table, $insertdata);
              if (isset($debug) && $debug == 'debug') {
                $response[QUERY_MESSAGE] = $sql;
            } else {
                $insert = $this->db->query($sql);
                $error = $this->db->error();
                $error_message = $error['message'];
                if ($error['code'] == 0) {
                    try {
                        if ($insert) {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $displaymessage;
                            $response[INSERTED_ID] = $this->db->insert_id();
                        } else {
                            throw new Exception('Error occured while inserting data');
                        }
                    } catch (Exception $ex) {
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Fail';
                        $response[DESCRIPTION] = 'Some thing error occured';
                    }
                } else {
                    $response[CODE] = DB_ERROR_CODE;
                    $response[MESSAGE] = 'Databse Error';
                    $response[DESCRIPTION] = $error_message;
                }
                if (QUERY_DEBUG == 1) {
                    $response[QUERY_DEBUG_MESSAGE] = $error_message;
                  //  $response[QUERY_MESSAGE] = $sql;
                }
            }
        } else {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Invalid format';
            $response[DESCRIPTION] = 'Input data is in invalid format';
        }
        return json_encode($response);
    }

    public function common_insert($params)
    {
                $response=array();
                if(!is_array($params))
                {
                        $response['code']=301;
                        $response['message']='Valiadtion';
                        $response['description']='Invalid input parameters';
                }
                else
                {
                        $table_name=  isset($params['table_name'])?$params['table_name']:'';
                        $table_insert_data=isset($params['insert_data'])?$params['insert_data']:'';
                        $success_message=isset($params['success_message'])?$params['success_message']:'';
                        $error_message=isset($params['error_message'])?$params['error_message']:'';
                        $debug=isset($params['debug'])?$params['debug']:0;
                        if(!empty($table_name) && is_array($table_insert_data) && (count($table_insert_data) > 0))
                        {
                                $table_name=  trim($table_name);
                                //Insert condition
                                $insert_sql=$this->db->insert_string($table_name,$table_insert_data);
                                if($debug==0)
                                {
                                    $success_message=($success_message!='')?$success_message:'Inserted successfully';
                                    $error_message=($error_message!='')?$error_message:'Unable to insert';
                                    $insert=  $this->db->query($insert_sql);
                                    //echo $this->db->last_query();exit;
                                    $db_error=  $this->db->error();
                                    if($db_error['code']==0)
                                    {
                                        $insert_row_count=  $this->db->affected_rows();
                                        $last_insert_id=  $this->db->insert_id();
                                        $response['code']=($insert_row_count > 0)?200:204;
                                        $response['message']=($insert_row_count > 0)?'success':'fail';
                                        $response['description']=($insert_row_count > 0)?$success_message:$error_message;
                                        $response['insert_id']=($insert_row_count > 0)?$last_insert_id:0;
                                    }
                                    else
                                    {
                                        $response['code']=575;
                                        $response['message']='Data base error';
                                        $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Please inform to support team';
                                    }
                                }
                                else
                                {
                                    $response['code']=575;
                                    $response['message']='Debug mode';
                                    $response['description']=$insert_sql;
                                }
                        }
                        else
                        {
                                $response['code']=301;
                                $response['message']='Valiadtion';
                                $response['description']='Table name or insert data is missing';
                        }
                }
                return json_encode($response);
    }
   
    public function common_update($params)
    {
        //echo "test";exit;
                $response=array();
                if(!is_array($params))
                {
                        $response['code']=301;
                        $response['message']='Valiadtion';
                        $response['description']='Invalid input parameters';
                }
                else
                {
                        $table_name=  isset($params['table_name'])?$params['table_name']:'';
                        $table_update_data=isset($params['update_data'])?$params['update_data']:'';
                        $table_update_condition=isset($params['update_condition'])?$params['update_condition']:'';
                        $success_message=isset($params['success_message'])?$params['success_message']:'';
                        $error_message=isset($params['error_message'])?$params['error_message']:'';
                        $debug=isset($params['debug'])?$params['debug']:0;
                        if(!empty($table_name) && is_array($table_update_data) && (count($table_update_data) > 0) && is_array($table_update_condition) && (count($table_update_condition) > 0))
                        {
                                $table_name=  trim($table_name);
                                //Insert condition
                                $update_sql=$this->db->update_string($table_name,$table_update_data,$table_update_condition);
                                if($debug==0)
                                {
                                    $success_message=($success_message!='')?$success_message:'updates successfully';
                                    $error_message=($error_message!='')?$error_message:'Unable to update';
                                    $update=  $this->db->query($update_sql);
                                    $db_error=  $this->db->error();
                                    if($db_error['code']==0)
                                    {
										//echo $this->db->last_query();exit;
                                        $update_row_count=  $this->db->affected_rows();
                                        $response['code']=($update_row_count > 0)?200:204;
                                        $response['message']=($update_row_count > 0)?'success':'fail';
                                        $response['description']=($update_row_count > 0)?$success_message:$error_message;
                                    }
                                    else
                                    {
                                        $response['code']=575;
                                        $response['message']='Data base error';
                                        $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Please inform to support team';
                                    }
                                }
                                else
                                {
                                    $response['code']=575;
                                    $response['message']='Debug mode';
                                    $response['description']=$update_sql;
                                }
                        }
                        else
                        {
                                $response['code']=301;
                                $response['message']='Valiadtion';
                                $response['description']='Table name or insert data is missing';
                        }
                }
                return json_encode($response);
    }
    public function common_delete($table,$conditionarray)
   {
        $response=array();
        $sql=$this->db->delete($table,$conditionarray);
        $action=$this->db->affected_rows();
            $response['code']='200';
            $response['message']='Success';
            $response['description']=$action.' Deleted Succesfully !!!';
         return json_encode($response);
    }
    //Check existance Code Start*/
    public function checkExistance($colname,$table,$checkarray)
    {
        $check=$this->db->select($colname)->from($table)->where($checkarray)->get()->num_rows();
        //print_r($this->db);
        return ($check > 0)?1:0;/*If Existance it will retuen 1 else 0*/
    }
    //Multiple  Insert
    public function batchInsert($table,$insertdata,$displaymessage=NULL)
    {
        $response=array();
        $sql=$this->db->insert_batch($table,$insertdata);
        $affected_rows=$this->db->affected_rows();
        $response['code']=($affected_rows > 0)?200:204;
        $response['message']=($affected_rows > 0)?'Success':'Fail';
        $response['description']=($affected_rows > 0)?"$affected_rows  records added successfully":'Unable to insert';
        return json_encode($response);
    }

    public function getEmail($cols,$table,$where_col,$id)
    {
        $response=array();
        $this->db->select($cols)->from($table);
        $sql_fetch=$this->db->where_in($where_col,$id)->get();
        //print_r($sql_fetch);exit;
        $db_error =  $this->db->error();
        if($db_error['code']!=0)
        {
                $response['code']='575';
                $response['message']='DB Error';
                $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {       //if()
                $count=$sql_fetch->num_rows();
                $response['code']=($count  > 0 )?200:204;
                $response['message']=($count  > 0 )?'Success':'Fail';
                $response['description']=($count  > 0 )?'Getting the user llist':'No results found';
                $response['result_count']=$count;
                $response['common_result']=($count  > 0 )?$sql_fetch->row():(object) null;
        }
        return json_encode($response);
    }

    public function getEmailMulti($cols,$table,$where_col,$id)
    {
        $response=array();
        $this->db->select($cols)->from($table);
        $sql_fetch=$this->db->where_in($where_col,$id)->get();
        //print_r($sql_fetch);exit;
        $db_error =  $this->db->error();
        if($db_error['code']!=0)
        {
                $response['code']='575';
                $response['message']='DB Error';
                $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {       //if()
                $count=$sql_fetch->num_rows();
                $response['code']=($count  > 0 )?200:204;
                $response['message']=($count  > 0 )?'Success':'Fail';
                $response['description']=($count  > 0 )?'Getting the user llist':'No results found';
                $response['result_count']=$count;
                $response['common_result']=($count  > 0 )?$sql_fetch->result():(object) null;
        }
        return json_encode($response);
    }
public function checkAndReturn($colname,$table,$checkdatawith)
    {
        /*It will return the Single value Only*/
        $check=$this->db->select($colname)->from($table)->where($checkdatawith)->get();
        $count=$check->num_rows();
        return ($count > 0)?$check->row()->$colname:0;
    }
    public function common_record_count($cols,$table_name,$order_by_col)
    {       
        $sql=$this->db->select($cols)->from($table_name)->order_by($order_by_col,'DESC')->get();
        $count=$sql->num_rows();
        return $count;
    }
    public function common_record_count_where($cols,$table_name,$where)
    {       
        $sql=$this->db->select($cols)->from($table_name)->where($where)->get();
        $count=$sql->num_rows();
        return $count;
    }
    public function common_list_paging($cols,$table_name,$like_col,$orderby,$limit,$start,$search)
    {
        $response=array();
        $sql=$this->db->select($cols)->from($table_name);
        if ($search == '') {
            $this->db->limit($limit, $start);
        }
        if ($search != '') {
            ($search != '') ? $this->db->like($like_col,$search,'both') : '';
        }
        //$sql=$this->db->limit($limit, $start);
        $query=$sql->order_by($orderby,'DESC')->get();
        //print_r($this->db->last_query());
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']='575';
            $resposne['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
            $response['code']=($count > 0)?200 :204;
            $response['message']=($count  > 0 )?'Success':'Fail';
            $response['description']=($count  > 0 )?'Getting the list':'No results found';
            $response['result_count']=$count;
            $response['common_result']=($count  > 0 )?$query->result():(object) null;
            $response['search_category'] = array('search' => $search);
         }
        return json_encode($response);       
    }
    public function common_list_paging_new($cols,$table_name,$like_col,$orderby,$limit,$start,$search)
    {
        $response=array();
        $sql=$this->db->select($cols)->from($table_name);
        if ($search == '') {
            $this->db->limit($limit, $start);
        }
        if ($search != '') {
            ($search != '') ? $this->db->like($like_col,$search,'both') : '';
            $this->db->limit($limit, $start);
        }
        //$sql=$this->db->limit($limit, $start);
        $query=$sql->order_by($orderby,'DESC')->get();
        //print_r($this->db->last_query());
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']='575';
            $resposne['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
            $response['code']=($count > 0)?200 :204;
            $response['message']=($count  > 0 )?'Success':'Fail';
            $response['description']=($count  > 0 )?'Getting the list':'No results found';
            $response['result_count']=$count;
            $response['common_result']=($count  > 0 )?$query->result():(object) null;
            $response['search_category'] = array('search' => $search);
         }
        return json_encode($response);       
    }
     public function commonStatusActivity($tablename,$setcolumns,$updatevalue,$wherecondition)
    {
        $updateStatus=($updatevalue==1)?'Activation Status':'De-activation Status';
        $sql=$this->db->update_string($tablename,array($setcolumns=>$updatevalue),$wherecondition);
        $qry=$this->db->query($sql);
        $update=$this->db->affected_rows();
        $response[CODE]=($update > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($update > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($update > 0)?"<b>$update</b> records updated successfully":'Unable to update';
        return json_encode($response);
    }
    public function commonDelete($table,$condition,$relationname)
    {
        $response=array();
        $sql=$this->db->delete($table,$condition);
        $delete=$this->db->affected_rows();
        $response[CODE]=($delete > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($delete > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($delete > 0)?"<b>$relationname</b> Deleted successfully":'Unable to delete';
        return json_encode($response);
    }
     public function commonUpdate($table, $update_data, $update_condition, $displaymessage = NULL, $debug = NULL,$failmessage=NULL) {
        $response = array();
        if (is_array($update_data) && is_array($update_condition)) {
            $sql = $this->db->update_string($table, $update_data, $update_condition);
            if (isset($debug) && $debug == 'debug') {
                $response[QUERY_MESSAGE] = $sql;
            } else {
                $update = $this->db->query($sql);
                $error = $this->db->error();
                $error_message = $error['message'];
                if ($error['code'] == 0) {
                    try {
                        $count = $this->db->affected_rows();
                        if ($count > 0) {
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $displaymessage;
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] =!empty($failmessage)?$failmessage:'Data not updated';
                        }
                    } catch (Exception $ex) {
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Fail';
                        $response[DESCRIPTION] = 'Some thing error occured';
                    }
                } else {
                    $response[CODE] = DB_ERROR_CODE;
                    $response[MESSAGE] = 'Database Error';
                    $response[DESCRIPTION] = $error_message;
                }
                if (QUERY_DEBUG == 1) {
                    $response[QUERY_DEBUG_MESSAGE] = $error_message;
                    $response[QUERY_MESSAGE] = $sql;
                }
            }
        } else {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Invalid format';
            $response[DESCRIPTION] = 'Input data is in invalid format';
        }
        return json_encode($response);
    }
    
      public function common_list_paging_join($cols,$table_name,$like_col,$orderby,$limit,$start,$search,$status_col,$status,$data)
    {
        $response=array();
        $sql=$this->db->select($cols)->from($table_name)->join($data['join_cond_one'],$data['join_cond_two'],$data['join_cond_three']);
        $this->db->join($data['second_join_cond_one'],$data['second_join_cond_two'],$data['second_join_cond_three']);
        $this->db->join($data['third_join_cond_one'],$data['third_join_cond_two'],$data['third_join_cond_three']);
        if($status!=''){
            $this->db->where($status_col,$status);
        }
        if ($search == '') {
            $this->db->limit($limit, $start);
        }
        if ($search != '') {
            ($search != '') ? $this->db->like($like_col,$search,'both') : '';
        }
        // if($search=='' && $status==''){
        //     $this->db->limit($limit, $start);
        // }

        $query=$sql->order_by($orderby,'DESC')->get();
        //echo $this->db->last_query();
        $db_error=$this->db->error();
        if($db_error['code']!=0){
            $response['code']=DB_ERROR_CODE;
            $resposne['message']='';
            $response['description']=(QUERY_DEBUG==1)?$db_error['message']:'Some thing error occured';
        }
        else
        {
            $count=$query->num_rows();
            $response['code']=($count > 0)?SUCCESS_CODE :FAIL_CODE;
            $response['message']=($count  > 0 )?'Success':'Fail';
            $response['description']=($count  > 0 )?'Getting the list':'No results found';
            $response['result_count']=$count;
            $response['common_result']=($count  > 0 )?$query->result():(object) null;
            $response['search_category'] = array('search' => $search);
         }
        return json_encode($response);       
    }
    public function common_get_allrec($table,$where) {
        $response=array();
        $query = $this->db->where($where);
        $query = $this->db->get($table);
        $count = $query->num_rows();
        $db_error =  $this->db->error();
        $respose[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
        $respose[MESSAGE]=($count > 0)?' success ':' failed ';
        $respose[DESCRIPTION]=($count > 0)? " $count result found ":' No result found ';
        $respose['common_result']=$query->result();
        return json_encode($respose);
      
    } 
}    
