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
</head>

<body>
    <?php include('header_admin.php'); ?>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="header-title">
                            <h4 class="card-title">Recharges en Attente</h4>
                        </div>
                        <?php if (!empty($recharges)) : ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID Recharge</th>
                                        <th>ID Portefeuille</th>
                                        <th>Montant</th>
                                        <th>Date de Demande</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recharges as $recharge) : ?>
                                        <tr>
                                            <td><?php echo $recharge['id_recharge']; ?></td>
                                            <td><?php echo $recharge['id_portefeuille']; ?></td>
                                            <td><?php echo $recharge['montant']; ?></td>
                                            <td><?php echo $recharge['date_recharge']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('portefeuille/approuver_recharge/' . $recharge['id_recharge']); ?>">Approuver</a> |
                                                <a href="<?php echo site_url('portefeuille/rejeter_recharge/' . $recharge['id_recharge']); ?>">Rejeter</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p>Aucune recharge en attente.</p>
                        <?php endif; ?>
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