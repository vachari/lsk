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
                            <li><a href="<?php echo base_url(); ?>">home</a></li>
                            <li>Shopping Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--shopping cart area start -->
    <div class="shopping_cart_area mt-60">
        <div class="container">
            <form action="#" id="cartForm" method="post">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product_remove">Delete</th>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product_total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cartReq = json_decode($cartList);
                                        if ($cartReq->code == 200) {
                                            foreach ($cartReq->cart_result as $cartRes) {
                                                $productLink = base_url() . 'productDetails/' . $cartRes->prod_id;
                                        ?>
                                                <tr>
                                                    <td class="product_remove"><a href="javascript:void(0)" onclick="cartRemove(<?php echo $cartRes->cart_id; ?>)"><i class="fa fa-trash-o"></i></a></td>
                                                    <td class="product_thumb"><a href="<?php echo $productLink; ?>"><img src="<?php echo $cartRes->product_image; ?>" alt=""></a></td>
                                                    <td class="product_name"><a href="<?php echo $productLink; ?>"><?php echo $cartRes->prod_name; ?></a></td>
                                                    <td class="product-price"><?php echo india_price($cartRes->selling_price); ?></td>
                                                    <td class="product_quantity"><label>Quantity</label>

                                                        <input name="cartid[]" value="<?php echo $cartRes->cart_id; ?>" type="hidden">
                                                        <input name="qty[]" min="1" max="10" value="<?php echo $cartRes->qty; ?>" type="number">
                                                    </td>
                                                    <td class="product_total"><?php echo india_price($cartRes->selling_price * $cartRes->qty); ?></td>


                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">No items found in cart..!</td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <?php if ($cartReq->code == 200) { ?>
                                <div class="cart_submit">
                                    <button type="submit">update cart</button>
                                    <span class="success_msg"></span>
                                </div>
                            <?php } else { ?>
                                <div class="cart_submit">
                                    <a href="<?php echo base_url(); ?>" class="btn btn-danger"><i class="zmdi zmdi-shopping-basket"></i>&nbsp;Continue Shopping</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if ($cartReq->code == 200) { ?>
                    <!--coupon code area start-->
                    <div class="coupon_area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="coupon_code left">
                                    <h3>Coupon</h3>
                                    <div class="coupon_inner">
                                        <p>Enter your coupon code if you have one.</p>
                                        <input placeholder="Coupon code" type="text">
                                        <button type="submit">Apply coupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="coupon_code right">
                                    <h3>Cart Totals</h3>
                                    <?php
                                    $cartReport = json_decode($cartStatistics);
                                    ?>

                                    <div class="coupon_inner">
                                        <div class="cart_subtotal">
                                            <p>Subtotal</p>
                                            <p class="cart_amount"><?php echo india_price($cartReport->cart_amount); ?></p>
                                        </div>
                                        <div class="cart_subtotal ">
                                            <p>Shipping</p>
                                            <p class="cart_amount"><?php echo india_price($cartReport->cart_shipping); ?></p>
                                        </div>

                                        <div class="cart_subtotal">
                                            <p>Total</p>
                                            <p class="cart_amount"><?php echo india_price($cartReport->cart_grand_total); ?></p>
                                        </div>
                                        <div class="checkout_btn">
                                            <a href="<?php echo base_url(); ?>checkout">Proceed to Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--coupon code area end-->
                <?php } ?>
            </form>
        </div>
    </div>
    <!--shopping cart area end -->

    <?php $this->load->view('includes/footer.php'); ?>

    <script type="text/javascript" src="<?php echo JS_PATH; ?>commoncart.js"></script>

</body>

</html>
<script type="text/javascript">
    $('#cartForm').on('submit', function(i) {
        i.preventDefault();
        $.ajax({
            dataType: 'JSON',
            method: 'POST',
            data: new FormData(this),
            url: "<?php echo base_url(); ?>front/Cart/updateCartForm",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data.code == 200) {
                    $('.success_msg').html(data.description).addClass('alert alert-success fade in');
                    Swal.fire({
                        title: "<b>Success</b>",
                        html: "Cart details updated successfully",
                        confirmButtonText: "Okay",
                    }).then((value) => {
                        if (value) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: "<b>Fail</b>",
                        html: "No Data modified / Error occured while updating",
                        confirmButtonText: "Okay",
                    }).then((value) => {
                        if (value) {
                            location.reload();
                        }
                    });
                }
            },
            error: function(error) {
                console.log(error);
            },
        });
    });
</script>