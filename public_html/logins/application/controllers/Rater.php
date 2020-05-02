<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rater extends CI_Controller {
	private $error = array();
	function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation','mail','email'));
		$this->load->model(array('auth_model','manager_model','rater_model'));
        if(!$this->checkLogin()){
        	redirect(base_url());
        }else if($this->session->userdata['user_type'] != 'MANAGER'){
        	redirect(base_url());
        }
    }
	public function index(){
		$data = array();
		$this->lang->load('rater');
		
		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_rater'] = $this->lang->line('text_rater');
		$data['text_empty'] = $this->lang->line('text_empty');
		$data['label_rater_id'] = $this->lang->line('label_rater_id');
		$data['label_rater_name'] = $this->lang->line('label_rater_name');
		$data['label_rater_email'] = $this->lang->line('label_rater_email');
		$data['label_rater_status'] = $this->lang->line('label_rater_status');
		$data['label_action'] = $this->lang->line('label_action');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_edit'] = $this->lang->line('button_edit');
		$data['button_remove'] = $this->lang->line('button_remove');

		$data['action'] = base_url().'rater';
		$data['edit'] = base_url().'rater/edit';
		$data['create'] = base_url().'rater/create';
		$data['remove'] = base_url().'rater/remove';
		$data['remove_all'] = base_url().'rater/removeall';

		$account_manager_id = $this->manager_model->getAccountManagerByManager($this->session->userdata['user']);
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$data['raters'] = $this->rater_model->getRatersBySearch($account_manager_id,$this->input->post('text_search'));
		}else{
			$data['raters'] = $this->rater_model->getRaters($account_manager_id);
		}
		$this->app->view('view_rater',$data);
	}
	public function create(){
		$data = array();
		$this->lang->load('rater');
		
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()){
			$password = $this->email_password();
			$adddata = $this->input->post();
			$adddata['manager_id'] = $this->session->userdata['user'];
			$adddata['account_manager_id'] = $this->manager_model->getAccountManagerByManager($this->session->userdata['user']);
			$this->rater_model->addRater($adddata,$password);
			redirect('rater');
		}
		$data['title'] = $this->lang->line('text_create');
		$data['heading_title'] = $this->lang->line('text_create');
		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_email'] = $this->lang->line('entry_email');
		$data['entry_status'] = $this->lang->line('entry_status');
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
		if($this->input->post('status')){
			$data['status'] = $this->input->post('status');
		}else{
			$data['status'] = 0;
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

		$data['action'] = base_url().'rater/create';
		$data['cancel'] = base_url().'rater';

		$this->app->view('create_rater',$data);
	}
	public function edit($rater_id = ''){
		$data = array();
		$this->lang->load('rater');

		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()){
			$update = $this->rater_model->updateRater($rater_id,$this->input->post());
			redirect('rater');
		}
		$data['title'] = $this->lang->line('text_edit');
		$data['heading_title'] = $this->lang->line('text_edit');
		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_email'] = $this->lang->line('entry_email');
		$data['entry_status'] = $this->lang->line('entry_status');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');

		$data['rater'] = $this->rater_model->getRater($rater_id);
		if(!$data['rater']){
			redirect('rater');
		}
		if($this->input->post('name')){
			$data['name'] = $this->input->post('name');
		}else if($data['rater']['name']){
			$data['name'] = $data['rater']['name'];
		}else{
			$data['name'] = '';
		}
		if($this->input->post('email')){
			$data['email'] = $this->input->post('email');
		}else if($data['rater']['email']){
			$data['email'] = $data['rater']['email'];
		}else{
			$data['email'] = '';
		}
		if($this->input->post('status')){
			$data['status'] = $this->input->post('status');
		}else if($data['rater']['status']){
			$data['status'] = $data['rater']['status'];
		}else{
			$data['status'] = 0;
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

		$data['action'] = base_url().'rater/edit/'.$rater_id;
		$data['cancel'] = base_url().'rater';

		$this->app->view('create_rater',$data);
	}
	public function remove($rater_id = ''){
		if($this->input->server('REQUEST_METHOD') == 'GET'){
			$this->rater_model->removeRater($rater_id);
			redirect('rater');
		}else{
			redirect('rater');
		}
	}
	public function removeall(){
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if($this->input->post('removecheck')){
				foreach ($this->input->post('removecheck') as $rater_id) {
					$this->rater_model->removeRater($rater_id);
				}
			}
			redirect('rater');
		}else{
			redirect('rater');
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
			if($this->uri->segments[1] == 'rater' && $this->uri->segments[2] == 'create'){
				$already = $this->rater_model->checkDuplicateEmail($this->input->post('email')); 
				if($already){
					$this->error['error_email'] = 'Email ID Already Exists!';
				}
			}else{
				$already = $this->rater_model->checkDuplicateUpdateEmail($this->input->post('email'),$this->uri->segments[3]);
				if($already){
					$this->error['error_email'] = 'Email ID Already Exists!';
				}
			}
		}
		return !$this->error;
	}
}
