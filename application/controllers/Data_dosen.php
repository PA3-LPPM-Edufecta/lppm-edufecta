<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_dosen extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('data_dosen_model', 'akses_model'));
	}

	public function index()
	{
	    $id_user = $this->session->userdata['id_user'];
        $id_level = $this->akses_model->get_id_level($id_user)->row()->id_level;
        $id_submenu = 14;
        $view_level = $this->akses_model->get_level($id_level, $id_submenu)->row()->view_level;
        $data['add_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->add_level;
        $data['edit_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->edit_level;
        $data['delete_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->delete_level;
        $data['print_level'] = $this->akses_model->get_level($id_level, $id_submenu)->row()->print_level;

        if ($view_level == 'Y') {
            return $this->template->load('admin/layouts/layoutbackend', 'admin/masterdata/data_dosen', $data);
        } else {
            return $this->template->load('admin/layouts/layouterror', 'errors/custom403');
        }
	}

	public function ajax_list()
	{
		ini_set('memory_limit', '512M');
		//set_time_limit(3600);
		$list = $this->data_dosen_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $dosen) {
			$no++;
			$row = array();
			$row[] = $dosen->nip;
			$row[] = $dosen->nidn;
			$row[] = $dosen->nama;
			$row[] = $dosen->gelar_depan;
			$row[] = $dosen->gelar_belakang;
			$row[] = $dosen->noktp;
			$row[] = $dosen->notelp;
			$row[] = $dosen->email;
			$row[] = $dosen->temp_lahir;
			$row[] = $dosen->tgl_lahir;
			$row[] = $dosen->alamat;
			$row[] = $dosen->foto;
			$row[] = $dosen->status;
			$row[] = $dosen->id;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_dosen_model->count_all(),
			"recordsFiltered" => $this->data_dosen_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	
	public function insert()
    {
        if (!empty($_FILES['imagefile']['name'])) {
			$this->_validate();
			$id = $this->input->post('id');

			$nama = slug($this->input->post('foto'));
			$config['upload_path']   = './assets/uploads/foto/dosen/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
			$config['max_size']      = '3000';
			$config['max_width']     = '3000';
			$config['max_height']    = '3000';
			$config['file_name']     = $nama;

			$this->upload->initialize($config);

			if ($this->upload->do_upload('imagefile')) {
				$gambar = $this->upload->data();
				$save  = array(
					'nip' => $this->input->post('nip'),
					'nidn'    => $this->input->post('nidn'),
					'nama'       => $this->input->post('nama'),
					'gelar_depan' => $this->input->post('gelar_depan'),
					'gelar_belakang'  => $this->input->post('gelar_belakang'),
					'noktp'  => $this->input->post('noktp'),
					'notelp'  => $this->input->post('notelp'),
					'email' => $this->input->post('email'),
					'temp_lahir' => $this->input->post('temp_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),	
					'alamat' => $this->input->post('alamat'),
					'foto' => $gambar['file_name']
				);

				$g = $this->data_dosen_model->getImage($id)->row_array();

				if ($g != null) {
					//hapus gambar yg ada diserver
					unlink('assets/uploads/foto/dosen/' . $g['foto']);
				}

				$this->data_dosen_model->insert_data_dosen("mst_dosen", $save);
				echo json_encode(array("status" => TRUE));
			} else { //Apabila tidak ada gambar yang di upload
				$save  = array(
					'nip' => $this->input->post('nip'),
					'nidn'    => $this->input->post('nidn'),
					'nama'       => $this->input->post('nama'),
					'gelar_depan' => $this->input->post('gelar_depan'),
					'gelar_belakang'  => $this->input->post('gelar_belakang'),
					'noktp'  => $this->input->post('noktp'),
					'notelp'  => $this->input->post('notelp'),
					'email' => $this->input->post('email'),
					'temp_lahir' => $this->input->post('temp_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'alamat' => $this->input->post('alamat')
				);
				$this->data_dosen_model->insert_data_dosen("mst_dosen", $save);
				echo json_encode(array("status" => TRUE));
			}
		} else {
			$this->_validate();
			$id = $this->input->post('id');
			$save  = array(
				'nip' => $this->input->post('nip'),
				'nidn'    => $this->input->post('nidn'),
				'nama'       => $this->input->post('nama'),
				'gelar_depan' => $this->input->post('gelar_depan'),
				'gelar_belakang'  => $this->input->post('gelar_belakang'),
				'noktp'  => $this->input->post('noktp'),
				'notelp'  => $this->input->post('notelp'),
				'email' => $this->input->post('email'),
				'temp_lahir' => $this->input->post('temp_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat')
			);
			$this->data_dosen_model->insert_data_dosen("mst_dosen", $save);
			echo json_encode(array("status" => TRUE));
		}
	}

	public function update()
	{
		if (!empty($_FILES['imagefile']['name'])) {
			$this->_validate();
			$id = $this->input->post('id');

			$nama = slug($this->input->post('foto'));
			$config['upload_path']   = './assets/uploads/foto/dosen/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
			$config['max_size']      = '3000';
			$config['max_width']     = '3000';
			$config['max_height']    = '3000';
			$config['file_name']     = $nama;

			$this->upload->initialize($config);

			if ($this->upload->do_upload('imagefile')) {
				$gambar = $this->upload->data();
				$save  = array(
					'nip' => $this->input->post('nip'),
					'nidn'    => $this->input->post('nidn'),
					'nama'       => $this->input->post('nama'),
					'gelar_depan' => $this->input->post('gelar_depan'),
					'gelar_belakang'  => $this->input->post('gelar_belakang'),
					'noktp'  => $this->input->post('noktp'),
					'notelp'  => $this->input->post('notelp'),
					'email' => $this->input->post('email'),
					'temp_lahir' => $this->input->post('temp_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),	
					'alamat' => $this->input->post('alamat'),
					'foto' => $gambar['file_name']
				);

				$g = $this->data_dosen_model->getImage($id)->row_array();

				if ($g != null) {
					//hapus gambar yg ada diserver
					unlink('assets/uploads/foto/dosen/' . $g['foto']);
				}

				$this->data_dosen_model->update_data_dosen($id, $save);
				echo json_encode(array("status" => TRUE));
			} else { //Apabila tidak ada gambar yang di upload
				$save  = array(
					'nip' => $this->input->post('nip'),
					'nidn'    => $this->input->post('nidn'),
					'nama'       => $this->input->post('nama'),
					'gelar_depan' => $this->input->post('gelar_depan'),
					'gelar_belakang'  => $this->input->post('gelar_belakang'),
					'noktp'  => $this->input->post('noktp'),
					'notelp'  => $this->input->post('notelp'),
					'email' => $this->input->post('email'),
					'temp_lahir' => $this->input->post('temp_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'alamat' => $this->input->post('alamat')
				);
				$this->data_dosen_model->update_data_dosen($id, $save);
				echo json_encode(array("status" => TRUE));
			}
		} else {
			$this->_validate();
			$id = $this->input->post('id');
			$save  = array(
				'nip' => $this->input->post('nip'),
				'nidn'    => $this->input->post('nidn'),
				'nama'       => $this->input->post('nama'),
				'gelar_depan' => $this->input->post('gelar_depan'),
				'gelar_belakang'  => $this->input->post('gelar_belakang'),
				'noktp'  => $this->input->post('noktp'),
				'notelp'  => $this->input->post('notelp'),
				'email' => $this->input->post('email'),
				'temp_lahir' => $this->input->post('temp_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat')
			);
			$this->data_dosen_model->update_data_dosen($id, $save);
			echo json_encode(array("status" => TRUE));
		}
	}

	public function viewdosen()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $data['table'] = $table;
        $data['data_field'] = $this->db->field_data($table);
        $data['data_table'] = $this->data_dosen_model->view_dosen($id)->result_array();
        $this->load->view('admin/settings/view', $data);
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
        $this->data_dosen_model->update_data_dosen($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_data_dosen($id)
    {
        $data = $this->data_dosen_model->get_data_dosen($id);
        echo json_encode($data);
    }

    public function delete_data_dosen()
    {
        $id = $this->input->post('id');
        $this->data_dosen_model->delete_data_dosen($id, 'mst_dosen');
        echo json_encode(array("status" => TRUE));
    }

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nip') == '') {
			$data['inputerror'][] = 'nip';
			$data['error_string'][] = 'NIP Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nidn') == '') {
			$data['inputerror'][] = 'nidn';
			$data['error_string'][] = 'NIDN Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($this->input->post('gelar_depan') == '') {
			$data['inputerror'][] = 'gelar_depan';
			$data['error_string'][] = 'Gelar Depan Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($this->input->post('gelar_belakang') == '') {
			$data['inputerror'][] = 'gelar_belakang';
			$data['error_string'][] = 'Gelar Belakang Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($this->input->post('noktp') == '') {
			$data['inputerror'][] = 'noktp';
			$data['error_string'][] = 'Nomor KTP Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($this->input->post('notelp') == '') {
			$data['inputerror'][] = 'notelp';
			$data['error_string'][] = 'Nomor Telepon Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($this->input->post('email') == '') {
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Email Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($this->input->post('temp_lahir') == '') {
			$data['inputerror'][] = 'temp_lahir';
			$data['error_string'][] = 'Tempat Lahir Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tgl_lahir') == '') {
			$data['inputerror'][] = 'tgl_lahir';
			$data['error_string'][] = 'Tanggal Lahir Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($this->input->post('alamat') == '') {
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Alamat Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
