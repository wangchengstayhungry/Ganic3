<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable extends CI_Controller {

	public $logged_id;
	public function __construct()
	{
		parent::__construct();
		is_ajax();
		$this->logged_id = $this->session->user_id;
		$this->load->model('datatable_model','DT_model');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('person_view');
	}

	
	public function ajax_list($data_check) 
	{
		$true_icon = "<center><label class='label label-success'><i class='fa fa-fw fa-lg fa-check'></i></label></center>"; // true icon
		$false_icon = "<center><label class='label label-danger'><i class='fa fa-fw fa-lg fa-times'></i></label></center>"; // false icon
		$logged_id = $this->session->user_id;
		$user = $this->session->level;
		/*
			List of group 
		*/
		
		if ($data_check=="manage_group") {
			$table="groups";
			$columns=array("name","description");
			if($user=="admin"){
			    $where=array('(id != "1" OR `name` != "TOPFORM MANAGMENT") AND `name`!="admin"'=>null );
			}else{
			    $where=array('id != "1" OR `name` != ' =>"TOPFORM MANAGMENT" );
			}
			$table_id="id";
		}
		if ($data_check=="manage_employee") {
			$table="users";
			$columns=array("emp_name","email",'name');
			$join_table=array("groups");
			$join_condition=array('groups.id=users.group_id');
			if($user=="admin"){
			    $where=array('`name` != "TOPFORM MANAGMENT" AND `name`!="admin"'=>null );
			}else{
			    $where=array('`name` != ' =>"TOPFORM MANAGMENT" );
			}
			$table_id="id";
		}
		if ($data_check=="forex_master") {
			$table="currency_master";
			$columns=array("currency_name","currency_rate",'currency_description');
			$table_id="currency_id";
		}
		if ($data_check=="country_master") {
			$table="country_master";
			$columns=array("country_name","country_code");
			$table_id="country_id";
		}
		if ($data_check=="gst_master") {
			$table="gst_master";
			$columns=array("gst_code","gst_rate","gst_type","gst_description");
			$table_id="gst_id";
		}
		if ($data_check=="customer_master") {
			$table="customer_master";
			$columns=array("customer_id","customer_name","customer_code","customer_email","customer_phone");
			$join_table=array("currency_master");
			$join_condition=array('currency_master.currency_id=customer_master.currency_id');
			$table_id="customer_id";
		}
		if ($data_check=="billing_master") {
			$table="billing_master";
			$columns=array("billing_id","stock_code","billing_description","billing_uom","gst_code","billing_type");
			$join_table=array("gst_master");
			$join_condition=array('gst_master.gst_id=billing_master.gst_id');
			$table_id="billing_id";
		}
		if ($data_check=="salesman_master") {
			$table="salesman_master";
			$columns=array("s_id","s_name","s_category","s_note");
			$table_id="s_id";	
		}
		if ($data_check=="quotation_list") {
			$table="quotation_master";
			$columns=array("quotation_ref_no","customer_name","sub_total","lump_sum_discount","lump_sum_discount_price","final_total","created_on");
			$where=array('quotation_status' =>strtoupper($this->uri->segment(5)));
			$join_table=array("customer_master");
			$join_condition=array('quotation_master.customer_id=customer_master.customer_id');
			$table_id="quotation_id";
		}
		if ($data_check == "stock_list") {
			$table = "open_stock_table";
			$columns = array("stock_code","billing_description","billing_uom","open_stock_quantity","open_stock_sign","open_stock_tran_type");
			$in_status = 'C';
			if ($this->uri->segment(5) == 'confirmed') {
				$in_status = 'C';
			}elseif ($this->uri->segment(5) == 'posted') {
				$in_status = 'P';
			}elseif ($this->uri->segment(5) == 'deleted') {
				$in_status = 'D';
			}
			$where=array('open_stock_status' =>strtoupper($in_status));
			$join_table=array("billing_master");
			$join_condition=array('open_stock_table.open_stock_id=billing_master.billing_id');
			$table_id="open_stock_id";
		}
		if ($data_check == "open_list") {
			$table = "open_table";
			$columns = array("open_tran_date","customer_name","open_doc_ref","open_remarks","open_amount","open_sign");
			$in_status = 'C';
			if ($this->uri->segment(5) == 'confirmed') {
				$in_status = 'C';
			}elseif ($this->uri->segment(5) == 'posted') {
				$in_status = 'P';
			}elseif ($this->uri->segment(5) == 'deleted') {
				$in_status = 'D';
			}
			$where=array('open_status' =>strtoupper($in_status));
			$join_table=array("customer_master");
			$join_condition=array('open_table.customer_id=customer_master.customer_id');
			$table_id="open_id";
		}
		if ($data_check=="invoice_list") {
			$table="invoice_master";
			$columns=array("invoice_ref_no","customer_name","sub_total","lump_sum_discount","lump_sum_discount_price","final_total","created_on", "invoice_status");
			$in_status = 'C';
			if ($this->uri->segment(5) == 'confirmed') {
				$in_status = 'C';
			}elseif ($this->uri->segment(5) == 'posted') {
				$in_status = 'P';
			}elseif ($this->uri->segment(5) == 'deleted') {
				$in_status = 'D';
			}

			$where=array('invoice_status' =>strtoupper($in_status));
			$join_table=array("customer_master");
			$join_condition=array('invoice_master.customer_id=customer_master.customer_id');
			$table_id="invoice_id";
		}
		if ($data_check=="other_list") {
			$table="listings";
			if ($this->uri->segment(5) == 'ar') {
		    $table="accounts_receivable";
			$columns=array("doc_date","doc_ref_no","customer_code", "total_amt", "currency_type","tran_type","remarks","opening_balance");
            //to ensure only invoices are shown up, use tran_type SALES as like query was difficult to implement in get_datatables method.
            //$where=array('tran_type' =>'Sales');
			$table_id="ar_id";
			}elseif ($this->uri->segment(5) == 'gl') {
				$table="gl_table";
				$join_table = array('invoice_master','customer_master','currency_master',);
				$join_condition=array('gl_table.doc_ref_no = invoice_master.invoice_ref_no','invoice_master.customer_id = customer_master.customer_id','customer_master.currency_id = currency_master.currency_id');
				$columns=array("doc_ref_no","customer_code","currency_name","doc_date","gst","currency_amount","lump_sum_discount_price","total_amt","tran_type");
			    $table_id="gl_id";
			}
		
			if ($this->uri->segment(5) == 'stock') {
				$in_status = 'Product';
				$table="invoice_product_master";
				$join_table=array("billing_master","invoice_master","customer_master");
				$join_condition=array('invoice_product_master.product_id=billing_master.billing_id','invoice_product_master.invoice_id=invoice_master.invoice_id','invoice_master.customer_id=customer_master.customer_id');
				$columns=array("customer_code","invoice_ref_no","billing_description","quantity","stock_code","reject_msg");
				$where=array('billing_type' =>$in_status,'invoice_status' =>strtoupper('P'));
				//$where=array('billing_type' =>$in_status,'invoice_status' =>strtoupper('P'));
				$table_id="invoice_id";
			}elseif ($this->uri->segment(5) == 'gst') {
				$in_status = 'Product';
				$table="invoice_product_master";
				$join_table=array("billing_master","gst_master","invoice_master","customer_master","currency_master");
				$join_condition=array('invoice_product_master.product_id=billing_master.billing_id','invoice_product_master.gst_id=gst_master.gst_id','invoice_product_master.invoice_id=invoice_master.invoice_id','invoice_master.customer_id=customer_master.customer_id','currency_master.currency_id=customer_master.currency_id');
				$columns=array("currency_name","invoice_ref_no","customer_code","stock_code","invoice_ref_no","billing_description","quantity","invoice_product_master.product_total as product_total","discount","gst_code","gst_rate","price");
				$where=array('billing_type' =>$in_status,'invoice_status' =>strtoupper('P'));
				//$where=array('billing_type' =>$in_status,'invoice_status' =>strtoupper('P'));
				$table_id="i_p_id";
				// $in_status = 'Product';
				// $table="invoice_product_master";
				// $join_table=array("billing_master","gst_master","invoice_master","customer_master","currency_master");
				// $join_condition=array('invoice_product_master.product_id=billing_master.billing_id','invoice_product_master.gst_id=gst_master.gst_id','invoice_product_master.invoice_id=invoice_master.invoice_id','invoice_master.customer_id=customer_master.customer_id','currency_master.currency_id=customer_master.currency_id');
				// $columns=array("invoice_master.created_on as created_on","invoice_ref_no","customer_code","stock_code","billing_description","gst_code","currency_name","discount","quantity","gst_rate","invoice_product_master.product_total as product_total","price");
				// // $where=array('billing_type' =>$in_status,'invoice_status' =>strtoupper('P'));
				// $table_id="i_p_id";
			}
		}
		if ($data_check=="audit_list") {
			$table="accounts_receivable";
			$columns=array("doc_date","doc_ref_no","customer_code","currency_type","total_amt","sign","tran_type","remarks");
			$table_id="ar_id";
		}
		if ($data_check=="receipt_list") {
			$table="receipt_master";
			$columns=array("receipt_ref_no","customer_name","bank","cheque","other_reference","amount","invoice","created_on");
			$where=array('receipt_status' =>strtoupper(substr($this->uri->segment(5),0,1)));
			$join_table=array("customer_master");
			$join_condition=array('receipt_master.customer_id=customer_master.customer_id');
			$table_id="receipt_id";
		}
		/*--------------------------------------------------------------------------------------------------------*/

		
		
		if (isset($join_table) && isset($join_condition) && isset($where)) {
			$list= $this->DT_model->get_datatables($table,$columns,$join_table,$join_condition,$where,$table_id);
		}
		elseif (isset($join_table) && isset($join_condition)) {
			$list = $this->DT_model->get_datatables($table,$columns,$join_table,$join_condition,null,$table_id);
		}
		elseif (isset($where)){
		 	$list = $this->DT_model->get_datatables($table,$columns,null,null,$where,$table_id);
		}
		else {
			$list = $this->DT_model->get_datatables($table,$columns,null,null,null,$table_id);		
		}	
		$data = array();

		$no = $this->input->post('start');
		
		foreach ($list as $person) {
			
			$no++;
			$row = array();
			/*
				get data of fired query as row as per requirement
			*/
			if($data_check=="manage_group")
			{
				$a=array();
				$permissions=(array)json_decode($person->permissions);
				$permissions_list="";
				foreach ($permissions as $key => $value) {
					if($value){
						$permissions_list.=ucwords(str_replace('_', ' ',$key)).",<br>";
					}
				}
					$row[] = $person->id;
					$row[] = $person->name;
					$row[] = $person->description;
					$row[] = $permissions_list;
					// $row[] = print_r($a);
			}

			if($data_check=="manage_employee")
			{
				$row[] = $person->table_id;
				$row[] = $person->name;
				$row[] = $person->emp_name;
				$row[] = $person->email;
			}

			if($data_check=="forex_master")
			{
				$row[] = $person->table_id;
				$row[] = $person->currency_name;
				$row[] = $person->currency_description;
				$row[] = $person->currency_rate;
			}

			if($data_check=="country_master")
			{
				$row[] = $person->table_id;
				$row[] = $person->country_name;
				$row[] = $person->country_code;
			}

			if($data_check=="gst_master")
			{
				$row[] = $person->table_id;
				$row[] = $person->gst_code;
				$row[] = $person->gst_rate;
				$row[] = $person->gst_type;
				$row[] = $person->gst_description;
			}

			if($data_check=="customer_master")
			{
				$row[] = $person->table_id;
				$row[] = $person->customer_name;
				$row[] = $person->customer_code;
				$row[] = $person->currency_name;
				$row[] = $person->customer_email;
				$row[] = $person->customer_phone;
			}

			if($data_check=="billing_master")
			{
				$row[] = $person->table_id;
				$row[] = $person->stock_code;
				$row[] = $person->billing_description;
				$row[] = $person->gst_code;
				$row[] = $person->billing_uom;
				$row[] = $person->billing_type;
			}

			if($data_check=="salesman_master"){
				$row[] = $person->table_id;
				$row[] = $person->s_name;
				$row[] = $person->s_category;
				$row[] = $person->s_note;
			}

			if($data_check=="quotation_list")
			{
				$row[] = $person->table_id;
				$row[] = $person->quotation_ref_no;
				$row[] = $person->customer_name." <br/>".$person->customer_code;
				$row[] = $person->sub_total;
				$row[] = $person->lump_sum_discount;
				$row[] = $person->lump_sum_discount_price;
				$row[] = $person->final_total;
				$row[] = $person->created_on;
			}

			if ($data_check == "stock_list") {
				$row[] = $person->table_id;
				$row[] = $person->stock_code;
				$row[] = $person->billing_description;
				$row[] = $person->billing_uom;
				$row[] = $person->open_stock_quantity;
				$row[] = $person->open_stock_sign;
				$row[] = $person->open_stock_tran_type;
			}
			if ($data_check=="open_list") {
				$row[] = $person->table_id;
				$row[] = $person->open_tran_date;
				$row[] = $person->customer_name;
				$row[] = $person->open_doc_ref;
				$row[] = $person->open_remarks;
				$row[] = $person->open_amount;
				$row[] = $person->open_sign;

			}

			if($data_check=="invoice_list")
			{
				$row[] = $person->table_id;
				$row[] = $person->invoice_ref_no;
				$row[] = $person->customer_name;
				$row[] = $person->sub_total;
				$row[] = $person->lump_sum_discount;
				$row[] = $person->lump_sum_discount_price;
				$row[] = $person->final_total;
				$row[] = $person->created_on;
				$row[] = $person->invoice_status;
			}

            if($data_check=="other_list")
			{
				if ($this->uri->segment(5) == 'ar') {
					$row[] = $person->table_id;
					$row[] = $person->doc_date;
					$row[] = $person->doc_ref_no;
					$row[] = $person->customer_code;
					$row[] = '+'. number_format(($person->total_amt), 2, '.', '');
					$row[] = $person->currency_type;
					$row[] = $person->tran_type;
					$row[] = $person->remarks;
					$row[] = $person->opening_balance;
					
					
				}elseif ($this->uri->segment(5) == 'gl') {
					$row[] = $person->table_id;
					$row[] = $person->doc_date;
					$row[] = $person->doc_ref_no;
					$row[] = $person->customer_code;
					$row[] = $person->currency_name;
					if($person->currency_amount != 1){//foreign total
						//$row[] = number_format(($person->lump_sum_discount_price*$person->currency_amount), 2, '.', '');
						$row[] = number_format(($person->lump_sum_discount_price), 2, '.', '');
						//$row[] = number_format(($person->gst*$person->currency_amount), 2, '.', '');
						$row[] = number_format(($person->gst*$person->currency_amount), 2, '.', '');
						//$row[] = number_format(($person->total_amt*$person->currency_amount), 2, '.', '');
						$row[] = number_format(($person->total_amt), 2, '.', '');
						$row[] = $person->currency_amount;
						//$row[] = number_format(($person->lump_sum_discount_price*$person->currency_amount/$person->currency_amount), 2, '.', '');
						$row[] = number_format(($person->lump_sum_discount_price/$person->currency_rate), 2, '.', '');
						$row[] = number_format(($person->gst*$person->currency_amount/$person->currency_amount), 2, '.', '');
						$row[] = number_format(($person->total_amt/$person->currency_rate), 2, '.', '');
					}
					else{
						$row[] = number_format(($person->lump_sum_discount_price*$person->currency_amount*$person->currency_amount), 2, '.', '');
						$row[] = number_format(($person->gst*$person->currency_amount*$person->currency_amount), 2, '.', '');
						$row[] = number_format(($person->total_amt*$person->currency_amount*$person->currency_amount), 2, '.', '');
						$row[] = $person->currency_amount;
						$row[] = number_format(($person->lump_sum_discount_price*$person->currency_amount), 2, '.', '');
						$row[] = number_format(($person->gst*$person->currency_amount), 2, '.', '');
						$row[] = number_format(($person->total_amt*$person->currency_amount), 2, '.', '');
					}
					$row[] = $person->tran_type;
				}elseif ($this->uri->segment(5) == 'stock') {
					$row[] = $person->table_id;
					$row[] = $person->created_on;
					$row[] = $person->invoice_ref_no;
					$row[] = $person->customer_code;
					$row[] = $person->stock_code;
					$row[] = $person->billing_description;
					$row[] = $person->discount;
					$row[] = number_format($person->quantity * (-1), 0, '', '');
					$row[] = $person->reject_msg;
					
				}
				elseif ($this->uri->segment(5) == 'gst') {
					$row[] = $person->table_id;
					$row[] = $person->created_on;
					$row[] = $person->invoice_ref_no;
					$row[] = $person->customer_code;
					$row[] = $person->stock_code;
					$row[] = $person->billing_description;
					$row[] = $person->gst_code;
					$row[] = $person->currency_name;
					$row[] = number_format(($person->price * $person->quantity - $person->price * $person->quantity * $person->discount / 100)* $person->currency_amount , 0, '', '');
					$row[] = number_format($person->price * $person->quantity * $person->gst_rate * $person->currency_amount / 100, 0, '', '');
					$row[] = $person->currency_amount;
					
					$row[] = number_format(($person->price * $person->quantity - $person->price * $person->quantity * $person->discount / 100) , 0, '', '');
					$row[] = number_format($person->price * $person->quantity * $person->gst_rate / 100, 0, '', '');
					// $row[] = $person->table_id;
					// $row[] = $person->created_on;
					// $row[] = $person->doc_ref_no;
					// $row[] = $person->customer_code;
					// $row[] = $person->stock_code;
					// $row[] = $person->billing_description;
					// $row[] = $person->gst_code;
					// $row[] = $person->currency_name;
					// $row[] = number_format(($person->price * $person->quantity - $person->quantity * $person->discount)* $person->currency_amount , 0, '', '');
					// $row[] = number_format($person->price * $person->quantity * $person->gst_rate * $person->currency_amount / 100, 0, '', '');
					// $row[] = $person->currency_amount;
					// $row[] = number_format(($person->price * $person->quantity - $person->quantity * $person->discount) , 0, '', '');
					// $row[] = number_format($person->price * $person->quantity * $person->gst_rate / 100, 0, '', '');
				}
			}
	        if($data_check=="audit_list")
			{
				$row[] = $person->table_id;
				$row[] = $person->doc_date;
				$row[] = $person->doc_ref_no;
				$row[] = $person->customer_code;
				$row[] = $person->currency_type;
				$row[] = $person->total_amt;
				$row[] = $person->sign;
				$row[] = $person->tran_type;
				$row[] = $person->remarks;
			}
			
			if($data_check=="receipt_list")
			{
				$row[] = $person->table_id;
				$row[] = $person->receipt_ref_no;
				$row[] = $person->customer_name;
				$row[] = $person->bank;
				$row[] = $person->cheque;
				$row[] = $person->other_reference;
				$row[] = $person->amount;
				$row[] = $person->invoice;
				$row[] = $person->created_on;
			}

			//add html for action
			
			$data[] = $row;
		}
		/*----------------------------------------------------------------------------------------------------*/

		if (isset($join_table) && isset($join_condition) && isset($where)) {
		$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->DT_model->count_all($table),
						"recordsFiltered" => $this->DT_model->count_filtered($table,$columns,$join_table,$join_condition,$where,$table_id),
						"data" => $data,
				);
		}
		elseif (isset($join_table) && isset($join_condition)) {
			$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->DT_model->count_all($table),
						"recordsFiltered" => $this->DT_model->count_filtered($table,$columns,$join_table,$join_condition,null,$table_id),
						"data" => $data,
				);	
		}
		elseif (isset($where)){
			$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->DT_model->count_all($table),
						"recordsFiltered" => $this->DT_model->count_filtered($table,$columns,null,null,$where,$table_id),
						"data" => $data,
				);	
		}
		else
		{
			$output = array(
						"draw" => $this->input->post('draw'),
						"recordsTotal" => $this->DT_model->count_all($table),
						"recordsFiltered" => $this->DT_model->count_filtered($table,$columns,null,null,null,$table_id),
						"data" => $data,
				);	
		}
		//output to json format
		echo json_encode($output);
	}
}
