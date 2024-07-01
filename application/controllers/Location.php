<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Bien_model');
        $this->load->model('Login_model');
        $this->load->model('Location_model');
    }

    public function index($id_bien){
        $client_data = $this->session->userdata('client');
        if (!$client_data) {
            redirect('login/login_client_view');
        }

        $bien = $this->Bien_model->get_bien_by_id($id_bien);
        
        if (!$bien) {
            show_404();
        }

        $data['bien'] = $bien;
        $data['client'] = $client_data;
        $this->load->view('client/location', $data);
    }

    public function calculer() {
        // Vérifier si le client est connecté
        $client_data = $this->session->userdata('client');
        if (!$client_data) {
            redirect('login/login_client_view');
        }

        // Récupérer les informations du bien
        $id_bien = $this->input->post('id_bien');
        $debut = $this->input->post('debut');
        $fin = $this->input->post('fin');

        $bien = $this->Bien_model->get_bien_by_id($id_bien);

        if (!$bien) {
            show_404();
        }

        // Calculer le loyer
        $debut_date = new DateTime($debut);
        $fin_date = new DateTime($fin);
        $interval = $debut_date->diff($fin_date);
        $mois = $interval->m + ($interval->y * 12);
        $loyer_total = $mois * $bien['loyer_mois'];

        // Ajouter la location
        $location_data = array(
            'id_bien' => $id_bien,
            'id_client' => $client_data['id_client'],
            'date_debut' => $debut,
            'date_fin_prevu' => $fin,
            'duree_mois' => $mois
        );
        $id_location = $this->Location_model->ajouter_location($location_data);

        // Ajouter le paiement initial
        $paiement_data = array(
            'id_location' => $id_location,
            'date_paiement' => date('Y-m-d'),
            'loyer_a_payer' => $loyer_total,
            'loyer_paye' => 0 // Pas encore payé
        );
        $this->db->insert('paiement', $paiement_data);

        // Passer les données à la vue
        $data['bien'] = $bien;
        $data['client'] = $client_data;
        $data['debut'] = $debut;
        $data['fin'] = $fin;
        $data['mois'] = $mois;
        $data['loyer_total'] = $loyer_total;
        $data['id_location'] = $id_location;

        $this->load->view('client/location_fait', $data);
    }

    public function payer() {
        // Vérifier si le client est connecté
        $client_data = $this->session->userdata('client');
        if (!$client_data) {
            redirect('login/login_client_view');
        }

        // Récupérer les informations de paiement
        $id_location = $this->input->post('id_location');
        $debut_paiement = $this->input->post('debut_paiement');
        $fin_paiement = $this->input->post('fin_paiement');

        // Récupérer les informations de la location
        $location = $this->Location_model->get_location_by_id($id_location);
        $bien = $this->Bien_model->get_bien_by_id($location['id_bien']);

        if (!$location || !$bien) {
            show_404();
        }

        // Calculer le loyer pour la période spécifiée
        $debut_date = new DateTime($debut_paiement);
        $fin_date = new DateTime($fin_paiement);
        $interval = $debut_date->diff($fin_date);
        $mois = $interval->m + ($interval->y * 12) + 1; // Ajouter 1 car les dates incluses comptent comme un mois complet
        $loyer_a_payer = $mois * $bien['loyer_mois'];

        // Mettre à jour le paiement
        $this->db->set('loyer_paye', 'loyer_paye + ' . $loyer_a_payer, FALSE);
        $this->db->where('id_location', $id_location);
        $this->db->update('paiement');

        // Rediriger vers une page de confirmation ou vers la liste des locations
        redirect('client/reste_a_payer/' . $id_location);
    }

    public function reste_a_payer($id_location = NULL) {
        // Vérifier si le client est connecté
        $client_data = $this->session->userdata('client');
        if (!$client_data) {
            redirect('login/login_client_view');
        }

        // Vérifier si l'id_location est passé
        if ($id_location === NULL) {
            show_error('ID de location manquant', 500);
        }

        // Récupérer les informations de la location
        $location = $this->Location_model->get_location_by_id($id_location);
        $total_paye = $this->Location_model->get_total_paye($id_location);
        $bien = $this->Bien_model->get_bien_by_id($location['id_bien']);

        if (!$location || !$bien) {
            show_404();
        }

        // Calculer le reste à payer
        $reste_a_payer = $location['duree_mois'] * $bien['loyer_mois'] - $total_paye;

        // Passer les données à la vue
        $data['bien'] = $bien;
        $data['client'] = $client_data;
        $data['location'] = $location;
        $data['total_paye'] = $total_paye;
        $data['reste_a_payer'] = $reste_a_payer;
        $data['id_location'] = $id_location;

        $this->load->view('client', $data);
    }
}