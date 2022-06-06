<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_dosen extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('data_dosen_model');
	}

	public function index()
	{
		$this->template->load('admin/layouts/layoutbackend', 'admin/masterdata/data_dosen');
	}

	public function ajax_list()
	{
		ini_set('memory_limit', '512M');
		set_time_limit(3600);
		$list = $this->data_dosen_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $apl) {
			$no++;
			$row = array();
			$row[] = $apl->nip;
			$row[] = $apl->nidn;
			$row[] = $apl->nama;
			$row[] = $apl->gelar_depan;
			$row[] = $apl->gelar_belakang;
			$row[] = $apl->noktp;
			$row[] = $apl->notelp;
			$row[] = $apl->email;
			$row[] = $apl->temp_lahir;
			$row[] = $apl->tgl_lahir;
			$row[] = $apl->alamat;
			$row[] = $apl->foto;
			$row[] = $apl->id;
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

	public function edit_dosen($id)
	{

		$data = $this->data_dosen_model->get_dosen($id);
		echo json_encode($data);
	}

	public function update()
	{
		if (!empty($_FILES['imagefile']['name'])) {
			$this->_validate();
			$id = $this->input->post('id');

			$nama = slug($this->input->post('foto'));
			$config['upload_path']   = './assets/foto/dosen/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
			$config['max_size']      = '2000';
			$config['max_width']     = '2000';
			$config['max_height']    = '2000';
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
					unlink('assets/foto/dosen/' . $g['foto']);
				}

				$this->data_dosen_model->update_dosen($id, $save);
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
				$this->data_dosen_model->update_dosen($id, $save);
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
			$this->data_dosen_model->update_dosen($id, $save);
			echo json_encode(array("status" => TRUE));
		}
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
