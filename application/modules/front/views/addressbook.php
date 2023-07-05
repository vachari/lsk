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
    
    <div class="clearfix"></div>

    <section>
        <div class="container martop150">
            <div class="col-md-3 bg_profile ">
                <div class="col-xs-12 mrtop">
                     <?php $this->load->view('includes/sidebar.php');?>
                </div>
                    <div style="height:850px" class="hidden-xs"></div>
                

            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                <div class="col-md-12">
                    <div class="header-title mrtop">
                        <h4> My Address Book</h4>
                        <hr style="margin-top:-5px;"> 
                    </div>
                    <div class="col-md-12"> 
                    <?php
                    $addr=json_decode($address);
                    if($this->session->flashdata('success'))
                    {
                        echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                        }
                    if($this->session->flashdata('failed'))
                    { 
                        echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                     } ?>
                    <form action="" method="post">
                       <div class="form-group col-md-8">
                            <label for=""> Title <span id="title_error" class="text-red"> * <?php echo form_error('title');?> </span> </label><br>
                            <input type="text" name="title" id="title" placeholder="Address type" autocomplete="off"  class="form-control" value="<?php echo (isset($addr->result->title)?$addr->result->title:'');?>">
                       </div>
                       <div class="form-group col-md-8">
                          <label for="">Full Name <span id="name_error" class="text-red"> * <?php echo form_error('name');?> </span></label>
                          <input type="text" id="name" name="name" placeholder="name" class="form-control" autocomplete="off" min="3" value="<?php echo (isset($addr->result->name)?$addr->result->name:'');?>" >
                      </div>
                      <div class="form-group col-md-8">
                          <label for="">Mobile <span id="mobile_error" class="text-red"> * <?php echo form_error('mobile');?></label>
                          <input type="text" id="mobile" name="mobile" placeholder="mobile " class="form-control" autocomplete="off" min="10" value="<?php echo (isset($addr->result->mobile)?$addr->result->mobile:'');?>">
                      </div>
                       <div class="form-group col-md-8">
                            <label for=""> Address  <span id="address_error" class="text-red"> * <?php echo form_error('address');?></span> </label>
                            <textarea  cols="30" id="address" rows="4" autocomplete="off" name="address"  placeholder=" Door.no , Street name , Landmark"  class="form-control"><?php echo (isset($addr->result->address)?$addr->result->address:'');?></textarea>
                       </div>
                      <div class="form-group col-md-8">
                          <label for="">State</label>
                          <select name="state" id="state" class="form-control">
                                        <option><?php if(!empty($user_data->state)) echo $user_data->state; ?></option>
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
                      <div class="form-group col-md-8">
                          <label for="">City <span id="city_error" class="text-red"> * <?php echo form_error('city');?></span> </label>
                          <input type="text" name="city" placeholder="city " class="form-control" autocomplete="off" min="3" value="<?php echo (isset($addr->result->city)?$addr->result->city:'');?>" id="city">
                      </div>
                       <div class="form-group col-md-8">
                            <label for=""> Pincode <span id="pincode_error" class="text-red"> * <?php echo form_error('pincode');?></span></label><br>
                            <input type="number"  min="7" id="pincode" name="pincode"  autocomplete="off"  placeholder="Pincode" class="form-control in-num" value="<?php echo (isset($addr->result->pincode))?$addr->result->pincode:'';?>">
                       </div>
                       <div class="clearfix"></div>
                        <div class="form-group col-md-12 pull-right">
                           
                            <input type="submit" name="btn_submit" id="add" value="Add Address" class="btn btn-success btn-md">
                       </div>
                    </form>
                    </div>
                    <div class="clearfix"></div>
                        <div class="col-md-12" id="successmessage"></div>
                <!-- Addess Details Display here -->
                    <div class="col-md-12">

                        <?php $addres=json_decode($address_list);
                            foreach ($addres->result as $list) {
                                
                           
                        ?>
                         <div class="col-md-4  bord mrtop ">

                            <h4 class=""><b><?php echo ucfirst($list->title); ?></b> <span><button class="btn btn-danger btn-xs pull-right " onclick="addressDelete(<?php echo $list->id;?>);" >X</button></span></h4>
                            <hr>

                            <p ><?php  

                                   echo  $list->name; 
                                   echo ', <br>';
                                   echo  $list->mobile; 
                                   echo ', <br>';
                                    $list->address; 
                                    $data= explode(',',$list->address); 
                                    print_r(implode(','.'<br>',$data)); 
                                    echo "<br>";
                                   echo  $list->state.','.$list->city; 
                                   echo ', <br>';
                                    echo $list->pincode;
                                ?></p>
                        </div>
                        <?php } ?>

                    </div>
                </div>
                <!-- end of the edit profile -->
                
               
            </div><!-- end of 9 col -->
            
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
    $('#add').on('click',function(){
          var  title=$('#title').val();pincode=$('#pincode').val(),address=$('#address').val();
          var username=$('#name').val().trim();
          var mobile = $('#mobile').val().trim();
          var city = $('#city').val().trim();
          var pincodepatteren=/^[0-9]{6}$/;
          var mobile_pattern = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
          var name_pattern = /^[a-zA-z. ]*$/;

         var str=true;
            $('#title_error,#pincode_error,#address_error,#mobile_error,#name_error').html('');
             $('#title,#pincode,#address,#mobile,#name').css('border','');

             if(title==''|| title==' '){
                str=false;
                $('#title').css('border','1px solid red');
                $('#title_error').html(' * Please enter title');
            }
            else if(!name_pattern.test(title)){
                str=false;
                $('#title').css('border','1px solid red');
                $('#title_error').html(' * Please enter valid title');
            }
            if(username==''|| username==' '){
                str=false;
                $('#name').css('border','1px solid red');
                $('#name_error').html(' * Please enter name');
            }

            else if(!name_pattern.test(username)){
                str=false;
                $('#name').css('border','1px solid red');
                $('#name_error').html(' * Please enter name');
            }
            if(mobile==''|| mobile==' '){
                str=false;
                $('#mobile').css('border','1px solid red');
                $('#mobile_error').html(' * Please enter mobile');
            }
            else if(mobile.length!==10)
            {
            $('#mobile').css('border','1px solid red');
            $("#mobile_error").html('Please put 10  digit mobile number');
            str = false;
            }
            else if(!mobile_pattern.test(mobile)) {
            $('#mobile').css('border','1px solid red');
            $("#mobile_error").html('Please enter valid mobile');
            str = false;
            }

            if(pincode==''|| pincode==' '){
                str=false;
                $('#pincode').css('border','1px solid red');
                $('#pincode_error').html(' * Please enter pincode');
            }
            else if(!pincodepatteren.test(pincode)){
                 str=false;
                $('#pincode').css('border','1px solid red');
                $('#pincode_error').html(' * Please enter valid pincode');
            }

            if(city==''|| city==' '){
                str=false;
                $('#city').css('border','1px solid red');
                $('#city_error').html(' * Please enter city');
            }
            else if(!name_pattern.test(city)){
                str=false;
                $('#city').css('border','1px solid red');
                $('#city_error').html(' * Please enter valid city');
            }

            if(address==''|| address==''){
                str=false;
                $('#address').css('border','1px solid red');
                $('#address_error').html(' * Please enter address');
            }

     return str;

    });

     function addressDelete(ids){if(confirm('Confirm to delete?')) commonDelete(ids);}
         function commonDelete(ids){
      if(ids!=''){
         $('#fail').hide();
         $.ajax({
          dataType:'json',
          type:'post',
          data:{'tablename':'address','updatelist':ids},
          url:'<?php echo base_url();?>front/User/commonDelete/',
          success:function(u){
           // console.log(u);
            if(u.code=='200'){$('#success').show();$('#successmessage').html('Address deleted successfully').addClass('alert alert-success');setTimeout(function() {window.location=location.href;},2000);}
                    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');}
                 },
          error:function(er){
            console.log(er);
          }
        });
      }
      else{
       $('#fail').show();$('#failmessage').html('*  Please Select ').addClass('alert alert-danger');
      }
    }

     
</script>