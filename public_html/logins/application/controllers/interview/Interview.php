<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interview extends CI_Controller {
	private $error = array();
	function __construct() {
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model(array('auth_model','interview_model','candidate_model'));
    	if(!$this->checkLogin()){
    		redirect(base_url());
    	}
    }
    public function index(){
    	$candidate_id = $this->session->userdata['interview_user'];
    	//$project_code = $this->session->userdata['interview_project'];
		$interview_status = $this->interview_model->checkInterviewStatus($candidate_id);
		if($interview_status == 'cancel'){
			redirect(base_url().'cancelled');
		}else if($interview_status == 'complete'){
			redirect(base_url().'complete');
		}
		$data = array();
		$this->lang->load('user_interview');
		
		$candidate_details = $this->candidate_model->getCandidateDetails($candidate_id);
		
		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_logout'] = $this->lang->line('text_interview_logout');
		$data['text_project_title'] = $this->lang->line('text_project_title');
		$data['text_project_role_title'] = $this->lang->line('text_project_role_title');
		$data['text_interview_question'] = $this->lang->line('text_interview_question');
		$data['text_interview_question_expire'] = $this->lang->line('text_interview_question_expire');
		$data['text_valid_from'] = $this->lang->line('text_valid_from');
		$data['text_valid_to'] = $this->lang->line('text_valid_to');
		$data['text_note'] = $this->lang->line('text_note');
		$data['text_start_interview_heading1'] = $this->lang->line('text_start_interview_heading1').$candidate_details->name;
		$data['text_start_interview_description'] = $this->lang->line('text_start_interview_description');

		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_start_recording'] = $this->lang->line('button_start_recording');
		$data['button_test_interview'] = $this->lang->line('button_test_interview');
		$data['button_invited'] = $this->lang->line('button_invited');

		$data['action'] = base_url().'access';

		$data['interview_detail'] = $this->interview_model->getInterviewDetails($this->session->userdata['interview_user']);
		$this->app_interview->view('interview/interview_dashboard',$data);
	}

	public function test(){
		
		$this->User_activity_model->addActivityMessage('Start test');

		$candidate_id = $this->session->userdata['interview_user'];
		$data = array();
		$this->lang->load('user_interview');

		$interview_detail = $this->interview_model->getInterviewDetails($candidate_id);
		$data['interview_detail'] = array(
			'invite_id'		=>	$interview_detail['invite_id'],
			'note'			=>	$interview_detail['note'],
			'title'			=>	$interview_detail['title'],
			'role_title'	=>	$interview_detail['role_title'],
			'questions'		=>	json_decode($interview_detail['question_list']),
			'project_type'	=>	$interview_detail['project_type'],
			'start_date'	=>	$interview_detail['start_date'],
			'end_date'		=>	$interview_detail['end_date'],
		);

		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_logout'] = $this->lang->line('text_interview_logout');
		$data['text_project_title'] = $this->lang->line('text_project_title');
		$data['text_project_role_title'] = $this->lang->line('text_project_role_title');
		$data['text_interview_question'] = $this->lang->line('text_interview_question');
		$data['text_interview_question_expire'] = $this->lang->line('text_interview_question_expire');
		$data['text_note'] = $this->lang->line('text_note');

		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_start_recording'] = $this->lang->line('button_start_recording');
		$data['button_invited'] = $this->lang->line('button_invited');
		$data['button_back'] = $this->lang->line('button_back');
		$data['back_interview'] = base_url() . 'candidate_dashboard';
		$data['submit_interview_url'] = base_url() . 'complete';
		$data['do_interview'] = base_url() . 'candidate_interview';
		
		$this->app_interview->view('interview/interview_test',$data);
	}
	public function practice(){
		$candidate_id = $this->session->userdata['interview_user'];
		$data = array();
		$this->lang->load('user_interview');

		$data['heading_title'] = $this->lang->line('practice_heading_title');
		$data['title'] = $this->lang->line('heading_title');

		$data['button_start_recording'] = "Next";
		
		$this->app->view('interview/interview_practice',$data);
	}
	public function practice_access(){

		$this->User_activity_model->addActivityMessage('Start Practice');

		$candidate_id = $this->session->userdata['interview_user'];

		$data = array();
		$this->lang->load('user_interview');

		$interview_detail = $this->interview_model->getInterviewDetails($candidate_id);
		$data['interview_detail']['questions'] = array(
			array(
				'question'		=>	'What is your favourite colour and why?',
				'expire'		=>	30,
			),
			array(
				'question'		=>	'If you can be the president of any country, which country will it be and what is the first law you will implement?',
				'expire'		=>	30,
			)
		);

		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_logout'] = $this->lang->line('text_interview_logout');
		$data['text_project_title'] = $this->lang->line('text_project_title');
		$data['text_project_role_title'] = $this->lang->line('text_project_role_title');
		$data['text_interview_question'] = $this->lang->line('text_interview_question');
		$data['text_interview_answer_start'] = $this->lang->line('text_interview_answer_start');
		$data['text_interview_question_expire'] = $this->lang->line('text_interview_question_expire');
		$data['text_note'] = $this->lang->line('text_note');
		$data['text_start_interview_heading2'] = $this->lang->line('text_start_interview_heading2');
		$data['text_start_interview_instructions'] = $this->lang->line('text_start_interview_instructions');
		$data['text_start_interview'] = $this->lang->line('text_start_interview');
		$data['text_interview_progress_text'] = $this->lang->line('text_interview_progress_text');

		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_next'] = $this->lang->line('button_next');
		$data['button_view_new_tab'] = $this->lang->line('button_view_new_tab');
		$data['button_re_test'] = $this->lang->line('button_re_test');
		$data['button_go_to_interview'] = $this->lang->line('button_go_to_interview');
		$data['back_interview'] = base_url() . 'practice';

		$this->app_interview->view('interview/interview_practice_access',$data);
	}
	public function access(){
		$this->User_activity_model->addActivityMessage('Start Interview');

		$candidate_id = $this->session->userdata['interview_user'];
		$this->db->query("UPDATE `tbl_invite_interview` SET `start_status` = '0', `end_status` = '0' WHERE `tbl_invite_interview`.`candidate_id`=".$candidate_id);
		//$project_code = $this->session->userdata['interview_project'];
		$interview_status = $this->interview_model->checkInterviewStatus($candidate_id);
		if($interview_status == 'cancel'){
			redirect(base_url().'cancelled');
		}else if($interview_status == 'complete'){
			redirect(base_url().'complete');
		}
		$data = array();
		$this->lang->load('user_interview');

		$interview_detail = $this->interview_model->getInterviewDetails($candidate_id);
		$this->interview_model->setInterviewStartStatus($candidate_id);
		$data['interview_detail'] = array(
			'invite_id'		=>	$interview_detail['invite_id'],
			'note'			=>	$interview_detail['note'],
			'title'			=>	$interview_detail['title'],
			'role_title'	=>	$interview_detail['role_title'],
			'questions'		=>	json_decode($interview_detail['question_list']),
			'project_type'	=>	$interview_detail['project_type'],
			'start_date'	=>	$interview_detail['start_date'],
			'end_date'		=>	$interview_detail['end_date'],
		);

		// start with first question
		$pquestion = json_decode($interview_detail['question_list'],true);

		$fq = isset($pquestion[0]) ? $pquestion[0] : null;
		if($fq){
			$message = $fq['question'];
			$message = 'Start : '.$message;
			$start_time = date("Y-m-d H:i:s", strtotime('+15 seconds'));
			$this->User_activity_model->addActivity(['activity_message' => $message,'created_at' => $start_time]);
		}

		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_logout'] = $this->lang->line('text_interview_logout');
		$data['text_project_title'] = $this->lang->line('text_project_title');
		$data['text_project_role_title'] = $this->lang->line('text_project_role_title');
		$data['text_interview_question'] = $this->lang->line('text_interview_question');
		$data['text_interview_answer_start'] = $this->lang->line('text_interview_answer_start');
		$data['text_interview_question_expire'] = $this->lang->line('text_interview_question_expire');
		$data['text_note'] = $this->lang->line('text_note');
		$data['text_start_interview_heading2'] = $this->lang->line('text_start_interview_heading2');
		$data['text_start_interview_instructions'] = $this->lang->line('text_start_interview_instructions');
		$data['text_start_interview'] = $this->lang->line('text_start_interview');
		$data['text_interview_progress_text'] = $this->lang->line('text_interview_progress_text');

		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_start_recording'] = $this->lang->line('button_start_recording');
		$data['button_invited'] = $this->lang->line('button_invited');
		$data['button_next'] = $this->lang->line('button_next');
		$data['button_skip'] = $this->lang->line('button_skip');
		$data['submit_interview_url'] = base_url() . 'complete';
		
		$this->app_interview->view('interview/interview_access',$data);
	}
	public function complete(){
		$candidate_id = $this->session->userdata['interview_user'];
		//$project_code = $this->session->userdata['interview_project'];
		$interview_status = $this->interview_model->checkInterviewStatus($candidate_id);
		if($interview_status != 'complete'){
			redirect(base_url());
		}
		$data = array();
		$this->lang->load('user_interview');
		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_project_title'] = $this->lang->line('text_project_title');
		$data['text_project_role_title'] = $this->lang->line('text_project_role_title');
		$data['text_interview_question'] = $this->lang->line('text_interview_question');
		$data['text_interview_question_expire'] = $this->lang->line('text_interview_question_expire');
		$data['status_text'] = 'Your interview has been successfully uploaded.';
		$data['button_download_interview'] = $this->lang->line('button_download_interview');

		$data['interview_detail'] = $this->interview_model->getInterviewCompleteDetails($candidate_id);
		$data['status_img'] = base_url().'assets/img/icon/complete.png';

		$this->app_interview->view('interview/interview_complete',$data);
	}
	public function cancelled(){
		$candidate_id = $this->session->userdata['interview_user'];
		//$project_code = $this->session->userdata['interview_project'];
		$interview_status = $this->interview_model->checkInterviewStatus($candidate_id);
		if($interview_status != 'cancel'){
			redirect(base_url().'interview');
		}
		$data = array();
		$this->lang->load('user_interview');
		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_project_title'] = $this->lang->line('text_project_title');
		$data['text_project_role_title'] = $this->lang->line('text_project_role_title');
		$data['text_interview_question'] = $this->lang->line('text_interview_question');
		$data['text_interview_question_expire'] = $this->lang->line('text_interview_question_expire');
		$data['status_text'] = 'Your interview has been blocked. Please contact the client administrator who invited you to
								do the e-interview for more information.';

		$data['status_img'] = base_url().'assets/img/icon/cancel.png';
		$data['interview_detail'] = $this->interview_model->getInterviewDetails($this->session->userdata['interview_user']);

		$this->app_interview->view('interview/interview_cancel',$data);
	}
	private function checkLogin(){
		if(isset($this->session->userdata['interview_user'])){
			return true;
		}else{
			return false;
		}
	}
}
