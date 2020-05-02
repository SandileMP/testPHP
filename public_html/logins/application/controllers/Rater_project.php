<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rater_project extends CI_Controller {
	private $error = array();
	private $credit;
	function __construct() {
		parent::__construct();
		$this->load->helper(array('cookie', 'date', 'form'));
		$this->load->library(array('encrypt', 'form_validation', 'mail'));
		$this->load->model(array('job_profile_model', 'project_model', 'account_manager_model', 'candidate_model', 'auth_model', 'interview_model', 'manager_model', 'credit_model', 'template_model', 'rater_model'));
		$this->credit = $this->credit_model->getSystemCredit();
		if (!$this->checkLogin()) {
			redirect(base_url());
		} else if ($this->session->userdata['user_type'] != 'RATER') {
			redirect(base_url());
		}
	}
	public function index() {
		if ($this->session->userdata['user_type'] != 'RATER') {
			redirect(base_url());
		}
		$data = array();
		$this->lang->load('project');

		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_projects'] = $this->lang->line('text_projects');
		$data['text_empty'] = $this->lang->line('text_empty');
		$data['text_interview_status'] = $this->lang->line('text_interview_status');
		$data['entry_project_id'] = $this->lang->line('entry_project_id');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_project_manager'] = $this->lang->line('entry_project_manager');
		$data['entry_project_start'] = $this->lang->line('entry_project_start');
		$data['entry_project_end'] = $this->lang->line('entry_project_end');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_edit'] = $this->lang->line('button_edit');
		$data['button_remove'] = $this->lang->line('button_remove');

		$data['action'] = base_url() . 'rater_project';
		$data['project_candidate'] = base_url() . 'rater_project/minterviews';
		$data['edit_project'] = base_url() . 'rater_project/edit';
		$data['create_project'] = base_url() . 'rater_project/create';
		$data['remove_project'] = base_url() . 'rater_project/remove';
		$data['remove_all_project'] = base_url() . 'rater_project/removeall';
		$data['send_link_mail_url'] = base_url() . 'rater_project/sendLinkMail';
		$data['interview_status_url'] = base_url() . 'rater_project/checkInterviewStatus';

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$projects = $this->project_model->getRaterProjects($this->session->userdata['user'], array('search' => $this->input->post('text_search')));
		} else {
			$projects = $this->project_model->getRaterProjects($this->session->userdata['user']);
		}
		$data['projects'] = array();
		if ($projects) {
			foreach ($projects as $project) {
				$data['projects'][] = array(
					'project_id' => $project->project_id,
					'project_name' => $project->project_name,
					'manager_name' => $this->manager_model->getManagerName($project->manager_id),
					'start_date' => $project->start_date,
					'end_date' => $project->end_date,
					'project_type' => $project->project_type,
				);
			}
		}
		$this->app->view('rater_project', $data);
	}
	public function remove($project_id = '') {
		if ($this->session->userdata['user_type'] != 'RATER') {
			redirect(base_url());
		}
		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$this->project_model->removeProject($project_id);
			redirect('project');
		} else {
			redirect('project');
		}
	}
	public function removeall() {
		if ($this->session->userdata['user_type'] != 'RATER') {
			redirect(base_url());
		}
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ($this->input->post('projectremovecheck')) {
				foreach ($this->input->post('projectremovecheck') as $ids) {
					$this->project_model->removeProject($ids);
				}
			}
			redirect('project');
		} else {
			redirect('project');
		}
	}
	public function minterviews($project_id = '') {
		$data = array();
		$this->lang->load('interview');

		$data['heading_title'] = $this->lang->line('heading_title_interviews');
		$data['title'] = $this->lang->line('heading_title_interviews');
		$data['text_interviews'] = $this->lang->line('text_interviews');
		$data['text_interview'] = $this->lang->line('text_interview');
		$data['text_empty'] = $this->lang->line('text_empty_interview');

		$data['entry_interview_id'] = $this->lang->line('entry_interview_id');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_interview_candidate'] = $this->lang->line('entry_interview_candidate');
		$data['entry_interview_status'] = $this->lang->line('entry_interview_status');
		$data['entry_interview_start'] = $this->lang->line('entry_interview_start');
		$data['entry_interview_end'] = $this->lang->line('entry_interview_end');
		$data['entry_interview_path'] = $this->lang->line('entry_interview_path');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_watch'] = $this->lang->line('button_watch');

		$data['entry_manager_evaluation'] = $this->lang->line('manager_evaluation');
		$data['text_rater_evaluation'] = $this->rater_model->getNameByAuthID($this->session->userdata['user']);
		$data['cancel'] = base_url() . 'rater_project';
		$data['action'] = base_url() . 'rater_project/minterviews/' . $project_id;

		$user_rater_id = $this->rater_model->getRaterIDByAuthID($this->session->userdata['user']);
		$project_details = $this->project_model->getProjectDetailById($project_id);
		if (!empty($project_details['rater_id'])) {
			$other_rater = array();
			$filter_raters = json_decode($project_details['rater_id']);
			foreach ($filter_raters as $rater_id) {
				if ($user_rater_id !== $rater_id) {
					$other_rater[] = $rater_id;
				}
			}
			$data['entry_rater_evaluation'] = $this->rater_model->getRatersName($other_rater);
		}
		$data['interviews'] = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$interviews = $this->interview_model->getInterviewsByProjectID($project_id, array('search' => $this->input->post('text_search')));
		} else {
			$interviews = $this->interview_model->getInterviewsByProjectID($project_id);
		}
		if ($interviews) {
			foreach ($interviews as $interview)
			{

                $project_id = $interview->project_id;
                $project = $this->project_model->getProjectName($project_id);
                $ProjectData = $this->project_model->getProjectData($project_id);

                $total_time_taken        =  0;
                $interview_question_data = array();

                if($interview->question_data)
                {
                    $interview_question_data = json_decode($interview->question_data,true);
                    $data_time = array_column($interview_question_data,'time_taken');
                    $total_time_taken = ($data_time && !empty($data_time)) ? array_sum($data_time) : 0;
                    //$total_time_taken = ($data_time && !empty($data_time)) ? (array_sum($data_time) - count($data_time)) : 0;
                }
                else
                {
                    $interview_question_data = isset($ProjectData['job_profile']['question_list']) ? $ProjectData['job_profile']['question_list'] : array();
                    $data_time = array_column($interview_question_data,'expire');
                    $total_time_taken = ($data_time && !empty($data_time)) ? array_sum($data_time) : 0;
                    //$total_time_taken = ($data_time && !empty($data_time)) ? (array_sum($data_time) - count($data_time)) : 0;
                }

				$data['interviews'][] = array(
					'interview_id' => $interview->interview_id,
					'project_id' => $interview->project_id,
                    'project_data' => $ProjectData,
                    'question_data' => $interview_question_data,
                    'total_time_taken' => $total_time_taken,
					'project_details' => $project_details,
					'project' => $this->project_model->getProjectName($interview->project_id),
					'candidate_id' => $interview->candidate_id,
					'candidate' => $this->candidate_model->getCandidateNameByID($interview->candidate_id),
					'account_manager_id' => $this->account_manager_model->getAuthAccountManager($project_details['account_manager_id'])['profile_id'],
					'manager_id' => $project_details['manager_id'],
					'manager' => $this->manager_model->getManagerNameByAuthID($project_details['manager_id']),
					'start' => $interview->start,
					'end' => $interview->end,
					'path' => $interview->path,
					'full_path' => base_url('application/controllers/interview/uploads') . '/' . $interview->path,
					'is_credited' => $interview->is_credited,
					'manager_eva_rating' => $interview->manager_eva_rating,
					'manager_eva_comment' => $interview->manager_eva_comment,
					'other_rater_evaluation' => $this->interview_model->getRaterEvaluation($interview->interview_id, $other_rater),
					'user_rater_evaluation' => $this->interview_model->getUserRaterEvaluation($interview->interview_id, $user_rater_id),
					'status' => (int) $interview->status,
				);
			}
		}
		$this->app->view('rater_mview_interviews', $data);
	}
	private function checkLogin() {
		if (isset($this->session->userdata['user'])) {
			return true;
		} else {
			return false;
		}
	}
	private function userLogin() {
		if ($this->checkLogin()) {
			$user = $this->session->userdata['user'];
			return $user;
		}
	}
	private function validateForm() {
		if (empty($this->input->post('project_name'))) {
			$this->error['error_project_name'] = $this->lang->line('error_project_name');
		}
		if (empty($this->input->post('profile_name'))) {
			$this->error['error_profile_name'] = $this->lang->line('error_profile_name');
		}
		if ($this->uri->segments[1] == 'project' && $this->uri->segments[2] == 'create') {
			if (is_array($this->input->post('candidate'))) {
				foreach ($this->input->post('candidate') as $key => $value) {
					if (is_array($value)) {
						foreach ($value as $key => $value2) {
							if (empty($value2)) {
								$this->error['error_candidate'] = $this->lang->line('error_candidate');
							}
						}
					}
				}
			}
		} else {
			if (is_array($this->input->post('candidate'))) {
				foreach ($this->input->post('candidate') as $key => $value) {
					if (is_array($value)) {
						foreach ($value as $key => $value2) {
							if (empty($value2)) {
								$this->error['error_candidate'] = $this->lang->line('error_candidate');
							}
						}
					}
				}
			}
		}

		// //Credit Validation
		// if (count($this->input->post('candidate')) > 0) {
		// 	$user_credit = $this->credit_model->getUserAvailableCredit($this->session->userdata['profile_id']);
		// 	$credit_require = (count($this->input->post('candidate')) * $this->credit);

		// 	if ($user_credit < $credit_require) {
		// 		$this->error['error_credit'] = 'Not Enough Credit.';
		// 		//$_POST['candidate'] = array();
		// 	}
		// }

		if (empty($this->input->post('notification'))) {
			$this->error['error_notification'] = $this->lang->line('error_notification');
		}
		if (!$this->input->post('open_project')) {
			if (empty($this->input->post('start_date'))) {
				$this->error['error_project_type'] = $this->lang->line('error_project_type');
			}
			if (empty($this->input->post('end_date'))) {
				$this->error['error_project_type'] = $this->lang->line('error_project_type');
			}
		}
		if ($this->input->post('open_project')) {
			if (empty($this->input->post('start_date'))) {
				$this->error['error_project_type'] = $this->lang->line('error_project_type');
			}
		}
		return !$this->error;
	}
	public function updateEvoRate() {
		if (count($_POST) == 3) {
			$value = $this->input->post('rate');
			$interview_id = $this->input->post('interview_id');
			$rater_id = $this->input->post('rater_id');
			$data = array('rating' => $value);
			$where = array('rater_id' => $rater_id, 'interview_id' => $interview_id);

			if ($this->interview_model->updateRaterEvoRate($data, $where)) {
				echo "1";
			} else {
				echo "0";
			}
		} else {
			echo "0";
		}
	}
	public function viewComment() {
		if (count($_POST) > 0) {
			$interview_id = $this->input->post('interview_id');
			$type = $this->input->post('type');
			$id = $this->input->post('id');
			if ($type == 'MANAGER') {
				$field = "manager_eva_comment";
				$where = array('interview_id' => $interview_id);
			} else if ($type == 'RATER') {
				$field = "comment";
				$where = array('rater_id' => $id, 'interview_id' => $interview_id);
			}
			echo $this->interview_model->getComment($field, $where, $type);
		}
	}
	public function getComment() {
		if (count($_POST) > 0) {
			$interview_id = $this->input->post('interview_id');
			$type = $this->input->post('type');
			$id = $this->input->post('id');
			$field = "comment";
			$where = array('rater_id' => $id, 'interview_id' => $interview_id);
			echo $this->interview_model->getComment($field, $where, $type);
		}
	}
	public function saveComment() {
		if (count($_POST) == 3) {
			$comment = $this->input->post('txt_comment');
			$interview_id = $this->input->post('txt_interview_id');
			$rater_id = $this->input->post('txt_rater_id');
			if ($comment == "" || $interview_id == "") {
				echo "0";
			} else {
				$data = array("comment" => $comment);
				$where = array('rater_id' => $rater_id, 'interview_id' => $interview_id);

				if ($this->interview_model->saveRaterComment($data, $where)) {
					echo "1";
				} else {
					echo "0";
				}
			}
		} else {
			echo "0";
		}
	}
}
