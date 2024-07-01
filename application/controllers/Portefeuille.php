<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portefeuille extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Portefeuille_model');
    }

    public function show_portefeuille() {
        if (!$this->session->userdata('client')) {
            redirect('accueil');
        }

        $id_client = $this->session->userdata('client')['id_client'];
        $data['portefeuille'] = $this->Portefeuille_model->get_portefeuille_by_client($id_client);

        $this->load->view('header_page');
        $this->load->view('portefeuille_page', $data);
    }

    public function demander_recharge() {
        if (!$this->session->userdata('client')) {
            redirect('accueil');
        }

        $id_client = $this->session->userdata('client')['id_client'];
        $montant = $this->input->post('montant');

        $portefeuille = $this->Portefeuille_model->get_portefeuille_by_client($id_client);
        if ($portefeuille) {
            $data = array(
                'id_portefeuille' => $portefeuille['id_portefeuille'],
                'montant' => $montant,
                'date_recharge' => date('Y-m-d H:i:s'),
                'statut' => 'en attente'
            );
            $this->Portefeuille_model->ajouter_recharge($data);
            $this->session->set_flashdata('success', 'Demande de recharge envoyée avec succès.');
        } else {
            $this->session->set_flashdata('error', 'Erreur lors de la demande de recharge.');
        }
        redirect('portefeuille/show_portefeuille');
    }

    public function show_recharges_en_attente() {
        if (!$this->session->userdata('admin')) {
            redirect('accueil');
        }

        $data['recharges'] = $this->Portefeuille_model->get_recharges_en_attente();

        $this->load->view('attente_page', $data);
    }

    public function approuver_recharge($id_recharge) {
        if (!$this->session->userdata('admin')) {
            redirect('accueil');
        }

        $recharge = $this->Portefeuille_model->get_recharge($id_recharge);
        if ($recharge && $recharge['statut'] == 'en attente') {
            $this->Portefeuille_model->approuver_recharge($id_recharge);
            $this->Portefeuille_model->mettre_a_jour_montant($recharge['id_portefeuille'], $recharge['montant']);
            $this->session->set_flashdata('success', 'Recharge approuvée avec succès.');
        } else {
            $this->session->set_flashdata('error', 'Erreur lors de l\'approbation de la recharge.');
        }
        redirect('portefeuille/show_recharges_en_attente');
    }

    public function rejeter_recharge($id_recharge) {
        if (!$this->session->userdata('admin')) {
            redirect('accueil');
        }

        $this->Portefeuille_model->rejeter_recharge($id_recharge);
        $this->session->set_flashdata('success', 'Recharge rejetée avec succès.');
        redirect('portefeuille/show_recharges_en_attente');
    }
}
