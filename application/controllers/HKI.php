<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HKI extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('HKI_Model'));
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
        $list = $this->HKI_Model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {
            $no++;
            $row = array();
            $row[]  = $pel->judul;
            $row[]  = $pel->jenis;
            $row[]  = $pel->keterangan;
            $row[]  = $pel->status;
            $row[]  =$pel->file;
            $row[]  =$pel->id;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->HKI_Model->count_all(),
            "recordsFiltered" => $this->HKI_Model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        $this->_validate();
        $kode = date('d-m-Y|H:i:s');
        $save  = array(
            'kdbuku'          => $kode,
            'nama'            => $this->input->post('nama'),
            'keterangan'      => $this->input->post('keterangan'),
            'sts'             => $this->input->post('sts')
        );
        $this->HKI_Model->insert_hki("tbl_hki", $save);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id      = $this->input->post('id');
        $save  = array(
            'kdbuku'        => $this->input->post('kdbuku'),
            'nama'          => $this->input->post('nama'),
            'keterangan'    => $this->input->post('keterangan'),
            'sts'           => $this->input->post('sts')
        );
        $this->HKI_Model->update_buku($id, $save);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_buku($id)
    {
        $data = $this->HKI_Model->get_buku($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->HKI_Model->delete_buku($id, 'buku');
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
            $data['error_string'][] = 'Nama Buku Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('keterangan') == '') {
            $data['inputerror'][] = 'keterangan';
            $data['error_string'][] = 'Keterangan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('sts') == '') {
            $data['inputerror'][] = 'sts';
            $data['error_string'][] = 'Status Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
