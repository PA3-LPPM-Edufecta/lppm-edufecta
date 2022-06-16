<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->load->helper('url');
        $data['user'] = $this->user_model->getAll();
        $data['user_level'] = $this->user_model->userlevel();
        $this->template->load('admin/layouts/layoutbackend', 'admin/settings/user_data', $data);
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->user_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $user->image;
            $row[] = $user->username;
            $row[] = $user->full_name;
            $row[] = $user->nama_level;
            $row[] = $user->is_active;
            $row[] = $user->id_user;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user_model->count_all(),
            "recordsFiltered" => $this->user_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->user_model->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/uploads/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '3000';
            $config['max_width']     = '3000';
            $config['max_height']    = '3000';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );

                $this->user_model->insertUser("tbl_user", $save);
                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->user_model->insertUser("tbl_user", $save);
                echo json_encode(array("status" => TRUE));
            }
        }
    }

    public function viewuser()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $data['table'] = $table;
        $data['data_field'] = $this->db->field_data($table);
        $data['data_table'] = $this->user_model->view_user($id)->result_array();
        $this->load->view('admin/settings/view', $data);
    }

    public function edituser($id)
    {

        $data = $this->user_model->getUser($id);
        echo json_encode($data);
    }


    public function update()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/uploads/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '3000';
            $config['max_width']     = '3000';
            $config['max_height']    = '3000';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }


                $g = $this->user_model->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/uploads/foto/user/' . $g['image']);
                }

                $this->user_model->updateUser($id, $save);
                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }

                $this->user_model->updateUser($id, $save);
                echo json_encode(array("status" => TRUE));
            }
        } else {
            // $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }

            $this->user_model->updateUser($id_user, $save);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $g = $this->user_model->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/uploads/foto/user/' . $g['image']);
        }
        $this->user_model->deleteUsers($id, 'tbl_user');
        $data['status'] = TRUE;
        echo json_encode($data);
    }

    public function reset()
    {
        $id = $this->input->post('id');
        $data = array(
            'password'  => get_hash('password')
        );
        $this->user_model->reset_pass($id, $data);
        $data['status'] = TRUE;
        echo json_encode($data);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('full_name') == '') {
            $data['inputerror'][] = 'full_name';
            $data['error_string'][] = 'Full Name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('password') == '') {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('is_active') == '') {
            $data['inputerror'][] = 'is_active';
            $data['error_string'][] = 'Please select Status';
            $data['status'] = FALSE;
        }

        if ($this->input->post('level') == '') {
            $data['inputerror'][] = 'level';
            $data['error_string'][] = 'Please select is level';
            $data['status'] = FALSE;
        }

        /*if($this->input->post('image') == '')
        {
            $data['inputerror'][] = 'image';
            $data['error_string'][] = 'Image is required';
            $data['status'] = FALSE;
        }*/

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
