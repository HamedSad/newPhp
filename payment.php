<?php
session_start();

include 'banner.php';
include_once 'functions.php';

// Vérifiez si le formulaire de paiement a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmPayment'])) {
    // Ici, vous pouvez effectuer des vérifications supplémentaires liées au paiement si nécessaire

    // Vidage du panier
    unset($_SESSION['basket']);

    // Redirection vers la page de confirmation du paiement
    header('Location: confirmationPayment.php');
    exit();
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

        <h2>Etape 3/4 : Procédez au paiement</h2>

        <div class="user-details">
            <div
                class="user-details-info">
                <!-- Form to update user details -->
                <form method="post" action="">
                    <label for="cardNumber">Numero de carte :</label>
                    <input type="text" name="cardNumber" required><br>

                    <label for="expirationDate">Date d'expiration:</label>
                    <input type="text" name="expirationDate"><br>

                    <label for="nameCard">Votre nom:</label>
                    <input type="text" name="nameCard"><br>

                    <label for="cvv">CVV:</label>
                    <input type="text" name="cvv"><br>

                    <input type="submit" name="confirmPayment" value="Confirmer le paiement">
                </form>
            </div>
        </div>
    </body>
</html>

