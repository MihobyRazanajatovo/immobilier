<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/accueil_page.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bouton.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/parking.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend-plugin.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend.css?v=1.0.0'); ?>">
    <title>Loyer</title>
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
    <?php include('header_client.php'); ?>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Loyer</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo site_url('client/payment_status_by_client'); ?>" class="form-container">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="end_date">End Date:</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-custom btn-block">Get Payment Status</button>
                            </form>
                            <div class="mt-4">
                                <?php if (!empty($results)) : ?>
                                    <table class="table table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Property Name</th>
                                                <th>Date de Paiement</th>
                                                <th>Montant</th>
                                                <th>Status</th>
                                                <th>Prix à Payer ou Restant</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($results as $row) : ?>
                                                <tr>
                                                    <td><?php echo $row->property_name; ?></td>
                                                    <td><?php echo $row->datepaiement; ?></td>
                                                    <td><?php echo number_format($row->montant, 2); ?></td>
                                                    <td><?php echo $row->status; ?></td>
                                                    <td><?php echo number_format($row->prix_a_payer_ou_restant, 2); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else : ?>
                                    <?php if (isset($start_date) && isset($end_date)) : ?>
                                        <p class="text-center text-muted">No data available for the selected date range.</p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/js/backend-bundle.min.js'); ?>"></script>
</body>

</html>
