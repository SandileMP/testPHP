<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller {
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
		$this->lang->load('candidate');
		
		$data['heading_title'] = $this->lang->line('heading_title_candidate');
		$data['title'] = $this->lang->line('heading_title_candidate');
		$data['text_candidate_list'] = $this->lang->line('text_candidate_list');
		$data['text_empty'] = $this->lang->line('text_empty_candidate');
		$data['entry_candidate_id'] = $this->lang->line('entry_candidate_id');
		$data['entry_candidate_name'] = $this->lang->line('entry_candidate_name');
		$data['entry_candidate_email'] = $this->lang->line('entry_candidate_email');
		$data['entry_candidate_interview'] = $this->lang->line('entry_candidate_interview');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_remove'] = $this->lang->line('button_remove');

		$data['remove_candidate'] = base_url() . 'candidate/remove';
		$projects = $this->project_model->getProjects();
		$candidates = $this->candidate_model->getCandidates($this->session->userdata['user']);

		$data['candidates'] = array();
		if($candidates) {
			foreach (json_decode(json_encode($candidates), true) as $key => $candidate) {		
				$data['candidates'][] = array(
					'candidate_id'			=>	$candidate['candidate_id'],
					'candidate_name'		=>	$candidate['candidate_name'],
					'candidate_email'		=>	$candidate['candidate_email'],
					'candidate_interviews'	=>	count($this->candidate_model->getCandidateInterview($candidate['candidate_id'])),
				);
			}
		}
		$this->app->view('candidate',$data);
	}
	public function remove($candidate_id = ''){
		if($this->input->server('REQUEST_METHOD') == 'GET'){
			$this->candidate_model->removeCandidate($candidate_id);
			redirect('candidate');
		}else{
			redirect('candidate');
		}
	}
	public function removeall(){
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if($this->input->post('removecheck')){
				foreach ($this->input->post('removecheck') as $ids) {
					$this->candidate_model->removeCandidate($ids);
				}
			}
			redirect('candidate');
		}else{
			redirect('candidate');
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
