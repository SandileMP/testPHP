<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {
	private $error = array();
	function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation','mail'));
		$this->load->model(array('job_profile_model','project_model','candidate_model','auth_model','interview_model','manager_model'));
        if(!$this->checkLogin()){
        	redirect(base_url());
        }else if($this->session->userdata['user_type'] != 'CLIENT'){
        	redirect(base_url());
        }
    }
	public function index(){
		$data = array();
		$this->lang->load('project');
		
		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_projects'] = $this->lang->line('text_projects');
		$data['text_empty'] = $this->lang->line('text_empty');
		$data['text_interview_status'] = $this->lang->line('text_interview_status');
		$data['entry_project_id'] = $this->lang->line('entry_project_id');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_job_profile_name'] = $this->lang->line('entry_job_profile_name');
		$data['entry_project_manager'] = $this->lang->line('entry_project_manager');
		$data['entry_project_candidate'] = $this->lang->line('entry_project_candidate');
		$data['entry_project_start'] = $this->lang->line('entry_project_start');
		$data['entry_project_end'] = $this->lang->line('entry_project_end');
		$data['entry_active_candidates'] = $this->lang->line('entry_active_candidates');
		$data['entry_test_completed_candidates'] = $this->lang->line('entry_test_completed_candidates');
		$data['entry_project_type'] = $this->lang->line('entry_project_type');
		$data['entry_project_notify'] = $this->lang->line('entry_project_notify');
		$data['entry_project_status'] = $this->lang->line('entry_project_status');
		$data['entry_project_link'] = $this->lang->line('entry_project_link');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_edit'] = $this->lang->line('button_edit');
		$data['button_remove'] = $this->lang->line('button_remove');

		$data['action'] = base_url().'project';
		$data['project_candidate'] = base_url().'project/candidates';
		$data['edit_project'] = base_url().'project/edit';
		$data['create_project'] = base_url().'project/create';
		$data['remove_project'] = base_url().'project/remove';
		$data['remove_all_project'] = base_url().'project/removeall';
		$data['send_link_mail_url'] = base_url().'project/sendLinkMail';
		$data['interview_status_url'] = base_url().'project/checkInterviewStatus';

		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$projects = $this->project_model->getProjectsBySearch($this->session->userdata['user'],$this->input->post('text_search'));
		}else{
			$projects = $this->project_model->getProjects($this->session->userdata['user']);
		}
		$data['projects'] = array();
		if($projects) {
			foreach ($projects as $project) {
				$data['projects'][] = array(
					'project_id'	=>	$project->project_id,
					'project_name'	=>	$project->project_name,
					'project_code'	=>	$project->project_code,
					'profile_name'	=>	$this->job_profile_model->getProfileName($project->profile_id),
					'manager_name'	=>	$this->manager_model->getManagerName($project->manager),
					'candidate'		=>	$this->candidate_model->getCandidateName($project->candidate),
					'project_type'	=>	$project->project_type,
					'start_date'	=>	$project->start_date,
					'end_date'		=>	$project->end_date,
					'notification'	=>	$project->notification,
					'status'		=>	$project->status,
					'completed'		=>	$this->project_model->countCompletedInterview($project->project_id),
				);
			}
		}
		$this->app->view('view_projects',$data);
	}
	public function create(){
		$data = array();
		$this->lang->load('project');
		
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()){
			$adddata = $this->input->post();
			$adddata['client'] = $this->session->userdata['user'];
			$create = $this->project_model->addProjects($adddata);
			redirect('project');
		}
		$data['heading_title'] = $this->lang->line('create_heading_title');
		$data['title'] = $this->lang->line('create_heading_title');
		$data['text_create_projects'] = $this->lang->line('text_create_projects');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_project_description'] = $this->lang->line('entry_project_description');
		$data['entry_profile_name'] = $this->lang->line('entry_profile_name');
		$data['entry_project_manager'] = $this->lang->line('entry_project_manager');
		$data['entry_project_candidate'] = $this->lang->line('entry_project_candidate');
		$data['entry_project_type'] = $this->lang->line('entry_project_type');
		$data['entry_start_date'] = $this->lang->line('entry_start_date');
		$data['entry_end_date'] = $this->lang->line('entry_end_date');
		$data['entry_status'] = $this->lang->line('entry_status');
		$data['entry_notification'] = $this->lang->line('entry_notification');
		$data['text_create_candidate'] = $this->lang->line('text_create_candidate');
		$data['text_open_project'] = $this->lang->line('text_open_project');
		$data['text_notification_on'] = $this->lang->line('text_notification_on');
		$data['text_notification_off'] = $this->lang->line('text_notification_off');
		$data['text_status_create'] = $this->lang->line('text_status_create');
		$data['text_status_launch'] = $this->lang->line('text_status_launch');
		$data['entry_candidate_name'] = $this->lang->line('entry_candidate_name');
		$data['entry_candidate_email'] = $this->lang->line('entry_candidate_email');
		$data['entry_candidate_password'] = $this->lang->line('entry_candidate_password');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['note_create_manager'] = $this->lang->line('note_create_manager');
		$data['note_create_job_profile'] = $this->lang->line('note_create_job_profile');
		$data['button_create_candidate'] = $this->lang->line('button_create_candidate');
		$data['button_generate'] = $this->lang->line('button_generate');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_remove'] = $this->lang->line('button_remove');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_launch'] = $this->lang->line('button_launch');
		$data['button_update'] = $this->lang->line('button_update');

		$data['job_profiles'] = $this->job_profile_model->getJob_profiles($this->session->userdata['user']);
		$data['managers'] = $this->manager_model->getManagers($this->session->userdata['user']);
		if($this->input->post('project_name')){
			$data['project_name'] = $this->input->post('project_name');
		}else{
			$data['project_name'] = '';
		}
		if($this->input->post('project_description')){
			$data['project_description'] = $this->input->post('project_description');
		}else{
			$data['project_description'] = '';
		}
		if($this->input->post('profile_name')){
			$data['profile_id'] = $this->input->post('profile_name');
		}else{
			$data['profile_id'] = '';
		}
		if($this->input->post('profile_manager')){
			$data['manager_id'] = $this->input->post('profile_manager');
		}else{
			$data['manager_id'] = array();
		}
		if(!empty($this->input->post('candidate'))){
			$data['candidate'] = $this->input->post('candidate');
			$data['i'] = count($this->input->post('candidate'));
		}else{
			$data['candidate'] = '';
			$data['i'] = 0;
		}
		if($this->input->post('open_project')){
			$data['open_project'] = $this->input->post('open_project');
		}else{
			$data['open_project'] = '';
		}
		if($this->input->post('start_date')){
			$data['start_date'] = $this->input->post('start_date');
		}else{
			$data['start_date'] = '';
		}
		if($this->input->post('end_date')){
			$data['end_date'] = $this->input->post('end_date');
		}else{
			$data['end_date'] = '';
		}
		if($this->input->post('notification')){
			$data['notification'] = $this->input->post('notification');
		}else{
			$data['notification'] = '';
		}
		$data['project_status'] = '';

		if(isset($this->error['warning'])){
			$data['warning'] = $this->error['warning'];
		}else{
			$data['warning'] = '';
		}
		if(isset($this->error['error_project_name'])){
			$data['error_project_name'] = $this->error['error_project_name'];
		}else{
			$data['error_project_name'] = '';
		}
		if(isset($this->error['error_project_description'])){
			$data['error_project_description'] = $this->error['error_project_description'];
		}else{
			$data['error_project_description'] = '';
		}
		if(isset($this->error['error_profile_name'])){
			$data['error_profile_name'] = $this->error['error_profile_name'];
		}else{
			$data['error_profile_name'] = '';
		}
		if(isset($this->error['error_profile_manager'])){
			$data['error_profile_manager'] = $this->error['error_profile_manager'];
		}else{
			$data['error_profile_manager'] = '';
		}
		if(isset($this->error['error_candidate'])){
			$data['error_candidate'] = $this->error['error_candidate'];
		}else{
			$data['error_candidate'] = '';
		}
		if(isset($this->error['error_notification'])){
			$data['error_notification'] = $this->error['error_notification'];
		}else{
			$data['error_notification'] = '';
		}
		if(isset($this->error['error_project_type'])){
			$data['error_project_type'] = $this->error['error_project_type'];
		}else{
			$data['error_project_type'] = '';
		}

		$data['generate_password_url'] = base_url().'auth/generate_password';
		$data['create_candidate_url'] = base_url().'project/create_candidate';
		$data['load_candidate_url'] = base_url().'project/loadCandidate';
		$data['action'] = base_url().'project/create';
		$data['cancel'] = base_url().'project';

		$this->app->view('create_projects',$data);
	}
	public function edit($project_id = ''){
		$data = array();
		$this->lang->load('project');
		
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()){
			$this->project_model->updateProject($project_id,$this->input->post());
			redirect('project');
		}
		$data['heading_title'] = $this->lang->line('text_edit_projects');
		$data['title'] = $this->lang->line('text_edit_projects');
		$data['text_create_projects'] = $this->lang->line('text_edit_projects');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_project_description'] = $this->lang->line('entry_project_description');
		$data['entry_profile_name'] = $this->lang->line('entry_profile_name');
		$data['entry_project_manager'] = $this->lang->line('entry_project_manager');
		$data['entry_project_candidate'] = $this->lang->line('entry_project_candidate');
		$data['entry_project_type'] = $this->lang->line('entry_project_type');
		$data['entry_start_date'] = $this->lang->line('entry_start_date');
		$data['entry_end_date'] = $this->lang->line('entry_end_date');
		$data['entry_status'] = $this->lang->line('entry_status');
		$data['entry_notification'] = $this->lang->line('entry_notification');
		$data['text_create_candidate'] = $this->lang->line('text_create_candidate');
		$data['text_open_project'] = $this->lang->line('text_open_project');
		$data['text_notification_on'] = $this->lang->line('text_notification_on');
		$data['text_notification_off'] = $this->lang->line('text_notification_off');
		$data['text_status_create'] = $this->lang->line('text_status_create');
		$data['text_status_launch'] = $this->lang->line('text_status_launch');
		$data['entry_candidate_name'] = $this->lang->line('entry_candidate_name');
		$data['entry_candidate_email'] = $this->lang->line('entry_candidate_email');
		$data['entry_candidate_password'] = $this->lang->line('entry_candidate_password');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['note_create_manager'] = $this->lang->line('note_create_manager');
		$data['note_create_job_profile'] = $this->lang->line('note_create_job_profile');
		$data['button_create_candidate'] = $this->lang->line('button_create_candidate');
		$data['button_generate'] = $this->lang->line('button_generate');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_remove'] = $this->lang->line('button_remove');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_launch'] = $this->lang->line('button_launch');
		$data['button_update'] = $this->lang->line('button_update');

		$data['project'] = $this->project_model->getProject($project_id);
		$data['job_profiles'] = $this->job_profile_model->getJob_profiles($this->session->userdata['user']);
		$data['managers'] = $this->manager_model->getManagers($this->session->userdata['user']);

		if($this->input->post('project_name')){
			$data['project_name'] = $this->input->post('project_name');
		}else if($data['project']['project_name']){
			$data['project_name'] = $data['project']['project_name'];
		}else{
			$data['project_name'] = '';
		}
		if($this->input->post('project_description')){
			$data['project_description'] = $this->input->post('project_description');
		}else if($data['project']['project_description']){
			$data['project_description'] = $data['project']['project_description'];
		}else{
			$data['project_description'] = '';
		}
		if($this->input->post('profile_name')){
			$data['profile_id'] = $this->input->post('profile_name');
		}else if($data['project']['profile_id']){
			$data['profile_id'] = $data['project']['profile_id'];
		}else{
			$data['profile_id'] = '';
		}
		if($this->input->post('profile_manager')){
			$data['manager_id'] = $this->input->post('profile_manager');
		}else if($data['project']['manager']){
			$data['manager_id'] = json_decode($data['project']['manager']);
		}else{
			$data['manager_id'] = '';
		}
		if($this->input->post('candidate')){
			$data['candidate'] = $this->input->post('candidate');
			$data['i'] = count($this->input->post('candidate'));
		}else if($data['project']['candidate']){
			$data['candidate'] = $this->project_model->getCandidates(json_decode($data['project']['candidate'],true));
			$data['i'] = count($data['project']['candidate']);
		}else{
			$data['candidate'] = array();
			$data['i'] = 0;
		}
		if($this->input->post('open_project')){
			$data['open_project'] = $this->input->post('open_project');
		}else if($data['project']['project_type'] == 'open'){
			$data['open_project'] = 'on';
		}else{
			$data['open_project'] = '';
		}
		if($this->input->post('start_date')){
			$data['start_date'] = $this->input->post('start_date');
		}else if($data['project']['start_date'] != '0000-00-00'){
			$data['start_date'] = $data['project']['start_date'];
		}else{
			$data['start_date'] = '';
		}
		if($this->input->post('end_date')){
			$data['end_date'] = $this->input->post('end_date');
		}else if($data['project']['end_date'] != '0000-00-00'){
			$data['end_date'] = $data['project']['end_date'];
		}else{
			$data['end_date'] = '';
		}
		if($this->input->post('notification')){
			$data['notification'] = $this->input->post('notification');
		}else if($data['project']['notification']){
			$data['notification'] = $data['project']['notification'];
		}else{
			$data['notification'] = '';
		}
		if($this->input->post('project_status')){
			$data['project_status'] = $this->input->post('project_status');
		}else if($data['project']['status']){
			$data['project_status'] = $data['project']['status'];
		}else{
			$data['project_status'] = '';
		}

		if(isset($this->error['warning'])){
			$data['warning'] = $this->error['warning'];
		}else{
			$data['warning'] = '';
		}
		if(isset($this->error['error_project_name'])){
			$data['error_project_name'] = $this->error['error_project_name'];
		}else{
			$data['error_project_name'] = '';
		}
		if(isset($this->error['error_project_description'])){
			$data['error_project_description'] = $this->error['error_project_description'];
		}else{
			$data['error_project_description'] = '';
		}
		if(isset($this->error['error_profile_name'])){
			$data['error_profile_name'] = $this->error['error_profile_name'];
		}else{
			$data['error_profile_name'] = '';
		}
		if(isset($this->error['error_profile_manager'])){
			$data['error_profile_manager'] = $this->error['error_profile_manager'];
		}else{
			$data['error_profile_manager'] = '';
		}
		if(isset($this->error['error_candidate'])){
			$data['error_candidate'] = $this->error['error_candidate'];
		}else{
			$data['error_candidate'] = '';
		}
		if(isset($this->error['error_notification'])){
			$data['error_notification'] = $this->error['error_notification'];
		}else{
			$data['error_notification'] = '';
		}
		if(isset($this->error['error_project_type'])){
			$data['error_project_type'] = $this->error['error_project_type'];
		}else{
			$data['error_project_type'] = '';
		}
		$data['action'] = base_url().'project/edit/'.$project_id;
		$data['cancel'] = base_url().'project';

		$this->app->view('create_projects',$data);
	}
	public function remove($project_id = ''){
		if($this->input->server('REQUEST_METHOD') == 'GET'){
			$this->project_model->removeProject($project_id);
			redirect('project');
		}else{
			redirect('project');
		}
	}
	public function removeall(){
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if($this->input->post('projectremovecheck')){
				foreach ($this->input->post('projectremovecheck') as $ids) {
					$this->project_model->removeProject($ids);
				}
			}
			redirect('project');
		}else{
			redirect('project');
		}
	}
	public function sendLinkMail(){
		$email = $this->auth_model->getClientEmailByID($this->session->userdata['user']);

		$subject = 'Interview Link';
		$message = "Your Interview Link : <strong>". $this->input->post('text') ."</strong><br><br>";

		$mail = new Mail();
		$mail->setTo($email);
		$mail->setFrom('info@e-interview.co.za');
		$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();
		echo 'success';
		die;
	}
	public function sendLoginDetailMail(){
		$candidate = $this->candidate_model->getCandidateDetails($this->input->post('candidate_id'));

		$subject = 'Login Credentials';
		$message = "Your Login Credentials are,". "<br><br>";
		$message .= "Login ID : <strong>". $candidate->candidate_email ."</strong><br>";
		$message .= "Password : <strong>". $candidate->candidate_password ."</strong><br>";

		$mail = new Mail();
		$mail->setTo($candidate->candidate_email);
		$mail->setFrom('info@e-interview.co.za');
		$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();
		echo 'success';
		die;
	}
	public function checkInterviewStatus(){
		$data = array();
		$interview = $this->project_model->checkInterviewStatus($this->input->post('id'));
		if(!$interview){
			$data['msg'] = 'Candidates Not Invited';
		}else{
			foreach ($interview as $key => $value) {
				$candidate_detail = $this->candidate_model->getCandidateDetails($value->candidate_id);
				$data[] = array(
					'candidate'	=>	$candidate_detail->candidate_name,
					'status'	=>	$value->status,
				);
			}
		}
		echo json_encode($data);
		die;
	}
	public function interview_project(){
		$data = array();
		$this->lang->load('interview');
		
		$data['heading_title'] = $this->lang->line('heading_title_manage_interview');
		$data['title'] = $this->lang->line('heading_title_manage_interview');
		$data['text_manage_interview'] = $this->lang->line('text_manage_interview');
		$data['text_empty'] = $this->lang->line('text_empty_project');

		$data['entry_project_id'] = $this->lang->line('entry_project_id');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_project_desc'] = $this->lang->line('entry_project_desc');
		$data['entry_profile'] = $this->lang->line('entry_profile');
		$data['entry_candidate'] = $this->lang->line('entry_candidate');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_view'] = $this->lang->line('button_view');

		$data['action'] = base_url().'project/interviews';

		$data['projects'] = array();
		$projects = $this->project_model->getProjects($this->session->userdata['user']);
		if($projects){
			foreach ($projects as $project) {
				$data['projects'][] = array(
					'project_id'	=>	$project->project_id,
					'project_name'	=>	$project->project_name,
					'project_desc'	=>	$project->project_description,
					'profile'		=>	$this->job_profile_model->getProfileName($project->profile_id),
					'candidate'		=>	$this->candidate_model->getCandidateName($project->candidate),
				);
			}
		}
		$this->app->view('interview_project',$data);
	}
	public function interviews($project_id = ''){
		$data = array();
		$this->lang->load('interview');
		
		$data['heading_title'] = $this->lang->line('heading_title_interviews');
		$data['title'] = $this->lang->line('heading_title_interviews');
		$data['text_interviews'] = $this->lang->line('text_interviews');
		$data['text_empty'] = $this->lang->line('text_empty_interview');

		$data['entry_interview_id'] = $this->lang->line('entry_interview_id');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_interview_candidate'] = $this->lang->line('entry_interview_candidate');
		$data['entry_interview_start'] = $this->lang->line('entry_interview_start');
		$data['entry_interview_end'] = $this->lang->line('entry_interview_end');
		$data['entry_interview_path'] = $this->lang->line('entry_interview_path');

		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_watch'] = $this->lang->line('button_watch');

		$data['cancel'] = base_url().'project/interview_project';

		$data['interviews'] = array();
		$interviews = $this->interview_model->getInterviewsByProjectID($project_id);
		if($interviews){
			foreach ($interviews as $interview) {
				$data['interviews'][] = array(
					'interview_id'	=>	$interview->interview_id,
					'project'		=>	$this->project_model->getProjectName($interview->project_id),
					'candidate'		=>	$this->candidate_model->getCandidateNameByID($interview->candidate),
					'start'			=>	$interview->start,
					'end'			=>	$interview->end,
					'path'			=>	$interview->path,
					'status'		=>	$interview->status,
				);
			}
		}
		$this->app->view('view_interviews',$data);
	}
	public function candidates($project_id = ''){
		$data = array();
		$this->lang->load('project');
		
		$data['heading_title'] = $this->lang->line('heading_title_candidates');
		$data['title'] = $this->lang->line('heading_title_candidates');
		$data['text_candidates'] = $this->lang->line('text_candidates');
		$data['text_empty'] = $this->lang->line('text_empty_candidate');
		$data['text_resend_login_detail'] = $this->lang->line('text_resend_login_detail');

		$data['entry_candidate_name'] = $this->lang->line('entry_candidate_name');
		$data['entry_test_completed'] = $this->lang->line('entry_test_completed');
		$data['entry_status'] = $this->lang->line('entry_status');
		$data['entry_action'] = $this->lang->line('entry_action');

		$data['button_cancel'] = $this->lang->line('button_cancel');

		$data['cancel'] = base_url().'project';
		$data['send_login_detail_url'] = base_url().'project/sendLoginDetailMail';

		$data['candidates'] = array();
		$candidates = $this->project_model->getProjectCandidates($project_id);
		if($candidates){
			foreach (array_count_values(json_decode($candidates)) as $candidate => $count) {
				$data['candidates'][] = array(
					'candidate_id'			=>	$candidate,
					'candidate_name'		=>	$this->candidate_model->getCandidateNameByID($candidate),
					'test_completed'		=>	$this->project_model->countCompletedInterviewByCandidate($candidate,$project_id),
					'total_test'			=>	$count,
				);
			}
		}
		$this->app->view('view_project_candidates',$data);
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
	private function validateForm(){
		if(empty($this->input->post('project_name'))){
			$this->error['error_project_name'] = $this->lang->line('error_project_name');
		}
		if(empty($this->input->post('project_description'))){
			$this->error['error_project_description'] = $this->lang->line('error_project_description');
		}
		if(empty($this->input->post('profile_name'))){
			$this->error['error_profile_name'] = $this->lang->line('error_profile_name');
		}
		if(empty($this->input->post('profile_manager'))){
			$this->error['error_profile_manager'] = $this->lang->line('error_profile_manager');
		}
		if($this->uri->segments[1] == 'project' && $this->uri->segments[2] != 'edit'){
			if(is_array($this->input->post('candidate'))){
				foreach ($this->input->post('candidate') as $key => $value) {
					if(is_array($value)){
						foreach ($value as $key => $value2) {
							if(empty($value2)){
								$this->error['error_candidate'] = $this->lang->line('error_candidate');
							}
						}
					}
				}
			}else{
				$this->error['error_candidate'] = $this->lang->line('error_candidate');
			}
		}
		if(empty($this->input->post('notification'))){
			$this->error['error_notification'] = $this->lang->line('error_notification');
		}
		if(!$this->input->post('open_project')){
			if(empty($this->input->post('start_date'))){
				$this->error['error_project_type'] = $this->lang->line('error_project_type');
			}
			if(empty($this->input->post('end_date'))){
				$this->error['error_project_type'] = $this->lang->line('error_project_type');
			}
		}
		if($this->input->post('open_project')){
			if(empty($this->input->post('start_date'))){
				$this->error['error_project_type'] = $this->lang->line('error_project_type');
			}
		}
		return !$this->error;
	}
}
