<?php
class Location_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function ajouter_location($data) {
        $this->db->insert('location', $data);
        return $this->db->insert_id();
    }

    public function get_locations_by_client($id_client) {
        $this->db->select('*');
        $this->db->from('location');
        $this->db->where('id_client', $id_client);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_paiements_by_location($id_location) {
        $this->db->select('*');
        $this->db->from('paiement');
        $this->db->where('id_location', $id_location);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_location_by_id($id_location) {
        $this->db->select('*');
        $this->db->from('location');
        $this->db->where('id_location', $id_location);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_total_paye($id_location) {
        $this->db->select_sum('loyer_paye');
        $this->db->where('id_location', $id_location);
        $query = $this->db->get('paiement');
        return $query->row()->loyer_paye;
    }

    // anaovana chiffre d'affaire admin
    public function get_all_locations_with_biens() {
        $this->db->select('location.*, bien.loyer_mois');
        $this->db->from('location');
        $this->db->join('bien', 'location.id_bien = bien.id_bien');
        $query = $this->db->get();
        return $query->result_array();
    }

    //get chiffre d'affaire entre deux mois
    // public function get_total_rent_by_month($start_date, $end_date) {
    //     $this->db->select("DATE_FORMAT(l.date_fin_prevu, '%Y-%m') AS mois, SUM(b.loyer_mois * l.duree_mois) AS total_rent");
    //     $this->db->from('location l');
    //     $this->db->join('bien b', 'l.id_bien = b.id_bien');
    //     $this->db->where("DATE_FORMAT(l.date_debut, '%Y-%m') >=", $start_date);
    //     $this->db->where("DATE_FORMAT(l.date_fin_prevu, '%Y-%m') <=", $end_date);
    //     $this->db->group_by('mois');
    //     $this->db->order_by('mois', 'ASC');
        
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    //get chiffre d'affaire et gain entre deux mois
    public function get_total_rent_and_gain_by_month($start_date, $end_date) {
        $this->db->select("DATE_FORMAT(l.date_fin_prevu, '%Y-%m-%d') AS mois, SUM(b.loyer_mois * l.duree_mois) AS total_rent, SUM(b.loyer_mois * l.duree_mois * tb.commission / 100) AS gain");
        $this->db->from('location l');
        $this->db->join('bien b', 'l.id_bien = b.id_bien');
        $this->db->join('type_bien tb', 'b.id_type_bien = tb.id_type_bien');
        $this->db->where("DATE_FORMAT(l.date_debut, '%Y-%m-%d') >=", $start_date);
        $this->db->where("DATE_FORMAT(l.date_fin_prevu, '%Y-%m-%d') <=", $end_date);
        $this->db->group_by('mois');
        $this->db->order_by('mois', 'ASC');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function get_chiffre_affaires_proprio($start_date, $end_date) {
        $this->db->select("DATE_FORMAT(l.date_fin_prevu, '%Y-%m') AS mois, SUM(b.loyer_mois * l.duree_mois) AS chiffre_affaires");
        $this->db->from('location l');
        $this->db->join('bien b', 'l.id_bien = b.id_bien');
        $this->db->join('type_bien tb', 'b.id_type_bien = tb.id_type_bien');
        $this->db->where('b.id_proprietaire', 1);
        $this->db->where("DATE_FORMAT(l.date_debut, '%Y-%m') >=", $start_date);
        $this->db->where("DATE_FORMAT(l.date_fin_prevu, '%Y-%m') <=", $end_date);
        $this->db->group_by('mois');
        $this->db->order_by('mois', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function get_payment_status_by_client($id_client, $start_date, $end_date) {
        $sql = "SELECT 
                    b.nom AS property_name, 
                    DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) AS datepaiement, 
                    b.loyer_mois AS montant, 
                    CASE 
                        WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 'paid'
                        ELSE 'unpaid'
                    END AS status,
                    CASE 
                        WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 0
                        ELSE b.loyer_mois
                    END AS prix_a_payer_ou_restant
                FROM 
                    (SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL 
                     SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL 
                     SELECT 11 UNION ALL SELECT 12) AS n
                JOIN 
                    location l ON n.n <= l.duree_mois
                JOIN 
                    bien b ON l.id_bien = b.id_bien
                WHERE 
                    l.id_client = ?
                    AND DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) BETWEEN ? AND ?
                ORDER BY 
                    datepaiement ASC";
    
        // Ajout de traces
        log_message('debug', 'SQL Query: ' . $this->db->last_query());
    
        $query = $this->db->query($sql, array($id_client, $start_date, $end_date));
        return $query->result();
    }
    
}
