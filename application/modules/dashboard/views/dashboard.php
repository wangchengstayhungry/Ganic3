<style type="text/css">
  #system_managers_menu,#applications_menu,#system_utilities_menu,#master_files_menu,#staff_managment_menu,#combo_tables_menu,#quotations_menu,#invoices_menu,#receipts_menu,#account_receivable_menu, #account_receivable_menu2{
    display: none;
  }
</style>
<section class="content-header">
  <h1>
    Admin Dashboard
    <small>Control panel</small>
  </h1>
  <?php echo breadcrumb(); ?>
</section>
<section class="content">
  <?php echo get_flash_message('message'); ?>
  <div class="row">
    <div class="col-md-offset-1 col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-green" id="system_managers">
            <div class="inner">
              <h1>System Manager</h1>
              <p>&nbsp;</p>
              <br>
              <br>
            </div>
            <div class="icon">
              <i class="fa fa-wrench"></i>
            </div>
            <a href="<?php echo current_url();?>?id=system_managers_sec" id="system_managers_sec" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-down"></i>
            </a>
          </div>
    </div>
    <div class="col-md-offset-1 col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-light-blue" id="applications">
            <div class="inner">
              <h1>Applications</h1>
              <p>&nbsp;</p>
              <br>
              <br>
            </div>
            <div class="icon">
              <i class="fa fa-cog"></i>
            </div>
            <a href="<?php echo current_url();?>?id=applications_sec" class="small-box-footer" id="applications_sec">
              Click Here <i class="fa fa-arrow-circle-down"></i>
            </a>
          </div>
    </div>
  </div>



  <div class="row" id="system_managers_menu">
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-aqua" id="system_utilities">
            <div class="inner">
              <h1>System Utilities</h1>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              <i class="fa fa-wrench"></i>
            </div>
            <a href="<?php echo current_url();?>?id=system_managers_sec&id1=system_utilities_sec" id="system_utilities_sec" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-down"></i>
            </a>
          </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-yellow" id="master_files">
            <div class="inner">
              <h1>Master <br>Files</h1>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              <i class="fa fa-cog"></i>
            </div>
            <a href="<?php echo current_url();?>?id=system_managers_sec&id1=master_files_sec" id="master_files_sec" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-down"></i>
            </a>
          </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-purple" id="combo_tables">
            <div class="inner">
              <h1>Combo <br> Tables</h1>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              <i class="fa fa-cogs"></i>
            </div>
            <a href="<?php echo current_url();?>?id=system_managers_sec&id1=combo_tables_sec" id="combo_tables_sec" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-down"></i>
            </a>
          </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-maroon" id="staff_managment">
            <div class="inner">
              <h1>Staff Managment</h1>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo current_url();?>?id=system_managers_sec&id1=staff_managment_sec" id="staff_managment_sec" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-down"></i>
            </a>
          </div>
    </div>
  </div>
  <div class="row" id="system_utilities_menu">
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Backup Data Files</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>system_utilities/backup_database" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Restore Data Files</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>system_utilities/restore_database" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Initialize Master Files</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>system_utilities/initialize_database" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
  </div>
  <div class="row" id="master_files_menu">
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Customer Master</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
            </div>
            <a href="<?php echo base_url(); ?>master_files/customer_master" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Billing Master</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
            </div>
            <a href="<?php echo base_url(); ?>master_files/billing_master" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Sales Person Master</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
            </div>
            <a href="<?php echo base_url(); ?>master_files/salesman_master" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
  </div>
  <div class="row" id="combo_tables_menu">
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-purple">
            <div class="inner">
              <h3>Forex Master</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
            </div>
            <a href="<?php echo base_url(); ?>combo_tables/forex_master" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-purple">
            <div class="inner">
              <h3>GST Master</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
            </div>
            <a href="<?php echo base_url(); ?>combo_tables/gst_master" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-purple">
            <div class="inner">
              <h3>Country</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
            </div>
            <a href="<?php echo base_url(); ?>combo_tables/country_master" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
  </div>
  <div class="row" id="staff_managment_menu">
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-maroon">
            <div class="inner">
              <h3>Add Employee Group</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>staff_management/manage_group" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-maroon">
            <div class="inner">
              <h3>Add Employee</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>staff_management/manage_employee" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
  </div>

  <div class="row" id="applications_menu">
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-aqua" id="quotations">
            <div class="inner">
              <h1>Quotation </h1>
              <br/> <br/>
            </div>
            <div class="icon">
              <i class="fa fa-wrench"></i>
            </div>
            <a  href="<?php echo current_url();?>?id=applications_sec&id1=quotations_sec" id="quotations_sec" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-down"></i>
            </a>
          </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-yellow" id="invoices">
            <div class="inner">
              <h1>Invoice </h1>
              <br/> <br/>
             </div>
            <div class="icon">
              <i class="fa fa-cog"></i>
            </div>
            <a href="<?php echo current_url();?>?id=applications_sec&id1=invoices_sec" id="invoices_sec"
             class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-down"></i>
            </a>
          </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-purple" id="receipts">
            <div class="inner">
              <h1>Receipt</h1>
             <br/> <br/>
            </div>
            <div class="icon">
              <i class="fa fa-cogs"></i>
            </div>
            <a  href="<?php echo current_url();?>?id=applications_sec&id1=receipts_sec" id="receipts_sec" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-down"></i>
            </a>
          </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-maroon" id="account_receivable">
            <div class="inner">
              <h1>Accounts <br/>Receivable </h1>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo current_url();?>?id=applications_sec&id1=account_receivable_sec" id="account_receivable_sec" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-down"></i>
            </a>
          </div>
    </div>
  </div>
  <div class="row" id="quotations_menu">
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Quotation <br> setting</h3>
<!--              <p>&nbsp;</p> -->
              </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>quotation/quotation_setting" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-aqua">
            <div class="inner">
              <h3>New quotation</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>quotation" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Quotation <br/> listing</h3>
              
            </div>
            <div class="icon">
              
            </div>
            <a href="JavaScript:void(0);" id="quotation_listing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                     <!-- <ul class="treeview-menu new_invoice_menu" style="display: none"> -->
                        <div class="quotation_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>quotation/quotationlist/confirm" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Confirmed Quotation</span>
                           </a>
                        </div>
                        <div class="quotation_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>quotation/quotationlist/rejected" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Rejected Quotation</span>
                           </a>
                        </div>
                        <div class="quotation_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>quotation/quotationlist/successful" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Successful Quotation</span>
                           </a>
                        </div>
                         <div class="quotation_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>quotation/quotationlist/deleted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Deleted Quotation</span>
                           </a>
                        </div>
          </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-aqua">
            <div class="inner">
              <h3>ZAP quotation</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>quotation/zap_Quotation_data" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-down"></i></a>
          </div>
    </div>
  </div>
  <div class="row" id="invoices_menu">
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Invoice <br/> setting</h3>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>invoice/invoice_setting" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-yellow">
            <div class="inner">
              <h3>New invoice</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <!-- <a href="<?php echo base_url(); ?>invoice" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            <a href="JavaScript:void(0);" id="new_invoice" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                     <!-- <ul class="treeview-menu new_invoice_menu" style="display: none"> -->
                        <div class="new_invoice_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url();?>invoice" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Itemised Entries</span>
                           </a>
                        </div>
                        <div class="new_invoice_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>invoice/extract_from_quotatin" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Extract Quotation</span>
                           </a>
                        </div>
                     <!-- </ul> -->
          </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Invoice listing</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="JavaScript:void(0);" id="invoice_listing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                     <!-- <ul class="treeview-menu new_invoice_menu listing_menu" style="display: none"> -->
                        <div class="invoice_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url();?>invoice/invoicelist/confirmed" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Confirmed Invoice</span>
                           </a>
                        </div>
                        <div class="invoice_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>invoice/invoicelist/posted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Posted Invoice</span>
                           </a>
                        </div>
                        <div class="invoice_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>invoice/invoicelist/deleted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Deleted Invoice</span>
                           </a>
                        </div>
          </div>
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Other listing</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="JavaScript:void(0);" id="other_listing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                     <!-- <ul class="treeview-menu new_invoice_menu listing_menu" style="display: none"> -->
                        <div class="other_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url();?>invoice/otherlist/ar" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>AR listing</span>
                           </a>
                        </div>
                        <div class="other_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>invoice/otherlist/gl" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>GL listing</span>
                           </a>
                        </div>
                        <div class="other_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>invoice/otherlist/gst" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>GST listing</span>
                           </a>
                        </div>
                        <div class="other_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>invoice/otherlist/stock" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Stock listing</span>
                           </a>
                        </div>
          </div>
    </div>
    
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="small-box bg-yellow">
            <div class="inner">
              <h3>ZAP Invoice</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>invoice/zap_Invoice_data" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-down"></i></a>
          </div>
    </div>
    
  </div>
  <div class="row" id="receipts_menu">
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-purple">
            <div class="inner">
              <h3>Receipt setting</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>receipt/receipt_setting" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-purple">
            <div class="inner">
              <h3>New receipt</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>receipt" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-purple">
            <div class="inner">
              <h3>Receipt listing</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="JavaScript:void(0);" id="receipt_listing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                     <!-- <ul class="treeview-menu new_invoice_menu" style="display: none"> -->
                        <div class="receipt_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>receipt/receiptlist/confirmed" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Confirmed Receipt</span>
                           </a>
                        </div>
                        <div class="receipt_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>receipt/receiptlist/posted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Posted Receipt</span>
                           </a>
                        </div>
                        <div class="receipt_listing_menu listing_menu" style="display: none">
                           <a href="<?php echo base_url(); ?>receipt/receiptlist/deleted" class="auto">
                           <i class="fa fa-arrow-right"></i>
                           <span>Deleted Receipt</span>
                           </a>
                        </div>
          </div>
    </div>
    
     <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-purple">
            <div class="inner">
              <h3>ZAP Receipt</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>receipt/zap_receipt_data" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-down"></i></a>
          </div>
    </div>
    
  </div>
  <div class="row" id="account_receivable_menu">
  <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-maroon">
            <div class="inner">
              <h3>Audit Listing</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>account/auditlist" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-maroon">
            <div class="inner">
              <h3>Opening Balance b/f</h3>
              <!--<p>&nbsp;</p>-->
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>account/opening_balance" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-maroon">
            <div class="inner">
              <h3>New Debtor <br/>Statement</h3>
              <!--<p>&nbsp;</p>-->
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>account/new_debtor" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    
  <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-maroon">
            <div class="inner">
              <h3>Debtor Statement</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>account" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    
    </div>
    
    <div class="row" id="account_receivable_menu2">

    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-maroon">
            <div class="inner">
              <h3>Other Debtor Report</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
    
    <!-- <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-maroon">
            <div class="inner">
              <h3>Account listing</h3>
              <p>&nbsp;</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div> -->
    
     <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="small-box bg-maroon">
            <div class="inner">
              <h3>ZAP Accounts <br/> Receivable</h3>
              <!--<p>&nbsp;</p>-->
            </div>
            <div class="icon">
              
            </div>
            <a href="<?php echo base_url(); ?>account/zap_ar_data" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-down"></i></a>
          </div>
    </div>
    
  </div>
</section>

<script type="text/javascript">
jQuery(document).ready(function($) {
var i =0;
  <?php 
if(isset($_GET['id']) && ($_GET['id'] == 'applications_sec' || $_GET['id'] == 'system_managers_sec') ){?>
  // alert('');
  var i =1;
  setTimeout(function(){
    $("#<?php echo $_GET['id'] ?>").trigger("click");
    <?php if(isset($_GET['id1'])){?>
      i = 2;
     var id1 = '<?php echo $_GET['id1'];?>';
      setTimeout(function(){
        $('#'+id1).trigger("click");
      },400)
   <?php }?>
  },400)
<?php }  ?>   



  $("#system_managers_menu,#applications_menu").hide();
  $("#system_utilities_menu,#master_files_menu,#staff_managment_menu,#combo_tables_menu,#quotations_menu,#invoices_menu,#receipts_menu,#account_receivable_menu, #account_receivable_menu2").hide();

    if(i == 1){
      $("#system_managers,#applications").click(function() {
        id=$(this).attr('id');
        $("#system_managers,#applications").hide();
        $("#"+id).show();
        $("#system_managers_menu,#applications_menu").slideUp();
          $("#"+id+"_menu").slideDown();
        if(<?php echo !isset($_GET['id1'])?1:0?>){
          $("html, body").delay(1000).animate({
            scrollTop: $("#"+id+"_menu").offset().top 
          }, 1000);
        // $("#"+id+"_menu").scrollIntoView(true);  
        }
        
      });

    }
    // alert(id1);
    //   setTimeout(function(){
    //     alert(i);
    //   },300)

      $("#system_utilities,#master_files,#staff_managment,#combo_tables,#quotations,#invoices,#receipts,#account_receivable").click(function() {
        if(i == 2){
          
          $("#system_utilities_menu,#master_files_menu,#staff_managment_menu,#combo_tables_menu,#quotations_menu,#invoices_menu,#receipts_menu,#account_receivable_menu,#account_receivable_menu2").slideUp();
          id=$(this).attr('id');
          $("#"+id+"_menu").slideDown();
          $("#"+id+"_menu2").slideDown();
          $("html, body").delay(1000).animate({
              scrollTop: $("#"+id+"_menu").offset().top 
          }, 1000);
          // $("#"+id+"_menu").scrollIntoView(true);

        }
      });
    
function topScroll(){
        $("html, body").delay(1000).animate({
              scrollTop: $("#"+id+"_menu").offset().top 
          }, 1000);
}

   $('#new_invoice,#quotation_listing, #invoice_listing, #other_listing, #receipt_listing').click(function(){
    id=$(this).attr('id');
    $('.'+ id +'_menu').show();
 })
});
</script>    
<script type="text/javascript">
  $("#system_utilities_menu,#master_files_menu,#staff_managment_menu,#combo_tables_menu").find('a').each(function() {
   link=$(this).attr('href').split('/');
   // console.log(link);
   if(!link[4]){
    // $(this).hide();
    $(this).html("&nbsp;");
   }
});


  // window.onbeforeunload = confirmExit;
  //    function confirmExit() {
  //        if (formmodified == 1) {
  //            return "New information not saved. Do you wish to leave the page?";
  //        }
  //    }
$(document).ready(function(){
        // alert(document.URL);
        if(document.URL == 'http://crm52.topjac.com/dashboard'){
      history.pushState(null, null, document.URL);
      window.addEventListener('popstate', function () {
          $.confirm({
                title:"<i class='fa fa-info'></i> Exit Confirmation",
                text: "Are You Sure Exit ?",
                confirm: function(button) {
                  
                    window.location.replace("<?php echo base_url(); ?>common/signout/topform managment");
                },
                cancel: function(button) {
                    history.pushState(null, null, document.URL);
                }
            });
        
    });  
        }
});

</script>

<input type="hidden" name="" value="" id="test">

