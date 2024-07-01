<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Csvimport
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
    }

    public function import_data_point($file_path_point)
    {
        if (!file_exists($file_path_point) ||!is_readable($file_path_point)) {
            return false;
        }

        $file_content = file_get_contents($file_path_point);

        if (empty($file_content)) {
            return false;
        }

        $csv_lines = explode(PHP_EOL, $file_content);
        $success = true;

        for ($i = 1; $i < count($csv_lines); $i++) {
            $line = trim($csv_lines[$i]);

            if (!empty($line)) {
                $csv_values = str_getcsv($line);

                // Validation basique
                if (!filter_var($csv_values[0], FILTER_VALIDATE_INT) ||!filter_var($csv_values[1], FILTER_VALIDATE_INT)) {
                    continue; // Passe à la ligne suivante si les valeurs ne sont pas valides
                }

                $rang_data = array(
                    'id_rang' => $csv_values[0],
                    'point' => $csv_values[1]
                );

                if (!$this->CI->db->insert('rang', $rang_data)) {
                    $success = false;
                }
            }
        }

        return $success;
    }
}
