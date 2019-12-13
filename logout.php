<?php
// Fichier config
require("includes/config.php");

$_SESSION = array();

// On supprime les cookies
setcookie(session_name(),'', time() - 42000);

// On détruit la session et on redirige sur la page d'index
session_destroy();
header('Location: ./index.php');
exit;
?>