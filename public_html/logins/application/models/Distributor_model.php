<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Distributor_model extends CI_Model {
	public function getDistributors() {
		$this->db->select('*');
		$this->db->from('tbl_distributor');
		$this->db->where('status != ',STATUS_DELETE,FALSE);
		$data = $this->db->get()->result();
		if ($data) {return (array) $data;}
	}
	public function getDistributor($distributor_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_distributor');
		$this->db->where('distributor_id', $distributor_id);
		$data = $this->db->get()->row_array();
		if ($data) {return $data;}
	}

	public function getDistributorByCandidate($candidate = '') {
		$this->db->select('tbl_auth.name');
		$this->db->from('tbl_candidate');
		$this->db->join('tbl_auth', 'tbl_auth.auth_id = tbl_candidate.distributor_id');
		$this->db->where('tbl_candidate.candidate_id', $candidate);
		$data = $this->db->get()->row_array();
		if ($data) {return $data;}
	}

	public function getAuthDistributor($auth_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id', $auth_id);
		$this->db->where('type', 'DISTRIBUTOR');
		$data = $this->db->get()->row_array();
		if ($data) {return $data;}
	}
	public function checkDuplicateEmail($email = '') {
		$this->db->select('email');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		$this->db->where('type', 'DISTRIBUTOR');
		$data = $this->db->get()->row_array();
		if ($data) {return $data['email'];}
	}
	public function checkDuplicateUpdateEmail($email = '', $hr_id = '') {
		$this->db->select('email');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		$this->db->where('profile_id !=', $hr_id);
		$this->db->where('type', 'DISTRIBUTOR');
		$data = $this->db->get()->row_array();
		if ($data) {return $data['email'];}
	}

	public function getDistributorsBySearch($serach = '') {
		$data = $this->db->query("SELECT * FROM tbl_distributor WHERE (distributor LIKE '%{$serach}%' OR name LIKE '%{$serach}%') AND (status != ".STATUS_DELETE.")");
		if ($data) {
			return (array) $data->result();
		}
	}
	public function getDashboardDistributors() {
		$this->db->select('*');
		$this->db->from('tbl_distributor');
		$this->db->where('status != ',STATUS_DELETE,FALSE);
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}
	public function addDistributor($data = array(), $password = '') {
		$data['distributor_id'] = '';
		$data['admin_id'] = $this->session->userdata['user'];
		$this->db->insert('tbl_distributor', $data);
		$profile_id = $this->db->insert_id();

		$auth = array(
			'auth_id' => '',
			'profile_id' => $profile_id,
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => base64_encode($password),
			'type' => 'DISTRIBUTOR',
		);
		$this->db->insert('tbl_auth', $auth);
		
		$subject = 'Registration as Distributor';
		$message = "Dear, ". $data['name'] ."<br><br>";
		$message .= "We welcome ". $data['distributor'] ." as an e-Interview platform distributor. As a system distributor, you can sell the e-interview platform directly to your clients and manage their accounts.<br><br>";
		$message .= "<strong>Credits</strong><br>";
		$message .= "The e-interview platform works on a credit system, where clients pay for the services using credits.<br>";
		$message .= "Each e-interview costs 1 (one) credit and is only deducted from their account once they view the recorded e-interview. Your clients will be able to administer e-interviews without credits, however they will not be able to view and rate the e-interviews.<br>";
		$message .= "To create a new client, you will need at least one (1) credit as a distributor. When your clients request credits from you, you will also need the amount of credits requested on your platform before you can approve their request.<br><br>";
		$message .= "<strong>Login</strong><br>";
		$message .= "Link : " . base_url() . "<br>";
		$message .= "Username : <b>" . $data['email'] . "</b><br>";
		$message .= "Password : <b>" . $password . "</b><br>";
		$message .= "<strong><i>(Please do not share your login details).</i></strong><br><br>";
		$message .= "Please familiarise yourself with the system and contact us should you have any questions.<br><br>";
		$message .= "Kind regards,<br>";
		$message .= "E-Interview Team";

		$mail = new Mail();
		$mail->setTo($data['email']);
		$mail->setFrom('info@e-interview.co.za');
		$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		//$mail->addAttachment('/usr/www/users/einteajaxm/e-interview_infograph.pdf');
		$mail->addAttachment(APPPATH.'../e-interview_infograph.pdf');
		$mail->send();
	}
	public function updateDistributor($distributor_id = '', $data = array()) {
		$this->db->where('distributor_id', $distributor_id);
		$this->db->update('tbl_distributor', $data);

		$update = array(
			'name' => $data['name'],
			'email' => $data['email'],
		);
		$this->db->where('profile_id', $distributor_id);
		$this->db->where('type', 'DISTRIBUTOR');
		$this->db->update('tbl_auth', $update);
	}
	public function removeDistributor($distributor_id = '') {
		$this->Action_model->deleteRecord($distributor_id,USER_DISTRIBUTOR);
		/*
		$this->db->where('distributor_id', $distributor_id);
		$this->db->delete('tbl_distributor');

		$this->db->where('profile_id', $distributor_id);
		$this->db->where('type', 'DISTRIBUTOR');
		$this->db->delete('tbl_auth');
		*/
	}
}
?>
