<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends CI_Model
{
	var $table = 'tbl_buku';
	var $tbl_mst_dosen = 'mst_dosen';
	var $tbl_tipe_pengajuan = 'ref_tipe_pengajuan';
	var $tbl_buku_lain = 'tbl_buku_file_lain';
	var $column_search = array('buku.judul', 'buku.penerbit', 'buku.isbn', 'buku.halaman', 'buku.tanggal', 'buku.file_cover', 'buku.file_editorial_board', 'buku.file_penerbit', 'buku.file', 'buku.status', 'dosen.nama', 'dosen.nidn', 'dosen.gelar_depan', 'dosen.gelar_belakang', 'refpengajuan.nama_tipe_pengajuan', 'bukulain.file'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $column_order = array('nama', 'nidn', 'judul', 'penerbit', 'isbn', 'halaman', 'tanggal', 'file_cover', 'file_editorial_board', 'file_penerbit', 'file', 'status');
	// var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	private function _get_datatables_query($term = '')
	{
		$this->db->select('buku.*, dosen.gelar_depan, dosen.nama, dosen.gelar_belakang, dosen.nidn, refpengajuan.nama_tipe_pengajuan, bukulain.file');
		$this->db->from('tbl_buku as buku'); //buku
		$this->db->join('mst_dosen as dosen','dosen.id = buku.id_dosen'); //dosen
		$this->db->join('ref_tipe_pengajuan as refpengajuan','refpengajuan.id = buku.id_tipe_pengajuan'); //tipe pengajuan
		$this->db->join('tbl_buku_file_lain as bukulain','bukulain.id = buku.id'); // buku file lain
		$this->db->like('refpengajuan.nama_tipe_pengajuan', $term);
		$this->db->where('buku.id_tipe_pengajuan', '2'); //tampilkan hanya yg ber id_tipe_pengajuan 2
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
		$this->db->from('tbl_buku as buku');
		$this->db->join('mst_dosen as dosen','dosen.id=buku.id_dosen');
		$this->db->join('ref_tipe_pengajuan as refpengajuan','refpengajuan.id = buku.id_tipe_pengajuan'); //tipe pengajuan
		$this->db->join('tbl_buku_file_lain as bukulain','bukulain.id = buku.id');
		return $this->db->count_all_results();
	}
	
	function get_buku($id)
	{
		$this->db->select('buku.id as id_buku, id_dosen, judul, penerbit, isbn, halaman, tanggal, file_cover, file_editorial_board, file_penerbit, bukulain.id as id_buku_lain, file');
		$this->db->from('tbl_buku as buku');
		$this->db->join('tbl_buku_file_lain as bukulain', 'bukulain.id = buku.id');
		$this->db->where('buku.id', $id);
		return $this->db->get()->row();
	}

	function getAll()
	{
		$this->db->select('buku.*,dosen.gelar_depan, dosen.nama, dosen.gelar_belakang, dosen.nidn, refpengajuan.nama_tipe_pengajuan');
		$this->db->join('mst_dosen as dosen','dosen.id=buku.id_dosen');
		$this->db->join('ref_tipe_pengajuan as refpengajuan','refpengajuan.id = buku.id_tipe_pengajuan'); //tipe pengajuan
		$this->db->join('tbl_buku_file_lain as bukulain','bukulain.id = buku.id');
		return $this->db->get('tbl_buku');
	}

	function view_buku($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('tbl_buku');
	}
	
	function update_buku($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_buku', $data);
	}

	function update_idDosen($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_buku', $data);
	}

	function update_bukulain($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_buku_file_lain', $data);
	}

	function insert_buku($tabel, $data)
	{
		$insert = $this->db->insert($tabel, $data);
		return $insert;
	}

	function insert_bukulain($tbl_buku_lain, $data)
	{
		$insert = $this->db->insert($tbl_buku_lain, $data);
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

	function insert_buku_file_lain($tbl, $data){
		$insert = $this->db->insert($tbl, $data);
		return $insert;
	}

	function delete_buku($id, $table)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
	}

	function delete_buku_file_lain($id, $table)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
	}

	function getImage1($id)
    {
        $this->db->select('file_cover');
        $this->db->from('tbl_buku');
        $this->db->where('id', $id);
        return $this->db->get();
    }

	function getImage2($id)
    {
        $this->db->select('file_editorial_board');
        $this->db->from('tbl_buku');
        $this->db->where('id', $id);
        return $this->db->get();
    }

	function getImage3($id)
    {
        $this->db->select('file_penerbit');
        $this->db->from('tbl_buku');
        $this->db->where('id', $id);
        return $this->db->get();
    }

	function getImage4($id)
    {
        $this->db->select('file');
        $this->db->from('tbl_buku_file_lain');
        $this->db->where('id', $id);
        return $this->db->get();
    }

	function getLastId()
	{
		$this->db->select('id');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		return $this->db->get('tbl_buku');
	}
}

/* End of file login_model.php */
