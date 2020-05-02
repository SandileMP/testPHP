<?php

class RecapchaVerify{
	
	private $secetKey = '6LedhJMUAAAAAGZ70B_rPur4dTeS8XS-1EYtnzK0';

	function verifyReCapcha($secret)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://www.google.com/recaptcha/api/siteverify",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "secret=".$this->secetKey."&response=".$secret
		));

		$response = json_decode(curl_exec($curl), true);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return false;
		} else {
		  return $response['success'];
		}	
	}
}

?>