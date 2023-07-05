<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo PROJECT_NAME;  ?> | Add Product</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" type="text/css" href="<?php echo SUPER_CSS_PATH; ?>bootstrap.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>gharaahaar1.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <style type="text/css">
        textarea {
            resize: none;
        }

        .select2-container .select2-selection--single {
            height: 34px !important;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view("includes/header.php"); ?>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <?php $this->load->view("includes/sidebar.php"); ?>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Product
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>"><i class="fa fa-dashboard"></i> Home </a></li>
                    <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Product/productDetails"><i class="fa fa-dashboard"></i> Manage Products</a></li>
                    <li class="active"> Create Product </li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add New Product</h3>
                                <a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Product/productDetails" class="btn btn-primary pull-right">Go Back</a>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <?php
                            $form_attributes = array('id' => 'insertproduct', 'name' => 'insertproduct');
                            echo form_open('', $form_attributes);
                            ?>
                            <div class="box-body">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php $data1 = array(
                                            'name' => 'product_code',
                                            'id' => 'product_code',
                                            'maxlength' => '40',
                                            'autocomplete' => 'off',
                                            'class' => 'form-control',
                                            'placeholder' => 'Product Code',
                                            'value'=>'PROD_'.mt_rand(0000,100000)
                                        );
                                        echo form_label(' Product Code', ' Product Code') . "<span style='color:red' id='prod_code_err';> *</span>";
                                        echo form_input($data1); ?>
                                        <span class="err_class" id="prod_code_err"></span>
                                        <?php

                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php $data2 = array(
                                            'name' => 'product_title',
                                            'id' => 'product_title',
                                            'maxlength' => '150',
                                            'autocomplete' => 'off',
                                            'class' => 'form-control',
                                            'placeholder' => 'Product Name'
                                        );
                                        echo form_label('Product Title', 'Product Title') . "<span style='color:red' id='prod_title_err'> *</span>";
                                        echo form_input($data2);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php $data3 = array(
                                            'name' => 'sku_qty',
                                            'id' => 'sku_qty',
                                            'min' => '1',
                                            'type' => 'number',
                                            'maxlength' => '40',
                                            'autocomplete' => 'off',
                                            'class' => 'form-control',
                                            'placeholder' => 'Quntity   '
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
                                            $unit_req = json_decode($unit_result);
                                            if ($unit_req->code == SUCCESS_CODE) {
                                                foreach ($unit_req->units_list as $units_response) {
                                            ?>
                                                    <option value="<?php echo $units_response->id; ?>"><?php echo $units_response->unit_code; ?></option>
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
                                        <?php echo form_label('Category', 'Category'); ?>
                                        <span style="color:red;" id="menu_err"> *</span>
                                        <select name="menu_id" id="menu_id" class="form-control ">
                                            <option value="">Choose Category </option>
                                            <?php
                                            $menu_req = json_decode($menu_result);
                                            if ($menu_req->code == SUCCESS_CODE) {
                                                foreach ($menu_req->menu_list as $menu_response) {
                                            ?>
                                                    <option value="<?php echo $menu_response->menu_id; ?>"><?php echo $menu_response->menu_title; ?></option>
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
                                        <?php echo form_label('Sub Category', 'Sub Category'); ?>
                                        <span style="color:red;" id="submenu_err"> *</span>
                                        <select name="submenu_id" id="submenu_id" class="form-control ">
                                            <option value="">Choose Sub Category </option>
                                        </select>
                                        <span class="err_class" id="submenu_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo form_label('Sub sub Category', 'Listsub Category'); ?>
                                        <span style="color:red;" id="listsubmenu_err"> </span>
                                        <select name="listsubmenu" id="listsubmenu" class="form-control ">
                                            <option value="">Choose Listsub Category </option>
                                        </select>
                                        <span class="err_class" id="listsubmenu_err"></span>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php $data1 = array(
                                            'name' => 'mrp',
                                            'id' => 'mrp',
                                            'maxlength' => '40',
                                            'autocomplete' => 'off',
                                            'class' => 'form-control',
                                            'placeholder' => 'Mrp'
                                        );
                                        echo form_label('Mrp', 'Mrp') . "<span style='color:red' id='mrp_err';> *</span>";
                                        echo form_input($data1); ?>
                                        <span class="err_class" id="mrp_err"></span>
                                        <?php

                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php $dataSelling = array(
                                            'name' => 'selling_price',
                                            'id' => 'selling_price',
                                            'maxlength' => '10',
                                            'autocomplete' => 'off',
                                            'class' => 'form-control',
                                            'placeholder' => 'Selling Price'
                                        );
                                        echo form_label('Selling Price', 'Selling Price') . "<span style='color:red' id='selling_price_err';> *</span>";
                                        echo form_input($dataSelling); ?>
                                        <span class="err_class" id="selling_price_err"></span>
                                        <?php

                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php $data1 = array(
                                            'name' => 'gst',
                                            'id' => 'gst',
                                            'maxlength' => '40',
                                            'autocomplete' => 'off',
                                            'class' => 'form-control',
                                            'placeholder' => 'Gst'
                                        );
                                        echo form_label('Gst', 'Gst') . "<span style='color:red' id='gst_err';> *</span>";
                                        echo form_input($data1); ?>
                                        <span class="err_class" id="gst_err"></span>
                                        <?php

                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php $dataOfferPrice = array(
                                            'name' => 'offerprice',
                                            'id' => 'offerprice',
                                            'maxlength' => '8',
                                            'autocomplete' => 'off',
                                            'class' => 'form-control',
                                            'placeholder' => 'Offer price'
                                        );
                                        echo form_label('Offer Price', 'Offer Price');
                                        echo form_input($dataOfferPrice); ?>
                                        <span class="err_class" id="offer_price_err"></span>
                                        <?php

                                        ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo form_label('Product Image (500 X 500)', 'IMAGE (250 X 150)'); ?>
                                        <span style="color:red;" id="prod_img_err"> *</span>

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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo form_label('App Image (250 X 150)', 'IMAGE (250 X 150)'); ?>
                                        <span style="color:red;"> </span>

                                        <?php
                                        $upload1 = array(
                                            'name' => 'alt_image',
                                            'id' => 'alt_image',
                                            'class' => 'form-control',
                                        );

                                        echo form_upload($upload1);
                                        ?>
                                        <span class="err_class" id="prod_alt_img_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">

                                    <p class="help-block">Note : Upload upto 2 MB size file only. <a href="http://compressjpeg.com/" target="_blank">Compress Image here </a></p>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?php
                                            echo "<div class='form-group col-md-8'> ";
                                            $data1 = array(
                                                'name' => 'product_description',
                                                'id' => 'product_description',
                                                'autocomplete' => 'off',
                                                'class' => 'form-control',
                                                'rows' => 4,
                                                'placeholder' => 'Product Description'
                                            );
                                            echo form_label('Product Description', 'Product Description'); ?>
                                            <span style="color:red;" id="prod_desc_err">*</span>
                                            <?php echo form_textarea($data1); ?>

                                            <span class="err_class" id="prod_desc_err"></span>
                                            <?php
                                            echo "</div>";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer pull-right">
                                    <p class="success_msg"></p>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    <?php echo form_submit('submit', 'Submit', array('class' => 'btn btn-success', 'name' => 'btn_submit', 'id' => 'btn_submit')); ?>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
        </div>
        </section>
        <!-- /.content -->
        <footer class="main-footer">
            <?php $this->load->view("includes/footer.php"); ?>
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
    <script src="<?php echo SUPER_JS_PATH; ?>dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo SUPER_JS_PATH; ?>demo.js"></script>
    <script src="<?php echo SUPER_JS_PATH; ?>select2.full.min.js"></script>
    <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>select2.min.css">
</body>

</html>
<script>
    $(document).on("keyup", ".number_class", function() {
        (isNaN($(this).val())) ? $(this).val(''): '';
    });
    $.datetimepicker.setLocale('en');
    var currentTime = new Date();
    var extendDate = new Date(currentTime.getFullYear(), currentTime.getMonth() + 1, currentTime.getDate());
    $('#datetimepicker').datetimepicker({
        value: new Date(),
        minDate: new Date(),
        maxDate: extendDate,
        format: "d-m-Y H:i",
        minTime: '10',
        pickTime: false,
        timepicker: true,
    }).css({
        'color': '#000',
        'background-color': '#F6FBFC'
    });
    $('.bookingdate_class').datetimepicker({
        minDate: new Date(),
        maxDate: extendDate,
        format: "d-m-Y H:i",
        minTime: '10',
        pickTime: false,
        timepicker: true,
    }).css({
        'color': '#000',
        'background-color': '#F6FBFC'
    });
    //$('#datetimepicker').timepicker( 'option', 'hours', {starts: 05, ends: 23});
</script>
<script type="text/javascript">
    $('#insertproduct').on('submit', function(i) {
        i.preventDefault();
        var str = true;
        $('#prod_desc_err,#submenu_err,#menu_err,#listsubmenu_err,#prod_code_err,#prod_title_err,#prod_skuqty_err,#prod_img_err,#unit_err,#group_err,#vendor_err,#vendor_item_code_err,#hsn_code_err,#shelf_life_no_err,#shelf_life_unit_err,#gst_err,#mrp_err').html('');
        $('#menu_id,#submenu_id,#listsubmenu,#product_code,#product_title,#product_description,#sku_qty,#image,#seller,#group_id,#unit_id,#vendor,#vendor_item_code,#hsn_code,#shelf_life_no,#shelf_life_unit,#mrp,#gst').css('border', '');
        var menu = $('#menu_id').val();
        var submenu = $('#submenu_id').val();
        var listsubmenu = $('#listsubmenu').val();
        var prodcode = $('#product_code').val();
        var prodtitle = $('#product_title').val();
        var proddesc = $('#product_description').val();
        var prodskuqty = $('#sku_qty').val();
        var image = $('#image').val();
        var unit = $('#unit_id').val();
        var mrp = $("#mrp").val();
        var gst = $("#gst").val();
        var selling_price = $("#selling_price").val();
        if (unit == '') {
            $('#unit_err').html('Please select unit');
            $('#unit_id').css('border', '1px solid red');
            str = false;
        }
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

        if (proddesc == '') {
            $('#description_err').html(' Required');
            $('#product_description').css('border', '1px solid red');
            str = false;
        }
        if (mrp == '') {
            $('#mrp_err').html(' Required');
            $('#mrp').css('border', '1px solid red');
            str = false;
        }
        if (gst == '') {
            $('#gst_err').html(' Required');
            $('#gst').css('border', '1px solid red');
            str = false;
        }
        alert(selling_price);
        if (selling_price == '') {
            $('#selling_price_err').html(' Required');
            $('#selling_price').css('border', '1px solid red');
            str = false;
        }
        if (image == '') {
            $('#image').css('border', '1px solid red');
            $('#prod_img_err').text('Please upload product image');
            str = false;
        }
        if (image != '') {
            var ext = image.match(/\.(.+)$/)[1];
            validformat = '';
            switch (ext) {
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
            if (validformat == false) {
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
                url: "<?php echo base_url(); ?>superadmin/Product/insertProduct",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    switch (data.code) {
                        case 200:

                            $('.success_msg').html(data.description).addClass('alert alert-success fade in');
                            setTimeout(function() {
                                window.location = "<?php echo base_url(); ?>superadmin/Product/productDetails/";
                            }, 2000);
                            break;
                        case 204:
                            $('.fail_msg').html(data.description).addClass('alert alert-success fade in');
                            $('#btn_submit').show();
                            setTimeout(function() {
                                window.location = "<?php echo base_url(); ?>superadmin/Product/createProduct";
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
                error: function(error) {
                    console.log(error);
                },
            });
        }
    });
</script>
<script type="text/javascript">
    $('.pricefilter').on('keyup', function() {
        $(this).css('border', '');
        var pricevalue = $(this).val();
        if (isNaN(pricevalue) || pricevalue == 0) {
            $(this).css('border', '1px solid red').val('');
        }
    });
    $('#menu_id').on('change', function() {
        var menu = $(this).val();
        if (menu > 0 && !isNaN(menu)) {
            $('#submenu_id').html('');
            $.ajax({
                dataType: 'html',
                method: 'POST',
                data: {
                    'menu': menu,
                    'submenuid': 'submenuid'
                },
                url: '<?php echo base_url(); ?>superadmin/Category/submenuWithMenu',
                success: function(ss) {
                    console.log(ss);
                    $('#submenu_id').html(ss);
                },
                error: function(se) {
                    console.log(se);
                }
            });
        }
    });
    $('#submenu_id').on('change', function() {
        var submenu = $(this).val();
        if (submenu > 0 && !isNaN(submenu)) {
            $('#listsubmenu').html('');
            $.ajax({
                dataType: 'html',
                method: 'POST',
                data: {
                    'submenu': submenu
                },
                url: '<?php echo base_url(); ?>superadmin/Category/listSubMenuWithMenu',
                success: function(ss) {
                    $('#listsubmenu').html(ss);
                },
                error: function(se) {
                    console.log(se);
                }
            });
        }
    });
    $(".select2").select2();
</script>