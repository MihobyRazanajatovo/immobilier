<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
    }
    public function index()
    {
        $this->load->library('session');
        $this->session->sess_destroy();
        redirect('login');
    }
}
