<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
        $this->load->database();
	}

    function get_id_level($id_user){
        $this->db->select('id_level');
		$this->db->where('id_user', $id_user);
		return $this->db->get('tbl_user');
    }

    function get_level($id_level, $id_submenu){
        // $this->db->select('view_level');
        // $this->db->from('tbl_akses_submenu');
        $this->db->where('id_level', $id_level);
        $this->db->where('id_submenu', $id_submenu);
        return $this->db->get('tbl_akses_submenu');
    }
}