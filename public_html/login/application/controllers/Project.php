<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {
	private $error = array();
	private $credit;
	function __construct() {
		parent::__construct();
		$this->load->helper(array('cookie', 'date', 'form'));
		$this->load->library(array('encrypt', 'form_validation', 'mail'));
		$this->load->model(array('job_profile_model', 'project_model', 'hr_model', 'candidate_model', 'auth_model', 'interview_model', 'manager_model', 'credit_model', 'template_model'));
		$this->credit = $this->credit_model->getSystemCredit();
		if (!$this->checkLogin()) {
			redirect(base_url());
		} else if ($this->session->userdata['user_type'] != 'CLIENT' && $this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
	}
	public function index() {
		if ($this->session->userdata['user_type'] != 'CLIENT') {
			redirect(base_url());
		}
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

		$data['action'] = base_url() . 'project';
		$data['project_candidate'] = base_url() . 'project/minterviews';
		$data['edit_project'] = base_url() . 'project/edit';
		$data['create_project'] = base_url() . 'project/create';
		$data['remove_project'] = base_url() . 'project/remove';
		$data['remove_all_project'] = base_url() . 'project/removeall';
		$data['send_link_mail_url'] = base_url() . 'project/sendLinkMail';
		$data['interview_status_url'] = base_url() . 'project/checkInterviewStatus';

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$projects = $this->project_model->getProjectsBySearch($this->session->userdata['user'], $this->input->post('text_search'));
		} else {
			$projects = $this->project_model->getProjects($this->session->userdata['user']);
		}
		$data['projects'] = array();
		if ($projects) {
			foreach ($projects as $project) {
				$data['projects'][] = array(
					'project_id' => $project->project_id,
					'project_name' => $project->project_name,
					'project_code' => $project->project_code,
					'profile_name' => $this->job_profile_model->getProfileName($project->profile_id),
					'manager_name' => $this->manager_model->getManagerName($project->manager_id),
					'candidate' => $this->candidate_model->getCandidateName($project->candidate_id),
					'project_type' => $project->project_type,
					'start_date' => $project->start_date,
					'end_date' => $project->end_date,
					'notification' => $project->notification,
					'status' => $project->status,
					'completed' => $this->project_model->countCompletedInterview($project->project_id),
				);
			}
		}
		$this->app->view('view_projects', $data);
	}
	public function create() {
		if ($this->session->userdata['user_type'] != 'CLIENT') {
			redirect(base_url());
		}
		$data = array();
		$this->lang->load('project');

		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()) {
			$adddata = $this->input->post();
			$adddata['client_id'] = $this->session->userdata['user'];
			$create = $this->project_model->addProjects($adddata);
			redirect('project');
		}
		$data['heading_title'] = $this->lang->line('create_heading_title');
		$data['title'] = $this->lang->line('create_heading_title');
		$data['text_create_projects'] = $this->lang->line('text_create_projects');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_project_description'] = $this->lang->line('entry_project_description');
		$data['entry_profile_name'] = $this->lang->line('entry_profile_name');
		$data['entry_project_manager'] = $this->lang->line('entry_select_project_manager');
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
		$data['text_no_manager'] = $this->lang->line('text_no_manager');
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

		if (isset($_POST['project_name'])) {
			$data['project_name'] = $this->input->post('project_name');
		} else {
			$data['project_name'] = '';
		}
		if (isset($_POST['project_description'])) {
			$data['project_description'] = $this->input->post('project_description');
		} else {
			$data['project_description'] = '';
		}
		if (isset($_POST['profile_name'])) {
			$data['profile_id'] = $this->input->post('profile_name');
		} else {
			$data['profile_id'] = '';
		}
		if (isset($_POST['profile_manager'])) {
			$data['manager_id'] = $this->input->post('profile_manager');
		} else {
			$data['manager_id'] = array();
		}
		if (isset($_POST['candidate'])) {
			$data['candidate'] = $this->input->post('candidate');
			$data['i'] = count($this->input->post('candidate'));
		} else {
			$data['candidate'] = '';
			$data['i'] = 0;
		}
		if (isset($_POST['open_project'])) {
			$data['open_project'] = $this->input->post('open_project');
		} else {
			$data['open_project'] = '';
		}
		if (isset($_POST['start_date'])) {
			$data['start_date'] = $this->input->post('start_date');
		} else {
			$data['start_date'] = '';
		}
		if (isset($_POST['end_date'])) {
			$data['end_date'] = $this->input->post('end_date');
		} else {
			$data['end_date'] = '';
		}
		if (isset($_POST['notification'])) {
			$data['notification'] = $this->input->post('notification');
		} else {
			$data['notification'] = '';
		}
		$data['project_status'] = '';

		if (isset($this->error['warning'])) {
			$data['warning'] = $this->error['warning'];
		} else {
			$data['warning'] = '';
		}
		if (isset($this->error['error_project_name'])) {
			$data['error_project_name'] = $this->error['error_project_name'];
		} else {
			$data['error_project_name'] = '';
		}
		if (isset($this->error['error_project_description'])) {
			$data['error_project_description'] = $this->error['error_project_description'];
		} else {
			$data['error_project_description'] = '';
		}
		if (isset($this->error['error_profile_name'])) {
			$data['error_profile_name'] = $this->error['error_profile_name'];
		} else {
			$data['error_profile_name'] = '';
		}
		if (isset($this->error['error_profile_manager'])) {
			$data['error_profile_manager'] = $this->error['error_profile_manager'];
		} else {
			$data['error_profile_manager'] = '';
		}
		if (isset($this->error['error_candidate'])) {
			$data['error_candidate'] = $this->error['error_candidate'];
		} else {
			$data['error_candidate'] = '';
		}
		if (isset($this->error['error_credit'])) {
			$data['error_credit'] = $this->error['error_credit'];
		} else {
			$data['error_credit'] = '';
		}
		if (isset($this->error['error_notification'])) {
			$data['error_notification'] = $this->error['error_notification'];
		} else {
			$data['error_notification'] = '';
		}
		if (isset($this->error['error_project_type'])) {
			$data['error_project_type'] = $this->error['error_project_type'];
		} else {
			$data['error_project_type'] = '';
		}

		$data['generate_password_url'] = base_url() . 'auth/generate_password';
		$data['create_candidate_url'] = base_url() . 'project/create_candidate';
		$data['load_candidate_url'] = base_url() . 'project/loadCandidate';
		$data['action'] = base_url() . 'project/create';
		$data['cancel'] = base_url() . 'project';

		$this->app->view('create_projects', $data);
	}
	public function edit($project_id = '') {
		if ($this->session->userdata['user_type'] != 'CLIENT') {
			redirect(base_url());
		}
		$data = array();
		$this->lang->load('project');

		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()) {
			$this->project_model->updateProject($project_id, $this->input->post());
			redirect('project');
		}
		$data['heading_title'] = $this->lang->line('text_edit_projects');
		$data['title'] = $this->lang->line('text_edit_projects');
		$data['text_create_projects'] = $this->lang->line('text_edit_projects');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_project_description'] = $this->lang->line('entry_project_description');
		$data['entry_profile_name'] = $this->lang->line('entry_profile_name');
		$data['entry_project_manager'] = $this->lang->line('entry_select_project_manager');
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
		$data['text_no_manager'] = $this->lang->line('text_no_manager');
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

		if (isset($_POST['project_name'])) {
			$data['project_name'] = $this->input->post('project_name');
		} else if ($data['project']['project_name']) {
			$data['project_name'] = $data['project']['project_name'];
		} else {
			$data['project_name'] = '';
		}
		if (isset($_POST['profile_name'])) {
			$data['profile_id'] = $this->input->post('profile_name');
		} else if ($data['project']['profile_id']) {
			$data['profile_id'] = $data['project']['profile_id'];
		} else {
			$data['profile_id'] = '';
		}
		if (isset($_POST['profile_manager'])) {
			$data['manager_id'] = $this->input->post('profile_manager');
		} else if ($data['project']['manager_id']) {
			$data['manager_id'] = json_decode($data['project']['manager_id']);
		} else {
			$data['manager_id'] = '';
		}
		if (isset($_POST['candidate'])) {
			$data['register_candidate'] = $this->project_model->getCandidates(json_decode($data['project']['candidate_id'], true));
			$data['candidate'] = $this->input->post('candidate');
			$data['i'] = count($this->input->post('candidate'));
		} else if ($data['project']['candidate_id']) {
			$data['register_candidate'] = $this->project_model->getCandidates(json_decode($data['project']['candidate_id'], true));
			$data['candidate'] = array();
			$data['i'] = 0;
		} else {
			$data['register_candidate'] = array();
			$data['candidate'] = array();
			$data['i'] = 0;
		}
		if (isset($_POST['open_project'])) {
			$data['open_project'] = $this->input->post('open_project');
		} else if ($data['project']['project_type'] == 'open') {
			$data['open_project'] = 'on';
		} else {
			$data['open_project'] = '';
		}
		if (isset($_POST['start_date'])) {
			$data['start_date'] = $this->input->post('start_date');
		} else if ($data['project']['start_date'] != '0000-00-00') {
			$data['start_date'] = $data['project']['start_date'];
		} else {
			$data['start_date'] = '';
		}
		if (isset($_POST['end_date'])) {
			$data['end_date'] = $this->input->post('end_date');
		} else if ($data['project']['end_date'] != '0000-00-00') {
			$data['end_date'] = $data['project']['end_date'];
		} else {
			$data['end_date'] = '';
		}
		if (isset($_POST['notification'])) {
			$data['notification'] = $this->input->post('notification');
		} else if ($data['project']['notification']) {
			$data['notification'] = $data['project']['notification'];
		} else {
			$data['notification'] = '';
		}
		$data['project_status'] = $data['project']['status'];

		if (isset($this->error['warning'])) {
			$data['warning'] = $this->error['warning'];
		} else {
			$data['warning'] = '';
		}
		if (isset($this->error['error_project_name'])) {
			$data['error_project_name'] = $this->error['error_project_name'];
		} else {
			$data['error_project_name'] = '';
		}
		if (isset($this->error['error_project_description'])) {
			$data['error_project_description'] = $this->error['error_project_description'];
		} else {
			$data['error_project_description'] = '';
		}
		if (isset($this->error['error_profile_name'])) {
			$data['error_profile_name'] = $this->error['error_profile_name'];
		} else {
			$data['error_profile_name'] = '';
		}
		if (isset($this->error['error_profile_manager'])) {
			$data['error_profile_manager'] = $this->error['error_profile_manager'];
		} else {
			$data['error_profile_manager'] = '';
		}
		if (isset($this->error['error_candidate'])) {
			$data['error_candidate'] = $this->error['error_candidate'];
		} else {
			$data['error_candidate'] = '';
		}
		if (isset($this->error['error_credit'])) {
			$data['error_credit'] = $this->error['error_credit'];
		} else {
			$data['error_credit'] = '';
		}
		if (isset($this->error['error_notification'])) {
			$data['error_notification'] = $this->error['error_notification'];
		} else {
			$data['error_notification'] = '';
		}
		if (isset($this->error['error_project_type'])) {
			$data['error_project_type'] = $this->error['error_project_type'];
		} else {
			$data['error_project_type'] = '';
		}
		$data['action'] = base_url() . 'project/edit/' . $project_id;
		$data['cancel'] = base_url() . 'project';

		$this->app->view('create_projects', $data);
	}
	public function remove($project_id = '') {
		if ($this->session->userdata['user_type'] != 'CLIENT') {
			redirect(base_url());
		}
		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$this->project_model->removeProject($project_id);
			redirect('project');
		} else {
			redirect('project');
		}
	}
	public function removeall() {
		if ($this->session->userdata['user_type'] != 'CLIENT') {
			redirect(base_url());
		}
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($this->input->post('projectremovecheck')) {
				foreach ($this->input->post('projectremovecheck') as $ids) {
					$this->project_model->removeProject($ids);
				}
			}
			redirect('project');
		} else {
			redirect('project');
		}
	}
	public function sendLinkMail() {
		if ($this->session->userdata['user_type'] != 'CLIENT') {
			redirect(base_url());
		}
		$email = $this->auth_model->getClientEmailByID($this->session->userdata['user']);

		$subject = 'Interview Link';
		$message = "Your Interview Link : <strong>" . $this->input->post('text') . "</strong><br><br>";

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
	public function sendLoginDetailMail() {
		$candidate = $this->candidate_model->getCandidateDetails($this->input->post('candidate_id'));

		$subject = 'Login Credentials';
		$message = "Your Login Credentials are," . "<br><br>";
		$message .= "Login ID : <strong>" . $candidate->email . "</strong><br>";
		$message .= "Password : <strong>" . base64_decode($candidate->password) . "</strong><br>";

		$mail = new Mail();
		$mail->setTo($candidate->email);
		$mail->setFrom('info@e-interview.co.za');
		$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();
		echo 'success';
		die;
	}
	public function checkInterviewStatus() {
		$data = array();
		$interview = $this->project_model->checkInterviewStatus($this->input->post('id'));
		if (!$interview) {
			$data['msg'] = 'Candidates Not Invited';
		} else {
			foreach ($interview as $key => $value) {
				$candidate_detail = $this->candidate_model->getCandidateDetails($value->candidate_id);
				$data[] = array(
					'candidate' => $candidate_detail->name,
					'status' => $value->status,
				);
			}
		}
		echo json_encode($data);
		die;
	}
	public function interview_project() {
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

		$data['action'] = base_url() . 'project/minterviews';
		$data['search_action'] = base_url() . 'project/interview_project';

		$data['projects'] = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$projects = $this->project_model->getProjectsBySearch($this->session->userdata['user'], $this->input->post('text_search'));
		} else {
			$projects = $this->project_model->getProjects($this->session->userdata['user']);
		}

		if ($projects) {
			foreach ($projects as $project) {
				$data['projects'][] = array(
					'project_id' => $project->project_id,
					'project_name' => $project->project_name,
					'profile' => $this->job_profile_model->getProfileName($project->profile_id),
					'candidate' => $this->candidate_model->getCandidateName($project->candidate_id),
				);
			}
		}
		$this->app->view('interview_project', $data);
	}
	public function interviews($project_id = '') {
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

		$data['cancel'] = base_url() . 'project/interview_project';

		$data['interviews'] = array();
		$interviews = $this->interview_model->getInterviewsByProjectID($project_id);
		if ($interviews) {
			foreach ($interviews as $interview) {
				$data['interviews'][] = array(
					'interview_id' => $interview->interview_id,
					'project' => $this->project_model->getProjectName($interview->project_id),
					'candidate' => $this->candidate_model->getCandidateNameByID($interview->candidate_id),
					'start' => $interview->start,
					'end' => $interview->end,
					'path' => $interview->path,
					'status' => $interview->status,
				);
			}
		}
		$this->app->view('view_interviews', $data);
	}

	public function minterviews($project_id = '') {
		$data = array();
		$this->lang->load('interview');

		$data['heading_title'] = $this->lang->line('heading_title_interviews');
		$data['title'] = $this->lang->line('heading_title_interviews');
		$data['text_interviews'] = $this->lang->line('text_interviews');
		$data['text_interview'] = $this->lang->line('text_interview');
		$data['text_empty'] = $this->lang->line('text_empty_interview');

		$data['entry_interview_id'] = $this->lang->line('entry_interview_id');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_interview_candidate'] = $this->lang->line('entry_interview_candidate');
		$data['entry_interview_status'] = $this->lang->line('entry_interview_status');
		$data['entry_interview_start'] = $this->lang->line('entry_interview_start');
		$data['entry_interview_end'] = $this->lang->line('entry_interview_end');
		$data['entry_interview_path'] = $this->lang->line('entry_interview_path');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_watch'] = $this->lang->line('button_watch');

		$data['cancel'] = base_url() . 'project';
		$data['manager_evaluation'] = $this->lang->line('manager_evaluation');
		$data['client_evaluation'] = $this->lang->line('client_evaluation');

		$data['interviews'] = array();
		$interviews = $this->interview_model->getInterviewsByProjectID($project_id);
		if ($interviews) {
			foreach ($interviews as $interview) {
				$project_details = $this->project_model->getProjectDetailById($interview->project_id);

				$data['interviews'][] = array(
					'interview_id' => $interview->interview_id,
					'project_id' => $interview->project_id,
					'project_details' => $project_details,
					'project' => $this->project_model->getProjectName($interview->project_id),
					'candidate_id' => $interview->candidate_id,
					'client_id' => $this->hr_model->getAuthHr($project_details['client_id'])['profile_id'],
					'candidate' => $this->candidate_model->getCandidateNameByID($interview->candidate_id),
					'manager_details' => $this->manager_model->getManager($project_details['manager_id']),
					'client_details' => $this->hr_model->getAuthHr($project_details['client_id']),
					'start' => $interview->start,
					'end' => $interview->end,
					'path' => $interview->path,
					'is_credited' => $interview->is_credited,
					'manager_eva_rating' => $interview->manager_eva_rating,
					'status' => $interview->status,
				);
			}
		}
		$this->app->view('mview_interviews', $data);
	}

	public function dinterviews() {
		$data = array();
		$this->lang->load('interview');

		$data['heading_title'] = $this->lang->line('heading_title_interviews');
		$data['title'] = $this->lang->line('heading_title_interviews');
		$data['text_interviews'] = $this->lang->line('text_interviews');
		$data['text_interview'] = $this->lang->line('text_interview');
		$data['text_empty'] = $this->lang->line('text_empty_interview');

		$data['entry_interview_id'] = $this->lang->line('entry_interview_id');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_interview_candidate'] = $this->lang->line('entry_interview_candidate');
		$data['entry_interview_status'] = $this->lang->line('entry_interview_status');
		$data['entry_interview_start'] = $this->lang->line('entry_interview_start');
		$data['entry_interview_end'] = $this->lang->line('entry_interview_end');
		$data['entry_interview_path'] = $this->lang->line('entry_interview_path');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_watch'] = $this->lang->line('button_watch');

		$data['cancel'] = base_url() . 'project/dinterviews';
		$data['action'] = base_url() . 'project/dinterviews';

		$data['manager_evaluation'] = $this->lang->line('manager_evaluation');
		$data['client_evaluation'] = $this->lang->line('client_evaluation');
		$data['interviews'] = array();

		$dsearch = @$_POST['text_search'];

		if ($this->session->userdata['user_type'] == 'CLIENT') {
			$interviews = $this->interview_model->getInterviewsByClientID($this->session->userdata['user'], $dsearch);
		}
		if ($this->session->userdata['user_type'] === 'MANAGER') {
			$interviews = $this->interview_model->getInterviewsByManagerID($this->session->userdata['user'], $dsearch);
		}

		$interviews = $this->interview_model->getInterviewsByProjectID($project_id);
		if ($interviews) {
			foreach ($interviews as $interview) {
				$project_details = $this->project_model->getProjectDetailById($interview->project_id);

				$data['interviews'][] = array(
					'interview_id' => $interview->interview_id,
					'project_id' => $interview->project_id,
					'project_details' => $project_details,
					'project' => $this->project_model->getProjectName($interview->project_id),
					'candidate_id' => $interview->candidate_id,
					'client_id' => $this->hr_model->getAuthHr($project_details['client_id'])['profile_id'],
					'candidate' => $this->candidate_model->getCandidateNameByID($interview->candidate_id),
					'manager_details' => $this->manager_model->getManager($project_details['manager_id']),
					'client_details' => $this->hr_model->getAuthHr($project_details['client_id']),
					'start' => $interview->start,
					'end' => $interview->end,
					'path' => $interview->path,
					'is_credited' => $interview->is_credited,
					'manager_eva_rating' => $interview->manager_eva_rating,
					'client_eva_rating' => $interview->account_manager_eva_rating,
					'status' => $interview->status,
				);
			}
		}
		$this->app->view('mview_interviews', $data);
	}

	public function candidates($project_id = '') {
		$data = array();
		$this->lang->load('project');

		$data['heading_title'] = $this->lang->line('heading_title_candidates');
		$data['title'] = $this->lang->line('heading_title_candidates');
		$data['text_candidates'] = $this->lang->line('text_candidates');
		$data['text_empty_candidate'] = $this->lang->line('text_empty_candidate');
		$data['text_resend_login_detail'] = $this->lang->line('text_resend_login_detail');

		$data['entry_candidate_name'] = $this->lang->line('entry_candidate_name');
		$data['entry_test_completed'] = $this->lang->line('entry_test_completed');
		$data['entry_status'] = $this->lang->line('entry_status');
		$data['entry_action'] = $this->lang->line('entry_action');

		$data['button_cancel'] = $this->lang->line('button_cancel');

		$data['cancel'] = base_url() . 'project';
		$data['send_login_detail_url'] = base_url() . 'project/sendLoginDetailMail';

		$data['candidates'] = array();
		$candidates = $this->project_model->getProjectCandidates($project_id);
		if ($candidates) {
			foreach (array_count_values(json_decode($candidates)) as $candidate => $count) {
				$data['candidates'][] = array(
					'candidate_id' => $candidate,
					'candidate_name' => $this->candidate_model->getCandidateNameByID($candidate),
					'test_completed' => $this->project_model->countCompletedInterviewByCandidate($candidate, $project_id),
					'total_test' => $count,
				);
			}
		}
		$this->app->view('view_project_candidates', $data);
	}
	private function checkLogin() {
		if (isset($this->session->userdata['user'])) {
			return true;
		} else {
			return false;
		}
	}
	private function userLogin() {
		if ($this->checkLogin()) {
			$user = $this->session->userdata['user'];
			return $user;
		}
	}
	private function validateForm() {
		if (empty($this->input->post('project_name'))) {
			$this->error['error_project_name'] = $this->lang->line('error_project_name');
		}
		if (empty($this->input->post('profile_name'))) {
			$this->error['error_profile_name'] = $this->lang->line('error_profile_name');
		}
		if ($this->uri->segments[1] == 'project' && $this->uri->segments[2] == 'create') {
			if (is_array($this->input->post('candidate'))) {
				foreach ($this->input->post('candidate') as $key => $value) {
					if (is_array($value)) {
						foreach ($value as $key => $value2) {
							if (empty($value2)) {
								$this->error['error_candidate'] = $this->lang->line('error_candidate');
							}
						}
					}
				}
			}
		} else {
			if (is_array($this->input->post('candidate'))) {
				foreach ($this->input->post('candidate') as $key => $value) {
					if (is_array($value)) {
						foreach ($value as $key => $value2) {
							if (empty($value2)) {
								$this->error['error_candidate'] = $this->lang->line('error_candidate');
							}
						}
					}
				}
			}
		}

		// //Credit Validation
		// if (count($this->input->post('candidate')) > 0) {
		// 	$user_credit = $this->credit_model->getUserAvailableCredit($this->session->userdata['profile_id']);
		// 	$credit_require = (count($this->input->post('candidate')) * $this->credit);

		// 	if ($user_credit < $credit_require) {
		// 		$this->error['error_credit'] = 'Not Enough Credit.';
		// 		//$_POST['candidate'] = array();
		// 	}
		// }

		if (empty($this->input->post('notification'))) {
			$this->error['error_notification'] = $this->lang->line('error_notification');
		}
		if (!$this->input->post('open_project')) {
			if (empty($this->input->post('start_date'))) {
				$this->error['error_project_type'] = $this->lang->line('error_project_type');
			}
			if (empty($this->input->post('end_date'))) {
				$this->error['error_project_type'] = $this->lang->line('error_project_type');
			}
		}
		if ($this->input->post('open_project')) {
			if (empty($this->input->post('start_date'))) {
				$this->error['error_project_type'] = $this->lang->line('error_project_type');
			}
		}
		return !$this->error;
	}

	public function updateEvoRate() {
		if (count($_POST) == 2) {
			$value = $this->input->post('rate');
			$interview_id = $this->input->post('interview_id');
			if ($this->session->userdata['user_type'] == 'MANAGER') {
				$data = array('manager_eva_rating' => $value);
			} else {
				$data = array('client_eva_rating' => $value);
			}
			$where = array('interview_id' => $interview_id);

			if ($this->interview_model->updateEvoRate($data, $where)) {
				echo "1";
			} else {
				echo "0";
			}
		} else {
			echo "0";
		}
	}

	public function viewComment() {
		if (count($_POST) > 0) {
			$interview_id = $this->input->post('interview_id');
			if ($this->session->userdata['user_type'] == 'MANAGER') {
				$field = "client_eva_comment";
			} else {
				$field = "manager_eva_comment";
			}
			$where = array('interview_id' => $interview_id);
			echo $this->interview_model->getComment($field, $where);
		}
	}

	public function getComment() {
		if (count($_POST) > 0) {
			$interview_id = $this->input->post('interview_id');
			if ($this->session->userdata['user_type'] == 'MANAGER') {
				$field = "manager_eva_comment";
			} else {
				$field = "client_eva_comment";
			}
			$where = array('interview_id' => $interview_id);
			echo $this->interview_model->getComment($field, $where);
		}
	}

	public function saveComment() {
		if (count($_POST) == 2) {
			$comment = $this->input->post('txt_comment');
			$interview_id = $this->input->post('txt_interview_id');
			if ($comment == "" || $interview_id == "") {
				echo "0";
			} else {
				if ($this->session->userdata['user_type'] == 'MANAGER') {
					$data = array("manager_eva_comment" => $comment);
				} else {
					$data = array("client_eva_comment" => $comment);
				}
				$where = array('interview_id' => $interview_id);

				if ($this->interview_model->saveComment($data, $where)) {
					echo "1";
				} else {
					echo "0";
				}
			}
		} else {
			echo "0";
		}
	}

	public function disableSelectedInterview() {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($this->input->post('interviewIdCheck')) {
				$candidateIdArr = $this->input->post('candidateId');
				foreach ($this->input->post('interviewIdCheck') as $key => $interview_id) {
					$candidate_id = $candidateIdArr[$key];
					
					if (!empty($interview_id) || !empty($candidate_id)) {
						$where = array('interview_id' => $interview_id);
						$value = array('status' => 2);
						if ($this->interview_model->disableInterview($value, $where)) {
							$cwhere = array('candidate_id' => $candidate_id);
							$cvalue = array('status' => 0);
							if ($this->candidate_model->updateCandidate($cvalue, $cwhere)) {
								$this->session->set_flashdata('success', 'Interview Disabled Successfull.');
							} else {
								$this->session->set_flashdata('danger', 'Interview Disabled Failed.');
							}
						} else {
							$this->session->set_flashdata('danger', 'Interview Disabled Failed.');
						}
					}
				}
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
		//redirect('project/dinterviews');
	}
	
	public function disableInterview($interview_id = '', $candidate_id = '') {
		if (!empty($interview_id) || !empty($candidate_id)) {
			$where = array('interview_id' => $interview_id);
			$value = array('status' => 2);
			if ($this->interview_model->disableInterview($value, $where)) {
				$cwhere = array('candidate_id' => $candidate_id);
				$cvalue = array('status' => 0);
				if ($this->candidate_model->updateCandidate($cvalue, $cwhere)) {
					$this->session->set_flashdata('success', 'Interview Disabled Successfull.');
				} else {
					$this->session->set_flashdata('danger', 'Interview Disabled Failed.');
				}
			} else {
				$this->session->set_flashdata('danger', 'Interview Disabled Failed.');
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	public function enableSelectedInterview($interview_id = '', $candidate_id = '', $status = '') {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($this->input->post('interviewIdCheck')) {
				$candidateIdArr = $this->input->post('candidateId');
				$mmstatusArr = $this->input->post('mmstatus');
				foreach ($this->input->post('interviewIdCheck') as $key => $interview_id) {
					$candidate_id = $candidateIdArr[$key];
					$status = $mmstatusArr[$key];
							
					if (!empty($interview_id) || !empty($candidate_id)) {
						$where = array('interview_id' => $interview_id);
						$value = array('status' => $status);
						if ($this->interview_model->disableInterview($value, $where)) {
							$cwhere = array('candidate_id' => $candidate_id);
							$cvalue = array('status' => 1);
							if ($this->candidate_model->updateCandidate($cvalue, $cwhere)) {
								$this->session->set_flashdata('success', 'Interview Enabled Successfully.');
							} else {
								$this->session->set_flashdata('danger', 'Interview Enabled Failed.');
							}
						} else {
							$this->session->set_flashdata('danger', 'Interview Enabled Failed.');
						}
					}
				}
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
	
	public function enableInterview($interview_id = '', $candidate_id = '', $status = '') {
		if (!empty($interview_id) || !empty($candidate_id)) {
			$where = array('interview_id' => $interview_id);
			$value = array('status' => $status);
			if ($this->interview_model->disableInterview($value, $where)) {
				$cwhere = array('candidate_id' => $candidate_id);
				$cvalue = array('status' => 1);
				if ($this->candidate_model->updateCandidate($cvalue, $cwhere)) {
					$this->session->set_flashdata('success', 'Interview Enabled Successfull.');
				} else {
					$this->session->set_flashdata('danger', 'Interview Enabled Failed.');
				}
			} else {
				$this->session->set_flashdata('danger', 'Interview Enabled Failed.');
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	public function resetSelectedInterview($interview_id = '', $candidate_id = '', $project_id = '') {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($this->input->post('interviewIdCheck')) {
				$candidateIdArr = $this->input->post('candidateId');
				$projectIdArr = $this->input->post('projectId');
				$emailArr = array();
				foreach ($this->input->post('interviewIdCheck') as $key => $interview_id) {
					$candidate_id = $candidateIdArr[$key];
					$project_id = $projectIdArr[$key];
					
					if (!empty($interview_id) || !empty($candidate_id)) {
						$where = array('interview_id' => $interview_id);
						$value = array(
							'status' => 0,
							'start' => '',
							'end' => '',
							'path' => '',
							'is_credited' => 0, 
							'manager_eva_rating' => '',
							'manager_eva_comment' => '',
							'client_eva_rating' => '',
							'client_eva_comment' => '',
						);
						$ivalue = array(
							'note' => '',
							'start_status' => 0,
							'end_status' => 0,
							'status' => 'pending',
						);
			
						$iwhere = array('project_id' => $project_id, 'candidate_id' => $candidate_id);
			
						if ($this->interview_model->resetInterview($where) && $this->interview_model->updateInviteInterview($ivalue, $iwhere)) {
							$cwhere = array('candidate_id' => $candidate_id);
							$cvalue = array('status' => 1);
							if ($this->candidate_model->updateCandidate($cvalue, $cwhere)) {
								// Send Mail
								$candidate = $this->candidate_model->getCandidateDetails($candidate_id);
								$client_name = $this->candidate_model->getClientByProject($project_id);
								
								if(isset($emailArr[$candidate_id.'_'.$project_id]) && $emailArr[$candidate_id.'_'.$project_id] == $candidate->email){
									continue;
								}
								$subject = 'Login Credentials';
			
								$message = "Dear, " . $candidate->name . "<br><br>";
								$message .= "You have invited you to participate in an e-interview. An e-interview is in all aspects the
											same as a traditional interview, except that you will not be interviewed by a person but will
											be presented with a set of pre-selected questions and your interview will be recorded using
											your communication device’s webcam. Your recorded interview will then be available for
											review by the interview panel." . "<br><br>";
								$message .= "It is very important that you prepare for this interview in the same way you would for a
											normal interview." . "<br><br>";
								$message .= "Link : <strong>" . base_url() . "</strong><br>";
								$message .= "Username : <strong>" . $candidate->email . "</strong><br>";
								$message .= "Password : <strong>" . base64_decode($candidate->password) . "</strong><br><br>";
								$message .= "Good luck with your e-interview!" . "<br><br>";
								$message .= "Kind Regards" . "<br>";
								$message .= $client_name['name'] . "<br>";
								$message .= $client_name['client'];
			
								$mail = new Mail();
								$mail->setTo($candidate->email);
								$mail->setFrom('info@e-interview.co.za');
								$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
								$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
								$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
								$mail->send();
								
								$emailArr[$candidate_id.'_'.$project_id] = $candidate->email;
								$this->session->set_flashdata('success', 'Interview Reset Successfull.');
							} else {
								$this->session->set_flashdata('danger', 'Interview Reset Failed.');
							}
						} else {
							$this->session->set_flashdata('danger', 'Interview Reset Failed.');
						}
					}
				}
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
	
	public function resetInterview($interview_id = '', $candidate_id = '', $project_id = '') {
		if (!empty($interview_id) || !empty($candidate_id)) {
			$where = array('interview_id' => $interview_id);
			$value = array(
				'status' => 0,
				'start' => '',
				'end' => '',
				'path' => '',
				'is_credited' => 0,
				'manager_eva_rating' => '',
				'manager_eva_comment' => '',
				'client_eva_rating' => '',
				'client_eva_comment' => '',
			);
			$ivalue = array(
				'note' => '',
				'start_status' => 0,
				'end_status' => 0,
				'status' => 'pending',
			);

			$iwhere = array('project_id' => $project_id, 'candidate_id' => $candidate_id);

			if ($this->interview_model->resetInterview($where) && $this->interview_model->updateInviteInterview($ivalue, $iwhere)) {
				$cwhere = array('candidate_id' => $candidate_id);
				$cvalue = array('status' => 1);
				if ($this->candidate_model->updateCandidate($cvalue, $cwhere)) {
					// Send Mail
					$candidate = $this->candidate_model->getCandidateDetails($candidate_id);
					$client_name = $this->candidate_model->getClientByProject($project_id);
					$subject = 'Login Credentials';

					$message = "Dear, " . $candidate->name . "<br><br>";
					$message .= "You have invited you to participate in an e-interview. An e-interview is in all aspects the
								same as a traditional interview, except that you will not be interviewed by a person but will
								be presented with a set of pre-selected questions and your interview will be recorded using
								your communication device’s webcam. Your recorded interview will then be available for
								review by the interview panel." . "<br><br>";
					$message .= "It is very important that you prepare for this interview in the same way you would for a
								normal interview." . "<br><br>";
					$message .= "Link : <strong>" . base_url() . "</strong><br>";
					$message .= "Username : <strong>" . $candidate->email . "</strong><br>";
					$message .= "Password : <strong>" . base64_decode($candidate->password) . "</strong><br><br>";
					$message .= "Good luck with your e-interview!" . "<br><br>";
					$message .= "Kind Regards" . "<br>";
					$message .= $client_name['name'] . "<br>";
					$message .= $client_name['client'];

					$mail = new Mail();
					$mail->setTo($candidate->email);
					$mail->setFrom('info@e-interview.co.za');
					$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
					$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
					$mail->send();

					$this->session->set_flashdata('success', 'Interview Reset Successfull.');
				} else {
					$this->session->set_flashdata('danger', 'Interview Reset Failed.');
				}
			} else {
				$this->session->set_flashdata('danger', 'Interview Reset Failed.');
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	public function sendEmailToSelectedTemplate($templateId = 0) {
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($this->input->post('interviewIdCheck')) {
				$candidateIdArr = $this->input->post('candidateId');
				$projectIdArr = $this->input->post('projectId');
				$emailArr = array();
				
				$template = $this->template_model->getTemplateDetailById($templateId);
				
				$subject = $template['subject'];
				$message = html_entity_decode($template['email_content']);		
						
				foreach ($this->input->post('interviewIdCheck') as $key => $interview_id) {
					$candidate_id = $candidateIdArr[$key];
					$candidate = $this->candidate_model->getCandidateDetails($candidate_id);

					$mail = new Mail();
					$mail->setTo($candidate->email);
					$mail->setFrom('info@e-interview.co.za');
					$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
					$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
					$mail->send();
				}
				echo '<b class="text-success">Email Sent Successfully.</b>';
				die;
			}
		}
		echo '<b class="text-danger">Email Sent Failed.</b>';
		die;
	}

	public function rejectInterview($interview_id = '', $candidate_id = '') {
		if (!empty($interview_id) || !empty($candidate_id)) {
			$where = array('interview_id' => $interview_id);
			$value = array('status' => 3);
			if ($this->interview_model->rejectInterview($value, $where)) {
				$cwhere = array('candidate_id' => $candidate_id);
				$cvalue = array('status' => 0);
				if ($this->candidate_model->updateCandidate($cvalue, $cwhere)) {
					$this->session->set_flashdata('success', 'Interview Rejected Successfull.');

					$client_name = @$this->hr_model->getHrByCandidate($candidate_id)['name'];
					$candidate_name = $this->candidate_model->getCandidateNameByID($candidate_id);
					$candidate_email = $this->candidate_model->getCandidateEmailByID($candidate_id);

					$subject = 'e-Interview Rejection';
					$message = "Dear, " . $candidate_name . "<br><br>";
					$message .= "Thank you for taking the time to complete the e-interview. We have enjoyed learning more about you." . "<br><br>";
					$message .= "We regret to advise you that after careful consideration we must advise that you have not been successful on this occasion. We would like to thank you for the interest you have shown in the post." . "<br><br>";
					$message .= "With best wishes as you continue your search for the right post and may we take this opportunity to wish you every success in your career." . "<br><br>";
					$message .= "Yours sincerely," . "<br>";
					$message .= $client_name;

					$mail = new Mail();
					$mail->setTo($candidate_email);
					$mail->setFrom('info@e-interview.co.za');
					$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
					$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
					$mail->send();

				} else {
					$this->session->set_flashdata('danger', 'Interview Rejected Failed.');
				}
			} else {
				$this->session->set_flashdata('danger', 'Interview Rejected Failed.');
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

}
