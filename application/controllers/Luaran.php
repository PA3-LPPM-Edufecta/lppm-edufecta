<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Luaran extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('luaran_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $this->template->load('admin/layouts/layoutbackend', 'admin/masterdata/luaran');
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

    public function editluaran($id)
    {
        $data = $this->luaran_model->getLuaran($id);
        echo json_encode($data);
    }

    public function insert()
    {
        $this->_validate();
        $save  = array(
            'nama'    => $this->input->post('nama'),
            'keterangan'      => $this->input->post('keterangan'),
            'status'       => $this->input->post('status'),
        );
        $this->luaran_model->insertluaran("tbl_luaran", $save);
        $insert_id = $this->db->insert_id();
        // $nama_luaran = $this->input->post('nama_luaran');
        // $get_id= $this->luaran_model->get_by_nama($nama_luaran);
        $id_level = $this->session->userdata['id_level'];
        $levels = $this->userlevel_model->getAll()->result();
        foreach ($levels as $row) {
            $data = array(
                'id_luaran' => $insert_id,
                'id_level'   => $row->id_level,
            );
            $this->luaran_model->insert_akses_luaran("tbl_akses_luaran", $data);
        }
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {

        $this->_validate();
        $id = $this->input->post('id');
        $data  = array(
            'nama'    => $this->input->post('nama'),
            'keterangan'      => $this->input->post('keterangan'),
            'status'       => $this->input->post('status'),
        );
        $this->luaran_model->updateluaran($id, $data);
        echo json_encode(array("status" => TRUE));
    }
    public function delete()
    {
        $id_luaran = $this->input->post('id_luaran');
        $this->luaran_model->deleteluaran($id_luaran, 'tbl_luaran');
        $this->luaran_model->deleteakses($id_luaran, 'tbl_akses_luaran');
        $data['status'] = TRUE;
        echo json_encode($data);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_luaran') == '') {
            $data['inputerror'][] = 'nama_luaran';
            $data['error_string'][] = 'Submenu is required';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }

        if ($this->input->post('link') == '') {
            $data['inputerror'][] = 'link';
            $data['error_string'][] = 'Link is required';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }

        if ($this->input->post('icon') == '') {
            $data['inputerror'][] = 'icon';
            $data['error_string'][] = 'Icon is required';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }

        if ($this->input->post('is_active') == '') {
            $data['inputerror'][] = 'is_active';
            $data['error_string'][] = 'Please select Status';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }

        if ($this->input->post('id_menu') == '') {
            $data['inputerror'][] = 'id_menu';
            $data['error_string'][] = 'Please select Menu';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
