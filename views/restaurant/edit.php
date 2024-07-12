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
        <textarea id="description_restaurant" name="description_restaurant" required><?php echo isset($restaurant) ? htmlspecialchars($restaurant->description_restaurant) : ''; ?></textarea>

        <h3>Description Detaillée</h3>
        <label for="paragraphe">Paragraphe:</label>
        <textarea id="paragraphe" name="paragraphe" required><?php echo isset($restaurant) ? htmlspecialchars($restaurant->description_restaurant->paragraphe) : ''; ?></textarea>

        <h3>Images</h3>
        <label for="image_url">URL de l'image:</label>
        <input type="text" id="image_url" name="image_url" value="<?php echo isset($restaurant) && isset($restaurant->description_restaurant->paragraphe->image) ? htmlspecialchars($restaurant->description_restaurant->paragraphe->image['url']) : ''; ?>">
        <label for="image_position">Position:</label>
        <select id="image_position" name="image_position">
            <option value="gauche" <?php echo isset($restaurant) && $restaurant->description_restaurant->paragraphe->image['position'] == 'gauche' ? 'selected' : ''; ?>>Gauche</option>
            <option value="droite" <?php echo isset($restaurant) && $restaurant->description_restaurant->paragraphe->image['position'] == 'droite' ? 'selected' : ''; ?>>Droite</option>
        </select>

        <h3>Liste des Attributs</h3>
        <label for="liste_attributs">Attributs (séparés par une virgule):</label>
        <input type="text" id="liste_attributs" name="liste_attributs" value="<?php echo isset($restaurant) ? htmlspecialchars(implode(", ", (array)$restaurant->description_restaurant->liste->item)) : ''; ?>">

        <h3>Carte</h3>
        <h4>Ajouter un Plat</h4>
        <label for="plat_nom">Nom du Plat:</label>
        <input type="text" id="plat_nom" name="plat_nom" required>
        <label for="plat_description">Description du Plat:</label>
        <textarea id="plat_description" name="plat_description" required></textarea>
        <label for="plat_prix">Prix:</label>
        <input type="number" id="plat_prix" name="plat_prix" step="0.01" required>
        <label for="plat_devise">Devise:</label>
        <input type="text" id="plat_devise" name="plat_devise" value="EUR" required>

        <h3>Menus</h3>
        <h4>Ajouter un Menu</h4>
        <label for="menu_titre">Titre du Menu:</label>
        <input type="text" id="menu_titre" name="menu_titre" required>
        <label for="menu_description">Description du Menu:</label>
        <textarea id="menu_description" name="menu_description" required></textarea>
        <label for="menu_prix">Prix:</label>
        <input type="number" id="menu_prix" name="menu_prix" step="0.01" required>
        <label for="menu_devise">Devise:</label>
        <input type="text" id="menu_devise" name="menu_devise" value="EUR" required>

        <button type="submit"><?php echo isset($restaurant) ? 'Modifier' : 'Ajouter'; ?></button>
    </form>
    <a href="/tp-portail/restaurant">Retour à la liste</a>
</body>

</html>