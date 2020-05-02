<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interview_logout extends CI_Controller {

	function __construct() {
        parent::__construct();
        if(!$this->checkLogin()){
    		redirect(base_url() . 'interview');
    	}
    }
	public function index(){
		$data = array();
		unset($this->session->userdata['interview_user']);
		redirect(base_url() .'interview');
		unset($this->session->userdata['interview_project']);
	}
	private function checkLogin(){
		if(isset($this->session->userdata['interview_user'])){
			return true;
		}else{
			return false;
		}
	}

}
