<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bidang_ilmu_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	// Listing
	public function home() {
		$this->db->select('*');
		$this->db->from('bidang_ilmu');
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	
	// Panggil per item dan listing
	public function listing_bidang_ilmu($id = FALSE) {
	if ($id === FALSE)	{
		$query = $this->db->query('SELECT * FROM bidang_ilmu ORDER BY id ASC');
		return $query->result_array();
	}
	$query = $this->db->get_where('bidang_ilmu', array('id' => $id));
	return $query->row_array();
	}
	
	// Add new bidang_ilmu
	public function tambah($data) {
		return $this->db->insert('bidang_ilmu', $data);
	}
	
	// Edit bidang_ilmu
	public function edit($data) {
		$this->db->where('id', $data['id']);
		return $this->db->update('bidang_ilmu', $data);
	}

	// Delete bidang_ilmu
	public function delete($data) {
		$this->db->where('id', $data['id']);
		return $this->db->delete('bidang_ilmu', $data);
	}
	
	// Listing data
	public function get_bidang_ilmu() {
		$this->db->select('*');
		$this->db->from('bidang_ilmu');
		$this->db->order_by('id','ASC');
		
		$q = $this->db->get();
		
		if($q->num_rows() > 0) {
			return $q->result();
		}else{
			return false;
		}
	}
	
	
	// Total bidang_ilmu
	public function total_bidang_ilmu() {
		$this->db->select('*');
		$this->db->from('bidang_ilmu');
		$this->db->order_by('id','ASC');
		
		$q = $this->db->get();
		
		if($q->num_rows() > 0) {
			return $q->num_rows();
		}else{
			return false;
		}
	}
	
	// bidang_ilmu Status Aktif
	public function status_aktif($id = FALSE) {
	if ($id === FALSE)	{
		$query = $this->db->query('SELECT * FROM bidang_ilmu WHERE status = "Aktif" ORDER BY id ASC LIMIT 5');
		return $query->result_array();
	}
	$query = $this->db->get_where('bidang_ilmu', array('id' => $id));
	return $query->row_array();
	}
	
	// bidang_ilmu Status Tidak Aktif
	public function status_tidak_aktif($id = FALSE) {
	if ($id === FALSE)	{
		$query = $this->db->query('SELECT * FROM bidang_ilmu WHERE status = "Tidak Aktif" ORDER BY id ASC LIMIT 3');
		return $query->result_array();
	}
	$query = $this->db->get_where('bidang_ilmu', array('id' => $id));
	return $query->row_array();
	}
	
	// Daftar bidang_ilmu
	public function data_bidang_ilmu($status) {
		$this->db->select('*');
		$this->db->from('bidang_ilmu');
		$this->db->order_by('id','ASC LIMIT 15');
		$this->db->where(array('status'=>$status));
		$query = $this->db->get();
		return $query->result_array();
	}
}