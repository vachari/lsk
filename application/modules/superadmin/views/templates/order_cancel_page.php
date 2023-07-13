<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Cancel Order</title>
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

    .alert-success {
      background-image: -webkit-linear-gradient(top, #dff0d8 0, #c8e5bc 100%);
      background-image: -o-linear-gradient(top, #dff0d8 0, #c8e5bc 100%);
      background-image: -webkit-gradient(linear, left top, left bottom, from(#dff0d8), to(#c8e5bc));
      background-image: linear-gradient(to bottom, #dff0d8 0, #c8e5bc 100%);
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffdff0d8', endColorstr='#ffc8e5bc', GradientType=0);
      background-repeat: repeat-x;
      border-color: #b2dba1;
    }

    .alert {
      text-shadow: 0 1px 0 rgba(255, 255, 255, .2);
      -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .25), 0 1px 2px rgba(0, 0, 0, .05);
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, .25), 0 1px 2px rgba(0, 0, 0, .05);
    }

    .alert-success {
      color: #3c763d;
      background-color: #dff0d8;
      border-color: #d6e9c6;
    }

    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 4px;
    }
  </style>
</head>

<body>
  <div class="container">
    <table class="table table-nobordered">
      <tr>

        <th colspan="4" class="text-center">
          <center>
            <a href="<?php echo SITE_DOMAIN ?>"><img src="<?php echo SITE_DOMAIN ?>/assets/images/logo.png" alt="" class="img-responsive"></a>
          </center>
        </th>

      </tr>
      <tr>
        <td colspan="5">
          <div class="container">
            <?php
            // print_r($orderdata);
            if (!empty($orderdata)) { ?>

              <h3 class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> <?php echo $orderdata['order_status'] . ' '; ?> Successfully </h3>
              <!-- <p> Order Number : &nbsp; <b><?php echo $orderdata['order_number']; ?> </b></p> -->
              <br>
              <p> Hi, <br> Greetings....! <!-- <?php echo ucfirst($orderdata['name']); ?> --></p>
              <p style="text-indent: 20">
                Your Order <b class="text-success"> #<?php echo $orderdata['order_number']; ?> </b> <?php echo $orderdata['order_status']; ?> successfully. If you'd like to buy another product or another order, visit <a href="<?php echo SITE_DOMAIN ?>" style="" target="_blank"> <?php echo SITE_DOMAIN ?> </a>
                <br><br>
              </p>
              <p>
                Thank You,<br>
                <b><?php echo SITE_NAME; ?> Customer Care.</b>
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