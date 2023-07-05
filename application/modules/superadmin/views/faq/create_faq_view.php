<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Create FAQ's</title>
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

  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>_all-skins.min.css">

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php $this->load->view("includes/header.php"); ?>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <?php $this->load->view("includes/sidebar.php"); ?>
      <!-- /.sid$this->load->view("includes/header.php")bar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Create New Faq
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo  SUPER_ADMIN_FOLDER_PATH; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo  SUPER_ADMIN_FOLDER_PATH; ?>Faqs/"><i class="fa fa-list"></i>Manage Faq</a></li>
          <li class="active"><i class="fa fa-list"></i> Create Faq</li>

          <li class="active"></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">

                <h3 class="box-title">Create New Faq</h3>
                <a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Faqs/" class="btn btn-primary pull-right">Go Back</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <?php echo form_open(SUPER_ADMIN_FOLDER_PATH . 'Faqs/insertFaq'); ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Type<sup>*</sup></label><span id="span_type" class="error"><?php echo form_error('faq_select'); ?></span>
                    <select name="faq_select" class="form-control" id="type">
                      <option value="">--Select--</option>
                      <option value="1">About Seller</option>
                      <option value="2">About Acount Creation</option>
                      <option value="3">Support Forum</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Question<sup>*</sup></label><span id="span_question" class="error"><?php echo form_error('question'); ?></span>
                    <?php echo form_input(array('class' => 'form-control', 'name' => 'question', 'id' => 'question', 'placeholder' => 'Enter Question', 'value' => set_value('question'), 'autocomplete' => 'off')); ?>
                    </span>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Description<sup>*</sup></label><span id="span_description" class="error"><?php echo form_error('description'); ?></span>
                    <?php echo form_textarea(array('class' => 'form-control', 'name' => 'description', 'id' => 'description', 'placeholder' => 'Enter Description', 'value' => set_value('description'), 'autocomplete' => 'off')); ?>
                    </span>
                    <div class="box-footer pull-right">
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
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <?php $this->load->view("includes/footer.php"); ?>
    </footer>

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
</body>

</html>

<script>
  $("#btn_submit").click(function() {
    var type = $('#type').val();
    var question = $('#question').val();
    var description = $('#description').val();
    $('#span_question,#span_description,#span_type').html('');
    $('#question,#description,#type').css('border', '');
    if (type == '' || type == ' ') {
      str = false;
      $('#type').css('border', '1px solid red');
      $('#span_type').css('color', 'red');
      $('#span_type').html(' Please Enter Type');
    }
    if (question == '' || question == ' ') {
      str = false;
      $('#question').css('border', '1px solid red');
      $('#span_question').css('color', 'red');
      $('#span_question').html(' Please Enter Question');
    }
    if (description == '' || description == ' ') {
      str = false;
      $('#description').css('border', '1px solid red');
      $('#span_description').css('color', 'red');
      $('#span_description').html(' Please Enter description');
    }
    return str;
  });
</script>