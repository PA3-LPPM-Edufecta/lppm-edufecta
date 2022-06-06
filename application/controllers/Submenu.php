<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('submenu_model', 'menu_model'));
        $this->load->model(array('userlevel_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $data['menu'] = $this->menu_model->getAll()->result();
        $this->template->load('admin/layouts/layoutbackend', 'admin/settings/submenu_data', $data);
    }

    public function ajax_list()
    {
        $list = $this->submenu_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $submenu) {
            $no++;
            $row = array();
            $row[] = $submenu->nama_submenu;
            $row[] = $submenu->link;
            $row[] = $submenu->icon;
            $row[] = $submenu->nama_menu;
            $row[] = $submenu->is_active;
            $row[] = $submenu->id_submenu;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->submenu_model->count_all(),
            "recordsFiltered" => $this->submenu_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function viewsubmenu()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $data_field = $this->db->field_data($table);
        $detail = $this->submenu_model->view_submenu($id)->result_array();
        $data = array(
            'table' => $table,
            'data_field' => $this->db->field_data($table),
            'data_table' => $detail,
        );
        $this->load->view('admin/settings/view', $data);
    }

    public function editsubmenu($id)
    {

        $data = $this->submenu_model->get_submenu($id);
        echo json_encode($data);
    }

    public function insert()
    {
        $this->_validate();
        $save  = array(
            'nama_submenu'    => $this->input->post('nama_submenu'),
            'link'      => $this->input->post('link'),
            'icon'       => $this->input->post('icon'),
            'id_menu'      => $this->input->post('id_menu'),
            'is_active' => $this->input->post('is_active')
        );
        $this->submenu_model->insertsubmenu("tbl_submenu", $save);
        $insert_id = $this->db->insert_id();
        // $nama_submenu = $this->input->post('nama_submenu');
        // $get_id= $this->submenu_model->get_by_nama($nama_submenu);
        $id_level = $this->session->userdata['id_level'];
        $levels = $this->userlevel_model->getAll()->result();
        foreach ($levels as $row) {
            $data = array(
                'id_submenu' => $insert_id,
                'id_level'   => $row->id_level,
            );
            $this->submenu_model->insert_akses_submenu("tbl_akses_submenu", $data);
        }
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {

        $this->_validate();
        $id = $this->input->post('id');
        $data  = array(
            'nama_submenu' => $this->input->post('nama_submenu'),
            'link'      => $this->input->post('link'),
            'icon'      => $this->input->post('icon'),
            'id_menu'    => $this->input->post('id_menu'),
            'is_active' => $this->input->post('is_active')
        );
        $this->submenu_model->updatesubmenu($id, $data);
        echo json_encode(array("status" => TRUE));
    }
    
    public function delete()
    {
        $id_submenu = $this->input->post('id_submenu');
        $this->submenu_model->deletesubmenu($id_submenu, 'tbl_submenu');
        $this->submenu_model->deleteakses($id_submenu, 'tbl_akses_submenu');
        $data['status'] = TRUE;
        echo json_encode($data);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_submenu') == '') {
            $data['inputerror'][] = 'nama_submenu';
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
