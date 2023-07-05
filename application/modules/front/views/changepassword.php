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
                 <div style="height:300px" class="hidden-xs"></div>                
            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                
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

                    <div class="header-title mrtop">
                        <h4> Change Password </h4>
                        <hr style="margin-top: -5px;"> 
                    </div>
                    <div class=""> 
                    <form method="post" >
                        <div class="form-group col-md-8">
                            <label> Old Password  <span id="old_password_error" class="text-red"> * <?php echo form_error('old_password');?> <?php if(isset($ope)){echo $ope;} ?> </span></label>
                            <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Old Password">
                        </div>
                        <div class="form-group col-md-8">
                            <label>New Password <span id="new_password_error" class="text-red"> * <?php echo form_error('new_password');?> </span></label>
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder=" New Password">
                        </div>
                       <div class="form-group col-md-8">
                            <label> Confirm Password <span id="confirm_password_error" class="text-red"> * <?php echo form_error('confirm_password');?> </span></label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                        </div>
                       
                        </div>  
                        <div class="form-group col-md-8 mrtop">    
                           <input type="submit" id="btn_submit" name="btn_submit" value=" Change " class="btn btn-profile">
                        </div>
                    </form>
                    </div>
                </div>
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
            var old=$('#old_password').val();
            var newpass=$('#new_password').val();
            var confirm=$('#confirm_password').val();
           
            // alert(old);
           
            var str=true;
            $('#old_password_error,#new_password_error,#confirm_password_error').html('');
             $('#old_password,#new_password,#confirm_password').css('border','');

            if(old==''|| old==' '){
                str=false;
                $('#old_password').css('border','1px solid red');
                $('#old_password_error').html('* Please enter old password');
            }
            
           if(newpass==''|| newpass==' '){
                str=false;
                $('#new_password').css('border','1px solid red');
                $('#new_password_error').html('* Please enter  new password');
            }
            
            if(confirm ==''|| confirm==' '){
                str=false;
                $('#confirm_password').css('border','1px solid red');
                $('#confirm_password_error').html('* Please enter  confirm password');
            }else if(newpass != confirm){
                str=false;

                $('#confirm_password').css('border','1px solid red');
                $('#confirm_password_error').html('* Both passwords should match');
            }

             return str;
        });


</script>