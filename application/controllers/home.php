<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Home extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('general');
            $this->load->model('members');
        }
        
        
        
        
	public function index(){

        
        $data['title'] = 'HRMS(Human Resource Management System) : Login';
        
        $data['header_nav'] = '';
	
		$data['access_uri'] = '';
		
		$data['additional_js'] = '';
	        
        //$data['error'] = '';
        
        $this->session->sess_destroy();
        
        $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Your Password', 'required|trim|xss_clean');
        
        if($this->form_validation->run() == FALSE){
            
            $data['error'] = validation_errors();
            $this->load->view('login.php',$data);
        }
        
        else{
            
            $uname = $this->input->post('email');
            $password = $this->input->post('password');
            
            if ($uname == EMAIL  && $password == PASSWORD)
            {
                
		    $this->session->set_userdata(array('username' => $uname));
                    redirect('dashboard');
                    
                    
                
            }
            
            else{
                $data['error'] = 'Wrong Username and Password';
                $this->load->view('login.php', $data);
            }
            
        }
        
    }
    
    
 
}