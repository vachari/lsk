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
                                    <li>Login / Register</li>
                                </ul>
                            </div>
                            <div class="heading-banner-title">
                                <h1>Login / Register</h1>
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
                    <!--Login Form Start-->
                    <div class="col-lg-6 col-md-6">
                        <div class="customer-login-register">
                            <div class="form-login-title">
                                <h2>Login</h2>
                            </div>
                            <div class="login-form">
                                <form action="javascript:void(0)" method="post">
                                    <div class="form-fild">
                                        <p><label>Email<span class="required">*</span></label></p>
                                        <input  autocomplete="off" type="text" name="email_login" id="email_login" placeholder="Email" class="form-control" autocomplete="off" max="60" min="6" value="">
                                        <span id="email_login_error" class="text-danger "></span>
                                    </div>
                                    <div class="form-fild">
                                        <p><label>Password <span class="required">*</span></label></p>
                                        <input  autocomplete="off" type="password" name="password_login" id="password_login" placeholder="Password" class="form-control" autocomplete="off" max="60" min="6">
                                        <span id="password_login_error" class="text-danger "></span>
                                    </div>
                                    <div class="login-submit">
                                        <button id='btn_submit_login' class="form-button loginSubmitDiv pull-right" type="submit">login</button>
                                        <div id="loginLoader" class="loginLoader"> </div>
                                        <label>
                                            <input class="checkbox" type="checkbox" name="rememberme" value="">
                                            <span>Remember me</span>
                                        </label>
                                    </div>
                                    <div class="lost-password">
                                        <a href="#">Lost your password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Login Form End-->
                    <!--Register Form Start-->
                    <div class="col-lg-6 col-md-6">
                        <div class="customer-login-register register-pt-0">
                            <div class="form-register-title">
                                <h2>Register</h2>
                            </div>
                            <div class="register-form">
                                <form action="javascript:void(0)" method="post">
                                    <div class="form-fild">
                                        <p><label>User Name<span class="required">*</span></label></p>
                                        <input autocomplete="off" type="text" name="user_name" id="names" placeholder="Name" class="form-control" autocomplete="off" max="60" min="6" value="<?php echo set_value('user_name'); ?>">
                                        <span id="name_error" class="text-danger "><?php echo form_error('user_name'); ?> </span>
                                    </div>
                                    <div class="form-fild">
                                        <p><label>Mobile <span class="required">*</span></label></p>
                                        <input  autocomplete="off" type="text" name="user_mobile" id="phone" placeholder="Mobile" class="form-control number-class" autocomplete="off" maxlength="10" value="<?php echo set_value('user_mobile'); ?>">
                                        <span id="phone_error" class="text-danger "> <?php echo form_error('user_mobile'); ?></span>
                                    </div>
                                    <div class="form-fild">
                                        <p><label>Email <span class="required">*</span></label></p>
                                        <input  autocomplete="off" type="text" name="user_email" id="email" placeholder="Email" class="form-control" autocomplete="off" max="60" min="6" value="<?php echo set_value('user_email'); ?>">
                                        <span id="email_error" class="text-danger "> <?php echo form_error('user_email'); ?></span>
                                    </div>
                                    <div class="form-fild">
                                        <p><label>Password <span class="required">*</span></label></p>
                                        <input type="password" name="user_password" id="password" placeholder="Password" class="form-control" autocomplete="off" max="60" min="6">
                                        <span id="password_error" class="text-danger "> <?php echo form_error('user_password'); ?></span>
                                    </div>
                                    <div class="register-submit registerSubmitDiv">
                                        <button type="submit" id="btn_submit_register" class="form-button">Register</button>
                                    </div>
                                    <div id="signupLoader" class="signupLoader"> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Register Form End-->
                </div>
            </div>
        </section>
        <!--My Account Area End-->

        <?php $this->load->view('includes/footer'); ?>

    </div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        $("#btn_submit_register").click(function() {
            var name = $('#names').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var cpassword = $('#cpassword').val();
            var phone = $('#phone').val();


            var name_pattern = /^[a-zA-Z][a-zA-Z ]*$/;
            var email_pattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            var passwordpattern = /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
            var mobile_pattern = /^[6-9]+[0-9]{9}$/;

            var str = true;
            $('#name_error,#email_error,#password_error,#cpassword_error,#phone_error').html('');
            $('#names,#email,#password,#cpassword,#phone ').css('border', '');

            if (name == '' || name == ' ') {
                str = false;
                $('#names').css('border', '1px solid red');
                $('#name_error').css('color', 'red');
                $('#name_error').html(' Please enter name');
            } else if (!name_pattern.test(name)) {
                str = false;
                $('#names').css('border', '1px solid red');
                $('#name_error').css('color', 'red');
                $('#name_error').html(' Please enter valid name');
            }

            if (phone == '' || phone == ' ') {
                str = false;
                $('#phone').css('border', '1px solid red');
                $('#phone_error').css('color', 'red');
                $('#phone_error').html(' Please enter  mobile');

            } else if (!mobile_pattern.test(phone)) {
                str = false;
                $('#phone').css('border', '1px solid red');
                $('#phone_error').css('color', 'red');
                $('#phone_error').html(' Please enter valid mobile');
            }

            if (email == '' || email == ' ') {
                str = false;
                $('#email').css('border', '1px solid red');
                $('#email_error').css('color', 'red');
                $('#email_error').html(' Please enter  email');
            } else if (!email_pattern.test(email)) {
                str = false;
                $('#email').css('border', '1px solid red');
                $('#email_error').css('color', 'red');
                $('#email_error').html(' Please enter valid email');
            }
            if (password == '' || password == ' ') {
                str = false;
                $('#password').css('border', '1px solid red');
                $('#password_error').css('color', 'red');
                $('#password_error').html(' Please enter password');
            } else if (!passwordpattern.test(password)) {
                str = false;
                $('#password').css('border', '1px solid red');
                $('#password_error').css('color', 'red');
                $('#password_error').html(' Please enter valid Password');
            }


            if (str) {
                $('.registerSubmitDiv').addClass('disableClass');
                $('.signupLoader').html('Please wait...!').addClass('waitingClass');
                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    async: false,
                    data: JSON.stringify({
                        'username': name,
                        'mobile': phone,
                        'email': email,
                        'password': password
                    }),
                    url: '<?php echo base_url(); ?>api/signup',
                    success: function(res) {
                        if (res['code'] == 200) {
                            $('.registerSubmitDiv').removeClass('disableClass');
                            $('.signupLoader').html(res['description']).addClass('successClass');
                            setTimeout(() => {
                                location.reload();
                            }, 5000)
                        } else {
                            $('.registerSubmitDiv').removeClass('disableClass');
                            $('.signupLoader').html(res['description']).addClass('failClass');
                            setTimeout(() => {
                                $('.signupLoader').html('').removeClass('failClass');
                            }, 3000)
                        }

                    },
                    error: function(error) {
                        console.log(error);
                        $('.registerSubmitDiv').removeClass('disableClass');
                        $('.signupLoader').html(error.responseJSON.description).addClass('failClass');
                        setTimeout(() => {
                            $('.signupLoader').html('').removeClass('failClass');
                        }, 3000)
                    }
                });
            }
        });

        $("#btn_submit_login").click(function() {
            var email = $('#email_login').val();
            var password = $('#password_login').val();

            var email_pattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            var passwordpattern = /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;

            var str = true;
            $('#email_login_error,#password_login_error').html('');
            $('#email_login,#password_login').css('border', '');


            if (email == '' || email == ' ') {
                str = false;
                $('#email_login').css('border', '1px solid red');
                $('#email_login_error').css('color', 'red');
                $('#email_login_error').html(' Please enter email');
            } else if (!email_pattern.test(email)) {
                str = false;
                $('#email_login').css('border', '1px solid red');
                $('#email_login_error').css('color', 'red');
                $('#email_login_error').html(' Please enter valid email');
            }
            if (password == '' || password == ' ') {
                str = false;
                $('#password_login').css('border', '1px solid red');
                $('#password_login_error').css('color', 'red');
                $('#password_login_error').html(' Please enter password');
            } else if (!passwordpattern.test(password)) {
                str = false;
                $('#password_login').css('border', '1px solid red');
                $('#password_login_error').css('color', 'red');
                $('#password_login_error').html(' Please enter valid password');
            }

            if (str) {
                $('.loginSubmitDiv').addClass('disableClass');
                $('.loginLoader').html('Please wait...!').addClass('waitingClass');
                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    async: false,
                    data: JSON.stringify({
                        'loginusername': email,
                        'loginpassword': password,
                        'devicetoken': '123123',
                        'appType': 'WEB'
                    }),
                    url: '<?php echo base_url(); ?>api/login',
                    success: function(res) {
                        if (res['code'] == 200) {
                            $('.loginSubmitDiv').removeClass('disableClass');
                            $('.loginLoader').html(res['description']).addClass('successClass');
                            localStorage.setItem('LSG_USER_TOKEN', res['token']);
                            setTimeout(() => {
                                if (history.back()) {
                                    history.back();
                                } else {
                                    window.location = "<?php echo base_url(); ?>";
                                }
                            }, 2000)
                        } else {
                            $('.loginSubmitDiv').removeClass('disableClass');
                            $('.loginLoader').html(res['description']).addClass('failClass');
                            setTimeout(() => {
                                $('.loginLoader').html('').removeClass('failClass');
                            }, 5000)
                        }

                    },
                    error: function(error) {
                        console.log(error);
                        $('.loginSubmitDiv').removeClass('disableClass');
                        $('.loginLoader').html('Something error occured').addClass('failClass');
                        setTimeout(() => {
                            $('.loginLoader').html('').removeClass('failClass');
                        }, 5000)
                    }
                });
            }
        });



    });
    $('.number-class').on('keyup', function() {
        (isNaN($(this).val())) ? $(this).val(''): '';
    });
</script>

</html>