<?php
session_start();
// Nettoyer les variables de session
session_unset();
// Détruire la session et rediriger vers la page de connexion
session_destroy();
header("Location: login.php");
exit();
?>

