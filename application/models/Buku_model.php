<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends CI_Model
{
	var $table = 'buku';
	var $column_search = array('tgl_terbit', 'judul', 'penerbit', 'isbn', 'halaman', 'file_cover', 'file_editorial_board', 'file_penerbit', 'file_lainnya', 'keterangan', 'status');
	var $column_order = array('tgl_terbit', 'judul', 'penerbit', 'isbn', 'halaman', 'file_cover', 'file_editorial_board', 'file_penerbit', 'file_lainnya', 'keterangan', 'status');
	var $order = array('id' => 'dsc');
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->from('buku');
		$i = 0;

		foreach ($this->column_search as $item) // loop column 
		{
			if ($_POST['search']['value']) // if datatable send POST for search
			{

				if ($i === 0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from('buku');
		return $this->db->count_all_results();
	}

	function insert_buku($table, $data)
	{
		$insert = $this->db->insert($table, $data);
		return $insert;
	}

	function update_buku($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('buku', $data);
	}

	function get_buku($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('buku')->row();
	}

	// // Luaran Status Aktif
	// public function status_aktif($id = FALSE)
	// {
	// 	if ($id === FALSE) {
	// 		$query = $this->db->query('SELECT * FROM buku WHERE sts = "Aktif" ORDER BY id ASC LIMIT 5');
	// 		return $query->result_array();
	// 	}
	// 	$query = $this->db->get('buku', array('id' => $id));
	// 	return $query->row_array();
	// }

	// // Luaran Status Tidak Aktif
	// public function status_tidak_aktif($id = FALSE)
	// {
	// 	if ($id === FALSE) {
	// 		$query = $this->db->query('SELECT * FROM buku WHERE sts = "Tidak Aktif" ORDER BY id ASC LIMIT 3');
	// 		return $query->result_array();
	// 	}
	// 	$query = $this->db->get('buku', array('id' => $id));
	// 	return $query->row_array();
	// }

	function delete_buku($id, $table)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
	}
}
