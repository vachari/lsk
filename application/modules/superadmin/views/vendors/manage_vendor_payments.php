<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Vendor Payments</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" type="text/css" href="<?php echo SUPER_CSS_PATH ; ?>bootstrap.min.css" />
  <link href="<?php echo CSS_PATH;?>jquery-ui.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>font-awesome.min.css">
  <!-- Ionicons -->
 <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>gharaahaar1.css">
 
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>select2.min.css">
<style>
        .pages a,.pages strong{                
            border-radius: 9px 9px;
            padding: 7px 12px;
         }
        .pages a{
             background-color:pink ;
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
       Manage Vendor Payments
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Vendor Payments</li>
      </ol>
    </section>
<?php //print_r($common_result);?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9"></div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
          <a href="" class="btn btn-info" title="Refresh"><i class="fa fa-refresh"></i></a>
         <button  class="btn btn-success   btn-md" onclick="updateActivationStatus('1')"> Active </button>
            <button  class="btn btn-warning   btn-md"  onclick="updateActivationStatus('0')">In-Active </button>  
                                 
           <span onclick="return confirm('Confirm to delete')"><button  class="btn btn-danger  btn-md" onclick="commonDelete();" title="Move to trash"> <i class="fa fa-trash"></i> </button></span>
          
        </div>
      </div>
      <div class="clearfix">&nbsp;</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <input type="text" class="form-control" name="search_name" id="search_name" placeholder="Search by Order/Vendor Contact/City/Pin Code" value="">
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <select name='vendor' id='vendor' class ='selectpicker form-control input-md select2 form-control' placeholder= 'Select Vendor'>
                            <option value=''>Select Vendor</option>
                            <?php
                                $vendor_res = json_decode($vendor_result);
                                if ($vendor_res->code == SUCCESS_CODE) {
                                    foreach ($vendor_res->vendor_list as $vendor_response) {
                                        ?>
                                        <option value="<?php echo $vendor_response->vendor_id; ?>"><?php echo ucfirst($vendor_response->vendor_name).' ('.$vendor_response->vendor_code.' )'; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <select class="form-control selectpicker select2" name="power_user" id="power_user">
                          <option value="">Select Power User</option>
                          <?php $power_users= json_decode($power_users);
                           if($power_users->code==200){
                            foreach ($power_users->result as $row) { ?>
                              <option value="<?php echo $row->user_id ?>"><?php echo $row->user_name; ?></option>  
                           <?php }
                          } ?>
                        </select>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <input type="text" name="delivery_date" id="delivery_date" value="" class="form-control" placeholder=" Sort By Delivery Date" id="delivery_date">
                  </div>

          </div>
          
      <div style="height: 35px;"></div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row">
              <div class="col-sm-12 table-responsive">
              <table class="table " id="">
                    <thead>
                      <tr id="success"><td class="text-center text-success"><span id="successmessage"></span></td> </tr>
                      <tr id="fail"><td class="text-center text-danger"><span id="failmessage"></span></td> </tr>
                     
                    </thead>
                    
              </table>
              <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-success" id="temp">      
                            <?php echo $this->session->flashdata('message') ?>
                        </div>
                    <?php } ?>
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-payments">
                        <thead>

                            <tr>
                                <th>
                                    <input type="checkbox" id="checkAll" >
                                </th>
                                <th>Order #</th>
                                <th style="min-width: 150px">Vendor Name(Code)</th>
                                <th style="min-width: 250px">Vendor Contact</th>
                                <th style="min-width: 150px">Power User Name</th>
                                <th>Total Value of Delivery(&#8377;)</th>
                                <th>Paid Amount(&#8377;)</th>
                                <th>Due Amount(&#8377;)</th>
                                <th>Due Days</th>
                                <th style="min-width: 110px">Delivery Date</th>
                                <th>City</th>
                                <th>Pincode</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                                $payments=json_decode($payments);
                                   if($payments->code != 200 ){

                                    echo '<tr> <td colspan=13> <div class="alert alert-danger text-center">Payments not found</div></td></tr>';

                                   }else{
                                    // $srno=$this->uri->segment(4,0);
                                    // $i=$srno+1;
                                    foreach ($payments->result as $ol) {
                                     
                                ?>
                        <tr>
                        <td><input type="checkbox"  name="multiple[]" value="<?php echo $ol->vendor_payment_id; ?>">  </td>
                        <td><?php echo $ol->order_number ?></td>
                        <td><?php echo $ol->vendor_name.' ('.$ol->vendor_code.')' ?></td>
                        <td><?php echo 'Phone: '.$ol->mobile.'<br> Email: '.$ol->email ?></td>
                        <td><?php echo $ol->power_user_name ?></td>
                        <td> <?php echo  $ol->total_value_of_delivery; ?> </td>
                        <td> <?php echo  $ol->collected_amount; ?> </td>
                        <td> <?php echo  $ol->due_amount; ?> </td>
                        <td> <?php echo  $ol->due_days; ?> </td>
                        <td> <?php if(strtotime($ol->delivery_date) > 0) echo date('d-M-Y',strtotime($ol->delivery_date));?></td>
                        <td> <?php echo $ol->city;?></td>
                        <td><?php echo $ol->pincode; ?></td>
                        <td></td>
                      </tr>
                      <?php  }  }?>
                        </tbody>
                    </table>
              <div class="text-center">
                                      <p id="payments_total_rows" class="text-success"><?php if(isset($total_rows) && !empty($total_rows)){ if($total_rows==1) echo '1 payment found'; else echo $total_rows. ' payments found';} ?></p>
                                      <p id="payments_pagination"></p>
                                    
                                            <div class="payments_pages">
                                          <?php if(!empty($links)) echo $links ?>
                                            </div>
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
<script src="<?php echo JS_PATH;?>jquery-ui.js"></script>
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
<script type="text/javascript">
    $(".select2").select2();
    $('#delivery_date').datepicker();
    $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
if(this.checked){
      $(".checkSingle").each(function(){
        this.checked=true;
      })
    }else{
      $(".checkSingle").each(function(){
        this.checked=false;
      })
    }

});
$(".checkSingle").click(function () {
    if ($(this).is(":checked")){
      var isAllChecked = 0;
      $(".checkSingle").each(function(){
        if(!this.checked)
           isAllChecked = 1;
      })
      if(isAllChecked == 0){ $("#checkAll").prop("checked", true); }
    }
    else {
      $("#checkAll").prop("checked", false);
    }
});
</script>
<script type="text/javascript">
  // filters for non-assigned orders
$('#search_name').on('keyup', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var vendor = $('#vendor').val();
    var pu = $('#power_user').val();
    var delivery_date=$('#delivery_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'search_name':keyword,'vendor':vendor,'power_user':pu,'delivery_date':delivery_date},
             url:"<?php echo base_url().'superadmin/payments/vendorPaymentsAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-payments > tbody').html(data.html);
              $('#payments_total_rows').html(data.total_rows);
              $('#payments_pagination').html(data.pagination);
              $('.payments_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  } );
$('#delivery_date').on('change', function(e) {
    e.preventDefault();
    var delivery_date=$(this).val();
    var search_name = $('#search_name').val();
    var vendor = $('#vendor').val();
    var pu=$('#power_user').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'search_name':search_name,'vendor':vendor,'power_user':pu,'delivery_date':delivery_date},
             url:"<?php echo base_url().'superadmin/payments/vendorPaymentsAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-payments > tbody').html(data.html);
              $('#payments_total_rows').html(data.total_rows);
              $('#payments_pagination').html(data.pagination);
              $('.payments_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  } );
$('#vendor').on('change', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var pu = $('#power_user').val();
    var search_name = $('#search_name').val();
    var delivery_date=$('#delivery_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'search_name':search_name,'vendor':keyword,'power_user':pu,'delivery_date':delivery_date},
             url:"<?php echo base_url().'superadmin/payments/vendorPaymentsAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-payments > tbody').html(data.html);
              $('#payments_total_rows').html(data.total_rows);
              $('#payments_pagination').html(data.pagination);
              $('.payments_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  } );


$('#power_user').on('change', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var vendor = $('#vendor').val();
    var search_name = $('#search_name').val();
    var delivery_date=$('#delivery_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'search_name':search_name,'vendor':vendor,'power_user':keyword,'delivery_date':delivery_date},
             url:"<?php echo base_url().'superadmin/payments/vendorPaymentsAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-payments > tbody').html(data.html);
              $('#payments_total_rows').html(data.total_rows);
              $('#payments_pagination').html(data.pagination);
              $('.payments_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  } );


  $('#payments_pagination').on('click','a',function(e){
       e.preventDefault(); 
      var pageno = $(this).attr('data-ci-pagination-page');
       loadPaymentsPagination(pageno);
     });

  function loadPaymentsPagination(pageno){
    var search_name=$('#search_name').val();
    var vendor = $('#vendor').val();
    var pu=$('#power_user').val();
    var delivery_date=$('#delivery_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'search_name':search_name,'vendor':vendor,'power_user':pu,'delivery_date':delivery_date},
             url:"<?php echo base_url().'superadmin/payments/vendorPaymentsAjax/' ?>"+ pageno,
             success:function(data){
              console.log(data);
              $('#dataTables-payments > tbody').html(data.html);
              $('#payments_total_rows').html(data.total_rows);
              $('#payments_pagination').html(data.pagination);
              $('.payments_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  }
  $('#temp').delay(3000).fadeOut('slow');
</script>
</body>
</html>