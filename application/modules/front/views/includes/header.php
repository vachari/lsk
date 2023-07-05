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

<!--header area start-->
<header class="header_area header_seven">
    <!--header top start-->
    <div class="header_top header_top_seven">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="welcome_text">
                        <p><img src="<?php echo IMG_PATH; ?>mobile.svg" alt="" /> <span>+91 7981186263</span> </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="top_right text-right">
                        <ul>
                            <li class="language">
                                <a href="#">
                                    <i class="zmdi zmdi-dribbble"></i> English <i class="zmdi zmdi-caret-down"></i>
                                </a>
                                <ul class="dropdown_language">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Germany</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li>
                            <?php if ($isUserLoggedIn) { ?>
                                <li class="top_links"><a href="#"><i class="zmdi zmdi-account"></i> My account <i class="zmdi zmdi-caret-down"></i></a>
                                    <ul class="dropdown_links">
                                        <li><a href="<?php echo base_url(); ?>checkout">Checkout </a></li>
                                        <li><a href="<?php echo base_url(); ?>profile">My Account </a></li>
                                        <li><a href="<?php echo base_url(); ?>cart">Shopping Cart</a></li>
                                        <li><a href="<?php echo base_url(); ?>wishlist">Wishlist</a></li>
                                        <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li class="top_links"><a href="#"><i class="zmdi zmdi-account"></i>Signup / Sign IN<i class="zmdi zmdi-caret-down"></i></a>
                                    <ul class="dropdown_links">
                                        <li><a href="<?php echo base_url(); ?>register">Create Account </a></li>
                                        <li><a href="<?php echo base_url(); ?>register">Login </a></li>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--header top start-->
    <!--header center area start-->
    <div class="header_middle header_middle_seven">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="logo">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo IMG_PATH; ?>lsk-logo.svg" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="header_middle_inner">
                        <div class="search-container">
                            <form action="<?php echo base_url(); ?>products" method="post">
                                <div class="hover_category">
                                    <select class="select_option" name="select" id="categori">
                                        <option selected value="1">All Categories</option>
                                        <?php foreach ($category->menu_result as $cat) {
                                            if (!empty($cat->listsubmenu_list)) {
                                                $listsub = $cat->listsubmenu_list;
                                            }
                                            $men_title = preg_replace('/\s+/', '', $cat->menu_title); ?>
                                            <option value="2"><?php echo  $men_title; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="search_box">
                                    <input name="search" placeholder="Search product..." type="text">
                                    <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="mini_cart_wrapper">
                            <a href="javascript:void(0)"><i class="zmdi zmdi-shopping-basket"></i> <span><?php echo $cartCount; ?>items - <?php echo $CartAmount; ?></span> </a>
                            <!--mini cart-->
                            <div class="mini_cart mini_cart_seven">
                                <?php
                                $cartReq = json_decode($cartList);
                                if ($cartReq->code == 200) {
                                    foreach ($cartReq->cart_result as $cartRes) {
                                ?>
                                        <div class="cart_item">
                                            <div class="cart_img">
                                                <a href="#"><img src="<?php echo $cartRes->product_image; ?>" alt=""></a>
                                            </div>
                                            <div class="cart_info">
                                                <a href="#"><?php echo $cartRes->prod_name; ?></a>

                                                <span class="quantity">Qty: <?php echo $cartRes->qty; ?></span>
                                                <span class="price_cart"><?php echo india_price($cartRes->selling_price); ?></span>

                                            </div>
                                            <div class="cart_remove">
                                                <a href="#"><i class="ion-android-close"></i></a>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                                <div class="mini_cart_table">
                                    <div class="cart_total">
                                        <span>Subtotal:</span>
                                        <span class="price"><?php echo $CartAmount; ?></span>
                                    </div>
                                </div>

                                <div class="mini_cart_footer">
                                    <div class="cart_button">
                                        <a href="<?php echo base_url(); ?>cart">View cart</a>
                                        <a href="<?php echo base_url(); ?>checkout">Checkout</a>
                                    </div>
                                </div>

                            </div>
                            <!--mini cart end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header center area end-->

    <!--header middel start-->
    <div class="header_bottom header_bottom_seven">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="categories_menu categori_seven">
                        <div class="categories_title">
                            <h2 class="categori_toggle">Categories</h2>
                        </div>
                        <div class="categories_menu_toggle">
                            <ul>
                                <?php

                                foreach ($category->menu_result as $cat) {
                                    if (!empty($cat->submenu_list)) {
                                        $listsub = $cat->submenu_list;
                                    }
                                    $subCount = count($cat->submenu_list);
                                    $men_title = preg_replace('/\s+/', '', $cat->menu_title);
                                ?>
                                    <li class="menu_item_children categorie_list"><a href="<?php echo base_url() . 'products/' . strtolower($men_title) . '/' . base64_encode($cat->menu_id); ?>"><span><img src="<?php echo $cat->icon; ?>" /></span> <?php echo $men_title; ?>
                                            <?php if ($subCount > 0) { ?>
                                                <i class="fa fa-angle-right"></i>
                                            <?php } ?>
                                        </a>
                                        <?php if ($subCount > 0) { ?>
                                            <ul class="categories_mega_menu">
                                                <?php foreach ($cat->submenu_list as $scat) {
                                                    $sub_title = preg_replace('/\s+/', '+', $scat->submenu_title);
                                                ?>
                                                    <li class="menu_item_children"><a href="<?php echo base_url() . 'products/' . strtolower($men_title) . '/' . strtolower($sub_title) . '/' . base64_encode($scat->submenu_id); ?>"><?php echo $scat->submenu_title; ?></a>
                                                        <!-- <ul class="categorie_sub_menu">
                                                            <li><a href="#">Bower</a></li>
                                                            <li><a href="#">Flipbac</a></li>
                                                            <li><a href="#">Gary Fong</a></li>
                                                            <li><a href="#">GigaPan</a></li>
                                                        </ul> -->
                                                    </li>
                                                <?php } ?>

                                            </ul>
                                        <?php } ?>
                                    </li>

                                <?php } ?>

                                <li><a href="#" id="more-btn"><i class="fa fa-plus" aria-hidden="true"></i> More Categories</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="main_menu menu_seven header_position">
                        <nav>
                            <ul>
                                <li class="active">
                                    <a href="<?php echo base_url(); ?>"><i class="zmdi zmdi-home"></i> home </a>
                                </li>
                                <li class="mega_items"><a href="shop.html"><i class="zmdi zmdi-shopping-basket"></i> shop <i class="zmdi zmdi-caret-down"></i></a>
                                    <div class="mega_menu">
                                        <ul class="mega_menu_inner">
                                            <li><a href="#">other Pages</a>
                                                <ul>
                                                    <li><a href="<?php echo base_url(); ?>cart">cart</a></li>
                                                    <li><a href="<?php echo base_url(); ?>wishlist">Wishlist</a></li>
                                                    <li><a href="<?php echo base_url(); ?>checkout">Checkout</a></li>
                                                    <li><a href="<?php echo base_url(); ?>profile">my account</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="<?php echo base_url(); ?>about"><i class="zmdi zmdi-comments"></i> about Us</a></li>
                                <li><a href="<?php echo base_url(); ?>contact"><i class="zmdi zmdi-account-box-mail"></i> Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header middel end-->

</header>
<!--header area end-->