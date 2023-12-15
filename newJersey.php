<!-- newJersey.php   -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Maillot</title>
</head>
<body>

<?php
// Inclure votre connexion à la base de données ici
// include_once 'connexion.php';

// Vérifier si le formulaire a été soumis
// ...

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $photo = $_POST['photo'];
    $joueur = $_POST['joueur'];
    $equipe = $_POST['equipe'];
    $saison = $_POST['saison'];
    $pays = $_POST['pays'];
    $couleur = $_POST['couleur'];
    $prix = $_POST['prix'];
    $likes = "0";
    $vues = 0;

    include 'functions.php';

    newJersey($photo, $joueur, $equipe, $saison, $pays, $couleur, $prix, $likes, $vues);

    header("Location: affichermaillots.php");
    exit();
}

?>

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

    <!-- Ajoutez d'autres champs en fonction de votre table maillot -->

    <input type="submit" value="Ajouter">
</form>

</body>
</html>
