<?php $this->load->view('includes/header_css.php'); ?>

<body>

    <?php $this->load->view('includes/header.php'); ?>

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li>My account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!-- my account start  -->
    <section class="main_content_area">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <div class="dashboard_tab_button">
                            <?php $this->load->view('includes/sidebar.php'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">
                            <div class="tab-pane fade show active" id="dashboard">
                                <h3>Orders </h3>

                            </div>
                            <div class="order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="">
                                            <th> S.no </th>
                                            <th> Order # </th>
                                            <th> Order Date </th>
                                            <th> Shipping Charges </th>
                                            <th> Total </th>
                                            <th> Shipping Start Date </th>
                                            <th> Status </th>
                                            <th colspan="2"> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $orders_list = json_decode($ordersdata);
                                        // print_r($orders_list);
                                        if ($orders_list->code == 200) {
                                            $i = 1;
                                            foreach ($orders_list->result as $ol) {

                                        ?>
                                                <tr>
                                                    <td> <?php echo  $i ?></td>

                                                    <td> <?php echo $ol->ordernumber; ?></td>
                                                    <td> <?php
                                                            $originalDate = $ol->orderdate;
                                                            $newDate = date("d-M-Y ", strtotime($originalDate));
                                                            $dueDate = date("d-M-Y ", strtotime($newDate . ' + 2 days'));
                                                            $newTime = date("h:i:s a", strtotime($originalDate));
                                                            echo $newDate;
                                                            ?></td>
                                                    <td> <?php echo  india_price($ol->shippingprice); ?></td>
                                                    <td> <?php echo  india_price($ol->totalpayableprice); ?> </td>
                                                    <td> <?php echo $dueDate; ?></td>
                                                    <td class="myorder-list text-success">
                                                        <h4>
                                                            <?php if ($ol->orderstatus == 1) { ?>
                                                                <span class="text-primary text-xs disabled"> Order Placed </span>


                                                            <?php  } else if ($ol->orderstatus == 2) { ?>
                                                                <span class="text-success text-sm disabled">Order Approved </span>
                                                            <?php } else if ($ol->orderstatus == 3) { ?>

                                                                <span class="text-warning  text-xs disabled"> Dispatched </span>
                                                            <?php } else if ($ol->orderstatus == 4) { ?>
                                                                <span class="text-info disabled">Order Delivered </span>
                                                            <?php } else if ($ol->orderstatus == 5) { ?>
                                                                <span class="text-danger disabled  text-xs"> Order Canceled </span>
                                                            <?php } ?>
                                                        </h4>
                                                    </td>
                                                    <td class="td-center">
                                                       <a href="<?php echo base_url() . 'orderview/' . $ol->orderid . '/' . base64_encode($ol->cart_type); ?>" class="table-icon" style=""> <i class="zmdi zmdi-eye"></i> </a> &nbsp;
                                                    </td>
                                                    <td class="td-center text-success">
                                                        <?php
                                                            if ($ol->orderstatus != 5) { ?>
                                                                <a href="<?php echo base_url() . 'cancelOrder/' . $ol->orderid . '/' . base64_encode($ol->totalpayableprice) ?>" class="table-icon" onclick="return window.confirm('Are you sure to cancel this order ?')"> <i class="zmdi zmdi-delete"></i> </a>
                                                        
                                                    <?php } else { ?>
                                                        <a href="" class="table-icon" disabled title="This order is cancelled"> <i class="zmdi zmdi-delete"></i> </a> 
                                                        
                                                    <?php } ?>
                                                    </td>
                                                </tr>

                                            <?php $i++;
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="12" class="alert alert-danger text-center"> No Orders Found </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account end   -->

    <!--brand newsletter area start-->



    <?php $this->load->view('includes/footer.php'); ?>

</body>

</html>