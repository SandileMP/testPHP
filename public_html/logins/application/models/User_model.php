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


    public function getUsersByType($userId,$type)
    {
        $this->db->select('*');
        $this->db->from('tbl_auth');
        $this->db->where('auth_id', $userId);
        $data = $this->db->get()->row_array();

        if($type == 'DISTRIBUTOR'){
            $this->db->select('*');
            $this->db->from('tbl_distributor');
            $this->db->where('distributor_id', $data['profile_id']);
            $data['profile'] = $this->db->get()->row_array();
        }


        if($type == 'ACCOUNT MANAGER'){
            $this->db->select('*');
            $this->db->from('tbl_account_manager');
            $this->db->where('account_manager_id', $data['profile_id']);
            $data['profile'] = $this->db->get()->row_array();
        }

        if($type == 'MANAGER'){
            $this->db->select('*');
            $this->db->from('tbl_manager');
            $this->db->where('manager_id', $data['profile_id']);
            $data['profile'] = $this->db->get()->row_array();

            if($data['profile']) {
                $this->db->select('*');
                $this->db->from('tbl_auth');
                $this->db->where('auth_id', $data['profile']['account_manager_id']);
                $account_manager = $this->db->get()->row_array();

                $this->db->select('credits');
                $this->db->from('tbl_account_manager');
                $this->db->where('account_manager_id', $account_manager['profile_id']);
                $credits = $this->db->get()->row_array();
                $data['profile']['credits'] = $credits['credits'];
            }
        }

        if($type == 'RATER'){
            $this->db->select('*');
            $this->db->from('tbl_rater');
            $this->db->where('rater_id', $data['profile_id']);
            $data['profile'] = $this->db->get()->row_array();
        }

        if($type == 'CANDIDATE'){
            $this->db->select('*');
            $this->db->from('tbl_candidate');
            $this->db->where('candidate_id', $data['profile_id']);
            $data['profile'] = $this->db->get()->row_array();
        }

        return (array) $data;
    }
}