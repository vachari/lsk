<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Add Vendor</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" type="text/css" href="<?php echo SUPER_CSS_PATH ; ?>bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>font-awesome.min.css">
  <!-- Ionicons -->
 <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>gharaahaar1.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">textarea{resize: none;}</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view("includes/header.php");?>
 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
   <?php $this->load->view("includes/sidebar.php");?>
    <!-- /.sidebar -->
  </aside>
        <div class="col-md-12"> 
        <?php if($this->session->flashdata('success')) { ?>
        <div class="alert alert-success" id="temp">
        <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php } ?>
        <?php if($this->session->flashdata('failure')) { ?>
        <div class="alert alert-danger" id="temp">
        <?php echo $this->session->flashdata('failure'); ?>
        </div>
        <?php } ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Vendor
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>Vendors/viewVendorDetails"><i class="fa fa-dashboard"></i> Manage Vendors</a></li>
        <li class="active">Create Vendors</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Add New Vendor</h3>
            <a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>Vendors/viewVendorDetails" class="btn btn-primary pull-right">Manage Vendors</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
                            $form_attributes = array('id' => 'vendor', 'name' => 'vendor');
                            echo form_open('', $form_attributes);
                         ?>
            <div class="box-body">
            <div class="col-md-4">
              <div class="form-group">
            <?php   $data1 = array(
                            'name' => 'vendor_code',
                            'id' => 'vendor_code',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Vendor Code (MaxLength 6)',
                            'value'=>set_value('vendor_code'),
                            'maxlength'=>6
                        );
                        echo form_label('Vendor Code'). "<span style='color:red' id='vendor_code_err';> *".form_error('vendor_code')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="vendor_code_err"></span>
                        
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <?php  $data2 = array(
                            'name' => 'vendor_name',
                            'id' => 'vendor_name',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Vendor Name',
                            'value' =>  set_value('vendor_name')
                        );
                        echo form_label('Vendor Name')."<span style='color:red' id='vendor_name_err'> *".form_error('vendor_name')."</span>";
                        echo form_input($data2);
                        ?>
                        <span class="err_class" id="vendor_name_err"></span>

              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               <?php $data3 = array(
                            'name' => 'mobile',
                            'id' => 'mobile',
                            'autocomplete' => 'off',
                            'class' => 'form-control input-md floatlabel number_class',
                            'placeholder' => 'Mobile',
                            'value' =>  set_value('mobile'),
                            'maxlength' => 10

                        );
                        echo form_label('Mobile') . "<span style='color:red' id='mobile_err'> *".form_error('mobile')."</span>";
                        echo form_input($data3);
                        ?>
                        <span class="err_class" id="mobile_err"></span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <?php
                        $data4 = array(
                            'name' => 'email',
                            'id' => 'email',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'rows' =>4,
                            'placeholder' => 'Email Id',
                            'value' =>  set_value('email')
                        );
                        echo form_label('Email ID'). "<span style='color:red' id='email_err'> *".form_error('email')."</span>"?>
                       <?php echo form_input($data4); ?>
                        <span class="err_class" id="email_err"></span>

                       </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               <?php $data5 = array(
                            'name' => 'plot',
                            'id' => 'plot',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Plot',
                            'value' =>  set_value('plot')

                        );
                        echo form_label('Plot') . "<span style='color:red' id='plot_err'> *".form_error('plot')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="plot_err"></span>
              </div>
            </div>   
            <div class="col-md-4">
              <div class="form-group">
               <?php $data5 = array(
                            'name' => 'street',
                            'id' => 'street',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Street',
                            'value' =>  set_value('street')

                        );
                        echo form_label('Street') . "<span style='color:red' id='street_err'> *".form_error('street')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="street_err"></span>
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group">
               <?php $data5 = array(
                            'name' => 'area',
                            'id' => 'area',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Area',
                            'value' =>  set_value('area')

                        );
                        echo form_label('Area') . "<span style='color:red' id='area_err'> *".form_error('area')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="area_err"></span>
              </div>
            </div>                                  
            <div class="col-md-4">
              <div class="form-group">
               <?php $data5 = array(
                            'name' => 'city',
                            'id' => 'city',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'City',
                            'value' =>  set_value('city')

                        );
                        echo form_label('City') . "<span style='color:red' id='city_err'> *".form_error('city')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="city_err"></span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               <?php $data5 = array(
                            'name' => 'state',
                            'id' => 'state',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'State',
                            'value' =>  set_value('state')

                        );
                        echo form_label('State') . "<span style='color:red' id='state_err'> *".form_error('state')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="state_err"></span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               <?php $data5 = array(
                            'name' => 'pincode',
                            'id' => 'pincode',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control number_class',
                            'placeholder' => 'Pincode',
                            'value' =>  set_value('pincode'),
                            'maxlength' => 6

                        );
                        echo form_label('Pincode') . "<span style='color:red' id='pincode_err'> *".form_error('pincode')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="pincode_err"></span>
              </div>
            </div>  
            <div class="col-md-4">
              <div class="form-group">
               <?php $data5 = array(
                            'name' => 'website',
                            'id' => 'website',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Website',
                            'value' =>  set_value('website')

                        );
                        echo form_label('Website') . "<span style='color:red' id='website_err'> *".form_error('website')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="website_err"></span>
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group">
               <?php $data5 = array(
                            'name' => 'gst',
                            'id' => 'gst',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'GST',
                            'value' =>  set_value('gst')

                        );
                        echo form_label('GST') . "<span style='color:red' id='gst_err'> *".form_error('gst')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="gst_err"></span>
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group">
               <?php $data5 = array(
                            'name' => 'pan',
                            'id' => 'pan',
                            'maxlength' => '10',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'PAN Number',
                            'value' =>  set_value('pan')

                        );
                        echo form_label('PAN Number') . "<span style='color:red' id='pan_err'> *".form_error('pan')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="pan_err"></span>
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group">
               <?php $data5 = array(
                            'name' => 'tds',
                            'id' => 'tds',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control number_class',
                            'placeholder' => 'TDS',
                            'value' =>  set_value('tds')

                        );
                        echo form_label('TDS') . "<span style='color:red' id='tds_err'> *".form_error('tds')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="tds_err"></span>
              </div>
            </div>
            <div class="clearfix">&emsp;</div>
              <h4>Add Bank Details</h4>
              <hr>
               <div class="col-md-6">
              <div class="form-group">
            <?php   $data1 = array(
                            'name' => 'bank_account_holder',
                            'id' => 'bank_account_holder',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'The Account Holder Name',
                            'value'=>set_value('bank_account_holder')
                        );
                        echo form_label('The Account Holder Name'). "<span style='color:red' id='bank_account_holder_err';> *".form_error('bank_account_holder')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="bank_account_holder_err"></span>
                        
              </div>
              </div> 
              <div class="col-md-6">
              <div class="form-group">
            <?php   $data1 = array(
                            'name' => 'bank_name',
                            'id' => 'bank_name',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Name of The Bank',
                            'value'=>set_value('bank_name')
                        );
                        echo form_label('Name of The Bank'). "<span style='color:red' id='bank_name_err';> *".form_error('bank_name')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="bank_name_err"></span>
                        
              </div>
              </div> 
              <div class="col-md-6">
              <div class="form-group">
            <?php   $data1 = array(
                            'name' => 'bank_account_number',
                            'id' => 'bank_account_number',
                            'autocomplete' => 'off',
                            'class' => 'form-control number_class',
                            'placeholder' => 'Account Number',
                            'value'=>set_value('bank_account_number')
                        );
                        echo form_label('Account Number'). "<span style='color:red' id='bank_account_number_err';> *".form_error('bank_account_number')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="bank_account_number_err"></span>   
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
            <?php   $data1 = array(
                            'name' => 'bank_branch',
                            'id' => 'bank_branch',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Branch Name',
                            'value'=>set_value('bank_branch')
                        );
                        echo form_label('Branch Name'). "<span style='color:red' id='bank_branch_err';> *".form_error('bank_branch')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="bank_branch_err"></span>   
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
            <?php   $data1 = array(
                            'name' => 'bank_ifsc_code',
                            'id' => 'bank_ifsc_code',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'IFSC Code',
                            'value'=>set_value('bank_ifsc_code')
                        );
                        echo form_label('IFSC Code'). "<span style='color:red' id='bank_ifsc_code_err';> *".form_error('bank_ifsc_code')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="bank_ifsc_code_err"></span>
                        
              </div>
              </div> 
              <div class="col-md-6">
              <div class="form-group">
                <label for="bank_account_type">Account Type<span style="color: red" id="bank_account_type_err"> *</span></label>
                <select name="bank_account_type" id="bank_account_type" class="form-control">
                  <option value="">--Select Account Type--</option>
                  <option value="1" <?php echo set_select('bank_account_type',1); ?>>Current Account</option>
                  <option value="2" <?php echo set_select('bank_account_type',2); ?>>Savings Account</option>
                  <option value="3" <?php echo set_select('bank_account_type',3); ?>>Recurring Deposit Account</option>
                  <option value="4" <?php echo set_select('bank_account_type',4); ?>>Fixed Deposit Account</option>
                </select>   
              </div>
              </div>
              <div class="col-md-12">
              <div class="form-group">
            <?php   $data1 = array(
                            'name' => 'bank_address',
                            'id' => 'bank_address',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Bank Address',
                            'value'=>set_value('bank_address')
                        );
                        echo form_label('Bank Address'). "<span style='color:red' id='bank_address_err';> *".form_error('bank_address')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="bank_address_err"></span>   
              </div>
              </div>                                   
            <div class="clearfix">&emsp;</div>
              <h4>Add Payment Terms</h4>
              <hr>
              <div class="col-md-6">
              <div class="form-group">
            <?php   $data1 = array(
                            'name' => 'payment_terms_code',
                            'id' => 'pt_code',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Payment Terms Code',
                            'value'=>set_value('payment_terms_code'),
                            'maxlength'=>30
                        );
                        echo form_label('Payment Terms Code'). "<span style='color:red' id='pt_code_err';> *".form_error('payment_terms_code')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="pt_code_err"></span>
                       
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
            <?php   $data1 = array(
                            'name' => 'no_of_days_credit_from_delivery_date',
                            'id' => 'credit_days',
                            'autocomplete' => 'off',
                            'class' => 'form-control number_class',
                            'placeholder' => 'No of days credit from delivery date',
                            'value'=>set_value('no_of_days_credit_from_delivery_date'),
                            'maxlength'=>10
                        );
                        echo form_label('No of days credit from delivery date'). "<span style='color:red' id='credit_days_err';> *".form_error('no_of_days_credit_from_delivery_date')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="credit_days_err"></span>
                        
              </div>
              </div>
             
            <div class="col-md-12">
            <div class="form-group">
           <?php   $data1 = array(
                            'name' => 'payment_terms_description',
                            'id' => 'ptd',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'rows' => 3,
                            'style' => 'resize:none',
                            'placeholder' => 'Payment Terms Description',
                            'value'=>set_value('payment_terms_description')
                        );
                        echo form_label('Payment Terms Description'). "<span style='color:red' id='ptd_err';> *".form_error('payment_terms_description')."</span>";
                        echo form_textarea($data1);?>
                        <span class="err_class" id="ptd_err"></span>
                        
              </div>
              </div>
              <div class="col-md-12"> 
              <h4>Add Vendor Contact Person<span style='color:red' id='vendor_name_err'> *</span></h4>
              <hr>
            </div>

                   <div class="col-md-12"> 
                    <div class="col-md-2" style="padding-left: 0px;">
                     <label> Contact Person Code</label><span style="color:red;"><?php echo form_error('vcp_code'); ?></span><input type="text" class="form-control" name="vcp_code[]" autocomplete="off" value="<?php echo set_value('vcp_code[0]'); ?>" maxlength="3">
                    </div>
                    <div class="col-md-3"><label> Contact Person Name</label><span style="color:red;"><?php echo form_error('vcp_name'); ?></span><input type="text" class="form-control" name="vcp_name[]" autocomplete="off" value="<?php echo set_value('vcp_name[0]'); ?>"></div>
                    <div class="col-md-3"><label> Contact Person Email</label><span style="color:red;"><?php echo form_error('vcp_email'); ?></span><input type="text" class="form-control" name="vcp_email[]" autocomplete="off" value="<?php echo set_value('vcp_email[0]'); ?>"></div>
                    <div class="col-md-3"><label> Contact Person Mobile</label><span style="color:red;"><?php echo  form_error('vcp_mobile'); ?></span><input type="text" class="form-control number_class" name="vcp_mobile[]" autocomplete="off" value="<?php echo set_value('vcp_mobile[0]'); ?>" maxlength="10"></div>
                    <div class="col-md-1"><label style="visibility: hidden;"> Add</label><button class="btn btn-primary" type="button" id="add_contact_person">Add</button></div>
                   </div>
                   <div id="wrapper">
                   </div>
              <div class="clearfix"></div>
            <div class="box-footer">
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
    <?php $this->load->view("includes/footer.php");?>
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
</body>
</html>
<script type="text/javascript">
// function remove(){
 $(document).on("click",".remove_btn",function(){
    $(this).parent().parent().remove();
  });
// }
</script>
 <script>
         $("#btn_submit").click(function(){
             var vendor_code=$('#vendor_code').val().trim();
            var vendor_name=$('#vendor_name').val();
            var mobile=$('#mobile').val().trim();
            var email=$('#email').val().trim();
            var plot=$('#plot').val();
            var street=$('#street').val();
            var city=$('#city').val();
             var state=$('#state').val();
              var area=$('#area').val();              
               var pincode=$('#pincode').val().trim();
           var website=$('#website').val();
            var gst=$('#gst').val().trim();
            var pan=$('#pan').val().trim();
             var tds=$('#tds').val().trim();
             var pt_code=$('#pt_code').val().trim();
             var credit_days=$('#credit_days').val().trim();
             var bank_account_holder=$('#bank_account_holder').val().trim();
             var bank_account_number=$('#bank_account_number').val().trim();
             var bank_name=$('#bank_name').val().trim();
             var bank_branch=$('#bank_branch').val().trim();
             var bank_ifsc_code=$('#bank_ifsc_code').val().trim();
             var bank_account_type=$('#bank_account_type').val();
             var bank_address=$('#bank_address').val().trim();
             var ptd=$('#ptd').val().trim();
            var namepattern=/^[A-Za-z][A-Za-z ]*$/;
            var vnamepattern=/^[A-Za-z][A-Za-z- ]*$/;
             var panpattern=/^[A-Za-z0-9]*$/
            var mobilepattern = /^[6-9]{1}[0-9]{9}$/;
            var emailpattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            var pincodepatteren=/^[1-9][0-9]{5}$/;
            var gstpattern = /^([0][1-9]|[1-2][0-9]|[3][0-5])([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$/;

            var str=true;
            $('#vendor_code_err,#vendor_name_err,#mobile_err,#email_err,#city_err,#location_err,#address_error,#plot_err,#area_err,#state_err,#street_err,#pincode_err,#website_err,#gst_err,#pan_err,#tds_err,#pt_code_err,#credit_days_err,#ptd_err,#bank_account_holder_err,#bank_account_number_err,#bank_name_err,#bank_branch_err,#bank_address_err,#bank_ifsc_code_err,#bank_account_type_err,#bank_address_err').html('');
             $('#vendor_code,#vendor_name,#mobile,#email,#city,#location,#address,#plot,#area,#street,#state,#pincode,#website,#gst,#pan,#tds,#pt_code,#credit_days,#ptd,#bank_account_holder,#bank_account_number,#bank_name,#bank_branch,#bank_ifsc_code,#bank_account_type,#bank_address').css('border','');
             if(vendor_code==''|| vendor_code==' '){
                str=false;
                $('#vendor_code').css('border','1px solid red');
                $('#vendor_code_err').css('color','red');
                $('#vendor_code_err').html(' Please enter Vendor Code');
            }
            if(vendor_name==''|| vendor_name==' '){
                str=false;
                $('#vendor_name').css('border','1px solid red');
                $('#vendor_name_err').css('color','red');
                $('#vendor_name_err').html(' Please Vendor Name');
            }
              if(vendor_name!="" && !vnamepattern.test(vendor_name)){
                str=false;
                $('#vendor_name').css('border','1px solid red');
                $('#vendor_name_err').css('color','red');
                $('#vendor_name_err').html(' Please enter valid Vendor Name');
                  }
            if(mobile==''|| mobile==' '){
                str=false;
                $('#mobile').css('border','1px solid red');
                $('#mobile_err').css('color','red');
                $('#mobile_err').html(' Please Enter Mobile no');
            }
            if(mobile!="" && !mobilepattern.test(mobile)){
                str=false;
                $('#mobile').css('border','1px solid red');
                $('#mobile_err').css('color','red');
                $('#mobile_err').html(' Please Enter valid Mobile no');
                  }            
           if(city==''|| city==' '){
                str=false;
                $('#city').css('border','1px solid red');
                $('#city_err').css('color','red');
                $('#city_err').html(' Please Enter City');
            }
            if(city!="" && !namepattern.test(city)){
                str=false;
                $('#city').css('border','1px solid red');
                $('#city_err').css('color','red');
                $('#city_err').html(' Please Enter valid City');
                  }            
           if(plot==''|| plot==' '){
                str=false;
                $('#plot').css('border','1px solid red');
                $('#plot_err').css('color','red');
                $('#plot_err').html(' Please Enter Plot number');
            }
           if(state==''|| state==' '){
                str=false;
                $('#state').css('border','1px solid red');
                $('#state_err').css('color','red');
                $('#state_err').html(' Please Enter State');
            }
            if(state!="" && !namepattern.test(state)){
                str=false;
                $('#state').css('border','1px solid red');
                $('#state_err').css('color','red');
                $('#state_err').html(' Please Enter valid State');
                  }             
           if(street==''|| street==' '){
                str=false;
                $('#street').css('border','1px solid red');
                $('#street_err').css('color','red');
                $('#street_err').html(' Please Enter Street');
            }              
           if(area==''|| area==' '){
                str=false;
                $('#area').css('border','1px solid red');
                $('#area_err').css('color','red');
                $('#area_err').html(' Please Enter Area');
            }
           if(pincode==''|| pincode==' '){
                str=false;
                $('#pincode').css('border','1px solid red');
                $('#pincode_err').css('color','red');
                $('#pincode_err').html(' Please Enter Pincode');
            }   
            if(pincode!="" && !pincodepatteren.test(pincode)){
                str=false;
                $('#pincode').css('border','1px solid red');
                $('#pincode_err').css('color','red');
                $('#pincode_err').html(' Please Enter valid Pincode');
            }                           
           if(website==''|| website==' '){
                str=false;
                $('#website').css('border','1px solid red');
                $('#website_err').css('color','red');
                $('#website_err').html(' Please Enter Website');
            }
           if(gst==''|| gst==' '){
                str=false;
                $('#gst').css('border','1px solid red');
                $('#gst_err').css('color','red');
                $('#gst_err').html(' Please Enter GST');
            }
         
           if(email==''){
                str=false;
                $('#email').css('border','1px solid red');
                $('#email_err').css('color','red');
                $('#email_err').html(' Please Enter Email');
            }
            if(email!="" && !emailpattern.test(email)){
                str=false;
                $('#email').css('border','1px solid red');
                $('#email_err').css('color','red');
                $('#email_err').html('Please Enter valid Email');
                  }             
           if(pan==''|| pan==' '){
                str=false;
                $('#pan').css('border','1px solid red');
                $('#pan_err').css('color','red');
                $('#pan_err').html(' Please Enter PAN number');
            }
           if(pan!='' && !panpattern.test(pan)){
                str=false;
                $('#pan').css('border','1px solid red');
                $('#pan_err').css('color','red');
                $('#pan_err').html(' Please Enter valid PAN number');
            }            
           if(tds==''|| tds==' '){
                str=false;
                $('#tds').css('border','1px solid red');
                $('#tds_err').css('color','red');
                $('#tds_err').html(' Please Enter TDS');
            }
            if(pt_code==''|| pt_code==' ' || pt_code==0){
                str=false;
                $('#pt_code').css('border','1px solid red');
            }
            if(credit_days==''|| credit_days==' ' || credit_days==0){
                str=false;
                $('#credit_days').css('border','1px solid red');
            }
            if(ptd==''|| ptd==' '){
                str=false;
                $('#ptd').css('border','1px solid red');
            }
            if(bank_account_holder ==''|| bank_account_holder==' '){
                str=false;
                $('#bank_account_holder').css('border','1px solid red');
            }
            if(bank_account_number==''|| bank_account_number==' '){
                str=false;
                $('#bank_account_number').css('border','1px solid red');
            }
            if(bank_name==''|| bank_name==' '){
                str=false;
                $('#bank_name').css('border','1px solid red');
            }
            if(bank_branch==''|| bank_branch==' '){
                str=false;
                $('#bank_branch').css('border','1px solid red');
            }
            if(bank_ifsc_code==''|| bank_ifsc_code==' '){
                str=false;
                $('#bank_ifsc_code').css('border','1px solid red');
            }
            if(bank_account_type==''|| bank_account_type==' '){
                str=false;
                $('#bank_account_type').css('border','1px solid red');
            }
            if(bank_address==''|| bank_address==' '){
                str=false;
                $('#bank_address').css('border','1px solid red');
            }

            $("[name^=vcp_code]").each(function(){
              if($(this).val() == '')
              {
                   str=false;
                $(this).css("border","1px solid red");
              }
              else
              {
                $(this).css("border","");
              }
            });
            $("[name^=vcp_name]").each(function(){
              if($(this).val() == '')
              {
                str=false;
                $(this).css("border","1px solid red");
              }
              else if($(this).val()!="" && !namepattern.test($(this).val())){
                str=false;
                $(this).css("border","1px solid red");
              }             
              else
              {
                $(this).css("border","");
              }
            });
            $("[name^=vcp_email]").each(function(){
              if($(this).val() == '')
              {
                   str=false;
                $(this).css("border","1px solid red");
              }
              else if($(this).val()!="" && !emailpattern.test($(this).val())){
                str=false;
                $(this).css("border","1px solid red");
              }               
              else
              {
                $(this).css("border","");
              }
            });    
            $("[name^=vcp_mobile]").each(function(){
              if($(this).val() == '')
              {
                   str=false;
                $(this).css("border","1px solid red");
              }
              else if($(this).val()!="" && !mobilepattern.test($(this).val())){
                str=false;
                $(this).css("border","1px solid red");
              }               
              else
              {
                $(this).css("border","");
              }
            });                                
          // if(email_check(email)==0){$('#email').focus().css('border','1px solid red'); $('#email_err').html(' Please enter Vehicle Number'); str=false;}

             return str;
         });
    $("#add_contact_person").click(function(){
      var data='<div class="col-md-12"><div class="col-md-2" style="padding-left: 0px;"><div class="form-group"><label> Contact Person Code</label><span style="color:red;"><?php echo form_error("vcp_mobile"); ?></span><input type="text" class="form-control" name="vcp_code[]" maxlength="3"></div></div><div class="col-md-3"><label> Contact Person Name</label><span style="color:red;"><?php echo form_error("vcp_name"); ?></span><input type="text" class="form-control" name="vcp_name[]" autocomplete="off"></div><div class="col-md-3"><label> Contact Person Email</label><span style="color:red;"><?php echo form_error("vcp_email"); ?></span><input type="text" class="form-control" name="vcp_email[]" autocomplete="off"></div><div class="col-md-3"><label> Contact Person Mobile</label><span style="color:red;"><?php echo form_error("vcp_mobile"); ?></span><input type="text" class="form-control number_class" name="vcp_mobile[]" autocomplete="off" maxlength="10"></div><div class="col-md-1"><label style="visibility: hidden;"> Add</label><button class="btn btn-danger remove_btn" type="button" onclick="remove()">Remove</button></div></div>';
      $("#wrapper").append(data);
    });
    $(document).on("keyup",".number_class",function(){(isNaN($(this).val()))?$(this).val(''):'';});
$('.mobile_class').on('keyup',function(){
  var mobile=$(this).val();
  (isNaN(mobile) && (mobile[0] > 5))?$(this).val(''):'';
  });
</script>
