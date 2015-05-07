<?php
class change_password extends CI_Controller{
    
    function __construct()
		{
			parent::__construct();

			#$this->load->model('jamz');
			#$this->load->model('artistmodel');
			$this->load->model(array('members', 'crud'));
			$this->load->helper('form');
                        $this->load->library('form_validation');
			#$this->load->model('crud');
			#$this->load->library('pagination');
		}
                
                
                
    public function index(){
        
        $mem_id = $this->session->userdata('id'); 
        
        if($this->input->post('submit'))
	    {
		$this->form_validation->set_rules('o_password', 'Old Password', 'required|xss_clean|trim|callback_password_check');
		$this->form_validation->set_rules('n_password', 'New Password', 'required|xss_clean|trim');
		$this->form_validation->set_rules('cn_password', 'Confirm New Password', 'required|xss_clean|trim|matches[n_password]');
			
            if($this->form_validation->run() == FALSE)
			   
             {
                $data['title'] = 'Change Password';
	        #$data['error'] = validation_errors();
                $this->load->view('change_password.php', $data);
             }
		else
		    {
			$npassword = $this->input->post('n_password');		
			$this->crud->use_table('churches');
			$this->crud->update(array('id' => $mem_id), array('password' => $npassword));
							
			#$data['error'] = 'deal';
                        #$this->load->view('change_password', $data);
                        redirect('change_password/success');
		    }
		    }
			$data['title'] = 'Change Password';		
			$this->load->view('change_password.php', $data);
       
    }
    
    function success(){
        
        $this->load->model('students');
        
        $id = $this->session->userdata('id');
    
        $data['title'] = 'Password Success';
        $get_mem_info = $this->students->get_new_password($id);
                
        $data['password'] =  $get_mem_info['password'];
        
        $this->load->view('success', $data);
        
        
        
        
	
					
		    
    }
    
    
    function password_check($str)
		{
			$mem_id = $this->session->userdata('id');
			
			$query = $this->db->get_where('churches', array('id' => $mem_id, 'password' => $str));
			
			$num = $query->num_rows();
			
			if($num <= 0)
			{
				$this->form_validation->set_message('password_check', 'The old password is wrong');
				return FALSE;
			}
			else
				return TRUE;
		}
    
    
    
    
                
                    
}
?>