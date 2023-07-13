<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sendmails extends CI_Controller
{

    public function htmlmail()
    {
        $userEmail = 'achariphp@gmail.com';
        $subject = 'Test email from Server' . date('d M, Y H:i');
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

        $this->load->library('email', $config);
        //$this->email->set_newline("\r\n");
        $this->email->set_newline("\r\n");
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->from('support@lskoffers.com', 'LSK Offers');
        $data = array(
            'userName' => 'Venkateswara Achari'
        );
        $this->email->to($userEmail);  // replace it with receiver mail id
        $this->email->subject($subject); // replace it with relevant subject
        $body = $this->load->view('emails/testmail.php', $data, TRUE);
        $this->email->message($body);
        $this->email->send();
        if ($this->email->send()) {
            echo "Mail Seng";
        } else {
            echo "Failed";
        }
    }

    public function checkMail()
    {
        $data = array(
            'userName' => 'Venkateswara Achari'
        );
        $mail_array = $this->sendmail->sendEmail(
            array(
                'to' => array('achariphp@fmail.com'),
                'bcc' => array(BCC_EMAIL),
                'subject' => SITE_NAME . ' User Verification Link',
                'data' => array('user_data' => $data),
                'template' => 'emails/testmail.php',
            )
        );
        echo json_encode($mail_array);
    }
}
