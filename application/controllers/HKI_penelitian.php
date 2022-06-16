<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HKI_penelitian extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('HKI_penelitian_model', 'Data_dosen_model', 'Tipe_pengajuan_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $data['mst_dosen'] = $this->Data_dosen_model->getAll()->result();
        $this->template->load('admin/layouts/layoutbackend', 'admin/kinerja_penelitian/HKI_penelitian', $data);
    }

    public function ajax_list()
    {
        $list = $this->HKI_penelitian_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $hki) {
            $no++;
            $row = array();
            $row[] = $hki->gelar_depan;
            $row[] = $hki->nama;
            $row[] = $hki->id_dosen;
            $row[] = $hki->nama_tipe_pengajuan;
            $row[] = $hki->gelar_belakang;
            $row[] = $hki->id_tipe_pengajuan;
            $row[] = $hki->nidn;
            $row[] = $hki->judul;
            $row[] = $hki->jenis;
            $row[] = $hki->nomor_pendaftaran;
            $row[] = $hki->nomor_hki;
            $row[] = $hki->tanggal;
            $row[] = $hki->file;
            $row[] = $hki->status;
            $row[] = $hki->id;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->HKI_penelitian_model->count_all(),
            "recordsFiltered" => $this->HKI_penelitian_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }

    // public function insert()
    // {
    //     $this->_validate();
    //     $idpeng = 1;
    //     $save  = array(
    //         'id_tipe_pengajuan'     => $idpeng,
    //         'id_dosen'              => $this->input->post('id_dosen'),
    //         'judul'                 => $this->input->post('judul'),
    //         'jenis'                 => $this->input->post('jenis'),
    //         'nomor_pendaftaran'     => $this->input->post('nomor_pendaftaran'),
    //         'nomor_hki'             => $this->input->post('nomor_hki'),
    //         'tanggal'               => $this->input->post('tanggal'),
    //         'file'                  => $this->input->post('file'),
    //         // 'status'                  => $this->input->post('status')
    //     );

    //     $this->HKI_penelitian_model->insert_hki("tbl_hki", $save);

    //     echo json_encode(array("status" => TRUE));
    // }

    // public function update()
    // {
    //     $this->_validate();
    //     $id = $this->input->post('id');
    //     $save  = array(
    //         'id_dosen'              => $this->input->post('id_dosen'),
    //         'judul'                 => $this->input->post('judul'),
    //         'jenis'                 => $this->input->post('jenis'),
    //         'nomor_pendaftaran'     => $this->input->post('nomor_pendaftaran'),
    //         'nomor_hki'             => $this->input->post('nomor_hki'),
    //         'tanggal'               => $this->input->post('tanggal'),
    //         'file'                  => $this->input->post('file'),
    //         // 'status'             => $this->input->post('status')
    //     );

    //     $this->HKI_penelitian_model->update_hki($id, $save);

    //     echo json_encode(array("status" => TRUE));
    // }

    public function insert()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            $this->_validate();
            $id = $this->input->post('id');

            $nama = slug($this->input->post('file'));
            $config['upload_path']   = './assets/uploads/foto/cover/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
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
                    'jenis'                 => $this->input->post('jenis'),
                    'nomor_pendaftaran'     => $this->input->post('nomor_pendaftaran'),
                    'nomor_hki'             => $this->input->post('nomor_hki'),
                    'tanggal'               => $this->input->post('tanggal'),
                    'file'                  => $gambar['file_name']
                );

                $g = $this->HKI_penelitian_model->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/uploads/foto/cover/' . $g['file']);
                }

                $this->HKI_penelitian_model->insert_hki("tbl_hki", $save);
                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $idpeng = 1;
                $save  = array(
                    'id_tipe_pengajuan'     => $idpeng,
                    'id_dosen'              => $this->input->post('id_dosen'),
                    'judul'                 => $this->input->post('judul'),
                    'jenis'                 => $this->input->post('jenis'),
                    'nomor_pendaftaran'     => $this->input->post('nomor_pendaftaran'),
                    'nomor_hki'             => $this->input->post('nomor_hki'),
                    'tanggal'               => $this->input->post('tanggal'),
                );
                $this->HKI_penelitian_model->insert_hki("tbl_hki", $save);
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
                'jenis'                 => $this->input->post('jenis'),
                'nomor_pendaftaran'     => $this->input->post('nomor_pendaftaran'),
                'nomor_hki'             => $this->input->post('nomor_hki'),
                'tanggal'               => $this->input->post('tanggal'),
            );
            $this->HKI_penelitian_model->insert_hki("tbl_hki", $save);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function update()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            $id = $this->input->post('id');

            $nama = slug($this->input->post('file'));
            $config['upload_path']   = './assets/uploads/foto/cover/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
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
                    'nomor_pendaftaran'     => $this->input->post('nomor_pendaftaran'),
                    'nomor_hki'             => $this->input->post('nomor_hki'),
                    'tanggal' => $this->input->post('tanggal'),
                    'file' => $gambar['file_name']
                );

                $g = $this->HKI_penelitian_model->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/uploads/foto/cover/' . $g['file']);
                }

                $this->HKI_penelitian_model->update_hki($id, $save);
                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'id_dosen' => $this->input->post('id_dosen'),
                    'judul'  => $this->input->post('judul'),
                    'jenis'  => $this->input->post('jenis'),
                    'nomor_pendaftaran'     => $this->input->post('nomor_pendaftaran'),
                    'nomor_hki'             => $this->input->post('nomor_hki'),
                    'tanggal' => $this->input->post('tanggal'),
                );
                $this->HKI_penelitian_model->update_hki($id, $save);
                echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id = $this->input->post('id');
            $save  = array(
                'id_dosen' => $this->input->post('id_dosen'),
                'judul'  => $this->input->post('judul'),
                'jenis'  => $this->input->post('jenis'),
                'nomor_pendaftaran'     => $this->input->post('nomor_pendaftaran'),
                'nomor_hki'             => $this->input->post('nomor_hki'),
                'tanggal' => $this->input->post('tanggal'),
            );
            $this->HKI_penelitian_model->update_hki($id, $save);
            echo json_encode(array("status" => TRUE));
        }
    }
    
    public function viewhki()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $data['table'] = $table;
        $data['data_field'] = $this->db->field_data($table);
        $data['data_table'] = $this->HKI_penelitian_model->view_hki($id)->result_array();
        $this->load->view('admin/settings/view', $data);
    }

    public function edit_hki($id)
    {
        $data = $this->HKI_penelitian_model->get_hki($id);
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
        $this->HKI_penelitian_model->update_hki($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $g = $this->HKI_penelitian_model->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/uploads/foto/cover/' . $g['file']);
        }
        $this->HKI_penelitian_model->delete_hki($id, 'tbl_hki');
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

        if ($this->input->post('nomor_pendaftaran') == '') {
            $data['inputerror'][] = 'nomor_pendaftaran';
            $data['error_string'][] = 'Nomor Pendaftaran is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nomor_hki') == '') {
            $data['inputerror'][] = 'nomor_hki';
            $data['error_string'][] = 'No. HKI is required';
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
