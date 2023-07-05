<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>:: Shoperative ::</title>
    <link href="<?php echo CSS_PATH;?>bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>jquery-ui.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>main.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>menu.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"  href="<?php echo CSS_PATH;?>bliss-slider.css">
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>select2.min.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->  
    <style type="text/css">
    .text-danger {
    color: #ff0000 !important;
    }
    .select2-container {
    width: 100% !important;
}
    </style>     
</head><!--/head-->

<body class="popup">

    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
            <?php  $this->load->view('vendor/includes/header.php');?>
    </div>

    <section>
        <div class="container martop150">
            <div class="col-md-3 bg_profile ">
                <div class="col-xs-12 mrtop">
                     <ul class="profile-side-bar">
                        <li> <a href=" <?php echo base_url().'vendor/dashboard'; ?>"> Dashboard</a></li>
                         <li  > <a href="<?php echo base_url().'vendor/profile'; ?>"> My Profile</a></li>
                         <li> <a href="<?php echo base_url().'vendor/products'; ?>">Create/Manage Products</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-inventory'; ?>">Product Inventory/Availability</a></li>
                         <li> <a href="<?php echo base_url().'vendor/assign-products-to-group'; ?>">Assign Products To Group</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-wise-prices'; ?>">Product Wise Prices</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-group-wise-prices'; ?>">Product Group Wise Prices</a></li>
                         <li> <a href="<?php echo base_url().'vendor/manage-shippers'; ?>">Manage Shippers</a></li>
                         <li> <a href="<?php echo base_url().'vendor/manage-shipping-cost'; ?>">Manage Shipping Cost</a></li>
                         <li> <a href="<?php echo base_url().'vendor/all-open-orders'; ?>">View All Open Orders</a></li>
                         <li class=""> <a href="<?php echo base_url().'vendor/all-dispatched_orders'; ?>">View All Dispatched Orders</a></li>
                         <li class=""> <a href="<?php echo base_url().'vendor/all-delivered-orders'; ?>">View All Closed Orders</a></li>
                         <li class="active"> <a href="<?php echo base_url().'vendor/assign-orders-to-shipper'; ?>">Assign Orders To Shipper</a></li>
                         <li> <a href="<?php echo base_url().'vendor/accounts-receivable'; ?>">Accounts Receivable</a></li>
                         <li> <a href=" <?php echo base_url() . 'vendor/change-password'; ?>"> Change Password   </a></li>
                         <li> <a href=" <?php echo base_url() . 'vendor/logout'; ?>"> Logout   </a></li>
                     </ul>
                </div>
                 <div style="height:300px" class="hidden-xs"></div>
                

            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                
                <div class="col-md-12">
                <?php
                    if($this->session->flashdata('Success'))
                    {
                        echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('Success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                        }
                    elseif($this->session->flashdata('Failed'))
                    { 
                        echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('Failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                     }else{
                      echo '<div id="displaymsg"></div>';
                     } ?>

                    <div class="header-title">
                        <h4> Assign Orders To Shipper<a href="<?php echo base_url().'vendor/assign-orders-to-shipper'; ?>" class="btn btn-primary pull-right" title="Refresh"><i class="glyphicon glyphicon-refresh"></i></a></h4>
                        <hr> 
                    </div>
                   <!-- Assign orders catelogue open here -->
<div class="col-md-12">
               
              <div class="form-group col-md-3" style="background-color: #ddd">
                        <label for="shipper">Select Shipper<span style="color: red"> *</span></label>
                        <select class="form-control selectpicker select2" name="select_shipper" id="select_shipper">
                          <option value="">--Select Shipper--</option>
                          <?php $shippers= json_decode($shippers);
                           if($shippers->code==200){
                            foreach ($shippers->result as $row) { ?>
                              <option value="<?php echo $row->shipper_id ?>"<?php echo set_select('shipper',$row->shipper_id) ?>><?php echo $row->shipper_name.'('.$row->shipper_code.')' ?></option>  
                           <?php }
                          } ?>
                        </select>
              </div>
            </div>
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#non-assigned-orders">Assign Orders</a></li>
              <li><a data-toggle="tab" href="#assigned-orders">Remove Assigned Orders</a></li>
            </ul>
            <div class="tab-content">
              <div id="non-assigned-orders" class="tab-pane fade in active">
                 <?php
                        $attributes = array('name' => 'form', 'id' => 'unit-form', 'class' => '');
                        echo form_open('', $attributes);
                        ?>
                        <input type="hidden" name="shipper" id="shipper" value="">
                      <div class="form-group col-md-3" style="display: none">
                        <label for="shipper">Shipper<span style="color: red"> *</span></label>
                        
                      </div>
                      <div class="col-md-12">
                        <h4>Select from unassigned orders below</h4>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="order"></label>
                        <input type="text" name="order" id="order" value="" class="form-control" placeholder="Search by Order/City/Pincode">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="due_date"></label>
                        <input type="text" name="due_date" value="" placeholder=" Sort By Order Due Date" id="due_date" style="margin-top: 22px">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="power_user"></label>
                        <select class="form-control selectpicker select2" name="power_user" id="power_user">
                          <option value="">Sort by Power User</option>
                          <?php $power_users= json_decode($power_users);
                           if($power_users->code==200){
                            foreach ($power_users->result as $row) { ?>
                              <option value="<?php echo $row->user_id ?>"<?php echo set_select('power_user',$row->user_id) ?>><?php echo $row->user_name; ?></option>  
                           <?php }
                          } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-success btn-sm" name="submit" style="margin-top: 20px">Assign Selected</button>
                        
                      </div>
                   <div class="table-responsive col-md-12" style="float:left;width:100%;overflow-y: auto;height: 350px;">
                    
                      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-non-assigned">
                        <thead>
                            <tr>
                                <th>
                                    <!-- <input type="checkbox" id="checkAll"> -->
                                </th>
                                <th>Order #</th>
                                <th>Power User Name</th>
                                <th style="min-width: 110px">Delivery Due Date</th>
                                <th>Order Items</th>
                                <th>Order Qty</th>
                                <th>Total(&#8377;)</th>
                                <th>City</th>
                                <th>Pincode</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $orders=json_decode($orders);
                          if($orders->code==200){
                            foreach ($orders->result as $order) { ?>
                                <tr class="">
                                    <td><input type="checkbox" class="inline-checkbox checkSingle" name="na_order_id[]" value="<?php echo $order->orderid ?>"></td>
                                    <td><a href="<?php echo base_url().'vendor/order-details/'.base64_encode($order->orderid) ?>"><?php echo $order->ordernumber ?></a></td>
                                    <td><?php echo ucwords($order->power_user_name); ?></td>
                                    <td> <?php echo date("d-M-Y ", strtotime($order->delivery_due_date)); ?></td>
                                    <td> <?php echo $order->ordertotalitems; ?></td>
                                    <td> <?php echo $order->orderqty; ?></td>
                                    <td> <?php echo $order->totalpayableprice; ?></td>
                                    <td> <?php echo $order->city; ?></td>
                                    <td> <?php echo $order->pincode; ?></td>
                                    
                                </tr>
                              <?php } }else{ ?>
                        <div class="text-center col-md-12">
                          <p style="color: red">No Open Orders To Assign</p>
                        </div>
                      <?php } ?>
                        </tbody>
                      </table>
                    
                       <div class="text-center">
                                      <p id="non_assigned_total_rows" class="text-success"><?php if($orders->code==200){
                                      if(count($orders->result)==1) echo '1 Order Available'; else echo count($orders->result). ' Orders Available'; } ?></p>
                                      <p id="non_assigned_pagination"></p>
                                    <span class="non_assigned_pages"></span>
                          </div>
                      </div>
                     <?php echo form_close(); ?>
                     
              </div>
              <div id="assigned-orders" class="tab-pane fade">
                <!-- Assigned Order List -->
                 <?php
                        $attributes = array('name' => 'form', 'id' => 'shipper-form', 'class' => '');
                        echo form_open_multipart('front/vendor/multipleOrdersRemoveFromShipper', $attributes);
                 ?>
                <div class="col-md-12">
                  <h4>Assigned orders of the selected Shipper</h4>
                 <div class="row"> 
                  <div class="form-group col-md-4">
                        <label for="a_order"></label><br>
                        <input type="text" name="order" id="a_order" value="" class="form-control" placeholder="Search by Order/City/Pincode">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="a_due_date"></label>
                        <input type="text" name="a_due_date" value="" placeholder=" Sort By Order Due Date" id="a_due_date" style="margin-top: 22px">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="a_power_user"></label>
                        <select class="form-control selectpicker select2" name="a_power_user" id="a_power_user">
                          <option value="">Sort by Power User</option>
                          <?php
                           if($power_users->code==200){
                            foreach ($power_users->result as $row) { ?>
                              <option value="<?php echo $row->user_id ?>"<?php echo set_select('a_power_user',$row->user_id) ?>><?php echo $row->user_name; ?></option>  
                           <?php }
                          } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                      <br>
                        <input type="hidden" name="shipper_id" id="shipperid" value="">
                        <?php echo form_submit('submit', 'Remove Selected', array('class' => 'btn btn-danger btn-sm btn-remove', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
                      </div>
                      </div>
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-assigned">
                        <thead>
                            <tr>
                                <th>
                                    <!-- <input type="checkbox" id="checkAll"> -->
                                </th>
                                <th>Order #</th>
                                <th>Power User Name</th>
                                <th style="min-width: 110px">Delivery Due Date</th>
                                <th>Order Items</th>
                                <th>Order Qty</th>
                                <th>Total(&#8377;)</th>
                                <th>City</th>
                                <th>Pincode</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
                      </table>
                      <div class="row">
                      <div class="form-group col-md-3">
                        <?php echo form_submit('submit', 'Remove Selected', array('class' => 'btn btn-danger btn-sm btn-remove', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
                      </div>
                      </div>
                      <div class="text-center">
                                      <p id="assigned_total_rows" class="text-success"></p>
                                      <p id="assigned_pagination"></p>
                                    <span class="assigned_pages"></span>
                          </div>
                </div>
                 <?php echo form_close(); ?>
                               
                   <!-- Assign orders catelogue close here -->
              </div>
            </div>
                </div>
            </div><!-- end of 9 col -->
            
        </div>

    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>jquery-ui.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
    <script src="<?php echo SUPER_JS_PATH; ?>select2.full.min.js"></script>
   <script type="text/javascript">
    $('#displaymsg').html('<div class="alert alert-success alert-dismissible text-center">Please select Shipper to assign orders.<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
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
$('#due_date,#a_due_date').datepicker();
</script>
<script type="text/javascript">
    $('#select_shipper').on('change',function(e){
      e.preventDefault();
      var keyword=$(this).val();
      $('#shipper').val(keyword);
      $('#shipperid').val(keyword);
      var order=$('#a_order').val();
      var pu=$('#a_power_user').val();
      if(keyword){
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'shipper':keyword,'order':order,'power_user':pu},
             url:"<?php echo base_url().'front/vendor/assignedShipperOrdersAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-assigned > tbody').html(data.html);
              $('#assigned_total_rows').html(data.total_rows);
              $('#assigned_pagination').html(data.pagination);
              $('.assigned_pages').html('');
             },
              error:function(e){console.log(e);}
         });
          }else{
            $('#dataTables-assigned > tbody').html('');
              $('#assigned_total_rows').html('');
              $('#assigned_pagination').html('');
  }
});
// filters for non-assigned orders
$('#order').on('keyup', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var pu = $('#power_user').val();
    var due_date=$('#due_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'order':keyword,'power_user':pu,'due_date':due_date},
             url:"<?php echo base_url().'front/vendor/assignOrdersToShipperAjax/' ?>",
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
$('#due_date').on('change', function(e) {
    e.preventDefault();
    var due_date=$(this).val();
    var order = $('#order').val();
    var pu=$('#power_user').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'order':order,'power_user':pu,'due_date':due_date},
             url:"<?php echo base_url().'front/vendor/assignOrdersToShipperAjax/' ?>",
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

$('#power_user').on('change', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var order = $('#order').val();
    var due_date=$('#due_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'order':order,'power_user':keyword,'due_date':due_date},
             url:"<?php echo base_url().'front/vendor/assignOrdersToShipperAjax/' ?>",
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


  $('#non_assigned_pagination').on('click','a',function(e){
       e.preventDefault(); 
      var pageno = $(this).attr('data-ci-pagination-page');
       loadNonAssignedPagination(pageno);
     });

  function loadNonAssignedPagination(pageno){
    var order=$('#order').val();
    var pu=$('#power_user').val();
    var due_date=$('#due_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'order':order,'power_user':pu,'due_date':due_date},
             url:"<?php echo base_url().'front/vendor/assignOrdersToShipperAjax/' ?>"+ pageno,
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
// filters for assigned orders
  $('#a_order').on('keyup', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var shipper=$('#shipper').val();
    var shipperid=$('#shipperid').val();
    var pu=$('#a_power_user').val();
    var due_date=$('#a_due_date').val();
    if(shipperid){
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'shipper':shipper,'order':keyword,'power_user':pu,'due_date':due_date},
             url:"<?php echo base_url().'front/vendor/assignedShipperOrdersAjax/' ?>",
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
$('#a_due_date').on('change', function(e) {
    e.preventDefault();
    var due_date=$(this).val();
    var shipper=$('#shipper').val();
    var shipperid=$('#shipperid').val();
    var order=$('#a_order').val();
    var pu=$('#a_power_user').val();
    if(shipperid){
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'shipper':shipper,'order':order,'power_user':pu,'due_date':due_date},
             url:"<?php echo base_url().'front/vendor/assignedShipperOrdersAjax/' ?>",
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
$('#a_power_user').on('change', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var shipper=$('#shipper').val();
    var shipperid=$('#shipperid').val();
    var order=$('#a_order').val();
    var due_date=$('#a_due_date').val();
    if(shipperid){
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'shipper':shipper,'order':order,'power_user':keyword,'due_date':due_date},
             url:"<?php echo base_url().'front/vendor/assignedShipperOrdersAjax/' ?>",
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

   $('#assigned_pagination').on('click','a',function(e){
       e.preventDefault(); 
      var pageno = $(this).attr('data-ci-pagination-page');
       loadPagination(pageno);
     });

  function loadPagination(pageno){
    var shipper=$('#shipper').val();
    var order=$('#a_order').val();
    var pu=$('#a_power_user').val();
    var due_date=$('#a_due_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'shipper':shipper,'order':order,'power_user':pu,'due_date':due_date},
             url:"<?php echo base_url().'front/vendor/assignedShipperOrdersAjax/' ?>"+ pageno,
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
$('#shipper-form').on('submit', function () {
    var str = true;
         var listarray = new Array();
        $('input[name="order_id[]"]:checked').each(function () {
            listarray.push($(this).val());
        });   
        var checklist = "" + listarray;
        if (checklist == '') {
            str = false;
            alert('Please select orders to remove');
        }
    return str;
  });



  $('#unit-form').on('submit', function (e) {
    e.preventDefault();
       var str = true;
       var shipper=$('#select_shipper').val();
       $('#select_shipper').css('border','');
       if(shipper==''){
          str=false;
          $('#select_shipper').css('border','1px solid red');
       }else{
        $('#select_shipper').css('border','');
       }

        var listarray = new Array();
        $('input[name="na_order_id[]"]:checked').each(function () {
            listarray.push($(this).val());
        });   
        var checklist = "" + listarray;
        if(str==true){
        if (checklist != '') {
            $.ajax({
                dataType: 'json',
                type: 'post',
                data: {'shipper': shipper, 'orders': checklist},
                url: '<?php echo base_url(); ?>front/vendor/shipperOrdersUpdate/',
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
            alert('Please select orders to assign');
        }
      }
      return str;
    });
  $(".select2").select2();
  $(".temp").delay(2000).fadeOut("slow");
</script>

 </body>
</html>