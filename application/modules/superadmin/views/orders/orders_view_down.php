<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Orders</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" type="text/css" href="<?php echo SUPER_CSS_PATH ; ?>bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>font-awesome.min.css">
  <!-- Ionicons -->
 <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>gharaahaar1.css">
   <link href="<?php echo CSS_PATH;?>accod.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>_all-skins.min.css">

</head>
<body class="hold-transition skin-blue sidebar-mini" onload="printDiv()">
  <div style="width: 800px;margin: 0 auto;border:1px solid #eee;">
    <section class="content-header">
      <h1>
        <!-- Orders Details -->
      </h1>
    </section>
    <!-- Main content -->
    <section class="" >
      <div class="col-md-12 col-sm-12 pd0">
        <div class="col-md-12 pull-right text-right">
          <div class="div-md-12 text-center">
              <!-- <img src="http://realrichies.com/gharaahaar/assets/images/logo.png" alt="Gharadhar" class="img-responsive" style="margin: 0 auto;"> -->
          </div>
           <!-- <input type='button' id='printbtn' value='Print' class="btn btn-info btn-sm"> -->
           <!-- <input type='button' id='btn' value='Print' class="btn btn-info btn-sm" onclick='printDiv();'> -->
        <!-- <a href="<?php echo base_url().'superadmin/Orders' ?>" class="btn btn-primary btn-sm"> Back </a> -->
      </div>
      </div>
        <div class="box-body mrtop" >
          <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <table style="width: 100%">
      <?php $ordersdata=json_decode($ordersdata); 
                          // print_r($ordersdata->result);
      foreach ($ordersdata->result as $od) {
      
      ?>
        <tbody>
          <tr>
            <td colspan="15" style="text-align: center;"> 

              <img src="http://realrichies.com/gharaahaar/assets/images/logo.png" alt="Gharadhar" class="img-responsive" style="margin: 0 auto;">
           </td>
          </tr>
          <tr>
            <th>

                <table class="table borderless" width="350px"  style="text-align: left">
                <tbody>
                  <tr>
                    <td colspan="3"><h3>Order Information</h3></td>
                  </tr>
                  <tr>
                    <td>  Order #  </td>
                    <td>:</td>
                    <td>  <p class="bord"> &nbsp;  <?php echo $od->ordernumber; ?> </p> </td>

                  </tr>
                <tr>
                  <td>  Order Date  </td>
                  <td>:</td>
                  <td>  <p > &nbsp;
                    <?php 
                    $originalDate=$od->orderdate;
                    $newDate = date("d-M-Y ", strtotime($originalDate));
                    $newTime = date("h:i:s a", strtotime($originalDate));
                    echo $newDate." ".$newTime;
                    ?>  </p> 
                  </td>

                </tr>
                <tr>
                    <td>  Shipping Date  </td>
                    <td>:</td>
                    <td>  <p><?php  echo $newDate." ".$newTime; ?> </p></td>
                </tr>
                </tbody>
                </table>

            </th>
            <th>
                  <table class="table borderless" width="100%" style="text-align: left">
                  <tbody>
                  <tr>
                    <td colspan="3"><h3>Shipping Information</h3></td>
                  </tr>
                  <tr>
                  <td>  Shipping Date  </td>
                  <td>:</td>
                  <td>  <p class="bord"> &nbsp;  May 29 , 2017 </p> </td>

                  </tr>
                  <tr>
                  <td>  Track Number  </td>
                  <td>:</td>
                  <td>  <p> Compleated </p></td>
                  </tr>
                  <tr>
                  <td> Shipping Form  </td>
                  <td>:</td>
                  <td >  
                  <p>Fedex </p>
                  <p>Pp.000025,Loream Ipsun 300422 </p>
                  <p>India </p>
                  <p>fedex@info.com </p>

                  </td>
                  </tr>
                  </tbody>
                  
                  </table>
            </th>

          </tr>

        </tbody>
    <?php }?>
    </table>
                    
                 <?php $uri=base64_decode($this->uri->segment(5)); if($uri == 1){ ?>
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
                        <?php $items = json_decode($cartList);

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
                            </div>    <?php }else{?>
                             <!-- tabs -->
                        <div class="col-md-12 no-pad">
                            <!-- Nav tabs -->
                            <div class="">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">User wise</a></li>
                                    <li role="presentation" ><a href="#item" aria-controls="item" role="tab" data-toggle="tab">Item wise</a></li>

                                </ul>
                                <div class="col-md-12 share-share">
                                    <div class="pull-right">
                                    <!-- <a href="" class=" " data-toggle="" data-placement="top" title="share to Facebook"><i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i></a>
                                    <a href="" class=" " data-toggle="" data-placement="top" title="share to Facebook"><i class="fa fa-share-alt-square fa-lg" aria-hidden="true"></i></a> -->
                                      <!--   <a href="<?php echo base_url(); ?>checkout" class="btn btn-info btn-md"> View Share Cart</a> -->
                                    </div>
                                </div>
                                <?php
                               
                                $sharecart_req = json_decode($sharecart_result);  
                                $sharecart_user = $sharecart_req->sharecart_user;
                                $sherecart_item = $sharecart_req->sharecart_item;
                                ?>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="user"> 
                                        <!-- tab1 -->

                                        <!-- Accodian starts from here -->      
                                        <div class="col-md-12 bg_head_acc">
                                            <div class="col-md-3">
                                                User ID
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
                                        <?php
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
                                    <div role="tabpanel" class="tab-pane  " id="item">
                                        <!-- tab2 start -->
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
                                        else
                                        {
                                        ?>
                                         <div class="clearfix"></div>
                                            <span class="accordion bg-pr ">  
                                                <div class="alert alert-danger">No Share cart items found.Please share the cart to continue.</div>
                                            </span>
                                        <?php } ?>




                                        <!-- Accodian ends here -->


                                        <!-- tab2 ends -->
                                    </div>   

                                </div>
                            </div>
                        </div>
                        <!-- tabs ends here -->
                                </div><?php } ?>
                                 
                            </div>
                        </div>
                
                  
          </div> 
            
          <?php echo form_close(); ?>
              
        </div>
            <!-- /.box-body -->
          
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>  
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo SUPER_JS_PATH; ?>bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo SUPER_JS_PATH; ?>fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SUPER_JS_PATH; ?>app.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo SUPER_JS_PATH; ?>jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo SUPER_JS_PATH; ?>Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo SUPER_JS_PATH; ?>dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo SUPER_JS_PATH; ?>demo.js"></script>
</body>
</html>
<script>
//accodion 
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
   $(this).tab('show');
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
<script>


function printDiv() 
{
window.print();

}
</script>
    