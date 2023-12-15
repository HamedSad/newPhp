<?php
// Inclure le fichier de fonctions
include 'functions.php';

// Vérifier si l'ID du maillot est passé en paramètre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $jersey_id = $_GET['id'];

    // Récupérer les informations actuelles du maillot depuis la base de données
    $query = "SELECT * FROM maillot WHERE id = $jersey_id";
    $result = connectDatabase()->query($query);

    if ($result) {
        $jersey = $result->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Erreur lors de la récupération des données du maillot.";
        exit();
    }

    // Initialiser une variable pour le feedback visuel
    $updateFeedbackClass = '';

    // Vérifier si le formulaire a été soumis pour mettre à jour le maillot
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $new_photo = $_POST['photo'];
        $new_equipe = $_POST['equipe'];
        $new_joueur = $_POST['joueur'];
        $new_saison = $_POST['saison'];
        $new_pays = $_POST['pays'];
        $new_couleur = $_POST['couleur'];
        $new_prix = $_POST['prix'];
        $new_liked = $_POST['liked'];
        $new_vues = $_POST['vues'];

        // Mettre à jour les informations du maillot dans la base de données
        $update_query = "UPDATE maillot SET photo = '$new_photo', equipe = '$new_equipe', joueur = '$new_joueur', saison = '$new_saison', pays = '$new_pays', couleur = '$new_couleur', prix = '$new_prix', liked = '$new_liked', vues = '$new_vues' WHERE id = $jersey_id";
        $update_result = connectDatabase()->exec($update_query);

        if ($update_result) {
           // Le maillot a été mis à jour avec succès
           $updateFeedbackClass = 'update-success';
           echo '<script>alert("Mise à jour réussie!");</script>';
           echo '<script>
            window.location.href = "maillot_details.php?id=' . $jersey_id . '";
           </script>';
       } else {
           echo "Erreur lors de la mise à jour du maillot.";
        }
    }
    } else {
    echo "ID du maillot non valide.";
    exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Maillot</title>
</head>
<body>
    <h2>Modifier le Maillot</h2>



    <form method="post" action="">

    <!-- Afficher le feedback avec la classe appropriée -->
    <div class="update-feedback <?php echo $updateFeedbackClass; ?>">
        <?php
        // Afficher le message en fonction de la classe de feedback
        if ($updateFeedbackClass === 'update-success') {
            echo "Le maillot a été mis à jour avec succès.";
        }
        ?>
    </div>

        <label for="photo">Photo :</label>
        <input type="text" name="photo" value="<?php echo $jersey['photo']; ?>" required><br>

        <label for="equipe">Equipe :</label>
        <input type="text" name="equipe" value="<?php echo $jersey['equipe']; ?>" required><br>

        <label for="joueur">Joueur :</label>
        <input type="text" name="joueur" value="<?php echo $jersey['joueur']; ?>" required><br>

        <label for="saison">Saison :</label>
        <input type="text" name="saison" value="<?php echo $jersey['saison']; ?>" required><br>

        <label for="pays">Pays :</label>
        <input type="text" name="pays" value="<?php echo $jersey['pays']; ?>" required><br>

        <label for="couleur">Couleur :</label>
        <input type="text" name="couleur" value="<?php echo $jersey['couleur']; ?>" required><br>

        <label for="prix">Prix :</label>
        <input type="number" name="prix" value="<?php echo $jersey['prix']; ?>" required><br>

        <label for="liked">Liked :</label>
        <input type="number" name="liked" value="<?php echo $jersey['liked']; ?>" required><br>

        <label for="vues">Vues :</label>
        <input type="number" name="vues" value="<?php echo $jersey['vues']; ?>" required><br>

        <input type="submit" value="Mettre à Jour">
    </form>
    
</body>
</html>
