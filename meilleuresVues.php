<!-- meilleuresVues.php -->

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Meilleures vues</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>Les articles les plus consultés</h1>
        <div class="meilleuresVues">
            <?php
            $meilleuresVues = getMeilleuresVues();
            // Affichage des 5 maillots contabilisant le plus de vues
            foreach ($meilleuresVues as $maillot) {
                echo '<a href="maillot_details.php?id=' . $maillot['id'] . '" class="maillots-link">';
                echo '<div class="best">';
                echo '<a href="maillot_details.php?id=' . $maillot['id'] . '">';
                echo '<img src="' . $maillot['photo'] . '" alt="Image du maillot" class="maillotImageBest">';
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
