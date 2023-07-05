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
    .input-box-pad {padding: 10px;}
    .info-box {background-color: #eee !important; margin-bottom: 10px; min-height: 100px;padding: 10px;}
    </style>     
</head><!--/head-->

<body class="popup">

    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
            <?php  $this->load->view('shipper/includes/header.php');?>
    </div>

    <section>
        <div class="container martop150">
            <div class="col-md-3 bg_profile ">
                <div class="col-xs-12 mrtop">
                     <ul class="profile-side-bar">
                        <li> <a href=" <?php echo base_url().'shipper/dashboard'; ?>"> Dashboard</a></li>
                         <li  > <a href="<?php echo base_url().'shipper/profile'; ?>"> My Profile</a></li>
                         <li class="active"> <a href="<?php echo base_url().'shipper/manage-shipping-cost'; ?>">Manage Shipping Cost</a></li>
                         <li> <a href=" <?php echo base_url() . 'shipper/manage-shipping-orders'; ?>"> Manage Shipping Orders  </a></li>
                         <li> <a href=" <?php echo base_url() . 'shipper/change-password'; ?>"> Change Password   </a></li>
                         <li> <a href=" <?php echo base_url() . 'shipper/logout'; ?>"> Logout   </a></li>
                     </ul>
                </div>
                 <div style="height:300px" class="hidden-xs"></div>
                

            </div> <!-- end of 3 col -->
            <div class="col-md-9">
                
                <div class="col-md-12">
                <?php
                    if($this->session->flashdata('success'))
                    {
                        echo "<div class='alert alert-success  alert-dismissible text-center'>".$this->session->flashdata('success')."<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                        }
                    if($this->session->flashdata('failed'))
                    { 
                        echo "<div class='alert alert-danger  alert-dismissible text-center'>".$this->session->flashdata('failed')."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                     } ?>

                    <div class="header-title">
                        <h4>Manage Shipping Cost</h4>
                        <hr style="margin-top: -5px;"> 
                    </div>
                   
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <form method="post" action="<?php echo base_url().'shipper/search-shipping-cost' ?>">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <input type="text" class="form-control" name="search_name" placeholder="Search here" value="<?php if(isset($search['search_name']) && $search['search_name']!=null) echo $search['search_name'] ?>">
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input type="submit" name="search_btn" value="Search" id="search_btn" class="btn btn-sm btn-info">
                    <a href="<?php echo base_url().'shipper/manage-shipping-cost' ?>" class="btn btn-sm btn-info">Refresh</a>
                  </div>
                  </form>
                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                    <a href="#" class="btn btn-sm btn-success" onclick="updateActivationStatus('1')"> Active</a>
                    <a href="#" class="btn btn-sm btn-warning" onclick="updateActivationStatus('0')"> In-Active</a>
                    <a href="#" class="btn btn-sm btn-danger" onclick="commonDelete();"> Delete</a>

                  </div>
                  <div class="clearfix">&nbsp;</div>
                  <div class="clearfix">&nbsp;</div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                  <div class="text-success" id="success"><span id="successmessage"></span></div>
                  <div class="text-danger" id="fail"><span id="failmessage"></span></div>
                  <div class="clearfix">&nbsp;</div>
                  <!-- shipping cost table open -->
                  <table width="100%" class="table table-bordered table-hover table-striped">
                    <thead>
                      <th><input type="checkbox" id="checkAll"></th>
                      <th>Sr No</th>
                      <th>Distance Range From (KM)</th>
                      <th>Distance Range To (KM)</th>
                      <th>Cost Per KG</th>
                      <th>Std Delivery Days From order Date</th>
                      <th>Special Conditions (if any)</th>
                      <th style="min-width: 100px">Created On</th>
                      <th>Status</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <tr>
                        <?php  
                                $shipping_cost=json_decode($shippingcostdata);
                                   if($shipping_cost->code != 200 ){

                                    echo '<tr> <td colspan=11> <div class="alert alert-danger text-center">Shipping cost data not found</div></td><tr>';

                                   }else{
                                    $srno=$this->uri->segment(3,0);
                                    $i=$srno+1;
                                    foreach ($shipping_cost->result as $shipping) {
                                     
                                ?>
                        <td><input type="checkbox" name="multiple[]" class="checkSingle" value="<?php echo $shipping->shipping_cost_id; ?>"></td>
                        <td><?php echo  $i ?></td>
                        <td><?php echo  $shipping->distance_range_from; ?></td>
                        <td> <?php echo  $shipping->distance_range_to; ?> </td>
                        <td> <?php echo $shipping->cost_per_kg; ?></td>
                        <td><?php echo $shipping->std_delivery_days_from_order_date; ?></td>
                        <td><?php echo $shipping->special_conditions; ?></td>
                        <td><?php echo date('d-m-Y',strtotime($shipping->created_on)); ?></td>
                        <td><?php if($shipping->status == 1) echo '<span class="text-success">Active</span>'; else echo '<span class="text-danger">In-Active</span>'; ?></td>
                        <td><a href="<?php echo base_url().'shipper/edit-shipping-cost/'.base64_encode($shipping->shipping_cost_id); ?>" class="btn btn btn-primary btn-xs">Edit</a></td>

                      </tr>
                      <?php $i++; }  }?>
                                 <tfoot>
                                        
                                         <?php if(!empty($links)){ ?>
                                        <tr>
                                         
                                          <td colspan="11" align="center">
                                            <div class="pagination_links">
                                              
                                                <?php echo $links; ?>
                                            </div>
                                          </td>
                                        </tr>
                                         <?php } ?>
                                 </tfoot>
                    </tbody>
                  </table>
                  <!-- shipping cost table close -->

                </div>
              
            </div><!-- end of 9 col -->
            
        </div>

    </section>
   
<?php $this->load->view('includes/footer');?>
    
    <script src="<?php echo JS_PATH;?>jquery.js"></script>
    <script src="<?php echo JS_PATH;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>bliss-slider.js"></script>
   <script type="text/javascript">
    $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
if(this.checked){
      $(".checkSingle").each(function(){
        this.checked=true;
      })
    }else{
      $(".checkSingle").each(function(){
        this.checked=false;
      })
    }

});
$(".checkSingle").click(function () {
    if ($(this).is(":checked")){
      var isAllChecked = 0;
      $(".checkSingle").each(function(){
        if(!this.checked)
           isAllChecked = 1;
      })
      if(isAllChecked == 0){ $("#checkAll").prop("checked", true); }
    }
    else {
      $("#checkAll").prop("checked", false);
    }
});
</script>
<script type="text/javascript">
   $('#fail').hide();
   $('#success').hide();
   function updateActivationStatus(s) {
        var listarray = new Array();
        //check this line for name filed
        $('input[name="multiple[]"]:checked').each(function () {
            listarray.push($(this).val());
        });
        //alert off if not nessearry
      // alert(listarray);
        var checklist = "" + listarray;
         //alert off if not nessearry
      //alert(checklist);
        if (!isNaN(s) && (s == '1' || s == '0') && checklist != '') {
           
            $.ajax({
                dataType: 'json',
                type: 'post',
                data: {'tablename': 'shipping_cost', 'updatelist': checklist, 'activity': s},
                url: '<?php echo base_url(); ?>front/Shipper/commonStatus/',
                success: function (u) {
                    console.log(u);
                    if(u.code=='200'){$('#success').show();$('#successmessage').html(u.description).addClass('alert alert-success');setTimeout(function() {window.location=location.href;},2000);}
    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');setTimeout(function() {window.location=location.href;},2000);}
                },
                error: function (er) {
                    console.log(er);
                }
            });
        } else {
            $('#fail').show();
            $('#failmessage').html('*  Please select a record').addClass('alert alert-warning');setTimeout(function() {window.location=location.href;},2000);
        }
    }
</script>

<script type="text/javascript">
    function commonDelete(){
    var listarray=new Array();
      $('input[name="multiple[]"]:checked').each(function(){listarray.push($(this).val());});
        var checklist=""+listarray;
        //alert(checklist);
      if(checklist!=''){
       var confirmation=confirm('Are you sure to delete selected records?');
        if(confirmation==true){
         $('#fail').hide();
         $.ajax({
          dataType:'json',
          type:'post',
          data:{'tablename':'shipping_cost','updatelist':checklist},
          url:'<?php echo base_url();?>front/Shipper/commonDelete/',
          success:function(u){
           // console.log(u);
            if(u.code=='200'){$('#success').show();$('#successmessage').html(u.description).addClass('alert alert-success');setTimeout(function() {window.location=location.href;},2000);}
                    if(u.code=='204' || u.code=='301' || u.code=='422'){$('#fail').show();$('#failmessage').html(u.description).addClass('alert alert-danger');setTimeout(function() {window.location=location.href;},2000);}
                 },
          error:function(er){
            console.log(er);
          }
        });
       }
      }
      else{
       $('#fail').show();
            $('#failmessage').html('*  Please select a record').addClass('alert alert-warning');setTimeout(function() {window.location=location.href;},2000);
      }
    }
$('#temp').delay(3000).fadeOut('slow');
</script>
 </body>
</html>
