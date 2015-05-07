<?php

class Fesbachapp extends CI_Controller{
    
    public function __construct()
    {
        
        parent:: __construct();           
    }
    
    function index(){
        
        $data['title'] = 'Fesbach || Home Page';
        
        $data['body'] = 'Welcome to Fesbach';
        
        $this->session->sess_destroy();
        
        $this->load->view('fesbachapp', $data);
        
    }
    
    
    
    
}