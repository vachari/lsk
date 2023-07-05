<?php $this->load->view("includes/header_css.php"); ?>

<body>

    <?php $this->load->view("includes/header.php"); ?>

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>">home</a></li>
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
                            <?php $this->load->view("includes/sidebar.php"); ?>
                        </div>

                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">
                            <div class="tab-pane fade show active" id="dashboard">
                                <h3>Orders </h3>

                            </div>

                        </div>
                        <h3>Order details </h3>
                        <div class="login">
                            <div class="login_form_container">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <div class="header-title">
                                                        <h4> Orders Details </h4>
                                                        <?php
                                                        $ordersdata = json_decode(
                                                            $ordersdata
                                                        );
                                                        // print_r($ordersdata->result);
                                                        foreach ($ordersdata->result
                                                            as $od) { ?>
                                                            <hr>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <div class="col-md-12 bord no-pad">
                                                                <div class="col-sm-7" style="margin-top: 30px;">
                                                                    <div class="panel-heading bg_darkgray">
                                                                        <h6 class="panel-title"> <b>Order Information</b></h6>
                                                                    </div>
                                                                    <div class="panel-heading bg_darkgray">

                                                                        <table class="">
                                                                            <tbody>

                                                                                <tr>
                                                                                    <td> Order # : </td>
                                                                                    <td>
                                                                                        <p class="bord"> &nbsp; <?php echo $od->ordernumber; ?> </p>
                                                                                    </td>

                                                                                </tr>
                                                                                <tr>
                                                                                    <td> Order Date : </td>
                                                                                    <td>
                                                                                        <p class="bord"> &nbsp;
                                                                                            <?php
                                                                                            $originalDate =
                                                                                                $od->orderdate;
                                                                                            $newDate = date(
                                                                                                "d-M-Y ",
                                                                                                strtotime(
                                                                                                    $originalDate
                                                                                                )
                                                                                            );
                                                                                            $dueDate = date(
                                                                                                "d-M-Y",
                                                                                                strtotime(
                                                                                                    $newDate .
                                                                                                        " + 2 days"
                                                                                                )
                                                                                            );
                                                                                            $newTime = date(
                                                                                                "h:i:s A",
                                                                                                strtotime(
                                                                                                    $originalDate
                                                                                                )
                                                                                            );
                                                                                            echo $newDate .
                                                                                                " " .
                                                                                                $newTime;
                                                                                            ?> </p>
                                                                                    </td>

                                                                                </tr>
                                                                                <tr>
                                                                                    <td> Shipping Date : </td>
                                                                                    <td>
                                                                                        <p class="bord"> &nbsp; <?php echo $dueDate .
                                                                                                                    " "; ?> </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>


                                                                            <tfoot class="bg_darkgray">
                                                                                <tr>
                                                                                    <td> Order Quantity : </td>
                                                                                    <td>
                                                                                        <p class="bord"> &nbsp; <?php echo $od->orderqty; ?> KG</p>
                                                                                    </td>

                                                                                </tr>
                                                                                <tr>
                                                                                    <th colspan="4"> Sub Total</th>
                                                                                    <th> <?php echo india_price(
                                                                                                $od->orderprice
                                                                                            ); ?></th>
                                                                                </tr>

                                                                                <tr>
                                                                                    <th colspan="4"> Shipping Charges</th>
                                                                                    <th> <?php echo india_price(
                                                                                                $od->shippingprice
                                                                                            ); ?></th>
                                                                                </tr>
                                                                                <?php $saving =
                                                                                    $od->orderprice +
                                                                                    $od->shippingprice -
                                                                                    $od->totalpayableprice; ?>
                                                                                <tr>
                                                                                    <th colspan="4"> Saving Amount </th>
                                                                                    <th><?php echo india_price(
                                                                                            $saving
                                                                                        ); ?></th>
                                                                                </tr>
                                                                                <tr border='1px'>
                                                                                    <th colspan="4"> Total </th>
                                                                                    <th><?php echo india_price(
                                                                                            $od->totalpayableprice
                                                                                        ); ?></th>
                                                                                </tr>
                                                                            </tfoot>

                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-5">
                                                                    <div class="col-md-12 bord no-pad mrtop">
                                                                        <div class="panel-heading bg_darkgray">
                                                                            <h6 class="panel-title"> <b>Shipping Information</b></h6>
                                                                        </div>
                                                                        <div class="" style="margin-left: -13px">
                                                                            <div class="col-md-12">
                                                                                <table class="table">
                                                                                    <tr>
                                                                                        <td> Shipping Date : </td>
                                                                                        <td>
                                                                                            <p class="bord"> &nbsp; <?php
                                                                                                                    $dueDate = date(
                                                                                                                        "d-M-Y ",
                                                                                                                        strtotime(
                                                                                                                            $newDate .
                                                                                                                                "+ 2 days"
                                                                                                                        )
                                                                                                                    );
                                                                                                                    echo $dueDate;
                                                                                                                    ?></p>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td style="min-width: 75px"> Shipping Address : </td>
                                                                                        <?php $address =
                                                                                            $od->address .
                                                                                            "," .
                                                                                            $od->city; ?>
                                                                                        <td style="word-break: break-word;"> <?php echo rtrim(
                                                                                                                                    $address,
                                                                                                                                    ","
                                                                                                                                ); ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td> Pincode : </td>
                                                                                        <td>
                                                                                            <p class="bord"> &nbsp; <?php echo $od->pincode; ?></p>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td> Mobile : </td>
                                                                                        <td>
                                                                                            <p class="bord"> &nbsp; <?php echo $od->mobile; ?></p>
                                                                                        </td>

                                                                                    </tr>


                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php }
                                                            ?>
                                                            </div>
                                                            <?php
                                                            $uri = base64_decode(
                                                                $this->uri->segment(
                                                                    3
                                                                )
                                                            );
                                                            if ($uri == 1) { ?>
                                                                <div class="col-md-12 bord ">
                                                                    <h3> &nbsp;&nbsp; Products </h3>
                                                                    <table class="table table-striped table-hover">
                                                                       
                                                                        <thead>
                                                                            <tr></tr>
                                                                            <tr>

                                                                                <th> Image </th>
                                                                                <th> Product </th>
                                                                                <th> Qty </th>
                                                                                <th> Unit Price </th>
                                                                                <th> Price </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $items = json_decode(
                                                                                $cartList
                                                                            );

                                                                            if (
                                                                                $items->code !=
                                                                                SUCCESS_CODE
                                                                            ) {
                                                                                echo " <tr><td colspan='10'> <div class='alert alert-danger text-center'> Items not found in mycart </div></td>
                         <tr>";
                                                                            } else {
                                                                                foreach ($items->cart_result
                                                                                    as $cart) { ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <img src="<?php echo $cart->product_image; ?>" style="height:50px;width:50px;">
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $cart->prod_name; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $cart->qty; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo india_price(
                                                                                                $cart->selling_price
                                                                                            ); ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php
                                                                                            $sell_amount =
                                                                                                $cart->selling_price;
                                                                                            $sell_qty =
                                                                                                $cart->qty;
                                                                                            echo $sell_qty *
                                                                                                $sell_amount;
                                                                                            ?>
                                                                                        </td>
                                                                                    </tr>
                                                                            <?php }
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                        <?php if (
                                                                            $items->code ==
                                                                            SUCCESS_CODE
                                                                        ) {
                                                                            foreach ($ordersdata->result
                                                                                as $od) { ?>
                                                                                <tfoot class="bg_darkgray">
                                                                                    <tr>
                                                                                        <th colspan="4"> Sub Total</th>
                                                                                        <th> <?php echo india_price(
                                                                                                    $od->totalpayableprice -
                                                                                                        $od->shippingprice
                                                                                                ); ?></th>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th colspan="4"> Shipping Charges</th>
                                                                                        <th> <?php echo india_price(
                                                                                                    $od->shippingprice
                                                                                                ); ?></th>
                                                                                    </tr>
                                                                                    <tr style="border: 1px solid #ddd" class="success">
                                                                                        <th colspan="4"> Total </th>
                                                                                        <th><?php echo india_price(
                                                                                                $od->totalpayableprice
                                                                                            ); ?></th>
                                                                                    </tr>


                                                                                    <!--  <?php // print_r($cartStatistics);
                                                                                            $cartStatisticsReq = json_decode(
                                                                                                $cartStatistics
                                                                                            ); ?>
                           
                             
                             
                           

                                                                                 
                                                                        <?php }
                                                                        } ?>
                                                                    </table>
                                                                </div> <?php }
                                                                        ?>

                                                         
    <!-- my account end   -->

                                                                                    <!--brand newsletter area start-->

                                                                                </tfoot>
                                                                    </table>
                                                                                <?php $this->load->view(
                                                                                        "includes/footer.php"
                                                                                    ); ?>
</body>

</html>