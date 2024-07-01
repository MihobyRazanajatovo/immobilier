<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parking extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Parking_model');
        $this->load->model('Voiture_model');
        $this->load->model('Tarif_model');
        $this->load->model('Stationnement_model');
        $this->load->model('Portefeuille_model');
        date_default_timezone_set('Europe/Paris');
    }

    public function add($id_parking){
        if (!$this->session->userdata('client')) {
            redirect('accueil');
        }

        $parking = $this->Parking_model->get_parking($id_parking);
        if ($parking['disponibilite'] != 'libre') {
            $this->session->set_flashdata('error', 'Le parking n\'est pas libre.');
            redirect('accueil');
        }

        $data['tarifs'] = $this->Tarif_model->get_tarifs();
        $data['id_parking'] = $id_parking;
        $this->load->view('header_page');
        $this->load->view('ajout_voiture', $data);
    }

    public function save(){
        if (!$this->session->userdata('client')) {
            redirect('accueil');
        }
    
        $id_parking = $this->input->post('id_parking');
        $id_client = $this->session->userdata('client')['id_client'];
        $immatriculation = $this->input->post('immatriculation');
        $marque = $this->input->post('marque');
        $couleur = $this->input->post('couleur');
        $id_tarif = $this->input->post('tarif');
    
        $parking = $this->Parking_model->get_parking($id_parking);
        if ($parking['disponibilite'] != 'libre') {
            $this->session->set_flashdata('error', 'Le parking n\'est pas libre.');
            redirect('accueil');
        }
    
        $tarif = $this->Tarif_model->get_tarif($id_tarif);
        $duree = $tarif['tranche'];
    
        $voiture_data = array(
            'marque' => $marque,
            'immatriculation' => $immatriculation,
            'couleur' => $couleur,
            'id_client' => $id_client
        );
        $this->Voiture_model->add_voiture($voiture_data);
    
        $id_voiture = $this->db->insert_id();
    
        date_default_timezone_set('Europe/Paris');
    
        $date_entree = date('Y-m-d H:i:s');
        
        // Extraire les heures, minutes et secondes de la durée
        list($hours, $minutes, $seconds) = explode(':', $duree);
        $date_sortie = date('Y-m-d H:i:s', strtotime("+$hours hours +$minutes minutes +$seconds seconds", strtotime($date_entree)));
    
        $stationnement_data = array(
            'id_voiture' => $id_voiture,
            'id_parking' => $id_parking,
            'id_tarif' => $id_tarif,
            'date_entree' => $date_entree,
            'date_sortie' => $date_sortie
        );
        $this->Parking_model->add_stationnement($stationnement_data);
    
        $this->Parking_model->update_parking_disponibilite($id_parking, 'occupé');
    
        redirect('accueil');
    }
    
    public function show_voitures_stationnees() {
        if (!$this->session->userdata('client')) {
            redirect('accueil');
        }

        $id_client = $this->session->userdata('client')['id_client'];

        $data['voitures'] = $this->Stationnement_model->get_voitures_stationnees_par_client($id_client);

        $this->load->view('header_page');
        $this->load->view('remove_page', $data);
    }

    public function remove() {
        if (!$this->session->userdata('client')) {
            redirect('accueil');
        }

        $id_client = $this->session->userdata('client')['id_client'];
        $id_voiture = $this->input->post('id_voiture');

        $stationnement = $this->Stationnement_model->get_stationnement_par_voiture_et_client($id_voiture, $id_client);

        if (!$stationnement) {
            $this->session->set_flashdata('error', 'La voiture n\'est pas stationnée ou n\'appartient pas à ce client.');
            redirect('parking/show_voitures_stationnees');
        }

        $id_parking = $stationnement['id_parking'];
        $id_tarif = $stationnement['id_tarif'];
        $date_sortie = date('Y-m-d H:i:s');
        $date_sortie_attendue = $stationnement['date_sortie'];

        $tarif = $this->Tarif_model->get_tarif($id_tarif);
        if (!$tarif || !isset($tarif['prix'])) {
            $this->session->set_flashdata('error', 'Erreur lors de la récupération du tarif.');
            redirect('parking/show_voitures_stationnees');
        }

        $montant_tarif = $tarif['prix'];
        $portefeuille = $this->Portefeuille_model->get_portefeuille_by_client($id_client);

        $montant_total = $montant_tarif;
        $amende = false;

        if (strtotime($date_sortie) > strtotime($date_sortie_attendue)) {
            $montant_amende = 15000.00;
            $montant_total += $montant_amende;
            $amende = true;
        }

        if ($portefeuille && $this->Portefeuille_model->verifier_solde($portefeuille['id_portefeuille'], $montant_tarif)) {
        
            $this->Portefeuille_model->deduire_montant($portefeuille['id_portefeuille'], $montant_tarif);
            
            if ($amende) {
                $amende_data = array(
                    'id_voiture' => $id_voiture,
                    'montant' => $montant_amende,
                    'date_amende' => $date_sortie
                );
                $this->Portefeuille_model->ajouter_amende($amende_data);
                $this->session->set_flashdata('error', 'Vous avez dépassé le délai de stationnement vous avez été puni. Vérifiez votre solde');
            }

            $this->Stationnement_model->update_stationnement_sortie($id_voiture, $date_sortie);

            $this->Parking_model->update_parking_disponibilite($id_parking, 'libre');

            $this->session->set_flashdata('success', 'Paiement effectué et voiture retirée avec succès.');
        } else {
            $this->session->set_flashdata('error', 'Solde insuffisant dans le portefeuille.');
        }

        redirect('parking/show_voitures_stationnees');

        // if (strtotime($date_sortie) > strtotime($date_sortie_attendue)) {
        //     $montant_amende = 5000.00;

        //     $amende_data = array(
        //         'id_voiture' => $id_voiture,
        //         'montant' => $montant_amende,
        //         'date_amende' => $date_sortie
        //     );
        //     $this->Parking_model->add_amende($amende_data);
        // }

        // $this->Stationnement_model->update_stationnement_sortie($id_voiture, $date_sortie);

        // $this->Parking_model->update_parking_disponibilites($id_parking, 'libre');

        // $this->session->set_flashdata('success', 'La voiture a été retirée avec succès.');
        // redirect('parking/show_voitures_stationnees');
    }


}
