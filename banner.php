<!-- banner.php -->

<?php
include_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Banniere header</title>
    </head>
    <body>
        <a href="affichermaillots.php">Tous les maillots</a>
        <a href="newJersey.php">Nouveau maillot</a>

<?php
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['userName'])) {
    // Utilisateur connecté
    echo '<a href="logout.php">Déconnexion</a>';
    echo '<span>Bienvenue, ' . $_SESSION['userName'] . '!</span>';
    echo '<a href="basket.php">Panier (' . getTotalArticlesInBasket() . ')</a>';
} else {
    // Utilisateur non connecté
    echo '<a href="login.php">Connexion</a>';
}
?>
    </body>
</html>

