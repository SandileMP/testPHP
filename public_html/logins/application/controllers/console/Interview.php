<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interview extends CI_Controller 
{
	function __construct() 
	{		
		parent::__construct();

		$this->load->model(array('job_profile_model', 'project_model', 'account_manager_model', 'manager_model', 'candidate_model', 'auth_model', 'interview_model', 'rater_model', 'credit_model', 'template_model'));
	}

	public function index()
	{
		echo "Working ok select function to call";
		exit;
	}
	
	/**
	 * get list of new interview
	 *
	 * @return void
	 */
	public function getNew()
	{
		$interview = null;
		$interviews = $this->interview_model->getInterviewForProcess();
		if(isset($interviews[0]) && !empty($interviews[0]))
		{
			$interview['interview_id'] = $interviews[0]['interview_id'];
			$interview['invite_id'] = $interviews[0]['invite_id'];
			$interview['webmFile'] = str_replace('mp4', 'webm', $interviews[0]['path']);
			$interview['textFile'] = $interview['webmFile'].'.txt';
			$interview['mp4File']  = $interviews[0]['path'];		
			
		}
		if($interview){						
			// mark interview as a start process and wait for complete interview
			//$this->interview_model->startInterviewProcess(array($interview['interview_id']));

			echo json_encode($interview);
		}
		else
		{
			echo "";
		}					
	}

	public function start()
	{	
		$returnarray = array('status' => 0, 'message' => '');
		$interview_id = $this->input->get('interview_id');		
		if($interview_id){
			$this->interview_model->startInterviewProcess(array($interview_id));			
			$returnarray = array('status' => 1, 'message' => 'success','interview_id' => $interview_id);
		}		
		else{
			$returnarray['message'] = 'param missing';
		}
		echo json_encode($returnarray);
	}
	
	public function complete()
	{
		$returnarray = array('status' => 0, 'message' => '');
		$interview_id = $this->input->get('interview_id');
		$invite_id = $this->input->get('invite_id');
		if($interview_id && $invite_id){
			$this->interview_model->InterviewConversionComplete(array('invite_id' => $invite_id, 'interview_id' => $interview_id));
			$returnarray = array('status' => 1, 'message' => 'success','interview_id' => $interview_id);			
		}
		else{
			$returnarray['message'] = 'param missing';
		}
		echo json_encode($returnarray);
	}

	public function error()
	{	
		$returnarray = array('status' => 0, 'message' => '');	
		$interview_id = $this->input->get('interview_id');
		$log = $this->input->get('log');
		if($interview_id){
			$returnarray = array('status' => 1, 'message' => 'success','interview_id' => $interview_id);
			$this->interview_model->failInterviewProcess(array($interview_id),$log);
		}
		else{
			$returnarray['message'] = 'param missing';
		}	
	}
}
