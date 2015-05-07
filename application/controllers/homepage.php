<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Homepage extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('general');
            $this->load->model('members');
            $this->load->model('students');
             $id = $this->session->userdata('id');
        }
        
        
        
        
        public function index(){
             $id = $this->session->userdata('id');
            $data['title'] = "User Page";
            $data['header'] = "Fesbach||User Page";
            $data['first_name'] = $this->session->userdata('surname');
            $data['menu'] = "<ul>
                                    <li ><a href=".site_url('homepage').">Dashboard</a></span></li>                                    
                                    <li ><a href=".site_url('home/book')." class=\"active\">Book</a></li>
                                    <li ><a href=".site_url('home/transaction').">Transaction History</a></li>
                                    <li ><a href=".site_url('homepage/userprofile').">Profile</a></li>
                                </ul>";
                                    
            
               $this->load->view('home_page.php', $data);
            
            
        }
        
        
     
        public function userprofile($id){
            
                 
            
              $data['title'] = "Profile";
                    
              $data['header'] = "Fesbach||Profile Page";
              
              #$data['first_name'] = $this->session->userdata('surname');
             /*$data['menu'] = "<ul>
                                    <li ><a href=".site_url('homepage').">Dashboard</a></span></li>                                    
                                    <li ><a href=".site_url('home/book')." class=\"active\">Book</a></li>
                                    <li ><a href=".site_url('home/transaction').">Transaction History</a></li>
                                    <li ><a href=".site_url('homepage/userprofile').">Profile</a></li>
                                </ul>";*/
                
                    #$id = $this->uri->segment(3);
                   
                    
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
                
                $data['surname'] = $get_mem_info['surname'];
                $data['email'] = $get_mem_info['email'];
                $data['phone'] = $get_mem_info['phone_number'];
                $data['fellowship'] = $get_mem_info['fellowship'];
                #$data['state'] = $get_mem_info['state'];
                
                $data['error'] = validation_errors();
                $this->load->view('userprofile', $data);
                $this->session->destroy();
            }
            else
            {
                #$mem_id = $this->students->get('id',array('username' => 'samuel'), 'churches');
                
                $mem_info = array('surname' => $this->input->post('surname'),
                                'email' => $this->input->post('email'),
                                'phone_number' => $this->input->post('phone_number'),
                                'fellowship' => $this->input->post('fellowship')
                                );
                                #'state' => $this->input->post('state'));
                
              
                $this->general->update_entry('churches', array('id' => $id), $mem_info);
             $this->load->view('updated');
                #$this->load->view('userprofile', $query);
                #echo "deal";
                #redirect('home/success');
            }

            
            
            
            
            
            
            
            
            
        }
        
        
        
    }
?>

