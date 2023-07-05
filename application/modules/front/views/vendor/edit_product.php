<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>:: Shoperative | Edit Product ::</title>
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
    .text-danger,.text-red {
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
                    <div class="header-title">
                        <h4> Edit Product </h4>
                        <hr style="margin-top: -5px;"> 
                    </div>
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
                   
                    <!-- form start -->
                        <?php
                            $form_attributes = array('id' => 'insertproduct', 'name' => 'insertproduct');
                            echo form_open('', $form_attributes);
                         ?>
                <input type="hidden" value="<?php echo $product_details->id;?>" id='id' name='pro_id'/>
                <input type="hidden" value="<?php echo $product_details->vendor_id;?>" id='vendor_id' name='vendor'/>

                <input type="hidden" value="<?php echo $product_details->prod_image;?>" id='img1' name='img1'/>
                <input type="hidden" value="<?php echo $product_details->other_image;?>" id='img2' name='img2'/>
                    <div class="col-md-4">
                        <div class="form-group">
                        <?php     $data1 = array(
                            'name' => 'product_code',
                            'id' => 'product_code',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Shoperative Product Code',
                            'value'=>$product_details->prod_code
                            
                        );
                        echo form_label('Shoperative Product Code', 'Shoperative Product Code'). "<span style='color:red' id='prod_code_err';> *</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="prod_code_err"></span>
                        <?php
                       
                        ?>
                            </div>
                        </div>
             <div class="col-md-4">
                            <div class="form-group">
                        <?php     $data1 = array(
                            'name' => 'vendor_item_code',
                            'id' => 'vendor_item_code',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Vendor Product Code',
                            'value'=>$product_details->vendor_item_code
                        );
                        echo form_label('Vendor Product Code', 'Vendor Product Code'). "<span style='color:red' id='vendor_item_code_err';> *</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="vendor_item_code_err"></span>
                        <?php
                       
                        ?>
                            </div>
                        </div>   
                            
                        <div class="col-md-4">
                            <div class="form-group">
                            <?php  $data2 = array(
                            'name' => 'product_title',
                            'id' => 'product_title',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Product Name',
                            'value'=>$product_details->prod_name
                        );
                        echo form_label(' Product Title', ' Product Title')."<span style='color:red' id='prod_title_err'> *</span>";
                        echo form_input($data2);
                        ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                             <?php $data3 = array(
                            'name' => 'sku_qty',
                            'id' => 'sku_qty',
                            'type' => 'number',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'SKU Qty',
                            'value'=>$product_details->sku
                            
                        );
                        echo form_label('SKU Qty', 'SKU Qty') . "<span style='color:red' id='prod_skuqty_err'> *</span>";
                        echo form_input($data3);
                        ?>
                        <span class="err_class" id="prod_skuqty_err"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <?php echo form_label('Unit Of Measure', 'Unit Of Measure');
               
                            ?>
                            <span style="color:red; " id="unit_err"> *</span> 
                            <select name="unit_id" id="unit_id" class="form-control "> 
                                <option value="">Choose Unit </option>
                                <?php
                                if ($units->code == SUCCESS_CODE) {
                                    foreach ($units->result as $units_response) {
                                        ?>
                                        <option value="<?php echo $units_response->id; ?>" <?php if($units_response->id==$product_details->unit) echo "selected" ?>><?php echo $units_response->unit_code; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="err_class" id="unit_err"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <?php echo form_label('Product Group', 'Product Group');
                            ?>
                            <span style="color:red;" id="group_err"> </span> 
                            <select name="group_id" id="group_id" class="form-control ">
                                <option value="">Choose Group </option>
                                <?php
                                if ($groups->code == SUCCESS_CODE) {
                                    foreach ($groups->result as $group_response) {
                                        ?>
                                        <option value="<?php echo $group_response->id; ?>" <?php if($group_response->id==$product_details->prod_group) echo "selected"; ?>><?php echo $group_response->group_name.'('.$group_response->group_code.')'; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="err_class" id="group_err"></span>
                </div>
            </div>
            <div class="col-md-4">
                            <div class="form-group" >
                              <?php echo form_label('Category', 'Category'); ?>
                            <span style="color:red;" id="menu_err"> *</span> 
                            <select name="menu_id" id="menu_id" class="form-control ">
                                <option value="">Choose Category </option>
                                <?php
                                if($categories->code==200){
                                    foreach ($categories->result  as $catrow) {
                                        ?>
                                        <option value="<?php echo $catrow->menu_id; ?>" <?php if($catrow->menu_id== $product_details->category){ echo "selected";} ?> >
                                        <?php echo $catrow->menu_title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="err_class" id="menu_err"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                             <?php echo form_label('Sub Category', 'Sub Category');?>
                            <span style="color:red;" id="submenu_err"> *</span> 
                            <select name="submenu_id" id="submenu_id" class="form-control ">
                                <option value="">--Sub Category--</option>
                                <?php
                                if($sub_categories->code==200){
                                    foreach ($sub_categories->result as $subrow) {
                                        ?>
                                       
                                        <option value="<?php echo $subrow->submenu_id; ?>" <?php if($subrow->submenu_id == $product_details->sub_category){ echo "selected";} ?> ><?php echo $subrow->submenu_title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="err_class" id="submenu_err"></span>
                             </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <?php echo form_label('List-Sub Category', 'Listsub Category'); ?>
                            <span style="color:red;" id="listsubmenu_err"> *</span> 
                            <select name="listsubmenu" id="listsubmenu" class="form-control ">
                                <option value="">--Listsub Category--</option>
                                <?php
                               if($listsub_categories->code==200){
                                    foreach ($listsub_categories->result as $listrow) {
                                        ?>
                                        <option value="<?php echo $listrow->listsubmenu_id; ?>" <?php if($listrow->listsubmenu_id == $product_details->listsubmenu_id) echo "selected" ?> ><?php echo $listrow->listsubmenu_title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="err_class" id="listsubmenu_err"></span>
                            </div>
                        </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4">
                            <div class="form-group">
                              <?php echo form_label('Image (250 X 150)', 'IMAGE'); ?>
                            <span style="color:red;" id="prod_img_err"> </span> 

                            <?php
                            $upload1 = array(
                                'name' => 'image',
                                'id' => 'image',
                                'class' => 'form-control',
                            );

                            echo form_upload($upload1);
                            ?>
                            <span class="err_class" id="prod_img_err"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div style="border: 1px solid #ddd; min-height: 80px">
                                <img src="<?php echo base_url(); ?>uploads/products/<?php echo $product_details->prod_image; ?>" width="100" height="80" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                             <?php echo form_label('App Image (250 X 150)', 'IMAGE (250 X 150)'); ?>
                            <span style="color:red;"> </span> 

                            <?php
                            $upload1 = array(
                                'name' => 'alt_image',
                                'id' => 'alt_image',
                                'class' => 'form-control',
                                'value' =>$product_details->prod_image
                            );

                            echo form_upload($upload1);
                            ?>
                            <span class="err_class" id="prod_alt_img_err"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div style="border: 1px solid #ddd; min-height: 80px">
                                <img src="<?php echo base_url(); ?>uploads/products/<?php echo $product_details->other_image; ?>" width="100" height="80" alt="Product App Image">
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="col-md-4">
                            <div class="form-group">
                             <?php $data3 = array(
                            'name' => 'hsn_code',
                            'id' => 'hsn_code',
                            'type'=>'text',
                            'maxlength' => '30',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'HSN Code',
                            'value' =>$product_details->hsn_code
                        );
                        echo form_label('HSN Code', 'hsn_code') . "<span style='color:red' id='hsn_code_err'> *</span>";
                        echo form_input($data3);
                        ?>
                        <span class="err_class" id="hsn_code_err"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                             <?php $data3 = array(
                            'name' => 'shelf_life_no',
                            'id' => 'shelf_life_no',
                            'type'=>'text',
                            'maxlength' => '3',
                            'autocomplete' => 'off',
                            'class' => 'form-control number_class',
                            'placeholder' => 'Shelf Life Number',
                            'value' =>$product_details->shelf_life_no
                        );
                        echo form_label('Shelf Life Number', 'shelf_life_no') . "<span style='color:red' id='shelf_life_no_err'> *</span>";
                        echo form_input($data3);
                        ?>
                        <span class="err_class" id="shelf_life_no_err"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <?php echo form_label('Shelf Life Unit', 'shelf_life_unit'); ?>
                            <span style="color:red;" id="shelf_life_unit_err"> * </span> 
                            <select name="shelf_life_unit" id="shelf_life_unit" class="form-control">
                                <option value="">--Select Unit-- </option>
                                <option value="Days" <?php echo set_select('shelf_life_unit','Days'); if($product_details->shelf_life_unit=='Days') echo 'selected' ?>>Days</option>
                                <option value="Weeks" <?php echo set_select('shelf_life_unit','Weeks'); if($product_details->shelf_life_unit=='Weeks') echo 'selected' ?>>Weeks</option>
                                <option value="Months" <?php echo set_select('shelf_life_unit','Months'); if($product_details->shelf_life_unit=='Months') echo 'selected' ?>>Months</option>
                                <option value="Years" <?php echo set_select('shelf_life_unit','Years'); if($product_details->shelf_life_unit=='Years') echo 'selected' ?>>Years</option>
                            </select>
                            <span class="err_class" id="shelf_life_unit_err"></span>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <?php
                        echo "<div class='form-group col-md-12'> ";
                        $data1 = array(
                            'name' => 'product_description',
                            'id' => 'product_description',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'rows' =>4,
                            'style' => 'resize:none',
                            'placeholder' => 'Product Description',
                            'value'=>$product_details->prod_desc
                            
                        );
                        echo form_label('Product Description', 'Product Description'); ?>
                         <span style="color:red;" id="prod_desc_err"></span>
                       <?php echo form_textarea($data1); ?>
                        
                        <span class="err_class" id="prod_desc_err"></span>
                        <?php
                        echo "</div>";
                        ?></div>
                        </div>
                        </div>
                        <div class="box-footer pull-right">
                        <p class="success_msg"></p>
                        <a href="<?php echo base_url().'vendor/products'; ?>" class="btn btn-danger">Cancel</a>
                            <?php echo form_submit('submit', 'Update', array('class' => 'btn btn-success', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
                        </div>
                         </div>
                        
                        <?php echo form_close(); ?>
                    </div>
                </div><!-- end of 9 col -->
            </div><!-- end of container -->

    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
 <script type="text/javascript">
           $('#insertproduct').on('submit', function (i) {
                i.preventDefault();
                var str = true;
                $('#prod_desc_err,#submenu_err,#menu_err,#listsubmenu_err,#prod_code_err,#prod_title_err,#prod_skuqty_err,#prod_img_err,#unit_err,#group_err,#vendor_item_code_err,#hsn_code_err,#shelf_life_no_err,#shelf_life_unit_err').html('');
                $('#menu_id,#submenu_id,#listsubmenu,#product_code,#product_title,#product_description,#sku_qty,#image,#seller,#group_id,#unit_id,#vendor_item_code,#hsn_code,#shelf_life_no,#shelf_life_unit').css('border', '');
                var menu = $('#menu_id').val();
                var submenu = $('#submenu_id').val();
                var listsubmenu = $('#listsubmenu').val();
                var prodcode = $('#product_code').val();
                var prodtitle = $('#product_title').val();
                var proddesc = $('#product_description').val();
                var prodskuqty = $('#sku_qty').val();
                var image = $('#image').val();
                var unit=$('#unit_id').val();
                var group=$('#group_id').val();
                var vendor_item_code = $("#vendor_item_code").val();
                var hsn = $("#hsn_code").val();
                var shelf_life_no = $("#shelf_life_no").val();
                var shelf_life_unit = $("#shelf_life_unit").val();

                if (vendor_item_code == '') {
                    $('#vendor_item_code_err').html(' Required');
                    $('#vendor_item_code').css('border', '1px solid red');
                    str = false;
                }               
                if (unit == '') {
                    $('#unit_err').html('Please select unit');
                    $('#unit_id').css('border', '1px solid red');
                    str = false;
                }
                // if (group == '') {
                //     $('#group_err').html('Please select group');
                //     $('#group_id').css('border', '1px solid red');
                //     str = false;
                // }
                if (menu == '') {
                    $('#menu_err').html('Please select Category');
                    $('#menu_id').css('border', '1px solid red');
                    str = false;
                }
                // if (listsubmenu == '') {
                //     $('#listsubmenu_err').html('Please select List Sub Category');
                //     $('#listsubmenu').css('border', '1px solid red');
                //     str = false;
                // }
                if (submenu == '') {
                    $('#submenu_err').html('Please select sub category');
                    $('#submenu_id').css('border', '1px solid red');
                    str = false;
                }
                if (prodcode == '') {
                    $('#prod_code_err').html(' Required');
                    $('#product_code').css('border', '1px solid red');
                    str = false;
                }
                if (prodtitle == '') {
                    $('#prod_title_err').html(' Required');
                    $('#product_title').css('border', '1px solid red');
                    str = false;
                }
                if (proddesc == '') {
                    $('#prod_desc_err').html(' Required');
                    $('#product_description').css('border', '1px solid red');
                    str = false;
                }

                if (prodskuqty == '') {
                    $('#prod_skuqty_err').html(' Required');
                    $('#sku_qty').css('border', '1px solid red');
                    str = false;
                }
                if (hsn == '') {
                    $('#hsn_code_err').html(' Required');
                    $('#hsn_code').css('border', '1px solid red');
                    str = false;
                }
                if (shelf_life_no == '') {
                    $('#shelf_life_no_err').html(' Required');
                    $('#shelf_life_no').css('border', '1px solid red');
                    str = false;
                }
                if (shelf_life_no != '' && shelf_life_no<=0) {
                    $('#shelf_life_no_err').html(' Invalid');
                    $('#shelf_life_no').css('border', '1px solid red');
                    str = false;
                }
                if (shelf_life_unit == '') {
                    $('#shelf_life_unit_err').html(' Required');
                    $('#shelf_life_unit').css('border', '1px solid red');
                    str = false;
                }
               
                // if (image == '')
                // {
                //     $('#image').css('border', '1px solid red');
                //     $('#prod_img_err').text('Please upload product image');
                //     str = false;
                // }
                if (image != '')
                {
                    var ext = image.match(/\.(.+)$/)[1];
                    validformat = '';
                    switch (ext)
                    {
                        case 'jpg':
                        case 'jpeg':
                        case 'png':
                        case 'gif':
                        case 'JPG':
                        case 'JPEG':
                        case 'PNG':
                        case 'GIF':
                            validformat = true;
                            break;
                        default:
                            validformat = false;
                    }
                    if (validformat == false)
                    {
                        $('#imgae').css('border', '1px solid red');
                        $('#prod_img_err').text('Upload valid jpeg,jpg,png,gif images only');
                        str = false;
                    }
                }
                if (str == true) {
                    // $('#btn_submit').hide();
                    $.ajax({
                        dataType: 'JSON',
                        method: 'POST',
                        data: new FormData(this),
                        url: "<?php echo base_url(); ?>front/vendor/update_product_details",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            console.log(data);
                            switch (data.code)
                            {
                                case 200:

                                    $('.success_msg').html('Data Updated Successfully').addClass('alert alert-success fade in');
                                    setTimeout(function () {
                                        window.location = location.href;
                                    }, 2000);
                                    break;
                                case 204:
                                    $('.fail_msg').html(data.description).addClass('alert alert-success fade in');
                                    $('#btn_submit').show();
                                    setTimeout(function () {
                                        window.location = location.href;
                                    }, 3000);
                                case 301:
                                case 422:
                                case 575:
                                    $('.success_msg').html(data.description).addClass('alert alert-danger fade in');
//                                            $('.form_loading_hide').show();
//                                            $('.form_loading_show').hide();
                                    break;
                            }
                        },
                        error: function (error) {
                            console.log(error);
                        },
                    });
                }
            });

        </script>
        <script type="text/javascript">
           $('#menu_id').on('change', function () {
                var menu = $(this).val();
                if (menu > 0 && !isNaN(menu)) {
                    $('#submenu_id').html('');
                    $.ajax({
                        dataType: 'html',
                        method: 'POST',
                        data: {'menu': menu, 'submenuid': 'submenuid'},
                        url: '<?php echo base_url(); ?>front/vendor/submenuWithMenu',
                        success: function (ss) {
                            console.log(ss);
                            $('#submenu_id').html(ss);
                        },
                        error: function (se) {
                            console.log(se);
                        }
                    });
                }
            });
            $('#submenu_id').on('change', function () {
                var submenu = $(this).val();
                if (submenu > 0 && !isNaN(submenu)) {
                    $('#listsubmenu').html('');
                    $.ajax({
                        dataType: 'html',
                        method: 'POST',
                        data: {'submenu': submenu},
                        url: '<?php echo base_url(); ?>front/vendor/listSubMenuWithMenu',
                        success: function (ss) {
                            $('#listsubmenu').html(ss);
                        },
                        error: function (se) {
                            console.log(se);
                        }
                    });
                }
            });
$(document).on("keyup",".number_class",function(){(isNaN($(this).val()))?$(this).val(''):'';});
$(".temp").delay(3000).fadeOut("slow");
        </script>
           
 </body>
</html>
