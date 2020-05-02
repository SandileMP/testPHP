<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{

	public function checkDetail($email,$password){
		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$data = $this->db->get()->result();
		if($data){
			return (array)$data[0];	
		}
	}
}
?>