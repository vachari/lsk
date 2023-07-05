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
    .bg_dd{background: #ddd;}

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
                     <ul class="profile-side-bar">
                         <li  class="active"> <a href="<?php echo base_url().'myprofile'?>"> CATEGORIES</a></li>
                        <div>
                            <ul class="list-menu ">
                                <?php $menus=json_decode($menuList);
                                   // print_r($menus->menu_result);
                                    $uri=$this->uri->segment(2);
                                foreach ($menus->menu_result as $m) {
                                    ?>

                        <li><a href="<?php echo base_url().'products/'.strtolower($m->menu_title).'/'.base64_encode($m->menu_id); ?>" <?php if($uri == $m->menu_id){echo 'style="background-color:#ddd;" ';}?> ><?php echo $m->menu_title;?> </a></li>
                              <?php       
                                }
                                 ?>
                            </ul>.

                        </div>
                         <li  class="active"> <a href="<?php echo base_url().'myprofile'?>"> PRICE RANGE</a></li>
                         <div class="mrtop">

                            <input type="range" min="0" max="100000">
                            <div class=""> 
                            <label for="">Min</label>
                            <label for=""  class="pull-right">Max</label>
                            </div>
                            <div class=""> 
                            <input type="text" class="col-md-5" value="1" min="1">
                            <input type="text" class=" pull-right col-md-5" value="1000">
                            </div>
                        </div>
                        <hr>
                       
                     </ul>
                </div>
                    <div style="height:800px" class="hidden-xs">   <div class="mrtop">
                            <input type="radio" class="" value="1" name="price_range"> ₹ 1 to ₹ 100   <br>
                            <input type="radio" class="" name="price_range"> ₹ 100 to ₹ 200 <br>
                            <input type="radio" class="" name="price_range"> ₹ 200 to ₹ 500 <br>
                            <input type="radio" class="" name="price_range"> ₹ 500 to ₹ 1000 <br>
                            <input type="radio" class="" name="price_range"> ₹ 1000 to ₹ 2000 <br>
                            <input type="radio" class="" name="price_range"> above ₹ 2000  <br>
                            </div></div>
            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                <div class="col-md-12 mrtop">
                     <div class="col-md-8">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo   base_url();?>">Home</a></li>
                      <?php if($this->uri->segment(4) ==''){?>
                       <li class="breadcrumb-item active"><?php echo  ucfirst($this->uri->segment(2)); ?></li> 
                      <?php }else if($this->uri->segment(5) =='') {?>
                    <li class="breadcrumb-item"><a href="#"><?php echo  ucfirst($this->uri->segment(2)); ?></a></li>
                    <li class="breadcrumb-item active"><?php echo  ucfirst($this->uri->segment(3)); ?></li> 
                  <?php  }else if($this->uri->segment(6) ==''){ ?>
                  <li class="breadcrumb-item"><a href="#"><?php echo  ucfirst($this->uri->segment(2)); ?></a></li>
                    <li class="breadcrumb-item active"><a href="#"><?php echo  ucfirst($this->uri->segment(3)); ?></a></li>    
                  <li class="breadcrumb-item active"><?php echo  ucfirst($this->uri->segment(4)); ?></li> 
                 <?php  }?>
                    </ol>
                    </div>
                    <div class="col-md-4 pull-right">
                        <div class="form-inline">
                            <label for=""> Sort By : </label>
                            <select name="price_filter" id="price_filter" class="form-control" onchange="sortFunction()">
                                <option value="0">Sort By Price </option>
                                <option value="1" selected="selected">Low - High </option>
                                <option value="2"> High - Low  </option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                 
                      <div class="header-title ">
                          <h4> Products List</h4>
                          <hr style="margin-top:-5px;"> 
                      </div>
                   
                    <?php $pro=json_decode($products);
                         if($pro->code != 200 ){
                            echo '<div class="alert alert-danger text-center"> Products not found </div>';
                        }else{
                    ?> 
                    <div class="col-md-12">
                <?php
                     foreach ($pro->result as $fpro) {  
                        ?>
                    <div class=" col-md-4  no-pad ">
                        <div class="product-main text-center">
                            <a href="<?php echo base_url().'productDetails/'.$fpro->id;?>"><img src="<?php echo base_url().'uploads/products/'.$fpro->prod_image;?>" alt="Shoperative product" /></a>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><a href="<?php echo base_url().'productDetails/'.$fpro->id;?>"><?php echo $fpro->prod_name;?>  </a></h4>
                            <div class="clearfix"></div>
                            <p><?php 
                                 echo substr($fpro->prod_desc, 0,30).'...';
                                 ?>
                            <div class="clearfix"></div>
                            <p class="price">
                               Rs. <?php echo $fpro->selling_price;?> <span class="font12">(<?php echo $fpro->unit_of_measure;?>)</span>
                            </p>
                            <div class="clearfix"></div>
                           <!--  <a href="#" class="btn btn-success">
                            <span>My Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>&nbsp;
                            </a>  -->
                             <button  href="javascript:void(0);" onclick="cart('<?php echo $fpro->id;?>',1);" id="btnCart" class="btn btn-my-cart btn-sm btn-success">
                            <span> My Cart &nbsp;  <img src="<?php echo IMG_PATH;?>my-cart.png" class="myc"></span>&nbsp;
                            </button>
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
                    <?php }  ?> 
                   </div><!--feature end-->
                  </div> <!-- main 12 col div -->
                    <?php } ?>
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
    <script type="text/javascript" src="<?php echo JS_PATH;?>commoncart.js"></script>
 </body>
</html>
<script>
   $('select').on('change', function() {
    
    if(this.value !=0){
       // alert( this.value );
       $.ajax({ 
          dataType:'html',
          type:'post',
          data:{'price_filtere': this.value },
          url:'<?php echo base_url();?>front/Products/getMenus',
          success:function(u){
            console.log(u);
            if(u.code=='200'){$('#success').show();$('#successmessage').html('Address deleted successfully').addClass('alert alert-success');setTimeout(function() {window.location=location.href;},2000);}
                    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');}
                 },
          error:function(er){
            console.log(er);
          }

       });

    }
});

function sortFunction(){
    var price_filter=$('#price_filter').val();
    alert(price_filter);
      $.ajax({
            dataType: 'JSON',
            method: 'POST',
            data: {'order_by':price_filter},
            url: "<?php echo base_url(); ?>superadmin/Product/getMenus",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data);
                switch (data.code)
                {
                    case 200:

                        $('.success_msg').html(data.description).addClass('alert alert-success fade in');
                        setTimeout(function () {
                            window.location = "<?php echo base_url(); ?>superadmin/Product/productDetails/";
                        }, 2000);
                        break;
                    case 204:
                        $('.fail_msg').html(data.description).addClass('alert alert-success fade in');
                        $('#btn_submit').show();
                        setTimeout(function () {
                            window.location = "<?php echo base_url(); ?>superadmin/Product/createProduct";
                        }, 3000);
                    case 301:
                    case 422:
                    case 575:
                        $('.success_msg').html(data.description).addClass('alert alert-danger fade in');
//                                            $('.form_loading_hide').show();
//                                            $('.form_loading_show').hide();
                        break;
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }


</script>
