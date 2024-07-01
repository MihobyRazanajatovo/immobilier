<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login_page.css'); ?>">
</head>
<body>
    <?php echo validation_errors(); ?>
    <div class="container">
        <div class="form-container">
            <img src="<?php echo base_url('assets/images/fond-clair.png'); ?>" alt="Exchange Objects Logo" class="logo">
            <h2>Get Started</h2>
            <form method="POST" action="<?php echo base_url('register/submit'); ?>">
                <input type="text" id="nom" name="nom" value="<?php echo set_value('nom'); ?>" placeholder="Nom" required>
                <input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email" required>
                <input type="text" id="tel" name="tel" value="<?php echo set_value('tel'); ?>" placeholder="Téléphone" required>
                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
                <button type="submit" class="signup-btn">Sign up</button>
            </form>
            <p>Already have an account? <a href="<?php echo base_url('login'); ?>">Sign in</a></p>
        </div>
        <div class="image-container">
            <img src="<?php echo base_url('assets/images/22.jpg'); ?>" alt="Dog with sunglasses" class="dog-image">
        </div>
    </div>
</body>
</html>
