<?php
class Parking_model extends CI_Model {

    public function get_parking($id = null) {
        if ($id) {
            $query = $this->db->get_where('parking', array('id_parking' => $id));
            return $query->row_array();
        } else {
            $query = $this->db->get('parking');
            return $query->result_array();
        }
    }

    public function add_stationnement($data) {
        return $this->db->insert('stationnement', $data);
    }

    public function update_parking_disponibilite($id_parking, $disponibilite) {
        $this->db->where('id_parking', $id_parking);
        return $this->db->update('parking', array('disponibilite' => $disponibilite));
    }

    public function add_amende($data) {
        $this->db->insert('amende', $data);
    }

    public function update_parking_disponibilites($id_parking, $disponibilite) {
        $this->db->set('disponibilite', $disponibilite);
        $this->db->where('id_parking', $id_parking);
        $this->db->update('parking');
    }
    
}