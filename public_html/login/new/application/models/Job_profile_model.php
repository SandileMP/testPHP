<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_profile_model extends CI_Model{
	public function getJob_profiles($client_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_job_profile');
		$this->db->where('client_id',$client_id);
		$data = $this->db->get()->result();
		if($data){ return (array)$data;	}
	}
	public function getDashboardJob_profiles(){
		$this->db->select('*');
		$this->db->from('tbl_job_profile');
		if($this->session->userdata['user_type'] == 'CLIENT'){
			$this->db->where('client_id',$this->session->userdata['user']);
		}
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;	
		}
	}
	public function getJob_profilesBySearch($client_id = '',$serach = ''){
		$data = $this->db->query("SELECT * FROM tbl_job_profile WHERE client_id = '{$client_id}' AND title LIKE '%{$serach}%' OR role_title LIKE '%{$serach}%'");
		if($data){
			return (array)$data->result();	
		}
	}
	public function getJob_profile($job_profile_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_job_profile');
		$this->db->where('job_profile_id',$job_profile_id);
		$data = $this->db->get()->result();
		if($data){ return (array)$data[0]; }
	}
	public function addjob_profiles($data = array()){
		$data['question'] = array_filter(array_map('array_filter', $data['question']));
		$data['question'] = json_encode(array_values($data['question']));
		$this->db->set('job_profile_id', '');
		$this->db->set('client_id', $data['client_id']);
		$this->db->set('title', $data['job_profile_title']);
		$this->db->set('role_title', $data['job_profile_role_title']);
		$this->db->set('question_list', $data['question']);
		return $this->db->insert('tbl_job_profile');
	}
	public function updatejob_profile($job_profile_id = '',$data = array()){
		$data['question'] = json_encode(array_values($data['question']));
		$this->db->set('title',$data['job_profile_title']);
		$this->db->set('role_title',$data['job_profile_role_title']);
		$this->db->set('question_list',$data['question']);
		$this->db->where('job_profile_id',$job_profile_id);
		$this->db->update('tbl_job_profile');
	}
	public function copyjob_profiles($job_profile_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_job_profile');
		$this->db->where('job_profile_id',$job_profile_id);
		$data = $this->db->get()->result()[0];

		$this->db->set('client_id', $data->client_id);
		$this->db->set('title', $data->title);
		$this->db->set('role_title', $data->role_title);
		$this->db->set('question_list', $data->question_list);
		return $this->db->insert('tbl_job_profile');
	}
	public function removejob_profile($job_profile_id = ''){
		$this->db->where('job_profile_id',$job_profile_id);
		$this->db->delete('tbl_job_profile');

		$this->db->where('profile_id',$job_profile_id);
		$this->db->delete('tbl_project');
	}
	public function getProfileName($job_profile_id = ''){
		$this->db->select('title');
		$this->db->from('tbl_job_profile');
		$this->db->where('job_profile_id',$job_profile_id);
		$data = $this->db->get()->result();
		if($data){ return $data[0]->title; }
	}
}
?>