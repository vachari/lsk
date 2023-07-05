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

</head>
<body class="popup" style="line-height: 22px;">
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
            <?php $this->load->view('includes/header.php');?>
    </div>
    <section> 
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full-bg text-justify martop150">

            <div class="col-md-12 "> 
               <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>"> Home </a></li>
                        <li class="active">Refund Policy</li>
                    </ol>
                </div>

            </div>
            <div class="col-md-12 "> 
                <div class="container "> <!-- bg_common -->
                    <div class="col-md-12  ">
                        <h2 class="text-center"><b> Refund Policy </b></h2>
                        <hr>
                        <ul>
                            <li>Once the cancellation is done by the Member, we initiate the refund within 3-4 working days.</li>
                            <li>The member is expected to receive the refund in his back account within 10 working days.</li>
                        </ul>
                    </div>
                    <div class="clearfix">&emsp;</div>
                </div>
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
