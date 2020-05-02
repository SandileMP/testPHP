<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor extends CI_Controller {
	private $error = array();
	function __construct() {
		parent::__construct();
		$this->load->helper(array('date', 'form'));
		$this->load->library(array('mail', 'email'));
		$this->load->model(array('auth_model', 'distributor_model', 'project_model', 'interview_model', 'job_profile_model', 'candidate_model'));
		if (!$this->checkLogin()) {
			redirect(base_url());
		} else if ($this->session->userdata['user_type'] != 'ADMIN') {
			redirect(base_url());
		}
	}
	public function index() {
		$data = array();
		$this->lang->load('distributor');

		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_distributor'] = $this->lang->line('text_distributor');
		$data['text_empty'] = $this->lang->line('text_empty');
		$data['label_distributor_id'] = $this->lang->line('label_distributor_id');
		$data['label_distributor_distributor'] = $this->lang->line('label_distributor_distributor');
		$data['label_distributor_name'] = $this->lang->line('label_distributor_name');
		$data['label_distributor_email'] = $this->lang->line('label_distributor_email');
		$data['label_distributor_phone'] = $this->lang->line('label_distributor_phone');
		$data['label_distributor_address'] = $this->lang->line('label_distributor_address');
		$data['label_distributor_credit'] = $this->lang->line('label_distributor_credit');
		$data['label_action'] = $this->lang->line('label_action');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_edit'] = $this->lang->line('button_edit');
		$data['button_remove'] = $this->lang->line('button_remove');

		$data['action'] = base_url() . 'distributor';
		$data['edit'] = base_url() . 'distributor/edit';
		$data['create'] = base_url() . 'distributor/create';
		$data['remove'] = base_url() . 'distributor/remove';
		$data['remove_all'] = base_url() . 'distributor/removeall';

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$data['distributors'] = $this->distributor_model->getDistributorsBySearch($this->input->post('text_search'));
		} else {
			$data['distributors'] = $this->distributor_model->getDistributors();
		}
		$this->app->view('view_distributor', $data);
	}
	public function create() {
		$data = array();
		$this->lang->load('distributor');

		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()) {
			$password = $this->email_password();
			$this->distributor_model->addDistributor($this->input->post(), $password);
			redirect('distributor');
		}
		$data['title'] = $this->lang->line('text_create');
		$data['heading_title'] = $this->lang->line('text_create');
		$data['entry_distributor'] = $this->lang->line('entry_distributor');
		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_email'] = $this->lang->line('entry_email');
		$data['entry_phone'] = $this->lang->line('entry_phone');
		$data['entry_address'] = $this->lang->line('entry_address');
		$data['entry_credit'] = $this->lang->line('entry_credit');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');

		if ($this->input->post('distributor')) {
			$data['distributor'] = $this->input->post('distributor');
		} else {
			$data['distributor'] = '';
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
		if (isset($this->error['error_distributor'])) {
			$data['error_distributor'] = $this->error['error_distributor'];
		} else {
			$data['error_distributor'] = '';
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

		$data['action'] = base_url() . 'distributor/create';
		$data['cancel'] = base_url() . 'distributor';

		$this->app->view('create_distributor', $data);
	}
	public function edit($distributor_id = '') {
		$data = array();
		$this->lang->load('distributor');
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()) {
			$update = $this->distributor_model->updateDistributor($distributor_id, $this->input->post());
			redirect('distributor');
		}
		$data['title'] = $this->lang->line('text_edit');
		$data['heading_title'] = $this->lang->line('text_edit');
		$data['entry_distributor'] = $this->lang->line('entry_distributor');
		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_email'] = $this->lang->line('entry_email');
		$data['entry_phone'] = $this->lang->line('entry_phone');
		$data['entry_address'] = $this->lang->line('entry_address');
		$data['entry_credit'] = $this->lang->line('entry_credit');
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');

		$distributor = $this->distributor_model->getDistributor($distributor_id);
		if (!$distributor) {
			redirect('distributor');
		}

		if ($this->input->post('distributor')) {
			$data['distributor'] = $this->input->post('distributor');
		} else if ($distributor['distributor']) {
			$data['distributor'] = $distributor['distributor'];
		} else {
			$data['distributor'] = '';
		}
		if ($this->input->post('status')) {
			$data['status'] = $this->input->post('status');
		} else if ($distributor['status']) {
			$data['status'] = $distributor['status'];
		} else {
			$data['status'] = 0;
		}
		if ($this->input->post('name')) {
			$data['name'] = $this->input->post('name');
		} else if ($distributor['name']) {
			$data['name'] = $distributor['name'];
		} else {
			$data['name'] = '';
		}
		if ($this->input->post('email')) {
			$data['email'] = $this->input->post('email');
		} else if ($distributor['email']) {
			$data['email'] = $distributor['email'];
		} else {
			$data['email'] = '';
		}
		if ($this->input->post('phone')) {
			$data['phone'] = $this->input->post('phone');
		} else if ($distributor['phone']) {
			$data['phone'] = $distributor['phone'];
		} else {
			$data['phone'] = '';
		}
		if ($this->input->post('address')) {
			$data['address'] = $this->input->post('address');
		} else if ($distributor['address']) {
			$data['address'] = $distributor['address'];
		} else {
			$data['address'] = '';
		}
		if ($this->input->post('credits')) {
			$data['credits'] = $this->input->post('credits');
		} else if ($distributor['credits']) {
			$data['credits'] = $distributor['credits'];
		} else {
			$data['credits'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['warning'] = $this->error['warning'];
		} else {
			$data['warning'] = '';
		}
		if (isset($this->error['error_distributor'])) {
			$data['error_distributor'] = $this->error['error_distributor'];
		} else {
			$data['error_distributor'] = '';
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

		$data['action'] = base_url() . 'distributor/edit/' . $distributor_id;
		$data['cancel'] = base_url() . 'distributor';

		$this->app->view('create_distributor', $data);
	}
	public function remove($distributor_id = '') {
		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$this->distributor_model->removeDistributor($distributor_id);
			redirect('distributor');
		} else {
			redirect('distributor');
		}
	}
	public function removeall() {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($this->input->post('removecheck')) {
				foreach ($this->input->post('removecheck') as $distributor_id) {
					$this->distributor_model->removeDistributor($distributor_id);
				}
			}
			redirect('distributor');
		} else {
			redirect('distributor');
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
		if (empty($this->input->post('distributor'))) {
			$this->error['error_distributor'] = $this->lang->line('error_distributor');
		}
		if (empty($this->input->post('name'))) {
			$this->error['error_name'] = $this->lang->line('error_name');
		}
		if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
			$this->error['error_email'] = $this->lang->line('error_email');			
		}else{
			if($this->uri->segments[1] == 'distributor' && $this->uri->segments[2] == 'create'){
				$already = $this->distributor_model->checkDuplicateEmail($this->input->post('email')); 
				if($already){
					$this->error['error_email'] = 'Email ID Already Exists!';
				}
			}else{
				$already = $this->distributor_model->checkDuplicateUpdateEmail($this->input->post('email'),$this->uri->segments[3]);
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
