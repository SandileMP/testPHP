<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	public function index(){
		$data = array();
		unset($this->session->userdata['update_interview_user']);
		unset($this->session->userdata['interview_project']);
		unset($this->session->userdata['interview_user']);
		unset($this->session->userdata['user']);
		unset($this->session->userdata['user_type']);
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
