<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Time extends CI_Controller {

    public function set_time() {
        $new_time = $this->input->post('time');
        $seconds = $this->input->post('seconds');
        $data['time'] = $new_time . ':' . str_pad($seconds, 2, '0', STR_PAD_LEFT);
        $this->load->view('accueil_admin_page', $data);
    }
}
