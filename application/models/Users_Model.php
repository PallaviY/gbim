<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_Model extends CI_Model {
    /**
     * insert and update user
     * @param type $user
     * @return boolean
     */
    public function store($user)
    {
        if(empty($user->id))
        {
            $result = $this->db->insert('users', $user);
            if($result)
                return true;
            else
                return false;
        } else {
            $result = $this->db->replace('users', $user);
            if($result)
                return TRUE;
            else
               return FALSE;
        }
    }
    
    /**
     * fetch all users with their roles
     * @return boolean
     */
    public function fetch_all()
    {
        $this->db->select('users.*,user_roles.id as roleid, user_roles.role');
        $this->db->from('users');
        $this->db->join('user_roles', 'user_roles.id = users.role_type','left');
        $this->db->where('users.status',1);
        $query = $this->db->get();
        $result = $query->result();
        if(!empty($result))
            return $result;
        else
            return false;
    }
    /**
     * fetch single user by id
     * @param type $user_id
     * @return boolean
     */
    public function fetch_single_by_id($user_id)
    {
        $this->db->select('users.*,user_roles.id as roleid, user_roles.role');
        $this->db->from('users');
        $this->db->join('user_roles', 'user_roles.id = users.role_type','left');
        $this->db->where('users.id',$user_id);
        $this->db->where('users.status',1);
        $query = $this->db->get();
        $result = $query->row();
        if(!empty($result))
            return $result;
        else
            return false;
    }
    /**
     * delete user
     * @param type $user_id
     * @return boolean
     */
    public function drop($user_id)
    {
        $this->db->where('id', $user_id);
        $result = $this->db->delete('users');
        if($result)
            return TRUE;
        else
            return FALSE;
    }
    /**
     * fetch single user by email
     * @param type $user_id
     * @return boolean
     */
    public function fetch_single_by_email($user)
    {
        $this->db->select('users.*,user_roles.id as roleid, user_roles.role');
        $this->db->from('users');
        $this->db->join('user_roles', 'user_roles.id = users.role_type','left');
        $this->db->where('users.email',$user->email);
        $this->db->where('users.password',$user->password);
        $this->db->where('users.status',1);
        $query = $this->db->get();
        $result = $query->row();
        if(!empty($result))
        {
            return $result;
        }
    }
    public function fetch_all_user_roles()
    {
        $this->db->select('*'); 
        $this->db->from('user_roles');
        $this->db->where('status',1);
        $query = $this->db->get();
        $result = $query->result();
        if(!empty($result))
        {
            return $result;
        }
    }
    public function is_user_exists($user_email, $user_number)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email',$user_email);
        $this->db->where('phone_number',$user_number);
        $this->db->where('status',1);
        $query = $this->db->get();
        $result = $query->row();
        if(!empty($result))
        {
            return $result;
        }
    }
}
