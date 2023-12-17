<!-- banner.php   -->

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
        <a href="login.php">Connexion</a>
        <a href="logout.php">Déconnexion</a>
        <a href="basket.php">Panier</a>

        <?php

        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['userName'])) {
            echo '<span>Bienvenue, ' . $_SESSION['userName'] . '!</span>';
        }

        ?>

    </body>
</html>

