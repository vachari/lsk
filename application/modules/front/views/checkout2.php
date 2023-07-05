<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>:: Shoperative ::</title>
        <link href="<?php echo CSS_PATH; ?>jquery-ui.css" rel="stylesheet" />
        <link href="<?php echo CSS_PATH; ?>bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo CSS_PATH; ?>font-awesome.min.css" rel="stylesheet" />
        <link href="<?php echo CSS_PATH; ?>main.css" rel="stylesheet" />
        <link href="<?php echo CSS_PATH; ?>menu.css" rel="stylesheet" />
        <link href="<?php echo CSS_PATH; ?>tabs.css" rel="stylesheet" />
        <link href="<?php echo CSS_PATH; ?>accod.css" rel="stylesheet" />
        <link href="<?php echo CSS_PATH; ?>jquery-ui-1.11.icon-font.min.css" rel="stylesheet" />
        <link href="<?php echo CSS_PATH; ?>jquery-ui.icon-font.min.css" rel="stylesheet" />

        <link href="<?php echo CSS_PATH; ?>responsive.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css"  href="<?php echo CSS_PATH; ?>bliss-slider.css">
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        <style type="text/css">
            .share-share{
                margin: -45px 0 0px -15px;}
            </style>
            
        </head><!--/head-->
        <body class="popup " id="font-maven" >
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
            <?php $this->load->view('includes/header.php'); ?>
        </div>
        <section> 
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full-bg ">

                <div class="col-md-12 "> 
                    <!-- <h2 class="text-titel"> <b> ABOUT US </b></h2> -->
                    <div class="container">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>"> Home </a></li>
                            <li class="active">Checkout</li>
                        </ol>
                    </div>

                </div>
                <div class="col-md-12 content_text "> 
                    <div class="container martop150">
                        <h2>  Checkout</h2>
                        <div class="">
                            <div class="col-md-9">
                                <div class="">
                                    <!-- Nav tabs --><div class="card">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a onclick="myCartPrices('1')" href="#mycart" aria-controls="mycart" role="tab" data-toggle="tab"> <i class="fa fa-shopping-cart fa-2x" aria-hidden="true" style="color:#80d240;z-index: 100"></i>   &nbsp;  My Cart  </a></li>
                                            <li role="presentation"><a onclick="myCartPrices('2')" href="#sharecart" aria-controls="sharecart" role="tab" data-toggle="tab"><i class="fa  fa-cart-plus fa-2x" aria-hidden="true" style="color:#ffa500;"></i>  &nbsp; Share Cart </a> </li>

                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="mycart">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th><input type="checkbox" id="checkAll"  ></th> -->
                                                            <th>S.no</th>
                                                            <th>Item</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Total</th>
                                                            <th></th>

                                                        </tr>
                                                    </thead>


                                                    <tbody >
                                                        <?php 
                                                        $items = json_decode($cartList);
                                                        if($items->code != 200 ){
                                                 echo '<tr ><td colspan="10" class="alert alert-danger text-center">Products not found</td></tr>';
                                             }
                                                 else{
                                                        $i=1;
                                                        foreach ($items->cart_result as $cart) {
                                                            ?>

                                                            <tr>
                                                                <!-- <td class=""><input type="checkbox" class="inline-checkbox" name="multiple[]" value="" ></td> -->
                                                                <td><?php echo $i; ?></td>
                                                                <td>
                                                                    <img src="<?php echo $cart->product_image; ?>"
                                                                         style="height:50px;width:50px;" > <?php echo $cart->prod_name; ?>
                                                                </td>

                                                                <td>
                                                                    <!-- <button id="minus" class="btnminus">-</button> -->

                                                                    <div class="qty_pan">
  <input type='button' value='-' class='qtyminus btn btn-danger btn-sm' field='quantity' onclick="decQty(<?php echo $cart->cart_id; ?>);" />
  <input type='text' name='quantity' value='<?php echo  $cart->qty;?>' class='qty' style="width: 60px;text-indent: 20px" min="1" id="qty<?php echo $cart->cart_id; ?>" />
            <input type='button' value='+' class='qtyplus btn btn-success btn-sm' field='quantity' onclick="incQty(<?php echo $cart->cart_id; ?>);" />

                                                                    </div>
                                                                    <!-- <button id="plus" class="btnplus">+</button> -->



                                                                </td>
                                                                <td>
                                                                    <?php echo $cart->selling_price; ?>
                                                                </td>
                                                                <td id="total">
                                                                    <?php
                                                                    $sell_amount = $cart->selling_price;
                                                                    $sell_qty = $cart->qty;
                                                                    echo $sell_qty * $sell_amount;
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                     <button class="btn btn-danger"><i class="glyphicon glyphicon-trash" onclick="cartRemove(<?php echo $cart->cart_id;?>)"></i></button>
                                                                </td>
                                                            </tr>

                                                        <?php $i++; }}
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="sharecart">

                                                <div class="">
                                                    <!-- Nav tabs -->
                                                    <div class="card">

                                                        <ul class="nav nav-tabs" role="tablist">
                                                            <li role="presentation" class="active"><a href="#shartcart-item" aria-controls="shartcart-item" role="tab" data-toggle="tab">share cart-by user</a></li>
                                                            <li role="presentation"><a href="#share-group" aria-controls="share-group" role="tab" data-toggle="tab" class="pull-left">share cart-by Item</a> </li>

                                                        </ul>
       <form method="post" name="sharecartfb" id="sharecartfb" action="<?php //echo base_url().'front/Cart/addsharecart';?>">
        <div class="col-md-12 share-share">
            <div class="pull-right">
            
                <?php if($this->session->userdata('user_type') == 2){ ?> 
                 <a href="javascript:void(0)" class="" data-toggle="" data-placement="top" title="Share cart end date" style="text-decoration: none;color:#000">
                       <span for="Cart End Data">End Date 
                       <input type="text" placeholder="Share cart end date" id="datepicker" name="datepicker" onkeyup="if(this.value == '') document.getElementById('fb').disabled = false; else document.getElementById('fb').disabled = true;"
></span>
                    </a> 
                <!-- a href="" class="" data-toggle="" data-placement="top" title="share to Facebook">
                    <i class="fa fa-share-alt-square fa-lg" aria-hidden="true"></i></a> -->
                
                <?php
                $title = urlencode('Shoperative');
                $session_id = $this->session->userdata('cart_session_id');
                $url = urlencode(base_url() . 'front/cart/follower_session_id/' . $session_id);
                $image = urlencode(SITE_DOMAIN .'/images/shop1.jpg');
                ?>
               <a href="javascript:void(0);" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');"  data-toggle="" data-placement="top" title="share to Facebook" target="_parent"  id="fb" class="btn btn-md btn-primary disabled " style="font-size: 23px;padding: 0px 14px;"> f</a>
                <?php }?>
            </div>
        </div></form>
                                        

                                                        <!-- Tab panes -->
                                                        <div class="tab-content">
                                                            <div role="tabpanel" class="tab-pane active" id="shartcart-item">
                                                                <!-- share item cart starts form here -->

                                                                <!-- Accodian starts from here -->      
                                                                <div class="col-md-12 bg_head_acc">
                                                                    <div class="col-md-3">
                                                                        User-Details
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        Username
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        Total Items
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        Total Price 
                                                                    </div> 
                                                                </div>    
                                                                <!--
                                                                Repeating section code start
                                                                -->
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
                                                                                <?php echo fetch_ucfirst($shareUserRes->username); ?>
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
                                                                                        <td><?php echo $shareUserRes->usercode; ?></td>
                                                                                        <td> <?php echo fetch_ucfirst($shareUserRes->username); ?></td>
                                                                                        <td> <?php echo fetch_ucfirst($shareItemResponse->productcode); ?></td>
                                                                                        <td> <?php echo fetch_ucfirst($shareItemResponse->productname); ?></td>
                                                                                        <td> <?php echo $shareItemResponse->qty; ?> | KG</td>
                                                                                        <td> ₹ <?php echo $shareItemResponse->unit_price; ?>
                                                                                        <td> ₹ <?php echo $shareItemResponse->total_amount; ?></td>
                                                                                    </tr>
                                                                                <?php } ?>
                                                                            </table> 
                                                                        </div>
                                                                    <?php }
                                                                }
                                                                ?>
                                                                <!--
                                                                    Share cart by User Repeating section code end
                                                                -->


                                                                <!-- Accodian ends here -->

                                                                <!-- share item cart ends form here -->
                                                            </div>
                                                            <div role="tabpanel" class="tab-pane" id="share-group">
                                                                <!-- Accodian starts from here -->      
                                                                <div class="col-md-12 bg_head_acc_share">
                                                                    <div class="col-md-3">
                                                                        Item-Code
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        Item Name
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        Total.Orders
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        Total.Price 
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
                                                                                        <td><?php echo fetch_ucfirst($shareItemRes->productname); ?>   </td>

                                                                                        <td> <?php echo fetch_ucfirst($shareUserRes->usercode); ?></td>
                                                                                        <td> <?php echo fetch_ucfirst($shareUserRes->username); ?></td>

                                                                                        <td> <?php echo fetch_ucfirst($shareUserRes->user_qty); ?> | KG</td>
                                                                                        <td>  ₹ <?php echo fetch_ucfirst($shareUserRes->unit_price); ?></td>
                                                                                        <td>  ₹ <?php echo fetch_ucfirst($shareUserRes->total_amount); ?></td>
                                                                                    </tr>
        <?php } ?>
                                                                            </table> 
                                                                        </div>
                                                                    <?php }
                                                                }
                                                                ?>
                                                                <!-- Accodian ends here -->
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- tabs ends here -->
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                             <?php 
                $cartStatisticsReq=json_decode($cartStatistics);
                if($cartStatisticsReq->cart_count !=0){
                ?>
                                <div class="col-md-3 bg_gray">
                                    <h3 id="cart_summary_titile">Order Summary</h3>
                                    <hr>
                                    <?php
                                    $cartStatisticsReq = json_decode($cartStatistics);
                                    ?>
                                    <table class="table table-bordered ">
                                        <tr>
                                            <td>Total Item Count</td>
                                            <td ><p id="cart_item_count" class="pull-right">
<?php echo $cartStatisticsReq->cart_count; ?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sub total</td>
                                            <td class="text-right">
                                                <p id="cart_subtoal">
                                                  <?php echo $cartStatisticsReq->cart_amount; ?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Service Charge</td>
                                            <td class="text-right">
                                                <p id="cart_service_charges><?php echo $cartStatisticsReq->cart_service_charge; ?></p>

                                                   </td>
                                                   </tr>
                                                   <tr>
                                                   <td>Shipping Charges</td>
                                                   <td  class="text-right">
                                            <p id="cart_shiiping_charges">
<?php echo $cartStatisticsReq->cart_shipping; ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discount </td>
                                        <td  class="text-right">
                                            <p id="cart_discount_charges">
<?php echo $cartStatisticsReq->cart_discount; ?>
                                            </p>
                                        </td>
                                    </tr>

                                </table>
                                <hr>

                                <h4 class="pull-left text-red">Grand Total</h4>
                                <h4 class="pull-right text-red" id="cart_grand_total">

<?php echo $cartStatisticsReq->cart_grand_total; ?>
                                </h4>
                                <hr>
                                <div class="text-center">
                                    <a href="<?php echo base_url().'shipping';?>" class="btn  btn-md btn-gand" >Continue to Checkout</a>
                                </div>
                                </table>
                            </div><?php }?>
                        </div>
                    </div>
                </div>
              </div>
    </section>


<?php $this->load->view('includes/footer'); ?>
    <script src="<?php echo JS_PATH; ?>jquery.js"></script>
    <script src="<?php echo JS_PATH; ?>jquery-ui.js"></script>
    <script src="<?php echo JS_PATH; ?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH; ?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH; ?>bliss-slider.js"></script>
    


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
<script type="text/javascript">


    function myCartPrices(data)
    {
        // alert(data);
        var dispTitle = 'Share Cart Order Summary';
        if(data == 1)
        {
            dispTitle = 'My Cart Order Summary';
        }

        $('#cart_summary_titile').html(dispTitle);
        $.ajax({
            dataType: 'JSON',
            type: 'POST',
            async: false,
            data: {'carttype': data},
            url: basepath + 'front/Checkout/getCartProperties',
            success: function (cart) {
                console.log(cart);
                $('#cart_item_count').html(cart.cart_count);
                $('#cart_subtoal').html(cart.cart_amount);  
                $('#cart_service_charges').html(cart.cart_service_charge);
                $('#cart_shiiping_charges').html(cart.cart_shipping);
                $('#cart_discount_charges').html(cart.cart_discount);
                $('#cart_grand_total').html(cart.cart_grand_total);

            },
            error: function (error) {
                console.log(error);
            }

        });

    }


</script>

 <script>
   
    $('.qtyplus').click(function (e) {
    e.preventDefault();
    var $this = $(this);
    var $target = $this.prev('input[name=' + $this.attr('field') + ']');
    var currentVal = parseInt($target.val());
    if (!isNaN(currentVal)) {
        $target.val(currentVal+1);
    } else {
        $target.val(0);
    }
});
$(".qtyminus").click(function (e) {
    e.preventDefault();
    var $this = $(this);
    var $target = $this.next('input[name=' + $this.attr('field') + ']');
    var currentVal = parseInt($target.val());
    if (!isNaN(currentVal)) {
        $target.val((currentVal == 0) ? 0 :currentVal-1);
    } else {
        $target.val(0);
    }
});
    
 function cartRemove(ids){
      if(ids!=''){
         $('#fail').hide();
      $('.success').hide();
         $.ajax({
          dataType:'json',
          type:'post',
          data:{'tablename':'cart','updatelist':ids},
          url:'<?php echo base_url();?>front/User/commonDelete/',
          success: function (u) {
                    console.log(u);
                    if(u.code=='200'){$('#success').show();$('#successmessage').html('Item successfully deleted form cart').addClass('text-center alert alert-success');setTimeout(function() {window.location=location.href;},2000);}
    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');}
                },
          error:function(er){
            console.log(er);
          }
        });
      }
      else{
       $('#fail').show();$('#failmessage').html('*  Please Select ').addClass('alert alert-danger');
      }
    }

  function  incQty(id)
 {

  var qty= parseInt($('#qty'+id).val());
// alert(qty);
   var newqty=qty+1;
    updateCart(id,newqty);
 }
 function  decQty(id)
 {

  var qty= parseInt($('#qty'+id).val());
// alert(qty);
   var newqty =qty-1;
    updateCart(id,newqty);
 }

 function updateCart(id,newqty)
 {
 // alert(id);
     if(id !='' && newqty > 0 ){ 
        $.ajax({
          dataType:'json',
          type:'post',
          data:{'cart_id':id,'qty':newqty},
          url:'<?php echo base_url();?>front/Cart/cartUpdate/',
           success: function (u) {
                 console.log(u);
                   if(u.code=='200'){  updateData(id,newqty);}
                if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');}
           },
           error:function(er){
            console.log(er);
          }
        });
     }
      else{
       $('#fail').show();$('#failmessage').html('Unable to update').addClass('text-center alert alert-danger');setTimeout(function() {window.location=location.href;},2000);
      }

}
   
   function updateData(id,newqty){
    // alert(newqty);
       $.ajax({
        dataType:'JOSN',
        type: "POST",
        data: {'cart_id':id,'qty':newqty},
        url: "<?php echo base_url(); ?>front/Cart/getCartData",
        success: function (data) {
                   // var u=data.result;
                  //  console.log(data);
                     // alert(data.cart_amount );
                    $('#total').html(data.cart_amount );
                    $('#cart_subtoal').html(data.cart_amount );
                    $('#cartCount').html(data.cart_count);
                    $('#cartAmount').html(data.cart_amount);
                    $('#cartDiscount').html(data.cart_discount);
                    $('#cart_grand_total').html(data.cart_grand_total);
                    $('#cart_qty').html(data.cart_qty);
                    

                },
                error: function (er) {
                    console.log(er);
                }
    });

   }

</script>
<script>
$( "#datepicker" ).change(function() {
         $('#fb').removeClass('disabled');
        });
        
          $( function() {
            $( "#datepicker" ).datepicker({minDate: 0});

          } );
           
            $("#datepicker").click(function(){
                $("#sharefb").click(function(){
                    var date_select = $('#datepicker').val();
                    console.log(date_select);
                    var flag=true;
                    $('#span_datepicker').html('');
                    $('#datepicker').css('border','');
                    if(date_select==""){
                    flag=false;
                    $('#datepicker').css('border','1px solid red');
                    }
                    else
                    {
                          $.ajax({
                            dataType: 'JSON',
                            type: 'POST',
                            async: false,
                            data: {'datepicker': date_select},
                            url: basepath + 'front/Cart/addsharecart',
                            success: function (sharecartfb) {
                            console.log(sharecartfb);
                              },
                            error: function (error) {
                            console.log(error);
                             }

                         }); 
                        window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title; ?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image; ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');
                    }

                     return flag;
                });
          });

  </script>

</html>
