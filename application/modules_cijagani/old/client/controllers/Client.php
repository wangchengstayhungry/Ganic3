<?php 
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Client extends MY_Controller {
	
	    function __construct() {
	        parent::__construct();
	    }
	
	    function index() {
	        echo "Hi! , Client";
	    }
	}
