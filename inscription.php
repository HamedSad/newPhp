<!-- inscription.php   --><?php
include 'functions.php';
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $isAdmin = 0;

    // Vérifier s'il existe déjà un utilisateur avec le même nom d'utilisateur
    if (userExistsByUsername($userName)) {
        echo '<script>alert("Un utilisateur avec ce nom d\'utilisateur existe déjà.");</script>';
        echo '<script>window.location.href = "inscription.php";</script>';
        exit();
    }

    // Vérifier s'il existe déjà un utilisateur avec la même adresse e-mail
    if (userExistsByEmail($email)) {
        echo '<script>alert("Un utilisateur avec cette adresse e-mail existe déjà.");</script>';
        echo '<script>window.location.href = "inscription.php";</script>';
        exit();
    }


    // Appeler la fonction pour ajouter le user
    $userId = newUser($userName, $email, $password, $isAdmin);

    // Utilisateur ajouté avec succès
    if ($userId !== false) {
        // MUser ajouté avec succès
        echo '<script>alert("Inscription enregistrée!");</script>';
        echo '<script>window.location.href = "login.php"; 
            </script>';
        exit();
    } else {
        // Erreur lors de l'ajout de l'user
        $_SESSION['error_message'] = "Erreur lors de l'ajout du maillot.";
        header("Location: newJersey.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>

        <h2>Inscription</h2>

        <!-- Formulaire d'inscription -->
        <form action="inscription.php" method="post" onsubmit="return validatePassword()">
            <label for="userName">Nom d'utilisateur :</label>
            <input type="text" id="userName" name="userName" required><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required><br>

            <label for="confirmPassword">Confirmer le mot de passe :</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required><br>

            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required><br>

            <input type="submit" value="S'inscrire">
        </form>

        <script>
            function validatePassword() {
var password = document.getElementById("password").value;
var confirmPassword = document.getElementById("confirmPassword").value;

if (password != confirmPassword) {
alert("Les mots de passe ne correspondent pas.");
return false;
}
return true;
}
        </script>

    </body>
</html>

