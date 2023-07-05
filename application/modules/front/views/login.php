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
    .text-danger {color: #ff0000 !important; }
	.orr{margin-top: 110%;}
	.mt16{margin-top:16px }
	.mt35{   margin-top: 35px;}
	 label{font-weight: 500;}
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
                        <li class="active">Signin - Signup</li>
                    </ol>
                </div>

            </div>
            <div class=" col-md-12  mrtop25"> 
             
                <div class="container bg_about box-sha">
                <?php if($this->session->flashdata('success')){ echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";}
                    if($this->session->flashdata('failed')){ echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>"; } 
                ?>
                   <div class="col-md-12">
                      
                        <div class="col-md-4 col-md-offset-4">
						  <h2 class="text-center mrtop25"> <b>Login</b>  </h2>
                            <?php echo form_open('front/Pages/login',array('id'=>'login_form','name'=>'login_form'))?>
                             <div class="form-group">
							 <label>Email</label>
                                <span id="email_login_error"> </span>
                                <input type="text" name="login_email" id="email_login" placeholder="Email" class="form-control" autocomplete="off" max="60" min="6" autofocus="autofocus">
                            </div>
                             <div class="form-group">
							  <label>Password</label>
                               <span id="password_login_error"> </span>
                                <input type="password" name="login_password" id="password_login" placeholder="Password" class="form-control" autocomplete="off" max="60" min="6">
                            </div>
                            <div class="form-group">
                               <a href="<?php echo base_url().'forgot-password' ?>" class="pull-right">Forgot Password?</a>
                            </div>
                            <div class="form-group col-md-10 text-center">
                                <input type="submit" name="btn_submit_login" value=" Login " class=" btn btn-md btn-success col-sm-8 col-sm-offset-4 mt16" id="btn_submit_login">
                            </div>
                            <?php echo form_close(); ?>
                            <div class="clearfix"></div>
                          <!--  <h5> ------- Or Continue as a  Guest User-------</h5>


                             <div class="form-group col-md-10 ">
                               <span id="email_guest_error"> </span>
                                <input type="text" name="guest_email" id="email_guest" placeholder="Email" class="form-control" autocomplete="off" max="60" min="6">
                            </div>
                             <div class="form-group col-md-10 ">
                                <span id="password_guest_error"> </span>
                                <input type="password" name="guest_password" id="password_guest" placeholder="Password" class="form-control" autocomplete="off" max="60" min="6">
                            </div>
                            
                            <div class="form-group col-md-10 text-center">
                                <input type="submit" name="btn_submit_guest" id="btn_submit_guest" value=" Submit " class="btn btn-md btn-success" >
                            </div>
                            <div class="form-group col-md-10 text-center">
                                <a href="<?php echo base_url().'vendor';?>" class="btn btn-md btn-danger" >Login as a Vendor</a><br><br>
                                <a href="<?php echo base_url().'shipper';?>" class="btn btn-md btn-danger" >Login as a Shipper</a>
                            </div>-->
                    </div>
					<!--<div class="col-md-2 text-center">-->
					 <!--<h3 class="orr">OR</h3>					</div>-->
					    <!-- <div class=" col-md-5">-->
                          
         <!--                   <h3 class="mrtop25">   Continue as a  Guest User  </h3>-->


         <!--                    <div class="form-group" style="    margin-top: 18px;">-->
							  <!--<label>Email</label>-->
         <!--                      <span id="email_guest_error"> </span>-->
         <!--                       <input type="text" name="guest_email" id="email_guest" placeholder="Email" class="form-control" autocomplete="off" max="60" min="6">-->
         <!--                   </div>-->
         <!--                    <div class="form-group">-->
							  <!--<label>Password</label>-->
         <!--                       <span id="password_guest_error"> </span>-->
         <!--                       <input type="password" name="guest_password" id="password_guest" placeholder="Password" class="form-control" autocomplete="off" max="60" min="6">-->
         <!--                   </div>-->
                            
         <!--                   <div class="form-group col-md-10 text-center">-->
         <!--                       <input type="submit" name="btn_submit_guest" id="btn_submit_guest" value=" Submit " class="btn btn-md btn-success mt35 col-sm-8 col-sm-offset-4" >-->
         <!--                   </div>-->
                        
         <!--           </div>-->
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
            var cpassword=$('#cpassword').val();
            var phone=$('#phone').val();
            var city=$('#city').val();
         
            var name_pattern=/^[a-zA-Z][a-zA-Z ]*$/;
            var email_pattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            var passwordpattern=/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
            var mobile_pattern = /^[6-9]+[0-9]{9}$/;
           
            var str=true;
            $('#name_error,#email_error,#password_error,#cpassword_error,#phone_error').html('');
             $('#names,#email,#password,#cpassword,#phone').css('border','');

            if(name==''|| name==' '){
                str=false;
                $('#names').css('border','1px solid red');
                $('#name_error').css('color','red');
                $('#name_error').html(' Please enter name');
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
            else if(!passwordpattern.test(password)){
                str=false;
                $('#password').css('border','1px solid red');
                $('#password_error').css('color','red');
                $('#password_error').html(' Please enter valid Password');
            }
            if(cpassword=='' || cpassword==' '){
                str=false;
                $('#cpassword').css('border','1px solid red');
                $('#cpassword_error').css('color','red');
                $('#cpassword_error').html(' Please enter confirm password');
            }
            if(password!='' && cpassword!='' && password!=cpassword){
                str=false;
                $('#cpassword').css('border','1px solid red');
                $('#cpassword_error').css('color','red');
                $('#cpassword_error').html(' Confirm password not matched');
            }
            if(city=='' || city==' '){
                str=false;
                $('#city').css('border','1px solid red');
                $('#city_error').css('color','red');
                $('#city_error').html(' Please enter city');
            }
            if(city!=''){
                if(!name_pattern.test(city)){
                    str=false;
                $('#city').css('border','1px solid red');
                $('#city_error').css('color','red');
                $('#city_error').html(' Please enter valid city');
                }
            }
          
             return str;
        });

         $("#btn_submit_login").click(function(){
            var email=$('#email_login').val();
            var password=$('#password_login').val();

            var email_pattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            var passwordpattern=/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
           
            var str=true;
            $('#email_login_error,#password_login_error').html('');
             $('#email_login,#password_login').css('border','');


           if(email==''|| email==' '){
                str=false;
                $('#email_login').css('border','1px solid red');
                $('#email_login_error').css('color','red');
                $('#email_login_error').html(' Please enter email');
            } 
            else if(!email_pattern.test(email)){
                str=false;
                $('#email_login').css('border','1px solid red');
                $('#email_login_error').css('color','red');
                $('#email_login_error').html(' Please enter valid email');
            }
           if(password==''|| password==' '){
                str=false;
                $('#password_login').css('border','1px solid red');
                $('#password_login_error').css('color','red');
                $('#password_login_error').html(' Please enter password');
            }
            else if(!passwordpattern.test(password)){
                str=false;
                $('#password_login').css('border','1px solid red');
                $('#password_login_error').css('color','red');
                $('#password_login_error').html(' Please enter valid password');
            }
          
             return str;
        });

         $("#btn_submit_guest").click(function(){
            var email=$('#email_guest').val();
            var password=$('#password_guest').val();

             email_pattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
             passwordpattern=/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
           
            var str=true;
            $('#email_guest_error,#password_guest_error').html('');
             $('#email_guest,#password_guest').css('border','');


           if(email==''|| email==' '){
                str=false;
                $('#email_guest').css('border','1px solid red');
                $('#email_guest_error').css('color','red');
                $('#email_guest_error').html(' Please enter email');
            } 
            else if(!email_pattern.test(email)){
                str=false;
                $('#email_guest').css('border','1px solid red');
                $('#email_guest_error').css('color','red');
                $('#email_guest_error').html(' Please enter valid email');
            }
           if(password==''|| password==' '){
                str=false;
                $('#password_guest').css('border','1px solid red');
                $('#password_guest_error').css('color','red');
                $('#password_guest_error').html(' Please enter password');
            }
            else if(!passwordpattern.test(password)){
                str=false;
                $('#password_guest').css('border','1px solid red');
                $('#password_guest_error').css('color','red');
                $('#password_guest_error').html(' Please enter valid password');
            }
          
             return str;
        });

    });
 $('.number-class').on('keyup',function(){(isNaN($(this).val()))?$(this).val(''):'';});
</script>
 </body>
</html>
