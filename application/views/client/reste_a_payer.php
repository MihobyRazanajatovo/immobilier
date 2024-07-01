<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reste à Payer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Reste à Payer pour <?php echo $bien['nom']; ?></h1>
        <?php if (isset($client['email'])): ?>
            <p>Client : <?php echo $client['email']; ?></p>
        <?php else: ?>
            <p>Client inconnu</p>
        <?php endif; ?>
        <p>Montant total payé : <?php echo $total_paye; ?> €</p>
        <p>Reste à payer : <?php echo $reste_a_payer; ?> €</p>
        <form action="<?php echo site_url('location/payer'); ?>" method="post">
            <input type="hidden" name="id_location" value="<?php echo $id_location; ?>">
            <div class="form-group">
                <label for="debut_paiement">Date de début de paiement :</label>
                <input type="date" class="form-control" id="debut_paiement" name="debut_paiement" required>
            </div>
            <div class="form-group">
                <label for="fin_paiement">Date de fin de paiement :</label>
                <input type="date" class="form-control" id="fin_paiement" name="fin_paiement" required>
            </div>
            <button type="submit" class="btn btn-success mt-3">Payer</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
