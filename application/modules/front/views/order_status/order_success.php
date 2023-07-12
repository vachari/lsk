<?php $this->load->view('includes/header_css.php'); ?>

<body onclick="redi()">

    <?php $this->load->view('includes/header.php'); ?>
    <!-- customer login start -->
    <div class="customer_login">
        <div class="container content_text ">
            <h2 class="text-center">Order Status</h2>
            <h3> Thank you for shopping..!</h3>
            <div class="container">
                <?php if ($this->session->flashdata('success')) {
                    echo "<div class='alert alert-success  alert-dismissible text-center'>" . $this->session->flashdata('success') . "<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                }
                if ($this->session->flashdata('failed')) {
                    echo "<div class='alert alert-danger  alert-dismissible text-center'>" . $this->session->flashdata('failed') . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                } ?>

            </div>
        </div>
        <?php $this->load->view('includes/footer.php'); ?>
</body>
<script type="text/javascript">
    function redi() {
        window.location.href = '<?php echo base_url(); ?>myorders';
    }
</script>

</html>