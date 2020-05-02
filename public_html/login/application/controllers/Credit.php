<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credit extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Credit_model', 'cm');
		$this->load->model('hr_model');
		$this->load->model('project_model');
		$this->load->model('interview_model');
		if (!$this->checkLogin()) {
			redirect(base_url());
		}
	}

	public function managecredit() {
		if ($this->session->userdata['user_type'] != 'CLIENT') {
			redirect(base_url());
		}
		$userId = $this->session->userdata['profile_id'];
		$data['title'] = 'Manage Credit';
		$data['userCredit'] = $this->cm->getUserAvailableCredit($userId);
		$data['creditResult'] = $this->cm->getRequestedCreditList($userId);
		$this->app->view('view_credit_request', $data);
	}

	public function sendcreditrequest() {
		if ($this->session->userdata['user_type'] != 'CLIENT') {
			redirect(base_url());
		}
		$post = $this->input->post();
		if ($post) {
			if ($this->cm->sendCreditRequest($post)) {
				$this->session->set_flashdata('msg_success', 'Credit request send successfully.');
			} else {
				$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
			}
		}
		return redirect('credit/managecredit');
	}

	public function managecreditrequest() {
		if ($this->session->userdata['user_type'] != 'ADMIN') {
			redirect(base_url());
		}
		$userId = $this->session->userdata['user'];
		$data['title'] = 'Manage Credit Request';
		$data['creditResult'] = $this->cm->getCreditRequestList($userId);
		$this->app->view('credit-request', $data);
	}

	public function approvecreditrequest() {
		if ($this->session->userdata['user_type'] != 'ADMIN') {
			redirect(base_url());
		}
		$post = $this->input->post();
		if ($post) {
			if ($this->cm->approveCreditRequest($post)) {
				$this->session->set_flashdata('msg_success', 'Credit request approved successfully.');
			} else {
				$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
			}
		}
		return redirect('credit/managecreditrequest');
	}

	public function declinecreditrequest($id) {
		if ($this->session->userdata['user_type'] != 'ADMIN') {
			redirect(base_url());
		}
		if ($this->cm->declineCreditRequest($id)) {
			$this->session->set_flashdata('msg_success', 'Credit request declined successfully.');
		}
		$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
		return redirect('credit/managecreditrequest');
	}

	private function checkLogin() {
		if (isset($this->session->userdata['user'])) {
			return true;
		} else {
			return false;
		}
	}

	// Deduct Credit

	public function deductAjaxCredit() {
		if (count($_POST) > 0) {
			$interview_id = $this->input->post('interview_id');
			$mclient_id = $this->input->post('client_id');
			if (!empty($mclient_id) && !empty($interview_id)) {
				if ($this->cm->isInterviewCredited($interview_id) == 0) {
					$sys_credit = $this->cm->getSystemCredit();
					$mclient = $this->hr_model->getHr($mclient_id);
					$mclient_credit = $mclient['credits'];
					if ($mclient_credit < $sys_credit) {
						echo "0";
					} else {
						if ($this->project_model->deductCredit($mclient_id)) {
							$where = array('interview_id' => $interview_id);
							$value = array('is_credited' => 1);
							if ($this->interview_model->mupdateInterview($value, $where)) {
								echo "1";
							} else {
								echo "3";
							}
						} else {
							echo "3";
						}
					}
				} else {
					echo "1";
				}

			} else {
				echo "3";
			}
		} else {
			echo "3";
		}
	}

}

/* End of file Credit 2.php */
/* Location: .//C/Users/markw/AppData/Local/Temp/fz3temp-2/Credit 2.php */