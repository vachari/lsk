 <?php $this->load->view('includes/header_css.php'); ?>

 </head>

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
                             <li>Wishlist</li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!--breadcrumbs area end-->


     <!--wishlist area start -->
     <div class="wishlist_area mt-60">
         <div class="container">
             <form action="#">
                 <div class="row">
                     <div class="col-12">
                         <div class="table_desc wishlist">
                             <div class="cart_page table-responsive">
                                 <table>

                                     <thead>
                                         <tr>
                                             <th class="product_remove">Delete</th>
                                             <th class="product_thumb">Image</th>
                                             <th class="product_name">Product</th>
                                             <th class="product-price">Price</th>
                                             <th class="product_total">Add To Cart</th>
                                         </tr>
                                     </thead>
                                     <?php
                                        $wishListData = json_decode($wish_list);
                                        if ($wishListData->code == 200) {
                                            foreach ($wishListData->result as $res) {
                                                $productLink = base_url() . 'productDetails/' . $res->prod_id;
                                        ?>
                                             <tbody>
                                                 <tr>
                                                     <td class="product_remove"><a onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url() . 'removeWish/' . $res->prod_id; ?>" title="Remove from wishlist">X</a></td>
                                                     <td class="product_thumb"><a href="<?php echo $productLink; ?>"><img src="<?php echo PRODCUCT_IMAGE_PATH . $res->prod_image; ?>" alt="<?php echo $res->prod_name; ?>" title="<?php echo $res->prod_name; ?>"></a></td>
                                                     <td class="product_name"><a href="<?php echo $productLink; ?>"><?php echo $res->prod_name; ?></a></td>
                                                     <td class="product_name"><a href="<?php echo $productLink; ?>"><?php echo india_price($res->selling_price); ?></a></td>
                                                     <td class="product_total"><a href="javascript:void(0)" onclick="addToCart(<?php echo $res->prod_id; ?>)">Add To Cart</a></td>
                                                 </tr>


                                             </tbody>
                                         <?php }
                                        } else { ?>
                                         <tbody>
                                             <tr>
                                                 <td colspan="6" class="alert alert-danger text-center">No wishlist records found..!</td>
                                             </tr>
                                         </tbody>
                                     <?php } ?>
                                 </table>
                             </div>

                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
     <!--wishlist area end -->

     <?php $this->load->view('includes/footer.php'); ?>
     <script type="text/javascript" src="<?php echo JS_PATH; ?>commoncart.js"></script>

 </body>

 </html>