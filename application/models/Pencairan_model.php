<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pencairan_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	// Listing
	public function home() {
		$this->db->select('*');
		$this->db->from('pencairan');
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	
	// Panggil per item dan listing
	public function listing_pencairan($id = FALSE) {
	if ($id === FALSE)	{
		$query = $this->db->query('SELECT * FROM pencairan ORDER BY id ASC');
		return $query->result_array();
	}
	$query = $this->db->get_where('pencairan', array('id' => $id));
	return $query->row_array();
	}
	
	// Add new pencairan
	public function tambah($data) {
		return $this->db->insert('pencairan', $data);
	}
	
	// Edit pencairan
	public function edit($data) {
		$this->db->where('id', $data['id']);
		return $this->db->update('pencairan', $data);
	}

	// Delete pencairan
	public function delete($data) {
		$this->db->where('id', $data['id']);
		return $this->db->delete('pencairan', $data);
	}
	
	// Listing data
	public function get_pencairan() {
		$this->db->select('*');
		$this->db->from('pencairan');
		$this->db->order_by('id','ASC');
		
		$q = $this->db->get();
		
		if($q->num_rows() > 0) {
			return $q->result();
		}else{
			return false;
		}
	}
	
	
	// Total pencairan
	public function total_pencairan() {
		$this->db->select('*');
		$this->db->from('pencairan');
		$this->db->order_by('id','ASC');
		
		$q = $this->db->get();
		
		if($q->num_rows() > 0) {
			return $q->num_rows();
		}else{
			return false;
		}
	}
	
	// pencairan Status Aktif
	public function status_aktif($id = FALSE) {
	if ($id === FALSE)	{
		$query = $this->db->query('SELECT * FROM pencairan WHERE status = "Aktif" ORDER BY id ASC LIMIT 5');
		return $query->result_array();
	}
	$query = $this->db->get_where('pencairan', array('id' => $id));
	return $query->row_array();
	}
	
	// pencairan Status Tidak Aktif
	public function status_tidak_aktif($id = FALSE) {
	if ($id === FALSE)	{
		$query = $this->db->query('SELECT * FROM pencairan WHERE status = "Tidak Aktif" ORDER BY id ASC LIMIT 3');
		return $query->result_array();
	}
	$query = $this->db->get_where('pencairan', array('id' => $id));
	return $query->row_array();
	}
	
	// Daftar pencairan
	public function data_pencairan($status) {
		$this->db->select('*');
		$this->db->from('pencairan');
		$this->db->order_by('id','ASC LIMIT 15');
		$this->db->where(array('status'=>$status));
		$query = $this->db->get();
		return $query->result_array();
	}
}