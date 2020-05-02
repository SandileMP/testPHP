<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class TestUpload extends CI_Controller
{    
    function __construct() {
		parent::__construct();
		set_error_handler(array($this,"someFunction"));
	}
	
	public function someFunction($errno, $errstr){
        echo "0";
	}
	
    public function index()
	{
		$file_idx = 'video-blob';
		$moveFileName = $_POST['video-filename'];
		$tempName = $_FILES[$file_idx]['tmp_name'];
		$moveFileName = rand(100,999).$moveFileName;
		$moveFileName = str_replace('RecordRTC-video', '_'.date('dmy_h_i_s'), $moveFileName);

		$filePath = APPPATH.'controllers/interview/test_uploads/' . $moveFileName;
		$moveFilePath = APPPATH.'controllers/interview/test_uploads/' . $moveFileName;
		$filePathForText = APPPATH.'controllers/interview/test_uploads/';


		$allowed = [ 'webm', 'wav', 'mp4', "mkv", 'mp3', 'ogg' ];
		$extension = pathinfo($filePath, PATHINFO_EXTENSION);
		if (!$extension || empty($extension) || !in_array($extension, $allowed)) {
			echo 'Invalid file extension: '.$extension;
		}

		if (move_uploaded_file($tempName, $moveFilePath))
		{			
			$rtn_fileName =  str_replace('webm','mp4',base_url('/application/controllers/interview/test_uploads').'/'.$moveFileName);

			if(isset($_POST['interviewComplete']) && $_POST['interviewComplete'] == "1")
			{
				if(isset($_POST['fileList']) && $_POST['fileList'])
				{
					$createTextFile = $filePathForText.$moveFileName.".txt";
					$createTextTempFile = $filePathForText.$moveFileName.".temp";

					/// create a file for
					$myfile = fopen($createTextTempFile, "w");
					$textforsave = $moveFileName;
					$textforsave = str_replace(",", "'\nfile '/app/", $textforsave);
	                $textforsave = "file '/app/".$textforsave."'";	                
	                
	                fwrite($myfile, $textforsave);					
					fclose($myfile);

					rename($createTextTempFile, $createTextFile);

					$message = isset($_POST['interviewTestType']) && $_POST['interviewTestType'] == 'temp_test' ? 'Test' : 'Practice';
					$message = $message. ' Complete';

					$this->User_activity_model->addActivityMessage($message);
				}
			}

			echo $rtn_fileName;
		
		}
    }

}
?>
