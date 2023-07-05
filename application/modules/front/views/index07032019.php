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
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full-bg martop150" >
            <div id="slider" class="slider-container">
        <ul class="slider">
            <li class="slide">
                <div class="slide-bg">
                    <img src="<?php echo IMG_PATH;?>b2.jpg" alt="An Image" draggable="false" class="img-responsive">
                </div>
                <!-- <div class="slide-content">
                    <h2>FROM FIELD TO KITCHEN</h2>
                    <h1>BEST QUALITY RICE</h1>
                     <a href="#" class="btn btn-md btn-default">SHOP NOW&nbsp;&nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div> -->
            </li>
            <li class="slide">
                <div class="slide-bg">
                    <img src="<?php echo IMG_PATH;?>b1.jpg" alt="An Image" draggable="false" class="img-responsive">
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
            <ul class="slide-list">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
            </ul>
        </div>

    </div>
        </div>
        <div class="power-user text-center hidden-xs hidden-sm">
            
            <div class="input-group">
            <input type="text" class="form-control input-md" name="follower_search" id="follower_serach"  placeholder="Search products here" autocomplete="off" onkeyup="doSearchFollwers();"/>
            <span class="input-group-addon no-brd btn"><button><i class="glyphicon glyphicon-search" aria-hidden="true"></i></button></span>
             </div>
            <ul class="searchjx" >  
                 <div class="" id="followeresults"></div>  
            </ul>
        </div>
     </section>
     
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 futurs-mian hidden-xs hidden-sm">
            <div class="container-fluid no-pad">
                <ul class="list-inline">
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                            <img src="<?php echo IMG_PATH;?>delivery.png" alt="Shoperative Delivery" />
                             <div class="clearfix"></div>
                            Fast Delivery
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                            <img src="<?php echo IMG_PATH;?>home-delivery.png" alt="Shoperative Delivery" />
                             <div class="clearfix"></div>
                            Buy more, pay less
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                            <img src="<?php echo IMG_PATH;?>paycash.png" alt="Shoperative Delivery" />
                             <div class="clearfix"></div>
                            Pay via card/cash
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                            <img src="<?php echo IMG_PATH;?>power-user.png" alt="Shoperative Delivery" />
                             <div class="clearfix"></div>
                            Apply to become<br>a Power user
                        </span>
                    </li>

                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                            <img src="<?php echo IMG_PATH;?>why-poweruser.png" alt="Shoperative Delivery" />
                             <div class="clearfix"></div>
                            Why become a<br>Power user
                        </span>
                    </li>
                    
                </ul>
            </div>
       </div>
       <div class="clearfix">&nbsp;</div>
       <div class="container-fluid">
           <div class="container">
               <div class="col-md-12 col-xs-12 text-center">
                    <ul class="list-inline">
                        <li><img src="<?php echo IMG_PATH;?>header-strip.png" alt="Shoperative"  class="img-responsive" /></li>
                        <li><h4 class="text-uppercase">featured products</h4></li>
                        <li><img src="<?php echo IMG_PATH;?>header-strip1.png" alt="Shoperative" class="img-responsive"  /></li>
                    </ul>
                   
               </div>
               <!-- <div class="col-md-2 pull-right"><a href="#" class="btn btn-danger btn-sm rd-btn">View All</a></div> -->
           </div>
           <div class="clearfix"></div>
                <div class="text-center container">
                    <center> 
                    <div class="success_msg "></div>
                    <div class="fail_msg "></div>
                    </center>
                </div>
           <div class="container "><!--feature start-->
                   
                    <div class="clearfix"></div>

                    <?php

                     $feature_pro=json_decode($feature_product);
                        //print_r($feature_pro->result[0]->id);exit;
                     if(empty($feature_pro->result[0]->id)){
                         echo '<div class="alert alert-danger text-center"> No Data Found </div>';
                     }
                     else{
                     foreach ($feature_pro->result as $fpro) {  

                        ?>
                    <div class=" col-md-3  no-pad ">
                        <?php   $wishdata= json_decode($wishListData ); 

                        ?>

                        <a  onclick="addWishList(<?php echo $fpro->id; ?>)">
                        <!-- <i class="heart"></i> -->
                       <img src="<?php echo IMG_PATH;?>heart-outline.png" id="wishlist" class="wishlisticon">
                       </a> 
                     <?php 
                     /* $uod= $this->session->userdata('user_id');
                        // print_r($wishdata);
                        if($wishdata->code == 200 ){
                        foreach ($wishdata->result as $wi) { 
                            if($wi->user_id === $uod &&  $fpro->id === $wi->prod_id){

                                ?>
                       
                         <a  onclick="addWishList(<?php echo $fpro->id; ?>)">
                       <img src="<?php echo IMG_PATH;?>heart-full.png" id="wishlist" class="wishlisticon">
                       </a>
                            <?php }else{*/
                                ?> 
 <!-- <a  onclick="addWishList(<?php echo $fpro->id; ?>)">
                       <img src="<?php echo IMG_PATH;?>heart-outline.png" id="wishlist" class="wishlisticon">
                       </a> --> 
                            <?php // } } } ?>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-main text-center">
                            <a href="<?php echo base_url().'productDetails/'.$fpro->id;?>"><img src="<?php echo base_url().'uploads/products/'.$fpro->prod_image;?>" alt="Shoperative product" /></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="<?php echo base_url().'productDetails/'.$fpro->id;?>"><?php echo $fpro->prod_name;?>  </a></h4>
                            <div class="clearfix"></div>
                            <p><?php 
                                 echo substr($fpro->prod_desc, 0,30).'...';
                                 ?>
                            <div class="clearfix"></div>
                            <p class="price">
                               Rs. <?php echo $fpro->selling_price;?> <small class="font12">(<?php echo $fpro->unit_of_measure;?>)</small>
                            </p>
                            <div class="clearfix"></div>
                            <span id="showData"></span>
                            <div class="clearfix"></div>
                            
                           <!--  <a href="#" class="btn btn-success">
                            <span>My Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a>  -->
                             <!-- <button  href="javascript:void(0);" onclick="cart('<?php echo $fpro->id;?>',1);" id="btnCart" class="btn btn-my-cart btn-success">
                            <span> My Cart &nbsp;  <img src="<?php echo IMG_PATH;?>my-cart.png" class="myc"></span>&nbsp;
                            </button> -->
							<?php 
							 $user_id=$this->session->userdata('user_id');
							 if(!empty($user_id))
							 {
							 ?>
                            <button href="javascript:void(0);" class="btn btn-share btn-warning" onclick="cart('<?php echo $fpro->id;?>',2);" >
                            <span> Share Cart &nbsp; <img src="<?php echo IMG_PATH;?>share-cart.png" class="shc"></span>&nbsp;
                            </button>
							<?php 
							 }
							 else{
								 ?>
							<button class="btn btn-share btn-warning" onclick="window.location='<?php echo base_url();?>register'">
                            <span> Share Cart &nbsp; <img src="<?php echo IMG_PATH;?>share-cart.png" class="shc"></span>&nbsp;
                            </button>	 
								 <?php
							 }
							 ?>
                            <div class="clearfix"></div>

                        </div>
                        
                    </div>
                    <?php }  }?> 
                     
                   </div><!--feature end-->
                   
                    <div class="clearfix">&nbsp;</div>

                    <div class="container">
                        <div class="col-md-12">
                      <div class="col-md-4 col-md-push-4">
                    <ul class="list-inline">
                        <li><img src="<?php echo IMG_PATH;?>header-strip.png" alt="Shoperative" /></li>
                        <li><h4 class="text-uppercase">Shop by items</h4></li>
                        <li><img src="<?php echo IMG_PATH;?>header-strip1.png" alt="Shoperative" /></li>
                    </ul>
                 </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="row">
               <?php  $items_var=json_decode($items_varity);
               if( $items_var->code != SUCCESS_CODE){
                     echo '<div class="alert alert-danger text-center"> No Data Found </div>';

               }else{
                    $i=1;
                foreach ($items_var->result as $v) {
                    //print_r($v);
                
               ?> 
                <div class="col-md-6 no-pad <?php if($i%2==0){echo " pull-left"; }else{echo " pull-right";} ?>">
                    <div class="col-md-12 shopby">
                         <?php if($i%2==0){ ?>
                         <img src="<?php echo base_url().'uploads/menu/';?><?php echo $v->image;?>" alt="Shoperative" width="100%"/>
                        <?php } ?>
                        <h4><span><?php echo $i;?>.</span><div class="clearfix"></div><?php echo $v->menu_title; ?><br>varieties</h4>
                        <div class="clearfix"></div>
                        <ul class="list-inline" style="<?php if($i%2!=0){echo  'height:150px';}else{echo 'height:100px';}?>">
                        <?php 
                        $vas=json_decode($varities);
                        foreach ($vas->result as $s) {
                           if($s->menu_id == $v->menu_id){

                                $men_title = preg_replace('/\s+/', '', $v->menu_title); 
                                $sub_title = preg_replace('/\s+/', '', $s->submenu_title); 
                                ?>
                         <li class="col-md-6"><a href="<?php echo base_url().'products/'.strtolower($men_title).'/'.strtolower($sub_title).'/'.base64_encode($s->submenu_id);?>"><i class="fa fa-angle-right <?php if($i%2==0){echo " yellow"; }else{echo " green";} ?>" aria-hidden="true"></i>&nbsp;
                         <?php echo $s->submenu_title;  ?></a></li>
                         <?php  } } ?>
                        </ul>
                          <?php 
                            if($i%2!=0){ 
                         ?>
                       <img src="<?php echo base_url().'uploads/menu/';?><?php echo $v->image;?>" alt="Shoperative" width="100%"/>
                       <?php } ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php $i++;} }?>

                <div class="container">&nbsp;</div>
                <div class="clearfix">&nbsp;</div>
                <div class="col-md-12 ">
                    <ul class="list-inline">
                    <?php 
                        $varity=json_decode($var_down);
                        if($varity->code !=200 ){
                            echo '<div class="alert alert-danger text-center"> No Data Found </div>';
                        }else{
                        if(!empty($i)){$a=$i;}else{$a=1;}
                       
                        foreach ($varity->result as $vrt) {
                                $menus_title = preg_replace('/\s+/', '', $vrt->menu_title); 
                        ?>
                <li class="col-lg-4 col-md-4 col-sm-4 col-xs-12 no-pad">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                    <img src="<?php echo base_url().'uploads/menu/';?><?php echo $vrt->image;?>" alt="Shoperative" height="235px" width="98%"/>
                        <!-- <img src="<?php echo IMG_PATH;?>rice.jpg" alt="Shoperative rice" width="98%"> -->
                        <div class="grains">
                            <ul class="list-inline col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
                                <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-uppercase"><h4><span><?php echo $a;?></span><br><?php echo $vrt->menu_title;?> <br>Varieties</h4></li>
                               <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-uppercase"><a href="<?php echo base_url().'products/'.strtolower($menus_title).'/'.base64_encode($vrt->menu_id); ?>" class="btn btn-md btn-default">Shop Now</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                 <?php $a++; } }?>
            </ul>

                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
           </div>
        <div class="clearfix">&nbsp;</div>
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad futurs-mian1 hidden-xs hidden-sm" >
            <div class="container-fluid">
                <ul class="list-inline">
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad text-uppercase">
                            <img src="<?php echo IMG_PATH;?>f1.png" alt="Shoperative Delivery" />
                             <div class="clearfix"></div>
                            free home delivery
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad text-uppercase">
                            <img src="<?php echo IMG_PATH;?>f2.png" alt="Shoperative Delivery" />
                             <div class="clearfix"></div>
                            organic
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad text-uppercase">
                            <img src="<?php echo IMG_PATH;?>f3.png" alt="Shoperative Delivery" />
                             <div class="clearfix"></div>
                            hand picked products
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad text-uppercase">
                            <img src="<?php echo IMG_PATH;?>f4.png" alt="Shoperative Delivery" />
                             <div class="clearfix"></div>
                            best quality
                        </span>
                    </li>
                     <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad text-uppercase">
                            <img src="<?php echo IMG_PATH;?>f5.png" alt="Shoperative Delivery" />
                             <div class="clearfix"></div>
                            easy returns
                        </span>
                    </li>
                    <li class="col-lg-2 col-md-2 col-sm-2 col-xs-12 no-pad text-center">
                        <span href="#" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad text-uppercase">
                            <img src="<?php echo IMG_PATH;?>f6.png" alt="Shoperative Delivery" />
                             <div class="clearfix"></div>
                            earn money
                        </span>
                    </li>
                    
                </ul>
            </div>
       </div>
                    
                </div>
       </div> 
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
