<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Interview_model extends CI_Model {
	// Invite For Interview
	public function getInterviews() {
		$this->db->select('*');
		$this->db->from('tbl_interview');
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}

	public function getInterview($interview_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_interview');
		$this->db->where('interview_id', $interview_id);
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}

	public function addInvite($data = array()) {
		$data['invite_id'] = '';
		$this->db->insert('tbl_invite_interview', $data);
	}
	public function getInvites() {
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}
	public function getInvitesByCandidate($candidate_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('candidate_id', $candidate_id);
		$data = $this->db->get()->row_array();
		if ($data) {
			return $data;
		}
	}
	public function getCandidateInvite($project_id = '', $candidate_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('project_id', $project_id);
		$this->db->where('candidate_id', $candidate_id);
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}
	public function getInterviewsByProjectID($project_id = '',$data = array()) {
		$this->db->select('*');
		$this->db->from('tbl_project as p');
		$this->db->where('p.project_id', $project_id);
		$project = $this->db->get()->row();
		if(!empty(json_decode($project->candidate_id,1))){
			$candidate_ids  = json_decode($project->candidate_id,1);
			$this->db->select('i.*,c.firstname,c.lastname,c.candidate_id,ii.email_type');
			$this->db->from('tbl_candidate as c');
			$this->db->join('tbl_interview as i', "i.candidate_id = c.candidate_id AND i.project_id = '{$project_id}'", 'left');
			$this->db->join('tbl_invite_interview as ii', "ii.candidate_id = c.candidate_id", 'left');
			
			if(isset($data['search'])){
				$this->db->group_start();
				$this->db->like('c.firstname',$data['search']);
				$this->db->or_like('c.lastname',$data['search']);
				$this->db->group_end();
			}

			$this->db->where_in('c.candidate_id',$candidate_ids,'IN');
			$this->db->where('ii.project_id',$project_id);
			$return = $this->db->get()->result();
			if ($return) return (array)$return;
		}else{
			return array();
		}
	}
	public function getallInterviews($data = array()) {
		$this->db->select('p.account_manager_id,p.manager_id,p.rater_id,p.project_name,i.path,i.status,i.interview_id,i.start,i.end,i.is_credited,i.manager_eva_rating,i.question_data,i.manager_eva_comment,ii.email_type,ii.project_id,c.firstname,c.lastname,c.candidate_id');
		$this->db->from('tbl_invite_interview as ii');
		$this->db->join('tbl_candidate as c', "ii.candidate_id = c.candidate_id", 'left');
		$this->db->join('tbl_interview as i', "i.candidate_id = c.candidate_id", 'left');
		$this->db->join('tbl_project as p', "ii.project_id = p.project_id", 'left');
		if(isset($data['search'])){
			$this->db->group_start();
			$this->db->like('c.firstname',$data['search']);
			$this->db->or_like('c.lastname',$data['search']);
			$this->db->group_end();
		}
		$this->db->where('p.manager_id', $this->session->userdata['user']);
		$this->db->where('c.candidate_id IS NOT NULL');

		$return = $this->db->get()->result();
		if ($return) return (array) $return;
	}
	public function getInterviewsByProjectIDSearch($project_id = '',$search = '') {	
		$this->db->select('i.*');
		$this->db->from('tbl_interview as i');
		$this->db->join('tbl_auth as a', 'a.profile_id = i.candidate_id', 'left');
		$this->db->where('a.name LIKE', '%'.$search.'%');
		$this->db->where('i.project_id', $project_id);
		$this->db->group_by('i.project_id');
		$data = $this->db->get()->result();
		if ($data) return (array) $data;		
	}

	public function getInterviewsByAccountManagerID($account_manager_id = '', $search = '') {
		$where = '';
		if ($search != "") {
			$where = " AND candidate_id IN (SELECT candidate_id FROM tbl_candidate WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%')";
		}
		return $this->db->query("SELECT * FROM `tbl_interview` WHERE project_id IN (SELECT project_id FROM tbl_project WHERE account_manager_id = $account_manager_id) $where")->result();
	}

	public function getInterviewsByManagerID($manager_id = '', $search = '') {
		$where = '';
		if ($search != "") {
			$where = " AND candidate_id IN (SELECT candidate_id FROM tbl_candidate WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%')";
		}
		return $this->db->query("SELECT * FROM `tbl_interview` WHERE project_id IN (SELECT project_id FROM tbl_project WHERE manager_id = $manager_id) $where")->result();
	}

	public function getManagerInterviewsByProjectID($manager_id = '', $project_id = '') {
		$this->db->select('i.*');
		$this->db->from('tbl_project as p');
		$this->db->join('tbl_auth as a', 'a.profile_id = p.manager_id', 'left');
		$this->db->join('tbl_interview as i', 'i.project_id = p.project_id', 'left');
		$this->db->where('a.auth_id', $manager_id);
		$this->db->where('i.project_id', $project_id);
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}
	public function getInvitedProjects() {
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$ids = $this->db->get()->result();
		$data = array();
		foreach ($ids as $value) {
			$data[] = $value->project_id;
		}
		if ($data) {return $data;}
	}
	public function getInvitedProjectsByManager($manager_id = '') {
		$this->db->select('i.*');
		$this->db->from('tbl_invite_interview as i');
		$this->db->join('tbl_project as p', 'p.project_id = i.project_id', 'left');
		$this->db->where('p.manager_id', $manager_id);
		$ids = $this->db->get()->result();
		$data = array();
		foreach ($ids as $value) {
			$data[] = $value->project_id;
		}
		if ($data) {return $data;}
	}
	public function getCompletedInterviewByManager($manager_id = '') {
		$this->db->select('p.*');
		$this->db->from('tbl_project as p');
		$this->db->join('tbl_auth as a', 'a.profile_id = p.manager_id', 'left');
		$this->db->where('a.auth_id', $manager_id);
		$this->db->where('p.status', 'launch');
		$data = $this->db->get()->result();
		if ($data) {
			$candidate_ids = array();
			foreach ($data as $key => $value) {
				$candidate_ids = array_merge($candidate_ids, json_decode($value->candidate_id));
			}
			$candidate_ids = join(',', $candidate_ids);
			$interview = $this->db->query("SELECT * FROM tbl_interview WHERE candidate_id IN($candidate_ids)")->result();
			if ($interview) {return $interview;}
		}
	}
	public function accessLogin($candidate = '') {
		$this->db->set('status', 1);
		$this->db->where('candidate_id', $candidate);
		$this->db->update('tbl_candidate');
	}
	public function preventLogin($candidate = '') {
		$this->db->set('status', 0);
		$this->db->where('candidate_id', $candidate);
		$this->db->update('tbl_candidate');
	}
	public function checkInterviewDetail($candidate_id = '') {
		$this->db->select('ii.*,p.*');
		$this->db->from('tbl_invite_interview as ii');
		$this->db->join('tbl_project as p', 'p.project_id = ii.project_id', 'left');
		$this->db->where('p.status', 'launch');
		$this->db->where('ii.candidate_id', $candidate_id);
		$data = $this->db->get()->row_array();
		if ($data) {
			$now = date('Y-m-d');
			if ($data['project_type'] == 'open') {
				if ($data['start_date'] <= $now) {
					$interview = true;
				} else {
					$interview = false;
				}

			} else if ($data['project_type'] == 'expiry') {
				if ($data['start_date'] <= $now && $data['end_date'] >= $now) {
					$interview = true;
				} else {
					$interview = false;
				}

			} else {
				$interview = false;
			}
			return $interview;
		}
	}
	public function getInterviewDetails($candidate_id = '') {
		$this->db->select('i.*,p.*,jp.title,jp.role_title,jp.question_list');
		$this->db->from('tbl_invite_interview as i');
		$this->db->join('tbl_project as p', 'p.project_id = i.project_id', 'left');
		$this->db->join('tbl_job_profile as jp', 'jp.job_profile_id = p.profile_id', 'left');
		$this->db->where('i.candidate_id', $candidate_id);
		$interview = $this->db->get()->result();
		if ($interview) {return (array) $interview[0];}
	}
	public function updateInterviewCandidate($candidate_id = '') {
		$this->db->set('status', 0);
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_id', $candidate_id);
	}
	public function updateInterviewEmailType($candidate_id = '',$type = '') {
		$this->db->query("UPDATE `tbl_invite_interview` SET email_type = '{$type}' WHERE candidate_id = '{$candidate_id}'");
	}
	public function updateInterview($invite_id = '') {
		$this->db->set('status', 1);
		$this->db->from('tbl_invite_interview');
		$this->db->where('invite_id', $invite_id);
	}
	public function checkInterviewStatus($candidate_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('candidate_id', $candidate_id);
		$data = $this->db->get()->row_array();
		if ($data) {
			if ($data['start_status'] == '0' && $data['end_status'] == '0') {
				return 'pending';
			} else if ($data['start_status'] == '1' && $data['end_status'] == '0') {
				return 'cancel';
			} else {
				return 'complete';
			}
		}
	}
	public function setInterviewStartStatus($candidate_id = '') {
		$this->db->query("UPDATE `tbl_invite_interview` SET start_status = 1, status = 'cancel' WHERE candidate_id = '{$candidate_id}'");
	}
	public function setInterviewEndStatus($candidate_id = '') {
		$this->db->query("UPDATE `tbl_invite_interview` SET end_status = 1, status = 'complete' WHERE candidate_id = '{$candidate_id}'");
	}
	public function completeInterview($data = array()) {
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('invite_id', $data['invite_id']);
		$invite_detail = $this->db->get()->result()[0];
		$add = array(
			'interview_id' => '',
			'invite_id' => $data['invite_id'],
			'project_id' => $invite_detail->project_id,
			'candidate_id' => $invite_detail->candidate_id,
			'start' => $data['start_time'],
			'end' => $data['end_time'],
			'path' => $data['video-filename'],
			'status' => 1,
            'question_data' => $data['frm_question_data'],
		);
		$this->db->insert('tbl_interview', $add);

		$this->db->select('*');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_id', $invite_detail->candidate_id);
		$candidates = (array) $this->db->get()->result()[0];
		
		$subject = 'Interview Completed';
		$message = "The Specific Candidate Has Completed Interview." . "<br><br>";
		$message .= "Name : <b>" . $candidates['firstname'] . " " . $candidates['lastname'] . "</b><br>";
		$message .= "Email : <b>" . $candidates['email'] . "</b><br>";

		$mail = new Mail();
		$mail->setTo('info@e-interview.co.za');
		$mail->setFrom('info@e-interview.co.za');
		$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();

		$this->sendComletedEmailToRater($candidates,$invite_detail->project_id);

		return $this->db->insert_id();
	}
	public function getProjectName($project_id = '') {
		$this->db->select('project_name');
		$this->db->from('tbl_project');
		$this->db->where('project_id', $project_id);
		$data = $this->db->get()->row_array();
		if ($data) {
			return $data['project_name'];
		}
	}
	public function getManagerNameByProject($project_id = '') {
		$this->db->select('a.name as name');
		$this->db->from('tbl_project as p');
		$this->db->join('tbl_auth as a', 'a.auth_id = p.manager_id', 'left');
		$this->db->where('p.project_id', $project_id);
		$this->db->where('a.type', 'MANAGER');
		return $data = $this->db->get()->row_array()['name'];
	}
	public function sendComletedEmailToRater($candidates = array(),$project_id = ''){
		$project_name = $this->getProjectName($project_id);
		$manager_name = $this->getManagerNameByProject($project_id);

		$this->db->select('rater_id');
		$this->db->from('tbl_project');
		$this->db->where('project_id', $project_id);
		$raters = $this->db->get()->row_array();

		$subject = 'Interview Completed';
		$mail = new Mail();
		if($raters){
			foreach (json_decode($raters['rater_id'],true) as $rater_id) {
				$this->db->select('*');
				$this->db->from('tbl_rater');
				$this->db->where('rater_id', $rater_id);
				$rater = $this->db->get()->row_array();

				$message = "Dear, " . $rater['name'] . "<br><br>";
				$message .= "The following participant completed the e-interview and is now ready to be viewed and evaluated." . "<br><br>";
				$message .= $candidates['firstname'] . " " . $candidates['lastname'] . "<br>";
				$message .= $project_name . "<br><br>";
				$message .= "For more information, please contact ". $manager_name ."<br><br>";
				$message .= "Regards,<br>";
				$message .= $manager_name;

				$mail->setTo($rater['email']);
				$mail->setFrom('info@e-interview.co.za');
				$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
				$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
				$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
				$mail->send();
			}
		}
	}
	public function getInterviewCompleteDetails($candidate_id = '') {
		$this->db->select('i.*,ii.status as interview_status,p.project_name,p.notification,jp.title,jp.role_title');
		$this->db->from('tbl_interview as i');
		$this->db->join('tbl_invite_interview as ii', 'ii.invite_id = i.invite_id', 'left');
		$this->db->join('tbl_project as p', 'p.project_id = ii.project_id', 'left');
		$this->db->join('tbl_job_profile as jp', 'jp.job_profile_id = p.profile_id', 'left');
		$this->db->where('i.status', 1);
		$this->db->where('i.candidate_id', $candidate_id);
		$interview_data = $this->db->get()->result();
		if ($interview_data) {return (array) $interview_data[0];}
	}
	public function getInterviewStatus($candidate_id = '') {
		$this->db->select('ii.status as interview_status');
		$this->db->from('tbl_interview as i');
		$this->db->join('tbl_invite_interview as ii', 'ii.invite_id = i.invite_id', 'left');
		$this->db->where('i.candidate_id', $candidate_id);
		$interview_data = $this->db->get()->row_array();
		if ($interview_data) {return $interview_data['interview_status'];}
	}
	public function getCompleteInterviewNotification() {
		$this->db->select('c.*,i.*');
		$this->db->from('tbl_interview as i');
		$this->db->join('tbl_project as p', 'p.project_id = i.project_id', 'left');
		$this->db->join('tbl_candidate as c', 'c.candidate_id = i.candidate_id', 'left');
		$this->db->where('i.status', 1);
		$this->db->where('p.notification', 'on');
		$this->db->where('p.account_manager_id', $this->session->userdata['user']);
		$this->db->order_by("i.interview_id", "desc");
		$interview_data = $this->db->get()->result();
		if ($interview_data) {
			if (explode(' ', $interview_data[0]->end)[0] == date('j/n/Y')) {
				return (array) $interview_data;
			}
		}
	}
	public function getCompleteInterviewNotificationManager() {
		$this->db->select('c.*,i.*');
		$this->db->from('tbl_interview as i');
		$this->db->join('tbl_project as p', 'p.project_id = i.project_id', 'left');
		$this->db->join('tbl_candidate as c', 'c.candidate_id = i.candidate_id', 'left');
		$this->db->where('i.status', 1);
		$this->db->where('p.notification', 'on');
		$this->db->where('p.manager_id', $this->session->userdata['user']);
		$this->db->order_by("i.interview_id", "desc");
		$interview_data = $this->db->get()->result();
		if ($interview_data) {
			if (explode(' ', $interview_data[0]->end)[0] == date('j/n/Y')) {
				return (array) $interview_data;
			}
		}
	}
	public function getManagerID($id = '') {
		$this->db->select('m.manager_id');
		$this->db->from('tbl_manager as m');
		$this->db->join('tbl_auth as a', 'a.profile_id = m.manager_id', 'left');
		$this->db->where('a.auth_id', $id);
		return $data = $this->db->get()->row_array()['manager_id'];
	}
	public function getRaterEvaluation($interview_id = '',$rater_ids = array()) {
		$rater_evaluation = array();
		if($rater_ids){
			foreach ($rater_ids as $rater_id) {
				$this->db->select('*');
				$this->db->from('tbl_rater_evaluation');
				$this->db->where('interview_id', $interview_id);
				$this->db->where('rater_id', $rater_id);
				$data = $this->db->get()->row_array();
				$rater_evaluation[] = array(
					'rater_id'	=>	$rater_id,
					'name'		=>	$this->getRaterNameByID($rater_id),
					'rating'	=>	$data['rating'] ? $data['rating'] : '',
				);
			}
		}
		return $rater_evaluation;
	}
	public function getUserRaterEvaluation($interview_id = '',$rater_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_rater_evaluation');
		$this->db->where('interview_id', $interview_id);
		$this->db->where('rater_id', $rater_id);
		$data = $this->db->get()->row_array();
		$rater_evaluation = array(
			'rater_id'	=>	$rater_id,
			'name'		=>	$this->getRaterNameByID($rater_id),
			'rating'	=>	$data['rating'] ? $data['rating'] : '',
		);
		return $rater_evaluation;
	}
	public function getRaterNameByID($rater_id = '') {
		$this->db->select('name');
		$this->db->from('tbl_rater');
		$this->db->where('rater_id', $rater_id);
		return $data = $this->db->get()->row_array()['name'];
	}
	public function updateEvoRate($value, $where) {
		$this->db->trans_start();
		$this->db->where($where);
		$this->db->update('tbl_interview', $value);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	public function updateRaterEvoRate($value, $where) {
		$this->db->select('*');
		$this->db->from('tbl_rater_evaluation');
		$this->db->where($where);
		$data = $this->db->get()->row_array();
		if(empty($data)){
			$insert = array(
				'rating'	=>	$value['rating'],
				'interview_id'	=>	$where['interview_id'],
				'rater_id'	=>	$where['rater_id'],
			);
			$this->db->trans_start();
			$this->db->insert('tbl_rater_evaluation', $insert);
			$this->db->trans_complete();
			return $this->db->trans_status();
		}else{
			$this->db->trans_start();
			$this->db->where($where);
			$this->db->update('tbl_rater_evaluation', $value);
			$this->db->trans_complete();
			return $this->db->trans_status();
		}
	}

	public function getComment($field, $where,$type) {
		if($type == 'MANAGER' || $type == 'ACCOUNT MANAGER'){
			return $this->db->get_where('tbl_interview', $where)->row()->$field;	
		}else if($type == 'RATER'){
			return $this->db->get_where('tbl_rater_evaluation', $where)->row_array()[$field];
		}
	}

	public function saveComment($value, $where) {
		$this->db->trans_start();
		$this->db->where($where);
		$this->db->update('tbl_interview', $value);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	public function saveRaterComment($value, $where) {
		$this->db->select('*');
		$this->db->from('tbl_rater_evaluation');
		$this->db->where($where);
		$data = $this->db->get()->row_array();
		if(empty($data)){
			$insert = array(
				'comment'	=>	$value['comment'],
				'interview_id'	=>	$where['interview_id'],
				'rater_id'	=>	$where['rater_id'],
			);
			$this->db->trans_start();
			$this->db->insert('tbl_rater_evaluation', $insert);
			$this->db->trans_complete();
			return $this->db->trans_status();
		}else{
			$this->db->trans_start();
			$this->db->where($where);
			$this->db->update('tbl_rater_evaluation', $value);
			$this->db->trans_complete();
			return $this->db->trans_status();
		}
	}

	public function disableInterview($value = [], $where = []) {
		$this->db->trans_start();
		$this->db->where($where);
		$this->db->update('tbl_interview', $value);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	public function resetInterview($where = []) {
		$this->db->trans_start();
		$this->db->where($where);
		$this->db->delete('tbl_interview');
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	public function deleteInterviewCandidate($where = []) {
		$project_id = $where['project_id'];
		$candidate_id = $where['candidate_id'];

		$this->candidateDeleteInProject($where);
		$this->candidateDeleteInInterview($where);
		$this->candidateDeleteInInviteInterview($where);
		$this->candidateDeleteInCandidate(array('candidate_id' => $candidate_id));
		$this->candidateDeleteInAuth(array('profile_id' => $candidate_id,'type' => 'CANDIDATE'));

		return $this->db->trans_status();
	}
	public function candidateDeleteInProject($data = array()){
		$this->db->select('candidate_id');
		$this->db->from('tbl_project');
		$this->db->where('project_id',$data['project_id']);
		$datas = $this->db->get()->row_array();
		$candidate_ids = json_decode($datas['candidate_id'],true);

		if(is_array($candidate_ids)){
			foreach ($candidate_ids as $key => $value) 
				if($value == $data['candidate_id']) unset($candidate_ids[$key]);
			$update = array('candidate_id' => '['.implode(',', $candidate_ids).']');
			/*$update = array('candidate_id' => json_encode($candidate_ids));*/
		}else{
			$update = array('candidate_id' => '');
		}

		$this->db->where('project_id',$data['project_id']);
		$this->db->update('tbl_project', $update);
	}
	public function candidateDeleteInInterview($data = array()){
		$this->db->where('project_id',$data['project_id']);
		$this->db->where('candidate_id',$data['candidate_id']);
		$this->db->delete('tbl_interview');
	}
	public function candidateDeleteInInviteInterview($data = array()){
		$this->db->where('project_id',$data['project_id']);
		$this->db->where('candidate_id',$data['candidate_id']);
		$this->db->delete('tbl_invite_interview');
	}
	public function candidateDeleteInCandidate($data = array()){
		$this->db->where('candidate_id',$data['candidate_id']);
		$this->db->delete('tbl_candidate');
	}
	public function candidateDeleteInAuth($data = array()){
		$this->db->where('profile_id',$data['profile_id']);
		$this->db->where('type',$data['type']);
		$this->db->delete('tbl_auth');
	}
	public function mupdateInterview($value = [], $where = []) {
		$this->db->trans_start();
		$this->db->where($where);
		$this->db->update('tbl_interview', $value);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	public function rejectInterview($value = [], $where = []) {
		$this->db->trans_start();
		$this->db->where($where);
		$this->db->update('tbl_interview', $value);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	public function updateInviteInterview($value = [], $where = []) {
		$this->db->trans_start();
		$this->db->where($where);
		$this->db->update('tbl_invite_interview', $value);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	public function updateResetRater($value = [], $where = []) {
		$this->db->trans_start();
		$this->db->where($where);
		$this->db->update('tbl_rater_evaluation', $value);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}



	public function getCandidateInterviewsStatus($candidate_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('candidate_id', $candidate_id);
		$data = $this->db->get()->result_array();
		$status = false;
		if($data){
			foreach ($data as $value) {
				if($value['start_status'] == 0 && $value['end_status'] == 0){
					$status = true;
				}else{
					$status = false;
				}
			}
		}
		return $status;
	}

	public function undereConversion($data = array()) 
	{
		if($data && !empty($data))
		{
			$this->db->select('*');
			$this->db->from('tbl_invite_interview');
			$this->db->where('invite_id', $data['invite_id']);
			$invite_detail = $this->db->get()->result()[0];
			$add = array(
				'interview_id' => '',
				'invite_id' => $data['invite_id'],
				'project_id' => $invite_detail->project_id,
				'candidate_id' => $invite_detail->candidate_id,
				'start' => $data['start_time'],
				'end' => $data['end_time'],
				'path' => $data['video-filename'],
				'status' => 4,
				'question_data' => $data['frm_question_data'],
			);
			$this->db->insert('tbl_interview', $add);

			return $this->db->insert_id();
		}
		return false;
	}

	public function InterviewConversionComplete($data = array()) 
	{
		if($data['interview_id'] && $data['invite_id'])
		{		
			$this->db->set('status', 1)->where('interview_id', $data['interview_id'])->update('tbl_interview');

			$this->db->reset_query();

			$this->db->select('*');
			$this->db->from('tbl_invite_interview');
			$this->db->where('invite_id', $data['invite_id']);
			$invite_detail = $this->db->get()->result();

			if($invite_detail && !empty($invite_detail)){
				$invite_detail = $invite_detail[0];
			}
			else{
				return ;
			}
						
			$this->db->select('*');
			$this->db->from('tbl_candidate');
			$this->db->where('candidate_id', $invite_detail->candidate_id);
			$candidates = $this->db->get()->result_array();
			
			if(empty($candidates) || !$candidates){
				return;				
			}			
			$candidates = $candidates[0];

			$subject = 'Interview Completed';
			$message = "The Specific Candidate Has Completed Interview." . "<br><br>";
			$message .= "Name : <b>" . $candidates['firstname'] . " " . $candidates['lastname'] . "</b><br>";
			$message .= "Email : <b>" . $candidates['email'] . "</b><br>";

			$this->load->library(array('mail'));
			
			$mail = new Mail();
			$mail->setTo('info@e-interview.co.za');
			$mail->setFrom('info@e-interview.co.za');
			$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
			$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
			$mail->send();

			$this->sendComletedEmailToRater($candidates,$invite_detail->project_id);
		}

		return true;
	}

	public function getInterviewForProcess() 
	{
		$processList = array();

		$active  = $this->db->select('*')->from('tbl_interview')->where('status', '5')->get()->result_array();
	
		if(empty($active))
		{
			$processList  = $this->db->select('*')->from('tbl_interview')->where('status', '4')->limit(1)->get()->result_array();
		}

		return $processList;
	}
	
	public function startInterviewProcess($newProcessList = array())
	{
		if($newProcessList && !empty($newProcessList))
		{
			$this->db->set('status', 5)->where_in('interview_id', $newProcessList)->update('tbl_interview');

		}
		return true;
	}

	public function getActiveProcessInterview() 
	{
		$activeProcessList  = $this->db->select('*')->from('tbl_interview')->where('status', '5')->limit(1)->get()->result_array();
		
		return $activeProcessList;
	}

	public function failInterviewProcess($newProcessList = array(),$log='')
	{
		if($newProcessList && !empty($newProcessList))
		{
			$this->db->set(array('status' => 6,'error_log' => $log))->where_in('interview_id', $newProcessList)->update('tbl_interview');
		}
		return true;
	}

	public function updateActiveProcessInterviewCounter($newProcess)
	{
		if(isset($newProcess['video_status_call']))
		{
			$video_status_call = $newProcess['video_status_call'] ? ($newProcess['video_status_call'] + 1) : 1 ;			
			$this->db->set('video_status_call', $video_status_call)->where('interview_id', $newProcess['interview_id'])->update('tbl_interview');
		}		
	}

	public function getInterviewInfo($intereview_id='')
	{
		$interview_data = [];

		if($intereview_id){
			$this->db->select('*');
			$this->db->from('tbl_interview');
			$this->db->where('tbl_interview.interview_id', $intereview_id);
			$interview_data = $this->db->get()->row_array();
		}		
		return $interview_data;
	}
}
?>