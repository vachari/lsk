<?php $this->load->view('includes/header_css.php'); ?>

<body>

  <!--header area start-->
  <?php $this->load->view('includes/header.php'); ?>
  <!--header area end-->

  <!--breadcrumbs area start-->
  <div class="breadcrumbs_area">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumb_content">
            <ul>
              <li><a href="<?php echo base_url(); ?>">home</a></li>
              <?php if ($this->uri->segment(4) == '') { ?>
                <li ><a href="#"><?php echo ($this->uri->segment(2)); ?></a></li>

              <?php  } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs area end-->

  <!--shop  area start-->
  <div class="shop_area shop_reverse mt-50 mb-50">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-12">
          <!--sidebar widget start-->
          <aside class="sidebar_widget">
            <div class="shop_sidebar_banner mb-50">
              <a href="<?php echo base_url(); ?>"><img src="<?php echo IMG_PATH; ?>bg/banner16.jpg" alt=""></a>
            </div>
            <div class="widget_list widget_categories">
              <h2>categories</h2>
              <ul>
                <?php $menus = json_decode($menuList);
                // print_r($menus->menu_result);
                $uri = base64_decode($this->uri->segment(3));
                foreach ($menus->menu_result as $m) {
                ?>
                  <li>
                    <a href="<?php echo base_url() . 'products/' . strtolower($m->menu_title) . '/' . base64_encode($m->menu_id); ?>" <?php if ($uri == $m->menu_id) {
                                                                                                                                        echo 'style="color:#016FBF;" ';
                                                                                                                                      } ?>><?php echo (strlen($m->menu_title) > 20) ? substr($m->menu_title, 0, 20) . '...' : $m->menu_title; ?> </a>
                  </li>
                <?php
                }
                ?>

              </ul>
            </div>
            <div class="widget_list widget_filter">
              <h2>Filter by price</h2>
              <form action="#">
                <div id="slider-range"></div>
                <input type="text" name="text" id="amount" />
                <button type="submit">Filter</button>
              </form>
            </div>


            <div class="widget_list" style="display: none;">
              <h2>Select By Color</h2>
              <ul>
                <li>
                  <a href="#">Black <span>(6)</span></a>
                </li>
                <li>
                  <a href="#"> Blue <span>(8)</span></a>
                </li>
                <li>
                  <a href="#">Brown <span>(10)</span></a>
                </li>
                <li>
                  <a href="#"> Green <span>(6)</span></a>
                </li>
                <li>
                  <a href="#">Pink <span>(4)</span></a>
                </li>

              </ul>
            </div>
            <div class="widget_list recent_product">
              <h2>Top Rated Products</h2>
              <div class="recent_product_container">
                <!-- Products Loop start -->

                <div class="recent_product_list">
                  <div class="recent_product_thumb">
                    <a href="product-details.html"><img src="<?php echo IMG_PATH; ?>s-product/product.jpg" alt=""></a>
                  </div>
                  <div class="recent_product_content">
                    <h3><a href="product-details.html">Natus erro</a></h3>
                    <div class="product_rating">
                      <ul>
                        <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                        <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                        <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                        <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                        <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                      </ul>
                    </div>
                    <div class="price_box">
                      <span class="current_price">$65.00</span>
                      <span class="old_price">$70.00</span>
                    </div>
                  </div>
                </div>
                <!-- Product Loop end -->






              </div>
            </div>

          </aside>
          <!--sidebar widget end-->
        </div>
        <div class="col-lg-9 col-md-12">
          <!--shop wrapper start-->
          <!--shop toolbar start-->
          <!-- <div class="shop_banner">
            <img src="<?php echo IMG_PATH; ?>bg/banner29.jpg" alt="">
          </div> -->
         
          <?php
          $pro = json_decode($products);
          if ($pro->code == 200) {
            $recordsCount = count($pro->result);
            
          ?>
            <div class="shop_toolbar_wrapper">
              <div class="shop_toolbar_btn">

                <button data-role="grid_3" type="button" class="active btn-grid-3" data-bs-toggle="tooltip" title="3"></button>

                <button data-role="grid_4" type="button" class=" btn-grid-4" data-bs-toggle="tooltip" title="4"></button>

                <button data-role="grid_list" type="button" class="btn-list" data-bs-toggle="tooltip" title="List"></button>
              </div>
              <div class="">


                <select name="pricesort" id="pricesort" class="form-control">

                  <option selected value="1">Sort by average rating</option>
                  <!-- <option value="2">Sort by popularity</option>
                   <option value="3">Sort by newness</option> -->
                  <option value="2">Sort by price: low to high</option>
                  <option value="1">Sort by price: high to low</option>
                  <!-- <option value="6">Product Name: Z</option> -->
                </select>
                <input type="hidden" name="cat_id" id="cat_id" value="<?php echo base64_decode($this->uri->segment(3, 0)); ?>">
                <input type="hidden" name="subcat_id" id="subcat_id" value="<?php echo base64_decode($this->uri->segment(4, 0)); ?>">
                <input type="hidden" name="listsubcat_id" id="listsubcat_id" value="<?php echo base64_decode($this->uri->segment(5, 0)); ?>">



              </div>

              <!-- <div class="page_amount">
                <p>Showing  1 - <?php echo $recordsCount; ?> results</p>
              </div> -->
            </div>
          <?php  } ?>
          <!--shop toolbar end-->

          <div class="row no-gutters shop_wrapper" id="productslist">
            <!-- Producut Loop start  -->
            <?php
            if ($pro->code == 200) {
              foreach ($pro->result as $fpro) {
            ?>
                <div class="col-lg-4 col-md-4 col-12 ">
                  <div class="single_product">
                    <div class="product_thumb">
                      <a href="<?php echo base_url() . 'productDetails/' . $fpro->id; ?>" title="quick view"><img class="prod-img" src="<?php echo base_url() . 'uploads/products/' . $fpro->prod_image; ?>" alt=""></a>
                      <div class="label_product">
                        <span class="label_sale">sale</span>
                      </div>
                      <!-- <div class="quick_button">
                         <a href="<?php echo base_url() . 'productDetails/' . $fpro->id; ?>" title="quick view"> <i class="zmdi zmdi-eye"></i></a>
                       </div> -->
                    </div>
                    <div class="product_content grid_content">
                      <div class="product_name">
                        <h3><a href="<?php echo base_url() . 'productDetails/' . $fpro->id; ?>"><?php echo (strlen($fpro->prod_name) > 22) ? substr($fpro->prod_name, 0, 20) . '...' : $fpro->prod_name; ?> </a></h3>
                      </div>
                      <div class="product_rating">
                        <ul>
                          <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                          <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                          <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                          <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                          <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                        </ul>
                      </div>
                      <div class="price_box">
                        <span class="current_price"><?php echo india_price($fpro->selling_price); ?></span>
                        <span class="old_price"><?php echo india_price($fpro->mrp); ?></span>
                      </div>
                      <div class="action_links">
                        <ul>
                          <li class="wishlist" data-id="<?php echo $fpro->id; ?>"><a href="javascript:void(0)" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                          <li class="add_to_cart" data-id="<?php echo $fpro->id; ?>"><a href="javascript:void(0)" onclick="addToCart('<?php echo $fpro->id; ?>') title=" add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i> add to cart</a></li>
                          <!-- <li class="compare"><a href="#" title="compare"><i class="zmdi zmdi-swap"></i></a></li> -->
                        </ul>
                      </div>
                    </div>
                    <div class="product_content list_content">
                      <div class="product_name">
                        <h3><a href="<?php echo base_url() . 'productDetails/' . $fpro->id; ?>"><?php echo (strlen($fpro->prod_name) > 22) ? substr($fpro->prod_name, 0, 20) . '...' : $fpro->prod_name; ?></a></h3>
                      </div>
                      <div class="product_rating">
                        <ul>
                          <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                          <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                          <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                          <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                          <li><a href="#"><i class="zmdi zmdi-star-outline"></i></a></li>
                        </ul>
                      </div>
                      <div class="price_box">
                        <span class="current_price"><?php echo india_price($fpro->selling_price); ?></span>
                        <span class="old_price"><?php echo india_price($fpro->mrp); ?></span>
                      </div>
                      <div class="action_links">
                        <ul>
                          <li class="wishlist" data-id="<?php echo $fpro->id; ?>"><a href="javascript:void(0)" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                          <li class="add_to_cart" data-id="<?php echo $fpro->id; ?>"><a href="javascript:void(0)" title="add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i> add to cart</a></li>
                          <li class="compare"><a href="#" title="compare"><i class="zmdi zmdi-swap"></i></a></li>
                        </ul>
                      </div>

                      <div class="product_desc">
                        <p>
                          <?php echo (strlen($fpro->prod_desc) > 200) ? substr($fpro->prod_desc, 0, 200) . '...' : $fpro->prod_desc; ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              <?php }
            } else { ?>
              <div class="col-lg-4 col-md-4 col-12 text-center">
                <img src="<?php echo IMG_PATH; ?>norecords.png" />
              </div>
            <?php } ?>
            <!-- Producut Loop End  -->










          </div>

          <div class="shop_toolbar t_bottom" style="display: none;">
            <div class="pagination">
              <ul>
                <li class="current">1</li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li class="next"><a href="#">next</a></li>
                <li><a href="#">>></a></li>
              </ul>
            </div>
          </div>
          <!--shop toolbar end-->
          <!--shop wrapper end-->
        </div>
      </div>
    </div>
  </div>
  <!--shop  area end-->

  <!--brand newsletter area start-->



  <!--footer area start-->
  <?php $this->load->view('includes/footer.php'); ?>
  <!--footer area end-->
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
  <script type="text/javascript" src="<?php echo JS_PATH; ?>commoncart.js"></script>






</body>

</html>
<script>
  $('.filters').on('click', function() {
    filters();
  });
  /*price Sorting Code Start*/

  $('#pricesort').on('change', function() {
    var order = $(this).val();
    filters(order);
  });
  /*price Sorting Code End*/
  function filters(order) {
    if (!isNaN())
      var sortvalue = order;
    else
      var sortvalue = $('#pricesort').val();
    var cat_id = $('#cat_id').val();
    var subcat_id = $('#subcat_id').val();
    var listsubcat_id = $('#listsubcat_id').val();
    var priceArray = new Array();
    $('input[name="price[]"]:checked').each(function() {
      priceArray.push($(this).val());
    });
    var pricelist = '' + priceArray;
    // alert(pricelist);

    $.ajax({
      dataType: 'html',
      type: 'POST',
      data: {
        'cat_id': cat_id,
        'subcat_id': subcat_id,
        'listsubcat_id': listsubcat_id,
        'price': pricelist,
        'sort': sortvalue,
        'url': location.href
      },
      url: "<?php echo base_url() . 'front/Products/productFilter'; ?>",
      success: function(result) {
        console.log(result);
        $('#productslist').empty;
        $('#productslist').html(result);
      },
      error: function(error) {
        console.log(error)
      }
    });
    /*Ajax code End*/
  }
</script>