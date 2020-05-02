<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Action_model extends CI_Model
{
    public function deleteRecord($id,$type)
    {
        if($id && $type)
        {
            $id = is_array($id) ? $id : array($id);

            if ($type == USER_DISTRIBUTOR)
            {
                $distributor_ids = null;
                $account_manager_ids = null;
                $manager_ids = null;
                $rater_ids = null;

                $distributor_list = $this->db->select('*')->from('tbl_distributor')->where_in('distributor_id', $id)->get()->result_array();
                $distributor_ids = !empty($distributor_list) ? array_map(function ($d) {
                    return $d['distributor_id'];
                }, $distributor_list) : array();
                $distributor_profile = !empty($distributor_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', 'DISTRIBUTOR')->where_in('profile_id', $distributor_ids)->get()->result_array() : array();
                $distributor_profile_ids = !empty($distributor_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $distributor_profile) : array();
                $this->db->flush_cache();

                $account_manager_list = !empty($distributor_profile_ids) ? $this->db->select('*')->from('tbl_account_manager')->where_in('distributor_id', $distributor_profile_ids)->get()->result_array() : array();
                $account_manager_ids = !empty($account_manager_list) ? array_map(function ($d) {
                    return $d['account_manager_id'];
                }, $account_manager_list) : array();
                $account_manager_profile = !empty($account_manager_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', 'ACCOUNT MANAGER')->where_in('profile_id', $account_manager_ids)->get()->result_array() : array();
                $account_manager_profile_ids = !empty($account_manager_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $account_manager_profile) : array();
                $this->db->flush_cache();


                $manager_list = !empty($account_manager_profile_ids) ? $this->db->select('*')->from('tbl_manager')->where_in('account_manager_id', $account_manager_profile_ids)->get()->result_array() : array();
                $manager_ids = !empty($manager_list) ? array_map(function ($d) {
                    return $d['manager_id'];
                }, $manager_list) : array();
                $manager_profile = !empty($manager_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', 'MANAGER')->where_in('profile_id', $manager_ids)->get()->result_array() : array();
                $manager_profile_ids = !empty($manager_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $manager_profile) : array();
                $this->db->flush_cache();


                $rater_list = !empty($manager_profile_ids) ? $this->db->select('*')->from('tbl_rater')->where_in('manager_id', $manager_profile_ids)->get()->result_array() : array();
                $rater_ids = !empty($rater_list) ? array_map(function ($d) {
                    return $d['rater_id'];
                }, $rater_list) : array();
                $rater_profile = !empty($rater_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', 'RATER')->where_in('profile_id', $rater_ids)->get()->result_array() : array();
                $rater_profile_ids = !empty($rater_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $rater_profile) : array();
                $this->db->flush_cache();


                $candidate_list = !empty($manager_profile_ids) ? $this->db->select('*')->from('tbl_candidate')->where_in('manager_id', $manager_profile_ids)->get()->result_array() : array();
                $candidate_ids = !empty($candidate_list) ? array_map(function ($d) {
                    return $d['candidate_id'];
                }, $candidate_list) : array();

                $candidate_profile = !empty($candidate_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', USER_CANDIDATE)->where_in('profile_id', $candidate_ids)->get()->result_array() : array();
                $candidate_profile_ids = !empty($candidate_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $candidate_profile) : array();

                $this->db->flush_cache();

                $upd_data = array('status' => STATUS_DELETE);

                if(!empty($distributor_ids)){
                    $this->db->where_in('distributor_id', $distributor_ids)->update('tbl_distributor', $upd_data);
                    $this->db->flush_cache();
                }

                if(!empty($account_manager_ids)) {
                    $this->db->where_in('account_manager_id', $account_manager_ids)->update('tbl_account_manager', $upd_data);
                    $this->db->flush_cache();
                }

                if(!empty($manager_ids)) {
                    $this->db->where_in('manager_id', $manager_ids)->update('tbl_manager', $upd_data);
                    $this->db->flush_cache();
                }

                if(!empty($rater_ids)) {
                    $this->db->where_in('rater_id', $rater_ids)->update('tbl_rater', $upd_data);
                    $this->db->flush_cache();
                }

                if(!empty($candidate_ids)) {
                    $this->db->where_in('candidate_id', $candidate_ids)->update('tbl_candidate', $upd_data);
                    $this->db->flush_cache();
                }
            }

            if ($type == USER_ACCOUNTMANAGER)
            {
                $account_manager_ids = null;
                $manager_ids = null;
                $rater_ids = null;

                $account_manager_list = $this->db->select('*')->from('tbl_account_manager')->where_in('account_manager_id', $id)->get()->result_array();
                $account_manager_ids = !empty($account_manager_list) ? array_map(function ($d) {
                    return $d['account_manager_id'];
                }, $account_manager_list) : array();
                $account_manager_profile = !empty($account_manager_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', 'ACCOUNT MANAGER')->where_in('profile_id', $account_manager_ids)->get()->result_array() : array();
                $account_manager_profile_ids = !empty($account_manager_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $account_manager_profile) : array();
                $this->db->flush_cache();


                $manager_list = !empty($account_manager_profile_ids) ? $this->db->select('*')->from('tbl_manager')->where_in('account_manager_id', $account_manager_profile_ids)->get()->result_array() : array();
                $manager_ids = !empty($manager_list) ? array_map(function ($d) {
                    return $d['manager_id'];
                }, $manager_list) : array();
                $manager_profile = !empty($manager_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', 'MANAGER')->where_in('profile_id', $manager_ids)->get()->result_array() : array();
                $manager_profile_ids = !empty($manager_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $manager_profile) : array();
                $this->db->flush_cache();


                $rater_list = !empty($manager_profile_ids) ? $this->db->select('*')->from('tbl_rater')->where_in('manager_id', $manager_profile_ids)->get()->result_array() : array();
                $rater_ids = !empty($rater_list) ? array_map(function ($d) {
                    return $d['rater_id'];
                }, $rater_list) : array();
                $rater_profile = !empty($rater_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', 'RATER')->where_in('profile_id', $rater_ids)->get()->result_array() : array();
                $rater_profile_ids = !empty($rater_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $rater_profile) : array();
                $this->db->flush_cache();


                $candidate_list = !empty($manager_profile_ids) ? $this->db->select('*')->from('tbl_candidate')->where_in('manager_id', $manager_profile_ids)->get()->result_array() : array();
                $candidate_ids = !empty($candidate_list) ? array_map(function ($d) {
                    return $d['candidate_id'];
                }, $candidate_list) : array();

                $candidate_profile = !empty($candidate_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', USER_CANDIDATE)->where_in('profile_id', $candidate_ids)->get()->result_array() : array();
                $candidate_profile_ids = !empty($candidate_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $candidate_profile) : array();

                $this->db->flush_cache();

                $upd_data = array('status' => STATUS_DELETE);

                if(!empty($account_manager_ids)) {
                    $this->db->where_in('account_manager_id', $account_manager_ids)->update('tbl_account_manager', $upd_data);
                    $this->db->flush_cache();
                }

                if(!empty($manager_ids)) {
                    $this->db->where_in('manager_id', $manager_ids)->update('tbl_manager', $upd_data);
                    $this->db->flush_cache();
                }

                if(!empty($rater_ids)) {
                    $this->db->where_in('rater_id', $rater_ids)->update('tbl_rater', $upd_data);
                    $this->db->flush_cache();
                }

                if(!empty($candidate_ids)) {
                    $this->db->where_in('candidate_id', $candidate_ids)->update('tbl_candidate', $upd_data);
                    $this->db->flush_cache();
                }

            }

            if ($type == USER_MANAGER)
            {
                $manager_ids = null;
                $rater_ids = null;

                $manager_list = $this->db->select('*')->from('tbl_manager')->where_in('manager_id', $id)->get()->result_array();
                $manager_ids = !empty($manager_list) ? array_map(function ($d) {
                    return $d['manager_id'];
                }, $manager_list) : array();
                $manager_profile = !empty($manager_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', 'MANAGER')->where_in('profile_id', $manager_ids)->get()->result_array() : array();
                $manager_profile_ids = !empty($manager_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $manager_profile) : array();
                $this->db->flush_cache();


                $rater_list = !empty($manager_profile_ids) ? $this->db->select('*')->from('tbl_rater')->where_in('manager_id', $manager_profile_ids)->get()->result_array() : array();
                $rater_ids = !empty($rater_list) ? array_map(function ($d) {
                    return $d['rater_id'];
                }, $rater_list) : array();
                $rater_profile = !empty($rater_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', 'RATER')->where_in('profile_id', $rater_ids)->get()->result_array() : array();
                $rater_profile_ids = !empty($rater_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $rater_profile) : array();
                $this->db->flush_cache();


                $candidate_list = !!empty($manager_profile_ids) ? $this->db->select('*')->from('tbl_candidate')->where_in('manager_id', $manager_profile_ids)->get()->result_array() : array();
                $candidate_ids = !empty($candidate_list) ? array_map(function ($d) {
                    return $d['candidate_id'];
                }, $candidate_list) : array();

                $candidate_profile = !empty($candidate_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', USER_CANDIDATE)->where_in('profile_id', $candidate_ids)->get()->result_array() : array();
                $candidate_profile_ids = !empty($candidate_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $candidate_profile) : array();

                $this->db->flush_cache();

                $upd_data = array('status' => STATUS_DELETE);


                if(!empty($manager_ids)) {
                    $this->db->where_in('manager_id', $manager_ids)->update('tbl_manager', $upd_data);
                    $this->db->flush_cache();
                }

                if(!empty($rater_ids)) {
                    $this->db->where_in('rater_id', $rater_ids)->update('tbl_rater', $upd_data);
                    $this->db->flush_cache();
                }

                if(!empty($candidate_ids)) {
                    $this->db->where_in('candidate_id', $candidate_ids)->update('tbl_candidate', $upd_data);
                    $this->db->flush_cache();
                }
            }


            if($type == USER_RATER)
            {
                $rater_ids = null;

                $rater_list = $this->db->select('*')->from('tbl_rater')->where_in('rater_id', $id)->get()->result_array();
                $rater_ids = !empty($rater_list) ? array_map(function ($d) {
                    return $d['rater_id'];
                }, $rater_list) : array();
                $rater_profile = !empty($rater_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', 'RATER')->where_in('profile_id', $rater_ids)->get()->result_array() : array();
                $rater_profile_ids = !empty($rater_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $rater_profile) : array();
                $this->db->flush_cache();


                $upd_data = array('status' => STATUS_DELETE);

                if(!empty($rater_ids)) {
                    $this->db->where_in('rater_id', $rater_ids)->update('tbl_rater', $upd_data);
                    $this->db->flush_cache();
                }
            }


            if ($type == USER_CANDIDATE)
            {
                $candidate_list = $this->db->select('*')->from('tbl_candidate')->where_in('candidate_id', $id)->get()->result_array();
                $candidate_ids = !empty($candidate_list) ? array_map(function ($d) {
                    return $d['candidate_id'];
                }, $candidate_list) : array();

                $candidate_profile = !empty($candidate_ids) ? $this->db->select('*')->from('tbl_auth')->where('type', USER_CANDIDATE)->where_in('profile_id', $candidate_ids)->get()->result_array() : array();
                $candidate_profile_ids = !empty($candidate_profile) ? array_map(function ($d) {
                    return $d['auth_id'];
                }, $candidate_profile) : array();

                $this->db->flush_cache();

                $upd_data = array('status' => STATUS_DELETE);

                if(!empty($candidate_ids)) {
                    $this->db->where_in('candidate_id', $candidate_ids)->update('tbl_candidate', $upd_data);
                    $this->db->flush_cache();
                }
            }

        }

    }
}

/*
for delete other data if required -
$job_profile_list = $this->db->select('*')->from('tbl_job_profile')->where_in('manager_id', $manager_profile_ids)->get()->result_array();
$this->db->flush_cache();

$project_list = $this->db->select('*')->from('tbl_project')->where_in('manager_id', $manager_profile_ids)->get()->result_array();
$this->db->flush_cache();

$email_template_list = $this->db->select('*')->from('tbl_email_template')->where_in('client_id', $manager_profile_ids)->get()->result_array();
$this->db->flush_cache();

*/

?>