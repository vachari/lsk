
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
                         <li class="active"> <a href="<?php echo base_url().'vendor/products'; ?>">Create/Manage Products</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-inventory'; ?>">Product Inventory/Availability</a></li>
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
                        <h4>Products</h4>
                        <hr style="margin-top: -5px;"> 
                    </div>
                   
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <form method="post" action="<?php echo base_url().'vendor/search-products' ?>">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input type="text" class="form-control" name="search_name" id="search_name" placeholder="SPC/VPC/Prod Name" value="<?php if(isset($search['search_name']) && $search['search_name']!=null) echo $search['search_name'] ?>">
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
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
                    <select class="form-control" name="category" id="category"> 
                        <option value=""> Select Category</option>
                        <?php if($categories->code==200){
                          foreach ($categories->result as $cat) {
                        ?>
                        <option value="<?php echo $cat->menu_id;?>" <?php if(isset($search['search_category']) && $search['search_category']!=null && $search['search_category']==$cat->menu_id) echo 'selected'; ?>><?php echo $cat->menu_title; ?></option>    
                        
                       <?php } } ?>

                    </select> 
                  </div>
                  
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input type="submit" name="search_btn" value="Search" id="search_btn" class="btn btn-sm btn-info">
                    <a href="<?php echo base_url().'vendor/products' ?>" class="btn btn-sm btn-info">Refresh</a>
                  </div>
                  </form>
                  <div class="clearfix">&nbsp;</div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="text-success" id="success"><span id="successmessage"></span></div>
                  <div class="text-danger" id="fail"><span id="failmessage"></span></div>
                  <div class="pull-right">
                    <a href="<?php echo base_url().'vendor/add-product' ?>" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>&nbsp; Add New Product</a>
                   <!--  <a href="<?php echo base_url().'vendor/add-bulk-products' ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp; Add Bulk Products</a> -->
                    <button  class="btn btn-success   btn-sm" onclick="updateActivationStatus('1')"> Active </button>
                  <button  class="btn btn-warning   btn-sm"  onclick="updateActivationStatus('0')">In-Active </button> 
                  <button  class="btn btn-success   btn-sm" title="Add to Feature Products" onclick="addFeature('1')"><i class="glyphicon glyphicon-plus"></i>&nbsp; FP </button>
            <button  class="btn btn-danger btn-sm" title="Remove from Feature Products"  onclick="addFeature('0')"><i class="glyphicon glyphicon-trash"  ></i>&nbsp; FP   </button> 
                 <button  class="btn btn-danger  btn-sm" onclick="commonDelete();"><i class="glyphicon glyphicon-trash"  ></i>&nbsp; Delete </button>
                  </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                  <!-- Orders table open -->
                  <table width="100%" class="table table-bordered table-hover table-striped">
                    <thead>
                      <th><input type="checkbox" id="checkAll"></th>
                        <th>Sr No</th>
                                 <th> <span title="Shoperative Product Code"> SPC</span></th>
                                <th><span title="Vendor Product Code"> VPC</span></th>
                                 <th> Product Name </th>
                                <th> <span title="Stock Keeping Unit"> SKU</span></th>
                                <th> <span title="Unit of measure">UOM</span></th>
                                 <th>  Group </th>
                                  <th>  Category </th>
                                  <th> Sub Category</th>
                                  <th> Sub-sub Category</th>
                                 <th>HSN Code</th>
                                 <th>Shelf Life</th>
                                 <th>  Image</th>
                                <th> Status</th>
                                <th> <span title="Feature Product">FP</span></th>
                                <th>Action</th>

                      
                    </thead>
                    <tbody>
                      
                        <?php
                                   if($products->code != 200 ){

                                    echo '<tr> <td colspan=17> <div class="alert alert-danger text-center">Products not found</div></td></tr>';

                                   }else{
                                    $srno=$this->uri->segment(3,0);
                                    $i=$srno+1;
                                    foreach ($products->result as $product) {
                                     
                                ?>
                        <tr>
                        <td><input type="checkbox" name="multiple[]" class="checkSingle" value="<?php echo $product->id; ?>"></td>
                        <td><?php echo  $i ?></td>
                        <td><?php echo $product->prod_code; ?></td>
                        <td><?php echo $product->vendor_item_code; ?></td>
                        <td><?php echo $product->prod_name; ?></td>
                        <td><?php echo  $product->sku; ?></td>
                        <td><?php echo  $product->unit; ?></td>
                        <td> <?php if($product->prod_group !=null && $product->prod_group_code !=null) echo $product->prod_group.'('.$product->prod_group_code.')'; else echo '--'; ?> </td>
                        <td> <?php echo $product->cat_title; ?></td>
                        <td> <?php echo $product->subcat_title; ?></td>
                        <td><?php if($product->listsubcat_title!=null) echo $product->listsubcat_title; else echo '--'; ?></td>
                        <td><?php echo $product->hsn_code; ?></td>
                        <td><?php echo $product->shelf_life_no.' '.$product->shelf_life_unit; ?></td>
                        <td><img width="50px" src="<?php echo base_url(); ?>uploads/products/<?php echo $product->prod_image; ?>"></td>
                                        <td class="text-success"><b> <?php if ($product->active_status == 1) {
                                                    echo "<b style='color:green'>Active</b>";
                                                } elseif($product->active_status == 0) {
                                                    echo "<b style='color:red'>In-Active</b>";
                                                } ?>   </b>
                                        </td>
                                         <td class="text-success text-center"><b> <?php if ($product->feature_product == 1) {
                                                    echo "<b style='color:green'><i class='glyphicon glyphicon-ok'></i></b>";
                                                } elseif($product->feature_product == 0) {
                                                    echo "<b style='color:red'><i class='glyphicon glyphicon-remove'></i></b>";
                                                } ?>   </b>
                                        </td>
                        <td><a href="<?php echo base_url(); ?>vendor/edit-product/<?php echo base64_encode($product->id); ?>" class="btn btn-xs btn-primary" title="Edit Product Details"> Edit</a></td>

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
  $('#group').change(function(){
    $('#search_btn').click();
  });
  $('#category').change(function(){
    $('#search_btn').click();
  });
   $('#search_btn').click(function(){
    var group = $('#group').val();
    var category = $('#category').val();
    var search = $('#search_name').val();
    $('#search_name').css('border','');
    if(group =='' && category=='' && search==''){
      $('#search_name').css('border','1px solid red');
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
                data: {'tablename': 'product', 'updatelist': checklist, 'activity': s},
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
    function addFeature(s) {
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
                data: {'tablename': 'feature', 'updatelist': checklist, 'activity': s},
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
          data:{'tablename':'product','updatelist':checklist},
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
