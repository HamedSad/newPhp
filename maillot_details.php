<?php
session_start();
include 'banner.php';
include_once 'functions.php';

$maillotId = $_GET['id'];
incrementerVues($maillotId);
$maillot = getMaillotById($maillotId);

// Vérifier si l'utilisateur est connecté et est un administrateur
if (isset($_SESSION['userName']) && $_SESSION['userName'] == "admin") {
    $isAdmin = true;
} else {
    $isAdmin = false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si le formulaire a été soumis, mettre à jour l'état "liked" dans la base de données
    updateLikedStatus($maillotId, !$maillot['liked']);
    $maillot = getMaillotById($maillotId); // Mettre à jour la variable $maillot après la mise à jour
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Détails du Maillot</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            .like-button {
                cursor: pointer;
                color: <?php echo $maillot['liked'] ? 'blue' : 'black'; ?>;
            }
        </style>
    </head>
    <body>

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

                <!--bouton "Like" -->
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $maillotId; ?>" method="post">
                    <button type="submit" class="like-button">
                        <?= $maillot['liked'] ? 'Unlike' : 'Like'; ?>
                    </button>
                </form>

                <!-- bouton "Update" si l'utilisateur est un administrateur -->
                <?php if ($isAdmin): ?>
                    <a href="updateJersey.php?id=<?= $maillotId ?>" class="update-button">Mettre à jour</a>
                <?php endif; ?>

                <!-- bouton "Delete" si l'utilisateur est un administrateur -->
                <?php if ($isAdmin): ?>
                    <a href="confirmationDelete.php?id=<?= $maillotId ?>" class="update-button">Supprimer</a>
                <?php endif; ?>

                <!-- bouton "Ajouter au panier" -->
                <form action="basket.php" method="post">
                    <input type="hidden" name="maillotId" value="<?= $maillotId ?>">
                    <button type="submit" class="basket-button">Ajouter au panier</button>
                </form>

            </div>
        </div>

        <script>
            // Ajoutez un script pour changer la couleur du bouton "Like" côté client
document.querySelector('.like-button').addEventListener('click', function () {
this.style.color = this.style.color === 'blue' ? 'black' : 'blue';
});
        </script>

    </body>
</html>

