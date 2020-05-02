<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Account_manager_model extends CI_Model {
	public function getAccountManagers($distributor_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_account_manager');
		$this->db->where('distributor_id',$distributor_id);
		$this->db->where('status != ',STATUS_DELETE,FALSE);
		$data = $this->db->get()->result();
		if ($data) {return (array) $data;}
	}
	public function getAccountManager($account_manager_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_account_manager');
		$this->db->where('account_manager_id', $account_manager_id);
		$data = $this->db->get()->row_array();
		if ($data) {return $data;}
	}

	public function getAccountManagerByCandidate($candidate = '') {
		$this->db->select('tbl_auth.name');
		$this->db->from('tbl_candidate');
		$this->db->join('tbl_auth', 'tbl_auth.auth_id = tbl_candidate.account_manager_id');
		$this->db->where('tbl_candidate.candidate_id', $candidate);
		$data = $this->db->get()->row_array();
		if ($data) {return $data;}
	}

	public function getAuthAccountManager($auth_id = '') {
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
		$this->db->where('type', 'ACCOUNT MANAGER');
		$data = $this->db->get()->row_array();
		if ($data) {return $data['email'];}
	}
	public function checkDuplicateUpdateEmail($email = '', $hr_id = '') {
		$this->db->select('email');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		$this->db->where('profile_id !=', $hr_id);
		$this->db->where('type', 'ACCOUNT MANAGER');
		$data = $this->db->get()->row_array();
		if ($data) {return $data['email'];}
	}

	public function getAccountManagersBySearch($distributor_id = '',$serach = '') {
		$data = $this->db->query("SELECT * FROM tbl_account_manager WHERE (distributor_id = '{$distributor_id}' AND (account_manager LIKE '%{$serach}%' OR name LIKE '%{$serach}%')) AND (status != ".STATUS_DELETE.")");
		if ($data) {
			return (array) $data->result();
		}
	}
	public function getDashboardAccountManagers($distributor_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_account_manager');
		$this->db->where('distributor_id',$distributor_id);
		$this->db->where('status != ',STATUS_DELETE,FALSE);
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}
	public function addAccountManager($data = array(), $password = '') {
		$data['account_manager_id'] = '';
		$data['distributor_id'] = $this->session->userdata['user'];
		$this->db->insert('tbl_account_manager', $data);
		$profile_id = $this->db->insert_id();
		
		$minus_credit = $data['credits'];
		$loggedinUser = $this->session->userdata['profile_id'];
		$this->db->set('credits', "credits-$minus_credit", FALSE);
		$this->db->where('distributor_id', $loggedinUser);
		$this->db->update('tbl_distributor');

		$auth = array(
			'auth_id' => '',
			'profile_id' => $profile_id,
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => base64_encode($password),
			'type' => 'ACCOUNT MANAGER',
		);
		$this->db->insert('tbl_auth', $auth);
		
		$subject = 'Client login to e-interview.co.za';
		$message = "Dear, ". $data['name'] ."<br><br>";
		$message .= "You have been registered on the ". $data['account_manager'] ." e-interview system as an Client. As an Client, you will be able to set up managers who will be able to create projects and interview applicants. You will also be able to view all the projects of all your managers you created on your account. As an Client, you will be responsible for the credits required to view interviews. Should you run out of credits, your managers will not be able to view any interviews.<br><br>";
		$message .= "To log in, please go to " . base_url() . "<br>";
		$message .= "Username : <b>" . $data['email'] . "</b><br>";
		$message .= "Password : <b>" . $password . "</b><br>";
		$message .= "<b><i>(Please save your login details somewhere safe and do not share it with anyone)</i></b><br><br>";
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
		//$mail->addAttachment('/usr/www/users/einteajaxm/e-interview_infograph.pdf');
		$mail->addAttachment(APPPATH.'../e-interview_infograph.pdf');
		$mail->send();
	}
	public function updateAccountManager($account_manager_id = '', $data = array()) {
		$this->db->where('account_manager_id', $account_manager_id);
		$this->db->update('tbl_account_manager', $data);

		$update = array(
			'name' => $data['name'],
			'email' => $data['email'],
		);
		$this->db->where('profile_id', $account_manager_id);
		$this->db->where('type', 'ACCOUNT MANAGER');
		$this->db->update('tbl_auth', $update);
	}
	public function updateCredit($account_manager_id){
		$account_manager_details = $this->getAccountManager($account_manager_id);
		$distributor = $this->auth_model->getAuth($account_manager_details['distributor_id']);
		$credits = $account_manager_details['credits'];
		
		$this->db->set('credits', "credits+$credits", FALSE);
		$this->db->where('distributor_id', $distributor['profile_id']);
		$this->db->update('tbl_distributor');
	}
	public function removeAccountManager($account_manager_id = '') {
		$this->Action_model->deleteRecord($account_manager_id,USER_ACCOUNTMANAGER);
		/*
		$this->updateCredit($account_manager_id);

		$this->db->where('account_manager_id', $account_manager_id);
		$this->db->delete('tbl_account_manager');

		$this->db->where('profile_id', $account_manager_id);
		$this->db->where('type', 'ACCOUNT MANAGER');
		$this->db->delete('tbl_auth');

		$this->db->where('account_manager_id', $account_manager_id);
		$this->db->delete('tbl_project');
		*/
	}
}
?>
