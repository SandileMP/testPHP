<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager_model extends CI_Model{
	public function getManagers($client_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_manager');
		$this->db->where('client_id',$client_id);
		$data = $this->db->get()->result();
		if($data){ return (array)$data;	}
	}
	public function getManager($manager_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_manager');
		$this->db->where('manager_id',$manager_id);
		$data = $this->db->get()->row_array();
		if($data){ return $data; }
	}
	public function getManagerName($manager_id = ''){
		$this->db->select('name');
		$this->db->from('tbl_manager');
		$this->db->where('manager_id',$manager_id);
		$data = $this->db->get()->row_array();
		if($data){ return $data['name']; }
	}
	public function getManagersBySearch($client_id = '',$serach = ''){
		$data = $this->db->query("SELECT * FROM tbl_manager WHERE client_id = '{$client_id}' AND name LIKE '%{$serach}%'");
		if($data){
			return (array)$data->result();	
		}
	}
	public function getDashboardManagers(){
		$this->db->select('*');
		$this->db->from('tbl_manager');
		$this->db->where('client_id',$this->session->userdata['user']);
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;	
		}
	}
	public function addManager($data = array(),$password = ''){
		$data['manager_id'] = '';
		$this->db->insert('tbl_manager',$data);
		$profile_id = $this->db->insert_id();

		$auth = array(
			'auth_id'		=>	'',
			'profile_id'	=>	$profile_id,
			'name'			=>	$data['name'],
			'email'			=>	$data['email'],
			'password'		=>	$password,
			'type'			=>	'MANAGER',
		);
		return $this->db->insert('tbl_auth',$auth);
	}
	public function updateManager($manager_id = '',$data = array()){
		$this->db->where('manager_id',$manager_id);
		$this->db->update('tbl_manager',$data);

		$update = array(
			'name'	=>	$data['name'],
			'email'	=>	$data['email'],
		);
		$this->db->where('profile_id',$manager_id);
		$this->db->where('type','MANAGER');
		$this->db->update('tbl_auth',$update);
	}
	public function removeManager($manager_id = ''){
		$this->db->where('manager_id',$manager_id);
		$this->db->delete('tbl_manager');
		
		$this->db->where('profile_id',$manager_id);
		$this->db->where('type','MANAGER');
		$this->db->delete('tbl_auth');

		$this->db->where('manager',$manager_id);
		$this->db->delete('tbl_project');
	}
}
?>