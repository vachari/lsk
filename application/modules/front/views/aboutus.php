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
                            <li>about us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
    <!--about section area -->
    <div class="about_section mt-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="about_thumb">
                        <img src="<?php echo IMG_PATH; ?>about/about1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="about_content">
                        <h1>Welcome To LSK Global Enterprises</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Soluta impedit velit maiores nemo perferendis facere a
                            assumenda in sint illo provident pariatur ullam voluptates
                            id eveniet optio neque perspiciatis dolores quod, quisquam!
                            Repellendus alias laudantium nesciunt nostrum magnam debitis
                            quidem aut temporibus expedita accusantium, illum ipsam eos,
                            eveniet explicabo assumenda, laboriosam modi fugiat dolores dolor sit.
                        </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Soluta impedit velit maiores nemo perferendis facere a
                            assumenda in sint illo provident.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php $this->load->view('includes/footer.php'); ?>



</body>

</html>