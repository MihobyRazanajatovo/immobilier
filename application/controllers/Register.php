<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Register_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('register_page');
    }

    public function submit() {
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('tel', 'Téléphone', 'required');
        $this->form_validation->set_rules('mdp', 'Mot de passe', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register_page');
        } else {
            $data = array(
                'nom' => $this->input->post('nom'),
                'tel' => $this->input->post('tel'),
                'mdp' => $this->input->post('mdp'),
                'email' => $this->input->post('email')
            );

            if ($this->Register_model->register_user($data)) {
                $this->load->view('login_page');
            } else {
                $this->load->view('register_page');
            }
        }
    }
}
