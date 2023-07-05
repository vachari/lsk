
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
                         <li class="active"> <a href="#">Product Wise Prices</a></li>
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
                        <h4>Manage Product Prices</h4>
                        <hr style="margin-top: -5px;"> 
                    </div>
                   
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <form method="post" action="<?php echo base_url().'vendor/search-product-wise-price' ?>">
                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                    <input type="text" class="form-control" name="search_name" placeholder="Search by Product Name/SPC/VPC" value="<?php if(isset($search['search_name']) && $search['search_name']!=null) echo $search['search_name'] ?>">
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input type="submit" name="search_btn" value="Search" id="search_btn" class="btn btn-sm btn-info">
                    <a href="<?php echo base_url().'vendor/product-wise-prices' ?>" class="btn btn-sm btn-info">Refresh</a>
                  </div>
                  </form>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            
                    <a href="#" class="btn btn-sm btn-success" onclick="updateActivationStatus('1')"> Active</a>
                    <a href="#" class="btn btn-sm btn-warning" onclick="updateActivationStatus('0')"> In-Active</a>
                    <a href="#" class="btn btn-sm btn-danger" onclick="commonDelete();"> Delete</a>

                  </div>
                  <div class="clearfix">&nbsp;</div>
                  <div class="clearfix">&nbsp;</div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                  <div class="text-success" id="success"><span id="successmessage"></span></div>
                  <div class="text-danger" id="fail"><span id="failmessage"></span></div>
                  <div class="clearfix">&nbsp;</div>
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>

                            <tr>
                                <th>
                                    <input type="checkbox" id="checkAll" >
                                </th>
                                <th>Sr No</th>
                                <th>Product Name</th>
                                <th><span title="Shoperative Product Code">SPC</span></th>
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
                                
                                   if($product_prices->code != 200 ){

                                    echo '<tr> <td colspan=15> <div class="alert alert-danger text-center">Data not found</div></td></tr>';

                                   }else{
                                    $srno=$this->uri->segment(3,0);
                                    $i=$srno+1;
                                    foreach ($product_prices->result as $row) {
                                     
                                ?>
                        <tr>
                        <td><input type="checkbox" name="multiple[]" class="checkSingle" value="<?php echo $row->id; ?>"></td>
                        <td><?php echo  $i ?></td>
                        <td><?php echo  $row->prod_name; ?></td>
                        <td><?php echo  $row->prod_code; ?></td>
                        <td><?php echo  $row->vendor_item_code; ?></td>
                        <td> <?php echo  $row->sku; ?> </td>
                        <td> <?php echo $row->unit; ?></td>
                        <td><?php echo $row->qty_range_from; ?></td>
                        <td><?php echo $row->qty_range_to; ?></td>
                        <td><?php echo $row->from_date; ?></td>
                        <td><?php echo $row->to_date; ?></td>
                        <td><?php echo $row->selling_price; ?></td>
                        <td><?php echo $row->buying_price; ?></td>
                        <td><?php if($row->status == 1) echo '<span class="text-success">Active</span>'; else echo '<span class="text-danger">In-Active</span>'; ?></td>
                        <td><a href="<?php echo base_url().'vendor/edit-product-price/'.base64_encode($row->id); ?>" class="btn btn btn-primary btn-xs">Edit</a></td>

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
   $('#fail').hide();
   $('#success').hide();
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
           
            $.ajax({
                dataType: 'json',
                type: 'post',
                data: {'tablename': 'productprice', 'updatelist': checklist, 'activity': s},
                url: '<?php echo base_url(); ?>front/Vendor/commonStatus/',
                success: function (u) {
                    console.log(u);
                    if(u.code=='200'){$('#success').show();$('#successmessage').html(u.description).addClass('alert alert-success');setTimeout(function() {window.location=location.href;},2000);}
    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');setTimeout(function() {window.location=location.href;},2000);}
                },
                error: function (er) {
                    console.log(er);
                }
            });
        } else {
            $('#fail').show();
            $('#failmessage').html('*  Please select a record').addClass('alert alert-warning');setTimeout(function() {window.location=location.href;},2000);
        }
    }
</script>

<script type="text/javascript">
    function commonDelete(){
    var listarray=new Array();
      $('input[name="multiple[]"]:checked').each(function(){listarray.push($(this).val());});
        var checklist=""+listarray;
        //alert(checklist);
      if(checklist!=''){
       var confirmation=confirm('Are you sure to delete selected records?');
        if(confirmation==true){
         $('#fail').hide();
         $.ajax({
          dataType:'json',
          type:'post',
          data:{'tablename':'productprice','updatelist':checklist},
          url:'<?php echo base_url();?>front/Vendor/commonDelete/',
          success:function(u){
           // console.log(u);
            if(u.code=='200'){$('#success').show();$('#successmessage').html(u.description).addClass('alert alert-success');setTimeout(function() {window.location=location.href;},2000);}
                    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');setTimeout(function() {window.location=location.href;},2000);}
                 },
          error:function(er){
            console.log(er);
          }
        });
       }
      }
      else{
       $('#fail').show();
            $('#failmessage').html('*  Please select a record').addClass('alert alert-warning');setTimeout(function() {window.location=location.href;},2000);
      }
    }
$('#temp').delay(3000).fadeOut('slow');
</script>
 </body>
</html>
