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
    .text-danger {
    color: #ff0000 !important;
    }
    </style>     
</head><!--/head-->

<body class="popup">

    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
            <?php  $this->load->view('shipper/includes/header.php');?>
    </div>
    <section class="martop150"> 
        <div class=" col-md-12 full-bg">

            <div class="col-md-12 "> 
               <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>"> Home </a></li>
                        <li class="active">Shipper Reset Password</li>
                    </ol>
                </div>
            </div>
            <div class=" col-md-12 "> 
             
                <div class="container bg_about box-sha">
                <?php if($this->session->flashdata('success')){ echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";}
                    if($this->session->flashdata('failed')){ echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>"; } 
                ?>
                   
                    <div class="col-md-4 col-md-offset-4">
                        <h4 class="text-center col-md-10 "> <b>Shipper Reset Password </b>  </h4>
                        <div class=" col-md-12">
                            <?php echo form_open('shipper/resetting-password',array('id'=>'reset_form','name'=>'reset_form'))?>
                            <input type="hidden" name="verificationcode" value="<?php echo set_value('verificationcode',$this->uri->segment(2,0)) ?>">
                            <div class="form-group col-md-10">
                               <span id="new_password_error" style="color: red"><?php echo form_error('new_password'); ?></span>
                                <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control" autocomplete="off" max="20" min="6">
                            </div>
                            <div class="form-group col-md-10">
                               <span id="confirm_password_error" style="color: red"><?php echo form_error('confirm_password'); ?></span>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control" autocomplete="off" max="20" min="6">
                            </div>
                           
                            <div class="form-group col-md-10 text-center">
                                <input type="submit" name="btn_submit_reset" value=" Submit " class=" btn btn-md btn-success" id="btn_submit_reset">
                            </div>
                            <div class="clearfix"></div>
                            <?php echo form_close() ?>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </section>
    <?php $this->load->view('shipper/includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
    <script src="<?php echo JS_PATH;?>jquery.js"></script>

   
<script type="text/javascript">

$(document).ready(function(){
         $("#reset_form").submit(function(){
             var str=true;
            var password=$('#new_password').val();
            var confirmpassword=$('#confirm_password').val();
            var passwordpattern=/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
            $('#new_password_error').html('');
            $('#new_password').css('border','');
            $('#confirm_password_error').html('');
            $('#confirm_password').css('border','');

           if(password==''|| password==' '){
                str=false;
                $('#new_password').css('border','1px solid red');
                $('#new_password_error').css('color','red');
                $('#new_password_error').html(' Please enter password');
            }
            if(password!=''){
                if(!passwordpattern.test(password)){
                    str=false;
                    $('#new_password').css('border','1px solid red');
                    $('#new_password_error').css('color','red');
                    $('#new_password_error').html(' Please enter valid password');
                }
            }
            if(confirmpassword==''|| confirmpassword==' '){
                str=false;
                $('#confirm_password').css('border','1px solid red');
                $('#confirm_password_error').css('color','red');
                $('#confirm_password_error').html(' Please enter confirm password');
            }
            if(confirmpassword!='' && password!=''){
                if(password!=confirmpassword){
                    str=false;
                    $('#confirm_password').css('border','1px solid red');
                    $('#confirm_password_error').css('color','red');
                    $('#confirm_password_error').html('Password not matched');
                }
            }

             return str;
        });
    });

</script>
 </body>
</html>
