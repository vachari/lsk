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
                        <li class="active">Shipper Forgot Password</li>
                    </ol>
                </div>

            </div>
            <div class=" col-md-12 "> 
             
                <div class="container bg_about box-sha">
                <?php if($this->session->flashdata('success')){ echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";}
                    if($this->session->flashdata('failed')){ echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>"; } 
                ?>
                   
                    <div class="col-md-6 col-md-offset-3">
                        <h3 class="text-center col-md-10 "> <b>Shipper Forgot Password</b>  </h3>
                        <div class=" col-md-12">
                            <?php echo form_open('shipper/sending-reset-password-link',array('id'=>'forgot_form','name'=>'forgot_form'))?>
                             <div class="form-group col-md-10 ">
                                <span id="email_error" style="color: red"><?php echo form_error('email'); ?></span>
                                <input type="text" name="email" id="email" placeholder=" Enter your email" class="form-control" autocomplete="off" max="60" min="6">
                            </div>
                             
                           
                            <div class="form-group col-md-10 text-center">
                                <a href="<?php echo base_url().'shipper/login' ?>" class="btn btn-md btn-warning"> Login </a>
                                <input type="submit" name="btn_submit_login" value=" Submit " class=" btn btn-md btn-success" id="btn_submit_login">
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
         $("#forgot_form").submit(function(){
             var str=true;
            var email=$('#email').val();
            var email_pattern = /^[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/;
           
           
            $('#email_error').html('');
             $('#email,#login_password').css('border','');

         
           if(email==''|| email==' '){
                str=false;
                $('#email').css('border','1px solid red');
                $('#email_error').css('color','red');
                $('#email_error').html(' Please enter email');
            } 
            if(email!=''){
                if(!email_pattern.test(email)){
                    str=false;
                    $('#email').css('border','1px solid red');
                    $('#email_error').css('color','red');
                    $('#email_error').html(' Please enter valid email');
                }
            }
           

             return str;
        });
    });

</script>
 </body>
</html>
