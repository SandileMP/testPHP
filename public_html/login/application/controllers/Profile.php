<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	private $error = array();
	function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model(array('auth_model', 'hr_model', 'manager_model'));
        if(!$this->checkLogin()){
        	redirect(base_url());
        }
    }

	public function index(){
		$data = array();
		$this->lang->load('profile');

		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('update_profile') && $this->validateForm()){
			$this->auth_model->updateAuthProfile($this->input->post(),$this->userLogin());
			redirect('dashboard');
		}
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('change_password') && $this->validatePassword()){
			$this->auth_model->updatePassword($this->input->post(),$this->userLogin());
			redirect('dashboard');
		}
		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_heading_profile'] = $this->lang->line('text_profile');
		$data['text_heading_password'] = $this->lang->line('text_heading_password');
		$data['button_update_profile'] = $this->lang->line('button_update_profile');
		$data['button_change_password'] = $this->lang->line('button_change_password');
		
		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_email'] = $this->lang->line('entry_email');
		$data['entry_type'] = $this->lang->line('entry_type');
		$data['entry_old_password'] = $this->lang->line('entry_old_password');
		$data['entry_new_password'] = $this->lang->line('entry_new_password');
		$data['entry_retype_password'] = $this->lang->line('entry_retype_password');
		$data['text_tab_profile'] = $this->lang->line('text_tab_profile');
		$data['text_tab_password'] = $this->lang->line('text_tab_password');
		
		$data['action'] = base_url().'profile';

		if(isset($this->error['email'])){
			$data['error_email'] = $this->error['email'];
		}else{
			$data['error_email'] = '';
		}
		if(isset($this->error['old_password'])){
			$data['error_old_password'] = $this->error['old_password'];
		}else{
			$data['error_old_password'] = '';
		}
		if(isset($this->error['new_password'])){
			$data['error_new_password'] = $this->error['new_password'];
		}else{
			$data['error_new_password'] = '';
		}
		if(isset($this->error['retype_password'])){
			$data['error_retype_password'] = $this->error['retype_password'];
		}else{
			$data['error_retype_password'] = '';
		}

		$data['userDetail'] = $this->auth_model->getAuthProfile($this->userLogin());
		if($this->input->post('name')){
			$data['name'] = $this->input->post('name');
		}else if($data['userDetail']['name']){
			$data['name'] = $data['userDetail']['name'];
		}else{
			$data['name'] = '';
		}
		if($this->input->post('email')){
			$data['email'] = $this->input->post('email');
		}else if($data['userDetail']['email']){
			$data['email'] = $data['userDetail']['email'];
		}else{
			$data['email'] = '';
		}
		if($this->input->post('type')){
			$data['type'] = $this->input->post('type');
		}else if($data['userDetail']['type']){
			$data['type'] = $data['userDetail']['type'];
		}else{
			$data['type'] = '';
		}

		if($this->input->post('old_password')){
			$data['old_password'] = $this->input->post('old_password');
		}else{
			$data['old_password'] = '';
		}

		if($this->input->post('new_password')){
			$data['new_password'] = $this->input->post('new_password');
		}else{
			$data['new_password'] = '';
		}


		$this->app->view('profile',$data);
	}
	private function validatePassword(){
		$userData = $this->auth_model->getAuth($this->userLogin());
		if(empty($this->input->post('old_password'))){
			$this->error['old_password'] = $this->lang->line('error_old_password');
		}
		if(base64_decode($userData['password']) != $this->input->post('old_password')){
			$this->error['old_password'] = $this->lang->line('error_old_password');
		}
		if(empty($this->input->post('new_password'))){
			$this->error['new_password'] = $this->lang->line('error_new_password');
		}
		if($this->input->post('new_password') != $this->input->post('retype_password')){
			$this->error['retype_password'] = $this->lang->line('error_retype_password');
		}

		return !$this->error;
	}
	private function validateForm(){
		if(empty($this->input->post('email'))){
			$this->error['email'] = 'Enter Valid Email Address!';			
		}
		if($this->session->userdata['user_type'] == 'CLIENT'){
			$hr_id = $this->hr_model->getAuthHr($this->session->userdata['user']);
			$already = $this->hr_model->checkDuplicateUpdateEmail($this->input->post('email'),$hr_id['profile_id']);
			if($already){
				$this->error['email'] = 'Email ID Already Exists!';
			}
		}else if($this->session->userdata['user_type'] == 'MANAGER'){
			$manager_id = $this->manager_model->getAuthManager($this->session->userdata['user']);
			$already = $this->manager_model->checkDuplicateUpdateEmail($this->input->post('email'),$manager_id['profile_id']); 
			if($already){
				$this->error['email'] = 'Email ID Already Exists!';
			}
		}else{
			$checkEmail = $this->auth_model->checkEmail($this->input->post('email'));
			if($checkEmail && $checkEmail['email'] != $this->input->post('email')){
				$this->error['email'] = $this->lang->line('error_email');			
			}
		}

		return !$this->error;
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
