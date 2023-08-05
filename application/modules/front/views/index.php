<?php $this->load->view('includes/header_css'); ?>
<?php
$category = json_decode($menuList);
?>

<body>
    <!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

    <div class="wrapper home-2">
        <?php $this->load->view('includes/header'); ?>
        <!--Slider Area Start-->
        <section class="slider-area ptb-30 white-bg">
            <div class="container">
                <div class="row">
                    <!--Categories Menu Start-->
                    <div class="col-lg-3 col-md-3">
                        <div class="side-menu">
                            <div class="category-heading">
                                <h2><i class="ion-android-menu"></i><span>categories</span></h2>
                            </div>
                            <div id="cate-toggle" class="category-menu-list">
                                <ul>
                                    <?php foreach ($category->menu_result as $cat) {
                                        $menu_title = preg_replace('/\s+/', '', $cat->menu_title);
                                        $subCount = count($cat->submenu_list);
                                        $menuURL = base_url() . 'products/' . strtolower($menu_title) . '/' . base64_encode($cat->menu_id);
                                    ?>
                                        <li class="<?php echo ($subCount > 0) ? 'right-menu' : '' ?>"><a href="<?php echo  $menuURL; ?>"><?php echo $menu_title; ?></a>
                                            <ul class="cat-mega-menu">
                                                <?php if ($subCount > 0) {
                                                    foreach ($cat->submenu_list as $scat) {
                                                        $sub_title = preg_replace('/\s+/', '+', $scat->submenu_title);
                                                        $subLink = base_url() . 'products/' . strtolower($menu_title) . '/' . strtolower($sub_title) . '/' . base64_encode($scat->submenu_id);

                                                ?>
                                                        <li class="right-menu cat-mega-title">
                                                            <a href="<?php echo $subLink; ?>"><?php echo $scat->submenu_title; ?></a>
                                                            <!-- <ul>
                                                                <li><a href="shop.html">LCD TV</a></li>
                                                                <li><a href="shop.html">LED TV</a></li>
                                                                <li><a href="shop.html">Curved TV</a></li>
                                                                <li><a href="shop.html">Plasma TV</a></li>
                                                            </ul> -->
                                                        </li>
                                                <?php }
                                                } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>





                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--Categories Menu End-->
                    <!--Slider Start-->
                    <div class="col-lg-9 col-md-9">
                        <div class="slider-wrapper theme-default">
                            <!--Slider Background Image Start-->
                            <div id="slider" class="nivoSlider">
                                <?php
                                $sliderNo = 1;
                                $sliderReq = $slider;
                                foreach ($slider as $slider) {

                                ?>
                                    <img src="<?php echo SLIDER_IMG_PATH; ?>/<?php echo $slider->slider_image; ?>" alt="" title="#htmlcaption<?php echo $slider->id; ?>" />
                                <?php $sliderNo++;
                                } ?>
                            </div>
                            <!--Slider Background Image End-->
                            <?php foreach ($sliderReq as $sl_res) { ?>
                                <div id="htmlcaption<?php echo $sl_res->id; ?>" class="nivo-html-caption">
                                    <div class="slider-caption">
                                        <div class="slider-text">
                                            <!-- <h5 class="wow animated fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s"><?php echo $sl_res->slider_title; ?></h5> -->
                                            <h1 class="wow animated fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s"><?php echo $sl_res->slider_title; ?></h1>
                                            <!-- <h4 class="wow animated fadeInLeft" data-wow-duration="1.5s" data-wow-delay="0.5s">Starting at <span>$560.99</span></h4> -->
                                            <div class="slider-button">
                                                <a href="<?php echo $sl_res->slider_url; ?>" class="wow button sec-slide animated fadeInLeft" data-text="Shop now" data-wow-duration="2.5s" data-wow-delay="0.5s">shopping Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php  } ?>
                        </div>
                    </div>
                    <!--Slider End-->
                </div>
            </div>
        </section>
        <!--Slider Area End-->
        <!--Corporate About Start-->
        <section class="corporate-about white-bg pb-30">
            <div class="container">
                <div class="row all-about no-gutters">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-about">
                            <div class="block-wrapper">
                                <div class="about-content">
                                    <h5>Free Delivery</h5>
                                    <p>Free shipping on all order</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-about">
                            <div class="block-wrapper2">
                                <div class="about-content">
                                    <h5>Free Delivery</h5>
                                    <p>Free shipping on all order</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-about">
                            <div class="block-wrapper3">
                                <div class="about-content">
                                    <h5>Free Delivery</h5>
                                    <p>Free shipping on all order</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-about not-border">
                            <div class="block-wrapper4">
                                <div class="about-content">
                                    <h5>Free Delivery</h5>
                                    <p>Free shipping on all order</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Corporate About End-->
        <!--All Product Area Start-->
        <section class="all-product-area pt-100">
            <div class="container">
                <div class="row">
                    <!--Right Side Product Start-->
                    <div class="col-lg-3 col-md-3">
                        <!--Hot Deal Product Start-->
                        <div class="right-side-product pb-50">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hot-deal-product">
                                        <!--Section Title2 Start-->
                                        <div class="section-title2">
                                            <h3>Hot deals</h3>
                                        </div>
                                        <!--Section Title2 End-->
                                        <!--Hot Deal Single Product Start-->
                                        <?php
                                        $hotDealsReq = json_decode($feature_products);
                                        if ($hotDealsReq->code  == 200) {
                                        ?>
                                            <div class="hot-del-single-product">
                                                <div class="row slide-active-home-2">
                                                    <!--Single Product Start-->
                                                    <?php foreach ($hotDealsReq->result as $hd_res) {

                                                        $prodLink = base_url() . 'productDetails/' . $hd_res->id;
                                                    ?>
                                                        <div class="col-lg-12">
                                                            <div class="single-product hot-deal">
                                                                <div class="product-img">
                                                                    <a href="single-product.html">
                                                                        <img class="first-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $hd_res->prod_image; ?>" alt="<?php echo ucfirst($hd_res->prod_name); ?>" title="<?php echo ucfirst($hd_res->prod_name); ?>">
                                                                        <img class="hover-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $hd_res->prod_image; ?>" alt="<?php echo ucfirst($hd_res->prod_name); ?>" title="<?php echo ucfirst($hd_res->prod_name); ?>">
                                                                    </a>
                                                                    <span class="sicker">15%</span>
                                                                    <ul class="product-action">
                                                                        <li><a href="#" data-toggle="tooltip" title="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li>
                                                                        <li><a href="#" data-toggle="tooltip" title="Compare"><i class="ion-ios-shuffle-strong"></i></a></li>
                                                                        <li><a href="#" data-toggle="modal" title="Quick View" data-target="#myModal"><i class="ion-android-expand"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-content">
                                                                    <div class="count-down-box">
                                                                        <div class="count-box">
                                                                            <div class="pro-countdown" data-countdown="<?php echo date('Y/m/d 23:59'); ?>"></div>
                                                                        </div>
                                                                    </div>
                                                                    <h2><a href="<?php echo $prodLink; ?>"><?php echo ucfirst(substr($hd_res->prod_name, 0, 20)) ?></a></h2>
                                                                    <div class="pro-rating-price">
                                                                        <div class="rating">
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                        <div class="product-price">

                                                                            <span class=""><?php echo india_price($hd_res->selling_price); ?></span>
                                                                            <span class="old-price"><?php echo india_price($hd_res->mrp); ?></span>
                                                                            <a class="button add-btn big" href="#" data-toggle="tooltip" title="Add to Cart">add to cart</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--Single Product End-->
                                                    <?php  } ?>

                                                </div>
                                            </div>
                                        <?php } ?>
                                        <!--Hot Deal Single Product Start-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Hot Deal Product End-->
                        <!--Offer Image Start-->
                        <div class="offer-img-area pb-50">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="single-offer mb-20">
                                        <div class="offer-img img-full">
                                            <a href="#"><img src="<?php echo IMG_PATH; ?>dynamic_banners/CAR_BIKE.JPG" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="single-offer mb-20">
                                        <div class="offer-img img-full">
                                            <a href="#"><img src="<?php echo IMG_PATH; ?>dynamic_banners/BIKE.JPG" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="single-offer">
                                        <div class="offer-img img-full">
                                            <a href="#"><img src="<?php echo IMG_PATH; ?>dynamic_banners/lSK_BIKES.JPG" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Offer Image End-->
                        <!--New arrivals Product Start-->
                        <div class="new-arrivals-product mb-50">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="new-arrivals-product-title">
                                        <!--Section Title2 Start-->
                                        <div class="section-title2">
                                            <h3>New arrivals</h3>
                                        </div>
                                        <!--Section Title2 End-->
                                        <!--Hot Deal Single Product Start-->
                                        <?php
                                        $newArrivalReq = json_decode($newarrival_products);
                                        if ($newArrivalReq->code  == 200) {
                                        ?>
                                            <div class="hot-del-single-product">
                                                <div class="row slide-active2">
                                                    <?php foreach ($hotDealsReq->result as $hd_res) {

                                                        $prodLink = base_url() . 'productDetails/' . $hd_res->id;
                                                    ?>
                                                        <!--Single Product Start-->
                                                        <div class="col-lg-12">
                                                            <div class="row no-gutters single-product style-2 list">
                                                                <div class="col-4">
                                                                    <div class="product-img">
                                                                        <a href="<?php echo $prodLink; ?>">
                                                                            <img class="first-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $hd_res->prod_image; ?>" alt="">
                                                                            <img class="hover-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $hd_res->prod_image; ?>" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="product-content">
                                                                        <h2><a href="<?php echo $prodLink; ?>"><?php echo ucfirst(substr($hd_res->prod_name, 0, 20)) ?></a></h2>
                                                                        <div class="rating">
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                        <div class="product-price">

                                                                            <span class="old-price"><?php echo india_price($hd_res->mrp); ?></span>
                                                                            <span class="new-price"><?php echo india_price($hd_res->selling_price); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--Single Product End-->
                                                    <?php  } ?>

                                                </div>
                                            </div>
                                            <!--Hot Deal Single Product Start-->
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--New arrivals Product End-->
                        <!--Right Side Our Blog Start-->
                        <div class="right-side-our-blog">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="right-side-Our-blog-title">
                                        <!--Section Title2 Start-->
                                        <div class="section-title2">
                                            <h3>our blog</h3>
                                        </div>
                                        <!--Section Title2 End-->
                                        <!--Our Blog Start-->
                                        <div class="our-blog">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="our-blog-active owl-carousel">
                                                        <!--Our Single Blog Start-->
                                                        <div class="our-single-blog">
                                                            <div class="our-blog-img img-full">
                                                                <a href="blog-post-img.html">
                                                                    <img src="<?php echo IMG_PATH; ?>blog/1.jpg" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="our-blog-content mt-15">
                                                                <h3><a href="blog-post-img.html">Blog image post</a></h3>
                                                                <span class="our-blog-author">By <a href="blog-author.html">admin</a></span>
                                                                <div class="our-blog-des mb-20">
                                                                    <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean</p>
                                                                </div>
                                                            </div>
                                                            <div class="blog-meta">
                                                                <span class="post-comment"><i class="ion-clipboard"></i>3 comments</span>
                                                                <span class="blog-post-date pull-right">10 Mar 2015</span>
                                                            </div>
                                                        </div>
                                                        <!--Our Single Blog Start-->
                                                        <!--Our Single Blog Start-->
                                                        <div class="our-single-blog">
                                                            <div class="our-blog-img img-full">
                                                                <a href="blog-post-gallery.html">
                                                                    <img src="<?php echo IMG_PATH; ?>blog/2.jpg" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="our-blog-content mt-15">
                                                                <h3><a href="blog-post-gallery.html">Post with Gallery</a></h3>
                                                                <span class="our-blog-author">By <a href="blog-author.html">admin</a></span>
                                                                <div class="our-blog-des mb-20">
                                                                    <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean</p>
                                                                </div>
                                                            </div>
                                                            <div class="blog-meta">
                                                                <span class="post-comment"><i class="ion-clipboard"></i>3 comments</span>
                                                                <span class="blog-post-date pull-right">10 Mar 2015</span>
                                                            </div>
                                                        </div>
                                                        <!--Our Single Blog Start-->
                                                        <!--Our Single Blog Start-->
                                                        <div class="our-single-blog">
                                                            <div class="our-blog-img img-full">
                                                                <a href="blog-post-audio.html">
                                                                    <img src="<?php echo IMG_PATH; ?>blog/3.jpg" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="our-blog-content mt-15">
                                                                <h3><a href="blog-post-audio.html">Post with Audio</a></h3>
                                                                <span class="our-blog-author">By <a href="blog-author.html">admin</a></span>
                                                                <div class="our-blog-des mb-20">
                                                                    <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean</p>
                                                                </div>
                                                            </div>
                                                            <div class="blog-meta">
                                                                <span class="post-comment"><i class="ion-clipboard"></i>3 comments</span>
                                                                <span class="blog-post-date pull-right">10 Mar 2015</span>
                                                            </div>
                                                        </div>
                                                        <!--Our Single Blog Start-->
                                                        <!--Our Single Blog Start-->
                                                        <div class="our-single-blog">
                                                            <div class="our-blog-img img-full">
                                                                <a href="blog-post-video.html">
                                                                    <img src="<?php echo IMG_PATH; ?>blog/4.jpg" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="our-blog-content mt-15">
                                                                <h3><a href="blog-post-video.html">Post with Video</a></h3>
                                                                <span class="our-blog-author">By <a href="blog-author.html">admin</a></span>
                                                                <div class="our-blog-des mb-20">
                                                                    <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean</p>
                                                                </div>
                                                            </div>
                                                            <div class="blog-meta">
                                                                <span class="post-comment"><i class="ion-clipboard"></i>3 comments</span>
                                                                <span class="blog-post-date pull-right">10 Mar 2015</span>
                                                            </div>
                                                        </div>
                                                        <!--Our Single Blog Start-->
                                                        <!--Our Single Blog Start-->
                                                        <div class="our-single-blog">
                                                            <div class="our-blog-img img-full">
                                                                <a href="blog-maecenas-ultricies.html">
                                                                    <img src="<?php echo IMG_PATH; ?>blog/5.jpg" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="our-blog-content mt-15">
                                                                <h3><a href="blog-maecenas-ultricies.html">Maecenas ultricies</a></h3>
                                                                <span class="our-blog-author">By <a href="blog-author.html">admin</a></span>
                                                                <div class="our-blog-des mb-20">
                                                                    <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean</p>
                                                                </div>
                                                            </div>
                                                            <div class="blog-meta">
                                                                <span class="post-comment"><i class="ion-clipboard"></i>3 comments</span>
                                                                <span class="blog-post-date pull-right">10 Mar 2015</span>
                                                            </div>
                                                        </div>
                                                        <!--Our Single Blog Start-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Our Blog End-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Right Side Our Blog End-->
                    </div>
                    <!--Right Side Product End-->
                    <!--Left Side Product Start-->
                    <div class="col-lg-9 col-md-9">
                        <!--Desktop & Television Product Start-->
                        <?php
                        $allCatProdReq = json_decode($categoryBasedProducts);
                        if ($allCatProdReq->code == SUCCESS_CODE) {
                            $csno = 0;
                            foreach ($allCatProdReq->menu_result as $cpRes) {

                                $menu_title = preg_replace('/\s+/', '', $cpRes->menu_title);
                                $menuLink = base_url() . 'products/' . strtolower($menu_title) . '/' . base64_encode($cpRes->menu_id);
                        ?>
                                <div class="desktop-television-product <?php echo ($csno > 0) ? 'pt-100' : '' ?>">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!--Section Title1 Start-->
                                            <div class="section-title1-border">
                                                <div class="section-title1">
                                                    <h3><?php echo $cpRes->menu_title; ?></h3>
                                                </div>
                                            </div>
                                            <!--Section Title1 End-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!--Product Tab Menu Start-->
                                            <div class="product-tab-menu-area">
                                                <div class="product-tab">
                                                    <ul class="nav">
                                                        <?php if (count($cpRes->submenu_list) > 0) {
                                                            $subSno = 0;
                                                            foreach ($cpRes->submenu_list as $subRes) {
                                                                $sub_title = preg_replace('/\s+/', '+', $subRes->submenu_title);
                                                                $subLink = base_url() . 'products/' . strtolower($menu_title) . '/' . strtolower($sub_title) . '/' . base64_encode($subRes->submenu_id);
                                                        ?>
                                                                <li><a class="<?php echo ($subSno == 0) ? 'active' : '' ?>" data-toggle="tab" href="<?php echo $subLink; ?>"><?php echo $subRes->submenu_title; ?></a></li>
                                                        <?php  }
                                                        } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--Product Tab Menu End-->
                                        </div>
                                    </div>
                                    <!--Product Tab Start-->
                                    <div class="tab-content">
                                        <div id="amply" class="tab-pane fade show active">
                                            <div class="row">
                                                <div class="all-product mb-90  owl-carousel">
                                                    <?php

                                                    if (count($cpRes->product_list) > 0) {
                                                        $subSno = 0;
                                                        foreach ($cpRes->product_list as $prodRes) {
                                                    ?>
                                                            <!--Single Product Start-->
                                                            <div class="col-lg-12 item-col">
                                                                <div class="single-product">
                                                                    <div class="product-img">
                                                                        <a href="<?php echo $prodRes->productLink; ?>">
                                                                            <img class="first-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $prodRes->prod_image; ?>" alt="<?php echo $prodRes->prod_name; ?>" title="<?php echo $prodRes->prod_name; ?>">
                                                                            <img class="hover-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $prodRes->prod_image; ?>" alt="<?php echo $prodRes->prod_name; ?>" title="<?php echo $prodRes->prod_name; ?>">
                                                                        </a>
                                                                        <span class="sicker"><?php echo $prodRes->offer_price; ?>%</span>
                                                                        <ul class="product-action">
                                                                            <li class="wishlist" data-id="<?php echo $prodRes->id; ?>"><a href="javascript:void(0)" data-toggle="tooltip" title="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li>
                                                                            <li class="add_to_cart" data-id="<?php echo $prodRes->id; ?>"><a href="javascript:void(0)" data-toggle="tooltip" title="Compare"><i class="ion-ios-shuffle-strong"></i></a></li>

                                                                        </ul>
                                                                    </div>
                                                                    <div class="product-content">
                                                                        <h2><a href="<?php echo $prodRes->productLink; ?>"><?php echo $prodRes->prod_name; ?></a></h2>
                                                                        <div class="rating">
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                        <div class="product-price">
                                                                            <span class="old-price"><?php echo india_price($prodRes->mrp); ?></span>
                                                                            <span class="new-price"><?php echo india_price($prodRes->mrp); ?></span>
                                                                            <a class="button add-btn add_to_cart" data-id="<?php echo $prodRes->id; ?>" href="javascript:void(0)" data-toggle="tooltip" title="Add to Cart">add to cart</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--Single Product End-->
                                                    <?php }
                                                    } ?>





                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <!--Product Tab End-->
                                    <!--Offer Image Start-->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="single-offer">
                                                <div class="offer-img img-full">
                                                    <a href="#"><img src="<?php echo IMG_PATH; ?>offer/3.jpg" alt=""></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Offer Image End-->
                                </div>
                        <?php $csno++;
                            }
                        } ?>
                        <!--Desktop & Television Product End-->


                        <!--Bestseller Product Start-->
                        <div class="bestseller-product pt-100 pb-85">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!--Section Title1 Start-->
                                    <div class="section-title1-border">
                                        <div class="section-title1">
                                            <h3>bestseller</h3>
                                        </div>
                                    </div>
                                    <!--Section Title1 End-->
                                </div>
                            </div>
                            <!--Best Sell Product Start-->
                            <div class="best-sell-product">
                                <div class="row">
                                    <div class="all-list-product
                                        owl-carousel">
                                        <div class="group">
                                            <!--Single Product Start-->
                                            <?php
                                            $bsestSellerReq = json_decode($bestseller_products);
                                            if ($bsestSellerReq->code  == 200) {
                                                foreach ($bsestSellerReq->result as $bs_res) {

                                                    $prodLink = base_url() . 'productDetails/' . $bs_res->id;
                                            ?>
                                                    <div class="col-lg-12">
                                                        <div class="row no-gutters single-product style-2">
                                                            <div class="col-4">
                                                                <div class="product-img">
                                                                    <a href="single-product.html">
                                                                        <img class="first-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $bs_res->prod_image; ?>" alt="">
                                                                        <img class="hover-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $bs_res->prod_image; ?>" alt="">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="product-content">
                                                                    <h2><a href="<?php echo $prodLink; ?>"><?php echo $bs_res->prod_name; ?></a></h2>
                                                                    <div class="rating">
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star-o"></i>
                                                                    </div>
                                                                    <div class="product-price">
                                                                        <span class="old-price"><?php echo india_price($bs_res->mrp); ?></span>
                                                                        <span class="old-price"><?php echo india_price($bs_res->selling_price); ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php }
                                            } ?>
                                            <!--Single Product End-->

                                        </div>




                                    </div>
                                </div>
                            </div>
                            <!--Best Sell Product End-->
                        </div>
                        <!--Bestseller Product End-->
                    </div>
                    <!--Left Side Product End-->
                </div>
            </div>
        </section>
        <!--All Product Area End-->
        <!--Offer Image Area Start-->
        <div class="offer-img-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="single-offer">
                            <div class="offer-img img-full">
                                <a href="#"><img src="<?php echo IMG_PATH; ?>offer/6.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="single-offer">
                            <div class="offer-img img-full">
                                <a href="#"><img src="<?php echo IMG_PATH; ?>offer/7.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Offer Image Area End-->
        <!--Hot Categories Area Start-->
        <Section class="hot-categories-area pt-100 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--Section Title1 Start-->
                        <div class="section-title1-border">
                            <div class="section-title1">
                                <h3>HOT CATEGORIES</h3>
                            </div>
                        </div>
                        <!--Section Title1 End-->
                    </div>
                </div>
                <!--Hot Categories Start-->
                <div class="row hot-categories">
                    <?php
                    $allCatProdReq = json_decode($categoryBasedProducts);
                    if ($allCatProdReq->code == SUCCESS_CODE) {
                        foreach ($allCatProdReq->menu_result as $cpRes) {

                            $menu_title = preg_replace('/\s+/', '', $cpRes->menu_title);
                            $menuLink = base_url() . 'products/' . strtolower($menu_title) . '/' . base64_encode($cpRes->menu_id);
                    ?>
                            <!--Single Categories Start-->
                            <div class="col-lg-3 col-md-6">
                                <div class="single-categories">
                                    <div class="categories-img img-full">
                                        <a href="<?php echo $menuLink; ?>"><img src=" <?php echo $cpRes->icon; ?>" style="height: 135px; width:270px;" alt="<?php echo $cpRes->menu_title; ?>" title="<?php echo $cpRes->menu_title; ?>"></a>
                                    </div>
                                    <div class="categories-content">
                                        <h3><a href="<?php echo $menuLink; ?>"><?php echo $cpRes->menu_title; ?></a></h3>
                                        <ul class="catgories-list">
                                            <?php if (count($cpRes->submenu_list) > 0) {
                                                $subSno = 0;
                                                foreach ($cpRes->submenu_list as $subRes) {
                                                    $sub_title = preg_replace('/\s+/', '+', $subRes->submenu_title);
                                                    $subLink = base_url() . 'products/' . strtolower($menu_title) . '/' . strtolower($sub_title) . '/' . base64_encode($subRes->submenu_id);
                                            ?>
                                                    <li><a href="<?php echo $subLink; ?>"><?php echo $subRes->submenu_title; ?></a></li>
                                            <?php  }
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--Single Categories End-->
                    <?php }
                    } ?>

                </div>
                <!--Hot Categories End-->
            </div>
        </Section>
        <!--Hot Categories Area End-->
        <!--All Slide Product Area Start-->
        <section class="all-slide-product pt-100 white-bg">
            <div class="container">
                <div class="row">
                    <!--Single Slide Product Start-->
                    <div class="col-lg-4 col-md-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <!--Section Title2 Start-->
                                <div class="section-title2">
                                    <h3>Special Products</h3>
                                </div>
                                <!--Section Title2 End-->
                            </div>
                        </div>
                        <!--Special Single Product Start-->
                        <div class="hot-del-single-product">
                            <div class="row">
                                <div class="slide-active3">
                                    <!--Single Product Start-->
                                    <?php
                                    $specialReq = json_decode($bestseller_products);
                                    if ($specialReq->code  == 200) {
                                        foreach ($specialReq->result as $bs_res) {

                                            $prodLink = base_url() . 'productDetails/' . $bs_res->id;
                                    ?>
                                            <div class="col-md-12">
                                                <div class="row no-gutters single-product style-2 list">
                                                    <div class="col-4">
                                                        <div class="product-img">
                                                            <a href="<?php echo $prodLink; ?>">
                                                                <img class="first-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $bs_res->prod_image; ?>" alt="">
                                                                <img class="hover-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $bs_res->prod_image; ?>" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="product-content">
                                                            <h2><a href="<?php echo $prodLink; ?>"><?php echo $bs_res->prod_name; ?></a></h2>
                                                            <div class="rating">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </div>
                                                            <div class="product-price">
                                                                <span class="old-price"><?php echo india_price($bs_res->mrp); ?></span>
                                                                <span class="new-price"><?php echo india_price($bs_res->selling_price); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                    <!--Single Product End-->





                                </div>
                            </div>
                        </div>
                        <!--Special Single Product Start-->
                    </div>
                    <!--Single Slide Product Start-->
                    <!--Single Slide Product Start-->
                    <div class="col-lg-4 col-md-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <!--Section Title2 Start-->
                                <div class="section-title2">
                                    <h3>New arrivals</h3>
                                </div>
                                <!--Section Title2 End-->
                            </div>
                        </div>
                        <!--New Arrivals Single Product Start-->
                        <div class="hot-del-single-product">
                            <div class="row">
                                <div class="slide-active3">
                                    <!--Single Product Start-->
                                    <?php
                                    $specialReq = json_decode($bestseller_products);
                                    if ($specialReq->code  == 200) {
                                        foreach ($specialReq->result as $bs_res) {

                                            $prodLink = base_url() . 'productDetails/' . $bs_res->id;
                                    ?>
                                            <div class="col-md-12">
                                                <div class="row no-gutters single-product style-2 list">
                                                    <div class="col-4">
                                                        <div class="product-img">
                                                            <a href="<?php echo $prodLink; ?>">
                                                                <img class="first-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $bs_res->prod_image; ?>" alt="">
                                                                <img class="hover-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $bs_res->prod_image; ?>" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="product-content">
                                                            <h2><a href="<?php echo $prodLink; ?>"><?php echo $bs_res->prod_name; ?></a></h2>
                                                            <div class="rating">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </div>
                                                            <div class="product-price">
                                                                <span class="old-price"><?php echo india_price($bs_res->mrp); ?></span>
                                                                <span class="new-price"><?php echo india_price($bs_res->selling_price); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                    <!--Single Product End-->

                                </div>
                            </div>
                        </div>
                        <!--New Arrivals Single Product Start-->
                    </div>
                    <!--Single Slide Product Start-->
                    <!--Single Slide Product Start-->
                    <div class="col-lg-4 col-md-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <!--Section Title2 Start-->
                                <div class="section-title2">
                                    <h3>On Sale</h3>
                                </div>
                                <!--Section Title2 End-->
                            </div>
                        </div>
                        <!--On Sale Single Product Start-->
                        <div class="hot-del-single-product">
                            <div class="row">
                                <div class="slide-active3">
                                    <!--Single Product Start-->
                                    <?php
                                    $specialReq = json_decode($bestseller_products);
                                    if ($specialReq->code  == 200) {
                                        foreach ($specialReq->result as $bs_res) {

                                            $prodLink = base_url() . 'productDetails/' . $bs_res->id;
                                    ?>
                                            <div class="col-md-12">
                                                <div class="row no-gutters single-product style-2 list">
                                                    <div class="col-4">
                                                        <div class="product-img">
                                                            <a href="<?php echo $prodLink; ?>">
                                                                <img class="first-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $bs_res->prod_image; ?>" alt="">
                                                                <img class="hover-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $bs_res->prod_image; ?>" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="product-content">
                                                            <h2><a href="<?php echo $prodLink; ?>"><?php echo $bs_res->prod_name; ?></a></h2>
                                                            <div class="rating">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </div>
                                                            <div class="product-price">
                                                                <span class="old-price"><?php echo india_price($bs_res->mrp); ?></span>
                                                                <span class="new-price"><?php echo india_price($bs_res->selling_price); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                    <!--Single Product End-->


                                </div>
                            </div>
                        </div>
                        <!--On Sale Single Product Start-->
                    </div>
                    <!--Single Slide Product Start-->
                </div>
            </div>
        </section>
        <!--All Slide Product Area End-->
        <!--Brand Area Start-->
        <div class="brand-area ptb-30 white-bg" style="display: none;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="brand-active owl-carousel">
                            <!--Single Brand Start-->
                            <div class="single-brand img-full">
                                <a href="#"><img src="<?php echo IMG_PATH; ?>brand/1.png" alt=""></a>
                            </div>
                            <!--Single Brand End-->
                            <!--Single Brand Start-->
                            <div class="single-brand img-full">
                                <a href="#"><img src="<?php echo IMG_PATH; ?>brand/2.png" alt=""></a>
                            </div>
                            <!--Single Brand End-->
                            <!--Single Brand Start-->
                            <div class="single-brand img-full">
                                <a href="#"><img src="<?php echo IMG_PATH; ?>brand/3.png" alt=""></a>
                            </div>
                            <!--Single Brand End-->
                            <!--Single Brand Start-->
                            <div class="single-brand img-full">
                                <a href="#"><img src="<?php echo IMG_PATH; ?>brand/4.png" alt=""></a>
                            </div>
                            <!--Single Brand End-->
                            <!--Single Brand Start-->
                            <div class="single-brand img-full">
                                <a href="#"><img src="<?php echo IMG_PATH; ?>brand/5.png" alt=""></a>
                            </div>
                            <!--Single Brand End-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Brand Area End-->
        <!--Footer Area Start-->
        <?php $this->load->view('includes/footer'); ?>
        <!--Footer Area End-->

    </div>



    <!--All Js Here-->


</body>
<script type="text/javascript" src="<?php echo JS_PATH; ?>commoncart.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".add_to_cart").click(function() {
            var _this = $(this);
            addToCart($(this).attr('data-id'));

        });
        $('.wishlist').click(function() {
            var _this = $(this);
            addWishList($(this).attr('data-id'));
        })
    });
</script>

</html>