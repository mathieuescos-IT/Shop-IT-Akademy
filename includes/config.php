<?php
// Script permettant l'affichage et l'envoi par email d'erreur PHP sur le site.
error_reporting(E_ALL);
ini_set('display_errors', 1);

function errorHandler($number, $message, $file, $line, $vars) {
    $email = "
			<p>An error ($number) occurred on line
			<strong>$line</strong> and in the <strong>file: $file.</strong>
			<p> $message </p>";

    $email .= "<pre>" . print_r($vars, 1) . "</pre>";

    $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Email the error to someone...
    error_log($email, 1, 'mathieu@escos.pro', $headers);

    // Make sure that you decide how to respond to errors (on the user's side)
    // Either echo an error message, or kill the entire project. Up to you...
    // The code below ensures that we only "die" if the error was more than
    // just a NOTICE.
    if ( ($number !== E_NOTICE) && ($number < 2048) ) {
        die("There was an error. Please try again later.");
    }
}

session_start();

$mysqli = new mysqli('Mettre ici HOTE', 'Mettre ici nom dutilisateur (ROOT si local)', 'Mettre ici mot de pase BDD (aucun SI LOCAL)', 'Mettre ici nom de la base de données');
$mysqli->set_charset("utf8");

require 'actions.php';
