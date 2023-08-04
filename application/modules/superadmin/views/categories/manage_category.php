<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Manage Category</title>
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
  <style>
    .pages a,
    .pages strong {
      border: 1px solid #ddd;
      border-radius: 9px 9px;
      padding: 7px 12px;
    }

    .pages a {
      background-color: #c52825;
      border-radius: 50px;
      color: white;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php $this->load->view("includes/header.php"); ?>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <?php $this->load->view("includes/sidebar.php"); ?>
      <!-- /.sid$this->load->view("includes/header.php")bar -->
    </aside>
    <?php
    $result = json_decode($common_result);
    //print_r($result->common_result); 

    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Manage Category
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Manage Category</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <div class="col-md-12 col-sm-12">

                  <div class="col-md-4 ">
                    <form method="post">
                      <div class="col-md-6 pd0 form-inline">
                        <input type="text" name="search" class="form-control" placeholder="Search by Category" required>
                      </div>
                      <div class="col-md-2 pd0">
                        <input type="submit" class="btn btn-md btn-default" name="submit" value="Search">
                      </div>
                    </form>
                    <div class="col-md-2 col-md-offset-1">
                      <a href="" class="btn btn-info" title="Refresh"><i class="fa fa-refresh"></i></a>
                    </div>

                  </div>
                  <div class="col-md-7 form-inline">
                    <button class="btn btn-success " onclick="updateActivationStatus('1')"><!-- <i class="fa fa-check" aria-hidden="true"> --></i>&nbsp;Active</button>
                    <button class="btn btn-warning btn-md" onclick="updateActivationStatus('0')"><!-- <i class="fa fa-ban" aria-hidden="true"> --></i>&nbsp;In active</button>
                    <button class="btn btn-success " onclick="frontEnable('1')"><!-- <i class="fa fa-check" aria-hidden="true"> --></i>&nbsp;Front Enable</button>
                    <button class="btn btn-warning btn-md" onclick="frontEnable('0')"><!-- <i class="fa fa-ban" aria-hidden="true"> --></i>&nbsp;Front Disable</button>
                    <span><button class="btn btn-danger  btn-md" onclick="commonDelete();"> Delete </button></span>
                    <!-- <span onclick="return confirm('Confirm to delete')"><button  class="btn btn-danger btn-sm" onclick="commonDelete();"> Delete</button> </span>  -->

                  </div>

                  <div class="col-md-1">
                    <a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Category/createCategory" class="btn btn-primary pull-right">Add New</a>
                    <?php
                    // if($result->common_result!=null){ $total=count($result->common_result); echo "Total : ".$total; } 
                    ?>
                  </div>



                </div>
                <div style="height: 35px;"></div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                      <div class="col-sm-6"></div>
                      <div class="col-sm-6"></div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <table class="table " id="">
                          <thead>
                            <tr id="success">
                              <td class="text-center text-success"><span id="successmessage"></span></td>
                            </tr>
                            <tr id="fail">
                              <td class="text-center text-danger"><span id="failmessage"></span></td>
                            </tr>

                          </thead>

                        </table>


                      </div>
                      <div class="col-md-12">

                        <div id="successmessage"></div>
                        <div id="failmessage"></div>
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
                      </div>

                      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>

                          <tr>
                            <th>
                              <input type="checkbox" id="multiAction">
                            </th>
                            <th> ID</th>
                            <th> Category Name </th>
                            <th> Image </th>
                            <th> Offer (%) </th>
                            <th> Front Enable </th>
                            <th> Status </th>
                            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $seg = $this->uri->segment(4);
                          if (empty($seg))
                            $i = 1;
                          else
                            $i = $seg + 1;
                          if ($result->common_result != null) {
                            foreach ($result->common_result as $row) {
                              // print_r($row);
                          ?>

                              <tr class="">
                                <td><input type="checkbox" name="multiple[]" value="<?php echo $row->menu_id; ?>"> </td>
                                <td> <?php echo $i; ?></td>
                                <td> <?php echo $row->menu_title; ?>( <?php echo $row->menu_id; ?>)</td>
                                <td>
                                  <?php if (!empty($row->image)) { ?>
                                    <img src="<?php echo base_url(); ?>uploads/menu/<?php echo $row->image; ?>" style="width:50px;" />
                                  <?php } else {
                                    echo "NO IMAGE";
                                  }
                                  ?>
                                </td>
                                <td> <?php echo $row->offer_price; ?> %</td>
                                <td>
                                  <?php
                                  if ($row->front_enable == 1) { ?>
                                    <span class="label label-success">Enable</span>
                                  <?php } else { ?>
                                    <span class="label label-danger">Disable</span>
                                  <?php }
                                  ?>


                                </td>
                                <td class="text-success"><b class="text-success">
                                    <?php if ($row->flag_status == 1) { ?>
                                      <span style="color:green">Active</span>
                                    <?php } else { ?>
                                      <span style="color:red">In-Active</span>
                                    <?php }
                                    ?>
                                </td>
                                <td>
                                  <a href="<?php echo base_url(); ?>superadmin/Category/delete_menu/<?php echo $row->menu_id; ?>" class="btn btn-sm btn-danger " onclick="return confirm('Are you sure?')"> <i class="glyphicon glyphicon-trash"></i> Delete </a>
                                  <a href="<?php echo base_url(); ?>superadmin/updatemenu/<?php echo $row->menu_id; ?>" class="btn btn-sm btn-warning "> <i class="glyphicon glyphicon-pencil "> </i>&nbsp; Edit </a>
                                </td>
                              </tr>
                            <?php
                              $i++;
                            }
                          } else { ?>
                            <tr>
                              <td colspan="7" style="text-align:center; color:red;font-size:20px;">Categories Not Found</td>
                            </tr>
                          <?php }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="text-center">
                    <td colspan="7">
                      <p class="pages"><?php echo $links; ?></p>
                    </td>
                  </div>
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
      <?php $this->load->view("includes/footer.php"); ?>

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
    <!--  -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

  </div>
  <!-- ./wrapper -->




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
  $('#success').hide();
  $('#fail').hide();
  /***Check Or Uncheck the Check box List Code Start*/
  $('#multiAction').click(function() {
    if ($('#multiAction').is(':checked')) {
      $('#multiAction').prop('checked', true);
      $('[name="multiple[]"]').prop('checked', true);
    } else {
      $('#multiAction').prop('checked', false);
      $('[name="multiple[]"]').prop('checked', false);
    }
  });
  /***Check Or Uncheck the Check box List Code End*/


  function frontEnable(sid) {
    var listarray = new Array();
    $('input[name="multiple[]"]:checked').each(function() {
      listarray.push($(this).val());
    });
    // alert('hai'); 
    var checklist = "" + listarray;
    if (!isNaN(sid) && (sid == '1' || sid == '0') && checklist != '') {
      $.ajax({
        type: "POST",
        dataType: "json",
        data: {
          'tablename': 'front_enable',
          'upldatelist': checklist,
          'activity': sid
        },
        url: "<?php echo base_url(); ?>superadmin/Common_controller/commonStatus",
        success: function(u) {
          console.log(u);
          if (u.code == '200') {
            $('#success').show();
            $('#successmessage').html(u.description).addClass('alert alert-success');
            setTimeout(function() {
              window.location = location.href;
            }, 2000);
          }
          if (u.code == '204' || u.code == '301' || u.code == '422') {
            $('#fail').show();
            $('#failmessage').html(u.description).addClass('alert alert-danger');
            setTimeout(function() {
              window.location = location.href;
            }, 2000);
          }
        },
        error: function(er) {
          console.log(er);
        }

      });
    }
  }


  function updateActivationStatus(sid) {

    var listarray = new Array();
    $('input[name="multiple[]"]:checked').each(function() {
      listarray.push($(this).val());
    });
    // alert('hai'); 
    var checklist = "" + listarray;
    if (!isNaN(sid) && (sid == '1' || sid == '0') && checklist != '') {

      $.ajax({
        type: "POST",
        dataType: "json",
        data: {
          'tablename': 'menu_list',
          'upldatelist': checklist,
          'activity': sid
        },
        url: "<?php echo base_url(); ?>superadmin/Common_controller/commonStatus",
        success: function(u) {
          console.log(u);
          if (u.code == '200') {
            $('#success').show();
            $('#successmessage').html(u.description).addClass('alert alert-success');
            setTimeout(function() {
              window.location = location.href;
            }, 2000);
          }
          if (u.code == '204' || u.code == '301' || u.code == '422') {
            $('#fail').show();
            $('#failmessage').html(u.description).addClass('alert alert-danger');
            setTimeout(function() {
              window.location = location.href;
            }, 2000);
          }
        },
        error: function(er) {
          console.log(er);
        }

      });
    } else {
      $('#fail').show();
      $('#failmessage').html('*  Please Select records').addClass('alert alert-danger');
      setTimeout(function() {
        window.location = location.href;
      }, 2000);
    }
  }
</script>

<script type="text/javascript">
  function commonDelete() {
    var result = confirm("Want to delete?");
    if (result) {
      var listarray = new Array();
      $('input[name="multiple[]"]:checked').each(function() {
        listarray.push($(this).val());
      });
      var checklist = "" + listarray;
      alert(checklist);
      if (checklist != '') {
        $('#fail').hide();
        $.ajax({
          dataType: 'json',
          type: 'post',
          data: {
            'tablename': 'menu',
            'updatelist': checklist
          },
          url: '<?php echo base_url(); ?>superadmin/Category/commonDelete/',
          success: function(u) {
            // console.log(u);
            if (u.code == '200') {
              $('#success').show();
              $('#successmessage').html(u.description).addClass('alert alert-success');
              setTimeout(function() {
                window.location = location.href;
              }, 2000);
            }
            if (u.code == '204' || u.code == '301' || u.code == '422') {
              $('#fail').show();
              $('#failmessage').html(u.description).addClass('alert alert-danger');
            }
          },
          error: function(er) {
            console.log(er);
          }
        });
      } else {
        $('#fail').show();
        $('#failmessage').html('*  Please Select ').addClass('alert alert-danger');
      }
    }
  }
  $(".temp").delay(4000).fadeOut("slow");
</script>