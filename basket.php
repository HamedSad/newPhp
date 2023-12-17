<?php
session_start();

include 'banner.php';
include 'functions.php';

// Supprimer un maillot du panier
if (isset($_GET['deleteFromBasket'])) {
    $jerseyId = $_GET['deleteFromBasket'];
    if (isset($_SESSION['basket'][$jerseyId])) {
        unset($_SESSION['basket'][$jerseyId]);
        // Ajoutez le script JavaScript pour recharger la page
        echo "<script>window.location.reload();</script>";
    }
}

// Ajouter un maillot au panier
if (isset($_POST['maillotId'])) {
    $jerseyId = $_POST['maillotId'];

    // Vérifier si le maillot est déjà dans le panier
    if (!isset($_SESSION['basket'][$jerseyId])) {
        $_SESSION['basket'][$jerseyId] = true;
        // Stocker un message de succès dans une variable de session
        $_SESSION['success_message'] = "L'article a bien été sélectionné.";
    } else {
        // Stocker le message dans une variable de session
        $_SESSION['message'] = "L'article a déjà été sélectionné.";
    }
}
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
        <h1>Votre Panier</h1>

    <?php
    // Vérifier si le panier est vide
    if (empty($_SESSION['basket'])) {
        echo "<p>Votre panier est vide.</p>";
        echo $_SESSION['basket'];
    } else {
        // Afficher les détails des maillots dans le panier
        foreach ($_SESSION['basket'] as $jerseyId => $value) {
            $maillot = getMaillotById($jerseyId);

            if ($maillot) {
                // Afficher les détails du maillot
                echo "<div class='maillot-details'>";
                echo "<p>Équipe: {$maillot['equipe']}</p>";
                echo "<p>Joueur: {$maillot['joueur']}</p>";
                echo "<p>Prix: {$maillot['prix']}</p>";
                echo "<p>Couleur: {$maillot['couleur']}</p>";
                echo "<p>Id: {$maillot['id']}</p>";

                // Ajoutez un lien pour supprimer le maillot du panier avec confirmation
                echo "<a href='basket.php?deleteFromBasket={$jerseyId}' onclick='return confirmRetirer()'>Retirer du panier</a>";
                echo "</div>";
            }
        }
    }
    ?>

        <!-- Fonction de confirmation pour le retrait -->
        <script>
            function confirmRetirer() {
return confirm("Êtes-vous sûr de vouloir retirer cet article du panier?");
}
        </script>
    </body>
</html>

