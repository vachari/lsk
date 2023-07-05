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
            <?php  $this->load->view('vendor/includes/header.php');?>
    </div>
    <section class="martop150"> 
        <div class=" col-md-12 full-bg">

            <div class="col-md-12 "> 
               <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>"> Home </a></li>
                        <li class="active">Vendor Login</li>
                    </ol>
                </div>

            </div>
            <div class=" col-md-12 "> 
             
                <div class="container bg_about box-sha">
                <?php if($this->session->flashdata('success')){ echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";}
                    if($this->session->flashdata('failed')){ echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>"; } 
                ?>
                   
                    <div class="col-md-4 col-md-offset-4">
                        <h2 class="text-center col-md-12 "> <b>Vendor Login</b>  </h2>
                        <div class=" col-md-12">
                            <?php echo form_open('vendor/logging',array('id'=>'login_form','name'=>'login_form'))?>
                             <div class="form-group col-md-12 ">
                                <span id="email_login_error" style="color: red"><?php echo form_error('login_email'); ?></span>
                                <input type="text" name="login_email" id="login_email" placeholder=" Enter your email" class="form-control" autocomplete="off" max="60" min="6">
                            </div>
                             <div class="form-group col-md-12">
                               <span id="password_login_error" style="color: red"><?php echo form_error('login_password'); ?></span>
                                <input type="password" name="login_password" id="login_password" placeholder="Password" class="form-control" autocomplete="off" max="60" min="6">
                                 <p class="help-block">Note : Password sent to your email ID</p>
                                 <p class="pull-right"><a href="<?php echo base_url().'vendor/forgot-password' ?>"> Forgot Password ?</a></p>
                            </div>
                           
                            <div class="form-group col-md-12 text-center">
                                <input type="submit" name="btn_submit_login" value=" Login " class=" btn btn-md btn-success col-sm-6 col-sm-offset-3" id="btn_submit_login">

                            </div>
                            <div class="clearfix"></div>

                            <?php echo form_close() ?>
                    </div>

                </div>
               <!-- <div class="col-md-12">
                    <a href="<?php echo base_url().'shipper';?>" class="btn btn-md btn-danger pull-right" >Login as a Shipper</a>
                    <br><br>
                </div>   -->
                <br>
                <br>
            </div>
        </div>
    </section>
    <?php $this->load->view('vendor/includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
    <script src="<?php echo JS_PATH;?>jquery.js"></script>

   
<script type="text/javascript">

$(document).ready(function(){
         $("#login_form").submit(function(){
             var str=true;
            var email=$('#login_email').val();
            var password=$('#login_password').val();
            var email_pattern = /^[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/;
            var passwordpattern=/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
           
           
            $('#email_login_error,#password_login_error').html('');
             $('#login_email,#login_password').css('border','');

         
           if(email==''|| email==' '){
                str=false;
                $('#login_email').css('border','1px solid red');
                $('#email_login_error').css('color','red');
                $('#email_login_error').html(' Please enter email');
            } 
            if(email!=''){
                if(!email_pattern.test(email)){
                    str=false;
                    $('#login_email').css('border','1px solid red');
                    $('#email_login_error').css('color','red');
                    $('#email_login_error').html(' Please enter valid email');
                }
            }
           if(password==''|| password==' '){
                str=false;
                $('#login_password').css('border','1px solid red');
                $('#password_login_error').css('color','red');
                $('#password_login_error').html(' Please enter password');
            }
            if(password!=''){
                if(!passwordpattern.test(password)){
                    str=false;
                    $('#login_password').css('border','1px solid red');
                    $('#password_login_error').css('color','red');
                    $('#password_login_error').html(' Please enter valid password');
                }
            }

             return str;
        });
    });

</script>
 </body>
</html>
