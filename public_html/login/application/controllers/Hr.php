<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr extends CI_Controller {
	private $error = array();
	function __construct() {
		parent::__construct();
		$this->load->helper(array('date', 'form'));
		$this->load->library(array('mail', 'email'));
		$this->load->model(array('auth_model', 'hr_model', 'project_model', 'interview_model', 'job_profile_model', 'candidate_model'));
		if (!$this->checkLogin()) {
			redirect(base_url());
		} else if ($this->session->userdata['user_type'] != 'ADMIN') {
			redirect(base_url());
		}
	}
	public function index() {
		$data = array();
		$this->lang->load('hr');

		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_hr'] = $this->lang->line('text_hr');
		$data['text_empty'] = $this->lang->line('text_empty');
		$data['label_hr_id'] = $this->lang->line('label_hr_id');
		$data['label_hr_client'] = $this->lang->line('label_hr_client');
		$data['label_hr_name'] = $this->lang->line('label_hr_name');
		$data['label_hr_email'] = $this->lang->line('label_hr_email');
		$data['label_hr_phone'] = $this->lang->line('label_hr_phone');
		$data['label_hr_address'] = $this->lang->line('label_hr_address');
		$data['label_hr_credit'] = $this->lang->line('label_hr_credit');
		$data['label_action'] = $this->lang->line('label_action');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_edit'] = $this->lang->line('button_edit');
		$data['button_remove'] = $this->lang->line('button_remove');

		$data['action'] = base_url() . 'hr';
		$data['edit'] = base_url() . 'hr/edit';
		$data['create'] = base_url() . 'hr/create';
		$data['remove'] = base_url() . 'hr/remove';
		$data['remove_all'] = base_url() . 'hr/removeall';

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$data['hrs'] = $this->hr_model->getHrsBySearch($this->input->post('text_search'));
		} else {
			$data['hrs'] = $this->hr_model->getHrs();
		}
		$this->app->view('view_hr', $data);
	}
	public function create() {
		$data = array();
		$this->lang->load('hr');

		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()) {
			$password = $this->email_password();
			$this->hr_model->addHr($this->input->post(), $password);
			redirect('hr');
		}
		$data['title'] = $this->lang->line('text_create');
		$data['heading_title'] = $this->lang->line('text_create');
		$data['entry_client'] = $this->lang->line('entry_client');
		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_email'] = $this->lang->line('entry_email');
		$data['entry_phone'] = $this->lang->line('entry_phone');
		$data['entry_address'] = $this->lang->line('entry_address');
		$data['entry_credit'] = $this->lang->line('entry_credit');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');

		if ($this->input->post('client')) {
			$data['client'] = $this->input->post('client');
		} else {
			$data['client'] = '';
		}
		if ($this->input->post('status')) {
			$data['status'] = $this->input->post('status');
		} else {
			$data['status'] = '';
		}
		if ($this->input->post('name')) {
			$data['name'] = $this->input->post('name');
		} else {
			$data['name'] = '';
		}
		if ($this->input->post('email')) {
			$data['email'] = $this->input->post('email');
		} else {
			$data['email'] = '';
		}
		if ($this->input->post('phone')) {
			$data['phone'] = $this->input->post('phone');
		} else {
			$data['phone'] = '';
		}
		if ($this->input->post('address')) {
			$data['address'] = $this->input->post('address');
		} else {
			$data['address'] = '';
		}

		if ($this->input->post('credits')) {
			$data['credits'] = $this->input->post('credits');
		} else {
			$data['credits'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['warning'] = $this->error['warning'];
		} else {
			$data['warning'] = '';
		}
		if (isset($this->error['error_client'])) {
			$data['error_client'] = $this->error['error_client'];
		} else {
			$data['error_client'] = '';
		}
		if (isset($this->error['error_name'])) {
			$data['error_name'] = $this->error['error_name'];
		} else {
			$data['error_name'] = '';
		}
		if (isset($this->error['error_email'])) {
			$data['error_email'] = $this->error['error_email'];
		} else {
			$data['error_email'] = '';
		}
		if (isset($this->error['error_phone'])) {
			$data['error_phone'] = $this->error['error_phone'];
		} else {
			$data['error_phone'] = '';
		}
		if (isset($this->error['error_address'])) {
			$data['error_address'] = $this->error['error_address'];
		} else {
			$data['error_address'] = '';
		}

		if (isset($this->error['error_credit'])) {
			$data['error_credit'] = $this->error['error_credit'];
		} else {
			$data['error_credit'] = '';
		}

		$data['action'] = base_url() . 'hr/create';
		$data['cancel'] = base_url() . 'hr';

		$this->app->view('create_hr', $data);
	}
	public function edit($hr_id = '') {
		$data = array();
		$this->lang->load('hr');
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()) {
			$update = $this->hr_model->updateHr($hr_id, $this->input->post());
			redirect('hr');
		}
		$data['title'] = $this->lang->line('text_edit');
		$data['heading_title'] = $this->lang->line('text_edit');
		$data['entry_client'] = $this->lang->line('entry_client');
		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_email'] = $this->lang->line('entry_email');
		$data['entry_phone'] = $this->lang->line('entry_phone');
		$data['entry_address'] = $this->lang->line('entry_address');
		$data['entry_credit'] = $this->lang->line('entry_credit');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');

		$data['hr'] = $this->hr_model->getHr($hr_id);
		if (!$data['hr']) {
			redirect('hr');
		}
		if ($this->input->post('client')) {
			$data['client'] = $this->input->post('client');
		} else if ($data['hr']['client']) {
			$data['client'] = $data['hr']['client'];
		} else {
			$data['client'] = '';
		}

		if ($this->input->post('status')) {
			$data['status'] = $this->input->post('status');
		} else if ($data['hr']['status']) {
			$data['status'] = $data['hr']['status'];
		} else {
			$data['status'] = 0;
		}
		if ($this->input->post('name')) {
			$data['name'] = $this->input->post('name');
		} else if ($data['hr']['name']) {
			$data['name'] = $data['hr']['name'];
		} else {
			$data['name'] = '';
		}
		if ($this->input->post('email')) {
			$data['email'] = $this->input->post('email');
		} else if ($data['hr']['email']) {
			$data['email'] = $data['hr']['email'];
		} else {
			$data['email'] = '';
		}
		if ($this->input->post('phone')) {
			$data['phone'] = $this->input->post('phone');
		} else if ($data['hr']['phone']) {
			$data['phone'] = $data['hr']['phone'];
		} else {
			$data['phone'] = '';
		}
		if ($this->input->post('address')) {
			$data['address'] = $this->input->post('address');
		} else if ($data['hr']['address']) {
			$data['address'] = $data['hr']['address'];
		} else {
			$data['address'] = '';
		}

		if ($this->input->post('credits')) {
			$data['credits'] = $this->input->post('credits');
		} else if ($data['hr']['credits']) {
			$data['credits'] = $data['hr']['credits'];
		} else {
			$data['credits'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['warning'] = $this->error['warning'];
		} else {
			$data['warning'] = '';
		}
		if (isset($this->error['error_client'])) {
			$data['error_client'] = $this->error['error_client'];
		} else {
			$data['error_client'] = '';
		}
		if (isset($this->error['error_name'])) {
			$data['error_name'] = $this->error['error_name'];
		} else {
			$data['error_name'] = '';
		}
		if (isset($this->error['error_email'])) {
			$data['error_email'] = $this->error['error_email'];
		} else {
			$data['error_email'] = '';
		}
		if (isset($this->error['error_phone'])) {
			$data['error_phone'] = $this->error['error_phone'];
		} else {
			$data['error_phone'] = '';
		}
		if (isset($this->error['error_address'])) {
			$data['error_address'] = $this->error['error_address'];
		} else {
			$data['error_address'] = '';
		}
		if (isset($this->error['error_credit'])) {
			$data['error_credit'] = $this->error['error_credit'];
		} else {
			$data['error_credit'] = '';
		}

		$data['action'] = base_url() . 'hr/edit/' . $hr_id;
		$data['cancel'] = base_url() . 'hr';

		$this->app->view('create_hr', $data);
	}
	public function remove($hr_id = '') {
		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$this->hr_model->removeHr($hr_id);
			redirect('hr');
		} else {
			redirect('hr');
		}
	}
	public function removeall() {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($this->input->post('removecheck')) {
				foreach ($this->input->post('removecheck') as $hr_id) {
					$this->hr_model->removeHr($hr_id);
				}
			}
			redirect('hr');
		} else {
			redirect('hr');
		}
	}
	public function email_password() {
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double) microtime() * 1000000);
		$i = 0;
		$pass = '';
		while ($i <= 9) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}
	private function checkLogin() {
		if (isset($this->session->userdata['user'])) {
			return true;
		} else {
			return false;
		}
	}
	private function userLogin() {
		if ($this->checkLogin()) {
			$user = $this->session->userdata['user'];
			return $user;
		}
	}
	private function validateForm() {
		if (empty($this->input->post('client'))) {
			$this->error['error_client'] = $this->lang->line('error_client');
		}
		if (empty($this->input->post('name'))) {
			$this->error['error_name'] = $this->lang->line('error_name');
		}
		if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
			$this->error['error_email'] = $this->lang->line('error_email');			
		}else{
			if($this->uri->segments[1] == 'hr' && $this->uri->segments[2] == 'create'){
				$already = $this->hr_model->checkDuplicateEmail($this->input->post('email')); 
				if($already){
					$this->error['error_email'] = 'Email ID Already Exists!';
				}
			}else{
				$already = $this->hr_model->checkDuplicateUpdateEmail($this->input->post('email'),$this->uri->segments[3]);
				if($already){
					$this->error['error_email'] = 'Email ID Already Exists!';
				}
			}
		}
		if (empty($this->input->post('phone'))) {
			$this->error['error_phone'] = $this->lang->line('error_phone');
		}
		if (empty($this->input->post('address'))) {
			$this->error['error_address'] = $this->lang->line('error_address');
		}
		if (!is_numeric($this->input->post('credits')) || ($this->input->post('credits') < 0)) {
			$this->error['error_credit'] = $this->lang->line('error_credit');
		}
		return !$this->error;
	}
}
