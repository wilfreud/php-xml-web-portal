<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Liste des Restaurants</title>
    <link rel="stylesheet" href="/tp-portail/assets/styles.css">
</head>

<body>
    <h1>Liste des Restaurants</h1>
    <ul>
        <?php if (empty($restaurants)) : ?>
            <li>Aucun restaurant trouvé</li>
        <?php endif; ?>

        <?php $count = 0; ?>
        <?php foreach ($restaurants as  $restaurant) : ?>
            <li>
                <a href="/tp-portail/restaurant/details/<?php echo $count; ?>">
                    <?php echo htmlspecialchars($restaurant->coordonnees->nom); ?>
                </a>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) : ?>
                    <form method="POST" action="/tp-portail/restaurant/delete/<?php echo $count; ?>" style="display:inline;">
                        <button type="submit">Supprimer</button>
                    </form>
                <?php endif; ?>

            </li>
            <?php $count++; ?>
        <?php endforeach; ?>
    </ul>
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) : ?>
        <a href="/tp-portail/restaurant/edit">Ajouter un Restaurant</a>
    <?php endif; ?>
</body>

</html>