<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Voiture</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/accueil_page.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/parking.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/ajout_voiture.css'); ?>">
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
                                <h4 class="card-title">Ajouter Voiture</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('error')) : ?>
                                <p><?php echo $this->session->flashdata('error'); ?></p>
                            <?php endif; ?>

                            <form action="<?php echo site_url('parking/save'); ?>" method="post">
                                <input type="hidden" name="id_parking" value="<?php echo $id_parking; ?>">
                                <div class="form-group">
                                    <label for="marque">Marque :</label>
                                    <input type="text" id="marque" name="marque" class="form-control" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="immatriculation">Immatriculation :</label>
                                    <input type="text" id="immatriculation" name="immatriculation" class="form-control" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="couleur">Couleur :</label>
                                    <input type="color" id="couleur" name="couleur" class="form-control" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="id_tarif">Durée de stationnement avec tarif:</label>
                                    <select name="tarif" required>
                                        <?php foreach ($tarifs as $tarif) { ?>
                                            <option value="<?php echo $tarif['id_tarif']; ?>"><?php echo htmlspecialchars($tarif['tranche']) . ' minutes - ' . htmlspecialchars($tarif['prix']) . ' Ariary'; ?></option>
                                        <?php } ?>
                                    </select><br>
                                </div>
                                <input type="hidden" name="tarif_minutes" value="15">
                                <button type="submit" class="signup-btn">Ajouter Voiture</button>
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

    <script>
        document.getElementById('id_tarif').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var tarifMinutes = selectedOption.getAttribute('data-minutes');
            document.getElementsByName('tarif_minutes')[0].value = tarifMinutes;
        });
    </script>
</body>

</html>