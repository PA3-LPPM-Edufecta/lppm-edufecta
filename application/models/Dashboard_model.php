<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Total luaran
	public function luaran()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('luaran');
		$query = $this->db->get();
		return $query->row();
	}

	// Total pencairan
	public function pencairan()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('pencairan');
		$query = $this->db->get();
		return $query->row();
	}

}