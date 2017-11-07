<section class="content-header">
  <?php 
    $list = array('active'=>'Quotation');
    echo breadcrumb($list); 
  ?>
</section>
<br>
<section class="content">
  <?php echo get_flash_message('message'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <div class="tooltip">Hover over me
  <span class="tooltiptext">Tooltip text</span>
</div>
          <h3 class="box-title">Quotation</h3>
        </div>
      </div>
    </div>
  </div>
  <form autocomplete="off" class="form-horizontal validate" method="post" action="<?php echo $save_url; ?>">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
          <div class="row">
            <div class="col-md-12">
              <div class="box-header with-border">
                <center>
                  <strong>
                    <img src="<?php echo UPLOAD_PATH.'site/'.$company_details->company_logo ?>" class='img img-thumbnail' height="150px" width="150px"/>
                    <h4><?php echo $company_details->company_name ?></h4>
                    <?php echo $company_details->company_address; ?>
                    <br>GST Register Number : <?php echo $company_details->gst_reg_no ?> | UEN No. : <?php echo $company_details->uen_no; ?>
                    <br>Phone : <?php echo $company_details->phone ?> | Fax : <?php echo $company_details->fax ?>
                  </strong>
                </center>
              </div>
                <hr>
              <div class="box-body">
                <section class="invoice">
                  <!-- info row -->
                  <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                      <b>To,</b>
                      <address>
                        <select name="customer_id" id="customer_id" title="Select Customer" class="form-control select2" required="">
                          <?php echo $customer_options; ?>
                        </select><br>
                        <b>Address:</b><span id="customer_address"></span><br>
                        <b>Phone:</b> <span id="customer_phone"></span><br>
                        <b>Email:</b> <span id="customer_email"></span>
                      </address>
                    </div>
                    <div class="col-sm-4 invoice-col"></div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      <b>Quotation : #QUOT\<?php echo $quotation_details->quotation_text_prefix.'\\'.$total_quotation; ?></b><br>
                      <input type='hidden' name='quotation_ref_no' id="quotation_ref_no" value="QUOT\<?php echo $quotation_details->quotation_text_prefix.'\\'.$total_quotation; ?>">
                      <br>
                      <b>Date:</b> <?php echo date('d-m-Y'); ?><br>
                      <b>Salesman:</b>
                      <select name="salesman_id" id="salesman_id" title="Select Sales Person" class="form-control select2 col-xs-4 col-md-4" required="">
                          <?php echo $salesman_options; ?>
                      </select>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <br>
                  <!-- <legend></legend> -->
                  <div class="row">
                    <div class="col-xs-12">
                      <textarea class="form-control" rows="1" name="quotation_header_text"><?php echo $quotation_details->quotation_header_text; ?></textarea>
                    </div>
                  </div>
                  <br>
                  <!-- <legend></legend> -->
                  <hr>
                  <div class="row">
                    <div class="col-xs-12 col-md-5 product_id_div">
                      <select name="product_id" id="product_id" title="Select Product" class="form-control select2" >
                          <?php echo $product_options; ?>
                        </select>
                    </div>
                      <!-- <button class="btn btn-primary" id="new_product" onclick="$('.product_id_div').removeClass('hidden');">Add New Product</button> -->
                  </div>
                  <br>
                  <!-- <legend></legend> -->
                  <!-- Table row -->
                  <div class="row">
                    <div class="col-xs-12 table-responsive">
                      <table class="table table-striped" id="product_table">
                        <thead>
                          <tr>
                            <th>S.NO</th>
                            <th>DESCRIPTION</th>
                            <th>QUANTITY</th>
                            <th>UOM</th>
                            <th width="15%">UNIT PRICE( SGD )</th>
                            <th>DISCOUNT (%)</th>
                            <th>AMOUNT(SGD)</th>
                            <th>GST</th>
                            <th>ACTION</th>
                          </tr>
                        </thead>

                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <!-- <hr> -->
                  <div class="row">
                    <!-- accepted payments column -->
                    <!-- /.col -->
                    <div class="col-md-6 col-md-offset-6 col-xs-12">
                      <div class="table-responsive">
                        <table class="table hidden" id="summary">
                          <tbody>
                            <tr>
                              <th style="width:50%">Subtotal:</th>
                              <td class="hidden"><input type='hidden' name='sub_total' id="sub_total_text"></td>
                              <td></td>
                              <td id="sub_total" class="pull-right"></td>
                            </tr>
                            <tr>
                              <th>Lump Sum <br>Discount (%):</th>
                              <td ><input type="number" min='0' max='100' id="lump_sum_discount" name="lump_sum_discount" class="form-control" onchange="get_sub_total()"></td>
                              <td id="lump_sum_discount_amount" class="pull-right"></td>
                            </tr>
                            <tr>
                              <th>Net of <br>lump Discount:</th>
                              <td></td>
                              <td id="lump_sum_discount_price" class="pull-right"></td>
                              <td class="hidden"><input type='hidden' name='lump_sum_discount_price' id="lump_sum_discount_price_text"></td>
                            </tr>
                            <tr>
                              <th>GST (%) :</th>
                              <td><input type="number" id="gst" name="gst" class="form-control" readonly="" value="7"></td>
                              <td id="gst_payable_amount" class="pull-right"></td>
                            </tr>
                            <tr>
                              <th>Total:</th>
                              <td></td>
                              <td id="final_total" class="pull-right"></td>
                              <td class="hidden"><input type='hidden' name='final_total' id="final_total_text"></td>
                            </tr>
                            <tr id="total_curr" class="hidden">
                              <th>Total in(<span id="cust_curr"></span>):</th>
                              <td></td>
                              <td id="final_total_forex_text" class="pull-right"></td>
                              <td class="hidden"><input type='hidden' name='currency_amount' id="currency_amount"></td>
                              <td class="hidden"><input type='hidden' name='final_total_forex' id="final_total_forex"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div id="done_btn" class="hidden pull-right">
                        Done With Products list?
                        <button class="btn btn-primary" onclick="$('#summary').removeClass('hidden');$('#done_btn').hide();$('#product_id_div select').attr('disabled',true);$('#edit_btn').removeClass('hidden');">Yes</button>
                        <button class="btn btn-primary " onclick='$("#product_id").select2("open");'>No</button>
                      </div>
                      <button class="btn btn-primary pull-right hidden" id="edit_btn" onclick="$('#summary').addClass('hidden');$('#done_btn').show();$('#product_id_div select').attr('disabled',false);$('#edit_btn').addClass('hidden');">Edit Product List</button>
                    </div>
                    <!-- /.col -->
                  </div>
                  <br>
                  <!-- <hr> -->
                  <!-- /.row -->
                  <div class="row">
                    <!-- accepted payments column -->
                    <!-- /.col -->
                    <div class="col-md-12 col-xs-12">
                      <div class="form-horizontal">
                        
                          <?php if(!empty($quotation_details->terms_of_payments)): ?>
                          <div class="form-group">
                              <span class="col-md-3 col-xs-12">Terms Of Payments : </span>
                              <span  class="col-md-9 col-xs-12"><input type="" class="form-control" name="terms_of_payments" id="terms_of_payments" value="<?php echo $quotation_details->terms_of_payments; ?>"></span>
                            </div>
                          <?php endif; ?>
                            <?php if(!empty($quotation_details->training_venue)): ?>
                            <div class="form-group">
                            <span class="col-md-3 col-xs-12">Training Venue:</span>
                               <span  class="col-md-9 col-xs-12"><input type="" class="form-control" name="training_venue" id="training_venue" value="<?php echo $quotation_details->training_venue; ?>"></span>
                              </div>
                          <?php endif; ?>
                            <?php if(!empty($quotation_details->modification)): ?>
                            <div class="form-group">
                            <span class="col-md-3 col-xs-12">Modification:</span>
                               <span  class="col-md-9 col-xs-12"><input type="" class="form-control" name="modification" id="modification" value="<?php echo $quotation_details->modification; ?>"></span>
                              </div>
                          <?php endif; ?>
                            <?php if(!empty($quotation_details->cancellation)): ?>
                            <div class="form-group">
                            <span class="col-md-3 col-xs-12">Cancellation:</span>
                               <span  class="col-md-9 col-xs-12"><input type="" class="form-control" name="cancellation" id="cancellation" value="<?php echo $quotation_details->cancellation; ?>"></span>
                              </div>
                          <?php endif; ?>
                            <span class="col-md-12 col-mxs112"><textarea class="form-control" rows="1" name="quotation_footer_text" id="quotation_footer_text" ><?php echo $quotation_details->quotation_footer_text; ?></textarea></span>
                          
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <br>
                  <br><br>
                   <!-- /.row -->
                  <div class="row">
                    <!-- accepted payments column -->
                    <!-- /.col -->
                    <div class="col-md-3 col-xs-12">
                      <div class="table-responsive">
                              <legend></legend>
                              Customer Signature and Co Stamp<br>
                              Name: <br>
                              Date: <br>
                        </table>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- this row will not appear when printing -->
                  <div class="row no-print">
                    <div class="col-xs-12">
                      <button type="submit" class="btn btn-success pull-right" ><i class="fa fa-credit-card"></i> Submit
                      </button>
                    </div>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>
<script type="text/javascript" src="<?php echo JS_PATH ?>quotation.js"></script>
<script type="text/javascript">
$(function() {
  //=========================customer details ====================================================
  $("#customer_id").change(function(event) {
    customer_id=$("#customer_id option:selected").val();
    if(customer_id!=""){
      $.post('<?php echo base_url('common/Ajax/quotationlist_ajax/get_customer_details') ?>', {customer_id: customer_id}, function(data, textStatus, xhr) {
        var obj = $.parseJSON(data);
        $("#customer_address").html(obj.customer_address);
        $("#customer_phone").html(obj.customer_phone);
        $("#customer_email").html(obj.customer_email);
        if(obj.customer_currency!="SGD"){
          $("#total_curr").removeClass('hidden');
          $("#cust_curr").text(obj.customer_currency);
        }
        else{
          $("#total_curr").addClass('hidden');
        }
        $("#currency_amount").val(obj.currency_amount);
      });
      get_sub_total();
  }
  });
  //===============================================product row ===================================
  $("#product_id").change(function(event) {
    // $(".product_id_div").addClass('hidden');
    $("#done_btn").removeClass('hidden');
    
    product_id=$("#product_id option:selected").val();
    if(product_id!=""){
      // $("#product_id option:selected").remove();
      // $('#product_id option[value=""]').attr('selected','');
      $.post('<?php echo base_url('common/Ajax/quotationlist_ajax/get_product_row') ?>', {  billing_id: product_id}, function(data, textStatus, xhr) {
        var rowCount = $('#product_table tbody tr').length;
        $("#product_table tbody").append("<tr id='"+product_id+"'><td class='sno'>"+(rowCount+1)+"</td>"+data+"</tr>");
        $("#product_id option:selected").remove();
        $("#quantity_"+product_id).focus();
        get_amount(product_id);
      });
    }
  });
});
// =================================== delete row ==============================================
function delete_row(data) {
  remove_product_id=$(data).parents("tr").attr("id");
  $(data).parents("tr").remove();
  $.post('<?php echo base_url('common/Ajax/quotationlist_ajax/get_product_option') ?>', {  billing_id: remove_product_id}, function(data, textStatus, xhr) {
    $("#product_id").append(data);
    get_sub_total();
  });
}
</script>