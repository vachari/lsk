<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>:: Shoperative | Edit Shipping Order ::</title>
    <link href="<?php echo CSS_PATH;?>bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>jquery-ui.css" rel="stylesheet" />
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
                         <li  > <a href="<?php echo base_url().'shipper/profile'; ?>"> My Profile</a></li>
                         <li> <a href="<?php echo base_url().'shipper/manage-shipping-cost'; ?>">Manage Shipping Cost</a></li>
                         <li class="active"> <a href=" <?php echo base_url() . 'shipper/manage-shipping-orders'; ?>"> Manage Shipping Orders  </a></li>
                         <li> <a href=" <?php echo base_url() . 'shipper/change-password'; ?>"> Change Password   </a></li>
                         <li> <a href=" <?php echo base_url() . 'shipper/logout'; ?>"> Logout   </a></li>
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
                   
                    <?php echo form_open('shipper/shipping-order-updating',array('id'=>'shipping_cost_form','name'=>'shipping_cost_form','method'=>'post'))?>
                    <input type="hidden" name="orderid" value="<?php echo $shipping_order->orderid; ?>">
                  
            
            <div class="col-md-6">
              <div class="form-group">
              <?php  $data1 = array(
                            'name' => 'shipping_ref_number',
                            'id' => 'shipping_ref_number',
                            'class' => 'form-control',
                            'placeholder' => 'Shipping Ref Number',
                            'value' => set_value('shipping_ref_number',$shipping_order->shipping_ref_number)
                        );
                        echo form_label('Shipping Reference Number')."<span style='color:red' id='shipping_ref_number_err'> *".form_error('shipping_ref_number')."</span>";
                        echo form_input($data1);
                        ?>
                        <span class="err_class" id="shipping_ref_number_err"></span>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <?php  $data2 = array(
                            'name' => 'shipper_name',
                            'id' => 'shipper_name',
                            'class' => 'form-control',
                            'placeholder' => 'Shipper Name',
                            'value' => set_value('shipper_name',$shipping_order->shipper_name)
                        );
                        echo form_label('Shipper Name')."<span style='color:red' id='shipper_name_err'> *".form_error('shipper_name')."</span>";
                        echo form_input($data2);
                        ?>
                        <span class="err_class" id="shipper_name_err"></span>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <?php $edd=''; 
                    $edate=strtotime($shipping_order->expected_delivery_date);
                    if($edate > 0){
                        $edd= date('m/d/Y',$edate);
                    }
               $data3 = array(
                            'name' => 'expected_delivery_date',
                            'id' => 'expected_delivery_date',
                            'class' => 'form-control',
                            'readonly' => 'readonly',
                            'placeholder' => 'Expected Delivery Date',
                            'value' => $edd
                        );
                        echo form_label('Expected Delivery Date')."<span style='color:red' id='expected_delivery_date_err'> *".form_error('expected_delivery_date')."</span>";
                        echo form_input($data3);
                        ?>
                        <span class="err_class" id="expected_delivery_date_err"></span>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <?php  $data4 = array(
                            'name' => 'lr',
                            'id' => 'lr',
                            'class' => 'form-control',
                            'placeholder' => 'LR',
                            'value' => set_value('lr',$shipping_order->lr)
                        );
                        echo form_label('LR')."<span style='color:red' id='lr_err'> ".form_error('lr')."</span>";
                        echo form_input($data4);
                        ?>
                        <span class="err_class" id="lr_err"></span>

              </div>
            </div>
                                                                    
                        <div class="form-group col-md-12 mrtop text-center">
                        <a href="<?php echo base_url().'shipper/manage-shipping-orders' ?>" class="btn btn-warning">Go Back</a>     
                           <input type="submit" id="btn_submit" name="btn_submit" value=" Submit " class="btn btn-profile">
                        </div>
                    <?php echo form_close() ?>
                    </div>
                </div><!-- end of 9 col -->
            </div><!-- end of container -->

    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>jquery-ui.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
 <script>
$('#expected_delivery_date').datepicker({minDate:0});
         $("#btn_submit").click(function(){
            var edd=$('#expected_delivery_date').val();
            var srn=$('#shipping_ref_number').val();
            var sn=$('#shipper_name').val();
            var lr=$('#lr').val();
            var str=true;
            $('#expected_delivery_date_err,#shipping_ref_number_err,#shipper_name_err,#lr_err').html('');
             $('#expected_delivery_date,#shipping_ref_number,#shipper_name,#lr').css('border','');
             if(srn==''|| srn==' '){
                str=false;
                $('#shipping_ref_number').css('border','1px solid red');
                $('#shipping_ref_number_err').css('color','red');
                $('#shipping_ref_number_err').html(' required');
            }
            if(sn==''|| sn==' '){
                str=false;
                $('#shipper_name').css('border','1px solid red');
                $('#shipper_name_err').css('color','red');
                $('#shipper_name_err').html(' required');
            } 
            if(edd==''|| edd==' '){
                str=false;
                $('#expected_delivery_date').css('border','1px solid red');
                $('#expected_delivery_date_err').css('color','red');
                $('#expected_delivery_date_err').html(' required');
            } 
            // if(lr==''|| lr==' '){
            //     str=false;
            //     $('#lr').css('border','1px solid red');
            //     $('#lr_err').css('color','red');
            //     $('#lr_err').html(' required');
            // }                             
             return str;
         });
    $(document).on("keyup",".number_class",function(){(isNaN($(this).val()))?$(this).val(''):'';});
$(".temp").delay(3000).fadeOut("slow");
</script>   
 </body>
</html>
