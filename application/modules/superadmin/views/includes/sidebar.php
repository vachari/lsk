   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
     <!-- Sidebar user panel -->
     <div class="user-panel">
       <div class="pull-left image">
         <img src="<?php echo SUPER_IMG_PATH; ?>avatar6.png" class="img-circle" alt="User Image">
       </div>
       <div class="pull-left info">
         <p><?php echo PROJECT_NAME; ?></p>

       </div>
     </div>

     <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu">
       <li class="header">Admin Navigations</li>
       <li class="treeview <?php if ($this->uri->segment(2) == 'dashboard') echo 'active' ?>">
         <a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>">
           <i class="fa fa-dashboard"></i> <span>Dashboard</span>
         </a>
       </li>

       
       <li class="treeview <?php if ($this->uri->segment(2) == 'Category' && ($this->uri->segment(3) != 'createslider' && $this->uri->segment(3) != 'manageslider')) echo 'active' ?>">
         <a href="#">
           <i class="fa fa-laptop"></i>
           <span>Category Management</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li class="<?php if ($this->uri->segment(2) == 'Category' && ($this->uri->segment(3) == 'createCategory' || $this->uri->segment(3) == 'manageCategory')) echo 'active' ?>"><a href="#"><i class="fa fa-circle-o"></i>Main Category<span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
               </span></a>
             <ul class="treeview-menu">
               <li class="<?php if ($this->uri->segment(3) == 'createCategory') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Category/createCategory"><i class="fa fa-circle-o"></i>Create New</a>
               </li>
               <li class="<?php if ($this->uri->segment(3) == 'manageCategory') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Category/manageCategory"><i class="fa fa-circle-o"></i> Manage </a>
               </li>
             </ul>
           </li>
           <li class="<?php if ($this->uri->segment(2) == 'Category' && ($this->uri->segment(3) == 'createsubCategory' || $this->uri->segment(3) == 'managesubCategory')) echo 'active' ?>"><a href="#"><i class="fa fa-circle-o"></i>Sub Category<span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
               </span></a>
             <ul class="treeview-menu">
               <li class="<?php if ($this->uri->segment(3) == 'createsubCategory') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Category/createsubCategory"><i class="fa fa-circle-o"></i>Create New</a>
               </li>
               <li class="<?php if ($this->uri->segment(3) == 'managesubCategory') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Category/managesubCategory"><i class="fa fa-circle-o"></i> Manage </a>
               </li>
             </ul>
           </li>
           <li class="<?php if ($this->uri->segment(2) == 'Category' && ($this->uri->segment(3) == 'createlistsubCategory' || $this->uri->segment(3) == 'managelistsubCategory')) echo 'active' ?>"><a href="#"><i class="fa fa-circle-o"></i>Sub-sub Category<span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
               </span></a>
             <ul class="treeview-menu">
               <li class="<?php if ($this->uri->segment(3) == 'createlistsubCategory') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Category/createlistsubCategory"><i class="fa fa-circle-o"></i>Create New</a>
               </li>
               <li class="<?php if ($this->uri->segment(3) == 'managelistsubCategory') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Category/managelistsubCategory"><i class="fa fa-circle-o"></i> Manage </a>
               </li>
             </ul>
           </li>
         </ul>
       </li>
       <li class="treeview <?php if ($this->uri->segment(2) == 'Settings' && ($this->uri->segment(3) == 'createUnits' || $this->uri->segment(3) == 'manageUnits')) echo 'active' ?>">
         <a href="#">
           <i class="fa fa-laptop"></i>
           <span>Units of Measure</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li class="<?php if ($this->uri->segment(3) == 'createUnits') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Settings/createUnits"><i class="fa fa-circle-o"></i>Create New</a>
           </li>
           <li class="<?php if ($this->uri->segment(3) == 'manageUnits') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Settings/manageUnits"><i class="fa fa-circle-o"></i>Manage</a>
           </li>
         </ul>
       </li>
       <li class="treeview <?php if ($this->uri->segment(2) == 'Product' && ($this->uri->segment(3) == 'createproduct' || $this->uri->segment(3) == 'productDetails' || $this->uri->segment(3) == 'bulk_upload_view')) echo 'active' ?>">
         <a href="#">
           <i class="fa fa-laptop"></i>
           <span>Products</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li class="<?php if ($this->uri->segment(3) == 'createproduct') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Product/createproduct"><i class="fa fa-circle-o"></i> Create New</a></li>
           <li class="<?php if ($this->uri->segment(3) == 'productDetails') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Product/productDetails"><i class="fa fa-circle-o"></i> Manage</a></li>
           <li class="<?php if ($this->uri->segment(3) == 'bulk_upload_view') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Product/bulk_upload_view"><i class="fa fa-circle-o"></i> Products Bulk Upload</a></li>
           <!-- <li class="<?php if ($this->uri->segment(3) == 'product_inventory') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Product/product_inventory"><i class="fa fa-circle-o"></i> Product Inventory/Availability</a></li> -->
         </ul>
       </li>

       <li class="treeview <?php if ($this->uri->segment(2) == 'Orders') echo 'active' ?>">
         <a href="#">
           <i class="fa fa-shopping-cart"></i> <span>Orders</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li class="<?php if ($this->uri->segment(2) == 'Orders') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH . 'Orders'; ?>"><i class="fa fa-circle-o"></i>ALL Orders </a></li>
           <li class="<?php if ($this->uri->segment(2) == 'manage_cancelled_orders') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH . 'manage_cancelled_orders'; ?>"><i class="fa fa-circle-o"></i>Cancelled Orders </a></li>
           <!-- <li><a href="<?php echo SUPER_ADMIN_FOLDER_PATH . 'Orders/shareCartOrders'; ?>"><i class="fa fa-circle-o"></i> Share Cart</a></li> -->
         </ul>
       </li>
       <!--  <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i> <span>Customer-Complaints</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         <ul class="treeview-menu">
            <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i>eMAil templates </a></li>
            <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Statistics</a></li>
          </ul>
        </li> -->
       <li class="treeview <?php if ($this->uri->segment(3) == 'createslider' || $this->uri->segment(3) == 'manageslider') echo 'active' ?>">
         <a href="#">
           <i class="fa fa-picture-o"></i> <span>Sliders</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li class="<?php if ($this->uri->segment(3) == 'createslider') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Category/createslider/"><i class="fa fa-circle-o"></i>Create New </a></li>
           <li class="<?php if ($this->uri->segment(3) == 'manageslider') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Category/manageslider/"><i class="fa fa-circle-o"></i> Manage</a></li>
         </ul>
       </li>
       <li class="treeview <?php if ($this->uri->segment(2) == 'Faqs' && $this->uri->segment(3) != 'help') echo 'active' ?>">
         <a href="#">
           <i class="fa fa-question"></i> <span>FAQ's</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li class="<?php if ($this->uri->segment(3) == 'createFaq') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Faqs/createFaq"><i class="fa fa-circle-o"></i>Create New </a></li>
           <li class="<?php if ($this->uri->segment(2) == 'Faqs' && $this->uri->segment(3) == '') echo 'active' ?>"><a href="<?php echo SUPER_ADMIN_FOLDER_PATH; ?>Faqs"><i class="fa fa-circle-o"></i> Manage</a></li>
         </ul>
       </li>




       <li class="treeview <?php if ($this->uri->segment(3) == 'setLimit' || $this->uri->segment(3) == 'changePassword') echo 'active' ?>">
         <a href="#">
           <i class="fa fa-cogs"></i> <span>Settings</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">

           <li class="<?php if ($this->uri->segment(3) == 'changePassword') echo 'active' ?>"><a href="<?php echo base_url() . 'superadmin/Admin/changePassword/'; ?>"><i class="fa fa-question" aria-hidden="true"></i>Change Password</a></li>
           <li><a href="<?php echo base_url() . 'superadmin/Admin/logout'; ?>"><i class="fa fa-question" aria-hidden="true"></i>Logout</a></li>
         </ul>
       </li>

     </ul>
   </section>