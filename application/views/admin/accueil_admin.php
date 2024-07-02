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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .header-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-title h4 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .card {
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .btn-custom {
            background-color: #eb631b;
            color: #fff;
            border: none;
        }

        .btn-custom:hover {
            background-color: #d45a1a;
            color: #fff;
        }

        .form-group label {
            font-weight: bold;
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="header-title">
                                <h4 class="card-title">Réinitialiser votre base?</h4>
                                <form action="<?php echo base_url('Admin/reset_tables'); ?>" method="post">
                                    <button type="submit" class="btn btn-custom">Réinitialiser</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Import csv biens</h4>
                                <form action="<?php echo base_url('Import/csv_import_biens'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="csv_file_biens">Importer un fichier CSV</label>
                                        <input type="file" name="csv_file_biens" class="form-control" required>
                                    </div>
                                    <button type="submit" name="import" class="btn btn-custom">Importer</button>
                                </form>
                            </div>

                            <div class="header-title">
                                <h4 class="card-title">Import csv location</h4>
                                <form action="<?php echo base_url('Import/csv_import_locations'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="csv_file_locations">Importer un fichier CSV</label>
                                        <input type="file" name="csv_file_locations" class="form-control" required>
                                    </div>
                                    <button type="submit" name="import_locations" class="btn btn-custom">Importer</button>
                                </form>
                            </div>
                            <div class="header-title">
                                <h4 class="card-title">Import csv commission</h4>
                                <form action="<?php echo base_url('Import/csv_import_commissions'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="csv_file_commissions">Fichier CSV pour les commissions</label>
                                        <input type="file" name="csv_file_commissions" class="form-control" required>
                                    </div>
                                    <button type="submit" name="import_commissions" class="btn btn-custom">Importer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/backend-bundle.min.js'); ?>"></script>
    <!-- Chart Custom JavaScript -->
    <script src="<?php echo base_url('assets/js/customizer.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/sidebar.js'); ?>"></script>

    <!-- Flextree Javascript-->
    <script src="<?php echo base_url('assets/js/flex-tree.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/tree.js'); ?>"></script>

    <!-- Table Treeview JavaScript -->
    <script src="<?php echo base_url('assets/js/table-treeview.js'); ?>"></script>

    <!-- SweetAlert JavaScript -->
    <script src="<?php echo base_url('assets/js/sweetalert.js'); ?>"></script>

    <!-- Vectoe Map JavaScript -->
    <script src="<?php echo base_url('assets/js/vector-map-custom.js'); ?>"></script>

    <!-- Chart Custom JavaScript -->
    <script src="<?php echo base_url('assets/js/chart-custom.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/charts/01.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/charts/02.js'); ?>"></script>

    <!-- slider JavaScript -->
    <script src="<?php echo base_url('assets/js/slider.js'); ?>"></script>

    <!-- Emoji picker -->
    <script src="<?php echo base_url('assets/vendor/emoji-picker-element/index.js'); ?>" type="module"></script>


    <!-- app JavaScript -->
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
</body>

</html>
