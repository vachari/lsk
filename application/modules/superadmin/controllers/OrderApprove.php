<?php
defined('BASEPATH') or exit('No direct script access allowed');
class OrderApprove extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Sendmail');
    }

    public function changeOrderStatus()
    {

        $order_id = $_REQUEST['order_id'];
        $order_number = $_REQUEST['order_number'];
        $order_email = $_REQUEST['order_email'];
        $order_phone = $_REQUEST['order_phone'];
        $order_backLink = $_REQUEST['order_backLink'];
        $track_status = $_REQUEST['track_status'];
        $track_comments = $_REQUEST['track_comments'];
        $order_data = [
            'order_number' => $order_number,
            'order_email' => $order_email,
            'order_phone' => $order_phone,
            'track_status' => $track_status,
            'track_comments' => $track_comments,
        ];
     
        $this->sendmail->sendEmail(
            array(
                'to' => $order_email,
                'cc' => array('info@' . SITE_DOMAIN),
                'bcc' => array(BCC_EMAIL),
                'subject' =>  $order_number . '- update  from ' . SITE_NAME,
                'data' => array('user_data' => $order_data),
                'template' => EMAIL_TEMPLATE_FOLDER . 'admin_order_approve',
            )
        );
        redirect($order_backLink, 'refresh');
    }
}
