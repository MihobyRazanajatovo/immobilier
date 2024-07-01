<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarif extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Tarif_model');
    }

    public function index() {
        $data['tarifs'] = $this->Tarif_model->get_tarifs();
        $this->load->view('tarif_admin_page', $data);
    }

    public function add_tarif() {
        if ($this->input->post()) {
            $data = array(
                'tranche' => $this->input->post('tranche'),
                'prix' => $this->input->post('prix')
            );
            $this->Tarif_model->insert_tarif($data);
            redirect('tarif');
        } else {
            $this->load->view('insert_tarif_admin');
        }
    }

    public function update($id) {
        if ($this->input->post()) {
            $data = array(
                'tranche' => $this->input->post('tranche'),
                'prix' => $this->input->post('prix')
            );
            $this->Tarif_model->update_tarif($id, $data);
            redirect('tarif');
        } else {
            $data['tarif'] = $this->Tarif_model->get_tarif($id);
            $this->load->view('update_tarif_admin', $data);
        }
    }

    public function delete($id) {
        $this->Tarif_model->delete_tarif($id);
        redirect('tarif');
    }
}