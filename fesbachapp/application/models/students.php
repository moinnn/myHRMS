<?php

class students extends CI_Model{
    
    function __construct()
        {
            parent::__construct();
            $this->load->database();
        }
    
    
 
    
    
    function is_exist($table, $param_array)
        {
            $query = $this->db->get_where($table, $param_array);
            
           return $query->result_array();		
        }    
    
    
    function verified($id)
        {
            if($this->is_exist('churches', array('id' => $id, 'status' => ENABLED)))
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
    
    
    function get_student_basic_info($id){
        
        $this->db->select('*');
            $this->db->where('id', $id);
            $this->db->limit(1);
            
            $query = $this->db->get('churches');
            
            $churches = array();
            
            foreach($query->result() as $row)
            {
                $churches['userfile'] = $row->userfile;
                $churches['title'] = $row->title;
                $churches['surname'] = $row->surname;
                $churches['first_name'] = $row->first_name;
                $churches['other_names'] = $row->other_names;
                $churches['month'] = $row->month;
                $churches['date_of_birth'] = $row->date_of_birth;
                $churches['email'] = $row->email;
                $churches['phone_number'] = $row->phone_number;
                $churches['marital_status'] = $row->marital_status;
                $churches['department'] = $row->department;
                $churches['society'] = $row->society;
                $churches['fellowship'] = $row->fellowship;
                $churches['state'] = $row->state;
                $churches['occupation'] = $row->occupation;
                $churches['baptised'] = $row->baptised;
                $churches['discipled'] = $row->discipled;
                $churches['area_of_interest'] = $row->area_of_interest;
                $churches['marital_status'] = $row->marital_status;
                $churches['contact_address'] = $row->contact_address;
                
            }
            
            return $churches;
        
    }
    
    
    function get_insert_id(){
        
        $this->db->insert_id();
    }
    
    function update_entry($id, $param_array){
        
        $this->db->where(array('id' => $id));
        $this->db->update('churches', $param_array);
        
    }
    
    function insert_entry($table, $param){
        
        $query = $this->db->insert($table, $param);
        
    }
    
     function get_image()
    {
    
        $query = $this->db->select('userfile')
                           ->from('churches')
                            ->where('id', 23)
                            ->get('');
                           
        $result = $query->row();
                          
         return $query->num_rows() === 1 ? $result : false;                 
    }  
    
    
    
    
    
    
}





















?>