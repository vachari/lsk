  <?php $sideBarActivePage = $this->uri->segment(1); ?>
  <div class="myaccount-tab-list nav">
  	<a href="<?php echo base_url(); ?>profile" class="<?php echo ($sideBarActivePage == 'profile') ? 'active' : ''; ?>">Dashboard <i class="fa fa-home"></i></a>
  	<a href="<?php echo base_url(); ?>myorders" class="<?php echo ($sideBarActivePage == 'myorders') ? 'active' : ''; ?>">Orders <i class="fa fa-file-o"></i></a>
  	<a href="<?php echo base_url(); ?>wishlist" class="<?php echo ($sideBarActivePage == 'wishlist') ? 'active' : ''; ?>">Orders <i class="fa fa-file-o"></i></a>
  	<a href="<?php echo base_url() . 'logout'; ?>">Logout <i class="fa fa-sign-out"></i></a>
  </div>