<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Product bulk upload</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">textarea{resize: none;}
.select2-container .select2-selection--single {
    height:34px!important;
}</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view("includes/header.php");?>
 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
   <?php $this->load->view("includes/sidebar.php");?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Products Bulk upload
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>"><i class="fa fa-dashboard"></i> Home </a></li>

        <li class="active"> Products bulk upload </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
						<h3 class="box-title">Upload bulk products</h3>
						<a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>Product/productDetails" class="btn btn-primary pull-right">Manage Products</a>
						</div>
						<!-- /.box-header -->
						<!-- form start -->
						<?php
             $form_attributes = array('id' => 'bulk_upload', 'name' => 'bulk_upload');
                            echo form_open_multipart(base_url().'superadmin/Product/bulk_upload', $form_attributes);
              ?>
						<div class="box-body">
						<div class="col-md-4">
							<div class="form-group">
						<?php	
                        echo form_label('Choose CSV file'). "<span style='color:red' id='csv_sheet_err'> *</span>"
                        ;?>
                        <input type="file"  name='csv_sheet' id="csv_sheet" class="form-control">

							</div>
                            <input type="submit" name="submit" class="btn btn-success">&emsp;
                            <a href="<?php echo base_url().'csv/Products_bulk_upload.csv'; ?>" class="btn btn-warning">Download Sample CSV</a>
						</div>
                      
						 </div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
    </section>
</div>
    <!-- /.content -->
     <footer class="main-footer">
    <?php $this->load->view("includes/footer.php");?>
  </footer>
  </div>
  <!-- /.content-wrapper -->

 

  <div class="control-sidebar-bg"></div>

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
<script src="<?php echo SUPER_JS_PATH; ?>select2.full.min.js"></script>
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>select2.min.css">
</body>
<script type="text/javascript">
  $("#bulk_upload").submit(function(){
      $('#csv_sheet').css('border','');
       $('#csv_sheet_err').html('');
        var str = true;
        var csv = $('#csv_sheet').val().trim();
        var file = csv.split('\\').pop();
          //alert(file);
         var regex = /^([a-zA-Z0-9\s_\\.\-:()])+(.csv)$/;
          if (csv == '') { $('#csv_sheet').css('border', '1px solid red').focus(); $('#csv_sheet_err').html('Please choose csv file'); str = false; }
        if (csv != '' && !regex.test(file) ) { $('#csv_sheet').css('border', '1px solid red').focus(); $('#csv_sheet_err').html('Please choose valid csv file'); str = false; }
        return str;
  });
  // setTimeout(function(){
  //   $("#flash_msg").html('');
  // },4000);
</script>
</html>
 