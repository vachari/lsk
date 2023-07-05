<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Products</title>
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
<style>
        .pages a,.pages strong{                
            border-radius: 9px 9px;
            padding: 7px 12px;
         }
        .pages a{
             background-color: #c52825;
             border-radius:50px;
             color: white;
        }
    </style>
</head>
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
       Product Inventory/Availabililty
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>Product/productDetails"><i class=""></i> Product Inventory</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			<div class="col-md-12 col-sm-12 ">
        <div class="col-md-12">
          <?php 
            $pro_de=json_decode($groupprice_details);
           //print_r($pro_de->product_details);exit;

          ?>
        <form method="post" class="form-inline">
          <input type="text" name="search" id="search" class="form-control" placeholder="Search by product name" value="<?php if($search!=null) echo $search ?>">
            <select class="form-control" name="vendor" id="vendor"> 
              <option value=""> Select Vendor</option>
              <?php $vendor_res=json_decode($vendor_details);
              if($vendor_res->vendor_list !=null){
                for ($i=0; $i <count($vendor_res->vendor_list) ; $i++) { 
                  # code...
              
              ?>
              <option value="<?php echo $vendor_res->vendor_list[$i]->vendor_id;?>" <?php if($vendor!=null && $vendor==$vendor_res->vendor_list[$i]->vendor_id) echo 'selected' ?>><?php echo $vendor_res->vendor_list[$i]->vendor_name.'('.$vendor_res->vendor_list[$i]->vendor_code.')';?></option>
             <?php } } ?>

          </select>
           <select class="form-control" name="group" id="group"> 
              <option value=""> Select Group</option>
              <?php 
                for ($i=0; $i <count($pro_de->product_details) ; $i++) { 
                  # code...
              ?>
              <option value="<?php echo $pro_de->product_details[$i]->group_code;?>" <?php if($group!=null && $group==$pro_de->product_details[$i]->group_code) echo 'selected' ?>><?php echo $pro_de->product_details[$i]->group_code;?></option>
             <?php }?>

          </select>

            <button type="submit" id="search_btn" class="btn btn-default"><i class="fa fa-search"></i></button>
            <a href="<?php echo base_url().'superadmin/Product/product_inventory' ?>" class="btn btn-info pull-right">Refresh</a>
           
        </form>
           </div>
        
           
        </div>
      </div>

      <div style=""></div>
            <!-- /.box-header -->
              <div class="col-md-12" id="flash_msg">
               <?php
               $success_msg = $this->session->flashdata('success_msg');
               $error_msg = $this->session->flashdata('error_msg');
               if($success_msg)
               {
                ?>
                <div class="alert alert-success" ><?php echo $success_msg; ?></div>
                <?php
               }
                if($error_msg)
               {
                ?>
                <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                <?php
               }
               ?>
              </div>
            <span id="successmessage"></span>
                <span id="failmessage"></span><br><br>
            <div class="box-body">

              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row">
              <div class="col-sm-12 table-responsive">
              <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>

                            <tr>
                                 <th> <span title="Shoperative Product Code"> SPC</span></th>
                                <th><span title="Vendor Product Code"> VPC</span></th>
                                <th> Vendor(code)</th>
                                 <th> Product Name </th>
                                <th> <span title="Stock Keeping Unit"> SKU</span></th>
                                <th> <span title="Unit of measure">UOM</span></th>
                                 <th>  Group </th>
                                  <th> Stock</th>
                                  <th> Last Updated On</th>
                                 <th>  Image</th>
                                <th> Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $prod_res = json_decode($common_result);
                            //print_r($prod_res);
                            if ($prod_res->code == SUCCESS_CODE) {
                                foreach ($prod_res->common_result as $row) {
                                    ?>
                                    <tr class="">
                                          <td><?php echo $row->prod_code; ?></td>
                                        <td><?php if($row->vendor_item_code !='') echo $row->vendor_item_code; else echo '--'; ?> </td>
                                          <td><?php if($row->vendor_name !='') echo $row->vendor_name.' ('.$row->vendor_code.')'; else echo '--'; ?></td>
                                           <td><?php echo $row->prod_name; ?></td>
                                      
                                        <td><?php echo $row->sku; ?></td>
                                        <td><?php echo $row->unit; ?></td>
                                         <td><?php if($row->prod_group !='') echo $row->prod_group; else echo '--'; ?></td>
                                         <td><input type="text-center" name="stock[]" id="stock_<?php echo $row->id; ?>" value="<?php echo $row->stock; ?>" class="number_class form-control" size="5" onkeyup="updatestock(this.value,<?php echo $row->id; ?>)"></td>
                                         <td><?php if(strtotime($row->last_modified_stock) > 0) echo date('d-M-Y h:i:s A', strtotime($row->last_modified_stock)); else echo '--'; ?></td>
                                          <td><img width="50px" src="<?php echo base_url(); ?>uploads/products/<?php echo $row->prod_image; ?>"></td>
                                        <td class="text-success"><b> <?php if ($row->active_status == 1) {
                                                    echo "<b style='color:green'>Active</b>";
                                                } elseif($row->active_status == 0) {
                                                    echo "<b style='color:red'>Inactive</b>";
                                                } ?>   </b>
                                        </td>
                                      
                                    </tr> 
                                    <?php $i++;
                                }
                            } else { ?>
                                <tr><td colspan="15" style="text-align:center; color:red;font-size:20px;">No Products Found...</td></tr>
                            <?php }
                            ?>


                        </tbody>
                    </table>
                         <div class="text-center">
              <td colspan="4" > <p class="pages"><?php echo $links; ?></p></td>
              </div>
                    </div></div></div>
            </div>
            <!-- /.box-body -->
          </div>
       
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
<script type="text/javascript">
  $('#group').change(function(){
    $('#search_btn').click();
  });
  $('#vendor').change(function(){
    $('#search_btn').click();
  });
   $('#search_btn').click(function(){
    var group = $('#group').val();
    var vendor = $('#vendor').val();
    var search = $('#search').val();
    $('#search').css('border','');
    if(group =='' && vendor=='' && search==''){
      $('#search').css('border','1px solid red');
    }
  });
   $(document).on("keyup",".number_class",function(){(isNaN($(this).val()))?$(this).val(''):'';});
</script>
<script type="text/javascript">
  function updatestock(stock,prod_id){
    if(stock >= 0){
      $.ajax({
            dataType:'json',
            type:'post',
            data:{'stock':stock,'product_id':prod_id},
            url:'<?php echo base_url();?>superadmin/Product/updatestock/',
            success:function(u){
              console.log(u);
              if(u.code==200){
                 $('#stock_'+prod_id).closest('td').next('td').html(u.last_modified_stock);
              }
            },
            error:function(er){
              console.log(er);
            }
          });
    }
  }
</script>
