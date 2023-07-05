<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Change Password</title>
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Change Password
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Change Password</h3>
            <!-- <a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>Category/manageCategory" class="btn btn-primary pull-right">Manage Category</a> -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <!-- <h3> <b> Change Password </b></h3> -->
          <?php if($this->session->flashdata('success')){?>
                <div class="alert alert-success">      
                  <?php echo $this->session->flashdata('success')?>
                </div>
              <?php } ?> 
              <?php if($this->session->flashdata('error')){?>
                <div class="alert alert-danger">      
                  <?php echo $this->session->flashdata('error')?>
                </div>
              <?php } 
            
              $attributes = array('name' =>'form' ,'id'=> 'register-form');
                     echo form_open_multipart('',$attributes); ?>
            <div class="box-body">
            <div class="col-md-4">
              <div class="form-group">
            <?php echo form_label('Old Password ','Old Password ')."<span style='color:red' id='old_err'>*".form_error('old_password')."</span>"; ?>
                      <?php
                      $data8= array(
                              'name'          => 'old_password',
                              'id'            => 'old_password',
                              'maxlength'     => 40,
                              'autocomplete'  => 'off',
                              'class'     => 'form-control',
                              'placeholder' => 'Enter Your Old Password'

                      );

                     echo form_password($data8);?>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
              <div class="form-group">
            <?php echo form_label('New Password','New Password')."<span style='color:red' id='new_err'>*".form_error('new_password')."</span>"; ?>
                      <?php
                      $data4= array(
                              'name'          => 'new_password',
                              'id'            => 'new_password',
                              'class'         => 'password',
                              'maxlength'     => 40,
                              'minlength'     => 4,
                             'autocomplete'  => 'off',
                              'class'     => 'form-control',
                              'placeholder' => 'Enter Your New Password'
                      );
                     echo form_password($data4);?>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
              <div class="form-group">
          <?php echo form_label('confirm Password','confirm Password')."<span style='color:red' id='confirm_err'>*".form_error('confirm_password')."</span>"; ?>
                   
                      
                      <?php
                      $data5 = array(
                              'name'          => 'confirm_password',
                              'id'            => 'confirm_password',
                              'class'         => 'password',
                              'maxlength'     => 40,
                              'autocomplete'  => 'off',
                              'class'     => 'form-control',
                              'placeholder' => 'Enter Your confirm Password'
                      );

                     echo form_password($data5);?>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="box-footer col-md-4">
            <button type="reset" class="btn btn-danger">Cancel</button>
              <?php echo form_submit('submit', ' Submit ', array('class' => 'btn btn-success', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
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
    <?php $this->load->view("includes/footer.php");?>
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
<script src="<?php echo SUPER_JS_PATH; ?>common.js"></script>
</body>
</html>
<script>
   $("#btn_submit").click(function(){
      var old_password=$('#old_password').val();
      var new_password=$('#new_password').val();
      var confirm_password=$('#confirm_password').val();
      var len = new_password.length;
      

      $('#old_err,#new_err,#confirm_err').html('');
      $('#old_password,#new_password,#confirm_password').css('border','');

      if(old_password==''|| old_password==' '){
          str=false;
          $('#old_password').css('border','1px solid red');
          $('#old_err').css('color','red');
          $('#old_err').html(' Please Enter Old Password');
      }
      if(new_password==''|| new_password==' '){
          str=false;
          $('#new_password').css('border','1px solid red');
          $('#new_err').css('color','red');
          $('#new_err').html(' Please Enter New Password');
      }
      // }elseif(len < 6) {
      //       str=false;
      //     $('#new_password').css('border','1px solid red');
      //     $('#new_err').css('color','red');
      //     $('#new_err').html('Password Length must be above 6 characters');
      //   }
      if(confirm_password==''|| confirm_password==' '){
          str=false;
          $('#confirm_password').css('border','1px solid red');
          $('#confirm_err').css('color','red');
          $('#confirm_err').html(' Please Confirm Password');
      }
        if(new_password != confirm_password) {
            //alert("Password and Confirm Password don't match");
            str=false;
          $('#confirm_password').css('border','1px solid red');
          $('#confirm_err').css('color','red');
          $('#confirm_err').html(' New Passwor and Confirm Password must be same');
        }
        
      return str;
    });
  
</script>