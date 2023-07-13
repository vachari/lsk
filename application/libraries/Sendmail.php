<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sendmail
{

    public function emailConfigSetttings()
    {
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
        $obj = &get_instance();
        $userEmail = $mail_array['to'];
        $subject = $mail_array['subject'];
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.hostinger.com',
            'smtp_port' => '465',
            'smtp_user' => 'info@lskoffers.com',
            'smtp_pass' => 'LSKOffers@info#2023',
            'smtp_timeout' => '4',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',

            'wordwrap' => TRUE,
        );

        $obj->load->library('email', $config);
        //$obj->email->set_newline("\r\n");
        $obj->email->set_newline("\r\n");
        $obj->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $obj->email->set_header('Content-type', 'text/html');
        $obj->email->from('support@lskoffers.com', 'LSK Offers');

        $obj->email->to($userEmail);  // replace it with receiver mail id
        $obj->email->subject($subject); // replace it with relevant subject
        $body = $obj->load->view('emails/testmail.php', $mail_array['data'], TRUE);
        $obj->email->message($body);
        $obj->email->send();
        return true;
    }
}
