<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class User_activity_model extends CI_Model {

	public function __construct() {
		parent::__construct();		
	}

	public function getActivityMessage($url='',$router=false)
	{

		$url = ($url) ? $url : current_url();
		$page = $router->fetch_class();
		$page = str_word_count($page) >= 2 ? $page : $page.'_'.$router->fetch_method();
		$page = str_replace(['_','-'], ' ',$page);

		$message = "visit $page page";

		return $message;
	}

	public function addActivity($activity = array())
	{
		$activity['user_id'] = (isset($activity['user_id']) && $activity['user_id']) ? $activity['user_id'] : (isset($this->session->userdata['user']) ? $this->session->userdata['user'] : null);
		$activity['activity_url'] = (isset($activity['activity_url']) && $activity['activity_url']) ? $activity['activity_url'] : current_url();
		$activity['agent_string'] = (isset($activity['agent_string']) && $activity['agent_string']) ? $activity['agent_string'] : $this->agent->agent;
		
		if(isset($this->session->userdata['interview_user']) && !isset($activity['invite_interview_id']))
		{
			$candidate_id = $this->session->userdata['interview_user'];
			$interview_detail = $this->interview_model->getInterviewDetails($candidate_id);
			$activity['invite_interview_id'] = $interview_detail['invite_id'];            
		}

		
		if(isset($activity['user_id']) && isset($activity['activity_message'])){
			// $this->db->query('DELETE FROM `tbl_user_activity`');
			$this->db->insert('tbl_user_activity', $activity);			
        }
			
	}

	public function addActivityMessage($message='')
	{
		$activity['activity_message'] =  $message;
		$this->addActivity($activity);
	}

	public function getActivity($filter=null)
	{		
		$this->db->select('tbl_user_activity.*, tbl_auth.name as user_name');
		$this->db->from('tbl_user_activity');
		$this->db->join('tbl_auth', 'tbl_user_activity.user_id = tbl_auth.auth_id', 'left');
		
		if($filter && is_array($filter))
		{
			foreach($filter as $filterKay => $filterVal){
				$this->db->where($filterKay, $filterVal);
			}
		}
		
		return $data = $this->db->get()->result();
	}
}
?>
