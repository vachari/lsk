<div class="clearfix">&nbsp;</div>
        <div class=" col-md-12 footer">
                <div class="container ">
                    <div class="col-md-12 no-pad">
                        <div class="col-md-4  hidden-xs">
                            <h4>Quick Links</h4>
                            <ul>
                                <li><a href="<?php echo base_url();?>about">About Us</a></li>
                               <!--  <li><a href="#">Blog</a></li> -->
                                <li><a href="<?php echo base_url();?>terms">Terms&nbsp;&amp;&nbsp;Conditions</a></li>
                                <li><a href="<?php echo base_url();?>privacy-policy">Privacy Policy</a></li>
                                <li><a href="<?php echo base_url();?>cancellation-policy">Cancellation & Return Policy</a></li>
                                <li><a href="<?php echo base_url();?>refund-policy">Refund Policy</a></li>
                                <li><a href="<?php echo base_url();?>faq">Faq</a></li>
                                <li><a href="<?php echo base_url();?>contact">Contact</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4  hidden-xs">
                            <h4>Need Help&nbsp;?</h4>
                             <!-- <ul>
                                <li><a href="<?php //echo base_url();?>about">About Us</a></li>
                              <li><a href="#">Blog</a></li> -->
<!--                                 <li><a href="<?php//echo base_url();?>terms">Terms&nbsp;&amp;&nbsp;Conditions</a></li>
                                <li><a href="<?php // base_url();?>privacy-policy">Privacy Policy</a></li>
                                <li><a href="<?php //echo base_url();?>cancellation-policy">Cancellation & Return Policy</a></li>
                                <li><a href="<?php //echo base_url();?>refund-policy">Refund Policy</a></li>
                                <li><a href="<?php //echo base_url();?>faq">Faq</a></li>
                                <li><a href="<?php// echo base_url();?>contact">Contact</a></li> -->
                            <!-- </ul> -->
                        </div>
                        <div class="col-md-4">
                            <h4>Follow Us</h4>
                            <ul class="list-inline">
                            <li><a href="#" class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#" class="y"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                <li><a href="#" class="g"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                
                            </ul>
                        </div>
                    <!--     <div class="col-md-3">
                            <h4>Keep up with latest news</h4>
                            <input type="text" name="" class="from-control "    placeholder="Enter Email" />
                            <input type="submit" name="" value="Subscribe" />
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-12 sub-foot  hidden-xs">
                <div class="container ">
               <div class="col-md-4">
                 <p>Copyright &copy; <?php echo date('Y');?> <a href="<?php echo SITE_DOMAIN ?>"> Shoperative.</a> All Rights Reserved.</p>
                </div>
                <div class="col-md-8">
                    <p class="pull-right">Design & Developed by :<a href="http://www.richlabz.com" target="_blank"> Richlabz IT Solutions Pvt.Ltd</a> </p> 
               </div>
            </div>
        </div>
       <!--  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sub-foot">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <p>Copyright&nbsp;&copy;&nbsp;2017 Ghar Adhar. All Rights Reserved.</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right text-right">
            <p>Powered By&nbsp;:&nbsp;<a href="#" target="_blank">Richlabz It Solutions Pvt Ltd.</a></p>
        </div>
        </div> -->
<!--    </div>-->
    <script src="<?php echo JS_PATH;?>jquery.js"></script>

    <script src="<?php echo JS_PATH;?>jquery-ui.js"></script>
<!--
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
-->
    <script type="text/javascript">
        
function openCartItems()
{
    setTimeout(function(){checkUser()},3000);
   
    }

function checkUser()
{
    //alert('working');
  //  $('#cart_icon').attr("aria-expanded","true");
    //$('#cart_icon').attr("aria-expanded","true");
}

var basepath = "<?php echo base_url();?>";
var user_id= "<?php echo $this->user_id=$this->session->userdata('user_id'); ?>";
var user_type="<?php echo  $this->session->userdata('user_type');?>";
var power_approved ="<?php echo  $this->session->userdata('power_approved');?>";    

    </script>
<script type="text/javascript">
        if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}

// This is the jQuery Ajax call

   function doSearch()
   {
      var search = $("#mysearch").val()
    // alert(search);
      $.ajax({
         type: "POST",
         url:"<?php echo base_url();?>front/Ajax/getdata/",
         data:{ 'search': search },
         success:function(data){
            // console.log(data);
         $("#searchresults").html(data);
      }});
   }

    </script> 

    <!-- popup script -->
       <script type="text/javascript">
        //with this first line we're saying: "when the page loads (document is ready) run the following script"
$(document).ready(function () {
    //select the POPUP FRAME and show it
    $("#open-popup").hide().fadeIn(1000);

    //close the POPUP if the button with id="close" is clicked
    $("#close").on("click", function (e) {
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
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script type="text/javascript">
$(function(){
  $('a[href="#"]').on('click', function(e){
    e.preventDefault();
  });
  
  $('#menu > li').on('mouseover', function(e){
    $(this).find("ul:first").show();
    $(this).find('> a').addClass('active');
  }).on('mouseout', function(e){
    $(this).find("ul:first").hide();
    $(this).find('> a').removeClass('active');
  });
  
  $('#menu li li').on('mouseover',function(e){
    if($(this).has('ul').length) {
      $(this).parent().addClass('expanded');
    }
    $('ul:first',this).parent().find('> a').addClass('active');
    $('ul:first',this).show();
  }).on('mouseout',function(e){
    $(this).parent().removeClass('expanded');
    $('ul:first',this).parent().find('> a').removeClass('active');
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
            acc[i].onclick = function () {
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
