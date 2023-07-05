<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Edit Product Price</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>_all-skins.min.css">
<link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>jquery-ui.css">
  <!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
  <link rel="stylesheet" href="/resources/demos/style.css">
 

  <style type="text/css">.no-pad{
    padding-left: 0px !important;
    padding-right: 0px !important;}
    .highlight {
    background-color: yellow;
  }
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view("includes/header.php");?>
 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
   <?php $this->load->view("includes/sidebar.php");?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Product Pricing
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>Product/itemPricingList"><i class="fa fa-dashboard"></i> Manage Product Pricing</a></li>
        <li class="active"> Update Product Pricing</li>
      </ol>
    </section>
    <?php //print_r($product_details); ?>
    <!-- Main content -->
    <section class="content">
			<div class="row">
				<div class="col-md-12  ">
					<div class="box box-primary">
            <?php if($this->session->flashdata('success')){echo "<div class='alert alert-success temp'>".$this->session->flashdata('success')."</div>";}
          if($this->session->flashdata('failed')){
          echo "<div class='alert alert-danger temp'>".$this->session->flashdata('failed')."</div>"; } ?>
						<div class="box-header with-border">
						<h3 class="box-title"> Update Product Pricing</h3>
						<a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>Product/itemPricingList" class="btn btn-primary pull-right">Go Back </a>
						</div>
						<!-- /.box-header -->
						<!-- form start -->

					<?php  
                
                    $form_attributes = array('id' => 'insertproductprices', 'name' => 'insertproductprices');
                    echo form_open('superadmin/Product/updateProductPricing', $form_attributes);
                    ?>

                  <div class="col-md-12 input_fields_wrap">
                    <div class="col-md-12">
                        <?php $product=json_decode($product_details); //print_r($product);?>
                        <div class="form-group col-md-3">
                        <div class="form-group col-md-6 no-pad ">
                          <input type="hidden" name="id" value="<?php echo $product_price_details->id ?>">
                            <label><span title="Shoperative Product Code">SPC</span></label>
                            <select name="prod_id" id="product code[]" class="form-control" required>   
                                 <option  value="">--Select SPC--</option>
                                    <?php foreach ($product->product_details as $row) {?>
                                  <option  value="<?php echo $row->id;  ?>" <?php if($row->id == $product_price_details->prod_id) echo "selected"; ?>><?php echo $row->prod_code.' ('.$row->prod_name.')';  ?></option> <?php }?>
                              </select>
                              <?php if(!empty($prod_code_error)){ echo $prod_code_error;}?>
                          </div>
                          <div class="form-group col-md-6 no-pad ">
                            <label><span title="Vendor Product Code">VPC</span></label>
                            <input name="vpc" id="vpc" value="<?php echo $product_price_details->vendor_item_code ?>" class="form-control" readonly>
                          </div>
                        </div>
                           <div class="form-group col-md-1 no-pad ">
                             <label>SKU Qty</label>
                            <input type="text" name="sku_qty" id="sku_qty" value="<?php echo $product_price_details->sku ?>"  class="form-control sku_qty" placeholder="SKU Qty" readonly>
                           </div>
                           <div class="form-group col-md-1 no-pad ">
                           <label><span title="Unit Of Measure">UOM</span></label>
                            <input name="unit_of_measure" value="<?php echo $product_price_details->unit_of_measure ?>" id="units"  class="form-control" placeholder="UOM" readonly>   

                        </div>
                         <div class="form-group col-md-1 no-pad ">
                              <label>Qty From</label>
                            <input type="text" autocomplete="off" name="qty_range_from" value="<?php echo $product_price_details->qty_range_from ?>" placeholder="from" class="form-control" required>   
                        </div>
                         <div class="form-group col-md-1 no-pad ">
                              <label>To</label>
                            <input type="text" autocomplete="off" name="qty_range_to" value="<?php echo $product_price_details->qty_range_to ?>" placeholder="to" class="form-control" required>   
                        </div>
                        <div class="form-group col-md-3">
                         <div class="form-group col-md-6 no-pad ">
                             <label>From Date </label>
                            <input type="date" autocomplete="off" name="form_date" value="<?php echo $product_price_details->form_date ?>" placeholder="form_date" class="form-control" id="fromdate" required> 
                            <input type="hidden" name="fromdate" value="<?php echo $product_price_details->form_date ?>">
                             
                        </div>
                        <div class="form-group col-md-6 no-pad ">
                           <label>To Date </label>
                             <input type="date" autocomplete="off" name="to_date" value="<?php echo $product_price_details->to_date ?>" placeholder="to_date" class="form-control" id="todate" required>
                             <input type="hidden" name="todate" value="<?php echo $product_price_details->to_date ?>">  
                        </div>
                      </div>
                         <div class="form-group col-md-1 no-pad ">
                             <label><span title="Selling Price"> SP</span></label>
                            <input type="text" autocomplete="off" name="selling_price" value="<?php echo $product_price_details->selling_price ?>" placeholder="SP" class="form-control" required>   
                        </div>
                         <div class="form-group col-md-1 no-pad ">
                             <label><span title="Buying Price"> BP</span></label>
                            <input type="text" autocomplete="off" name="buying_price" value="<?php echo $product_price_details->buying_price ?>" placeholder="BP" class="form-control" required>   
                        </div>
                    </div>
                 
                  </div>
                  <div class="form-group col-md-11   ">
                             
                            <input type="submit" autocomplete="off" name="submit" value="Update" class="btn btn-md btn-success pull-right">
                    </div>
                      <?php echo form_close();?>
                    <div class="clearfix"></div> 
					</div>
				</div>
			</div>
    </section>
    <!-- /.content -->
     
  </div>
  <!-- /.content-wrapper -->
<footer class="main-footer">
    <?php $this->load->view("includes/footer.php");?>
  </footer>
 

  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery-2.2.3.min.js"></script>
<script src="<?php echo SUPER_JS_PATH; ?>jquery-ui.js"></script>
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
<script type="text/javascript">
  $(document).ready(function(){
  $('#fromdate').datepicker({ minDate: 0,changeMonth: true,changeYear: true});
  $('#todate').datepicker({ minDate: 0,changeMonth: true,changeYear: true});
  });
</script>
<script>  
 $(document).on("change","[name^=prod_id]",function(){
                var product_id = $(this).val();
                var vpc = $(this).parent().parent().find('[name^=vpc]');
                var sku = $(this).parent().parent().find('[name^=sku_qty]');
                var product_unit =  $(this).parent().parent().find('[name^=unit_of_measure]');
                if (product_id > 0 && !isNaN(product_id)) {
                    $.ajax({
                        dataType: 'JSON',
                        method: 'POST',
                        data: {'product_id': product_id},
                        url: '<?php echo base_url(); ?>superadmin/Product/get_product_sku',
                        success: function (ss) {
                            if(ss.code == '200')
                            {
                              var res = ss.product_details;
                              var vendor_code=res.vendor_item_code;
                              vpc.val(res.vendor_item_code)
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
 $(".temp").delay(4000).fadeOut("slow");

</script>