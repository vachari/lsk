<?php
$pay_email = $this->session->userdata('pay_email');
$pay_orderid = $this->session->userdata('order_no');
$username = $customerData['user_name'];
?>
<html>


<head>
    <script>
        window.onload = function() {
            var d = new Date().getTime();
            document.getElementById("tid").value = d;
        };
    </script>
</head>

<body>
    <form method="post" name="customerData" action="<?php echo base_url() . 'front/Orders/ccProcessPayment'; ?>">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <img src="<?php echo PROJECT_LOGO; ?>" alt="IMG" style="height: 80px; width:120px;">
                </div>

                <div class="col-md-6">
                    <h5>
                        Make Payment
                    </h5>
                    <div class="clearfix">&nbsp;</div>
                    <ul class="list-items">
                        <li>Total Amount : <?php echo india_price($customerData['totalpayableprice']); ?></li>
                        <li>Paying Amount ₹: <input type="text" name="amount" value="1.00" class="form-control" /></li>
                    </ul>

                    <div class="clearfix">&nbsp;</div>
                    <div>
                        <input type="submit" value="Make Payment" class="btn btn-primary" />
                    </div>
                </div>
            </div>
        </div>

        <table width="40%" height="100" border='1' align="center" style="opacity: 0;">
            <caption>
                <font size="4" color="blue"><b>Integration Kit</b></font>
            </caption>
        </table>
        <table width="40%" height="100" border='1' align="center" style="opacity: 0;">
            <tr>
                <td>Parameter Name:</td>
                <td>Parameter Value:</td>
            </tr>
            <tr>
                <td colspan="2"> Compulsory information</td>
            </tr>
            <tr>
                <td>TID :</td>
                <td><input type="text" name="tid" id="tid" readonly /></td>
            </tr>
            <tr>
                <td>Merchant Id :</td>
                <td><input type="text" name="merchant_id" value="<?php echo CC_AVENUE_MERCHANT_ID; ?>" /></td>
            </tr>
            <tr>
                <td>Order Id :</td>
                <td><input type="text" name="order_id" value="<?php echo $pay_orderid; ?>" /></td>
            </tr>

            <tr>
                <td>Currency :</td>
                <td><input type="text" name="currency" value="INR" /></td>
            </tr>
            <tr>
                <td>Redirect URL :</td>
                <td><input type="text" name="redirect_url" value="<?php echo base_url() . 'front/Orders/ccPaymentSuccess'; ?>" /></td>
            </tr>
            <tr>
                <td>Cancel URL :</td>
                <td><input type="text" name="cancel_url" value="<?php echo base_url() . 'front/Orders/paymentFail'; ?>" /></td>
            </tr>
            <tr>
                <td>Language :</td>
                <td><input type="text" name="language" value="EN" /></td>
            </tr>
            <tr>
                <td colspan="2">Billing information(optional):</td>
            </tr>
            <tr>
                <td>Billing Name :</td>
                <td><input type="text" name="billing_name" value="<?php echo $username; ?>" /></td>
            </tr>
            <tr>
                <td>Billing Address :</td>
                <td><input type="text" name="billing_address" value="<?php echo $customerData['address']; ?>" /></td>
            </tr>
            <tr>
                <td>Billing City :</td>
                <td><input type="text" name="billing_city" value="<?php echo $customerData['city']; ?>" /></td>
            </tr>
            <tr>
                <td>Billing State :</td>
                <td><input type="text" name="billing_state" value="<?php echo $customerData['state']; ?>" /></td>
            </tr>
            <tr>
                <td>Billing Zip :</td>
                <td><input type="text" name="billing_zip" value="<?php echo $customerData['pincode']; ?>" /></td>
            </tr>
            <tr>
                <td>Billing Country :</td>
                <td><input type="text" name="billing_country" value="<?php echo $customerData['country']; ?>" /></td>
            </tr>
            <tr>
                <td>Billing Tel :</td>
                <td><input type="text" name="billing_tel" value="<?php echo $customerData['mobile']; ?>" /></td>
            </tr>
            <tr>
                <td>Billing Email :</td>
                <td><input type="text" name="billing_email" value="<?php echo $customerData['email']; ?>" /></td>
            </tr>
            <tr>
                <td colspan="2">Shipping information(optional)</td>
            </tr>
            <tr>
                <td>Shipping Name :</td>
                <td><input type="text" name="delivery_name" value="<?php echo $username; ?>" /></td>
            </tr>
            <tr>
                <td>Shipping Address :</td>
                <td><input type="text" name="delivery_address" value="<?php echo $customerData['address']; ?>" /></td>
            </tr>
            <tr>
                <td>shipping City :</td>
                <td><input type="text" name="delivery_city" value="<?php echo $customerData['city']; ?>" /></td>
            </tr>
            <tr>
                <td>shipping State :</td>
                <td><input type="text" name="delivery_state" value="<?php echo $customerData['state']; ?>" /></td>
            </tr>
            <tr>
                <td>shipping Zip :</td>
                <td><input type="text" name="delivery_zip" value="<?php echo $customerData['pincode']; ?>" /></td>
            </tr>
            <tr>
                <td>shipping Country :</td>
                <td><input type="text" name="delivery_country" value="<?php echo $customerData['country']; ?>" /></td>
            </tr>
            <tr>
                <td>Shipping Tel :</td>
                <td><input type="text" name="delivery_tel" value="<?php echo $customerData['mobile']; ?>" /></td>
            </tr>
            <tr>
                <td>Merchant Param1 :</td>
                <td><input type="text" name="merchant_param1" value="additional Info." /></td>
            </tr>
            <tr>
                <td>Merchant Param2 :</td>
                <td><input type="text" name="merchant_param2" value="additional Info." /></td>
            </tr>
            <tr>
                <td>Merchant Param3 :</td>
                <td><input type="text" name="merchant_param3" value="additional Info." /></td>
            </tr>
            <tr>
                <td>Merchant Param4 :</td>
                <td><input type="text" name="merchant_param4" value="additional Info." /></td>
            </tr>
            <tr>
                <td>Merchant Param5 :</td>
                <td><input type="text" name="merchant_param5" value="additional Info." /></td>
            </tr>
            <tr>
                <td>Promo Code :</td>
                <td><input type="text" name="promo_code" value="" /></td>
            </tr>
            <tr>
                <td>Vault Info. :</td>
                <td><input type="text" name="customer_identifier" value="" /></td>
            </tr>

        </table>
    </form>
</body>

</html>