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
                $churches['id'] = $row->id;
                $churches['title'] = $row->title;
                $churches['surname'] = $row->surname;
                $churches['first_name'] = $row->first_name;
                $churches['other_names'] = $row->other_names;
                $churches['sex'] = $row->sex;
                $churches['month'] = $row->month;
                $churches['date_of_birth'] = $row->date_of_birth;
                $churches['email'] = $row->email;
                $churches['phone_number'] = $row->phone_number;
                $churches['marital_status'] = $row->marital_status;
                $churches['department'] = $row->department;
                $churches['society'] = $row->society;
                $churches['userfile'] = $row->userfile;
                $churches['fellowship_center'] = $row->fellowship_center;
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
    
    
    function delete_entry($id, $param_array){
        
        $this->db->where(array('id' => $id));
        $this->db->delete('churches', $param_array);
        
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
    
    function get_user_details()
    {
            $this->db->select('*');
            $this->db->where('id', $id);
            $this->db->limit(1);
            
            $query = $this->db->get('churches');
            
            return $query->row_array();
        
        
        
    }
    
    function members_profile_pics($mem_id)
		{
			$this->db->select('userfile');
			$this->db->where('id', $mem_id);
			$query = $this->db->get('churches');
			
			$userfile = "";
			
			foreach($query->result() as $row)
				$userfile = $row->userfile;

			return $userfile == '' ? "<div class=\"image\"><img src=\"".base_url()."assets/images/defaultProfilePix.png\"  /><div class=\"text\"><a href=\"".site_url()."page/profile/".UPLOAD_PICX."\">Upload Profile Picture</a></div></div>" : "<div class=\"image\"><img src=\"".base_url()."assets/images/members/".$userfile."\"  /><div class=\"text\"><a href=\"".site_url()."page/profile/".UPLOAD_PICX."\">Change Picture</a></div></div>"; 
			
		}
                
                
                function member_thumb_pix($mem_id, $thumb_type)
		{
			$this->db->select('userfile');
			$this->db->where('id', $mem_id);
			$query = $this->db->get('churches');
			
			foreach($query->result() as $row)
			{
				$userfile = $row->userfile;
				
				if($userfile == "")
					$userfile = "defaultProfilePix.png";
			}
			
			if($thumb_type == MINI_THUMB_TYPE)
				return $userfile;
			elseif($thumb_type == MEDIUM_THUMB_TYPE)
				return str_replace('.', '_thumb.', $userfile);
			
		}
                
                
                function is_default_pix($mem_id)
		{
			$this->db->select('userfile');
			$this->db->where('id', $mem_id);
			$query = $this->db->get('churches');
			
			$userfile= "";
			
			foreach($query->result() as $row)
			{
				$userfile = $row->userfile;
			}
			
			if($userfile == "")
				return TRUE;
			
			return FALSE;
		}
    
                
                function settings($id, $old_password, $new_password){
                    
                    #echo $old_password.":".sha1($old_password)." New password:".$new_password.";".sha1($new_password);
		$this->db->select('password', false)->from('churches')->where('id', $id)->where('password', $old_password);
		
		$query = $this->db->get();
		if($query->num_rows() !== 1)
			return FALSE;
		#echo "here";		
		$this->db->where('id', $id);
		$this->db->where('password', $old_password);
		$this->db->update('churches', array('password' => $new_password));
                    
                    
                }
                
                function is_correct($id,$old_password){
                    
                    $this->db->select('password')->from('churches')->where('id',$id)->where('password', $old_password);
                    
                    $query = $this->db->get();
                    
                    return $query->result_array();
                }
                
                function get_new_password($id){
                    
                    $this->db->select('password');
                    $this->db->from('churches');
                    $this->db->where(array('id' => $id));
                    
                    $query = $this->db->get();
                    
                    $churches = array();
            
                   foreach($query->result() as $row)
                {
                    $churches['password'] = $row->password;
                }
                    return $churches;
                
                }
    
    
    
    
}





















?>