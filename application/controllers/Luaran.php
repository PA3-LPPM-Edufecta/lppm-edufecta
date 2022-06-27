<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Luaran extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('luaran_model', 'akses_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $id_user = $this->session->userdata['id_user'];
        $id_level = $this->akses_model->get_id_level($id_user)->row()->id_level;
        $id_submenu = 9;
        $view_level = $this->akses_model->get_level($id_level, $id_submenu)->row()->view_level;
        $data['add_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->add_level;
        $data['edit_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->edit_level;
        $data['delete_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->delete_level;
        $data['print_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->print_level;

        if ($view_level == 'Y') {
            return $this->template->load('admin/layouts/layoutbackend', 'admin/masterdata/luaran', $data);
        } else {
            return $this->template->load('admin/layouts/layouterror', 'errors/custom403');
        }
    }

    public function ajax_list()
    {
        $list = $this->luaran_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $luaran) {
            $no++;
            $row = array();
            $row[] = $luaran->nama;
            $row[] = $luaran->keterangan;
            $row[] = $luaran->status;
            $row[] = $luaran->id;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->luaran_model->count_all(),
            "recordsFiltered" => $this->luaran_model->count_filtered(),
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
            // 'status'       => $this->input->post('status')
        );
        $this->luaran_model->insert_luaran("luaran", $save);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {

        $this->_validate();
        $id = $this->input->post('id');
        $data  = array(
            'nama'    => $this->input->post('nama'),
            'keterangan'      => $this->input->post('keterangan'),
            // 'status'       => $this->input->post('status'),
        );
        $this->luaran_model->update_luaran($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_luaran($id)
    {
        $data = $this->luaran_model->getLuaran($id);
        echo json_encode($data);
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
        $this->luaran_model->update_luaran($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->luaran_model->delete_luaran($id, 'luaran');
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
            $data['error_string'][] = 'Nama is required';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }

        if ($this->input->post('keterangan') == '') {
            $data['inputerror'][] = 'keterangan';
            $data['error_string'][] = 'Keterangan is required';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
