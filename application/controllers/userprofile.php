<?php

class userprofile extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model(array('students', 'general'));
        
        
    }
    
    
         public function _remap($method, $params = array())
        {            
            if(method_exists($this, $method))
            {               
                if(!$this->session->userdata('id'))
                {
                    $this->session->sess_destroy();
                    redirect('access');
                }
                
                return call_user_func_array(array($this, $method), $params);
            }
            
            show_404();
        }

    
    
    
    function index(){
        
                    
                    #$id = $this->uri->segment(3);
                    $id = $this->session->userdata('id');
                    
            $this->form_validation->set_rules('surname', 'Your SurName', 'required|xss_clean|trim');
            #$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|trim|valid_email');
            #$this->form_validation->set_rules('phone_number', 'Phone', 'required|xss_clean|trim');
            #$this->form_validation->set_rules('fellowship', 'Fellowship', 'required|xss_clean|trim');
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
                $data['sex'] = $get_mem_info['sex'];
                $data['month'] = $get_mem_info['month'];
                $data['date_of_birth'] = $get_mem_info['date_of_birth'];
                $data['email'] = $get_mem_info['email'];
                $data['phone_number'] = $get_mem_info['phone_number'];
                $data['marital_status'] = $get_mem_info['marital_status'];
                $data['department'] = $get_mem_info['department'];
                $data['society'] = $get_mem_info['society'];
                $data['fellowship_center'] = $get_mem_info['fellowship_center'];
                $data['fellowship'] = $get_mem_info['fellowship'];
                $data['state'] = $get_mem_info['state'];
                $data['occupation'] = $get_mem_info['occupation'];
                $data['baptised'] = $get_mem_info['baptised'];
                $data['discipled'] = $get_mem_info['discipled'];
                $data['area_of_interest'] = $get_mem_info['area_of_interest'];
                $data['contact_address'] = $get_mem_info['contact_address'];
                
                $data['error'] = validation_errors();
                $this->load->view('userprofile', $data);
                
            }
             
            else
            {
              
                
		    #$file_name = $this->upload->file_name;
                #$mem_id = $this->students->get('id',array('username' => 'samuel'), 'churches');
                
                $mem_info = array(
                                  'title' => $this->input->post('title'),
                                'surname' => $this->input->post('surname'),
                                'first_name' => $this->input->post('first_name'),
                                'other_names' => $this->input->post('other_names'),
                                'sex' => $this->input->post('sex'),
                                'month' => $this->input->post('month'),
                                'date_of_birth' => $this->input->post('date_of_birth'),
                                'email' => $this->input->post('email'),
                                'phone_number' => $this->input->post('phone_number'),
                                'marital_status' => $this->input->post('marital_status'),
                                'department' => $this->input->post('department'),
                                'society' => $this->input->post('society'),
                                 'fellowship_center' => $this->input->post('fellowship_center'),
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
                redirect('userprofile/edit');
            }

        }
   
   
   function edit(){
            
            $this->load->model('students');
	    $id = $this->session->userdata('id');
	    
	    #$id = $this->uri->segment(3);
            
            $data = $this->students->get_student_basic_info($id);
            
            $this->load->view('display',$data);
        }
        
        
        
        function member_picture_upload(){
            
            $mem_id = $this->session->userdata('id');
             
            if(($mem_id == NULL) ||  (!$this->session->userdata('id'))) 
			{
				$this->session->sess_destroy();
				redirect('access');
			}
             
             
             $this->load->library('images');
             //uploading configuration
	     $config['upload_path'] = './folders/images/member_data/';
	     $config['allowed_types'] = 'jpg|gif|png';
	     $config['max_size'] = '3000';
             
             if(!$this->students->is_default_pix($mem_id))//check if the artist is having no picture in uploaded yet(still using default)
		    $config['file_name'] = substr($this->students->member_thumb_pix($mem_id,MINI_THUMB_TYPE), 0, -4);
                    
             else
             $config['file_name'] = time();
                        
             $this->load->library('upload', $config);
             
             if($this->input->post('submit')){
                
                if(!$this->upload->do_upload()){
                    #echo "goog";
                    $data['error'] = $this->upload->display_errors();
                    
                    $this->load->view('member_picture_upload', $data);
                
             }
             else{
                if(!$this->students->is_default_pix($mem_id) && get_file_info(set_realpath('./folders/images/member_data/').$this->students->member_thumb_pix($mem_id, MINI_THUMB_TYPE), 'name'))
                
                {
                
                @unlink(set_realpath('./folders/images/member_data/').$this->students->member_thumb_pix($mem_id, MINI_THUMB_TYPE)); //deleting the main picture
		@unlink(set_realpath('./folders/images/member_data/members_thumb/').$this->students->member_thumb_pix($mem_id, MEDIUM_THUMB_TYPE)); //deleting the thumb picture
		@unlink(set_realpath('./folders/images/member_data/members_thumb/').$this->students->member_thumb_pix($mem_id,MINI_THUMB_TYPE)); //deleting the thumb picture
                
                }
                
                /*********************create thumb nails*****************/
		$this->images->squareThumb($this->upload->upload_path.$this->upload->file_name, $this->upload->upload_path. 'members_thumb/'.str_replace('.', '_thumb.', $this->upload->file_name), 56);
					
		$this->image_lib->clear();
                
                /*********************create smallest image*****************/
		$this->images->squareThumb($this->upload->upload_path.$this->upload->file_name, $this->upload->upload_path. 'members_thumb/'.$this->upload->file_name, 38);
					
		$this->image_lib->clear();
                
                ///****************resize image*********************/
		$this->images->resize($this->upload->upload_path.$this->upload->file_name, 170, 165, $this->upload->upload_path.$this->upload->file_name, "width");
					
		$this->image_lib->clear();
                
                //filename
		$file_name = $this->upload->file_name;
                
                if(get_file_info($this->upload->upload_path.$file_name, 'name'))
		{
                
                    $this->crud->use_table('churches');
		    $this->crud->update(array('id' => $mem_id),array('userfile' => $file_name));
                    
                    #$data['error'] = "here!";
                    #$this->load->view('member_picture_upload',$data);
						
		    redirect('userprofile');
                }
                else
		{
		    $data['error'] = "Something went wrong, please try uploading again!";
                    $this->load->view('member_picture_upload', $data);
		}
		
             }
             }
             else
		    {
			$this->load->view('member_picture_upload');
                        
		    }
                        
                        #$this->load->view('member_picture_upload');
					
        }
                
             
                        
                        
                
              #$this->load->view('member_picture_upload');      
            
            
            
        
        
        
        function logout()
        {
            $this->session->sess_destroy();
            redirect('access');           
        }
	
    
    
    
    
    
        
        }    
        
        
        
    
    
    

?>