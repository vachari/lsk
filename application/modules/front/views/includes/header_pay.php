<link href="<?php echo CSS_PATH; ?>cart.css" rel="stylesheet" />
<style>
   .lev-pos{position: absolute;
    top: -127px;}


/** page structure **/
nav {
  display: block;
  width: 100%;

}

.wrapper { 
  display: block;
  margin: 0 auto;
  width: 750px;
}

#menu {
  display: block;
  position: relative;
  z-index: 99;
  padding: 0px;margin: 0px;
  
}

#menu li {
  display: block;
  float: left;
  
}
#menu li a {
  display: block;
  position: relative;
  float: left;
  padding: 18px 51px 0px;
  font-size: 13px;
 
  text-decoration: none;
  color: #fff;
    margin-left: 12px;
}
#menu li a:hover, #menu li a.active {
  background: #151515;
  color: #fff;
}

#menu li ul {
  display: none;
  position: absolute;
  top: 35px;
  width: 200px;
  max-height: 500px;
  min-height: 500px;
  background: #f9f9f9;
  z-index: -1;
  -webkit-box-shadow: 0 2px 7px rgba(0,0,0,0.45);
  -moz-box-shadow: 0 2px 7px rgba(0,0,0,0.45);
  box-shadow: 0 2px 7px rgba(0,0,0,0.45);
  padding-top: 7px;
  padding-left: 0px;
}
#menu li ul li {
  display: block;
  width: 200px;
  height: auto;
}
#menu li ul li a {
  display: block;
  float: none;
  color: #4e5b67;
  font-size: 13px;
  line-height: 28px;
  padding: 0 15px;
}
#menu li ul li a:hover {
  background: #80d240;
  color: #fff;
}

#menu li ul.expanded {
  width: 400px;height: auto;
}
#menu li ul.expanded li { margin-right: 200px; }

.m-t-12{margin-top: 12px !important;}
.m-t-26{margin-top: 26px !important;}
#menu li ul li ul {
  display: none;
  position: absolute;
  left: 200px;
  top: 0;
  height:500px;
  background: none;
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
}
#menu li ul li ul li a { color: #4e5b67; }
#menu li ul li ul li a:hover { text-decoration: none; }

/*#menu li ul li ul li a:after {content: "\f107";float: right}*/

#menu li ul li.green a:hover, #menu li ul li.green a.active { background: #80d240; color: #fff; }
#menu li ul li.green ul { background: #f9f9f9; box-shadow: 0 2px 7px rgba(0,0,0,0.45); }

/*
#menu li ul li.green a:hover, #menu li ul li.green a.active:after {content: "\f107";float: right}
#menu li ul li.green ul { background: #65834c; }*/
.side-left ul li{padding-right:0px !important;padding-left: 0px !important}
@media (min-width:320px) and (max-width:640px){
    
 .slide-bg img{height: 255px !important}
    #menu li a{padding:0px 0px}
}

    .slide-bg img{height: 635px}
</style>
<!--header-->
<header id="header" class="navbar-fixed-top" style="opacity: 0;">
    <div class="container-fluid">
        
              <div class="col-md-3 col-xs-6 no-pad" id="mobile_view_logo">
                <div class="col-md-12 logo text-center"> 
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo IMG_PATH; ?>logo.png" alt="Shoperative" class="img-responsive"/></a>
                </div>
            </div>
        <div class="col-md-4 col-xs-4 no-pad">  
            <div class="col-md-6 col-xs-6 no-pad"  id="search_data" >
                <?php echo form_open('Followers',array('method'=>'post','name'=>'filterfollowerform','id'=>'filterfollowerform')); ?>

<!--
                    <div class="form-group input-group">
                        <input type="search" class="form-control bod-light" name="search"  placeholder="Search followers"  autocomplete="off" required="true" >
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default no-bod-rad bod-light"><i class="fa fa-search"></i>
                            </button>
                        </span>

                    </div>
-->
                    <ul class="searchjx" style="">  
                                 <div class="" id="searchresults"></div>  
                            </ul>
                    <!-- <div class="form-group no-mar no-pad col-md-10 col-xs-10">
                        <div class="">
                            <input type="search" class="form-control" name="search" id="mysearch"  placeholder="Search Product" onkeyup="doSearch();" autocomplete="off"  style="height: 30px;" />
                             <ul class="searchjx" style="">  
                                 <div class="" id="searchresults"></div>  
                            </ul>
                        </div>
                    </div>
                    <div class="form-group no-mar no-pad col-md-2 col-xs-2"> 
                        <button class="btn btn-default no-mar">
                                <i class="glyphicon glyphicon-search" aria-hidden="true"></i>
                        </button>
                    </div> -->
                <?php echo form_close(); ?> 
               </div>
                       <div class="col-md-12 col-xs-12 no-pad"  id="search_data" >
            <?php echo form_open('power-users',array('method'=>'post','name'=>'filterpowerfollowerform','id'=>'filterpowerfollowerform')); ?>
                    <div class="form-group input-group">
                        <input type="search" class="form-control bod-light" name="search" id="mysearch" placeholder="Search Products here" autocomplete="off" onkeyup="doSearch()" required="true">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default bod-light no-bod-rad" type="button"><i class="fa fa-search"></i>
                            </button>
                        </span>

                    </div>
                    <ul class="searchjx" style="">  
                                 <div class="" id="searchresults"></div>  
                            </ul>
              <?php echo form_close(); ?>
               </div>
            </div>
      
            <div class="col-md-3 col-xs-8 no-pad hidden-xs">
                <div class="col-md-12 side-left no-padd">
                    <?php if ($this->user_id !='') {
                      $user=$this->session->userdata('user_name');
                      if(strlen($user) > 10){
                        $user=substr($user, 0,10).'...';
                      }
                     ?>
                        <ul class="list-inline col-md-12 no-pad" style="margin-right: 0px">
                            <li class="text-capitalize"><a href="<?php echo base_url(); ?>"> <b> &nbsp;</b><?php echo 'Hi '.$user; ?> </a></li>
                            <li><a href="<?php echo base_url() . 'myprofile/'; ?>" >My Account</a></li>
                            <li><a href="<?php echo base_url() . 'logout/'; ?>" class="no-brd">Logout</a></li> 
                        </ul>
                        <?php
                    } else {
                        ?>
                     <!--    <ul class="list-inline col-md-12 no-pad">
                            <li><a href="<?php //echo base_url(); ?>register">Login</a></li>
                            <li><a href="<?php //echo base_url(); ?>register">Register</a></li>
                        </ul> -->
                            <?php if ($this->user_id =='') { ?>
                <ul class="list-inline col-md-12 no-pad" style="margin-left: 90px;">
                     <li  class="dropdown">
                    
                        <a class="dropdown-toggle" type="button" data-toggle="dropdown">LOGIN
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="    z-index: 999999;
    margin-top: 5px;background: #bfcbfb;">
                          <li><a href="<?php echo base_url(); ?>signin">Follower</a></li>
                          <li><a href="<?php echo base_url(); ?>signin">Power User</a></li>
                          <li><a href="<?php echo base_url(); ?>vendor/login" target="_new">Vendor</a></li>
                          <li><a href="<?php echo base_url(); ?>shipper/login" target="_new">Shipper</a></li>
                        </ul>
                
                    </li>
                     
                     <li><a href="<?php echo base_url(); ?>register"  style="border-right:none">REGISTER</a></li>      
                        </ul>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
       
          
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-md-12 yellow-bg menu-bg11" style="">
        <div class="container-fluid text-capitalize">
            <div class="col-md-6 no-pad ">
              <!--
                <a class="toggleMenu menu-icon" href="#"> 
                    <span class=""> Menu </span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
              -->
                
            <!--Pattern HTML-->
              <div id="pattern" class="pattern">
                <!--Begin Pattern HTML-->
            		<!-- <a href="#menu" class="menu-link">Menu</a> -->
               

             <!--   <nav>
                <div class="wrapper">
                  <ul id="menu" class="clearfix">
                 
                      <li class="mob-menu"><a href="#"><span class="hidden-xs">Shop By Category</span> <span class="hidden-lg hidden-md hidden-sm"> <i class="fa fa-bars" aria-hidden="true  "></i></span><i class="fa fa-angle-down pull-right m-t-3" aria-hidden="true"></i></a>
                      <ul>
                       <?php
                                $category = json_decode($menuList);
                                foreach ($category->menu_result as $cat) {
                                    if(!empty($cat->listsubmenu_list)){
                                    $listsub = $cat->listsubmenu_list;}
                                    $men_title = preg_replace('/\s+/', '', $cat->menu_title); 
                     ?>
                        <li class="green"><a href="<?php echo base_url().'products/'.strtolower($men_title).'/'.base64_encode($cat->menu_id); ?>"><?php echo $cat->menu_title;?>  <?php if(!empty($cat->submenu_list)){ ?> <i class="fa fa-angle-right pull-right m-t-12" aria-hidden="true"></i><?php }?></a>
                           <?php if(!empty($cat->submenu_list)){ ?>
                          <ul>
                             <?php  foreach ($cat->submenu_list as $subcat) { ?>
                            <li><?php $sub_title = preg_replace('/\s+/', '+', $subcat->submenu_title); ?><a href="<?php echo base_url().'products/'.strtolower($men_title).'/'.strtolower($sub_title).'/'.base64_encode($subcat->submenu_id);?>"><?php 
                                                echo $subcat->submenu_title;
                                               if(!empty($subcat->listsubmenu_list[0]->submenu_id)){
                                                ?> <i class="fa fa-angle-right pull-right m-t-12" aria-hidden="true"></i><?php }?></a>
                            <?php  if(!empty($subcat->listsubmenu_list[0]->submenu_id)){ ?>
                               <ul>
                                 <?php  foreach ($subcat->listsubmenu_list as $listsubcat) { ?>
                                  <?php
                                   if($subcat->submenu_id == $listsubcat->submenu_id ){
                                     $list_title = preg_replace('/\s+/', '+', $listsubcat->listsubmenu_title);?>
                            <li><a href="<?php echo base_url().'products/'.strtolower($men_title).'/'.strtolower($sub_title).'/'.strtolower($list_title).'/'.base64_encode($listsubcat->listsubmenu_id);?>"> <?php 
                                 echo $listsubcat->listsubmenu_title; ?></a>
                                 
                           <?php } } ?>
                                   </li>
                          </ul>
                            <?php }?>
                              </li>
                               <?php } ?>
                          </ul>
                           <?php }?>
                        </li>
                     <?php } ?>
                      </ul>
                    </li>
                
                  </ul>
                </div>
              </nav> -->
            	</div>
            	<!--End Pattern HTML-->
	
            </div>
<div class="col-md-6">
   <div class="pull-right sfp">
       <ul>
         <li><a href="javascript:void(0)" data-toggle="modal" data-target="#searchfollowers"> Search Followers &nbsp; &nbsp;</a></li>
         <li style="border-right:none"><a href="javascript:void(0)"  data-toggle="modal" data-target="#searchpowerusers"> Search Power User</a></li>

       </ul>
    </div>         
</div>

        </div>
    </div>
</header>
    <div class="clearfix"></div>
    <div class="col-md-4   no-pad pull-right ">   
    </div>
    <div class="clearfix"></div>
    <?php if($this->user_id!="" ){ ?>
        <!-- <div class="col-md-12 bg_profile_image"> 
              <div class="container">
                   <ol class="profile_page pull-right">
                       <li><a href="<?php echo base_url().'myprofile';?>"> Profile </a></li>
                       <li ><a href="<?php echo base_url().'myorders';?>"> My Orders </a></li>
                       <li ><a href="<?php echo base_url().'wishlist';?>"> Wishlist </a></li>
                       <li ><a href="<?php echo base_url().'addressbook';?>"> Address Book </a></li>
                       <li ><a href="<?php echo base_url().'help';?>">  Help </a></li>
                       <li ><a href="<?php echo base_url().'logout';?>"> Logout </a></li>
                   </ol>
               </div>
       </div> --> 

    <?php } ?>
    <div class="clearfix "></div>
    <link href="<?php echo CSS_PATH; ?>accod.css" rel="stylesheet" />
<!--menu script start-->


    <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
  