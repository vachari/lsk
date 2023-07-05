 <ul role="tablist" class="nav flex-column dashboard-list">
 	<?php $sideBarActivePage = $this->uri->segment(1); ?>
 	<li><a href="<?php echo base_url(); ?>profile" class="nav-link <?php echo ($sideBarActivePage == 'profile') ? 'active' : ''; ?>">Dashboard</a></li>
 	<li> <a href="<?php echo base_url(); ?>myorders" class="nav-link <?php echo ($sideBarActivePage == 'myorders') ? 'active' : ''; ?>">Orders</a></li>
 	<!-- <li><a href="#downloads" class="nav-link">Downloads</a></li> -->
 	<!-- <li><a href="javascript:void(0)" onclick="alert('Inprogress')" class="nav-link">Addresses</a></li> -->
 	<li><a href="<?php echo base_url(); ?>wishlist" class="nav-link">Wishlist</a></li>
 	<li><a href="<?php echo base_url() . 'logout'; ?>" class="nav-link">logout</a></li>
 </ul>