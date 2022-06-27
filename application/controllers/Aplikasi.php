<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aplikasi extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('aplikasi_model','akses_model'));
    }

    public function index()
    {
        $id_user = $this->session->userdata['id_user'];
        $id_level = $this->akses_model->get_id_level($id_user)->row()->id_level;
        $id_submenu = 1;
        $view_level = $this->akses_model->get_level($id_level, $id_submenu)->row()->view_level;

        if ($view_level == 'Y') {
            return $this->template->load('admin/layouts/layoutbackend', 'admin/settings/aplikasi');
        } else {
            return $this->template->load('admin/layouts/layouterror', 'errors/custom403');
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        //set_time_limit(3600);
        $list = $this->aplikasi_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $apl) {
            $no++;
            $row = array();
            $row[] = $apl->nama_owner;
            $row[] = $apl->alamat;
            $row[] = $apl->tlp;
            $row[] = $apl->title;
            $row[] = $apl->nama_aplikasi;
            $row[] = $apl->copy_right;
            $row[] = $apl->versi;
            $row[] = $apl->tahun;
            $row[] = $apl->logo;
            $row[] = $apl->id;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->aplikasi_model->count_all(),
            "recordsFiltered" => $this->aplikasi_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function edit_aplikasi($id)
    {

        $data = $this->aplikasi_model->getAplikasi($id);
        echo json_encode($data);
    }

    public function update()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            $this->_validate();
            $id = $this->input->post('id');

            $nama = slug($this->input->post('logo'));
            $config['upload_path']   = './assets/uploads/foto/logo/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '3000';
            $config['max_width']     = '3000';
            $config['max_height']    = '3000';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                $save  = array(
                    'nama_owner' => $this->input->post('nama_owner'),
                    'title' => $this->input->post('title'),
                    'nama_aplikasi'  => $this->input->post('nama_aplikasi'),
                    'copy_right'  => $this->input->post('copy_right'),
                    'tahun' => $this->input->post('tahun'),
                    'versi' => $this->input->post('versi'),
                    'logo' => $gambar['file_name']
                );

                $g = $this->aplikasi_model->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/uploads/foto/logo/' . $g['logo']);
                }

                $this->aplikasi_model->updateAplikasi($id, $save);
                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'nama_owner' => $this->input->post('nama_owner'),
                    'title' => $this->input->post('title'),
                    'nama_aplikasi'  => $this->input->post('nama_aplikasi'),
                    'copy_right'  => $this->input->post('copy_right'),
                    'tahun' => $this->input->post('tahun'),
                    'versi' => $this->input->post('versi')
                );
                $this->aplikasi_model->updateAplikasi($id, $save);
                echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id = $this->input->post('id');
            $save  = array(
                'nama_owner' => $this->input->post('nama_owner'),
                'alamat'    => $this->input->post('alamat'),
                'tlp'       => $this->input->post('tlp'),
                'title' => $this->input->post('title'),
                'nama_aplikasi'  => $this->input->post('nama_aplikasi'),
                'copy_right'  => $this->input->post('copy_right'),
                'tahun' => $this->input->post('tahun'),
                'versi' => $this->input->post('versi')
            );
            $this->aplikasi_model->updateAplikasi($id, $save);
            echo json_encode(array("status" => TRUE));
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_owner') == '') {
            $data['inputerror'][] = 'nama_owner';
            $data['error_string'][] = 'Nama PT Tidak Boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nama_aplikasi') == '') {
            $data['inputerror'][] = 'nama_aplikasi';
            $data['error_string'][] = 'Nama Aplikasi Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('alamat') == '') {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tlp') == '') {
            $data['inputerror'][] = 'tlp';
            $data['error_string'][] = 'No Telpon Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('title') == '') {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Title Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('copy_right') == '') {
            $data['inputerror'][] = 'copy_right';
            $data['error_string'][] = 'Copy Right tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tahun') == '') {
            $data['inputerror'][] = 'tahun';
            $data['error_string'][] = 'Tahun tidak boleh kosong';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
