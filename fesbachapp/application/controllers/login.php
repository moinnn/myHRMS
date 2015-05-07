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
                $data['title'] = "Login";
                $data['additional_js'] = "";
                $data['error'] = "";
                
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
                        if($this->members->is_exist('member_info', array('email_ad' => $uname, 'password' => $password)))
                        {
                            $mem_id = $this->members->get('mem_id', array('email_ad' => $uname), 'member_info');
                            
                            $mem_info = $this->members->get_member_basic_info($mem_id);
                            
                            $this->session->set_userdata(array('mem_id' => $mem_id, 'mem_name' => $mem_info['yname']));
                            
                            if($this->members->verified($mem_id))
                                    redirect('home');
                            else
                                    redirect('register/verification');
                        }
                        else
                        {
                            $data['error'] = "Wrong username or password!";
                            $this->load->view('login', $data);
                        }
                }			
            }
            

    } // End Home