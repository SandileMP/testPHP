<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_interview extends CI_Controller {
	private $error = array();
	function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation','mail'));
		$this->load->model(array('auth_model','interview_model','project_model','candidate_model','job_profile_model'));
        if(!$this->checkLogin()){
        	redirect(base_url());
        }else if($this->session->userdata['user_type'] != 'MANAGER'){
        	redirect(base_url());
        }
    }
	public function index(){
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

		$data['action'] = base_url().'manage_interview/interviews';

		$data['projects'] = array();
		$projects = $this->project_model->getProjectsByManager($this->session->userdata['user']);
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
		$this->app->view('manage_interview',$data);
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

		$data['cancel'] = base_url().'manage_interview';

		$data['interviews'] = array();
		//$interviews = $this->interview_model->getInterviewsByProjectID($project_id);
		$interviews = $this->interview_model->getManagerInterviewsByProjectID($this->session->userdata('user'),$project_id);
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
		$this->app->view('interviews',$data);
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
