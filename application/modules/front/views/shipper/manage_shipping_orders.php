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
    .input-box-pad {padding: 10px;}
    .info-box {background-color: #eee !important; margin-bottom: 10px; min-height: 100px;padding: 10px;}
    </style>     
</head><!--/head-->

<body class="popup">

    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
            <?php  $this->load->view('shipper/includes/header.php');?>
    </div>

    <section>
        <div class="container martop150">
            <div class="col-md-3 bg_profile ">
                <div class="col-xs-12 mrtop">
                     <ul class="profile-side-bar">
                        <li> <a href=" <?php echo base_url().'shipper/dashboard'; ?>"> Dashboard</a></li>
                         <li  > <a href="<?php echo base_url().'shipper/profile'; ?>"> My Profile</a></li>
                         <li> <a href="<?php echo base_url().'shipper/manage-shipping-cost'; ?>">Manage Shipping Cost</a></li>
                         <li class="active"> <a href="<?php echo base_url().'shipper/manage-shipping-orders'; ?>">Manage Shipping Orders</a></li>
                         <li> <a href=" <?php echo base_url() . 'shipper/change-password'; ?>"> Change Password   </a></li>
                         <li> <a href=" <?php echo base_url() . 'shipper/logout'; ?>"> Logout   </a></li>
                     </ul>
                </div>
                 <div style="height:300px" class="hidden-xs"></div>
                

            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                
                <div class="col-md-12">
                <?php
                    if($this->session->flashdata('success'))
                    {
                        echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                        }
                    if($this->session->flashdata('failed'))
                    { 
                        echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                     } ?>

                    <div class="header-title">
                        <h4>Manage Shipping Orders</h4>
                        <hr style="margin-top: -5px;"> 
                    </div>
                   
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                      <div class="col-md-2">
                        <a href="<?php echo base_url().'shipper/manage-shipping-orders'; ?>" class="btn btn-sm btn-info" style="margin-top: 20px">Refresh</a>
                      </div>
                </div>
                <div class="table-responsive col-md-12" style="float:left;width:100%;overflow-y: auto;height: 450px;">
                  <div class="text-success" id="success"><span id="successmessage"></span></div>
                  <div class="text-danger" id="fail"><span id="failmessage"></span></div>
                  <div class="clearfix">&nbsp;</div>
                  <!-- shipping cost table open -->
                  <table width="100%" class="table table-bordered table-hover table-striped" id="dataTables-assigned">
                   <thead>
                            <tr>
                                <th>
                                   <input type="checkbox" id="checkAll">
                                </th>
                                <th>Order #</th>
                                <th>Power User Name</th>
                                <th style="min-width: 110px">Delivery Due Date</th>
                                <th style="min-width: 110px">Expected Delivery By</th>
                                <th>Order Items</th>
                                <th>Order Qty</th>
                                <th>Total(&#8377;)</th>
                                <th>City</th>
                                <th>Pincode</th>
                                <th>Shipping Ref Number</th>
                                <th>Shipper Name</th>
                                <th>LR</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>
                      <?php $orders=json_decode($orders);
                          if($orders->code==200){
                            foreach ($orders->result as $order) { ?>
                                <tr class="">
                                    <td><input type="checkbox" class="inline-checkbox checkSingle" name="order_id[]" value="<?php echo $order->orderid ?>"></td>
                                    <td><a href="<?php echo base_url().'shipper/order-details/'.base64_encode($order->orderid); ?>"><?php echo $order->ordernumber ?></a></td>
                                    <td><?php echo ucwords($order->power_user_name); ?></td>
                                    <td> <?php echo date("d-M-Y ", strtotime($order->delivery_due_date)); ?></td>
                                    <td> <?php if(strtotime($order->expected_delivery_date) > 0) echo date("d-M-Y ", strtotime($order->expected_delivery_date)); else echo '--'; ?></td>
                                    <td> <?php echo $order->ordertotalitems; ?></td>
                                    <td> <?php echo $order->orderqty; ?></td>
                                    <td> <?php echo $order->totalpayableprice; ?></td>
                                    <td> <?php echo $order->city; ?></td>
                                    <td> <?php echo $order->pincode; ?></td>
                                    <td> <?php echo $order->shipping_ref_number; ?></td>
                                    <td> <?php echo $order->shipper_name; ?></td>
                                    <td> <?php echo $order->lr; ?></td>
                                    <td> <a href="<?php echo base_url().'shipper/edit-shipping-order/'.base64_encode($order->orderid); ?>" class="btn btn-xs btn-primary">Edit</a></td>
                                    
                                </tr>
                              <?php } }else{ ?>
                        <div class="text-center col-md-12">
                          <p style="color: red">Orders Not Available</p>
                        </div>
                      <?php } ?>
                                
                    </tbody>
                  </table>
                  <!-- shipping cost table close -->
                                    <div class="text-center">
                                      <p id="assigned_total_rows" class="text-success"></p>
                                      <p id="assigned_pagination"></p>
                                      <span class="assigned_pages"></span>
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
  $('#due_date,#a_due_date').datepicker();
  $(".select2").select2();
  $('#temp').delay(3000).fadeOut('slow');
</script>
<script type="text/javascript">
  // filters for assigned orders
  $('#a_order').on('keyup', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var pu=$('#a_power_user').val();
    var due_date=$('#a_due_date').val();
   
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'order':keyword,'power_user':pu,'due_date':due_date},
             url:"<?php echo base_url().'front/Shipper/assignedShipperOrdersAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-assigned > tbody').html(data.html);
              $('#assigned_total_rows').html(data.total_rows);
              $('#assigned_pagination').html(data.pagination);
              $('.assigned_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  } );
$('#a_due_date').on('change', function(e) {
    e.preventDefault();
    var due_date=$(this).val();
    var order=$('#a_order').val();
    var pu=$('#a_power_user').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'order':order,'power_user':pu,'due_date':due_date},
             url:"<?php echo base_url().'front/Shipper/assignedShipperOrdersAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-assigned > tbody').html(data.html);
              $('#assigned_total_rows').html(data.total_rows);
              $('#assigned_pagination').html(data.pagination);
              $('.assigned_pages').html('');
             },
              error:function(e){console.log(e);}
         });
  } );
$('#a_power_user').on('change', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    var order=$('#a_order').val();
    var due_date=$('#a_due_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'order':order,'power_user':keyword,'due_date':due_date},
             url:"<?php echo base_url().'front/Shipper/assignedShipperOrdersAjax/' ?>",
             success:function(data){
              console.log(data);
              $('#dataTables-assigned > tbody').html(data.html);
              $('#assigned_total_rows').html(data.total_rows);
              $('#assigned_pagination').html(data.pagination);
              $('.assigned_pages').html('');
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
    var order=$('#a_order').val();
    var pu=$('#a_power_user').val();
    var due_date=$('#a_due_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'order':order,'power_user':pu,'due_date':due_date},
             url:"<?php echo base_url().'front/Shipper/assignedShipperOrdersAjax/' ?>"+ pageno,
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
 </body>
</html>
