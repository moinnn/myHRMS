 
 <?php
 class show extends CI_Controller{
 
     public function __construct(){
        parent:: __construct();
        
    }
    
 
 function show()
    {
        $this->load->model('students');
        $item = $this->students->get_image();
        
        Header("Content-type: image/jpeg");
        echo $item->userfile; 
    }
    
    
    }
    ?>