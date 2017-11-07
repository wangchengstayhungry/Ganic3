<?php
		defined('BASEPATH') OR exit('No direct script access allowed');

		class Stock extends MY_Controller {

			public function __construct()
		    {
		        parent::__construct();
		        $this->load->model('stock/stock_model','stock');
		    }	
			
		    public function opening_balance()
	 		{
	 			is_logged_in('admin');
	 			has_permission();
	 			$this->body_vars['product_options']=$this->custom->createDropdownSelect("billing_master",array('billing_id','stock_code','billing_description'),"Product",array(" : "," "),array('billing_type' => 'product'));
				$this->body_vars['save_url']=base_url('stock/create_stocktable');
	 			$this->body_file="stock/opening_balance.php";

	 		}	

	 		public function stock_openlist()
			{
				is_logged_in('admin');
				has_permission();
			}

			public function stock_manage($mode,$row_id="") {
				is_logged_in('admin');
				has_permission();
							
				/*==========================================*/
				if($row_id!=""):
				$this->body_vars['open_stock_edit_data']=$open_stock_edit_data=$this->custom->getSingleRow('open_stock_table',array("open_stock_id"=>$row_id));
				if($open_stock_edit_data):
					
					// $this->body_vars['customer_options']=$this->custom->createDropdownSelect("customer_master",array('customer_id','customer_name','customer_code'),"Customer",array('(',')'),array(),array($open_edit_data->customer_id));

					if($mode=="edit"):
						$stock = $this->stock->get_product_details(array('billing_id' => $open_stock_edit_data->open_billing_id));
						$data['stock_code'] = $stock->stock_code;
						$data['stock_description'] = $stock->billing_description;
						$data['uom'] = $stock->billing_uom;
						$data['quantity'] = $open_stock_edit_data->open_stock_quantity;
						$data['open_stock_id'] = $open_stock_edit_data->open_stock_id;
						$this->body_vars['cust_data'] = $data;
						$this->body_vars['save_url']=base_url('stock/create_stocktable/edit');
						$this->body_file="stock/open_stock_edit.php";
					endif;
					if($mode=="view"):
						$result= $this->invoice->get_customer_details(array('customer_id'=>$invoice_edit_data->customer_id));
						$data['customer_address']=$result->customer_bldg_number.' , <br>'.$result->customer_street_name.' , <br>'.$result->customer_postal_code;
						$data['customer_phone']=$result->customer_phone;
						$data['customer_email']=$result->customer_email;
						$currency_data=$this->custom->getSingleRow("currency_master",array('currency_id'=>$result->currency_id));
						$data['customer_currency']=$currency_data->currency_name;
						$data['currency_amount']=$currency_data->currency_rate;
						$this->body_vars['cust_data']=$data;
						$this->body_vars['mode']="view";
						$this->body_file="invoice/invoice_view.php";
					endif;
					/*==========================================*/
				else:
					redirect('invoice/invoicelist/pending','refresh');
				endif;
				endif;
			}

	 		public function create_stocktable($action="new")
	 		{

	 			is_logged_in('admin');
				has_permission(); 
				$post=$this->input->post();
				
				$open_data = $post;
				if (isset($post)) {

					if($action=="new"){
						$insert_data = array();
						if (isset($insert_data)) {
							unset($insert_data);
						}
						$count = count($post['data']['product_id']);
						foreach ($post['data']['product_id'] as $product_id){
						   $insert_data['open_billing_id'][] = $product_id;
						}
						foreach ($post['data']['quantity'] as $quantity) {
							$insert_data['open_stock_quantity'][] = $quantity;
						}
						
						for ($i=0; $i < $count ; $i++) { 
							$data['open_billing_id'] = $insert_data['open_billing_id'][$i];
							$data['open_stock_quantity'] = $insert_data['open_stock_quantity'][$i];
							
							$open_id[]=$this->custom->insertRow("open_stock_table",$data);
						}
					}

					if($action=="edit"){
						
						$where=array('open_stock_id' => $open_data['data']['open_stock_id'][0]);

						$data['open_stock_quantity'] = $open_data['data']['quantity'][0];
						
						unset($open_data['open_stock_id']);

						$this->db->trans_start();
						$res[]=$this->custom->updateRow("open_stock_table",$data,$where);
						
						if ($this->db->trans_status() === FALSE || in_array("error", $res))
						{
							set_flash_message("message","danger","Something Went Wrong");	
						    $this->db->trans_rollback();
						}
						else
						{
							set_flash_message("message","success","Stock Updated Successfully");
						    $this->db->trans_commit();
						}
					}
					redirect('stock/stock_openlist/confirm');
				}
	 		}
		}

?>