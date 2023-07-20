<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sendmail 
{

    public function emailConfigSetttings() {
        $config['protocol'] = SMTP_PROTOCAL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASSWORD;
        $config['charset'] = "iso-8859-1";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
     //   $config['mailpath'] = '/usr/sbin/sendmail';
        return $config;
    }
    public function sendEmail($mail_array)
    {
       // print_r($mail_array);exit;
        $obj =& get_instance();
        $userEmail = $mail_array['to'];
        $subject = $mail_array['subject'];
        
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "cirlcetechdev@gmail.com"; 
        $config['smtp_pass'] = "fmfwjhbayozyxcxu";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "text/html";
        $config['newline'] = "\r\n";
        $obj->email->initialize($config);
        $obj->email->set_newline("\r\n");
        $obj->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $obj->email->set_header('Content-type', 'text/html');
        $obj->email->from('info@lskoffers', 'LSK Offers');
        $obj->email->to($userEmail);  
        $obj->email->subject($subject); 
        $body = $obj->load->view($mail_array['template'], $mail_array['data'], TRUE);
        $obj->email->message($body);
        $obj->email->send();
        return true;
         
    }
}
