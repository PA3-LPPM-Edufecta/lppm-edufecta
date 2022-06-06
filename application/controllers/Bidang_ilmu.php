<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidang_ilmu extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('bidang_ilmu_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $this->template->load('admin/layouts/layoutbackend', 'admin/masterdata/bidang_ilmu');
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->bidang_ilmu_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $bdgilmu) {
            $no++;
            $row = array();
            $row[] = $bdgilmu->nama;
            $row[] = $bdgilmu->keterangan;
            $row[] = $bdgilmu->status;
            $row[] = $bdgilmu->id;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->bidang_ilmu_model->count_all(),
            "recordsFiltered" => $this->bidang_ilmu_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        $this->_validate();
        $save  = array(
            'nama'            => $this->input->post('nama'),
            'keterangan'      => $this->input->post('keterangan'),
            'status'             => $this->input->post('status')
        );
        $this->bidang_ilmu_model->insert_bidang_ilmu("bidang_ilmu", $save);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id      = $this->input->post('id');
        $data  = array(
            'nama'          => $this->input->post('nama'),
            'keterangan'    => $this->input->post('keterangan'),
            'status'        => $this->input->post('status')
        );
        $this->bidang_ilmu_model->update_bidang_ilmu($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_bidang_ilmu($id)
    {
        $data = $this->bidang_ilmu_model->get_bidang_ilmu($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->bidang_ilmu_model->delete_bidang_ilmu($id, 'bidang_ilmu');
        echo json_encode(array("status" => TRUE));
    }
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        
        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama Bidang Ilmu Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('keterangan') == '') {
            $data['inputerror'][] = 'keterangan';
            $data['error_string'][] = 'Keterangan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('status') == '') {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
