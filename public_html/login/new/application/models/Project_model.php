<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model{
	public function getProjects($client_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('client',$client_id);
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;	
		}
	}
	public function getProjectsBySearch($client_id = '',$serach = ''){
		$data = $this->db->query("SELECT * FROM tbl_project WHERE client = '{$client_id}' AND project_name LIKE '%{$serach}%'");
		if($data){
			return (array)$data->result();	
		}
	}
	public function checkProjectDetail($project_code = ''){
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('project_code',$project_code);
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
	public function getDashboardProjects(){
		$this->db->select('*');
		$this->db->from('tbl_project');
		if($this->session->userdata['user_type'] == 'CLIENT'){
			$this->db->where('client',$this->session->userdata['user']);
		}
		if($this->session->userdata['user_type'] == 'MANAGER'){
			$this->db->where('manager',$this->session->userdata['user']);
		}
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;	
		}
	}
	public function getProject($project_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('project_id',$project_id);
		$data = $this->db->get()->result();
		if($data){
			return (array)$data[0];	
		}
	}
	public function addProjects($data = array()){
		/*$counts = array_count_values(array_column($data['candidate'], 'email'));
		$emails['email'] = array();
		foreach ($counts as $email_id => $count) {
			foreach ($data['candidate'] as $candidate) {
				if(!in_array($email_id, $emails['email']) && $candidate['email'] == $email_id){
					$emails['name'][] = $candidate['name'];
					$emails['email'][] = $email_id;
				}
			}
		}
		$candidate = array();
		foreach ($emails['name'] as $key => $name) {
			$candidate[] = array(
				'name'	=>	$emails['name'][$key],
				'email'	=>	$emails['email'][$key],
				'count'	=>	$counts[$emails['email'][$key]],
			);
		}*/

		$project_code = $this->generate_project_code();
		$candidate_id = array();
		foreach ($data['candidate'] as $key => $value) {
			$candidate_id[] = $this->createCandidate($value);
			/*for ($i=0; $i < $value['count']; $i++) { 
				$candidate_id[] = $cand;
			}*/
		}

		if(!isset($data['open_project'])){
			$project_type = 'expiry';
		}else{
			$project_type = 'open';
			$data['end_date'] = '';
		}
		$add = array(
			'project_id'			=>	'',
			'project_name'			=>	$data['project_name'],
			'project_description'	=>	$data['project_description'],
			'project_code'			=>	$project_code,
			'profile_id'			=>	$data['profile_name'],
			'client'				=>	$data['client'],
			'manager'				=>	$data['profile_manager'],
			'candidate'				=>	json_encode($candidate_id),
			'project_type'			=>	$project_type,
			'start_date'			=>	$data['start_date'],
			'end_date'				=>	$data['end_date'],
			'notification'			=>	$data['notification'],
			'status'				=>	$data['project_status'],
		);
		if($data['project_status'] == 'launch'){
			$this->db->insert('tbl_project',$add);
			$project_id = $this->db->insert_id();
			$this->sendEmailInvite($project_id);
			return true;
		}else{
			return $this->db->insert('tbl_project',$add);
		}
	}
	public function updateProject($project_id = '',$data = array()){
		if(!isset($data['open_project'])){
			$project_type = 'expiry';
		}else{
			$project_type = 'open';
			$data['end_date'] = '';
		}
		$update = array(
			'project_name'			=>	$data['project_name'],
			'project_description'	=>	$data['project_description'],
			'profile_id'			=>	$data['profile_name'],
			'manager'				=>	$data['profile_manager'],
			'project_type'			=>	$project_type,
			'start_date'			=>	$data['start_date'],
			'end_date'				=>	$data['end_date'],
			'notification'			=>	$data['notification'],
			'status'				=>	$data['project_status'],
		);
		$this->db->where('project_id',$project_id);
		$this->db->update('tbl_project',$update);

		$candidate_id = array();
		if(isset($data['candidate'])){
			$this->db->select('candidate');
			$this->db->from('tbl_project');
			$this->db->where('project_id',$project_id);
			$datas = $this->db->get()->row_array()['candidate'];		
			
			foreach ($data['candidate'] as $key => $value) {
				/*$this->db->select('candidate_id');
				$this->db->from('tbl_candidate');
				$this->db->where('candidate_email',$value['email']);
				$che = $this->db->get()->row_array();
				if($che){
					$candidate = $che['candidate_id'];
					$candidate_id[] = $candidate;
				}else{
					$candidate_id[] = $this->createCandidate($value);
				}*/
				$candidate_id[] = $this->createCandidate($value);
			}

			$candidates = array(
				'candidate'	=>	json_encode(array_merge(json_decode($datas),$candidate_id)),
			);
			$this->db->where('project_id',$project_id);
			$this->db->update('tbl_project',$candidates);	
		}
		if($data['project_status'] == 'launch'){
			$this->sendEmailInvite($project_id);
		}
	}
	public function removeProject($project_id = ''){
		$this->db->where('project_id',$project_id);
		$this->db->delete('tbl_project');

		$this->db->where('project_id',$project_id);
		$this->db->delete('tbl_invite_interview');
	}
	public function getProjectName($project_id = ''){
		$this->db->select('project_name');
		$this->db->from('tbl_project');
		$this->db->where('project_id',$project_id);
		$data = $this->db->get()->result()[0];
		if($data){
			return $data->project_name;
		}
	}
	public function getProjectCode($project_id = ''){
		$this->db->select('project_code');
		$this->db->from('tbl_project');
		$this->db->where('project_id',$project_id);
		$data = $this->db->get()->result()[0];
		if($data){
			return $data->project_code;
		}
	}
	public function getProjectDescription($project_id = ''){
		$this->db->select('project_description');
		$this->db->from('tbl_project');
		$this->db->where('project_id',$project_id);
		$data = $this->db->get()->result()[0];
		if($data){
			return $data->project_description;
		}
	}
	public function getProjectsByManager($manager_id = ''){
		$this->db->select('p.*');
		$this->db->from ('tbl_auth as a');
		$this->db->join ('tbl_project as p', 'p.manager = a.profile_id', 'left');
		$this->db->where('p.status','launch');
		$this->db->where ('a.auth_id',$manager_id);
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;	
		}
	}
	public function getCandidates($data = array()){
		$candidates = array();
		foreach ($data as $key => $candidate_id) {
			$this->db->select('candidate_id,candidate_name,candidate_email');
			$this->db->from('tbl_candidate');
			$this->db->where('candidate_id',$candidate_id);
			$data = $this->db->get()->row_array();
			$candidates[] = array(
				'candidate_id'	=>	$data['candidate_id'],
				'candidate_name'	=>	$data['candidate_name'],
				'candidate_email'	=>	$data['candidate_email'],
			);
		}
		return $candidates;
	}
	public function getProjectCandidates($project_id = ''){
		$this->db->select('candidate');
		$this->db->from ('tbl_project');
		$this->db->where ('project_id',$project_id);
		$data = $this->db->get()->row_array();
		if($data){
			return $data['candidate'];
		}
	}
	public function getLaunchedProjects(){
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('status','launch');
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;	
		}
	}
	public function getLaunchedProjectsByManager($manager_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where('status','launch');
		$this->db->where('manager',$manager_id);
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;	
		}
	}
	public function createCandidate($data = array()){
		$password = $this->email_password();
		$addcandidate = array(
			'candidate_id'			=>	'',
			'candidate_name'		=>	$data['name'],
			'candidate_email'		=>	$data['email'],
			'candidate_password'	=>	$password,
			'status'				=>	1,
		);
		$this->db->insert('tbl_candidate',$addcandidate);
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

		$moklu = array(
			'name'	=>	$data['name'],
			'email'	=>	$data['email'],
			'candidate_id'	=>	$candidate_id,
		);
		$this->createCandidateProfile($moklu);
		return $candidate_id;
	}
	public function createCandidateProfile($data = array()){
		$names = @explode(' ', $data['name']);
		if(!empty($names[0])) $firstname = $names[0];
		else $firstname = '';
		if(!empty($names[1])) $lastname = $names[1];
		else $lastname = '';
		$add = array(
			'candidate_profile_id'	=>	'',
			'candidate_id'			=>	$data['candidate_id'],
			'firstname'				=>	$firstname,
			'lastname'				=>	$lastname,
			'email'					=>	$data['email'],
			'phone'					=>	'',
			'image'					=>	'',
			'id'					=>	'',
			'dob'					=>	'',
			'gender'				=>	'',
			'age'					=>	'',
			'nationality'			=>	'',
			'ethnicity'				=>	'',
			'highest_education'		=>	'',
			'marital_status'		=>	'',
			'employeement_status'	=>	'',
			'home_language'			=>	'',
			'status'				=>	0,
		);
		$this->db->insert('tbl_candidate_profile',$add);
	}
	public function sendEmailInvite($project_id = ''){
		$mail = new Mail();
		$project_data = $this->project_model->getProject($project_id);
		foreach (json_decode($project_data['candidate']) as $key => $candidate) {
			$invites = $this->interview_model->getCandidateInvite($project_id,$candidate);
			if(!$invites){
				
				$emailer = $this->candidate_model->getCandidateEmailByID($candidate);
				$postData = array(
					'invite_id'		=>	'',
					'project_id'	=>	$project_id,
					'candidate_id'	=>	$candidate,
					'note'			=>	'',
					'start_status'	=>	0,
					'end_status'	=>	0,
					'status'		=>	'pending',
				);
				$this->interview_model->addInvite($postData);
				$credentials = $this->candidate_model->getCandidateDetails($candidate);

				$subject = 'Invite For Interview';
				$message  = "Hello, ". $credentials->candidate_name ."<br>";
				$message .= "We are invited you to give Interview Online.". "<br><br>";
				$message .= "Interview Login Link : <strong>". base_url()."</strong><br><br>";
				$message .= "Your Login Credentials are,". "<br>";
				$message .= "Login ID : <strong>". $credentials->candidate_email ."</strong><br>";
				$message .= "Password : <strong>". $credentials->candidate_password ."</strong><br>";
				
				$mail->setTo($emailer);
				$mail->setFrom('info@e-interview.co.za');
				$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
				$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
				$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
				$mail->send();
			}
		}
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
	public function generate_project_code(){
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
	    srand((double)microtime()*1000000);
	    $i = 0;
	    $pass = '' ;
	    while ($i <= 15) {
	        $num = rand() % 33;
	        $tmp = substr($chars, $num, 1);
	        $pass = $pass . $tmp;
	        $i++;
	    }
	    return $pass;
	}
	public function checkInterviewStatus($project_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('project_id',$project_id);
		$data = $this->db->get()->result();
		if($data){
			return (array)$data;	
		}
	}
	public function countCompletedInterview($project_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('project_id',$project_id);
		$this->db->where('status','complete');
		$data = $this->db->get()->result();
		return count($data);
	}
	public function countCompletedInterviewByCandidate($candidate_id = '',$project_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_interview');
		$this->db->where('candidate',$candidate_id);
		$this->db->where('project_id',$project_id);
		$this->db->where('status',1);
		$data = $this->db->get()->result();
		return count($data);
	}
	public function InterviewStatusByCandidate($candidate_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('candidate_id',$candidate_id);
		$data = $this->db->get()->row_array();
		if($data){
			if($data['status'] ==  'complete'){
				return 1;
			}else{
				return 0;
			}
		}
	}
	public function countTotalInterviewByCandidate($candidate_id = ''){
		$this->db->select('*');
		$this->db->from('tbl_invite_interview');
		$this->db->where('candidate_id',$candidate_id);
		$data = $this->db->get()->result();
		return count($data);
	}
}
?>