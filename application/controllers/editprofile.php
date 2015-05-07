
<?php
class editprofile extends CI_Controller{

 public function __construct(){
        parent:: __construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model(array('students', 'general'));
        
    }


function index(){
            
            $this->load->model('students');
            $id = $this->session->userdata('id');
            
            $data =  $this->students->get_student_basic_info($id);
            
            $this->load->view('editprofile.php',$data);
        }
        
        
        
   }    
        ?>