<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
class Upload extends CI_Controller {
    private $error = array();
    function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie','date','form'));
        $this->load->library(array('encrypt','form_validation','mail'));
        $this->load->model(array('auth_model','interview_model','candidate_model'));
        set_error_handler(array($this,"someFunction"));
        $this->selfInvoker();
    }
    public function index(){
    }
    public function someFunction($errno, $errstr){
        echo '<h2>Upload failed.</h2><br>';
        echo '<p>'.$errstr.'</p>';
    }
    public function selfInvoker(){

        if (!isset($_POST['audio-filename']) && !isset($_POST['video-filename'])) {
            echo 'Empty file name.';
            return;
        }

        // do NOT allow empty file names
        if (empty($_POST['audio-filename']) && empty($_POST['video-filename'])) {
            echo 'Empty file name.';
            return;
        }

        // do NOT allow third party audio uploads
        if (isset($_POST['audio-filename']) && strrpos($_POST['audio-filename'], "RecordRTC-") !== 0) {
            echo 'File name must start with "RecordRTC-"';
            return;
        }

        // do NOT allow third party video uploads
        if (isset($_POST['video-filename']) && strrpos($_POST['video-filename'], "RecordRTC-") !== 0) {
            echo 'File name must start with "RecordRTC-"';
            return;
        }
        
        $fileName = '';
        $tempName = '';
        $file_idx = '';
        
        if (!empty($_FILES['audio-blob'])) {
            $file_idx = 'audio-blob';
            $fileName = $_POST['audio-filename'];
            $tempName = $_FILES[$file_idx]['tmp_name'];
        } else {
            $file_idx = 'video-blob';
            $fileName = $_POST['video-filename'];
            $tempName = $_FILES[$file_idx]['tmp_name'];
        }
        
        if (empty($fileName) || empty($tempName)) {
            if(empty($tempName)) {
                echo 'Invalid temp_name: '.$tempName;
                return;
            }

            echo 'Invalid file name: '.$fileName;
            return;
        }
        
       // $filePath = '/usr/www/users/einteajaxm/logins/application/controllers/interview/uploads/' . $fileName;
       $videoFile = APPPATH.'controllers/interview/uploads/' . $fileName;
       $videoFilePath = APPPATH.'controllers/interview/uploads/';
       $saveVideoFileName = $_POST['invite_id']."_interview_".rand(100,999).'_'.date('Ymd_H_i_s');
       $saveVideoFileName = $saveVideoFileName.'.webm';

       $tempVideoFile =  $videoFilePath.$saveVideoFileName.'.temp';
       $textFile = $videoFilePath.$saveVideoFileName.'.txt';
       

        // make sure that one can upload only allowed audio/video files
        $allowed = array(
            'webm',
            'wav',
            'mp4',
            "mkv",
            'mp3',
            'ogg'
        );
        $extension = pathinfo($videoFile, PATHINFO_EXTENSION);
        if (!$extension || empty($extension) || !in_array($extension, $allowed)) {
            echo 'Invalid file extension: '.$extension;
            //continue;
        }
        
        if (!move_uploaded_file($tempName, $videoFile)) {
            echo 'Problem saving file: '.$tempName;
            // $this->User_activity_model->addActivityMessage('error saving file');
            return;
        }

        if(isset($_POST['interviewComplete']) && $_POST['interviewComplete'] == "1")
        {
			if($_POST['fileList'] && !empty($_POST['fileList']))
			{				
				/// create a file for convert
				$myfile = fopen($tempVideoFile, "w");
				$textforsave = $_POST['fileList'];

				$textforsave = str_replace(",", "'\nfile '/app/", $textforsave);                
                $textforsave = "file '/app/".$textforsave."'";

                fwrite($myfile, $textforsave);
                fclose($myfile);

                rename($tempVideoFile, $textFile);

                $_POST["video-filename"] = $saveVideoFileName;

				if(isset($_POST['interviewTestType']) && $_POST['interviewTestType'] == 'interview'){
					$this->submitted_data();
				}
			}
        }
        else
        {
            // complete 
            $interviewQuestion = isset($_POST['prevInterviewQuestion']) && $_POST['prevInterviewQuestion'] ? $_POST['prevInterviewQuestion'] : '';
            if($interviewQuestion){
                $message = 'Question : '.$interviewQuestion.' Complete';
                $this->User_activity_model->addActivityMessage($message);
            }

            /// next 
            $message = isset($_POST['interviewQuestion']) && $_POST['interviewQuestion'] ? $_POST['interviewQuestion'] : '';
            if($message){
                $message = 'Start : '.$message;
                $start_time = date("Y-m-d H:i:s", strtotime('+15 seconds'));
                $this->User_activity_model->addActivity(['activity_message' => $message,'created_at' => $start_time]);
            }
        }
    }
    
    public function submitted_data()
    {
        $this->interview_model->setInterviewEndStatus($this->session->userdata['interview_user']);
        //$id = $this->interview_model->completeInterview($this->input->post());

        $id = $this->interview_model->undereConversion($this->input->post());

        if(!$id){
            echo 'Fail to To Save Data';
            return;
        }

        $message = 'Interview Complete';
        $this->User_activity_model->addActivityMessage($message);

        return $id;
    }
}
?>