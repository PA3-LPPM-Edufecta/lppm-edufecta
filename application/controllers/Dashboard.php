<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
	}

	// Halaman dashboard
	public function index()
	{
		$data = array(	'title'					=> 'Dashboard',
						'isi'					=> 'pages/dashboard/list'
					);
		$this->load->view('layouts/dashboard', $data, FALSE);
	}

	public function dataluaran()
	{
		$data = array(	'title'					=> 'Luaran',
						'isi'					=> 'pages/masterdata/luaran'
					);
		$this->load->view('layouts/dashboard', $data, FALSE);
	}

	public function jenispencairan()
	{
		$data = array(	'title'					=> 'Jenis Pencarian',
						'isi'					=> 'pages/masterdata/jenis_pencairan'
					);
		$this->load->view('layouts/dashboard', $data, FALSE);
	}

	public function bidangilmu()
	{
		$data = array(	'title'					=> 'Bidang Ilmu',
						'isi'					=> 'pages/masterdata/bidangilmu'
					);
		$this->load->view('layouts/dashboard', $data, FALSE);
	}

	public function subbidangilmu()
	{
		$data = array(	'title'					=> 'Sub Bidang Ilmu',
						'isi'					=> 'pages/masterdata/sub_bidang_ilmu'
					);
		$this->load->view('layouts/dashboard', $data, FALSE);
	}

	public function skimpenelitian()
	{
		$data = array(	'title'					=> 'Skim Penelitian',
						'isi'					=> 'pages/masterdata/skim_penelitian'
					);
		$this->load->view('layouts/dashboard', $data, FALSE);
	}
}