<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Import_model');
        date_default_timezone_set('Europe/Paris');
    }

    public function csv_import_biens() {
        if (isset($_FILES["csv_file_biens"]["name"])) {
            $path = $_FILES["csv_file_biens"]["tmp_name"];
            $file = fopen($path, "r");
            $header = fgetcsv($file);

            while ($row = fgetcsv($file)) {
                $reference = $row[0];
                $nom = $row[1];
                $description = $row[2];
                $type_nom = $row[3];
                $region = $row[4];
                $loyer_mensuel = $row[5];
                $proprietaire_tel = $row[6];
                $commission = $row[7];

                // Check if proprietaire exists, if not, insert
                $proprietaire = $this->Import_model->get_proprietaire_by_tel($proprietaire_tel);
                if (!$proprietaire) {
                    $proprietaire_data = array(
                        'tel' => $proprietaire_tel
                    );
                    $proprietaire_id = $this->Import_model->insert_proprietaire($proprietaire_data);
                } else {
                    $proprietaire_id = $proprietaire['id_proprietaire'];
                }

                // Check if type_bien exists, if not, insert
                $type_bien = $this->Import_model->get_type_bien_by_nom($type_nom, $commission);
                if (!$type_bien) {
                    $type_bien_data = array(
                        'nom' => $type_nom,
                        'commission' => $commission
                    );
                    $type_bien_id = $this->Import_model->insert_type_bien($type_bien_data);
                } else {
                    $type_bien_id = $type_bien['id_type_bien'];
                }

                // Insert bien
                $bien_data = array(
                    'reference' => $reference,
                    'nom' => $nom,
                    'description' => $description,
                    'region' => $region,
                    'loyer_mois' => $loyer_mensuel,
                    'id_proprietaire' => $proprietaire_id,
                    'id_type_bien' => $type_bien_id
                );
                $this->Import_model->insert_bien($bien_data);
            }
            fclose($file);
            $this->session->set_flashdata('message', 'CSV Data Imported Successfully');
            redirect('admin');
        }
    }
}