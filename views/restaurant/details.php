<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Détails du Restaurant</title>
    <link rel="stylesheet" href="/tp-portail/assets/styles.css">
</head>

<body>
    <h1>Détails du Restaurant</h1>
    <h2><?php echo htmlspecialchars($restaurant->coordonnees->nom); ?></h2>
    <p><strong>Adresse:</strong> <?php echo htmlspecialchars($restaurant->coordonnees->adresse); ?></p>
    <p><strong>Restaurateur:</strong> <?php echo htmlspecialchars($restaurant->coordonnees->restaurateur); ?></p>
    <h3>Description</h3>
    <p><?php echo htmlspecialchars($restaurant->description_restaurant); ?></p>
    <h3>Carte</h3>
    <ul>
        <?php if (isset($restaurant->carte->plat)) : ?>
            <?php foreach ($restaurant->carte->plat as $plat) : ?>
                <li>
                    <strong><?php echo htmlspecialchars($plat->nom); ?></strong> - <?php echo htmlspecialchars($plat->prix); ?> <?php echo htmlspecialchars($plat->prix['devise']); ?>
                    <p><?php echo htmlspecialchars($plat->description_plat); ?></p>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <h3>Menus</h3>
    <ul>
        <?php if (isset($restaurant->menus->menu)) : ?>
            <?php foreach ($restaurant->menus->menu as $menu) : ?>
                <li>
                    <strong><?php echo htmlspecialchars($menu->titre); ?></strong> - <?php echo htmlspecialchars($menu->prix); ?> <?php echo htmlspecialchars($menu->prix['devise']); ?>
                    <p><?php echo htmlspecialchars($menu->description_menu); ?></p>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <a href="/tp-portail/restaurant">Retour à la liste des restaurants</a>
</body>

</html>