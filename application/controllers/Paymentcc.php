<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paymentcc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('ccavRequestHandler');
        // $this->load->library('ccavResponseHandler');
        // $this->load->library('Crypto');
        $this->load->helper('form');
    }

    public function index()
    {
        $this->load->view('payment');
    }

    public function processPayment()
    {
        
    }

    public function paymentSuccess()
    {
        print_r($_REQUEST);
        echo "Payment Success";
    }

    public function paymentFail()
    {
        print_r($_REQUEST);
        echo "Payment Fail";
    }
}
