<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Manage_project_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getProjects($manager_id = '') {
		$this->db->select('p.*');
		$this->db->from('tbl_project as p');
		$this->db->join('tbl_auth as a', 'p.manager_id = a.profile_id', 'left');
		$this->db->where('a.auth_id', $manager_id);
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}

	public function getProjectsBySearch($manager_id = '', $serach = '') {
		$this->db->select('profile_id');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id', $manager_id);
		$this->db->where('type', 'MANAGER');
		$result = $this->db->get()->row_array();
		if($result){
			$data = $this->db->query("SELECT * FROM tbl_project WHERE manager_id = '{$result['profile_id']}' AND project_name LIKE '%{$serach}%'");
			if ($data) {
				return (array) $data->result();
			}
		}else{
			return array();
		}

	}
	public function checkProjectDetail($project_code = '') {
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('project_code', $project_code);
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

	public function getProjectDetailById($project_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('project_id', $project_id);
		$data = $this->db->get()->row_array();
		return $data;
	}

	public function getProjectDetail($project_code = '') {
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('project_code', $project_code);
		$data = $this->db->get()->row_array();
		return $data;
	}

	public function getDashboardProjects() {
		$this->db->select('*');
		$this->db->from('tbl_project');
		if ($this->session->userdata['user_type'] == 'CLIENT') {
			$this->db->where('client_id', $this->session->userdata['user']);
		}
		if ($this->session->userdata['user_type'] == 'MANAGER') {
			$this->db->where('manager_id', $this->session->userdata['user']);
		}
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}
	public function getProject($project_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('project_id', $project_id);
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data[0];
		}
	}
	public function addProjects($data = array()) {
		$project_code = $this->generate_project_code();
		$candidate_id = array();
		if(isset($data['candidate'])){
			foreach ($data['candidate'] as $key => $value) {
				$candidate_id[] = $this->createCandidate($value);
			}
			$candidates = json_encode($candidate_id);
		}else{
			$candidates = '';
		}

		if (!isset($data['open_project'])) {
			$project_type = 'expiry';
		} else {
			$project_type = 'open';
			$data['end_date'] = '';
		}
		$add = array(
			'project_id' => '',
			'project_name' => $data['project_name'],
			'project_code' => $project_code,
			'profile_id' => $data['profile_name'],
			'client_id' => $data['client_id'],
			'manager_id' => $data['profile_manager'],
			'candidate_id' => $candidates,
			'project_type' => $project_type,
			'start_date' => $data['start_date'],
			'end_date' => $data['end_date'],
			'notification' => $data['notification'],
			'status' => $data['project_status'],
		);
		$mail_data = array(
			'manager_id'	=>	$data['profile_manager'],
			'client_id'		=>	$data['client_id'],
			'role_profile'	=>	$data['profile_name'],
		);
		$this->sendMailToManager($mail_data);

		if ($data['project_status'] == 'launch') {
			$this->db->insert('tbl_project', $add);
			$project_id = $this->db->insert_id();
			$this->sendEmailInvite($project_id);
			return true;
		} else {
			return $this->db->insert('tbl_project', $add);
		}
	}
	public function updateProject($project_id = '', $data = array()) {
		$candidate_id = array();
		if (isset($data['candidate'])) {
			$this->db->select('candidate_id');
			$this->db->from('tbl_project');
			$this->db->where('project_id', $project_id);
			$datas = $this->db->get()->row_array()['candidate_id'];

			foreach ($data['candidate'] as $key => $value) {
				$candidate_id[] = $this->createCandidate($value);
			}
			if($datas){
				$candidates = array(
					'candidate_id' => json_encode(array_merge(json_decode($datas), $candidate_id)),
				);
			}else{
				$candidates = array(
					'candidate_id' => json_encode($candidate_id),
				);
			}
			$this->db->where('project_id', $project_id);
			$this->db->update('tbl_project', $candidates);
		}

		if (!isset($data['open_project'])) {
			$project_type = 'expiry';
		} else {
			$project_type = 'open';
			$data['end_date'] = '';
		}
		$project_detail = $this->getProjectDetailById($project_id);
		$update = array(
			'project_name' => $data['project_name'],
			'profile_id' => $data['profile_name'],
			'manager_id' => $data['profile_manager'],
			'project_type' => $project_type,
			'start_date' => $data['start_date'],
			'end_date' => $data['end_date'],
			'notification' => $data['notification'],
			'status' => $data['project_status'],
		);
		$this->db->where('project_id', $project_id);
		$this->db->update('tbl_project', $update);

		if($project_detail['manager_id'] != $data['profile_manager']){
			$mail_data = array(
				'manager_id'	=>	$data['profile_manager'],
				'client_id'		=>	$project_detail['client_id'],
				'role_profile'	=>	$data['profile_name'],
			);
			$this->sendMailToManager($mail_data);
		}
		if ($data['project_status'] == 'launch') {
			$this->sendEmailInvite($project_id);
		}
	}
	public function removeProject($project_id = '') {
		$this->db->where('project_id', $project_id);
		$this->db->delete('tbl_project');

		$this->db->where('project_id', $project_id);
		$this->db->delete('tbl_invite_interview');
	}
	public function sendMailToManager($data = array()) {
		$manager_data = $this->manager_model->getAuthDetailByManagerID($data['manager_id']);
		if($manager_data){
			$client_data = $this->auth_model->getClientByID($data['client_id']);
			$role_profile = $this->job_profile_model->getRoleProfileName($data['role_profile']);
			
			$subject = 'Manager login to e-interview.co.za';
			$message = "Dear, " . $manager_data['name'] . "<br><br>";
			$message .= "You have been registered on the ". $client_data['client'] ." e-interview system as a
						manager to view and evaluate interviews from applicants applying for the ". $role_profile .".
						Please save your login details somewhere safe and do not share it with anyone." . "<br><br>";
			$message .= "To log in, please go to " . base_url() . "<br>";
			$message .= "Username : <b>" . $manager_data['email'] . "</b><br>";
			$message .= "Password : <b>" . base64_decode($manager_data['password']) . "</b><br><br>";
			$message .= "Please be aware that the applicants may not have completed the e-interviews yet, so you
						might not be able to view and evaluate any interviews yet. You will be notified once<br><br>";
			$message .= "Please do not hesitate to contact me if you have any questions.<br><br>";
			$message .= "Kind regards,<br>";
			$message .= $client_data['client'];

			$mail = new Mail();
			$mail->setTo($manager_data['email']);
			$mail->setFrom('info@e-interview.co.za');
			$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
			$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
			$mail->send();
		}
	}
	public function getProjectName($project_id = '') {
		$this->db->select('project_name');
		$this->db->from('tbl_project');
		$this->db->where('project_id', $project_id);
		$data = $this->db->get()->result()[0];
		if ($data) {
			return $data->project_name;
		}
	}
	public function getProjectCode($project_id = '') {
		$this->db->select('project_code');
		$this->db->from('tbl_project');
		$this->db->where('project_id', $project_id);
		$data = $this->db->get()->result()[0];
		if ($data) {
			return $data->project_code;
		}
	}
	public function getProjectDescription($project_id = '') {
		$this->db->select('project_description');
		$this->db->from('tbl_project');
		$this->db->where('project_id', $project_id);
		$data = $this->db->get()->result()[0];
		if ($data) {
			return $data->project_description;
		}
	}
	public function getProjectsByManager($manager_id = '') {
		$this->db->select('p.*');
		$this->db->from('tbl_auth as a');
		$this->db->join('tbl_project as p', 'p.manager_id = a.profile_id', 'left');
		$this->db->where('p.status', 'launch');
		$this->db->where('a.auth_id', $manager_id);
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}
	public function getCandidates($data = array()) {
		$candidates = array();
		if($data){
			foreach ($data as $key => $candidate_id) {
				$this->db->select('candidate_id,firstname,lastname,email');
				$this->db->from('tbl_candidate');
				$this->db->where('candidate_id', $candidate_id);
				$data = $this->db->get()->row_array();
				$candidates[] = array(
					'candidate_id' => $data['candidate_id'],
					'candidate_name' => $data['firstname'] . '&nbsp;' . $data['lastname'],
					'candidate_email' => $data['email'],
				);
			}
		}
		return $candidates;
	}
	public function getProjectCandidates($project_id = '') {
		$this->db->select('candidate_id');
		$this->db->from('tbl_project');
		$this->db->where('project_id', $project_id);
		$data = $this->db->get()->row_array();
		if ($data) {
			return $data['candidate_id'];
		}
	}
	public function getProjectDate($project_id = '') {
		$this->db->select('start_date');
		$this->db->from('tbl_project');
		$this->db->where('project_id', $project_id);
		$data = $this->db->get()->row_array();
		if ($data) {
			return $data['start_date'];
		}
	}
	public function getManagerNameByProject($project_id = '') {
		$this->db->select('m.name as name');
		$this->db->from('tbl_project as p');
		$this->db->join('tbl_manager as m', 'm.manager_id = p.manager_id', 'left');
		$this->db->where('p.project_id', $project_id);
		return $data = $this->db->get()->row_array()['name'];
	}
	public function getClientByProject($project_id = '') {
		$this->db->select('c.name,c.client');
		$this->db->from('tbl_project as p');
		$this->db->join('tbl_auth as a', 'a.auth_id = p.client_id', 'left');
		$this->db->join('tbl_client as c', 'c.client_id = a.profile_id', 'left');
		$this->db->where('p.project_id', $project_id);
		return $data = $this->db->get()->row_array();
	}
	public function getLaunchedProjects() {
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('status', 'launch');
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}
	public function getLaunchedProjectsByManager($manager_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('status', 'launch');
		$this->db->where('manager_id', $manager_id);
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}
	public function createCandidate($data = array()) {
		$password = $this->email_password();
		$candidate_id = $this->createCandidateProfile($data);

		$addauth = array(
			'auth_id' => '',
			'profile_id' => $candidate_id,
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => base64_encode($password),
			'type' => 'CANDIDATE',
		);
		$this->db->insert('tbl_auth', $addauth);
		return $candidate_id;
	}
	public function createCandidateProfile($data = array()) {
		$names = @explode(' ', $data['name']);
		if (!empty($names[0])) {
			$firstname = $names[0];
		} else {
			$firstname = '';
		}

		if (!empty($names[1])) {
			$lastname = $names[1];
		} else {
			$lastname = '';
		}

		$add = array(
			'candidate_id' => '',
			'client_id' => $this->session->userdata['user'],
			'firstname' => $firstname,
			'lastname' => $lastname,
			'email' => $data['email'],
			'phone' => '',
			'image' => '',
			'id' => '',
			'dob' => '',
			'gender' => '',
			'age' => '',
			'nationality' => '',
			'ethnicity' => '',
			'highest_education' => '',
			'marital_status' => '',
			'employeement_status' => '',
			'home_language' => '',
			'status' => 0,
		);
		$this->db->insert('tbl_candidate', $add);
		return $this->db->insert_id();
	}
	public function sendEmailInvite($project_id = '') {
		$mail = new Mail();
		$project_data = $this->project_model->getProject($project_id);
		if($project_data['candidate_id']){
			foreach (json_decode($project_data['candidate_id']) as $key => $candidate_id) {
				$invites = $this->interview_model->getCandidateInvite($project_id, $candidate_id);
				if (!$invites) {

					$emailer = $this->candidate_model->getCandidateEmailByID($candidate_id);
					$postData = array(
						'invite_id' => '',
						'project_id' => $project_id,
						'candidate_id' => $candidate_id,
						'note' => '',
						'start_status' => 0,
						'end_status' => 0,
						'status' => 'pending',
					);
					$start_date = $this->getProjectDate($project_id);
					$this->interview_model->addInvite($postData);
					$credentials = $this->candidate_model->getCandidateDetails($candidate_id);
					$manager_name = $this->getManagerNameByProject($project_id);
					$client_name = $this->getClientByProject($project_id);

					$subject = 'Invitation to complete e-interview';
					$message = "Dear, " . $credentials->name . "<br><br>";
					$message .= "You have invited you to participate in an e-interview. An e-interview is in all aspects the
								same as a traditional interview, except that you will not be interviewed by a person but will
								be presented with a set of pre-selected questions and your interview will be recorded using
								your communication device’s webcam. Your recorded interview will then be available for
								review by the interview panel." . "<br><br>";
					$message .= "It is very important that you prepare for this interview in the same way you would for a
								normal interview." . "<br><br>";
					$message .= "Link : <strong>" . base_url() . "</strong><br>";
					$message .= "Username : <strong>" . $credentials->email . "</strong><br>";
					$message .= "Password : <strong>" . base64_decode($credentials->password) . "</strong><br><br>";
					$message .= "Good luck with your e-interview!" . "<br><br>";
					$message .= "Kind Regards" . "<br>";
					$message .= $client_name['name']."<br>";
					$message .= $client_name['client'];

					$mail = new Mail();
					$mail->setTo($credentials->email);
					$mail->setFrom('info@e-interview.co.za');
					$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
					$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
					$mail->send();
				}
			}
		}
	}
	public function email_password() {
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double) microtime() * 1000000);
		$i = 0;
		$pass = '';
		while ($i <= 9) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}
	public function generate_project_code() {
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double) microtime() * 1000000);
		$i = 0;
		$pass = '';
		while ($i <= 15) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}
	public function checkInterviewStatus($project_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('project_id', $project_id);
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}
	public function countCompletedInterview($project_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('project_id', $project_id);
		$this->db->where('status', 'complete');
		$data = $this->db->get()->result();
		return count($data);
	}
	public function countCompletedInterviewByCandidate($candidate_id = '', $project_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_interview');
		$this->db->where('candidate_id', $candidate_id);
		$this->db->where('project_id', $project_id);
		$this->db->where('status', 1);
		$data = $this->db->get()->result();
		return count($data);
	}
	public function InterviewStatusByCandidate($candidate_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('candidate_id', $candidate_id);
		$data = $this->db->get()->row_array();
		if ($data) {
			if ($data['status'] == 'complete') {
				return 1;
			} else {
				return 0;
			}
		}
	}
	public function countTotalInterviewByCandidate($candidate_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('candidate_id', $candidate_id);
		$data = $this->db->get()->result();
		return count($data);
	}

	public function deductCredit($profile_id) {
		$credits = $this->db->get('tbl_credit')->row()->credit;
		$this->db->set("credits", "credits-$credits", FALSE);
		$this->db->where('client_id', $profile_id);
		if ($this->db->update('tbl_client')) {
			return true;
		}
	}
}
?>