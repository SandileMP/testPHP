<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Template_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function getTemplateDetailById($template_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_email_template');
		$this->db->where('template_id', $template_id);
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data[0];
		}
	}
	
	public function getTemplates($client_id = '') {
		$this->db->select('*');
		$this->db->from('tbl_email_template');
		$this->db->where('client_id', $client_id);
		$data = $this->db->get()->result();
		if ($data) {
			return (array) $data;
		}
	}

	public function getTemplatesBySearch($client_id = '', $serach = '') {
		$data = $this->db->query("SELECT * FROM tbl_email_template WHERE client_id = '{$client_id}' AND (template_name LIKE '%{$serach}%' OR interview_status LIKE '%{$serach}%' OR subject LIKE '%{$serach}%') ");
		if ($data) {
			return (array) $data->result();
		}
	}
	
	public function addTemplates($data = array()) {
		$add = array(
			'template_id' => '',
			'template_name' => $data['template_name'],
			'interview_status' => $data['interview_status'],
			'subject' => $data['subject'],
			'email_content' => htmlspecialchars_decode($data['email_content']),
			'client_id' => $data['client_id'],
		);
		return $this->db->insert('tbl_email_template', $add);
	}
	
	public function updateTemplate($template_id = '', $data = array()) {
		$update = array(
			'template_name' => $data['template_name'],
			'interview_status' => $data['interview_status'],
			'subject' => $data['subject'],
			'email_content' => htmlspecialchars_decode($data['email_content']),
		);
		$this->db->where('template_id', $template_id);
		$this->db->update('tbl_email_template', $update);
	}	
	
	public function removeTemplate($template_id = '') {
		$this->db->where('template_id', $template_id);
		$this->db->delete('tbl_email_template');
	}	

	public function cloneTemplate($template_id = '') {
		$data = $this->getTemplateDetailById($template_id);
		$data['template_name'].=' Copy';
		$this->addTemplates($data);
	}	

}
?>