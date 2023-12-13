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

?>
