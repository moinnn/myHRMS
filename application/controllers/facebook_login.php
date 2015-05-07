<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Facebook_login extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('form');
            $this->load->helper('url');

           // Load facebook library and pass associative array which contains appId and secret key
		   $this->load->library('facebook', array('appId' => '801719633237760', 'secret' => '686d9f620418a88da2594aa9e552d532'));
        }
        
        
	
	 public function index(){
	 	
	 	
	 	echo "Hello World";
	 	//require_once '.php';
	 	//$this->facebook->login_url;
	 	
	 }
	 	
	 }
