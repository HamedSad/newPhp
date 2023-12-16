<!-- newJersey.php   --><?php
session_start();
include 'functions.php';
include 'banner.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $photo = $_POST['photo'];
    $joueur = $_POST['joueur'];
    $equipe = $_POST['equipe'];
    $saison = $_POST['saison'];
    $pays = $_POST['pays'];
    $couleur = $_POST['couleur'];
    $prix = $_POST['prix'];
    $liked = "0";
    $vues = 0;
    // Appeler la fonction pour ajouter le maillot
    $jersey_id = newJersey($photo, $joueur, $equipe, $saison, $pays, $couleur, $prix, $liked, $vues);

    if ($jersey_id !== false) {
        // Maillot ajouté avec succès
        echo '<script>alert("Maillot ajouté!");</script>';
        echo '<script>window.location.href = "affichermaillots.php"; 
            </script>';
        exit();
    } else {
        // Erreur lors de l'ajout du maillot
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
        <title>Ajouter un Maillot</title>
    </head>
    <body>

        <h2>Ajouter un Maillot</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="photo">Photo:</label>
            <input type="text" name="photo"><br>
            <label for="joueur">Nom du Joueur:</label>
            <input type="text" name="joueur" required><br>
            <label for="equipe">Equipe:</label>
            <input type="text" name="equipe" required><br>
            <label for="saison">Saison:</label>
            <input type="text" name="saison" required><br>
            <label for="pays">Pays:</label>
            <input type="text" name="pays" required><br>
            <label for="couleur">Couleur:</label>
            <input type="text" name="couleur" required><br>
            <label for="prix">Prix:</label>
            <input type="text" name="prix" required><br>
            <input type="submit" value="Ajouter">
        </form>

    </body>
</html>

