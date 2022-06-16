<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tipe_pengajuan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('tipe_pengajuan_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $this->template->load('admin/layouts/layoutbackend', 'admin/kinerja_penelitian/HKI');
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->tipe_pengajuan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $tipe) {
            $no++;
            $row = array();
            $row[] = $tipe->nama;
            $row[] = $tipe->id;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->buku_model->count_all(),
            "recordsFiltered" => $this->buku_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
