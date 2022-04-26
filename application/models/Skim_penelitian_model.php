<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skim_penelitian_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	// Listing
	public function home() {
		$this->db->select('*');
		$this->db->from('skim_penelitian');
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	
	// Panggil per item dan listing
	public function listing_skim_penelitian($id = FALSE) {
	if ($id === FALSE)	{
		$query = $this->db->query('SELECT * FROM skim_penelitian ORDER BY id ASC');
		return $query->result_array();
	}
	$query = $this->db->get_where('skim_penelitian', array('id' => $id));
	return $query->row_array();
	}
	
	// Add new skim_penelitian
	public function tambah($data) {
		return $this->db->insert('skim_penelitian', $data);
	}
	
	// Edit skim_penelitian
	public function edit($data) {
		$this->db->where('id', $data['id']);
		return $this->db->update('skim_penelitian', $data);
	}

	// Delete skim_penelitian
	public function delete($data) {
		$this->db->where('id', $data['id']);
		return $this->db->delete('skim_penelitian', $data);
	}
	
	// Listing data
	public function get_skim_penelitian() {
		$this->db->select('*');
		$this->db->from('skim_penelitian');
		$this->db->order_by('id','ASC');
		
		$q = $this->db->get();
		
		if($q->num_rows() > 0) {
			return $q->result();
		}else{
			return false;
		}
	}
	
	
	// Total skim_penelitian
	public function total_skim_penelitian() {
		$this->db->select('*');
		$this->db->from('skim_penelitian');
		$this->db->order_by('id','ASC');
		
		$q = $this->db->get();
		
		if($q->num_rows() > 0) {
			return $q->num_rows();
		}else{
			return false;
		}
	}
	
	// skim_penelitian Status Aktif
	public function status_aktif($id = FALSE) {
	if ($id === FALSE)	{
		$query = $this->db->query('SELECT * FROM skim_penelitian WHERE status = "Aktif" ORDER BY id ASC LIMIT 5');
		return $query->result_array();
	}
	$query = $this->db->get_where('skim_penelitian', array('id' => $id));
	return $query->row_array();
	}
	
	// skim_penelitian Status Tidak Aktif
	public function status_tidak_aktif($id = FALSE) {
	if ($id === FALSE)	{
		$query = $this->db->query('SELECT * FROM skim_penelitian WHERE status = "Tidak Aktif" ORDER BY id ASC LIMIT 3');
		return $query->result_array();
	}
	$query = $this->db->get_where('skim_penelitian', array('id' => $id));
	return $query->row_array();
	}
	
	// Daftar skim_penelitian
	public function data_skim_penelitian($status) {
		$this->db->select('*');
		$this->db->from('skim_penelitian');
		$this->db->order_by('id','ASC LIMIT 15');
		$this->db->where(array('status'=>$status));
		$query = $this->db->get();
		return $query->result_array();
	}
}