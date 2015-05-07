<?php

class signup extends CI_Controller{
    
    public function __construct(){
        parent:: __construct();
        $this->load->helper('form');
	$this->load->library('form_validation');
	$this->load->helper('captcha');
	$this->load->model(array('students','members'));
    }
    
    
    function index(){
        
        $data['title'] = 'GreenlightVest - SignUp Page';
	
	$data['access_uri'] = "<ul>
					<li><a href=\"#\">About</a></li>
					<li><a href=\"".site_url('login')."\">Sign In</a></li>
					<li><a href=\"".site_url('signup')."\">Sign Up</a></li>
					<li><a href=\"".site_url('project/all')."\">Support A Project</a></li>
					<li class=\"active\"><a href=\"".site_url('project')."\">Start Project</a></li>
				</ul>";
	
	
	$banner_title = 'SignUp';
	
	$data['header'] = 'Registration Page';
	
	$data['additional_js'] = '';
	
	$data['site_banner'] = "<div class=\"greenBg smallBanner\">
					<div class=\"container_16\">
					<div class=\" grid_10\"><h2>".$banner_title."</h2>
					 <p>m dolor sit amet, consectetur adipiscing elit.Phasellus sed cursus erat. Aliquam tristique ligula sit amet dolor Lore</p>
				</div>
				</div></div>";
				
	$data['content'] = "<div class=\" grid_4 sticky\">
					<div class=\"stickyInner\"><h2>Project Categories</h2>
						<ul>
							<li><a href=\"#\">Art</a></li>
							<li><a href=\"#\">Culture</a></li>
							<li><a href=\"#\">Education</a></li>
							<li><a href=\"#\">Music</a></li>
							<li><a href=\"#\">Movies</a></li>
							<li><a href=\"#\">Humanity</a></li>
						</ul>
					</div>
				</div>";
        
        $this->session->sess_destroy();
        
        //Set Validation Rules;
        $this->form_validation->set_rules('surname', 'Your Surname', 'required|xss_clean|trim');
        $this->form_validation->set_rules('phone', 'Your Phone Number', 'required|xss_clean|trim');
        #$this->form_validation->set_rules('uname', 'A Usename', 'required|xss_clean|trim|callback_check_user');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|trim|callback_check_email');
        $this->form_validation->set_rules('pass', 'A Password', 'required|xss_clean|trim');
        $this->form_validation->set_rules('cpass', 'Password Confirmation', 'required|xss_clean|matches[pass]');
        $this->form_validation->set_rules('captcha', 'Verification', 'xss_clean|required|callback_check_captcha');
        
        
	// Upload Configuration
				/*$config['upload_path'] = 'folders/images/member_data';
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] = 3000;
				$config['file_name'] = '';
				
				$this->load->library('upload', $config);*/
	
        
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
		    
		    #$this->load->library('images');
		    #$this->load->helper('file');
			
		    #$this->images->resize($this->upload->upload_path.$this->upload->file_name, 200, 200, $this->upload->upload_path.$this->upload->file_name);
		    #$file_name = $this->upload->file_name;
                    #$this->load->view('signup');
                    $sname = $this->input->post('surname');
                    $fname = $this->input->post('fname');
		    $sex = $this->input->post('sex');
		    $contact_address = $this->input->post('contact_address');
		    $state = $this->input->post('state');
		    $country = $this->input->post('country');
		    $phone = $this->input->post('phone');
		    $email = $this->input->post('email');
		    $pass = $this->input->post('pass');
		    $verification_code = random_string('alnum', 10);
                    
                    $this->load->helper('string');
                    
		    
                    $param = array(
			'fname' => $fname,
                        'sname' => $sname,
                        'sex' => $sex,
                        'email_ad' => $email,
			'mobile_num' => $phone,
			'city' => $state,
			'country' => $country,
                        'password' => md5($pass),
			'status' => 'no',
			'verification_code' => $verification_code,
			'date_created' => date('Y-m-d')
                        #'status' => DISABLED
                    );
                    
                  // 
				////insert into members info table
				$this->members->insert_entry('mem_info', $param);
				//
				//get inserted auto created id
				$mem_id = $this->members->get_insert_id();
				//
				////set session for auto login
				$this->session->set_userdata(array('mem_id' => $mem_id, 'mem_name' => $sname, 'fname' => $fname, 'email' => $email));
				//
				////send mail
				$this->load->model('correspondence');
				$this->correspondence->email_notification($email, ucwords(strtolower($sname)), VERIFICATION, $verification_code);
				//
				redirect('signup/verification');
                    
                    
                
    }
        
    
    }
    
		
		
	function verification()
		{
			$this->load->helper('security');
			$this->load->helper('email');
			
			$mem_id = $this->session->userdata('mem_id');
			$mem_name = $this->session->userdata('mem_name');
			
			//header dynamic variables
			$data['title'] = "Verification ";
			$data['access_uri'] = "<ul>
					<li><a href=\"#\">About</a></li>
					<li><a href=\"".site_url('login')."\">Sign In</a></li>
					<li><a href=\"".site_url('signup')."\">Sign Up</a></li>
					<li><a href=\"#\">Support A Project</a></li>
					<li class=\"active\"><a href=\"#\">Start Project</a></li>
				</ul>";
	
	
			$banner_title = 'Verification';
	
			$data['header'] = 'Registration Page';
	
			$data['site_banner'] = "<div class=\"greenBg smallBanner\">
							<div class=\"container_16\">
							<div class=\" grid_10\"><h2>".$banner_title."</h2>
							 <p>m dolor sit amet, consectetur adipiscing elit.Phasellus sed cursus erat. Aliquam tristique ligula sit amet dolor Lore</p>
						</div>
						</div></div>";
						
			$data['additional_js'] = "";
			
			$data['error'] = $data['rerror'] = "";
			
			//check if artist is logged in
			if(($mem_id == NULL) || ($mem_id == '') || $this->members->verified($mem_id))
			{
				$this->session->sess_destroy();
				redirect('login');
			}
			
			if($this->input->post('resend'))
			{
				if(valid_email(xss_clean($this->input->post('email_verification_code'))))
				{
					$email_ad = $this->input->post('email_verification_code');
					
					if($this->members->get('email_ad', array('mem_id' => $mem_id), 'mem_info') == $email_ad)
					{
						$verification_code = $this->members->get('verification_code', array('mem_id' => $mem_id), 'mem_info');
						
						//send mail
						$this->load->model('correspondence');
						$this->correspondence->email_notification($email_ad, ucwords(strtolower($mem_name)), VERIFICATION, $verification_code);
						
						$data['rerror'] = $mem_name.", We have just sent your verification code, check your mail box or sometimes spam.";
					}
					else
						$data['rerror'] = "The email address is not the same with what you registered with.";
				}
				else
					$data['rerror'] = "Your email address is in-valid";
			}
			
			
			$this->form_validation->set_rules('verification_code', 'Verification Code', 'required|xss_clean|trim|alpha_numeric|callback_check_verification|exact_length[10]');
			
			if($this->form_validation->run() == FALSE)
			{
				if(!$this->input->post('resend')) $data['error'] = validation_errors();
				$this->load->view('verification', $data);
			}
			else
			{
				$mem_info = $this->members->get_member_basic_info($mem_id);
				//
				foreach($mem_info as $value)
				{
					$sname = $value['sname'];
					$email_ad = $value['email_ad'];
				}
				//	
				$this->session->set_userdata(array('mem_id' => $mem_id,
								   'mem_name' => $mem_name));
				//
				$this->members->update_entry($mem_id, array('status' => ENABLED));
					
				////send mail
				$this->load->model('correspondence');
				$this->correspondence->email_notification($email_ad, ucwords(strtolower($sname)), REGISTRATION);
					
				//redirect to members page
				redirect('home');
					
				
			}
	
		}
    
    
            
            
            
            
            
            
    
            function check_email($email)
		{
			if($this->members->is_exist('mem_info', array('email_ad' => $email)))
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
		    $mem_id = $this->session->userdata('mem_id');
		    
		    if(!$this->members->is_exist('mem_info', array('mem_id' => $mem_id, 'verification_code' => $verification_code)))
			{
				$this->form_validation->set_message('check_verification', 'Sorry you have a wrong verification code!');
				return false;
			}			
				
			return true;	
		}
		
		
    
        
        
    
}




?>