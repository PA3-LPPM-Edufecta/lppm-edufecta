<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skim_penelitian_model extends CI_Model
{
	var $table = 'mst_skim';
	var $column_search = array('nama', 'keterangan', 'maksimal_pengajuan', 'syarat', 'lama_penyelesaian', 'status');
	var $column_order = array('nama', 'keterangan', 'maksimal_pengajuan', 'syarat', 'lama_penyelesaian', 'status');
	// var $order = array('id' => 'asc');
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->select('b.id as id_ref_tipe_pengajuan, b.nama_tipe_pengajuan, a.id, a.id_luaran, a.id_tipe_pengajuan, a.nama, 
		a.keterangan, a.maksimal_pengajuan, a.syarat, a.list_syarat, a.lama_penyelesaian, a.wajib_laporan_kemajuan, a.maksimal_dana, 
		a.jumlah_maksimal_pengajuan, a.status, a.created_at, a.updated_at');
		$this->db->from('mst_skim as a');
		$this->db->join('ref_tipe_pengajuan as b', 'a.id_tipe_pengajuan=b.id');
		$this->db->where('a.id_tipe_pengajuan', '1');
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
		$this->db->from('mst_skim');
		return $this->db->count_all_results();
	}

	function getAll()
	{
	   return $this->db->get('mst_skim');
	}

	function insert_skim_penelitian($table, $data)
	{
		$insert = $this->db->insert($table, $data);
		return $insert;
	}

	function update_skim_penelitian($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('mst_skim', $data);
	}

	function get_skim_penelitian($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('mst_skim')->row();
	}

	function delete_skim_penelitian($id, $table)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
	}
}
