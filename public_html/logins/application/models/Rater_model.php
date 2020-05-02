<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rater_model extends CI_Model{
	public function getRaters($account_manager_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_rater');
		$this->db->where('account_manager_id',$account_manager_id);
        $this->db->where('status != ',STATUS_DELETE,FALSE);
		$data = $this->db->get()->result();
		if($data){ return (array)$data;	}
	}
	public function getRater($rater_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_rater');
		$this->db->where('rater_id',$rater_id);
        $this->db->where('status != ',STATUS_DELETE,FALSE);
		$data = $this->db->get()->row_array();
		if($data){ return $data; }
	}
	public function getAuthDetailByRaterID($rater_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('profile_id',$rater_id);
		$this->db->where('type','RATER');
		$data = $this->db->get()->row_array();
		if($data){ return $data; }
	}
	public function getNameByAuthID($rater_id = ''){
		$this->db->select('name');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id',$rater_id);
		$this->db->where('type','RATER');
		$data = $this->db->get()->row_array();
		if($data){ return $data['name']; }
	}
	public function getRaterIDByAuthID($rater_id = ''){
		$this->db->select('profile_id');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id',$rater_id);
		$this->db->where('type','RATER');
		$data = $this->db->get()->row_array();
		if($data){ return $data['profile_id']; }
	}
	public function getRaterProjects($rater_id = ''){
		$count = array();
		$rater_id = $this->getRaterIDByAuthID($rater_id);
		$this->db->select('project_id');
		$this->db->from('tbl_project');
		$this->db->where('rater_id LIKE','%'.$rater_id.'%');
		$data = $this->db->get()->result();
		foreach ($data as $key => $value) {
			$count[] = $value->project_id;
		}
		if($data) return $count;
	}
	public function getRatersName($rater_ids = array()){
		$rater = array();
		foreach ($rater_ids as $rater_id) {
			$this->db->select('name');
			$this->db->from('tbl_rater');
			$this->db->where('rater_id',$rater_id);
            $this->db->where('status != ',STATUS_DELETE,FALSE);
			$data = $this->db->get()->row_array();
			$rater[] = $data['name'];
		}
		return $rater;
	}
	public function getRatersBySearch($account_manager_id = '',$serach = ''){
		$data = $this->db->query("SELECT * FROM tbl_rater WHERE (account_manager_id = '{$account_manager_id}' AND name LIKE '%{$serach}%') AND (status != ".STATUS_DELETE.") ");
		if($data){
			return (array)$data->result();	
		}
	}
	public function checkDuplicateEmail($email = '') {
		$this->db->select('email');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		$where = '(type = "RATER" OR type = "CLIENT")';
		$this->db->where($where);
		$data = $this->db->get()->row_array();
		if ($data) { return $data['email']; }
	}
	public function getAuthIDByRater($rater_id = ''){
		$this->db->select('auth_id');
		$this->db->from('tbl_auth');
		$this->db->where('profile_id', $rater_id);	
		$this->db->where('type', 'RATER');	
		$data = $this->db->get()->row_array();
		if ($data) { return $data['auth_id']; }
	}
	public function checkDuplicateUpdateEmail($email = '',$rater_id = '') {
		$auth_id = $this->getAuthIDByRater($rater_id);
		$this->db->select('email');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		$this->db->where('auth_id !=', $auth_id);
		$where = '(type = "RATER" OR type = "CLIENT")';
		$this->db->where($where);
		$data = $this->db->get()->row_array();
		if ($data) { return $data['email']; }
	}
	public function getAuthRater($auth_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id', $auth_id);
		$data = $this->db->get()->row_array();
		if ($data) {return $data;}
	}
	public function getDashboardRaters(){
		$this->db->select('*');
		$this->db->from('tbl_rater');
		$this->db->where('manager_id',$this->session->userdata['user']);
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;	
		}
	}
	public function addRater($data = array(),$password = ''){
		$data['rater_id'] = '';
		$this->db->insert('tbl_rater',$data);
		$profile_id = $this->db->insert_id();

		$auth = array(
			'auth_id'		=>	'',
			'profile_id'	=>	$profile_id,
			'name'			=>	$data['name'],
			'email'			=>	$data['email'],
			'password'		=>	base64_encode($password),
			'type'			=>	'RATER',
		);
		$this->db->insert('tbl_auth',$auth);

		$manager_data = $this->manager_model->getAuthDetailByManagerID($data['manager_id']);
		$subject = 'Rater login to e-interview.co.za';
		$message = "Dear, ". $data['name'] ."<br><br>";
		$message .= "You have been registered on the e-interview system as a rater to view and evaluate interviews from applicants applying for the specific role. Please save your login details somewhere safe and do not share it with anyone.<br><br>";
		$message .= "To log in, please go to " . base_url() . "<br>";
		$message .= "Username : <b>" . $data['email'] . "</b><br>";
		$message .= "Password : <b>" . $password . "</b><br><br>";
		$message .= "Please be aware that the applicants may not have completed the e-interviews yet, so you might not be able to view and evaluate any interviews yet. You will be notified once a candidate completed an interview.<br><br>";
		$message .= "Please do not hesitate to contact me if you have any questions.<br><br>";
		$message .= "Kind regards,<br>";
		$message .= $manager_data['name'];

		$mail = new Mail();
		$mail->setTo($data['email']);
		$mail->setFrom('info@e-interview.co.za');
		$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();
	}
	public function updateRater($rater_id = '',$data = array()){
		$this->db->where('rater_id',$rater_id);
		$this->db->update('tbl_rater',$data);

		$update = array(
			'name'	=>	$data['name'],
			'email'	=>	$data['email'],
		);
		$this->db->where('profile_id',$rater_id);
		$this->db->where('type','RATER');
		$this->db->update('tbl_auth',$update);
	}
	public function removeRater($rater_id = '')
    {
        $this->Action_model->deleteRecord($rater_id,USER_RATER);

        /*
		$this->db->where('rater_id',$rater_id);
		$this->db->delete('tbl_rater');
		
		$this->db->where('profile_id',$rater_id);
		$this->db->where('type','RATER');
		$this->db->delete('tbl_auth');

		$this->db->where('rater_id',$rater_id);
		$this->db->delete('tbl_project');
        */
	}
}
?>