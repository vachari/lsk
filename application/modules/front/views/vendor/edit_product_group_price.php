<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>:: Shoperative | Edit Group Wise Product Price ::</title>
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
    .text-danger,.text-red {
    color: #ff0000 !important;
    }
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
                        <li> <a href=" <?php echo base_url().'vendor/dashboard'; ?>"> Dashboard</a></li>
                         <li  > <a href="<?php echo base_url().'vendor/profile'; ?>"> My Profile</a></li>
                         <li> <a href="<?php echo base_url().'vendor/products'; ?>">Create/Manage Products</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-inventory'; ?>">Product Inventory/Availability</a></li>
                         <li> <a href="<?php echo base_url().'vendor/assign-products-to-group'; ?>">Assign Products To Group</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-wise-prices'; ?>">Product Wise Prices</a></li>
                         <li class="active"> <a href="<?php echo base_url().'vendor/product-group-wise-prices'; ?>">Product Group Wise Prices</a></li>
                         <li> <a href="<?php echo base_url().'vendor/manage-shippers'; ?>">Manage Shippers</a></li>
                         <li> <a href="<?php echo base_url().'vendor/manage-shipping-cost'; ?>">Manage Shipping Cost</a></li>
                         <li> <a href="<?php echo base_url().'vendor/all-open-orders'; ?>">View All Open Orders</a></li>
                         <li class=""> <a href="<?php echo base_url().'vendor/all-confirmed-orders'; ?>">View All Confirmed Orders</a></li>
                         <li class=""> <a href="<?php echo base_url().'vendor/all-dispatched_orders'; ?>">View All Dispatched Orders</a></li>
                         <li class=""> <a href="<?php echo base_url().'vendor/all-cancelled_orders'; ?>">View All Cancelled Orders</a></li>
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
                    <div class="header-title">
                        <h4> Edit Group Wise Product Price </h4>
                        <hr style="margin-top: -5px;"> 
                    </div>
                    <?php if ($this->session->flashdata('Success')) { ?>
                        <div class="alert alert-success temp">      
                            <?php echo $this->session->flashdata('Success') ?>
                        </div>
                    <?php } ?> 
               <?php if ($this->session->flashdata('Failed')) { ?>
                        <div class="alert alert-danger temp">      
                            <?php echo $this->session->flashdata('Failed') ?>
                        </div>
                    <?php } ?>   
                   
                    <?php echo form_open('vendor/product-group-price-updating',array('id'=>'prod_price_form','name'=>'prod_price_form','method'=>'post')) ?>
                    <input type="hidden" name="id" value="<?php echo $product_group_price_details->id; ?>">
                    <input type="hidden" name="prod_group" value="<?php echo $product_group_price_details->prod_group; ?>">
                    <div class="col-md-4">
              <div class="form-group">
                <label for="prod_group">Product Group</label>
                    <select name="prodgroup" id="prod_group" class="form-control" required disabled>   
                                 <option  value="">--Select Product Group--</option>
                                    <?php if($groups->code==200){
                                     foreach ($groups->result as $row){ ?>
                                    
                                  <option  value="<?php echo $row->id;  ?>" <?php if($row->id == $product_group_price_details->prod_group) echo "selected"; ?>><?php echo $row->group_name.' ('.$row->group_code.')';  ?></option> <?php } } ?>
                              </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <label for="units">Unit Of Measure</label>
                <select name="unit_of_measure" id="units" class="form-control" required disabled>   
                                 <option  value="">--Select UOM--</option>
                                    <?php if($units->code==200){
                                     foreach ($units->result as $row){ ?>
                                    
                                  <option  value="<?php echo $row->id;  ?>" <?php if($row->id == $product_group_price_details->unit_of_measure) echo "selected"; ?>><?php echo $row->unit_code; ?></option> <?php } } ?>
                              </select> 
                       </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="qty_range_from">Qty Range From</label>
                    <input type="text" id="qty_range_from" autocomplete="off" name="qty_range_from" value="<?php echo $product_group_price_details->qty_range_from ?>" placeholder="from" class="form-control" required>
              </div>
            </div>   
            <div class="col-md-4">
              <div class="form-group">
                <label for="qty_range_to">Qty Range To</label>
                <input type="text" autocomplete="off" name="qty_range_to" id="qty_range_to" value="<?php echo $product_group_price_details->qty_range_to ?>" placeholder="to" class="form-control" required> 
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group">
                <label for="fromdate">From Date </label>
                <input type="date" autocomplete="off" name="from_date" value="<?php echo $product_group_price_details->from_date ?>" placeholder="form_date" class="form-control" id="fromdate" required> 
                <input type="hidden" name="fromdate" value="<?php echo $product_group_price_details->from_date ?>">
              </div>
            </div>                                  
            <div class="col-md-4">
              <div class="form-group">
               <label for="todate">To Date </label>
                <input type="date" autocomplete="off" name="to_date" value="<?php echo $product_group_price_details->to_date ?>" placeholder="to_date" class="form-control" id="todate" required>
                <input type="hidden" name="todate" value="<?php echo $product_group_price_details->to_date ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="selling_price"> Selling Price</label>
                <input type="text" autocomplete="off" id="selling_price" name="selling_price" value="<?php echo $product_group_price_details->sellingprice ?>" placeholder="Selling Price" class="form-control" required disabled> 
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               <label for="buying_price">Buying Price</label>
                <input type="text" autocomplete="off" id="buying_price" name="buying_price" value="<?php echo $product_group_price_details->buyingprice ?>" placeholder="Buying Price" class="form-control" required disabled> 
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               <label for="discount">Discount(%)</label>
                <input type="text" autocomplete="off" id="discount" name="discount" value="<?php echo $product_group_price_details->discount ?>" placeholder="Discount(%)" class="form-control" required> 
              </div>
            </div>  
                                                                       
                        <div class="form-group col-md-12 mrtop text-center">
                        <a href="<?php echo base_url().'vendor/product-group-wise-prices' ?>" class="btn btn-warning">Go Back</a>     
                           <input type="submit" id="btn_submit" name="btn_submit" value=" Update " class="btn btn-profile">
                        </div>
                    <?php echo form_close() ?>
                    </div>
                </div><!-- end of 9 col -->
            </div><!-- end of container -->

    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  $('#fromdate').datepicker({ minDate: 0,changeMonth: true,changeYear: true});
  $('#todate').datepicker({ minDate: 0,changeMonth: true,changeYear: true});
  });
  $(".temp").delay(3000).fadeOut("slow");
</script>
 </body>
</html>
