<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Example</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/accueil_page.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/parking.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/remove_page.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend-plugin.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend.css?v=1.0.0'); ?>">
</head>

<body>
    <?php include('header_page.php'); ?>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Voitures stationnées</h4>
                            </div>
                        </div>
                        <div class="parking-lot">
                            <?php if (!empty($voitures)) : ?>
                                <ul>
                                    <?php foreach ($voitures as $voiture) : ?>
                                        <li>Marque: <?php echo $voiture['marque']; ?></li>
                                        <li>L'immatriculation: <?php echo $voiture['immatriculation']; ?></li>
                                        <li>Couleur de la voiture: <?php echo $voiture['couleur']; ?></li>
                                        <li>Sortie prévue le : <?php echo $voiture['date_sortie']; ?></li>
                                    <?php endforeach; ?>
                                    <li>
                                        <form action="<?php echo site_url('parking/remove'); ?>" method="post" style="display:inline;">
                                            <input type="hidden" name="id_voiture" value="<?php echo $voiture['id_voiture']; ?>">
                                            <button type="submit">Retirer</button>
                                        </form>
                                    </li>
                                </ul>
                            <?php else : ?>
                                <p>Aucune voiture n'est actuellement stationnée.</p>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('success')) : ?>
                                <p style="color:green;"><?php echo $this->session->flashdata('success'); ?></p>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('error')) : ?>
                                <p style="color:red;"><?php echo $this->session->flashdata('error'); ?></p>
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