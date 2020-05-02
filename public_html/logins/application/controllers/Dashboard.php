<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('auth_model', 'project_model', 'job_profile_model', 'candidate_model', 'account_manager_model', 'distributor_model', 'manager_model', 'interview_model', 'credit_model', 'rater_model','user_model'));
		if (isset($this->session->userdata['user_type']) && $this->session->userdata['user_type'] === 'CANDIDATE') {
			redirect(base_url() . "candidate_dashboard");
		}
		if (!$this->checkLogin()) {
			redirect(base_url());
		}
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


		$data['user_type'] = $this->session->userdata("user_type");

		if ($data['user_type'] == 'ADMIN') {
			$data['link_box1'] = base_url() . 'distributor';
			$data['box1'] = $this->distributor_model->getDashboardDistributors();
			$data['text_total_box1'] = $this->lang->line('text_total_distributors');
			$data['link_box2'] = base_url() . 'credit/managecreditrequest';
			$data['box2'] = $this->credit_model->getDistributorCreditRequestList($this->session->userdata['user']);
			$data['text_total_box2'] = $this->lang->line('text_total_credit_request');
		} else if ($data['user_type'] == 'DISTRIBUTOR') {
			$data['link_box1'] = base_url() . 'account_manager';
			$data['box1'] = $this->account_manager_model->getDashboardAccountManagers($this->session->userdata['user']);
			$data['text_total_box1'] = $this->lang->line('text_total_account_managers');
			$data['link_box2'] = base_url() . 'credit/managecreditrequest';
			$data['box2'] = $this->credit_model->getCreditRequestList($this->session->userdata['user']);
			$data['text_total_box2'] = $this->lang->line('text_total_credit_request');
		} else if ($data['user_type'] == 'ACCOUNT MANAGER') {
			$data['link_box1'] = base_url() . 'manager';
			$data['box1'] = $this->manager_model->getDashboardManagers();
			$data['text_total_box1'] = $this->lang->line('text_total_managers');
			$data['link_box2'] = base_url() . 'account_manager_project';
			$data['box2'] = $this->project_model->getDashboardProjects();
			$data['text_total_box2'] = $this->lang->line('text_total_projects');
		} else if($data['user_type'] == 'MANAGER') {
			$data['link_box1'] = base_url() . 'rater';
			$account_manager_id = $this->manager_model->getAccountManagerByManager($this->session->userdata['user']);
			$data['box1'] = $this->rater_model->getRaters($account_manager_id);
			$data['text_total_box1'] = $this->lang->line('text_total_raters');
			$data['link_box2'] = base_url() . 'job_profile';
			$data['box2'] = $this->job_profile_model->getDashboardJob_profiles();
			$data['text_total_box2'] = $this->lang->line('text_total_job_profiles');
			$data['link_box3'] = base_url() . 'project';
			$data['box3'] = $this->project_model->getDashboardProjects();
			$data['text_total_box3'] = $this->lang->line('text_total_projects');
            $data['box4Credit'] = $this->lang->line('text_total_projects');

            $data['user_info'] =  $this->user_model->getUsersByType($this->session->userdata['user'],$this->session->userdata['user_type']);

		} else if($data['user_type'] == 'RATER') {
			$data['link_box3'] = base_url() . 'rater_project';
			$data['box3'] = $this->rater_model->getRaterProjects($this->session->userdata['user']);
			$data['text_total_box3'] = $this->lang->line('text_total_projects');
		}

        $data['user_info'] =  $this->user_model->getUsersByType($this->session->userdata['user'],$this->session->userdata['user_type']);
		$this->app->view('dashboard', $data);
	}

	private function checkLogin() {
		if (isset($this->session->userdata['user'])) {
			return true;
		} else {
			return false;
		}
	}

	public function switchRole()
	{
		if($this->input->post('role')){
			$response = $this->auth_model->getUserByRole($this->input->post('role'), $this->session->userdata['user']);

			$roleList = $this->auth_model->getRoleList($response['email']);

			$this->session->userdata['user'] = $response['auth_id'];
			$this->session->userdata['user_type'] = $response['type'];
			$this->session->userdata['profile_id'] = $response['profile_id'];

			if($roleList && !empty($roleList)){
				$this->session->userdata['switch_role'] = $roleList;
			}
		}
		redirect(base_url() . 'dashboard');
	}

	public function activity() 
	{		
		$profile_id = $this->session->userdata['profile_id'];
		$data['title'] = 'User Activity';
		$filter = $this->input->get();		
		$activity = $this->User_activity_model->getActivity();
		$data['activity'] = $activity;
		
		$this->app->view('user_activity', $data);

	}
}
