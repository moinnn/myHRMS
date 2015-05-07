<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Dashboard extends CI_Controller
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

        $username = $this->session->userdata('username');
	
	if($username == NULL || !$username){
		$this->session->sess_destroy();
		redirect('home');
	}
	else{
	//echo $username;
        $data['title'] = 'HRMS(Human Resource Management System) : Home';
        
        $data['header_nav'] = "<ul class=\"wat-cf\">
					<li><a href=\"#\">Profile</a></li>
					<li><a href=\"#\">Settings</a></li>
					<li><a class=\"logout\" href=\"".site_url('dashboard/logout')."\">Logout</a></li>
				</ul>";
				
		$data['additional_js'] = '';
		
		$data['access_uri'] = "<div class=\"secondary-navigation\">
						<ul class=\"wat-cf\">
							<li class=\"active\"><a href=\"".site_url('dashboard')."\">Dashboard</a></li>
							<li><a href=\"".site_url('employees')."\">Employees</a></li>
							<li><a href=\"".site_url('leave')."\">leave</a></li>
							<li><a href=\"".site_url('travel')."\">Travels</a></li>
							<li><a href=\"".site_url('benefit')."\">Benefits</a></li>
							<li><a href=\"".site_url('training')."\">Training</a></li>
							<li><a href=\"".site_url('task')."\">Task</a></li>
							<li><a href=\"".site_url('report')."\">Reports</a></li>
						</ul>
					</div>";
	    $data['insert'] = $this->members->recent_added();
		
		$this->load->view('dashboard.php',$data);
	
		
	}
		
    }
    
 
    
    
       public function logout(){
	
	$this->session->sess_destroy();
	redirect('home');
	        
    }
    
 }
        
       