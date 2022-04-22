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
}