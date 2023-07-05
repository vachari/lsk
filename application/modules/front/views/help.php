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
    input[type="number"]{width:60px;}

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
                    <div style="height:350px" class="hidden-xs"></div>
                

            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                <div class="col-md-12">
                   
                    <div class="col-md-12"> 
                        <div class="text-center"> 
                                <h2><i class="fa fa-comments fa-3x" aria-hidden="true" style="color:lightgray;"></i> &nbsp; Need Some Help ?</h2>
                        </div>

                <?php
                    if($this->session->flashdata('success'))
                    {
                        echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                        }
                    if($this->session->flashdata('failed'))
                    { 
                        echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                     } 
                ?>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <form method="post"> 
                                <div class="form-group col-md-8">
                                    <label>Subject <span id="subject_error" class="text-red"> * <?php echo form_error('subject');?> </span></label>
                                    <input type="search" id="subject" class="form-control" name="subject" placeholder="Subject">
                                </div>
                                <div class="clearfix"></div>
                                 <div class="form-group col-md-8">
                                    <label>Message  <span id="message_error" class="text-red"> * <?php echo form_error('message');?> </span></label>
                                    <textarea name="message" id="message" cols="30" rows="5"  placeholder="Message" class="form-control"></textarea>
                                </div>
                               
                         
                            <div class="col-md-8 text-center ">
                                <div class="form-group ">
                                    <input type="submit" name="submit" id="btnSubmit" class="btn btn-md btn-danger pull-right" value=" Request Support ">
                                </div>
                            </div>
                             </form>
                        </div>
                    </div>
                </div>

                <!-- end of the edit profile -->
                <div class="col-md-12 mrtop">
                    <div class="col-md-4 mrtop text-center bord" >
                        <i class="fa fa-question fa-2x icon-rou" aria-hidden="true" style="">  </i>
                        <h4 class="mrtop"><b>FAQs</b></h4>
                        <div class="divline"></div>
                        <p class="mrtop"> Reqular Questions & answers are presented in the Faqs area.</p>
                    </div>
                     <div class="col-md-4 mrtop text-center bord">
                        <i class="fa fa-book fa-2x icon-rou" aria-hidden="true" style="">  </i>
                        <h4 class="mrtop"><b>Knowledge</b></h4>
                        <div class="divline"></div>
                        <p class="mrtop"> Reqular Questions & answers are presented in the Faqs area.</p>
                    </div>
                     <div class="col-md-4 mrtop text-center bord">
                            <i class="fa fa-comment fa-2x icon-rou" aria-hidden="true" style="">  </i>
                            <h4 class="mrtop"><b>Support Forum</b></h4>
                            <div class="divline"></div>
                            <p class="mrtop"> Reqular Questions & answers are presented in the Faqs area.</p>
                </div>
               
            </div><!-- end of 9 col -->
            
        </div>
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
    $('#btnSubmit').on('click',function(){
      var  subject=$('#subject').val();
      var  message=$('#message').val();
          var pincodepatteren=/^[0-9]{6}$/;

         var str=true;
            $('#subject_error,#message_error').html('');
             $('#subject,#message').css('border','');

             if(subject==''|| subject==' '){
                str=false;
                $('#subject').css('border','1px solid red');
                $('#subject_error').html(' * Please enter subject');
            }


            if(message==''|| message==''){
                str=false;
                $('#message').css('border','1px solid red');
                $('#message_error').html(' * Please enter message');
            }

     return str;

    });
</script>