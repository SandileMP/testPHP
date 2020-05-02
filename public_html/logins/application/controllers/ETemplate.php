<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ETemplate extends CI_Controller {
	private $error = array();
	private $credit;
	function __construct() {
		parent::__construct();
		$this->load->helper(array('cookie', 'date', 'form'));
		$this->load->library(array('encrypt', 'form_validation'));
		$this->load->model(array('template_model'));
		if (!$this->checkLogin()) {
			redirect(base_url());
		} else if ($this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
	}
	
	public function index($ajax = 0) {
		if ($this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
		$data = array();
		$this->lang->load('email_template');

		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_templates'] = $this->lang->line('text_templates');
		$data['text_empty'] = $this->lang->line('text_empty');
		
		$data['entry_template_id'] = $this->lang->line('entry_template_id');
		$data['entry_template_name'] = $this->lang->line('entry_template_name');
		$data['entry_interview_status'] = $this->lang->line('entry_interview_status');
		$data['entry_subject'] = $this->lang->line('entry_subject');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_edit'] = $this->lang->line('button_edit');
		$data['button_remove'] = $this->lang->line('button_remove');
		$data['button_clone'] = $this->lang->line('button_clone');
		
		$data['action'] = base_url() . 'eTemplate';
		$data['create_template'] = base_url() . 'eTemplate/create';
		$data['edit_template'] = base_url() . 'eTemplate/edit';
		$data['remove_template'] = base_url() . 'eTemplate/remove';
		$data['remove_all_template'] = base_url() . 'eTemplate/removeall';
		$data['clone_template'] = base_url() . 'eTemplate/createClone';

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$templates = $this->template_model->getTemplatesBySearch($this->session->userdata['user'], $this->input->post('text_search'));
		} else {
			$templates = $this->template_model->getTemplates($this->session->userdata['user']);
		}
		$data['templates'] = array();
		if ($templates) {
			foreach ($templates as $template) {
				$data['templates'][] = array(
					'template_id' => $template->template_id,
					'template_name' => $template->template_name,
					'subject' => $template->subject,
					'interview_status' => $template->interview_status,
				);
			}
		}
		
		if($ajax == 1){
			echo $this->load->view('get_email_templates', $data, true);

		}else{
			$this->app->view('view_email_templates', $data);
		}
	}
	
	public function create() {
		if ($this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
		$data = array('template_id' => 0);
		$this->lang->load('email_template');

		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()) {
			$adddata = $this->input->post();
			$adddata['client_id'] = $this->session->userdata['user'];
			$create = $this->template_model->addTemplates($adddata);
			redirect('eTemplate');
		}
		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_create_templates'] = $this->lang->line('text_create_templates');
		$data['text_intStatus_invitation'] = $this->lang->line('text_intStatus_invitation');
		$data['text_intStatus_rejection'] = $this->lang->line('text_intStatus_rejection');
		$data['text_intStatus_reminder'] = $this->lang->line('text_intStatus_reminder');
								
		$data['entry_template_name'] = $this->lang->line('entry_template_name');
		$data['entry_interview_status'] = $this->lang->line('entry_interview_status');
		$data['entry_subject'] = $this->lang->line('entry_subject');
		$data['entry_email_content'] = $this->lang->line('entry_email_content');

		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_remove'] = $this->lang->line('button_remove');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_update'] = $this->lang->line('button_update');


		if (isset($_POST['template_name'])) {
			$data['template_name'] = $this->input->post('template_name');
		} else {
			$data['template_name'] = '';
		}
		if (isset($_POST['interview_status'])) {
			$data['interview_status'] = $this->input->post('interview_status');
		} else {
			$data['interview_status'] = '';
		}
		if (isset($_POST['subject'])) {
			$data['subject'] = $this->input->post('subject');
		} else {
			$data['subject'] = '';
		}
		if (isset($_POST['email_content'])) {
			$data['email_content'] = $this->input->post('email_content');
		} else {
			$data['email_content'] = '';
		}


		if (isset($this->error['warning'])) {
			$data['warning'] = $this->error['warning'];
		} else {
			$data['warning'] = '';
		}
		if (isset($this->error['error_template_name'])) {
			$data['error_template_name'] = $this->error['error_template_name'];
		} else {
			$data['error_template_name'] = '';
		}
		if (isset($this->error['error_interview_status'])) {
			$data['error_interview_status'] = $this->error['error_interview_status'];
		} else {
			$data['error_interview_status'] = '';
		}
		if (isset($this->error['error_subject'])) {
			$data['error_subject'] = $this->error['error_subject'];
		} else {
			$data['error_subject'] = '';
		}
		if (isset($this->error['error_email_content'])) {
			$data['error_email_content'] = $this->error['error_email_content'];
		} else {
			$data['error_email_content'] = '';
		}

		$data['action'] = base_url() . 'eTemplate/create';
		$data['cancel'] = base_url() . 'eTemplate';

		$this->app->view('create_email_templates', $data);
	}
	
	public function edit($template_id = '') {
		if ($this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
		$data = array('template_id' => $template_id);
		$this->lang->load('email_template');

		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateForm()) {
			$this->template_model->updateTemplate($template_id, $this->input->post());
			redirect('eTemplate');
		}
		$data['template'] = $this->template_model->getTemplateDetailById($template_id);
		
		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_create_templates'] = $this->lang->line('text_edit_templates');
		$data['text_intStatus_invitation'] = $this->lang->line('text_intStatus_invitation');
		$data['text_intStatus_rejection'] = $this->lang->line('text_intStatus_rejection');
		$data['text_intStatus_reminder'] = $this->lang->line('text_intStatus_reminder');
								
		$data['entry_template_name'] = $this->lang->line('entry_template_name');
		$data['entry_interview_status'] = $this->lang->line('entry_interview_status');
		$data['entry_subject'] = $this->lang->line('entry_subject');
		$data['entry_email_content'] = $this->lang->line('entry_email_content');

		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_remove'] = $this->lang->line('button_remove');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_update'] = $this->lang->line('button_update');

		if (isset($_POST['template_name'])) {
			$data['template_name'] = $this->input->post('template_name');
		} else if ($data['template']['template_name']) {
			$data['template_name'] = $data['template']['template_name'];
		} else {
			$data['template_name'] = '';
		}
		if (isset($_POST['interview_status'])) {
			$data['interview_status'] = $this->input->post('interview_status');
		} else if ($data['template']['interview_status']) {
			$data['interview_status'] = $data['template']['interview_status'];
		} else {
			$data['interview_status'] = '';
		}
		if (isset($_POST['subject'])) {
			$data['subject'] = $this->input->post('subject');
		} else if ($data['template']['subject']) {
			$data['subject'] = $data['template']['subject'];
		} else {
			$data['subject'] = '';
		}				
		if (isset($_POST['email_content'])) {
			$data['email_content'] = $this->input->post('email_content');
		} else if ($data['template']['email_content']) {
			$data['email_content'] = $data['template']['email_content'];
		} else {
			$data['email_content'] = '';
		}		


		if (isset($this->error['warning'])) {
			$data['warning'] = $this->error['warning'];
		} else {
			$data['warning'] = '';
		}
		if (isset($this->error['error_template_name'])) {
			$data['error_template_name'] = $this->error['error_template_name'];
		} else {
			$data['error_template_name'] = '';
		}
		if (isset($this->error['error_interview_status'])) {
			$data['error_interview_status'] = $this->error['error_interview_status'];
		} else {
			$data['error_interview_status'] = '';
		}
		if (isset($this->error['error_subject'])) {
			$data['error_subject'] = $this->error['error_subject'];
		} else {
			$data['error_subject'] = '';
		}
		if (isset($this->error['error_email_content'])) {
			$data['error_email_content'] = $this->error['error_email_content'];
		} else {
			$data['error_email_content'] = '';
		}
		
		$data['action'] = base_url() . 'eTemplate/edit/' . $template_id;
		$data['cancel'] = base_url() . 'eTemplate';

		$this->app->view('create_email_templates', $data);
	}
	
	public function remove($template_id = '') {
		if ($this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$this->template_model->removeTemplate($template_id);
			redirect('eTemplate');
		} else {
			redirect('eTemplate');
		}
	}
	
	public function removeall() {
		if ($this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($this->input->post('templateremovecheck')) {
				foreach ($this->input->post('templateremovecheck') as $ids) {
					$this->template_model->removeTemplate($ids);
				}
			}
			redirect('eTemplate');
		} else {
			redirect('eTemplate');
		}
	}
	
	public function createClone($template_id = '') {
		if ($this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$this->template_model->cloneTemplate($template_id);
			redirect('eTemplate');
		} else {
			redirect('eTemplate');
		}
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
		if (empty($this->input->post('template_name'))) {
			$this->error['error_template_name'] = $this->lang->line('error_template_name');
		}
		if (empty($this->input->post('interview_status'))) {
			$this->error['error_interview_status'] = $this->lang->line('error_interview_status');
		}
		if (empty($this->input->post('subject'))) {
			$this->error['error_subject'] = $this->lang->line('error_subject');
		}
		if (empty($this->input->post('email_content'))) {
			$this->error['error_email_content'] = $this->lang->line('error_email_content');
		}		
		
		return !$this->error;
	}


}
