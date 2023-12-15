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

<?php
include 'functions.php';

$maillotId = $_GET['id'];
incrementerVues($maillotId);
$maillot = getMaillotById($maillotId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si le formulaire a été soumis, mettre à jour l'état "liked" dans la base de données
    updateLikedStatus($maillotId, !$maillot['liked']);
    $maillot = getMaillotById($maillotId); // Mettre à jour la variable $maillot après la mise à jour
}

?>

<div class="maillot-details">
    <img src="<?= $maillot['photo'] ?>" alt="Image du maillot" class="maillot-details-image">
    <div class="maillot-details-info">
        <p>Équipe: <?= $maillot['equipe'] ?></p>
        <p>Couleur: <?= $maillot['couleur'] ?></p>
        <p>Prix: <?= $maillot['prix'] ?></p>
        <p>Joueur: <?= $maillot['joueur'] ?></p>

        <!-- Ajoutez le bouton "Like" -->
        <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $maillotId; ?>" method="post">
            <button type="submit" class="like-button">
                <?= $maillot['liked'] ? 'Unlike' : 'Like'; ?>
            </button>
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
