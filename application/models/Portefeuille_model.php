<?php
class Portefeuille_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Europe/Paris');
    }

    public function get_portefeuille_by_client($id_client) {
        $this->db->where('id_client', $id_client);
        $query = $this->db->get('portefeuille');
        return $query->row_array();
    }

    public function ajouter_recharge($data) {
        $this->db->insert('recharge', $data);
    }

    public function get_recharges_en_attente() {
        $this->db->where('statut', 'en attente');
        $query = $this->db->get('recharge');
        return $query->result_array();
    }

    public function get_recharge($id_recharge) {
        $this->db->where('id_recharge', $id_recharge);
        $query = $this->db->get('recharge');
        return $query->row_array();
    }

    public function approuver_recharge($id_recharge) {
        $this->db->set('statut', 'approuvé');
        $this->db->where('id_recharge', $id_recharge);
        $this->db->update('recharge');
    }

    public function rejeter_recharge($id_recharge) {
        $this->db->set('statut', 'rejeté');
        $this->db->where('id_recharge', $id_recharge);
        $this->db->update('recharge');
    }

    public function mettre_a_jour_montant($id_portefeuille, $montant) {
        $this->db->set('montant', 'montant + ' . $montant, FALSE);
        $this->db->where('id_portefeuille', $id_portefeuille);
        $this->db->update('portefeuille');
    }

    public function verifier_solde($id_portefeuille, $montant) {
        $this->db->where('id_portefeuille', $id_portefeuille);
        $this->db->where('montant >=', $montant);
        $query = $this->db->get('portefeuille');
        return $query->num_rows() > 0;
    }

    public function deduire_montant($id_portefeuille, $montant) {
        $this->db->set('montant', 'montant - ' . $montant, FALSE);
        $this->db->where('id_portefeuille', $id_portefeuille);
        $this->db->update('portefeuille');
    }

    public function ajouter_amende($data) {
        $this->db->insert('amende', $data);
    }

}
