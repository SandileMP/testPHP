<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('cookie', 'date', 'form'));
		$this->load->library(array('encrypt', 'form_validation', 'mail'));
		$this->load->model(array('auth_model', 'interview_model', 'candidate_model'));
		if (isset($this->session->userdata['update_interview_user'])) {
			redirect(base_url() . 'update');
		}
		if ($this->checkLogin()) {
			if ($this->session->userdata['user_type'] === 'CANDIDATE') {
				redirect(base_url() . "candidate_dashboard");
			} else {
				redirect(base_url() . "dashboard");
			}
		}
	}
	public function index() {
		$data = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$email = $this->input->post('signin-email');
			$password = $this->input->post('signin-password');
			$response = $this->auth_model->checkDetail($email, $password);
			if ($response) {
				if ($response['type'] === 'CANDIDATE') {
					$candidate_id = $response['profile_id'];
					$candidate_detail = $this->candidate_model->checkCandidateProfile($candidate_id);
					if (!$candidate_detail) {
						$this->session->userdata['update_interview_user'] = $candidate_id;
						redirect(base_url() . 'update');
					} else {
						$interview_detail = $this->interview_model->checkInterviewDetail($candidate_id);
						if (!$interview_detail) {
							unset($this->session->userdata['interview_user']);
							unset($this->session->userdata['update_interview_user']);
							$data['login_error'] = 'Today You Have No Interview!!';
						} else {
							$this->session->userdata['interview_user'] = $candidate_id;
							$this->session->userdata['user_type'] = $response['type'];
							$this->session->userdata['user'] = $response['auth_id'];
							redirect(base_url() . 'candidate_dashboard');
						}
					}
				} else {
					$roleList = $this->auth_model->getRoleList($response['email']);

					$this->session->userdata['user'] = $response['auth_id'];
					$this->session->userdata['user_type'] = $response['type'];
					$this->session->userdata['profile_id'] = $response['profile_id'];

					if($roleList && !empty($roleList)){
						$this->session->userdata['switch_role'] = $roleList;
					}
					redirect(base_url() . 'dashboard');
				}
			} else {
				unset($this->session->userdata['user']);
				unset($this->session->userdata['user_type']);
				unset($this->session->userdata['profile_id']);
				$data['login_error'] = 'Your Login Email or Password Does Not Match!!';
			}
		}
		if (isset($this->session->userdata['login_error'])) {
			$data['login_error'] = $this->session->userdata['login_error'];
			unset($this->session->userdata['login_error']);
		}
		$data['forgot_action'] = base_url('forgot_password');
		$this->load->view('login', $data);
	}

	public function forgot_password() {
		$data = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$email = $this->input->post('forgot-email');
			$account = $this->input->post('forgot-account');
			if (!empty($email)) {
				$response = $this->auth_model->checkForgotEmailDetail($email, $account);

				if (!$response) {
					$data['error'] = 'Email Address not Registered!';
				} else {
					$send_mail = false;
					foreach ($response as $auth) {
						if ($auth['type'] != 'CANDIDATE' && $send_mail == false)  {

							$auth['password'] = $this->auth_model->getAndSetPassword($email);

							if($auth['password']) {
								$subject = 'Forgot Password';
								$message = "Your e-interview Account Password :" . "<br>";

								$message .= "<b>" . base64_decode($auth['password']) . "</b>";

								$mail = new Mail();
								$mail->setTo($auth['email']);
								$mail->setFrom('info@e-interview.co.za');
								$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
								$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
								$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
								$mail->send();
								$send_mail = true;
							}
						}
					}
					if ($send_mail) {
						$data['success'] = 'Password Sent To Your Email Address Successfully.';
					} else {
						$data['error'] = 'You Have no Permission For Forgot Password!';
					}
				}
			} else {
				$data['error'] = 'Please Enter Valid Email Address!';
			}
		}
		echo json_encode($data);
		die;
	}
	private function checkLogin() {
		if (isset($this->session->userdata['user'])) {
			return true;
		} else {
			return false;
		}
	}

}
