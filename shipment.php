<?php
session_start();

include 'banner.php';
include_once 'functions.php';

$userName = $_SESSION['userName'];
$user = getUserByName($userName);

// Initialize variable for feedback
$updateFeedbackClass = '';

// Check if the form has been submitted to update user details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $new_nom = $_POST['nom'];
    $new_prenom = $_POST['prenom'];
    $new_adresse = $_POST['adresse'];
    $new_complementAdresse = $_POST['complementAdresse'];
    $new_codePostal = $_POST['codePostal'];
    $new_commune = $_POST['commune'];
    $new_pays = $_POST['pays'];

    // Update user details in the database using the function
    $update_result = updateUserInfo($userName, $new_nom, $new_prenom, $new_adresse, $new_complementAdresse, $new_codePostal, $new_commune, $new_pays);

    if ($update_result) {
        // User details have been updated successfully
        $updateFeedbackClass = 'update-success';
        echo '<script>alert("Adresse enregistrée!");</script>';
        // Redirect to the same page or another page as needed
        echo '<script>window.location.href = "payment.php";</script>';
    } else {
        echo "Erreur lors de la mise à jour des détails de l'utilisateur.";
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
        <h1>Votre paiement</h1>

        <h2>Etape 2/4 : Confirmez votre adresse</h2>

        <div class="user-details">

            <div
                class="user-details-info">
                <!-- Add a form to update user details -->
                <form method="post" action="">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" value="<?= $user['nom']; ?>" required><br>

                    <label for="prenom">Prenom :</label>
                    <input type="text" name="prenom" value="<?= $user['prenom']; ?>" required><br>

                    <label for="adresse">Adresse :</label>
                    <input type="text" name="adresse" value="<?= $user['adresse']; ?>" required><br>

                    <label for="complementAdresse">Complement d'adresse :</label>
                    <input type="text" name="complementAdresse" value="<?= $user['complementAdresse']; ?>"><br>

                    <label for="codePostal">Code postal :</label>
                    <input type="text" name="codePostal" value="<?= $user['codePostal']; ?>" required><br>

                    <label for="commune">Commune :</label>
                    <input type="text" name="commune" value="<?= $user['commune']; ?>" required><br>

                    <label for="pays">Pays :</label>
                    <input type="text" name="pays" value="<?= $user['pays']; ?>" required><br>

                    <input type="submit" value="Valider l'adresse">
                </form>
            </div>
        </div>
    </body>
</html>

