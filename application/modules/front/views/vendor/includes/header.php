<link href="<?php echo CSS_PATH; ?>cart.css" rel="stylesheet" />
<style>
    .lev-pos{position: absolute;
    top: -127px;}


/** page structure **/
nav {
  display: block;
  width: 100%;
  height: 70px;
  background: #ffffff;
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
  padding: 0px;
  
}

#menu li {
  display: block;
  float: left;
  
}
#menu li a {
  display: block;
  position: relative;
  float: left;
  padding: 0 35px;
  font-size: 17px;
  line-height: 70px;
  font-weight: bold;
  text-decoration: none;
  color: #242a86;
}
#menu li a:hover, #menu li a.active {
  background: #fff;
  color: #2c343b;
}

#menu li ul {
  display: none;
  position: absolute;
  top: 70px;
  width: 200px;
     max-height: 444px;
    min-height: 386px;
  background: #f9f9f9;
  z-index: -1;
  -webkit-box-shadow: 0 2px 7px rgba(0,0,0,0.45);
  -moz-box-shadow: 0 2px 7px rgba(0,0,0,0.45);
  box-shadow: 0 2px 7px rgba(0,0,0,0.45);
  padding: 0px;
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
  font-size: 15px;
  line-height: 41px;
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
  height:246px;
  background: none;
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
}
#menu li ul li ul li a { color: #4e5b67; }
#menu li ul li ul li a:hover { text-decoration: underline; }

/*#menu li ul li ul li a:after {content: "\f107";float: right}*/

#menu li ul li.green a:hover, #menu li ul li.green a.active { background: #80d240; color: #fff; }
#menu li ul li.green ul { background: #f9f9f9; box-shadow: 0 2px 7px rgba(0,0,0,0.45); }

/*
#menu li ul li.green a:hover, #menu li ul li.green a.active:after {content: "\f107";float: right}
#menu li ul li.green ul { background: #65834c; }*/

@media (min-width:320px) and (max-width:640px){
    

    #menu li a{padding:0px 0px}
}


</style>
<!--header-->
<header id="header" class="navbar-fixed-top" >
    <div class="container">
              <div class="col-md-4 col-xs-6 no-pad" id="mobile_view_logo">
                <div class="col-md-12 logo text-center"> 
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo IMG_PATH; ?>logo.png" alt="Shoperative" class="img-responsive"/></a>
                </div>
            </div>
            <div class="col-md-4 col-xs-6 no-pad"></div>
            <div class="col-md-4 col-xs-6 no-pad">
                <div class="col-md-12 pull-right side-left">
                    <?php if ($this->vendor_id !='') { 
                      $user=$this->session->userdata('vendor_name');
                      if(strlen($user) > 20){
                        $user=substr($user, 0,17).'...';
                      }
                      ?>
                        <ul class="list-inline col-md-12 no-pad ">
                            <li class="text-capitalize"><a href="<?php echo base_url().'vendor'; ?>"> <b> &nbsp;</b><?php echo 'Hi '.$user.' (V)'; ?> </a></li>
                            <li><a href="<?php echo base_url() . 'vendor/profile/'; ?>" >My Profile</a></li>
                            <li><a href="<?php echo base_url() . 'vendor/logout'; ?>" class="no-brd">Logout</a></li>
                            
                        </ul>
                      <p style="color: #fff" class="text-right">  Vendor Panel </p>
                        <?php
                    } ?>
                
                </div>
            </div>
        </div>
    </header>
    <link href="<?php echo CSS_PATH; ?>accod.css" rel="stylesheet" />
<!--menu script start-->


    <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
  