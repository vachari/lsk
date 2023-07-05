<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>:: Shoperative ::</title>
    <link href="<?php echo CSS_PATH;?>bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>main.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>menu.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"  href="<?php echo CSS_PATH;?>bliss-slider.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <style> 
    input[type="submit"]{border-radius:40px !important;padding:5px 30px;}
    input[type="number"]{width:60px;}
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
     border-top: 0px solid #ddd; 
}
    </style>
</head><!--/head-->

<body class="popup" >
    <div class="clearfix"></div>
    <div class="col-md-12  no-pad">
            <?php $this->load->view('includes/header.php');?>
    </div>
    <div class="clearfix"></div>
     
    <div class="clearfix"></div>

    <section>
        <div class="container martop150">
            <div class="col-md-3 bg_profile ">
                <div class="col-xs-12 mrtop">
                     <ul class="profile-side-bar">
                         <li > <a href="<?php echo base_url().'myprofile'?>"> My Profile</a></li>
                         <li> <a href="<?php echo base_url().'myorders'?>"> My Orders</a></li>
                         <li class="active"> <a href="<?php echo base_url().'sharedcart'?>"> My Shared Cart</a></li>
                         <!--<li> <a href="<?php echo base_url().'mysaving'?>"> My Saving</a></li>-->
                         <li > <a href=" <?php echo base_url().'wishlist'?>"> Wishlist</a></li>
                         <li> <a href=" <?php echo base_url().'basket'?>"> My Regular Basket</a></li>
                         <li > <a href=" <?php echo base_url().'addressbook'?> "> Address Book</a></li>
                         <li> <a href=" <?php echo base_url().'help'?> "> Help</a></li>
                         <li> <a href=" <?php echo base_url() . 'changepassword/'; ?>"> Change Password   </a></li>
                         <li> <a href=" <?php echo base_url() . 'logout/'; ?>"> Logout   </a></li>
                     </ul>
                </div>
                    <div style="height:850px" class="hidden-xs"></div>
                

            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                 <div class="row">
              <div class="col-sm-12">
              <div class="col-md-12">
                <div class="col-md-12">
                    <div class="header-title">
                         <h4> My shared Cart </h4>
                        <?php $ordersdata=json_decode($ordersdata); 
                           // print_r($ordersdata->result);
                        foreach ($ordersdata->result as $od) {
                        
                        ?>
                        <hr> 
                    </div>
                    <div class="col-md-12"> 
                        <div class="col-md-12"> 
                            <div class="col-md-12 bord no-pad">
                              <div class="col-sm-7" style="margin-top: 30px;">
                               <div class="panel-heading bg_darkgray"> 
                                         <h6 class="panel-title">  <b>Order Information</b></h6>
                                    </div>
                                  <div class="panel-heading bg_darkgray"> 
                                    
                                     <table class="">
                                              <tbody>
                                             
                                               <tr>
                                                    <td>  Order #  : </td>
                                                    <td>  <p class="bord"> &nbsp;  <?php echo $od->ordernumber; ?> </p> </td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td>  Order Date  : </td>
                                                    <td>  <p class="bord"> &nbsp;
                                                    <?php 
                                        $originalDate=$od->orderdate;
                                        $newDate = date("d-M-Y ", strtotime($originalDate));
                                        $dueDate = date("d-M-Y",strtotime($newDate.' + 2 days'));
                                        $newTime = date("h:i:s A", strtotime($originalDate));
                                       echo $newDate." ".$newTime;
                                    ?>  </p> </td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td>  Shipping Date  : </td>
                                                    <td>  <p class="bord"> &nbsp; <?php  echo $dueDate." "; ?> </p></td>
                                                </tr>
                                                </tbody>
                                               
                                                
                                                <tfoot class="bg_darkgray">
                                                 <tr>
                                                    <td>  Order Quantity : </td>
                                                    <td>  <p class="bord"> &nbsp;  <?php echo $od->orderqty; ?> KG</p> </td>
                                                   
                                                </tr>
                                                    <tr> 
                                                        <th colspan="4"> Sub Total</th>
                                                        <th> <?php echo "₹ ".$od->orderprice; ?></th>
                                                    </tr>

                                                    <tr> 
                                                        <th colspan="4"> Shipping Charges</th>
                                                        <th> <?php echo "₹ ".$od->shippingprice; ?></th>
                                                    </tr>
                                                    <?php $saving = $od->orderprice + $od->shippingprice - $od->totalpayableprice;  ?>
                                                    <tr>
                                                        <th colspan="4"> Saving Amount </th>
                                                        <th><?php echo "₹ ".$saving; ?></th>
                                                    </tr>
                                                     <tr border='1px'>
                                                        <th colspan="4"> Total </th>
                                                        <th><?php echo "₹ ".$od->totalpayableprice; ?></th>
                                                    </tr>
                                                  </tfoot>
                                                
                                            </table>
                                </div>
                              </div>
                              
                                <div class="col-md-5">
                                    <div class="col-md-12 bord no-pad mrtop">
                                    <div class="panel-heading bg_darkgray"> 
                                         <h6 class="panel-title">  <b>Shipping Information</b></h6>
                                    </div>
                                    <div class="" style="margin-left: -13px">
                                        <div class="col-md-12"> 
                                            <table class="table"> 
                                                <tr>
                                                    <td>  Shipping Date  : </td>
                                                    <td>  <p class="bord"> &nbsp;  <?php $dueDate = date("d-M-Y ", strtotime($newDate. '+ 2 days')); echo $dueDate ?></p> </td>
                                                   
                                                </tr>
                                                 <tr>
                                                    <td style="min-width: 75px"> Shipping Address  : </td>
                                                    <?php $address = $od->address.','.$od->city; ?>
                        <td style="word-break: break-word;"> <?php echo rtrim($address,',');?></td>
                                                </tr>
                                                <tr>
                                                    <td>  Pincode  : </td>
                                                    <td>  <p class="bord"> &nbsp;  <?php echo $od->pincode ?></p> </td>
                                                   
                                                </tr>
                                                 <tr>
                                                    <td>  Mobile  : </td>
                                                    <td>  <p class="bord"> &nbsp;  <?php echo $od->mobile ?></p> </td>
                                                   
                                                </tr>

                                                
                                            </table>
                                       </div>
                                    </div>
                                </div>
                                </div>
                                <?php }?>
                            </div>
                 <?php  $uri=base64_decode($this->uri->segment(3)); if($uri == 1){ ?>
                <div class="col-md-12 bord ">
                <h3> &nbsp;&nbsp;  Products </h3>
                 <table class="table table-striped table-hover">
                    <caption class="bg_darkgray"> <b> &nbsp; Mycart Product Details</b></caption>
                        <thead>
                            <tr></tr>
                            <tr>

                                <th> Image </th>
                                <th> Product </th>
                                <th> Qty </th>
                                <th> Unit Price </th>
                                <th>  Price </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $items = json_decode($cart_List);

                            if($items->code != SUCCESS_CODE){
                        echo " <tr><td colspan='10'> <div class='alert alert-danger text-center'> Items not found in mycart </div></td>
                         <tr>";
                            }else{
                            foreach ($items->cart_result as $cart) { 
                       ?>
                        <tr>
                            <td>
                                <img src="<?php echo $cart->product_image; ?>"
                                     style="height:50px;width:50px;" >
                            </td>
                            <td>
                                 <?php echo $cart->prod_name; ?>
                            </td>
                            <td>
                                <?php echo $cart->qty; ?>
                            </td>
                            <td>
                                <?php echo $cart->selling_price; ?>
                            </td>
                            <td>
                                <?php
                                $sell_amount = $cart->selling_price;
                                $sell_qty = $cart->qty;
                                echo $sell_qty * $sell_amount;
                                ?>
                            </td>
                        </tr>
                      <?php } }?>
                        </tbody>
                       <?php   if($items->code == SUCCESS_CODE){
                        foreach ($ordersdata->result as $od) { 
                        ?>
                        <tfoot class="bg_darkgray">
                            <tr> 
                                <th colspan="4"> Sub Total</th>
                                <th> <?php echo "₹ ".($od->totalpayableprice - $od->shippingprice ); ?></th>
                            </tr>

                            <tr> 
                                <th colspan="4"> Shipping Charges</th>
                                <th> <?php echo "₹ ".$od->shippingprice; ?></th>
                            </tr>
                             <tr style="border: 1px solid #ddd" class="success">
                                <th colspan="4"> Total </th>
                                <th><?php echo "₹ ".$od->totalpayableprice; ?></th>
                            </tr>


                           <!--  <?php   
                           // print_r($cartStatistics);
                            $cartStatisticsReq=json_decode($cartStatistics);
                            ?>
                            <tr> 
                                <th colspan="4"> Sub Total</th>
                                <th> <?php echo "₹ ".$cartStatisticsReq->cart_amount; ?></th>
                            </tr>
                            <tr> 
                                <th colspan="4"> Shipping Charges</th>
                                <th>  <?php echo "₹ ".$cartStatisticsReq->cart_shipping; ?></th>
                            </tr>
                             <tr>
                              
                                <th colspan="4"> Processing Fee</th>
                                <th><?php echo "₹ ".$cartStatisticsReq->cart_service_charge; ?></th>
                            </tr>
                            <tr border='1px'>
                                <th colspan="4"> Total </th>
                                <th><?php echo "₹ ".$cartStatisticsReq->cart_grand_total; ?></th>
                            </tr> -->
                        
                        </tfoot>
                       <?php }  }?> 
                        </table> 
                            </div>    <?php }else{ ?>

                             <div class="col-md-12">
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#userwise">User Wise</a></li>
                            <li><a data-toggle="tab" href="#itemwise">Item Wise</a></li>
                          </ul>

                          <div class="tab-content">
                            <div id="userwise" class="tab-pane fade in active">
                               <!-- Accodian starts from here -->      
                                        <div class="col-md-12 bg_head_acc">
                                            <div class="col-md-3">
                                                Item-Code
                                            </div>
                                            <div class="col-md-3">
                                                Item-Name
                                            </div>
                                            <div class="col-md-3">
                                                Total Items
                                            </div>
                                            <div class="col-md-3">
                                                Total Price 
                                            </div> 
                                        </div>    
                                        <?php
                                            $sharecart_req = json_decode($checkout_result);
                                        $sharecart_user = $sharecart_req->sharecart_user;
                                        $sherecart_item = $sharecart_req->sharecart_item;
                                        if ($sharecart_user->code == 200) {
                                            foreach ($sharecart_user->userDeatails as $shareUserRes) {
                                                ?>
                                                <button class="accordion bg-pr">  
                                                    <div class="col-md-3">
                                                        <?php echo $shareUserRes->usercode; ?>
                                                    </div>
                                                    <div class="col-md-3 ">
                                    <?php $user_id=$this->session->userdata('user_id'); ?>
                                    <?php if(($shareUserRes->usertype == 1) || ($shareUserRes->usertype == 2)  ){ echo fetch_ucfirst($shareUserRes->username);}else{ echo "----";} ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                       <?php echo $shareUserRes->user_shopping_count; ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <?php echo ' ₹ '; ?> <?php echo $shareUserRes->user_shopping_amount; ?>
                                                    </div>
                                                </button>
                                                <div class="panel">
                                                    <table class="table table-nobot no-bordered table-responsive">
                                                        <tr class="danger"> 
                                                            <th>User-Id</th>
                                                            <th>Username</th>
                                                            <th> Items Code</th>
                                                            <th> Product Name</th>
                                                            <th> Qty</th>
                                                            <th>Price</th>
                                                            <th>Total Price</th>
                                                        </tr>

                                                        <?php

                                    $shareUserItem = $shareUserRes->cart_result;
                                    foreach ($shareUserItem as $shareItemResponse) {
                                                            ?>
                                                            <tr> 
                                                                <td><?php echo fetch_ucfirst($shareItemResponse->productcode); ?></td>
                                                                <td> <?php echo fetch_ucfirst($shareItemResponse->productname); ?></td>
                                                                <td> <?php echo $shareItemResponse->qty; ?> | KG</td>
                                                                <td> ₹ <?php echo $shareItemResponse->unit_price; ?>
                                                                <td> ₹ <?php echo $shareItemResponse->total_amount; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table> 
                                                </div>

                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="clearfix"></div>
                                            <span class="accordion bg-pr ">  
                                                <div class="alert alert-danger">No Share cart items.. Please share the cart to continue.</div>
                                            </span>
                                        <?php } 
                                        ?>
                                        <!-- USer based code end -->
                                        <!-- tab1 ends -->
                            </div>
                            <div id="itemwise" class="tab-pane fade">
                               <!-- Accodian starts from here -->      
                                        <div class="col-md-12 bg_head_acc_share">
                                            <div class="col-md-3">
                                                Item-Code
                                            </div>
                                            <div class="col-md-3">
                                                Item-Name
                                            </div>
                                            <div class="col-md-3">
                                                Total-Orders
                                            </div>
                                            <div class="col-md-3">
                                                Total-Price 
                                            </div> 
                                        </div>    
                                        <?php 
                    if ($sherecart_item->code == 200) {
                        foreach ($sherecart_item->shareItemDeatils as $shareItemRes) {
                                                ?> 
                                                <button class="accordion bg-pr-share">  
                                                    <div class="col-md-3">
                                                      <?php echo fetch_ucfirst($shareItemRes->productcode); ?>   
                                                    </div>
                                                    <div class="col-md-3 ">
                                                       <?php echo fetch_ucfirst($shareItemRes->productname); ?>  
                                                    </div>
                                                    <div class="col-md-3">
                                                      <?php echo fetch_ucfirst($shareItemRes->item_order_count); ?>  
                                                    </div>
                                                    <div class="col-md-3">
                                                        ₹ <?php echo fetch_ucfirst($shareItemRes->item_cart_amount); ?>  
                                                    </div>


                                                </button>
                                                <div class="panel">
                                                    <table class="table table-nobot no-bordered table-responsive">
                                                        <tr class="info text-center"> 
                                                            <th>Item Code </th>
                                                            <th>Item Name  </th>
                                                            <th> User Id</th>
                                                            <th> User</th>
                                                            <th> Qty</th>
                                                            <th>Price</th>
                                                            <th>Total Price</th>
                                                        </tr>
                                                        <?php foreach ($shareItemRes->user_result as $shareUserRes) { ?>
                                                            <tr> 
                                                                <td><?php echo fetch_ucfirst($shareItemRes->productcode); ?>  </td>
                                                                <td><?php echo fetch_ucfirst($shareItemRes->productname); ?>    </td>

                                                                <td> <?php echo fetch_ucfirst($shareUserRes->usercode); ?></td>
                                                                <td> <?php echo fetch_ucfirst($shareUserRes->username); ?></td>

                                                                <td> <?php echo fetch_ucfirst($shareUserRes->user_qty); ?>| KG</td>
                                                                <td>  ₹ <?php echo fetch_ucfirst($shareUserRes->unit_price); ?></td>
                                                                <td>  ₹ <?php echo fetch_ucfirst($shareUserRes->total_amount); ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table> 
                                                </div>
                                            <?php }
                                        }
                                        else
                                        {
                                        ?>
                                         <div class="clearfix"></div>
                                            <span class="accordion bg-pr ">  
                                                <div class="alert alert-danger">No Share cart items found.Please share the cart to continue.</div>
                                            </span>
                                        <?php } ?>
                                        <!-- Accodian ends here -->
                          </div>
                        </div>
                          
                                    </div>   
                                </div>
                            </div>
                        </div>
                        <!-- tabs ends here -->
                                </div><?php } ?>
                                 
                            </div>
                        </div>


                    </div>

                </div>
                <!-- end of the edit profile -->
                
               
            </div><!-- end of 9 col -->
                
               
            </div><!-- end of 9 col -->
            
        </div>

    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
   
 </body>
 <script>
//accodion 
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  }
}
</script>
</html>
