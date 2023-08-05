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
                                    <li>Shopping Cart</li>
                                </ul>
                            </div>
                            <div class="heading-banner-title">
                                <h1>Shopping Cart</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!--Shopping Cart Area Start-->
        <div class="shopping-cart-area mt-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="shop-form" action="#" id="cartForm" method="post">
                            <div class="wishlist-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-remove"></th>
                                            <th class="product-cart-img">
                                                <span class="nobr">Product Image</span>
                                            </th>
                                            <th class="product-name">
                                                <span class="nobr">Product Name</span>
                                            </th>
                                            <th class="product-quantity">
                                                <span class="nobr">quantity</span>
                                            </th>
                                            <th class="product-price">
                                                <span class="nobr"> Unit Price </span>
                                            </th>
                                            <th class="product-total-price">
                                                <span class="nobr"> Total Price </span>
                                            </th>
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
                                                    <td class="product-remove product_remove">
                                                        <a href="javascript:void(0)" onclick="cartRemove(<?php echo $cartRes->cart_id; ?>)">×</a>
                                                    </td>
                                                    <td class="product-cart-img">
                                                        <a href="<?php echo $productLink; ?>"><img src="<?php echo $cartRes->product_image; ?>" alt=""></a>
                                                    </td>
                                                    <td class="product-name" title="<?php echo $cartRes->prod_name; ?>">
                                                        <a href="<?php echo $productLink; ?>"><?php echo substr($cartRes->prod_name, 0, 30); ?>..</a>
                                                    </td>
                                                    <td class="product-quantity">
                                                        <input name="cartid[]" value="<?php echo $cartRes->cart_id; ?>" type="hidden">
                                                        <input name="qty[]" min="1" max="10" value="<?php echo $cartRes->qty; ?>" type="number">
                                                    </td>
                                                    <td class="product-price">
                                                        <span> <ins><?php echo india_price($cartRes->selling_price); ?></ins></span>
                                                    </td>
                                                    <td class="product-total-price">
                                                        <span><?php echo india_price($cartRes->selling_price * $cartRes->qty); ?></span>
                                                    </td>
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
                        
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                         
                            <div class="cart-collaterals">
                                <div class="cart-cuppon">
                                    <div class="coupon">
                                        <input name="coupon_code" class="input-copun" value="" placeholder="Coupon code" type="text">
                                        <button type="submit" class="wishlist-btn shopping-btn">Apply coupon</button>
                                    </div>
                                    <?php if ($cartReq->code == 200) { ?>
                                        <button class="btn btn-primary" type="submit">Update cart</button>
                                        <span class="success_msg"></span>
                                    <?php } else { ?>
                                        <div class="cart_submit">
                                            <a href="<?php echo base_url(); ?>" class="update-btn"><i class="zmdi zmdi-shopping-basket"></i>&nbsp;Continue Shopping</a>
                                        </div>
                                    <?php } ?> 
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php if ($cartReq->code == 200) {
                        $cartReport = json_decode($cartStatistics);
                    ?>
                        <div class="col-lg-6 col-md-6">
                            <div class="shopping-cart-total">
                                <h2>Cart totals</h2>
                                <div class="shop-table table-responsive">
                                    <table>
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <td data-title="Subtotal"><span><?php echo india_price($cartReport->cart_amount); ?></span></td>
                                            </tr>
                                            <tr class="shipping">
                                                <td data-title="Shipping"><Span><?php echo india_price($cartReport->cart_shipping); ?></Span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <td data-title="Total"><span><strong><?php echo india_price($cartReport->cart_grand_total); ?></strong></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="proceed-to-checkout">
                                    <a class="checkout-button " href="<?php echo base_url(); ?>checkout">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!--Shopping Cart Area End-->
      
        <!--Footer Area Start-->
        <?php $this->load->view('includes/footer'); ?>
        <!--Footer Area End-->

    </div>


</body>
<script type="text/javascript" src="<?php echo JS_PATH; ?>commoncart.js"></script>
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
</html>