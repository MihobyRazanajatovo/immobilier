<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Example</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/accueil_page.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/parking.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend-plugin.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend.css?v=1.0.0'); ?>">
    <style>
        .btn-custom {
            background-color: #eb631b;
            border-color: #eb631b;
            color: #fff;
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
                                <label for="id_bien">Select Property:</label>
                                <select id="id_bien" name="id_bien" required>
                                    <?php foreach ($biens as $bien) : ?>
                                        <option value="<?php echo $bien['id_bien']; ?>"><?php echo $bien['nom']; ?></option>
                                    <?php endforeach; ?>
                                </select><br><br>

                                <label for="id_client">Select Client:</label>
                                <select id="id_client" name="id_client" required>
                                    <?php foreach ($clients as $client) : ?>
                                        <option value="<?php echo $client['id_client']; ?>"><?php echo $client['email']; ?></option>
                                    <?php endforeach; ?>
                                </select><br><br>

                                <label for="date_debut">Start Date:</label>
                                <input type="date" id="date_debut" name="date_debut" required><br><br>

                                <label for="duree_mois">Duration (Months):</label>
                                <input type="number" id="duree_mois" name="duree_mois" required><br><br>

                                <button type="submit">Ajouter</button>
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