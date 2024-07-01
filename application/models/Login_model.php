<?php
class Login_model extends CI_Model {
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    private function get_admin_by_email($email) {
        $query = $this->db->get_where('admin', array('email' => $email));
        return $query->row_array();
    }

    public function admin_login($email, $mdp) {
        $admin = $this->get_admin_by_email($email);
        if ($admin && $mdp == $admin['mdp']) {
            return $admin;
        }
        return false;
    }

    private function get_proprio_by_tel($tel) {
        $query = $this->db->get_where('proprietaire', array('tel' => $tel));
        return $query->row_array();
    }
    
    public function proprio_login($tel) {
        $proprio = $this->get_proprio_by_tel($tel);
        var_dump($proprio);
        if ($proprio) {
            $this->session->set_userdata('proprietaire', $proprio);
            return true; 
        } else {
            return false;
        }
    }

    private function get_client_by_email($email) {
        $query = $this->db->get_where('client', array('email' => $email));
        return $query->row_array();
    }
    
    public function client_login($email) {
        $client = $this->get_client_by_email($email);
        if ($client) {
            $this->session->set_userdata('client', $client);
            return true; 
        } else {
            return false;
        }
    }

}
