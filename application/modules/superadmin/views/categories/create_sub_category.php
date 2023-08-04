<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Create Sub Category</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" type="text/css" href="<?php echo SUPER_CSS_PATH; ?>bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>gharaahaar1.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
    textarea {
      resize: none;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php $this->load->view("includes/header.php"); ?>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <?php $this->load->view("includes/sidebar.php"); ?>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Sub Category
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo  SUPER_ADMIN_FOLDER_PATH; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo  SUPER_ADMIN_FOLDER_PATH; ?>Category/managesubCategory"><i class="fa fa-dashboard"></i> Manage Sub Category</a></li>
          <li class="active">Create Sub Category</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
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
              <div class="box-header with-border">
                <h3 class="box-title">Add Sub Category</h3>
                <a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Category/managesubCategory" class="btn btn-primary pull-right">Go Back</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <?php $attributes = array('name' => 'form', 'id' => 'register-form');
              echo form_open_multipart('superadmin/Category/createsubCategory', $attributes); ?>
              <div class="box-body">
                <div class="col-md-4">
                  <div class="form-group">
                    <?php echo form_label('Choose Menu ', 'Choose Menu ') . "<span style='color:red' id='menu_err' >*" . form_error('menu_id') . "</span>"; ?>
                    <select name="menu_id" id="menu_id" class="form-control ">
                      <option value=""> ------- Choose Menu ------- </option>

                      <?php
                      foreach ($result->result() as $row) {
                      ?>
                        <option value="<?php echo $row->menu_id; ?>"><?php echo $row->menu_title; ?> </option>
                      <?php
                      }
                      ?>

                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <?php echo form_label('Enter Submenu', 'Enter Submenu') . "<span style='color:red' id='title_err'>*" . form_error('submenu_title') . "</span>"; ?>
                    <?php
                    $data = array(
                      'name'          => 'submenu_title',
                      'id'            => 'menu_title',
                      'maxlength'     => 40,
                      'autocomplete'  => 'off',
                      'class'     => 'form-control',
                      'placeholder' => 'Enter submenu'

                    );

                    echo form_input($data); ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <?php echo form_label('Offer price  (%)', 'Offer price'); ?>
                    <span style="color:red;" id="offerprice_err"><?php echo form_error('menu_title'); ?></span>
                    <?php
                    $data = array(
                      'name'          => 'offer_price',
                      'id'            => 'offer_price',
                      'maxlength'     => '3',
                      'autocomplete'  => 'off',
                      'class'     => 'form-control',
                      'placeholder' => 'Enter Offer Price',
                      'value' => 0

                    );
                    echo form_input($data); ?>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                  <div class="form-group">
                    <?php echo form_label('IMAGE (250 X 150)', 'IMAGE (250 X 150)'); ?>
                    <span style="color:red;"></span>

                    <?php
                    $upload1 = array(
                      'name'          => 'image',
                      'id'            => 'image',
                      'class'     => 'form-control'
                    );

                    echo form_upload($upload1); ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <?php echo form_label('App Icon (100 X 80)', 'App Icon'); ?>
                    <span style="color:red;"> </span>

                    <?php
                    $upload2 = array(
                      'name'          => 'icon',
                      'id'            => 'icon',
                      'class'     => 'form-control'
                    );

                    echo form_upload($upload2); ?>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="box-footer">
                  <button type="reset" class="btn btn-danger">Reset</button>
                  <?php echo form_submit('submit', 'Submit', array('class' => 'btn btn-success', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
    </div>
    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <?php $this->load->view("includes/footer.php"); ?>
    </footer>
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
  $("#btn_submit").click(function() {
    var menu_title = $('#menu_title').val();
    var menu_id = $('#menu_id').val();
    $('#title_err,#menu_err').html('');
    $('#menu_title,menu_id').css('border', '');
    if (menu_title == '' || menu_title == ' ') {
      str = false;
      $('#menu_title').css('border', '1px solid red');
      $('#title_err').css('color', 'red');
      $('#title_err').html(' Please Enter Category');
    }
    if (menu_id == '' || menu_id == ' ') {
      str = false;
      $('#menu_id').css('border', '1px solid red');
      $('#menu_err').css('color', 'red');
      $('#menu_err').html(' Please Enter Category');
    }
    return str;
  });
  $(".temp").delay(4000).fadeOut("slow");
</script>