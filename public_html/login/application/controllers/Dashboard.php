<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('auth_model', 'project_model', 'job_profile_model', 'candidate_model', 'hr_model', 'manager_model', 'interview_model'));
		if (isset($this->session->userdata['user_type']) && $this->session->userdata['user_type'] === 'CANDIDATE') {
			redirect(base_url() . "candidate_dashboard");
		}
		if (!$this->checkLogin()) {
			redirect(base_url());
		}
		//echo getcwd();
	}

	public function index() {
		$data = array();
		$this->lang->load('dashboard');

		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');

		$data['text_auths'] = $this->lang->line('text_auths');
		$data['text_total_projects'] = $this->lang->line('text_total_projects');
		$data['text_total_job_profiles'] = $this->lang->line('text_total_job_profiles');
		$data['text_total_candidates'] = $this->lang->line('text_total_candidates');
		$data['text_total_users'] = $this->lang->line('text_total_users');
		$data['text_projects'] = $this->lang->line('text_projects');
		$data['text_job_profiles'] = $this->lang->line('text_job_profiles');
		$data['entry_auth_id'] = $this->lang->line('entry_auth_id');
		$data['entry_auth_name'] = $this->lang->line('entry_auth_name');
		$data['entry_auth_email'] = $this->lang->line('entry_auth_email');
		$data['entry_auth_type'] = $this->lang->line('entry_auth_type');
		$data['button_continue'] = $this->lang->line('button_continue');
		$data['button_back'] = $this->lang->line('button_back');
		$data['text_heading_dashboard'] = $this->lang->line('text_dashboard');

		$data['link_job_profile'] = base_url() . 'job_profile';
		$data['link_project'] = base_url() . 'project';
		$data['link_candidate'] = base_url() . 'candidate';

		$data['user_type'] = $this->session->userdata("user_type");

		if ($data['user_type'] == 'ADMIN') {
			$data['text_total_users'] = $this->lang->line('text_total_clients');
			$data['users'] = $this->hr_model->getDashboardClients();
			$data['user_link'] = base_url() . 'hr';
			$data['projects'] = $this->project_model->getDashboardProjects();
			$data['job_profiles'] = $this->job_profile_model->getDashboardJob_profiles();
		} else if ($data['user_type'] == 'CLIENT') {
			$data['text_total_users'] = $this->lang->line('text_total_managers');
			$data['users'] = $this->manager_model->getDashboardManagers();
			$data['user_link'] = base_url() . 'manager';
			$data['projects'] = $this->project_model->getDashboardProjects();
			$data['job_profiles'] = $this->job_profile_model->getDashboardJob_profiles();
		} else {
			$data['text_total_users'] = $this->lang->line('text_total_candidates');
			$data['text_total_job_profiles'] = $this->lang->line('text_total_interview');
			$data['user_link'] = base_url() . 'candidate';
			$data['projects'] = $this->project_model->getProjectsByManager($this->session->userdata("user"));
			$data['users'] = $this->candidate_model->getCandidates($this->session->userdata("user"));
			$data['job_profiles'] = $this->interview_model->getCompletedInterviewByManager($this->session->userdata("user"));
			$data['link_project'] = base_url() . 'manage_project';
			$data['link_job_profile'] = base_url() . 'manage_project';
		}
		$this->app->view('dashboard', $data);
	}

	private function checkLogin() {
		if (isset($this->session->userdata['user'])) {
			return true;
		} else {
			return false;
		}
	}
}
