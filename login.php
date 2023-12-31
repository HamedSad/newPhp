<?php
session_start();
include 'functions.php';

// Vérifier si l'utilisateur est déjà connecté
if (isLoggedIn()) {
    header("Location: affichermaillots.php");
    exit();
}

// Si le formulaire de connexion est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredUsername = $_POST['userName'];
    $enteredPassword = $_POST['password'];

    // Authentifier l'utilisateur
    $user = authenticateUser($enteredUsername, $enteredPassword);

    if ($user) {
        // Authentification réussie, stocker l'ID de l'utilisateur dans la session
        $_SESSION['userId'] = $user['id'];

        // Rediriger vers la page d'affichage des maillots
        header("Location: affichermaillots.php");
        exit();
    } else {
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!-- Reste du code HTML pour la page de connexion -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="login-container">
            <h2>Connexion</h2>

            <h2>Pas encore inscrit?</h2>
            <a href="inscription.php">Clique ici</a>

            <?php if (isset($error_message)): ?>
                <p class="error-message"><?= $error_message ?></p>
            <?php endif; ?>

            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <label for="userName">Nom d'utilisateur:</label>
                <input type="text" id="userName" name="userName" required>

                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Se connecter</button>
            </form>
        </div>
    </body>
</html>

