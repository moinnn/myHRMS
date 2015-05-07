<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Login extends CI_Controller
    {		
            public function __construct()
            {
                parent::__construct();
                
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->load->model('members');
            }
            
            function index()
            {
                //header dynamic variables
                $data['title'] = 'GreenlightVest - SignUp Page';
	
                $data['access_uri'] = "<ul>
					<li><a href=\"#\">About</a></li>
					<li><a href=\"".site_url('login')."\">Sign In</a></li>
					<li><a href=\"".site_url('signup')."\">Sign Up</a></li>
					<li><a href=\"".site_url('project')."\">Support A Project</a></li>
					<li class=\"active\"><a href=\"#\">Start Project</a></li>
				</ul>";
	
	
                $banner_title = 'SignIn';
	
                $data['header'] = 'Login Page';
        
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
                
                $this->form_validation->set_rules('username', 'Email Address', 'valid_email|required|xss_clean|trim');
                $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim|md5');
                
                if($this->form_validation->run() == FALSE)
                {
                    $data['error'] = validation_errors();
                    $this->load->view('login', $data);
                }
                else
                {
                        $uname = $this->input->post('username');
                        $password = $this->input->post('password');
                        
                        //redirect to members page
                        if($this->members->is_exist('mem_info', array('email_ad' => $uname, 'password' => $password)))
                        {
                            $mem_id = $this->members->get('mem_id', array('email_ad' => $uname), 'mem_info');
                            
                            $mem_info = $this->members->get_member_basic_info($mem_id);
                            
                            $this->session->set_userdata(array('mem_id' => $mem_id, 'mem_name' => $mem_info['sname'], 'mem_email' => $mem_info['email_ad']));
                            
                            if($this->members->verified($mem_id))
                                    redirect('home');
                            else
                                    redirect('signup/verification');
                        }
                        else
                        {
                            $data['error'] = "Wrong username or password!";
                            $this->load->view('login', $data);
                        }
                }			
            }
            

    } // End Home