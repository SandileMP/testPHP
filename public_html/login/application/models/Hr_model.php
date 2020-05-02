<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Hr_model extends CI_Model {
	public function getHrs() {
		$this->db->select('*');
		$this->db->from('tbl_client');
		$data = $this->db->get()->result();
		if ($data) {return (array) $data;}
	}
	public function getHr($client_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_client');
		$this->db->where('client_id', $client_id);
		$data = $this->db->get()->row_array();
		if ($data) {return $data;}
	}

	public function getHrByCandidate($candidate = '') {
		$this->db->select('tbl_auth.name');
		$this->db->from('tbl_candidate');
		$this->db->join('tbl_auth', 'tbl_auth.auth_id = tbl_candidate.client_id');
		$this->db->where('tbl_candidate.candidate_id', $candidate);
		$data = $this->db->get()->row_array();
		if ($data) {return $data;}
	}

	public function getAuthHr($auth_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id', $auth_id);
		$data = $this->db->get()->row_array();
		if ($data) {return $data;}
	}
	public function checkDuplicateEmail($email = '') {
		$this->db->select('email');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		$this->db->where('type', 'CLIENT');
		$data = $this->db->get()->row_array();
		if ($data) {return $data['email'];}
	}
	public function checkDuplicateUpdateEmail($email = '', $hr_id = '') {
		$this->db->select('email');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		$this->db->where('profile_id !=', $hr_id);
		$this->db->where('type', 'CLIENT');
		$data = $this->db->get()->row_array();
		if ($data) {return $data['email'];}
	}

	public function getHrsBySearch($serach = '') {
		$data = $this->db->query("SELECT * FROM tbl_client WHERE client LIKE '%{$serach}%' OR name LIKE '%{$serach}%'");
		if ($data) {
			return (array) $data->result();
		}
	}
	public function getDashboardClients() {
		$this->db->select('*');
		$this->db->from('tbl_client');
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}
	public function addHr($data = array(), $password = '') {
		$data['client_id'] = '';
		$data['admin_id'] = $this->session->userdata['user'];
		$this->db->insert('tbl_client', $data);
		$profile_id = $this->db->insert_id();

		$auth = array(
			'auth_id' => '',
			'profile_id' => $profile_id,
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => base64_encode($password),
			'type' => 'CLIENT',
		);
		$this->db->insert('tbl_auth', $auth);
		
		$subject = 'Client login to e-interview.co.za';
		$message = "Dear, " . $data['name'] . "<br><br>";
		$message .= "You have been registered on the ". $data['client'] ." e-interview system as a client
					administrator. As a client administrator, you will be able to set up e-interviews for your
					company, as well as invite managers to view and evaluate e-interviews. You will find a
					manual on how to use the system on the Dashboard after you logged in." . "<br><br>";
		$message .= "To log in, please go to " . base_url() . "<br>";
		$message .= "Username : <strong>" . $data['email'] . "</strong><br>";
		$message .= "Password : <strong>" . $password . "</strong><br>";
		$message .= "<strong><i>(Please save your login details somewhere safe and do not share it with anyone)</i></strong><br><br>";
		$message .= "Please do not hesitate to contact us if you have any questions.<br><br>";
		$message .= "Kind regards,<br>";
		$message .= "The e-Interview admin team<br>";
		$message .= "admin@e-interview.co.za";

		$mail = new Mail();
		$mail->setTo($data['email']);
		$mail->setFrom('info@e-interview.co.za');
		$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();
	}
	public function updateHr($client_id = '', $data = array()) {
		$this->db->where('client_id', $client_id);
		$this->db->update('tbl_client', $data);

		$update = array(
			'name' => $data['name'],
			'email' => $data['email'],
		);
		$this->db->where('profile_id', $client_id);
		$this->db->where('type', 'CLIENT');
		$this->db->update('tbl_auth', $update);
	}
	public function removeHr($client_id = '') {
		$this->db->where('client_id', $client_id);
		$this->db->delete('tbl_client');

		$this->db->where('profile_id', $client_id);
		$this->db->where('type', 'CLIENT');
		$this->db->delete('tbl_auth');

		$this->db->where('client_id', $client_id);
		$this->db->delete('tbl_job_profile');

		$this->db->where('client_id', $client_id);
		$this->db->delete('tbl_project');
		//$this->deleteHrManager($client_id);
	}
	public function deleteHrManager($client_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_manager');
		$this->db->where('client_id', $client_id);
		$data = $this->db->get()->result();
		foreach ($data as $key => $manager) {
			$this->db->where('manager_id', $manager->manager_id);
			$this->db->delete('tbl_manager');

			$this->db->where('profile_id', $manager->manager_id);
			$this->db->where('type', 'MANAGER');
			$this->db->delete('tbl_auth');
		}
	}

}
?>