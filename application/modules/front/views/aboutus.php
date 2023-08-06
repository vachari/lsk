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
                                    <li>About Us</li>
                                </ul>
                            </div>
                            <div class="heading-banner-title">
                                <h1>About Us</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!--Aboout Us Area Start-->
        <section class="about-us-area">
            <!--About Us Image Start-->
            <div class="about-us-img bg-4"></div>
            <!--About Us Image End-->
            <div class="container-fluid">
                <div class="row">
                    <!--About Us Content Start-->
                    <div class="col-lg-6 offset-lg-6 col-md-6 offset-md-6 about-us-content">
                        <div class="about-us-title text-center">
                            <h2><?php echo PROJECT_NAME; ?></h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                    </div>
                    <!--About Us Content End-->
                </div>
            </div>
        </section>
        <!--Aboout Us Area End-->
        <!--Counter Up Area Start-->
        <section class="counter-up-area">
            <div class="row no-gutters">
                <!--Single Count Box Start-->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-count-box">
                        <div class="counter-img">
                            <img src="img/icon/6.png" alt="">
                        </div>
                        <div class="counter-content">
                            <div class="counter-number">
                                <h2><span class="counter">1234</span></h2>
                            </div>
                            <div class="counter-title">
                                <h5>happy customers</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Single Count Box End-->
                <!--Single Count Box Start-->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-count-box">
                        <div class="counter-img">
                            <img src="img/icon/7.png" alt="">
                        </div>
                        <div class="counter-content">
                            <div class="counter-number">
                                <h2><span class="counter">2</span></h2>
                            </div>
                            <div class="counter-title">
                                <h5>awards winned</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Single Count Box End-->

                <!--Single Count Box Start-->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-count-box">
                        <div class="counter-img">
                            <img src="img/icon/9.png" alt="">
                        </div>
                        <div class="counter-content">
                            <div class="counter-number">
                                <h2><span class="counter">4</span></h2>
                            </div>
                            <div class="counter-title">
                                <h5>Upcoming Features</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Single Count Box End-->
            </div>
        </section>
        <!--Counter Up Area End-->
       
        <?php $this->load->view('includes/footer'); ?>
    </div>


</body>

</html>