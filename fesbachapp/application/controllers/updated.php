<?php
class updated extends CI_Controller{

        public function __construct(){
            
            
            parent:: __construct();  
            
        }

    function index(){
        
        
        
        $this->load->view('updated.php');
        
       $this->session->sess_destroy();
    }
    

    

}




?>