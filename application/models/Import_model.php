<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_model extends CI_Model {

    // Insert propriétaire
    public function insert_proprietaire($data) {
        $this->db->insert('proprietaire', $data);
        return $this->db->insert_id();
    }

    // Get propriétaire by telephone
    public function get_proprietaire_by_tel($tel) {
        $query = $this->db->get_where('proprietaire', array('tel' => $tel));
        return $query->row_array();
    }

    // Insert type de bien
    public function insert_type_bien($data) {
        $this->db->insert('type_bien', $data);
        return $this->db->insert_id();
    }

    // Get type de bien by nom
    public function get_type_bien_by_nom($nom) {
        $query = $this->db->get_where('type_bien', array('nom' => $nom));
        return $query->row_array();
    }

    // Insert bien
    public function insert_bien($data) {
        $this->db->insert('bien', $data);
        return $this->db->insert_id();
    }

    // Get bien by reference
    public function get_bien_by_reference($reference) {
        $query = $this->db->get_where('bien', array('reference' => $reference));
        return $query->row_array();
    }

    // Insert client
    public function insert_client($data) {
        $this->db->insert('client', $data);
        return $this->db->insert_id();
    }

    // Get client by email
    public function get_client_by_email($email) {
        $query = $this->db->get_where('client', array('email' => $email));
        return $query->row_array();
    }

    // Insert location
    public function insert_location($data) {
        $this->db->insert('location', $data);
        return $this->db->insert_id();
    }

    public function update_type_bien_commission($nom, $commission) {
        $this->db->set('commission', $commission);
        $this->db->where('nom', $nom);
        $this->db->update('type_bien');
    }
}
