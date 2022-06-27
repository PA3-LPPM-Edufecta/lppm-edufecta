<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('menu_model', 'akses_model'));
        $this->load->model(array('userlevel_model'));
    }

    public function index()
    {
        // $this->load->helper('url');
        $id_user = $this->session->userdata['id_user'];
        $id_level = $this->akses_model->get_id_level($id_user)->row()->id_level;
        $id_submenu = 1;
        $view_level = $this->akses_model->get_level($id_level, $id_submenu)->row()->view_level;

        if ($view_level == 'Y') {
            return $this->template->load('admin/layouts/layoutbackend', 'admin/settings/menu_data');
        } else {
            return $this->template->load('admin/layouts/layouterror', 'errors/custom403');
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        //set_time_limit(3600);
        $list = $this->menu_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $menu) {
            $no++;
            $row = array();
            $row[] = $menu->nama_menu;
            $row[] = $menu->link;
            $row[] = $menu->icon;
            $row[] = $menu->urutan;
            $row[] = $menu->is_active;
            $row[] = $menu->id_menu;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->menu_model->count_all(),
            "recordsFiltered" => $this->menu_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function addmenu()
    {
        $this->load->view('menu/add_menu');
    }

    public function viewmenu()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $data['table'] = $table;
        $data['data_field'] = $this->db->field_data($table);
        $data['data_table'] = $this->menu_model->view_menu($id)->result_array();
        $this->load->view('admin/settings/view', $data);
    }

    public function editmenu($id)
    {
        $data = $this->menu_model->get_menu($id);
        echo json_encode($data);
    }

    public function insert()
    {
        $this->_validate();
        $save  = array(
            'nama_menu'    => $this->input->post('nama_menu'),
            'link'      => $this->input->post('link'),
            'icon'       => $this->input->post('icon'),
            'urutan'      => $this->input->post('urutan'),
            'is_active' => $this->input->post('is_active')
        );
        $this->menu_model->insertMenu("tbl_menu", $save);
        // $id_level = $this->session->userdata['id_level'];
        $nama_menu = $this->input->post('nama_menu');
        $get_id = $this->menu_model->get_nama_menu($nama_menu);
        $levels = $this->userlevel_model->getAll()->result();
        foreach ($levels as $row) {
            $data = array(
                'id_menu'   => $get_id->id_menu,
                'id_level'  => $row->id_level,
                'view_level' => 'N'
            );
            //insert ke akses menu
            $this->menu_model->insertaksesmenu("tbl_akses_menu", $data);
        }

        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id_menu      = $this->input->post('id_menu');
        $save  = array(
            'nama_menu' => $this->input->post('nama_menu'),
            'link'      => $this->input->post('link'),
            'icon'      => $this->input->post('icon'),
            'urutan'    => $this->input->post('urutan'),
            'is_active' => $this->input->post('is_active')
        );
        $this->menu_model->updateMenu($id_menu, $save);
        echo json_encode(array("status" => TRUE));
    }
    public function delete()
    {
        $id_menu = $this->input->post('id_menu');
        $this->menu_model->deleteMenu($id_menu, 'tbl_menu');
        $this->menu_model->deleteakses($id_menu, 'tbl_akses_menu');
        $ceksubmenu = $this->userlevel_model->getIdsubmenu($id_menu)->result();
        foreach ($ceksubmenu as $row) {
            $idsubmenu = $row->id_submenu;
            $this->menu_model->deleteakses_submenu($idsubmenu, 'tbl_akses_submenu');
        }

        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_menu') == '') {
            $data['inputerror'][] = 'nama_menu';
            $data['error_string'][] = 'Menu is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('link') == '') {
            $data['inputerror'][] = 'link';
            $data['error_string'][] = 'Link is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('icon') == '') {
            $data['inputerror'][] = 'icon';
            $data['error_string'][] = 'Icon is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('is_active') == '') {
            $data['inputerror'][] = 'is_active';
            $data['error_string'][] = 'Please select Status';
            $data['status'] = FALSE;
        }

        if ($this->input->post('urutan') == '') {
            $data['inputerror'][] = 'urutan';
            $data['error_string'][] = 'Urutan is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
