<?php
// functions.php
//****************************** Connexion à la Base de données  *****************************************
function connectToDatabase()
{
    // Remplacez ces informations par les paramètres de votre base de données
    $host = 'localhost';
    $dbname = 'tests';
    $username = 'root';
    $password = 'root';

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
}

//****************************** affichermaillots.php allJerseys.php  *****************************************
function getAllMaillots()
{
    $db = connectToDatabase();

    $sqlQuery = 'SELECT * FROM maillot';
    $maillotsStatement = $db->query($sqlQuery);

    return $maillotsStatement->fetchAll(PDO::FETCH_ASSOC);
}

//****************************** meilleuresVues.php bestJerseys.php  *****************************************
function getMeilleuresVues()
{
    $db = connectToDatabase();

    $sqlQuery = 'SELECT * FROM maillot ORDER BY vues DESC LIMIT 5';
    $maillotsStatement = $db->query($sqlQuery);

    return $maillotsStatement->fetchAll(PDO::FETCH_ASSOC);

}


//****************************** maillot_details.php jerseyDetails.php  *****************************************
function getMaillotById($id)
{
    $db = connectToDatabase();

    $sqlQuery = 'SELECT * FROM maillot WHERE id = :id';
    $maillotStatement = $db->prepare($sqlQuery);
    $maillotStatement->bindParam(':id', $id, PDO::PARAM_INT);
    $maillotStatement->execute();

    return $maillotStatement->fetch(PDO::FETCH_ASSOC);
}

function getUserByName($userName)
{
    $db = connectToDatabase();

    $sqlQuery = 'SELECT * FROM users WHERE userName = :userName';
    $userStatement = $db->prepare($sqlQuery);
    $userStatement->bindParam(':userName', $userName, PDO::PARAM_STR);
    $userStatement->execute();

    // Utilisez fetch plutôt que fetchAll, car nous nous attendons à une seule ligne
    return $userStatement->fetch(PDO::FETCH_ASSOC);
}

function incrementerVues($id)
{
    try {
        $db = connectToDatabase();

        // Sélection de la valeur actuelle de vues
        $sqlSelect = 'SELECT vues FROM maillot WHERE id = :id';
        $selectStatement = $db->prepare($sqlSelect);
        $selectStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $selectStatement->execute();

        $vuesActuelles = $selectStatement->fetchColumn();

        // Incrémentation de vues
        $nouvellesVues = $vuesActuelles + 1;

        // Mise à jour de la valeur dans la base de données
        $sqlUpdate = 'UPDATE maillot SET vues = :nouvellesVues WHERE id = :id';
        $updateStatement = $db->prepare($sqlUpdate);
        $updateStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $updateStatement->bindParam(':nouvellesVues', $nouvellesVues, PDO::PARAM_INT);
        $updateStatement->execute();

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function updateLikedStatus($maillotId, $liked)
{
    $db = connectToDatabase();

    $sqlUpdate = 'UPDATE maillot SET liked = :liked WHERE id = :id';
    $updateStatement = $db->prepare($sqlUpdate);
    $updateStatement->bindParam(':id', $maillotId, PDO::PARAM_INT);
    $updateStatement->bindParam(':liked', $liked, PDO::PARAM_BOOL);
    $updateStatement->execute();
}

//****************************** updateJersey.php  ******************************************************************
function updateMaillotInfo($jersey_id, $new_photo, $new_equipe, $new_joueur, $new_saison, $new_pays, $new_couleur, $new_prix, $new_liked, $new_vues)
{
    try {
        $db = connectToDatabase();

        $update_query = "UPDATE maillot SET 
            photo = '$new_photo', 
            equipe = '$new_equipe', 
            joueur = '$new_joueur', 
            saison = '$new_saison', 
            pays = '$new_pays', 
            couleur = '$new_couleur', 
            prix = '$new_prix', 
            liked = '$new_liked', 
            vues = '$new_vues' 
            WHERE id = $jersey_id";

        $update_result = $db->exec($update_query);

        return $update_result;

    } catch (Exception $e) {
        die('Erreur lors de la mise à jour du maillot : ' . $e->getMessage());
    }
}

//****************************** confirmationDelete.php  ******************************************************************
function deleteMaillot($maillotId)
{
    $db = connectToDatabase();
    try {
        // Préparez et exécutez la requête de suppression
        $query = "DELETE FROM maillot WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $maillotId, PDO::PARAM_INT);
        $statement->execute();
    } catch (PDOException $e) {
        // Gérez les erreurs de suppression (par exemple, enregistrer dans un fichier journal)
        echo "Erreur de suppression : " . $e->getMessage();
    }
}

//****************************** newJersey.php  ******************************************************************
function newJersey($photo, $joueur, $equipe, $saison, $pays, $couleur, $prix, $liked, $vues)
{

    try {
        $db = connectToDatabase();

        $sql = "INSERT INTO maillot (photo, joueur, equipe, saison, pays, couleur, prix, liked, vues) 
                VALUES (:photo, :joueur, :equipe, :saison, :pays, :couleur, :prix, :liked, :vues)";

        $insertStatement = $db->prepare($sql);

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

//****************************** inscription.php  ******************************************************************
function newUser($userName, $email, $password, $isAdmin, $nom, $prenom, $adresse, $complementAdresse, $codePostal, $commune, $pays)
{

    try {
        $db = connectToDatabase();

        $sql = "INSERT INTO users (userName, email, password, isAdmin, nom, prenom, adresse, complementAdresse, codePostal, commune, pays) 
                VALUES (:userName, :email, :password, :isAdmin, :nom, :prenom, :adresse, :complementAdresse, :codePostal, :commune, :pays)";

        $insertStatement = $db->prepare($sql);

        // Liaison des valeurs des paramètres
        $insertStatement->bindParam(':userName', $userName, PDO::PARAM_STR);
        $insertStatement->bindParam(':email', $email, PDO::PARAM_STR);
        $insertStatement->bindParam(':password', $password, PDO::PARAM_STR);
        $insertStatement->bindParam(':isAdmin', $isAdmin, PDO::PARAM_STR);

        $insertStatement->bindParam(':nom', $nom, PDO::PARAM_STR);
        $insertStatement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $insertStatement->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $insertStatement->bindParam(':complementAdresse', $complementAdresse, PDO::PARAM_STR);
        $insertStatement->bindParam(':codePostal', $codePostal, PDO::PARAM_STR);
        $insertStatement->bindParam(':commune', $commune, PDO::PARAM_STR);
        $insertStatement->bindParam(':pays', $pays, PDO::PARAM_STR);

        // Exécution de la requête
        $insertStatement->execute();

    } catch (Exception $e) {
        die('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
}

// Fonction pour vérifier si un utilisateur existe déjà avec le même nom d'utilisateur
function userExistsByUsername($userName)
{
    $db = connectToDatabase();
    $query = $db->prepare("SELECT COUNT(*) FROM users WHERE userName = :userName");
    $query->bindParam(':userName', $userName, PDO::PARAM_STR);
    $query->execute();
    return $query->fetchColumn() > 0;
}

// Fonction pour vérifier si un utilisateur existe déjà avec la même adresse e-mail
function userExistsByEmail($email)
{
    $db = connectToDatabase();
    $query = $db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    return $query->fetchColumn() > 0;
}

//****************************** shipment.php  ******************************************************************
function updateUserInfo($userName, $new_nom, $new_prenom, $new_adresse, $new_complementAdresse, $new_codePostal, $new_commune, $new_pays)
{
    try {
        $db = connectToDatabase();

        $update_query = "UPDATE users SET 
            nom = '$new_nom', 
            prenom = '$new_prenom', 
            adresse = '$new_adresse', 
            complementAdresse = '$new_complementAdresse', 
            codePostal = '$new_codePostal', 
            commune = '$new_commune', 
            pays = '$new_pays' 
            WHERE userName = '$userName'";

        $update_result = $db->exec($update_query);

        return $update_result;

    } catch (Exception $e) {
        die('Erreur lors de la mise à jour des détails de l\'utilisateur : ' . $e->getMessage());
    }
}

//****************************** banner.php  ******************************************************************

// Fonction pour obtenir le nombre total d'articles dans le panier
function getTotalArticlesInBasket()
{
    if (isset($_SESSION['basket'])) {
        return count($_SESSION['basket']);
    } else {
        return 0;
    }
}

//****************************** login.php  ******************************************************************
function authenticateUser($enteredUsername, $enteredPassword)
{
    $db = connectToDatabase();

    // Remplacez cela par une requête sécurisée à votre base de données
    $query = $db->prepare("SELECT * FROM users WHERE userName = :userName AND password = :password");
    $query->bindParam(':userName', $enteredUsername);
    $query->bindParam(':password', $enteredPassword); // En pratique, utilisez le hachage des mots de passe

    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Vérifier les informations d'identification
    if ($user) {
        $_SESSION['userName'] = $enteredUsername;
        return true;
    } else {
        return false;
    }
}

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

//****************************** logout.php  ******************************************************************
function logoutUser()
{
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

