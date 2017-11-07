<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
   		
	class System_utilities extends MY_Controller {

	
		public function backup_database()
		{
			is_logged_in('admin');
			has_permission();
			$this->body_file="common/blank.php";
			databaseBackup();
			redirect('dashboard','refresh');
		}
		public function initialize_database()
		{
			is_logged_in('admin');
			has_permission();
			$this->body_file="common/blank.php";
			databaseInitialize();
			redirect('dashboard','refresh');
		}
		
		public function restore_database($action="form")
		{
			is_logged_in('admin');
			// has_permission();
			if($action=="form"){ 
				$this->body_vars['save_url']= base_url('system_utilities/restore_database/save');
			}
			if ($action=="save") {
				$data=file_upload(date('YmdHis'),"db_file","database_restore_files");
				$this->load->helper("file");
				// d($data);
				if($data['status']){
					$sql_file=$data["upload_data"]['full_path'];
					$query_list = explode(";", read_file($sql_file));
					
					//This foreign key check was disabled for 1 table referred by 2 tables
					//Cannot delete or update a parent row: a foreign key constraint fails # # TABLE STRUCTURE FOR: groups # DROP TABLE IF EXISTS `groups`
					$this->db->query('SET foreign_key_checks = 0');
					
					d($query_list);
					foreach($query_list as $query):
						$query=trim($query);
						if($query!=""){
	     					$this->db->query($query);
	     				}
	     			endforeach;
	     			$this->db->query('SET foreign_key_checks = 1');
	     			set_flash_message('message','success',"System Restored Successfully");
     			}
     			else{
     				set_flash_message('message','warning',$data["error"]);	
     			}
     			redirect('system_utilities/restore_database','refresh');
			}
		}

        public function export_customer_master()
        {
            require_once "util_github/Column.class.php";
            require_once "util_github/Record.class.php";
            require_once "util_github/Table.class.php";
            require_once "util_github/WritableTable.class.php";

            // $fields = array(
            //     array("bool" , DBFFIELD_TYPE_LOGICAL),
            //     array("memo" , DBFFIELD_TYPE_MEMO),
            //     array("date" , DBFFIELD_TYPE_DATE),
            //     array("number" , DBFFIELD_TYPE_NUMERIC, 3, 0),
            //     array("string" , DBFFIELD_TYPE_CHAR, 50),
            // );
            $fields = array(
                array("bool" , DBFFIELD_TYPE_LOGICAL),
                array("memo" , DBFFIELD_TYPE_MEMO),
                array("date" , DBFFIELD_TYPE_DATE),
                array("number" , DBFFIELD_TYPE_NUMERIC, 3, 0),
                array("string" , DBFFIELD_TYPE_CHAR, 50),
            );
            //$table = new Test("sdfsdf");
            // /* create a new table */
            
            $tableNew = XBaseWritableTable::create("data.dbf",$fields);
            $r =& $tableNew->appendRecord();
            
            $r->setObjectByName("bool",true);
            $r->setObjectByName("date",time());
            $r->setObjectByName("number",123);
            $r->setObjectByName("string","String one");

            $tableNew->writeRecord();

            //var_dump($tableNew);exit;
            $file = "data.dbf";
            if (file_exists($file)) {


                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                exit;
            }
            //var_dump($tableNew);exit;
           // redirect('master_files/customer_master','refresh');
        }
		
		public function import_customer_master($action="form")
		{
			is_logged_in('admin');
			// has_permission();
			
			if($action=="form"){
				$this->body_vars['save_url']= base_url('system_utilities/import_customer_master/save');
			}
			if ($action=="save") {
			    
			    require_once "util/Column.class.php";
            	require_once "util/Record.class.php";
            	require_once "util/Table.class.php";
            	
				$data=file_upload(date('YmdHis'),"db_file","database_import_files");
				$this->load->helper("file");
			
				if($data['status']){
					$dbf_file=$data["upload_data"]['full_path'];
			        
			    	
            	/* create a table object and open it */
            	$table = new XBaseTable($dbf_file);
            	$table->open();
            
            
                    // foreach ($table->getColumns() as $i=>$c) {
                	   // echo "<br/>".$c->getName();
                    // }
                    
                    
                //     while ($record=$table->nextRecord()) {
                // 	    foreach ($table->getColumns() as $i=>$c) {
                // 	        if(strcmp($c->getName(),"IDEN")==0)
                // 		    echo "<td>".$record->getString($c)."</td>";
                // 	    }
                // 	    echo "</tr>";
                //     }
                // 	echo "</table>";
                
                //separate
                // 	$record = $table->nextRecord();
                // 	echo $record->getStringByName("IDEN");
                
                $ctr = 0;
            
                //zapCustomer_Master();
                
                while($record =$table->nextRecord())
                {
                    $insert_data['customer_code'] = $record->getStringByName("IDEN");
                    $insert_data['customer_name'] = $record->getStringByName("NAME");
                
                    $address1 = $record->getStringByName("ADD1");
                    $address2 = $record->getStringByName("ADD2");
                    $address3 = $record->getStringByName("ADD3");
                    $address4 = $record->getStringByName("ADD4");
                    $address5 = $record->getStringByName("ADD5");
                    
                    if($address5 !="")
                    {
                    	$insert_data['customer_postal_code'] = $address5;
                    
                    	$insert_data['customer_street_name'] = $address2. ", ". $address3. ", ". $address4;
                    
                    	$insert_data['customer_bldg_number'] = $address1;
                    }
                    
                    else if($address4 !="")
                    {
                    	$insert_data['customer_postal_code'] = $address4;
                    
                    	$insert_data['customer_street_name'] = $address2. ", ". $address3;
                    
                    	$insert_data['customer_bldg_number'] = $address1;
                    }
                    
                    else if($address3!="")
                    {
                    	$insert_data['customer_postal_code'] = $address3;
                    
                    	$insert_data['customer_street_name'] = $address2;
                    
                    	$insert_data['customer_bldg_number'] = $address1;
                    }
                    
                    else if($address2!="")
                    {
                    	$insert_data['customer_street_name'] = $address2;
                    
                    	$insert_data['customer_bldg_number'] = $address1;
                    }
                    
                    else
                    {
                    	$insert_data['customer_bldg_number'] = $address1;
                    }
                    
                    $insert_data['customer_bldg_number'] = str_replace(";",",",$insert_data['customer_bldg_number']);
                    $insert_data['customer_street_name'] = str_replace(";",",",$insert_data['customer_street_name']);
                    $insert_data['customer_postal_code'] = str_replace(";",",",$insert_data['customer_postal_code']);
                    
                    $insert_data['customer_phone'] = $record->getStringByName("TEL1");
                    $insert_data['customer_fax'] = $record->getStringByName("FAXI");
                    $insert_data['customer_email'] = $record->getStringByName("TELX");
                    $insert_data['customer_contact_person'] = $record->getStringByName("CONT");
                    $insert_data['customer_credit_limit'] = $record->getStringByName("LIMI");
                    $insert_data['customer_credit_term_days'] = $record->getStringByName("TERM");
                    
                    $insert_data['currency_id'] = 1;
                    //$insert_data['currency_id'] = currency update from rate.dbf
                    
                    $insert_data['customer_uen_no'] = $record->getStringByName("UEN");
                    $insert_data['customer_gst_number'] = $record->getStringByName("GSTNO");
                    
                    //$insert_data['customer_rating'] = $record->getStringByName("IDEN");
                    
                    //$insert_data['country_id'] = insert country id where name = CTY
                    
                    //$insert_data['status'] = not present in dbf
                    var_dump($insert_data);exit;
                    
                   // $this->custom->insertRow("customer_master",$insert_data);
                    
                    $ctr = $ctr + 1;
                }
                
                	/* close the table */
                	$table->close();
                	
                	if($ctr > 0)
                	{
                	    set_flash_message('message', 'success', 'Imported '.$ctr.' records');    
                	}
                	
                	else
                	{
                	    set_flash_message('message', 'danger', 'Unable to import');
                	}
    			        
    	     	//		set_flash_message('message','success',"Imported Successfully");
         			}
         			else{
         				set_flash_message('message','warning',$data["error"]);	
         			}
                
                    $this->body_vars['save_url']= base_url('system_utilities/import_customer_master/save');

         		    redirect('system_utilities/import_customer_master','refresh');
    			}
		}
		
		public function import_salesman_master($action="form")
		{
			is_logged_in('admin');
			// has_permission();
			
			if($action=="form"){
				$this->body_vars['save_url']= base_url('system_utilities/import_salesman_master/save');
			}
			if ($action=="save") {
			    
			    require_once "util/Column.class.php";
            	require_once "util/Record.class.php";
            	require_once "util/Table.class.php";
            	
				$data=file_upload(date('YmdHis'),"db_file","database_import_files");
				$this->load->helper("file");
			
				if($data['status']){
					$dbf_file=$data["upload_data"]['full_path'];
			        
            	    /* create a table object and open it */
                	$table = new XBaseTable($dbf_file);
                	$table->open();
                
                    $ctr = 0;
                    
                    zapSalesMan_Master();
            
                    //   foreach ($table->getColumns() as $i=>$c) {
                    // 	    echo "<br/>".$c->getName();
                    //     }
                        
                    //     echo "<br/>";
                        
                    //     while ($record=$table->nextRecord()) {
                    //         echo "SMAN ".$record->getStringByName("SMAN")."<br/>";
                    // 	        echo "NAME ".$record->getStringByName("NAME")."<br/>";
                    // 	        }
                    
                    while($record =$table->nextRecord())
                    {
                        $insert_data['s_code'] = $record->getStringByName("SMAN");
                        $insert_data['s_name'] = $record->getStringByName("NAME");
                        
                        //$insert_data['s_category'] = $record->getStringByName("CTYPE");
                        //ctype is not present in the sent dbf file although mentioned in the file
                        //$insert_data['s_note'] = not present in dbf
                        
                        $this->custom->insertRow("salesman_master",$insert_data);
                        
                        $ctr = $ctr + 1;
                    }
                    
                    	/* close the table */
                    	$table->close();
                    	
                    	if($ctr > 0)
                    	{
                    	    set_flash_message('message', 'success', 'Imported '.$ctr.' records');    
                    	}
                    	
                    	else
                    	{
                    	    set_flash_message('message', 'danger', 'Unable to import');
                    	}
        			        
        	     	//		set_flash_message('message','success',"Imported Successfully");
         		}
         			
     			else{
     				set_flash_message('message','warning',$data["error"]);	
     			}
            
                $this->body_vars['save_url']= base_url('system_utilities/import_salesman_master/save');

     		    redirect('system_utilities/import_salesman_master','refresh');
			}
		}
		
		public function import_billing_master($action="form")
		{
			is_logged_in('admin');
			// has_permission();
			
			if($action=="form"){
				$this->body_vars['save_url']= base_url('system_utilities/import_billing_master/save');
			}
			if ($action=="save") {
			    
			    require_once "util/Column.class.php";
            	require_once "util/Record.class.php";
            	require_once "util/Table.class.php";
            	
				$data=file_upload(date('YmdHis'),"db_file","database_import_files");
				$this->load->helper("file");
			
				if($data['status']){
					$dbf_file=$data["upload_data"]['full_path'];
			        
            	/* create a table object and open it */
            	$table = new XBaseTable($dbf_file);
            	$table->open();
            
            $ctr = 0;
            
            zapBilling_Master();
            
            while($record =$table->nextRecord())
            {
               
                $insert_data['stock_code'] = $record->getStringByName("CODE");

                $desc = $record->getStringByName("DESC");
                $desc.= $record->getStringByName("DESC1");
                $desc.= $record->getStringByName("DESC2");
                $desc.= $record->getStringByName("DESC3");
                $desc.= $record->getStringByName("DESC4");
                $desc.= $record->getStringByName("DESC5");
                $desc.= $record->getStringByName("DESC6");
                $desc.= $record->getStringByName("DESC7");
                $desc.= $record->getStringByName("DESC8");
                $desc.= $record->getStringByName("DESC9");
                
                //trim to remove left and right white space, preg to reduce more than one space to one inside the string
                $desc = trim(preg_replace('/\s+/',' ', $desc));
                
               // $desc = str_replace("(","[",$desc);
                $desc = str_replace(";",",",$desc);
                
                $insert_data['billing_description'] = $desc;
                $insert_data['billing_uom'] = $record->getStringByName("UOM");
                $insert_data['billing_price_per_uom'] = $record->getStringByName("PRIC");
                
                //gst id is required in order to display them in datatable as it is foreign key so keeping it 1
                $insert_data['gst_id'] = 1;

                //other fields are not present in the dbf

                $this->custom->insertRow("billing_master",$insert_data);
                
                $ctr = $ctr + 1;
            }
            
            	/* close the table */
            	$table->close();
            	
            	if($ctr > 0)
            	{
            	    set_flash_message('message', 'success', 'Imported '.$ctr.' records');    
            	}
            	
            	else
            	{
            	    set_flash_message('message', 'danger', 'Unable to import');
            	}
			        
	     	//		set_flash_message('message','success',"Imported Successfully");
     			}
     			else{
     				set_flash_message('message','warning',$data["error"]);	
     			}
            
                $this->body_vars['save_url']= base_url('system_utilities/import_billing_master/save');

     		    redirect('system_utilities/import_billing_master','refresh');
			}
		}
		
	}
		
		/*End of file System_utilities.php */
		/* Location: ./application/modules/new_modules/company_profile/controllers/System_utilities.php */