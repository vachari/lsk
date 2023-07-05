
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>:: Shoperative ::</title>
    <link href="<?php echo CSS_PATH;?>bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>main.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>menu.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH;?>responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"  href="<?php echo CSS_PATH;?>bliss-slider.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <style> 
    
    input[type="submit"]{border-radius:40px !important;padding:5px 30px;}

    </style>
</head><!--/head-->

<body class="popup" >
    <div class="clearfix"></div>
    <div class="col-md-12  no-pad">
            <?php $this->load->view('includes/header.php');?>
    </div>
    <div class="clearfix"></div>
     
    <div class="clearfix">&nbsp;</div> <div class="clearfix">&nbsp;</div> <div class="clearfix">&nbsp;</div> <div class="clearfix">&nbsp;</div> <div class="clearfix">&nbsp;</div> <div class="clearfix">&nbsp;</div> <div class="clearfix">&nbsp;</div>
    <section>
        <div class="container ">
        <p id="message"></p>
      <div class="col-sm-10 col-sm-offset-1 bg_profile border">
        <?php if(!empty($follower)){
           // print_r($follower);die;
        foreach($follower as $row){

         ?>
        <div class="col-sm-10 col-sm-offset-1">
         
            <div class="col-sm-3">
                
          <img src="<?php echo IMG_PATH; ?>home-delivery.png" alt="Shoperative" class="img-responsive"/>
            </div>
        <div class="col-sm-6">
             
        <h5 class="m-t-19"><b><?php echo $row->user_name; ?></b></h5>
        <h5><?php echo $row->user_mobile; ?></h5>
        <h5><?php echo $row->user_city.' ,'.$row->state; ?></h5>
        </div>
        <input type="hidden" name="email" id="useremail-<?php echo $row->user_id; ?>" value="<?php echo $row->user_email; ?>">
        <input type="hidden" name="username" id="username-<?php echo $row->user_id; ?>" value="<?php echo $row->user_name; ?>">
         <div class="col-sm-3">
              <div class="clearfix">&nbsp;</div>  <div class="clearfix">&nbsp;</div>
        <?php if($this->user_id){ ?>
                  <button type="button" class="btn btn-md btn-primary" onclick="follower_user(<?php echo $row->user_id ; ?>)">Follow</button>
         <?php } else{ ?>
                  <a href="<?php echo base_url().'signin'; ?>" class="btn btn-md btn-primary">Follow</a>
          <?php } ?>
            
         </div>

          </div> 
          <div style="border-bottom: 1px solid #ccc;    margin: 5px 0px;" class="col-sm-12"></div>

<?php }  }else{ ?>
<div>No Data found</div>

<?php
} ?>
        </div>
</div>
    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
   
 </body>
</html>
<script type="text/javascript">
   function follower_user(id){
    var useremail =$("#useremail-"+id).val();
    var username =$("#username-"+id).val();
    if(useremail!="" && username!=""){
         $.ajax({
            url: '<?php echo base_url(); ?>front/User/follower_request',
            method: 'POST',
            data: {"useremail":useremail,'followerid':id,'username':username},
            dataType: 'json',
            success: function(s){
               console.log(s);
               if(s.code==200){
                $("#message").html(s.description);
               }else{
                 $("#message").html(s.description);
               }
            },
            error: function(e){
                console.log(e);
            }
        });
    }else{
   alert('Try Again!.') ;
    }
   } 
</script>