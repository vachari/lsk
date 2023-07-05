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
    <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>select2.min.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->  
    <style type="text/css">
    .text-danger {
    color: #ff0000 !important;
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
                         <li class="active"> <a href="<?php echo base_url().'vendor/assign-products-to-group'; ?>">Assign Products To Group</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-wise-prices'; ?>">Product Wise Prices</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-group-wise-prices'; ?>">Product Group Wise Prices</a></li>
                         <li> <a href="<?php echo base_url().'vendor/manage-shippers'; ?>">Manage Shippers</a></li>
                         <li> <a href="<?php echo base_url().'vendor/manage-shipping-cost'; ?>">Manage Shipping Cost</a></li>
                         <li> <a href="<?php echo base_url().'vendor/all-open-orders'; ?>">View All Open Orders</a></li>
                         <li class=""> <a href="<?php echo base_url().'vendor/all-dispatched_orders'; ?>">View All Dispatched Orders</a></li>
                         <li class=""> <a href="<?php echo base_url().'vendor/all-delivered-orders'; ?>">View All Closed Orders</a></li>
                          <li> <a href="<?php echo base_url().'vendor/assign-orders-to-shipper'; ?>">Assign Orders To Shipper</a></li>
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
                        <h4> Assign Products To Group <a href="<?php echo base_url().'vendor/assign-products-to-group'; ?>" class="btn btn-primary pull-right" title="Refresh"><i class="glyphicon glyphicon-refresh"></i></a></h4>
                        <hr> 
                    </div>
                   <!-- Assign products catelogue open here -->
<div class="col-md-12">
               
              <div class="form-group col-md-3" style="background-color: #ddd">
                        <label for="group">Select Group<span style="color: red"> *</span></label>
                        <select class="form-control selectpicker select2" name="select_group" id="select_group">
                          <option value="">--Select Group--</option>
                          <?php $groups= json_decode($groups);
                           if($groups!=null){
                            foreach ($groups as $row) { ?>
                              <option value="<?php echo $row->id ?>"<?php echo set_select('group',$row->id) ?>><?php echo $row->group_name.'('.$row->group_code.')' ?></option>  
                           <?php }
                          } ?>
                        </select>
              </div>
              
            </div>
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#non-assigned-products">Assign Products</a></li>
              <li><a data-toggle="tab" href="#assigned-products">Remove Assigned Products</a></li>
            </ul>
            <div class="tab-content">
            <div id="non-assigned-products" class="tab-pane fade in active">
              <?php
                        $attributes = array('name' => 'form', 'id' => 'unit-form', 'class' => '');
                        echo form_open('', $attributes);
                        ?>
                        <input type="hidden" name="group" id="group" value="">
                      <div class="form-group col-md-3" style="display: none">
                        <label for="group">Group<span style="color: red"> *</span></label>
                        
                      </div>
                      <div class="col-md-12">
                        <h4>Select from unassigned products below</h4>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="product"></label>
                        <input type="text" name="product" id="product" value="" class="form-control" placeholder="Search by Product Code/Name">
                      </div>
                      
                      <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-success" name="submit" style="margin-top: 20px">Assign Selected</button>
                        
                      </div>
                   <div class="table-responsive col-md-12" style="float:left;width:100%;overflow-y: auto;height: 350px;">
                    
                      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-non-assigned">
                        <thead>
                            <tr>
                                <th>
                                    <!-- <input type="checkbox" id="checkAll"> -->
                                </th>
                                <th> Product Code </th>
                                <th> Product Name</th>
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
                                    <td><img width="50px" src="<?php echo base_url(); ?>uploads/products/<?php echo $prod->prod_image; ?>"></td>
                                </tr>
                              <?php } }else{ ?>
                        <div class="text-center col-md-12">
                          <p style="color: red">No More Products To Assign</p>
                        </div>
                      <?php } ?>
                        </tbody>
                      </table>
                    
                       <div class="text-center">
                                      <p id="non_assigned_total_rows" class="text-success"><?php if($products !=null){
                                       if(count($products)==1) echo '1 Product Available'; 
                                      else echo count($products). ' Products Available'; } ?></p>
                                      <p id="non_assigned_pagination"></p>
                                    <span class="non_assigned_pages"></span>
                          </div>
                      </div>
                     <?php echo form_close(); ?>
                     
            </div>
            <div id="assigned-products" class="tab-pane fade">
              <!-- Assigned Product List -->
                 <?php
                        $attributes = array('name' => 'form', 'id' => 'group-form', 'class' => '');
                        echo form_open_multipart('front/vendor/multipleProductsRemoveFromGroup', $attributes);
                 ?>
                <div class="col-md-12">
                  <h4>Assigned products of the selected group</h4>
                 <div class="row"> 
                  <div class="form-group col-md-4">
                        <label for="a_product"></label><br>
                        <input type="text" name="product" id="a_product" value="" class="form-control" placeholder="Search by Product Code/Name">
                      </div>
                      <div class="form-group col-md-3">
                      <br>
                        <input type="hidden" name="id" id="groupid" value="">
                        <?php echo form_submit('submit', 'Remove Selected', array('class' => 'btn btn-danger btn-remove', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
                      </div>
                      </div>
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-assigned">
                        <thead>
                            <tr>
                                <th>
                                    <!-- <input type="checkbox" id="checkAll"> -->
                                </th>
                                <th> Product Code </th>
                                <th> Product Name</th>
                                <th> Image</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
                      </table>
                      <div class="row">
                      <div class="form-group col-md-3">
                        <?php echo form_submit('submit', 'Remove Selected', array('class' => 'btn btn-danger btn-remove', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
                      </div>
                      </div>
                      <div class="text-center">
                                      <p id="assigned_total_rows" class="text-success"></p>
                                      <p id="assigned_pagination"></p>
                                    <span class="assigned_pages"></span>
                          </div>
                </div>
                 <?php echo form_close(); ?>
                               
                   <!-- Assign products catelogue close here -->
            </div>
          </div>

                        
                
                </div>
            </div><!-- end of 9 col -->
            
        </div>

    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
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
  $('#displaymsg').html('<div class="alert alert-success alert-dismissible text-center">Please select Group to assign products.<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
    $('#select_group').on('change',function(e){
      e.preventDefault();
      var keyword=$(this).val();
      $('#group').val(keyword);
      $('#groupid').val(keyword);
      var product=$('#a_product').val();
if(keyword){
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'group':keyword,'product':product},
             url:"<?php echo base_url().'front/vendor/assignedGroupProductsAjax/' ?>",
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
});
// filters for non-assigned products
$('#product').on('keyup', function(e) {
    e.preventDefault();
    var keyword=$(this).val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'product':keyword},
             url:"<?php echo base_url().'front/vendor/assignProductsToGroupAjax/' ?>",
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
    var product=$('#product').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'product':product},
             url:"<?php echo base_url().'front/vendor/assignProductsToGroupAjax/' ?>"+ pageno,
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
    var groupid=$('#groupid').val();
    if(groupid){
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'group':group,'product':keyword},
             url:"<?php echo base_url().'front/vendor/assignedGroupProductsAjax/' ?>",
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
    var group=$('#group').val();
    var product=$('#a_product').val();
    $.ajax({
             dataType:'JSON',
             method:'POST',
             data:{'group':group,'product':product},
             url:"<?php echo base_url().'front/vendor/assignedGroupProductsAjax/' ?>"+ pageno,
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
                url: '<?php echo base_url(); ?>front/vendor/groupProductsUpdate/',
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
  $(".select2").select2();
  $(".temp").delay(2000).fadeOut("slow");
</script>

 </body>
</html>