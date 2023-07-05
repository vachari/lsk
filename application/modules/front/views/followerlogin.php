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
            <?php $this->load->view('includes/header.php');?>
    </div>
    <section class="martop150"> 
        <div class=" col-md-12  full-bg ">

            <div class="col-md-12 "> 
                <!-- <h2 class="text-titel"> <b> SIgn up / Sign in</b></h2> -->
               <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>"> Home </a></li>
                        <li class="active">Follower Login</li>
                    </ol>
                </div>

            </div>
            <div class=" col-md-12 "> 
             
                <div class="container bg_about box-sha">
                <?php if($this->session->flashdata('success')){ echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";}
                    if($this->session->flashdata('failed')){ echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>"; } 
                ?>
                   
                    <div class="col-md-4 col-md-offset-4">
                        <h2 class="text-center col-md-10 "> <b>Follower Login</b>  </h2>
                        <div class=" col-md-12">
                            <?php echo form_open('front/Pages/followerLogin',array('id'=>'login_form','name'=>'login_form'))?>
                             <div class="form-group col-md-10 ">
                                <span id="email_login_error"> </span>
                                <input type="text" name="login_email" id="email_login" placeholder=" Enter your email" class="form-control" autocomplete="off" max="60" min="6">
                            </div>
                             <div class="form-group col-md-10 ">
                               <span id="password_login_error"> </span>
                                <input type="password" name="login_password" id="password_login" placeholder="Password" class="form-control" autocomplete="off" max="60" min="6">
                                 <p class="help-block">Note : Password sent to your email</p>
                            </div>
                           
                            <div class="form-group col-md-10 text-center">
                                <input type="submit" name="btn_submit_login" value=" Login " class=" btn btn-md btn-success" id="btn_submit_login">
                            </div>
                            <div class="clearfix"></div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </section>
    <?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
    <script src="<?php echo JS_PATH;?>jquery.js"></script>

   
<script type="text/javascript">

$(document).ready(function(){
         $("#btn_submit_register").click(function(){
            var name=$('#names').val();
            var email=$('#email').val();
            var password=$('#password').val();
            var phone=$('#phone').val();

         
             only_aplhabets_pattern=/^[a-zA-Z ]*$/;
             email_pattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
             // passwordpattern=/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
             mobile_pattern = /^[6-9]+[0-9]{9}$/;
           
            var str=true;
            $('#name_error,#email_error,#password_error,#phone_error').html('');
             $('#names,#email,#password,#phone').css('border','');

            if(name==''|| name==' '){
                str=false;
                $('#names').css('border','1px solid red');
                $('#name_error').css('color','red');
                $('#name_error').html(' Please enter  name');
            }
           
             
            if(phone==''|| phone==' '){
                str=false;
                $('#phone').css('border','1px solid red');
                $('#phone_error').css('color','red');
                $('#phone_error').html(' Please enter  mobile');
                
            }
            else if(!mobile_pattern.test(phone)){
                str=false;
                $('#phone').css('border','1px solid red');
                $('#phone_error').css('color','red');
                $('#phone_error').html(' Please enter valid mobile');
            }

           if(email==''|| email==' '){
                str=false;
                $('#email').css('border','1px solid red');
                $('#email_error').css('color','red');
                $('#email_error').html(' Please enter  email');
            } 
            else if(!email_pattern.test(email)){
                str=false;
                $('#email').css('border','1px solid red');
                $('#email_error').css('color','red');
                $('#email_error').html(' Please enter valid email');
            }
           if(password==''|| password==' '){
                str=false;
                $('#password').css('border','1px solid red');
                $('#password_error').css('color','red');
                $('#password_error').html(' Please enter password');
            }
       
          
             return str;
        });

        

       
 
</script>
 </body>
</html>
