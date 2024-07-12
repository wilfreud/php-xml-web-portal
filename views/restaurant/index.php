<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant XML</title>
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

        .text-center {
            text-align: center;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .capitalize {
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <?php
    $coordonne  = $ficheRestaurant->coordonne;
    $menus = $ficheRestaurant->menus;
    $carte = $ficheRestaurant->carte;
    ?>

    <div>
        <h1 class="text-center"><?php echo $coordonne->nom ?></h1>
        <p class="text-center"> <?php echo $coordonne->descriptionCoordonne->listes ?> </p>
        <p class="italic text-center">
            <?php echo $coordonne->adresse . " - " . $coordonne->nomRestaurateur ?>
        </p>
    </div>
    <hr>

    <!-- Liste des elements a la carte -->
    <div>
        <h2 class="text-center">A la carte</h2>
        <div>
            <?php
            foreach ($carte->plat as $index => $plat) {
                echo "<div class='plat-tem'>";
                echo "<p class='bold uppercase'>" . $plat->indication . "</p>";
                echo "<p> <span class='bold'>Prix: </span>" . $plat->prix . " €</p>";
                echo "<p> <span class='bold'>Description: </span>" . $plat->descriptionP->paragraphe . "</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <hr>

    <!-- Liste des menus -->
    <div>
        <h2 class="text-center">Menus</h2>
        <div>
            <?php
            foreach ($menus->menu as $index => $menu) {
                echo "<div class='menu-item'>";
                echo "<p class='bold capitalize'>" . $menu->titre . "</p>";
                echo "<p> <span class='bold'>Description: </span>" . $menu->descriptionM . "</p>";
                echo "<p> <span class='bold'>Prix: </span>" . $menu->prixM . " €</p>";
                echo "<div>";
                echo "<p> <span class='bold'>Plats: </span> <ul>";
                foreach ($menu->plat as $plat) {
                    echo "<li>" . $plat->indication . "</li>";
                    echo "<ul>";
                    echo "<li> <span class='bold'>Prix: </span>" . $plat->prix . " €</li>";
                    echo "<li> <span class='bold'>Description: </span>" . $plat->descriptionP->paragraphe . "</li>";
                    echo "</ul>";
                }
                echo "</ul> </p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
</body>

</html>