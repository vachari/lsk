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
                         <li> <a href="<?php echo base_url().'vendor/assign-orders-to-shipper'; ?>">Assign Orders To Shipper</a></li>
                         <li class="active"> <a href="<?php echo base_url().'vendor/accounts-receivable'; ?>">Accounts Receivable</a></li>
                         <li > <a href=" <?php echo base_url() . 'vendor/change-password'; ?>"> Change Password   </a></li>
                         <li> <a href=" <?php echo base_url() . 'vendor/logout'; ?>"> Logout   </a></li>
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
                        <h4>Accounts Receivable</h4>
                        <hr style="margin-top: -5px;"> 
                    </div>
                   
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <input type="text" class="form-control" name="search_name" id="search_name" placeholder="Search by Order/City/Pin Code" value="">
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <select class="form-control selectpicker select2" name="power_user" id="power_user">
                          <option value="">Sort by Power User</option>
                          <?php $power_users= json_decode($power_users);
                           if($power_users->code==200){
                            foreach ($power_users->result as $row) { ?>
                              <option value="<?php echo $row->user_id ?>"><?php echo $row->user_name; ?></option>  
                           <?php }
                          } ?>
                        </select>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <label for="delivery_date"></label>
                        <input type="text" name="delivery_date" id="delivery_date" value="" placeholder=" Sort By Delivery Date" id="delivery_date">
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <a href="<?php echo base_url().'vendor/accounts-receivable' ?>" class="btn btn-sm btn-info">Refresh</a>
                  </div>
                  <div class="clearfix">&nbsp;</div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                  <!-- Payments table open -->
                  <table width="100%" class="table table-bordered table-hover table-striped" id="dataTables-payments">
                    <thead>
                      <th>Order #</th>
                      <th>Power User Name</th>
                      <th>Total Value of Delivery(&#8377;)</th>
                      <th>Collected Amount(&#8377;)</th>
                      <th>Due Amount(&#8377;)</th>
                      <th>Due Days</th>
                      <th style="min-width: 110px">Delivery Date</th>
                      <th>City</th>
                      <th>Pincode</th>
                    </thead>
                    <tbody>
                      
                        <?php  
                                $payments=json_decode($payments);
                                   if($payments->code != 200 ){

                                    echo '<tr> <td colspan=10> <div class="alert alert-danger text-center">Payments not found</div></td></tr>';

                                   }else{
                                    // $srno=$this->uri->segment(3,0);
                                    // $i=$srno+1;
                                    foreach ($payments->result as $ol) {
                                     
                                ?>
                        <tr>
                        <td><?php echo $ol->order_number ?></td>
                        <td><?php echo $ol->power_user_name ?></td>
                        <td> <?php echo  $ol->total_value_of_delivery; ?> </td>
                        <td> <?php echo  $ol->collected_amount; ?> </td>
                        <td> <?php echo  $ol->due_amount; ?> </td>
                        <td> <?php echo  $ol->due_days; ?> </td>
                        <td> <?php if(strtotime($ol->delivery_date) > 0) echo date('d-M-Y',strtotime($ol->delivery_date));?></td>
                        <td> <?php echo $ol->city;?></td>
                        <td><?php echo $ol->pincode; ?></td>
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
                  <!-- payments table close -->

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
    var pu = $('#power_user').val();
    var delivery_date=$('#delivery_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'search_name':keyword,'power_user':pu,'delivery_date':delivery_date},
             url:"<?php echo base_url().'front/vendor/accountsReceivableAjax/' ?>",
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
    var pu=$('#power_user').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'search_name':search_name,'power_user':pu,'delivery_date':delivery_date},
             url:"<?php echo base_url().'front/vendor/accountsReceivableAjax/' ?>",
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
    var search_name = $('#search_name').val();
    var delivery_date=$('#delivery_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'search_name':search_name,'power_user':keyword,'delivery_date':delivery_date},
             url:"<?php echo base_url().'front/vendor/accountsReceivableAjax/' ?>",
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
    var pu=$('#power_user').val();
    var delivery_date=$('#delivery_date').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'search_name':search_name,'power_user':pu,'delivery_date':delivery_date},
             url:"<?php echo base_url().'front/vendor/accountsReceivableAjax/' ?>"+ pageno,
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
</script>
 </body>
</html>
