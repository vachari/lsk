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
    <div class="heading-banner-area pt-30">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="heading-banner">
              <div class="breadcrumbs">
                <ul>
                  <li><a href="index.html">Home</a><span class="breadcome-separator">></span></li>
                  <li>Shop</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Heading Banner Area End-->
    <!--Product List Grid View Area Start-->
    <div class="product-list-grid-view-area mt-20">
      <div class="container">
        <div class="row">
          <!--Shop Product Area Start-->
          <div class="col-lg-9 order-lg-2 order-1">
            <div class="shop-desc-container">
              <div class="row">
                <!--Shop Product Image Start-->
                <div class="col-lg-12">
                  <div class="shop-product-img mb-30 img-full">
                    <img src="<?php echo IMG_PATH; ?>offer/11.jpg" alt="">
                  </div>
                </div>
                <!--Shop Product Image Start-->
              </div>
            </div>
            <!--Shop Tab Menu Start-->
            <?php
            $pro = json_decode($products);

            $recordsCount = count($pro->result);

            ?>
            <div class="shop-tab-menu">
              <div class="row">
                <!--List & Grid View Menu Start-->
                <div class="col-lg-5 col-md-5 col-xl-6 col-12">
                  <div class="shop-tab">
                    <ul class="nav">
                      <li><a class="active" data-toggle="tab" href="#grid-view"><i class="ion-android-apps"></i></a></li>
                      <li><a data-toggle="tab" href="#list-view"><i class="ion-navicon-round"></i></a></li>
                    </ul>
                  </div>
                </div>
                <!--List & Grid View Menu End-->
                <!-- View Mode Start-->
                <div class="col-lg-7 col-md-7 col-xl-6 col-12">
                  <div class="toolbar-form">
                    <form action="#">
                      <div class="toolbar-select">
                        <span>Short by:</span>
                        <select data-placeholder="Choose a Country..." class="order-by" tabindex="1">
                          <option value="Default sorting">Default sorting</option>
                          <option value="United States">United States</option>
                          <option value="United Kingdom">United Kingdom</option>
                          <option value="Afghanistan">Afghanistan</option>
                          <option value="Aland Islands">Aland Islands</option>
                          <option value="Albania">Albania</option>
                          <option value="Algeria">Algeria</option>
                        </select>
                      </div>
                    </form>
                  </div>
                  <div class="show-result">
                    <p>Showing 1–16 of <?php echo $recordsCount; ?> results</p>
                  </div>
                </div>
                <!-- View Mode End-->
              </div>
            </div>
            <!--Shop Tab Menu End-->
            <!--Shop Product Area Start-->

            <div class="shop-product-area">
              <div class="tab-content">
                <!--Grid View Start-->
                <div id="grid-view" class="tab-pane fade show active">
                  <div class="row product-container">
                    <!--Single Product Start-->
                    <?php
                    if ($pro->code == 200) {
                      foreach ($pro->result as $fpro) {
                        $productLink = base_url() . 'productDetails/' . $fpro->id;
                    ?>
                        <div class="col-lg-3 col-md-3 item-col2">
                          <div class="single-product">
                            <div class="product-img">
                              <a href="<?php echo $productLink; ?>">
                                <img class="first-img" src="<?php echo base_url() . 'uploads/products/' . $fpro->prod_image; ?>" alt="">
                                <img class="hover-img" src="<?php echo base_url() . 'uploads/products/' . $fpro->prod_image; ?>" alt="">
                              </a>
                              <ul class="product-action">
                                <li class="wishlist" data-id="<?php echo $fpro->id; ?>"><a href="javascript:void(0)" data-toggle="tooltip" title="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li>
                                <li class="add_to_cart" data-id="<?php echo $fpro->id; ?>"><a href="javascript:void(0)" data-toggle="tooltip" title="Add to cart"><i class="ion-android-cart"></i></a></li>

                              </ul>
                            </div>
                            <div class="product-content">
                              <h2><a href="<?php echo $productLink; ?>"><?php echo (strlen($fpro->prod_name) > 22) ? substr($fpro->prod_name, 0, 20) . '...' : $fpro->prod_name; ?></a></h2>
                              <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                              </div>
                              <div class="product-price">
                                <span class="new-price"><?php echo india_price($fpro->selling_price); ?></span>
                                <a class="button add-btn" href="javascript:void(0)" class="add_to_cart" data-id="<?php echo $fpro->id; ?>" data-toggle="tooltip" title="Add to Cart">add to cart</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--Single Product End-->
                      <?php }
                    } else { ?>
                      <div class="col-lg-4 col-md-4 col-12 text-center">
                        <img src="<?php echo IMG_PATH; ?>norecords.png" />
                      </div>
                    <?php } ?>


                  </div>

                </div>
                <!--Grid View End-->

              </div>
            </div>
            <!--Shop Product Area End-->
            <!--Pagination Start-->
            <div class="pagination pb-10">
              <ul class="page-number">
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
              </ul>
            </div>
            <!--Pagination End-->
          </div>
          <!--Shop Product Area End-->
          <!--Left Sidebar Start-->
          <div class="col-lg-3 order-lg-1 order-2">
            <!--Widget Shop Categories start-->
            <div class="widget widget-shop-categories">
              <h3 class="widget-shop-title">Shop By Categories</h3>
              <div class="widget-content">
                <ul class="product-categories">
                  <?php $menus = json_decode($menuList);
                  // print_r($menus->menu_result);
                  $uri = base64_decode($this->uri->segment(3));
                  foreach ($menus->menu_result as $m) {
                    $catLink = base_url() . 'products/' . strtolower($m->menu_title) . '/' . base64_encode($m->menu_id);
                  ?>
                    <li class="<?php if ($uri == $m->menu_id) {
                                  echo 'catActiveClass" ';
                                } ?>"><a href="<?php echo $catLink; ?>"><?php echo $m->menu_title; ?></a></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <!--Widget Shop Categories End-->
            <!--Widget Price Slider Start-->
            <div class="widget widget-price-slider">
              <h3 class="widget-title">Filter by price</h3>
              <div class="widget-content">
                <div class="price-filter">
                  <form action="#">
                    <div id="slider-range"></div>
                    <span>Price:<input id="amount" class="amount" readonly="" type="text"></span>
                    <input class="price-button" value="Filter" type="button">
                  </form>
                </div>
              </div>
            </div>
            <!--Widget Price Slider End-->
            <!--Widget Brand Start-->
            <div class="widget widget-brand">
              <h3 class="widget-title">Brands</h3>
              <div class="widget-content">
                <ul class="brand-menu">
                  <li><input type="checkbox"><a href="#">Brand2</a> <span class="pull-right">(1)</span></li>
                </ul>
              </div>
            </div>
            <!--Widget Brand End-->
            <!--Widget Manufacture Start-->
            <div class="widget widget-manufacture">
              <h3 class="widget-title">MANUFACTURER</h3>
              <div class="widget-content">
                <ul class="brand-menu">
                  <li><input type="checkbox"><a href="#">Pellentesque</a> <span class="pull-right">(1)</span></li>
                </ul>
              </div>
            </div>
            <!--Widget Manufacture End-->
            <!--Widget Color Start-->
            <div class="widget widget-color">
              <h3 class="widget-title">Color</h3>
              <div class="widget-content">
                <ul class="brand-menu">
                  <li><input type="checkbox"><a href="#">Gold</a> <span class="pull-right">(1)</span></li>
                  <li><input type="checkbox"><a href="#">Green</a> <span class="pull-right">(1)</span></li>
                  <li><input type="checkbox"><a href="#">White</a> <span class="pull-right">(1)</span></li>
                </ul>
              </div>
            </div>
            <!--Widget Color End-->
            <!--Widget Compare Start-->
            <div class="widget widget-compare">
              <h3 class="widget-compare-title">Compare</h3>
              <div class="widget-content">
                <ul class="compare-menu">
                  <li>
                    <a class="title" href="#">Cillum dolore</a>
                    <a class="pull-right" href="#"><i class="fa fa-times"></i></a>
                  </li>
                  <li>
                    <a class="title" href="#">Cillum dolore</a>
                    <a class="pull-right" href="#"><i class="fa fa-times"></i></a>
                  </li>
                </ul>
                <a class="clear-all" href="#">Clear all</a>
                <a class="compare-btn" href="#">compare</a>
              </div>
            </div>
            <!--Widget Compare End-->
            <!--Widget Tag Start-->
            <div class="widget widget-tag">
              <h3 class="widget-shop-tag-title">Popular Tags</h3>
              <ul>
                <li><a href="#">asian</a></li>
                <li><a href="#">brown</a></li>
                <li><a href="#">camera</a></li>
                <li><a href="#">chilled</a></li>
                <li><a href="#">coctail</a></li>
                <li><a href="#">cool</a></li>
                <li><a href="#">dark</a></li>
                <li><a href="#">euro</a></li>
                <li><a href="#">food</a></li>
                <li><a href="#">france</a></li>
                <li><a href="#">hardware</a></li>
                <li><a href="#">hat</a></li>
                <li><a href="#">hipster</a></li>
                <li><a href="#">holidays</a></li>
                <li><a href="#">light</a></li>
                <li><a href="#">mac</a></li>
                <li><a href="#">place</a></li>
                <li><a href="#">retro</a></li>
                <li><a href="#">t-shirt</a></li>
                <li><a href="#">teen</a></li>
                <li><a href="#">travel</a></li>
                <li><a href="#">video-2</a></li>
                <li><a href="#">watch</a></li>
                <li><a href="#">white</a></li>
              </ul>
            </div>
            <!--Widget Tag End-->
          </div>
          <!--Left Sidebar End-->
        </div>
      </div>
    </div>
    <!--Product List Grid View Area End-->
    <!--Brand Area Start-->
    <div class="brand-area ptb-30 white-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
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



  <!--All Js Here-->

  <!--Jquery 3.6.0-->

</body>

</html>