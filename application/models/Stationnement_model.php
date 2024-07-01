<?php
class Stationnement_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Europe/Paris');
    }

    public function get_voitures_stationnees_par_client($id_client) {
        $this->db->select('v.id_voiture, v.marque, v.immatriculation, v.couleur, s.id_parking, s.date_sortie');
        $this->db->from('stationnement s');
        $this->db->join('voiture v', 's.id_voiture = v.id_voiture');
        $this->db->where('v.id_client', $id_client);
        $this->db->where('s.date_sortie >', date('Y-m-d H:i:s')); 
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_stationnement_par_voiture_et_client($id_voiture, $id_client) {
        $this->db->select('s.*, v.id_client');
        $this->db->from('stationnement s');
        $this->db->join('voiture v', 's.id_voiture = v.id_voiture');
        $this->db->where('s.id_voiture', $id_voiture);
        $this->db->where('v.id_client', $id_client); 
        $this->db->where('s.date_sortie >', date('Y-m-d H:i:s'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_stationnement_sortie($id_voiture, $date_sortie) {
        $this->db->set('date_sortie', $date_sortie);
        $this->db->where('id_voiture', $id_voiture);
        $this->db->where('date_sortie >', date('Y-m-d H:i:s')); 
        $this->db->update('stationnement');
    }
}
