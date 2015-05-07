<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Benefit extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('general');
            $this->load->model('members');
	    	$this->load->library('pagination');
        }
	
	
	
	public function index(){
		
		
	 $username = $this->session->userdata('username');
	
	if($username == NULL || !$username){
		$this->session->sess_destroy();
		redirect('home');
	}
	else{
	//echo $username;
        $data['title'] = 'HRMS(Human Resource Management System) : Benefits';
        
        $data['header_nav'] = "<ul class=\"wat-cf\">
					<li><a href=\"#\">Profile</a></li>
					<li><a href=\"#\">Settings</a></li>
					<li><a class=\"logout\" href=\"".site_url('dashboard/logout')."\">Logout</a></li>
				</ul>";
				
		$data['access_uri'] = "<div class=\"secondary-navigation\">
					<ul class=\"wat-cf\">
						<li ><a href=\"".site_url('dashboard')."\">Dashboard</a></li>
						<li><a href=\"".site_url('employees')."\">Employees</a></li>
						<li><a href=\"".site_url('leave')."\">leave</a></li>
						<li><a href=\"".site_url('travel')."\">Travels</a></li>
						<li class = \"active\"><a href=\"".site_url('benefit')."\">Benefits</a></li>
						<li><a href=\"".site_url('training')."\">Training</a></li>
						<li><a href=\"".site_url('task')."\">Task</a></li>
						<li><a href=\"".site_url('report')."\">Reports</a></li>
					</ul>
				</div>";
				
		$data['additional_js'] = '';
	
		$data['error'] = '';
		
		$data['employees_assigned'] = '';
		
		$data['query'] = $this->members->get_all_benefit();
		
		
		$this->load->view('benefits/benefit.php',$data);
		
			}
	}
			

			
    public function add_benefit(){
	
	 $username = $this->session->userdata('username');
	
	if($username == NULL || !$username){
		$this->session->sess_destroy();
		redirect('home');
		
		}
		
	else{
	//echo $username;
        $data['title'] = 'HRMS(Human Resource Management System) : Employees';
        
        $data['header_nav'] = "<ul class=\"wat-cf\">
									<li><a href=\"#\">Profile</a></li>
									<li><a href=\"#\">Settings</a></li>
									<li><a class=\"logout\" href=\"".site_url('dashboard/logout')."\">Logout</a></li>
								</ul>";
        
				
		$data['access_uri'] = "<div class=\"secondary-navigation\">
					<ul class=\"wat-cf\">
						<li ><a href=\"".site_url('dashboard')."\">Dashboard</a></li>
						<li><a href=\"".site_url('employees')."\">Employees</a></li>
						<li><a href=\"".site_url('leave')."\">leave</a></li>
						<li><a href=\"".site_url('travel')."\">Travels</a></li>
						<li class = \"active\"><a href=\"".site_url('benefit')."\">Benefits</a></li>
						<li><a href=\"".site_url('training')."\">Training</a></li>
						<li><a href=\"".site_url('task')."\">Task</a></li>
						<li><a href=\"".site_url('report')."\">Reports</a></li>
					</ul>
				</div>";
				
		$data['additional_js'] = '';
		
		$data['benefit'] =  $this->members->get_all_benefitHTML();
		
		$data['id'] =  $employee_id = $this->uri->segment(3);
		
		$employee_first_name = $this->members->get('first_name',array('employee_id'=>$employee_id),'employees');
		$employee_last_name = $this->members->get('last_name',array('employee_id'=>$employee_id),'employees');
		
		$data['employee_name'] = $employee_first_name.' '.$employee_last_name;
		
		$data['error'] = '';
		
		$this->form_validation->set_rules('benefit', 'Benefit Type', 'required|xss_clean|trim');
		$this->form_validation->set_rules('entities', 'Entities', 'required|xss_clean|trim');
		
		if($this->form_validation->run() == FALSE){
		
		$data['error'] = validation_errors();	
		$this->load->view('benefits/add_benefit.php',$data);
		
		}
		
		else{
			
			$benefit_id = $this->input->post('benefit');
			$employee_id = $this->uri->segment(3);
			$entities = $this->input->post('entities');
			$date_start = $this->input->post('start_date');
			$date_end = $this->input->post('end_date');
			
			$param = array('benefit_id'=>$benefit_id,
							'employee_id'=>$employee_id,
							'entities' => $entities,
							'date_start'=>date_format(date_create($date_start),'Y-m-d'),
							'date_end' =>date_format(date_create($date_end), 'Y-m-d'),
							'date_added' => date('Y-m-d H:i:s',time())
					);
			
			$this->members->insert_entry('employee_benefits',$param);
			redirect('employees/success');
			
		}
		
		}
		
    }
    
    
    
    public function add_new_benefit(){
    	
    	$username = $this->session->userdata('username');
    	
    	if($username == NULL || !$username){
    		$this->session->sess_destroy();
    		redirect('home');
    	}
    	
    	else{
    	
    	$data['title'] = 'HRMS(Human Resource Management System) : Benefits';
    	
    	$data['header_nav'] = "<ul class=\"wat-cf\">
					<li><a href=\"#\">Profile</a></li>
					<li><a href=\"#\">Settings</a></li>
					<li><a class=\"logout\" href=\"".site_url('dashboard/logout')."\">Logout</a></li>
				</ul>";
    	
    	$data['access_uri'] = "<div class=\"secondary-navigation\">
					<ul class=\"wat-cf\">
						<li ><a href=\"".site_url('dashboard')."\">Dashboard</a></li>
						<li><a href=\"".site_url('employees')."\">Employees</a></li>
						<li><a href=\"".site_url('leave')."\">leave</a></li>
						<li><a href=\"".site_url('travel')."\">Travels</a></li>
						<li class = \"active\"><a href=\"".site_url('benefit')."\">Benefits</a></li>
						<li><a href=\"".site_url('training')."\">Training</a></li>
						<li><a href=\"".site_url('task')."\">Task</a></li>
						<li><a href=\"".site_url('report')."\">Reports</a></li>
					</ul>
				</div>";
    	
    	$data['additional_js'] = '<script type="text/javascript" src="'.base_url().'assets/js/calendarDateInput.js"></script>
						  <script type="text/javascript" src="'.base_url().'assets/js/jquery.timePicker.js"></script>
						  <script type="text/javascript" src="'.base_url().'assets/js/action.js"></script>
					          <script language="javascript">
						  function load_widget(widget_id, loader_id, page_link, target_widget_loader, the_widget_id, resize)
						{
                                                $(loader_id).show();
                                                var widget_val = $(widget_id).val();
    	
                                                $.get("'.site_url('/').'" + page_link, {widget_id_val: widget_val, widget_id: the_widget_id}, function(response) {
                                                    setTimeout("finishAjax(\'" + target_widget_loader + "\', \'"+escape(response)+"\', \'"+ loader_id + "\')", 400);
                                                });
						}
					
						</script>';
    		
    	
    	$data['query'] = $this->members->get_all_benefit();
    	
    	$data['employees_assigned'] = '';
    	
    	$data['error'] = '';
    	
    	$this->form_validation->set_rules('benefit_type', 'Benefit Type', 'required|xss_clean|trim');
    	
    	if($this->form_validation->run() == FALSE){
    	
    		$data['error'] = validation_errors();
    		$this->load->view('benefits/benefit.php',$data);
    	}
    	
    	
    	else{
    		
    		$benefit_type = $this->input->post('benefit_type');
    		
    		$param = array('benefit_type'=>$benefit_type,
    						'date_added'=>date('Y-m-d : h:i:s',time()),
    						'date_updated'=>date('Y-m-d : h:i:s',time())
    				
    						);
    		
    		$this->members->insert_entry('benefits',$param);
    		redirect('benefit');
    	}
    	}
    }
    
    
    
    
        }