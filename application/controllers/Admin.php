<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Location_model');
        date_default_timezone_set('Europe/Paris');
    }

    public function index()
    {
        $this->load->view('admin/accueil_admin');
    }

    public function reset_tables() {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $tables = ['type_bien', 'bien', 'location', 'paiement', 'vente'];
        foreach ($tables as $table) {
            $this->db->truncate($table);
        }
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
        $this->load->view('admin/accueil_admin');
    }

    // public function total_rent_by_month() {
    //     $start_date = $this->input->post('start_date');
    //     $end_date = $this->input->post('end_date');
        
    //     $data['results'] = array();
    //     if ($start_date && $end_date) {
    //         $data['results'] = $this->Location_model->get_total_rent_by_month($start_date, $end_date);
    //     }
        
    //     $this->load->view('admin/chiffre_affaires', $data);
    // }

    public function total_rent_and_gain() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        
        $data['results'] = array();
        if ($start_date && $end_date) {
            $data['results'] = $this->Location_model->get_total_rent_and_gain_by_month($start_date, $end_date);
        }
        
        $this->load->view('admin/chiffre_affaires', $data);
    }
}
