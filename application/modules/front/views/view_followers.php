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
        <div class="container martop150">
            <div class="col-md-3 bg_profile ">
                <div class="col-xs-12 mrtop">
                    <?php $this->load->view('includes/sidebar.php');?>
                </div>
                    <div style="height:850px" class="hidden-xs"></div>                
            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                <div class="col-md-12">
                    <div class="col-md-12"> 
                    <div class="col-md-4 header-title mrtop">
                        <h4> My  Followers </h4>
                        <hr style="margin-top:-5px;"> 
                    </div>
                    <div class="col-md-6 header-title mrtop">
                        <p class="blink">You have less number of followers please add followers  </p>
                    </div>
                    <div class="col-md-2  header-title mrtop">
                        <a href="<?php echo base_url().'addFollowers'; ?>" class="btn btn-md btn-primary">Add Follower</a>
                    </div>
                    </div>
                    <div class="col-md-12"> 
                    <?php //print_r($follower);?>
                        <table class="table  table-bordered">
                            <thead>
                                <tr class="">
                                    <th> S.no  </th>
                                    <th> Name  </th>
                                    <th>  Email   </th>
                                    <th>  Mobile    </th>
                                    <th>  City   </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $followerdata=json_decode($follower);
                                
                                   if($followerdata->code == 200 ){
                                    $i=1;
                                    foreach ($followerdata->result as $f) {
                                     
                                ?> 
                                <tr>
                                    <td> <?php echo  $i ?></td>
                                    <td><?php echo $f->user_name;?></td>
                                    <td><?php echo $f->user_email;?></td>
                                    <td><?php echo $f->user_mobile;?></td>
                                    <td><?php echo $f->user_city?></td>
                                
                                </tr>

                                <?php $i++; }  }?>
                                 
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
