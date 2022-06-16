<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom404 extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');
        // backButtonHandle();
    }

    public function index()
    {
        $this->load->helper('url');
        $this->template->load('admin/layouts/layout404','errors/custom404');
    } //end function index

}
/* End of file Custom404.php */
 