<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skim_penelitian extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('skim_penelitian_model', 'luaran_model'));
    }

    public function index()
    {
        $this->load->helper('url');
        $data['luaran'] = $this->luaran_model->getAll()->result();
        $this->template->load('admin/layouts/layoutbackend', 'admin/masterdata/skim_penelitian', $data);
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->skim_penelitian_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $n = 1;
        foreach ($list as $skimpenelitian) {
            $no++;
            $row = array();
            $row[] = $n++;  
            $row[] = $skimpenelitian->nama;
            $row[] = $skimpenelitian->keterangan;
            $row[] = $skimpenelitian->maksimal_pengajuan;
            $row[] = $skimpenelitian->syarat;
            $row[] = $skimpenelitian->lama_penyelesaian;
            $row[] = $skimpenelitian->nama_tipe_pengajuan;
            $row[] = $skimpenelitian->status;
            $row[] = $skimpenelitian->id;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->skim_penelitian_model->count_all(),
            "recordsFiltered" => $this->skim_penelitian_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        $this->_validate();
        $list_syarat = $this->input->post('list_syarat');
        if($this->input->post('syarat') == 0){
            $list_syarat = null;
        }
        if(isset($list_syarat)){
            $list_syarat = implode(",",$list_syarat);
        }
        $id_luaran = $this->input->post('id_luaran');
        if(isset($id_luaran)){
            $id_luaran = implode(",",$id_luaran);
        }
        if($this->input->post('maksimal_pengajuan') == 0){
            $jumlah_maksimal_pengajuan = 0;
        } else {
            $jumlah_maksimal_pengajuan = $this->input->post('jumlah_maksimal_pengajuan');
        }
        $save  = array(
            'nama'                      => $this->input->post('nama'),
            'id_tipe_pengajuan'         => $this->input->post('id_tipe_pengajuan'),
            'keterangan'                => $this->input->post('keterangan'),
            'maksimal_pengajuan'        => $this->input->post('maksimal_pengajuan'),
            'jumlah_maksimal_pengajuan' => $jumlah_maksimal_pengajuan,
            'syarat'                    => $this->input->post('syarat'),
            'list_syarat'               => $list_syarat,
            'lama_penyelesaian'         => $this->input->post('lama_penyelesaian'),
            'wajib_laporan_kemajuan'    => $this->input->post('wajib_laporan_kemajuan'),
            'id_luaran'                 => $id_luaran,
            'maksimal_dana'             => $this->input->post('maksimal_dana'),
        );
        $this->skim_penelitian_model->insert_skim_penelitian("mst_skim", $save);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id      = $this->input->post('id');
        $id_luaran = $this->input->post('id_luaran');
        if($this->input->post('syarat') == 0){
            $list_syarat = null;
        }else{
            $list_syarat = $this->input->post('list_syarat');
        }
        if(isset($id_luaran)){
            $id_luaran = implode(",",$id_luaran);
        }
        if($this->input->post('maksimal_pengajuan') == 0){
            $jumlah_maksimal_pengajuan = 0;
        } else {
            $jumlah_maksimal_pengajuan = $this->input->post('jumlah_maksimal_pengajuan');
        }
        $data  = array(
            'nama'                      => $this->input->post('nama'),
            'id_tipe_pengajuan'         => $this->input->post('id_tipe_pengajuan'),
            'keterangan'                => $this->input->post('keterangan'),
            'maksimal_pengajuan'        => $this->input->post('maksimal_pengajuan'),
            'jumlah_maksimal_pengajuan' => $jumlah_maksimal_pengajuan,
            'syarat'                    => $this->input->post('syarat'),
            'list_syarat'               => $list_syarat,
            'lama_penyelesaian'         => $this->input->post('lama_penyelesaian'),
            'wajib_laporan_kemajuan'    => $this->input->post('wajib_laporan_kemajuan'),
            'id_luaran'                 => $id_luaran,
            'maksimal_dana'             => $this->input->post('maksimal_dana'),
        );
        $this->skim_penelitian_model->update_skim_penelitian($id, $data);
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
        $this->skim_penelitian_model->update_skim_penelitian($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_skim_penelitian($id)
    {
        $data = $this->skim_penelitian_model->get_skim_penelitian($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->skim_penelitian_model->delete_skim_penelitian($id, 'mst_skim');
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
            $data['error_string'][] = 'Nama Bidang Ilmu Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('maksimal_pengajuan') == '') {
            $data['inputerror'][] = 'maksimal_pengajuan';
            $data['error_string'][] = 'Maksimal Pengajuan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('syarat') == '') {
            $data['inputerror'][] = 'syarat';
            $data['error_string'][] = 'Syarat Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('lama_penyelesaian') == '') {
            $data['inputerror'][] = 'lama_penyelesaian';
            $data['error_string'][] = 'Lama Penyelesaian Pengajuan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('wajib_laporan_kemajuan') == '') {
            $data['inputerror'][] = 'wajib_laporan_kemajuan';
            $data['error_string'][] = 'Wajib Laporan Kemajuan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        // if ($this->input->post('luaran_wajib') == '') {
        //     $data['inputerror'][] = 'luaran_wajib';
        //     $data['error_string'][] = 'Luaran Wajib Tidak Boleh Kosong';
        //     $data['status'] = FALSE;
        // }

        if ($this->input->post('maksimal_dana') == '') {
            $data['inputerror'][] = 'maksimal_dana';
            $data['error_string'][] = 'Maksimal Dana Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit(); 
        }
    }
}
