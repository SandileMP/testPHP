<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model(array('auth_model','interview_model','candidate_model'));
        if(isset($this->session->userdata['update_interview_user'])){
        	redirect(base_url() . 'update');
        }
        if($this->checkLogin()){
        	if($this->session->userdata['user_type'] === 'CANDIDATE'){
        		redirect(base_url()."candidate_dashboard");
        	}else{
        		redirect(base_url()."dashboard");
        	}
        }
    }
	public function index(){
		$data = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$email = $this->input->post('signin-email');
			$password = $this->input->post('signin-password');
			$response = $this->auth_model->checkDetail($email,$password);
			if($response){
				if($response['type'] === 'CANDIDATE'){
					$candidate_id = $response['profile_id'];
					$candidate_detail = $this->candidate_model->checkCandidateProfile($candidate_id);
					if(!$candidate_detail){
						$this->session->userdata['update_interview_user'] = $candidate_id;
						redirect(base_url() . 'update');
					}else{
						$interview_detail = $this->interview_model->checkInterviewDetail($candidate_id);
						if(!$interview_detail){
							unset($this->session->userdata['interview_user']);
							unset($this->session->userdata['update_interview_user']);
							$data['login_error'] = 'Today You Have No Interview!!';
						}else{
							$this->session->userdata['interview_user'] = $candidate_id;
							$this->session->userdata['user_type'] = $response['type'];
							$this->session->userdata['user'] = $response['auth_id'];
							redirect(base_url() . 'candidate_dashboard');
						}
					}
				}else{
					$this->session->userdata['user'] = $response['auth_id'];
					$this->session->userdata['user_type'] = $response['type'];
					redirect(base_url() . 'dashboard');
				}
			}else{
				unset($this->session->userdata['user']);
				unset($this->session->userdata['user_type']);
				$data['login_error'] = 'Your Login Email or Password Does Not Match!!';
			}
		}
		if(isset($this->session->userdata['login_error'])){
			$data['login_error'] = $this->session->userdata['login_error'];
			unset($this->session->userdata['login_error']);
		}
		$this->load->view('login',$data);
	}
	private function checkLogin(){
		if(isset($this->session->userdata['user'])){
			return true;
		}else{
			return false;
		}
	}

}
