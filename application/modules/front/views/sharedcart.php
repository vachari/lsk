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
                     <?php $this->load->view('includes/sidebar.php');?>
                </div>
                    <div style="height:850px" class="hidden-xs"></div>                
            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                <div class="col-md-12">
   
                    <div class="header-title mrtop">
                        <h4> My  Shared Cart </h4>
                        <hr style="margin-top:-5px;"> 
                    </div>
                    <div class="col-md-12"> 
                    <?php //print_r($cart_data);?>
                        <table class="table  table-bordered">
                            <thead>
                                <tr class="">
                                    <th> S.no  </th>
                                    <th class="text-center"> Cart Session ID  </th>
                                    <th> Shared On </th>
                                    <th> End Date </th>
                                    <th> </th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <?php  $shared_cart=json_decode($sharedcartdata);
                                 // print_r($shared_cart);exit;
                                   if($shared_cart->code == 200 ){
                                    $i=1;
                                    foreach ($shared_cart->result as $sc) {
                                     
                                ?> 
                                <tr>
                                    <td> <?php echo  $i ?></td>
                                    <td><?php echo  $sc->session_id ?></td>
                                    <td><?php echo  date('m/d/Y',strtotime($sc->shared_on)) ?></td>
                                    <td><?php echo  date('m/d/Y',strtotime($sc->end_date)) ?></td>
                                    <?php if((strtotime($sc->end_date)) < (strtotime(date('Y-m-d'))) ){ ?>
                                    <td><a href="" class="btn btn-primary btn-xs disabled"> View </a></td>
                                    <?php }else{ ?>
                                    <!--<td><a href="<?php echo base_url().'front/cart/cart_session_id/'.$sc->session_id; ?>" class="btn btn-primary btn-xs"> View </a></td>-->
                                    <td><a href="<?php echo base_url().'sharecart_view/'.$sc->session_id; ?>" class="btn btn-primary btn-xs"> View </a></td>
                                     <?php } ?>
                                </tr>

                                <?php $i++; }  }else{?>
                                <tr>
                                 <td  colspan="5" class="alert alert-danger text-center"> Not shared any cart yet</td>
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
