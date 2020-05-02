<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credit_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getSystemCredit() {
		return $this->db->get('tbl_credit')->row()->credit;
	}

	public function getUserAvailableCredit($userId) {
		$query = $this->db->query("
            SELECT credits
            FROM tbl_client
            WHERE client_id = $userId
            ");
		$result = $query->result();
		if (!empty($result)) {
			return $result[0]->credits;
		}
		return false;
	}

	public function getRequestedCreditList($userId) {
		$query = $this->db->query("
            SELECT id, credit_request, credit_approved, status, created_at
            FROM tbl_credit_request
            WHERE status != 'deleted'
            AND fk_user_id = $userId
            ORDER BY id DESC
            ");
		return $query->result();
	}

	public function sendCreditRequest($post) {
		if (isset($post)) {
			$loggedinUser = $this->session->userdata['profile_id'];
			$client_where = array('client_id' => $loggedinUser);
			$client = $this->getClient($client_where);
			$requestTo = $client->admin_id;

			$userId = $loggedinUser;
			$creditRequest = trim($post['credit_request']);

			$userQuery = $this->db->query("
                    INSERT INTO
                    tbl_credit_request (fk_user_id, credit_request, fk_request_to_user_id)
                    VALUES ('$userId', '$creditRequest', '$requestTo') ");
			if ($userQuery) {
				return true;
			}
		}
		return false;
	}

	public function getCreditRequestList($user_id) {
		return $this->db->query("SELECT tbl_credit_request.id,tbl_credit_request.credit_request,tbl_credit_request.credit_approved,tbl_credit_request.status,tbl_credit_request.created_at, tbl_client.name, tbl_client.email
				FROM `tbl_credit_request`
				JOIN tbl_client on tbl_client.client_id = tbl_credit_request.fk_user_id
				WHERE fk_request_to_user_id = $user_id")->result();
	}

	public function approveCreditRequest($post) {
		if (isset($post)) {
			$loggedinUser = $this->session->userdata['profile_id'];
			$creditRequestId = trim($post['credit_request_id']);
			$creditApproved = trim($post['credit_approved']);
			$data = array(
				'credit_approved' => $creditApproved,
				'status' => 'approved',
				'last_updated_by' => $loggedinUser,
			);
			$this->db->where('id', $creditRequestId);
			$this->db->update('tbl_credit_request', $data);

			$userId = $this->getCreditRequestedUserId($creditRequestId);
			$this->db->set('credits', "credits+$creditApproved", FALSE);
			$this->db->where('client_id', $userId);
			$this->db->update('tbl_client');

			return true;
		}
		return false;
	}

	public function declineCreditRequest($id) {
		$loggedinUser = $this->session->userdata['profile_id'];
		$creditRequestId = trim($id);
		$data = array(
			'status' => 'declined',
			'last_updated_by' => $loggedinUser,
		);
		$this->db->where('id', $creditRequestId);
		$this->db->update('tbl_credit_request', $data);
		return true;
	}

	function getCreditRequestedUserId($id) {
		return $this->db->get_where('tbl_credit_request', array('id' => $id))->row()->fk_user_id;
	}

	function getClient($where) {
		return $this->db->get_where('tbl_client', $where)->row();
	}

	function isInterviewCredited($interview_id) {
		return $this->db->get_where('tbl_interview', array('interview_id' => $interview_id))->row()->is_credited;
	}

}

/* End of file Credit_model.php */
/* Location: .//C/Users/markw/AppData/Local/Temp/fz3temp-2/Credit_model.php */