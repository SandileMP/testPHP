<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Interview_model extends CI_Model{
	// Invite For Interview
	public function getInterviews(){
		$this->db->select('*');
		$this->db->from('tbl_interview');
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;
		}
	}
	public function addInvite($data = array()){
		$data['invite_id'] = '';
		$this->db->insert('tbl_invite_interview',$data);
	}
	public function getInvites(){
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;
		}
	}
	public function getInvitesByCandidate($candidate_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('candidate_id',$candidate_id);
		$data = $this->db->get()->row_array();
		if($data){
			return $data;
		}
	}
	public function getCandidateInvite($project_id = '',$candidate_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('project_id',$project_id);
		$this->db->where('candidate_id',$candidate_id);
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;
		}
	}
	public function getInterviewsByProjectID($project_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_interview');
		$this->db->where('project_id',$project_id);
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;
		}
	}
	public function getManagerInterviewsByProjectID($manager_id = '',$project_id = ''){
		$this->db->select('i.*');
		$this->db->from ('tbl_project as p');
		$this->db->join ('tbl_auth as a', 'a.profile_id = p.manager', 'left');
		$this->db->join ('tbl_interview as i', 'i.project_id = p.project_id', 'left');
		$this->db->where ('a.auth_id',$manager_id);
		$this->db->where ('i.project_id',$project_id);
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;
		}
	}
	public function getInvitedProjects(){
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$ids = $this->db->get()->result();
		$data = array();
		foreach ($ids as $value) {
			$data[] = $value->project_id;
		}
		if($data){ return $data; }
	}
	public function getInvitedProjectsByManager($manager_id = ''){
		$this->db->select('i.*');
		$this->db->from ('tbl_invite_interview as i');
		$this->db->join ('tbl_project as p', 'p.project_id = i.project_id', 'left');
		$this->db->where ('p.manager',$manager_id);
		$ids = $this->db->get()->result();
		$data = array();
		foreach ($ids as $value) {
			$data[] = $value->project_id;
		}
		if($data){ return $data; }
	}
	public function getCompletedInterviewByManager($manager_id = ''){
		$this->db->select('p.*');
		$this->db->from ('tbl_project as p');
		$this->db->join ('tbl_auth as a', 'a.profile_id = p.manager', 'left');
		$this->db->where ('a.auth_id',$manager_id);
		$this->db->where ('p.status','launch');
		$data = $this->db->get()->result();
		if($data){
			$candidate_ids = array();
			foreach ($data as $key => $value) {
				$candidate_ids = array_merge($candidate_ids,json_decode($value->candidate));
			}
			$candidate_ids = join(',',$candidate_ids);
			$interview = $this->db->query("SELECT * FROM tbl_interview WHERE candidate IN($candidate_ids)")->result();
			if($interview){ return $interview; }
		}
	}
	public function accessLogin($candidate = ''){
		$this->db->set('status',1);
		$this->db->where('candidate_id',$candidate);
		$this->db->update('tbl_candidate');
	}
	public function preventLogin($candidate = ''){
		$this->db->set('status',0);
		$this->db->where('candidate_id',$candidate);
		$this->db->update('tbl_candidate');
	}
	public function checkInterviewDetail($candidate_id = ''){
		$this->db->select('ii.*,p.*');
		$this->db->from('tbl_invite_interview as ii');
		$this->db->join ('tbl_project as p', 'p.project_id = ii.project_id', 'left');
		$this->db->where('p.status','launch');
		$this->db->where('ii.candidate_id',$candidate_id);
		$data = $this->db->get()->row_array();
		if($data){
			$now = date('Y-m-d');
			if($data['project_type'] == 'open'){
				if($data['start_date'] <= $now) $interview = true;
				else $interview = false;
			}else if($data['project_type'] == 'expiry'){
				if($data['start_date'] <= $now && $data['end_date'] >= $now) $interview = true;
				else $interview = false;
			}else{
				$interview = false;
			}
			return $interview;
		}
	}
	public function getInterviewDetails($candidate_id = ''){
		$this->db->select('i.*,p.*,jp.title,jp.role_title,jp.question_list');
		$this->db->from ('tbl_invite_interview as i');
		$this->db->join ('tbl_project as p', 'p.project_id = i.project_id', 'left');
		$this->db->join ('tbl_job_profile as jp', 'jp.job_profile_id = p.profile_id', 'left');
		$this->db->where ('i.candidate_id',$candidate_id);
		$interview = $this->db->get()->result();
		if($interview){return (array)$interview[0];}
	}
	public function updateInterviewCandidate($candidate_id = ''){
		$this->db->set('status',0);
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_id',$candidate_id);
	}
	public function updateInterview($invite_id = ''){
		$this->db->set('status',1);
		$this->db->from('tbl_invite_interview');
		$this->db->where('invite_id',$invite_id);
	}
	public function checkInterviewStatus($candidate_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('candidate_id',$candidate_id);
		$data = $this->db->get()->row_array();
		if($data){
			if($data['start_status'] == '0' && $data['end_status'] == '0'){
				return 'pending';
			}else if($data['start_status'] == '1' && $data['end_status'] == '0'){
				return 'cancel';
			}else{
				return 'complete';
			}
		}
	}
	public function setInterviewStartStatus($candidate_id = ''){
		$this->db->query("UPDATE `tbl_invite_interview` SET start_status = 1, status = 'cancel' WHERE candidate_id = '{$candidate_id}'");
	}
	public function setInterviewEndStatus($candidate_id = ''){
		$this->db->query("UPDATE `tbl_invite_interview` SET end_status = 1, status = 'complete' WHERE candidate_id = '{$candidate_id}'");
	}
	public function completeInterview($data = array()){
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('invite_id',$data['invite_id']);
		$invite_detail = $this->db->get()->result()[0];
		$add = array(
			'interview_id'	=>	'',
			'invite_id'		=>	$data['invite_id'],
			'project_id'	=>	$invite_detail->project_id,
			'candidate'		=>	$invite_detail->candidate_id,
			'start'			=>	$data['start_time'],
			'end'			=>	$data['end_time'],
			'path'			=>	$data['video-filename'],
			'status'		=>	1,
		);
		$this->db->insert('tbl_interview',$add);

		$this->db->select('*');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_id',$invite_detail->candidate_id);
		$candidates = (array)$this->db->get()->result()[0];
		$subject = 'Interview Completed';
		$message = "The Specific Candidate Has Completed Interview.". "<br><br>";
		$message .= "Name : <strong>". $candidates['candidate_name'] ."</strong><br>";
		$message .= "Email : <strong>". $candidates['candidate_email'] ."</strong><br>";

		$mail = new Mail();
		$mail->setTo('info@e-interview.co.za');
		$mail->setFrom('info@e-interview.co.za');
		$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();

		return $this->db->insert_id();
	}
	public function getInterviewCompleteDetails($candidate_id = ''){
		$this->db->select('i.*,ii.status as interview_status,p.project_name,p.project_description,p.notification,jp.title,jp.role_title');
		$this->db->from ('tbl_interview as i');
		$this->db->join ('tbl_invite_interview as ii', 'ii.invite_id = i.invite_id', 'left');
		$this->db->join ('tbl_project as p', 'p.project_id = ii.project_id', 'left');
		$this->db->join ('tbl_job_profile as jp', 'jp.job_profile_id = p.profile_id', 'left');
		$this->db->where ('i.status',1);
		$this->db->where ('i.candidate',$candidate_id);
		$interview_data = $this->db->get()->result();
		if($interview_data){return (array)$interview_data[0];}
	}
	public function getCompleteInterviewNotification(){
		$this->db->select('c.*,i.*');
		$this->db->from ('tbl_interview as i');
		$this->db->join ('tbl_project as p', 'p.project_id = i.project_id', 'left');
		$this->db->join ('tbl_candidate as c', 'c.candidate_id = i.candidate', 'left');
		$this->db->where ('i.status',1);
		$this->db->where ('p.notification','on');
		if($this->session->userdata['user_type'] == 'CLIENT'){
			$this->db->where ('p.client',$this->session->userdata['user']);
		}
		if($this->session->userdata['user_type'] == 'MANAGER'){
			$this->db->where ('p.manager',$this->session->userdata['user']);
		}
		$this->db->order_by("i.interview_id", "desc");
		$interview_data = $this->db->get()->result();
		if($interview_data){
			if(explode(' ',$interview_data[0]->end)[0] == date('d/n/Y')){
				return (array)$interview_data;
			}
		}
	}
}
?>