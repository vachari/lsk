<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo SITE_NAME; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Calibri|Open+Sans|Roboto|Muli" rel="stylesheet">

</head>

<body>
    <div style="width:600px;margin:0 auto;border:1px solid #ccc;background-color: #151515; color:#fff;font-family: 'Muli',sans-serif;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;">

        <div style="width:100%;background: #fff;text-align: center">

            <div style="width:40%;float: left">
                <img src="<?php echo PROJECT_LOGO; ?>" style="width: 90%;padding-top : 9px;">
            </div>
            <div style="width:60%;float: right">
                <div style="width:100%;padding-top: 21px;">

                    <a href="#"> <img src="<?php echo IMG_PATH; ?>tw-white.png" alt="twitter" title="twitter" style="float: right;margin-right: 12px;    margin-left: 4px;"> </a>
                    <a href="#"> <img src="<?php echo IMG_PATH; ?>fb-white.png" alt="facebook" title="facebook" style="float: right"> </a>
                </div>
            </div>
        </div>
        <div style="clear: both"></div>
        <div style="width:100%;background: #151515;text-align: center">

            <h3 style="margin-top: 0px;padding-bottom: 20px;margin-bottom: 0px;color: #fff"><?php echo PROJECT_TITLE; ?></h3>
        </div>

        <div style="background-color:#ffffff;color:#333;padding:20px 21px;">
            <p style="line-height: 26px;"><b>Welcome to the <?php echo SITE_NAME; ?> community.</b></p>
            <p>Order Number : <?php echo $user_data['order_number']; ?></p>
            <p>Order Status : <?php echo $user_data['track_status']; ?></p>
            <p>Comments : <?php echo $user_data['track_comments']; ?></p>
        </div>
        <div style="text-align: center;margin-top: 22px">

            <h4 style="margin-top: 10px;margin-bottom: 0px">Regards</h4>
            <h3 style="margin-top: 5px;margin-bottom: 5px"><?php echo SITE_NAME; ?> Team</h3>
            <p style="margin-top: 2px"><b> Contact : +91 <?php echo PROJECT_PHONE; ?></b></p>
        </div>

    </div>
</body>

</html>