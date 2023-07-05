<?php
	$razor_api_key="rzp_test_axm004IdFYVgRW";
	$razor_api_secret="Ym5iqaO27EzeHMbhRQdyUM18";
	echo "Payable Amount : ". $pay_amount;
	echo "<br>";
	$pay_amount=$pay_amount * 100;
	$pay_email=$this->session->userdata('pay_email');
?>
<!DOCTYPE html>
<html>
<head>
	<title>RazorPay Integration</title>
	<meta name="viewport" content="width=device-width">
	<style type="text/css">
		.razorpay-payment-button{
			color: white !important;background-color: gray;padding: 10px;border-color: green;font-size: 14px;
		}
	</style>
</head>

<body>
	<form action="<?php echo base_url().'front/Orders/payment'; ?>" method="POST">
		<!-- Note that the amount is in paise = 50 INR -->
		<script
		    src="https://checkout.razorpay.com/v1/checkout.js"
		    data-key="<?php echo $razor_api_key ?>"
		    data-amount="<?php echo $pay_amount ?>"
		    data-buttontext="Pay Now"
		    data-name="Shoperative Payment"
		    data-description="RazorPay Test"
		    data-image="https://your-awesome-site.com/your_logo.jpg"
		    data-prefill.name="<?php echo $pay_name ?>"
		    data-prefill.email="<?php echo $pay_email ?>"
		    data-theme.color="#F37254"
		></script>
		<input type="hidden" value="Hidden Element" name="hidden">
	</form>
</body>
</html>
