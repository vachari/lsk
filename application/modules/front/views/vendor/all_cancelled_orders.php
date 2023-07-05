
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>:: Shoperative ::</title>
    <link href="<?php echo CSS_PATH;?>bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>main.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>menu.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"  href="<?php echo CSS_PATH;?>bliss-slider.css">
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
                         <li class=""> <a href="<?php echo base_url().'vendor/all-open-orders'; ?>">View All Open Orders</a></li>
                         <li class=""> <a href="<?php echo base_url().'vendor/all-dispatched_orders'; ?>">View All Dispatched Orders</a></li>
                         <li class=""> <a href="<?php echo base_url().'vendor/all-delivered-orders'; ?>">View All Closed Orders</a></li>
                         <li> <a href="<?php echo base_url().'vendor/assign-orders-to-shipper'; ?>">Assign Orders To Shipper</a></li>
                         <li> <a href="<?php echo base_url().'vendor/accounts-receivable'; ?>">Accounts Receivable</a></li>
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
                        <h4>All Cancelled Orders</h4>
                        <hr style="margin-top: -5px;"> 
                    </div>
                   
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <form method="post" action="<?php echo base_url().'vendor/search-open-orders' ?>">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input type="text" class="form-control" name="search_name" placeholder="City or Pin Code" value="<?php if(isset($search['search_name']) && $search['search_name']!=null) echo $search['search_name'] ?>">
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <select name="overdue" id="overdue" class="form-control">
                      <option value="">-Sort by Delivery Date-</option>
                      <option value="1"<?php if(isset($search['overdue']) && $search['overdue']!=null && $search['overdue']==1) echo "selected" ?>>ASC</option>
                      <option value="2"<?php if(isset($search['overdue']) && $search['overdue']!=null && $search['overdue']==2) echo "selected" ?>>DESC</option>
                    </select>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <select name="delivery_due_date" id="delivery_due_date" class="form-control">
                      <option value="">-Delivery Due Date-</option>
                      <option value="14"<?php if(isset($search['delivery_due_date']) && $search['delivery_due_date']!=null && $search['delivery_due_date']==14) echo "selected" ?>>Within Next 2 Weeks</option>
                      <option value="7"<?php if(isset($search['delivery_due_date']) && $search['delivery_due_date']!=null && $search['delivery_due_date']==7) echo "selected" ?>>Within Next 1 Week</option>
                      <option value="3"<?php if(isset($search['delivery_due_date']) && $search['delivery_due_date']!=null && $search['delivery_due_date']==3) echo "selected" ?>>In Next 3 Days</option>
                      <option value="1"<?php if(isset($search['delivery_due_date']) && $search['delivery_due_date']!=null && $search['delivery_due_date']==1) echo "selected" ?>>In Next 1 Day</option>
                      <option value="-1"<?php if(isset($search['delivery_due_date']) && $search['delivery_due_date']!=null && $search['delivery_due_date']== -1) echo "selected" ?>>Overdue</option>
                    </select>
                    
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input type="submit" name="search_btn" value="Search" id="search_btn" class="btn btn-sm btn-info">
                    <a href="<?php echo base_url().'vendor/all-open-orders' ?>" class="btn btn-sm btn-info">Refresh</a>
                  </div>
                  </form>
                  <div class="clearfix">&nbsp;</div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                  <!-- Orders table open -->
                  <table width="100%" class="table table-bordered table-hover table-striped">
                  <div class="pull-right mt-3 mr-3">
            <!-- 
                New Order - 1
                Approve - 2 
                Dispatch  - 3 
                Deliver - 4
                Cancel - 5 
            -->

           
      </div>
                    <thead>
                      <th><input type="checkbox" id="checkAll"></th>
                      <th>Sr No</th>
                      <th>Order #</th>
                      <th>Power User Name</th>
                      <th style="min-width: 110px">Order Date</th>
                      <th>Order Items</th>
                      <th>Order Qty</th>
                      <th>Total(&#8377;)</th>
                      <th style="min-width: 110px">Delivery Due Date</th>
                      <th>City</th>
                      <th>Pincode</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      
                    </thead>
                    <tbody>
                      
                        <?php  
                                $orders_list=json_decode($ordersdata);
                                   if($orders_list->code != 200 ){

                                    echo '<tr> <td colspan=13> <div class="alert alert-danger text-center">Orders not found</div></td></tr>';

                                   }else{
                                    $srno=$this->uri->segment(3,0);
                                    $i=$srno+1;
                                    foreach ($orders_list->result as $ol) {
                                     
                                ?>
                        <tr>
                        <td><input type="checkbox" name="multiple[]" class="checkSingle" value="<?php echo $ol->orderid; ?>"></td>
                        <td><?php echo  $i ?></td>
                        <td><a href="<?php echo base_url().'vendor/order-details/'.base64_encode($ol->orderid) ?>"><?php echo $ol->ordernumber ?></a></td>
                        <td><?php if($ol->power_user_id!=0){ $user_name=$this->Crud->checkAndReturn('user_name','ga_users_tbl',['user_id'=>$ol->power_user_id]); }else{$user_name=$ol->user_name;} echo ucwords($user_name); ?></td>
                        <td> <?php $orderDate = date("d-M-Y ", strtotime($ol->orderdate)); echo $orderDate; ?>
                        </td>
                        <td><?php echo  $ol->ordertotalitems; ?></td>
                        <td><?php echo  $ol->orderqty; ?></td>
                        <td> <?php echo  $ol->totalpayableprice; ?> </td>
                        <td> <?php $dueDate = date("d-M-Y ", strtotime($ol->delivery_due_date)); echo $dueDate;?></td>
                        <td> <?php echo $ol->city;?></td>
                        <td><?php echo $ol->pincode; ?></td>
                        <td><?php echo $ol->email;?></td>
                        <td><?php echo $ol->mobile;?></td>

                      </tr>
                      <?php $i++; }  }?>
                                 <tfoot>
                                        
                                         <?php if(!empty($links)){ ?>
                                        <tr>
                                         
                                          <td colspan="13" align="center">
                                            <div class="pagination_links">
                                              
                                                <?php echo $links; ?>
                                            </div>
                                          </td>
                                        </tr>
                                         <?php } ?>
                                 </tfoot>
                    </tbody>
                  </table>
                  <!-- Orders table close -->
                    <?php // print_r($orders) ?>

                </div>
              
            </div><!-- end of 9 col -->
            
        </div>

    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
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
 </body>
</html>
