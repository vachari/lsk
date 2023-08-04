<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo PROJECT_NAME;  ?> | Products</title>
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

    <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH; ?>_all-skins.min.css">
    <style>
        .pages a,
        .pages strong {
            border-radius: 9px 9px;
            padding: 7px 12px;
        }

        .pages a {
            background-color: #c52825;
            border-radius: 50px;
            color: white;
        }
    </style>
</head>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view("includes/header.php"); ?>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <?php $this->load->view("includes/sidebar.php"); ?>
            <!-- /.sid$this->load->view("includes/header.php")bar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Manage Products
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Product/productDetails"><i class=""></i> Manage Products</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="col-md-6">


                                    </div>

                                    <div class="col-md-6   form-inline">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#sortModal" class="btn btn-primary pull-right">Sort Gallery</a>
                                    </div>


                                </div>
                            </div>

                            <div style=""></div>
                            <!-- /.box-header -->
                            <div class="col-md-12" id="flash_msg">
                                <?php
                                $success_msg = $this->session->flashdata('success_msg');
                                $error_msg = $this->session->flashdata('error_msg');
                                if ($success_msg) {
                                ?>
                                    <div class="alert alert-success"><?php echo $success_msg; ?></div>
                                <?php
                                }
                                if ($error_msg) {
                                ?>
                                    <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                                <?php
                                }
                                ?>
                            </div>
                            <span id="successmessage"></span>
                            <span id="failmessage"></span><br><br>
                            <div class="box-body">

                                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                    <div class="row">
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-6"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <?php echo form_open_multipart('superadmin/Product/insertGallery', 'id="insert_galleryList"'); ?>
                                            <input type="hidden" name="product_id" value="<?php echo $this->uri->segment(4); ?>">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>

                                                    <tr>
                                                        <th>Product Image <em style="color: red;">*</em></th>
                                                        <th>Title<em style="color: red;">*</em></th>
                                                        <th>Priority</th>
                                                        <th>Link</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php
                                                    $i = 1;
                                                    $prod_res = json_decode($galleryList);
                                                    //print_r($prod_res);
                                                    if ($prod_res->code == SUCCESS_CODE) {
                                                        foreach ($prod_res->result as $row) {
                                                    ?>
                                                            <tr>
                                                                <td><img class="img-fluid img-thumbnail" src="<?php echo base_url() . $row->image; ?>" width="70" /></td>
                                                                <td><?php echo $row->title; ?></td>

                                                                <td><?php echo $row->priority; ?></td>
                                                                <td><?php echo $row->download_url; ?></td>
                                                                <td>
                                                                    <a href="javascript:void(0)" onclick="editProductChild('<?php echo $row->id; ?>','<?php echo $row->title; ?>','<?php echo $row->download_url; ?>','<?php echo $row->priority; ?>','<?php echo $row->product_id; ?>')" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="menu-icon fa fa-edit"></i></a>
                                                                    <a href="<?php echo base_url() . 'admin/products/ProductsController/deleteRelatedProduct?id=' . $row->id . '&proid=' . $row->product_id; ?>"> <button class="btn btn-danger btn-sm" type="button"><i class="menu-icon fa fa-trash "></i></button></a>
                                                                </td>
                                                            </tr>
                                                        <?php $i++;
                                                        }
                                                    } else { ?>
                                                        <tr>
                                                            <td colspan="4" style="text-align:center; color:red;font-size:20px;">No Gallery Found...</td>
                                                        </tr>
                                                    <?php }
                                                    ?>
                                                    <tr id="PR_1">
                                                        <td><input name="product_file[]" type="file" class="form-control" accept="image/*"></td>
                                                        <td><input name="product_title[]" type="text" class="form-control" placeholder="Enter Title"></td>
                                                        <td><input name="product_priority[]" type="number" class="form-control" placeholder="Enter Priority"></td>
                                                        <td><input name="product_downloadlink[]" type="text" class="form-control" placeholder="Enter Link"></td>
                                                        <td>--</td>
                                                    </tr>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td class="pull-right"><button id="addBtn" class="btn btn-success btn-sm" type="button">+ Add More</button></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary pl-5 pr-5" id="submit" name="submit">Update</button>
                                                </div>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.box-body -->
                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <?php $this->load->view("includes/footer.php"); ?>

        </footer>

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">___</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open_multipart(base_url() . 'superadmin/Product/updateProductChild', 'id="update_childProduct"'); ?>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" name="modal_title" id="modal_title" maxlength="100" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Priority:</label>
                        <input type="number" class="form-control" name="modal_priority" id="modal_priority" maxlength="3" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Download URL:</label>
                        <input type="text" class="form-control" name="modal_downloadUrl" id="modal_downloadUrl" maxlength="100" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Upload Image:</label>
                        <input type="file" class="form-control" name="modal_uploadfile" id="modal_uploadfile" maxlength="100" autocomplete="off" />
                    </div>
                    <input type="hidden" id="modal_product_refId" name="modal_product_refId">
                    <input type="hidden" id="modal_product_Id" name="modal_product_Id">


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="submitEditProducctForm">Update</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div id="sortModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sortModalLabel">Sort Products</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open_multipart(base_url() . 'superadmin/Product/sortProducts', 'id="sort_childProduct"'); ?>
                <input type="text" name="sort_productid" value="<?php echo $this->uri->segment('4'); ?>">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Product Image <em style="color: red;">*</em></th>
                                    <th>Title<em style="color: red;">*</em></th>
                                    <th>Priority</th>
                                    <th>Modify Priority</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php
                                $sortReq = json_decode($galleryList);
                                if ($sortReq->code == 200) {
                                    foreach ($sortReq->result as $row) {
                                ?>
                                        <tr>
                                            <td><img height="120px" class="img" src="<?php echo base_url() . $row->image; ?>" /></td>
                                            <td><?php echo $row->title; ?></td>
                                            <td><?php echo $row->priority; ?></td>
                                            <td>
                                                <input type="number" name="sort_prioirty[]" style="width: 40%" class="form-control" value="<?php echo $row->priority; ?>">
                                                <input type="hidden" name="sort_id[]" style="width: 40%" class="form-control" value="<?php echo $row->id; ?>">
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="submitEditProducctForm">Save</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

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
</body>

</html>

<script type="text/javascript">
    var rowIdx = 1;

    $('#addBtn').on('click', function() {
        $('#tbody').append(`<tr id="PR_${++rowIdx}">
		<td><input name="product_file[]" type="file" class="form-control" ccept="image/*"></td>
										<td><input name="product_title[]" type="text" class="form-control" placeholder="Enter Product Name"></td>
										<td><input name="product_priority[]" type="text" class="form-control" placeholder="Enter Priority"></td>
										<td><input name="product_downloadlink[]" type="text" class="form-control" placeholder="Enter Link"></td>
                                        <td class="text-center">
                <button class="btn btn-danger remove"
                  type="button">Delete</button>
                </td>
		  </tr>`);
    });

    $('#tbody').on('click', '.remove', function() {
        var child = $(this).closest('tr').nextAll();
        child.each(function() {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
        });
        $(this).closest('tr').remove();
        rowIdx--;
    });

    function editProductChild(id, title, downloadLink, priority, productId) {
        $('#exampleModalLabel').html(`Edit - ${title}`);
        $('#modal_title').val(title);
        $('#modal_downloadUrl').val(downloadLink);
        $('#modal_priority').val(priority);
        $('#modal_product_refId').val(id);
        $('#modal_product_Id').val(productId);


    }

    function editProductChild(id, title, downloadLink, priority, productId) {
        $('#exampleModalLabel').html(`Edit - ${title}`);
        $('#modal_title').val(title);
        $('#modal_downloadUrl').val(downloadLink);
        $('#modal_priority').val(priority);
        $('#modal_product_refId').val(id);
        $('#modal_product_Id').val(productId);


    }
</script>