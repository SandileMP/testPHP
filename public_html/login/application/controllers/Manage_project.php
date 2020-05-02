<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_project extends CI_Controller {
	private $error = array();
	private $credit;
	function __construct() {
		parent::__construct();
		$this->load->helper(array('cookie', 'date', 'form'));
		$this->load->library(array('encrypt', 'form_validation', 'mail'));
		$this->load->model(array('job_profile_model', 'manage_project_model', 'hr_model', 'candidate_model', 'auth_model', 'interview_model', 'manager_model', 'credit_model'));
		$this->credit = $this->credit_model->getSystemCredit();
		if (!$this->checkLogin()) {
			redirect(base_url());
		} else if ($this->session->userdata['user_type'] != 'MANAGER') {
			redirect(base_url());
		}
	}
	public function index() {
		$data = array();
		$this->lang->load('manage_project');

		$data['heading_title'] = $this->lang->line('heading_title');
		$data['title'] = $this->lang->line('heading_title');
		$data['text_projects'] = $this->lang->line('text_projects');
		$data['text_empty'] = $this->lang->line('text_empty');
		$data['text_interview_status'] = $this->lang->line('text_interview_status');
		$data['entry_project_id'] = $this->lang->line('entry_project_id');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_job_profile_name'] = $this->lang->line('entry_job_profile_name');
		$data['entry_project_manager'] = $this->lang->line('entry_project_manager');
		$data['entry_project_candidate'] = $this->lang->line('entry_project_candidate');
		$data['entry_project_start'] = $this->lang->line('entry_project_start');
		$data['entry_project_end'] = $this->lang->line('entry_project_end');
		$data['entry_active_candidates'] = $this->lang->line('entry_active_candidates');
		$data['entry_test_completed_candidates'] = $this->lang->line('entry_test_completed_candidates');
		$data['entry_project_type'] = $this->lang->line('entry_project_type');
		$data['entry_project_notify'] = $this->lang->line('entry_project_notify');
		$data['entry_project_status'] = $this->lang->line('entry_project_status');
		$data['entry_project_link'] = $this->lang->line('entry_project_link');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_create'] = $this->lang->line('button_create');
		$data['button_edit'] = $this->lang->line('button_edit');
		$data['button_remove'] = $this->lang->line('button_remove');

		$data['action'] = base_url() . 'manage_project';
		$data['project_candidate'] = base_url() . 'manage_project/minterviews';
		$data['edit_project'] = base_url() . 'manage_project/edit';
		$data['create_project'] = base_url() . 'manage_project/create';
		$data['remove_project'] = base_url() . 'manage_project/remove';
		$data['remove_all_project'] = base_url() . 'manage_project/removeall';
		$data['send_link_mail_url'] = base_url() . 'manage_project/sendLinkMail';
		$data['interview_status_url'] = base_url() . 'manage_project/checkInterviewStatus';

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$projects = $this->manage_project_model->getProjectsBySearch($this->session->userdata['user'], $this->input->post('text_search'));
		} else {
			$projects = $this->manage_project_model->getProjects($this->session->userdata['user']);
		}
		$data['projects'] = array();
		if ($projects) {
			foreach ($projects as $project) {
				$data['projects'][] = array(
					'project_id' => $project->project_id,
					'project_name' => $project->project_name,
					'project_code' => $project->project_code,
					'profile_name' => $this->job_profile_model->getProfileName($project->profile_id),
					'manager_name' => $this->manager_model->getManagerName($project->manager_id),
					'candidate' => $this->candidate_model->getCandidateName($project->candidate_id),
					'project_type' => $project->project_type,
					'start_date' => $project->start_date,
					'end_date' => $project->end_date,
					'notification' => $project->notification,
					'status' => $project->status,
					'completed' => $this->manage_project_model->countCompletedInterview($project->project_id),
				);
			}
		}
		$this->app->view('view_manage_projects', $data);
	}
	public function interview_project() {
		$data = array();
		$this->lang->load('interview');

		$data['heading_title'] = $this->lang->line('heading_title_manage_interview');
		$data['title'] = $this->lang->line('heading_title_manage_interview');
		$data['text_manage_interview'] = $this->lang->line('text_manage_interview');
		$data['text_empty'] = $this->lang->line('text_empty_project');

		$data['entry_project_id'] = $this->lang->line('entry_project_id');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_project_desc'] = $this->lang->line('entry_project_desc');
		$data['entry_profile'] = $this->lang->line('entry_profile');
		$data['entry_candidate'] = $this->lang->line('entry_candidate');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_view'] = $this->lang->line('button_view');

		$data['action'] = base_url() . 'project/minterviews';
		$data['search_action'] = base_url() . 'project/interview_project';

		$data['projects'] = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$projects = $this->manage_project_model->getProjectsBySearch($this->session->userdata['user'], $this->input->post('text_search'));
		} else {
			$projects = $this->manage_project_model->getProjects($this->session->userdata['user']);
		}

		if ($projects) {
			foreach ($projects as $project) {
				$data['projects'][] = array(
					'project_id' => $project->project_id,
					'project_name' => $project->project_name,
					'profile' => $this->job_profile_model->getProfileName($project->profile_id),
					'candidate' => $this->candidate_model->getCandidateName($project->candidate_id),
				);
			}
		}
		$this->app->view('interview_project', $data);
	}
	public function interviews($project_id = '') {
		$data = array();
		$this->lang->load('interview');

		$data['heading_title'] = $this->lang->line('heading_title_interviews');
		$data['title'] = $this->lang->line('heading_title_interviews');
		$data['text_interviews'] = $this->lang->line('text_interviews');
		$data['text_empty'] = $this->lang->line('text_empty_interview');

		$data['entry_interview_id'] = $this->lang->line('entry_interview_id');
		$data['entry_project_name'] = $this->lang->line('entry_project_name');
		$data['entry_interview_candidate'] = $this->lang->line('entry_interview_candidate');
		$data['entry_interview_start'] = $this->lang->line('entry_interview_start');
		$data['entry_interview_end'] = $this->lang->line('entry_interview_end');
		$data['entry_interview_path'] = $this->lang->line('entry_interview_path');

		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_watch'] = $this->lang->line('button_watch');

		$data['cancel'] = base_url() . 'project/interview_project';

		$data['interviews'] = array();
		$interviews = $this->interview_model->getInterviewsByProjectID($project_id);
		if ($interviews) {
			foreach ($interviews as $interview) {
				$data['interviews'][] = array(
					'interview_id' => $interview->interview_id,
					'project' => $this->manage_project_model->getProjectName($interview->project_id),
					'candidate' => $this->candidate_model->getCandidateNameByID($interview->candidate_id),
					'start' => $interview->start,
					'end' => $interview->end,
					'path' => $interview->path,
					'status' => $interview->status,
				);
			}
		}
		$this->app->view('view_interviews', $data);
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

		$data['manager_evaluation'] = $this->lang->line('manager_evaluation');
		$data['client_evaluation'] = $this->lang->line('client_evaluation');

		$data['entry_interview_end'] = $this->lang->line('entry_interview_end');
		$data['entry_interview_path'] = $this->lang->line('entry_interview_path');

		$data['entry_action'] = $this->lang->line('entry_action');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['button_watch'] = $this->lang->line('button_watch');

		$data['cancel'] = base_url() . 'manage_project';

		$data['interviews'] = array();

		$interviews = $this->interview_model->getInterviewsByProjectID($project_id);
		if ($interviews) {
			foreach ($interviews as $interview) {
				$project_details = $this->manage_project_model->getProjectDetailById($interview->project_id);

				$data['interviews'][] = array(
					'interview_id' => $interview->interview_id,
					'project_id' => $interview->project_id,
					'project_details' => $project_details,
					'project' => $this->manage_project_model->getProjectName($interview->project_id),
					'candidate_id' => $interview->candidate_id,
					'client_id' => $this->hr_model->getAuthHr($project_details['client_id'])['profile_id'],
					'candidate' => $this->candidate_model->getCandidateNameByID($interview->candidate_id),
					'start' => $interview->start,
					'end' => $interview->end,
					'path' => $interview->path,
					'is_credited' => $interview->is_credited,
					'manager_eva_rating' => $interview->manager_eva_rating,
					'client_eva_rating' => $interview->client_eva_rating,
					'status' => $interview->status,
				);
			}
		}
		$this->app->view('mview_interviews', $data);
	}

	public function candidates($project_id = '') {
		$data = array();
		$this->lang->load('manage_project');

		$data['heading_title'] = $this->lang->line('heading_title_candidates');
		$data['title'] = $this->lang->line('heading_title_candidates');
		$data['text_candidates'] = $this->lang->line('text_candidates');
		$data['text_empty_candidate'] = $this->lang->line('text_empty_candidate');
		$data['text_resend_login_detail'] = $this->lang->line('text_resend_login_detail');

		$data['entry_candidate_name'] = $this->lang->line('entry_candidate_name');
		$data['entry_test_completed'] = $this->lang->line('entry_test_completed');
		$data['entry_status'] = $this->lang->line('entry_status');
		$data['entry_action'] = $this->lang->line('entry_action');

		$data['button_cancel'] = $this->lang->line('button_cancel');

		$data['cancel'] = base_url() . 'project';
		$data['send_login_detail_url'] = base_url() . 'project/sendLoginDetailMail';

		$data['candidates'] = array();
		$candidates = $this->manage_project_model->getProjectCandidates($project_id);
		if ($candidates) {
			foreach (array_count_values(json_decode($candidates)) as $candidate => $count) {
				$data['candidates'][] = array(
					'candidate_id' => $candidate,
					'candidate_name' => $this->candidate_model->getCandidateNameByID($candidate),
					'test_completed' => $this->manage_project_model->countCompletedInterviewByCandidate($candidate, $project_id),
					'total_test' => $count,
				);
			}
		}
		$this->app->view('view_project_candidates', $data);
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
		if (count($_POST) == 2) {
			$value = $this->input->post('rate');
			$interview_id = $this->input->post('interview_id');
			if ($this->session->userdata['user_type'] == 'MANAGER') {
				$data = array('manager_eva_rating' => $value);
			} else {
				$data = array('client_eva_rating' => $value);
			}
			$where = array('interview_id' => $interview_id);

			if ($this->interview_model->updateEvoRate($data, $where)) {
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
			if ($this->session->userdata['user_type'] == 'MANAGER') {
				$field = "client_eva_comment";
			} else {
				$field = "manager_eva_comment";
			}
			$where = array('interview_id' => $interview_id);
			echo $this->interview_model->getComment($field, $where);
		}
	}

	public function getComment() {
		if (count($_POST) > 0) {
			$interview_id = $this->input->post('interview_id');
			if ($this->session->userdata['user_type'] == 'MANAGER') {
				$field = "manager_eva_comment";
			} else {
				$field = "client_eva_comment";
			}
			$where = array('interview_id' => $interview_id);
			echo $this->interview_model->getComment($field, $where);
		}
	}

	public function saveComment() {
		if (count($_POST) == 2) {
			$comment = $this->input->post('txt_comment');
			$interview_id = $this->input->post('txt_interview_id');
			if ($comment == "" || $interview_id == "") {
				echo "0";
			} else {
				if ($this->session->userdata['user_type'] == 'MANAGER') {
					$data = array("manager_eva_comment" => $comment);
				} else {
					$data = array("client_eva_comment" => $comment);
				}
				$where = array('interview_id' => $interview_id);

				if ($this->interview_model->saveComment($data, $where)) {
					echo "1";
				} else {
					echo "0";
				}
			}
		} else {
			echo "0";
		}
	}

	public function disableInterview($interview_id = '', $candidate_id = '') {
		if (!empty($interview_id) || !empty($candidate_id)) {
			$where = array('interview_id' => $interview_id);
			$value = array('status' => 2);
			if ($this->interview_model->disableInterview($value, $where)) {
				$cwhere = array('candidate_id' => $candidate_id);
				$cvalue = array('status' => 0);
				if ($this->candidate_model->updateCandidate($cvalue, $cwhere)) {
					$this->session->set_flashdata('success', 'Interview Disabled Successfull.');
				} else {
					$this->session->set_flashdata('danger', 'Interview Disabled Failed.');
				}
			} else {
				$this->session->set_flashdata('danger', 'Interview Disabled Failed.');
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	public function enableInterview($interview_id = '', $candidate_id = '', $status = '') {
		if (!empty($interview_id) || !empty($candidate_id)) {
			$where = array('interview_id' => $interview_id);
			$value = array('status' => $status);
			if ($this->interview_model->disableInterview($value, $where)) {
				$cwhere = array('candidate_id' => $candidate_id);
				$cvalue = array('status' => 1);
				if ($this->candidate_model->updateCandidate($cvalue, $cwhere)) {
					$this->session->set_flashdata('success', 'Interview Enabled Successfull.');
				} else {
					$this->session->set_flashdata('danger', 'Interview Enabled Failed.');
				}
			} else {
				$this->session->set_flashdata('danger', 'Interview Enabled Failed.');
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	public function resetInterview($interview_id = '', $candidate_id = '', $project_id = '') {
		if (!empty($interview_id) || !empty($candidate_id)) {
			$where = array('interview_id' => $interview_id);
			$value = array(
				'status' => 0,
				'start' => '',
				'end' => '',
				'path' => '',
				'is_credited' => 0,
				'manager_eva_rating' => '',
				'manager_eva_comment' => '',
				'client_eva_rating' => '',
				'client_eva_comment' => '',
			);
			$ivalue = array(
				'note' => '',
				'start_status' => 0,
				'end_status' => 0,
				'status' => 'pending',
			);

			$iwhere = array('project_id' => $project_id, 'candidate_id' => $candidate_id);

			if ($this->interview_model->resetInterview($where) && $this->interview_model->updateInviteInterview($ivalue, $iwhere)) {
				$cwhere = array('candidate_id' => $candidate_id);
				$cvalue = array('status' => 1);
				if ($this->candidate_model->updateCandidate($cvalue, $cwhere)) {
					// Send Mail
					$candidate = $this->candidate_model->getCandidateDetails($candidate_id);

					$subject = 'Login Credentials';
					$message = "Your Login Credentials are," . "<br><br>";
					$message .= "Login ID : <strong>" . $candidate->email . "</strong><br>";
					$message .= "Password : <strong>" . base64_decode($candidate->password) . "</strong><br>";

					$mail = new Mail();
					$mail->setTo($candidate->email);
					$mail->setFrom('info@e-interview.co.za');
					$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
					$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
					$mail->send();

					$this->session->set_flashdata('success', 'Interview Reset Successfull.');
				} else {
					$this->session->set_flashdata('danger', 'Interview Reset Failed.');
				}
			} else {
				$this->session->set_flashdata('danger', 'Interview Reset Failed.');
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	public function rejectInterview($interview_id = '', $candidate_id = '') {
		if (!empty($interview_id) || !empty($candidate_id)) {
			$where = array('interview_id' => $interview_id);
			$value = array('status' => 3);
			if ($this->interview_model->rejectInterview($value, $where)) {
				$cwhere = array('candidate_id' => $candidate_id);
				$cvalue = array('status' => 0);
				if ($this->candidate_model->updateCandidate($cvalue, $cwhere)) {
					$this->session->set_flashdata('success', 'Interview Rejected Successfull.');

					$client_name = @$this->hr_model->getHrByCandidate($candidate_id)['name'];
					$candidate_name = $this->candidate_model->getCandidateNameByID($candidate_id);
					$candidate_email = $this->candidate_model->getCandidateEmailByID($candidate_id);

					$subject = 'e-Interview Rejection';
					$message = "Dear, " . $candidate_name . "<br><br>";
					$message .= "Thank you for taking the time to complete the e-interview. We have enjoyed learning more about you." . "<br><br>";
					$message .= "We regret to advise you that after careful consideration we must advise that you have not been successful on this occasion. We would like to thank you for the interest you have shown in the post." . "<br><br>";
					$message .= "With best wishes as you continue your search for the right post and may we take this opportunity to wish you every success in your career." . "<br><br>";
					$message .= "Yours sincerely," . "<br>";
					$message .= $client_name;

					$mail = new Mail();
					$mail->setTo($candidate_email);
					$mail->setFrom('info@e-interview.co.za');
					$mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
					$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					$mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
					$mail->send();

				} else {
					$this->session->set_flashdata('danger', 'Interview Rejected Failed.');
				}
			} else {
				$this->session->set_flashdata('danger', 'Interview Rejected Failed.');
			}
		}
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

}
