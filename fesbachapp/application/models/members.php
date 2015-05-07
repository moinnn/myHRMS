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
            
            if($query->num_rows() > 0) return true;
            
            return false;			
        }
        
        function verified($mem_id)
        {
            if($this->is_exist('member_info', array('mem_id' => $mem_id, 'status' => ENABLED)))
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
        
        function get_member_basic_info($mem_id)
        {
            $this->db->select('yname, email_ad, mobile, contact_ad');
            $this->db->where('mem_id', $mem_id);
            $this->db->limit(1);
            
            $query = $this->db->get('member_info');
            
            $member_info = array();
            
            foreach($query->result() as $row)
            {
                $member_info['yname'] = $row->yname;
                $member_info['email_ad'] = $row->email_ad;
                $member_info['mobile'] = $row->mobile;
                $member_info['contact_ad'] = $row->contact_ad;
            }
            
            return $member_info;
        }
        
        function get_insert_id()
        {                
            return $this->db->insert_id();           
        }
        
        function update_entry($mem_id, $param_array)
        {
            $this->db->where(array('mem_id' => $mem_id));
            $this->db->update('member_info', $param_array);
        }
        
        function insert_entry($table, $param)
        {    
            $this->db->insert($table, $param);
        }        

    }