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
                $type_bien = $this->Import_model->get_type_bien_by_nom($type_nom);
                if (!$type_bien) {
                    $type_bien_data = array(
                        'nom' => $type_nom
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

    private function convert_date_format($date) {
        $date_array = explode('/', $date); // Le séparateur dans votre fichier CSV est '/' et non '-'
        return $date_array[2] . '-' . $date_array[1] . '-' . $date_array[0];
    }

    public function csv_import_locations() {
        if (isset($_FILES["csv_file_locations"]["name"])) {
            $path = $_FILES["csv_file_locations"]["tmp_name"];
            $file = fopen($path, "r");
            $header = fgetcsv($file);

            while ($row = fgetcsv($file)) {
                $reference = $row[0];
                $date_debut = $this->convert_date_format($row[1]);
                $duree_mois = $row[2];
                $client_email = $row[3];

                // Check if client exists, if not, insert
                $client = $this->Import_model->get_client_by_email($client_email);
                if (!$client) {
                    $client_data = array(
                        'email' => $client_email
                    );
                    $client_id = $this->Import_model->insert_client($client_data);
                } else {
                    $client_id = $client['id_client'];
                }

                // Check if bien exists
                $bien = $this->Import_model->get_bien_by_reference($reference);
                if (!$bien) {
                    continue; // Skip if bien does not exist
                }

                $id_bien = $bien['id_bien'];
                $date_fin_prevu = date('Y-m-d', strtotime("+$duree_mois months", strtotime($date_debut)));

                // Insert location
                $location_data = array(
                    'id_bien' => $id_bien,
                    'id_client' => $client_id,
                    'date_debut' => $date_debut,
                    'date_fin_prevu' => $date_fin_prevu,
                    'duree_mois' => $duree_mois
                );
                $this->Import_model->insert_location($location_data);
            }
            fclose($file);
            $this->session->set_flashdata('message', 'CSV des locations importé avec succès');
            redirect('admin');
        }
    }

    public function csv_import_commissions() {
        if (isset($_FILES["csv_file_commissions"]["name"])) {
            $path = $_FILES["csv_file_commissions"]["tmp_name"];
            $file = fopen($path, "r");
            $header = fgetcsv($file);

            while ($row = fgetcsv($file)) {
                $type_nom = $row[0];
                $commission = floatval(str_replace('%', '', str_replace(',', '.', $row[1])));

                // Update commission for type de bien
                $this->Import_model->update_type_bien_commission($type_nom, $commission);
            }
            fclose($file);
            $this->session->set_flashdata('message', 'CSV des commissions importé avec succès');
            redirect('admin');
        }
    }
}