<!-- maillot_details.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Maillot</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
include 'functions.php'; // Assurez-vous d'ajuster le chemin si nécessaire

    $maillotId = $_GET['id'];

    // Appeler la fonction pour incrémenter les vues
    incrementerVues($maillotId);

    $maillot = getMaillotById($maillotId);
?>

    <div class="maillot-details">
        <p>Équipe: <?= $maillot['equipe'] ?></p>
        <p>Couleur: <?= $maillot['couleur'] ?></p>
        <p>Prix: <?= $maillot['prix'] ?></p>
        <p>Joueur: <?= $maillot['joueur'] ?></p>
    </div>

</body>
</html>
