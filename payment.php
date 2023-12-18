<?php
session_start();

include 'banner.php';
include 'functions.php';

$userName = $_SESSION['userName'];
$user = getUserByName($userName);

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panier</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>Votre paiement</h1>

        <h2>Etape 2/4 : Confirmez votre adresse</h2>

        <div class="user-details">

            <div class="user-details-info">

                <p>Nom:
                    <?= $user['nom'] ?></p>
                <p>Prenom:
                    <?= $user['prenom'] ?></p>
                <p>Adresse:
                    <?= $user['adresse'] ?></p>
                <p>Complement d'adresse:
                    <?= $user['complementAdresse'] ?></p>
                <p>Code postal:
                    <?= $user['codePostal'] ?></p>
                <p>Commune:
                    <?= $user['commune'] ?></p>
                <p>Pays:
                    <?= $user['pays'] ?></p>
            </div>
        </div>

    </body>
</html>

