<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager_model extends CI_Model{
	public function getManagers($account_manager_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_manager');
		$this->db->where('account_manager_id',$account_manager_id);
		$this->db->where('status != ',STATUS_DELETE,FALSE);
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
	public function getAuthDetailByManagerID($manager_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id',$manager_id);
		$this->db->where('type','MANAGER');
		$data = $this->db->get()->row_array();
		if($data){ return $data; }
	}
	public function getAccountManagerByManager($manager_id = ''){
		$this->db->select('m.account_manager_id');
		$this->db->from('tbl_manager as m');
		$this->db->join('tbl_auth as a','a.profile_id = m.manager_id');
		$this->db->where('a.auth_id',$manager_id);
		$this->db->where('a.type','MANAGER');
		$data = $this->db->get()->row_array();
		if($data){ return $data['account_manager_id']; }
	}
	public function getManagerName($manager_id = ''){
		$this->db->select('name');
		$this->db->from('tbl_manager');
		$this->db->where('manager_id',$manager_id);
		$data = $this->db->get()->row_array();
		if($data){ return $data['name']; }
	}
	public function getManagerNameByAuthID($manager_id = ''){
		$this->db->select('m.name');
		$this->db->from('tbl_manager as m');
		$this->db->join('tbl_auth as a','a.profile_id = m.manager_id');
		$this->db->where('a.auth_id',$manager_id);
		$this->db->where('a.type','MANAGER');
		$data = $this->db->get()->row_array();
		if($data){ return $data['name']; }
	}
	public function getManagerDetailByAuthID($manager_id = ''){
		$this->db->select('m.*');
		$this->db->from('tbl_manager as m');
		$this->db->join('tbl_auth as a','a.profile_id = m.manager_id');
		$this->db->where('a.auth_id',$manager_id);
		$this->db->where('a.type','MANAGER');
		$data = $this->db->get()->row_array();
		if($data){ return $data; }
	}
	public function getManagersBySearch($account_manager_id = '',$serach = ''){
		$data = $this->db->query("SELECT * FROM tbl_manager WHERE (account_manager_id = '{$account_manager_id}' AND name LIKE '%{$serach}%') AND (status != ".STATUS_DELETE.")");
		if($data){
			return (array)$data->result();	
		}
	}
	public function checkDuplicateEmail($email = '') {
		$this->db->select('email');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		$where = '(type = "MANAGER" OR type = "CLIENT")';
		$this->db->where($where);
		$data = $this->db->get()->row_array();
		if ($data) { return $data['email']; }
	}
	public function getAuthIDByManager($manager_id = ''){
		$this->db->select('auth_id');
		$this->db->from('tbl_auth');
		$this->db->where('profile_id', $manager_id);	
		$this->db->where('type', 'MANAGER');	
		$data = $this->db->get()->row_array();
		if ($data) { return $data['auth_id']; }
	}
	public function checkDuplicateUpdateEmail($email = '',$manager_id = '') {
		$auth_id = $this->getAuthIDByManager($manager_id);
		$this->db->select('email');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		$this->db->where('auth_id !=', $auth_id);
		$where = '(type = "MANAGER" OR type = "CLIENT")';
		$this->db->where($where);
		$data = $this->db->get()->row_array();
		if ($data) { return $data['email']; }
	}
	public function getAuthManager($auth_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id', $auth_id);
		$data = $this->db->get()->row_array();
		if ($data) {return $data;}
	}
	public function getDashboardManagers(){
		$this->db->select('*');
		$this->db->from('tbl_manager');
		$this->db->where('account_manager_id',$this->session->userdata['user']);
		$this->db->where('status != ',STATUS_DELETE,FALSE);
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
			'password'		=>	base64_encode($password),
			'type'			=>	'MANAGER',
		);
		$this->db->insert('tbl_auth',$auth);

		$client_data = $this->auth_model->getClientByID($data['account_manager_id']);
		$subject = 'Manager login to e-interview.co.za';
		$message = "Dear, ". $data['name'] ."<br><br>";
		$message .= "You have been registered on the " . $client_data['account_manager'] . " e-interview system as a Manager. As a Manager, you will be able to set up e-interviews for your company, as well as invite raters to view and evaluate e-interviews.<br><br>";
		$message .= "To log in, please go to " . base_url() . "<br>";
		$message .= "Username : <b>" . $data['email'] . "</b><br>";
		$message .= "Password : <b>" . $password . "</b><br><br>";
		$message .= "<b><i>(Please save your login details somewhere safe and do not share it with anyone)</i></b><br><br>";
		$message .= "Please do not hesitate to contact me if you have any questions.<br><br>";
		$message .= "Kind regards,<br>";
		$message .= $client_data['account_manager']."<br><br>";
		$message .= $client_data['name'];

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
		$this->Action_model->deleteRecord($manager_id,USER_MANAGER);
		/*
		$this->db->where('manager_id',$manager_id);
		$this->db->delete('tbl_manager');
		
		$this->db->where('profile_id',$manager_id);
		$this->db->where('type','MANAGER');
		$this->db->delete('tbl_auth');

		$this->db->where('manager_id',$manager_id);
		$this->db->delete('tbl_project');
		*/
	}
}
?>
