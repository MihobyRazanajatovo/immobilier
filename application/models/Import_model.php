<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_model extends CI_Model {

    public function insert_proprietaire($data) {
        $this->db->insert('proprietaire', $data);
        return $this->db->insert_id();
    }

    public function get_proprietaire_by_tel($tel) {
        $query = $this->db->get_where('proprietaire', array('tel' => $tel));
        return $query->row_array();
    }

    public function insert_type_bien($data) {
        $this->db->insert('type_bien', $data);
        return $this->db->insert_id();
    }

    public function get_type_bien_by_nom($nom, $commission) {
        $query = $this->db->get_where('type_bien', array('nom' => $nom, 'commission' => $commission));
        return $query->row_array();
    }

    public function insert_bien($data) {
        $this->db->insert('bien', $data);
        return $this->db->insert_id();
    }

    public function get_bien_by_reference($reference) {
        $query = $this->db->get_where('bien', array('reference' => $reference));
        return $query->row_array();
    }
}
