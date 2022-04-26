<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Luaran_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	// Listing
	public function home() {
		$this->db->select('*');
		$this->db->from('luaran');
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	
	// Panggil per item dan listing
	public function listing_luaran($id = FALSE) {
	if ($id === FALSE)	{
		$query = $this->db->query('SELECT * FROM luaran ORDER BY id ASC');
		return $query->result_array();
	}
	$query = $this->db->get_where('luaran', array('id' => $id));
	return $query->row_array();
	}
	
	// Add new luaran
	public function tambah($data) {
		return $this->db->insert('luaran', $data);
	}
	
	// Edit luaran
	public function edit($data) {
		$this->db->where('id', $data['id']);
		return $this->db->update('luaran', $data);
	}

	// Delete luaran
	public function delete($data) {
		$this->db->where('id', $data['id']);
		return $this->db->delete('luaran', $data);
	}
	
	// Listing data
	public function get_luaran() {
		$this->db->select('*');
		$this->db->from('luaran');
		$this->db->order_by('id','ASC');
		
		$q = $this->db->get();
		
		if($q->num_rows() > 0) {
			return $q->result();
		}else{
			return false;
		}
	}
	
	
	// Total luaran
	public function total_luaran() {
		$this->db->select('*');
		$this->db->from('luaran');
		$this->db->order_by('id','ASC');
		
		$q = $this->db->get();
		
		if($q->num_rows() > 0) {
			return $q->num_rows();
		}else{
			return false;
		}
	}
	
	// Luaran Status Aktif
	public function status_aktif($id = FALSE) {
	if ($id === FALSE)	{
		$query = $this->db->query('SELECT * FROM luaran WHERE status = "Aktif" ORDER BY id ASC LIMIT 5');
		return $query->result_array();
	}
	$query = $this->db->get_where('luaran', array('id' => $id));
	return $query->row_array();
	}
	
	// Luaran Status Tidak Aktif
	public function status_tidak_aktif($id = FALSE) {
	if ($id === FALSE)	{
		$query = $this->db->query('SELECT * FROM luaran WHERE status = "Tidak Aktif" ORDER BY id ASC LIMIT 3');
		return $query->result_array();
	}
	$query = $this->db->get_where('luaran', array('id' => $id));
	return $query->row_array();
	}
	
	// Daftar luaran
	public function data_luaran($status) {
		$this->db->select('*');
		$this->db->from('luaran');
		$this->db->order_by('id','ASC LIMIT 15');
		$this->db->where(array('status'=>$status));
		$query = $this->db->get();
		return $query->result_array();
	}
}