<?php
class App {
	private $allow_unauth = array(
		'home',
	);
	private function userLogin(){
		$CI = get_instance();
		if($this->checkLogin()){
			$user = $CI->session->userdata['user'];
			return $user;
		}
	}
	private function checkLogin(){
		$CI = get_instance();
		if(isset($CI->session->userdata['user'])){
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
		
		$CI->lang->load('common/menu');
		$CI->lang->load('common/header');
		$CI->lang->load('common/footer');
		
		$header_data['text_profile'] = $CI->lang->line('text_profile');
		$header_data['text_messege'] = $CI->lang->line('text_messege');
		$header_data['text_setting'] = $CI->lang->line('text_setting');
		$header_data['text_logout'] = $CI->lang->line('text_logout');
		$header_data['text_search'] = $CI->lang->line('text_search');
		$header_data['button_continue'] = $CI->lang->line('button_continue');
		$header_data['button_back'] = $CI->lang->line('button_back');
		$header_data['button_go'] = $CI->lang->line('button_go');
		if($CI->session->userdata['user_type'] === 'CANDIDATE'){
			$header_data['dashboard'] = base_url().'candidate_dashboard';
		}else{
			$header_data['dashboard'] = base_url().'dashboard';
		}
		$header_data['profile'] = base_url().'profile';
		$header_data['message'] = base_url().'message';
		$header_data['setting'] = base_url().'setting';
		$header_data['logout'] = base_url().'logout';
		$CI->load->model('auth_model');
		$CI->load->model('interview_model');
		$header_data['userDetail'] = $CI->auth_model->getAuthProfile($this->userLogin());
		$header_data['interviewCompleted'] = $CI->interview_model->getCompleteInterviewNotification();
		
		$menu_data = array();
		$menu_data['userDetail'] = $CI->auth_model->getAuthProfile($this->userLogin());
		$menu_data['text_dashboard'] = $CI->lang->line('text_dashboard');
		$menu_data['text_admin'] = $CI->lang->line('text_admin');
		$menu_data['text_hr'] = $CI->lang->line('text_hr');
		$menu_data['text_create_hr'] = $CI->lang->line('text_create_hr');
		$menu_data['text_create_manager'] = $CI->lang->line('text_create_manager');
		$menu_data['text_create_job_profile'] = $CI->lang->line('text_create_job_profile');
		$menu_data['text_create_project'] = $CI->lang->line('text_create_project');
		$menu_data['text_manager'] = $CI->lang->line('text_manager');
		$menu_data['text_applicant'] = $CI->lang->line('text_applicant');
		$menu_data['text_invite_interview'] = $CI->lang->line('text_invite_interview');
		$menu_data['text_manage_interview'] = $CI->lang->line('text_manage_interview');
		$menu_data['text_view_interview'] = $CI->lang->line('text_view_interview');
		if($CI->session->userdata['user_type'] === 'CANDIDATE'){
			$menu_data['dashboard'] = base_url().'candidate_dashboard';
		}else{
			$menu_data['dashboard'] = base_url().'dashboard';
		}
		$menu_data['hr'] = base_url().'hr';
		$menu_data['create_hr'] = base_url().'hr';
		$menu_data['create_manager'] = base_url().'manager';
		$menu_data['create_job_profile'] = base_url().'job_profile';
		$menu_data['create_project'] = base_url().'project';
		$menu_data['manager'] = base_url().'manager';
		$menu_data['invite_interview'] = base_url().'invite_interview';
		$menu_data['manage_interview'] = base_url().'manage_interview';
		$menu_data['admin_view_interview'] = base_url().'hr/interview_project';
		$menu_data['view_interview'] = base_url().'project/interview_project';
		$menu_data['candidate'] = base_url().'candidate';

		$footer_data = array();
		$footer_data['text_footer'] = $CI->lang->line('text_footer');
		
		$header = $CI->parser->parse('common/header',$header_data,true);
		$menu = $CI->parser->parse('common/menu',$menu_data,true);
		$footer = $CI->parser->parse('common/footer',$footer_data,true);
		
		$data = array(
	        'app_header'   	=>	$header,
	        'app_menu'   	=>	$menu,
			'app_content'	=>	$view,
			'app_footer'	=>	$footer,
		);

		$CI->parser->parse('common/index', $data);
	}
}