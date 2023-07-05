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
    <style> 
    input[type="submit"]{border-radius:40px !important;padding:5px 30px;}

    </style>
</head><!--/head-->

<body class="popup" >
    <div class="clearfix"></div>
    <div class="col-md-12  no-pad">
            <?php $this->load->view('includes/header.php');?>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>

    <section>
        <div class="container martop150">
            <div class="col-md-3 bg_profile ">
                <div class="col-xs-12 mrtop">
                    <?php $this->load->view('includes/sidebar.php');?>
                </div>
                    <div style="height:500px" class="hidden-xs"></div>
            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                <div class="col-md-12">
                     <div class="col-md-12"> 
                    <div class="col-md-10 header-title mrtop">
                        <h4> Add  Followers </h4>
                        <hr style="margin-top:-5px;"> 
                    </div>
                    <div class="col-md-2  header-title mrtop">
                        <a href="<?php echo base_url().'viewFollowers'; ?>" class="btn btn-md btn-primary"> Back </a>
                    </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12"> 
                    <?php
                    if($this->session->flashdata('success'))
                    {
                        echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                        }
                    if($this->session->flashdata('failed'))
                    { 
                        echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                     } ?>
                   <?php $form_attributes = array('id' => 'profile', 'editProfile' => 'edit'); 
                           echo form_open('',$form_attributes);?>
                   
                        <div class="form-group col-md-8">
                            <label> Name <span id="name_error" class="text-red"> * <?php echo form_error('user_name');?> </span> </label>
                            <input type="text" name="user_name" id="user_name"  class="form-control" placeholder="Name" value="<?php ?>" autocompleate="off">
                        </div>
                        <div class="form-group col-md-8">
                            <label> Email <span id="email_error" class="text-red"> * <?php echo form_error('user_email');?> </span> </label>
                           <input type="text" value="<?php  ?>" placeholder="Email"  class="form-control " id="user_email" name="user_email" autocompleate="off">
                        </div>
                        <div class="form-group col-md-8">
                            <label> Mobile No. <span id="mobile_error" class="text-red"> * <?php echo form_error('user_mobile');?> </span> </label>
                            <input type="text" name="user_mobile" id="user_mobile"  class="form-control" placeholder="Mobile" value="<?php  ?>"  maxlength="10" autocompleate="off"ss>
                        </div>
                        <div class="col-md-8 no-pad form-group">
                             <div class="col-md-12">
                                <label>City <span id="city_error" class="text-red">  * <?php echo form_error('city');?> </span> </label>
                                <input type="text" name="city" id="city"  class="form-control" placeholder="City" value="<?php  ?>" autocompleate="off" >
                            </div>
                         
                        </div> 
                     
                        <div class="form-group col-md-8 mrtop">
                           <input type="submit" name="submit" id="btn_submit" value=" Submit " class="btn btn-profile">
                        </div>
                    </form>
                    </div>
                </div>
                <!-- end of the edit profile -->
               
            </div><!-- end of 9 col -->
            
        </div>

    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
   
 </body>
</html>
<script type="text/javascript">
     $("#btn_submit").click(function(){
            var name=$('#user_name').val();
            var mobile=$('#user_mobile').val();
            var city=$('#city').val();
            var email=$('#user_email').val();
             only_aplhabets_pattern=/^[a-zA-Z ]*$/;
             email_pattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
             passwordpattern=/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
             mobile_pattern = /^[6-9]+[0-9]{9}$/;
           
            var str=true;
            $('#name_error,#email_error,city_error,#mobile_error').html('');
             $('#user_name,#city,#user_email,#user_mobile').css('border','');

            if(name==''|| name==' '){
                str=false;
                $('#user_name').css('border','1px solid red');
                $('#name_error').css('color','red');
                $('#name_error').html(' Please enter name');
            }
            if(city==''|| city==' '){
                str=false;
                $('#city').css('border','1px solid red');
                $('#city_error').css('color','red');
                $('#city_error').html(' Please enter city');
            }
          
            
            if(email==''|| email==' '){
                str=false;
                $('#user_email').css('border','1px solid red');
                $('#email_error').css('color','red');
                $('#email_error').html(' Please enter  email');
            } else if(!email_pattern.test(email)){
                str=false;
                $('#user_email').css('border','1px solid red');
                $('#email_error').css('color','red');
                $('#email_error').html(' Please enter valid Email');
            }

            if(mobile==''|| mobile==' '){
                str=false;
                $('#user_mobile').css('border','1px solid red');
                $('#mobile_error').css('color','red');
                $('#mobile_error').html(' Please enter  mobile');
                
            }
            else if(!mobile_pattern.test(mobile)){
                str=false;
                $('#user_mobile').css('border','1px solid red');
                $('#mobile_error').css('color','red');
                $('#mobile_error').html(' Please enter valid mobile');
            }

           
          
             return str;
        });


     
</script>