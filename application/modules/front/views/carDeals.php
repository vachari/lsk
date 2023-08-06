<?php $this->load->view('includes/header_css'); ?>
<style type="text/css">
    .contactPhoneClass {
        color: #eb3e32;
    }
</style>

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
                                    <li>Cars & Bike Deals</li>
                                </ul>
                            </div>
                            <div class="heading-banner-title">
                                <h1>Cars & Bike Deals</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!--Service Item Area Start-->
        <section class="service-item-area mt-20">
            <div class="container">
                <div class="row">
                    <!--Single Service Item Start-->
                    <div class="col-lg-4 col-md-4">
                        <div class="single-service-item">
                            <div class="service-img img-full mb-35">
                                <img src="<?php echo IMG_PATH; ?>dynamic_banners/CAR_BIKE.jpg" style="height: 370px;width:370px;" alt="">
                            </div>
                            <div class="service-content">
                                <div class="service-title">
                                    <h4>DISCUSS about Cars</h4>
                                </div>
                                <p>Contact us <b class="contactPhoneClass"><?php echo PROJECT_PHONE; ?></b> for more details</p>
                            </div>
                        </div>
                    </div>
                    <!--Single Service Item End-->
                    <!--Single Service Item Start-->
                    <div class="col-lg-4 col-md-4">
                        <div class="single-service-item">
                            <div class="service-img img-full mb-35">
                                <img src="<?php echo IMG_PATH; ?>dynamic_banners/BIKE.jpg" alt="">
                            </div>
                            <div class="service-content">
                                <div class="service-title">
                                    <h4>About Electric Bike</h4>
                                </div>
                                <p>Contact us <b class="contactPhoneClass"><?php echo PROJECT_PHONE; ?></b> for more details</p>
                            </div>
                        </div>
                    </div>
                    <!--Single Service Item End-->
                    <!--Single Service Item Start-->
                    <div class="col-lg-4 col-md-4">
                        <div class="single-service-item">
                            <div class="service-img img-full mb-35">
                                <img src="<?php echo IMG_PATH; ?>dynamic_banners/lSK_BIKES.jpg" alt="">
                            </div>
                            <div class="service-content">
                                <div class="service-title">
                                    <h4>About Bikes</h4>
                                </div>
                                <p>Contact us <b class="contactPhoneClass"><?php echo PROJECT_PHONE; ?></b> for more details</p>
                            </div>
                        </div>
                    </div>
                    <!--Single Service Item End-->
                </div>
            </div>
        </section>
        <!--Service Item Area End-->

        <?php $this->load->view('includes/footer'); ?>


</body>

</html>