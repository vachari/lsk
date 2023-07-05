<?php $this->load->view('includes/header_css.php'); ?>

<body>
  <!--header area start-->
  <?php $this->load->view('includes/header.php'); ?>
  <!--header area end-->
  <?php
  $recordExists = 1;
  $feature_pro = json_decode($feature_product);
  if (empty($feature_pro->result->id)) {
    $recordExists = 0;
  }
  ?>
  <!--breadcrumbs area start-->
  <div class="breadcrumbs_area">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumb_content">
            <ul class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"> Home </a></li>
              <li><a href="#"> Products </a></li>
              <li class="active"><?php echo (fetch_ucfirst($feature_pro->result->prod_name)); ?> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs area end-->
  
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-md-5 col-sm-12">
        <div class="modal_tab">
          <div class="tab-content product-details-large">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
              <div class="modal_tab_img">
                <a href="#"><img src="<?php echo base_url() . 'uploads/products/' . $feature_pro->result->prod_image; ?>" alt=""></a>
              </div>
            </div>

            
              <div class="tab-pane fade" id="tab2" role="tabpanel">
                <div class="modal_tab_img">
                  <a href="#"><img src="<?php echo base_url() . 'uploads/products/other_images' . $feature_pro->result->other_image; ?>" alt=""></a>
                </div>
              </div>
             

          </div>
          <div class="modal_tab_button">
            <ul class="nav product_navactive owl-carousel" role="tablist">
              <li>
                <a class="nav-link active" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="false"><img src="<?php echo base_url() . 'uploads/products/' . $feature_pro->result->prod_image; ?>" alt=""></a>
              </li>
               
                <li>
                  <a class="nav-link" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false"><img src="<?php echo base_url() . 'uploads/products/other_images/' . $feature_pro->result->other_image; ?>" alt=""></a>
                </li>
               


            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-md-7 col-sm-12">
        <div class="modal_right">
          <div class="modal_title mb-10">
            <h2><?php echo fetch_ucfirst($feature_pro->result->prod_name); ?></h2>
          </div>
          <div class="modal_price mb-10">
            <?php
            $sellingPrice = 0;


            ?>
            <span class="new_price"><?php echo india_price($feature_pro->result->selling_price); ?></span>
            <span class="old_price"><?php echo india_price($feature_pro->result->mrp); ?></span>
          </div>
          <div class="modal_description mb-15">
            <p><?php echo $feature_pro->result->prod_desc; ?></p>
          </div>
          <div class="variants_selects">
            <div class="variants_size" style="display: none;">
              <h2>size</h2>
              <select class="select_option">
                <option selected value="1">s</option>
                <option value="1">m</option>
                <option value="1">l</option>
                <option value="1">xl</option>
                <option value="1">xxl</option>
              </select>
            </div>
            <div class="variants_color" style="display: none;">
              <h2>color</h2>
              <select class="select_option">
                <option selected value="1">purple</option>
                <option value="1">violet</option>
                <option value="1">black</option>
                <option value="1">pink</option>
                <option value="1">orange</option>
              </select>
            </div>
            <div class="modal_add_to_cart">
              <form action="#">
                <input min="0" max="100" step="2" value="1" type="number" id="cartQty">
                <button type="button" onclick="addToCart(<?php echo $feature_pro->result->id; ?>,'description')">add to cart</button>
              </form>
            </div>
          </div>
          <div class="modal_social">
            <h2>Share this product</h2>
            <ul>
              <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
              <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
              <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix">&nbsp;</div>
  <?php $this->load->view('includes/footer.php'); ?>
  <!--footer area end-->
  <script type="text/javascript" src="<?php echo JS_PATH; ?>commoncart.js"></script>

</body>