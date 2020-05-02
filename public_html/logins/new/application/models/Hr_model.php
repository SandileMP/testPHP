<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hr_model extends CI_Model{
	public function getHrs(){
		$this->db->select('*');
		$this->db->from('tbl_hr');
		$data = $this->db->get()->result();
		if($data){ return (array)$data;	}
	}
	public function getHr($hr_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_hr');
		$this->db->where('hr_id',$hr_id);
		$data = $this->db->get()->result()[0];
		if($data){ return json_decode(json_encode($data),true); }
	}
	public function getHrsBySearch($serach = ''){
		$data = $this->db->query("SELECT * FROM tbl_hr WHERE client LIKE '%{$serach}%' OR name LIKE '%{$serach}%'");
		if($data){
			return (array)$data->result();	
		}
	}
	public function getDashboardClients(){
		$this->db->select('*');
		$this->db->from('tbl_hr');
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;	
		}
	}
	public function addHr($data = array(),$password = ''){
		$data['hr_id'] = '';
		$this->db->insert('tbl_hr',$data);
		$profile_id = $this->db->insert_id();
		
		$auth = array(
			'auth_id'		=>	'',
			'profile_id'	=>	$profile_id,
			'name'			=>	$data['name'],
			'email'			=>	$data['email'],
			'password'		=>	$password,
			'type'			=>	'CLIENT',
		);
		return $this->db->insert('tbl_auth',$auth);
	}
	public function updateHr($hr_id = '',$data = array()){
		$this->db->where('hr_id',$hr_id);
		$this->db->update('tbl_hr',$data);

		$update = array(
			'name'	=>	$data['name'],
			'email'	=>	$data['email'],
		);
		$this->db->where('profile_id',$hr_id);
		$this->db->where('type','CLIENT');
		$this->db->update('tbl_auth',$update);
	}
	public function removeHr($hr_id = ''){
		$this->db->where('hr_id',$hr_id);
		$this->db->delete('tbl_hr');
		
		$this->db->where('profile_id',$hr_id);
		$this->db->where('type','CLIENT');
		$this->db->delete('tbl_auth');

		$this->db->where('client_id',$hr_id);
		$this->db->delete('tbl_job_profile');

		$this->db->where('client',$hr_id);
		$this->db->delete('tbl_project');
		//$this->deleteHrManager($hr_id);
	}
	public function deleteHrManager($hr_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_manager');
		$this->db->where('client_id',$hr_id);
		$data = $this->db->get()->result();
		foreach ($data as $key => $manager) {
			$this->db->where('manager_id',$manager->manager_id);
			$this->db->delete('tbl_manager');

			$this->db->where('profile_id',$manager->manager_id);
			$this->db->where('type','MANAGER');
			$this->db->delete('tbl_auth');
		}
	}

}
?>