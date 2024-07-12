<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Informations du film</title>
    <style>
        .error {
            color: red;
        }

        .warning-message {
            color: orange;
        }
    </style>
</head>

<?php
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    ViewRenderer::render('errors/401');
}
?>

<body>
    <h2><?php echo isset($film) ? "Modifier" : "Ajouter"; ?> un Film</h2>
    <form method="post">
        <label for="titre">Titre :</label><br>
        <input type="text" id="titre" name="titre" required value="<?php echo isset($film) ? htmlspecialchars($film->titre) : ''; ?>"><br><br>

        <label for="duree">Durée :</label><br>
        <input type="text" id="duree" name="duree" required value="<?php echo isset($film) ? htmlspecialchars($film->duree) : ''; ?>"><br><br>

        <label for="genre">Genre :</label><br>
        <input type="text" id="genre" name="genre" required value="<?php echo isset($film) ? htmlspecialchars($film->genre) : ''; ?>"><br><br>

        <label for="realisateur">Réalisateur :</label><br>
        <input type="text" id="realisateur" name="realisateur" required value="<?php echo isset($film) ? htmlspecialchars($film->realisateur) : ''; ?>"><br><br>

        <label for="acteurs">Acteurs :</label><br>
        <textarea id="acteurs" name="acteurs" rows="3" required><?php echo isset($film) ? htmlspecialchars(implode(", ", (array)$film->acteurs->acteur)) : ''; ?></textarea><br><br>

        <label for="anneeProduction">Année de Production :</label><br>
        <input type="text" id="anneeProduction" name="anneeProduction" required value="<?php echo isset($film) ? htmlspecialchars($film->anneeProduction) : ''; ?>"><br><br>

        <label for="langue">Langue :</label><br>
        <input type="text" id="langue" name="langue" required value="<?php echo isset($film) ? htmlspecialchars($film->langue) : ''; ?>"><br><br>

        <label for="presse">Presse :</label><br>
        <input type="text" id="presse" name="presse" value="<?php echo isset($film) ? htmlspecialchars($film->presse) : ''; ?>"><br><br>

        <label for="spectateur">Spectateur :</label><br>
        <input type="text" id="spectateur" name="spectateur" value="<?php echo isset($film) ? htmlspecialchars($film->spectateur) : ''; ?>"><br><br>

        <label for="intrigue">Intrigue :</label><br>
        <textarea id="intrigue" name="intrigue" rows="3" required><?php echo isset($film) ? htmlspecialchars($film->description->paragraphe->intrigue) : ''; ?></textarea><br><br>

        <label for="horaires">Horaires :</label><br>
        <textarea id="horaires" name="horaires" rows="6" required><?php
                                                                    if (isset($film)) {
                                                                        foreach ($film->description->paragraphe->horaires->horaire as $horaire) {
                                                                            echo htmlspecialchars($horaire->jour) . "---" . htmlspecialchars($horaire->heure) . "\n";
                                                                        }
                                                                    }
                                                                    ?></textarea><br><br>

        <button type="submit"><?php echo isset($film) ? "Modifier" : "Ajouter"; ?></button>
    </form>
</body>

</html>