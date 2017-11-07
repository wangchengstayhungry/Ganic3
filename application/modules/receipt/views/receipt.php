<section class="content-header">
  <?php 
    $list = array('active'=>'Receipt');
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
          <h3 class="box-title">Receipt</h3>
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
                <section class="receipt">
                  <!-- info row -->
                  <div class="row receipt-info">
                    <div class="col-sm-4 receipt-col">
                      <b>To,</b>
                      <address>
                        <select name="customer_id" id="customer_id" title="Select Customer" class="form-control select2" required="">
                          <?php echo $customer_options; ?>
                        </select><br>
                         <span id="customer_bldg_street"></span><br>
                         <span id="customer_cntry_post"></span><br>
                      </address>
                    </div>
                    <div class="col-sm-4 receipt-col"></div>
                    <!-- /.col -->
                    <div class="col-sm-4 receipt-col">
                      <b>Date:</b> <?php echo date('d-m-Y'); ?><br>
                      <br>
                      <b>Receipt : <?php echo $receipt_details->receipt_text_prefix.'.'.$total_receipt; ?></b><br>
                      <input type='hidden' name='receipt_ref_no' id="receipt_ref_no" value="<?php echo $receipt_details->receipt_text_prefix.'.'.$total_receipt; ?>">
                      
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <br>
                  <hr>
                  <div class="row">
                    <div class="col-xs-12 col-md-4 product_id_div">
                      <select name="invoice_reference_id[]" id="invoice_reference_id" title="Select Invoice reference" class="form-control select2" multiple="multiple">
                          <?php echo $invoice_reference; ?>
                        </select>
                    </div>
                  </div>
                  <br>
                  <br>
                  <br>
                  <!-- <legend></legend> -->
                  <!-- Table row -->
                  
                  
                  <div class="row">
                    <div class="col-xs-6 table-responsive">
                      <table class="table table-striped hidden" id="inv_table">
                        <thead>
                          <tr>
                            <th>Invoice Number</th>
                            <th>Amount ( <span id="currency2"></span> ) </th>
                          </tr>
                        </thead>

                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  
                  
                  <div class="row col-md-12" align="left">
                    <div class="col-md-12">
                      <!--<p class="display-none receipt_body">Received with thanks the sum of <span id="currency">...</span><span id="amountinwords">...</span> being payment for: <span id="invoice_reference"></span></p>-->
                        <!--<p class="display-none receipt_body">Received with thanks the sum of <span id="currency">...</span><span id="inv_amount">...</span> being payment for: <span id="invoice_reference"></span></p>                      -->
                        <p class="display-none receipt_body">Received with thanks the sum of <span id="currency">...</span><span id="inv_amount">...</span> being payment for above invoices.</span></p>                      

                    </div>
                    <br>
                    <div  class="col-md-12">
                        <p> 
                        <span class="col-md-6">Bank: <input type="text" name="bank"></span> <span class="col-md-6">Cheque: <input type="text" name="cheque"></span> 
                        </p>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="col-md-12">
                        <p>
                        <span class="col-md-6">OTHER REFERENCE IF ANY: </span> <span class="col-md-6"> <input type="text" name="other_reference" class="m-l-55"> </span>
                        </p>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <!-- <hr> -->
                  
                  <br>
                  <input type="hidden" name="currency" id="rec_currency">
                  <input type="hidden" name="amount" id="rec_amount">
                  <input type="hidden" name="invoice" id="rec_invoice">
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
<!-- <script type="text/javascript" src="<?php echo JS_PATH ?>receipt.js"></script> -->
<script type="text/javascript">

$(document).ready(function(){
        // alert(document.URL);
      history.pushState(null, null, document.URL);
      window.addEventListener('popstate', function () {
          $.confirm({
                title:"<i class='fa fa-info'></i> Exit Confirmation",
                text: "Are You Sure Exit ?",
                confirm: function(button) {
                  
                    window.history.go(-1);
                },
                cancel: function(button) {
                    history.pushState(null, null, document.URL);
                }
            });
        
    });
});

$(function() {
  //=========================customer details ====================================================
  $("#customer_id").change(function(event) {
    customer_id=$("#customer_id option:selected").val();
    if(customer_id!=""){
      $.post('<?php echo base_url('common/Ajax/receiptlist_ajax/get_customer_details') ?>', {customer_id: customer_id}, function(data, textStatus, xhr) {
        var obj = $.parseJSON(data);
        console.log(obj);
        $("#customer_bldg_street").html(obj.customer_bldg_street);
        $("#customer_cntry_post").html(obj.customer_cntry_post);
        $("#customer_cntry_post").html(obj.customer_cntry_post);
        $("#currency").html(obj.customer_currency);
        $("#currency2").html(obj.customer_currency);
        $("#rec_currency").val(obj.customer_currency);

        $( "#invoice_reference_id" ).html( obj.invoice_reference );
        // $("#customer_email").html(obj.customer_email);
        

      });
      // get_sub_total();
  }
  });
    //===============================================invoice reference ===================================
  $("#invoice_reference_id").change(function(event) {
      var invoice_id = [];

      $.each($("#invoice_reference_id option:selected"), function(){            
          invoice_id.push($(this).val());
      });
      
      if(invoice_id!=""){
          $("#inv_table tbody").empty();
          $count = 0;
          
          $.each($("#invoice_reference_id option:selected"), function(){            
          $.post('<?php echo base_url('common/Ajax/receiptlist_ajax/get_receipt_data') ?>', {  invoice_id: invoice_id}, function(data, textStatus, xhr) {
            obj = $.parseJSON(data);
            // console.log(typeof obj.invoic_name);
            // console.log(obj);
            
            $("#inv_table").removeClass('hidden');
            $("#inv_table tbody").append('<tr> <td>'+obj.invoic_name[$count]+'</td> <td>'+obj.invoice_amt[$count]+'</td></tr>');
            $count = $count + 1;
            // $("#invoice_reference").html(obj.invoic_name.join(", "));
            //$("#amountinwords").html(' '+obj.total_in_words);
            $("#inv_amount").html(' '+obj.total);
            $("#rec_amount").val(obj.total);

            $("#rec_invoice").val(obj.invoic_name);
            $('.receipt_body').show();
          });
          });
      }
      
      else
      {
            $("#inv_table tbody").empty();
            $("#inv_table").addClass('hidden');
            $('.receipt_body').hide();
      }
  
  });
});

</script>