<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Quotationlist_ajax extends CI_Controller {

		public $view_path;
		public $data;
		public $table;
		public $logged_id;
		public function __construct()
		{
			parent::__construct();
			
			$this->table="quotation_master";
			$this->logged_id = $this->session->user_id;
			$this->load->model('quotation/quotation_model','quotation');
		} 
		public function get_customer_details()
		{
			is_ajax();
			$this->body_file="common/blank.php";
			$this->header_file="common/blank.php";
			$this->footer_file="common/blank.php";
			$post=$this->input->post();
			$result= $this->quotation->get_customer_details($post);
			$data['customer_address']=$result->customer_bldg_number.' , <br>'.$result->customer_street_name.' , <br>'.$result->customer_postal_code;
			$data['customer_phone']=$result->customer_phone;
			$data['customer_email']=$result->customer_email;
			$currency_data=$this->custom->getSingleRow("currency_master",array('currency_id'=>$result->currency_id));
			$data['customer_currency']=$currency_data->currency_name;
			$data['currency_amount']=$currency_data->currency_rate;

			///////////////
			//opening balance
			$data['customer_name'] = $result->customer_name;
			$data['customer_code'] = $result->customer_code;
			//////////////
			echo json_encode($data);
		}

	public function get_product_row()
		{
			is_ajax();
			$this->body_file="common/blank.php";
			$this->header_file="common/blank.php";
			$this->footer_file="common/blank.php";
			$post=$this->input->post();
			$quotation_id=null;
			if (isset($post['quotation_id'])) {
				$quotation_id=$post['quotation_id'];
				unset($post['quotation_id']);
			}
			$product_details=$this->quotation->get_product_details_row($post["billing_id"]);
			$old_quotation_product_details=$this->custom->getSingleRow('quotation_product_master',array("quotation_id"=>$quotation_id,'product_id'=>$product_details->billing_id));
			$quantity=1;
			$discount=0;
			if(!is_null($old_quotation_product_details)){
				$quantity=$old_quotation_product_details->quantity;
				$discount=$old_quotation_product_details->discount;
			}
			$gst=$this->custom->getSingleRow('gst_master',array('gst_id'=>$product_details->gst_id));
			$html="";
			$html.="<td>".$product_details->billing_description."</td>";
	
			if($product_details->billing_type=="Product")
			{
    			$html.="<td><input type='number' min='1' class='form-control' value='$quantity' name='quantity[$product_details->billing_id]' id='quantity_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'></td>";
			}
			else
			{
		   		$html.="<td><input type='hidden' disabled min='1' class='form-control' value='1' name='quantity[$product_details->billing_id]' id='quantity_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")' value='1'></td>";
			}
			
			$html.="<td>".$product_details->billing_uom."</td>";

            $showCurrency=0;
            $currencyFinal=0;
            
	        if (isset($post['currencyRate']) && $post['currencyRate']!='0') 
            {
                $currencyRate=$post['currencyRate'];
                $currencyFinal=$currencyRate*$product_details->billing_price_per_uom;
                $showCurrency=$currencyRate*$product_details->billing_price_per_uom;
    
                if($product_details->billing_type=="Product")
                {
                    $html.="<td id='unit_price_".$product_details->billing_id."'>".$currencyFinal."</td>";
                }
    
                else
                {
                    $html.="<td id='unit_price_".$product_details->billing_id."'></td>";
                }
            }
	
            else////////////////////????????????????????????????????????????
            {   
                $showCurrency=$product_details->billing_price_per_uom;
                if($product_details->billing_type=="Product")
                {
            	    $html.="<td id='unit_price_".$product_details->billing_id."'>".$product_details->billing_price_per_uom."</td>";
                }
                
                else
                {
                    $html.="<td id='unit_price_".$product_details->billing_id."'></td>";
                }
            }

            if($product_details->billing_type=="Service")
            {
	            $html.="<td><input type='hidden' min='0' max='100' class='form-control' value='$discount' name='discount[$product_details->billing_id]' id='discount_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'></td>";
            }
            
            else
            {
                $html.="<td><input type='number' min='0' max='100' class='form-control' value='$discount' name='discount[$product_details->billing_id]' id='discount_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'></td>";
            }


// 			$html.="<td class='total' id='total_".$product_details->billing_id."'>".$product_details->billing_price_per_uom."</td>";

			if($product_details->billing_type=="Product")
			{
				if (isset($post['currencyRate']) && $post['currencyRate']!='0') 
				{
					$currencyRate=$post['currencyRate'];
					$currencyFinal=$currencyRate*$product_details->billing_price_per_uom*$quantity;
					$html.="<td class='total' data-show='".$currencyFinal."' data-calculate='".$product_details->billing_price_per_uom."' id='total_".$product_details->billing_id."'>".$currencyFinal."</td>";
				}
				else
				{
					$currencyRate=1;
					$currencyFinal=$currencyRate*$product_details->billing_price_per_uom*$quantity;
					$html.="<td class='total'   data-show='".$product_details->billing_price_per_uom."' data-calculate='".$product_details->billing_price_per_uom."' id='total_".$product_details->billing_id."'>".$product_details->billing_price_per_uom."</td>";
				}
			}
			
			else
			{
				if($currencyFinal!=0)
					$html.="<td class='total' data-show='0' data-calculate='0' id='total_".$product_details->billing_id."'><input class='form-control' type='number' id='service_total_".$product_details->billing_id."' onblur='get_amount(".$product_details->billing_id.")' value='".$currencyFinal."'/> </td>";
				else
					$html.="<td class='total' data-show='0' data-calculate='0' id='total_".$product_details->billing_id."'><input class='form-control' type='number' id='service_total_".$product_details->billing_id."' onblur='get_amount(".$product_details->billing_id.")' /> </td>";
			}
	          
	          
	           // $html.="<td class='initialtotal' id='initialtotal_".$product_details->billing_id."'>".$product_details->billing_price_per_uom."</td>";
	            
			$html.="<td>".$gst->gst_code."</td>";
			
			$html.="<td><input size='10' readonly id='gst_amt_".$product_details->billing_id."' style='border: none; border-color: transparent; background: transparent;' tabIndex='-1' /></td>";

			/* ===============all hidden field to submit the form ====================== */
						$html.="<td class='hidden'>".
				"<input type='hidden' name='product_id[]' value='".$product_details->billing_id."'>".
				"<input type='hidden' name='gst_id[$product_details->billing_id]' value='".$product_details->gst_id."'>".
				"<input type='hidden' name='price[$product_details->billing_id]' value='".$product_details->billing_price_per_uom."' id='price_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'>".
				"<input type='hidden' name='product_total[$product_details->billing_id]' value='".$product_details->billing_price_per_uom."'  id='product_total_".$product_details->billing_id."' data-show='".$showCurrency."'  onchange='get_amount(".$product_details->billing_id.")'>".
				"<input type='hidden' name=''  value='".$gst->gst_rate."' class='gst_percentages' id='".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'>"
				."</td>";

			$html.="<td><a class='btn btn-xs btn-danger delete-row' onclick='delete_row(this)'>Remove</a></td>";
			echo $html;
		}

		public function get_product_row_edit()
		{
			is_ajax();
			$this->body_file="common/blank.php";
			$this->header_file="common/blank.php";
			$this->footer_file="common/blank.php";
			$post=$this->input->post();
			$quotation_id=null;
			if (isset($post['quotation_id'])) {
				$quotation_id=$post['quotation_id'];
				unset($post['quotation_id']);
			}
			$product_details=$this->quotation->get_product_details_row($post["billing_id"]);
			$old_quotation_product_details=$this->custom->getSingleRow('quotation_product_master',array("quotation_id"=>$quotation_id,'product_id'=>$product_details->billing_id));
			$quantity=1;
			$discount=0;
			if(!is_null($old_quotation_product_details)){
				$quantity=$old_quotation_product_details->quantity;
				$discount=$old_quotation_product_details->discount;
			}
			$gst=$this->custom->getSingleRow('gst_master',array('gst_id'=>$product_details->gst_id));
			$html="";
			$html.="<td>".$product_details->billing_description."</td>";
	
			if($product_details->billing_type=="Product")
			{
    			$html.="<td><input type='number' min='1' class='form-control' value='$quantity' name='quantity[$product_details->billing_id]' id='quantity_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'></td>";
			}
			else
			{
		   		$html.="<td><input type='hidden' disabled min='1' class='form-control' value='1' name='quantity[$product_details->billing_id]' id='quantity_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")' value='1'></td>";
			}
			
			$html.="<td>".$product_details->billing_uom."</td>";

            $showCurrency=0;
            $currencyFinal=0;
            
	        if (isset($post['currencyRate']) && $post['currencyRate']!='0') 
            {
                $currencyRate=$post['currencyRate'];
                $currencyFinal=$currencyRate*$product_details->billing_price_per_uom;
                $showCurrency=$currencyRate*$product_details->billing_price_per_uom;
    
                if($product_details->billing_type=="Product")
                {
                    $html.="<td id='unit_price_".$product_details->billing_id."'>".$currencyFinal."</td>";
                }
    
                else
                {
                    $html.="<td id='unit_price_".$product_details->billing_id."'></td>";
                }
            }
	
            else
            {   
                $showCurrency=$product_details->billing_price_per_uom;
                if($product_details->billing_type=="Product")
                {
            	    $html.="<td id='unit_price_".$product_details->billing_id."'>".$product_details->billing_price_per_uom."</td>";
                }
                
                else
                {
                    $html.="<td id='unit_price_".$product_details->billing_id."'></td>";
                }
            }

            if($product_details->billing_type=="Service")
            {
	            $html.="<td><input type='hidden' min='0' max='100' class='form-control' value='$discount' name='discount[$product_details->billing_id]' id='discount_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'></td>";
            }
            
            else
            {
                $html.="<td><input type='number' min='0' max='100' class='form-control' value='$discount' name='discount[$product_details->billing_id]' id='discount_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'></td>";
            }


// 			$html.="<td class='total' id='total_".$product_details->billing_id."'>".$product_details->billing_price_per_uom."</td>";

    if($product_details->billing_type=="Product")
    {
        if (isset($post['currencyRate']) && $post['currencyRate']!='0') 
	    {
	        $currencyRate=$post['currencyRate'];
	        $currencyFinal=$currencyRate*$product_details->billing_price_per_uom*$quantity;
	        $html.="<td class='total' data-show='".$currencyFinal."' data-calculate='".$product_details->billing_price_per_uom."' id='total_".$product_details->billing_id."'>".$currencyFinal."</td>";
        }
        else
	    {
	        $currencyRate=1;
            $currencyFinal=$currencyRate*$product_details->billing_price_per_uom*$quantity;
            $html.="<td class='total'   data-show='".$product_details->billing_price_per_uom."' data-calculate='".$product_details->billing_price_per_uom."' id='total_".$product_details->billing_id."'>".$product_details->billing_price_per_uom."</td>";
        }
    }
    
    else
    {
        if (isset($post['currencyRate']) && $post['currencyRate']!='0') 
	    {
	        $currencyRate=$post['currencyRate'];
            $p_total = $this->custom->getSingleValue('quotation_product_master','product_total', array("quotation_id"=>$quotation_id,'product_id'=>$product_details->billing_id));
	        $currencyFinal=$currencyRate*$p_total*1;//qty = 1
    	    if($currencyFinal!=0)
                $html.="<td class='total' data-show='0' data-calculate='0' id='total_".$product_details->billing_id."'><input class='form-control' type='number' id='service_total_".$product_details->billing_id."' onblur='get_amount(".$product_details->billing_id.")' value='".$currencyFinal."'/> </td>";
            else
                $html.="<td class='total' data-show='0' data-calculate='0' id='total_".$product_details->billing_id."'><input class='form-control' type='number' id='service_total_".$product_details->billing_id."' onblur='get_amount(".$product_details->billing_id.")' /> </td>";
        }
        else
	    {
	        $currencyRate=1;
	        
            $p_total = $this->custom->getSingleValue('quotation_product_master','product_total', array("quotation_id"=>$quotation_id,'product_id'=>$product_details->billing_id));
            $currencyFinal=$currencyRate*$p_total*1; // qty = 1
            
            if($currencyFinal!=0)
                $html.="<td class='total' data-show='0' data-calculate='0' id='total_".$product_details->billing_id."'><input class='form-control' type='number' id='service_total_".$product_details->billing_id."' onblur='get_amount(".$product_details->billing_id.")' value='".$currencyFinal."'/> </td>";
            else
                $html.="<td class='total' data-show='0' data-calculate='0' id='total_".$product_details->billing_id."'><input class='form-control' type='number' id='service_total_".$product_details->billing_id."' onblur='get_amount(".$product_details->billing_id.")' /> </td>";
        }
    }
	           // $html.="<td class='initialtotal' id='initialtotal_".$product_details->billing_id."'>".$product_details->billing_price_per_uom."</td>";
	            
			$html.="<td>".$gst->gst_code."</td>";
			
			$html.="<td><input size='10' readonly id='gst_amt_".$product_details->billing_id."' style='border: none; border-color: transparent; background: transparent;' tabIndex='-1' /></td>";

			/* ===============all hidden field to submit the form ====================== */
						$html.="<td class='hidden'>".
				"<input type='hidden' name='product_id[]' value='".$product_details->billing_id."'>".
				"<input type='hidden' name='gst_id[$product_details->billing_id]' value='".$product_details->gst_id."'>".
				"<input type='hidden' name='price[$product_details->billing_id]' value='".$product_details->billing_price_per_uom."' id='price_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'>".
				"<input type='hidden' name='product_total[$product_details->billing_id]' value='".$product_details->billing_price_per_uom."'  id='product_total_".$product_details->billing_id."' data-show='".$showCurrency."'  onchange='get_amount(".$product_details->billing_id.")'>".
				"<input type='hidden' name=''  value='".$gst->gst_rate."' class='gst_percentages' id='".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'>"
				."</td>";

			$html.="<td><a class='btn btn-xs btn-danger delete-row' onclick='delete_row(this)'>Remove</a></td>";
			echo $html;
		}
		
		public function get_product_row_invoice()
		{
			is_ajax();
			$this->body_file="common/blank.php";
			$this->header_file="common/blank.php";
			$this->footer_file="common/blank.php";
			$post=$this->input->post();
			$quotation_id=null;
			if (isset($post['quotation_id'])) {
				$quotation_id=$post['quotation_id'];
				unset($post['quotation_id']);
			}
			$product_details=$this->quotation->get_product_details_row($post["billing_id"]);
			$old_quotation_product_details=$this->custom->getSingleRow('quotation_product_master',array("quotation_id"=>$quotation_id,'product_id'=>$product_details->billing_id));
			$quantity=1;
			$discount=0;
			if(!is_null($old_quotation_product_details)){
				$quantity=$old_quotation_product_details->quantity;
				$discount=$old_quotation_product_details->discount;
			}
			$gst=$this->custom->getSingleRow('gst_master',array('gst_id'=>$product_details->gst_id));
			$html="";
			$html.="<td>".$product_details->billing_description."</td>";
	
			if($product_details->billing_type=="Product")
			{
    			$html.="<td><input type='number' readonly min='1' class='form-control' value='$quantity' name='quantity[$product_details->billing_id]' id='quantity_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'></td>";
			}
			else
			{
		   		$html.="<td><input type='hidden' readonly disabled min='1' class='form-control' value='1' name='quantity[$product_details->billing_id]' id='quantity_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")' value='1'></td>";
			}
			
			$html.="<td>".$product_details->billing_uom."</td>";

            $showCurrency=0;
            $currencyFinal=0;
            
	        if (isset($post['currencyRate']) && $post['currencyRate']!='0') 
            {
                $currencyRate=$post['currencyRate'];
                $currencyFinal=$currencyRate*$product_details->billing_price_per_uom;
                $showCurrency=$currencyRate*$product_details->billing_price_per_uom;
    
                if($product_details->billing_type=="Product")
                {
                    $html.="<td id='unit_price_".$product_details->billing_id."'>".$currencyFinal."</td>";
                }
    
                else
                {
                    $html.="<td id='unit_price_".$product_details->billing_id."'></td>";
                }
            }
	
            else
            {   
                $showCurrency=$product_details->billing_price_per_uom;
                if($product_details->billing_type=="Product")
                {
            	    $html.="<td id='unit_price_".$product_details->billing_id."'>".$product_details->billing_price_per_uom."</td>";
                }
                
                else
                {
                    $html.="<td id='unit_price_".$product_details->billing_id."'></td>";
                }
            }

            if($product_details->billing_type=="Service")
            {
	            $html.="<td><input type='hidden' min='0' max='100' class='form-control' value='$discount' name='discount[$product_details->billing_id]' id='discount_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'></td>";
            }
            
            else
            {
                $html.="<td><input type='number' readonly min='0' max='100' class='form-control' value='$discount' name='discount[$product_details->billing_id]' id='discount_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'></td>";
            }


// 			$html.="<td class='total' id='total_".$product_details->billing_id."'>".$product_details->billing_price_per_uom."</td>";

    if($product_details->billing_type=="Product")
    {
        if (isset($post['currencyRate']) && $post['currencyRate']!='0') 
	    {
	        $currencyRate=$post['currencyRate'];
	        $currencyFinal=$currencyRate*$product_details->billing_price_per_uom*$quantity;
	        $html.="<td class='total' data-show='".$currencyFinal."' data-calculate='".$product_details->billing_price_per_uom."' id='total_".$product_details->billing_id."'>".$currencyFinal."</td>";
        }
        else
	    {
	        $currencyRate=1;
            $currencyFinal=$currencyRate*$product_details->billing_price_per_uom*$quantity;
            $html.="<td class='total'   data-show='".$product_details->billing_price_per_uom."' data-calculate='".$product_details->billing_price_per_uom."' id='total_".$product_details->billing_id."'>".$product_details->billing_price_per_uom."</td>";
        }
    }
    
    else
    {
        if (isset($post['currencyRate']) && $post['currencyRate']!='0') 
	    {
	        $currencyRate=$post['currencyRate'];
            $p_total = $this->custom->getSingleValue('quotation_product_master','product_total', array("quotation_id"=>$quotation_id,'product_id'=>$product_details->billing_id));
	        $currencyFinal=$currencyRate*$p_total*1;//qty = 1
    	    if($currencyFinal!=0)
                $html.="<td class='total' data-show='0' data-calculate='0' id='total_".$product_details->billing_id."'><input class='form-control' readonly type='number' id='service_total_".$product_details->billing_id."' onblur='get_amount(".$product_details->billing_id.")' value='".$currencyFinal."'/> </td>";
            else
                $html.="<td class='total' data-show='0' data-calculate='0' id='total_".$product_details->billing_id."'><input class='form-control' readonly type='number' id='service_total_".$product_details->billing_id."' onblur='get_amount(".$product_details->billing_id.")' /> </td>";
        }
        else
	    {
	        $currencyRate=1;
	        
            $p_total = $this->custom->getSingleValue('quotation_product_master','product_total', array("quotation_id"=>$quotation_id,'product_id'=>$product_details->billing_id));
            $currencyFinal=$currencyRate*$p_total*1; // qty = 1
            
            if($currencyFinal!=0)
                $html.="<td class='total' data-show='0' data-calculate='0' id='total_".$product_details->billing_id."'><input class='form-control' readonly type='number' id='service_total_".$product_details->billing_id."' onblur='get_amount(".$product_details->billing_id.")' value='".$currencyFinal."'/> </td>";
            else
                $html.="<td class='total' data-show='0' data-calculate='0' id='total_".$product_details->billing_id."'><input class='form-control' readonly type='number' id='service_total_".$product_details->billing_id."' onblur='get_amount(".$product_details->billing_id.")' /> </td>";
        }
    }
	           // $html.="<td class='initialtotal' id='initialtotal_".$product_details->billing_id."'>".$product_details->billing_price_per_uom."</td>";
	            
			$html.="<td>".$gst->gst_code."</td>";
			
			$html.="<td><input size='10' readonly id='gst_amt_".$product_details->billing_id."' style='border: none; border-color: transparent; background: transparent;' tabIndex='-1' /></td>";

			/* ===============all hidden field to submit the form ====================== */
						$html.="<td class='hidden'>".
				"<input type='hidden' name='product_id[]' value='".$product_details->billing_id."'>".
				"<input type='hidden' name='gst_id[$product_details->billing_id]' value='".$product_details->gst_id."'>".
				"<input type='hidden' name='price[$product_details->billing_id]' value='".$product_details->billing_price_per_uom."' id='price_".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'>".
				"<input type='hidden' name='product_total[$product_details->billing_id]' value='".$product_details->billing_price_per_uom."'  id='product_total_".$product_details->billing_id."' data-show='".$showCurrency."'  onchange='get_amount(".$product_details->billing_id.")'>".
				"<input type='hidden' name=''  value='".$gst->gst_rate."' class='gst_percentages' id='".$product_details->billing_id."' onchange='get_amount(".$product_details->billing_id.")'>"
				."</td>";

			$html.="<td><a class='btn btn-xs btn-danger delete-row' onclick='delete_row(this)'>Remove</a></td>";
			echo $html;
		}

		public function get_product_option()
		{
			is_ajax();
			$this->body_file="common/blank.php";
			$this->header_file="common/blank.php";
			$this->footer_file="common/blank.php";
			$post=$this->input->post();
			$product_details=$this->quotation->get_product_details($post);
			echo "<option value=".$product_details->billing_id.">".$product_details->stock_code." : ".$product_details->billing_description."</option>";	
		}

		public function get_product_stock_info() 
		{
			is_ajax();
			$this->body_file="common/blank.php";
			$this->header_file="common/blank.php";
			$this->footer_file="common/blank.php";
			$post=$this->input->post();
			$product_details=$this->quotation->get_product_details_row($post["billing_id"]);
			
			echo json_encode($product_details);
			// echo "<option value=".$product_details->billing_id.">".$product_details->stock_code." : ".$product_details->billing_description."</option>";
		}
		public function get_quotation_details()
		{
			is_ajax();
			$post=$this->input->post();
			$quotation['quotation_details']=$this->custom->getSingleRow('quotation_master',array("quotation_id"=>$post['quotation_id']));
			$quotation['quotation_product_edit_data']=$quotation_product_edit_data=$this->custom->getRows('quotation_product_master',array("quotation_id"=>$post['quotation_id']));
			foreach ($quotation_product_edit_data as $value) {
					$product_array[]=$value->product_id;
				}
			$quotation['product_array']=$product_array;	
			$quotation['total_quotation']=$this->custom->getTotalCount("quotation_master");
			echo json_encode($quotation);
		}
		public function delete()
		{
// 			is_ajax();
// 			$id=$this->input->post('rowID');
// 			$where = array('quotation_id' => $id);
// 			// $result="hi";
// 			$result = $this->custom->deleteRow($this->table,$where);
// 			echo $result;
            is_ajax();
			$id=$this->input->post('rowID');
			$where = array('quotation_id' => $id);
			$result = $this->custom->updateRow($this->table,array('quotation_status'=>"DELETED"),$where);
			echo $result;
		}

		public function success()
		{
			is_ajax();
			$id=$this->input->post('rowID');
			$where = array('quotation_id' => $id);
			$result = $this->custom->updateRow($this->table,array('quotation_status'=>"SUCCESSFUL"),$where);
			echo $result;
		}

		public function reject()
		{
			is_ajax();
			$id=$this->input->post('rowID');
			$where = array('quotation_id' => $id);
			$result = $this->custom->updateRow($this->table,array('quotation_status'=>"REJECTED"),$where);
			echo $result;
		}

		public function print_quotation($mode="print")
		{
			$row_id=$this->input->post('rowID');
			$this->data['quotation_edit_data']=$quotation_edit_data=$this->custom->getSingleRow('quotation_master',array("quotation_id"=>$row_id));
			if($quotation_edit_data):
				$this->data['quotation_product_edit_data']=$quotation_product_edit_data=$this->custom->getRows('quotation_product_master',array("quotation_id"=>$row_id));
				foreach ($quotation_product_edit_data as $value) {
					$product_array[]=$value->product_id;
				}
				$this->data['product_array']=$product_array;
				/*==========================================*/
				$company_where=array('profile_id'=>1);
				$this->data['company_details']=$company_details=$this->custom->getSingleRow('company_profile',$company_where);
				/*==========================================*/
				$this->data['customer_options']=$this->custom->createDropdownSelect("customer_master",array('customer_id','customer_name','customer_code'),"Customer",array('(',')'),array(),array($quotation_edit_data->customer_id));
				/*==========================================*/
				$this->data['salesman_options']=$this->custom->createDropdownSelect("salesman_master",array('s_id','s_name'),"Sales Person",array(' '),array(),array($quotation_edit_data->salesman_id));
				/*==========================================*/
				$this->data['product_options']=$this->custom->createDropdownSelect("billing_master",array('billing_id','stock_code','billing_description'),"Product",array(" : "," "));
				/*==========================================*/
				$this->data['total_quotation']=$this->custom->getTotalCount("quotation_master");
				/*==========================================*/
				$result= $this->quotation->get_customer_details(array('customer_id'=>$quotation_edit_data->customer_id));
				$data['customer_address']=$result->customer_bldg_number.' , <br>'.$result->customer_street_name.' , <br>'.$result->customer_postal_code;
				$data['customer_phone']=$result->customer_phone;
				$data['customer_email']=$result->customer_email;
				$currency_data=$this->custom->getSingleRow("currency_master",array('currency_id'=>$result->currency_id));
				$data['customer_currency']=$currency_data->currency_name;
				$data['currency_amount']=$currency_data->currency_rate;
				$this->data['cust_data']=$data;
				/*==========================================*/

					$this->data['save_url']=base_url('quotation/create_new_quotation/edit');
					if($mode=="print"):
						$this->data['mode']="print";
						$this->load->view('quotation/quotation_view.php', $this->data, FALSE);
					endif;
					if($mode=="email"):
						$this->data['mode']="email";
						$html=$this->load->view('quotation/quotation_view.php', $this->data, TRUE);	
						$this->load->helper('email');
						// send_email("parthganatra17@gmail.com","trueline.chirag@gmail.com","Test",$html);
						send_email("mohit.ch@ibrinfotech.com","mohit.ch@ibrinfotech.com","Test",$html);
					endif;
					$message='<div class="alert alert-success fade in"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>'.$mode.' Task Complete!</div>';

				/*==========================================*/
				?>
				<script>
				message='<?php echo $message; ?>';
				$("#form_data").html(""); // remove content of form.
                $("#refresh").click();//refresh  the datatable.
                $("#list_table").show(); // show data table
                $("#message_area").html(message);
                </script><?php
			else:
				redirect('quotation/quotationlist/pending','refresh');
			endif;
		}

		public function email()
		{
			echo '<script> $("#refresh").click(); </script>';
			echo '<script> $("#list_table").show();</script>';
		}

	}

?>