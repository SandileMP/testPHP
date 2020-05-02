<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_profile extends CI_Controller {
	private $error = array();
	function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model(array('job_profile_model','auth_model'));
        if(!$this->checkLogin()){
        	redirect(base_url());
        }else if($this->session->userdata['user_type'] != 'MANAGER'){
        	redirect(base_url());
        }
    }

	public function index(){
		$data = array();
		$this->lang->load('job_profile');

		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_job_profiles'] = $this->lang->line('text_job_profiles');
		$data['text_empty'] = $this->lang->line('text_empty');
		$data['entry_job_profile_id'] = $this->lang->line('entry_job_profile_id');
		$data['entry_job_profile_title'] = $this->lang->line('entry_job_profile_title');
		$data['entry_job_profile_role_title'] = $this->lang->line('entry_job_profile_role_title');
		$data['entry_job_profile_question'] = $this->lang->line('entry_job_profile_question');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_copy'] = $this->lang->line('button_copy');
		$data['button_edit'] = $this->lang->line('button_edit');
		$data['button_remove'] = $this->lang->line('button_remove');

		$data['action'] = base_url().'job_profile';
		$data['edit_job_profile'] = base_url().'job_profile/edit';
		$data['create_job_profile'] = base_url().'job_profile/create';
		$data['copy_job_profile'] = base_url().'job_profile/copy';
		$data['remove_job_profile'] = base_url().'job_profile/remove';
		$data['remove_all_job_profile'] = base_url().'job_profile/removeall';

		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$data['job_profiles'] = $this->job_profile_model->getJob_profilesBySearch($this->session->userdata['user'],$this->input->post('text_search'));
		}else{
			$data['job_profiles'] = $this->job_profile_model->getJob_profiles($this->session->userdata['user']);
		}
		$this->app->view('view_job_profiles',$data);
	}
	public function create(){
		$data = array();
		$this->lang->load('job_profile');
		
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()){
			$adddata = $this->input->post();
			$adddata['manager_id'] = $this->session->userdata['user'];
			$create = $this->job_profile_model->addjob_profiles($adddata);
			redirect('job_profile');
		}
		$data['job_profile'] = '';
		$data['expire'] = '';
		$data['heading_title'] = $this->lang->line('create_heading_title');
		$data['title'] = $this->lang->line('create_heading_title');
		$data['text_create_job_profiles'] = $this->lang->line('text_create_job_profiles');
		$data['entry_job_profile_title'] = $this->lang->line('entry_job_profile_title');
		$data['entry_job_profile_role_title'] = $this->lang->line('entry_job_profile_role_title');
		$data['entry_job_profile_question_list'] = $this->lang->line('entry_job_profile_question_list');
		$data['entry_job_profile_expire_time'] = $this->lang->line('entry_job_profile_expire_time');
		$data['entry_job_profile_question'] = $this->lang->line('entry_job_profile_question');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_remove'] = $this->lang->line('button_remove');

		if($this->input->post('job_profile_title')){
			$data['job_profile_title'] = $this->input->post('job_profile_title');
		}else{
			$data['job_profile_title'] = '';
		}
		if($this->input->post('job_profile_role_title')){
			$data['job_profile_role_title'] = $this->input->post('job_profile_role_title');
		}else{
			$data['job_profile_role_title'] = '';
		}
		if(!empty($this->input->post('question'))){
			$data['question'] = $this->input->post('question');
			$data['i'] = count($this->input->post('question'));
		}else{
			$data['question'] = '';
			$data['i'] = 0;
		}
		
		if(isset($this->error['error_job_profile_title'])){
			$data['error_job_profile_title'] = $this->error['error_job_profile_title'];
		}else{
			$data['error_job_profile_title'] = '';
		}
		if(isset($this->error['error_job_profile_role_title'])){
			$data['error_job_profile_role_title'] = $this->error['error_job_profile_role_title'];
		}else{
			$data['error_job_profile_role_title'] = '';
		}
		if(isset($this->error['error_job_profile_question'])){
			$data['error_job_profile_question'] = $this->error['error_job_profile_question'];
		}else{
			$data['error_job_profile_question'] = '';
		}
		$data['action'] = base_url().'job_profile/create';
		$data['cancel'] = base_url().'job_profile';

		$this->app->view('create_job_profiles',$data);
	}
	public function edit($job_profile_id = ''){
		$data = array();
		$this->lang->load('job_profile');

		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()){
			$this->job_profile_model->updatejob_profile($job_profile_id,$this->input->post());
			redirect('job_profile');
		}
		
		$edit_job_profile = $this->job_profile_model->getjob_profile($job_profile_id);

		if($this->input->post('job_profile_title')){
			$data['job_profile_title'] = $this->input->post('job_profile_title');
		}else if($edit_job_profile['title']){
			$data['job_profile_title'] = $edit_job_profile['title'];
		}else{
			$data['job_profile_title'] = '';
		}

		if($this->input->post('job_profile_role_title')){
			$data['job_profile_role_title'] = $this->input->post('job_profile_role_title');
		}else if($edit_job_profile['role_title']){
			$data['job_profile_role_title'] = $edit_job_profile['role_title'];
		}else{
			$data['job_profile_role_title'] = '';
		}

		if(!empty($this->input->post('question'))){
			$data['question'] = $this->input->post('question');
			$data['i'] = count($this->input->post('question'));
		}else if($edit_job_profile['question_list']){
			$question_list = json_decode($edit_job_profile['question_list'], true);
			$data['question'] = $question_list;
			$data['i'] = count($question_list);
		}else{
			$data['question'] = '';
			$data['i'] = 0;
		}

		$data['heading_title'] = $this->lang->line('edit_heading_title');
		$data['title'] = $this->lang->line('edit_heading_title');
		$data['text_create_job_profiles'] = $this->lang->line('text_edit_job_profiles');
		$data['entry_job_profile_title'] = $this->lang->line('entry_job_profile_title');
		$data['entry_job_profile_role_title'] = $this->lang->line('entry_job_profile_role_title');
		$data['entry_job_profile_question_list'] = $this->lang->line('entry_job_profile_question_list');
		$data['entry_job_profile_expire_time'] = $this->lang->line('entry_job_profile_expire_time');
		$data['entry_job_profile_question'] = $this->lang->line('entry_job_profile_question');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_remove'] = $this->lang->line('button_remove');
				
		if(isset($this->error['error_job_profile_title'])){
			$data['error_job_profile_title'] = $this->error['error_job_profile_title'];
		}else{
			$data['error_job_profile_title'] = '';
		}
		if(isset($this->error['error_job_profile_role_title'])){
			$data['error_job_profile_role_title'] = $this->error['error_job_profile_role_title'];
		}else{
			$data['error_job_profile_role_title'] = '';
		}
		if(isset($this->error['error_job_profile_question'])){
			$data['error_job_profile_question'] = $this->error['error_job_profile_question'];
		}else{
			$data['error_job_profile_question'] = '';
		}
		
		$data['action'] = base_url().'job_profile/edit/'.$job_profile_id;
		$data['cancel'] = base_url().'job_profile';

		$this->app->view('create_job_profiles',$data);
	}
	public function copy(){
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('removecheck')){
			foreach ($this->input->post('removecheck') as $job_profile_id) {
				$this->job_profile_model->copyjob_profiles($job_profile_id);
			}
			redirect('job_profile');
		}else{
			redirect('job_profile');
		}
	}
	public function remove($job_profile_id = ''){
		if($this->input->server('REQUEST_METHOD') == 'GET'){
			$this->job_profile_model->removejob_profile($job_profile_id);
			redirect('job_profile');
		}else{
			redirect('job_profile');
		}
	}
	public function removeall(){
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if($this->input->post('removecheck')){
				foreach ($this->input->post('removecheck') as $ids) {
					$this->job_profile_model->removejob_profile($ids);
				}
			}
			redirect('job_profile');
		}else{
			redirect('job_profile');
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
	private function validateForm(){
		if(empty($this->input->post('job_profile_title'))){
			$this->error['error_job_profile_title'] = $this->lang->line('error_job_profile_title');
		}
		if(empty($this->input->post('job_profile_role_title'))){
			$this->error['error_job_profile_role_title'] = $this->lang->line('error_job_profile_role_title');
		}
		if($this->input->post('question')){
			foreach ($this->input->post('question') as $key => $value) {
				if(empty($value['question']) || empty($value['expire'])){
					$this->error['error_job_profile_question'] = $this->lang->line('error_job_profile_question');
				}
			}
		}else{
			$this->error['error_job_profile_question'] = $this->lang->line('error_job_profile_question');
		}

		return !$this->error;
	}
}
