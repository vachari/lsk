
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
                         <li class="active"> <a href="<?php echo base_url().'vendor/product-inventory'; ?>">Product Inventory/Availability</a></li>
                         <li> <a href="<?php echo base_url().'vendor/assign-products-to-group'; ?>">Assign Products To Group</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-wise-prices'; ?>">Product Wise Prices</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-group-wise-prices'; ?>">Product Group Wise Prices</a></li>
                         <li> <a href="<?php echo base_url().'vendor/manage-shippers'; ?>">Manage Shippers</a></li>
                         <li> <a href="<?php echo base_url().'vendor/manage-shipping-cost'; ?>">Manage Shipping Cost</a></li>
                         <li> <a href="<?php echo base_url().'vendor/all-open-orders'; ?>">View All Open Orders</a></li>
                         <li class=""> <a href="<?php echo base_url().'vendor/all-confirmed-orders'; ?>">View All Confirmed Orders</a></li>
                         <li class=""> <a href="<?php echo base_url().'vendor/all-dispatched_orders'; ?>">View All Dispatched Orders</a></li>
                         <li class=""> <a href="<?php echo base_url().'vendor/all-cancelled_orders'; ?>">View All Cancelled Orders</a></li>
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
                        <h4>Product Inventory/Availability</h4>
                        <hr style="margin-top: -5px;">
                    </div>
                   
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <form method="post" action="<?php echo base_url().'vendor/search-product-inventory' ?>">
                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                    <input type="text" class="form-control" name="search_name" id="search_name" placeholder="Search by SPC/VPC/Product Name" value="<?php if(isset($search['search_name']) && $search['search_name']!=null) echo $search['search_name'] ?>">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <select class="form-control" name="group" id="group"> 
                        <option value=""> Select Group</option>
                        <?php if($groups->code==200){
                          foreach ($groups->result as $group) {
                        ?>
                        <option value="<?php echo $group->id;?>" <?php if(isset($search['search_group']) && $search['search_group']!=null && $search['search_group']==$group->id) echo 'selected'; ?>><?php echo $group->group_name.'('.$group->group_code.')'; ?></option>    
                        
                       <?php } } ?>

                    </select> 
                  </div>
                  
                  
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input type="submit" name="search_btn" value="Search" id="search_btn" class="btn btn-sm btn-info">
                    <a href="<?php echo base_url().'vendor/product-inventory' ?>" class="btn btn-sm btn-info">Refresh</a>
                  </div>
                  </form>
                  <div class="clearfix">&nbsp;</div>
                </div>
                
                <div class="clearfix">&nbsp;</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                  <!-- Orders table open -->
                  <table width="100%" class="table table-bordered table-hover table-striped">
                    <thead>
                        <th>Sr No</th>
                                 <th> <span title="Shoperative Product Code"> SPC</span></th>
                                <th><span title="Vendor Product Code"> VPC</span></th>
                                 <th style="min-width: 140px"> Product Name </th>
                                <th> <span title="Stock Keeping Unit"> SKU</span></th>
                                <th> <span title="Unit of measure">UOM</span></th>
                                 <th>  Group </th>
                                  <th style="min-width: 110px">  Stock </th>
                                  <th style="min-width: 140px"> Last Updated On</th>
                                 <th>  Image</th>
                                <th> Status</th>
                      
                    </thead>
                    <tbody>
                      
                        <?php
                                   if($products->code != 200 ){

                                    echo '<tr> <td colspan=15> <div class="alert alert-danger text-center">Products not found</div></td></tr>';

                                   }else{
                                    $srno=$this->uri->segment(3,0);
                                    $i=$srno+1;
                                    foreach ($products->result as $product) {
                                     
                                ?>
                        <tr>
                        <td><?php echo  $i ?></td>
                        <td><?php echo $product->prod_code; ?></td>
                        <td><?php echo $product->vendor_item_code; ?></td>
                        <td><?php echo $product->prod_name; ?></td>
                        <td><?php echo  $product->sku; ?></td>
                        <td><?php echo  $product->unit; ?></td>
                        <td> <?php if($product->prod_group !=null && $product->prod_group_code !=null) echo $product->prod_group.'('.$product->prod_group_code.')'; else echo '--'; ?> </td>
                        <td><input type="text-center" name="stock[]" id="stock_<?php echo $product->id; ?>" value="<?php echo $product->stock; ?>" class="number_class form-control" size="20" onkeyup="updatestock(this.value,<?php echo $product->id; ?>)"></td>
                                         <td><?php if(strtotime($product->last_modified_stock) > 0) echo date('d-M-Y h:i:s A', strtotime($product->last_modified_stock)); else echo '--'; ?></td>
                        <td><img width="50px" src="<?php echo base_url(); ?>uploads/products/<?php echo $product->prod_image; ?>"></td>
                                        <td class="text-success"><b> <?php if ($product->active_status == 1) {
                                                    echo "<b style='color:green'>Active</b>";
                                                } elseif($product->active_status == 0) {
                                                    echo "<b style='color:red'>In-Active</b>";
                                                } ?>   </b>
                                        </td>
                      </tr>
                      <?php $i++; }  }?>
                                 <tfoot>
                                        
                                         <?php if(!empty($links)){ ?>
                                        <tr>
                                         
                                          <td colspan="15" align="center">
                                            <div class="pagination_links">
                                              
                                                <?php echo $links; ?>
                                            </div>
                                          </td>
                                        </tr>
                                         <?php } ?>
                                 </tfoot>
                    </tbody>
                  </table>


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
  $('#group').change(function(){
    $('#search_btn').click();
  });
   $('#search_btn').click(function(){
    var group = $('#group').val();
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
            url:'<?php echo base_url();?>front/vendor/updatestock/',
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
 </body>
</html>
