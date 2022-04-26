<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class bidang_ilmu extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('bidang_ilmu_model');
	}

	// View bidang_ilmu
	public function index()
	{
		$data	= array(
			'title'		=> 'Master Data - Bidang Ilmu',
			'bidang_ilmu'	=> $this->bidang_ilmu_model->listing_bidang_ilmu(),
			'isi'		=> 'masterdata/bidang_ilmu/list'
		);
		$this->load->view('layouts/dashboard', $data);
	}

	// public function tambah()
	// {
	// 	$data	= array(
	// 				'title'		=> 'Tambah bidang_ilmu Baru',
	// 				'isi'		=> 'masterdata/bidang_ilmu/tambah'
	// 			);
	// 	$this->load->view('layouts/dashboard', $data);
	// }

	// Tambah bidang_ilmu
	public function tambah()
	{
		// Tambah bidang_ilmu, check validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data	= array(
				'title'		=> 'Tambah Bidang Ilmu Baru',
				'isi'		=> 'masterdata/bidang_ilmu/tambah'
			);
			$this->load->view('layouts/dashboard', $data);
		} else {
			$data = array(
				'nama'			=> $this->input->post('nama'),
				'keterangan' 	=> $this->input->post('keterangan'),
			);
			$this->bidang_ilmu_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data Bidang Ilmu Berhasil Ditambah');
			redirect(base_url() . 'bidang_ilmu');
		}
	}

	// Edit bidang_ilmu
	public function edit($id)
	{
		$bidang_ilmu = $this->bidang_ilmu_model->listing_bidang_ilmu($id);
		// Tambah bidang_ilmu, check validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data	= array(
				'title'		=> 'Edit Data Bidang Ilmu',
				'bidang_ilmu'	=> $bidang_ilmu,
				'isi'		=> 'masterdata/bidang_ilmu/edit'
			);
			$this->load->view('layouts/dashboard', $data);
		} else {
			$data = array(
				'id'			=> $this->input->post('id'),
				'nama'			=> $this->input->post('nama'),
				'keterangan' 	=> $this->input->post('keterangan')
			);
			$this->bidang_ilmu_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data Bidang Ilmu Berhasil Diupdate');
			redirect(base_url() . 'bidang_ilmu');
		}
	}

	//Edit Status
	public function	edit_status($id)
	{
		$bidang_ilmu = $this->bidang_ilmu_model->listing_bidang_ilmu($id);
		$status = $this->input->post('status');

		$data = array(
			'id'		=> $this->input->post('id'),
			'status'		=> $status
		);

		$this->bidang_ilmu_model->edit($data);
		$this->session->set_flashdata('sukses', 'Status Berhasil Diupdate');
		redirect(base_url() . 'bidang_ilmu');
	}

	// Delete bidang_ilmu 
	public function delete($id)
	{
		$data = array('id'	=> $id);
		$this->bidang_ilmu_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data Bidang Ilmu Berhasil Dihapus');
		redirect(base_url() . 'bidang_ilmu');
	}
}
