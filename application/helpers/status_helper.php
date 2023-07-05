<?php

 function getStatus($res):array
 {
     $status=array();
     if (empty($res)) {
         $status['code'] = 404;
         $status['msg'] = "Data not found";
     } else {
         $status['code'] = 200;
         $status['msg'] = "Successfully Retrieved";
         $status['data'] = $res;
     }
     return $status;
 }

function getStatusCodes($statusCode):array
{
    $status=[];
     switch ($statusCode){
         case "200" :
             $status['code'] = 200;
             $status['msg'] = "Successfully Done";
             return $status;
         case "201":
             $status['code'] = 201;
             $status['msg'] = "Some Thing Went Wrong";
             return $status;
         case "404":
             $status['code'] = 404;
             $status['msg'] = "Data not found";
             return $status;
         case "204":
             $status['code'] = 204;
             $status['msg'] = "There is no content (Post values should not be null)";
             return $status;
         case "400":
             $status['code'] = 400;
             $status['msg'] = "bad request (only Post requests are acceptable)";
             return $status;
         case "208":
             $status['code'] = 208;
             $status['msg'] = "email Already Registered";
             return $status;
         case "203":
             $status['code'] = 203;
             $status['msg'] = "Image Didn't Upload";
             return $status;
         default:
             $status['code'] = 001;
             $status['msg'] = "Status code not matched";
             return $status;

     }
}