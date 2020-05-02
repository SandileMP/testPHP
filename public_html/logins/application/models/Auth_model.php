<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Auth_model extends CI_Model {
	public function checkDetail($email, $password) {
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		$this->db->where('type !=', 'CANDIDATE');
		$this->db->where('password', base64_encode($password));
		$data = $this->db->get()->row_array();

		if(!$data)
		{
			$this->db->select('*');
			$this->db->from('tbl_auth');
			$this->db->where('email', $email);
			$this->db->where('password', base64_encode($password));
			$data = $this->db->get()->row_array();
		}


		if ($data) {
			if ($data['type'] == 'DISTRIBUTOR') {
				$distributor = $this->db->query("SELECT status FROM tbl_distributor WHERE status = 1 AND email like '" . $data['email'] . "' AND distributor_id = '" . $data['profile_id'] . "'")->num_rows();
				if ($distributor == 1) {
					return $data;
				}
			} else if ($data['type'] == 'ACCOUNT MANAGER') {
				$account_manager = $this->db->query("SELECT status FROM tbl_account_manager WHERE status = 1 AND email like '" . $data['email'] . "' AND account_manager_id = '" . $data['profile_id'] . "'")->num_rows();
				if ($account_manager == 1) {
					return $data;
				}
			} else if ($data['type'] == 'MANAGER') {
				$manager = $this->db->query("SELECT status FROM tbl_manager WHERE status = 1 AND email like '" . $data['email'] . "' AND manager_id = '" . $data['profile_id'] . "'")->num_rows();
				if ($manager == 1) {
					return $data;
				}
			} else if ($data['type'] == 'RATER') {
				$manager = $this->db->query("SELECT status FROM tbl_rater WHERE status = 1 AND email like '" . $data['email'] . "' AND rater_id = '" . $data['profile_id'] . "'")->num_rows();
				if ($manager == 1) {
					return $data;
				}
			} else {
				return $data;
			}
		}
	}
	public function checkForgotEmailDetail($email = '', $account = '') {
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		if($account){
			$this->db->where('type', $account);
		}
		$data = $this->db->get()->result();
		return json_decode(json_encode($data), true);
	}
	public function getAllAuths() {
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$data = $this->db->get()->result();
		if ($data) {return (array) $data;}
	}
	public function getAuths($type = '') {
		$this->db->select('*');
		$this->db->where('type', $type);
		$this->db->from('tbl_auth');
		$data = $this->db->get()->result();
		if ($data) {return (array) $data;}
	}
	public function getAuth($auth_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id', $auth_id);
		$data = $this->db->get()->result();
		if ($data) {return (array) $data[0];}
	}
	public function getAuthByCandidateID($candidate_id = '') {
		$this->db->select('auth_id');
		$this->db->from('tbl_auth');
		$this->db->where('profile_id', $candidate_id);
		$this->db->where('type', 'CANDIDATE');
		$data = $this->db->get()->row_array();
		if ($data) {return $data['auth_id'];}
	}
	public function getManagerEmailByID($auth_id = '') {
		$this->db->select('email');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id', $auth_id);
		$this->db->where('type', 'MANAGER');
		$data = $this->db->get()->row_array();
		if ($data) {return $data['email'];}
	}
	public function getClientByID($auth_id = '') {
		$this->db->select('c.account_manager,c.name');
		$this->db->from('tbl_auth as a');
		$this->db->join('tbl_account_manager as c', 'c.account_manager_id = a.profile_id');
		$this->db->where('a.auth_id', $auth_id);
		$this->db->where('a.type', 'ACCOUNT MANAGER');
		$data = $this->db->get()->row_array();
		if ($data) {return $data;}
	}
	public function addAuth($data = array(), $auth_type = array()) {
		$add = array(
			'auth_id' => '',
			'name' => $data['auth_name'],
			'email' => $data['auth_email'],
			'password' => base64_encode($auth_type['password']),
			'type' => $auth_type['auth_type'],
		);
		return $this->db->insert('tbl_auth', $add);
	}
	public function updateAuth($auth_id = '', $data = array()) {
		$this->db->select('password');
		$this->db->where('auth_id', $auth_id);
		$this->db->from('tbl_auth');
		$old_password = $this->db->get()->result()[0]->password;
		$update = array(
			'name' => $data['auth_name'],
			'email' => $data['auth_email'],
			'password' => base64_encode($data['auth_password']),
		);
		$this->db->where('auth_id', $auth_id);
		$this->db->update('tbl_auth', $update);
		if ($old_password != $data['auth_password']) {
			return true;
		} else {
			return false;
		}
	}
	public function removeAuth($auth_id = '') {
		$this->db->where('auth_id', $auth_id);
		$this->db->delete('tbl_auth');

		$this->db->where('manager', $auth_id);
		$this->db->delete('tbl_project');
	}
	public function getManagers() {
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('TYPE', 'MANAGER');
		$data = $this->db->get()->result();
		if ($data) {return (array) $data;}
	}
	public function getManager($manager_id = '') {
		$this->db->select('name');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id', $manager_id);
		$data = $this->db->get()->result()[0]->name;
		if ($data) {return $data;}
	}
	public function updateAuthProfile($data = array(), $auth_id) {
		$update = array(
			'name' => $data['name'],
			'email' => $data['email'],
		);
		$this->db->where('auth_id', $auth_id);
		$this->db->update('tbl_auth', $update);
	}
	public function updatePassword($data = array(), $auth_id) {
		$update = array(
			'password' => base64_encode($data['new_password']),
		);
		$this->db->where('auth_id', $auth_id);
		$this->db->update('tbl_auth', $update);

		$user = $this->getUserByAuthId($auth_id);

		if($user){
			$this->db->where('email', $user['email']);
			$this->db->where('type !=', 'CANDIDATE');
			$this->db->update('tbl_auth', $update);

		}
	}
	public function getAuthProfile($auth_id) {
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id', $auth_id);
		$data = $this->db->get()->result();
		if ($data) {return (array) $data[0];}
	}
	public function checkEmail($email) {
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		$data = $this->db->get()->result();
		if ($data) {return (array) $data[0];}
	}


    public function getAuthByTypeAndId($id,$type) {
        $this->db->select('*');
        $this->db->from('tbl_auth');
        $this->db->where('profile_id', $id);
        $this->db->where('type', $type);
        $data = $this->db->get()->row_array();
        if ($data) {return $data;}
    }


	public function getRoleList($email) {
		$role = array();
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('email', $email);
		$this->db->where('type !=', 'CANDIDATE');
		$this->db->where('type !=', 'ADMIN');
		$data = $this->db->get()->result_array();

		if($data){
			foreach ($data as $dataInfo){
				$role[$dataInfo['type']] = $dataInfo['type'];
			}
		}

		return $role;
	}

	public function getUserByAuthId($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('auth_id', $id);
		$data = $this->db->get()->row_array();
		return $data;
	}

	public function getUserByRole($role, $activeId)
	{
		$user = $this->getUserByAuthId($activeId);

		$this->db->select('*');
		$this->db->from('tbl_auth');
		$this->db->where('email', $user['email']);
		$this->db->where('type', $role);
		$data = $this->db->get()->row_array();

		return $data;
	}

	public function getAndSetPassword($email)
	{
		$new_password = '';
		if($email){
			$new_password = $this->generate_password();
			$new_password = base64_encode($new_password);
			$this->db->where('email', $email);
			$this->db->where('type !=', 'CANDIDATE');
			$this->db->update('tbl_auth', array('password' => $new_password));
		}
		return $new_password;
	}

	public function generate_password()
	{
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
		while ($i <= 7) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}


	public function registerWithRole($email, $role)
	{
		$data = $this->db->select('*')->from('tbl_auth')->where('email', $email)->where('type', $role)->row_array();

		if(!$data || empty($data))
		{
			$user = $this->db->select('*')->from('tbl_auth')->where('email', $email)->where('type !=', 'CANDIDATE')->row_array();

			// Account Manager

			$data = array(
			'account_manager_id',
			'distributor_id',
			'account_manager',
			'name',
			'email',
			'phone',
			'address',
			'credits',
			'status',
			);


			$data['distributor_id'] = $this->session->userdata['user'];
			$this->db->insert('tbl_account_manager', $data);
			$profile_id = $this->db->insert_id();

			$minus_credit = $data['credits'];
			$loggedinUser = $this->session->userdata['profile_id'];
			$this->db->set('credits', "credits-$minus_credit", FALSE);
			$this->db->where('distributor_id', $loggedinUser);
			$this->db->update('tbl_distributor');

			$auth = array(
				'auth_id' => '',
				'profile_id' => $profile_id,
				'name' => $data['name'],
				'email' => $data['email'],
				'password' => base64_encode($password),
				'type' => 'ACCOUNT MANAGER',
			);
			$this->db->insert('tbl_auth', $auth);
		}


		if ($data) {
			if ($data['type'] == 'DISTRIBUTOR') {
				$distributor = $this->db->query("SELECT status FROM tbl_distributor WHERE status = 1 AND email like '" . $data['email'] . "' AND distributor_id = '" . $data['profile_id'] . "'")->num_rows();
				if ($distributor == 1) {
					return $data;
				}
			} else if ($data['type'] == 'ACCOUNT MANAGER') {
				$account_manager = $this->db->query("SELECT status FROM tbl_account_manager WHERE status = 1 AND email like '" . $data['email'] . "' AND account_manager_id = '" . $data['profile_id'] . "'")->num_rows();
				if ($account_manager == 1) {
					return $data;
				}
			} else if ($data['type'] == 'MANAGER') {
				$manager = $this->db->query("SELECT status FROM tbl_manager WHERE status = 1 AND email like '" . $data['email'] . "' AND manager_id = '" . $data['profile_id'] . "'")->num_rows();
				if ($manager == 1) {
					return $data;
				}
			} else if ($data['type'] == 'RATER') {
				$manager = $this->db->query("SELECT status FROM tbl_rater WHERE status = 1 AND email like '" . $data['email'] . "' AND rater_id = '" . $data['profile_id'] . "'")->num_rows();
				if ($manager == 1) {
					return $data;
				}
			} else {
				return $data;
			}
		}
	}

}
?>
