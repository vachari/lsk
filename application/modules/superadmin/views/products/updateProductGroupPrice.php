<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;  ?> | Edit Product Group Price</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" type="text/css" href="<?php echo SUPER_CSS_PATH ; ?>bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>font-awesome.min.css">
  <!-- Ionicons -->
 <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>gharaahaar1.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">.no-pad{
    padding-left: 3px !important;
    padding-right: 3px !important;
  }
  .form-control {
    
    padding: 5px;
  }
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view("includes/header.php");?>
 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
   <?php $this->load->view("includes/sidebar.php");?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Product Group Pricing
      </h1>
      <ol class="breadcrumb">
       <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Product Group Price</li>
      </ol>
    </section>
      <?php //print_r($product_details);exit;?>
    <!-- Main content -->
    <section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
             <?php if($this->session->flashdata('success')){
          echo "<div class='alert alert-success temp'>".$this->session->flashdata('success')."</div>"; 
            
          }
          
          if($this->session->flashdata('failed')){
          echo "<div class='alert alert-danger temp'>".$this->session->flashdata('failed')."</div>"; 
            
          } 
        ?> 
						<div class="box-header with-border">
						<h3 class="box-title">Update Product Group Price</h3>
						<a href="<?php echo SUPER_ADMIN_FOLDER_PATH;?>Product/groupPricingList" class="btn btn-primary pull-right">Go Back</a>
						</div>
						<!-- /.box-header -->
						<!-- form start -->
            <div class="col-md-12 text-center">
					       </div>
                <?php 
                    $form_attributes = array('id' => 'insertproductprices', 'name' => 'insertproductprices');
                    echo form_open('superadmin/Product/UpdateProductGroupPricing', $form_attributes);
                    ?>
                    
                  <div class="col-md-12 input_fields_wrap">
                    <div class="col-md-12">
                      <input type="hidden" name="id" value="<?php echo $groupPrice_details->id ?>">
                    <div class="form-group col-md-3 no-pad ">
                     <!--  <div class="form-group col-md-4 no-pad ">
                        
                    <?php $product=json_decode($product_details); //print_r($product);?>
                            <label><span title="Shoperative Product Code">SPC</span></label>
                            <select name="prod_id" id="prod_id" class="form-control" required>   
                                 <option  value="">Select</option>
                        <?php 
                                        foreach ($product->product_details as $row) {
                                        
                                      ?>

                                <option  value="<?php echo $row->id;?>" <?php if($groupPrice_details->prod_id == $row->id) echo "selected"; ?>><?php echo $row->prod_code.' ('.$row->prod_name.')';  ?></option>
                                           <?php 

                                              }
                                           ?>
                                       </select>
                              </div> -->
                        <div class="form-group col-md-6 no-pad">
                            <label> Group</label>
                             <select class="form-control" name="prod_group" class="form-control" required> 
                                <option value=""> Select </option>

                                <?php    $pro_de=json_decode($group_details);
                                  //print_r($pro_de->product_details);
                                  for ($i=0; $i <count($pro_de->product_details) ; $i++) { 
                                                                   ?>
                                <option value="<?php echo $pro_de->product_details[$i]->id;?>" <?php if($groupPrice_details->prod_group == $pro_de->product_details[$i]->id) echo "selected"; ?>><?php echo $pro_de->product_details[$i]->group_code;?></option>
                               <?php }?>

                            </select>
                        </div>

                         <div class="form-group col-md-6 no-pad">
                           <label> <span title="Unit of Measure">UOM</span></label>
                           <select class="form-control" name="unit_of_measure" class="form-control" required> 
                                <option value="">Select</option>

                                <?php    $unit_res=json_decode($units_details);
                                  //print_r($pro_de->product_details);
                                  for ($i=0; $i <count($unit_res->units_list) ; $i++) { 
                                                                   ?>
                                <option value="<?php echo $unit_res->units_list[$i]->id;?>" <?php if($groupPrice_details->unit_of_measure == $unit_res->units_list[$i]->id) echo "selected"; ?>><?php echo $unit_res->units_list[$i]->unit_code;?></option>
                               <?php }?>

                            </select>  
                        </div>
                        </div>
                         <div class="form-group col-md-1 no-pad">
                              <label>Qty From</label>
                            <input type="text" name="qty_range_from" value="<?php echo $groupPrice_details->qty_range_from ?>" placeholder="from" class="form-control number_class" required>   
                        </div>
                         <div class="form-group col-md-1 no-pad">
                              <label>To</label>
                            <input type="text" name="qty_range_to" value="<?php echo $groupPrice_details->qty_range_to ?>" placeholder="to" class="form-control number_class" required>   
                        </div>
                         <div class="form-group col-md-2 no-pad">
                             <label>From Date</label>
                            <input type="date" name="from_date" value="<?php echo $groupPrice_details->from_date ?>" placeholder="from date" class="form-control" required> 
                             
                        </div>
                        <div class="form-group col-md-2 no-pad">
                           <label>To Date</label>
                             <input type="date" name="to_date" value="<?php echo $groupPrice_details->to_date ?>" placeholder="to_date " class="form-control" required>  
                        </div>
                         <div class="form-group col-md-1 no-pad">
                             <label><span title="Selling Price">SP</span></label>
                            <input type="text" name="selling_price" value="<?php echo $groupPrice_details->sellingprice ?>" placeholder="SP" class="form-control number_class" required>   
                        </div>
                         <div class="form-group col-md-1 no-pad">
                             <label><span title="Buying Price">BP</span></label>
                            <input type="text" name="buying_price" value="<?php echo $groupPrice_details->buyingprice ?>" placeholder="BP" class="form-control number_class" required>   
                        </div>
                        <div class="form-group col-md-1 no-pad">
                            <label><span title="Discount(%)">Discount(%)</span></label>
                            <input type="text" name="discount" value="<?php echo $groupPrice_details->discount ?>" placeholder="Discount(%)" class="form-control number_class" required>   
                        </div>
                    </div>
                  </div>
                  <div class="form-group col-md-12 ">
                             
                            <input type="submit" name="submit" value="Update" class="btn btn-md btn-success pull-right">
                    </div>
                      <?php echo form_close();?>
                    <div class="clearfix"></div> 
					</div>
				</div>
			</div>
    </section>
    <!-- /.content -->
     
  </div>
  <!-- /.content-wrapper -->
<footer class="main-footer">
    <?php $this->load->view("includes/footer.php");?>
  </footer>
 

  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery-2.2.3.min.js"></script>

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo SUPER_JS_PATH; ?>bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo SUPER_JS_PATH; ?>fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SUPER_JS_PATH; ?>app.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo SUPER_JS_PATH; ?>jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo SUPER_JS_PATH; ?>jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo SUPER_JS_PATH; ?>Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo SUPER_JS_PATH; ?>dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo SUPER_JS_PATH; ?>demo.js"></script>

</body>
</html>
<script type="text/javascript">
 $(document).on("keyup",".number_class",function(){(isNaN($(this).val()))?$(this).val(''):'';});
 $(".temp").delay(4000).fadeOut("slow");
</script>
<script>
/*$(document).ready(function(){
         $("#btn_submit").click(function(){
            var name=$('#name').val();
            var bob=$('#bob').val();
            var doj=$('#doj').val();
            var prod_group=$('#prod_group').val();
            var blood=$('#blood').val();
            var email=$('#email').val();
            var password=$('#password').val();
            
            // var photo=$('#photo').val();
           
            var str=true;
            $('#name_error,#bob_error,#doj_error,#gender_error,#blood_error,#email_error,#password_error,#phone_error,#father_error,#mother_error,#class_error,#roll_error,#address_error,photo_error').html('');
             $('#name,#bob,#doj,#gender,#blood,#email,#password,#phone,#father,#mother,#class,#roll,#address,photo').css('border','');
            var date_pattern = /^\d{4}-\d{2}-\d{2}$/;

            if(alphabets_check(name)==0){$('#name').focus().css('border','1px solid red'); $('#name_error').html(' Please enter valid Name'); str=false;}
           
             if(alphanumeric_check(address)==0){$('#address').focus().css('border','red'); $('#address_error').html(' Please enter Address'); str=false;}
             if(mobile_check(phone)==0){$('#phone').focus().css('border','red'); $('#phone_error').html(' Please enter valid Phone Number'); str=false;}
              if(email_check(email)==0){$('#email').focus().css('border','red'); $('#email_error').html(' Please enter valid Email Id'); str=false;}
             if(password=='' && !passwordpattern.test(password)){$('#password').focus().css('border','red'); $('#password_error').html(' Please enter Password'); str=false;}
          
             //if(image_validate(photo)==0){$('#photo').focus().css('border','red'); $('photo_error').html(' Please upload photo'); str=false;}

            if(name==''|| name==' '){
                str=false;
                $('#name').css('border','1px solid red');
                $('#name_error').css('color','red');
                $('#name_error').html(' Please enter  name');
            }
             
           //    if(doj==''|| doj==' '){
           //      str=false;
           //      $('#doj').css('border','1px solid red');
           //      $('#doj_error').css('color','red');
           //      $('#doj_error').html(' Please enter  doj');
           //  }
             if(gender=='0'){
                str=false;
                $('#gender').css('border','1px solid red');
                $('#gender_error').css('color','red');
                $('#gender_error').html(' Please select  gender');
            }
            if(blood=='0'|| blood=='0 '){
                str=false;
                $('#blood').css('border','1px solid red');
                $('#blood_error').css('color','red');
                $('#blood_error').html(' Please select blood group');
            }
            if(phone==''|| phone==' '){
                str=false;
                $('#phone').css('border','1px solid red');
                $('#phone_error').css('color','red');
                $('#phone_error').html(' Please enter  phone');
            }
           if(email==''|| email==' '){
                str=false;
                $('#email').css('border','1px solid red');
                $('#email_error').css('color','red');
                $('#email_error').html(' Please enter  email');
            }
           if(password==''|| password==' '){
                str=false;
                $('#password').css('border','1px solid red');
                $('#password_error').css('color','red');
                $('#password_error').html(' Enter password');
            }
          
             if(father==''|| father==' '){
                str=false;
                $('#father').css('border','1px solid red');
                $('#father_error').css('color','red');
                $('#father_error').html(' Enter father name');
            }
            if(mother==''|| mother==' '){
                str=false;
                $('#mother').css('border','1px solid red');
                $('#mother_error').css('color','red');
                $('#mother_error').html(' Enter mother name');
            }
             if(class_s==''|| class_s==' '){
                str=false;
                $('#class').css('border','1px solid red');
                $('#class_error').css('color','red');
                $('#class_error').html(' Enter class name');
            }
              if(roll==''|| roll==' '){
                str=false;
                $('#roll').css('border','1px solid red');
                $('#roll_error').css('color','red');
                $('#roll_error').html(' Enter roll name');
            }
               if(address==''|| address==' '){
                str=false;
                $('#address').css('border','1px solid red');
                $('#address_error').css('color','red');
                $('#address_error').html(' Enter address name');
            }
              if(photo==''|| photo==' '){
                str=false;
                $('#photo').css('border','1px solid red');
                $('#photo_error').css('color','red');
                $('#photo_error').html(' Enter photo name');
            }
           
           


             return str;
        });
    });

*/
    
</script>