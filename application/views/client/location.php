<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Loyer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Détails du Loyer pour <?php echo $bien['nom']; ?></h1>
        <?php if (isset($client['email'])): ?>
            <p>Client : <?php echo $client['email']; ?></p>
        <?php else: ?>
            <p>Client inconnu</p>
        <?php endif; ?>
        <form action="<?php echo site_url('location/calculer'); ?>" method="post">
            <input type="hidden" name="id_bien" value="<?php echo $bien['id_bien']; ?>">
            <div class="form-group">
                <label for="debut">Date de début :</label>
                <input type="date" class="form-control" id="debut" name="debut" required>
            </div>
            <div class="form-group">
                <label for="fin">Date de fin :</label>
                <input type="date" class="form-control" id="fin" name="fin" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculer le loyer</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
