<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Create Slider </title>
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
  <style type="text/css">textarea{resize: none;}</style>
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
       Create Slider
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Create Slider</li>
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
            <h3 class="box-title">Create Slider</h3>
            <a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>Category/manageslider" class="btn btn-primary pull-right">Manage Sliders</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
            $attribute = array('name' =>'form' ,'id'=> 'register-form');
               echo form_open_multipart('',$attribute); ?>
            <div class="box-body">
            <div class="col-md-4">
              <div class="form-group">
            <?php echo form_label('Slider Title','Slider Title');?><span style="color:red;" id="span_title">*<?php echo form_error('slider_title'); ?></span>
                  <?php
                  $data = array(
                          'name'          => 'slider_title',
                          'id'            => 'slider_title',
                          'maxlength'     => 40,
                          'autocomplete'  => 'off',
                          'class'     => 'form-control',
                          'placeholder' => 'Enter Slider Title',
                          'value'     =>set_value('slider_title')


                      );

                       echo form_input($data);
                     ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <?php 
               echo form_label('Slider URL','Slider URL');?><span style="color:red;" id="span_url">*
                    <?php echo form_error('slider_url'); ?></span>
            <?php echo form_input(array('class'=>'form-control','name'=>'slider_url','id'=>'slider_url','placeholder'=>'Enter Slider URL','value'=>set_value('slider_url'),'autocomplete'=>'off')); ?>

              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
              <div class="form-group">
              <?php echo form_label('IMAGE (250 X 150)','IMAGE (250 X 150)'); ?>
                    <span style="color:red;" id="img_err">*</span> 
                      
                      <?php
                      $upload1 = array(
                              'name'          => 'image',
                              'id'            => 'image',
                              'class'     => 'form-control'
                      );

                     echo form_upload($upload1);?>
                      
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
             <?php echo form_label('App Icon (100 X 80)','App Icon'); ?>
                    <span style="color:red;"> </span> 
                      
                      <?php
                      $upload2 = array(
                              'name'          => 'icon',
                              'id'            => 'icon',
                              'class'     => 'form-control'
                      );

                     echo form_upload($upload2);?>
                     <span class="err_class" id="icon_err"></span>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="box-footer">
             <input type="reset" class="btn btn-danger" value="Cancel">
              <?php echo form_submit('submit', 'Submit', array('class' => 'btn btn-success', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
                        </div>
             </div>
            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content --><footer class="main-footer">
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
</body>
</html>

 <script>
   $("#register-form").submit(function(){
      var str =true;
      var title=$('#slider_title').val();
      var url=$('#slider_url').val();
      var image = $('#image').val();
      var icon = $('#icon').val();
      $('#span_title,#span_url,#img_err,#icon_err').html('');
      $('#slider_title,#slider_url,#image,#icon').css('border','');
      if(title==''|| title==' '){
          str=false;
          $('#slider_title').css('border','1px solid red');
          $('#span_title').css('color','red');
          $('#span_title').html(' Please Enter title');
      }
       if(url==''|| url==' '){
          str=false;
          $('#slider_url').css('border','1px solid red');
          $('#span_url').css('color','red');
          $('#span_url').html(' Please Enter url');
      }
      if (image == '')
                {
                    $('#image').css('border', '1px solid red');
                    $('#img_err').text('Please upload slider image');
                    str = false;
                }
                if (image != '')
                {
                    var ext = image.match(/\.(.+)$/)[1];
                    var validformat = '';
                    switch (ext)
                    {
                        case 'jpg':
                        case 'jpeg':
                        case 'bmp':
                        case 'png':
                        case 'tif':
                            validformat = true;
                            break;
                        default:
                            validformat = false;
                    }
                    if (validformat == false)
                    {
                        $('#imgae').css('border', '1px solid red');
                        $('#img_err').text('Upload valid jpeg,jpg,png,bmp,tif images only');
                        str = false;
                    }
                }
      return str; 
    });
  $(".temp").delay(4000).fadeOut("slow");
</script>
