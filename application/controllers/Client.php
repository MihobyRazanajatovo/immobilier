<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');    
        $this->load->model('Bien_model');  
        $this->load->model('Location_model');  
        // $this->id_client = $this->session->userdata('id_client');  
    }


    public function index(){
        $biens = $this->Bien_model->get_all_biens_with_photos();
        $data['biens'] = $biens;
        $this->load->view('client/accueil_client', $data);
    }

    public function payment_status_by_client() {
        $proprio_data = $this->session->userdata('client');
        if (!$proprio_data) {
            redirect('login/login_proprio_view');
        }
        $id_client = $proprio_data['id_client'];
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        
        // Ajout de traces
        log_message('debug', 'Start Date: ' . $start_date);
        log_message('debug', 'End Date: ' . $end_date);
        log_message('debug', 'Client ID: ' . $id_client);
    
        $data['results'] = array();
        if ($start_date && $end_date && $id_client) {
            $data['results'] = $this->Location_model->get_payment_status_by_client($id_client, $start_date, $end_date);
        }
        
        $this->load->view('client/loyer', $data);
    }
    
    
}