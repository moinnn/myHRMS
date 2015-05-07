<?php

class Project extends CI_Controller{
    
    public function __construct()
		{
			parent::__construct();
			
			#$this->load->helper('captcha');
			#$this->load->model('jamz');
			$this->load->library('form_validation');
                        $this->load->helper('form');
			$this->load->model(array('students','members'));
			#$this->load->model('activity');
		}
    
    
    function index(){
        
        $mem_id = $this->session->userdata('mem_id');
        $mem_name = $this->session->userdata('mem_name');
        
        
        $data['title'] =  'Start Project';
        
        $banner_title  =  'Start New Project';
        
        $data['header'] = 'Start Project';
        
        $data['additional_js'] = '<script type="text/javascript" src="'.base_url().'assets/js/calendarDateInput.js"></script>
                                        <script type="text/javascript" src="'.base_url().'assets/js/jquery.timePicker.js"></script>
                                        <script type="text/javascript" src="'.base_url().'assets/js/action.js"></script>
                                        <script language="javascript">
                                            
                                           
                                            
                                            function load_widget(widget_id, loader_id, page_link, target_widget_loader, the_widget_id, resize)
                                            {
                                                $(loader_id).show();
                                                var widget_val = $(widget_id).val();
                                                
                                                $.get("'.site_url('/').'" + page_link, {widget_id_val: widget_val, widget_id: the_widget_id}, function(response) {
                                                    setTimeout("finishAjax(\'" + target_widget_loader + "\', \'"+escape(response)+"\', \'"+ loader_id + "\')", 400);
                                                });
                                            }
                                            
                                            function finishAjax(id, response, loader){
                                              $(loader).hide();
                                              $(id).html(unescape(response));
                                              $(id).fadeIn();
                                            }
                                            
                                        </script>';
        
        $data['error'] = '';
        
        $data['site_banner'] = "<div class=\"greenBg smallBanner\">
					<div class=\"container_16\">
					<div class=\" grid_10\"><h2>".$banner_title."</h2>
					 <p>m dolor sit amet, consectetur adipiscing elit.Phasellus sed cursus erat. Aliquam tristique ligula sit amet dolor Lore</p>
				</div>
				</div></div>";
                            
        $data['content'] = '';
        
        
        $this->form_validation->set_rules('project_title', 'Your Project Title', 'required|xss_clean|trim');
        $this->form_validation->set_rules('project_amount', 'Amount Required', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('project_url', 'URL', 'required|prep_url');
        $this->form_validation->set_rules('project_description', 'Description', 'required|max_length[140]');
                                          
        
        
        
        
        
        
        if($mem_id == NULL || (!$this->session->userdata('mem_id')) || !$this->members->verified($mem_id))
        {
            
            $data['access_uri'] = "<ul>
					<li><a href=\"#\">About</a></li>
					<li><a href=\"".site_url('login')."\">Sign In</a></li>
					<li><a href=\"".site_url('signup')."\">Sign Up</a></li>
					<li><a href=\"".site_url('project')."\">Support A Project</a></li>
					<li class=\"active\"><a href=\"#\">Start Project</a></li>
				</ul>";
                                }
        else
        {
            $data['access_uri'] = "Welcome"." "."<b>".$mem_name."</b>"." "."<a href=\"".site_url('home/logout')."\">Logout</a>";
	}
        
        if($mem_id == NULL || (!$this->session->userdata('mem_id')) || !$this->members->verified($mem_id))
        {
            
                    redirect('login');
            
        }
         else{
             if($this->form_validation->run() == FALSE)
	    {
		$data['error'] = validation_errors();
		$this->load->view('new_project', $data);
	    }
            
            else{
                
                $project_title = $this->input->post('project_title');
                $project_description = $this->input->post('project_description');
                $project_url = $this->input->post('project_url');
                $project_amount = $this->input->post('project_amount');
                $project_category = $this->input->post('project_category');
                $pickupdate = $this->input->post('pickupdate');
                
                $param = array(
                    'mem_id' => $mem_id,
                    'project_title' => $project_title,
                    'project_description' => $project_description,
                    'project_url' => $project_url,
                    'project_amount' => $project_amount,
                    'category' => $project_category,
                    'project_deadline' => date_format(date_create($pickupdate), 'Y-m-d'),
                    'date_added' => date('Y-m-d')
                );
                
                $where_array = array('mem_id' => $mem_id);
                if($this->members->is_exist('projects', $where_array )){
                
                    $data['error'] = 'User Project must not exceed one';
                    $this->load->view('new_project.php', $data);
                }
                
                
                else{
                    
                $this->members->insert_entry('projects', $param);
                
                redirect('project/success');
                }
                
                
            }
            
            #$this->load->view('new_project.php',$data);
         }
         
        
			
        
        
        
       
        #$this->load->view('new_project.php',$data);
        
    }
    
    
    
    function all($offset = ''){
        
        $mem_id = $this->session->userdata('mem_id');
        $mem_name = $this->session->userdata('mem_name');
        $data['id'] = $this->uri->segment(3);
        
        $this->load->library('pagination');
        
        $num_rows = $this->members->get_num_of_projects();
        
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('projects/all');
        $config['total_rows'] = $num_rows;
        $config['per_page'] = '3';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next&gt';
        $config['prev_link'] = '&Previous';
        
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        
        $data['pagination'] = $pagination;
        
        
        $data['title'] =  'Support A Project';
        
        $banner_title  =  'Support A Project';
        
        $data['header'] = 'Support A Project';
        
        $data['additional_js'] = '';
        
        $data['content'] = '';
        
        $data['error'] = '';
        
       
        
         if($mem_id == NULL || (!$this->session->userdata('mem_id')) || !$this->members->verified($mem_id))
         {
            
            $data['access_uri'] = "<ul>
					<li><a href=\"#\">About</a></li>
					<li><a href=\"".site_url('login')."\">Sign In</a></li>
					<li><a href=\"".site_url('signup')."\">Sign Up</a></li>
					<li><a href=\"".site_url('project')."\">Support A Project</a></li>
					<li class=\"active\"><a href=\"#\">Start Project</a></li>
				</ul>";
         }
         
        else
        {
            $data['access_uri'] = "Welcome"." "."<b>".$mem_name."</b>"." "."<a href=\"".site_url('home/logout')."\">Logout</a>";
        }
        
        $data['site_banner'] = "<div class=\"greenBg smallBanner\">
					<div class=\"container_16\">
					<div class=\" grid_10\"><h2>".$banner_title."</h2>
					 <p>m dolor sit amet, consectetur adipiscing elit.Phasellus sed cursus erat. Aliquam tristique ligula sit amet dolor Lore</p>
				</div>
				</div></div>
                                ";
                            
        
        
        $data['query'] = $this->members->get_project_info();
        
        if($mem_id == NULL || (!$this->session->userdata('mem_id')) || !$this->members->verified($mem_id))
        {
            
                    redirect('login');
            
        }
        else{
        
        $this->load->view('projects.php',$data);
        
        }
        
        
    }
    
    function profile(){
        
        $mem_id = $this->session->userdata('mem_id');
        $mem_name = $this->session->userdata('mem_name');
        $id = $this->uri->segment(3);
        
        $data['title'] =  'Project Profile';
        
        $data['header'] = 'Start Project';
        
        $data['additional_js'] = '';
        
        $data['error'] = '';
        
                
        if($mem_id == NULL || (!$this->session->userdata('mem_id')) || !$this->members->verified($mem_id))
         {
            
            $data['access_uri'] = "<ul>
					<li><a href=\"#\">About</a></li>
					<li><a href=\"".site_url('login')."\">Sign In</a></li>
					<li><a href=\"".site_url('signup')."\">Sign Up</a></li>
					<li><a href=\"".site_url('project')."\">Support A Project</a></li>
					<li class=\"active\"><a href=\"#\">Start Project</a></li>
				</ul>";
         }
         
        else
        {
            $data['access_uri'] = "Welcome".$mem_name."<li><a href=\"".site_url('home/logout')."\">Logout</a></li>";
	}
        
         if($mem_id == NULL || (!$this->session->userdata('mem_id')) || !$this->members->verified($mem_id))
        {
            
                    redirect('login');
            
        }
        else{
            
        $id = $this->uri->segment(3);
        
        #$pid = $this->session->set_userdata(array('pid' => $id));
        $query = $this->members->get_project_profile($id);
        
                
        $data['project_title'] =  $query['project_title'];
        $data['fname'] = $query['fname'];
        $data['sname'] = $query['sname'];
        $data['email_ad'] = $query['email_ad'];
        $data['project_url'] = $query['project_url'];
        $data['city'] = $query['city'];
        $data['category'] = $query['category'];
        $data['country'] = $query['country'];
        $data['project_description'] = $query['project_description'];
        
        /*$where_array = array(
            'category' => $data['category']
        );*/
       # $get_id = $this->members->get('category_id',$where_array,'categories');
        
        
        $data['site_banner'] = "<div class=\"greenBg smallBanner\">
                                <div class=\"container_16\">
                                    <div class=\"grid_2 imgFull\"><img src=\"images/game.jpg\"></div>
                                    <div class=\" grid_10\">
                                     <h2>".$data['project_title']."</h2>
                                        <p>m dolor sit amet, consectetur adipiscing elit.Phasellus sed cursus </p>
                                    </div>
                                <div class=\"grid_4 \">
                                <div class=\"btn orangeBtn\"><a href=\"".site_url('donation')."\"><h4>Support this project</h4>
                                	<span>Fund/Pledge</span></a>
                            </div>
                            </div>
                            </div></div>";
        #$id = $this->uri->segment(4);
        
        $data['content'] = '<div class="container_16">
                                <div class="profileMain">
                                	<div class="grid_11">
                                                 <div class="youtube"><br>
                                </div></div>
                                    <div class="grid_11 profileTab">
                                        <ul>
                                            <li class="highlight"><a href="#">Overview</a></li>
                                            <li><a href="#">Backers</a></li>
                                            <li><a href="#">Comments</a></li>
                                            <li><a href="#">Overview</a></li>
                                        </ul>
                                    </div>
                                <div class="grid_11">
                                    <div class="profileTabBody"> <p>'.$data['project_description'].'</p>
                                </div></div>
                                </div>
                                <div class="profileSideBar">
                                <div class="grid_2 marginBtm20"><img src="images/user.jpg"></div>
                                        <div class="grid_3 marginBtm20">
                                            <h2 class=" marginBtm20">'.$data['fname']." ".$data['sname'].'</h2>
                                            <h5 class="icon "><div class="iconCategory"></div>'.$data['category'].'</h5>
                                            <h5 class="icon"><div class="iconCountry"></div>'.$data['city']." ".$data['country'].'</h5>
                                            <h5 class="icon"><div class="iconEmail"></div>'.$data['email_ad'].'</h5>
                                            <h5 class="icon"><div class="iconWeb"></div>'.$data['project_url'].'</h5>
                                        </div>
                                    <div class="grid_5 marginBtm20">'.$data['project_description'].'
                                        </div>
                                    <div class="grid_5 marginBtm20 ">
                                    <div class="info">
                                        <h4>N30,934</h4>
                                        <h6>Donation</h6></div>
                                      <div class="info">
                                        <h4>N150,098</h4>
                                        <h6>Pledges</h6></div>
                                    <div class="info">
                                    <h4>30days</h4>
                                    <h6>To go</h6></div>
                                    </div>
                                    <div class="clearfix"><br>
                                    </div>
                                        <div class="grid_4  supportBtn">
                                        <div class="btn orangeBtn">
                                        <a href="#"><h4>Support this project</h4>
                                            <span>Fund/Pledge</span></a>
                                        </div>
                                    </div>
                                        <div class="grid_5 textCenter">25% of (N10,000,000) pledge goal attained</div>
                                        <div class="gr7id_5 relatedT"><h2>Related Projects</h2></div>
                                        '.$this->members->get_related_projects().'
                                            </div>
                                        </div>';
        
        $this->load->view('partial/header_page.php', $data);
                
        }
    }
    
    
    function success(){
        
        $mem_id = $this->session->userdata('mem_id');
        $mem_name = $this->session->userdata('mem_name');
        
        
        $data['title'] =  'Start Project';
        
        $banner_title  =  'Project Success';
        
        $data['header'] = 'Start Project';
        
        $data['additional_js'] = '';
        
        $data['error'] = '';
        
        $message = '<p align = "center">You have succesfully registered your project</p>';
        
         if($mem_id == NULL || (!$this->session->userdata('mem_id')) || !$this->members->verified($mem_id))
         {
            
            $data['access_uri'] = "<ul>
					<li><a href=\"#\">About</a></li>
					<li><a href=\"".site_url('login')."\">Sign In</a></li>
					<li><a href=\"".site_url('signup')."\">Sign Up</a></li>
					<li><a href=\"".site_url('project')."\">Support A Project</a></li>
					<li class=\"active\"><a href=\"#\">Start Project</a></li>
				</ul>";
         }
         
        else
        {
            $data['access_uri'] = "Welcome".$mem_name."<li><a href=\"".site_url('home/logout')."\">Logout</a></li>";
	}
        
        $data['site_banner'] = "<div class=\"greenBg smallBanner\">
					<div class=\"container_16\">
					<div class=\" grid_10\"><h2>".$banner_title."</h2>
					 <p>m dolor sit amet, consectetur adipiscing elit.Phasellus sed cursus erat. Aliquam tristique ligula sit amet dolor Lore</p>
				</div>
				</div></div>
                                $message";
                            
        $data['content'] = '';
        
        if($mem_id == NULL || (!$this->session->userdata('mem_id')) || !$this->members->verified($mem_id))
        {
            
                    redirect('login');
            
        }
        else{
        
        $this->load->view('partial/header_page.php',$data);
        
        }
        
    }
    
    
    
}

?>