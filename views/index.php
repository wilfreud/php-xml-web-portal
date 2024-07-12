<?php
// index.php
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            display: inline-block;
            margin: 10px;
            padding: 15px 25px;
            font-size: 18px;
            color: #fff;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }

    ?>

    <div class="container">
        <h1>Bienvenue sur le Portail</h1>
        <a href="/tp-portail/cinema">Cinemas</a>
        <a href="/tp-portail/restaurant">Restaurants</a>
    </div>

</body>

</html>