<!DOCTYPE html>
<html> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Orders </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" type="text/css" href="<?php echo SUPER_CSS_PATH ; ?>bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>font-awesome.min.css">
  <!-- Ionicons -->
 <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>gharaahaar1.css">
   <link href="<?php echo CSS_PATH;?>accod.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>_all-skins.min.css">
<style>
        .pages a,.pages strong{                
            border: 1px solid #ddd;
            border-radius: 9px 9px;
            padding: 7px 12px;
         }
        .pages a{
             background-color: #c52825;
             border-radius:50px;
             color: white;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view("includes/header.php");?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
   <?php $this->load->view("includes/sidebar.php");?>
    <!-- /.sid$this->load->view("includes/header.php")bar -->
  </aside>
 <?php
   
      ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Orders View
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'superadmin/Orders';?>"><i class="fa fa-dashboard"></i> Manage Orders</a></li>
        <li class="active"> Order View</li>
      </ol>
 </section>

    <!-- Main content -->
    <section class="content" >
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			<div class="col-md-12 col-sm-12 pd0">
       
        <div class="col-md-10 pd0">
          
          <div class="col-md-5 pd0 ">
         <!--  <form method="post">
			     <input type="search" name="search" class="form-control" placeholder="Search here.....">
           </form> -->
          <!--  </div>
            <div class="col-md-2 pd0">
           <button class="btn btn-md btn-default">Search</button>-->
           </div> 
        </div>
        <div class="col-md-2">
           <!-- <input type='button' id='printbtn' value='Print' class="btn btn-info btn-sm"> -->
           <input type='button' id='btn' value='Print' class="btn btn-info btn-sm" onclick='printDiv();'>
        <a href="<?php echo base_url().'superadmin/Orders' ?>" class="btn btn-primary btn-sm"> Back </a>
        </div>
        
      </div>
            <!-- /.box-header -->
            <div class="box-body mrtop" >
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
              <div class="row">
              <div class="col-sm-12">
              <div class="col-md-12">
                <div class="col-md-12">
                    <div class="header-title mrtop">
                        <!-- <h4> Orders Details </h4> -->
                        <?php $ordersdata=json_decode($ordersdata); 
                          // print_r($ordersdata->result);
                        foreach ($ordersdata->result as $od) {
                        
                        ?>
                    </div>
                    <div class="col-md-12" id='DivIdToPrint'> 
                        <div class="col-md-12 mrtop" style="border: 1px solid #eee;margin: 15px;padding: 20px;"> 
                            <div class="col-md-12 bord no-pad" >
                              <div class="col-sm-7">
                               <div class="panel-heading bg_darkgray"> 
                                         <h6 class="panel-title">  <b>Order Information</b></h6>
                                    </div>
                                  <div class="panel-heading bg_darkgray"> 
                                    
                                     <table class="table borderless">
                                              <tbody>
                                             
                                               <tr>
                                                    <td>  Order #  : </td>
                                                    <td>  <p class="bord"> &nbsp;  <?php echo $od->ordernumber; ?> </p> </td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td>  Order Date  : </td>
                                                    <td>  <p class="bord"> &nbsp;
                                                    <?php 
                                        $originalDate=$od->orderdate;
                                        $newDate = date("d-M-Y ", strtotime($originalDate));
                                        $newTime = date("h:i:s a", strtotime($originalDate));
                                       echo $newDate." ".$newTime;
                                    ?>  </p> </td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td>  Shipping Date  : </td>
                                                    <td>  <p><?php  echo $newDate." ".$newTime; ?> </p></td>
                                                </tr>
                                                </tbody>
                                               
                                                
                                                <tfoot class="bg_darkgray">
                                                 <tr>
                                                    <td>  Order Quantity : </td>
                                                    <td>  <p class="bord"> &nbsp;  <?php echo $od->orderqty; ?> Items</p> </td>
                                                   
                                                </tr>
                                                    <tr> 
                                                        <th colspan="4"> Sub Total</th>
                                                        <th> <?php echo "₹ ".($od->totalpayableprice - $od->shippingprice ); ?></th>
                                                    </tr>

                                                    <tr> 
                                                        <th colspan="4"> Shipping Charges</th>
                                                        <th> <?php echo "₹ ".$od->shippingprice; ?></th>
                                                    </tr>
                                                     <tr border='1px'>
                                                        <th colspan="4"> Total </th>
                                                        <th><?php echo "₹ ".$od->totalpayableprice; ?></th>
                                                    </tr>
                                                  </tfoot>
                                                
                                            </table>
                                </div>
                              </div>
                              
                                <div class="col-md-5">
                                    <div class="col-md-12 bord no-pad mrtop">
                                    <div class="panel-heading bg_darkgray"> 
                                         <h6 class="panel-title">  <b>Shipping Information</b></h6>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12"> 
                                            <table class="table borderless">
                                                <tr>
                                                    <td>  Shipping Date  : </td>
                                                    <td>  <p class="bord"> &nbsp;  May 29 , 2017 </p> </td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td>  Track Number  : </td>
                                                    <td>  <p> Compleated </p></td>
                                                </tr>
                                                 <tr>
                                                    <td> Shipping Form  : </td>
                                                    <td>  
                                                    <p>Fedex </p>
                                                    <p>Pp.000025,Loream Ipsun 300422 </p>
                                                    <p>India </p>
                                                    <p>fedex@info.com </p>

                                                    </td>
                                                </tr>
                                                
                                            </table>
                                       </div>
                                    </div>
                                </div>
                                </div>
                                <?php }?>
                            </div>
                 <?php $uri=base64_decode($this->uri->segment(5)); if($uri == 1){ ?>
                <div class="col-md-12 bord ">
                <h3> &nbsp;&nbsp;  Products </h3>
                 <table class="table table-striped table-hover">
                    <caption class="bg_darkgray"> <b> &nbsp; Mycart Product Details</b></caption>
                        <thead>
                            <tr></tr>
                            <tr>

                                <th> Image </th>
                                <th> Product </th>
                                <th> Qty </th>
                                <th> Unit Price </th>
                                <th>  Price </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $items = json_decode($cartList);

                            if($items->code != SUCCESS_CODE){
                        echo " <tr><td colspan='10'> <div class='alert alert-danger text-center'> Items not found in mycart </div></td>
                         <tr>";
                            }else{
                            foreach ($items->cart_result as $cart) { 
                       ?>
                        <tr>
                            <td>
                                <img src="<?php echo $cart->product_image; ?>"
                                     style="height:50px;width:50px;" >
                            </td>
                            <td>
                                 <?php echo $cart->prod_name; ?>
                            </td>
                            <td>
                                <?php echo $cart->qty; ?>
                            </td>
                            <td>
                                <?php echo $cart->selling_price; ?>
                            </td>
                            <td>
                                <?php
                                $sell_amount = $cart->selling_price;
                                $sell_qty = $cart->qty;
                                echo $sell_qty * $sell_amount;
                                ?>
                            </td>
                        </tr>
                      <?php } }?>
                        </tbody>
                       <?php   if($items->code == SUCCESS_CODE){
                        foreach ($ordersdata->result as $od) { 
                        ?>
                        <tfoot class="bg_darkgray">
                            <tr> 
                                <th colspan="4"> Sub Total</th>
                                <th> <?php echo "₹ ".($od->totalpayableprice - $od->shippingprice ); ?></th>
                            </tr>

                            <tr> 
                                <th colspan="4"> Shipping Charges</th>
                                <th> <?php echo "₹ ".$od->shippingprice; ?></th>
                            </tr>
                             <tr style="border: 1px solid #ddd" class="success">
                                <th colspan="4"> Total </th>
                                <th><?php echo "₹ ".$od->totalpayableprice; ?></th>
                            </tr>


                           <!--  <?php   
                           // print_r($cartStatistics);
                            $cartStatisticsReq=json_decode($cartStatistics);
                            ?>
                            <tr> 
                                <th colspan="4"> Sub Total</th>
                                <th> <?php echo "₹ ".$cartStatisticsReq->cart_amount; ?></th>
                            </tr>
                            <tr> 
                                <th colspan="4"> Shipping Charges</th>
                                <th>  <?php echo "₹ ".$cartStatisticsReq->cart_shipping; ?></th>
                            </tr>
                             <tr>
                              
                                <th colspan="4"> Processing Fee</th>
                                <th><?php echo "₹ ".$cartStatisticsReq->cart_service_charge; ?></th>
                            </tr>
                            <tr border='1px'>
                                <th colspan="4"> Total </th>
                                <th><?php echo "₹ ".$cartStatisticsReq->cart_grand_total; ?></th>
                            </tr> -->
                        
                        </tfoot>
                       <?php }  }?> 
                        </table> 
                            </div>    <?php }else{?>
                             <!-- tabs -->
                        <div class="col-md-12 no-pad">
                            <!-- Nav tabs --><div class="card">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">User wise</a></li>
                                    <li role="presentation"><a href="#item" aria-controls="item" role="tab" data-toggle="tab">Item wise</a></li>

                                </ul>
                                <div class="col-md-12 share-share">
                                    <div class="pull-right">
                                    <!-- <a href="" class=" " data-toggle="" data-placement="top" title="share to Facebook"><i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i></a>
                                    <a href="" class=" " data-toggle="" data-placement="top" title="share to Facebook"><i class="fa fa-share-alt-square fa-lg" aria-hidden="true"></i></a> -->
                                      <!--   <a href="<?php echo base_url(); ?>checkout" class="btn btn-info btn-md"> View Share Cart</a> -->
                                    </div>
                                </div>
                                <?php
                               
                                $sharecart_req = json_decode($sharecart_result); 	
                                $sharecart_user = $sharecart_req->sharecart_user;
                                $sherecart_item = $sharecart_req->sharecart_item;
                                ?>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="user"> 
                                        <!-- tab1 -->

                                        <!-- Accodian starts from here -->      
                                        <div class="col-md-12 bg_head_acc">
                                            <div class="col-md-3">
                                                User ID
                                            </div>
                                            <div class="col-md-3">
                                                Username
                                            </div>
                                            <div class="col-md-3">
                                                Total Items
                                            </div>
                                            <div class="col-md-3">
                                                Total Price 
                                            </div> 
                                        </div>    
                                        <?php
                                        if ($sharecart_user->code == 200) {
                                            foreach ($sharecart_user->userDeatails as $shareUserRes) {
                                           
                                                ?>
                                                <button class="accordion bg-pr">  
                                                    <div class="col-md-3">
                                                        <?php echo $shareUserRes->usercode; ?>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <?php echo fetch_ucfirst($shareUserRes->username); ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <?php echo $shareUserRes->user_shopping_count; ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <?php echo ' ₹ '; ?> <?php echo $shareUserRes->user_shopping_amount; ?>
                                                    </div>
                                                </button>
                                                <div class="panel">
                                                    <table class="table table-nobot no-bordered table-responsive">
                                                        <tr class="danger"> 
                                                            <th>User-Id</th>
                                                            <th>Username</th>
                                                            <th> Items Code</th>
                                                            <th> Product Name</th>
                                                            <th> Qty</th>
                                                            <th>Price</th>
                                                            <th>Total Price</th>
                                                        </tr>

                                                        <?php
                                                        $shareUserItem = $shareUserRes->cart_result;
                                                        foreach ($shareUserItem as $shareItemResponse) {
                                                            ?>
                                                            <tr> 
                                                                <td><?php echo $shareUserRes->usercode; ?></td>
                                                                <td> <?php echo fetch_ucfirst($shareUserRes->username); ?></td>
                                                                <td> <?php echo fetch_ucfirst($shareItemResponse->productcode); ?></td>
                                                                <td> <?php echo fetch_ucfirst($shareItemResponse->productname); ?></td>
                                                                <td> <?php echo $shareItemResponse->qty; ?> | KG</td>
                                                                <td> ₹ <?php echo $shareItemResponse->unit_price; ?>
                                                                <td> ₹ <?php echo $shareItemResponse->total_amount; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table> 
                                                </div>

                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="clearfix"></div>
                                            <span class="accordion bg-pr ">  
                                                <div class="alert alert-danger">No Share cart items.. Please share the cart to continue.</div>
                                            </span>
                                        <?php }
                                        ?>
                                        <!-- USer based code end -->
                                        <!-- tab1 ends -->
                                    </div>
                                    <div role="tabpanel" class="tab-pane  " id="item">
                                        <!-- tab2 start -->
                                        <!-- Accodian starts from here -->      
                                        <div class="col-md-12 bg_head_acc_share">
                                            <div class="col-md-3">
                                                Item-Code
                                            </div>
                                            <div class="col-md-3">
                                                Item-Name
                                            </div>
                                            <div class="col-md-3">
                                                Total-Orders
                                            </div>
                                            <div class="col-md-3">
                                                Total-Price 
                                            </div> 
                                        </div>    
                                        <?php
                                        if ($sherecart_item->code == 200) {
                                            foreach ($sherecart_item->shareItemDeatils as $shareItemRes) {
                                           
                                                ?> 
                                                
                                                <button class="accordion bg-pr-share">  
                                                    <div class="col-md-3">
                                                        <?php echo fetch_ucfirst($shareItemRes->productcode); ?>    
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <?php echo fetch_ucfirst($shareItemRes->productname); ?>  
                                                    </div>
                                                    <div class="col-md-3">
                                                        <?php echo fetch_ucfirst($shareItemRes->item_order_count); ?>  
                                                    </div>
                                                    <div class="col-md-3">
                                                        ₹ <?php echo fetch_ucfirst($shareItemRes->item_cart_amount); ?>  
                                                    </div>


                                                </button>
                                                <div class="panel">
                                                    <table class="table table-nobot no-bordered table-responsive">
                                                        <tr class="info text-center"> 
                                                            <th>Item Code </th>
                                                            <th>Item Name  </th>
                                                            <th> User Id</th>
                                                            <th> User</th>
                                                            <th> Qty</th>
                                                            <th>Price</th>
                                                            <th>Total Price</th>
                                                        </tr>
                                                        <?php foreach ($shareItemRes->user_result as $shareUserRes) { ?>
                                                            <tr> 
                                                                <td><?php echo fetch_ucfirst($shareItemRes->productcode); ?>  </td>
                                                                <td><?php echo fetch_ucfirst($shareItemRes->productname); ?>   </td>

                                                                <td> <?php echo fetch_ucfirst($shareUserRes->usercode); ?></td>
                                                                <td> <?php echo fetch_ucfirst($shareUserRes->username); ?></td>

                                                                <td> <?php echo fetch_ucfirst($shareUserRes->user_qty); ?> | KG</td>
                                                                <td>  ₹ <?php echo fetch_ucfirst($shareUserRes->unit_price); ?></td>
                                                                <td>  ₹ <?php echo fetch_ucfirst($shareUserRes->total_amount); ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table> 
                                                </div>
                                            <?php }
                                        }
                                        else
                                        {
                                        ?>
                                         <div class="clearfix"></div>
                                            <span class="accordion bg-pr ">  
                                                <div class="alert alert-danger">No Share cart items found.Please share the cart to continue.</div>
                                            </span>
                                        <?php } ?>




                                        <!-- Accodian ends here -->


                                        <!-- tab2 ends -->
                                    </div>   

                                </div>
                            </div>
                        </div>
                        <!-- tabs ends here -->
                                </div><?php } ?>
                                 
                            </div>
                        </div>


                    </div>

                </div>
                <!-- end of the edit profile -->
                
               
            </div><!-- end of 9 col -->
                  </div>
                  <div class="col-md-12">
                   <div id="successmessage"></div>
                   <div id="failmessage"></div>
                   </div>
                   <?php if($this->session->flashdata('success')){ echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";}
                    if($this->session->flashdata('failed')){ echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>"; } 
                
                       ?>
                 
              </div>
              </div> 
            
             
              <div class="text-center">
              <td colspan="4" > </p></td>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
       
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
   <?php $this->load->view("includes/footer.php");?>
   
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!--  -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

 

  
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo SUPER_JS_PATH; ?>bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo SUPER_JS_PATH; ?>fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SUPER_JS_PATH; ?>app.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo SUPER_JS_PATH; ?>jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo SUPER_JS_PATH; ?>Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo SUPER_JS_PATH; ?>dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo SUPER_JS_PATH; ?>demo.js"></script>
</body>
</html>
<script>

function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
//accodion 
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  }
}
</script>
<script type="text/javascript">
$('#success').hide();
$('#fail').hide();
    /***Check Or Uncheck the Check box List Code Start*/
    $('#multiAction').click(function () {
        if ($('#multiAction').is(':checked')) {
            $('#multiAction').prop('checked', true);
            $('[name="multiple[]"]').prop('checked', true);
        } else {
            $('#multiAction').prop('checked', false);
            $('[name="multiple[]"]').prop('checked', false);
        }
    });
    /***Check Or Uncheck the Check box List Code End*/
    

    function frontEnable(sid){
    var listarray = new Array();
  $('input[name="multiple[]"]:checked').each(function () {
      listarray.push($(this).val());
  });
      // alert('hai'); 
  var checklist = "" + listarray;
    if (!isNaN(sid) && (sid == '1' || sid == '0') && checklist != '')
  {
      $.ajax({
    type: "POST",
    dataType: "json",
    data: {'tablename': 'front_enable', 'upldatelist': checklist, 'activity': sid},
    url: "<?php echo base_url(); ?>superadmin/Common_controller/commonStatus",
     success: function (u) {
                    console.log(u);
                    if(u.code=='200'){$('#success').show();$('#successmessage').html(u.description).addClass('alert alert-success');setTimeout(function() {window.location=location.href;},2000);}
    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');}
                },
                error: function (er) {
                    console.log(er);
                }

      });
  }
  }


  function updateActivationStatus(sid){
    
    var listarray = new Array();
  $('input[name="multiple[]"]:checked').each(function () {
      listarray.push($(this).val());
  });
      // alert('hai'); 
  var checklist = "" + listarray;
    if (!isNaN(sid) && (sid == '1' || sid == '0') && checklist != '')
  {

  $.ajax({
    type: "POST",
    dataType: "json",
    data: {'tablename': 'menu_list', 'upldatelist': checklist, 'activity': sid},
    url: "<?php echo base_url(); ?>superadmin/Common_controller/commonStatus",
     success: function (u) {
      console.log(u);
    if(u.code=='200'){$('#success').show();$('#successmessage').html(u.description).addClass('alert alert-success');setTimeout(function() {window.location=location.href;},2000);}
    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');setTimeout(function() {window.location=location.href;},2000);}
      },
      error: function (er) {
          console.log(er);
      }

      });
  }
  else{
       $('#fail').show();$('#failmessage').html('*  Please Select ').addClass('alert alert-danger');
      }
  }
</script>

<script type="text/javascript">
    function commonDelete(){
    var listarray=new Array();
      $('input[name="multiple[]"]:checked').each(function(){listarray.push($(this).val());});
        var checklist=""+listarray;
        alert(checklist);
      if(checklist!=''){
         $('#fail').hide();
         $.ajax({
          dataType:'json',
          type:'post',
          data:{'tablename':'menu','updatelist':checklist},
          url:'<?php echo base_url();?>superadmin/Category/commonDelete/',
          success:function(u){
           // console.log(u);
            if(u.code=='200'){$('#success').show();$('#successmessage').html(u.description).addClass('alert alert-success');setTimeout(function() {window.location=location.href;},2000);}
                    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');}
                 },
          error:function(er){
            console.log(er);
          }
        });
      }
      else{
       $('#fail').show();$('#failmessage').html('*  Please Select ').addClass('alert alert-danger');
      }
    }

</script>
    