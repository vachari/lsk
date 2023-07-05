<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo SUPER_CSS_PATH ; ?>login.css">

 
	<style type="text/css">
	
	</style>
</head>

<body>
	<div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
        <?php $attributes = array('id' => 'register-form','role'=>'login');
          echo form_open('superadmin/Admin/login',$attributes); ?>
           <?php if($this->session->flashdata('error')){
          echo "<div class='alert alert-danger'>".$this->session->flashdata('error')."</div>"; 
            
          } ?>
         <!--  <img src="" class="img-responsive" alt="Logo" /> -->
         <h1 class="text-center"> Admin Login</h1 >
          <div class=" form-group"> 
          
            <?php echo form_label('Email','Email'); ?>
            <span> 
            <?php   echo  form_error('email'); ?>
          </span> 

            <?php
                      $data = array(
                              'name'          => 'email',
                              'id'            => 'email',
                              'maxlength'     => '40',
                              'autocomplete'  => 'off',
                              'class'     => 'form-control',
                              'placeholder' => 'Enter Your Email'

                      );

                     echo form_input($data);?>
          </div>
          <div class=" form-group"> 
          
          
            <?php echo form_label('Password','Password'); ?>
            <span>
            <?php   echo  form_error('password'); ?>
          </span>
          
            <?php
                      $data = array(
                              'name'          => 'password',
                              'id'            => 'password',
                              'maxlength'     => '40',
                              'autocomplete'  => 'off',
                              'class'     => 'form-control',
                              'placeholder' => 'Password'

                      );

                     echo form_password($data);?>
          </div>
          
          <div class="pwstrength_viewport_progress"></div>
          
         <?php echo form_submit(array('name'=>'submit','value'=>'Login','class'=>'btn btn-md btn-block btn-success')); ?> 
         
         
          
        </form>
        
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      

  </div>
  
     
  
  
</div>
</body>
</html>