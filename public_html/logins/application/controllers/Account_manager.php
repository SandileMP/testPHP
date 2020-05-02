<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_Manager extends CI_Controller {
	private $error = array();
	function __construct() {
		parent::__construct();
		$this->load->helper(array('date', 'form'));
		$this->load->library(array('mail', 'email'));
		$this->load->model(array('auth_model', 'account_manager_model', 'project_model', 'interview_model', 'job_profile_model', 'candidate_model', 'credit_model'));
		if (!$this->checkLogin()) {
			redirect(base_url());
		} else if ($this->session->userdata['user_type'] != 'DISTRIBUTOR') {
			redirect(base_url());
		}
	}
	public function index() {
		$data = array();
		$this->lang->load('account_manager');

		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_account_manager'] = $this->lang->line('text_account_manager');
		$data['text_empty'] = $this->lang->line('text_empty');
		$data['label_account_manager_id'] = $this->lang->line('label_account_manager_id');
		$data['label_account_manager_account_manager'] = $this->lang->line('label_account_manager_account_manager');
		$data['label_account_manager_name'] = $this->lang->line('label_account_manager_name');
		$data['label_account_manager_email'] = $this->lang->line('label_account_manager_email');
		$data['label_account_manager_phone'] = $this->lang->line('label_account_manager_phone');
		$data['label_account_manager_address'] = $this->lang->line('label_account_manager_address');
		$data['label_account_manager_credit'] = $this->lang->line('label_account_manager_credit');
		$data['label_action'] = $this->lang->line('label_action');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_edit'] = $this->lang->line('button_edit');
		$data['button_remove'] = $this->lang->line('button_remove');

		$data['action'] = base_url() . 'account_manager';
		$data['edit'] = base_url() . 'account_manager/edit';
		$data['create'] = base_url() . 'account_manager/create';
		$data['remove'] = base_url() . 'account_manager/remove';
		$data['remove_all'] = base_url() . 'account_manager/removeall';

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$data['account_managers'] = $this->account_manager_model->getAccountManagersBySearch($this->session->userdata['user'],$this->input->post('text_search'));
		} else {
			$data['account_managers'] = $this->account_manager_model->getAccountManagers($this->session->userdata['user']);
		}
		$this->app->view('view_account_manager', $data);
	}
	public function create() {
		$data = array();
		$this->lang->load('account_manager');

		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()) {
			$password = $this->email_password();
			$this->account_manager_model->addAccountManager($this->input->post(), $password);
			redirect('account_manager');
		}
		$data['title'] = $this->lang->line('text_create');
		$data['heading_title'] = $this->lang->line('text_create');
		$data['entry_account_manager'] = $this->lang->line('entry_account_manager');
		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_email'] = $this->lang->line('entry_email');
		$data['entry_phone'] = $this->lang->line('entry_phone');
		$data['entry_address'] = $this->lang->line('entry_address');
		$data['entry_credit'] = $this->lang->line('entry_credit');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');

		if ($this->input->post('account_manager')) {
			$data['account_manager'] = $this->input->post('account_manager');
		} else {
			$data['account_manager'] = '';
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
		if (isset($this->error['error_account_manager'])) {
			$data['error_account_manager'] = $this->error['error_account_manager'];
		} else {
			$data['error_account_manager'] = '';
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

		$data['action'] = base_url() . 'account_manager/create';
		$data['cancel'] = base_url() . 'account_manager';

		$this->app->view('create_account_manager', $data);
	}
	public function edit($account_manager_id = '') {
		$data = array();
		$this->lang->load('account_manager');
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()) {
			$update = $this->account_manager_model->updateAccountManager($account_manager_id, $this->input->post());
			redirect('account_manager');
		}
		$data['title'] = $this->lang->line('text_edit');
		$data['heading_title'] = $this->lang->line('text_edit');
		$data['entry_account_manager'] = $this->lang->line('entry_account_manager');
		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_email'] = $this->lang->line('entry_email');
		$data['entry_phone'] = $this->lang->line('entry_phone');
		$data['entry_address'] = $this->lang->line('entry_address');
		$data['entry_credit'] = $this->lang->line('entry_credit');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');

		$account_manager = $this->account_manager_model->getAccountManager($account_manager_id);
		if (!$account_manager) {
			redirect('account_manager');
		}

		if ($this->input->post('account_manager')) {
			$data['account_manager'] = $this->input->post('account_manager');
		} else if ($account_manager['account_manager']) {
			$data['account_manager'] = $account_manager['account_manager'];
		} else {
			$data['account_manager'] = '';
		}
		if ($this->input->post('status')) {
			$data['status'] = $this->input->post('status');
		} else if ($account_manager['status']) {
			$data['status'] = $account_manager['status'];
		} else {
			$data['status'] = 0;
		}
		if ($this->input->post('name')) {
			$data['name'] = $this->input->post('name');
		} else if ($account_manager['name']) {
			$data['name'] = $account_manager['name'];
		} else {
			$data['name'] = '';
		}
		if ($this->input->post('email')) {
			$data['email'] = $this->input->post('email');
		} else if ($account_manager['email']) {
			$data['email'] = $account_manager['email'];
		} else {
			$data['email'] = '';
		}
		if ($this->input->post('phone')) {
			$data['phone'] = $this->input->post('phone');
		} else if ($account_manager['phone']) {
			$data['phone'] = $account_manager['phone'];
		} else {
			$data['phone'] = '';
		}
		if ($this->input->post('address')) {
			$data['address'] = $this->input->post('address');
		} else if ($account_manager['address']) {
			$data['address'] = $account_manager['address'];
		} else {
			$data['address'] = '';
		}
		if ($this->input->post('credits')) {
			$data['credits'] = $this->input->post('credits');
		} else if ($account_manager['credits']) {
			$data['credits'] = $account_manager['credits'];
		} else {
			$data['credits'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['warning'] = $this->error['warning'];
		} else {
			$data['warning'] = '';
		}
		if (isset($this->error['error_account_manager'])) {
			$data['error_account_manager'] = $this->error['error_account_manager'];
		} else {
			$data['error_account_manager'] = '';
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

		$data['action'] = base_url() . 'account_manager/edit/' . $account_manager_id;
		$data['cancel'] = base_url() . 'account_manager';

		$this->app->view('create_account_manager', $data);
	}
	public function remove($account_manager_id = '') {
		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$this->account_manager_model->removeAccountManager($account_manager_id);
			redirect('account_manager');
		} else {
			redirect('account_manager');
		}
	}
	public function removeall() {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($this->input->post('removecheck')) {
				foreach ($this->input->post('removecheck') as $account_manager_id) {
					$this->account_manager_model->removeAccountManager($account_manager_id);
				}
			}
			redirect('account_manager');
		} else {
			redirect('account_manager');
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
		if (empty($this->input->post('account_manager'))) {
			$this->error['error_account_manager'] = $this->lang->line('error_account_manager');
		}
		if (empty($this->input->post('name'))) {
			$this->error['error_name'] = $this->lang->line('error_name');
		}
		if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
			$this->error['error_email'] = $this->lang->line('error_email');			
		}else{
			if($this->uri->segments[1] == 'account_manager' && $this->uri->segments[2] == 'create'){
				$already = $this->account_manager_model->checkDuplicateEmail($this->input->post('email')); 
				if($already){
					$this->error['error_email'] = 'Email ID Already Exists!';
				}
			}else{
				$already = $this->account_manager_model->checkDuplicateUpdateEmail($this->input->post('email'),$this->uri->segments[3]);
				if($already){
					$this->error['error_email'] = 'Email ID Already Exists!';
				}
			}
		}
		if($this->uri->segments[1] == 'account_manager' && $this->uri->segments[2] == 'create'){
			$profile_id = $this->session->userdata['profile_id'];
			$remain_credit = $this->credit_model->getDistributorAvailableCredit($profile_id);
			if (!is_numeric($this->input->post('credits')) || ($this->input->post('credits') < 0)) {
				$this->error['error_credit'] = $this->lang->line('error_credit');	
			}
			if($remain_credit < $this->input->post('credits')){
				$this->error['error_credit'] = $this->lang->line('error_credit_notenough');	
			}
		}
		if (empty($this->input->post('phone'))) {
			$this->error['error_phone'] = $this->lang->line('error_phone');
		}
		if (empty($this->input->post('address'))) {
			$this->error['error_address'] = $this->lang->line('error_address');
		}
		return !$this->error;
	}
}
