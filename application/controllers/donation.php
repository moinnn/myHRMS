<?php
class Donation extends CI_Controller{
    
    public function __construct()
		{
			parent::__construct();
			
			#$this->load->helper('captcha');
			#$this->load->model('jamz');
			$this->load->library('form_validation');
                        $this->load->helper('form');
			$this->load->model(array('students','members'));
			#$this->load->model('activity');
		}
                
        
        
        function index()
        {
        
        $mem_id = $this->session->userdata('mem_id');
        $mem_name = $this->session->userdata('mem_name');
        #$data['id'] = $this->uri->segment(3);
        
        #$this->load->library('pagination');
        
        #$num_rows = $this->members->get_num_of_projects();
        
        /*$config['uri_segment'] = 4;
        $config['base_url'] = site_url('projects/all');
        $config['total_rows'] = $num_rows;
        $config['per_page'] = '3';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next&gt';
        $config['prev_link'] = '&Previous';
        
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        
        $data['pagination'] = $pagination;*/
        
        
        $data['title'] =  'Donation/Pledge';
        
        $banner_title  =  'Donation/Pledge';
        
        $data['header'] = 'Donation/Pledge';
        
        $data['additional_js'] = '';
        
        $data['content'] = '';
        
        $data['error'] = '';
        
       
        
         if($mem_id == NULL || (!$this->session->userdata('mem_id')) || !$this->members->verified($mem_id))
         {
            
            $data['access_uri'] = "<ul>
					<li><a href=\"#\">About</a></li>
					<li><a href=\"".site_url('login')."\">Sign In</a></li>
					<li><a href=\"".site_url('signup')."\">Sign Up</a></li>
					<li><a href=\"".site_url('project')."\">Support A Project</a></li>
					<li class=\"active\"><a href=\"#\">Start Project</a></li>
				</ul>";
         }
         
        else
        {
            $data['access_uri'] = "Welcome"." "."<b>".$mem_name."</b>"." "."<a href=\"".site_url('home/logout')."\">Logout</a>";
        }
        
        $data['site_banner'] = "<div class=\"greenBg smallBanner\">
					<div class=\"container_16\">
					<div class=\" grid_10\"><h2>".$banner_title."</h2>
					 <p>m dolor sit amet, consectetur adipiscing elit.Phasellus sed cursus erat. Aliquam tristique ligula sit amet dolor Lore</p>
				</div>
				</div></div>
                                ";
                            
        
        
        #$data['query'] = $this->members->get_project_info();
        
        if($mem_id == NULL || (!$this->session->userdata('mem_id')) || !$this->members->verified($mem_id))
        {
            
                    redirect('login');
            
        }
        else{
        
        $this->load->view('donations.php',$data);
        
        }
        
        
    }   
            
            
        }
                      
                
                
  
  
                
                

?>