<?php
class App_interview {
	private $allow_unauth = array(
		'home',
	);
	private function userLogin(){
		$CI = get_instance();
		if($this->checkLogin()){
			$user = $CI->session->userdata['interview_user'];
			return $user;
		}
	}
	private function checkLogin(){
		$CI = get_instance();
		if(isset($CI->session->userdata['interview_user'])){
			return true;
		}else{
			return false;
		}
	}
  	public function view($template, $vars = array(), $config = array()){
		$CI = get_instance();
		$CI->load->library('parser');
		$app_name = $CI->config->item('app_name');
		$view = $CI->load->view($template,$vars,true);
		
		if (array_key_exists('title', $config)) {
		    $title = $config['title'];
		}else{ 
			$title = $app_name; 
		}

		//Header
		$header_data = array(
			'title'	=>	$vars['title'],
		);
		
		$CI->lang->load('interview/common/header');
		$CI->lang->load('interview/common/footer');
		
		$header_data['text_logout'] = $CI->lang->line('text_logout');
		$header_data['dashboard'] = base_url().'candidate_dashboard';
		$header_data['logout'] = base_url().'logout';
		
		$footer_data = array();
		$footer_data['text_footer'] = $CI->lang->line('text_footer');
		
		$header = $CI->parser->parse('interview/common/header',$header_data,true);
		$footer = $CI->parser->parse('interview/common/footer',$footer_data,true);
		
		$data = array(
	        'app_header'   	=>	$header,
			'app_content'	=>	$view,
			'app_footer'	=>	$footer,
		);

		$CI->parser->parse('interview/common/index', $data);
	}
}