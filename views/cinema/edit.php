<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Informations du film</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

    <!-- Form submission -->
    <?php
    if (isset($_SERVER['REQUEST_METHOD']) === 'POST') {
        // $moviePostData = [
        //     'titre' => $_POST['titre'],
        //     'duree' => $_POST['duree'],
        //     'genre' => $_POST['genre'],
        //     'realisateur' => $_POST['realisateur'],
        //     'acteurs' => $_POST['acteurs'],
        //     'anneeProduction' => $_POST['anneeProduction'],
        //     'langue' => $_POST['langue'],
        //     'presse' => isset($_POST['presse']) ? $_POST['presse'] : '',
        //     'spectateur' => isset($_POST['spectateur']) ? $_POST['spectateur'] : '',
        //     'description' => $_POST['description'],
        //     'intrigue' => $_POST['intrigue'],
        //     'horaires' => $_POST['horaires']
        // ];
    }
    ?>

    <!-- Load data -->
    <?php
    $movieData = new stdClass();
    $movieData->titre = '';
    $movieData->duree = '';
    $movieData->genre = '';
    $movieData->realisateur = '';
    $movieData->acteurs = '';
    $movieData->anneeProduction = '';
    $movieData->langue = '';
    $movieData->presse = '';
    $movieData->spectateur = '';
    $movieData->intrigue = '';
    $movieData->horaires = '';
    if (isset($film)) {
        $movieData->titre = $film->titre;
        $movieData->duree = $film->duree;
        $movieData->genre = $film->genre;
        $movieData->realisateur = $film->realisateur;
        $movieData->acteurs = $film->acteurs;
        $movieData->anneeProduction = $film->anneeProduction;
        $movieData->langue = $film->langue;
        $movieData->presse = $film->presse;
        $movieData->spectateur = $film->spectateur;
        $movieData->intrigue = $film->description->paragraphe->intrigue;
        $movieData->horaires = $film->horaires;
    }
    ?>

    <h2>
        <?php if (isset($film)) {
            echo "Modidifer";
        } else {
            echo "Ajouter";
        }
        ?> un Film</h2>
    <form method="post">
        <label for="titre">Titre :</label><br>
        <input type="text" id="titre" name="titre" required value="<?php echo $movieData->titre ?>"><br><br>

        <label for="duree">Durée :</label><br>
        <input type="text" id="duree" name="duree" required value="<?php echo $movieData->duree ?>"><br><br>

        <label for="genre">Genre :</label><br>
        <input type="text" id="genre" name="genre" required value="<?php echo $movieData->genre ?>"><br><br>

        <label for="realisateur">Réalisateur :</label><br>
        <input type="text" id="realisateur" name="realisateur" required value="<?php echo $movieData->realisateur ?>"><br><br>

        <label for="acteurs">Acteurs :</label><br>
        <textarea id="acteurs" name="acteurs" rows="3" required><?php echo $movieData->acteurs ?></textarea><br><br>

        <label for="anneeProduction">Année de Production :</label><br>
        <input type="text" id="anneeProduction" name="anneeProduction" required value="<?php echo $movieData->anneeProduction ?>"><br><br>

        <label for="langue">Langue :</label><br>
        <input type="text" id="langue" name="langue" required value="<?php echo $movieData->langue ?>"><br><br>

        <label for="presse">Presse :</label><br>
        <input type="text" id="presse" name="presse" value="<?php echo $movieData->presse ?>"><br><br>

        <label for="spectateur">Spectateur :</label><br>
        <input type="text" id="spectateur" name="spectateur" value="<?php echo $movieData->spectateur ?>"><br><br>

        <label for="intrigue">Intrigue :</label><br>
        <textarea id="intrigue" name="intrigue" rows="3" required><?php echo $movieData->intrigue ?></textarea><br><br>

        <label for="horaires">Horaires :</label><br>
        <textarea id="horaires" name="horaires" rows="3" required><?php echo $movieData->horaires ?></textarea><br><br>

        <button type="submit">
            <?php if (isset($film)) {
                echo "Modidifer";
            } else {
                echo "Ajouter";
            } ?>
        </button>
    </form>

    <?php
    // Afficher les erreurs de validation
    if (isset($_GET['error'])) {
        echo '<div class="error">Veuillez remplir tous les champs correctement.</div>';
    }
    ?>

</body>

</html>