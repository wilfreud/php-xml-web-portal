<?php
// session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des films | XML</title>
    <link rel="stylesheet" href="index.css">

    <style>
        .warning-message {
            color: orange;
            font-style: italic;
        }

        .bold {
            font-weight: bold;
        }

        .italic {
            font-style: italic;
        }
    </style>
</head>

<body>
    <h1>Films</h1>
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) : ?>
        <form method="get" action="/tp-portail/cinema/edit">
            <button type="submit">Ajouter</button>
        </form>
    <?php endif; ?>
    <hr />
    <div>
        <?php
        $count = 0;
        foreach ($movies as $movie) {
            echo "<div> <span class='bold'>Titre: </span>" . $movie->titre . "</div>";
            echo "<div> <span class='bold'>Realisateur: </span>" . $movie->realisateur . "</div>";
            echo "<div> <span class='bold'>Annee de Production: </span>" . $movie->anneeProduction . "</div>";
            echo "<div> <span class='bold'>Genre: </span>" . $movie->genre . "</div>";
            echo "<div> <span class='bold'>Duree: </span>" . $movie->duree . "</div>";
            echo "<div> <span class='bold'>Langue: </span>" . $movie->langue . "</div>";
            echo "<div> <span class='bold'>Presse: </span>" . $movie->presse . "</div>";
            echo "<div> <span class='bold'>Spectateur: </span>" . $movie->spectateur . "</div>";
            echo "<div> <span class='bold'>Acteurs: </span> <ul>";
            foreach ($movie->acteurs->acteur as $acteur) {
                echo "<li>" . $acteur . "</li>";
            }
            echo "</ul> </div>";
            echo "<div> 
        <p> <span class='bold'>Intrigue</span>: " . $movie->description->paragraphe->intrigue . "</p>";
            echo "<div>";
            echo "<p class='bold italic'> Horaires </p>";
            echo "<ul>";
            foreach ($movie->description->paragraphe->horaires->horaire as $horaire) {
                echo "<li>" . $horaire->jour . ": " . $horaire->heure . "</li>";
            }
            echo "</ul>";

            echo "<div>";
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                echo "<form method='get' action='/tp-portail/cinema/$count'>" .
                    "<button type='submit'>Editer</button>
                </form>";

                echo "<form method='post' action='/tp-portail/cinema/delete/$count'>" .
                    "<button type='submit'>Supprimer</button>
                         </form>";
            }

            echo "</div>";


            echo "</div>";
            echo "<hr />";
            $count++;
        }
        ?>
    </div>
</body>

</html>