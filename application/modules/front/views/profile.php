<?php $this->load->view('includes/header_css'); ?>

<body>
    <!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

    <div class="wrapper">
        <?php $this->load->view('includes/header'); ?>
        <!--Heading Banner Area Start-->
        <section class="heading-banner-area pt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading-banner">
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home</a><span class="breadcome-separator">></span></li>
                                    <li>My Account</li>
                                </ul>
                            </div>
                            <div class="heading-banner-title">
                                <h1>My Account</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!--My Account Area Start-->
        <section class="my-account-area mt-20">
            <div class="container">
                <div class="row">
                    <!-- My Account Tab List Start -->
                    <div class="col-lg-4 col-12 mb-30">
                        <div class="myaccount-tab-list nav">
                            <a href="#dashboad" class="active" data-toggle="tab">Dashboard <i class="fa fa-home"></i></a>
                            <a href="#orders" data-toggle="tab">Orders <i class="fa fa-file-o"></i></a>
                            <!-- <a href="#download" data-toggle="tab">Download <i class="fa fa-arrow-down"></i></a> -->
                            <a href="#address" data-toggle="tab">Wishlist <i class="fa fa-map-marker"></i></a>
                            <a href="#account-info" data-toggle="tab">Account Details <i class="fa fa-user-o"></i></a>
                            <a href="<?php echo base_url(); ?>logout">Logout <i class="fa fa-sign-out"></i></a>
                        </div>
                    </div>
                    <!-- My Account Tab List End -->

                    <!-- My Account Tab Content Start -->
                    <div class="col-lg-8 col-12 mb-30">
                        <div class="tab-content">

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade show active" id="dashboad">
                                <div class="myaccount-content dashboad">
                                    <p>Hello <strong><?php echo $_SESSION['user_name']; ?></strong> (not <strong><?php echo $_SESSION['user_email']; ?></strong>? <a href="<?php echo base_url() . 'logout'; ?>">Log out</a>)</p>
                                    <p>From your account dashboard you can view your <span>recent orders</span>, manage your <span>shipping and billing addresses</span>, and <span>edit your password and account details</span>.</p>
                                </div>
                                <?php
                                if ($this->session->flashdata('success')) {
                                    echo "<div class='alert alert-success  alert-dismissible text-center'>" . $this->session->flashdata('success') . "<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                                }
                                if ($this->session->flashdata('failed')) {
                                    echo "<div class='alert alert-danger  alert-dismissible text-center'>" . $this->session->flashdata('failed') . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                                } ?>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="orders">
                                <div class="myaccount-content order">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr class="">
                                                    <th> S.no </th>
                                                    <th> Order # </th>
                                                    <th> Order Date </th>

                                                    <th> Total </th>
                                                    <th> Shipping Start Date </th>
                                                    <th> Status </th>
                                                    <th colspan="2"> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $orders_list = json_decode($ordersdata);
                                                if ($orders_list->code == 200) {
                                                    $i = 1;
                                                    foreach ($orders_list->result as $ol) {

                                                ?>
                                                        <tr>
                                                            <td> <?php echo  $i ?></td>

                                                            <td> <a href="<?php echo base_url() . 'orderview/' . $ol->orderid . '/' . base64_encode($ol->cart_type); ?>"><?php echo $ol->ordernumber; ?></a></td>
                                                            <td> <?php
                                                                    $originalDate = $ol->orderdate;
                                                                    $newDate = date("d-M-Y ", strtotime($originalDate));
                                                                    $dueDate = date("d-M-Y ", strtotime($newDate . ' + 2 days'));
                                                                    $newTime = date("h:i:s a", strtotime($originalDate));
                                                                    echo $newDate;
                                                                    ?></td>

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
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="download">
                                <div class="myaccount-content download">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Date</th>
                                                    <th>Expire</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Haven - Free Real Estate PSD Template</td>
                                                    <td>Aug 22, 2018</td>
                                                    <td>Yes</td>
                                                    <td><a href="#"><i class="far fa-arrow-to-bottom mr-1"></i> Download File</a></td>
                                                </tr>
                                                <tr>
                                                    <td>HasTech - Profolio Business Template</td>
                                                    <td>Sep 12, 2018</td>
                                                    <td>Never</td>
                                                    <td><a href="#"><i class="far fa-arrow-to-bottom mr-1"></i> Download File</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="address">
                                <div class="myaccount-content wishlist">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="product_remove">Delete</th>
                                                    <th class="product_thumb">Image</th>
                                                    <th class="product_name">Product</th>
                                                    <th class="product-price">Price</th>
                                                    <th class="product_total">Add To Cart</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $wishListData = json_decode($wish_list);
                                            if ($wishListData->code == 200) {
                                                foreach ($wishListData->result as $res) {
                                                    $productLink = base_url() . 'productDetails/' . $res->prod_id;
                                            ?>
                                                    <tbody>
                                                        <tr>
                                                            <td class="product_remove"><a onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url() . 'removeWish/' . $res->prod_id; ?>" title="Remove from wishlist">X</a></td>
                                                            <td class="product_thumb"><a href="<?php echo $productLink; ?>"><img src="<?php echo PRODCUCT_IMAGE_PATH . $res->prod_image; ?>" alt="<?php echo $res->prod_name; ?>" title="<?php echo $res->prod_name; ?>"></a></td>
                                                            <td class="product_name"><a href="<?php echo $productLink; ?>"><?php echo $res->prod_name; ?></a></td>
                                                            <td class="product_name"><a href="<?php echo $productLink; ?>"><?php echo india_price($res->selling_price); ?></a></td>
                                                            <td class="product_total"><a href="javascript:void(0)" onclick="addToCart(<?php echo $res->prod_id; ?>)">Add To Cart</a></td>
                                                        </tr>


                                                    </tbody>
                                                <?php }
                                            } else { ?>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="6" class="alert alert-danger text-center">No wishlist records found..!</td>
                                                    </tr>
                                                </tbody>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="account-info">
                                <div class="myaccount-content account-details">
                                    <div class="account-details-form">

                                        <div class="row">
                                            <?php $form_attributes = array('id' => 'profile', 'editProfile' => 'edit');
                                            echo form_open('front/User/profileUpdate', $form_attributes); ?>
                                            <?php
                                            $userReq = json_decode($user_details);
                                            $info = $userReq->result[0];
                                            ?>
                                            <div class="col-6">
                                                <div class="single-input-item">
                                                    <label for="display-name">User Name <abbr class="required">*</abbr></label>
                                                    <input type="text" name="user_name" id="user_name" placeholder="Name" value="<?php echo  $info->user_name; ?>">
                                                    <span class="error"><?php echo form_error('user_name'); ?></span>
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="single-input-item">
                                                    <label for="email">Email Addres <abbr class="required">*</abbr><?php echo form_error('user_address'); ?></label>
                                                    <input type="text" value="<?php echo  $info->user_email; ?>" disabled="disabled" class="form-control ">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="single-input-item">
                                                    <label for="email">Mobile No.<abbr class="required">*</abbr></label>
                                                    <input type="text" name="user_mobile" id="user_mobile" readonly placeholder="Mobile" value="<?php echo  $info->user_mobile; ?>">
                                                    <span class="error"><?php echo form_error('user_mobile'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="single-input-item">
                                                    <label for="email">City<abbr class="required">*</abbr></label>
                                                    <input type="text" name="user_city" id="city" placeholder="City" value="<?php echo  $info->user_city; ?>">
                                                    <span class="error"><?php echo form_error('user_city'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="single-input-item">
                                                    <label for="email">State<abbr class="required">*</abbr></label>
                                                    <input type="text" name="state" id="state" placeholder="State" value="<?php echo  $info->state; ?>">
                                                    <span class="error"><?php echo form_error('state'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="single-input-item">
                                                    <label for="">&nbsp;</label>
                                                    <button class="form-button" type="submit" name="submit" id="btn_submit">Update</button>

                                                </div>
                                            </div>
                                            </form>
                                            <div class="col-12">
                                                <fieldset>
                                                    <legend>Password change</legend>
                                                    <form method="post" action="<?php echo base_url(); ?>front/User/updatePassword">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="single-input-item">
                                                                    <label for="current-pwd">Current password </label>
                                                                    <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Old Password">
                                                                    <span id="old_password_error" class="error"><?php echo form_error('old_password'); ?> <?php if (isset($ope)) {
                                                                                                                                                                echo $ope;
                                                                                                                                                            } ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="single-input-item">
                                                                    <label for="new-pwd">New password</label>
                                                                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder=" New Password">
                                                                    <span id="new_password_error" class="error"><?php echo form_error('new_password'); ?> </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="single-input-item">
                                                                    <label for="confirm-pwd">Confirm new password</label>
                                                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                                                                    <span id="confirm_password_error" class="error"><?php echo form_error('confirm_password'); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-30">
                                                            <button type="submit" id="changepass_submit" class="form-button">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </fieldset>
                                            </div>

                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- Single Tab Content End -->

                        </div>
                    </div>
                    <!-- My Account Tab Content End -->
                </div>
            </div>
        </section>
        <!--My Account Area End-->

        <?php $this->load->view('includes/footer'); ?>
    </div>

</body>
<script type="text/javascript">
    $("#btn_submit").click(function() {
        var name = $('#user_name').val();
        var mobile = $('#user_mobile').val();
        var state = $('#state').val();
        var city = $('#city').val();


        var name_pattern = /^[a-zA-z. ]*$/;
        var email_pattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        var passwordpattern = /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
        var mobile_pattern = /^[6-9]+[0-9]{9}$/;

        var str = true;
        $('#name_error,#state_error,#city_error,#mobile_error').html('');
        $('#name,#state,#city,#mobile').css('border', '');

        if (name == '' || name == ' ') {
            str = false;
            $('#name').css('border', '1px solid red');
            $('#name_error').css('color', 'red');
            $('#name_error').html(' Please enter name');
        } else if (!name_pattern.test(name)) {
            str = false;
            $('#name').css('border', '1px solid red');
            $('#name_error').css('color', 'red');
            $('#name_error').html(' Please enter valid name');
        }
        if (mobile == '' || mobile == ' ') {
            str = false;
            $('#mobile').css('border', '1px solid red');
            $('#mobile_error').css('color', 'red');
            $('#mobile_error').html(' Please enter  mobile');

        } else if (!mobile_pattern.test(mobile)) {
            str = false;
            $('#mobile').css('border', '1px solid red');
            $('#mobile_error').css('color', 'red');
            $('#mobile_error').html(' Please enter valid mobile');
        }
        if (!name_pattern.test(city)) {
            str = false;
            $('#city').css('border', '1px solid red');
            $('#city_error').css('color', 'red');
            $('#city_error').html('Please enter valid city');
        }
        if (!name_pattern.test(state)) {
            str = false;
            $('#state').css('border', '1px solid red');
            $('#state_error').css('color', 'red');
            $('#state_error').html('Please enter valid state');
        }



        return str;
    });

    $("#changepass_submit").click(function() {
        var old = $('#old_password').val();
        var newpass = $('#new_password').val();
        var confirm = $('#confirm_password').val();

        // alert(old);

        var str = true;
        $('#old_password_error,#new_password_error,#confirm_password_error').html('');
        $('#old_password,#new_password,#confirm_password').css('border', '');

        if (old == '' || old == ' ') {
            str = false;
            $('#old_password').css('border', '1px solid red');
            $('#old_password_error').html('* Please enter old password');
        }

        if (newpass == '' || newpass == ' ') {
            str = false;
            $('#new_password').css('border', '1px solid red');
            $('#new_password_error').html('* Please enter  new password');
        }

        if (confirm == '' || confirm == ' ') {
            str = false;
            $('#confirm_password').css('border', '1px solid red');
            $('#confirm_password_error').html('* Please enter  confirm password');
        } else if (newpass != confirm) {
            str = false;

            $('#confirm_password').css('border', '1px solid red');
            $('#confirm_password_error').html('* Both passwords should match');
        }

        return str;
    });
</script>

</html>