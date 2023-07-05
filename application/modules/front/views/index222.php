<?php //print_r($category);?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>:: Shoperative ::</title>
    <link href="<?php echo CSS_PATH; ?>megamenutwo.css" rel="stylesheet" />
<!--    <link href="<?php echo CSS_PATH; ?>megamenu.css" rel="stylesheet" />-->
     <script type="text/javascript" src="<?php echo JS_PATH;?>modernizr.js"></script>
    <link href="<?php echo CSS_PATH;?>bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>main.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>menu.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"  href="<?php echo CSS_PATH;?>bliss-slider.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>jquery-ui.css">
    
</head><!--/head-->
<body class="popup">
 <div id="open-popup" class="col-sm-4 col-sm-offset-4 no-pad" data-toggle="removepopup">

 <div class="modal-header" style="background-color: #ffa500 !important;color: #fff;border-radius:30px">
        <button type="button" class="close" style="color:#fff;opacity:1;margin-top:2px" data-dismiss="removepopup" aria-hidden="true"  onclick="disnone()">&times;</button>
        <h4 class="modal-title text-center">Welcome to Shoperative</h4>
      </div>
      <div class="col-sm-12">
        <div class="clearfix">&nbsp;</div>
          <h4 class="m-b-0 text-center">India’s National Network of Consumer Food Cooperatives. Together we hope to make this the most enjoyable, healthy, and rewarding experience for you and your loved ones...!</h4>
 <div class="clearfix">&nbsp;</div>
 <div class="text-center">
  <button class="btn btn-share btn-success"><a href="<?php echo base_url();?>register" style="color:#fff;"><span> Explore</span>&nbsp;</a></button>
 <button class="btn btn-share btn-success"><a href="<?php echo base_url();?>register" style="color:#fff;"><span> Join us</span>&nbsp;</a></button>
                        </div>
                        <div class="clearfix">&nbsp;</div>

    </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad ">
            <?php $this->load->view('includes/header.php');?>
            </div>
         <section> 
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full-bg martop85" >
            <div id="slider" class="slider-container">
        <ul class="slider">
            <li class="slide">
                <div class="slide-bg">
                    <img src="<?php echo IMG_PATH; ?>slider.jpg" alt="An Image" draggable="false" class="img-responsive">
                </div>
                <!-- <div class="slide-content">
                    <h2>FROM FIELD TO KITCHEN</h2>
                    <h1>BEST QUALITY RICE</h1>
                     <a href="#" class="btn btn-md btn-default">SHOP NOW&nbsp;&nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div> -->
            </li>
            <li class="slide">
                <div class="slide-bg">
                    <img src="<?php echo IMG_PATH; ?>slider_2.jpg" alt="An Image" draggable="false" class="img-responsive">
                </div>
                <!-- <div class="slide-content">
                    <h2>FROM FIELD TO KITCHEN</h2>
                    <h1>BEST QUALITY RICE</h1>
                     <a href="#" class="btn btn-md btn-default">SHOP NOW&nbsp;&nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div> -->
            </li>
            
        </ul>
        <div class="slider-controls">
            <div class="slide-nav">
                <a href="#" class="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                <a href="#" class="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            </div>
<!--
            <ul class="slide-list">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
            </ul>
-->
        </div>

    </div>
        </div>
<!--
        <div class="power-user text-center hidden-xs hidden-sm">
            
            <div class="input-group">
            <input type="text" class="form-control input-md" name="follower_search" id="follower_serach"  placeholder="Search products here" autocomplete="off" onkeyup="doSearchFollwers();"/>
            <span class="input-group-addon no-brd btn"><button><i class="glyphicon glyphicon-search" aria-hidden="true"></i></button></span>
             </div>
            <ul class="searchjx" >  
                 <div class="" id="followeresults"></div>  
            </ul>
        </div>
-->
     </section>
     <div class="container">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 futurs-mian hidden-xs hidden-sm">
            <div class="container-fluid no-pad">
                <ul class="list-inline">
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                             <span class="sid-head">Fast Delivery</span> 
                            <img src="<?php echo IMG_PATH; ?>fast-delivery.png" alt="Gharadhardelivery" />
                            <div class="clearfix">&nbsp;</div>
                           
                          
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                             <span class="sid-head"> Buy more,<br/> pay less </span> 
                            <img src="<?php echo IMG_PATH; ?>cart.png" style="    margin-top: -52px;margin-right: -47px;" alt="Gharadhardelivery" />
                            
                         
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                              <span class="sid-head"> Pay via <br/>card/cash</span>
                            <img src="<?php echo IMG_PATH; ?>pay-via.png" style="    margin-top: -52px;margin-right: -47px;"  alt="Gharadhardelivery" />
                            
                          
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                             <span class="sid-head"> Apply to became<br> &emsp; &emsp; &emsp; a Power user</span>
                            <img src="http://shoperative.in/assets/images/power-user.png" style="float: right;
    width: 56px;
    margin-top: -29px;" alt="Gharadhardelivery" />
                          
                            
                        </span>
                    </li>

                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right:none">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                                    <span class="sid-head"> Why became a<br> &emsp; &emsp; &emsp; Power user</span>
                            <img src="http://shoperative.in/assets/images/why-poweruser.png"  style="float: right;
    width: 56px;
    margin-top: -29px;" alt="Gharadhardelivery" />
                            
                    
                        </span>
                    </li>
                    
                </ul>
            </div>
       </div>
         
    </div>

<!-- vegetables start -->
     <div class="container-fluid">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 futurs-mian" style="padding-bottom: 0px;margin-top: -71%">
           <div class="clearfix">&nbsp;</div>
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padd" style="border-bottom: 2px solid #fff">
           <h3 style="    margin-bottom: 0px;text-align: left
"><span style="border-bottom:3px solid green" class="col-wh"> Fruits &emsp;  &emsp;  &emsp; </span></h3>
           </div>
            <div class="container-fluid no-pad">
        
                <ul class="list-inline">
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                    
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                  
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                  
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                   
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                   
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                 </ul>
            </div>
       </div>
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 futurs-mian" style="margin-top: -35%;padding-top: 0px">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padd" style="border-bottom: 2px solid #fff">
           <h3 style="    margin-bottom: 1px;text-align: left
"><span style="border-bottom:3px solid green"> Vegetables &emsp;  &emsp;  &emsp; </span></h3>
           </div>
        
        
                <ul class="list-inline">
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                    
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                  
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                  
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                   
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                   
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                 </ul>
            
       </div>
   </div>
<!-- vegetables end -->

<div class="container-fluid">
<div class="row">
    <div class="col-sm-6 no-padd">
      <img src="<?php echo IMG_PATH; ?>Ad-1.jpg" class="img-responsive">
    </div>
    <div class="col-sm-6 no-padd">
      <img src="<?php echo IMG_PATH; ?>Ad-2.jpg" class="img-responsive">
    </div>

    </div>
    </div>
<!--fruits section start-->
    
     <div class="container-fluid" style="background-color: #E4E4E4">
  
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 futurs-mian" style="margin-top: 0px;padding-top: 0px">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padd" style="border-bottom: 2px solid #fff">
           <h3 style="    margin-bottom: 1px;text-align: left
"><span style="border-bottom:3px solid green"> Vegetables &emsp;  &emsp;  &emsp; </span></h3>
           </div>
        
        
                <ul class="list-inline">
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                    
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                  
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                  
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                   
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                   
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                 </ul>
            
       </div>
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 futurs-mian" style="margin-top: 0px;padding-top: 0px">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padd" style="border-bottom: 2px solid #fff">
           <h3 style="    margin-bottom: 1px;text-align: left
"><span style="border-bottom:3px solid green"> Vegetables &emsp;  &emsp;  &emsp; </span></h3>
           </div>
        
        
                <ul class="list-inline">
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                    
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                  
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                  
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                   
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="http://shoperative.in/productDetails/1">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center" style="border-right: none">
                     <div class=" col-md-12  no-pad ">
                        
                   
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="http://shoperative.in/productDetails/1"><img src="<?php echo IMG_PATH; ?>cabbage_PNG8804.png" alt="Gharadhar product"></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="#">Rice 01   </a></h4>
                            <div class="clearfix"></div>
                            <p>Rice is the seed of the grass ...                            </p><div class="clearfix"></div>
                            <p class="price">
                               Rs. 100 <small class="font12">(kg)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                            <a href="#" class="btn btn-green n-b-r">
                            <span> &nbsp; Wishlist <i class="fa fa-heart" aria-hidden="true"></i></span>&nbsp; &nbsp;
                            </a> <a href="#" class="btn btn-red n-b-r">
                            <span> &nbsp; Share Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a> 
                            
			                             <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    </li>
                 </ul>
            
       </div>
   </div>
<!--fruits section end-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad futurs-mian1 hidden-xs hidden-sm">
            <div class="container-fluid">
                <ul class="list-inline">
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad text-uppercase">
                            <img src="<?php echo IMG_PATH; ?>f1.png" alt="Gharadhardelivery">
                             <div class="clearfix"></div>
                            free home delivery
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad text-uppercase">
                            <img src="<?php echo IMG_PATH; ?>f2.png" alt="Gharadhardelivery">
                             <div class="clearfix"></div>
                            organic
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad text-uppercase">
                            <img src="<?php echo IMG_PATH; ?>f3.png" alt="Gharadhardelivery">
                             <div class="clearfix"></div>
                            hand picked products
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad text-uppercase">
                            <img src="<?php echo IMG_PATH; ?>f4.png" alt="Gharadhardelivery">
                             <div class="clearfix"></div>
                            best quality
                        </span>
                    </li>
                     <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad text-uppercase">
                            <img src="<?php echo IMG_PATH; ?>f5.png" alt="Gharadhardelivery">
                             <div class="clearfix"></div>
                            easy returns
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad text-uppercase">
                            <img src="<?php echo IMG_PATH; ?>f6.png" alt="Gharadhardelivery">
                             <div class="clearfix"></div>
                            earn money
                        </span>
                    </li>
                    
                </ul>
            </div>
       </div>
    
       <div class="clearfix"></div>
<?php $this->load->view('includes/footer');?>   
    <!-- <script src="<?php echo JS_PATH;?>jquery.js"></script> -->
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>commoncart.js"></script>
      <script src="<?php echo JS_PATH;?>jquery-ui.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#slider").blissSlider({
                auto: 1,
                transitionTime: 500,
                timeBetweenSlides: 4000
            });
        });

        function doSearchFollwers()
        {
        var fsearch = $("#follower_serach").val()
        // alert(search);
        $.ajax({
         type: "POST",
         url:"<?php echo base_url();?>front/Ajax/getFollow/",
         data:{ 'search': fsearch },
         success:function(data){
             console.log(data);
          $("#followeresults").html(data);
        }});
         }

    </script>
 </body>
</html>
