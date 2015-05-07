<?php

    class Members extends CI_Model
    {
        
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }
        
        function admin_do_login($username, $password)
        {
            $query = $this->db->get_where('admin', array('admin_username' => $username, 'admin_password' => $password, 'enabled' => YES));
            
            if($query->num_rows() == 1)
            {
                    return true;
            }
            
            return false;			
        }
        
        function is_exist($table, $param_array)
        {
            $query = $this->db->get_where($table, $param_array);
            
           return $query->result_array();		
        }    
        
        function verified($mem_id)
        {
            if($this->is_exist('mem_info', array('mem_id' => $mem_id, 'status' => ENABLED)))
                return true;
            
            return false;
        }
        
        function get($what_id, $where_array, $table)
        {
            $this->db->select($what_id);
            $this->db->where($where_array);
            $this->db->limit(1);
            $query = $this->db->get($table);
            
            foreach($query->result() as $value)
                return $value->$what_id;            
        }
        
       
	
	
	function recent_added(){     //function to view the recently added employees on the dashboard page. It displays the last 3 added employees.
	    
	    $this->db->select('*');
	    $this->db->from('employees');
	    $this->db->order_by('date_added','desc');
	    $this->db->limit(3);
	    
	    $query = $this->db->get();
	   
	    $result = "";
	    
	    foreach($query->result() as $row){
		
		$first_name = $row->first_name;
		$last_name =  $row->last_name;
		$employee_id = $row->employee_id;
		
		$result .= "<li><a href = \"".site_url('employees/view_employee/'.$employee_id)."\" STYLE=\"text-decoration: none\"><font color = \"green\" >".ucfirst($first_name). '  '.ucfirst($last_name)."</font></a></li>";
	    }
	    
	    return $result;    
	}
	
	function get_all_benefitHTML(){                   //this function displays when you add a new benefit for an employee i.e in the add employee benefit form.
	    
	    $this->db->select('*');
	    $this->db->from('benefits');
	    $this->db->order_by('date_added','desc');
	    
	    $query = $this->db->get();
	    
	    $result = '<select name = "benefit">
			    <option value = ""></option>';
	    
	    foreach($query->result() as $row){
		
		$benefit_id = $row->benefit_id;
		$benefit_type = $row->benefit_type;
		
		$result .= '<option value = "'.$benefit_id.'">'.$benefit_type.'</option>';
		
	    }
	    $result .= '</select>';
	    
	    return $result;
	}
	
	function get_employee_benefit($employee_id)  //this model gets the benefits of an employee in the employee profile page
	{
	    $this->db->select('*');
	    $this->db->from('employee_benefits');
	    $this->db->where(array('employee_id'=>$employee_id));
	    $this->db->order_by('date_added','desc');
	    
	    $query = $this->db->get();
	    
	    $result = "";
	    
	    if($query->num_rows() < 1){
		
		$result .= '<p>There are no Benefits for this employee</p>';
	    }
	    
	    else{
		
		foreach($query->result() as $row){
		    
		    $benefit_id = $row->benefit_id;
		    $benefit_type = $this->members->get('benefit_type',array('benefit_id'=>$benefit_id),'benefits');
		    
		    $result .= '<li>'.$benefit_type.'<li>';
		}
	    }
	    
	    
		return $result;
	    }
	
	
	    
	function get_all_benefit(){     //This function displays all existing benefit in the system. It is displayed on the benefit page.
		
		$this->db->select('*');
		$this->db->from('benefits');
		$this->db->order_by('date_added');
		
		
		$query = $this->db->get();
		
		return $query->result_array();
	} 

	function get_employees_assigned($employee_benefit_id,$benefit_id ){
		
		$this->db->select('employee_id');
		$this->db->from('employee_benefits');
		$this->db->where(array('employee_benefit_id'=>$employee_benefit_id,'benefit_id'=>$benefit_id));

		$query = $this->db->get();
		
		return $query->num_rows();
			
	}
	
	
	function get_all($all,$table,$orderby,$asc){
	    
	    $this->db->select($all);
	    $this->db->from($table);
	    $this->db->order_by($orderby,$asc);
	    
	    $query = $this->db->get();
	    
	    return $query->result_array();
	}
	
	
	function get_all_where($all,$table,$where_array,$orderby,$desc){
	    
	    $this->db->select($all);
	    $this->db->from($table);
	    $this->db->where($where_array);
	    $this->db->order_by($orderby,$desc);
	    
	    $query = $this->db->get();
	    
	    return $query->result_array();
	}
	
	
	
	function get_all_employees($limit,$offset = 0){
	    
	    $this->db->select('*');
	    $this->db->from('employees');
	    $this->db->order_by('date_added','desc');
	    $this->db->limit($limit,$offset);
	    
	    $query = $this->db->get();
	        
		return $query->result_array();  
	}
	
	
	function get_num_of_employees(){
	    
	    $this->db->select('*');
	    $this->db->from('employees');
	    
	    $query = $this->db->get();
	    
	    return $query->num_rows();
	}
	
	
	function search_employee($param){
	    
	    $this->db->select('*');
	    $this->db->from('employees');
	    $this->db->like('first_name',$param,'after');
	    $this->db->or_like('last_name',$param,'after');
	        
	    $query = $this->db->get();
	    
	    return $query->result_array();
	    
	}
	
	    
        function get_insert_id()
        {                
            return $this->db->insert_id();           
        }
        
        function update_entry($mem_id, $param_array)
        {
            $this->db->where(array('mem_id' => $mem_id));
            $this->db->update('mem_info', $param_array);
        }
        
        function insert_entry($table, $param)
        {    
            $this->db->insert($table, $param);
        }  

        

    }