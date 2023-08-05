<?php $this->load->view('includes/header_css'); ?>

<body>
    <!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

    <div class="wrapper">
        <!--Header Area Start-->
        <?php $this->load->view('includes/header'); ?>
        <!--Header Area End-->
        <!--Heading Banner Area Start-->
        <section class="heading-banner-area pt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading-banner">
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home</a><span class="breadcome-separator">></span></li>
                                    <li>Checkout</li>
                                </ul>
                            </div>
                            <div class="heading-banner-title">
                                <h1>Checkout</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!--Checkout Area Start-->
        <div class="checkout-area mt-20">
            <div class="container">
                <div class="row">

                    <!--Checkout Area Start-->
                    <div class="col-md-12">
                        <div class="checkout-form-area">
                            <div class="checkout-title">
                                <h3>Billing details</h3>
                            </div>
                            <div class="ceckout-form">
                                <?php echo form_open('front/Orders/orders'); ?>
                                <!--Billing Fields Start-->
                                <div class="billing-fields">
                                    <div class="form-fild first-name">
                                        <p><label>User Name<span class="required">*</span></label></p>
                                        <input type="text" name="name" maxlength="60" value="<?php echo $_SESSION['user_name']; ?>" required />
                                    </div>
                                    <div class="form-fild first-name">
                                        <p><label>Phone<span class="required">*</span></label></p>
                                        <input type="text" name="phone" value="<?php echo isset($_SESSION['user_mobile']) ? $_SESSION['user_mobile'] : ''; ?>" required />
                                    </div>
                                    <div class="form-fild first-name">
                                        <p><label>Email Address<span class="required">*</span></label></p>
                                        <input type="text" name="email" value="<?php echo $_SESSION['user_email']; ?>" maxlength="60" required />
                                    </div>
                                    <div class="form-fild first-name">
                                        <p><label>Street address <span class="required">*</span></label></p>
                                        <textarea name="address" class="form-control" placeholder="House number and street name" required></textarea>
                                    </div>
                                    <div class="form-fild first-name">
                                        <p><label>Town / City <span class="required">*</span></label></p>
                                        <input type="text" name="city" maxlength="60" required />
                                    </div>
                                    <div class="form-fild first-name">
                                        <p><label>Pincode<span class="required">*</span></label></p>
                                        <input type="text" name="pincode" maxlength="6" required />
                                    </div>
                                    <div class="form-fild first-name">
                                        <p><label>State<span class="required">*</span></label></p>
                                        <input type="text" name="state" maxlength="50" required />
                                    </div>
                                    <div class="form-fild first-name">
                                        <p><label>State<span class="required">*</span></label></p>
                                        <input type="text" name="country" maxlength="30" required value="India" />
                                    </div>

                                    <div class="form-fild first-name">
                                        <p><label>Referral Code</label></p>
                                        <input type="text" name="referralCode" maxlength="20" />
                                    </div>
                                </div>
                                <!--Billing Fields End-->


                                <!--Additional Fields Start-->
                                <div class="additional-fields">
                                    <div class="order-notes">
                                        <div class="form-fild order-name">
                                            <p><label>Order notes</label></p>
                                            <textarea name="order_comments" id="checkout-mess" placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!--Additional Fields End-->
                                <!--Your Order Fields Start-->
                                <div class="your-order-fields mt-30">
                                    <div class="your-order-title">
                                        <h3>Your order</h3>
                                    </div>
                                    <div class="your-order-table table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Product</th>
                                                    <th class="product-total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cartReq = json_decode($cartList);
                                                if ($cartReq->code == 200) {
                                                    foreach ($cartReq->cart_result as $cartRes) {
                                                ?>
                                                        <tr class="cart_item">
                                                            <td class="product-name"><?php echo $cartRes->prod_name; ?> <strong class="product-quantity"> ×<?php echo $cartRes->qty; ?></strong></td>
                                                            <td class="product-total"><span class="amount"> <?php echo india_price($cartRes->selling_price * $cartRes->qty); ?></span></td>
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan="2">No Items found in cart. Please shop ..</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <?php
                                                $cartReport = json_decode($cartStatistics);
                                                ?>
                                                <tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                    <td><span class="amount"><?php echo india_price($cartReport->cart_amount); ?></span></td>
                                                </tr>
                                                <tr class="shipping">
                                                    <th>Shipping</th>
                                                    <td data-title="shipping">
                                                        <p><?php echo india_price($cartReport->cart_shipping); ?></p>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td><strong><span class="total-amount"><?php echo india_price($cartReport->cart_grand_total); ?></span></strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!--Your Order Fields End-->
                                <div class="checkout-payment">
                                    <ul>
                                        <li class="payment_method_cheque-li">
                                            <input id="payment_online" checked name="mod" value="online" type="radio" /> Pay via CC AVENUE ( Make Secure payment with CC Avenue)
                                        </li>

                                    </ul>
                                    <input type="hidden" name="paymentgateway_agent" value="CC_AVENUE">
                                    <button class="order-btn" type="submit">Place order</button>
                                </div>
                                <?php echo form_close(); ?>
                                <div class="clearfix">&nbsp;</div>
                                <div>
                                    <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>">Add more items</a>
                                    <a class="btn btn-sm btn-warning" href="<?php echo base_url(); ?>cart">Modify Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Checkout Area End-->
                </div>
            </div>
        </div>
        <!--Checkout Area End-->

        <?php $this->load->view('includes/footer'); ?>

    </div>

</body>

</html>