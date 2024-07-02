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


    public function index() {
        $data['biens'] = $this->Bien_model->get_all_biens_with_photos();
        $this->load->view('client/accueil_client', $data);
    }
    

    public function payment_status_by_client() {
        $client_data = $this->session->userdata('client');
        if (!$client_data) {
            redirect('login/login_client_view');
        }

        $id_client = $client_data['id_client'];
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        if ($start_date && $end_date) {
            $data['results'] = $this->Location_model->get_payment_status_by_client($id_client, $start_date, $end_date);
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
        } else {
            $data['results'] = [];
        }
        
        $this->load->view('client/loyer', $data);
    }
    
    
}

