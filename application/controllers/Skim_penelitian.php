<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Skim_penelitian extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('masterdata/skim_penelitian_model');
	}

	// View skim_penelitian
	public function index()
	{
		$data	= array(
			'title'		=> 'Master Data - Skim Penelitian',
			'skim_penelitian'	=> $this->skim_penelitian_model->listing_skim_penelitian(),
			'isi'		=> 'admin/masterdata/skim_penelitian/list'
		);
		$this->load->view('admin/layouts/layoutbackend', $data);
	}

	public function list_syarat(){
		$list_syarat = $this->input->post('list_syarat');
		$no = 1;
			
		foreach($list_syarat as $list) {
			$result = $no++.'. '.$list;
		}
		unset($result);
	}

	// Tambah skim_penelitian
	public function tambah()
	{	
		// Tambah skim_penelitian, check validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data	= array(
				'title'		=> 'Tambah Data',
				'luaran'	=> $this->skim_penelitian_model->listing_data_luaran(), 
				'isi'		=> 'admin/masterdata/skim_penelitian/tambah'
			);
			$this->load->view('admin/layouts/layoutbackend', $data);
		} else {

			$list_syarat = $this->input->post('list_syarat');

			$result = implode("<br>", $list_syarat);

			$data1 = array(
				'nama'							=> $this->input->post('nama'),
				'keterangan' 					=> $this->input->post('keterangan'),
				'maksimal_pengajuan' 			=> $this->input->post('maksimal_pengajuan'),
				'jumlah_maksimal_pengajuan' 	=> $this->input->post('jumlah_maksimal_pengajuan'),
				'syarat' 						=> $this->input->post('syarat'),
				'list_syarat' 					=> $result,
				'lama_penyelesaian' 			=> $this->input->post('lama_penyelesaian'),
				'wajib_laporan_kemajuan' 		=> $this->input->post('wajib_laporan_kemajuan'),
				'maksimal_dana' 				=> $this->input->post('maksimal_dana')
			);
			$this->skim_penelitian_model->tambah($data1);
			// var_dump($data1);

			$idskim = $this->db->query('SELECT id FROM skim_penelitian ORDER BY id DESC LIMIT 1');
			$idskim->result_array();
			$paket = $this->input->post('paket[]');

			foreach($paket as $p){
				$data2 = array(
					'id_luaran'						=> $p,
					'id_skim_penelitian'			=> $idskim['id'],
				);
			}

			$this->skim_penelitian_model->tambah_skim($data2);
			$this->session->set_flashdata('sukses', 'Data Skim Penelitian Berhasil Ditambah');
			redirect(base_url() . 'skim_penelitian');
		}
	}

	// Edit skim_penelitian
	public function edit($id)
	{
		$skim_penelitian = $this->skim_penelitian_model->listing_skim_penelitian($id);
		// Edit skim_penelitian, check validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data	= array(
				'title'				=> 'Edit Data',
				'skim_penelitian'	=> $skim_penelitian,
				'isi'				=> 'admin/masterdata/skim_penelitian/edit'
			);
			$this->load->view('admin/layouts/layoutbackend', $data);
		} else {
			$list_syarat = $this->input->post('list_syarat');

			$result = implode("<br>", $list_syarat);

			$data1 = array(
				'nama'							=> $this->input->post('nama'),
				'keterangan' 					=> $this->input->post('keterangan'),
				'maksimal_pengajuan' 			=> $this->input->post('maksimal_pengajuan'),
				'jumlah_maksimal_pengajuan' 	=> $this->input->post('jumlah_maksimal_pengajuan'),
				'syarat' 						=> $this->input->post('syarat'),
				'list_syarat' 					=> $result,
				'lama_penyelesaian' 			=> $this->input->post('lama_penyelesaian'),
				'wajib_laporan_kemajuan' 		=> $this->input->post('wajib_laporan_kemajuan'),
				'maksimal_dana' 				=> $this->input->post('maksimal_dana')
			);
			$this->skim_penelitian_model->edit($data1);
			// var_dump($data1);

			$idskim = $this->db->query('SELECT id FROM skim_penelitian ORDER BY id DESC LIMIT 1');
			$idskim->result_array();
			$paket = $this->input->post('paket[]');

			foreach($paket as $p){
				$data2 = array(
					'id_luaran'						=> $p,
					'id_skim_penelitian'			=> $idskim['id'],
				);
			}

			$this->skim_penelitian_model->edit_skim($data2);
			$this->session->set_flashdata('sukses', 'Data Skim Penelitian Berhasil Ditambah');
			redirect(base_url() . 'skim_penelitian');
		}
	}

	//Edit Status
	public function	edit_status($id)
	{
		$skim_penelitian = $this->skim_penelitian_model->listing_skim_penelitian($id);
		$status = $this->input->post('status');

		$data = array(
			'id'		=> $this->input->post('id'),
			'status'		=> $status
		);

		$this->skim_penelitian_model->edit($data);
		$this->session->set_flashdata('sukses', 'Status Berhasil Diupdate');
		redirect(base_url() . 'skim_penelitian');
	}

	// Delete skim_penelitian 
	public function delete($id)
	{
		$data = array('id'	=> $id);
		$this->skim_penelitian_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data Skim Penelitian Berhasil Dihapus');
		redirect(base_url() . 'skim_penelitian');
	}
}
