<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Email </title>
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
   <div class="container" style="border:1px solid #eee;">
        <table class="table table-bordered">
            <tr>
 
                <th  colspan="4" class="text-center"><center>
              <a href="<?php echo SITE_DOMAIN ?>"><img src="<?php echo SITE_DOMAIN ?>/assets/images/logo.png" alt="" class="img-responsive"></a> </center> </th>

            </tr>
            <?php ?>
            <tr>
            	<th colspan="4"><h3> Welcome to Shoperative <br><small>Thank you for joining with us!</small></h3>	</th>
            </tr>
            <tr >
                <th>Name</th><td> <?php echo $name; ?></td>
            </tr>
            <tr>
                <th>Email</th><td> <?php echo $email; ?></td>
            </tr>

            <tr>
                <th>Mobile</th><td> <?php echo $mobile;?></td>
            </tr>

            <tr>
                <th>Message</th><td> <?php echo $message;?></td>
            </tr>
            <?php  ?>
        </table>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>


