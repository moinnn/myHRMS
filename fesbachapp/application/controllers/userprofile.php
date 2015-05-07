<?php

class userprofile extends CI_Controller{
    
    public function __construct(){
        parent:: __construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model(array('students', 'general'));
        
    }
   
    
    
    
    
    function index(){
        
                    
                    #$id = $this->uri->segment(3);
                    $id = $this->session->userdata('id');
                    
            $this->form_validation->set_rules('surname', 'Your Name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|trim|valid_email');
            $this->form_validation->set_rules('phone_number', 'Phone', 'required|xss_clean|trim');
            $this->form_validation->set_rules('fellowship', 'Fellowship', 'required|xss_clean|trim');
            #$this->form_validation->set_rules('state', 'State', 'required|xss_clean|trim');
            
            if($this->form_validation->run() == FALSE)
            {
                #$id = $this->uri->segment(4);
                $id = $this->session->userdata('id');
                $get_mem_info = $this->students->get_student_basic_info($id);
                
                $data['userfile'] =  $get_mem_info['userfile'];
                $data['title'] = $get_mem_info['title'];
                $data['surname'] = $get_mem_info['surname'];
                $data['first_name'] = $get_mem_info['first_name'];
                $data['other_names'] = $get_mem_info['other_names'];
                $data['month'] = $get_mem_info['month'];
                $data['date_of_birth'] = $get_mem_info['date_of_birth'];
                $data['email'] = $get_mem_info['email'];
                $data['phone'] = $get_mem_info['phone_number'];
                $data['marital_status'] = $get_mem_info['marital_status'];
                $data['department'] = $get_mem_info['department'];
                $data['society'] = $get_mem_info['society'];
                $data['fellowship'] = $get_mem_info['fellowship'];
                $data['state'] = $get_mem_info['state'];
                $data['occupation'] = $get_mem_info['occupation'];
                $data['baptised'] = $get_mem_info['baptised'];
                $data['discipled'] = $get_mem_info['discipled'];
                $data['area_of_interest'] = $get_mem_info['area_of_interest'];
                $data['contact_address'] = $get_mem_info['contact_address'];
                
                $data['error'] = validation_errors();
                $this->load->view('userprofile', $data);
                $this->session->destroy();
            }
            else
            {
                #$mem_id = $this->students->get('id',array('username' => 'samuel'), 'churches');
                
                $mem_info = array('title' => $this->input->post('title'),
                                'surname' => $this->input->post('surname'),
                                'first_name' => $this->input->post('first_name'),
                                'other_names' => $this->input->post('other_names'),
                                'month' => $this->input->post('month'),
                                'date_of_birth' => $this->input->post('date_of_birth'),
                                'email' => $this->input->post('email'),
                                'phone_number' => $this->input->post('phone_number'),
                                'marital_status' => $this->input->post('marital_status'),
                                'department' => $this->input->post('department'),
                                'society' => $this->input->post('society'),
                                'fellowship' => $this->input->post('fellowship'),
                                'state' => $this->input->post('state'),
                                'occupation' => $this->input->post('occupation'),
                                'baptised' => $this->input->post('baptised'),
                                'discipled' => $this->input->post('discipled'),
                                'area_of_interest' => $this->input->post('aoi'),
                                'contact_address' => $this->input->post('contact_address')
                                );
                                
                
              
                $this->general->update_entry('churches', array('id' => $id), $mem_info);
                #$this->load->view('updated');
                #$this->load->view('userprofile', $query);
                #echo "deal";
                redirect('updated');
            }

        }
        
        
        
    }
    
    

?>