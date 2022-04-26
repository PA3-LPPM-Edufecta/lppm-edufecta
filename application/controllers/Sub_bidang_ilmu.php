<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sub_bidang_ilmu extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sub_bidang_ilmu_model');
	}

	// View bidang_ilmu/sub
	public function index()
	{
		$data	= array(
			'title'		=> 'Master Data - Sub Bidang Ilmu',
			'sub_bidang_ilmu'	=> $this->sub_bidang_ilmu_model->listing_sub_bidang_ilmu(),
			'isi'		=> 'masterdata/bidang_ilmu/sub/list'
		);
		$this->load->view('layouts/dashboard', $data);
	}

	// public function tambah()
	// {
	// 	$data	= array(
	// 				'title'		=> 'Tambah bidang_ilmu/sub Baru',
	// 				'isi'		=> 'masterdata/bidang_ilmu/sub/tambah'
	// 			);
	// 	$this->load->view('layouts/dashboard', $data);
	// }

	// Tambah bidang_ilmu/sub
	public function tambah()
	{
		// Tambah bidang_ilmu/sub, check validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data	= array(
				'title'		=> 'Tambah Bidang Ilmu Baru',
				'isi'		=> 'masterdata/bidang_ilmu/sub/tambah'
			);
			$this->load->view('layouts/dashboard', $data);
		} else {
			$data = array(
				'nama'			=> $this->input->post('nama'),
				'keterangan' 	=> $this->input->post('keterangan'),
			);
			$this->sub_bidang_ilmu_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data Bidang Ilmu Berhasil Ditambah');
			redirect(base_url() . 'sub_bidang_ilmu');
		}
	}

	// Edit bidang_ilmu/sub
	public function edit($id)
	{
		$sub_bidang_ilmu = $this->sub_bidang_ilmu_model->listing_sub_bidang_ilmu($id);
		// Tambah bidang_ilmu/sub, check validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data	= array(
				'title'		=> 'Edit Data Bidang Ilmu',
				'sub_bidang_ilmu'	=> $sub_bidang_ilmu,
				'isi'		=> 'masterdata/bidang_ilmu/sub/edit'
			);
			$this->load->view('layouts/dashboard', $data);
		} else {
			$data = array(
				'id'			=> $this->input->post('id'),
				'nama'			=> $this->input->post('nama'),
				'keterangan' 	=> $this->input->post('keterangan')
			);
			$this->sub_bidang_ilmu_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data Bidang Ilmu Berhasil Diupdate');
			redirect(base_url() . 'sub_bidang_ilmu/');
		}
	}

	//Edit Status
	public function	edit_status($id)
	{
		$sub_bidang_ilmu = $this->sub_bidang_ilmu_model->listing_sub_bidang_ilmu($id);
		$status = $this->input->post('status');

		$data = array(
			'id'		=> $this->input->post('id'),
			'status'		=> $status
		);

		$this->sub_bidang_ilmu_model->edit($data);
		$this->session->set_flashdata('sukses', 'Status Berhasil Diupdate');
		redirect(base_url() . 'sub_bidang_ilmu/');
	}

	// Delete bidang_ilmu/sub 
	public function delete($id)
	{
		$data = array('id'	=> $id);
		$this->sub_bidang_ilmu_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data Bidang Ilmu Berhasil Dihapus');
		redirect(base_url() . 'sub_bidang_ilmu/');
	}
}
