<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login_page.css'); ?>">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <img src="<?php echo base_url('assets/images/fond-clair.png'); ?>" alt="Exchange Objects Logo" class="logo">
            <h2>Get Started</h2>
            <form method="POST" action="<?php echo base_url('login/login_admin'); ?>">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="password" name="mdp" id="mdp" placeholder="Password" required>
                <button type="submit" class="signup-btn">Sign in</button>
            </form>
            <p>Se connecter en tant que <a href="<?php echo base_url('login/login_proprio_view'); ?>">Propriétaire?</a> ou en tant que <a href="<?php echo base_url('login/login_client_view'); ?>">Client?</a></p>
        </div>
        <div class="image-container">
            <img src="<?php echo base_url('assets/images/22.jpg'); ?>" alt="trano" class="dog-image">
        </div>
        <?php if ($this->session->flashdata('error')) : ?>
            <p><?php echo $this->session->flashdata('error'); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>