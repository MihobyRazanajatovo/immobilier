<?php
class Voiture_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function add_voiture($data) {
        return $this->db->insert('voiture', $data);
    }
}
