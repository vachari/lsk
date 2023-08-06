<?php
$cartCount = 0;
$CartAmount = 0;
$isUserLoggedIn = false;
$loggedInUserName = '';
$totItemSql = $this->db->select("SUM(qty) as totItem,SUM(total_amount) as productTotalAmount")->from('ga_cart_tbl')->where(array('cart_status' => 0, 'cart_session_id' => $this->cart_session_id))->get();

if ($totItemSql->num_rows() > 0) {
    $cartCount = ($totItemSql->row()->totItem > 0) ? $totItemSql->row()->totItem : 0;
    $CartAmount = ($cartCount > 0) ? india_price($totItemSql->row()->productTotalAmount) : india_price(0);
}
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0) {
    $isUserLoggedIn = true;
    $loggedInUserName = $_SESSION['user_name'];
}
$category = json_decode($menuList);
?>
<!--Header Area Start-->
<header>
    <div class="header-container">
        <!--Header Top Area Start-->
        <div class="header-top-area">
            <div class="container">
                <div class="row">
                    <!--Header Top Left Area Start-->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="header-top-menu">
                            <ul>

                                <li><span>Beta</span></li>
                            </ul>
                        </div>
                    </div>
                    <!--Header Top Left Area End-->
                    <!--Header Top Right Area Start-->
                    <div class="col-lg-8 col-md-8 d-lg-block d-md-block d-none text-right">
                        <div class="header-top-menu">
                            <ul>
                                <li class="support"><span>Best Car & Bike deals are there - Support: <?php echo PROJECT_PHONE; ?></span></li>
                                <li class="account"><a href="#">My Account <i class="fa fa-angle-down"></i></a>
                                    <ul class="ht-dropdown">
                                        <?php if ($isUserLoggedIn) { ?>
                                            <li><a href="<?php echo base_url(); ?>checkout">Checkout </a></li>
                                            <li><a href="<?php echo base_url(); ?>profile">My Account </a></li>
                                            <li><a href="<?php echo base_url(); ?>cart">Shopping Cart</a></li>
                                            <li><a href="<?php echo base_url(); ?>profile">Wishlist</a></li>
                                            <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
                                        <?php  } else { ?>
                                            <li><a href="<?php echo base_url(); ?>register">Create Account </a></li>
                                            <li><a href="<?php echo base_url(); ?>register">Login </a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--Header Top Right Area End-->
                </div>
            </div>
        </div>
        <!--Header Top Area End-->
        <!--Header Middel Area Start-->
        <div class="header-middel-area">
            <div class="container">
                <div class="row">
                    <!--Logo Start-->
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="logo">
                            <a href="<?php echo base_url(); ?>"><img src="<?php echo PROJECT_LOGO ?>" alt="LOGO" title="<?php echo PROJECT_NAME; ?>"></a>
                        </div>
                    </div>
                    <!--Logo End-->
                    <!--Search Box Start-->
                    <div class="col-lg-6 col-md-5 col-12">
                        <div class="search-box-area">

                            <form action="<?php echo base_url(); ?>products" method="post">
                                <div class="select-area">
                                    <select name="select" data-placeholder="Choose a Country..." class="select" tabindex="1">
                                        <option value="">All Categories</option>
                                        <?php foreach ($category->menu_result as $cat) {
                                            $menu_title = preg_replace('/\s+/', '', $cat->menu_title)
                                        ?>
                                            <optgroup label="<?php echo $menu_title; ?>">
                                                <?php foreach ($cat->submenu_list as $sub_res) { ?>
                                                    <option value="<?php echo $sub_res->submenu_id; ?>"><?php echo $sub_res->submenu_title; ?></option>
                                                <?php } ?>
                                            </optgroup>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="search-box">
                                    <input type="text" name="search" id="search" placeholder="" value='Search product...' onblur="if(this.value==''){this.value='Search product...'}" onfocus="if(this.value=='Search product...'){this.value=''}">
                                    <button type="submit"><i class="ion-ios-search-strong"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--Search Box End-->
                    <!--Mini Cart Start-->
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="mini-cart-area">
                            <ul>
                                <!-- <li><a href="#"><i class="ion-android-star"></i></a></li> -->
                                <li><a href="#"><i class="ion-android-cart"></i><span class="cart-add"><?php echo $cartCount; ?></span><span class="cart-total"><?php echo $CartAmount; ?> <i class="fa fa-angle-down"></i></span></a>
                                    <ul class="cart-dropdown <?php echo ($cartCount == 0) ? 'hideClass' : ''; ?>">
                                        <?php

                                        $cartReq = json_decode($cartList);
                                        if ($cartReq->code == 200) {
                                            foreach ($cartReq->cart_result as $cartRes) {
                                                $producLink = base_url() . 'ProdutDetails/' . $cartRes->prod_id; ?>

                                                <!--Single Cart Item Start-->
                                                <li class="cart-item">
                                                    <div class="cart-img">
                                                        <a href="<?php echo $producLink; ?>"><img src="<?php echo $cartRes->product_image; ?>" alt="<?php echo $cartRes->product_image; ?>" title="<?php echo $cartRes->product_image; ?>"></a>
                                                    </div>
                                                    <div class="cart-content">
                                                        <h4><a href="<?php echo $producLink; ?>"><?php echo $cartRes->prod_name; ?></a></h4>
                                                        <p class="cart-quantity">Qty:<?php echo $cartRes->qty; ?></p>
                                                        <p class="cart-price"><?php echo india_price($cartRes->selling_price); ?></p>
                                                    </div>
                                                    <div class="cart-close">
                                                        <a href="javascript:void(0)" onclick="deleteCartItem(<?php echo $cartRes->cart_id; ?>)" title="Remove"><i class="ion-android-close"></i></a>
                                                    </div>
                                                </li>
                                                <!--Single Cart Item Start-->
                                            <?php }
                                        } else { ?>
                                            <li class="cart-item"> No Cart Items found..!
                                            </li> <?php } ?>
                                        <!--Cart Total Start-->
                                        <li class="cart-total-amount mtb-20">
                                            <h4>SubTotal : <span class="pull-right"><?php echo $CartAmount; ?></span></h4>
                                        </li>
                                        <!--Cart Total End-->
                                        <!--Cart Button Start-->
                                        <li class="cart-button">
                                            <a href="<?php echo base_url(); ?>cart" class="button2">View cart</a>
                                            <a href="<?php echo base_url(); ?>checkout" class="button2">Check out</a>
                                        </li>
                                        <!--Cart Button End-->
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--Mini Cart End-->
                </div>
            </div>
        </div>
        <!--Header Middel Area End-->
        <!--Header bottom Area Start-->
        <div class="header-bottom-area header-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--Logo Sticky Start-->
                        <div class="logo-sticky">
                            <a href="<?php echo base_url(); ?>"><img src="<?php echo PROJECT_LOGO; ?>" alt="<?php echo PROJECT_NAME; ?>" title="<?php echo PROJECT_NAME; ?>"></a>
                        </div>
                        <!--Logo Sticky End-->
                        <!--Main Menu Area Start-->
                        <div class="main-menu-area">
                            <nav>
                                <ul class="main-menu">

                                    <li class="new"><a href="#">Categories</a>
                                        <!--Mega Menu Start-->
                                        <ul class="mega-menu">
                                            <?php foreach ($category->menu_result as $cat) {
                                                $menu_title = preg_replace('/\s+/', '', $cat->menu_title);
                                                $subCount = count($cat->submenu_list);
                                                $menuURL = base_url() . 'products/' . strtolower($menu_title) . '/' . base64_encode($cat->menu_id);
                                            ?>
                                                <li>
                                                    <ul>
                                                        <li class="mega-title"><a href="<?php echo $menuURL; ?>"><?php echo $menu_title; ?></a></li>
                                                        <?php if ($subCount > 0) {
                                                            foreach ($cat->submenu_list as $scat) {
                                                                $sub_title = preg_replace('/\s+/', '+', $scat->submenu_title);
                                                                $subLink = base_url() . 'products/' . strtolower($menu_title) . '/' . strtolower($sub_title) . '/' . base64_encode($scat->submenu_id);
                                                        ?>
                                                                <li><a href="<?php echo $subLink; ?>"><?php echo $scat->submenu_title; ?></a></li>
                                                        <?php }
                                                        } ?>
                                                    </ul>
                                                </li>
                                            <?php } ?>


                                        </ul>
                                        <!--Mega Menu End-->
                                    </li>

                                    <li><a href="<?php echo base_url(); ?>about">About US</a></li>
                                    <li><a href="<?php echo base_url(); ?>contact">Contact Us</a></li>
                                    <li><a href="javascript:void(0)">Quick Access</a>
                                        <ul class="dropdown">
                                            <li><a href="<?php echo base_url(); ?>cart">Shopping Cart</a></li>
                                            <li><a href="<?php echo base_url(); ?>profile">Wishlist</a></li>
                                            <li><a href="<?php echo base_url(); ?>checkout">Checkout</a></li>
                                            <li><a href="<?php echo base_url(); ?>login">Login Register</a></li>
                                            <li><a href="<?php echo base_url(); ?>profile">My Account</a></li>
                                            <li><a href="<?php echo base_url(); ?>orders">Orders</a></li>

                                        </ul>
                                    </li>
                                    <li class="hot"><a href="<?php echo base_url(); ?>car-deals"><i class="ion-android-star"></i> Car & Bike Deals</a></li>
                                    <li><a href="<?php echo base_url(); ?>about">Offers & Coupons</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!--Main Menu Area End-->
                    </div>
                </div>
            </div>
        </div>
        <!--Header bottom Area End-->
        <!--Mobile Menu Area Start-->
        <div class="mobile-menu-area d-lg-none d-md-none d-block">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="mobile-menu">
                            <nav>
                                <ul>
                                    <li class="new"><a href="#">Categories</a>
                                        <!--Mega Menu Start-->
                                        <ul>
                                            <?php foreach ($category->menu_result as $cat) {
                                                $menu_title = preg_replace('/\s+/', '', $cat->menu_title);
                                                $subCount = count($cat->submenu_list);
                                                $menuURL = base_url() . 'products/' . strtolower($menu_title) . '/' . base64_encode($cat->menu_id);
                                            ?>
                                                <li class="mega-title"><a href="<?php echo $menuURL; ?>"><?php echo $menu_title; ?></a></li>
                                                <ul>

                                                    <?php if ($subCount > 0) {
                                                        foreach ($cat->submenu_list as $scat) {
                                                            $sub_title = preg_replace('/\s+/', '+', $scat->submenu_title);
                                                            $subLink = base_url() . 'products/' . strtolower($menu_title) . '/' . strtolower($sub_title) . '/' . base64_encode($scat->submenu_id);
                                                    ?>
                                                            <li><a href="<?php echo $subLink; ?>"><?php echo $scat->submenu_title; ?></a></li>
                                                    <?php }
                                                    } ?>
                                                </ul>
                                    </li>
                                <?php } ?>


                                </ul>
                                <!--Mega Menu End-->
                                </li>

                                <li><a href="<?php echo base_url(); ?>about">About US</a></li>
                                <li><a href="<?php echo base_url(); ?>contact">Contact Us</a></li>
                                <li><a href="javascript:void(0)">Quick Access</a>
                                    <ul>
                                        <li><a href="<?php echo base_url(); ?>cart">Shopping Cart</a></li>
                                        <li><a href="<?php echo base_url(); ?>profile">Wishlist</a></li>
                                        <li><a href="<?php echo base_url(); ?>checkout">Checkout</a></li>
                                        <li><a href="<?php echo base_url(); ?>login">Login Register</a></li>
                                        <li><a href="<?php echo base_url(); ?>profile">My Account</a></li>
                                        <li><a href="<?php echo base_url(); ?>orders">Orders</a></li>

                                    </ul>
                                </li>
                                <li class="hot"><a href="<?php echo base_url(); ?>about"><i class="ion-android-star"></i> Car & Bike Deals</a></li>
                                <li><a href="<?php echo base_url(); ?>about">Offers & Coupons</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Mobile Menu Area End-->
    </div>
</header>
<!--Header Area End-->
<script type="text/javascript">
    function deleteCartItem(cartID) {
        alert(cartID);
    }
</script>