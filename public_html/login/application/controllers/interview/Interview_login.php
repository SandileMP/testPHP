<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interview_login extends CI_Controller {
	private $credit;
	private $error = array();
	function __construct() {
		parent::__construct();
		$this->load->helper(array('cookie', 'date', 'form'));
		$this->load->library(array('encrypt', 'form_validation', 'mail'));
		$this->load->model(array('interview_model', 'candidate_model', 'project_model', 'auth_model', 'credit_model', 'hr_model'));
		$this->credit = $this->credit_model->getSystemCredit();
		if ($this->checkLogin()) {
			redirect(base_url() . 'candidate_dashboard');
		}
	}
	public function register() {
		if (!isset($this->uri->segments[2])) {
			exit('Interview Project does not exists or Invalid Project!!!');
		}
		$data = array();
		$data['action'] = base_url() . 'interview/' . $this->uri->segments[2];
		$data['login'] = base_url();

		$project_detail = $this->project_model->checkProjectDetail($this->uri->segments[2]);
		if (!$project_detail) {
			exit('Interview Project does not exists or Invalid Project!!!');
		}

		// Get Project Client
		// $project_avail_detail = $this->project_model->getProjectDetail($this->uri->segments[2]);
		// $client_auth_id = $project_avail_detail['client_id'];
		// $mclient_id = $this->hr_model->getAuthHr($client_auth_id)['profile_id'];
		// $mclient = $this->hr_model->getHr($mclient_id);
		// $mclient_credit = $mclient['credits'];
		// if ($mclient_credit < $this->credit) {
		// 	//die("The Registration Is Stopped On This Project. Please Contact To Administrator.");
		// }
		// Get Client_credit

		$data['nationality'] = $this->candidate_model->getNationalityList();
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateRegisterForm()) {
			$create = $this->candidate_model->addRegisterCandidate($this->input->post());
			if ($create) {
				$profile_id = $this->candidate_model->getProfileID($create);
				$this->session->userdata['interview_user'] = $profile_id;
				$this->session->userdata['user'] = $create;
				$this->session->userdata['user_type'] = 'CANDIDATE';

				// $this->project_model->deductCredit($mclient_id);
				redirect(base_url() . 'candidate_dashboard');
			}
		}

		if ($this->input->post('firstname')) {
			$data['firstname'] = $this->input->post('firstname');
		} else {
			$data['firstname'] = '';
		}

		if ($this->input->post('lastname')) {
			$data['lastname'] = $this->input->post('lastname');
		} else {
			$data['lastname'] = '';
		}

		if ($this->input->post('email')) {
			$data['email'] = $this->input->post('email');
		} else {
			$data['email'] = '';
		}

		if ($this->input->post('id')) {
			$data['id'] = $this->input->post('id');
		} else {
			$data['id'] = '';
		}

		if ($this->input->post('dob')) {
			$data['dob'] = $this->input->post('dob');
		} else {
			$data['dob'] = '';
		}

		if ($this->input->post('age')) {
			$data['age'] = $this->input->post('age');
		} else {
			$data['age'] = '';
		}

		if ($this->input->post('phone')) {
			$data['phone'] = $this->input->post('phone');
		} else {
			$data['phone'] = '';
		}

		if (isset($this->error['profile_image'])) {
			$data['profile_image_error'] = $this->error['profile_image'];
		} else {
			$data['profile_image_error'] = '';
		}

		if (isset($this->error['firstname'])) {
			$data['firstname_error'] = $this->error['firstname'];
		} else {
			$data['firstname_error'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['lastname_error'] = $this->error['lastname'];
		} else {
			$data['lastname_error'] = '';
		}

		if (isset($this->error['email'])) {
			$data['email_error'] = $this->error['email'];
		} else {
			$data['email_error'] = '';
		}

		if (isset($this->error['id'])) {
			$data['id_error'] = $this->error['id'];
		} else {
			$data['id_error'] = '';
		}

		if (isset($this->error['dob'])) {
			$data['dob_error'] = $this->error['dob'];
		} else {
			$data['dob_error'] = '';
		}

		if (isset($this->error['age'])) {
			$data['age_error'] = $this->error['age'];
		} else {
			$data['age_error'] = '';
		}

		if (isset($this->error['phone'])) {
			$data['phone_error'] = $this->error['phone'];
		} else {
			$data['phone_error'] = '';
		}

		$this->load->view('interview/interview_signup', $data);
	}
	public function update() {
		$data = array();
		$data['action'] = base_url() . 'update';
		$data['login'] = base_url();

		$data['nationality'] = $this->candidate_model->getNationalityList();
		if (isset($this->session->userdata['update_interview_user'])) {
			$candidate_detail = $this->candidate_model->getCandidateProfile($this->session->userdata['update_interview_user']);
		} else {
			redirect(base_url());
		}

		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validateRegisterForm()) {
			$update = $this->candidate_model->updateRegisterCandidate($this->session->userdata['update_interview_user'], $this->input->post());
			if ($update) {
				$interview_detail = $this->interview_model->checkInterviewDetail($this->session->userdata['update_interview_user']);
				if (!$interview_detail) {
					unset($this->session->userdata['update_interview_user']);
					$this->session->userdata['login_error'] = 'Today You Have No Interview!!';
					redirect(base_url());
				} else {
					$this->session->userdata['interview_user'] = $this->session->userdata['update_interview_user'];
					$this->session->userdata['user'] = $this->auth_model->getAuthByCandidateID($this->session->userdata['interview_user']);
					$this->session->userdata['user_type'] = 'CANDIDATE';
					unset($this->session->userdata['update_interview_user']);
					redirect(base_url() . 'candidate_dashboard');
				}
			}
		}

		if ($this->input->post('firstname')) {
			$data['firstname'] = $this->input->post('firstname');
		} else if ($candidate_detail['firstname']) {
			$data['firstname'] = $candidate_detail['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if ($this->input->post('lastname')) {
			$data['lastname'] = $this->input->post('lastname');
		} else if ($candidate_detail['firstname']) {
			$data['lastname'] = $candidate_detail['lastname'];
		} else {
			$data['lastname'] = '';
		}

		if ($this->input->post('email')) {
			$data['email'] = $this->input->post('email');
		} else if ($candidate_detail['firstname']) {
			$data['email'] = $candidate_detail['email'];
		} else {
			$data['email'] = '';
		}

		if ($this->input->post('id')) {
			$data['id'] = $this->input->post('id');
		} else {
			$data['id'] = '';
		}

		if ($this->input->post('dob')) {
			$data['dob'] = $this->input->post('dob');
		} else {
			$data['dob'] = '';
		}

		if ($this->input->post('age')) {
			$data['age'] = $this->input->post('age');
		} else {
			$data['age'] = '';
		}

		if ($this->input->post('phone')) {
			$data['phone'] = $this->input->post('phone');
		} else {
			$data['phone'] = '';
		}

		if (isset($this->error['profile_image'])) {
			$data['profile_image_error'] = $this->error['profile_image'];
		} else {
			$data['profile_image_error'] = '';
		}

		if (isset($this->error['firstname'])) {
			$data['firstname_error'] = $this->error['firstname'];
		} else {
			$data['firstname_error'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['lastname_error'] = $this->error['lastname'];
		} else {
			$data['lastname_error'] = '';
		}

		if (isset($this->error['email'])) {
			$data['email_error'] = $this->error['email'];
		} else {
			$data['email_error'] = '';
		}

		if (isset($this->error['id'])) {
			$data['id_error'] = $this->error['id'];
		} else {
			$data['id_error'] = '';
		}

		if (isset($this->error['dob'])) {
			$data['dob_error'] = $this->error['dob'];
		} else {
			$data['dob_error'] = '';
		}

		if (isset($this->error['age'])) {
			$data['age_error'] = $this->error['age'];
		} else {
			$data['age_error'] = '';
		}

		if (isset($this->error['phone'])) {
			$data['phone_error'] = $this->error['phone'];
		} else {
			$data['phone_error'] = '';
		}

		$this->load->view('interview/interview_signup', $data);
	}
	private function validateRegisterForm() {
		if (empty($this->input->post('firstname'))) {
			$this->error['firstname'] = 'Enter Valid Firstname!!';
		}
		if (empty($this->input->post('lastname'))) {
			$this->error['lastname'] = 'Enter Valid Lastname!!';
		}
		if (empty($this->input->post('email')) && !filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = 'Enter Valid Email Address!!';
		}
		if (empty($this->input->post('id'))) {
			$this->error['id'] = 'Enter Valid ID Or Passport Number!!';
		}
		if (empty($this->input->post('dob'))) {
			$this->error['dob'] = 'Enter Valid Date Of Birth!!';
		}
		if (empty($this->input->post('age'))) {
			$this->error['age'] = 'Enter Valid Age!!';
		}
		if (empty($this->input->post('phone'))) {
			$this->error['phone'] = 'Enter Valid Phone Number!!';
		}
		return !$this->error;
	}
	private function checkLogin() {
		if (isset($this->session->userdata['interview_user'])) {
			return true;
		} else {
			return false;
		}
	}

}
