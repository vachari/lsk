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
                            <?php $this->load->view('includes/sidebar.php'); ?>
                        </div>

                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">
                            <div class="tab-pane fade show active" id="dashboard">
                                <h3>Dashboard </h3>
                                <p>From your account dashboard. you can easily check &amp; view your
                                    <a href="#">recent orders</a>, manage your <a href="#">shipping and billing
                                        addresses</a> and <a href="#">Edit your password and account details.</a>
                                </p>
                            </div>

                        </div>
                        <h3>Account details </h3>
                        <div class="login">
                            <div class="login_form_container">
                                <?php
                                if ($this->session->flashdata('success')) {
                                    echo "<div class='alert alert-success  alert-dismissible text-center'>" . $this->session->flashdata('success') . "<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                                }
                                if ($this->session->flashdata('failed')) {
                                    echo "<div class='alert alert-danger  alert-dismissible text-center'>" . $this->session->flashdata('failed') . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                                } ?>
                                <div class="account_login_form">
                                    <?php $form_attributes = array('id' => 'profile', 'editProfile' => 'edit');
                                    echo form_open('front/User/profileUpdate', $form_attributes); ?>
                                    <p>Already have an account? <a href="#">Log in instead!</a></p>
                                    <?php $user = json_decode($user_details);
                                    foreach ($user->result as $info) {
                                    ?>
                                        <label> Name <span id="name_error" class="text-red"> * <?php echo form_error('user_name'); ?> </span> </label>
                                        <input type="text" name="user_name" id="user_name" placeholder="Name" value="<?php echo  $info->user_name; ?>">

                                        <label> Mobile No. <span id="mobile_error" class="text-red"> * <?php echo form_error('user_mobile'); ?> </span> </label>
                                        <input type="text" name="user_mobile" id="user_mobile" readonly placeholder="Mobile" value="<?php echo  $info->user_mobile; ?>">

                                        <label> Email <span id="address_error" class="text-red"> * <?php echo form_error('user_address'); ?> </span> </label>
                                        <input type="text" value="<?php echo  $info->user_email; ?>" disabled="disabled" class="form-control ">

                                        <label>State <span id="state_error" class="text-red"> <?php echo form_error('state'); ?> </span> </label>
                                        <select name="state" id="state" class="form-control">
                                            <option><?php if (!empty($info->state)) echo $info->state; ?></option>
                                            <option>Andhra Pradesh</option>
                                            <option>Arunachal Pradesh</option>
                                            <option>Assam</option>
                                            <option>Bihar</option>
                                            <option>Chhattisgarh</option>
                                            <option>Goa</option>
                                            <option>Gujarat</option>
                                            <option>Hariyana</option>
                                            <option>Himachal Pradesh</option>
                                            <option>Jammu & Kashmir</option>
                                            <option>Jharkhand</option>
                                            <option>Karnataka</option>
                                            <option>Kerala</option>
                                            <option>Madhya Pradesh</option>
                                            <option>Maharashtra</option>
                                            <option>Manipur</option>
                                            <option>Meghalaya</option>
                                            <option>Mizoram</option>
                                            <option>Nagaland</option>
                                            <option>Odisha</option>
                                            <option>Punjab</option>
                                            <option>Rajasthan</option>
                                            <option>Sikkim</option>
                                            <option>Tamil Nadu</option>
                                            <option>Telangana</option>
                                            <option>Tripura</option>
                                            <option>Uttarakhand</option>
                                            <option>Uttar Pradesh</option>
                                            <option>West Bengal</option>
                                        </select>

                                        <label>City <span id="city_error" class="text-red"> <?php echo form_error('user_city'); ?> </span> </label>
                                        <input type="text" name="user_city" id="city" placeholder="City" value="<?php echo  $info->user_city; ?>">

                                        <div class="save_button primary_btn default_button">
                                            <button class="primary_btn" type="submit" name="submit" id="btn_submit">Save</button>

                                        </div>
                                    <?php } ?>
                                    </form>
                                </div>
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
</script>

</html>