<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shoperative</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Calibri|Open+Sans|Roboto|Muli" rel="stylesheet">

 </head>
<body>
<div style="width:600px;margin:0 auto;border:1px solid #ccc;background-color: #151515; color:#fff;font-family: 'Muli',sans-serif;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;">
     
  <div style="width:100%;background: #fff;text-align: center">
  
<div style="width:40%;float: left">
         <img src="<?php echo IMG_PATH;?>logo.png" style="width: 90%;padding-top : 9px;">
        </div>
<div style="width:60%;float: right">
    <div style="width:100%;padding-top: 21px;">
        
    <a href="#"> <img src="<?php echo IMG_PATH;?>tw-white.png" alt="twitter" title="twitter" style="float: right;margin-right: 12px;    margin-left: 4px;"> </a>
    <a href="#"> <img src="<?php echo IMG_PATH;?>fb-white.png" alt="facebook" title="facebook" style="float: right"> </a>
    </div>
        </div>
  </div>
    <div style="clear: both"></div>
    <div style="width:100%;background: #151515;text-align: center">
  
     <h3 style="margin-top: 0px;padding-bottom: 20px;margin-bottom: 0px;color: #fff">Global Network of Food Coop's</h3>
  </div>
   
    <div style="background-color:#ffffff;color:#333;padding:20px 21px;">
  <p style="line-height: 26px;"><b>Welcome to Shoperative</b></p>
  <p style="line-height: 26px;">Dear <b>User</b>,</p>
  <p style="line-height: 26px;">Your Power user( <?php echo $powerUserName; ?>) shared cart end date and cart link, please shop on the same cart.</p>
  <p style="line-height: 26px;"> End Date: <?php echo date('d-M-Y',strtotime($end_date)); ?></p>
  <p style="line-height: 26px;"> Link to check cart: <a href="<?php echo $link; ?>" class="btn btn-sm btn-primary">Click here</a></p>


   
   </div>
        <div style="text-align: center;margin-top: 22px">
      
        <h4 style="margin-top: 10px;margin-bottom: 0px">Regards</h4>
        <h3 style="margin-top: 5px;margin-bottom: 5px">Shoperative Team</h3>
         <p style="margin-top: 2px"><b> Contact  : +91 9866567070</b></p>
        </div>
  
    </div>
 </body>
</html>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Share Cart </title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style type="text/css">.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 0px solid #ddd;
}</style>
  </head> 
  <body>
   <div class="container" style="border:1px solid #eee; padding:10px;">
            <table class="table table-bordered">
            <tr>
                 <th  colspan="4" class="text-center"><center>
              <a href="<?php echo SITE_DOMAIN ?>"><img src="<?php echo SITE_DOMAIN ?>/assets/images/logo.png" alt="" class="img-responsive"></a> </center> </th>
            </tr>
           
        </table>
            <h3> Welcome to Shoperative <br><small>Dear User, <br>
                        Your Power user( <?php echo $powerUserName; ?>) shared cart end date and cart link, please shop on the same cart.</small></h3>
          
               End Date: <?php echo date('d-M-Y',strtotime($end_date)); ?>
            <br>
               Link to check cart: <a href="<?php echo $link; ?>" class="btn btn-sm btn-primary">Click here</a>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>


