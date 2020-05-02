<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {
	private $error = array();
	function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation','mail','email'));
		$this->load->model(array('auth_model','manager_model'));
        if(!$this->checkLogin()){
        	redirect(base_url());
        }else if($this->session->userdata['user_type'] != 'CLIENT'){
        	redirect(base_url());
        }
    }
	public function index(){
		$data = array();
		$this->lang->load('manager');
		
		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_manager'] = $this->lang->line('text_manager');
		$data['text_empty'] = $this->lang->line('text_empty');
		$data['label_manager_id'] = $this->lang->line('label_manager_id');
		$data['label_manager_name'] = $this->lang->line('label_manager_name');
		$data['label_manager_email'] = $this->lang->line('label_manager_email');
		$data['label_action'] = $this->lang->line('label_action');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_edit'] = $this->lang->line('button_edit');
		$data['button_remove'] = $this->lang->line('button_remove');

		$data['action'] = base_url().'manager';
		$data['edit'] = base_url().'manager/edit';
		$data['create'] = base_url().'manager/create';
		$data['remove'] = base_url().'manager/remove';
		$data['remove_all'] = base_url().'manager/removeall';

		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$data['managers'] = $this->manager_model->getManagersBySearch($this->session->userdata['user'],$this->input->post('text_search'));
		}else{
			$data['managers'] = $this->manager_model->getManagers($this->session->userdata['user']);
		}
		$this->app->view('view_manager',$data);
	}
	public function create(){
		$data = array();
		$this->lang->load('manager');
		
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()){
			$password = $this->email_password();
			$adddata = $this->input->post();
			$adddata['client_id'] = $this->session->userdata['user'];
			$this->manager_model->addManager($adddata,$password);
			redirect('manager');
		}
		$data['title'] = $this->lang->line('text_create');
		$data['heading_title'] = $this->lang->line('text_create');
		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_email'] = $this->lang->line('entry_email');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');

		if($this->input->post('name')){
			$data['name'] = $this->input->post('name');
		}else{
			$data['name'] = '';
		}
		if($this->input->post('email')){
			$data['email'] = $this->input->post('email');
		}else{
			$data['email'] = '';
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

		$data['action'] = base_url().'manager/create';
		$data['cancel'] = base_url().'manager';

		$this->app->view('create_manager',$data);
	}
	public function edit($manager_id = ''){
		$data = array();
		$this->lang->load('manager');

		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()){
			$update = $this->manager_model->updateManager($manager_id,$this->input->post());
			redirect('manager');
		}
		$data['title'] = $this->lang->line('text_edit');
		$data['heading_title'] = $this->lang->line('text_edit');
		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_email'] = $this->lang->line('entry_email');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');

		$data['manager'] = $this->manager_model->getManager($manager_id);
		if(!$data['manager']){
			redirect('manager');
		}
		if($this->input->post('name')){
			$data['name'] = $this->input->post('name');
		}else if($data['manager']['name']){
			$data['name'] = $data['manager']['name'];
		}else{
			$data['name'] = '';
		}
		if($this->input->post('email')){
			$data['email'] = $this->input->post('email');
		}else if($data['manager']['email']){
			$data['email'] = $data['manager']['email'];
		}else{
			$data['email'] = '';
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

		$data['action'] = base_url().'manager/edit/'.$manager_id;
		$data['cancel'] = base_url().'manager';

		$this->app->view('create_manager',$data);
	}
	public function remove($manager_id = ''){
		if($this->input->server('REQUEST_METHOD') == 'GET'){
			$this->manager_model->removeManager($manager_id);
			redirect('manager');
		}else{
			redirect('manager');
		}
	}
	public function removeall(){
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if($this->input->post('removecheck')){
				foreach ($this->input->post('removecheck') as $manager_id) {
					$this->manager_model->removeManager($manager_id);
				}
			}
			redirect('manager');
		}else{
			redirect('manager');
		}
	}
	public function email_password(){
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
	    srand((double)microtime()*1000000);
	    $i = 0;
	    $pass = '' ;
	    while ($i <= 9) {
	        $num = rand() % 33;
	        $tmp = substr($chars, $num, 1);
	        $pass = $pass . $tmp;
	        $i++;
	    }
	    return $pass;
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
		if(empty($this->input->post('name'))){
			$this->error['error_name'] = $this->lang->line('error_name');
		}
		if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
			$this->error['error_email'] = $this->lang->line('error_email');			
		}else{
			if($this->uri->segments[1] == 'manager' && $this->uri->segments[2] == 'create'){
				$already = $this->manager_model->checkDuplicateEmail($this->input->post('email')); 
				if($already){
					$this->error['error_email'] = 'Email ID Already Exists!';
				}
			}else{
				$already = $this->manager_model->checkDuplicateUpdateEmail($this->input->post('email'),$this->uri->segments[3]);
				if($already){
					$this->error['error_email'] = 'Email ID Already Exists!';
				}
			}
		}
		return !$this->error;
	}
}
