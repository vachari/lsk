<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paymentcc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('ccavRequestHandler');
        // $this->load->library('ccavResponseHandler');
        $this->load->library('someclass');
        // $this->load->helper('Crypto');
        $this->load->helper('form');
    }

    public function index()
    {
        $this->load->view('payment');
    }

    public function processPayment()
    {
        error_reporting(0);

        $merchant_data = '';
        $working_key = '523FEAAF52FED812AB333978971AC194'; //Shared by CCAVENUES
        $access_code = 'AVNH78KF79BJ52HNJB'; //Shared by CCAVENUES

        foreach ($_POST as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }

        $encrypted_data = $this->someclass->encrypt($merchant_data, $working_key); // Method for encrypting the data.
        var_dump($encrypted_data);
?>
        <form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
            <?php
            echo "<input type=hidden name=encRequest value=$encrypted_data>";
            echo "<input type=hidden name=access_code value=$access_code>";
            ?>
        </form>
        </center>
        <script language='javascript'>
            document.redirect.submit();
        </script>
<?php
        echo "Payment Works";
    }

    public function paymentSuccess()
    {
        print_r($_REQUEST);
        error_reporting(0);

        $workingKey = '523FEAAF52FED812AB333978971AC194';        //Working Key should be provided here.
       // $encResponse = $_POST["encResp"];            //This is the response sent by the CCAvenue Server
        $encResponse = '3dd26ec4e02ca480515f41c13d3a29926ae33d2ed1dd73a51bdd3431444e84d6d18b71d164c125d891a3bb71498756f2b5c0d289b4f5936c854747d18b9c0816b15e5fed58094a9c6f3f70732371d9c61c9f9912cfe81676260fc6e78a5fbaf9d144698bf05b9f9beaa21fba389110e7bd94d2667ef9dbe7df14d6cf3a6cb9d05b1a5cd5a02e8a1c3aa9591286db52fb513e3dffb0453f1c8e1326a90bcad40cc843f0760ff7d6b20dd050c53f2a3ca8012f4d9d14339d05956d74136b65fc6f54ec9fe1c4360cd7ba1cbd8e860f5d9685f2590f1cdc07c57a36f32b6d4669081623fe7c33962272d7a32bf751a01cf6d78601913bfa7ddbbb8798dd5d0c3cb9b49b506d46ebc849e33201230b60b7444e640f33896fddbe09586579d6222eef96d4b1024b7dfcd071c9b15abdd0dbed198e19b741fc28c97b185ea4473909b9c35b678a2f4dfa58326217caa55c9c6b413f0fbfa28028c85a11e54662f37cd45743e86a780754e30e972a05829f527ed9ade056d4b9f03ec175297f8d3731cce9b0bd303c787b8de1eb13ab2e6208b7fc6798a16eb75513b3c311005415fca18e5c1ffc64d5c4f6aeccd71408b4de0f30db239b4917034672fd7219a2c364669b0b686c5ab356faebc389ed30b902bfbf04257e15b504959764af29263254bf0c932588738dd04b6fc425c1da027578a561f177f6171f36617fe922d65c789069683bcfb3b8092eb1558119b0c6560abf2afdcbc55a54067c68126e4b43185ed3aeef9cbaf9a24058c40add4c1b6b8bb1e54fe858ff1dcfd5d432ab3ae6206560a8df75cff29209eea730dd395ea167337f53480f26f0e18820c6b9b3c3b77246382a1a13838d87f72e691aa79c278e4e9015040ed98889f417af8c8d7835b421f7a30efc8b617bd771aa18783feb262e4c572e38696f467ad25bae4b53b6030b3088f7c790304eb7cb29ae027b970a4e9511c769d130d0d6fa4a97e238b074d5c649abb8cc707b8a09c13fd22f9501f5b53b1a50ff1c623ebcb11478f47260d70f87c001e01fcf48a0945c6f38f641c543b5d0b7a2c72b5ac39603f9f8e4c7160b6c8f295f74e6b36eef189d804681cbd8607fcb6fac4f9c789559cef3b0042afbd7bd49636bdd8a22ba94424ab5d5d6d3c664e1a7f96610c31551610685907436ec02b7265d172e0ec0f65b31e639ff60da3968951fe7bdd2ca822a5a744da95ec0060910e78a98e4b56696d4910bbb09f450c8192f1c8a6f516dbf895332098f52477b76c32ff170848027e73e87b44678579516e1c7e5c6e82137e20089d0425ae38e92a8bed4b1ba8c2af119c48c77763d1c44c579af119d5086941cb4703062b4cf2b040a214407053fed8c36740d5b79da1a632cd68f9844badb9d96';            //This is the response sent by the CCAvenue Server
        $rcvdString = $this->someclass->decrypt($encResponse, $workingKey);        //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        echo "<center>";

        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            if ($i == 3)    $order_status = $information[1];
        }

        if ($order_status === "Success") {
            echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
        } else if ($order_status === "Aborted") {
            echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
        } else if ($order_status === "Failure") {
            echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
        } else {
            echo "<br>Security Error. Illegal access detected";
        }

        echo "<br><br>";

        echo "<table cellspacing=4 cellpadding=4>";
        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            echo '<tr><td>' . $information[0] . '</td><td>' . $information[1] . '</td></tr>';
        }

        echo "</table><br>";
        echo "</center>";
    }

    public function paymentFail()
    {
        print_r($_REQUEST);
        echo "Payment Fail";
    }
}
