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
    <style type="text/css">
    .text-danger {
    color: #ff0000 !important;
  }
 label{font-weight: 500;}
    </style>     
</head><!--/head-->

<body class="popup">
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
            <?php $this->load->view('includes/header.php');?>
    </div>
    <section class="martop150"> 
        <div class=" col-md-12  full-bg ">

            <div class="col-md-12 "> 
                <!-- <h2 class="text-titel"> <b> SIgn up / Sign in</b></h2> -->
               <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>"> Home </a></li>
                        <li><a href="<?php echo base_url();?>signin"> Register </a></li>
                        <li class="active">Power User Registration</li>
                    </ol>
                </div>

            </div>
            <div class=" col-md-12  "> 
             
                <div class="container bg_common box-sha">
                <?php if($this->session->flashdata('success')){ echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";}
                    if($this->session->flashdata('failed')){ echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>"; } 
                ?>
                    <div class="col-md-12 ">
                        <h2 class="text-center  "> <b> &nbsp;&nbsp; &nbsp; &nbsp; Power User Registration</b>  </h2>
                        <!-- <center><hr class="" style="margin-top: -5px;width: 150px;margin-left: 40%;"></center> -->
                        <div class="  mrtop col-md-9 col-md-offset-1">
                            <?php echo form_open_multipart();?>
                            <div class="form-group col-md-6 col-lg-6">
                                <label>Name</label>

                                <span id="name_error" class="text-danger "> *<?php echo form_error('user_name');?></span>
                                <input type="text" name="user_name" id="names" placeholder="Name" class="form-control" autocomplete="off" max="60" min="2" value="<?php echo set_value('user_name');?>">

                            </div>
                             <div class="form-group col-md-6 col-lg-6">
                                <label>Mobile</label>
                                <span id="phone_error" class="text-danger ">  *<?php echo form_error('user_mobile');?></span>
                                <input type="text" name="user_mobile" id="phone" placeholder="Mobile" class="form-control number-class" autocomplete="off" maxlength="10" value="<?php echo set_value('user_mobile');?>">
                            </div>
                            <div class="clearfix"></div>
                             <div class="form-group col-md-6 col-lg-6">
                                <label>Email</label>
                                <span id="email_error" class="text-danger "> *<?php echo form_error('user_email');?></span>
                                <input type="text" name="user_email" id="email" placeholder="Email" class="form-control" autocomplete="off" max="60" min="2" value="<?php echo set_value('user_email');?>">
                            </div>
                            <div class="form-group col-md-6 col-lg-6">
                                <label>Area</label>
                                <span id="area_error" class="text-danger "> *</span>
                                <input type="text" name="area" id="sublocality_level_1" placeholder="Area" class="form-control" autocomplete="off"   value="<?php echo set_value('area');?>">
                                <input type="hidden" name="latitude" id="latitude" value="0">
                                <input type="hidden" name="longitude" id="longitude" value="0">
                            </div>
                               <div class="form-group col-md-6 col-lg-6">
                                <label>City</label>
                                <span id="city_error" class="text-danger ">* <?php echo form_error('user_city');?></span>
                                <input type="text" name="user_city" id="city" placeholder="City" class="form-control" autocomplete="off"   value="<?php echo set_value('user_city');?>">
                            </div>
                            <div class="form-group col-md-6 col-lg-6">
                                <label>State</label>
                                <span id="state_error" class="text-danger ">* </span>
                                <input type="text" name="state" id="state" placeholder="State" class="form-control" autocomplete="off"   value="<?php echo set_value('state');?>">
                            </div>
                            
                            <div class="clearfix"></div>
                            <!-- <div class="form-group col-md-6 col-lg-6">
                               
                                <input type="hidden" name="country" id="country_name" placeholder="Country" class="form-control" autocomplete="off"  value="">
                            </div> -->
                            <div class="clearfix"></div>

                             <div class="form-group col-md-6 col-lg-6">
                             <label>Password</label>
                                <span id="password_error" class="text-danger "> *<?php echo form_error('user_password');?></span>
                                <input type="password" name="user_password" id="password" placeholder="Password" class="form-control" autocomplete="off" max="60" min="6" >
                            </div>
                            <div class="form-group col-md-6 col-lg-6">
                             <label>Confirm Password</label>

                                <span id="conform_password_error" class="text-danger "> *<?php echo form_error('confirm_password');?></span>
                                <input type="password" name="confirm_password" id="conform_password" placeholder="Confirm Password" class="form-control" autocomplete="off" max="60" min="6" >
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-md-6 col-lg-6">
                                 <label>Profession</label>
                               <select id="profession" name="profession" class="form-control">
                                   <option selected disabled value="">--Select Your Profession--</option>

                                 <?php $professions = json_decode($professions);
                                  if($professions->result !=null){
                                        foreach($professions->result as $row){ ?>
                                            <option value="<?php echo $row->id; ?>" <?php echo set_select('profession', $row->id); ?> > <?php echo $row->profession; ?></option>
                                  <?php  } } ?>
                               </select>
                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                 <label>Monthly Household Income</label>
                               <select name="user_income" id="user_income" class="form-control">
                                   <option selected disabled value="">--Select Income--</option>
                                   <option>Below 100000</option>
                                   <option>100000 to 200000</option>
                                   <option>200000 to 500000</option>
                                   <option>Above 500000</option>
                                </select>
                            </div>
                              <div class="form-group col-md-12 col-lg-12">
                             <label> Facebook Link </label>
                             <span id="fb_link_error" class="text-danger "> *<?php echo form_error('fb_link');?></span> <br><input type="link" name="fb_link" id="fb_link" placeholder="Ex https://www.facebook.com/profile-name" class="form-control" autocomplete="off" max="60" value="<?php echo set_value('fb_link');?>">
                            </div>
                            <dir class="clearfix"> </dir>
                            <div class="form-group col-md-12 col-lg-12">
                            <label> Address </label>
                                <span id="user_address_error" class="text-danger "> *<?php echo form_error('user_address');?></span>
                                <textarea name="user_address" rows="4" cols="10" class="form-control" placeholder="Enter Address" id="user_address"><?php echo set_value('user_address');?></textarea>
                            </div>
                            <div class="clearfix"></div>

                              <div class="form-group col-md-12 col-lg-12">
                                <label>ID Proof</label>
                                <span id="image_error" class="text-danger "> <?php echo form_error('user_proof');?></span>
                                <input type="file" name="user_proof" id="image" class="form-control" value="<?php echo set_value('user_proof');?>">     
                            </div>
                           
                            <div class="clearfix"></div>
                             <h4> Add Followers :</h4>
                       <span id="follower_two" class="text-danger"></span>
                        <div class="form-inline  col-md-12 col-lg-12 input_fields_wrap  no-pad" id="tbUser">
                              <label>Name  <span id="follower_name_error" class="text-danger "> <?php echo form_error('');?></span><br>
                                <input type="text" name="follower_user_name[]" id="follower_name" placeholder="Name " class="form-control wi95" autocomplete="off" max="60" value="<?php echo set_value("follower_user_name[0]");?>"  required></label>
                               <label>Email  <span id="follower_email_error" class="text-danger "> <?php echo form_error('follower_reigster_id[]');?></span><br>
                                <input type="email" name="follower_reigster_id[]" id="email" placeholder="Email " class="form-control wi95" autocomplete="off" max="60" pattern="[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" value="<?php echo set_value("follower_reigster_id[0]");?>" required></label>
                               <label> Mobile  <span id="" class="text-danger "> <?php echo form_error('');?></span> <br><input type="text" name="follower_mobile[]" id="mobile" placeholder=" Mobile" class="form-control number-class wi95" autocomplete="off" maxlength="10" pattern="[6-9]+[0-9]{9}"  value="<?php echo set_value("follower_mobile[0]");?>" required></label>
                                <label> City  <span id="" class="text-danger "> <?php echo form_error('');?></span> <br><input type="text" name="follower_city[]" id="" placeholder="City" class="form-control wi95" autocomplete="off" value="<?php echo set_value("follower_city[0]");?>"  required=""></label>
                         
                                <button class='add_field_button btn btn-sm btn-warning'><i class="glyphicon glyphicon-plus"></i></button>
                            </div>
                            <!-- follower code starts from here-->                               
                           <div class="clearfix"></div>
                                
                            <div class="form-group col-md-12 text-center  mrtop">
                                <input type="submit" name="btn_submit" id="btnSumbit" value="Register " class="btn btn-md btn-success " >

                            </div>
                            
                            <?php echo form_close();?>
                        </div>
                    </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </section>
    <?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
<?php $foll_lim =$limit_data; $lilit= $foll_lim->data_result[0]->follower_limit; ?> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUlB6Eh-d9yy-kbAVPFbC9WcIYQCtJXJE&libraries=places&callback=initAutocomplete"
async defer></script>
<script type="text/javascript">
            var placeSearch, autocomplete;
            var componentForm = {
                sublocality_level_1: 'long_name',
                locality: 'long_name',
                administrative_area_level_1: 'long_name',
                country: 'long_name',
                postal_code: 'short_name'
            };
            function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('sublocality_level_1')),
                {types: ['geocode'],
                    componentRestrictions: {country: "in"}
                });

            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
            }
         function fillInAddress() {
          // Get the place details from the autocomplete object.
          var place = autocomplete.getPlace();
         var latitude = place.geometry.location.lat();
         var longitude = place.geometry.location.lng();
          console.log(latitude);
          console.log(longitude);
          document.getElementById('latitude').value=latitude;
          document.getElementById('longitude').value=longitude;
    document.getElementById('city').value ='';
    document.getElementById('state').value ='';

           for (var i = 0; i < place.address_components.length; i++) {
      for (var j = 0; j < place.address_components[i].types.length; j++) {
        if (place.address_components[i].types[j] == "administrative_area_level_1") {
          document.getElementById('state').value = place.address_components[i].long_name;
        }
        if (place.address_components[i].types[j] == "locality") {
          document.getElementById('city').value = place.address_components[i].long_name;
        }
      }
    }
        }
    </script>
<script>
$(document).ready(function () {
        var max_fields =100; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="form-inline col-md-12 col-lg-12 no-pad"><label> &nbsp;Name  <span class="text-danger "> </span><br><input type="text" name="follower_user_name[]"  placeholder="Name " class="form-control wi95" autocomplete="off" max="60" required ></label><label> &nbsp;Email  <span  class="text-danger "> </span><br><input style="margin-left:2px;" type="text" name="follower_reigster_id[]" id="email" placeholder="Email " class="form-control wi95" autocomplete="off" max="60" pattern="[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" required></label><label> &nbsp; Mobile  <span id="" class="text-danger "> </span> <br><input style="margin-left:4px;" type="text" name="follower_mobile[]" id="mobile" placeholder=" Mobile" class="form-control number-class wi95" autocomplete="off" maxlength="10" pattern="[6-9]+[0-9]{9}" required></label><label> &nbsp; City  <span id="follower_city" class="text-danger "> </span> <br><input style="margin-left:5px;" type="text" name="follower_city[]" id="" placeholder="City" class="form-control wi95" autocomplete="off" max="60" value="" required></label><a href="#" class="remove_field btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a><div class="clearfix"></div></div> '); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

</script>   
<script type="text/javascript">
         $("#btnSumbit").click(function(){
            var name = $('#names').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var area = $('#sublocality_level_1').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var password = $('#password').val();
            var conform_password = $('#conform_password').val();
            var fb_link = $('#fb_link').val();
            var user_address = $('#user_address').val();
            var only_aplhabets_pattern=/^[a-zA-Z][a-zA-Z ]*$/;
            var email_pattern = /^[a-zA-Z0-9][a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            var passwordpattern=/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
            var mobile_pattern = /^[6-9]+[0-9]{9}$/;
            var count = $("div#tbUser input").length;
            var name_pattern = /^[a-zA-z. ]*$/;
            var str=true;
            $('#name_error,#email_error,#password_error,#phone_error,#conform_password,#area_error,#city_error,#state_error,#user_address_error,#fb_link_error,#follower_two').html('');
             $('#names,#email,#password,#phone,#conform_password,#sublocality_level_1,#city,#state,#user_address').css('border','');
            if(count<=7){
              $('#follower_two').html(' Please enter atleast two followers');
              str = false;
              }
            if(name==''|| name==' '){
                str=false;
                $('#names').css('border','1px solid red');
                $('#name_error').css('color','red');
                $('#name_error').html(' Please enter name');
            }
            else if(!name_pattern.test(name)){
                str=false;
                $('#names').css('border','1px solid red');
                $('#name_error').css('color','red');
                $('#name_error').html(' Please enter valid name');
            }
            if(area==''|| area==' '){
                str=false;
                $('#sublocality_level_1').css('border','1px solid red');
                $('#area_error').css('color','red');
                $('#area_error').html(' Please enter area');
            }
            if(city==''|| city==' '){
                str=false;
                $('#city').css('border','1px solid red');
                $('#city_error').css('color','red');
                $('#city_error').html(' Please enter city');
            }
            else if(!name_pattern.test(city)){
                str=false;
                $('#city').css('border','1px solid red');
                $('#city_error').css('color','red');
                $('#city_error').html(' Please enter valid city');
            }
            if(state==''|| state==' '){
                str=false;
                $('#state').css('border','1px solid red');
                $('#state_error').css('color','red');
                $('#state_error').html(' Please enter state');
            }
            else if(!name_pattern.test(state)){
                str=false;
                $('#state').css('border','1px solid red');
                $('#state_error').css('color','red');
                $('#state_error').html(' Please enter valid state');
            }
            if(fb_link==''|| fb_link==' '){
                str=false;
                $('#fb_link').css('border','1px solid red');
                $('#fb_link_error').css('color','red');
                $('#fb_link_error').html(' Please enter facebook link');
            }
            if(user_address==''|| user_address==' '){
                str=false;
                $('#user_address').css('border','1px solid red');
                $('#user_address_error').css('color','red');
                $('#user_address_error').html(' Please enter address');
            }
            if(phone==''|| phone==' '){
                str=false;
                $('#phone').css('border','1px solid red');
                $('#phone_error').css('color','red');
                $('#phone_error').html(' Please enter mobile');
            }
            else if(!mobile_pattern.test(phone)){
                str=false;
                $('#phone').css('border','1px solid red');
                $('#phone_error').css('color','red');
                $('#phone_error').html(' Please enter valid mobile');
            }
           if(email==''|| email==' '){
                str=false;
                $('#email').css('border','1px solid red');
                $('#email_error').css('color','red');
                $('#email_error').html(' Please enter email');
            } 
            else if(!email_pattern.test(email)){
                str=false;
                $('#email').css('border','1px solid red');
                $('#email_error').css('color','red');
                $('#email_error').html(' Please enter valid email');
            }
           if(password==''|| password==' '){
                str=false;
                $('#password').css('border','1px solid red');
                $('#password_error').css('color','red');
                $('#password_error').html(' Please enter password');
            }
            else if(!passwordpattern.test(password)){
                str=false;
                $('#password').css('border','1px solid red');
                $('#password_error').css('color','red');
                $('#password_error').html(' Please enter valid Password');
            }
            
            if(conform_password==''|| conform_password==' '){
                str=false;
                $('#conform_password').css('border','1px solid red');
                $('#conform_password_error').css('color','red');
                $('#conform_password_error').html(' Please enter confirm password');
            }else if(conform_password != password){
                str=false;
                $('#conform_password').css('border','2px solid red');
                $('#conform_password_error').css('color','red');
                $('#conform_password_error').html(' Both Passwords should same');
                $('#password').css('border','2px solid red');
                $('#password_error').css('color','red');
                $('#password_error').html(' Both Passwords should same');
            }
            
             return str;
        });
$('.number-class').on('keyup',function(){(isNaN($(this).val()))?$(this).val(''):'';});


   $("#email").focusout(function(){
    var email=$("#email").val();
    if(email!="")
    {
    $.ajax({
          dataType:'text',
          type:'post',
          data:{'email':email},
          url:'<?php echo base_url();?>pages/common_check_existence',
          success:function(res){
            alert(res);
            $("#email_error").html(res);
                    if(res.trim("")=="Email is already exist"){
                        $('#btnSumbit').attr("disabled","disabled");
                    }else{
                      $('#btnSumbit').removeAttr("disabled");
                    }
          },
          error:function(res){
            console.log(res);
          }
  });
}
  });
</script>
 </body>
</html>
