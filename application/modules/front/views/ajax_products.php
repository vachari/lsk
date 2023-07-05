 <div class="row no-gutters shop_wrapper" id="productslist">
     <?php $pro = json_decode($products);
        if ($pro->code != 200) {
            echo '<div class="alert alert-danger text-center"> Products not found </div>';
        } else {
        ?>

         <?php
            foreach ($pro->result as $fpro) {
            ?>
             <div class="col-lg-4 col-md-4 col-12 ">
                 <div class="single_product">
                     <div class="product_thumb">
                         <a href="product-details.html"><img src="<?php echo base_url() . 'uploads/products/' . $fpro->prod_image; ?>" alt=""></a>
                         <div class="label_product">
                             <span class="label_sale">sale</span>
                         </div>
                         <div class="quick_button">
                             <a href="<?php echo base_url() . 'productDetails/' . $fpro->id; ?>" title="quick view"> <i class="zmdi zmdi-eye"></i></a>
                         </div>
                     </div>
                     <div class="product_content grid_content">
                         <div class="product_name">
                             <h3><a href="product-details.html"><?php echo (strlen($fpro->prod_name) > 22) ? substr($fpro->prod_name, 0, 20) . '...' : $fpro->prod_name; ?> </a></h3>
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
                                 <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                 <li class="add_to_cart"><a href="cart.html" title="add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i> add to cart</a></li>
                                 <li class="compare"><a href="#" title="compare"><i class="zmdi zmdi-swap"></i></a></li>
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
                                 <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                 <li class="add_to_cart"><a href="cart.html" title="add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i> add to cart</a></li>
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
         <?php }  ?>

     <?php } ?>
 </div>