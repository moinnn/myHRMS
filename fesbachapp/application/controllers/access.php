<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class access extends CI_Controller
    {		
            public function __construct()
            {
                parent::__construct();
                
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->load->model('students');
                #$this->output->enable_profiler(TRUE);
            }
            
            function index()
            {
                //header dynamic variables
                $data['title'] = "Login";
                $data['additional_js'] = "";
                $data['error'] = "";
		$data['header'] = "Fesbach||Login Page";
                
                #$this->session->sess_destroy();
                
                $this->form_validation->set_rules('username', 'Username', 'required|xss_clean|trim');
                $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim');
                
                if($this->form_validation->run() == FALSE)
                {
                    $data['error'] = validation_errors();
                    $this->load->view('signin', $data);
                }
                else
                {
                        $uname = $this->input->post('username');
                        $password = $this->input->post('password');
                        
                $data['query'] = $this->students->is_exist('churches', array('username' => $uname, 'password' => $password));
                
                
		if (empty($data['query']))
                {
						
		    $data['error'] = "Wrong username or password!";
                    
                     $this->load->view('signin', $data);
                    # $this->session->destroy();
                     
		    }
                    
		    else
                    {
			#$data['query'] = $this->register_model->view_user();    
                        #//redirect to members page
                        $mem_id = $this->students->get('id', array('username' => $uname), 'churches');
                        $data = $this->students->get_student_basic_info($mem_id);
                          $this->session->set_userdata(array('id' => $mem_id, 'surname' => $data['surname']));
                        $this->load->view('userprofile', $data);
                        #redirect('userprofile');
		       
                      
                            
                        
                }			
            }
            }      

    } // End Home