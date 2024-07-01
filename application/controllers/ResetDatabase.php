<?php
class ResetDatabase extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function reset_tables() {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $tables = ['client', 'tarif', 'voiture', 'parking', 'stationnement', 'portefeuille', 'recharge', 'amende'];
        foreach ($tables as $table) {
            $this->db->truncate($table);
        }
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
        $this->load->view('accueil_admin_page');
    }
}
