<?php
class Location_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function ajouter_location($data)
    {
        $this->db->insert('location', $data);
        return $this->db->insert_id();
    }

    public function get_locations_by_client($id_client)
    {
        $this->db->select('*');
        $this->db->from('location');
        $this->db->where('id_client', $id_client);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_paiements_by_location($id_location)
    {
        $this->db->select('*');
        $this->db->from('paiement');
        $this->db->where('id_location', $id_location);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_location_by_id($id_location)
    {
        $this->db->select('*');
        $this->db->from('location');
        $this->db->where('id_location', $id_location);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_total_paye($id_location)
    {
        $this->db->select_sum('loyer_paye');
        $this->db->where('id_location', $id_location);
        $query = $this->db->get('paiement');
        return $query->row()->loyer_paye;
    }

    // chiffre d'affaire et gain admin 
    public function get_chiffre_gain_admin($start_date, $end_date)
    {
        $sql = "
            SELECT
                DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') AS month,
                SUM(IF(numbers.n = 0, b.loyer_mois, b.loyer_mois * (tb.commission / 100))) AS total_gain,
                SUM(b.loyer_mois) AS total_loyer_mensuel
            FROM
                location l
            JOIN
                bien b ON l.id_bien = b.id_bien
            JOIN
                type_bien tb ON b.id_type_bien = tb.id_type_bien
            JOIN
                (
                    SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
                    UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
                    UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12 UNION ALL SELECT 13 UNION ALL SELECT 14
                    UNION ALL SELECT 15 UNION ALL SELECT 16 UNION ALL SELECT 17 UNION ALL SELECT 18 UNION ALL SELECT 19
                    UNION ALL SELECT 20 UNION ALL SELECT 21 UNION ALL SELECT 22 UNION ALL SELECT 23 UNION ALL SELECT 24
                    UNION ALL SELECT 25 UNION ALL SELECT 26 UNION ALL SELECT 27 UNION ALL SELECT 28 UNION ALL SELECT 29
                    UNION ALL SELECT 30 UNION ALL SELECT 31 UNION ALL SELECT 32 UNION ALL SELECT 33 UNION ALL SELECT 34
                    UNION ALL SELECT 35 UNION ALL SELECT 36 UNION ALL SELECT 37 UNION ALL SELECT 38 UNION ALL SELECT 39
                    UNION ALL SELECT 40 UNION ALL SELECT 41 UNION ALL SELECT 42 UNION ALL SELECT 43 UNION ALL SELECT 44
                    UNION ALL SELECT 45 UNION ALL SELECT 46 UNION ALL SELECT 47 UNION ALL SELECT 48
                ) numbers ON numbers.n < l.duree_mois
            WHERE
                DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') BETWEEN ? AND ?
            GROUP BY
                month
            ORDER BY
                month
        ";

        $query = $this->db->query($sql, array($start_date, $end_date));
        return $query->result_array();
    }

    // chiffre d'affaire proprio et gain
    public function get_chiffre_affaires_proprio($id_proprietaire, $start_date, $end_date)
    {
        $sql = "
            SELECT
                p.id_proprietaire,
                DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') AS month,
                SUM(IF(numbers.n = 0, b.loyer_mois, b.loyer_mois * (1 - tb.commission / 100))) AS total_gain,
                SUM(b.loyer_mois) AS chiffre_affaire_mensuel
            FROM
                location l
            JOIN
                bien b ON l.id_bien = b.id_bien
            JOIN
                type_bien tb ON b.id_type_bien = tb.id_type_bien
            JOIN
                proprietaire p ON b.id_proprietaire = p.id_proprietaire
            JOIN
                (
                    SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
                    UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
                    UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12 UNION ALL SELECT 13 UNION ALL SELECT 14
                    UNION ALL SELECT 15 UNION ALL SELECT 16 UNION ALL SELECT 17 UNION ALL SELECT 18 UNION ALL SELECT 19
                    UNION ALL SELECT 20 UNION ALL SELECT 21 UNION ALL SELECT 22 UNION ALL SELECT 23 UNION ALL SELECT 24
                    UNION ALL SELECT 25 UNION ALL SELECT 26 UNION ALL SELECT 27 UNION ALL SELECT 28 UNION ALL SELECT 29
                    UNION ALL SELECT 30 UNION ALL SELECT 31 UNION ALL SELECT 32 UNION ALL SELECT 33 UNION ALL SELECT 34
                    UNION ALL SELECT 35 UNION ALL SELECT 36 UNION ALL SELECT 37 UNION ALL SELECT 38 UNION ALL SELECT 39
                    UNION ALL SELECT 40 UNION ALL SELECT 41 UNION ALL SELECT 42 UNION ALL SELECT 43 UNION ALL SELECT 44
                    UNION ALL SELECT 45 UNION ALL SELECT 46 UNION ALL SELECT 47 UNION ALL SELECT 48
                ) numbers ON numbers.n < l.duree_mois
            WHERE
                p.id_proprietaire = ? AND
                DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') BETWEEN ? AND ?
            GROUP BY
                p.id_proprietaire,
                month
            ORDER BY
                month
        ";

        $query = $this->db->query($sql, array($id_proprietaire, $start_date, $end_date));
        return $query->result_array();
    }

    public function get_payment_status_by_client($id_client, $start_date, $end_date)
    {
        $sql = "
        SELECT 
                b.nom AS property_name, 
                DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) AS datepaiement, 
                CASE 
                    WHEN n.n = 1 THEN b.loyer_mois * 2
                    ELSE b.loyer_mois
                END AS montant, 
                CASE 
                    WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 'paid'
                    ELSE 'unpaid'
                END AS status,
                CASE 
                    WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 0
                    ELSE CASE 
                        WHEN n.n = 1 THEN b.loyer_mois * 2
                        ELSE b.loyer_mois
                    END
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
                datepaiement ASC
    ";

        $query = $this->db->query($sql, array($id_client, $start_date, $end_date));
        return $query->result();
    }

    public function add_location($data)
    {
        return $this->db->insert('location', $data);
    }

    public function get_all_biens()
    {
        $query = $this->db->get('bien');
        return $query->result_array();
    }

    public function get_all_clients()
    {
        $query = $this->db->get('client');
        return $query->result_array();
    }

    public function has_active_location($id_bien, $date_debut)
    {
        $this->db->where('id_bien', $id_bien);
        $this->db->where('date_fin_prevu >=', $date_debut);
        $query = $this->db->get('location');
        return $query->num_rows() > 0;
    }
}
