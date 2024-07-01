<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Parking_model');
    }

    public function index(){
        $data['parkings'] = $this->Parking_model->get_parking();
        $this->load->view('header_page');
        $this->load->view('accueil_page', $data);
    }
}