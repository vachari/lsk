<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Register Success  </title>
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
   <div class="col-md-6" style="border:2px solid green;" >
        <table class="table table-nobordered">
            <tr>

                 <th  colspan="4" class="text-center"><center>
              <a href="<?php echo SITE_DOMAIN ?>"><img src="<?php echo SITE_DOMAIN ?>/assets/images/logo.png" alt="" class="img-responsive"></a> </center> </th>

            </tr>
            <?php  if(!empty($user_data)){?>
            <tr style="background: green;color:#fff;">
            	<th colspan="4" class="text-center" style="text-align: center;"><h4> Welcome to Shoperative </h4>	</th>
            </tr>
            <tr><td colspan="5">
              <br>
                Hi <?php  echo $user_data['user_name']; ?>,
                <br>   
              Welcome to Shoperative.
                <br> 
                <br> 
                <p>
                  We are excited to add you as a Power User to the  GHAR AAHAAR community. <br>
                 Your Account Successfully Registerd To activate your account please click on the link below
                </p>
                <br>
                <b>Activation Link : </b>
                <a href="<?php echo $user_data['link']; ?> " class="btn btn-info btn-sm">Click here  </a> 
                <br><br>
                <p>
                  For any queries or help, please contact us at info@shoperative.in . Wish you a long and fruitful association with Shoperative.
                </p>
                <br>
                Thank you,<br>
                Team Shoperative
            </td></tr>
            <?php } ?>
        </table>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>


