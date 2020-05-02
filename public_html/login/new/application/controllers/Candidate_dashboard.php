<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Candidate_dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model(array('auth_model','project_model','job_profile_model','candidate_model','hr_model','manager_model','interview_model'));
        if(!$this->checkLogin()){
        	redirect(base_url());
        }
    }

	public function index(){
		$data = array();
		$this->lang->load('candidate_dashboard');
		
		$data['heading_title'] = $this->lang->line('text_dashboard');
		$data['title'] = $this->lang->line('text_dashboard');
		$data['text_heading_dashboard'] = $this->lang->line('text_dashboard');

		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_job_title'] = $this->lang->line('entry_job_title');
		$data['entry_job_role_title'] = $this->lang->line('entry_job_role_title');
		$data['entry_start_date'] = $this->lang->line('entry_start_date');
		$data['entry_end_date'] = $this->lang->line('entry_end_date');
		$data['entry_action'] = $this->lang->line('entry_action');

		$data['button_begin'] = $this->lang->line('button_begin');
		$data['button_watch'] = $this->lang->line('button_watch');
		$data['interview_link'] = base_url().'welcome';
		$data['action'] = base_url().'candidate_dashboard';
		
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$this->session->userdata['interview_project'] = $this->input->post('begin_interview');
			redirect(base_url().'welcome');
		}

		$interview_detail = $this->interview_model->getInterviewDetails($this->session->userdata['interview_user']);
		$data['project'] = array(
			'project_name'	=>	$this->project_model->getProjectName($interview_detail['project_id']),
			'project_code'	=>	$this->project_model->getProjectCode($interview_detail['project_id']),
			'title'			=>	$interview_detail['title'],
			'role_title'	=>	$interview_detail['role_title'],
			'note'			=>	$interview_detail['note'],
			'project_type'	=>	$interview_detail['project_type'],
			'start_date'	=>	$interview_detail['start_date'],
			'end_date'		=>	$interview_detail['end_date'],
		);
		$data['interview_completed'] = $this->interview_model->getInterviewCompleteDetails($this->session->userdata['interview_user']);
		$this->app->view('candidate_dashboard',$data);
	}

	private function checkLogin(){
		if(isset($this->session->userdata['interview_user'])){
			return true;
		}else{
			return false;
		}
	}
}
