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

    public function get_biens_with_details() {
        $this->db->select('
            b.id_bien,
            b.nom AS nom_bien,
            b.description,
            b.region,
            b.loyer_mois,
            p.tel AS tel_proprietaire,
            t.nom AS type_bien,
            COALESCE(l.disponibilite, "Disponible") AS disponibilite
        ');
        $this->db->from('bien b');
        $this->db->join('location l', 'b.id_bien = l.id_bien', 'left');
        $this->db->join('proprietaire p', 'b.id_proprietaire = p.id_proprietaire', 'left');
        $this->db->join('type_bien t', 'b.id_type_bien = t.id_type_bien', 'left');
        $this->db->order_by('b.id_bien');

        $biens = $this->db->get()->result_array();

        foreach ($biens as &$bien) {
            $this->db->select('photo_url');
            $this->db->from('photo');
            $this->db->where('id_bien', $bien['id_bien']);
            $photos = $this->db->get()->result_array();
            $bien['photos'] = $photos;
        }

        return $biens;
    }

    public function get_location_details() {
        $query = $this->db->query("
            SELECT 
                b.nom AS designation, 
                b.loyer_mois, 
                DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) AS mois, 
                CASE 
                    WHEN n.n = 1 THEN '100%'
                    ELSE CONCAT(t.commission, '%')
                END AS commission,
                n.n AS num_mois_location,
                CASE 
                    WHEN n.n = 1 THEN b.loyer_mois
                    ELSE b.loyer_mois * t.commission / 100
                END AS valeur_commission,
                CASE 
                    WHEN n.n = 1 THEN b.loyer_mois * 2
                    ELSE b.loyer_mois
                END AS loyer_du_mois
            FROM 
                (SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL 
                 SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL 
                 SELECT 11 UNION ALL SELECT 12) AS n
            JOIN 
                location l ON n.n <= l.duree_mois
            JOIN 
                bien b ON l.id_bien = b.id_bien
            JOIN
                type_bien t ON b.id_type_bien = t.id_type_bien
            ORDER BY 
                b.id_bien, mois ASC
        ");
        return $query->result_array();
    }
    
}
