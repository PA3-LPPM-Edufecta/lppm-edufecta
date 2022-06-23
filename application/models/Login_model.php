<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    function Aplikasi()
    {
        return $this->db->get('aplikasi');
        return $this->db->get('tbl_userlevel');
    }

    function Auth($username, $password, $is_active)
    {

        //menggunakan active record . untuk menghindari sql injection
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        $this->db->where("is_active", $is_active == 'Y');
        return $this->db->get("tbl_user");    
    }

    public function ambilStatus()
    {
        $this->db->where('is_active', $this->input->post('Y'));
        $query = $this->db->get($this->db->dbprefix . 'tbl_userlevel');
        $ret = $query->row();
        return $ret->account_status;

    }

    function check_db($username)
    {
        return $this->db->get_where('tbl_user', array('username' => $username));
    }

    function check_active($is_active)
    {
        return $this->db->get_where('tbl_userlevel', array('is_active' => $is_active));
    }


}

/* End of file login_model.php */
