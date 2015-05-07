<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Employees extends CI_Controller
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
        
        
	
	 public function index($offset = null){
	
	
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
						<li class=\"active\"><a href=\"".site_url('employees')."\">Employees</a></li>
						<li><a href=\"".site_url('leave')."\">leave</a></li>
						<li><a href=\"".site_url('travel')."\">Travels</a></li>
						<li><a href=\"".site_url('benefit')."\">Benefits</a></li>
						<li><a href=\"".site_url('training')."\">Training</a></li>
						<li><a href=\"".site_url('task')."\">Task</a></li>
						<li><a href=\"".site_url('report')."\">Reports</a></li>
					</ul>
				</div>";
				
	$data['additional_js'] = '';
	
	$num_of_rows_affected = $this->members->get_num_of_employees();
	
	$data['result'] = "<center>".($num_of_rows_affected)." "."Rows Affected</center>";
	
	
	$data['error'] = '';
	$offset = intval($offset);
	
	$this->load->config('pagination'); 
                
	$config['uri_segment'] = 4;
	$config['base_url'] = site_url('employees/index');
	$config['total_rows'] = $this->members->get_num_of_employees();
	$config['per_page'] =20;
	
	
	$data['query'] = $this->members->get_all_employees($config['per_page'],$offset);
	
	$this->pagination->initialize($config);
	
	$data['pagination'] = $this->pagination->create_links();
	
	
	$this->load->view('employees/employees.php',$data);
	
	
    }
    }
    
    public function pdf_export(){
    
    	$this->load->helper('pdfcreator');
    
    	$data['query'] = $this->members->get_all('*','employees','date_added','desc');
    
    
    	$query = $this->load->view('employees/employees', $data, true);
    
    	//echo $query;
    	create_pdf_html2pdf($query, "", 'P', 'A4', 'employee_list.pdf');
    
    
    }
    
    public function add_employee(){
    
    	$username = $this->session->userdata('username');
    
    	if($username == NULL || !$username){
    		$this->session->sess_destroy();
    		redirect('home');
    	}
    	else{
    		//echo $username;
    		$data['title'] = 'HRMS(Human Resource Management System) : Add Employees';
    
    		$data['header_nav'] = "<ul class=\"wat-cf\">
					<li><a href=\"#\">Profile</a></li>
					<li><a href=\"#\">Settings</a></li>
					<li><a class=\"logout\" href=\"".site_url('dashboard/logout')."\">Logout</a></li>
				</ul>";
    
    		$data['access_uri'] = "<div class=\"secondary-navigation\">
					<ul class=\"wat-cf\">
						<li ><a href=\"".site_url('dashboard')."\">Dashboard</a></li>
						<li class=\"active\"><a href=\"".site_url('employees')."\">Employees</a></li>
						<li><a href=\"".site_url('leave')."\">leave</a></li>
						<li><a href=\"".site_url('travel')."\">Travels</a></li>
						<li><a href=\"".site_url('benefit')."\">Benefits</a></li>
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
    			
    		$data['department'] = $this->members->get_all('*','departments','department_id','desc');
    		
    		$data['error'] = '';
    
   
    		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean|trim');
    		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean|trim');
    		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|callback_check_email');
    		$this->form_validation->set_rules('position', 'Job Position', 'required|xss_clean|trim');
    		
    
    		if($this->form_validation->run() == FALSE){
    
    			$data['error'] = validation_errors();
    			$this->load->view('employees/add_employee.php',$data);
    		}
    
    		else{
    
    			$first_name = $this->input->post('first_name');
    			$last_name = $this->input->post('last_name');
    			$date_of_birth = $this->input->post('pickupdate');
    			$email = $this->input->post('email');
    			$phone_number = $this->input->post('phone_number');
    			$contact_address = $this->input->post('contact_address');
    			$department = $this->input->post('department');
    			$position = $this->input->post('position');
    			$contract_type = $this->input->post('contract_type');

   		 			
    			
    			$param = array(
    					'first_name'=>$first_name,
    					'last_name'=>$last_name,
    					'date_of_birth'=>date_format(date_create($date_of_birth), 'Y-m-d'),
    					'email'=>$email,
    					'phone_number'=>$phone_number,
    					'contact_address'=>$contact_address,
    					'department_id'=>$department,
    					'position'=>$position,
    					'supervisor'=> $this->members->get('HOD',array('department_id'=>$department),'departments'),
    					'contract_type'=>$contract_type,
    					'date_added'=>date('Y-m-d : h:i:s',time()),
    					'last_updated'=>date('Y-m-d : h:i:s',time())
    
    			);
    			
    			if ($param['contract_type'] == 'full-time'){
    
    			$this->members->insert_entry('employees',$param);
    			redirect('employees/success');
    			}
    			
    			else{
			    
			    $this->form_validation->set_rules('contractdate', 'End Of Contract', 'required|xss_clean|trim');
			    
    				$end_of_contract = $this->input->post('contractdate');
    				$this->form_validation->set_rules('contractdate', 'Contract Date', 'required|xss_clean|trim');
    				$param = array(
    						'first_name'=>$first_name,
    						'last_name'=>$last_name,
    						'date_of_birth'=>date_format(date_create($date_of_birth), 'Y-m-d'),
    						'email'=>$email,
    						'phone_number'=>$phone_number,
    						'contact_address'=>$contact_address,
    						'department_id'=>$department,
    						'position'=>$position,
    						'supervisor'=> $this->members->get('HOD',array('department_id'=>$department),'departments'),
    						'contract_type'=>$contract_type,
						'end_of_contract'=>date_format(date_create($end_of_contract), 'Y-m-d'),
    						'date_added'=>date('Y-m-d : h:i:s',time()),
    						'last_updated'=>date('Y-m-d : h:i:s',time())
    				
    				);
    				
    				$this->members->insert_entry('employees',$param);
				redirect('employees/success');
    				
    			}
    		}
    
    	}
    
    }
    
     
    
    
    public function success(){
    
    	$username = $this->session->userdata('username');
    
    	if($username == NULL || !$username){
    		$this->session->sess_destroy();
    		redirect('home');
    	}
    	else{
    		//echo $username;
    		$data['title'] = 'HRMS(Human Resource Management System) : Success';
    
    		$data['header_nav'] = "<ul class=\"wat-cf\">
					<li><a href=\"#\">Profile</a></li>
					<li><a href=\"#\">Settings</a></li>
					<li><a class=\"logout\" href=\"".site_url('dashboard/logout')."\">Logout</a></li>
				</ul>";
    
    		$data['access_uri'] = "<div class=\"secondary-navigation\">
					<ul class=\"wat-cf\">
						<li ><a href=\"".site_url('dashboard')."\">Dashboard</a></li>
						<li class=\"active\"><a href=\"".site_url('employees')."\">Employees</a></li>
						<li><a href=\"".site_url('leave')."\">leave</a></li>
						<li><a href=\"".site_url('travel')."\">Travels</a></li>
						<li><a href=\"".site_url('benefit')."\">Benefits</a></li>
						<li><a href=\"".site_url('training')."\">Training</a></li>
						<li><a href=\"".site_url('task')."\">Task</a></li>
						<li><a href=\"".site_url('report')."\">Reports</a></li>
					</ul>
				</div>";
    
    		$data['additional_js'] = '';
    
    		$data['success'] = 'Employee Successfully Added';
    
    		$this->load->view('success.php',$data);
    		$this->load->view('partial/footer_page.php');
    			
    
    
    	}
    }
    
    
    public function search_employee(){
    
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
						<li class=\"active\"><a href=\"".site_url('employees')."\">Employees</a></li>
						<li><a href=\"".site_url('leave')."\">leave</a></li>
						<li><a href=\"".site_url('travel')."\">Travels</a></li>
						<li><a href=\"".site_url('benefit')."\">Benefits</a></li>
						<li><a href=\"".site_url('training')."\">Training</a></li>
						<li><a href=\"".site_url('task')."\">Task</a></li>
						<li><a href=\"".site_url('report')."\">Reports</a></li>
					</ul>
				</div>";
    
    		$data['additional_js'] = '';
    
    		$search = $this->input->post('search');
    
    		$data['query'] = $this->members->search_employee($search);
    
    
    		$data['error'] = '';
    
    		$data['pagination'] = '';
    
    		$this->load->view('employees/employees.php',$data);
    
    
    	}
    }
    
    
    public function view_employee($employee_id){
    
    	$data['id'] = $employee_id = $this->uri->segment(3);
    
    	$username = $this->session->userdata('username');
    
    	if($username == NULL || !$username){
    		$this->session->sess_destroy();
    		redirect('home');
    	}
    	else{
    		//echo $username;
    		$data['title'] = 'HRMS(Human Resource Management System) : Employees Profile';
    
    		$data['header_nav'] = "<ul class=\"wat-cf\">
					<li><a href=\"#\">Profile</a></li>
					<li><a href=\"#\">Settings</a></li>
					<li><a class=\"logout\" href=\"".site_url('dashboard/logout')."\">Logout</a></li>
				</ul>";
    
    		$data['access_uri'] = "<div class=\"secondary-navigation\">
					<ul class=\"wat-cf\">
						<li ><a href=\"".site_url('dashboard')."\">Dashboard</a></li>
						<li class=\"active\"><a href=\"".site_url('employees')."\">Employees</a></li>
						<li><a href=\"".site_url('leave')."\">leave</a></li>
						<li><a href=\"".site_url('travel')."\">Travels</a></li>
						<li><a href=\"".site_url('benefit')."\">Benefits</a></li>
						<li><a href=\"".site_url('training')."\">Training</a></li>
						<li><a href=\"".site_url('task')."\">Task</a></li>
						<li><a href=\"".site_url('report')."\">Reports</a></li>
					</ul>
				</div>";
    
    		$data['additional_js'] = '';
    
    
    
    		$employee_first_name = $this->members->get('first_name',array('employee_id'=>$employee_id),'employees');
    		$employee_last_name = $this->members->get('last_name',array('employee_id'=>$employee_id),'employees');
		$department_name = $this->members->get('department_id',array('employee_id'=>$employee_id),'employees');
    
    		$data['employee_name'] = $employee_first_name.' '.$employee_last_name;
    		$data['email'] = $this->members->get('email',array('employee_id'=>$employee_id),'employees');
    		$data['phone'] = $this->members->get('phone_number',array('employee_id'=>$employee_id),'employees');
    		$data['address']  = $this->members->get('contact_address',array('employee_id'=>$employee_id),'employees');
    		$data['department'] = $this->members->get('department_name',array('department_id'=>$department_name),'departments');
    		$data['position'] = $this->members->get('position',array('employee_id'=>$employee_id),'employees');
    		$data['status'] = $this->members->get('contract_type',array('employee_id'=>$employee_id),'employees');
    		$data['benefit'] = $this->members->get_employee_benefit($employee_id);
    		$data['resumption'] = date("F d, Y", strtotime($this->members->get('date_added',array('employee_id'=>$employee_id),'employees')));
    
    		$this->load->view('employees/profile.php',$data);
    
    	}
    }
     
    public function delete_employee($employee_id){
    
    	$employee_id = $this->uri->segment(3);
    
    	$username = $this->session->userdata('username');
    
    	if($username == NULL || !$username){
    		$this->session->sess_destroy();
    		redirect('home');
    	}
    		
    	else{
    		$this->general->delete_entry('employees',array('employee_id'=>$employee_id));
    		redirect('employees');
    
    	}
    }
     
    public function edit_employee($employee_id){
    
    	//$employee_id = $this->uri->segment(3);
    
    	$username = $this->session->userdata('username');
    
    	if($username == NULL || !$username){
    		$this->session->sess_destroy();
    		redirect('home');
    	}
    
    	else{
    
    		$data['title'] = 'HRMS(Human Resource Management System) : Edit Profile';
    
    		$data['header_nav'] = "<ul class=\"wat-cf\">
						<li><a href=\"#\">Profile</a></li>
						<li><a href=\"#\">Settings</a></li>
						<li><a class=\"logout\" href=\"".site_url('dashboard/logout')."\">Logout</a></li>
					</ul>";
    			
    		$data['access_uri'] = "<div class=\"secondary-navigation\">
						<ul class=\"wat-cf\">
							<li ><a href=\"".site_url('dashboard')."\">Dashboard</a></li>
							<li class=\"active\"><a href=\"".site_url('employees')."\">Employees</a></li>
							<li><a href=\"".site_url('leave')."\">leave</a></li>
							<li><a href=\"".site_url('travel')."\">Travels</a></li>
							<li><a href=\"".site_url('benefit')."\">Benefits</a></li>
							<li><a href=\"".site_url('training')."\">Training</a></li>
							<li><a href=\"".site_url('task')."\">Task</a></li>
							<li><a href=\"".site_url('report')."\">Reports</a></li>
						</ul>
					</div>";
    			
    		$data['additional_js'] = '';
    
    		$data['error'] = '';
    		$this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean|trim');
    		$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean|trim');
    		$this->form_validation->set_rules('fone', 'Phone Number', 'required|xss_clean|trim');
    		//$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
    		$this->form_validation->set_rules('position', 'Job Position', 'required|xss_clean|trim');
    
    		if($this->form_validation->run() == FALSE){
    
    			$data['error'] = validation_errors();
    			//$this->load->view('employees/add_employee.php',$data);
    
    
    			$employee_id = $data['id'] = $this->uri->segment(3);
    			$data['fname'] = $data['first_name']  = $this->members->get('first_name',array('employee_id'=>$employee_id),'employees');
    			$data['lname'] = $data['last_name'] =  $this->members->get('last_name',array('employee_id'=>$employee_id),'employees');
    			//$data['email_address'] = $this->members->get('email',array('employee_id'=>$employee_id),'employees');
    			$data['fone'] = $this->members->get('phone_number',array('employee_id'=>$employee_id),'employees');
    			$data['address'] = $this->members->get('contact_address',array('employee_id'=>$employee_id),'employees');
    			$data['position'] = $this->members->get('position',array('employee_id'=>$employee_id),'employees');
    				
    			$this->load->view('employees/edit_employee.php',$data);
    		}
    
    		else{
    				
    			$fname = $this->input->post('fname');
    			$lname = $this->input->post('lname');
    			//$email = $this->input->post('email');
    			$fone = $this->input->post('fone');
    			$contact = $this->input->post('contact_address');
    			$position = $this->input->post('position');
    				
    			$param_array = array(
    					'first_name'=>$fname,
    					'last_name'=>$lname,
    					//'email'=>$email,
    					'phone_number'=>$fone,
    					'contact_address'=>$contact,
    					'position'=>$position,
    					'last_updated'=>date('Y-m-d : h:i:s',time())
    			);
    				
    			$this->general->update_entry('employees',array('employee_id'=>$employee_id),$param_array);
    			redirect('employees/edit_success');
    				
    				
    		}
    
    			
    			
    	}
    
    
    }
     
    public function edit_success(){
    
    	$username = $this->session->userdata('username');
    
    	if($username == NULL || !$username){
    		$this->session->sess_destroy();
    		redirect('home');
    	}
    	else{
    		//echo $username;
    		$data['title'] = 'HRMS(Human Resource Management System) : Success';
    
    		$data['header_nav'] = "<ul class=\"wat-cf\">
					<li><a href=\"#\">Profile</a></li>
					<li><a href=\"#\">Settings</a></li>
					<li><a class=\"logout\" href=\"".site_url('dashboard/logout')."\">Logout</a></li>
				</ul>";
    
    		$data['access_uri'] = "<div class=\"secondary-navigation\">
					<ul class=\"wat-cf\">
						<li ><a href=\"".site_url('dashboard')."\">Dashboard</a></li>
						<li class=\"active\"><a href=\"".site_url('employees')."\">Employees</a></li>
						<li><a href=\"".site_url('leave')."\">leave</a></li>
						<li><a href=\"".site_url('travel')."\">Travels</a></li>
						<li><a href=\"".site_url('benefit')."\">Benefits</a></li>
						<li><a href=\"".site_url('training')."\">Training</a></li>
						<li><a href=\"".site_url('task')."\">Task</a></li>
						<li><a href=\"".site_url('report')."\">Reports</a></li>
					</ul>
				</div>";
    
    		$data['additional_js'] = '';
    
    		$data['success'] = 'Employee Successfully Updated';
    
    		$this->load->view('success.php',$data);
    		//$this->load->view('partial/footer_page.php');
    			
    
    
    	}
    }
    
    
     
    
    
    public function check_email($email){
    
    	if($this->members->is_exist('employees',array('email'=>$email))){
    
    		$this->form_validation->set_message('check_email','This Email Address has already been used');
    		return false;
    	}
    	else{
    		return true;
    	}
    
    
    }
     
    
    
     
    
    public function logout(){
    
    	$this->session->sess_destroy();
    	redirect('home');
    	 
    }
    
     
 }
 ?>
        
       