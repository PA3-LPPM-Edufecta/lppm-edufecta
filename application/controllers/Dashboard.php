<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
	}

	// Halaman dasboard
	public function index()
	{
		$this->load->view('layouts/dashboard');
	}
}