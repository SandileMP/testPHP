<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credit extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Credit_model', 'cm');
		$this->load->model('account_manager_model');
		$this->load->model('project_model');
		$this->load->model('interview_model');
		if (!$this->checkLogin()) {
			redirect(base_url());
		}
	}

	public function managecredit() {
		if ($this->session->userdata['user_type'] != 'DISTRIBUTOR' && $this->session->userdata['user_type'] != 'ACCOUNT MANAGER') {
			redirect(base_url());
		}
		if($this->session->userdata['user_type'] == 'ACCOUNT MANAGER'){
			$userId = $this->session->userdata['profile_id'];
			$data['title'] = 'Manage Credit';
			$data['userCredit'] = $this->cm->getUserAvailableCredit($userId);
			$data['creditResult'] = $this->cm->getRequestedCreditList($userId);
		}else if($this->session->userdata['user_type'] == 'DISTRIBUTOR'){
			$userId = $this->session->userdata['profile_id'];
			$data['title'] = 'Manage Credit';
			$data['userCredit'] = $this->cm->getDistributorAvailableCredit($userId);
			$data['creditResult'] = $this->cm->getDistributorRequestedCreditList($userId);
		}
		$this->app->view('view_credit_request', $data);
	}

	public function sendcreditrequest() {
		if ($this->session->userdata['user_type'] != 'DISTRIBUTOR' && $this->session->userdata['user_type'] != 'ACCOUNT MANAGER') {
			redirect(base_url());
		}
		$post = $this->input->post();
		if ($post && $this->session->userdata['user_type'] == 'ACCOUNT MANAGER') {
			if ($this->cm->sendCreditRequest($post)) {
				$this->session->set_flashdata('msg_success', 'Credit request send successfully.');
			} else {
				$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
			}
		}else if($post && $this->session->userdata['user_type'] == 'DISTRIBUTOR'){
			if ($this->cm->sendDistributorCreditRequest($post)) {
				$this->session->set_flashdata('msg_success', 'Credit request send successfully.');
			} else {
				$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
			}	
		}
		return redirect('credit/managecredit');
	}

	public function managecreditrequest() {
		if ($this->session->userdata['user_type'] != 'ADMIN' && $this->session->userdata['user_type'] != 'DISTRIBUTOR') {
			redirect(base_url());
		}
		$userId = $this->session->userdata['user'];
		$profile_id = $this->session->userdata['profile_id'];
		$data['title'] = 'Manage Credit Request';
		$filter = $this->input->get();
		if($this->session->userdata['user_type'] == 'ADMIN') {
			$data['creditResult'] = $this->cm->getDistributorCreditRequestList($userId,$filter);
		}else if($this->session->userdata['user_type'] == 'DISTRIBUTOR'){
			$data['userCredit'] = $this->cm->getDistributorAvailableCredit($profile_id);
			$data['creditResult'] = $this->cm->getCreditRequestList($userId,$filter);
		}
		$this->app->view('credit-request', $data);
	}

	public function approvecreditrequest() {
		if ($this->session->userdata['user_type'] != 'ADMIN' && $this->session->userdata['user_type'] != 'DISTRIBUTOR') {
			redirect(base_url());
		}
		$post = $this->input->post();
		if ($post && $this->session->userdata['user_type'] == 'ADMIN') {
			if ($this->cm->approveDistributorCreditRequest($post)) {
				$this->session->set_flashdata('msg_success', 'Credit request approved successfully.');
			} else {
				$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
			}
		}else if($post && $this->session->userdata['user_type'] == 'DISTRIBUTOR'){
			$profile_id = $this->session->userdata['profile_id'];
			$remain_credit = $this->cm->getDistributorAvailableCredit($profile_id);
			if($remain_credit < $post['credit_approved']){
				$this->session->set_flashdata('msg_error', 'You do not have sufficient credits. Please request more credits or allocate less credits.');
			}else{
				if ($this->cm->approveCreditRequest($post)) {
					$this->session->set_flashdata('msg_success', 'Credit request approved successfully.');
				} else {
					$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
				}
			}
		}
		return redirect('credit/managecreditrequest');
	}

	public function declinecreditrequest($id) {
		if ($this->session->userdata['user_type'] != 'ADMIN' && $this->session->userdata['user_type'] != 'DISTRIBUTOR') {
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
					$mclient = $this->account_manager_model->getAccountManager($mclient_id);
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
