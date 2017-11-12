

<?php $permissions=json_decode($this->custom->getSingleValue('groups','permissions',array('id' => $this->session->group_id))); 
   ?>
<aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
         <div class="pull-left image">
            <img src="<?php echo IMG_PATH.'avatar5.png';?>" class="img-circle" alt="User Image" />
         </div>
         <div class="pull-left info">
            <p>Hi, <?php echo $this->session->username; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->level; ?></a>
         </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
         <!-- <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Start</div>-->
            <li class="active">
               <a href="<?php echo base_url(); ?>dashboard" class="auto">
               <i class="fa fa-dashboard">
               </i>
               <span class="font-bold">Dashboard</span>
               </a>
            </li>
            <li>
               <a href="<?php echo base_url(); ?>dashboard/change_password" class="auto">
                  <!-- <span class="pull-right text-muted">
                     <i class="i i-circle-sm-o text"></i>
                     <i class="i i-circle-sm text-active"></i>
                     </span> -->
                  <!-- <b class="badge bg-danger pull-right">4</b> -->
                  <i class="fa fa-user"></i>
                  <span class="font-bold">Change Password</span>
               </a>
            </li>
            <!-- System utilities code start -->
            <li class="treeview">
               <a href="#">
               <i class="fa fa-database"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">System Manager</span>
               </a>
                <ul class="treeview-menu"> 
            <?php if($this->ion_auth->is_admin() && $this->session->group_id==1 ): ?>
            <li>
               <a href="<?php echo base_url(); ?>company_profile" class="auto">
               <i class="fa fa-building"></i>
               <span class="font-bold">TOPFORM Utility</span>
               </a>
            </li>
            <?php endif; ?> 
            <?php if(!$this->ion_auth->is_admin() && $this->session->group_id!=1): ?>
               <li>
                  <a href="<?php echo base_url(); ?>company_profile" class="auto">
                  <i class="fa fa-building"></i>
                  <span class="font-bold">Company Profile</span>
                  </a>
               </li>
            <?php endif; ?>
            <?php if($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin"): ?>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-wrench"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">System Utilities</span>
               </a>
               <ul class="treeview-menu">
                  <li>
                     <a href="<?php echo base_url(); ?>system_utilities/backup_database" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Backup Data Files</span>
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>system_utilities/restore_database" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Restore Data Files</span>
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>system_utilities/initialize_database" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Initialize Master Files</span>
                     </a>
                  </li>
               </ul>
            </li>
            <?php endif; ?>
            
            <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->customer_master || $permissions->billing_master || $permissions->salesman_master): ?>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-cloud-upload"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Migrate Data Files</span>
               </a>
               <ul class="treeview-menu">
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->customer_master): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>system_utilities/import_customer_master" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Import Customer Data</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->billing_master): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>system_utilities/import_billing_master" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Import Billing Data</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->salesman_master): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>system_utilities/import_salesman_master" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Import Sales Person Data</span>
                     </a>
                  </li>
                  <?php endif; ?>
               </ul>
            </li>
            <?php endif; ?>
            
            <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->customer_master || $permissions->billing_master || $permissions->salesman_master): ?>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-cog"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Master Files</span>
               </a>
               <ul class="treeview-menu">
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->customer_master): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>master_files/customer_master" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Customer Master</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->billing_master): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>master_files/billing_master" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Billing Master</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->salesman_master): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>master_files/salesman_master" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Sales Person Master</span>
                     </a>
                  </li>
                  <?php endif; ?>
               </ul>
            </li>
            <?php endif; ?>
            <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->forex_master || $permissions->gst_master || $permissions->country_master): ?>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-cogs"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Combo Tables</span>
               </a>
               <ul class="treeview-menu">
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->forex_master): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>combo_tables/forex_master" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Forex Master</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->gst_master): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>combo_tables/gst_master" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>GST Master</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->country_master): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>combo_tables/country_master" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Country</span>
                     </a>
                  </li>
                  <?php endif; ?>
               </ul>
            </li>
            <?php endif; ?>
             <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin"): ?>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-users"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Staff Management</span>
               </a>
               <ul class="treeview-menu">
                  <li>
                     <a href="<?php echo base_url(); ?>staff_management/manage_group" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Add Employee Group</span>
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>staff_management/manage_employee" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Add Employee</span>
                     </a>
                  </li>
               </ul>
            </li>
            <?php endif; ?>
            </ul>
            </li>
           <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->quotation_setting || $permissions->quotation || $permissions->pending_quotation || $permissions->confirm_quotation || $permissions->rejected_quotation): ?>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-clone"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Application</span>
               </a>
                <ul class="treeview-menu"> 
               <li class="treeview">
               <a href="#">
               <i class="fa fa-list"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Quotation</span>
               </a>
               <ul class="treeview-menu">
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->quotation_setting): ?>
                     <li>
                        <a href="<?php echo base_url(); ?>quotation/quotation_setting" class="auto">
                        <i class="fa fa-paperclip"></i>
                        <span class="font-bold">Quotation Setting</span>
                        </a>
                     </li>
                     <?php endif; ?>
                     <!-- System utilities code close -->
            <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->quotation): ?>
            <li>
               <a href="<?php echo base_url(); ?>quotation" class="auto">
               <i class="fa fa-file-o"></i>
               <span class="font-bold">New Quotation</span>
               </a>
            </li>
            <?php endif; ?>
            <!-- <li>
               <a href="<php echo base_url();?>admin/quotationlist" class="auto">
                   <span class="pull-right text-muted">
               <i class="i i-circle-sm-o text"></i>
               <i class="i i-circle-sm text-active"></i>
               </span>
                   <i class="i i-docs icon">
               </i>
                   <span class="font-bold">Quotationlist</span>
               </a>
               </li> -->
     <!--       <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->pending_quotation || $permissions->confirm_quotation || $permissions->rejected_quotation): ?>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-list"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Quotation listing</span>
               </a>
               <ul class="treeview-menu">
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->pending_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/pending" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Pending Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->confirm_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/confirm" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Confirm Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->rejected_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/rejected" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Rejected Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?> -->
                  
                        <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->pending_quotation  || $permissions->confirm_quotation || $permissions->rejected_quotation|| $permissions->successful_quotation|| $permissions->deleted_quotation): ?>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-list"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Quotation listing</span>
               </a>
               <ul class="treeview-menu">
                <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->confirm_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/confirm" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Confirmed Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                   <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->rejected_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/rejected" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Rejected Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  
                   <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->successful_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/successful" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Successful Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  
                   <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->deleted_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/deleted" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Deleted Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  
                <!--  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->pending_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/pending" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Pending Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->confirm_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/confirm" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Confirm Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?> -->
                 
               </ul>
            </li>
            <?php endif; ?>      
            
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->quotation_setting): ?>
                     <li>
                        <a href="<?php echo base_url(); ?>quotation/zap_Quotation_data" class="auto">
                        <i class="fa fa-bolt"></i>
                        <span class="font-bold">ZAP Quotation</span>
                        </a>
                     </li>
                     <?php endif; ?>
               </ul>
            </li>
            <?php endif; ?>      
               </ul>
            </li>

            <li class="treeview">
               <a href="#">
               <i class="fa fa-list"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Quotation</span>
               </a>
               <ul class="treeview-menu">
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->quotation_setting): ?>
                     <li>
                        <a href="<?php echo base_url(); ?>quotation/quotation_setting" class="auto">
                        <i class="fa fa-paperclip"></i>
                        <span class="font-bold">Quotation Setting</span>
                        </a>
                     </li>
                     <?php endif; ?>
                     <!-- System utilities code close -->
            <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->quotation): ?>
            <li>
               <a href="<?php echo base_url(); ?>quotation" class="auto">
               <i class="fa fa-file-o"></i>
               <span class="font-bold">New Quotation</span>
               </a>
            </li>
            <?php endif; ?>
            <!-- <li>
               <a href="<php echo base_url();?>admin/quotationlist" class="auto">
                   <span class="pull-right text-muted">
               <i class="i i-circle-sm-o text"></i>
               <i class="i i-circle-sm text-active"></i>
               </span>
                   <i class="i i-docs icon">
               </i>
                   <span class="font-bold">Quotationlist</span>
               </a>
               </li> -->
     <!--       <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->pending_quotation || $permissions->confirm_quotation || $permissions->rejected_quotation): ?>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-list"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Quotation listing</span>
               </a>
               <ul class="treeview-menu">
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->pending_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/pending" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Pending Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->confirm_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/confirm" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Confirm Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->rejected_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/rejected" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Rejected Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?> -->
                  
                        <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->pending_quotation  || $permissions->confirm_quotation || $permissions->rejected_quotation|| $permissions->successful_quotation|| $permissions->deleted_quotation): ?>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-list"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Quotation listing</span>
               </a>
               <ul class="treeview-menu">
                <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->confirm_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/confirm" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Confirmed Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                   <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->rejected_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/rejected" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Rejected Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  
                   <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->successful_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/successful" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Successful Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  
                   <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->deleted_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/deleted" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Deleted Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  
                <!--  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->pending_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/pending" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Pending Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->confirm_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>quotation/quotationlist/confirm" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Confirm Quotation</span>
                     </a>
                  </li>
                  <?php endif; ?> -->
                 
               </ul>
            </li>
            <?php endif; ?>      
            
                  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->quotation_setting): ?>
                     <li>
                        <a href="<?php echo base_url(); ?>quotation/zap_Quotation_data" class="auto">
                        <i class="fa fa-bolt"></i>
                        <span class="font-bold">ZAP Quotation</span>
                        </a>
                     </li>
                     <?php endif; ?>
               </ul>
            </li>
            <?php endif; ?> 
            
            <li class="treeview">
               <a href="#">
               <i class="fa fa-list"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Invoice</span>
               </a>
               <ul class="treeview-menu">
                  
               <li>
                  <a href="<?php echo base_url();?>invoice/invoice_setting" class="auto">
                  <i class="fa fa-paperclip"></i>
                  <span class="font-bold">Invoice Setting</span>
                  </a>
               </li>
                     
               <!-- <li>
                  <a href="<?php echo base_url();?>invoice" class="auto">
                  <i class="fa fa-file-o"></i>
                  <span class="font-bold">New invoice</span>
                  </a>
               </li> -->

                  <li class="treeview">
                     <a href="JavaScript:void(0);">
                     <i class="fa fa-list"></i>
                     <i class="fa fa-angle-left pull-right"></i>
                     <span class="font-bold">New invoice</span>
                     </a>
                     <ul class="treeview-menu">
                        <li>
                           <a href="<?php echo base_url();?>invoice" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Itemised Entries</span>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>invoice/extract_from_quotatin" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Extract Quotation</span>
                           </a>
                        </li>
                     </ul>
                  </li>
                 
               <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->pending_invoice || $permissions->confirm_invoice || $permissions->rejected_invoice): ?>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-list"></i>
                     <i class="fa fa-angle-left pull-right"></i>
                     <span class="font-bold">Invoice listing</span>
                     </a>
                     <ul class="treeview-menu">
                        <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->pending_invoice): ?>
                        <li>
                           <a href="<?php echo base_url(); ?>invoice/invoicelist/confirmed" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Confirmed Invoice</span>
                           </a>
                        </li>
                        <?php endif; ?>
                        <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->confirm_invoice): ?>
                        <li>
                           <a href="<?php echo base_url(); ?>invoice/invoicelist/posted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Posted Invoice</span>
                           </a>
                        </li>
                        <?php endif; ?>
                        <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->rejected_invoice): ?>
                        <li>
                           <a href="<?php echo base_url(); ?>invoice/invoicelist/deleted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Deleted Invoice</span>
                           </a>
                        </li>
                        <?php endif; ?>
                     </ul>
                  </li>
                  <?php endif; ?>
            
            		  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->pending_quotation  || $permissions->confirm_quotation || $permissions->rejected_quotation|| $permissions->successful_quotation|| $permissions->deleted_quotation): ?>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-list"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Other listing</span>
               </a>
               <ul class="treeview-menu">
                <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->confirm_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>invoice/otherlist/ar" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>AR listing</span>
                     </a>
                  </li>
                  <?php endif; ?>
                                     
                   <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->successful_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>invoice/otherlist/gl" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>GL listing</span>
                     </a>
                  </li>
                  <?php endif; ?>
                  
                   <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->deleted_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>invoice/otherlist/gst" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>GST listing</span>
                     </a>
                  </li>
                  <?php endif; ?>
				  
				  <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->deleted_quotation): ?>
                  <li>
                     <a href="<?php echo base_url(); ?>invoice/otherlist/stock" class="auto">
                     <i class="fa fa-arrow-right"></i>
                     <span>Stock listing</span>
                     </a>
                  </li>
                  <?php endif; ?>
               </ul>
                  </li>
                  <?php endif; ?>
            
            <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->quotation_setting): ?>
                     <li>
                        <a href="<?php echo base_url(); ?>invoice/zap_Invoice_data" class="auto">
                        <i class="fa fa-bolt"></i>
                        <span class="font-bold">ZAP Invoice</span>
                        </a>
                     </li>
                     <?php endif; ?>
                     
               </ul>
            </li>
            <li class="treeview">
               <a href="javascript:void(0);">
               <i class="fa fa-list"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Receipt</span>
               </a>
               <ul class="treeview-menu">
                  
               <li>
                  <a href="<?php echo base_url(); ?>receipt/receipt_setting" class="auto">
                  <i class="fa fa-paperclip"></i>
                  <span class="font-bold">Receipt Setting</span>
                  </a>
               </li>
                     
               <li>
                  <a href="<?php echo base_url(); ?>receipt" class="auto">
                  <i class="fa fa-file-o"></i>
                  <span class="font-bold">New Receipt</span>
                  </a>
               </li>

               <li>
                  <a href="#" class="auto">
                  <i class="fa fa-file-o"></i>
                  <i class="fa fa-angle-left pull-right"></i>
                  <span class="font-bold">Receipt Listing</span>
                  </a>
                     <ul class="treeview-menu">
                        <li>
                           <a href="<?php echo base_url(); ?>receipt/receiptlist/confirmed" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Confirmed Receipt</span>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>receipt/receiptlist/posted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Posted Receipt</span>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>receipt/receiptlist/deleted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Deleted Receipt</span>
                           </a>
                        </li>
                     </ul>
               </li>
               
                 <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->quotation_setting): ?>
                     <li>
                        <a href="<?php echo base_url(); ?>receipt/zap_receipt_data" class="auto">
                        <i class="fa fa-bolt"></i>
                        <span class="font-bold">ZAP Receipt</span>
                        </a>
                     </li>
                     <?php endif; ?>
            
               </ul>
            </li>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-list"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Accounts receivable</span>
               </a>
               <ul class="treeview-menu">
               
               <li>
                  <a href="<?php echo base_url(); ?>account/auditlist" class="auto">
                  <i class="fa fa-list-alt"></i>
                  <span class="font-bold">Audit Listing</span>
                  </a>
               </li>
               
               <li>
                  <a href="<?php echo base_url(); ?>account/opening_balance" class="auto">
                  <i class="fa fa-list-alt"></i>
                  <span class="font-bold">Opening Balance b/f</span>
                  </a>
               </li>

               <li>
                  <a href="#" class="auto">
                  <i class="fa fa-file-o"></i>
                  <i class="fa fa-angle-left pull-right"></i>
                  <span class="font-bold">Opening Listing</span>
                  </a>
                     <ul class="treeview-menu">
                        <li>
                           <a href="<?php echo base_url(); ?>account/openlist/confirmed" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Confirmed Opening Balance</span>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>account/openlist/posted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Posted Opening Balance</span>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>account/openlist/deleted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Deleted Opening Balance</span>
                           </a>
                        </li>
                     </ul>
               </li>

               <li>
                  <a href="<?php echo base_url(); ?>account/new_debtor" class="auto">
                  <i class="fa fa-file-o"></i>
                  <span class="font-bold">New Debtor Statement</span>
                  </a>
               </li>
               
               <li>
                  <a href="<?php echo base_url(); ?>account/offset" class="auto">
                  <i class="fa fa-file-o"></i>
                  <span class="font-bold">Offset the records</span>
                  </a>
               </li>
               
               <li>
                  <a href="<?php echo base_url(); ?>account" class="auto">
                  <i class="fa fa-file-o"></i>
                  <span class="font-bold">Debtor Statement</span>
                  </a>
               </li>

               <li>
                  <a href="#" class="auto">
                  <i class="fa fa-paperclip"></i>
                  <span class="font-bold">Other Debtor Report</span>
                  </a>
               </li>
                     

               <!-- <li>
                  <a href="#" class="auto">
                  <i class="fa fa-file-o"></i>
                  <span class="font-bold">Account Listing</span>
                  </a>
               </li> -->

               
                 <?php if(($this->ion_auth->is_admin() && $this->session->group_id==1 || $this->session->level=="admin") || $permissions->quotation_setting): ?>
                     <li>
                        <a href="<?php echo base_url(); ?>account/zap_ar_data" class="auto">
                        <i class="fa fa-bolt"></i>
                        <span class="font-bold">ZAP Accounts Receivable</span>
                        </a>
                     </li>
                     <?php endif; ?>
            
               </ul>
            </li>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-list"></i>
               <i class="fa fa-angle-left pull-right"></i>
               <span class="font-bold">Stocks</span>
               </a>
               <ul class="treeview-menu">
                  <li>
                     <a href="<?php echo base_url(); ?>stock/opening_balance" class="auto">
                     <i class="fa fa-list-alt"></i>
                     <span class="font-bold">Stock Opening Balance B/F</span>
                     </a>
                  </li>

                  <li>
                     <a href="#" class="auto">
                     <i class="fa fa-list"></i>
                     <i class="fa fa-angle-left pull-right"></i>
                     <span class="font-bold">Stock Opening Balance Listing</span>
                     </a>
                     <ul class="treeview-menu">
                        <li>
                           <a href="<?php echo base_url(); ?>stock/stock_openlist/confirmed" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Confirmed Stock Opening Balance</span>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>stock/stock_openlist/posted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Posted Stock Opening Balance</span>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>stock/stock_openlist/deleted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Deleted Stock Opening Balance</span>
                           </a>
                        </li>
                     </ul>
                  </li>

               </ul>
            </li>
            
               
            </ul>
            </li>
            <?php endif; ?>
            <!-- order entry start -->
            
            <!-- order entry End -->
            
            <!-- Invoice Start -->
            <li>
               <!--<php echo base_url();?>admin/logout-->
               <a href="<?php echo base_url(); ?>common/signout" class="auto">
               <i class="fa fa-sign-out"></i>
               <span class="font-bold">Logout</span>
               </a>
            </li>
         </ul>
         <!-- <div class="line dk hidden-nav-xs"></div> -->
   </section>
   <!-- /.sidebar -->
</aside>
<script type="text/javascript">
  $('.sidebar-menu').find('a').each(function() {
   link=$(this).attr('href').split('/');
   // console.log(link);
   if(!link[4] && link[0]!="#"){
    // $(this).hide();
   }
});
</script>