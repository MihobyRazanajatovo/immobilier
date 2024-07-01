<?php
class Bien_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Europe/Paris');
    }

    public function get_biens_by_proprietaire($id_proprietaire) {
        $this->db->select('*');
        $this->db->from('bien');
        $this->db->where('id_proprietaire', $id_proprietaire);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_photos_by_bien($id_bien) {
        $this->db->select('photo_url');
        $this->db->from('photo');
        $this->db->where('id_bien', $id_bien);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_biens_with_photos($id_proprietaire) {
        $biens = $this->get_biens_by_proprietaire($id_proprietaire);
        foreach ($biens as &$bien) {
            $bien['photo'] = $this->get_photos_by_bien($bien['id_bien']);
        }
        return $biens;
    }  

    public function get_all_biens() {
        $this->db->select('*');
        $this->db->from('bien');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_biens_with_photos() {
        $biens = $this->get_all_biens();
        foreach ($biens as &$bien) {
            $bien['photos'] = $this->get_photos_by_bien($bien['id_bien']);
        }
        return $biens;
    }

    public function get_bien_by_id($id_bien) {
        $this->db->select('*');
        $this->db->from('bien');
        $this->db->where('id_bien', $id_bien);
        $query = $this->db->get();
        return $query->row_array();
    }
}
