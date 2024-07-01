<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proprietaire extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Bien_model');
        $this->load->model('Location_model');
        }

    public function index(){
        $proprio_data = $this->session->userdata('proprietaire');
        if (!$proprio_data) {
            redirect('login/login_proprio_view');
        }
        $id_proprietaire = $proprio_data['id_proprietaire'];
        $biens = $this->Bien_model->get_biens_with_photos($id_proprietaire);
       
        $data['biens'] = $biens;

        $this->load->view('proprio/accueil_proprio', $data);
        
    }

    public function chiffre_affaires_proprio() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        
        $data['results'] = array();
        if ($start_date && $end_date) {
            $data['results'] = $this->Location_model->get_chiffre_affaires_proprio($start_date, $end_date);
        }
        
        $this->load->view('proprio/chiffre_affaire', $data);
    }

    
    
}