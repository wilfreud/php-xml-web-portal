<!-- views/restaurant/edit.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo isset($restaurant) ? 'Modifier' : 'Ajouter'; ?> un Restaurant</title>
    <link rel="stylesheet" href="/tp-portail/assets/styles.css">
</head>

<body>
    <h1><?php echo isset($restaurant) ? 'Modifier' : 'Ajouter'; ?> un Restaurant</h1>
    <form method="POST" action="">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo isset($restaurant) ? htmlspecialchars($restaurant->coordonnees->nom) : ''; ?>" required>

        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" name="adresse" value="<?php echo isset($restaurant) ? htmlspecialchars($restaurant->coordonnees->adresse) : ''; ?>" required>

        <label for="restaurateur">Restaurateur:</label>
        <input type="text" id="restaurateur" name="restaurateur" value="<?php echo isset($restaurant) ? htmlspecialchars($restaurant->coordonnees->restaurateur) : ''; ?>" required>

        <label for="description_restaurant">Description:</label>
        <textarea id="description_restaurant" name="description_restaurant"><?php echo isset($restaurant) ? htmlspecialchars($restaurant->description_restaurant) : ''; ?></textarea>

        <!-- Ajoutez ici d'autres champs pour la carte, les menus, etc. selon vos besoins -->

        <button type="submit"><?php echo isset($restaurant) ? 'Modifier' : 'Ajouter'; ?></button>
    </form>
    <a href="/tp-portail/restaurant">Retour à la liste</a>
</body>

</html>