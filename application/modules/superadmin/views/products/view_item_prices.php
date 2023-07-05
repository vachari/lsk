<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Product Prices </title>
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
       Manage Product Price
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Product Price</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			<div class="col-md-12 col-sm-12 ">
       
        <div class="col-md-4 ">
           <form method="post">
          <div class="col-md-9  ">
            <select class="form-control" name="search" id="search"> 
              <option value=""> Select Product</option>
              <?php  $pro_det=json_decode($main_pro); 
                 foreach ($pro_det->product_details as $pro) { ?>
      <option value="<?php echo $pro->id ?>"><?php  echo $pro->prod_name.'('.$pro->prod_code.')'; ?></option>
               <?php } ?>
          </select>
			    
           </div>
            <div class="col-md-2">
            <input type="submit" id="search_btn" class="btn btn-md btn-info" value="Search">
        </form>
           </div>
        </div>
        <div class="col-md-1">
           <a href="" class="btn btn-info" title="Refresh"><i class="fa fa-refresh"></i></a>
        </div>
        <div class="col-md-3 form-inline">
         <button  class="btn btn-success   btn-md" onclick="updateActivationStatus('1')"> Active </button>
            <button  class="btn btn-warning   btn-md"  onclick="updateActivationStatus('0')">In  Active </button>  
                                 
           <span><button  class="btn btn-danger  btn-md" onclick="commonDelete();"> Delete </button></span>
          
          
        </div>
        <div class="col-md-1">
           <a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>Product/productPricing" class="btn btn-primary pull-right">Add New</a>
        </div>
      </div>
</div>
<!-- <span id="successmessage"></span>
<span id="failmessage"></span> -->
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row">
              <div class="col-sm-12">
                <div id="successmessage"></div>
                <div id="failmessage"></div>
              <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success temp">      
                            <?php echo $this->session->flashdata('success') ?>
                        </div>
                    <?php } ?> 
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>

                            <tr>
                                <th>
                                    <input type="checkbox" id="checkAll" >
                                </th>
                                <th>Shoperative Product Name(Code)</th>
                                <th><span title="Vendor Product Code">VPC</span></th>
                                <th><span title="Stock Keeping Unit">SKU</span></th>
                                <th><span title="Unit Of Measure">UOM</span></th>
                                <th><span title="Qty Range From">QRF</span></th>
                                <th><span title="Qty Range To">QRT</span></th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th><span title="Selling Price">SP</span></th>
                                <th><span title="Buying Price">BP</span></th>
                                <th>Status</th>
                                 <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $itemprice_res = json_decode($common_result);
                            
                            if ($itemprice_res->code == 200) {
                                foreach ($itemprice_res->common_result as $row) {
                                    ?>
                                    <tr  >
                                        <td><input type="checkbox"  name="multiple[]" value="<?php echo $row->id; ?>">  </td>
                                        <td rowspan="<?php if($row->prod_id == $row->prod_id ){echo '';}?>">
                                         <?php  foreach ($pro_det->product_details as $pro) { ?>

                                  <?php

                                        if($row->prod_id==$pro->id)
                                        {

                                         echo $pro->prod_name.'('.$pro->prod_code.')'; 

                                         }

                                          }

                                         ?>
                                        </td>
                                        <td><?php echo $row->vendor_item_code; ?></td>
                                        <td><?php echo $row->sku; ?></td>

                                        <td><?php $uom=$this->Crud->checkAndReturn('unit_code','ga_prod_units_tbl',['id'=>$row->unit_of_measure]); if($uom) echo $uom; else echo '--';  ?></td>
                                        <td><?php echo $row->qty_range_from; ?></td>
                                        <td><?php echo $row->qty_range_to; ?></td>
                                        <td><?php echo date('m/d/Y',strtotime($row->form_date)); ?></td>
                                        <td><?php echo date('m/d/Y',strtotime($row->to_date)); ?></td>
                                        <td><?php echo $row->selling_price; ?></td>
                                         <td><?php echo $row->buying_price; ?></td>
                                        <td class="text-success"><b>
                                          <?php if ($row->item_status == 1) {
                                                    echo "<b style='color:green'>Active</b>";
                                                } elseif($row->item_status == 0) {
                                                    echo "<b style='color:red'>Inactive</b>";
                                                } ?>   </b></td>
                                        <td> 
                                        <a href="<?php echo base_url(); ?>superadmin/Product/updateProductPrice/<?php echo $row->id; ?>" class="btn btn-sm btn-info" title="Edit Product Price"><i class="glyphicon glyphicon-edit"> </i> </a>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                }
                            } else { ?>
                                <tr><td colspan="12" style="text-align:center; color:red;font-size:20px;">Results not Found</td></tr>
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
    $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
    /***Check Or Uncheck the Check box List Code End*/
</script>
<script type="text/javascript">
  $('#search').change(function(){
    $('#search_btn').click();
  });
</script>
<script type="text/javascript">
   function updateActivationStatus(s) {

        var listarray = new Array();
        //check this line for name filed
        $('input[name="multiple[]"]:checked').each(function () {
            listarray.push($(this).val());
        });
        //alert off if not nessearry
      // alert(listarray);
        var checklist = "" + listarray;
         //alert off if not nessearry
      //alert(checklist);
        if (!isNaN(s) && (s == '1' || s == '0') && checklist != '') {
            $('#fail').hide();
            $.ajax({
                dataType: 'json',
                type: 'post',
                data: {'tablename': 'item', 'updatelist': checklist, 'activity': s},
                url: '<?php echo base_url(); ?>superadmin/Product/commonStatus/',
                success: function (u) {
                    console.log(u);
                    if(u.code=='200'){$('#success').show();$('#successmessage').html(u.description).addClass('alert alert-success');setTimeout(function() {window.location=location.href;},2000);}
    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');}
                },
                error: function (er) {
                    console.log(er);
                }
            });
        } else {
            $('#fail').show();
            $('#failmessage').html('*  Please select a record');
        }
    }
</script>

<script type="text/javascript">
    function commonDelete(){
    var result = confirm("Want to delete?");
    if (result) {
    var listarray=new Array();
      $('input[name="multiple[]"]:checked').each(function(){listarray.push($(this).val());});
        var checklist=""+listarray;
        //alert(checklist);
      if(checklist!=''){
         $('#fail').hide();
         $.ajax({
          dataType:'json',
          type:'post',
          data:{'tablename':'item','updatelist':checklist},
          url:'<?php echo base_url();?>superadmin/Product/commonDelete/',
          success:function(u){
           // console.log(u);
            if(u.code=='200'){$('#success').show();$('#successmessage').html(u.description).addClass('alert alert-success');setTimeout(function() {window.location=location.href;},2000);}
                    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');}
                 },
          error:function(er){
            console.log(er);
          }
        });
      }
      else{
       $('#fail').show();$('#failmessage').html('*  Please Select a record').addClass('alert alert-danger');
      }
     } 
    }
    $(".temp").delay(4000).fadeOut("slow");

</script>