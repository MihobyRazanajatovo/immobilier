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
                            <h4>Chiffre d'Affaires et Gain de MADA IMMO</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo site_url('admin/chiffre_gain'); ?>" class="form-container">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="start_date">Start Date (YYYY-MM):</label>
                                        <input type="month" id="start_date" name="start_date" class="form-control" placeholder="Date début">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="end_date">End Date (YYYY-MM):</label>
                                        <input type="month" id="end_date" name="end_date" class="form-control" placeholder="Date">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-custom btn-block">Afficher</button>
                            </form>
                            <div class="mt-4">
                                <?php if (!empty($results)) : ?>
                                    <table class="table table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Mois</th>
                                                <th scope="col">Gain</th>
                                                <th scope="col">Chiffre d'Affaire</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_chiffre_affaire = 0;
                                            $total_loyer_mensuel = 0;
                                            foreach ($results as $row) :
                                                $total_chiffre_affaire += $row['total_gain'];
                                                $total_loyer_mensuel += $row['total_loyer_mensuel'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['month']; ?></td>
                                                    <td><?php echo number_format($row['total_gain'], 2, '.', ','); ?></td>
                                                    <td><?php echo number_format($row['total_loyer_mensuel'], 2, '.', ','); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <th><?php echo number_format($total_chiffre_affaire, 2, '.', ','); ?></th>
                                                <th><?php echo number_format($total_loyer_mensuel, 2, '.', ','); ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                <?php endif; ?>
                            </div>
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