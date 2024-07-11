<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Film</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SERVER['REQUEST_METHOD']) === 'POST') {
        // $movieData = [
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

        print_r($_POST);
        exit();
    }
    ?>

    <h2>Ajouter un Film</h2>
    <form method="post">
        <label for="titre">Titre :</label><br>
        <input type="text" id="titre" name="titre" required><br><br>

        <label for="duree">Durée :</label><br>
        <input type="text" id="duree" name="duree" required><br><br>

        <label for="genre">Genre :</label><br>
        <input type="text" id="genre" name="genre" required><br><br>

        <label for="realisateur">Réalisateur :</label><br>
        <input type="text" id="realisateur" name="realisateur" required><br><br>

        <label for="acteurs">Acteurs :</label><br>
        <textarea id="acteurs" name="acteurs" rows="3" required></textarea><br><br>

        <label for="anneeProduction">Année de Production :</label><br>
        <input type="text" id="anneeProduction" name="anneeProduction" required><br><br>

        <label for="langue">Langue :</label><br>
        <input type="text" id="langue" name="langue" required><br><br>

        <label for="presse">Presse :</label><br>
        <input type="text" id="presse" name="presse"><br><br>

        <label for="spectateur">Spectateur :</label><br>
        <input type="text" id="spectateur" name="spectateur"><br><br>

        <label for="description">Description :</label><br>
        <textarea id="description" name="description" rows="5" required></textarea><br><br>

        <label for="intrigue">Intrigue :</label><br>
        <textarea id="intrigue" name="intrigue" rows="3" required></textarea><br><br>

        <label for="horaires">Horaires :</label><br>
        <textarea id="horaires" name="horaires" rows="3" required></textarea><br><br>

        <button type="submit">Ajouter le Film</button>
    </form>

    <?php
    // Afficher les erreurs de validation
    if (isset($_GET['error'])) {
        echo '<div class="error">Veuillez remplir tous les champs correctement.</div>';
    }
    ?>

</body>

</html>