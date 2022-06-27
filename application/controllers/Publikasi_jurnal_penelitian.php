<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publikasi_jurnal_penelitian extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Publikasi_jurnal_penelitian_model', 'Data_dosen_model', 'Tipe_pengajuan_model', 'akses_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $data['mst_dosen'] = $this->Data_dosen_model->getAll()->result();
        $id_user = $this->session->userdata['id_user'];
        $id_level = $this->akses_model->get_id_level($id_user)->row()->id_level;
        $id_submenu = 27;
        $view_level = $this->akses_model->get_level($id_level, $id_submenu)->row()->view_level;
        $data['add_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->add_level;
        $data['edit_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->edit_level;
        $data['delete_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->delete_level;
        $data['print_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->print_level;

        if ($view_level == 'Y') {
            return $this->template->load('admin/layouts/layoutbackend', 'admin/kinerja_penelitian/publikasi_jurnal_penelitian', $data);
        } else {
            return $this->template->load('admin/layouts/layouterror', 'errors/custom403');
        }
    }

    public function ajax_list()
    {
        $list = $this->Publikasi_jurnal_penelitian_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pubjurnal) {
            $no++;
            $row = array();
            $row[] = $pubjurnal->gelar_depan;
            $row[] = $pubjurnal->nama;
            $row[] = $pubjurnal->id_dosen;
            $row[] = $pubjurnal->nama_tipe_pengajuan;
            $row[] = $pubjurnal->gelar_belakang;
            $row[] = $pubjurnal->id_tipe_pengajuan;
            $row[] = $pubjurnal->nidn;
            $row[] = $pubjurnal->judul;
            $row[] = $pubjurnal->nama_pubjurnal;
            $row[] = $pubjurnal->issn;
            $row[] = $pubjurnal->volume;
            $row[] = $pubjurnal->nomor;
            $row[] = $pubjurnal->halaman;
            $row[] = $pubjurnal->sebagai_penulis_ke;
            $row[] = $pubjurnal->url;
            $row[] = $pubjurnal->tanggal;
            $row[] = $pubjurnal->file;
            $row[] = $pubjurnal->status;
            $row[] = $pubjurnal->id;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Publikasi_jurnal_penelitian_model->count_all(),
            "recordsFiltered" => $this->Publikasi_jurnal_penelitian_model->count_filtered(),
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
                $idpeng = 1;

                $save  = array(
                    'id_tipe_pengajuan'     => $idpeng,
                    'id_dosen'              => $this->input->post('id_dosen'),
                    'judul'                 => $this->input->post('judul'),
                    'nama_pubjurnal'        => $this->input->post('nama_pubjurnal'),
                    'issn'                  => $this->input->post('issn'),
                    'volume'                => $this->input->post('volume'),
                    'nomor'                 => $this->input->post('nomor'),
                    'halaman'               => $this->input->post('halaman'),
                    'sebagai_penulis_ke'    => $this->input->post('sebagai_penulis_ke'),
                    'url'                   => $this->input->post('url'),
                    'tanggal'               => $this->input->post('tanggal'),
                    'file'                  => $gambar['file_name']
                );

                $g = $this->Publikasi_jurnal_penelitian_model->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/uploads/foto/cover/' . $g['file']);
                }

                $this->Publikasi_jurnal_penelitian_model->insert_publikasi_jurnal("tbl_publikasi_jurnal", $save);
                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $idpeng = 1;
                $save  = array(
                    'id_tipe_pengajuan'     => $idpeng,
                    'id_dosen'              => $this->input->post('id_dosen'),
                    'judul'                 => $this->input->post('judul'),
                    'nama_pubjurnal'                  => $this->input->post('nama_pubjurnal'),
                    'issn'                  => $this->input->post('issn'),
                    'volume'                => $this->input->post('volume'),
                    'nomor'                 => $this->input->post('nomor'),
                    'halaman'               => $this->input->post('halaman'),
                    'sebagai_penulis_ke'    => $this->input->post('sebagai_penulis_ke'),
                    'url'                   => $this->input->post('url'),
                    'tanggal'               => $this->input->post('tanggal'),
                );
                $this->Publikasi_jurnal_penelitian_model->insert_publikasi_jurnal("tbl_publikasi_jurnal", $save);
                echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id = $this->input->post('id');
            $idpeng = 1;
            $save  = array(
                'id_tipe_pengajuan'     => $idpeng,
                'id_dosen'              => $this->input->post('id_dosen'),
                'judul'                 => $this->input->post('judul'),
                'nama_pubjurnal'                  => $this->input->post('nama_pubjurnal'),
                'issn'                  => $this->input->post('issn'),
                'volume'                => $this->input->post('volume'),
                'nomor'                 => $this->input->post('nomor'),
                'halaman'               => $this->input->post('halaman'),
                'sebagai_penulis_ke'    => $this->input->post('sebagai_penulis_ke'),
                'url'                   => $this->input->post('url'),
                'tanggal'               => $this->input->post('tanggal'),
            );
            $this->Publikasi_jurnal_penelitian_model->insert_publikasi_jurnal("tbl_publikasi_jurnal", $save);
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
                    'id_dosen'              => $this->input->post('id_dosen'),
                    'judul'                 => $this->input->post('judul'),
                    'nama_pubjurnal'                  => $this->input->post('nama_pubjurnal'),
                    'issn'                  => $this->input->post('issn'),
                    'volume'                => $this->input->post('volume'),
                    'nomor'                 => $this->input->post('nomor'),
                    'halaman'               => $this->input->post('halaman'),
                    'sebagai_penulis_ke'    => $this->input->post('sebagai_penulis_ke'),
                    'url'                   => $this->input->post('url'),
                    'tanggal'               => $this->input->post('tanggal'),
                    'file' => $gambar['file_name']
                );

                $g = $this->Publikasi_jurnal_penelitian_model->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/uploads/foto/cover/' . $g['file']);
                }

                $this->Publikasi_jurnal_penelitian_model->update_publikasi_jurnal($id, $save);
                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'id_dosen'              => $this->input->post('id_dosen'),
                    'judul'                 => $this->input->post('judul'),
                    'nama_pubjurnal'                  => $this->input->post('nama_pubjurnal'),
                    'issn'                  => $this->input->post('issn'),
                    'volume'                => $this->input->post('volume'),
                    'nomor'                 => $this->input->post('nomor'),
                    'halaman'               => $this->input->post('halaman'),
                    'sebagai_penulis_ke'    => $this->input->post('sebagai_penulis_ke'),
                    'url'                   => $this->input->post('url'),
                    'tanggal'               => $this->input->post('tanggal'),
                );
                $this->Publikasi_jurnal_penelitian_model->update_publikasi_jurnal($id, $save);
                echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id = $this->input->post('id');
            $save  = array(
                'id_dosen'              => $this->input->post('id_dosen'),
                'judul'                 => $this->input->post('judul'),
                'nama_pubjurnal'                  => $this->input->post('nama_pubjurnal'),
                'issn'                  => $this->input->post('issn'),
                'volume'                => $this->input->post('volume'),
                'nomor'                 => $this->input->post('nomor'),
                'halaman'               => $this->input->post('halaman'),
                'sebagai_penulis_ke'    => $this->input->post('sebagai_penulis_ke'),
                'url'                   => $this->input->post('url'),
                'tanggal'               => $this->input->post('tanggal'),
            );
            $this->Publikasi_jurnal_penelitian_model->update_publikasi_jurnal($id, $save);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function viewjurnal()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $data['table'] = $table;
        $data['data_field'] = $this->db->field_data($table);
        $data['data_table'] = $this->Publikasi_jurnal_penelitian_model->view_publikasi_jurnal($id)->result_array();
        $this->load->view('admin/settings/view', $data);
    }

    public function edit_publikasi_jurnal($id)
    {
        $data = $this->Publikasi_jurnal_penelitian_model->get_publikasi_jurnal($id);
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
        $this->Publikasi_jurnal_penelitian_model->update_publikasi_jurnal($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $g = $this->Publikasi_jurnal_penelitian_model->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/uploads/foto/cover/' . $g['file']);
        }
        $this->Publikasi_jurnal_penelitian_model->delete_publikasi_jurnal($id, 'tbl_publikasi_jurnal');
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

        if ($this->input->post('nama_pubjurnal') == '') {
            $data['inputerror'][] = 'nama_pubjurnal';
            $data['error_string'][] = 'Nama is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('issn') == '') {
            $data['inputerror'][] = 'issn';
            $data['error_string'][] = 'ISSN is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('volume') == '') {
            $data['inputerror'][] = 'volume';
            $data['error_string'][] = 'Volume is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nomor') == '') {
            $data['inputerror'][] = 'nomor';
            $data['error_string'][] = 'Nomor is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('halaman') == '') {
            $data['inputerror'][] = 'halaman';
            $data['error_string'][] = 'Halaman is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('sebagai_penulis_ke') == '') {
            $data['inputerror'][] = 'sebagai_penulis_ke';
            $data['error_string'][] = 'Penulis is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('url') == '') {
            $data['inputerror'][] = 'url';
            $data['error_string'][] = 'URL is required';
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
