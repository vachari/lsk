<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('isSuperAdminLogin'))    
{
   
	function isSuperAdminLogin()
	{
		$CI =& get_instance();
        $is_logged_in = $CI->session->userdata('admin_id');
		if((!isset($is_logged_in) || $is_logged_in != true) )
		{
		    redirect(base_url().'superadmin');
		}      
		else
		{
           return TRUE;
		}
	}
	
}
if(!function_exists('isVendorLogin'))    
{
   
	function isVendorLogin()
	{
		$CI =& get_instance();
        $is_logged_in = $CI->session->userdata('vendor_id');
		if((!isset($is_logged_in) || $is_logged_in != true) )
		{
		    redirect(base_url().'vendor');
		}      
		else
		{
           return TRUE;
		}
	}
	
}