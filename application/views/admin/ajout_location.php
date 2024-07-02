<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter nouvelle location</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/accueil_page.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/parking.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend-plugin.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend.css?v=1.0.0'); ?>">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 10px 10px 0 0;
        }

        .card-header h4 {
            margin: 0;
        }

        .card-body {
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: 0;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        select,
        input[type="date"],
        input[type="number"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            box-sizing: border-box;
        }

        .btn-custom {
            background-color: #eb631b;
            border-color: #eb631b;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #d9541a;
            border-color: #d9541a;
        }
    </style>
</head>

<body>
    <?php include('header_admin.php'); ?>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ajouter nouvelle location</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo site_url('admin/add'); ?>">
                                <label for="id_bien">Sélectionner un bien:</label>
                                <select id="id_bien" name="id_bien" required>
                                    <?php foreach ($biens as $bien) : ?>
                                        <option value="<?php echo $bien['id_bien']; ?>"><?php echo $bien['nom']; ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <label for="id_client">Sélectionner un client:</label>
                                <select id="id_client" name="id_client" required>
                                    <?php foreach ($clients as $client) : ?>
                                        <option value="<?php echo $client['id_client']; ?>"><?php echo $client['email']; ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <label for="date_debut">Date de début:</label>
                                <input type="date" id="date_debut" name="date_debut" required>

                                <label for="duree_mois">Durée (mois):</label>
                                <input type="number" id="duree_mois" name="duree_mois" required>

                                <button type="submit" class="btn btn-custom">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/backend-bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/customizer.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/sidebar.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/flex-tree.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/tree.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/table-treeview.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/sweetalert.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vector-map-custom.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/chart-custom.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/charts/01.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/charts/02.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/slider.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/emoji-picker-element/index.js'); ?>" type="module"></script>
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
</body>

</html>
