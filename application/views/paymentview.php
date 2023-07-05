<?php
$razor_api_key = "rzp_test_a5o9roI9nSyMNJ";
$razor_api_secret = "Ly8a4HcAGejDLf4A6qnocbqD";
echo "Payable Amount : " . $pay_amount;
echo "<br>";
$pay_amount = $pay_amount * 100;
$pay_email = 'achariphp@gmail.com';
?>
<!DOCTYPE html>
<html>

<head>
    <title>RazorPay Integration</title>
    <meta name="viewport" content="width=device-width">
    <style type="text/css">
        .razorpay-payment-button {
            color: white !important;
            background-color: gray;
            padding: 10px;
            border-color: green;
            font-size: 14px;
        }
    </style>
    <style>
        .razorpay-payment-button {
            display: none;
        }
    </style>
     

<body>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
       
    </div>
    <section>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full-bg martop150">

            <div class="col-md-12 ">
                <!-- <h2 class="text-titel">  ABOUT US </h2> -->
                <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>"> Home </a></li>
                    </ol>
                </div>

            </div>

        </div>
    </section>
    <section>
        <div class="container text-center">

            <button class="btn razorpay-payment-button" id="myButton">Pay Now</button>
        </div>
    </section>

    <form action="<?php echo base_url() . 'front/Orders/payment'; ?>" method="POST" id="myForm">
        <!-- Note that the amount is in paise = 50 INR -->
        <!-- for live --
		data-amount="<?php echo $pay_amount ?>"
		-->
        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $razor_api_key ?>" data-amount="100" data-buttontext="Pay Now" data-name="Circle Tech" data-description="RazorPay Test" data-image="<?php echo IMG_PATH; ?>logo.png" data-prefill.name="<?php echo $pay_name ?>" data-prefill.email="<?php echo $pay_email ?>" data-theme.color="#F37254"></script>
        <input type="hidden" value="Hidden Element" name="hidden">
    </form>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".razorpay-payment-button").submit();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#myButton").click(function() {
            $("#myForm").submit();
        });
    });
</script>

</html>