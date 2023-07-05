<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Edit Groups </title>
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
       Update Group
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo  SUPER_ADMIN_FOLDER_PATH;?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo  SUPER_ADMIN_FOLDER_PATH;?>Settings/manageGroups"><i class="fa fa-dashboard"></i> Manage Groups </a></li>
        <li class="active"> Update Group</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Update Group</h3>
            <a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>Settings/manageGroups" class="btn btn-primary pull-right">Go Back</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
            <div class="box-body">
            <div class="col-md-12 input_fields_wrap"> 
               <?php if ($this->session->flashdata('Failed')) { ?>
                        <div class="alert alert-danger temp">      
                            <?php echo $this->session->flashdata('Failed') ?>
                        </div>
                    <?php } ?> 
                      <?php //print_r($groups_res); exit;
                                $row=json_decode($groups_res);
                               //print_r($row);
                                ?>
                        <?php
                        $attributes = array('name' => 'form', 'id' => 'unit-form', 'class' => 'navbar-form');
                        echo form_open_multipart('superadmin/Settings/groupUpdate', $attributes);
                        ?>
                        <div class="form-group col-md-3">
                              <?php echo form_label('Product Group Code', 'group Code') . "<span style='color:red'>*" . form_error('group_code') . "</span>"; ?>
                            <br>
                            <input type="hidden" name="id" id="id" value="<?php echo $row->id;?>"/>
                             <?php $data = array(
                                'name' => 'group_code',
                                'id' => 'group_code',
                                'maxlength' => '40',
                                'autocomplete' => 'off',
                                'class' => 'form-control prod_group',
                                'value'=>$row->group_code,
                                'required' => 'required'
                            );

                            echo form_input($data);
                            ?>
              <span class="group_code_error" id="group_code_error"></span> 
                            
                        </div>
                         <div class="form-group col-md-3">

                            <?php echo form_label('Product Group Name', 'group name') . "<span style='color:red'>*" . form_error('group_name') . "</span>"; ?>
                            <br>

                            <?php
                            $data1 = array(
                                'name' => 'group_name',
                                'id' => 'group_name',
                                'maxlength' => '40',
                                'autocomplete' => 'off',
                                'class' => 'form-control prod_group',
                                'value'=>$row->group_name,
                                'required' => 'required'
                            );

                            echo form_input($data1);
                            ?>
              <span class="group_error" id="group_error"></span> 
                           
                         </div>
          
          <div class="clearfix">&emsp;</div>
                      <div class="box-footer col-md-3">
            <input type="reset" class="btn btn-danger" value="Cancel">
              <?php echo form_submit('submit', 'Update', array('class' => 'btn btn-success', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
            </div>  
                </div>
                    <div class="clearfix"></div>
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
<script type="text/javascript">
  $(".temp").delay(4000).fadeOut("slow");
</script>
</body>
</html>