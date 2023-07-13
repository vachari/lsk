<?php $this->load->view('includes/header_css.php'); ?>

<body>
    <?php $this->load->view('includes/header.php'); ?>

    <!-- customer login start -->
    <div class="customer_login">
        <div class="container">
            <div class="login-bg">

                <div class="row">
                    <!--login area start-->
                    <div class="col-lg-6 col-md-6">
                        <div class="account_form">
                            <h2>login</h2>
                            <form action="javascript:void(0)" method="post">
                                <p>
                                    <label>Email<span class="text-danger">*</span></label>

                                    <input type="text" name="email_login" id="email_login" placeholder="Email" class="form-control" autocomplete="off" max="60" min="6" value="">
                                    <span id="email_login_error" class="text-danger "></span>
                                </p>
                                <p>
                                    <label>Password<span class="text-danger">*</span></label>

                                    <input type="password" name="password_login" id="password_login" placeholder="Password" class="form-control" autocomplete="off" max="60" min="6">
                                    <span id="password_login_error" class="text-danger "></span>
                                </p>
                                <div class="login_submit">
                                    <a href="#">Lost your password?</a>
                                    <label for="remember">
                                        <input id="remember" type="checkbox">
                                        Remember me
                                    </label>
                                    <button id='btn_submit_login' class="loginSubmitDiv" type="submit">login</button>
                                    <div id="loginLoader" class="loginLoader"> </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!--login area start-->

                    <!--register area start-->
                    <div class="col-lg-6 col-md-6">
                        <div class="account_form register">
                            <h2>Register</h2>

                            <form action="javascript:void(0)" method="post">
                                <p>
                                    <label>Name <span>*</span></label>
                                    <input type="text" name="user_name" id="names" placeholder="Name" class="form-control" autocomplete="off" max="60" min="6" value="<?php echo set_value('user_name'); ?>">
                                    <span id="name_error" class="text-danger "><?php echo form_error('user_name'); ?> </span>
                                </p>
                                <p>
                                    <label>Mobile<span class="text-danger">*</span></label>
                                    <input type="text" name="user_mobile" id="phone" placeholder="Mobile" class="form-control number-class" autocomplete="off" maxlength="10" value="<?php echo set_value('user_mobile'); ?>">
                                    <span id="phone_error" class="text-danger "> <?php echo form_error('user_mobile'); ?></span>
                                </p>
                                <p>
                                    <label>Email<span class="text-danger">*</span></label>

                                    <input type="text" name="user_email" id="email" placeholder="Email" class="form-control" autocomplete="off" max="60" min="6" value="<?php echo set_value('user_email'); ?>">
                                    <span id="email_error" class="text-danger "> <?php echo form_error('user_email'); ?></span>
                                </p>
                                <p>
                                    <label>Password<span class="text-danger">*</span></label>

                                    <input type="password" name="user_password" id="password" placeholder="Password" class="form-control" autocomplete="off" max="60" min="6">
                                    <span id="password_error" class="text-danger "> <?php echo form_error('user_password'); ?></span>
                                </p>
                                <div class="login_submit registerSubmitDiv">
                                    <button type="submit" id="btn_submit_register">Register</button>
                                </div>
                                <div id="signupLoader" class="signupLoader"> </div>

                            </form>
                        </div>
                    </div>
                    <!--register area end-->
                </div>
            </div>
        </div>
    </div>
    <!-- customer login end -->
    <?php $this->load->view('includes/footer.php'); ?>

</body>

</html>
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
                                location.reload();
                            }, 1000)
                        }

                    },
                    error: function(error) {
                        console.log(error);
                        $('.registerSubmitDiv').removeClass('disableClass');
                        $('.signupLoader').html('Something error occured').addClass('failClass');
                        setTimeout(() => {
                            location.reload();
                        }, 1000)
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
                                location.reload();
                            }, 1000)
                        }

                    },
                    error: function(error) {
                        console.log(error);
                        $('.loginSubmitDiv').removeClass('disableClass');
                        $('.loginLoader').html('Something error occured').addClass('failClass');
                        setTimeout(() => {
                            location.reload();
                        }, 1000)
                    }
                });
            }
        });



    });
    $('.number-class').on('keyup', function() {
        (isNaN($(this).val())) ? $(this).val(''): '';
    });
</script>