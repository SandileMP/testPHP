<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invite_interview extends CI_Controller {
	private $error = array();
	function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation','mail'));
		$this->load->model(array('auth_model','interview_model','project_model','job_profile_model','candidate_model'));
        if(!$this->checkLogin()){
        	redirect(base_url());
        }else if($this->session->userdata['user_type'] != 'MANAGER'){
        	redirect(base_url());
        }
    }
	public function index(){
		$data = array();
		$this->lang->load('interview');
		$this->lang->load('project');
		
		$data['heading_title'] = $this->lang->line('heading_title_invite_interview');
		$data['title'] = $this->lang->line('heading_title_invite_interview');
		$data['text_invite_interview'] = $this->lang->line('text_invite_interview');
		$data['text_invite_model'] = $this->lang->line('text_invite_interview');
		$data['text_empty'] = $this->lang->line('text_empty_invite_interview');
		$data['entry_invite_email'] = $this->lang->line('entry_invite_email');
		$data['entry_project_id'] = $this->lang->line('entry_project_id');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_project_desc'] = $this->lang->line('entry_project_desc');
		$data['entry_job_profile_name'] = $this->lang->line('entry_job_profile_name');
		$data['entry_project_manager'] = $this->lang->line('entry_project_manager');
		$data['entry_project_candidate'] = $this->lang->line('entry_project_candidate');
		$data['entry_project_type'] = $this->lang->line('entry_project_type');
		$data['entry_project_notification'] = $this->lang->line('entry_project_notification');
		$data['entry_invite_basic_note'] = $this->lang->line('entry_invite_basic_note');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_invite'] = $this->lang->line('button_invite');
		$data['button_invited'] = $this->lang->line('button_invited');

		$data['action'] = base_url().'invite_interview';
		$data['invite'] = base_url().'invite_interview/invite';

		$projects = $this->project_model->getLaunchedProjectsByManager($this->session->userdata['user']);
		$data['invited_projects'] = $this->interview_model->getInvitedProjectsByManager($this->session->userdata['user']);
		if(!$data['invited_projects']){
			$data['invited_projects'] = array();
		}

		$data['projects'] = array();
		if($projects) {
			foreach ($projects as $project) {
				$data['projects'][] = array(
					'project_id'	=>	$project->project_id,
					'project_name'	=>	$this->project_model->getProjectName($project->project_id),
					'profile_name'	=>	$this->job_profile_model->getProfileName($project->profile_id),
					'candidate'		=>	$this->candidate_model->getCandidateName($project->candidate),
					'project_type'	=>	$project->project_type,
					'start_date'	=>	$project->start_date,
					'end_date'		=>	$project->end_date,
					'notification'	=>	$project->notification,
				);
			}
		}
		$this->app->view('invite_interview',$data);
	}
	public function invite(){
		$json = array();
		$this->lang->load('interview');

		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if(empty($this->input->post('note'))){
				$json['error_basic_note'] = $this->lang->line('error_basic_note');
			}else{
				$project_link = base_url(). 'interview';

				$subject = 'Invite For Interview';
				$message  = "Hello,<br>";
				$message .= "We are invited you to give Interview Online.". "<br><br>";
				$message .= "Interview Login Link : <strong>". $project_link ."</strong><br>";
				$message .= "Login With Login Credentials and Give Interview,". "<br>";
				$message .= "Thanks Regards.";
				
				$mail = new Mail();
				$projectData = $this->project_model->getProject($this->input->post('project_id'));
				foreach (json_decode($projectData['candidate']) as $key => $candidate) {
					$this->interview_model->accessLogin($candidate);
					$email = $this->candidate_model->getCandidateEmailByID($candidate);
					
					$mail->setTo($email);
					$mail->setFrom('info@e-interview.co.za');
					$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
					$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
					$mail->send();
	
					$postData = array(
						'project_id'	=>	$this->input->post('project_id'),
						'candidate'		=>	$candidate,
						'note'			=>	$this->input->post('note'),
						'project_type'	=>	$projectData['project_type'],
						'start_date'	=>	$projectData['start_date'],
						'end_date'		=>	$projectData['end_date'],
						'notification'	=>	$projectData['notification'],
					);
					$this->interview_model->addInvite($postData);
				}
				$msg = 'Successfully Invited.';
				$json['success'] = $msg;
			}
			echo json_encode($json);
			die;
		}
	}
	private function checkLogin(){
		if(isset($this->session->userdata['user'])){
			return true;
		}else{
			return false;
		}
	}
	private function userLogin(){
		if($this->checkLogin()){
			$user = $this->session->userdata['user'];
			return $user;
		}
	}
}
