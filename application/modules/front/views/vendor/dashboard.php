
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
    <style type="text/css">
    .input-box-pad {padding: 10px;}
    .info-box {background-color: #eee !important; margin-bottom: 10px; min-height: 100px;padding: 10px;}
    
    </style>     
</head><!--/head-->

<body class="popup">

    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
            <?php  $this->load->view('vendor/includes/header.php');?>
    </div>

    <section>
        <div class="container martop150">
            <div class="col-md-3 bg_profile ">
                <div class="col-xs-12 mrtop">
                     <ul class="profile-side-bar">
                        <li class="active"> <a href=" <?php echo base_url().'vendor/dashboard'; ?>"> Dashboard</a></li>
                         <li  > <a href="<?php echo base_url().'vendor/profile'; ?>"> My Profile</a></li>
                         <li> <a href="<?php echo base_url().'vendor/products'; ?>">Create/Manage Products</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-inventory'; ?>">Product Inventory/Availability</a></li>
                         <li> <a href="<?php echo base_url().'vendor/assign-products-to-group'; ?>">Assign Products To Group</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-wise-prices'; ?>">Product Wise Prices</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-group-wise-prices'; ?>">Product Group Wise Prices</a></li>
                         <li> <a href="<?php echo base_url().'vendor/manage-shippers'; ?>">Manage Shippers</a></li>
                         <li> <a href="<?php echo base_url().'vendor/manage-shipping-cost'; ?>">Manage Shipping Cost</a></li>
                         <li> <a href="<?php echo base_url().'vendor/all-open-orders'; ?>">View All Open Orders</a></li>
                        <!-- <li class=""> <a href="<?php echo base_url().'vendor/all-confirmed-orders'; ?>">View All Confirmed Orders</a></li>-->
                         <li class=""> <a href="<?php echo base_url().'vendor/all-dispatched_orders'; ?>">View All Dispatched Orders</a></li>
                         <!-- <li class=""> <a href="<?php echo base_url().'vendor/all-cancelled_orders'; ?>">View All Cancelled Orders</a></li>-->
                         <li class=""> <a href="<?php echo base_url().'vendor/all-delivered-orders'; ?>">View All Closed Orders</a></li>
                         <li> <a href="<?php echo base_url().'vendor/assign-orders-to-shipper'; ?>">Assign Orders To Shipper</a></li>
                         <li> <a href="<?php echo base_url().'vendor/accounts-receivable'; ?>">Accounts Receivable</a></li>
                         <li > <a href=" <?php echo base_url() . 'vendor/change-password'; ?>"> Change Password   </a></li>
                         <li> <a href=" <?php echo base_url() . 'vendor/logout'; ?>"> Logout   </a></li>
                     </ul>
                </div>
                 <div style="height:300px" class="hidden-xs"></div>
                

            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                
                <div class="col-md-12">
                <?php
                    if($this->session->flashdata('success'))
                    {
                       // echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                        }
                    if($this->session->flashdata('failed'))
                    { 
                        //echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                     } ?>

                    <div class="header-title">
                        <h3>Vendor Dashboard </h3>
                        <hr style="margin-top: -5px;"> 
                    </div>
                   
                </div>
                <!-- Shipping report -->
       <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 content-header"> 
          <!-- <h4>Shipping</h4><br> -->
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class=""><a href="<?php echo base_url().'vendor/all-open-orders' ?>"> All Open Orders</a></span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class=""><a href="<?php echo base_url().'vendor/orders-due-for-delivery-by-due-date' ?>"> Orders-due for delivery by Due-Date </a></span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
       <div class="clearfix visible-sm-block"></div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class=""><a href="<?php echo base_url().'vendor/all-open-orders' ?>"> Orders-due for delivery by Delivery-Location</a></span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i  class="pd21 fa fa-users"></i></span>

            <div class="info-box-content">
              <span class=""><a href="<?php echo base_url().'vendor/manage-shippers'; ?>"> Registered Shipping-Agents</a></span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-fuchsia"><i  class="pd21 fa fa-money"></i></span>

            <div class="info-box-content">
              <span class=""><a href="<?php echo base_url().'vendor/manage-shipping-cost'; ?>"> Shipping Cost Table </a></span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix">&nbsp;</div><div class="clearfix">&nbsp;</div>
      <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box input-box-pad">
              <p class="text-center"><b><u>Transactions</u></b></p>
              <p class="text-center"><a href=""> Print Shipping-Address Labels</a></p>
              <p class="text-center"><a href=""> Print Packing-Lists</a></p>
              <p class="text-center"><a href=""> Record Shipping Details by Order Number</a></p>
              <p class="text-center"><a href=""> Manage Sales Returns</a></p>
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
         <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box input-box-pad">
              <p class="text-center"><b><u>Reports</u></b></p>
              <p class="text-center"><a href=""> Shipped Delivery-Orders List</a></p>
              <p class="text-center"><a href=""> Sales Returns by Reason</a></p>
              <p class="text-center"><a href=""> Lost Deliveries</a></p>
              <p class="text-center"><a href=""> Delayed Deliveries</a></p>
            </div>
            <!-- /.info-box -->
        </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- shipping report -->
            </div><!-- end of 9 col -->
            
        </div>

    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
   
 </body>
</html>
