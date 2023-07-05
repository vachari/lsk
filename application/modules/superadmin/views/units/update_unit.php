<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ghar Aahaar | Edit Unit</title>
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
  <style type="text/css">.pd0{padding-left:0px;padding-right:0px;}</style>
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
         Update Product Unit
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo  SUPER_ADMIN_FOLDER_PATH;?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo  SUPER_ADMIN_FOLDER_PATH;?>Settings/manageUnits" class="">Manage Product Units</a></li>
      </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Update Product Unit</h3>
            <a href="<?php echo  SUPER_ADMIN_FOLDER_PATH;?>Settings/manageUnits" class="btn btn-primary pull-right">Go Back</a>
            </div>
        <div class="box-body">
           <div class="col-md-12"> 
        <?php if($this->session->flashdata('Success')) { ?>
        <div class="alert alert-success temp">
        <?php echo $this->session->flashdata('Success'); ?>
        </div>
        <?php } ?>
        <?php if($this->session->flashdata('Failed')) { ?>
        <div class="alert alert-danger temp">
        <?php echo $this->session->flashdata('Failed'); ?>
        </div>
        <?php } ?>
      </div>
           <div class="col-md-12 input_fields_wrap"> 
                      
                        <?php $row=json_decode($units_res); //print_r($row); ?>
                        <?php
                        $attributes = array('name' => 'form', 'id' => 'unit-form', 'class' => 'navbar-form');
                        echo form_open_multipart('superadmin/Settings/updateUnits', $attributes);
                        ?>
                       <div class="form-group col-md-3">
                      <input type="hidden" name="id" value="<?php echo $row->id ?>">
                            <?php echo form_label('UOM ID', 'uomid') . "<span style='color:red' id='uomid_error'> * " . form_error('uomid') . "</span><br>"; ?>
                           

                            <?php
                            $data = array(
                                'name' => 'uomid',
                                'id' => 'uomid',
                                'maxlength' => '40',
                                'autocomplete' => 'off',
                                'class' => 'form-control',
                                'placeholder' => 'Enter UOM ID',
                                'required' => 'required',
                                'value' => $row->uom_id
                            );

                            echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="state">State<span style="color: red" id="state_error"> *</span></label><br>
                          <select name="state" id="state" class="form-control" required>
                            <option value="">--Select State--</option>
                            <option <?php if($row->state=='Solid') echo 'selected' ?>>Solid</option>
                            <option <?php if($row->state=='Liquid') echo 'selected' ?>>Liquid</option>
                            <option <?php if($row->state=='Gas') echo 'selected' ?>>Gas</option>
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="quantity">Quantity Measure<span style="color: red" id="quantity_error"> *</span></label><br>
                          <select name="quantity" id="quantity" class="form-control" required>
                            <option value="">--Qunatity Measure--</option>
                            <option <?php if($row->quantity_of_measure=='Volume') echo 'selected' ?>>Volume</option>
                            <option <?php if($row->quantity_of_measure=='Weight') echo 'selected' ?>>Weight</option>
                            <option <?php if($row->quantity_of_measure=='Numbers') echo 'selected' ?>>Numbers</option>
                          </select>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="uom">UOM<span style="color: red" id="uom_error"> *</span></label><br>
                          <input type="text" name="uom" id="uom" value="<?php echo $row->unit_of_measure ?>" placeholder="Enter Unit Of Measure" class="form-control" required>
                        </div>
 <div class="clearfix" >&emsp; </div>
                        <div class="form-group col-md-4 pull-right"> <br>
                            <?php echo form_submit('submit', 'Update', array('class' => 'btn btn-success ', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
                        </div>
                        <div class="clearfix" >&emsp; </div>
                        <?php echo form_close(); ?>
                        
                    </div>
           </div>
         </div>
      
    </section>
    </div>
    <!-- /.content -->
     
  </div>
  <!-- /.content-wrapper -->

 

  <div class="control-sidebar-bg"></div>
  <footer class="main-footer">
   <?php $this->load->view("includes/footer.php");?>
  </footer>
</div>
<!-- ./wrapper -->

</div>

</div>

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
<script type="text/javascript">
  $(".temp").delay(4000).fadeOut("slow");
</script>
</body>
</html>
