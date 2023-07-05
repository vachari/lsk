<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>:: Shoperative | Edit Shipping Cost ::</title>
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
                         <li> <a href="<?php echo base_url().'vendor/manage-shippers'; ?>">Manage Shippers</a></li>
                         <li class="active"> <a href="<?php echo base_url().'vendor/manage-shipping-cost'; ?>">Manage Shipping Cost</a></li>
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
                        <h4> Edit Shipping Cost </h4>
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
                   
                    <?php echo form_open('vendor/shipping-cost-updating',array('id'=>'shipping_cost_form','name'=>'shipping_cost_form','method'=>'post'))?>
                    
                    <div class="col-md-4">
              <div class="form-group">
           <label>Shipper</label><span class="err_class" id="shipper_err" style="color:red;">*</span>
                        <input type="hidden" name="shipping_cost_id" value="<?php echo $shipping_cost->shipping_cost_id; ?>">
                        <select name='shipper' id='shipper' class ='selectpicker form-control input-md select2 form-control' placeholder= 'Select Shipper'>
                            <option value=''>Select Shipper</option>
                            <?php
                                $shipper_res = json_decode($shippers);
                                if ($shipper_res->code == SUCCESS_CODE) {
                                    foreach ($shipper_res->result as $shipper) {
                                        ?>
                                        <option value="<?php echo $shipper->shipper_id; ?>" <?php if($shipper->shipper_id==$shipping_cost->shipper_id) echo 'selected'; echo set_select('shipper',$shipper->shipper_id); ?>><?php echo ucfirst($shipper->shipper_name).' ('.$shipper->shipper_code.' )'; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <?php  $data2 = array(
                            'name' => 'distance_range_from',
                            'id' => 'distance_range_from',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control number_class',
                            'placeholder' => 'Distance Range From',
                            'value' =>  set_value('distance_range_from',$shipping_cost->distance_range_from)
                        );
                        echo form_label('Distance Range From (KM)')."<span style='color:red' id='distance_range_from_err'> *".form_error('distance_range_from')."</span>";
                        echo form_input($data2);
                        ?>
                        <span class="err_class" id="distance_range_from_err"></span>

              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <?php  $data3 = array(
                            'name' => 'distance_range_to',
                            'id' => 'distance_range_to',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control number_class',
                            'placeholder' => 'Distance Range To',
                            'value' =>  set_value('distance_range_to',$shipping_cost->distance_range_to)
                        );
                        echo form_label('Distance Range To (KM)')."<span style='color:red' id='distance_range_to_err'> *".form_error('distance_range_to')."</span>";
                        echo form_input($data3);
                        ?>
                        <span class="err_class" id="distance_range_to_err"></span>

              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <?php
                        $data4 = array(
                            'name' => 'cost_per_kg',
                            'id' => 'cost_per_kg',
                            'maxlength' => '40',
                            'autocomplete' => 'off',
                            'class' => 'form-control number_class',
                            'placeholder' => 'Cost Per KG',
                            'value' =>  set_value('cost_per_kg',$shipping_cost->cost_per_kg)
                        );
                        echo form_label('Cost Per KG'). "<span style='color:red' id='cost_per_kg_err'> *".form_error('cost_per_kg')."</span>"?>
                       <?php echo form_input($data4); ?>
                        <span class="err_class" id="cost_per_kg_err"></span>

                       </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
               <?php $data5 = array(
                            'name' => 'std_delivery_days_from_order_date',
                            'id' => 'std_delivery_days_from_order_date',
                            'autocomplete' => 'off',
                            'class' => 'form-control number_class',
                            'placeholder' => 'Standard Delivery Days From Order Date',
                            'value' =>  set_value('std_delivery_days_from_order_date',$shipping_cost->std_delivery_days_from_order_date)

                        );
                        echo form_label('Standard Delivery Days From Order Date') . "<span style='color:red' id='std_delivery_days_from_order_date_err'> *".form_error('std_delivery_days_from_order_date')."</span>";
                        echo form_input($data5);
                        ?>
                        <span class="err_class" id="std_delivery_days_from_order_date_err"></span>
              </div>
            </div>   
            <div class="col-md-12">
              <div class="form-group">
               <?php $data6 = array(
                            'name' => 'special_conditions',
                            'id' => 'special_conditions',
                            'autocomplete' => 'off',
                            'class' => 'form-control',
                            'rows' => 2,
                            'style' => 'resize:none',
                            'placeholder' => 'Special Conditions',
                            'value' =>  set_value('special_conditions',$shipping_cost->special_conditions)

                        );
                        echo form_label('Special Conditions (If Any)') . "<span style='color:red' id='special_conditions_err'> ".form_error('special_conditions')."</span>";
                        echo form_textarea($data6);
                        ?>
                        <span class="err_class" id="special_conditions_err"></span>
              </div>
            </div> 
                                                                    
                        <div class="form-group col-md-12 mrtop text-center">
                        <a href="<?php echo base_url().'vendor/manage-shipping-cost' ?>" class="btn btn-warning">Go Back</a>     
                           <input type="submit" id="btn_submit" name="btn_submit" value=" Submit " class="btn btn-profile">
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
            var shipper=$('#shipper').val();
            var distance_range_from=$('#distance_range_from').val().trim();
            var distance_range_to=$('#distance_range_to').val().trim();
            var cost_per_kg=$('#cost_per_kg').val().trim();
            var std_del_days=$('#std_delivery_days_from_order_date').val().trim();

            var str=true;
            $('#shipper_err,#distance_range_from_err,#distance_range_to_err,#cost_per_kg_err,#std_delivery_days_from_order_date_err').html('');
             $('#shipper,#distance_range_from,#distance_range_to,#cost_per_kg,#std_delivery_days_from_order_date').css('border','');
             if(shipper==''|| shipper==' '){
                str=false;
                $('#shipper').css('border','1px solid red');
                $('#shipper_err').css('color','red');
                $('#shipper_err').html(' required');
            }
            if(distance_range_from==''|| distance_range_from==' '){
                str=false;
                $('#distance_range_from').css('border','1px solid red');
                $('#distance_range_from_err').css('color','red');
                $('#distance_range_from_err').html(' required');
            }
            if(distance_range_to==''|| distance_range_to==' '){
                str=false;
                $('#distance_range_to').css('border','1px solid red');
                $('#distance_range_to_err').css('color','red');
                $('#distance_range_to_err').html(' required');
            }         
           if(cost_per_kg==''|| cost_per_kg==' '){
                str=false;
                $('#cost_per_kg').css('border','1px solid red');
                $('#cost_per_kg_err').css('color','red');
                $('#cost_per_kg_err').html(' required');
            }          
           if(std_del_days==''|| std_del_days==' '){
                str=false;
                $('#std_delivery_days_from_order_date').css('border','1px solid red');
                $('#std_delivery_days_from_order_date_err').css('color','red');
                $('#std_delivery_days_from_order_date_err').html(' required');
            }                              
             return str;
         });
    $(document).on("keyup",".number_class",function(){(isNaN($(this).val()))?$(this).val(''):'';});
$(".temp").delay(3000).fadeOut("slow");
</script>   
 </body>
</html>
