<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Cancel Order </title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <style type="text/css">
    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
      padding: 8px;
      line-height: 1.42857143;
      vertical-align: top;
      border-top: 0px solid #ddd;
    }
  </style>
</head>

<body>
  <div class="container">
    <table class="table table-nobordered">
      <tr>

        <th colspan="4" class="text-center">
          <center>
            <a href="<?php echo SITE_DOMAIN ?>"><img src="https://lskoffers.com/assets/images/lsk-logo.svg" alt="" class="img-responsive"></a>
          </center>
        </th>

      </tr>
      <tr>
        <td colspan="5">
          <div class="container">
            <?php
            if (!empty($orderdata['order_data'])) { ?>

              <h3 class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> Order Canceled </h3>
              <p> Order Number :<?php echo $orderdata['order_data']['order_number']; ?></p>
              <br>
              <p> Dear <?php echo ucfirst($orderdata['order_data']['name']); ?></p>
              <p style="text-indent: 20">
                Your Order <b class="text-success"> #<?php echo $orderdata['order_data']['order_number']; ?> </b> Cancelled successfully.If you'd like to buy another product or another order , visit <a href="<?php echo SITE_DOMAIN ?>" style="text-decoration: none;color:black;"> <?php echo SITE_DOMAIN ?> </a>.
                <br><br>
              </p>
              <p>
                Thank You,<br>
                <b><?php echo SITE_NAME; ?> Customer Care</b>
              </p>
            <?php } ?>
          </div>
        </td>
      </tr>
    </table>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>

</html>