<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>:: Shoperative | Edit Product Price ::</title>
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
                         <li class="active"> <a href="<?php echo base_url().'vendor/product-wise-prices'; ?>">Product Wise Prices</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-group-wise-prices'; ?>">Product Group Wise Prices</a></li>
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
                        <h4> Edit Product Price </h4>
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
                   
                    <?php echo form_open('vendor/product-price-updating',array('id'=>'prod_price_form','name'=>'prod_price_form','method'=>'post')) ?>
                    <input type="hidden" name="id" value="<?php echo $product_price_details->id; ?>">
                    <input type="hidden" name="prod_id" value="<?php echo $product_price_details->prod_id; ?>">
                    <div class="col-md-4">
              <div class="form-group">
                <label for="prod_id">Shoperative Product Code(Name)</label>
                    <select name="prodid" id="prod_id" class="form-control" required disabled>   
                                 <option  value="">--Select Product Code--</option>
                                    <?php if($product_code_list->code==200){
                                     foreach ($product_code_list->result as $row){ ?>
                                    
                                  <option  value="<?php echo $row->id;  ?>" <?php if($row->id == $product_price_details->prod_id) echo "selected"; ?>><?php echo $row->prod_code.' ('.$row->prod_name.')';  ?></option> <?php } } ?>
                              </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <label for="vpc">Vendor Product Code</label>
                <input name="vpc" id="vpc" value="<?php echo $product_price_details->vendor_item_code ?>" class="form-control" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               <label for="sku_qty">SKU Qty</label>
                <input type="text" name="sku_qty" id="sku_qty" value="<?php echo $product_price_details->sku ?>"  class="form-control sku_qty" placeholder="SKU Qty" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <label for="units">Unit Of Measure</label>
                <input name="unit_of_measure" value="<?php echo $product_price_details->unit_of_measure ?>" id="units"  class="form-control" placeholder="UOM" readonly> 
                       </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="qty_range_from">Qty Range From</label>
                    <input type="text" id="qty_range_from" autocomplete="off" name="qty_range_from" value="<?php echo $product_price_details->qty_range_from ?>" placeholder="from" class="form-control" required>
              </div>
            </div>   
            <div class="col-md-4">
              <div class="form-group">
                <label for="qty_range_to">Qty Range To</label>
                <input type="text" autocomplete="off" name="qty_range_to" id="qty_range_to" value="<?php echo $product_price_details->qty_range_to ?>" placeholder="to" class="form-control" required> 
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group">
                <label for="fromdate">From Date </label>
                <input type="date" autocomplete="off" name="form_date" value="<?php echo $product_price_details->form_date ?>" placeholder="form_date" class="form-control" id="fromdate" required> 
                <input type="hidden" name="fromdate" value="<?php echo $product_price_details->form_date ?>">
              </div>
            </div>                                  
            <div class="col-md-4">
              <div class="form-group">
               <label for="todate">To Date </label>
                <input type="date" autocomplete="off" name="to_date" value="<?php echo $product_price_details->to_date ?>" placeholder="to_date" class="form-control" id="todate" required>
                <input type="hidden" name="todate" value="<?php echo $product_price_details->to_date ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="selling_price"> Selling Price</label>
                <input type="text" autocomplete="off" id="selling_price" name="selling_price" value="<?php echo $product_price_details->selling_price ?>" placeholder="Selling Price" class="form-control" required> 
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               <label for="buying_price">Buying Price</label>
                <input type="text" autocomplete="off" id="buying_price" name="buying_price" value="<?php echo $product_price_details->buying_price ?>" placeholder="Buying Price" class="form-control" required> 
              </div>
            </div>  
                                                                       
                        <div class="form-group col-md-12 mrtop text-center">
                        <a href="<?php echo base_url().'vendor/product-wise-prices' ?>" class="btn btn-warning">Go Back</a>     
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
</script>
<script>  
 $(document).on("change","[name^=prod_id]",function(){
                var product_id = $(this).val();
                if (product_id > 0 && !isNaN(product_id)) {
                    $.ajax({
                        dataType: 'JSON',
                        method: 'POST',
                        data: {'product_id': product_id},
                        url: '<?php echo base_url(); ?>front/vendor/get_product_sku',
                        success: function (ss) {
                            if(ss.code == '200')
                            {
                              var res = ss.product_details;
                              $('#vpc').val(res.vendor_item_code)
                              $('#sku_qty').val(res.sku);
                              $('#units').val(res.unit);

                            }
                            else
                            {
                              alert('Something went wrong');
                            }
                        },
                        error: function (se) {
                            console.log(se);
                        }
                    });
                }   
 });
 $(".temp").delay(3000).fadeOut("slow");

</script>  
 </body>
</html>
