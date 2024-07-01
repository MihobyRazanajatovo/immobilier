<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biens propriétaire</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/accueil_page.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/accueil.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/parking.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend-plugin.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend.css?v=1.0.0'); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<?php include('header_proprio.php'); ?>
    <div class="content-page">
        <div class="container-fluid">
            <h1>Biens du Propriétaire</h1>
            <?php if (!empty($biens)) : ?>
                <div class="row property-list">
                    <?php foreach ($biens as $bien) : ?>
                        <div class="col-md-6 col-lg-3 d-flex">
                            <div class="property-card">
                                <h3><?php echo $bien['nom']; ?></h3>
                                <p>Description : <?php echo $bien['description']; ?></p>
                                <p>Région : <?php echo $bien['region']; ?></p>
                                <p>Loyer par mois : <?php echo $bien['loyer_mois']; ?></p>
                                <?php if (!empty($bien['photo'])) : ?>
                                    <div id="carousel-<?php echo $bien['id_bien']; ?>" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php foreach ($bien['photo'] as $index => $photo) : ?>
                                                <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                                                    <img src="<?php echo base_url($photo['photo_url']); ?>" class="d-block w-100" alt="Photo du bien">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#carousel-<?php echo $bien['id_bien']; ?>" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-<?php echo $bien['id_bien']; ?>" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <p>Aucune photo disponible</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p>Aucun bien trouvé pour ce propriétaire.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
