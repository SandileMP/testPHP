<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	private $error = array();
	function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation','mail','email'));
		$this->load->model(array('auth_model'));
		$userDetail = $this->auth_model->getAuth($this->userLogin());
        if(!$this->checkLogin() || $userDetail['type'] != 'ADMIN'){
        	redirect(base_url());
        }
    }
	public function hr(){
		$data = array();
		$data['auth_type'] = 'HR';
		$this->lang->load('auth');
		
		$data['heading_title'] = $this->lang->line('hr_heading_title');
		$data['title'] = $this->lang->line('hr_heading_title');
		$data['text_auths'] = $this->lang->line('hr_text_auth');
		$data['text_empty'] = $this->lang->line('hr_text_empty');
		$data['entry_auth_id'] = $this->lang->line('entry_auth_id');
		$data['entry_auth_name'] = $this->lang->line('entry_auth_name');
		$data['entry_auth_email'] = $this->lang->line('entry_auth_email');
		$data['entry_auth_password'] = $this->lang->line('entry_auth_password');
		$data['entry_auth_type'] = $this->lang->line('entry_auth_type');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_create'] = $this->lang->line('hr_button_create');
		$data['button_edit'] = $this->lang->line('button_edit');
		$data['button_remove'] = $this->lang->line('button_remove');

		$data['action'] = base_url().'auth/hr';
		$data['edit_auth'] = base_url().'auth/edit_hr';
		$data['create_auth'] = base_url().'auth/create_hr';
		$data['remove_auth'] = base_url().'auth/remove/hr';
		$data['remove_all_auth'] = base_url().'auth/removeall/hr';

		$data['auths'] = $this->auth_model->getAuths($data['auth_type']);
		$this->app->view('view_auth',$data);
	}
	public function create_hr(){
		$data = array();
		$data['auth_type'] = 'HR';
		$this->lang->load('auth');
		
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()){
			$auth_type['auth_type'] = 'HR';
			$auth_type['password'] = $this->email_password();
			$create = $this->auth_model->addAuth($this->input->post(),$auth_type);
			if($create){
				$subject = 'Login Credentials';
				$message = "Your Login Credentials are,<br><br>";
				$message .= "Login Link : <strong>". base_url() ."</strong><br>";
				$message .= "Auth Type : <strong>". $auth_type['auth_type'] ."</strong><br>";
				$message .= "Login ID : <strong>". $this->input->post('auth_email') ."</strong><br>";
				$message .= "Password : <strong>". $auth_type['password'] ."</strong><br>";

				$mail = new Mail();
				$mail->setTo($this->input->post('auth_email'));
				$mail->setFrom('info@e-interview.co.za');
				$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
				$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
				$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
				$mail->send();
			}
			redirect('auth/hr');
		}
		$data['heading_title'] = $this->lang->line('create_hr_heading_title');
		$data['title'] = $this->lang->line('create_hr_heading_title');
		$data['text_create_auth'] = $this->lang->line('text_create_hr');
		$data['entry_auth_name'] = $this->lang->line('entry_auth_name');
		$data['entry_auth_email'] = $this->lang->line('entry_auth_email');
		$data['entry_auth_password'] = $this->lang->line('entry_auth_password');
		$data['entry_auth_type'] = $this->lang->line('entry_auth_type');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_remove'] = $this->lang->line('button_remove');
		$data['button_generate'] = $this->lang->line('button_generate');

		if($this->input->post('auth_name')){
			$data['auth_name'] = $this->input->post('auth_name');
		}else{
			$data['auth_name'] = '';
		}
		if($this->input->post('auth_email')){
			$data['auth_email'] = $this->input->post('auth_email');
		}else{
			$data['auth_email'] = '';
		}

		if(isset($this->error['warning'])){
			$data['warning'] = $this->error['warning'];
		}else{
			$data['warning'] = '';
		}
		if(isset($this->error['error_name'])){
			$data['error_name'] = $this->error['error_name'];
		}else{
			$data['error_name'] = '';
		}
		if(isset($this->error['error_email'])){
			$data['error_email'] = $this->error['error_email'];
		}else{
			$data['error_email'] = '';
		}

		$data['action'] = base_url().'auth/create_hr';
		$data['cancel'] = base_url().'auth/hr';

		$this->app->view('create_auth',$data);
	}
	public function edit_hr($auth_id = ''){
		$data = array();
		$this->lang->load('auth');
		
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateEditForm()){
			$create = $this->auth_model->updateAuth($auth_id,$this->input->post());
			if($create){
				$subject = 'Your New Password';
				$message = "Your Password Has Changed,<br><br>";
				$message .= "New Password : <strong>". $this->input->post('auth_password') ."</strong><br>";

				$mail = new Mail();
				$mail->setTo($this->input->post('auth_email'));
				$mail->setFrom('info@e-interview.co.za');
				$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
				$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
				$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
				$mail->send();
			}
			redirect('auth/hr');
		}
		$data['heading_title'] = $this->lang->line('edit_hr_heading_title');
		$data['title'] = $this->lang->line('edit_hr_heading_title');
		$data['text_create_auth'] = $this->lang->line('text_edit_hr_auth');
		$data['entry_auth_name'] = $this->lang->line('entry_auth_name');
		$data['entry_auth_email'] = $this->lang->line('entry_auth_email');
		$data['entry_auth_password'] = $this->lang->line('entry_auth_password');
		$data['entry_auth_type'] = $this->lang->line('entry_auth_type');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_remove'] = $this->lang->line('button_remove');
		$data['button_generate'] = $this->lang->line('button_generate');

		$data['auth'] = $this->auth_model->getAuth($auth_id);

		if($this->input->post('auth_name')){
			$data['auth_name'] = $this->input->post('auth_name');
		}else if($data['auth']['name']){
			$data['auth_name'] = $data['auth']['name'];
		}else{
			$data['auth_name'] = '';
		}
		if($this->input->post('auth_email')){
			$data['auth_email'] = $this->input->post('auth_email');
		}else if($data['auth']['email']){
			$data['auth_email'] = $data['auth']['email'];
		}else{
			$data['auth_email'] = '';
		}
		if($this->input->post('auth_password')){
			$data['auth_password'] = $this->input->post('auth_password');
		}else if($data['auth']['password']){
			$data['auth_password'] = $data['auth']['password'];
		}else{
			$data['auth_password'] = '';
		}
		
		if($data['auth']['type']){
			$data['auth_type'] = $data['auth']['type'];
		}else{
			$data['auth_type'] = '';
		}

		if(isset($this->error['warning'])){
			$data['warning'] = $this->error['warning'];
		}else{
			$data['warning'] = '';
		}
		
		if(isset($this->error['error_name'])){
			$data['error_name'] = $this->error['error_name'];
		}else{
			$data['error_name'] = '';
		}
		if(isset($this->error['error_email'])){
			$data['error_email'] = $this->error['error_email'];
		}else{
			$data['error_email'] = '';
		}
		if(isset($this->error['error_password'])){
			$data['error_password'] = $this->error['error_password'];
		}else{
			$data['error_password'] = '';
		}

		$data['action'] = base_url().'auth/edit_hr/'.$auth_id;
		$data['cancel'] = base_url().'auth/hr';
		$data['generate_password_url'] = base_url().'auth/generate_password';

		$this->app->view('create_auth',$data);
	}
	public function manager(){
		$data = array();
		$data['auth_type'] = 'MANAGER';
		$this->lang->load('auth');
		
		$data['heading_title'] = $this->lang->line('manager_heading_title');
		$data['title'] = $this->lang->line('manager_heading_title');
		$data['text_auths'] = $this->lang->line('manager_text_auth');
		$data['text_empty'] = $this->lang->line('manager_text_empty');
		$data['entry_auth_id'] = $this->lang->line('entry_auth_id');
		$data['entry_auth_name'] = $this->lang->line('entry_auth_name');
		$data['entry_auth_email'] = $this->lang->line('entry_auth_email');
		$data['entry_auth_password'] = $this->lang->line('entry_auth_password');
		$data['entry_auth_type'] = $this->lang->line('entry_auth_type');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_create'] = $this->lang->line('manager_button_create');
		$data['button_edit'] = $this->lang->line('button_edit');
		$data['button_remove'] = $this->lang->line('button_remove');

		$data['action'] = base_url().'auth/manager';
		$data['edit_auth'] = base_url().'auth/edit_manager';
		$data['create_auth'] = base_url().'auth/create_manager';
		$data['remove_auth'] = base_url().'auth/remove/manager';
		$data['remove_all_auth'] = base_url().'auth/removeall/manager';

		$data['auths'] = $this->auth_model->getAuths($data['auth_type']);
		$this->app->view('view_auth',$data);
	}
	public function create_manager(){
		$data = array();
		$data['auth_type'] = 'MANAGER';
		$this->lang->load('auth');
		
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()){
			$auth_type['auth_type'] = 'MANAGER';
			$auth_type['password'] = $this->email_password();
			$create = $this->auth_model->addAuth($this->input->post(),$auth_type);
			if($create){
				$subject = 'Login Credentials';
				$message = "Your Login Credentials are,<br><br>";
				$message .= "Login Link : <strong>". base_url() ."</strong><br>";
				$message .= "Auth Type : <strong>". $auth_type['auth_type'] ."</strong><br>";
				$message .= "Login ID : <strong>". $this->input->post('auth_email') ."</strong><br>";
				$message .= "Password : <strong>". $auth_type['password'] ."</strong><br>";

				$mail = new Mail();
				$mail->setTo($this->input->post('auth_email'));
				$mail->setFrom('info@e-interview.co.za');
				$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
				$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
				$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
				$mail->send();
			}
			redirect('auth/manager');
		}
		$data['heading_title'] = $this->lang->line('create_manager_heading_title');
		$data['title'] = $this->lang->line('create_manager_heading_title');
		$data['text_create_auth'] = $this->lang->line('text_create_manager');
		$data['entry_auth_name'] = $this->lang->line('entry_auth_name');
		$data['entry_auth_email'] = $this->lang->line('entry_auth_email');
		$data['entry_auth_password'] = $this->lang->line('entry_auth_password');
		$data['entry_auth_type'] = $this->lang->line('entry_auth_type');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_remove'] = $this->lang->line('button_remove');
		$data['button_generate'] = $this->lang->line('button_generate');

		if($this->input->post('auth_name')){
			$data['auth_name'] = $this->input->post('auth_name');
		}else{
			$data['auth_name'] = '';
		}
		if($this->input->post('auth_email')){
			$data['auth_email'] = $this->input->post('auth_email');
		}else{
			$data['auth_email'] = '';
		}

		if(isset($this->error['warning'])){
			$data['warning'] = $this->error['warning'];
		}else{
			$data['warning'] = '';
		}
		if(isset($this->error['error_name'])){
			$data['error_name'] = $this->error['error_name'];
		}else{
			$data['error_name'] = '';
		}
		if(isset($this->error['error_email'])){
			$data['error_email'] = $this->error['error_email'];
		}else{
			$data['error_email'] = '';
		}

		$data['action'] = base_url().'auth/create_manager';
		$data['cancel'] = base_url().'auth/manager';
		$data['generate_password_url'] = base_url().'auth/generate_password';

		$this->app->view('create_auth',$data);
	}
	public function edit_manager($auth_id = ''){
		$data = array();
		$this->lang->load('auth');
		
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateEditForm()){
			$create = $this->auth_model->updateAuth($auth_id,$this->input->post());
			if($create){
				$subject = 'Your New Password';
				$message = "Your Password Has Changed,<br><br>";
				$message .= "New Password : <strong>". $this->input->post('auth_password') ."</strong><br>";

				$mail = new Mail();
				$mail->setTo($this->input->post('auth_email'));
				$mail->setFrom('info@e-interview.co.za');
				$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
				$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
				$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
				$mail->send();
			}
			redirect('auth/manager');
		}
		$data['heading_title'] = $this->lang->line('edit_manager_heading_title');
		$data['title'] = $this->lang->line('edit_manager_heading_title');
		$data['text_create_auth'] = $this->lang->line('text_edit_manager_auth');
		$data['entry_auth_name'] = $this->lang->line('entry_auth_name');
		$data['entry_auth_email'] = $this->lang->line('entry_auth_email');
		$data['entry_auth_password'] = $this->lang->line('entry_auth_password');
		$data['entry_auth_type'] = $this->lang->line('entry_auth_type');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_remove'] = $this->lang->line('button_remove');
		$data['button_generate'] = $this->lang->line('button_generate');

		$data['auth'] = $this->auth_model->getAuth($auth_id);

		if($this->input->post('auth_name')){
			$data['auth_name'] = $this->input->post('auth_name');
		}else if($data['auth']['name']){
			$data['auth_name'] = $data['auth']['name'];
		}else{
			$data['auth_name'] = '';
		}
		if($this->input->post('auth_email')){
			$data['auth_email'] = $this->input->post('auth_email');
		}else if($data['auth']['email']){
			$data['auth_email'] = $data['auth']['email'];
		}else{
			$data['auth_email'] = '';
		}
		if($this->input->post('auth_password')){
			$data['auth_password'] = $this->input->post('auth_password');
		}else if($data['auth']['password']){
			$data['auth_password'] = $data['auth']['password'];
		}else{
			$data['auth_password'] = '';
		}
		
		if($data['auth']['type']){
			$data['auth_type'] = $data['auth']['type'];
		}else{
			$data['auth_type'] = '';
		}

		if(isset($this->error['warning'])){
			$data['warning'] = $this->error['warning'];
		}else{
			$data['warning'] = '';
		}
		if(isset($this->error['error_name'])){
			$data['error_name'] = $this->error['error_name'];
		}else{
			$data['error_name'] = '';
		}
		if(isset($this->error['error_email'])){
			$data['error_email'] = $this->error['error_email'];
		}else{
			$data['error_email'] = '';
		}
		if(isset($this->error['error_password'])){
			$data['error_password'] = $this->error['error_password'];
		}else{
			$data['error_password'] = '';
		}

		$data['action'] = base_url().'auth/edit_manager/'.$auth_id;
		$data['cancel'] = base_url().'auth/manager';
		$data['generate_password_url'] = base_url().'auth/generate_password';

		$this->app->view('create_auth',$data);
	}
	public function remove($type = '',$auth_id = ''){
		if($this->input->server('REQUEST_METHOD') == 'GET'){
			$this->auth_model->removeAuth($auth_id);
			redirect('auth/'.$type);
		}else{
			redirect('auth/'.$type);
		}
	}
	public function removeall($type = ''){
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if($this->input->post('authremovecheck')){
				foreach ($this->input->post('authremovecheck') as $ids) {
					$this->auth_model->removeAuth($ids);
				}
			}
			redirect('auth/'.$type);
		}else{
			redirect('auth/'.$type);
		}
	}
	public function email_password(){
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
	    srand((double)microtime()*1000000);
	    $i = 0;
	    $pass = '' ;
	    while ($i <= 7) {
	        $num = rand() % 33;
	        $tmp = substr($chars, $num, 1);
	        $pass = $pass . $tmp;
	        $i++;
	    }
	    return $pass;
	}
	public function generate_password(){
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
	    srand((double)microtime()*1000000);
	    $i = 0;
	    $pass = '' ;
	    while ($i <= 7) {
	        $num = rand() % 33;
	        $tmp = substr($chars, $num, 1);
	        $pass = $pass . $tmp;
	        $i++;
	    }
	    echo $pass;
	    die;
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
		if(empty($this->input->post('auth_name'))){
			$this->error['error_name'] = $this->lang->line('error_name');
		}
		if(!filter_var($this->input->post('auth_email'), FILTER_VALIDATE_EMAIL)){
			$this->error['error_email'] = $this->lang->line('error_email');
		}

		return !$this->error;
	}
	private function validateEditForm(){
		if(empty($this->input->post('auth_name'))){
			$this->error['error_name'] = $this->lang->line('error_name');
		}
		if(!filter_var($this->input->post('auth_email'), FILTER_VALIDATE_EMAIL)){
			$this->error['error_email'] = $this->lang->line('error_email');
		}
		if(empty($this->input->post('auth_password'))){
			$this->error['error_password'] = $this->lang->line('error_password');
		}

		return !$this->error;
	}
}
