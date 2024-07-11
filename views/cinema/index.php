<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des films | XML</title>

</head>

<body>
    <h1>Films</h1>
    <hr />
    <?php

    echo "<div>";
    foreach ($movies as $movie) {
        echo "<div> <span class='bold'>Titre: </span>" . $movie->titre . "</div>";
        echo "<div> <span class'bold'>Realisateur: </span>" . $movie->realisateur . "</div>";
        echo "<div> <span class'bold'>Annee de Production: </span>" . $movie->anneeProduction . "</div>";
        echo "<div> <span class'bold'>Genre: </span>" . $movie->genre . "</div>";
        echo "<div> <span class'bold'>Duree: </span>" . $movie->duree . "</div>";
        echo "<div> <span class'bold'>Langue: </span>" . $movie->langue . "</div>";
        echo "<div> <span class'bold'>Presse: </span>" . $movie->presse . "</div>";
        echo "<div> <span class'bold'>Spectateur: </span>" . $movie->spectateur . "</div>";
        echo "<div> <span class'bold'>Acteurs: </span> <ul>";
        foreach ($movie->acteurs as $acteur) {
            echo "<li>" . $acteur . "</li>";
        }
        echo "</ul> </div>";
        echo "<div> 
        <h4 class'bold'>Intrigue: </h4>";
        echo "<p>" . $movie->description->paragraphe->intrigue . "</p>";
        echo "<p class='bold italic'> Horaires </p>";
        echo "<ul>";
        foreach ($movie->description->paragraphe->horaires as $horaire) {
            echo "<li> <span class='bold'>Jours: </span>" . $horaire->jour . "</li>";
            echo "<li> <span class='bold'>Heures: </span>" . $horaire->heure . "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
    echo "</div>";
    ?>
</body>

</html>