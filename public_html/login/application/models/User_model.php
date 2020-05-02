<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class User_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getAuthProfile($user_id) {
		$this->db->select('*');
		$this->db->from('tbl_profile');
		$this->db->where('user_id', $user_id);
		$data = $this->db->get()->result();
		return (array) $data[0];
	}
	public function getUsers() {
		$this->db->select('*');
		$this->db->from('tbl_profile');
		$data = $this->db->get()->result();
		return (array) $data;
	}
	public function updateUserDetails($data = array(), $user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_profile', $data);
	}

	public function addUserDetails($data = array(), $user_id) {
		$this->db->set('profile_id', '');
		$this->db->set('user_id', $user_id);
		$this->db->set('firstname', $data['firstname']);
		$this->db->set('lastname', $data['lastname']);
		$this->db->set('email', $data['email']);
		$this->db->set('phone', $data['phone']);
		$this->db->set('type', $data['type']);
		$this->db->set('status', $data['status']);
		$this->db->insert('tbl_profile');
	}
}