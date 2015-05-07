<?php

class signup extends CI_Controller{
    
    public function __construct(){
        parent:: __construct();
        $this->load->helper('form');
	$this->load->library('form_validation');
	$this->load->helper('captcha');
	$this->load->model('students');
    }
    
    
    function index(){
        
        $data['title'] = 'Fesbach  || Registration Page';
	
	$data['header'] = 'Registration Page';
        
        $this->session->sess_destroy();
        
        //Set Validation Rules;
        $this->form_validation->set_rules('sname', 'Your Surname', 'required|xss_clean|trim');
        #$this->form_validation->set_rules('phone', 'Your Phone Number', 'required|xss_clean|trim');
        $this->form_validation->set_rules('uname', 'A Usename', 'required|xss_clean|trim|callback_check_user');
        #$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|trim|callback_check_email');
        $this->form_validation->set_rules('pass', 'A Password', 'required|xss_clean|trim');
        $this->form_validation->set_rules('cpass', 'Password Confirmation', 'required|xss_clean|matches[pass]');
        #$this->form_validation->set_rules('captcha', 'Verification', 'xss_clean|required|callback_check_captcha');
        
        
	// Upload Configuration
				$config['upload_path'] = 'folders/images/member_data';
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] = 250;
				$config['file_name'] = time();
				
				$this->load->library('upload', $config);
	
        
        $vals = array(
				'word' 		 => sprintf("%04d",abs(mt_rand(1000,9999))),
				'img_path'	 => './captcha/',
				'img_url'	 => base_url().'captcha/',
				'img_width'	 => '200',
				'img_height' => 30,
				'expiration' => 3600
			);
                
                $cap = create_captcha($vals);
                
                #$this->session->set_userdata(array('cap_word' => $cap[cap_word]));
                
                $data['cap_img'] = $cap['image'];
		$data['cap_word'] = $cap['word'];
                
                if($this->form_validation->run() == FALSE)
			{
			    $data['error'] = validation_errors();
			    $this->load->view('signup', $data);
			}
			
			
                else{
		    if (!$this->upload->do_upload()){
		
			$data['error'] = $this->upload->display_errors();
			$this->load->view('signup', $data);
		}
		else{
		    
		    $this->load->library('images');
		    $this->load->helper('file');
			
		    $this->images->resize($this->upload->upload_path.$this->upload->file_name, 200, 200, $this->upload->upload_path.$this->upload->file_name);
		    $file_name = $this->upload->file_name;
                    #$this->load->view('signup');
                    $title = $this->input->post('title');
                    $sname = $this->input->post('sname');
                    $fname = $this->input->post('fname');
                    $oname = $this->input->post('oname');
		    $month_of_birth = $this->input->post('month');
		    $dob = $this->input->post('dob');
                    $phone = $this->input->post('phone');
                    $state = $this->input->post('state');
                    $fellowship = $this->input->post('fellowship');
                    $occupation = $this->input->post('occupation');
		    $baptised = $this->input->post('baptised');
		    $discipled = $this->input->post('discipled');
		    $aoi = $this->input->post('aoi');
		    $marital_status = $this->input->post('marital_status');
		    $contact_address = $this->input->post('contact_address');
		    $department = $this->input->post('department');
		    $society = $this->input->post('society');
		    $file_name = $this->upload->file_name;
                    $email = $this->input->post('email');
                    $uname = $this->input->post('uname');
                    $pass = $this->input->post('pass');
                    $cpass = $this->input->post('cpass');
                    $verification_code = random_string('alnum', 10);
                    
                    $this->load->helper('string');
                    
		    $upload = array(
			'userfile' => $file_name
		    );
		    
                    $param = array(
			'title' => $title,
                        'surname' => $sname,
                        'first_name' => $fname,
                        'other_names' => $oname,
			'month' => $month_of_birth,
			'date_of_birth' => $dob,
                        'phone_number' => $phone,
                        'state' => $state,
                        'fellowship' => $fellowship,
                        'occupation' => $occupation,
			'baptised' => $baptised,
			'discipled' => $discipled,
			'area_of_interest' => $aoi,
			'marital_status' => $marital_status,
			'contact_address' => $contact_address,
			'department' => $department,
			'society' => $society,
			'userfile' => $file_name,
                        'email' => $email,
                        'username' => $uname,
                        'password' => $pass,
                        'conf_password' => $cpass,
			'verification' => $verification_code
                        #'status' => DISABLED
                    );
                    
                    //insert data into table
                    $this->students->insert_entry('churches', $param);
                    
                    
                    //get inserted auto created id
                    $id = $this->students->get_insert_id();
                    
                    ////set session for auto login
		    $this->session->set_userdata(array('id' => $id, 'surname' => $sname));
		    
		    
                    
                    $this->load->model('correspondence');
                    $this->correspondence->email_notify($email, $fname, $uname, $pass);
                    
                    redirect('access');
                    
                    
                
    }
        
    }
    }
    
    
            
            
            
            
            
            
    
            function check_email($email)
		{
			if($this->students->is_exist('churches', array('email' => $email)))
			{
				$this->form_validation->set_message('check_email', 'A member with this email address already exist!');
				return false;
			}			
				
			return true;			
		}
		
		
		function check_user($uname)
		{
			if($this->students->is_exist('churches', array('username' => $uname)))
			{
				$this->form_validation->set_message('check_user', 'A member with this username '.strtoupper($uname).' already exist!');
				return false;
			}			
				
			return true;			
		}
		
		
		
		function check_captcha($captcha)
		{
			if(strtolower($this->input->post('cap_word')) == strtolower($captcha))
				return true;
			
			$this->form_validation->set_message('check_captcha', 'Wrong Validation Code');
			return false;
		}
		
		function check_verification($verification_code){
		    $stud_id = $this->session->userdata('stud_id');
		    
		    if(!$this->members->is_exist('churches', array('stud_id' => $stud_id, 'verification' => $verification_code)))
			{
				$this->form_validation->set_message('check_verification', 'Sorry you have a wrong verification code!');
				return false;
			}			
				
			return true;	
		}
		
		function show()
		{
		    $this->load->model('students');
		    $item = $this->students->get_image();
        
		    Header("Content-type: image/jpeg");
		    echo $item->userfile; 
    }
    
        
        
    
}




?>