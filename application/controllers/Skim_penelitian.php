<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class skim_penelitian extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('skim_penelitian_model');
	}

	// View skim_penelitian
	public function index()
	{
		$data	= array(
			'title'		=> 'Master Data - Skim Penelitian',
			'skim_penelitian'	=> $this->skim_penelitian_model->listing_skim_penelitian(),
			'isi'		=> 'masterdata/skim_penelitian/list'
		);
		$this->load->view('layouts/dashboard', $data);
	}

	// public function tambah()
	// {
	// 	$data	= array(
	// 				'title'		=> 'Tambah skim_penelitian Baru',
	// 				'isi'		=> 'masterdata/skim_penelitian/tambah'
	// 			);
	// 	$this->load->view('layouts/dashboard', $data);
	// }

	// Tambah skim_penelitian
	public function tambah()
	{	
		// Tambah skim_penelitian, check validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		// $this->form_validation->set_rules('maksimal_pengajuan', 'Maksimal Pengajuan', 'required');
		// $this->form_validation->set_rules('syarat', 'Syarat', 'required');
		// $this->form_validation->set_rules('lama_penyelesaian', 'Lama Penyelesaian', 'required');
		// $this->form_validation->set_rules('wajib_laporan_kemajuan', 'Wajib Laporan Kemajuan', 'required');
		// $this->form_validation->set_rules('luaran_wajib', 'Luaran Wajib', 'required');
		// $this->form_validation->set_rules('maksimal_dana', 'Maksimal Dana', 'required');

		if ($this->form_validation->run() === FALSE) {
			$data	= array(
				'title'		=> 'Tambah Skim Penelitian Baru',
				'luaran'	=> $this->skim_penelitian_model->listing_data_luaran(), 
				'isi'		=> 'masterdata/skim_penelitian/tambah'
			);
			$this->load->view('layouts/dashboard', $data);
		} else {
			$data = array(
				'nama'			=> $this->input->post('nama'),
				'keterangan' 	=> $this->input->post('keterangan'),
				'maksimal_pengajuan' 	=> $this->input->post('maksimal_pengajuan'),
				'jumlah_maksimal_pengajuan' 	=> $this->input->post('jumlah_maksimal_pengajuan'),
				'syarat' 	=> $this->input->post('syarat'),
				'list_syarat' 	=> $this->input->post('list_syarat'),
				'lama_penyelesaian' 	=> $this->input->post('lama_penyelesaian'),
				'wajib_laporan_kemajuan' 	=> $this->input->post('wajib_laporan_kemajuan'),
				'id_luaran' 	=> $this->input->post('paket[]'),
				'maksimal_dana' 	=> $this->input->post('maksimal_dana')
			);
			
			var_dump($data);

			// $this->skim_penelitian_model->tambah($data);
			// $this->session->set_flashdata('sukses', 'Data Skim Penelitian Berhasil Ditambah');
			// redirect(base_url() . 'skim_penelitian');
		}
	}

	// Edit skim_penelitian
	public function edit($id)
	{
		$skim_penelitian = $this->skim_penelitian_model->listing_skim_penelitian($id);
		// Tambah skim_penelitian, check validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data	= array(
				'title'		=> 'Edit Data Skim Penelitian',
				'skim_penelitian'	=> $skim_penelitian,
				'isi'		=> 'masterdata/skim_penelitian/edit'
			);
			$this->load->view('layouts/dashboard', $data);
		} else {
			$data = array(
				'id'			=> $this->input->post('id'),
				'nama'			=> $this->input->post('nama'),
				'keterangan' 	=> $this->input->post('keterangan')
			);
			$this->skim_penelitian_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data Skim Penelitian Berhasil Diupdate');
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
