<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Luaran extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('luaran_model');
	}

	// View luaran
	public function index()
	{
		$data	= array(
			'title'		=> 'Master Data - Luaran',
			'luaran'	=> $this->luaran_model->listing_luaran(),
			'isi'		=> 'masterdata/luaran/list'
		);
		$this->load->view('layouts/dashboard', $data);
	}

	// Tambah luaran
	public function tambah()
	{
		// Tambah luaran, check validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data	= array(
				'title'		=> 'Tambah Data',
				'isi'		=> 'masterdata/luaran/tambah'
			);
			$this->load->view('layouts/dashboard', $data);
		} else {
			$data = array(
				'nama'			=> $this->input->post('nama'),
				'keterangan' 	=> $this->input->post('keterangan'),
			);

			$this->luaran_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data Luaran Berhasil Ditambah');
			redirect(base_url() . 'masterdata/luaran');
		}
	}

	// Edit Luaran
	public function edit($id)
	{
		$luaran = $this->luaran_model->listing_luaran($id);
		// Tambah luaran, check validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data	= array(
				'title'		=> 'Edit Data',
				'luaran'	=> $luaran,
				'isi'		=> 'masterdata/luaran/edit'
			);
			$this->load->view('layouts/dashboard', $data);
		} else {
			$data = array(
				'id'			=> $this->input->post('id'),
				'nama'			=> $this->input->post('nama'),
				'keterangan' 	=> $this->input->post('keterangan')
			);
			$this->luaran_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data Luaran Berhasil Diupdate');
			redirect(base_url() . 'masterdata/luaran');
		}
	}

	//Edit Status
	public function	edit_status($id)
	{
		$luaran = $this->luaran_model->listing_luaran($id);
		$status = $this->input->post('status');

		$data = array(
			'id'		=> $this->input->post('id'),
			'status'		=> $status
		);

		$this->luaran_model->edit($data);
		$this->session->set_flashdata('sukses', 'Status Berhasil Diupdate');
		redirect(base_url() . 'masterdata/luaran');
	}

	// Delete Luaran 
	public function delete($id)
	{
		$data = array('id'	=> $id);
		$this->luaran_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data Luaran Berhasil Dihapus');
		redirect(base_url() . 'masterdata/luaran');
	}
}
