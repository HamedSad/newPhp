<?php
// functions.php
function connectDatabase()
{
    try {
        return new PDO('mysql:host=localhost;dbname=tests;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
}

function getAllMaillots()
{
    $mysqlClient = connectDatabase();

    $sqlQuery = 'SELECT * FROM maillot';
    $maillotsStatement = $mysqlClient->query($sqlQuery);

    return $maillotsStatement->fetchAll(PDO::FETCH_ASSOC);
}

function getMaillotById($id)
{
    $mysqlClient = connectDatabase();

    $sqlQuery = 'SELECT * FROM maillot WHERE id = :id';
    $maillotStatement = $mysqlClient->prepare($sqlQuery);
    $maillotStatement->bindParam(':id', $id, PDO::PARAM_INT);
    $maillotStatement->execute();

    return $maillotStatement->fetch(PDO::FETCH_ASSOC);
}

function incrementerVues($id)
{
    try {
        $mysqlClient = connectDatabase();

        // Sélection de la valeur actuelle de vues
        $sqlSelect = 'SELECT vues FROM maillot WHERE id = :id';
        $selectStatement = $mysqlClient->prepare($sqlSelect);
        $selectStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $selectStatement->execute();

        $vuesActuelles = $selectStatement->fetchColumn();

        // Incrémentation de vues
        $nouvellesVues = $vuesActuelles + 1;

        // Mise à jour de la valeur dans la base de données
        $sqlUpdate = 'UPDATE maillot SET vues = :nouvellesVues WHERE id = :id';
        $updateStatement = $mysqlClient->prepare($sqlUpdate);
        $updateStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $updateStatement->bindParam(':nouvellesVues', $nouvellesVues, PDO::PARAM_INT);
        $updateStatement->execute();

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getMeilleuresVues(){
    $mysqlClient = connectDatabase();

    $sqlQuery = 'SELECT * FROM maillot ORDER BY vues DESC LIMIT 5';
    $maillotsStatement = $mysqlClient->query($sqlQuery);

    return $maillotsStatement->fetchAll(PDO::FETCH_ASSOC);

}

function newJersey($photo, $joueur, $equipe, $saison, $pays, $couleur, $prix, $liked, $vues){
    
    try {
        $mysqlClient = connectDatabase();

        $sql = "INSERT INTO maillot (photo, joueur, equipe, saison, pays, couleur, prix, liked, vues) 
                VALUES (:photo, :joueur, :equipe, :saison, :pays, :couleur, :prix, :liked, :vues)";
        
        $insertStatement = $mysqlClient->prepare($sql);

        // Liaison des valeurs des paramètres
        $insertStatement->bindParam(':photo', $photo, PDO::PARAM_STR);
        $insertStatement->bindParam(':joueur', $joueur, PDO::PARAM_STR);
        $insertStatement->bindParam(':equipe', $equipe, PDO::PARAM_STR);
        $insertStatement->bindParam(':saison', $saison, PDO::PARAM_STR);
        $insertStatement->bindParam(':pays', $pays, PDO::PARAM_STR);
        $insertStatement->bindParam(':couleur', $couleur, PDO::PARAM_STR);
        $insertStatement->bindParam(':prix', $prix, PDO::PARAM_STR);
        $insertStatement->bindParam(':liked', $liked, PDO::PARAM_STR);
        $insertStatement->bindParam(':vues', $vues, PDO::PARAM_STR);

        // Exécution de la requête
        $insertStatement->execute();

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function updateLikedStatus($maillotId, $liked){
    $mysqlClient = connectDatabase();

    $sqlUpdate = 'UPDATE maillot SET liked = :liked WHERE id = :id';
    $updateStatement = $mysqlClient->prepare($sqlUpdate);
    $updateStatement->bindParam(':id', $maillotId, PDO::PARAM_INT);
    $updateStatement->bindParam(':liked', $liked, PDO::PARAM_BOOL);
    $updateStatement->execute();
}

function deleteMaillot($maillotId) {
    try {
        // Remplacez les informations de connexion par les vôtres
        $pdo = new PDO("mysql:host=localhost;dbname=tests", "root", "root");

        // Préparez et exécutez la requête de suppression
        $query = "DELETE FROM maillot WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':id', $maillotId, PDO::PARAM_INT);
        $statement->execute();
    } catch (PDOException $e) {
        // Gérez les erreurs de suppression (par exemple, enregistrer dans un fichier journal)
        echo "Erreur de suppression : " . $e->getMessage();
    }
}

?>
