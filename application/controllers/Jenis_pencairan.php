<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_pencairan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('jenis_pencairan_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $this->template->load('admin/layouts/layoutbackend', 'admin/masterdata/jenis_pencairan');
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->jenis_pencairan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pencairan) {
            $no++;
            $row = array(); //array 0
            $row[] = $pencairan->nama; //array 1
            $row[] = $pencairan->keterangan; //array 2
            $row[] = $pencairan->status; //array 3
            $row[] = $pencairan->id;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->jenis_pencairan_model->count_all(),
            "recordsFiltered" => $this->jenis_pencairan_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        $this->_validate();
        $save  = array(
            'nama'           => $this->input->post('nama'),
            'keterangan'     => $this->input->post('keterangan'),
            'status'            => $this->input->post('status')
        );
        $this->jenis_pencairan_model->insert_jenis_pencairan("jenis_pencairan", $save);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id      = $this->input->post('id');
        $save  = array(
            'nama'            => $this->input->post('nama'),
            'keterangan'      => $this->input->post('keterangan'),
            'status'             => $this->input->post('status')
        );
        $this->jenis_pencairan_model->update_jenis_pencairan($id, $save);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_jenis_pencairan($id)
    {
        $data = $this->jenis_pencairan_model->get_jenis_pencairan($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->jenis_pencairan_model->delete_jenis_pencairan($id, 'jenis_pencairan');
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
            $data['error_string'][] = 'Nama Tidak Boleh Kosong';
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