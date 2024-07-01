<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('Login_model');
        $this->load->library('session');
    }

    public function index(){
        $this->load->view('login/login_admin');
    }

    public function login_proprio_view(){
        $this->load->view('login/login_proprio');
    }

    public function login_client_view(){
        $this->load->view('login/login_client');
    }

    public function login_admin(){
        if($this->input->post('email') && $this->input->post('mdp')){
            $email = $this->input->post('email');
            $mdp = $this->input->post('mdp');
    
            $admin_data = $this->Login_model->admin_login($email, $mdp);
    
            if ($admin_data) {
                $this->session->set_userdata('admin', $admin_data);
                log_message('debug', 'Admin connecté: ' . print_r($admin_data, true));
                redirect('admin');
            } else {
                $this->session->set_flashdata('error','Invalid login. User not found');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('error','Invalid login data');
            redirect('login');
        }
    }

    public function login_proprio() {
        if ($this->input->post('tel')) {
            $tel = $this->input->post('tel');
    
            $proprio_data = $this->Login_model->proprio_login($tel);
    
            if ($proprio_data) {
                log_message('debug', 'Propriétaire connecté: ' . print_r($proprio_data, true));
                redirect('proprietaire');
            } else {
                $this->session->set_flashdata('error', 'Login invalide. Propriétaire non trouvé.');
                redirect('login/login_proprio_view');
            }
        } else {
            $this->session->set_flashdata('error', 'Données de login invalides.');
            redirect('login/login_proprio_view');
        }
    }

    public function login_client() {
        if ($this->input->post('email')) {
            $email = $this->input->post('email');
    
            $client_data = $this->Login_model->client_login($email);
    
            if ($client_data) {
                log_message('debug', 'Client connecté: ' . print_r($client_data, true));
                redirect('client');
            } else {
                $this->session->set_flashdata('error', 'Login invalide. Client non trouvé.');
                redirect('login/login_client_view');
            }
        } else {
            $this->session->set_flashdata('error', 'Données de login invalides.');
            redirect('login/login_client_view');
        }
    }
    
}
