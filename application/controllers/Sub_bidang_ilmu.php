<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_bidang_ilmu extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('sub_bidang_ilmu_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $this->template->load('admin/layouts/layoutbackend', 'admin/masterdata/sub_bidang_ilmu');
    }

    public function ajax_list($id)
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->sub_bidang_ilmu_model->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        $n = 1;
        foreach ($list as $subbdgilmu) {
            $no++;
            $row = array();
            $row[] = $n++;  
            $row[] = $subbdgilmu->id_bidang_ilmu;
            $row[] = $subbdgilmu->nama;
            $row[] = $subbdgilmu->keterangan;
            $row[] = $subbdgilmu->status;
            $row[] = $subbdgilmu->id;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sub_bidang_ilmu_model->count_all(),
            "recordsFiltered" => $this->sub_bidang_ilmu_model->count_filtered($id),
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
            'id_bidang_ilmu'  => $this->input->post('id_bidang_ilmu'),
        );
        $this->sub_bidang_ilmu_model->insert_sub_bidang_ilmu("sub_bidang_ilmu", $save);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id      = $this->input->post('id');
        $data  = array(
            'nama'          => $this->input->post('nama'),
            'keterangan'    => $this->input->post('keterangan'),
            // 'status'        => $this->input->post('status')
        );
        $this->sub_bidang_ilmu_model->update_sub_bidang_ilmu($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function update_status()
    {
        $id      = $this->input->post('id');
        $status  = $this->input->post('status');
        if($status == 0){
            $data  = array(
                'status'        => 1,
            );
        } else {
            $data  = array(
                'status'        => 0,
            );
        }
        $this->sub_bidang_ilmu_model->update_sub_bidang_ilmu($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_sub_bidang_ilmu($id)
    {
        $data = $this->sub_bidang_ilmu_model->get_sub_bidang_ilmu($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->sub_bidang_ilmu_model->delete_sub_bidang_ilmu($id, 'sub_bidang_ilmu');
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
            $data['error_string'][] = 'Nama Sub Bidang Ilmu Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('keterangan') == '') {
            $data['inputerror'][] = 'keterangan';
            $data['error_string'][] = 'Keterangan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        // if ($this->input->post('status') == '') {
        //     $data['inputerror'][] = 'status';
        //     $data['error_string'][] = 'Status Tidak Boleh Kosong';
        //     $data['status'] = FALSE;
        // }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
