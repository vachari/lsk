  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>:: Shoperative ::</title>
      <link href="<?php echo CSS_PATH; ?>bootstrap.min.css" rel="stylesheet" />
      <link href="<?php echo CSS_PATH; ?>font-awesome.min.css" rel="stylesheet" />
      <link href="<?php echo CSS_PATH; ?>main.css" rel="stylesheet" />
      <link href="<?php echo CSS_PATH; ?>menu.css" rel="stylesheet" />
      <link href="<?php echo CSS_PATH; ?>tabs.css" rel="stylesheet" />
      <link href="<?php echo CSS_PATH; ?>accod.css" rel="stylesheet" />
      <link href="<?php echo CSS_PATH; ?>responsive.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>bliss-slider.css">
      <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
      <style type="text/css">
          label {
              margin: 0 !important;
          }

          .share-share {
              margin: -45px 0 0px -15px;
          }

          .hov:hover {
              cursor: pointer;
          }

          td,
          th {
              padding: 2px 5px !important;
          }
          input[type=text],input[type=textarea]{
              margin: 0 !important;
              padding-top:1px !important;
          }
          .form-group {
              margin: 2px 0 !important;
          }
          .form-group h3{
             margin: 5px 0 !important;
          }
          
      </style>
  </head>
  <!--/head-->

  <body class="popup " id="font-maven">
      <div class="clearfix"></div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
          <?php $this->load->view('includes/header.php'); ?>
      </div>
      <section>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full-bg martop150 ">

              <div class="col-md-12 ">
                  <!-- <h2 class="text-titel"> <b> ABOUT US </b></h2> -->
                  <div class="container">
                      <ol class="breadcrumb">
                          <li><a href="<?php echo base_url(); ?>"> Home </a></li>
                          <li><a href="<?php echo base_url() . 'checkout'; ?>"> Checkout </a></li>
                          <li class="active">Shipping</li>
                      </ol>
                  </div>

              </div>
              <div class="col-md-12 content_text ">
                  <div class="container">
                      <?php if ($this->session->flashdata('success')) {
                            echo "<div class='alert alert-success  alert-dismissible text-center'>" . $this->session->flashdata('success') . "<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                        }
                        if ($this->session->flashdata('failed')) {
                            echo "<div class='alert alert-danger  alert-dismissible text-center'>" . $this->session->flashdata('failed') . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                        } ?>

                      <div class="col-md-9">

                          <div class="forn-group col-md-6 ">
                              <h3>Ship to this address</h3>
                              <span id="successmessage"></span>
                              <?php
                                $userinfo = json_decode($userinfo);
                                $user_data = $userinfo->result;
                                $addres = json_decode($address_list);
                                foreach ($addres->result as $list) {


                                ?>
                                  <div class="col-md-10  bord hov mrtop" onclick="addressClick(<?php echo  $list->id; ?>)" id="addlist">

                                      <h4 class=""><b><?php echo ucfirst($list->title); ?></b> </h4>
                                      <hr>

                                      <p><?php
                                            echo  $list->name;
                                            echo ', <br>';
                                            echo  $list->mobile;
                                            echo ', <br>';
                                            $list->address;
                                            $data = explode(',', $list->address);
                                            print_r(implode(',' . '<br>', $data));
                                            echo ", ";
                                            echo  $list->state . ',' . $list->city;
                                            echo ', <br>';
                                            echo 'Pincode : ' . $list->pincode;
                                            ?></p>
                                  </div> <br>
                              <?php } ?>
                              <div class="col-md-12">

                                  <p class="help-block">Note : Add new address here click here.
                                      <a href="<?php echo base_url() . 'addressbook'; ?>" class="btn btn-xs btn-primary" target="_blank">Address Book </a>
                                  </p>
                              </div>
                          </div>
                          <div class="form-group col-md-6 bord">
                              <?php echo form_open('front/Orders/orders'); ?>
                              <div id="addressList" class="my-1 py-0">
                                  <div class="form-group">
                                      <h3 class=""> Ship to a new address </h3>
                                      <label for="username">Name <span id="name_error" class="text-red form-label"> * <?php echo form_error('name'); ?> </span> </label>
                                      <input type="text" name="name" id="username" placeholder="Enter name" class="form-control" autocomplete="off" min="3" value="<?php echo $user_data->user_name; ?>">
                                  </div>
                                  <div class="form-group ">
                                      <label for="mobile">Mobile <span id="mobile_error" class="text-red"> * <?php echo form_error('title'); ?> </span> </label>
                                      <input type="text" name="mobile" id="usermobile" placeholder="Enter mobile " class="form-control" autocomplete="off" maxlength="10" value="<?php echo $user_data->user_mobile; ?>">
                                  </div>
                                  <div class="form-group ">
                                      <label class="text-capitalize">address <span id="address_error" class="text-red"> * <?php echo form_error('address'); ?> </span> </label>
                                      <textarea name="address" id="useraddress" placeholder=" Door.no , Street name , Landmark" class="form-control"><?php if (empty($last_address->address)) {
                                                                                                                                                            echo $user_data->user_address;
                                                                                                                                                        } else {
                                                                                                                                                            echo $last_address->address;
                                                                                                                                                        } ?></textarea>
                                  </div>
                                  <div class="form-group ">
                                      <label for="">State <span id="state_error" class="text-red"> * <?php echo form_error('state'); ?> </span> </label>
                                      <!-- <input type="text" name="state" id="userstate" placeholder="Enter state " class="form-control" autocomplete="off" min="2" value="<?php echo $user_data->state; ?>"> -->
                                      <select name="state" id="userstate" class="form-control">
                                          <option><?php if (!empty($user_data->state)) echo $user_data->state; ?></option>
                                          <option>Andhra Pradesh</option>
                                          <option>Arunachal Pradesh</option>
                                          <option>Assam</option>
                                          <option>Bihar</option>
                                          <option>Chhattisgarh</option>
                                          <option>Goa</option>
                                          <option>Gujarat</option>
                                          <option>Hariyana</option>
                                          <option>Himachal Pradesh</option>
                                          <option>Jammu & Kashmir</option>
                                          <option>Jharkhand</option>
                                          <option>Karnataka</option>
                                          <option>Kerala</option>
                                          <option>Madhya Pradesh</option>
                                          <option>Maharashtra</option>
                                          <option>Manipur</option>
                                          <option>Meghalaya</option>
                                          <option>Mizoram</option>
                                          <option>Nagaland</option>
                                          <option>Odisha</option>
                                          <option>Punjab</option>
                                          <option>Rajasthan</option>
                                          <option>Sikkim</option>
                                          <option>Tamil Nadu</option>
                                          <option>Telangana</option>
                                          <option>Tripura</option>
                                          <option>Uttarakhand</option>
                                          <option>Uttar Pradesh</option>
                                          <option>West Bengal</option>
                                      </select>
                                  </div>
                                  <div class="form-group ">
                                      <label for="">City <span id="city_error" class="text-red"> * <?php echo form_error('city'); ?> </span> </label>
                                      <input type="text" name="city" id="usercity" placeholder="Enter city " class="form-control" autocomplete="off" min="3" value="<?php if (empty($last_address->city)) {
                                                                                                                                                                        echo $user_data->user_city;
                                                                                                                                                                    } else {
                                                                                                                                                                        echo $last_address->city;
                                                                                                                                                                    } ?>">
                                  </div>
                                  <div class="form-group ">
                                      <label for="">Pincode <span id="pincode_error" class="text-red"> * <?php echo form_error('pincode'); ?> </span> </label>
                                      <input type="" name="pincode" id="userpincode" placeholder="Enter pincode " class="form-control" autocomplete="off" maxlength="6" value="<?php if (!empty($last_address->pincode)) {
                                                                                                                                                                                    echo $last_address->pincode;
                                                                                                                                                                                } ?>">
                                  </div>
                              </div>
                              <div class="form-group col-md-12 pull-right no-pad">
                                  <label><b>Payment Mode : </b><span id="radio_error" class="text-red"> Online</span></label><br>
                                  <input type="hidden" name="mod" id="radiobtn" value="online">

                              </div>

                          </div>

                      </div>
                      <div class="col-md-3">
                          <div class="row">
                              <div class="col-12">
                                  <h4>Order Summary</h4>
                                  <hr>
                                  <?php
                                    $cartStatisticsReq = json_decode($cartUStatistics);
                                    ?>
                                  <table class="table table-bordered ">
                                      <tr>
                                          <td>Total Item Count</td>
                                          <td>
                                              <p>
                                                  <?php echo $cartStatisticsReq->cart_count; ?>
                                              </p>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>Sub total</td>
                                          <td class="text-right">
                                              <p>
                                                  <?php echo $cartStatisticsReq->cart_amount; ?>
                                              </p>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>Service Charge</td>
                                          <td class="text-right">
                                              <?php echo $cartStatisticsReq->cart_service_charge; ?>

                                          </td>
                                      </tr>
                                      <tr>
                                          <td>Shipping Charges</td>
                                          <td class="text-right">

                                              <?php echo $cartStatisticsReq->cart_shipping; ?>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>Total Saving </td>
                                          <td class="text-right text-success">
                                              <?php echo $cartStatisticsReq->cart_discount; ?>

                                          </td>
                                      </tr>

                                  </table>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-12">

                                  <h4 class="pull-left text-red">Grand Total</h4>
                                  <h4 class="pull-right text-red">
                                      <?php echo " ₹ " . $cartStatisticsReq->cart_grand_total; ?>
                                  </h4>

                              </div>
                          </div>
                          <!-- 							                                   
                                    <div class="text-center">
                                  
                                    <a href="<?php echo base_url() . 'shipping'; ?>" class="btn  btn-md btn-gand" style="">Proceed to Pay</a> 
                                    </div>
                                    <hr>
                                    -->
                          
                      
                      <div class="row">
                          <div class="col-12">
                          <!--As required I have created an input field hidden
					which takes the flag either wallet to be used or not
					this value comes from chechout page and passed to shipping page as($use_wallet)
				-->
                          <?php $submit_btn_value = "Proceed To Pay"; //
                            if ($this->tot_wallet_amount > 0 && $use_wallet == 1) { ?>
                              <h5><span class="text-red">*&nbsp;Note:</span>You have
                                  <span class="text-red"> (₹ <?php echo $this->tot_wallet_amount; ?>)</span>
                                  In Your Wallet
                              </h5>
                              <input type="hidden" name="use_wallet" id="use_wallet" value="<?php echo $use_wallet; ?>">
                              <?php if ($this->tot_wallet_amount >= $cartStatisticsReq->cart_grand_total) {
                                    $submit_btn_value = "Place My Order";
                                ?>
                                  <h5><span class="text-red"> * </span><?php echo "Your wallet amount <span class='text-red'>( ₹ " . $cartStatisticsReq->cart_grand_total . " ) </span>will be used" ?> </h5>
                              <?php } else { ?>
                                  <h5><span class="text-red"> * </span>
                                      <?php $rem_amount = ($cartStatisticsReq->cart_grand_total) - ($this->tot_wallet_amount);
                                        echo "Total remaining amount to be pay<span class='text-red'>( ₹ " . $rem_amount . ")</span>" ?> </h5>
                          <?php }
                            } ?>
                      
                          <a href="<?php echo base_url(); ?>" class="btn  btn-md btn-primary" style="">Continue Shopping</a>
                          <input type="submit" id="submit_btn" class="btn btn-gand btn-md" onclick="return validation()" value="<?php echo $submit_btn_value; ?>">
                      </div>
                   
                 
                  <?php echo form_close(); ?>

              </div>
          </div>
      </section>


      <?php $this->load->view('includes/footer'); ?>
      <script src="<?php echo JS_PATH; ?>bootstrap.min.js"></script>
      <script type="text/javascript" src="<?php echo JS_PATH; ?>menu.js"></script>
      <script type="text/javascript" src="<?php echo JS_PATH; ?>bliss-slider.js"></script>
      <script type="text/javascript" src="<?php echo JS_PATH; ?>bliss-slider.js"></script>

  </body>

  </html>
  <script type="text/javascript">
      function validation(e) {
          // e.preventDefault();
          var name = $('#username').val();
          var mobile = $('#usermobile').val();
          var state = $('#userstate').val();
          var city = $('#usercity').val();
          var address = $('#useraddress').val();
          var pincode = $('#userpincode').val();
          var address = $('#useraddress').val();
          var pincodepatteren = /^[0-9]{6}$/;
          var mobilepattern = /^[6-9]+[0-9]{9}$/;
          var str = true;
          $('#name_error,#pincode_error,#address_error,#state_error,#city_error,#mobile_error').html('');
          $('#username,#userpincode,#useraddress,#userstate,#usercity,#usermobile').css('border', '');

          if (name == '' || name == ' ') {
              str = false;
              $('#username').css('border', '1px solid red');
              $('#name_error').html(' * Please enter name');
          }

          if (mobile == '' || mobile == ' ') {
              str = false;
              $('#usermobile').css('border', '1px solid red');
              $('#mobile_error').html(' * Please enter mobile');
          } else if (!mobilepattern.test(mobile)) {
              str = false;
              $('#usermobile').css('border', '1px solid red');
              $('#mobile_error').html(' * Please enter valid mobile');
          }

          if (address == '' || address == '') {
              str = false;
              $('#useraddress').css('border', '1px solid red');
              $('#address_error').html(' * Please enter address');
          }
          if (state == '' || state == '') {
              str = false;
              $('#userstate').css('border', '1px solid red');
              $('#state_error').html(' * Please Select state');
          }
          if (city == '' || city == '') {
              str = false;
              $('#usercity').css('border', '1px solid red');
              $('#city_error').html(' * Please enter city');
          }
          if (pincode == '' || pincode == ' ') {
              str = false;
              $('#userpincode').css('border', '1px solid red');
              $('#pincode_error').html(' * Please enter pincode');
          } else if (!pincodepatteren.test(pincode)) {
              str = false;
              $('#userpincode').css('border', '1px solid red');
              $('#pincode_error').html(' * Please enter valid pincode');
          }


          return str;

      }

      function addressClick(id) {
          $.ajax({
              dataType: 'json',
              type: "post",
              data: {
                  'address_id': id
              },
              url: "<?php echo base_url(); ?>front/Checkout/getAddress",
              success: function(data) {

                  $('#username').val(data.name);
                  $('#usermobile').val(data.mobile);
                  $('#useraddress').val(data.address);
                  $('#userstate').val(data.state);
                  $('#usercity').val(data.city);
                  $('#userpincode').val(data.pincode);
              },
              error: function(er) {
                  console.log(er);
              }
          });

      }
  </script>