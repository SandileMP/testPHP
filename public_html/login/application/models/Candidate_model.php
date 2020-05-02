<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Candidate_model extends CI_Model {
	public function checkLoginDetail($email = '', $password = '') {
		$this->db->select('*');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_email', $email);
		$this->db->where('candidate_password', base64_encode($password));
		$this->db->where('status', 1);
		$data = $this->db->get()->result();
		if ($data) {
			return $data[0]->candidate_id;
		}
	}
	public function getCandidates($manager_id = '') {
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
			$candidates = '';
			$candidate_ids = @join(',', $candidate_ids);
			$candidates = $this->db->query("SELECT * FROM tbl_candidate WHERE candidate_id IN($candidate_ids)")->result();
			if ($candidates) {return $candidates;}
		} else {
			return;
		}
	}
	public function addCandidate($data = array()) {
		$data['candidate_id'] = '';
		return $this->db->insert('tbl_candidate', $data);
	}
	public function removeCandidate($candidate_id = '') {
		$this->db->where('candidate_id', $candidate_id);
		$this->db->delete('tbl_candidate');
	}
	public function getCandidateName($candidate_ids = '') {
		$candidate_ids = json_decode($candidate_ids, true);
		$data = array();
		if ($candidate_ids) {
			foreach ($candidate_ids as $candidate_id) {
				$this->db->select('name');
				$this->db->from('tbl_auth');
				$this->db->where('profile_id', $candidate_id);
				$this->db->where('type', 'CANDIDATE');
				$res = $this->db->get()->row();
				if ($res) {
					$data[] = $res->name;
				}
			}
		}
		return $data;
	}
	public function getCandidateEmail($candidate_ids = '') {
		$candidate_ids = json_decode($candidate_ids);
		$data = array();
		foreach ($candidate_ids as $candidate_id) {
			$this->db->select('email');
			$this->db->from('tbl_auth');
			$this->db->where('profile_id', $candidate_id);
			$this->db->where('type', 'CANDIDATE');
			$res = $this->db->get()->row_array();
			$data[] = $res['email'];
		}
		return $data;
	}
	public function getProfileID($auth_id = '') {
		$this->db->select('profile_id');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id', $auth_id);
		$this->db->where('type', 'CANDIDATE');
		$res = $this->db->get()->row();
		return $res->profile_id;
	}
	public function getCandidateNameByID($candidate_id = '') {
		$this->db->select('name');
		$this->db->from('tbl_auth');
		$this->db->where('profile_id', $candidate_id);
		$this->db->where('type', 'CANDIDATE');
		$res = $this->db->get()->row();
		return $res->name;
	}
	public function getCandidateEmailByID($candidate_id = '') {
		$this->db->select('email');
		$this->db->from('tbl_auth');
		$this->db->where('profile_id', $candidate_id);
		$this->db->where('type', 'CANDIDATE');
		$res = $this->db->get()->row();
		return $res->email;
	}
	public function checkCandidates($email = '') {
		$this->db->select('*');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_email', $email);
		$data = $this->db->get()->result();
		if ($data) {return (array) $data;}
	}
	public function getCandidateID($email = '') {
		$this->db->select('candidate_id');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_email', $email);
		$res = $this->db->get()->result()[0];
		return $res->candidate_id;
	}
	public function getCandidateDetails($candidate_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('profile_id', $candidate_id);
		$this->db->where('type', 'CANDIDATE');
		$res = $this->db->get()->result()[0];
		return $res;
	}
	public function getCandidateInterview($candidate_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_interview');
		$this->db->where('candidate_id', $candidate_id);
		$res = $this->db->get()->result();
		if ($res) {return $res;}
	}
	public function checkCandidateProfile($candidate_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_id', $candidate_id);
		$this->db->where('status', 1);
		$res = $this->db->get()->result();
		if ($res) {return $res;}
	}
	public function getCandidateProfile($candidate_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_id', $candidate_id);
		$res = $this->db->get()->row_array();
		if ($res) {return $res;}
	}
	public function getNationalityList() {
		$this->db->select('alpha_3_code,nationality');
		$this->db->from('tbl_countries');
		$res = $this->db->get()->result();
		if ($res) {return $res;}
	}
	public function addRegisterCandidate($data = array()) {
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('project_code', $this->uri->segments[2]);
		$datas = $this->db->get()->row_array();

		$add = array(
			'candidate_id' => '',
			'client_id' => $datas['client_id'],
			'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'image' => '',
			'id' => $data['id'],
			'dob' => $data['dob'],
			'gender' => $data['gender'],
			'age' => $data['age'],
			'nationality' => $data['nationality'],
			'ethnicity' => $data['ethnicity'],
			'highest_education' => $data['highest_education'],
			'marital_status' => $data['marital_status'],
			'employeement_status' => $data['employeement_status'],
			'home_language' => $data['home_language'],
			'current_job_level' => $data['current_job_level'],
			'status' => 1,
		);
		$insert_profile = $this->db->insert('tbl_candidate', $add);
		$candidate_id = $this->db->insert_id();

		$create = array(
			'name' => $data['firstname'] . ' ' . $data['lastname'],
			'email' => $data['email'],
			'candidate_id' => $candidate_id,
		);
		$auth_id = $this->createCandidate($create);
		if ($datas['candidate_id'] != 'null') {
			$candidates = array(
				'candidate_id' => json_encode(array_merge(json_decode($datas['candidate_id']), (array) $candidate_id)),
			);
		} else {
			$candidates = array(
				'candidate_id' => json_encode((array) $candidate_id),
			);
		}
		$this->db->where('project_code', $this->uri->segments[2]);
		$this->db->update('tbl_project', $candidates);

		$this->addInvites($candidate_id, $this->uri->segments[2]);
		return $auth_id;
	}
	public function updateRegisterCandidate($candidate_id = '', $data = array()) {
		$update = array(
			'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'image' => '',
			'id' => $data['id'],
			'dob' => $data['dob'],
			'gender' => $data['gender'],
			'age' => $data['age'],
			'nationality' => $data['nationality'],
			'ethnicity' => $data['ethnicity'],
			'highest_education' => $data['highest_education'],
			'marital_status' => $data['marital_status'],
			'employeement_status' => $data['employeement_status'],
			'home_language' => $data['home_language'],
			'current_job_level' => $data['current_job_level'],
			'status' => 1,
		);
		$this->db->where('candidate_id', $candidate_id);
		return $this->db->update('tbl_candidate', $update);
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
	public function addInvites($candidate_id = '', $project_code = '') {
		$this->db->select('project_id');
		$this->db->from('tbl_project');
		$this->db->where('project_code', $project_code);
		$data = $this->db->get()->row_array();
		$add = array(
			'invite_id' => '',
			'project_id' => $data['project_id'],
			'candidate_id' => $candidate_id,
			'note' => '',
			'start_status' => 0,
			'end_status' => 0,
			'status' => 'pending',
		);
		$this->db->insert('tbl_invite_interview', $add);

		$start_date = $this->getProjectDate($data['project_id']);
		$credentials = $this->getCandidateDetails($candidate_id);
		$manager_name = $this->getManagerNameByProject($data['project_id']);
		$client_name = $this->getClientByProject($data['project_id']);

		$subject = 'e-interview login details';
		$message = "Dear, " . $credentials->name . "<br><br>";
		$message .= "Thank you for registering your details on the e-interview.co.za platform. Should you wish to complete your interview at a later stage, please use the following login information to log back into your account:" . "<br><br>";
		$message .= "Website : <strong>" . base_url() . "</strong><br>";
		$message .= "Username : <strong>" . $credentials->email . "</strong><br>";
		$message .= "Password : <strong>" . base64_decode($credentials->password) . "</strong><br><br>";
		$message .= "Thank You" . "<br><br>";
		$message .= $client_name['name'] . "<br>";
		$message .= $client_name['client'];

		$mail = new Mail();
		$mail->setTo($credentials->email);
		$mail->setFrom('info@e-interview.co.za');
		$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();
	}
	public function createCandidate($data = array()) {
		$password = $this->email_password();
		$addauth = array(
			'auth_id' => '',
			'profile_id' => $data['candidate_id'],
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => base64_encode($password),
			'type' => 'CANDIDATE',
		);
		$this->db->insert('tbl_auth', $addauth);
		return $this->db->insert_id();
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

	public function updateCandidate($value, $where) {
		$this->db->trans_start();
		$this->db->where($where);
		$this->db->update('tbl_candidate', $value);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
}
?>