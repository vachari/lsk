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
                                    <li>Frequently Questions</li>
                                </ul>
                            </div>
                            <div class="heading-banner-title">
                                <h1>frequently questions</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!--Frequently Questions Area Start-->
        <section class="frequently-question mt-20">
            <div class="container">
                <div class="row">
                    <!--Frequently Content Start-->
                    <div class="col-lg-12">
                        <div class="frequently-content mb-50">
                            <div class="frequently-title">
                                <h4>Below are frequently asked questions, you may find the answer for yourself</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec id erat sagittis, faucibus metus malesuada, eleifend turpis. Mauris semper augue id nisl aliquet, a porta lectus mattis. Nulla at tortor augue. In eget enim diam. Donec gravida tortor sem, ac fermentum nibh rutrum sit amet. Nulla convallis mauris vitae congue consequat. Donec interdum nunc purus, vitae vulputate arcu fringilla quis. Vivamus iaculis euismod dui.</p>
                            </div>
                        </div>
                    </div>
                    <!--Frequently Content End-->
                </div>
                <div class="row">
                    <!--Frequently Accordion Start-->
                    <div class="col-lg-12">
                        <div class="goroup-accrodion mb-60">
                            <div class="accordion" id="accordionExample">
                                <!--Single Accrodion Start-->
                                <div class="card active">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Mauris congue euismod purus at semper. Morbi et vulputate massa?</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">Donec mattis finibus elit ut tristique. Nullam tempus nunc eget arcu vulputate, eu porttitor tellus commodo. Aliquam erat volutpat. Aliquam consectetur lorem eu viverra lobortis. Morbi gravida, nisi id fringilla ultricies, elit lorem eleifend lorem</div>
                                    </div>
                                </div>
                                <!--Single Accrodion End-->
                                <!--Single Accrodion Start-->
                                <div class="card panel-default">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Donec mattis finibus elit ut tristique?</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body">Donec mattis finibus elit ut tristique. Nullam tempus nunc eget arcu vulputate, eu porttitor tellus commodo. Aliquam erat volutpat. Aliquam consectetur lorem eu viverra lobortis. Morbi gravida, nisi id fringilla ultricies, elit lorem eleifend lorem</div>
                                    </div>
                                </div>
                                <!--Single Accrodion End-->
                                <!--Single Accrodion Start-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Vestibulum a lorem placerat, porttitor urna vel?</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                        <div class="card-body">Donec mattis finibus elit ut tristique. Nullam tempus nunc eget arcu vulputate, eu porttitor tellus commodo. Aliquam erat volutpat. Aliquam consectetur lorem eu viverra lobortis. Morbi gravida, nisi id fringilla ultricies, elit lorem eleifend lorem</div>
                                    </div>
                                </div>
                                <!--Single Accrodion End-->
                                <!--Single Accrodion Start-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                Aenean elit orci, efficitur quis nisl at, accumsan?</a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                        <div class="card-body">Donec mattis finibus elit ut tristique. Nullam tempus nunc eget arcu vulputate, eu porttitor tellus commodo. Aliquam erat volutpat. Aliquam consectetur lorem eu viverra lobortis. Morbi gravida, nisi id fringilla ultricies, elit lorem eleifend lorem</div>
                                    </div>
                                </div>
                                <!--Single Accrodion End-->
                                <!--Single Accrodion Start-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                Pellentesque habitant morbi tristique senectus et netus?</a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                        <div class="card-body">Donec mattis finibus elit ut tristique. Nullam tempus nunc eget arcu vulputate, eu porttitor tellus commodo. Aliquam erat volutpat. Aliquam consectetur lorem eu viverra lobortis. Morbi gravida, nisi id fringilla ultricies, elit lorem eleifend lorem</div>
                                    </div>
                                </div>
                                <!--Single Accrodion End-->
                                <!--Single Accrodion Start-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                Nam pellentesque aliquam metus?</a>
                                        </h4>
                                    </div>
                                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                        <div class="card-body">Donec mattis finibus elit ut tristique. Nullam tempus nunc eget arcu vulputate, eu porttitor tellus commodo. Aliquam erat volutpat. Aliquam consectetur lorem eu viverra lobortis. Morbi gravida, nisi id fringilla ultricies, elit lorem eleifend lorem</div>
                                    </div>
                                </div>
                                <!--Single Accrodion End-->
                                <!--Single Accrodion Start-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                Aenean elit orci, efficitur quis nisl at?</a>
                                        </h4>
                                    </div>
                                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                                        <div class="card-body">Donec mattis finibus elit ut tristique. Nullam tempus nunc eget arcu vulputate, eu porttitor tellus commodo. Aliquam erat volutpat. Aliquam consectetur lorem eu viverra lobortis. Morbi gravida, nisi id fringilla ultricies, elit lorem eleifend lorem</div>
                                    </div>
                                </div>
                                <!--Single Accrodion End-->
                                <!--Single Accrodion Start-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                Morbi gravida, nisi id fringilla ultricies, elit lorem?</a>
                                        </h4>
                                    </div>
                                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                                        <div class="card-body">Donec mattis finibus elit ut tristique. Nullam tempus nunc eget arcu vulputate, eu porttitor tellus commodo. Aliquam erat volutpat. Aliquam consectetur lorem eu viverra lobortis. Morbi gravida, nisi id fringilla ultricies, elit lorem eleifend lorem</div>
                                    </div>
                                </div>
                                <!--Single Accrodion End-->
                            </div>
                        </div>
                    </div>
                    <!--Frequently Accordion End-->
                </div>
            </div>
        </section>
        <!--Frequently Questions Area End-->

        <?php $this->load->view('includes/footer'); ?>

    </div>


</body>

</html>