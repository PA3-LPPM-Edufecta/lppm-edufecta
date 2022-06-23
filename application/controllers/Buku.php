<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
        $this->load->model(array('Buku_model', 'Data_dosen_model', 'Tipe_pengajuan_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $data['mst_dosen'] = $this->Data_dosen_model->getAll()->result();
        $data['id_buku'] =  $this->Buku_model->getLastId()->result();
        $this->template->load('admin/layouts/layoutbackend', 'admin/kinerja_pengabdian/buku', $data);
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Buku_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $buku) {
            $no++;
            $row = array();
            $row[] = $buku->gelar_depan;
            $row[] = $buku->nama;
            $row[] = $buku->id_dosen;
            $row[] = $buku->nama_tipe_pengajuan;
            $row[] = $buku->gelar_belakang;
            $row[] = $buku->id_tipe_pengajuan;
            $row[] = $buku->nidn;
            $row[] = $buku->judul;
            $row[] = $buku->penerbit;
            $row[] = $buku->isbn;
            $row[] = $buku->halaman;
            $row[] = $buku->tanggal;
            $row[] = $buku->file_cover;
            $row[] = $buku->file_editorial_board;
            $row[] = $buku->file_penerbit;
            $row[] = $buku->file;
            $row[] = $buku->status;
            $row[] = $buku->id;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Buku_model->count_all(),
            "recordsFiltered" => $this->Buku_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        $this->_validate();

        $config['upload_path']   = './assets/uploads/foto/cover/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf'; //mencegah upload backdor
        $config['max_size']      = '50000';
        $config['max_width']     = '3000';
        $config['max_height']    = '3000';
        $this->load->library('upload');
        $this->upload->initialize($config);
        if ($this->upload->do_upload('file_cover')) {
            $gambar1 = $this->upload->data();

            $config['upload_path']   = './assets/uploads/foto/cover/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf'; //mencegah upload backdor
            $config['max_size']      = '50000';
            $config['max_width']     = '3000';
            $config['max_height']    = '3000';
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file_editorial_board')) {
                $gambar2 = $this->upload->data();

                $config['upload_path']   = './assets/uploads/foto/cover/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf'; //mencegah upload backdor
                $config['max_size']      = '50000';
                $config['max_width']     = '3000';
                $config['max_height']    = '3000';
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file_penerbit')) {
                    $gambar3 = $this->upload->data();

                    $config['upload_path']   = './assets/uploads/foto/cover/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf'; //mencegah upload backdor
                    $config['max_size']      = '50000';
                    $config['max_width']     = '3000';
                    $config['max_height']    = '3000';
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('file')) {
                        $gambar4 = $this->upload->data();

                        $save = array(
                            'id_tipe_pengajuan'     => 2,
                            'id_dosen'              => $this->input->post('id_dosen'),
                            'judul'                 => $this->input->post('judul'),
                            'penerbit'              => $this->input->post('penerbit'),
                            'isbn'                  => $this->input->post('isbn'),
                            'halaman'               => $this->input->post('halaman'),
                            'tanggal'               => $this->input->post('tanggal'),
                            'file_cover'            => $gambar1['file_name'],
                            'file_editorial_board'  => $gambar2['file_name'],
                            'file_penerbit'         => $gambar3['file_name'],
                        );

                        $save2 = array(
                            'id_buku'   => $this->input->post('id_buku'),
                            'file'      => $gambar4['file_name']
                        );

                        $this->Buku_model->insert_buku("tbl_buku", $save);
                        $this->Buku_model->insert_bukulain("tbl_buku_file_lain", $save2);
                        echo json_encode(array("status" => TRUE));
                    } 
                } 
            } 
        } 
    }

    public function update()
    {
        $id = $this->input->post('id');

        $config['upload_path']   = './assets/uploads/foto/cover/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf'; //mencegah upload backdor
        $config['max_size']      = '50000';
        $config['max_width']     = '3000';
        $config['max_height']    = '3000';
        $this->load->library('upload');
        $this->upload->initialize($config);
        if ($this->upload->do_upload('file_cover')) {
            $gambar1 = $this->upload->data();

            $config['upload_path']   = './assets/uploads/foto/cover/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf'; //mencegah upload backdor
            $config['max_size']      = '50000';
            $config['max_width']     = '3000';
            $config['max_height']    = '3000';
            $this->upload->initialize($config);
            
            $save = array(
                'id_tipe_pengajuan'     => 2,
                'id_dosen'              => $this->input->post('id_dosen'),
                'judul'                 => $this->input->post('judul'),
                'penerbit'              => $this->input->post('penerbit'),
                'isbn'                  => $this->input->post('isbn'),
                'halaman'               => $this->input->post('halaman'),
                'tanggal'               => $this->input->post('tanggal'),
                'file_cover'            => $gambar1['file_name'],
            );

            $this->Buku_model->update_buku($id, $save);

            if ($this->upload->do_upload('file_editorial_board')) {
                $gambar2 = $this->upload->data();

                $config['upload_path']   = './assets/uploads/foto/cover/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf'; //mencegah upload backdor
                $config['max_size']      = '50000';
                $config['max_width']     = '3000';
                $config['max_height']    = '3000';
                $this->upload->initialize($config);

                $save = array(
                    'id_tipe_pengajuan'     => 2,
                    'id_dosen'              => $this->input->post('id_dosen'),
                    'judul'                 => $this->input->post('judul'),
                    'penerbit'              => $this->input->post('penerbit'),
                    'isbn'                  => $this->input->post('isbn'),
                    'halaman'               => $this->input->post('halaman'),
                    'tanggal'               => $this->input->post('tanggal'),
                    'file_cover'            => $gambar1['file_name'],
                    'file_editorial_board'  => $gambar2['file_name'],
                );

                $this->Buku_model->update_buku($id, $save);

                if ($this->upload->do_upload('file_penerbit')) {
                    $gambar3 = $this->upload->data();

                    $config['upload_path']   = './assets/uploads/foto/cover/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf'; //mencegah upload backdor
                    $config['max_size']      = '50000';
                    $config['max_width']     = '3000';
                    $config['max_height']    = '3000';
                    $this->upload->initialize($config);

                    $save = array(
                        'id_tipe_pengajuan'     => 2,
                        'id_dosen'              => $this->input->post('id_dosen'),
                        'judul'                 => $this->input->post('judul'),
                        'penerbit'              => $this->input->post('penerbit'),
                        'isbn'                  => $this->input->post('isbn'),
                        'halaman'               => $this->input->post('halaman'),
                        'tanggal'               => $this->input->post('tanggal'),
                        'file_cover'            => $gambar1['file_name'],
                        'file_editorial_board'  => $gambar2['file_name'],
                        'file_penerbit'         => $gambar3['file_name'],
                    );

                    $this->Buku_model->update_buku($id, $save);

                    if ($this->upload->do_upload('file')) {
                        $gambar4 = $this->upload->data();

                        $save = array(
                            'id_tipe_pengajuan'     => 2,
                            'id_dosen'              => $this->input->post('id_dosen'),
                            'judul'                 => $this->input->post('judul'),
                            'penerbit'              => $this->input->post('penerbit'),
                            'isbn'                  => $this->input->post('isbn'),
                            'halaman'               => $this->input->post('halaman'),
                            'tanggal'               => $this->input->post('tanggal'),
                            'file_cover'            => $gambar1['file_name'],
                            'file_editorial_board'  => $gambar2['file_name'],
                            'file_penerbit'         => $gambar3['file_name'],
                        );

                        $save2 = array(
                            'file'      => $gambar4['file_name']
                        );

                        $this->Buku_model->update_buku($id, $save);
                        $this->Buku_model->update_bukulain($id, $save2);
                        echo json_encode(array("status" => TRUE));
                    } else {
                        $save = array(
                            'id_tipe_pengajuan'     => 2,
                            'id_dosen'              => $this->input->post('id_dosen'),
                            'judul'                 => $this->input->post('judul'),
                            'penerbit'              => $this->input->post('penerbit'),
                            'isbn'                  => $this->input->post('isbn'),
                            'halaman'               => $this->input->post('halaman'),
                            'tanggal'               => $this->input->post('tanggal'),
                        );

                        $this->Buku_model->update_buku($id, $save);
                        echo json_encode(array("status" => TRUE));
                    } 
                } else {
                    $save = array(
                        'id_tipe_pengajuan'     => 2,
                        'id_dosen'              => $this->input->post('id_dosen'),
                        'judul'                 => $this->input->post('judul'),
                        'penerbit'              => $this->input->post('penerbit'),
                        'isbn'                  => $this->input->post('isbn'),
                        'halaman'               => $this->input->post('halaman'),
                        'tanggal'               => $this->input->post('tanggal'),
                    );

                    $this->Buku_model->update_buku($id, $save);
                    echo json_encode(array("status" => TRUE));
                } 
            } else {
                $save = array(
                    'id_tipe_pengajuan'     => 2,
                    'id_dosen'              => $this->input->post('id_dosen'),
                    'judul'                 => $this->input->post('judul'),
                    'penerbit'              => $this->input->post('penerbit'),
                    'isbn'                  => $this->input->post('isbn'),
                    'halaman'               => $this->input->post('halaman'),
                    'tanggal'               => $this->input->post('tanggal'),
                );

                $this->Buku_model->update_buku($id, $save);
                echo json_encode(array("status" => TRUE));
            }
        } else {
            $save = array(
                'id_tipe_pengajuan'     => 2,
                'id_dosen'              => $this->input->post('id_dosen'),
                'judul'                 => $this->input->post('judul'),
                'penerbit'              => $this->input->post('penerbit'),
                'isbn'                  => $this->input->post('isbn'),
                'halaman'               => $this->input->post('halaman'),
                'tanggal'               => $this->input->post('tanggal'),
            );

            $this->Buku_model->update_buku($id, $save);
            echo json_encode(array("status" => TRUE));  
        }
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
        $this->Buku_model->update_buku($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_buku($id)
    {
        $data = $this->Buku_model->get_buku($id);
        echo json_encode($data);
    }

    // //Edit Status
    // public function	edit_status($id)
    // {
    // 	$buku = $this->Buku_model->get_buku($id);
    // 	$status = $this->input->post('status');

    // 	$save = array(
    // 		'id'		=> $this->input->post('id'),
    // 		'status'	=> $status
    // 	);
    // 	$this->Buku_model->edit_status($id, $save);
    //     echo json_encode(array("status" => TRUE));
    // }

    public function delete()
    {
        $id = $this->input->post('id');

        // $g = $this->Buku_model->getImage1($id)->row_array();
        // $h = $this->Buku_model->getImage2($id)->row_array();
        // $i = $this->Buku_model->getImage3($id)->row_array();
        // $j = $this->Buku_model->getImage4($id)->row_array();
        //     //hapus gambar yg ada diserver
        // unlink('assets/uploads/foto/cover/' . $g['file']);
        // unlink('assets/uploads/foto/cover/' . $h['file']);
        // unlink('assets/uploads/foto/cover/' . $i['file']);
        // unlink('assets/uploads/foto/cover/' . $j['file']);

        $this->Buku_model->delete_buku($id, 'tbl_buku');
        $this->Buku_model->delete_buku_file_lain($id, 'tbl_buku_file_lain');
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
            $data['error_string'][] = 'Dosen Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('judul') == '') {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = 'Judul Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('penerbit') == '') {
            $data['inputerror'][] = 'penerbit';
            $data['error_string'][] = 'Penerbit Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('isbn') == '') {
            $data['inputerror'][] = 'isbn';
            $data['error_string'][] = 'ISBN Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('halaman') == '') {
            $data['inputerror'][] = 'halaman';
            $data['error_string'][] = 'Halaman Buku Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tanggal') == '') {
            $data['inputerror'][] = 'tanggal';
            $data['error_string'][] = 'Tanggal Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if (empty($_FILES['file_cover']['name'])) {
            $data['inputerror'][] = 'file_cover';
            $data['error_string'][] = 'File Cover Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if (empty($_FILES['file_editorial_board']['name'])) {
            $data['inputerror'][] = 'file_editorial_board';
            $data['error_string'][] = 'File Editorial Board Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if (empty($_FILES['file_penerbit']['name'])) {
            $data['inputerror'][] = 'file_penerbit';
            $data['error_string'][] = 'File Penerbit Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if (empty($_FILES['file']['name'])) {
            $data['inputerror'][] = 'file';
            $data['error_string'][] = 'File Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
