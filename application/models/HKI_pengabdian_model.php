<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HKI_pengabdian_model extends CI_Model
{
	var $table = 'tbl_hki';
	var $tbl_mst_dosen = 'mst_dosen';
	var $tbl_tipe_pengajuan = 'ref_tipe_pengajuan';
	var $column_search = array('hki.judul', 'hki.jenis', 'hki.nomor_pendaftaran', 'hki.nomor_hki', 'hki.tanggal', 'hki.file', 'hki.status', 'dosen.nama', 'dosen.nidn', 'dosen.gelar_depan', 'dosen.gelar_belakang', 'refpengajuan.nama_tipe_pengajuan'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $column_order = array('nama', 'nidn', 'judul', 'jenis', 'nomor_pendaftaran', 'nomor_hki', 'tanggal', 'file', 'status');
	// var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	private function _get_datatables_query($term = '')
	{
		$this->db->select('hki.*, dosen.gelar_depan, dosen.nama, dosen.gelar_belakang, dosen.nidn, refpengajuan.nama_tipe_pengajuan');
		$this->db->from('tbl_hki as hki'); //hki
		$this->db->join('mst_dosen as dosen','dosen.id = hki.id_dosen'); //dosen
		$this->db->join('ref_tipe_pengajuan as refpengajuan','refpengajuan.id = hki.id_tipe_pengajuan'); //tipe pengajuan
		// $this->db->like('refpengajuan.nama_tipe_pengajuan', $term);
		$this->db->where('hki.id_tipe_pengajuan', '2'); //tampilkan hanya yg ber id_tipe_pengajuan 2
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
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query($term);
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query($term);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from('tbl_hki as hki');
		$this->db->join('mst_dosen as dosen','dosen.id=hki.id_dosen');
		$this->db->join('ref_tipe_pengajuan as refpengajuan','refpengajuan.id = hki.id_tipe_pengajuan'); //tipe pengajuan
		return $this->db->count_all_results();
	}
	
	function get_hki($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('tbl_hki')->row();
	}

	function getAll()
	{
		$this->db->select('hki.*,dosen.gelar_depan, dosen.nama, dosen.gelar_belakang, dosen.nidn, refpengajuan.nama_tipe_pengajuan');
		$this->db->join('mst_dosen as dosen','dosen.id=hki.id_dosen');
		$this->db->join('ref_tipe_pengajuan as refpengajuan','refpengajuan.id = hki.id_tipe_pengajuan'); //tipe pengajuan
		return $this->db->get('tbl_hki');
	}

	function view_hki($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('tbl_hki');
	}
	
	function update_hki($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_hki', $data);
	}

	function update_idDosen($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_hki', $data);
	}

	function insert_hki($tabel, $data)
	{
		$insert = $this->db->insert($tabel, $data);
		return $insert;
	}

	function insert_idDosen($tbl_mst_dosen, $data)
	{
		$insert = $this->db->insert($tbl_mst_dosen, $data);
		return $insert;
	}

	function insert_idPengajuan($tbl_tipe_pengajuan, $data)
	{
		$insert = $this->db->insert($tbl_tipe_pengajuan, $data);
		return $insert;
	}

	function delete_hki($id, $table)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
	}

	function getImage($id)
    {
        $this->db->select('file');
        $this->db->from('tbl_hki');
        $this->db->where('id', $id);
        return $this->db->get();
    }
}

/* End of file login_model.php */
