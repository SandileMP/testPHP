<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidate_model extends CI_Model{
	public function checkLoginDetail($email = '',$password = ''){
		$this->db->select('*');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_email',$email);
		$this->db->where('candidate_password',$password);
		$this->db->where('status',1);
		$data = $this->db->get()->result();
		if($data){
			return $data[0]->candidate_id;
		}
	}
	public function getCandidates($manager_id = ''){
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
			$candidates = '';
			$candidate_ids = @join(',',$candidate_ids);
			$candidates = $this->db->query("SELECT * FROM tbl_candidate WHERE candidate_id IN($candidate_ids)")->result();
			if($candidates){ return $candidates; }
		}else{
			return;
		}
	}
	public function addCandidate($data = array()){
		$data['candidate_id'] =	'';
		return $this->db->insert('tbl_candidate',$data);
	}
	public function removeCandidate($candidate_id = ''){
		$this->db->where('candidate_id',$candidate_id);
		$this->db->delete('tbl_candidate');
	}
	public function getCandidateName($candidate_ids = ''){
		$candidate_ids = json_decode($candidate_ids, true);
		$data = array();
		foreach ($candidate_ids as $candidate_id) {
			
			$this->db->select('candidate_name');
			$this->db->from('tbl_candidate');
			$this->db->where('candidate_id',$candidate_id);
			$res = $this->db->get()->row();
			if ($res) {
				$data[] = $res->candidate_name;
			}
		}
		return $data;
	}
	public function getCandidateEmail($candidate_ids = ''){
		$candidate_ids = json_decode($candidate_ids);
		$data = array();
		foreach ($candidate_ids as $candidate_id) {
			$this->db->select('candidate_email');
			$this->db->from('tbl_candidate');
			$this->db->where('candidate_id',$candidate_id);
			$res = $this->db->get()->result()[0];
			$data[] = $res->candidate_email;
		}
		return $data;
	}
	public function getCandidateNameByID($candidate_id = ''){
		$this->db->select('candidate_name');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_id',$candidate_id);
		$res = $this->db->get()->row();
		return $res->candidate_name;
	}
	public function getCandidateEmailByID($candidate_id = ''){
		$this->db->select('candidate_email');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_id',$candidate_id);
		$res = $this->db->get()->row();
		return $res->candidate_email;
	}
	public function checkCandidates($email = ''){
		$this->db->select('*');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_email',$email);
		$data = $this->db->get()->result();
		if($data){ return (array)$data; }
	}
	public function getCandidateID($email = ''){
		$this->db->select('candidate_id');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_email',$email);
		$res = $this->db->get()->result()[0];
		return $res->candidate_id;
	}
	public function getCandidateDetails($candidate_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_candidate');
		$this->db->where('candidate_id',$candidate_id);
		$res = $this->db->get()->result()[0];
		return $res;
	}
	public function getCandidateInterview($candidate_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_interview');
		$this->db->where('candidate',$candidate_id);
		$res = $this->db->get()->result();
		if($res){ return $res; }
	}
	public function checkCandidateProfile($candidate_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_candidate_profile');
		$this->db->where('candidate_id',$candidate_id);
		$this->db->where('status',1);
		$res = $this->db->get()->result();
		if($res){ return $res; }
	}
	public function getCandidateProfile($candidate_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_candidate_profile');
		$this->db->where('candidate_id',$candidate_id);
		$res = $this->db->get()->row_array();
		if($res){ return $res; }
	}
	public function getNationalityList(){
		$this->db->select('alpha_3_code,nationality');
		$this->db->from('tbl_countries');
		$res = $this->db->get()->result();
		if($res){ return $res; }
	}
	public function addRegisterCandidate($data = array(),$files = array()){
		$create = array(
			'name'	=>	$data['firstname'].' '.$data['lastname'],
			'email'	=>	$data['email'],
		);
		$candidate_id = $this->createCandidate($create);
		
		$this->db->select('candidate');
		$this->db->from('tbl_project');
		$this->db->where('project_code',$this->uri->segments[2]);
		$datas = $this->db->get()->row_array()['candidate'];
		$candidates = array(
			'candidate'	=>	json_encode(array_merge(json_decode($datas),(array)$candidate_id)),
		);
		$this->db->where('project_code',$this->uri->segments[2]);
		$this->db->update('tbl_project',$candidates);

		if($files){
			$type =".".substr($files['type'],6);
			$name1="profile_image".rand(0,9).chr(rand(97,122)).chr(rand(65,90)).rand(0,9).chr(rand(97,122));
			$newname=$name1.$type;
			$path1= '/usr/www/users/einteajaxm/application/controllers/interview/profile/' . $newname;
			move_uploaded_file($files['tmp_name'], $path1);
		}else{
			$newname = '';
		}

		$this->addInvites($candidate_id,$this->uri->segments[2]);
		$add = array(
			'candidate_profile_id'	=>	'',
			'candidate_id'			=>	$candidate_id,
			'firstname'				=>	$data['firstname'],
			'lastname'				=>	$data['lastname'],
			'email'					=>	$data['email'],
			'phone'					=>	$data['phone'],
			'image'					=>	$newname,
			'id'					=>	$data['id'],
			'dob'					=>	$data['dob'],
			'gender'				=>	$data['gender'],
			'age'					=>	$data['age'],
			'nationality'			=>	$data['nationality'],
			'ethnicity'				=>	$data['ethnicity'],
			'highest_education'		=>	$data['highest_education'],
			'marital_status'		=>	$data['marital_status'],
			'employeement_status'	=>	$data['employeement_status'],
			'home_language'			=>	$data['home_language'],
			'status'				=>	1,
		);
		return $this->db->insert('tbl_candidate_profile',$add);
	}
	public function updateRegisterCandidate($candidate_id = '',$data = array(),$files = array()){
		$type =".".substr($files['type'],6);
		$name1="profile_image".rand(0,9).chr(rand(97,122)).chr(rand(65,90)).rand(0,9).chr(rand(97,122));
		$newname=$name1.$type;
		$path1= '/usr/www/users/einteajaxm/application/controllers/interview/profile/' . $newname;
		move_uploaded_file($files['tmp_name'], $path1);

		$update = array(
			'firstname'				=>	$data['firstname'],
			'lastname'				=>	$data['lastname'],
			'email'					=>	$data['email'],
			'phone'					=>	$data['phone'],
			'image'					=>	$newname,
			'id'					=>	$data['id'],
			'dob'					=>	$data['dob'],
			'gender'				=>	$data['gender'],
			'age'					=>	$data['age'],
			'nationality'			=>	$data['nationality'],
			'ethnicity'				=>	$data['ethnicity'],
			'highest_education'		=>	$data['highest_education'],
			'marital_status'		=>	$data['marital_status'],
			'employeement_status'	=>	$data['employeement_status'],
			'home_language'			=>	$data['home_language'],
			'status'				=>	1,
		);
		$this->db->where('candidate_id',$candidate_id);
		return $this->db->update('tbl_candidate_profile',$update);
	}
	public function addInvites($candidate_id = '',$project_code = ''){
		$this->db->select('project_id');
		$this->db->from('tbl_project');
		$this->db->where('project_code',$project_code);
		$data = $this->db->get()->row_array();
		$add = array(
			'invite_id'	=>	'',
			'project_id'	=>	$data['project_id'],
			'candidate_id'	=>	$candidate_id,
			'note'	=>	'',
			'start_status'	=>	0,
			'end_status'	=>	0,
			'status'	=>	'pending',
		);
		$this->db->insert('tbl_invite_interview',$add);

		$credentials = $this->candidate_model->getCandidateDetails($candidate_id);
		$subject = 'Invite For Interview';
		$message  = "Hello, ". $credentials->candidate_name ."<br>";
		$message .= "We are invited you to give Interview Online.". "<br><br>";
		$message .= "Interview Login Link : <strong>". base_url()."</strong><br><br>";
		$message .= "Your Login Credentials are,". "<br>";
		$message .= "Login ID : <strong>". $credentials->candidate_email ."</strong><br>";
		$message .= "Password : <strong>". $credentials->candidate_password ."</strong><br>";
	
		$mail = new Mail();
		$mail->setTo($credentials->candidate_email);
		$mail->setFrom('info@e-interview.co.za');
		$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();
	}
	public function createCandidate($data = array()){
		$password = $this->email_password();
		$add = array(
			'candidate_id'			=>	'',
			'candidate_name'		=>	$data['name'],
			'candidate_email'		=>	$data['email'],
			'candidate_password'	=>	$password,
			'status'				=>	1,
		);
		$this->db->insert('tbl_candidate',$add);
		$candidate_id = $this->db->insert_id();

		$addauth = array(
			'auth_id'		=>	'',
			'profile_id'	=>	$candidate_id,
			'name'			=>	$data['name'],
			'email'			=>	$data['email'],
			'password'		=>	$password,
			'type'			=>	'CANDIDATE',
		);
		$this->db->insert('tbl_auth',$addauth);
		return $candidate_id;
	}
	public function email_password(){
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
	    srand((double)microtime()*1000000);
	    $i = 0;
	    $pass = '' ;
	    while ($i <= 9) {
	        $num = rand() % 33;
	        $tmp = substr($chars, $num, 1);
	        $pass = $pass . $tmp;
	        $i++;
	    }
	    return $pass;
	}
}
?>