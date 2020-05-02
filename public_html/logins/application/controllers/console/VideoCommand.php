<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VideoCommand extends CI_Controller 
{
	function __construct() 
	{		
		parent::__construct();				
		$this->load->model(array('job_profile_model', 'project_model', 'account_manager_model', 'manager_model', 'candidate_model', 'auth_model', 'interview_model', 'rater_model', 'credit_model', 'template_model'));
	}
	
	public function index()
	{
		$this->checkNewInterview();
		$this->checkActiveInterview();
	}
	
	public function checkNewInterview()
	{
		echo "\n *************** ". date('m-d-Y H:i:s') ." Check New interview *************** \n";

		$interviews = $this->interview_model->getInterviewForProcess();
		$videoPath = APPPATH.'controllers/interview/uploads/';

		if($interviews && !empty($interviews))
		{
			$markAsActive = [];			
			foreach($interviews as $interview){
				$markAsActive[] = $interview['interview_id'];
			}

			// mark interview as a start process and wait for complete interview
			$this->interview_model->startInterviewProcess($markAsActive);

			foreach($interviews as $interview)
			{
				echo "\n".' interview_id = '.$interview['interview_id']; 
				echo "\n".' invite_id = '. $interview['invite_id']; 
				echo "\n".' project_id = '. $interview['project_id']; 
				echo "\n".' candidate_id = '. $interview['candidate_id'];
				echo "\n convert status = Start";
				echo "\n\n";
				
				$webmFile = str_replace('mp4', 'webm', $videoPath.$interview['path']);
				$textFile = $webmFile.'.txt';
				$mp4File = $videoPath.$interview['path'];

				/// create a video file from txt file

				/// check video file created complete 
				if(file_exists($webmFile) && file_exists($textFile) && file_exists($mp4File))
				{
					// after  complete process  send mail to rater 
					$this->interview_model->InterviewConversionComplete(array('invite_id' => $interview['invite_id'],'interview_id' => $interview['interview_id']));
					echo "\n convert status = Complete";
					echo "\n\n";
				}
				else{
					echo "\n convert status = in Process";
					echo "\n\n";
				}
								
				// fail interview process 
				//$this->interview_model->failInterviewProcess(array($interview['interview_id']));
				
			}
			//exit("temp Break");			
		}
		else
		{
			echo "\n no new interview\n\n";
		}
		echo "\n ****************************** \n";		
	}


	public function checkActiveInterview()
	{
		echo "\n *************** ". date('m-d-Y H:i:s') ." Check Active interview *************** \n";

		$interviews = $this->interview_model->getActiveProcessInterview();
		$videoPath = APPPATH.'controllers/interview/uploads/';

		if($interviews && !empty($interviews))
		{
			foreach($interviews as $interview)
			{
				echo "\n".' interview_id = '.$interview['interview_id']; 
				echo "\n".' invite_id = '. $interview['invite_id']; 
				echo "\n".' project_id = '. $interview['project_id']; 
				echo "\n".' candidate_id = '. $interview['candidate_id'];				
				
				$webmFile = str_replace('mp4', 'webm', $videoPath.$interview['path']);
				$textFile = $webmFile.'.txt';
				$mp4File = $videoPath.$interview['path']."111";

				$this->interview_model->updateActiveProcessInterviewCounter($interview);

				if(file_exists($webmFile) && file_exists($textFile) && file_exists($mp4File))
				{
					echo "\n convert status = Complete";
					// after  complete process  send mail to rater 
					$this->interview_model->InterviewConversionComplete(array('invite_id' => $interview['invite_id'],'interview_id' => $interview['interview_id']));
				}
				else
				{
					echo "\n convert status = in Process";					
				}

				echo "\n\n";


				if(isset($interview['video_status_call']) && $interview['video_status_call'] > 15)
				{

				}
				
				// fail interview process 
				//$this->interview_model->failInterviewProcess(array($interview['interview_id']));
				
			}
			//exit("temp Break");			
		}
		else
		{
			echo "\n no new interview\n\n";
		}
		echo "\n ****************************** \n";		
	}

	public function loop(){
		$this->index();
		sleep(3);
		$this->loop1();
	}

	public function loop1(){
		$this->loop();
	}
}
