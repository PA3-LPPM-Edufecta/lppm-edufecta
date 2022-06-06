<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pencairan extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('masterdata/pencairan_model');
	}

	// View pencairan
	public function index()
	{
		$data	= array(
			'title'		=> 'Master Data - Pencairan',
			'pencairan'	=> $this->pencairan_model->listing_pencairan(),
			'isi'		=> 'admin/masterdata/pencairan/list'
		);
		$this->load->view('admin/layouts/layoutbackend', $data);
	}

	// Tambah pencairan
	public function tambah()
	{
		// Tambah pencairan, check validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data	= array(
				'title'		=> 'Tambah Data',
				'isi'		=> 'admin/masterdata/pencairan/tambah'
			);
			$this->load->view('admin/layouts/layoutbackend', $data);
		} else {
			$data = array(
				'nama'			=> $this->input->post('nama'),
			);
			$this->pencairan_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data Pencairan Berhasil Ditambah');
			redirect(base_url() . 'pencairan');
		}
	}

	// Edit pencairan
	public function edit($id)
	{
		$pencairan = $this->pencairan_model->listing_pencairan($id);
		// Tambah pencairan, check validasi
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data	= array(
				'title'		=> 'Edit Data',
				'pencairan'	=> $pencairan,
				'isi'		=> 'admin/masterdata/pencairan/edit'
			);
			$this->load->view('admin/layouts/layoutbackend', $data);
		} else {
			$data = array(
				'id'			=> $this->input->post('id'),
				'nama'			=> $this->input->post('nama'),
			);
			$this->pencairan_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data Pencairan Berhasil Diupdate');
			redirect(base_url() . 'pencairan');
		}
	}

	//Edit Status
	public function	edit_status($id)
	{
		$pencairan = $this->pencairan_model->listing_pencairan($id);
		$status = $this->input->post('status');

		$data = array(
			'id'		=> $this->input->post('id'),
			'status'		=> $status
		);

		$this->pencairan_model->edit($data);
		$this->session->set_flashdata('sukses', 'Status Berhasil Diupdate');
		redirect(base_url() . 'pencairan');
	}

	// Delete pencairan 
	public function delete($id)
	{
		$data = array('id'	=> $id);
		$this->pencairan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data Pencairan Berhasil Dihapus');
		redirect(base_url() . 'pencairan');
	}
}
