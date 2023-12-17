<?php
// Démarrez la session PHP
session_start();
include 'banner.php';

// Vérifiez si la session contient des articles
if (empty($_SESSION['panier'])) {
    $_SESSION['panier'] = array(); // Initialisez le panier s'il est vide
}

// Ajoutez un article au panier s'il est sélectionné
if (isset($_GET['ajouter'])) {
    $article_id = $_GET['ajouter'];
    if (!in_array($article_id, $_SESSION['panier'])) {
        $_SESSION['panier'][] = $article_id;
    }
}

// Supprimez un article du panier s'il est retiré
if (isset($_GET['retirer'])) {
    $article_id = $_GET['retirer'];
    $index = array_search($article_id, $_SESSION['panier']);
    if ($index !== false) {
        unset($_SESSION['panier'][$index]);
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

        <h1>Votre Panier</h1>

<?php
// Affichez les articles du panier
if (!empty($_SESSION['panier'])) {
    echo "<ul>";
    foreach ($_SESSION['panier'] as $article_id) {
        // Affichez les détails de l'article à partir de votre base de données
        echo "<li>Article $article_id - <a href='basket.php?retirer=$article_id'>Retirer</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>Votre panier est vide.</p>";
}
?>

    </body>
</html>

