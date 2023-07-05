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
    .btn-danger{background: red !important;}
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
                    <div style="height:850px" class="hidden-xs"></div>                
            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                <div class="col-md-12">
                    <div class="header-title mrtop">
                        <h4> My Regular Basket</h4>
                        <hr style="margin-top:-5px;"> 
                    </div>
                    <div class="col-md-12"> 
                    <?php if($this->session->flashdata('success')){echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";}if($this->session->flashdata('failed')){ echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";} ?>
                    
                     <?php echo form_open('addall_basket')?>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr >
                                    <th>  Product Image    </th>
                                    <th>  Product Title     </th>
                                    <th> Unit Price   </th>
                                     <th> Qty   </th> 
                                    <th colspan="4">    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                              <?php 
                    $sharecart_req = json_decode($checkout_result);
                    $sharecart_user = $sharecart_req->sharecart_user;
                    $sherecart_item = $sharecart_req->sharecart_item;
                   // print_r($sherecart_item->shareItemDeatils);exit;
                    if ($sharecart_user->code != 200) {
                                  echo "<tr><td colspan=5><div class='alert alert-danger text-center'>".' No items found'."</div></td><tr>";
                               }  
                               else{
                                
                                    foreach ($sherecart_item->shareItemDeatils as $shareItemResponse) {

                              ?>
                                <tr>
                                     <th>  
                                    <img src="<?php echo base_url().'uploads/products/'.$shareItemResponse->prod_img;?>" alt="Shoperative product" width="50px"/>
                                     </th>
                                    <th> <?php echo fetch_ucfirst($shareItemResponse->productname); ?> </th>
                                    <th> Rs.<?php echo $shareItemResponse->unit_price; ?>  </th>
          <th><?php echo form_input(array('type'=>'text','name' => 'qty[]','value'=>"$shareItemResponse->qty")); ?></th>
          <?php echo form_input(array('type'=>'hidden','name' => 'product_id[]','value'=>"$shareItemResponse->product_id")); ?>
          <?php echo form_input(array('type'=>'hidden','name' => 'product_name[]','value'=>"$shareItemResponse->productname")); ?>
                                    <th > 
                                    <a href="<?php echo base_url().'removeBasket/'.$shareItemResponse->product_id;?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times fa-1x" aria-hidden="true" ></i></a>

                                    </th>
                                </tr>
                                <?php } ?>
                        <td colspan="5"></a><button type="submit" class="btn  btn-md btn-success no-bod-rad pull-right"  style="margin-top: 0px"> <i class="fa fa-cart-plus font17" aria-hidden="true"></i>&nbsp; Add item to cart</button></td>
                        <?php
                              } ?>

                               

                                 
                            </tbody>

                        </table>
                       <?php echo form_close(); ?>
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
    <script type="text/javascript" src="<?php echo JS_PATH;?>commoncart.js"></script>
    
   
 </body>
</html>
