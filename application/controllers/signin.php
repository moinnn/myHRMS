<?php

class signin extends CI_Controller{
    
    public function __construct(){
        parent:: __construct();
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('students');
    }
    
    
    function index(){
        
        $data['title'] = 'SignIn';
        
        $this->session->sess_destroy();
        
        $this->form_validation->set_rules('username', 'Email Address', 'required|trim|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Your Password', 'required|trim|xss_clean');
        
        if($this->form_validation->run() == FALSE){
            
            $data['error'] = validation_error();
            $this->load->view('signin', $data);
        }
        
        else{
            
            $uname = $this->input->post('username');
            $password = $this->input->post('password');
            
            if ($this->students->is_exist('churches', array('email' => $uname, 'password' => $password)))
            {
                
                $stud_id = $this->students->get('id', array('email' => $uname), 'churches' );
                
                $stud_info = $this->students->get_student_basic_info($stud_id);
                
                $this->session->set_userdata(array('stud_id' => $stud_id, 'stud_info' => $stud_info['surname']));
                
                 if($this->students->verified($id))
                                
                    redirect('homepage');
                    else
                    redirect('signup/confirmation');
                
            }
            
            else{
                $data['error'] = 'Wrong Username and Password';
                $this->load->view('signin', $data);
            }
            
        }
        
    }
    
    
}

?>