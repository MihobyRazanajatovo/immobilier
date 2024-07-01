<?php
class Tarif_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_tarifs() {
        $query = $this->db->get('tarif');
        return $query->result_array();
    }

    public function get_tarif($id_tarif) {
        $this->db->where('id_tarif', $id_tarif);
        $query = $this->db->get('tarif');
        return $query->row_array();
    }

    
    
    public function insert_tarif($data) {
        $this->db->insert('tarif', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            throw new Exception('Failed to insert tarif');
        }
    }

    public function update_tarif($id, $data) {
        $this->db->where('id_tarif', $id);
        $this->db->update('tarif', $data);
        return $this->db->affected_rows() > 0;
    }

    public function delete_tarif($id) {  
        $this->db->where('id_tarif', $id);
        $this->db->delete('tarif');
    }
    
}
