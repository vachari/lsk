<footer class="footer_widgets">
  <div class="footer_bottom footer_bottom_seven">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-7">
          <div class="copyright_area">
            <p>Copyright &copy; <?php echo date('Y'); ?> <a href="#"> <?php echo PROJECT_NAME; ?> </a> All Right Reserved.</p>
          </div>
        </div>
        <div class="col-lg-6 col-md-5">
          <div class="footer_payment text-right">
            <a href="<?php echo base_url(); ?>privacy-policy" class="footer-link pe-3 text-white">Privacy Policy</a>
            <a class="text-white pe-3" href="&nbsp;">|</a>
            <a href="<?php echo base_url(); ?>terms" class="footer-link text-white">Terms and Conditions</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Plugins JS -->
<script src="<?php echo JS_PATH; ?>plugins.js"></script>

<!-- Main JS -->
<script src="<?php echo JS_PATH; ?>main.js"></script>

<script type="text/javascript">
  function openCartItems() {
    setTimeout(function() {
      checkUser()
    }, 3000);

  }

  function checkUser() {
    //alert('working');
    //  $('#cart_icon').attr("aria-expanded","true");
    //$('#cart_icon').attr("aria-expanded","true");
  }

  var basepath = "<?php echo base_url(); ?>";
  var user_id = "<?php echo $this->user_id = $this->session->userdata('user_id'); ?>";
  var user_type = "<?php echo  $this->session->userdata('user_type'); ?>";
  var power_approved = "<?php echo  $this->session->userdata('power_approved'); ?>";
</script>
<script type="text/javascript">
  if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
      backToTop = function() {
        var scrollTop = $(window).scrollTop();
        if (scrollTop > scrollTrigger) {
          $('#back-to-top').addClass('show');
        } else {
          $('#back-to-top').removeClass('show');
        }
      };
    backToTop();
    $(window).on('scroll', function() {
      backToTop();
    });
    $('#back-to-top').on('click', function(e) {
      e.preventDefault();
      $('html,body').animate({
        scrollTop: 0
      }, 700);
    });
  }

  // This is the jQuery Ajax call

  function doSearch() {
    var search = $("#mysearch").val()
    // alert(search);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>front/Ajax/getdata/",
      data: {
        'search': search
      },
      success: function(data) {
        // console.log(data);
        $("#searchresults").html(data);
      }
    });
  }
</script>

<!-- popup script -->
<script type="text/javascript">
  //with this first line we're saying: "when the page loads (document is ready) run the following script"
  $(document).ready(function() {
    //select the POPUP FRAME and show it
    $("#open-popup").hide().fadeIn(1000);

    //close the POPUP if the button with id="close" is clicked
    $("#close").on("click", function(e) {
      e.preventDefault();
      $("#open-popup").fadeOut(1000);
    });
  });
</script>
<!-- popup script end -->

<script>
  function disnone() {
    document.getElementById("open-popup").style.display = "none";
  }
</script>
<!-- popup end -->
<!-- tooltip js -->
<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
<script type="text/javascript">
  $(function() {
    $('a[href="#"]').on('click', function(e) {
      e.preventDefault();
    });

    $('#menu > li').on('mouseover', function(e) {
      $(this).find("ul:first").show();
      $(this).find('> a').addClass('active');
    }).on('mouseout', function(e) {
      $(this).find("ul:first").hide();
      $(this).find('> a').removeClass('active');
    });

    $('#menu li li').on('mouseover', function(e) {
      if ($(this).has('ul').length) {
        $(this).parent().addClass('expanded');
      }
      $('ul:first', this).parent().find('> a').addClass('active');
      $('ul:first', this).show();
    }).on('mouseout', function(e) {
      $(this).parent().removeClass('expanded');
      $('ul:first', this).parent().find('> a').removeClass('active');
      $('ul:first', this).hide();
    });
  });
</script>
<!-- tooltip end -->
<script>
  $(document).ready(function() {
    $('body').addClass('js');
    var $menu = $('#menu'),
      $menulink = $('.menu-link'),
      $menuTrigger = $('.has-subnav > a');

    $menulink.click(function(e) {
      e.preventDefault();
      $menulink.toggleClass('active');
      $menu.toggleClass('active');
    });

    $menuTrigger.click(function(e) {
      e.preventDefault();
      var $this = $(this);
      $this.toggleClass('active').next('ul').toggleClass('active');
    });

  });
</script>
<!--menu script end-->
<script>
  //accodion 
  var acc = document.getElementsByClassName("accordion");
  var i;
  for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function() {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    }
  }

  /* $('#item_dispaly').on('click', function () {

   });*/
</script>
<script>
  function incQty(id, qty) {
    qty = $('#itemqty' + id).text();
    var newqty = parseInt(qty) + 1;
    updateCart(id, newqty);
    location.reload();
  }

  function decQty(id, qty) {

    qty = $('#itemqty' + id).text();
    var newqty = parseInt(qty) - 1;
    updateCart(id, newqty);
    location.reload();
  }

  function updateCart(id, newqty) {
    if (id != '' && newqty > 0) {
      $.ajax({
        dataType: 'json',
        type: 'post',
        data: {
          'cart_id': id,
          'qty': newqty
        },
        url: basepath + 'front/Cart/cartUpdate/',
        success: function(u) {
          console.log(u);
          if (u.code == '200') {
            $('#itemqty' + id).html(newqty);
            var unit_price = $('#itemunitprice' + id).text();
            $('#itemtotal' + id).html(newqty * parseInt(unit_price));
          }

        },
      });
    } else {
      // $('html, body').animate({ scrollTop: 0 }, 0);
      $('#fail').show();
      $('#failmessage').html('Unable to update').addClass('text-center alert alert-danger');
      // setTimeout(function() {window.location=location.href;},2000);
    }


  }
</script>