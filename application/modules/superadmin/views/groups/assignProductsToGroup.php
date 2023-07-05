<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Assign Products To Group </title>
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
       Assign Products To Group
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo  SUPER_ADMIN_FOLDER_PATH;?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo  SUPER_ADMIN_FOLDER_PATH;?>Settings/manageGroups"><i class="fa fa-dashboard"></i> Manage Groups </a></li>
        <li class="active"> Assign Products To Group</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            
            <div class="box-header with-border">
            <h3 class="box-title">Assign Products To Group</h3>
            <a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>Settings/manageGroups" class="btn btn-primary pull-right">Manage Groups</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
            <div class="box-body">
              <div class="clearfix">&emsp;</div>
             
            <div class="col-md-12">
               
              <div class="form-group col-md-3" style="background-color: #ddd">
                        <label for="group">Select Group<span style="color: red"> *</span></label>
                        <select class="form-control" name="select_group" id="select_group">
                          <option value="">--Select Group--</option>
                          <?php $groups= json_decode($groups);
                           if($groups!=null){
                            foreach ($groups as $row) { ?>
                              <option value="<?php echo $row->id ?>"<?php echo set_select('group',$row->id) ?>><?php echo $row->group_name.'('.$row->group_code.')' ?></option>  
                           <?php }
                          } ?>
                        </select>
              </div>
              <div class="col-md-9">
                <div id="displaymsg"></div>
                <?php if($this->session->flashdata('success')){echo "<div class='alert alert-success temp'>".$this->session->flashdata('success')."</div>";}
          if($this->session->flashdata('failed')){
          echo "<div class='alert alert-danger temp'>".$this->session->flashdata('failed')."</div>"; } ?>
              </div>
              <div class="clearfix">&emsp;</div>
              <hr>
            </div>

             
            <div class="col-md-12"> 
                      <div class="col-md-10 col-md-offset-1">
                        <?php
                        $attributes = array('name' => 'form', 'id' => 'unit-form', 'class' => '');
                        echo form_open('', $attributes);
                        ?>
                        <input type="hidden" name="group" id="group" value="">
                      <div class="form-group col-md-3" style="display: none">
                        <label for="group">Group<span style="color: red"> *</span></label>
                        
                      </div>
                      <div class="form-group col-md-3">
                        <label for="product">Product</label>
                        <input type="text" name="product" id="product" value="" class="form-control" placeholder="Search by code or name">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="vendor">Vendor</label>
                        <input type="text" name="vendor" id="vendor" value="" class="form-control" placeholder="Search by code or name">
                      </div>
                      <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-success" name="submit" style="margin-top: 25px">Assign Selected</button>&emsp;
                        <a href="" class="btn btn-primary" style="margin-top: 25px" title="Refresh"><i class="glyphicon glyphicon-refresh"></i></a>
                      </div>
                   <div class="table-responsive col-md-12" style="float:left;width:100%;overflow-y: auto;height: 250px;">
                    
                      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-non-assigned">
                        <thead>
                            <tr>
                                <th>
                                    <!-- <input type="checkbox" id="checkAll"> -->
                                </th>
                                <th> Product Code </th>
                                <th> Product Name</th>
                                <th> Vendor Code</th>
                                <th> Vendor Name</th>
                                <th> Image</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $products=json_decode($products);
                          if($products !=null){
                           

                            foreach ($products as $prod) { ?>
                                <tr class="">
                                    <td><input type="checkbox" class="inline-checkbox checkSingle" name="na_product_id[]" value="<?php echo $prod->id ?>"></td>
                                    <td> <?php echo $prod->prod_code; ?></td>
                                    <td> <?php echo fetch_ucwords($prod->prod_name); ?></td>
                                    <td> <?php echo $prod->vendor_code; ?> </td>
                                    <td> <?php echo fetch_ucwords($prod->vendor_name); ?> </td>
                                    <td><img width="50px" src="<?php echo base_url(); ?>uploads/products/<?php echo $prod->prod_image; ?>"></td>
                                </tr>
                              <?php } }else{ ?>
                        <div class="text-center col-md-12">
                          <p style="color: red">Non-Assigned Products Not Available</p>
                        </div>
                      <?php } ?>
                        </tbody>
                      </table>
                    
                       <div class="text-center">
                                      <p id="non_assigned_total_rows" class="text-success"><?php if($products !=null) echo count($products). ' Products Available' ?></p>
                                      <p id="non_assigned_pagination"></p>
                                    <span class="non_assigned_pages"></span>
                          </div>
                      </div>
                     <?php echo form_close(); ?>
                     </div>
                <!-- Assigned Product List -->
                 <?php
                        $attributes = array('name' => 'form', 'id' => 'group-form', 'class' => 'navbar-form');
                        echo form_open_multipart('superadmin/Settings/multipleProductsRemoveFromGroup', $attributes);
                 ?>
                <div class="col-md-10 col-md-offset-1">
                  <h3 class="box-title">Assigned Products Of The Selected Group</h3>
                  <div class="clearfix">&nbsp;</div>
                  <div class="form-group col-md-3">
                        <label for="product">Product</label>
                        <input type="text" name="product" id="a_product" value="" class="form-control" placeholder="Search by code or name">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="vendor">Vendor</label>
                        <input type="text" name="vendor" id="a_vendor" value="" class="form-control" placeholder="Search by code or name">
                      </div>
                      <div class="form-group col-md-3">
                        <br>
                        <input type="hidden" name="id" id="groupid" value="">
                        <?php echo form_submit('submit', 'Remove Selected', array('class' => 'btn btn-danger btn-remove', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
                      </div>
                      <div class="clearfix">&nbsp;</div><div class="clearfix">&nbsp;</div>
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-assigned">
                        <thead>
                            <tr>
                                <th>
                                    <!-- <input type="checkbox" id="checkAll"> -->
                                </th>
                                <th> Product Code </th>
                                <th> Product Name</th>
                                <th> Vendor Code</th>
                                <th> Vendor Name</th>
                                <th> Image</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
                      </table>
                      <div class="form-group col-md-3">
                        <?php echo form_submit('submit', 'Remove Selected', array('class' => 'btn btn-danger btn-remove', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
                      </div>
                      <div class="text-center">
                                      <p id="assigned_total_rows" class="text-success"></p>
                                      <p id="assigned_pagination"></p>
                                    <span class="assigned_pages"></span>
                          </div>
                </div>
                 <?php echo form_close(); ?>
              </div>

<div class="clearfix">&nbsp;</div><div class="clearfix">&nbsp;</div>
             </div>
            </div>
   
          </div>
        </div>
      </div>
    </section>  
    <div class="clearfix"></div>
    <span class="help_block"></span>
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
<!-- <script src="<?php echo SUPER_JS_PATH; ?>dashboard2.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo SUPER_JS_PATH; ?>demo.js"></script>


</body>
</html>
<script type="text/javascript">
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
    $('#select_group').on('change',function(e){
      e.preventDefault();
      var keyword=$(this).val();
      $('#group').val(keyword);
      $('#groupid').val(keyword);
      var product=$('#a_product').val();
      var vendor=$('#a_vendor').val();

    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'group':keyword,'product':product,'vendor':vendor},
             url:"<?php echo base_url().'superadmin/Settings/assignedGroupProductsAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-assigned > tbody').html(data.html);
              $('#assigned_total_rows').html(data.total_rows);
              $('#assigned_pagination').html(data.pagination);
              $('.assigned_pages').html('');
             },
              error:function(e){console.log(e);}
         });
});
// filters for non-assigned products
$('#product').on('keyup', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var vendor=$('#vendor').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'product':keyword,'vendor':vendor},
             url:"<?php echo base_url().'superadmin/Settings/assignProductsToGroupAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-non-assigned > tbody').html(data.html);
              $('#non_assigned_total_rows').html(data.total_rows);
              $('#non_assigned_pagination').html(data.pagination);
              $('.non_assigned_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  } );

  $('#vendor').on('keyup', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var product=$('#product').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'product':product,'vendor':keyword},
             url:"<?php echo base_url().'superadmin/Settings/assignProductsToGroupAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-non-assigned > tbody').html(data.html);
              $('#non_assigend_total_rows').html(data.total_rows);
              $('#non_assigend_pagination').html(data.pagination);
              $('.non_assigend_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  } );

  $('#non_assigned_pagination').on('click','a',function(e){
       e.preventDefault(); 
      var pageno = $(this).attr('data-ci-pagination-page');
       loadNonAssignedPagination(pageno);
     });

  function loadNonAssignedPagination(pageno){
    var product=$('#product').val();
    var vendor=$('#vendor').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'product':product,'vendor':vendor},
             url:"<?php echo base_url().'superadmin/Settings/assignProductsToGroupAjax/' ?>"+ pageno,
             success:function(data){
              console.log(data);
              $('#dataTables-non-assigned > tbody').html(data.html);
              $('#non_assigned_total_rows').html(data.total_rows);
              $('#non_assigned_pagination').html(data.pagination);
              $('.non_assigned_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  }
// filters for assigned products
  $('#a_product').on('keyup', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var group=$('#group').val();
    var vendor=$('#a_vendor').val();
    var groupid=$('#groupid').val();
    if(groupid){
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'group':group,'product':keyword,'vendor':vendor},
             url:"<?php echo base_url().'superadmin/Settings/assignedGroupProductsAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-assigned > tbody').html(data.html);
              $('#assigned_total_rows').html(data.total_rows);
              $('#assigned_pagination').html(data.pagination);
              $('.assigned_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  }
  } );

  $('#a_vendor').on('keyup', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var group=$('#group').val();
    var product=$('#a_product').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'group':group,'product':product,'vendor':keyword},
             url:"<?php echo base_url().'superadmin/Settings/assignedGroupProductsAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-assigned > tbody').html(data.html);
              $('#assigend_total_rows').html(data.total_rows);
              $('#assigend_pagination').html(data.pagination);
              $('.assigend_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  } );

  $('#assigned_pagination').on('click','a',function(e){
       e.preventDefault(); 
      var pageno = $(this).attr('data-ci-pagination-page');
       loadPagination(pageno);
     });

  function loadPagination(pageno){
    var group=$('#group').val();
    var product=$('#a_product').val();
    var vendor=$('#v_vendor').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'group':group,'product':product,'vendor':vendor},
             url:"<?php echo base_url().'superadmin/Settings/assignedGroupProductsAjax/' ?>"+ pageno,
             success:function(data){
              console.log(data);
              $('#dataTables-assigned > tbody').html(data.html);
              $('#assigned_total_rows').html(data.total_rows);
              $('#assigned_pagination').html(data.pagination);
              $('.assigned_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  }

  </script>

<script type="text/javascript">
$('#group-form').on('submit', function () {
    var str = true;
         var listarray = new Array();
        $('input[name="product_id[]"]:checked').each(function () {
            listarray.push($(this).val());
        });   
        var checklist = "" + listarray;
        if (checklist == '') {
            str = false;
            alert('Please select products to remove');
        } 
    return str;
  });



  $('#unit-form').on('submit', function (e) {
    e.preventDefault();
       var str = true;
       var group=$('#select_group').val();
       $('#select_group').css('border','');
       if(group==''){
          str=false;
          $('#select_group').css('border','1px solid red');
       }else{
        $('#select_group').css('border','');
       }

        var listarray = new Array();
        $('input[name="na_product_id[]"]:checked').each(function () {
            listarray.push($(this).val());
        });   
        var checklist = "" + listarray;
        if(str==true){
        if (checklist != '') {
            $.ajax({
                dataType: 'json',
                type: 'post',
                data: {'group': group, 'products': checklist},
                url: '<?php echo base_url(); ?>superadmin/Settings/groupProductsUpdate/',
                success: function (u) {
                    console.log(u);
                    if(u.code=='200'){$('#displaymsg').html(u.description).addClass('alert alert-success temp');setTimeout(function() {window.location=location.href;},2000);}
                    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#displaymsg').html(u.description).addClass('alert alert-danger temp');setTimeout(function() {window.location=location.href;},2000);}
                },
                error: function (er) {
                    console.log(er);
                }
            });
        } else {
            str = false;
            alert('Please select products to assign');
        }
      }
      return str;
    });
  $(".temp").delay(2000).fadeOut("slow");
</script>
