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
        <div class="container martop150 ">
            <div class="col-md-3 bg_profile ">
                <div class="col-xs-12 mrtop">
                     <ul class="profile-side-bar">
                         <li > <a href="<?php echo base_url().'myprofile'?>"> My Profile</a></li>
                         <?php   $user_type = $this->session->userdata('user_type');  
                                    if($user_type == 2 ){?>
                        <li > <a href="<?php echo base_url().'viewFollowers'?>">My Followers</a></li>
                         <?php  } ?>
                         <li> <a href="<?php echo base_url().'myorders'?>"> My Orders</a></li>
                         <?php if($this->session->userdata("power_user_id")==0){?>
                         <li> <a href="<?php echo base_url().'sharedcart'?>"> My Shared Cart</a></li>
                         <?php } ?>
                         <li class="active"> <a href="<?php echo base_url().'mysaving'?>"> My Saving</a></li>
                         <li > <a href=" <?php echo base_url().'wishlist'?>"> Wishlist</a></li>
                         <li> <a href=" <?php echo base_url().'basket'?>"> My Regular Basket</a></li>
                         <li > <a href=" <?php echo base_url().'addressbook'?> "> Address Book</a></li>
                         <li> <a href=" <?php echo base_url().'help'?> "> Help</a></li>
                         <li> <a href=" <?php echo base_url() . 'changepassword/'; ?>"> Change Password   </a></li>
                         <li> <a href=" <?php echo base_url() . 'logout/'; ?>"> Logout   </a></li>
                     </ul>
                </div>
                    <div style="height:850px" class="hidden-xs"></div>
                

            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                <div class="col-md-12">
   
                    <div class="header-title mrtop">
                        <h4> My  Orders </h4>
                        <hr style="margin-top:-5px;"> 
                    </div>
                    <div class="col-md-12"> 
                    <?php //print_r($cart_data);?>
                        <table class="table  table-bordered">
                            <thead>
                                <tr class="">
                                    <th> S.no  </th>
                                   
                                    <th>  Order #   </th>
                                    <th>  Order Date    </th>
                                    <th>  Total    </th>
                                    <th>  Saving Amount </th>
                                    <th > Actions   </th>
                                   
                                </tr>
                                
                            </thead>
                            <tbody>
                                <?php  $orders_list=json_decode($ordersdata);
                                // print_r($orders_list);
                                   if($orders_list->code == 200 ){
                                    $i=1;
                                    foreach ($orders_list->result as $ol) {
                                     
                                ?> 
                                <tr>
                                    <td class="text-center"> <?php echo  $i; ?></td>
                                    <td class="text-center"> <?php echo $ol->ordernumber;?></td>
                                    <td class="text-center"> <?php 
                                            $originalDate=$ol->orderdate;
                                        $newDate = date("d-M-Y ", strtotime($originalDate));
                                        $newTime = date("h:i:s a", strtotime($originalDate));
                                            echo $newDate;
                                     ?></td>
                                    <td class="text-center"> <?php echo  "₹ ".$ol->totalpayableprice; ?> </td>
                                    <?php $saving = $ol->orderprice + $ol->shippingprice - $ol->totalpayableprice;  ?>
                                    <td class="text-center text-success"> <strong><?php echo "₹ ".$saving; ?></strong></td>
                                    
                                    
                                    <td class="text-center"> 
                                           <h4> <a href="<?php echo base_url().'orderview/'.$ol->orderid.'/'.base64_encode($ol->cart_type);?>" class="btn btn-info btn-xs" style=""> <!-- <i class="glyphicon glyphicon-eye-open" > --></i> View Details</a> &nbsp;
                                           </h4> 
                                    </td>
                                 
                                    
                                </tr>

                                <?php $i++; }  }else{?>
                                <tr>
                                 <td  colspan="12" class="alert alert-danger text-center"> No Orders Found </td>
                                 </tr>
                                <?php } ?>
                            </tbody>

                        </table>
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
