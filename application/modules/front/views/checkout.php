<?php $this->load->view('includes/header_css.php'); ?>

<body>

    <?php $this->load->view('includes/header.php'); ?>

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->



    <!--Checkout page section-->
    <div class="Checkout_section mt-60">
        <div class="container">
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <?php echo form_open('front/Orders/orders'); ?>
                        <h3>Billing Details</h3>
                        <div class="row">

                            <div class="col-lg-6 mb-20">
                                <label>User Name <span>*</span></label>
                                <input type="text" name="name" maxlength="60" value="<?php echo $_SESSION['user_name']; ?>" required>
                            </div>

                            <div class="col-lg-6 mb-20">
                                <label>Phone<span>*</span></label>
                                <input type="text" name="phone" value="<?php echo isset($_SESSION['user_mobile']) ? $_SESSION['user_mobile'] : ''; ?>" required>

                            </div>
                            <div class="col-lg-6 mb-20">
                                <label> Email Address <span>*</span></label>
                                <input type="text" name="email" value="<?php echo $_SESSION['user_email']; ?>" maxlength="60" required />

                            </div>

                            <div class="col-12 mb-20">
                                <label>Street address <span>*</span></label>
                                <textarea name="address" class="form-control" placeholder="House number and street name" required></textarea>
                            </div>
                            <!-- <div class="col-12 mb-20">
                                    <input placeholder="Apartment, suite, unit etc. (optional)" type="text">
                                </div> -->
                            <div class="col-12 mb-20">
                                <label>Town / City <span>*</span></label>
                                <input type="text" name="city" maxlength="60" required />
                            </div>


                            <div class="col-12 mb-20">
                                <label>Pincode<span>*</span></label>
                                <input type="text" name="pincode" maxlength="6" required />
                            </div>
                            <div class="col-12 mb-20">
                                <label>State <span>*</span></label>
                                <input type="text" name="state" maxlength="50" required />
                            </div>
                            <div class="col-12 mb-20">
                                <label>Country <span>*</span></label>
                                <input type="text" name="country" maxlength="30" required value="India" />
                            </div>
                            <div class="col-12 mb-20">
                                <label>Referral Code<span></span></label>
                                <input type="text" name="referralCode" maxlength="20" />
                            </div>


                            <div class="col-12 mb-20" style="display: none;">
                                <input id="account" type="checkbox" data-bs-target="createp_account" />
                                <label for="account" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne">Create an account?</label>

                                <div id="collapseOne" class="collapse one" data-parent="#accordion">
                                    <div class="card-body1">
                                        <label> Account password <span>*</span></label>
                                        <input placeholder="password" type="password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-20">
                                <input style="display: none;" id="address" type="checkbox" data-bs-target="createp_account" />
                                <label style="display: none;" class="righ_0" for="address" data-bs-toggle="collapse" data-bs-target="#collapsetwo" aria-controls="collapseOne">Ship to a different address?</label>

                                <div id="collapsetwo" class="collapse one" data-parent="#accordion">
                                    <div class="row">
                                        <div class="col-lg-6 mb-20">
                                            <label>User Name <span>*</span></label>
                                            <input type="text" id="b_name" name="b_name" maxlength="30" />
                                        </div>


                                        <div class="col-12 mb-20">
                                            <label>Street address <span>*</span></label>
                                            <input placeholder="House number and street name" type="text" name="b_address" id="b_address" value="GK Residency, Banglore" />
                                        </div>
                                        <div class="col-12 mb-20">
                                            <input placeholder="Apartment, suite, unit etc. (optional)" type="text">
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label>Town / City <span>*</span></label>
                                            <input type="text" name="b_city" id="b_city" value="Banglore">
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label>State <span>*</span></label>
                                            <input type="text" name="b_state" id="b_state" value="Karnataka">
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label>Pincode <span>*</span></label>
                                            <input type="text" name="b_pincode" id="b_pincode" maxlength="6" value="560094">
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label>Country <span>*</span></label>
                                            <input type="text" name="b_country" id="b_country" value="India">
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <label>Phone<span>*</span></label>
                                            <input type="text" name="b_mobile" id="b_mobile" maxlength="10" value="9182900940" />

                                        </div>
                                        <div class="col-lg-6">
                                            <label> Email Address <span>*</span></label>
                                            <input type="text" name="b_email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-6">

                        <h3>Your order</h3>
                        <div class="order_table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cartReq = json_decode($cartList);
                                    if ($cartReq->code == 200) {
                                        foreach ($cartReq->cart_result as $cartRes) {
                                    ?>
                                            <tr>
                                                <td> <?php echo $cartRes->prod_name; ?> <strong> × <?php echo $cartRes->qty; ?></strong></td>
                                                <td> <?php echo india_price($cartRes->selling_price * $cartRes->qty); ?></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="2">No Items found in cart. Please shop ..</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <?php
                                $cartReport = json_decode($cartStatistics);
                                ?>
                                <tfoot>
                                    <tr>
                                        <th>Cart Subtotal</th>
                                        <td><?php echo india_price($cartReport->cart_amount); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td><strong><?php echo india_price($cartReport->cart_shipping); ?></strong></td>
                                    </tr>
                                    <tr class="order_total">
                                        <th>Order Total</th>
                                        <td><strong><?php echo india_price($cartReport->cart_grand_total); ?></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment_method">
                            <!-- <div class="panel-default">
                                <input id="payment" name="check_method" type="radio" data-bs-target="createp_account" />
                                <label for="payment" data-bs-toggle="collapse" data-bs-target="#method" aria-controls="method">Create an account?</label>

                                <div id="method" class="collapse one" data-parent="#accordion">
                                    <div class="card-body1">
                                        <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                    </div>
                                </div>
                            </div> -->
                            <div class="panel-default">

                                <input id="payment_online" checked name="mod" value="online" type="radio" /> ONLINE ( Make Secure payment with CC Avenue)
                                <!-- <label for="payment_defult" data-bs-toggle="collapse" data-bs-target="#collapsedefult" aria-controls="collapsedefult">PayPal <img src="assets/img/icon/papyel.png" alt=""></label> -->

                                <div id="collapsedefult" class="collapse one" data-parent="#accordion">
                                    <div class="card-body1">
                                        <p>Make secure payment with CC Avenue</p>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">&nbsp;</div>
                            <div class="order_button">
                                <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>">Add more items</a>
                                <a class="btn btn-sm btn-warning" href="<?php echo base_url(); ?>cart">Modify Cart</a>

                                <button type="submit" class="btn btn-sm btn-danger">Proceed to Pay</button>
                            </div>
                        </div>
                        <input type="hidden" name="paymentgateway_agent" value="CC_AVENUE">
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Checkout page section end-->


    <?php $this->load->view('includes/footer.php'); ?>
</body>

</html>