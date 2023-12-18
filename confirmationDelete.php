<?php
include_once 'functions.php';
include 'banner.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    // Si la confirmation est reçue, supprimer le maillot
    $maillotId = $_POST['maillot_id'];
    deleteMaillot($maillotId);

    echo '<script>alert("Maillot supprimé!");</script>';
    echo '<script>window.location.href = "affichermaillots.php"; 
        </script>';
    exit();

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Si la requête est GET et l'ID est défini, récupérer les détails du maillot
    $maillotId = $_GET['id'];
    $maillot = getMaillotById($maillotId);

    // Vérifier si les détails du maillot ont été récupérés avec succès
    if (!$maillot) {
        echo "Erreur lors de la récupération des détails du maillot.";
        exit();
    }
} else {
    // Si l'ID n'est pas défini, rediriger vers une page appropriée
    header("Location: affichermaillots.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmation de Suppression</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="modal.css">
    </head>
    <body>

        <div class="confirmation-container">
            <h2>Confirmation de Suppression</h2>
            <p>Voulez-vous vraiment supprimer ce maillot bitch?</p>
            <form method="post" action="">
                <input type="hidden" name="maillot_id" value="<?= $maillotId ?>">
                <button type="submit" name="confirm_delete">Confirmer la Suppression</button>
                <a href="maillot_details.php?id=<?= $maillotId ?>">Annuler</a>
            </form>
            <div class="maillot-details">
                <img src="<?= $maillot['photo'] ?>" alt="Image du maillot" class="maillot-details-image">
                <div class="maillot-details-info">
                    <p>Équipe:
                        <?= $maillot['equipe'] ?></p>
                    <p>Couleur:
                        <?= $maillot['couleur'] ?></p>
                    <p>Prix:
                        <?= $maillot['prix'] ?></p>
                    <p>Joueur:
                        <?= $maillot['joueur'] ?></p>
                </div>
            </div>
        </div>

    </body>
</html>

