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

</head><!--/head-->

<body class="popup" class="text-justify">
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
            <?php $this->load->view('includes/header.php');?>
    </div>
    <section> 
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full-bg martop150">

            <div class="col-md-12 "> 
                <!-- <h2 class="text-center text-titel"> <b> Faq </b></h2> -->
               <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>"> Home </a></li>
                        <li class="active">Faq</li>
                    </ol>
                </div>

            </div><p class="mrtop100"><br></p>
            <div class="col-md-12 "> 
                <div class="container  ">
                    <div class="col-md-12 ">
                    <div class=" ">
                     
                        <h2> <b> Frequently </b> Asked  Questions </h2>
                        <p class="text-gray mrtop font16 text-justify"> 
                             It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                        </p>
                        </div>

                    </div>
                    <div class="col-sm-12 mrtop"></div>
                    <div class="col-md-4 "> 
                        <h1  class="head_faq text-green" > <i class="fa fa-pie-chart"  ></i></h1>
                        <h3> <b>Knowledge Base</b> </h3>
                       <?php if(isset($faq_res1)) { foreach($faq_res1 as $faq1){
                         echo '<p><b>'.$faq1->query.'</b></p><p  class="text-gray text-justify font16">'.$faq1->description. '</p><br>';
                        }} ?> 
                    </div>
                    <div class="col-md-4"> 
                    <h1 class="head_faq text-orange"> <i class="fa fa-support"  ></i></h1>
                        <h3> <b>About Power User  </b></h3>
                       <?php if(isset($faq_res2)) { foreach($faq_res2 as $faq2){
                         echo '<p><b>'.$faq2->query.'</b></p><p  class="text-gray text-justify font16">'.$faq2->description. '</p><br>';
                        } }?>                        
                       
                    </div>
                    <div class="col-md-4"> 
                    <h1  class="head_faq"> <i class="fa fa-calendar"  ></i></h1>
                        <h3> <b>Support Forum </b></h3>
                        <?php if(isset($faq_res3)) { foreach($faq_res3 as $faq3){
                         echo '<p><b>'.$faq3->query.'</b></p><p  class="text-gray text-justify font16">'.$faq3->description. '</p><br>';
                        }} ?>  
                    </div>
                    
                    
                   
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
