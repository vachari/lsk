  <?php //Getting Wallet Amount
	$my_wallet_amount=0;
	$my_wallet_amount_raw=$this->db->select('tot_wallet_amount')->from('ga_wallet_tbl')
								->where('user_id',$_SESSION['user_id'])->get();
	if($my_wallet_amount_raw->num_rows()>0){
		$my_wallet_amount=$my_wallet_amount_raw->row()->tot_wallet_amount;

	}					
  ?>
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
                        <h4> My  Wallet  (Rs. <strong class="mywalletamount"></strong>)</h4>
                        <hr style="margin-top:-5px;"> 
                    </div>
                    <div class="col-md-12"> 
                    <?php //print_r($cart_data);?>
                        <table class="table  table-bordered">
                            <thead>
                                <tr class="">
                                    <th>  S.no </th>
									<th>Item Name </th>
                                    <th>  Order #</th>
                                    <th>  Order Date</th>
									<th>  Cancelled On</th>
									 <th> Unit Price</th>
                                    <th>  Shipping Charges</th>
                                    <th>  Total Amount</th>
                                    <th>  Refunded Amount</th>
									<th> Reason</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <?php  $orders_list=json_decode($ordersdata);
                                // print_r($orders_list);
								  $total_wallet_amt=0;
                                   if($orders_list->code == 200 ){
                                    $i=1;
                                    foreach ($orders_list->result as $ol) {
                                     $total_wallet_amt=$total_wallet_amt+$ol->refund_amount;
                                ?> 
                                <tr>
                                    <td> <?php echo  $i ?></td>
									<td><?php echo $ol->prod_name;?></td>
                                    <td> <?php echo $ol->ordernumber;?></td>
                                    <td> <?php 
                                            $originalDate=$ol->orderdate;
                                        $newDate = date("d-M-Y ", strtotime($originalDate));
                                        $dueDate = date("d-M-Y ", strtotime($newDate.' + 2 days'));
                                        $newTime = date("h:i:s a", strtotime($originalDate));
                                            echo $newDate;
                                     ?></td>
									 <td><?php echo date("d-M-Y");//here cancel date should display?></td>
									 <td><?php echo $ol->unit_price;?></td>
                                    <td> <?php echo  $ol->shipping_charges; ?></td>
                                    <td> <?php echo  $ol->total_amount; ?> </td>
                                    <td><span style="color:#19cd19"><strong><?php echo $ol->refund_amount; ?></strong></span></td>
									<td>You cancelled order item</td>
                                    

                                </tr>


                                <?php $i++; }  }else{?>
                                <tr>
                                 <td  colspan="12" class="alert alert-danger text-center"> No records found</td>
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
<script>
$('.mywalletamount').html('<?php echo $my_wallet_amount;?>');
</script>
