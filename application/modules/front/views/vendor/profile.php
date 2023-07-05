
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
                         <li class="active"> <a href="<?php echo base_url().'vendor/profile'; ?>"> My Profile</a></li>
                         <li> <a href="<?php echo base_url().'vendor/products'; ?>">Create/Manage Products</a></li>
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
                        <h4> Profile <a href="<?php echo base_url().'vendor/profile-update' ?>" class="btn btn-warning pull-right">Update</a></h4>
                        <hr> 
                    </div>
                   
                        <div class="col-md-4">
              <div class="form-group">
            <?php   $data1 = array(
                            'name' => 'vendor_code',
                            'id' => 'vendor_code',
                            'maxlength' => 6,
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Vendor Code',
                            'disabled' => 'disabled',
                            'value'=>$vendor_details->vendor_code
                        );
                        echo form_label('Vendor Code'). "<span style='color:red' id='vendor_code_err';> *".form_error('vendor_code')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="vendor_code_err"></span>
                        <?php
                       
                        ?>
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
                            'placeholder' => 'Name',
                            'disabled' => 'disabled',
                            'value'=>$vendor_details->vendor_name
                            
                        );
                        echo form_label('Name')."<span style='color:red' id='vendor_name_err'> *".form_error('vendor_name')."</span>";
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
                            'maxlength' => 10,
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Mobile',
                            'disabled' => 'disabled',
                            'value'=>$vendor_details->mobile
                           

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
                            'disabled' => 'disabled',
                            'value'=>$vendor_details->email
                            
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
                            'disabled' => 'disabled',
                            'value' =>  $vendor_details->plot

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
                            'disabled' => 'disabled',
                            'value' =>  $vendor_details->street

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
                            'disabled' => 'disabled',
                            'value' =>  $vendor_details->area

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
                            'disabled' => 'disabled',
                            'value'=>$vendor_details->city
                            

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
                            'disabled' => 'disabled',
                            'value' =>  $vendor_details->state

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
                            'maxlength' => 6,
                            'autocomplete' => 'off',
                            'class' => 'form-control number_class',
                            'placeholder' => 'Pincode',
                            'disabled' => 'disabled',
                            'value' =>  $vendor_details->pincode

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
                            'disabled' => 'disabled',
                            'value' =>  $vendor_details->website

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
                            'disabled' => 'disabled',
                            'value' =>  $vendor_details->gst

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
                            'maxlength' => 10,
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'PAN Number',
                            'disabled' => 'disabled',
                            'value' =>  $vendor_details->pan

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
                            'disabled' => 'disabled',
                            'value' =>  $vendor_details->tds

                        );
                        echo form_label('TDS') . "<span style='color:red' id='tds_err'> *".form_error('tds')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="tds_err"></span>
              </div>
            </div> 
            <!-- Vendor Contact Persons code start -->
                <div class="clearfix">&emsp;</div>
              <div class="clearfix">&emsp;</div>
              <?php if($vendor_contacts !=null){ ?>
               <h4 class="box-title">Contacts</h4><hr>
              <?php $i=0; foreach ($vendor_contacts as $row) {  ?>
                  <div class="col-md-12">
                  <input type="hidden" name="<?php echo 'id'.$i; ?>" value="<?php echo $row->id ?>"> 
                    <div class="col-md-3" style="padding-left: 0px;">
                     <label>Code</label><span style="color:red;"><?php echo form_error('vcp_code'); ?></span><input type="text" class="form-control" name="vcp_code[]" autocomplete="off" value="<?php echo set_value('vcp_code',$row->contact_person_code); ?>" maxlength="3" disabled="disabled">
                    </div>
                    <div class="col-md-3"><label>Name</label><span style="color:red;"><?php echo form_error('vcp_name'); ?></span><input type="text" class="form-control" name="vcp_name[]" autocomplete="off" value="<?php echo set_value('vcp_name',$row->contact_person_name); ?>" disabled="disabled"></div>
                    <div class="col-md-3"><label>Email</label><span style="color:red;"><?php echo form_error('vcp_email'); ?></span><input type="text" class="form-control" name="vcp_email[]" autocomplete="off" value="<?php echo set_value('vcp_email',$row->contact_person_email); ?>" disabled="disabled"></div>
                    <div class="col-md-3"><label>Mobile</label><span style="color:red;"><?php echo  form_error('vcp_mobile'); ?></span><input type="text" class="form-control number_class" name="vcp_mobile[]" autocomplete="off" value="<?php echo set_value('vcp_mobile',$row->contact_person_mobile); ?>" maxlength="10" disabled="disabled"></div>
                   </div>
               <?php $i++; }

              } else{ ?>
                <div class="col-md-12 text-center text-danger"><b>Contacts Not Found</b></div>
                <div class="clearfix">&emsp;</div>
              <?php }?>
               
              <div class="clearfix">&emsp;</div>
            <!-- Vendor Contact Persons code end-->
             
            <div class="clearfix">&emsp;</div>
            <div class="clearfix">&emsp;</div>
              <h4 class="box-title">Bank Details</h4>
              <hr>
               <div class="col-md-6">
              <div class="form-group">
            <?php $vpd=$vendor_payment_details; 
                  if($vpd!=null){ $bah=$vpd->bank_account_holder;}else{$bah='';}
               $data1 = array(
                            'name' => 'bank_account_holder',
                            'id' => 'bank_account_holder',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'The Account Holder Name',
                            'disabled' => 'disabled',
                            'value'=>set_value('bank_account_holder',$bah)
                        );
                        echo form_label('The Account Holder Name'). "<span style='color:red' id='bank_account_holder_err';> *".form_error('bank_account_holder')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="bank_account_holder_err"></span>
                        
              </div>
              </div> 
              <div class="col-md-6">
              <div class="form-group">
            <?php 
            if($vpd!=null){ $bn=$vpd->bank_name;}else{$bn='';}
              $data1 = array(
                            'name' => 'bank_name',
                            'id' => 'bank_name',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Name of The Bank',
                            'disabled' => 'disabled',
                            'value'=>set_value('bank_name',$bn)
                        );
                        echo form_label('Name of The Bank'). "<span style='color:red' id='bank_name_err';> *".form_error('bank_name')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="bank_name_err"></span>
                        
              </div>
              </div> 
              <div class="col-md-6">
              <div class="form-group">
            <?php  
            if($vpd!=null){ $ban=$vpd->bank_account_number;}else{$ban='';}
             $data1 = array(
                            'name' => 'bank_account_number',
                            'id' => 'bank_account_number',
                            'autocomplete' => 'off',
                            'class' => 'form-control number_class',
                            'placeholder' => 'Account Number',
                            'disabled' => 'disabled',
                            'value'=>set_value('bank_account_number',$ban)
                        );
                        echo form_label('Account Number'). "<span style='color:red' id='bank_account_number_err';> *".form_error('bank_account_number')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="bank_account_number_err"></span>   
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
            <?php  
            if($vpd!=null){ $bb=$vpd->bank_branch;}else{$bb='';}
             $data1 = array(
                            'name' => 'bank_branch',
                            'id' => 'bank_branch',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Branch Name',
                            'disabled' => 'disabled',
                            'value'=>set_value('bank_branch',$bb)
                        );
                        echo form_label('Branch Name'). "<span style='color:red' id='bank_branch_err';> *".form_error('bank_branch')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="bank_branch_err"></span>   
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
            <?php 
            if($vpd!=null){ $bic=$vpd->bank_ifsc_code;}else{$bic='';}
              $data1 = array(
                            'name' => 'bank_ifsc_code',
                            'id' => 'bank_ifsc_code',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'IFSC Code',
                            'disabled' => 'disabled',
                            'value'=>set_value('bank_ifsc_code',$bic)
                        );
                        echo form_label('IFSC Code'). "<span style='color:red' id='bank_ifsc_code_err';> *".form_error('bank_ifsc_code')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="bank_ifsc_code_err"></span>
                        
              </div>
              </div> 
              <div class="col-md-6">
              <div class="form-group">
                <?php if($vpd!=null){ $bat=$vpd->bank_account_type;}else{$bat='';} ?>
                <label for="bank_account_type">Account Type<span style="color: red" id="bank_account_type_err"> *</span></label>
                <select name="bank_account_type" id="bank_account_type" class="form-control" disabled>
                  <option value="">--Select Account Type--</option>
                  <option value="1" <?php echo set_select('bank_account_type',1); if($bat!='' && $bat==1) echo 'selected'; ?>>Current Account</option>
                  <option value="2" <?php echo set_select('bank_account_type',2); if($bat!='' && $bat==2) echo 'selected'; ?>>Savings Account</option>
                  <option value="3" <?php echo set_select('bank_account_type',3); if($bat!='' && $bat==3) echo 'selected'; ?>>Recurring Deposit Account</option>
                  <option value="4" <?php echo set_select('bank_account_type',4); if($bat!='' && $bat==4) echo 'selected'; ?>>Fixed Deposit Account</option>
                </select>   
              </div>
              </div>
              <div class="col-md-12">
              <div class="form-group">
            <?php 
            if($vpd!=null){ $ba=$vpd->bank_address;}else{$ba='';}
              $data1 = array(
                            'name' => 'bank_address',
                            'id' => 'bank_address',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Bank Address',
                            'disabled' => 'disabled',
                            'value'=>set_value('bank_address',$ba)
                        );
                        echo form_label('Bank Address'). "<span style='color:red' id='bank_address_err';> *".form_error('bank_address')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="bank_address_err"></span>   
              </div>
              </div>
              <div class="clearfix">&emsp;</div>
            <div class="clearfix">&emsp;</div>
              <h4 class="box-title">Payment Terms</h4><hr>
              <div class="col-md-6">
              <div class="form-group">
            <?php 
            if($vpd!=null){ $ptc=$vpd->payment_terms_code;}else{$ptc='';}
             $data1 = array(
                            'name' => 'payment_terms_code',
                            'id' => 'pt_code',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Payment Terms Code',
                            'disabled' => 'disabled',
                            'value'=>set_value('payment_terms_code',$ptc),
                            'maxlength'=>30
                        );
                        echo form_label('Payment Terms Code'). "<span style='color:red' id='pt_code_err';> ".form_error('payment_terms_code')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="pt_code_err"></span>
                       
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
            <?php 
            if($vpd!=null){ $cd=$vpd->no_of_days_credit_from_delivery_date;}else{$cd='';}
              $data1 = array(
                            'name' => 'no_of_days_credit_from_delivery_date',
                            'id' => 'credit_days',
                            'autocomplete' => 'off',
                            'class' => 'form-control number_class',
                            'placeholder' => 'Number of days credit from delivery date',
                            'disabled' => 'disabled',
                            'value'=>set_value('no_of_days_credit_from_delivery_date',$cd.' Days'),
                            'maxlength'=>10
                        );
                        echo form_label('Number of days credit from delivery date'). "<span style='color:red' id='credit_days_err';> ".form_error('no_of_days_credit_from_delivery_date')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="credit_days_err"></span>
                        
              </div>
              </div>
             
            <div class="col-md-12">
            <div class="form-group">
           <?php  
           if($vpd!=null){ $ptd=$vpd->payment_terms_description;}else{$ptd='';}
            $data1 = array(
                            'name' => 'payment_terms_description',
                            'id' => 'ptd',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'rows' => 3,
                            'style' => 'resize:none',
                            'placeholder' => 'Payment Terms Description',
                            'disabled' => 'disabled',
                            'value'=>set_value('payment_terms_description',$ptd)
                        );
                        echo form_label('Payment Terms Description'). "<span style='color:red' id='ptd_err';> ".form_error('payment_terms_description')."</span>";
                        echo form_textarea($data1);?>
                        <span class="err_class" id="ptd_err"></span>
                        
              </div>
              </div>
                       
                          
                        <div class="form-group col-md-12 mrtop text-center"> 
                        <a href="<?php echo base_url().'vendor/profile-update' ?>" class="btn btn-warning">Update</a>   
                          
                        </div>
                    </div>
                </div><!-- end of 9 col -->
            </div><!-- end of container -->

    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
   
 </body>
</html>
