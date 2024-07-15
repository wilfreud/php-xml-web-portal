<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="/tp-portail/assets/styles.css">
</head>

<body>
    <h1>Connexion</h1>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <hr>
    <form method="POST" action="/tp-portail/login">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
</body>

</html>