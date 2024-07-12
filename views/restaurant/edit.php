<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo isset($restaurant) ? "Modifier" : "Ajouter"; ?> un Restaurant</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <h2><?php echo isset($restaurant) ? "Modifier" : "Ajouter"; ?> un Restaurant</h2>
    <p class="italic">Saisissez les coordonnees</p>
    <form method="post">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" required value="<?php echo isset($restaurant) ? htmlspecialchars($restaurant->coordonnees->nom) : ''; ?>"><br><br>

        <label for="adresse">Adresse :</label><br>
        <input type="text" id="adresse" name="adresse" required value="<?php echo isset($restaurant) ? htmlspecialchars($restaurant->coordonnees->adresse) : ''; ?>"><br><br>

        <label for="restaurateur">Restaurateur :</label><br>
        <input type="text" id="restaurateur" name="restaurateur" required value="<?php echo isset($restaurant) ? htmlspecialchars($restaurant->coordonnees->restaurateur) : ''; ?>"><br><br>

        <button type="submit"><?php echo isset($restaurant) ? "Modifier" : "Ajouter"; ?></button>
    </form>
    <a href="/tp-portail/restaurant">Retour à la liste</a>
</body>

</html>