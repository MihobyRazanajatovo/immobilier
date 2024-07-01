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
        $this->load->model('Bien_model');
        date_default_timezone_set('Europe/Paris');
    }

    public function index()
    {
        $this->load->view('admin/accueil_admin');
    }

    public function reset_tables() {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $tables = ['client','proprietaire','type_bien', 'bien', 'location', 'paiement', 'vente'];
        foreach ($tables as $table) {
            $this->db->truncate($table);
        }
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
        $this->load->view('admin/accueil_admin');
    }

    public function chiffre_gain() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        if ($start_date && $end_date) {
            $data['results'] = $this->Location_model->get_chiffre_gain_admin($start_date, $end_date);
        } else {
            $data['results'] = null;
        }

        $this->load->view('admin/chiffre_affaires', $data);
    }

    public function add_location_view() {
        $data['biens'] = $this->Location_model->get_all_biens();
        $data['clients'] = $this->Location_model->get_all_clients();
        $this->load->view('admin/ajout_location', $data);
    }

    public function add() {
        $id_bien = $this->input->post('id_bien');
        $id_client = $this->input->post('id_client');
        $date_debut = $this->input->post('date_debut');
        $duree_mois = $this->input->post('duree_mois');

        $date_fin_prevu = $this->calculate_date_fin_prevu($date_debut, $duree_mois);

        $location_data = array(
            'id_bien' => $id_bien,
            'id_client' => $id_client,
            'date_debut' => $date_debut,
            'date_fin_prevu' => $date_fin_prevu,
            'duree_mois' => $duree_mois,
        );

        $this->Location_model->add_location($location_data);
        redirect('admin/add_location_view');
    }

    private function calculate_date_fin_prevu($date_debut, $duree_mois) {
        $date_debut_obj = new DateTime($date_debut);
        
        $date_debut_obj->modify('+' . $duree_mois . ' months');
        
        $date_fin_prevu_obj = new DateTime($date_debut_obj->format('Y-m-t'));

        return $date_fin_prevu_obj->format('Y-m-d');
    }

    public function location_details() {
        $data['locations'] = $this->Bien_model->get_location_details();
        $this->load->view('admin/details_location', $data);
    }
}
