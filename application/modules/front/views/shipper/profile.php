
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
            <?php  $this->load->view('shipper/includes/header.php');?>
    </div>

    <section>
        <div class="container martop150">
            <div class="col-md-3 bg_profile ">
                <div class="col-xs-12 mrtop">
                     <ul class="profile-side-bar">
                        <li> <a href=" <?php echo base_url().'shipper/dashboard'; ?>"> Dashboard</a></li>
                         <li class="active"> <a href="<?php echo base_url().'shipper/profile'; ?>"> My Profile</a></li>
                         <li> <a href="<?php echo base_url().'shipper/manage-shipping-cost'; ?>">Manage Shipping Cost</a></li>
                         <li> <a href=" <?php echo base_url() . 'shipper/manage-shipping-orders'; ?>"> Manage Shipping Orders  </a></li>
                         <li> <a href=" <?php echo base_url() . 'shipper/change-password'; ?>"> Change Password   </a></li>
                         <li> <a href=" <?php echo base_url() . 'shipper/logout'; ?>"> Logout   </a></li>
                     </ul>
                </div>
                 <div style="height:300px" class="hidden-xs"></div>
                

            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                
                <div class="col-md-12">
                    <div class="header-title">
                        <h4> Profile </h4>
                        <hr style="margin-top: -5px;"> 
                    </div>
                   
                        <div class="col-md-4">
              <div class="form-group">
            <?php   $data1 = array(
                            'name' => 'shipper_code',
                            'id' => 'shipper_code',
                            'maxlength' => 6,
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Shipper Code',
                            'disabled' => 'disabled',
                            'value'=>$shipper_details->shipper_code
                        );
                        echo form_label('Shipper Code'). "<span style='color:red' id='shipper_code_err';> *".form_error('shipper_code')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="shipper_code_err"></span>
                        <?php
                       
                        ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <?php  $data2 = array(
                            'name' => 'shipper_name',
                            'id' => 'shipper_name',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Name',
                            'disabled' => 'disabled',
                            'value'=>$shipper_details->shipper_name
                            
                        );
                        echo form_label('Name')."<span style='color:red' id='shipper_name_err'> *".form_error('shipper_name')."</span>";
                        echo form_input($data2);
                        ?>
                        <span class="err_class" id="shipper_name_err"></span>

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
                            'value'=>$shipper_details->mobile
                           

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
                            'value'=>$shipper_details->email
                            
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
                            'value' =>  $shipper_details->plot

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
                            'value' =>  $shipper_details->street

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
                            'value' =>  $shipper_details->area

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
                            'value'=>$shipper_details->city
                            

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
                            'value' =>  $shipper_details->state

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
                            'value' =>  $shipper_details->pincode

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
                            'value' =>  $shipper_details->website

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
                            'value' =>  $shipper_details->gst

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
                            'value' =>  $shipper_details->pan

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
                            'value' =>  $shipper_details->tds

                        );
                        echo form_label('TDS') . "<span style='color:red' id='tds_err'> *".form_error('tds')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="tds_err"></span>
              </div>
            </div>  
                          
                        <div class="form-group col-md-12 mrtop text-center"> 
                        <a href="<?php echo base_url().'shipper/profile-update' ?>" class="btn btn-warning">Update Profile</a>   
                          
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
