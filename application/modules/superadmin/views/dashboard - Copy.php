<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Dashboard </title>
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
 
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>_all-skins.min.css">
<style type="text/css">
  .input-box-pad{padding: 10px;}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view("includes/header.php");?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
   <?php $this->load->view("includes/sidebar.php");?>
    <!-- /.sid$this->load->view("includes/header.php")bar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'superadmin';?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Open Orders</span>
              <span class="info-box-number"><?php echo $new_orders; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Delivered</span>
              <span class="info-box-number"><?php echo $deliver_orders; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
		  <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Need to deliver</span>
              <span class="info-box-number"><?php echo $confirm_orders; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
		    <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Cancelled Orders</span>
              <span class="info-box-number"><?php echo $cancel_orders; ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i  class="pd21 fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Standard Users</span>
              <span class="info-box-number">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i  class="pd21 fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Power Users  </span>
              <span class="info-box-number"><?php echo $power_users_count; ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
      <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-fuchsia"><i  class="pd21 fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Followers</span>
              <span class="info-box-number"><?php echo $followers_users_count; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-maroon"><i  class="pd21 fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Guest  Users</span>
              <span class="info-box-number"><?php echo $guest_users_count;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Shipping report -->
       <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 content-header"> 
          <h1>Shipping</h1><br>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="">All Open Orders</span>
              <span class="info-box-number"><?php echo $new_orders; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="">Orders-due for delivery by Due-Date</span>
              <span class="info-box-number"><?php echo $deliver_orders; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        
      <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="">Orders-due for delivery by Payment-Mode</span>
              <span class="info-box-number"><?php echo $confirm_orders; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       <div class="clearfix visible-sm-block"></div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="">Orders-due for delivery by Delivery-Location</span>
              <span class="info-box-number"><?php echo $cancel_orders; ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i  class="pd21 fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="">Registered Shipping-Agents</span>
              <span class="info-box-number">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-fuchsia"><i  class="pd21 fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="">Shipping Cost Table</span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
      <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box input-box-pad">
              <p class="text-center"><b><u>Transactions</u></b></p>
              <p class="text-center">Print Shipping-Address Labels</p>
              <p class="text-center">Print Packing-Lists</p>
              <p class="text-center">Record Shipping Details by Order Number</p>
              <p class="text-center">Manage Sales Returns</p>
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
         <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box input-box-pad">
              <p class="text-center"><b><u>Reports</u></b></p>
              <p class="text-center">Shipped Delivery-Orders List</p>
              <p class="text-center">Sales Returns by Reason</p>
              <p class="text-center">Lost Deliveries</p>
              <p class="text-center">Delayed Deliveries</p>
            </div>
            <!-- /.info-box -->
        </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- shipping report -->
       <!-- Collections report -->
       <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 content-header"> 
          <h1>Collections <small>(How is collection outstanding collection and credit rating relavent here)</small></h1><br>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="">All Open Orders</span>
              <span class="info-box-number"><?php echo $new_orders; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="">All Open Invoiced Orders</span>
              <span class="info-box-number"><?php echo $deliver_orders; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        
      <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="">Outstanding Collections by Age</span>
              <span class="info-box-number"><?php echo $confirm_orders; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       <div class="clearfix visible-sm-block"></div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i  class="pd21 fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="">Outstanding Collections by Territory</span>
              <span class="info-box-number"><?php echo $cancel_orders; ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i  class="pd21 fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="">Credit History of Customers</span>
              <span class="info-box-number">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-fuchsia"><i  class="pd21 fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="">Blocked Customers List</span>
              <span class="info-box-number">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
      <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1">
            <div class="info-box input-box-pad">
              <p class="text-center"><b><u>Transactions</u></b></p>
              <p class="text-center">Send Payment Follow-up Mails</p>
              <p class="text-center">Send Payment Follow-up mobile-alerts</p>
              <p class="text-center">Payments Reconciliation with Bank Records</p>
              <p class="text-center">Payments Reconciliation with Open Invoiced Orders</p>
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
         
      </div>
      <!-- /.row -->
      <!-- Collections report -->
       <!-- Shipping report -->
       <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 content-header"> 
          <h1>Inventory Management & ATP</h1><br>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
          <div class="info-box input-box-pad">
              <p class="text-center">Stock Level by SKU</p>
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       <div class="col-md-3 col-sm-4 col-xs-6">
          <div class="info-box input-box-pad">
              <p class="text-center">Stock Level by SKU by Storage Location</p>
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-4 col-xs-6">
         <div class="info-box input-box-pad">
              <p class="text-center">Yearly/Monthly-Demand by SKU</p>
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-4 col-xs-6">
          <div class="info-box input-box-pad">
              <p class="text-center">Procurement Lead-time by SKU</p>
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-4 col-xs-6">
          <div class="info-box input-box-pad">
              <p class="text-center">Reorder Level by SKU</p>
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       <div class="col-md-4 col-sm-4 col-xs-6">
          <div class="info-box input-box-pad">
              <p class="text-center">Input-Price History by SKU</p>
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-4 col-xs-6">
          <div class="info-box input-box-pad">
              <p class="text-center">Vendor List & Rating</p>
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->



        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
      <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box input-box-pad">
              <p class="text-center"><b><u>Transactions</u></b></p>
              <p class="text-center">Print Shipping-Address Labels</p>
              <p class="text-center">Print Packing-Lists</p>
              <p class="text-center">Record Shipping Details by Order Number</p>
              <p class="text-center">Manage Sales Returns</p>
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
         <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box input-box-pad">
              <p class="text-center"><b><u>Reports</u></b></p>
              <p class="text-center">Shipped Delivery-Orders List</p>
              <p class="text-center">Sales Returns by Reason</p>
              <p class="text-center">Lost Deliveries</p>
              <p class="text-center">Delayed Deliveries</p>
            </div>
            <!-- /.info-box -->
        </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- shipping report -->
        <!-- content goes here -->
    
    </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <?php $this->load->view("includes/footer.php");?>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
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
