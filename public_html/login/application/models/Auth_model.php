<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model{
	public function checkDetail($email,$password){

		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('email',$email);
		$this->db->where('password',base64_encode($password));
		$data = $this->db->get()->row_array();
		if($data){
			if ($data['type'] == 'CLIENT') {
				$client = $this->db->query("SELECT status FROM tbl_client WHERE status = 1 AND email like '". $data['email']  ."'")->num_rows();
				if ($client == 1) {
					return $data;
				}
			}else{
				return $data; 
			}
		}
	}
	public function getAllAuths(){
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$data = $this->db->get()->result();
		if($data){ return (array)$data; }
	}
	public function getAuths($type = ''){
		$this->db->select('*');
		$this->db->where('type',$type);
		$this->db->from('tbl_auth');
		$data = $this->db->get()->result();
		if($data){ return (array)$data; }
	}
	public function getAuth($auth_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id',$auth_id);
		$data = $this->db->get()->result();
		if($data){ return (array)$data[0]; }
	}
	public function getAuthByCandidateID($candidate_id = ''){
		$this->db->select('auth_id');
		$this->db->from('tbl_auth');
		$this->db->where('profile_id',$candidate_id);
		$this->db->where('type','CANDIDATE');
		$data = $this->db->get()->row_array();
		if($data){ return $data['auth_id']; }
	}
	public function getClientEmailByID($auth_id = ''){
		$this->db->select('email');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id',$auth_id);
		$this->db->where('type','CLIENT');
		$data = $this->db->get()->row_array();
		if($data){ return $data['email']; }
	}
	public function getClientByID($auth_id = ''){
		$this->db->select('c.client,c.name');
		$this->db->from('tbl_auth as a');
		$this->db->join('tbl_client as c', 'c.client_id = a.profile_id');
		$this->db->where('a.auth_id', $auth_id);
		$this->db->where('a.type', 'CLIENT');
		$data = $this->db->get()->row_array();
		if ($data) {return $data;}
	}
	public function addAuth($data = array(),$auth_type = array()){
		$add = array(
			'auth_id'	=>	'',
			'name'		=>	$data['auth_name'],
			'email'		=>	$data['auth_email'],
			'password'	=>	base64_encode($auth_type['password']),
			'type'		=>	$auth_type['auth_type'],
		);
		return $this->db->insert('tbl_auth',$add);
	}
	public function updateAuth($auth_id = '',$data = array()){
		$this->db->select('password');
		$this->db->where('auth_id',$auth_id);
		$this->db->from('tbl_auth');
		$old_password = $this->db->get()->result()[0]->password;
		$update = array(
			'name'		=>	$data['auth_name'],
			'email'		=>	$data['auth_email'],
			'password'	=>	base64_encode($data['auth_password']),
		);
		$this->db->where('auth_id',$auth_id);
		$this->db->update('tbl_auth',$update);
		if($old_password != $data['auth_password']){
			return true;
		}else{
			return false;
		}
	}
	public function removeAuth($auth_id = ''){
		$this->db->where('auth_id',$auth_id);
		$this->db->delete('tbl_auth');

		$this->db->where('manager',$auth_id);
		$this->db->delete('tbl_project');
	}
	public function getManagers(){
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('TYPE','MANAGER');
		$data = $this->db->get()->result();
		if($data){ return (array)$data;	}
	}
	public function getManager($manager_id = ''){
		$this->db->select('name');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id',$manager_id);
		$data = $this->db->get()->result()[0]->name;
		if($data){ return $data; }
	}
	public function updateAuthProfile($data = array(),$auth_id){
		$update = array(
			'name'	=>	$data['name'],
			'email'	=>	$data['email'],
		);
		$this->db->where('auth_id',$auth_id);
		$this->db->update('tbl_auth',$update);
	}
	public function updatePassword($data = array(),$auth_id){
		$update = array(
			'password'	=>	base64_encode($data['new_password']),
		);
		$this->db->where('auth_id',$auth_id);
		$this->db->update('tbl_auth',$update);
	}
	public function getAuthProfile($auth_id){
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id',$auth_id);
		$data = $this->db->get()->result();
		if($data){ return (array)$data[0]; }
	}
	public function checkEmail($email){
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('email',$email);
		$data = $this->db->get()->result();
		if($data){ return (array)$data[0]; }
	}
}
?>