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
    <?php
    include 'functions.php'; 
    $allMaillots = getAllMaillots();
    
    // Affichage de tous les maillots
    foreach ($allMaillots as $maillot) {
        echo '<a href="maillot_details.php?id=' . $maillot['id'] . '" class="maillots-link">'; // Ajout du lien autour de la div
        echo '<div class="maillots">';
        echo '<p>Équipe: ' . $maillot['equipe'] . '</p>';
        echo '<p>Couleur: ' . $maillot['couleur'] . '</p>';
        echo '<p>Prix: ' . $maillot['prix'] . '</p>';
        echo '<p>Date: ' . $maillot['date'] . '</p>';
        echo '</div>';
        echo '</a>'; // Fermeture du lien
    }
    ?>
    <p>Les articles les plus consultés</p>
    <?php
    $meilleuresVues = getMeilleuresVues();
    // Affichage de tous les maillots en fonction des vues
    foreach ($meilleuresVues as $maillot) {
        echo '<div class="best">';
        echo '<p>Équipe: ' . $maillot['equipe'] . '</p>';
        echo '<p>Couleur: ' . $maillot['couleur'] . '</p>';
        echo '<p>Prix: ' . $maillot['prix'] . '</p>';
        echo '<p>Date: ' . $maillot['date'] . '</p>';
        echo '</div>';
    }
    ?>
</body>
</html>