<!-- banner.php   -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Maillot</title>
</head>
<body>
    <a href="affichermaillots.php">Tous les maillots</a>
    <a href="newJersey.php">Nouveau maillot</a>
    <a href="login.php">Connexion</a>
    <a href="logout.php">Déconnexion</a>

    <?php
    session_start();
    
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['userName'])) {
        echo '<span>Bienvenue, ' . $_SESSION['userName'] . '!</span>';
    } 
    ?>
    
</body>
</html>
