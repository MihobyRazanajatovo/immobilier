<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les biens</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/accueil_page.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/accueil.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bouton.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/parking.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend-plugin.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend.css?v=1.0.0'); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include('header_client.php'); ?>
    <div class="content-page">
        <div class="container-fluid">
            <h1>Tous les biens</h1>
            <?php if (!empty($biens)) : ?>
                <div class="row property-list">
                    <?php foreach ($biens as $bien) : ?>
                        <div class="col-md-4 d-flex mb-4">
                            <div class="property-card p-3 w-100 border">
                                <h3><?php echo $bien['nom']; ?></h3>
                                <p>Description : <?php echo $bien['description']; ?></p>
                                <p>Région : <?php echo $bien['region']; ?></p>
                                <p>Loyer par mois : <?php echo $bien['loyer_mois']; ?></p>
                                <?php if (!empty($bien['photos'])) : ?>
                                    <div id="carousel-<?php echo $bien['id_bien']; ?>" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php foreach ($bien['photos'] as $index => $photo) : ?>
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
                                <a href="<?php echo site_url('location/index/'.$bien['id_bien']); ?>" class="signup-btn mt-3">Louer</a>
                                <!-- <button type="submit" class="signup-btn mt-3">Louer</button> -->
                                <?php if (!empty($bien['locations'])) : ?>
                                    <div class="mt-3">
                                        <?php foreach ($bien['locations'] as $location) : ?>
                                            <a href="<?php echo site_url('location/reste_a_payer/' . $location['id_location']); ?>" class="btn btn-warning">Reste à Payer</a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p>Aucun bien trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
