<?php $this->load->view('includes/header_css'); ?>

<!--header area end-->
<?php
$recordExists = 1;
$feature_pro = json_decode($feature_product);
if (empty($feature_pro->result->id)) {
  $recordExists = 0;
}
?>

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
                  <li><a href="<?php echo base_url(); ?>">Home</a><span class="breadcome-separator">></span></li>

                  <li><?php echo (fetch_ucfirst($feature_pro->result->prod_name)); ?> </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Heading Banner Area End-->
    <!--Single Product Area Start-->
    <section class="single-product-area mt-20">
      <div class="container">
        <!--Single Product Info Start-->
        <div class="row single-product-info mb-50">
          <!--Single Product Image Start-->
          <div class="col-lg-6 col-md-6">
            <!--Product Tab Content Start-->
            <div class="single-product-tab-content tab-content">
              <div id="w1" class="tab-pane fade in active">
                <div class="easyzoom easyzoom--overlay">
                  <a href="<?php echo base_url() . 'uploads/products/' . $feature_pro->result->prod_image; ?>">
                    <img src="<?php echo base_url() . 'uploads/products/' . $feature_pro->result->prod_image; ?>" alt="">
                  </a>
                </div>
              </div>

              <?php
              if (count($product_gallery) > 0) {
                $sno = 2;
                foreach ($product_gallery as $pgRes) {

              ?>
                  <div id="w<?php echo $sno; ?>" class="tab-pane fade">
                    <div class="easyzoom easyzoom--overlay">
                      <a href="<?php echo base_url()   . $pgRes->image; ?>">
                        <img src="<?php echo base_url()  . $pgRes->image; ?>" alt="">
                      </a>
                    </div>
                  </div>
              <?php $sno++;
                }
              }
              ?>



            </div>
            <!--Product Tab Content End-->
            <!--Single Product Tab Menu Start-->
            <div class="single-product-tab">
              <div class="nav single-product-tab-menu owl-carousel">
                <a data-toggle="tab" href="#w1"><img class="desc_thumb_img" src="<?php echo base_url() . 'uploads/products/' . $feature_pro->result->prod_image; ?>" alt=""></a>
                <?php
                if (count($product_gallery) > 0) {
                  $thumbb_sno = 2;
                  foreach ($product_gallery as $pgRes) { ?>
                    <a data-toggle="tab" href="#w<?php echo $thumbb_sno; ?>"><img class="desc_thumb_img" src="<?php echo base_url()  . $pgRes->image; ?>" alt=""></a>
                <?php $thumbb_sno++;
                  }
                } ?>
              </div>
            </div>
            <!--Single Product Tab Menu Start-->
          </div>
          <!--Single Product Image End-->
          <!--Single Product Content Start-->
          <div class="col-lg-6 col-md-6">
            <div class="single-product-content">
              <!--Product Nav Start-->
              <div class="product-nav">
                <a href="#"><i class="fa fa-angle-left"></i></a>
                <a href="#"><i class="fa fa-angle-right"></i></a>
              </div>
              <!--Product Nav End-->
              <h1 class="product-title"><?php echo fetch_ucfirst($feature_pro->result->prod_name); ?></h1>
              <!--Product Rating Start-->
              <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star on-color"></i>
                <i class="fa fa-star on-color"></i>
                <a class="review-link" href="#">(1 customer review)</a>
              </div>
              <!--Product Rating End-->
              <!--Product Price Start-->
              <div class="single-product-price">
                <span class="new-price"><?php echo india_price($feature_pro->result->selling_price); ?></span>
                <span class="old-price"><?php echo india_price($feature_pro->result->mrp); ?></span>
              </div>
              <!--Product Price End-->
              <!--Product Description Start-->
              <div class="product-description">
                <p>
                <p><?php echo $feature_pro->result->short_description; ?></p>
                </p>
              </div>
              <!--Product Description End-->
              <!--Product Quantity Start-->
              <div class="single-product-quantity">
                <form action="#">
                  <div class="quantity">
                    <label>Quantity</label>
                    <input min="0" max="100" step="2" value="1" type="number" id="cartQty">
                  </div>
                  <button class="quantity-button" type="button" onclick="addToCart(<?php echo $feature_pro->result->id; ?>,'description')">Add to cart</button>
                </form>
              </div>
              <!--Product Quantity End-->
              <!--Wislist Compare Button Start-->
              <div class="wislist-compare-btn">
                <ul>
                  <li><a class="wishlist" href="#">Add To Wishlist</a></li>
                  <li><a class="compare" href="#">Compare</a></li>
                </ul>
              </div>
              <!--Wislist Compare Button End-->
              <!--Product Meta Start-->
              <!-- <div class="product-meta">
                <span class="posted-in">
                  Categories:
                  <a href="#">Accessories</a>,
                  <a href="#">Electronics</a>,
                  <a href="#">Tvs & Audios</a>,
                  <a href="#">Watches</a>
                </span>
              </div> -->
              <!--Product Meta End-->
              <!--Product Sharing Start-->
              <div class="single-product-sharing">
                <ul>
                  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                  <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
              </div>
              <!--Product Sharing End-->
            </div>
          </div>
          <!--Single Product Content End-->
        </div>
        <!--Single Product Info End-->
        <!--Discription Tab Start-->
        <div class="row">
          <div class="discription-tab">
            <div class="col-lg-12">
              <div class="discription-review-contnet mb-40">
                <!--Discription Tab Menu Start-->
                <div class="discription-tab-menu">
                  <ul class="nav">
                    <li><a class="active" data-toggle="tab" href="#description">Description</a></li>
                    <li><a data-toggle="tab" href="#review">Reviews (0)</a></li>
                  </ul>
                </div>
                <!--Discription Tab Menu End-->
                <!--Discription Tab Content Start-->
                <div class="discription-tab-content tab-content">
                  <div id="description" class="tab-pane fade show active">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="description-content">
                          <p>
                            <?php echo ($feature_pro->result->prod_desc); ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="review" class="tab-pane fade">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="review-page-comment">
                          <div class="review-comment">
                            <h2>1 review for typesetting animal</h2>
                            <ul>
                              <li>
                                <div class="product-comment">
                                  <img src="<?php echo IMG_PATH; ?>comment-author/2.png" alt="">
                                  <div class="product-comment-content">
                                    <p><strong>admin</strong>
                                      -
                                      <span>March 7, 2016:</span>
                                      <span class="pro-comments-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                      </span>
                                    </p>
                                    <div class="description">
                                      <p>roadthemes</p>
                                    </div>
                                  </div>
                                </div>
                              </li>
                            </ul>
                            <div class="review-form-wrapper">
                              <div class="review-form">
                                <span class="comment-reply-title">Add a review </span>
                                <form action="#">
                                  <p class="comment-notes">
                                    <span id="email-notes">Your email address will not be published.</span>
                                    Required fields are marked
                                    <span class="required">*</span>
                                  </p>
                                  <div class="comment-form-rating">
                                    <label>Your rating</label>
                                    <div class="rating">
                                      <i class="fa fa-star-o"></i>
                                      <i class="fa fa-star-o"></i>
                                      <i class="fa fa-star-o"></i>
                                      <i class="fa fa-star-o"></i>
                                      <i class="fa fa-star-o"></i>
                                    </div>
                                  </div>
                                  <div class="input-element">
                                    <div class="comment-form-comment">
                                      <label>Comment</label>
                                      <textarea name="message" cols="40" rows="8"></textarea>
                                    </div>
                                    <div class="review-comment-form-author">
                                      <label>Name </label>
                                      <input required="required" type="text">
                                    </div>
                                    <div class="review-comment-form-email">
                                      <label>Email </label>
                                      <input required="required" type="text">
                                    </div>
                                    <div class="comment-submit">
                                      <button type="submit" class="form-button">Submit</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--Discription Tab Content End-->
              </div>
            </div>
          </div>
        </div>
        <!--Discription Tab End-->
      </div>
    </section>
    <!--Single Product Area End-->
    <!--Related Products Area Start-->
    <section class="related-products-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!--Section Title1 Start-->
            <div class="section-title1-border">
              <div class="section-title1">
                <h3>Related products</h3>
              </div>
            </div>
            <!--Section Title1 End-->
          </div>
        </div>
        <div class="row">
          <div class="related-products owl-carousel">
            <!--Single Product Start-->
            <?php
            $relatedReq = json_decode($related_products);
            if ($relatedReq->code  == 200) {
              foreach ($relatedReq->result as $hd_res) {

                $prodLink = base_url() . 'productDetails/' . $hd_res->id;
            ?>
                <div class="col-lg-12">
                  <div class="single-product">
                    <div class="product-img">
                      <a href="<?php echo $prodLink; ?>">
                        <img class="first-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $hd_res->prod_image; ?>" alt="">
                        <img class="hover-img" src="<?php echo PRODCUCT_IMAGE_PATH; ?><?php echo $hd_res->prod_image; ?>" alt="">
                      </a>
                      <span class="sicker"><?php echo $hd_res->offer_price; ?>%</span>
   
                    </div>
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
                        <a class="button add-btn" href="#">add to cart</a>
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
    </section>
    <!--Related Products Area End-->
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
    <?php $this->load->view('includes/footer'); ?>
  </div>


</body>
<script type="text/javascript" src="<?php echo JS_PATH; ?>commoncart.js"></script>
</html>