<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Order Status </title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style type="text/css">.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 0px solid #ddd;
}.mrtop{margin-top: 15px;}.bord {
    border: 1px solid #eae6e6;
}   .bg_darkgray {
    background-color: #e4e4e4;
}.no-pad {
    padding: 0px !important;
}

</style>
  </head>
  <body>
   <div class="container">
        <table class="table table-bordered">
            <tr>
                <th  colspan="4" class="text-center"><center>
              <a href="<?php echo SITE_DOMAIN ?>"><img src="<?php echo SITE_DOMAIN ?>/assets/images/logo.png" alt="" class="img-responsive"></a> </center> </th>
            </tr>
           
        </table>
    </div>
    <?php $check =json_decode($checkoutStatistics);?>
    <!-- Order status email stats form here -->
     <div class="container" width="50%">

                    <div class="header-title mrtop">
                        <h4>Orders Status</h4>
                        <hr style="margin-top:-5px;"> 
                    </div>
                    <div class="col-md-9 col-md-offset-2"> 
                        <div class="col-md-12 mrtop  "> 
                            <div class="col-md-12 bord no-pad">
                                <div class="panel-heading bg_darkgray"> 
                                     <h4 class="panel-title" style="padding: 10px;">  Order Id : <?php echo $order_data['order_number']; ?></h4>
                                </div>
                                <div class="panel-body">
                                    <p>General Details </p>
                                    <div class="col-md-9"> 
                                        <table class="table borderless" width="400">
                                            <tr>
                                            <?php 
                                        $originalDate=$order_data['order_date'];
                                        $newDate = date("d-M-Y ", strtotime($originalDate));
                                        $newTime = date("h:i:s a", strtotime($originalDate));
                                       
                                    ?> 
                                                <td>  Order Date  :</td>
                                                <td>   <p class="">&nbsp;  <?php  echo  $newDate;?> </p> </td>
                                                 </td>
                                            </tr>
                                            <tr>
                                                <td>  Order Status :</td>
                                                <td>   <p class="">&nbsp; Order Processing </p> </td>
                                            </tr>
                                        </table>
                                   </div>
                                </div>
                            </div>

                <div class="col-md-12 bord mrtop no-pad">
                 <table class="table table-striped table-hover" width="500">
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
                        <?php   ?>
                        <tfoot class="bg_darkgray">

                            <tr> 
                                <th colspan="4"> Sub Total</th>
                                <th> <?php echo "Rs. ".$check->cart_amount; ?></th>
                            </tr>
                            <tr> 
                                <th colspan="4"> Shipping Charges</th>
                                <th>  <?php echo "Rs. ".$check->cart_shipping; ?></th>
                            </tr>
                             <tr> 
                                <th colspan="4"> Processing Fee</th>
                                <th><?php echo "Rs. ".$check->cart_service_charge; ?></th>
                            </tr>
                             <tr> 
                                <th colspan="4">Cart  Discount</th>
                                <th><?php echo "Rs. ".$check->cart_discount; ?></th>
                            </tr>
                            <tr border='1px'>
                                <th colspan="4"> Total </th>
                                <th><?php echo "Rs. ".$check->cart_grand_total; ?></th>
                            </tr> 

                        </tfoot>
                        <?php  ?>
                        </table> 
                            </div> 
                                 <div class="col-md-12 bord no-pad mrtop">
                                    <div class="panel-heading bg_darkgray"> 
                                         <h6 class="panel-title" style="padding: 10px;">  <b>Shipping Information</b></h6>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12"> 
                                            <table class="table borderless">
                                                <tr>
                                                    <td>  Shipping Date  : </td>
                                                    <td>  <p class=""> &nbsp;  May 29 , 2017 </p> </td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td>  Track Number  : </td>
                                                    <td>  <p> Order Processing  </p></td>
                                                </tr>
                                                 <tr>
                                                    <td> Shipping Form  : </td>
                                                    <td>  
                                                   
                                                    <p>India </p>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                       </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
                <!-- end of the edit profile -->
                 <?php  //} ?>
            <div class="footer">
                <div class="container bg_darkgray">
                     <p class="" style="text-align: center;padding: 10px"> All &copy; Rights Reserved by Shoperative 2017. </p>
                </div>
            </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>


