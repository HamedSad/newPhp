<!-- affichermaillots.php -->

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste des maillots</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="wrapper">
            <?php
            session_start();
            include 'banner.php';
            include 'functions.php';
            include 'meilleuresVues.php';

            $allMaillots = getAllMaillots();

            echo '<h1>Tous nos maillots</h1>';
            // Affichage de tous les maillots
            foreach ($allMaillots as $maillot) {
                echo '<a href="maillot_details.php?id=' . $maillot['id'] . '" class="maillots-link">';
                echo '<div class="maillots">';
                // Ajout de l'image cliquable
                echo '<a href="maillot_details.php?id=' . $maillot['id'] . '">';
                echo '<img src="' . $maillot['photo'] . '" alt="Image du maillot" class="maillotImage">';
                echo '</a>';
                echo '<p>' . $maillot['joueur'] . '</p>';
                echo '<p>' . $maillot['equipe'] . '</p>';
                echo '<p>' . $maillot['saison'] . '</p>';
                echo '<p>' . $maillot['prix'] . '€</p>';
                echo '</div>';
                echo '</a>';
            }
            ?>
        </div>

    </body>
</html>

