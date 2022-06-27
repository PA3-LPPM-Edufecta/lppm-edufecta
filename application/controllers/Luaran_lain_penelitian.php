<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Luaran_lain_penelitian extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Luaran_lain_penelitian_model', 'Data_dosen_model', 'akses_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $data['mst_dosen'] = $this->Data_dosen_model->getAll()->result();
        $id_user = $this->session->userdata['id_user'];
        $id_level = $this->akses_model->get_id_level($id_user)->row()->id_level;
        $id_submenu = 26;
        $view_level = $this->akses_model->get_level($id_level, $id_submenu)->row()->view_level;
        $data['add_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->add_level;
        $data['edit_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->edit_level;
        $data['delete_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->delete_level;
        $data['print_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->print_level;

        if ($view_level == 'Y') {
            return $this->template->load('admin/layouts/layoutbackend', 'admin/kinerja_penelitian/luaran_lain_penelitian', $data);
        } else {
            return $this->template->load('admin/layouts/layouterror', 'errors/custom403');
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        //set_time_limit(3600);
        $list = $this->Luaran_lain_penelitian_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $luaranlain) {
            $no++;
            $row = array();
            $row[] = $luaranlain->gelar_depan;
            $row[] = $luaranlain->nama;
            $row[] = $luaranlain->id_dosen;
            $row[] = $luaranlain->nama_tipe_pengajuan;
            $row[] = $luaranlain->gelar_belakang;
            $row[] = $luaranlain->id_tipe_pengajuan;
            $row[] = $luaranlain->nidn;
            $row[] = $luaranlain->judul;
            $row[] = $luaranlain->jenis;
            $row[] = $luaranlain->deskripsi;
            $row[] = $luaranlain->tanggal;
            $row[] = $luaranlain->file;
            $row[] = $luaranlain->status;
            $row[] = $luaranlain->id;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Luaran_lain_penelitian_model->count_all(),
            "recordsFiltered" => $this->Luaran_lain_penelitian_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            $this->_validate();
            $id = $this->input->post('id');

            $nama = slug($this->input->post('file'));
            $config['upload_path']   = './assets/uploads/foto/cover/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf'; //mencegah upload backdor
            $config['max_size']      = '3000';
            $config['max_width']     = '3000';
            $config['max_height']    = '3000';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                $idluar= 1;

                $save  = array(
                    'id_tipe_pengajuan'     => $idluar,
                    'id_dosen'              => $this->input->post('id_dosen'),
                    'judul'                 => $this->input->post('judul'),
                    'jenis'                 => $this->input->post('jenis'),
                    'deskripsi'             => $this->input->post('deskripsi'),
                    'tanggal'               => $this->input->post('tanggal'),
                    'file'                  => $gambar['file_name']
                );

                $g = $this->Luaran_lain_penelitian_model->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/uploads/foto/cover/' . $g['file']);
                }

                $this->Luaran_lain_penelitian_model->insert_luaran("tbl_luaran_lain", $save);
                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $idluar= 1;
                $save  = array(
                    'id_tipe_pengajuan'     => $idluar,
                    'id_dosen'              => $this->input->post('id_dosen'),
                    'judul'                 => $this->input->post('judul'),
                    'jenis'                 => $this->input->post('jenis'),
                    'deskripsi'             => $this->input->post('deskripsi'),
                    'tanggal'               => $this->input->post('tanggal'),
                );
                $this->Luaran_lain_penelitian_model->insert_luaran("tbl_luaran_lain", $save);
                echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id = $this->input->post('id');
            $idluar = 1;
            $save  = array(
                'id_tipe_pengajuan'     => $idluar,
                'id_dosen'              => $this->input->post('id_dosen'),
                'judul'                 => $this->input->post('judul'),
                'jenis'                 => $this->input->post('jenis'),
                'deskripsi'             => $this->input->post('deskripsi'),
                'tanggal'               => $this->input->post('tanggal'),
            );
            $this->Luaran_lain_penelitian_model->insert_luaran("tbl_luaran_lain", $save);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function update()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            $id = $this->input->post('id');

            $nama = slug($this->input->post('file'));
            $config['upload_path']   = './assets/uploads/foto/cover/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf'; //mencegah upload backdor
            $config['max_size']      = '3000';
            $config['max_width']     = '3000';
            $config['max_height']    = '3000';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                $save  = array(
                    'id_dosen' => $this->input->post('id_dosen'),
                    'judul'  => $this->input->post('judul'),
                    'jenis'  => $this->input->post('jenis'),
                    'deskripsi'             => $this->input->post('deskripsi'),
                    'tanggal' => $this->input->post('tanggal'),
                    'file' => $gambar['file_name']
                );

                $g = $this->Luaran_lain_penelitian_model->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/uploads/foto/cover/' . $g['file']);
                }

                $this->Luaran_lain_penelitian_model->update_luaran($id, $save);
                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'id_dosen' => $this->input->post('id_dosen'),
                    'judul'  => $this->input->post('judul'),
                    'jenis'  => $this->input->post('jenis'),
                    'deskripsi'             => $this->input->post('deskripsi'),
                    'tanggal' => $this->input->post('tanggal'),
                );
                $this->Luaran_lain_penelitian_model->update_luaran($id, $save);
                echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id = $this->input->post('id');
            $save  = array(
                'id_dosen' => $this->input->post('id_dosen'),
                'judul'  => $this->input->post('judul'),
                'jenis'  => $this->input->post('jenis'),
                'deskripsi'     => $this->input->post('deskripsi'),
                'deskripsi'             => $this->input->post('deskripsi'),
                'tanggal' => $this->input->post('tanggal'),
            );
            $this->Luaran_lain_penelitian_model->update_luaran($id, $save);
            echo json_encode(array("status" => TRUE));
        }
    }
    
    
    public function viewluaran()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $data['table'] = $table;
        $data['data_field'] = $this->db->field_data($table);
        $data['data_table'] = $this->Luaran_lain_penelitian_model->view_luaran($id)->result_array();
        $this->load->view('admin/settings/view', $data);
    }

    public function edit_luaran($id)
    {
        $data = $this->Luaran_lain_penelitian_model->get_luaran($id);
        echo json_encode($data);
    }

    public function update_status()
    {
        $id      = $this->input->post('id');
        $status  = $this->input->post('status');
        if ($status == 0) {
            $data  = array(
                'status'        => 1,
            );
        } else {
            $data  = array(
                'status'        => 0,
            );
        }
        $this->Luaran_lain_penelitian_model->update_luaran($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $g = $this->Luaran_lain_penelitian_model->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/uploads/foto/cover/' . $g['file']);
        }
        $this->Luaran_lain_penelitian_model->delete_luaran($id, 'tbl_luaran_lain');
        $data['status'] = TRUE;
        echo json_encode($data);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('id_dosen') == '') {
            $data['inputerror'][] = 'id_dosen';
            $data['error_string'][] = 'Pilih Dosen Terlebih Dahulu';
            $data['status'] = FALSE;
        }

        if ($this->input->post('judul') == '') {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = 'Judul is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('jenis') == '') {
            $data['inputerror'][] = 'jenis';
            $data['error_string'][] = 'Jenis is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('deskripsi') == '') {
            $data['inputerror'][] = 'deskripsi';
            $data['error_string'][] = 'Deskripsi is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tanggal') == '') {
            $data['inputerror'][] = 'tanggal';
            $data['error_string'][] = 'Tanggal Is required';
            $data['status'] = FALSE;
        }

        // if ($this->input->post('file') == '') {
        //     $data['inputerror'][] = 'file';
        //     $data['error_string'][] = 'File Is required';
        //     $data['minlength'] = '2';
        //     $data['status'] = FALSE;
        // }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
