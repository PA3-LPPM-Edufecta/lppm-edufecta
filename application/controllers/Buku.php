<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('buku_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $this->template->load('admin/layouts/layoutbackend', 'admin/masterdata/buku');
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->buku_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $buku) {
            $no++;
            $row = array();
            $row[] = $buku->kdbuku;
            $row[] = $buku->nama;
            $row[] = $buku->keterangan;
            $row[] = $buku->sts;
            $row[] = $buku->id;
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
        $this->buku_model->insert_buku("buku", $save);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id      = $this->input->post('id');
        $save  = array(
            'nama'          => $this->input->post('nama'),
            'keterangan'    => $this->input->post('keterangan'),
            'sts'           => $this->input->post('sts')
        );
        $this->buku_model->update_buku($id, $save);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_buku($id)
    {
        $data = $this->buku_model->get_buku($id);
        echo json_encode($data);
    }

    // //Edit Status
	// public function	edit_status($id)
	// {
	// 	$buku = $this->buku_model->get_buku($id);
	// 	$status = $this->input->post('status');
        
	// 	$save = array(
	// 		'id'		=> $this->input->post('id'),
	// 		'status'	=> $status
	// 	);
	// 	$this->buku_model->edit_status($id, $save);
    //     echo json_encode(array("status" => TRUE));
	// }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->buku_model->delete_buku($id, 'buku');
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
