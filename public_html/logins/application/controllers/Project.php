<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {
	private $error = array();
	private $credit;
	function __construct() {
		parent::__construct();
		$this->load->helper(array('cookie', 'date', 'form'));
		$this->load->library(array('encrypt', 'form_validation', 'mail'));
		$this->load->model(array('job_profile_model', 'project_model', 'account_manager_model', 'manager_model', 'candidate_model', 'auth_model', 'interview_model', 'rater_model', 'credit_model', 'template_model'));
		$this->credit = $this->credit_model->getSystemCredit();
		if (!$this->checkLogin()) {
			redirect(base_url());
		} else if ($this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
	}
	public function index() {
		if ($this->session->userdata['user_type'] != 'MANAGER') {
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
		$data['entry_project_rater'] = $this->lang->line('entry_project_rater');
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
		if ($this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
		$data = array();
		$this->lang->load('project');

        if(isset($_POST['project_rater']) && $_POST['project_rater']) {
            $_POST['project_rater'] = json_decode($_POST['project_rater'], true);
            $_POST['project_rater'] = array_map(function ($data) {
                return $data['id'];
            }, $_POST['project_rater']);
        }

		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()) {
			$adddata = $this->input->post();
			$adddata['account_manager_id'] = $this->project_model->getAccountManagerID($this->session->userdata['user']);
			$adddata['manager_id'] = $this->session->userdata['user'];

			$create = $this->project_model->addProjects($adddata);
			redirect('project');
		}
		$data['heading_title'] = $this->lang->line('create_heading_title');
		$data['title'] = $this->lang->line('create_heading_title');
		$data['text_create_projects'] = $this->lang->line('text_create_projects');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_project_description'] = $this->lang->line('entry_project_description');
		$data['entry_profile_name'] = $this->lang->line('entry_profile_name');
		$data['entry_project_rater'] = $this->lang->line('entry_select_project_rater');
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
		$data['text_no_rater'] = $this->lang->line('text_no_rater');
		$data['entry_candidate_name'] = $this->lang->line('entry_candidate_name');
		$data['entry_candidate_email'] = $this->lang->line('entry_candidate_email');
		$data['entry_candidate_password'] = $this->lang->line('entry_candidate_password');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['note_create_rater'] = $this->lang->line('note_create_rater');
		$data['note_create_job_profile'] = $this->lang->line('note_create_job_profile');
		$data['button_create_candidate'] = $this->lang->line('button_create_candidate');
		$data['button_generate'] = $this->lang->line('button_generate');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_remove'] = $this->lang->line('button_remove');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_launch'] = $this->lang->line('button_launch');
		$data['button_update'] = $this->lang->line('button_update');

		$account_manager_id = $this->manager_model->getAccountManagerByManager($this->session->userdata['user']);
		$data['job_profiles'] = $this->job_profile_model->getJob_profiles($this->session->userdata['user']);
		$data['raters'] = $this->rater_model->getRaters($account_manager_id);

		if (isset($_POST['project_name'])) {
			$data['project_name'] = $this->input->post('project_name');
		} else {
			$data['project_name'] = '';
		}

		if (isset($_POST['email_template_id'])) {
			$data['email_template_id'] = $this->input->post('email_template_id');
		} else {
			$data['email_template_id'] = '';
		}

		if (isset($_POST['project_description'])) {
			$data['project_description'] = $this->input->post('project_description');
		} else {
			$data['project_description'] = '';
		}
		if (isset($_POST['profile_id'])) {
			$data['profile_id'] = $this->input->post('profile_id');
		} else {
			$data['profile_id'] = '';
		}
		if (isset($_POST['project_rater'])) {
			$data['rater_id'] = $this->input->post('project_rater');
		} else {
			$data['rater_id'] = array();
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
		if (isset($this->error['error_project_rater'])) {
			$data['error_project_rater'] = $this->error['error_project_rater'];
		} else {
			$data['error_project_rater'] = '';
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

		if (isset($this->error['error_email_template_id'])) {
			$data['error_email_template_id'] = $this->error['error_email_template_id'];
		} else {
			$data['error_email_template_id'] = '';
		}

		$data['generate_password_url'] = base_url() . 'auth/generate_password';
		$data['create_candidate_url'] = base_url() . 'project/create_candidate';
		$data['load_candidate_url'] = base_url() . 'project/loadCandidate';
		$data['action'] = base_url() . 'project/create';
		$data['cancel'] = base_url() . 'project';

		$templates = $this->template_model->getInvitationTemplates($this->session->userdata['user']);
		$templates = array(''=> 'Default Invitation Template') + $templates;

		$data['email_template'] = $templates;

		$this->app->view('create_projects', $data);
	}
	public function edit($project_id = '') {
		if ($this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
		$data = array();
		$this->lang->load('project');

		if(isset($_POST['project_rater']) && $_POST['project_rater']) {
            $_POST['project_rater'] = json_decode($_POST['project_rater'], true);
            $_POST['project_rater'] = array_map(function ($data) {
                return $data['id'];
            }, $_POST['project_rater']);
        }

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
		$data['entry_project_rater'] = $this->lang->line('entry_select_project_rater');
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
		$data['text_no_rater'] = $this->lang->line('text_no_rater');
		$data['entry_candidate_name'] = $this->lang->line('entry_candidate_name');
		$data['entry_candidate_email'] = $this->lang->line('entry_candidate_email');
		$data['entry_candidate_password'] = $this->lang->line('entry_candidate_password');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['note_create_rater'] = $this->lang->line('note_create_rater');
		$data['note_create_job_profile'] = $this->lang->line('note_create_job_profile');
		$data['button_create_candidate'] = $this->lang->line('button_create_candidate');
		$data['button_generate'] = $this->lang->line('button_generate');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_remove'] = $this->lang->line('button_remove');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_launch'] = $this->lang->line('button_launch');
		$data['button_update'] = $this->lang->line('button_update');

		$account_manager_id = $this->manager_model->getAccountManagerByManager($this->session->userdata['user']);
		$data['project'] = $this->project_model->getProject($project_id);
		$data['job_profiles'] = $this->job_profile_model->getJob_profiles($this->session->userdata['user']);
		$data['raters'] = $this->rater_model->getRaters($account_manager_id);

		if (isset($_POST['project_name'])) {
			$data['project_name'] = $this->input->post('project_name');
		} else if ($data['project']['project_name']) {
			$data['project_name'] = $data['project']['project_name'];
		} else {
			$data['project_name'] = '';
		}

		if (isset($_POST['email_template_id'])) {
			$data['email_template_id'] = $this->input->post('email_template_id');
		} else if (isset($data['project']['email_template_id']) && $data['project']['email_template_id']) {
			$data['email_template_id'] = $data['project']['email_template_id'];
		} else {
			$data['email_template_id'] = '';
		}

		if (isset($_POST['profile_id'])) {
			$data['profile_id'] = $this->input->post('profile_id');
		} else if ($data['project']['profile_id']) {
			$data['profile_id'] = $data['project']['profile_id'];
		} else {
			$data['profile_id'] = '';
		}
		if (isset($_POST['project_rater'])) {
			$data['rater_id'] = $this->input->post('project_rater');
		} else if ($data['project']['rater_id']) {
			$data['rater_id'] = json_decode($data['project']['rater_id']);
		} else {
			$data['rater_id'] = array();
		}

		$data['rater_id'] = json_decode($data['project']['rater_id']);

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
		if (isset($this->error['error_project_rater'])) {
			$data['error_project_rater'] = $this->error['error_project_rater'];
		} else {
			$data['error_project_rater'] = '';
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

		if (isset($this->error['error_email_template_id'])) {
			$data['error_email_template_id'] = $this->error['error_email_template_id'];
		} else {
			$data['error_email_template_id'] = '';
		}

		$data['action'] = base_url() . 'project/edit/' . $project_id;
		$data['cancel'] = base_url() . 'project';

		$templates = $this->template_model->getInvitationTemplates($this->session->userdata['user']);
		$templates = array(''=> 'Default Invitation Template') + $templates;

		$data['email_template'] = $templates;

		$this->app->view('create_projects', $data);
	}
	public function remove($project_id = '') {
		if ($this->session->userdata['user_type'] != 'MANAGER') {
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
		if ($this->session->userdata['user_type'] != 'MANAGER') {
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
		if ($this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
		$project_id = $this->input->post('id');
		$project_link = $this->input->post('text');

		$email = $this->manager_model->getAuthDetailByManagerID($this->session->userdata['user']);
		$project_name = $this->project_model->getProjectName($project_id);

		$subject = 'Interview Link';
		$message = "Dear, " . $email['name'] . "<br><br>";
		$message .= "You selected to use a generic link for the " . $project_name . "Your applicants can use the same link to register, their e-interviews will be automatically saved under this project. You can edit the email template as per your requirements, but it is important that you include the generic link as well as the IT requirements.<br><br>";
		$message .= "Email template to include with your email:<br>";
		$message .= "You have been invited to participate in an e-interview. An e-interview is in all aspects the same as a traditional interview, except that you will not be interviewed by a person, but will be presented with a set of pre-selected questions and your interview will be recorded using your communication device’s webcam. Your recorded interview will then be available for review by the interview panel.<br><br>";
		$message .= "Please click on the following link to access your e-interview: " . $project_link . "<br>";
		$message .= "It is very important that you prepare for this interview in the same way you would for a normal interview.<br><br>";
		$message .= "Please note the following IT requirements:<br>";
		$message .= "This system was designed to be used on a computer, laptop or any mobile device.<br />";
		$message .= "Only use Google Chrome as your internet browser. You can download Chrome here: https://www.google.com/chrome/ <br />";
		$message .= "Good luck with your e-interview!<br /><br />";
		$message .= "Kind regards,<br>";
		$message .= "Assessmenthouse";


		$mail = new Mail();
		$mail->setTo($email['email']);
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
					'full_path' => base_url('application/controllers/interview/uploads') . '/' . $interview->path,
					'status' => $interview->status,
				);
			}
		}
		$this->app->view('view_interviews', $data);
	}
	public function all() {
		$data = array();
		$this->lang->load('all_interview');

		$data['heading_title'] = $this->lang->line('heading_title_interviews');
		$data['title'] = $this->lang->line('heading_title_interviews');
		$data['text_interviews'] = $this->lang->line('text_interviews');
		$data['text_interview'] = $this->lang->line('text_interview');
		$data['text_empty'] = $this->lang->line('text_empty_interview');
		$data['rater_name'] = $this->lang->line('rater_name');
		$data['entry_interview_candidate'] = $this->lang->line('entry_interview_candidate');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_interview_status'] = $this->lang->line('entry_interview_status');
		$data['manager_evaluation'] = $this->lang->line('manager_evaluation');
		$data['button_watch'] = $this->lang->line('button_watch');
		$data['action'] = base_url() . 'project/all';

		$data['interviews'] = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$interviews = $this->interview_model->getallInterviews(array(
				'search' => $this->input->post('text_search'),
			));
		} else {
			$interviews = $this->interview_model->getallInterviews();
		}
		$data['interviews'] = array();
		if ($interviews) {
			foreach ($interviews as $interview) {

                $project_id = $interview->project_id;
                $project = $this->project_model->getProjectName($project_id);
                $ProjectData = $this->project_model->getProjectData($project_id);

                $total_time_taken        =  0;
                $interview_question_data = array();

                if($interview->question_data)
                {
                    $interview_question_data = json_decode($interview->question_data,true);
                    $data_time = array_column($interview_question_data,'time_taken');
                    $total_time_taken = ($data_time && !empty($data_time)) ? array_sum($data_time) : 0;
                    //$total_time_taken = ($data_time && !empty($data_time)) ? (array_sum($data_time) - count($data_time)) : 0;
                }
                else
                {
                    $interview_question_data = isset($ProjectData['job_profile']['question_list']) ? $ProjectData['job_profile']['question_list'] : array();
                    $data_time = array_column($interview_question_data,'expire');
                    $total_time_taken = ($data_time && !empty($data_time)) ? array_sum($data_time) : 0;
                    //$total_time_taken = ($data_time && !empty($data_time)) ? (array_sum($data_time) - count($data_time)) : 0;
                }


				$data['interviews'][] = array(
					'interview_id' => $interview->interview_id,
					'project_id' => $interview->project_id,
                    'project_data' => $ProjectData,
                    'question_data' => $interview_question_data,
                    'total_time_taken' => $total_time_taken,
					'project' => $interview->project_name,
					'candidate_id' => $interview->candidate_id,
					'account_manager_id' => $this->account_manager_model->getAuthAccountManager($interview->account_manager_id)['profile_id'],
					'manager_id' => $interview->manager_id,
					'candidate' => $interview->firstname . ' ' . $interview->lastname,
					'manager_details' => $this->manager_model->getManager($interview->manager_id),
					'start' => $interview->start,
					'end' => $interview->end,
					'path' => $interview->path,
					'full_path' => base_url('application/controllers/interview/uploads') . '/' . $interview->path,
					'is_credited' => $interview->is_credited,
					'manager_eva_rating' => $interview->manager_eva_rating,
					'manager_eva_comment' => $interview->manager_eva_comment,
					'rater_evaluation' => $this->interview_model->getRaterEvaluation($interview->interview_id, json_decode($interview->rater_id, 1)),
					'email_type' => $interview->email_type,
					'status' => (int) $interview->status,
				);
			}
		}

		$this->app->view('all_interview', $data);
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

		$data['entry_manager_evaluation'] = $this->lang->line('manager_evaluation');
		$data['cancel'] = base_url() . 'project';
		$data['action'] = base_url() . 'project/minterviews/' . $project_id;

		$project_details = $this->project_model->getProjectDetailById($project_id);
		$data['entry_rater_evaluation'] = array();
		if (!empty($project_details['rater_id'])) {
			$data['entry_rater_evaluation'] = $this->rater_model->getRatersName(json_decode($project_details['rater_id']));
		}
		$data['interviews'] = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$interviews = $this->interview_model->getInterviewsByProjectID($project_id, array('search' => $this->input->post('text_search')));
		} else {
			$interviews = $this->interview_model->getInterviewsByProjectID($project_id);
		}
		if ($interviews) {
			$project = $this->project_model->getProjectName($project_id);
            $ProjectData = $this->project_model->getProjectData($project_id);
			foreach ($interviews as $interview) {

                $total_time_taken        =  0;
                $interview_question_data = array();

			    if($interview->question_data)
                {
                    $interview_question_data = json_decode($interview->question_data,true);
                    $data_time = array_column($interview_question_data,'time_taken');
                    $total_time_taken = ($data_time && !empty($data_time)) ? array_sum($data_time) : 0;
                    //$total_time_taken = ($data_time && !empty($data_time)) ? (array_sum($data_time) - count($data_time)) : 0;
                }
			    else
                {
                    $interview_question_data = isset($ProjectData['job_profile']['question_list']) ? $ProjectData['job_profile']['question_list'] : array();
                    $data_time = array_column($interview_question_data,'expire');
                    $total_time_taken = ($data_time && !empty($data_time)) ? array_sum($data_time) : 0;
                    //$total_time_taken = ($data_time && !empty($data_time)) ? (array_sum($data_time) - count($data_time)) : 0;
                }

				$data['interviews'][] = array(
					'interview_id' => $interview->interview_id,
					'project_id' => $project_id,
					'project' => $project,
					'project_data' => $ProjectData,
					'question_data' => $interview_question_data,
                    'total_time_taken' => $total_time_taken,
					'candidate_id' => $interview->candidate_id,
					'account_manager_id' => $this->account_manager_model->getAuthAccountManager($project_details['account_manager_id'])['profile_id'],
					'manager_id' => $project_details['manager_id'],
					'candidate' => $interview->firstname . ' ' . $interview->lastname,
					'start' => $interview->start,
					'end' => $interview->end,
					'path' => $interview->path,
					'full_path' => base_url('application/controllers/interview/uploads') . '/' . $interview->path,
					'is_credited' => $interview->is_credited,
					'manager_eva_rating' => $interview->manager_eva_rating,
					'manager_eva_comment' => $interview->manager_eva_comment,
					'rater_evaluation' => $this->interview_model->getRaterEvaluation($interview->interview_id, json_decode($project_details['rater_id'])),
					'email_type' => $interview->email_type,
					'status' => (int) $interview->status,
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
		$data['entry_manager_evaluation'] = $this->lang->line('manager_evaluation');
		$data['entry_interview_end'] = $this->lang->line('entry_interview_end');
		$data['entry_interview_path'] = $this->lang->line('entry_interview_path');

		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_watch'] = $this->lang->line('button_watch');

		$data['cancel'] = base_url() . 'project';
		$data['action'] = base_url() . 'project/dinterviews';

		$data['entry_rater_evaluation'] = array();
		if (!empty($project_details['rater_id'])) {
			$data['entry_rater_evaluation'] = $this->rater_model->getRatersName(json_decode($project_details['rater_id']));
		}
		$data['interviews'] = array();
		$dsearch = @$_POST['text_search'];
		if ($this->session->userdata['user_type'] === 'ACCOUNT MANAGER') {
			$interviews = $this->interview_model->getInterviewsByAccountManagerID($this->session->userdata['user'], $dsearch);
		}
		if ($this->session->userdata['user_type'] === 'MANAGER') {
			$interviews = $this->interview_model->getInterviewsByManagerID($this->session->userdata['user'], $dsearch);
		}

		if ($interviews) {
			foreach ($interviews as $interview) {
				$project_details = $this->project_model->getProjectDetailById($interview->project_id);
				if (!empty($project_details['rater_id'])) {
					$data['rater_evaluation'] = $this->rater_model->getRatersName(json_decode($project_details['rater_id']));
				}

				$data['interviews'][] = array(
					'interview_id' => $interview->interview_id,
					'project_id' => $interview->project_id,
					'project_details' => $project_details,
					'project' => $this->project_model->getProjectName($interview->project_id),
					'candidate_id' => $interview->candidate_id,
					'account_manager_id' => $this->account_manager_model->getAuthAccountManager($project_details['account_manager_id'])['profile_id'],
					'manager_id' => $project_details['manager_id'],
					'candidate' => $this->candidate_model->getCandidateNameByID($interview->candidate_id),
					'manager_details' => $this->manager_model->getManager($project_details['manager_id']),
					'start' => $interview->start,
					'end' => $interview->end,
					'path' => $interview->path,
					'full_path' => base_url('application/controllers/interview/uploads') . '/' . $interview->path,
					'is_credited' => $interview->is_credited,
					'manager_eva_rating' => $interview->manager_eva_rating,
					'manager_eva_comment' => $interview->manager_eva_comment,
					'rater_evaluation' => $this->interview_model->getRaterEvaluation($interview->interview_id, json_decode($project_details['rater_id'])),
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
		if ($this->input->post('project_rater') && $this->input->post('project_rater')[0] == 0) {
			unset($_POST['project_rater'][0]);
		}

        if (count($this->input->post('project_rater')) <= 0) {
            $this->error['error_project_rater'] = $this->lang->line('error_project_select_rater');
        }
		if (count($this->input->post('project_rater')) > PROJECT_MAX_RATER) {
			$this->error['error_project_rater'] = $this->lang->line('error_project_rater');
		}
		if ($this->uri->segments[1] == 'project' && $this->uri->segments[2] == 'create') {
			if (empty($this->input->post('profile_id'))) {
				$this->error['error_profile_name'] = $this->lang->line('error_profile_name');
			}
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
/*
		if (!$this->input->post('email_template_id')){
			$this->error['error_email_template_id'] = ($this->lang->line('error_email_template_id')) ? $this->lang->line('error_email_template_id') : 'Select Email Template !!';
		}*/

		return !$this->error;
	}
	public function updateEvoRate() {
		if (count($_POST) == 2) {
			$value = $this->input->post('rate');
			$interview_id = $this->input->post('interview_id');
			$data = array('manager_eva_rating' => $value);
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
			$type = $this->input->post('type');
			$id = $this->input->post('id');
			if ($type == 'MANAGER') {
				$field = "manager_eva_comment";
				$where = array('interview_id' => $interview_id);
			} else if ($type == 'RATER') {
				$field = "comment";
				$where = array('rater_id' => $id, 'interview_id' => $interview_id);
			}
			echo $this->interview_model->getComment($field, $where, $type);
		}
	}
	public function getComment() {
		if (count($_POST) > 0) {
			$interview_id = $this->input->post('interview_id');
			$type = $this->input->post('type');
			$id = $this->input->post('id');
			if ($type == 'MANAGER') {
				$field = "manager_eva_comment";
				$where = array('interview_id' => $interview_id);
			} else if ($type == 'RATER') {
				$field = "comment";
				$where = array('rater_id' => $id, 'interview_id' => $interview_id);
			}
			echo $this->interview_model->getComment($field, $where, $type);
		}
	}
	public function saveComment() {
		if (count($_POST) == 2) {
			$comment = $this->input->post('txt_comment');
			$interview_id = $this->input->post('txt_interview_id');
			if ($comment == "" || $interview_id == "") {
				echo "0";
			} else {
				$data = array("manager_eva_comment" => $comment);
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

					if (!empty($interview_id) && !empty($candidate_id)) {
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
		if (!empty($interview_id) && !empty($candidate_id)) {
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

					if (!empty($interview_id) && !empty($candidate_id)) {
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
		if (!empty($interview_id) && !empty($candidate_id)) {
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

					if (!empty($interview_id) && !empty($candidate_id)) {
						$where = array('interview_id' => $interview_id);
						$value = array(
							'status' => 0,
							'start' => '',
							'end' => '',
							'path' => '',
							'is_credited' => 0,
							'manager_eva_rating' => '',
							'manager_eva_comment' => '',
							'account_manager_eva_rating' => '',
							'account_manager_eva_comment' => '',
						);
						$ivalue = array(
							'note' => '',
							'start_status' => 0,
							'end_status' => 0,
							'status' => 'pending',
						);
						$irvalue = array(
							'reating' => 0,
							'comment' => '',
						);

						$iwhere = array('project_id' => $project_id, 'candidate_id' => $candidate_id);

						if ($this->interview_model->resetInterview($where) && $this->interview_model->updateInviteInterview($ivalue, $iwhere) && $this->interview_model->updateResetRater($irvalue, $where)) {
							$cwhere = array('candidate_id' => $candidate_id);
							$cvalue = array('status' => 1);
							if ($this->candidate_model->updateCandidate($cvalue, $cwhere)) {
								// Send Mail
								$candidate = $this->candidate_model->getCandidateDetails($candidate_id);
								$client_name = $this->candidate_model->getClientByProject($project_id);

								if (isset($emailArr[$candidate_id . '_' . $project_id]) && $emailArr[$candidate_id . '_' . $project_id] == $candidate->email) {
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
								$message .= $client_name['account_manager'];

								$mail = new Mail();
								$mail->setTo($candidate->email);
								$mail->setFrom('info@e-interview.co.za');
								$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
								$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
								$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
								$mail->send();

								$emailArr[$candidate_id . '_' . $project_id] = $candidate->email;
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
		if (!empty($interview_id) && !empty($candidate_id)) {
			$where = array('interview_id' => $interview_id);
			$value = array(
				'status' => 0,
				'start' => '',
				'end' => '',
				'path' => '',
				'is_credited' => 0,
				'manager_eva_rating' => '',
				'manager_eva_comment' => '',
				'account_manager_eva_rating' => '',
				'account_manager_eva_comment' => '',
			);
			$ivalue = array(
				'note' => '',
				'start_status' => 0,
				'end_status' => 0,
				'status' => 'pending',
			);
			$irvalue = array(
				'reating' => 0,
				'comment' => '',
			);

			$iwhere = array('project_id' => $project_id, 'candidate_id' => $candidate_id);

			if ($this->interview_model->resetInterview($where) && $this->interview_model->updateInviteInterview($ivalue, $iwhere) && $this->interview_model->updateResetRater($irvalue, $where)) {
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
					$message .= $client_name['account_manager'];

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
				$data['email_type'] = array();

				foreach ($this->input->post('interviewIdCheck') as $key => $interview_id) {
					$candidate_id = $candidateIdArr[$key];

					$candidate = $this->candidate_model->getCandidateDetails($candidate_id);
					$email_type = $this->interview_model->updateInterviewEmailType($candidate_id, $template['interview_status']);

					$data['email_type'][$candidate_id] = $template['interview_status'];

					$mail = new Mail();
					$mail->setTo($candidate->email);
					$mail->setFrom('info@e-interview.co.za');
					$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
					$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
					$mail->send();
				}
				$data['msg'] = '<b class="text-success">Email Sent Successfully.</b>';
				echo json_encode($data);
				die;
			}
		}
		$data['msg'] = '<b class="text-danger">Email Sent Failed.</b>';
		echo json_encode($data);
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

					$client_name = @$this->account_rater_model->getAccountRaterByCandidate($candidate_id)['name'];
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
	public function deleteCandidate($interview_id = '', $candidate_id = '', $project_id = '') {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($this->input->post('interviewIdCheck')) {
				$candidateIdArr = $this->input->post('candidateId');
				$projectIdArr = $this->input->post('projectId');
				$emailArr = array();
				foreach ($this->input->post('interviewIdCheck') as $key => $interview_id) {
					$candidate_id = $candidateIdArr[$key];
					$project_id = $projectIdArr[$key];

					if (!empty($candidate_id)) {
						$where = array('project_id' => $project_id, 'candidate_id' => $candidate_id);

						if ($this->interview_model->deleteInterviewCandidate($where)) {
							$this->session->set_flashdata('success', 'Candidate Remove Successfull.');
						} else {
							$this->session->set_flashdata('danger', 'Candidate Remove Failed.');
						}
					}
				}
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	public function getInterviewStatus()
	{
		$returnArray = [];

		$interviewList = $adddata = $this->input->post('check_interview');

		if($interviewList && !empty($interviewList))
		{
			foreach($interviewList as $interview)
			{
				$interviewInfo = $this->interview_model->getInterviewInfo($interview);				
				$returnArray[] = array(
					'id' => $interviewInfo['interview_id'],
					'status' => $interviewInfo['status'],
					'label' => interviewStatus($interviewInfo['status']),
					'label_color' => interviewStatusColor($interviewInfo['status']),
				);				
			}
		}
		echo json_encode($returnArray);
	}
}