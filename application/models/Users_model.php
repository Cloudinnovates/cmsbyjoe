<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Users_model extends CI_Model {

		function __construct()
		{
				parent::__construct();
		}
		
		function get_all_users()
		{
				// $this->db->where('role <>', 'superadmin');
				return $this->db->get('users');
		}
		
		function add_user($record)
		{
				return $this->db->insert('users', $record);
		}
		
		function update_user($id, $record)
		{
				$this->db->where('id', $id);
				$this->db->update('users', $record);
				return $this->db->affected_rows();
		}	
		
		function username_exists($username)
		{
				$this->db->where('username', $username);
				$query = $this->db->get('users');
				if ($query->num_rows() > 0)
				{
						return TRUE;
				}
				else
				{
						return FALSE;
				}
		}
		
		function password_exists($pw)
		{
				$this->db->where('password', $pw);
				$query = $this->db->get('users');
				if ($query->num_rows() > 0)
				{
						return TRUE;
				}
				else
				{
						return FALSE;
				}
		}
		
}


/* End of file users_model.php */
/* Location: ./application/models/users_model.php */