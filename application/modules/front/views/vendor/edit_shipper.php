<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>:: Shoperative | Edit Shipper ::</title>
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
                         <li> <a href="<?php echo base_url().'vendor/products'; ?>">Create/Manage Products</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-inventory'; ?>">Product Inventory/Availability</a></li>
                         <li> <a href="<?php echo base_url().'vendor/assign-products-to-group'; ?>">Assign Products To Group</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-wise-prices'; ?>">Product Wise Prices</a></li>
                         <li> <a href="<?php echo base_url().'vendor/product-group-wise-prices'; ?>">Product Group Wise Prices</a></li>
                         <li  class="active"> <a href="<?php echo base_url().'vendor/manage-shippers'; ?>">Manage Shippers</a></li>
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
                        <h4> Edit Shipper </h4>
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
                   
                    <?php echo form_open('vendor/shipper-updating',array('id'=>'shipper_form','name'=>'shipper_form','method'=>'post')) ?>
                    <input type="hidden" name="shipper_id" value="<?php echo $shipper_details->shipper_id; ?>">
                    <div class="col-md-4">
              <div class="form-group">
            <?php   $data1 = array(
                            'name' => 'shipper_code',
                            'id' => 'shipper_code',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'placeholder' => 'Shipper Code (MaxLength 6)',
                            'value'=>set_value('shipper_code',$shipper_details->shipper_code),
                            'maxlength'=>6
                        );
                        echo form_label('Shipper Code'). "<span style='color:red' id='shipper_code_err';> *".form_error('shipper_code')."</span>";
                        echo form_input($data1);?>
                        <span class="err_class" id="shipper_code_err"></span>
                        
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
                            'placeholder' => 'Shipper Name',
                            'value' =>  set_value('shipper_name',$shipper_details->shipper_name)
                        );
                        echo form_label('Shipper Name')."<span style='color:red' id='shipper_name_err'> *".form_error('shipper_name')."</span>";
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
                            'autocomplete' => 'off',
                            'class' => 'form-control input-md floatlabel number_class',
                            'placeholder' => 'Mobile',
                            'value' =>  set_value('mobile',$shipper_details->mobile),
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
                            'value' =>  set_value('email',$shipper_details->email)
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
                            'value' =>  set_value('plot',$shipper_details->plot)

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
                            'value' =>  set_value('street',$shipper_details->street)

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
                            'value' =>  set_value('area',$shipper_details->area)

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
                            'value' =>  set_value('city',$shipper_details->city)

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
                            'value' =>  set_value('state',$shipper_details->state)

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
                            'value' =>  set_value('pincode',$shipper_details->pincode),
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
                            'value' =>  set_value('website',$shipper_details->website)

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
                            'value' =>  set_value('gst',$shipper_details->gst)

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
                            'value' =>  set_value('pan',$shipper_details->pan)

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
                            'value' =>  set_value('tds',$shipper_details->tds)

                        );
                        echo form_label('TDS') . "<span style='color:red' id='tds_err'> *".form_error('tds')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="tds_err"></span>
              </div>
            </div>                                                           
                        <div class="form-group col-md-12 mrtop text-center">
                        <a href="<?php echo base_url().'vendor/manage-shippers' ?>" class="btn btn-warning">Go Back</a>     
                           <input type="submit" id="btn_submit" name="btn_submit" value=" Update " class="btn btn-profile">
                        </div>
                    <?php echo form_close() ?>
                    </div>
                </div><!-- end of 9 col -->
            </div><!-- end of container -->

    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
 <script>
         $("#btn_submit").click(function(){
             var shipper_code=$('#shipper_code').val().trim();
            var shipper_name=$('#shipper_name').val();
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
            var namepattern=/^[A-Za-z][A-Za-z ]*$/;
             var panpattern=/^[A-Za-z0-9]*$/
            var mobilepattern = /^[6-9]{1}[0-9]{9}$/;
            var emailpattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            var pincodepatteren=/^[1-9][0-9]{5}$/;
            var gstpattern = /^([0][1-9]|[1-2][0-9]|[3][0-5])([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$/;

            var str=true;
            $('#shipper_code_err,#shipper_name_err,#mobile_err,#email_err,#city_err,#location_err,#address_error,#plot_err,#area_err,#state_err,#street_err,#pincode_err,#website_err,#gst_err,#pan_err,#tds_err').html('');
             $('#shipper_code,#shipper_name,#mobile,#email,#city,#location,#address,#plot,#area,#street,#state,#pincode,#website,#gst,#pan,#tds').css('border','');
             if(shipper_code==''|| shipper_code==' '){
                str=false;
                $('#shipper_code').css('border','1px solid red');
                $('#shipper_code_err').css('color','red');
                $('#shipper_code_err').html(' required');
            }
            if(shipper_name==''|| shipper_name==' '){
                str=false;
                $('#shipper_name').css('border','1px solid red');
                $('#shipper_name_err').css('color','red');
                $('#shipper_name_err').html(' required');
            }
              if(shipper_name!="" && !namepattern.test(shipper_name)){
                str=false;
                $('#shipper_name').css('border','1px solid red');
                $('#shipper_name_err').css('color','red');
                $('#shipper_name_err').html(' invalid name');
                  }
            if(mobile==''|| mobile==' '){
                str=false;
                $('#mobile').css('border','1px solid red');
                $('#mobile_err').css('color','red');
                $('#mobile_err').html(' required');
            }
            if(mobile!="" && !mobilepattern.test(mobile)){
                str=false;
                $('#mobile').css('border','1px solid red');
                $('#mobile_err').css('color','red');
                $('#mobile_err').html(' invalid mobile');
                  }            
           if(city==''|| city==' '){
                str=false;
                $('#city').css('border','1px solid red');
                $('#city_err').css('color','red');
                $('#city_err').html(' required');
            }
            if(city!="" && !namepattern.test(city)){
                str=false;
                $('#city').css('border','1px solid red');
                $('#city_err').css('color','red');
                $('#city_err').html(' invalid city');
                  }            
           if(plot==''|| plot==' '){
                str=false;
                $('#plot').css('border','1px solid red');
                $('#plot_err').css('color','red');
                $('#plot_err').html('required');
            }
           if(state==''|| state==' '){
                str=false;
                $('#state').css('border','1px solid red');
                $('#state_err').css('color','red');
                $('#state_err').html(' required');
            }
            if(state!="" && !namepattern.test(state)){
                str=false;
                $('#state').css('border','1px solid red');
                $('#state_err').css('color','red');
                $('#state_err').html('invalid state');
                  }             
           if(street==''|| street==' '){
                str=false;
                $('#street').css('border','1px solid red');
                $('#street_err').css('color','red');
                $('#street_err').html(' required');
            }              
           if(area==''|| area==' '){
                str=false;
                $('#area').css('border','1px solid red');
                $('#area_err').css('color','red');
                $('#area_err').html(' required');
            }
           if(pincode==''|| pincode==' '){
                str=false;
                $('#pincode').css('border','1px solid red');
                $('#pincode_err').css('color','red');
                $('#pincode_err').html(' required');
            }   
            if(pincode!="" && !pincodepatteren.test(pincode)){
                str=false;
                $('#pincode').css('border','1px solid red');
                $('#pincode_err').css('color','red');
                $('#pincode_err').html(' invalid pincode');
                  }                           
           if(website==''|| website==' '){
                str=false;
                $('#website').css('border','1px solid red');
                $('#website_err').css('color','red');
                $('#website_err').html(' required');
            }
           if(gst==''|| gst==' '){
                str=false;
                $('#gst').css('border','1px solid red');
                $('#gst_err').css('color','red');
                $('#gst_err').html(' required');
            }
         
           if(email==''){
                str=false;
                $('#email').css('border','1px solid red');
                $('#email_err').css('color','red');
                $('#email_err').html(' required');
            }
            if(email!="" && !emailpattern.test(email)){
                str=false;
                $('#email').css('border','1px solid red');
                $('#email_err').css('color','red');
                $('#email_err').html(' invalid email');
                  }             
           if(pan==''|| pan==' '){
                str=false;
                $('#pan').css('border','1px solid red');
                $('#pan_err').css('color','red');
                $('#pan_err').html(' required');
            }
           if(pan!='' && !panpattern.test(pan)){
                str=false;
                $('#pan').css('border','1px solid red');
                $('#pan_err').css('color','red');
                $('#pan_err').html(' invalid PAN');
            }            
           if(tds==''|| tds==' '){
                str=false;
                $('#tds').css('border','1px solid red');
                $('#tds_err').css('color','red');
                $('#tds_err').html(' required');
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

            $("[name^=vcpcode]").each(function(){
              if($(this).val() != '')
              {
             
                    $("[name^=vcpname]").each(function(){
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
                    $("[name^=vcpemail]").each(function(){
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
                    $("[name^=vcpmobile]").each(function(){
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
                   
              }
             
            });                              
          // if(email_check(email)==0){$('#email').focus().css('border','1px solid red'); $('#email_err').html(' Please enter Vehicle Number'); str=false;}

             return str;
         });
    $("#add_contact_person").click(function(){
      var data='<div class="col-md-12"><div class="col-md-2" style="padding-left: 0px;"><div class="form-group"><label>Person Code</label><span style="color:red;"><?php echo form_error("vcpmobile"); ?></span><input type="text" class="form-control" name="vcpcode[]" maxlength="3"></div></div><div class="col-md-3"><label>Person Name</label><span style="color:red;"><?php echo form_error("vcpname"); ?></span><input type="text" class="form-control" name="vcpname[]" autocomplete="off"></div><div class="col-md-3"><label>Person Email</label><span style="color:red;"><?php echo form_error("vcpemail"); ?></span><input type="text" class="form-control" name="vcpemail[]" autocomplete="off"></div><div class="col-md-3"><label>Person Mobile</label><span style="color:red;"><?php echo form_error("vcpmobile"); ?></span><input type="text" class="form-control number_class" name="vcpmobile[]" autocomplete="off" maxlength="10"></div><div class="col-md-1"><label style="visibility: hidden;"> Add</label><button class="btn btn-xs btn-danger remove_btn" type="button" onclick="remove()">Remove</button></div></div>';
      $("#wrapper").append(data);
    });
    $(document).on("keyup",".number_class",function(){(isNaN($(this).val()))?$(this).val(''):'';});
$('.mobile_class').on('keyup',function(){
  var mobile=$(this).val();
  (isNaN(mobile) && (mobile[0] > 5))?$(this).val(''):'';
  });
$(".temp").delay(3000).fadeOut("slow");
</script>   
 </body>
</html>
