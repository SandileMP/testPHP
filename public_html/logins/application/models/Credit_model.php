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
            FROM tbl_account_manager
            WHERE account_manager_id = $userId
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->credits;
        }
        return false;
    }
    public function getDistributorAvailableCredit($userId) {
        $query = $this->db->query("
            SELECT credits
            FROM tbl_distributor
            WHERE distributor_id = $userId
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
    public function getDistributorRequestedCreditList($userId) {
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
            $client_where = array('account_manager_id' => $loggedinUser);
            $client = $this->getClient($client_where);
            $requestTo = $client->distributor_id;

            $userId = $loggedinUser;
            $creditRequest = trim($post['credit_request']);

            $userQuery = $this->db->query("
                    INSERT INTO
                    tbl_credit_request (fk_user_id, credit_request, fk_request_to_user_id)
                    VALUES ('$userId', '$creditRequest', '$requestTo') ");
            if ($userQuery) {
                $this->sendCreditRequestMail($requestTo);
                return true;
            }
        }
        return false;
    }
    public function sendDistributorCreditRequest($post) {
        if (isset($post)) {
            $loggedinUser = $this->session->userdata['profile_id'];
            $distributor_where = array('distributor_id' => $loggedinUser);
            $client = $this->getDistributor($distributor_where);
            $requestTo = $client->admin_id;

            $userId = $loggedinUser;
            $creditRequest = trim($post['credit_request']);

            $userQuery = $this->db->query("
                    INSERT INTO
                    tbl_credit_request (fk_user_id, credit_request, fk_request_to_user_id)
                    VALUES ('$userId', '$creditRequest', '$requestTo') ");
            if ($userQuery) {
                $this->sendCreditRequestMail($requestTo);
                return true;
            }
        }
        return false;
    }

    public function getDistributorCreditRequestList($user_id,$filter=array()) {
		$credit_query = "SELECT tbl_credit_request.id,tbl_credit_request.credit_request,tbl_credit_request.credit_approved,tbl_credit_request.status,tbl_credit_request.created_at, tbl_distributor.name, tbl_distributor.email
				FROM `tbl_credit_request`
				JOIN tbl_distributor on tbl_distributor.distributor_id = tbl_credit_request.fk_user_id
				WHERE fk_request_to_user_id = $user_id";


		if (isset($filter['name']) && $filter['name']){
			$credit_query .= " AND (tbl_distributor.name LIKE '%".$filter['name']."%' OR tbl_distributor.email LIKE '%".$filter['name']."%')";
		}

        if (isset($filter['credit_request']) && $filter['credit_request']){
			$credit_query .= " AND tbl_credit_request.credit_request = ".$filter['credit_request'];
		}

        if (isset($filter['credit_approved']) && $filter['credit_approved']){
			$credit_query .= " AND tbl_credit_request.credit_approved = ".$filter['credit_approved'];
		}

        if (isset($filter['date_from']) && $filter['date_from']){
			$filter['date_from'] = strtotime($filter['date_from']);
			$filter['date_from'] = date('Y-m-d',$filter['date_from']).' 00:00:00';

			$credit_query .= " AND tbl_credit_request.created_at >= '".$filter['date_from']."'";
		}

        if (isset($filter['date_to']) && $filter['date_to']){

			$filter['date_to'] = strtotime($filter['date_to']);
			$filter['date_to'] = date('Y-m-d',$filter['date_to']).' 11:59:59';

			$credit_query .= " AND tbl_credit_request.created_at <= '".$filter['date_to']."'";
		}

        if (isset($filter['status']) && $filter['status']){
			$credit_query .= " AND tbl_credit_request.status = '".$filter['status']."'";
		}

        return $this->db->query($credit_query)->result();
    }

    public function getCreditRequestList($user_id,$filter=array()) {
        $credit_query = "SELECT tbl_credit_request.id,tbl_credit_request.credit_request,tbl_credit_request.credit_approved,tbl_credit_request.status,tbl_credit_request.created_at, tbl_account_manager.name, tbl_account_manager.email
				FROM `tbl_credit_request`
				JOIN tbl_account_manager on tbl_account_manager.account_manager_id = tbl_credit_request.fk_user_id
				WHERE fk_request_to_user_id = $user_id";

		if (isset($filter['name']) && $filter['name']){
			$credit_query .= " AND (tbl_account_manager.name LIKE '%".$filter['name']."%' OR tbl_account_manager.email LIKE '%".$filter['name']."%')";
		}

		if (isset($filter['credit_request']) && $filter['credit_request']){
			$credit_query .= " AND tbl_credit_request.credit_request = ".$filter['credit_request'];
		}

		if (isset($filter['credit_approved']) && $filter['credit_approved']){
			$credit_query .= " AND tbl_credit_request.credit_approved = ".$filter['credit_approved'];
		}

		if (isset($filter['date_from']) && $filter['date_from']){
			$filter['date_from'] = strtotime($filter['date_from']);
			$filter['date_from'] = date('Y-m-d',$filter['date_from']).' 00:00:00';
			$credit_query .= " AND tbl_credit_request.created_at >= '".$filter['date_from']."'";
		}

		if (isset($filter['date_to']) && $filter['date_to']){

			$filter['date_to'] = strtotime($filter['date_to']);
			$filter['date_to'] = date('Y-m-d',$filter['date_to']).' 11:59:59';

			$credit_query .= " AND tbl_credit_request.created_at <= '".$filter['date_to']."'";
		}

		if (isset($filter['status']) && $filter['status']){
			$credit_query .= " AND tbl_credit_request.status = '".$filter['status']."'";
		}
		
		return $this->db->query($credit_query)->result();


    }

    public function approveDistributorCreditRequest($post) {
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
            $this->db->where('distributor_id', $userId);
            $this->db->update('tbl_distributor');

            $this->approveCreditRequestMail($userId,'DISTRIBUTOR');

            return true;
        }
        return false;
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
            $this->db->where('account_manager_id', $userId);
            $this->db->update('tbl_account_manager');

            $this->db->set('credits', "credits-$creditApproved", FALSE);
            $this->db->where('distributor_id', $loggedinUser);
            $this->db->update('tbl_distributor');

            $this->approveCreditRequestMail($userId,'ACCOUNT MANAGER');

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

        if($this->session->userdata('user_type') == 'ADMIN')
        {
            $userId = $this->getCreditRequestedUserId($id);
            $this->approveCreditRequestMail($userId,'DISTRIBUTOR');
        }

        if($this->session->userdata('user_type') == 'ADMIN')
        {
            $userId = $this->getCreditRequestedUserId($id);
            $this->approveCreditRequestMail($userId,'ACCOUNT MANAGER');
        }

        return true;
    }

    function getCreditRequestedUserId($id) {
        return $this->db->get_where('tbl_credit_request', array('id' => $id))->row()->fk_user_id;
    }

    function getClient($where) {
        return $this->db->get_where('tbl_account_manager', $where)->row();
    }

    function getDistributor($where) {
        return $this->db->get_where('tbl_distributor', $where)->row();
    }

    function isInterviewCredited($interview_id) {
        return $this->db->get_where('tbl_interview', array('interview_id' => $interview_id))->row()->is_credited;
    }


    function sendCreditRequestMail($user_id)
    {
        $this->load->model('Auth_model');
        $this->load->library('mail');

        $user = $this->Auth_model->getAuth($user_id);

        if($user && isset($user['email']) && $user['email']) {

            $subject = "E-Interview: Credit Request Received";
            $email = $user['email'];

            $message = "Dear User,";
            $message .= "<br><br>";
            $message .= "Please note that there has been a credit request logged on your account.";
            $message .= "<br><br>";
            $message .= "Kindly log into you account to approve or decline the request.";
            $message .= "<br><br>";
            $message .= "Kind Regards,";
            $message .= "<br><br>";
            $message .= "E-Interview";
            $message .= "<br><br>";

            $mail = new Mail();
            $mail->setTo($email);
            $mail->setFrom('info@e-interview.co.za');
            $mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
            $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
            $mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
            $mail->send();
        }

        return true;
    }


    function approveCreditRequestMail($user_id,$type)
    {
        $this->load->model('Auth_model');
        $this->load->library('mail');

        $user = $this->Auth_model->getAuthByTypeAndId($user_id,$type);

        if($user && isset($user['email']) && $user['email']) {

            $subject = "E-interview: Credit request update";
            $email = $user['email'];

            $message = "Dear User,";
            $message .= "<br><br>";
            $message .= "Please note that you credit request has been approved.";
            $message .= "<br><br>";
            $message .= "Kindly log in to your system for a full update or contact the person you requested credits from for more information.";
            $message .= "<br><br>";
            $message .= "Kind Regards,";
            $message .= "<br><br>";
            $message .= "E-Interview";
            $message .= "<br><br>";

            $mail = new Mail();
            $mail->setTo($email);
            $mail->setFrom('info@e-interview.co.za');
            $mail->setSender(html_entity_decode('e-interview', ENT_QUOTES, 'UTF-8'));
            $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
            $mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
            $mail->send();
        }

        return true;
    }

    function getCreditInfo($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_credit_request');
        $this->db->where('id', $id);
        $data = $this->db->get()->row_array();

        return $data;
    }

}

/* End of file Credit_model.php */
/* Location: .//C/Users/markw/AppData/Local/Temp/fz3temp-2/Credit_model.php */
