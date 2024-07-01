<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        if (!$this->session->userdata('client')) {
            redirect('accueil');
        }
    }

    public function index(){
        $data['client'] = $this->session->userdata('client');
        $this->load->view('header_page');
        $this->load->view('profil_page', $data);
    }
}


