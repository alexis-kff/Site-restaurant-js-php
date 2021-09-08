<?php 
//------ CONNEXION BDD
$bdd = new PDO('mysql:host=localhost;dbname=le_9', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//------ SESSION
//session_start();

//------ CONSTANTE (chemin)
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . '/PHP/le_9/Accueil.php');
// Cette constante retourne le chemin physique du dossier 10-boutique sur le serveur
// Lors de l'enregistrement d'image / photos, nous aurons besoin du chemin complet vers le dossier photo pour enregistrer la photo

// $_SERVER['DOCUMENT_ROOT'] --> C:/xampp/htdocs (chemin physique vers le dossier htdocs sur le serveur)
// echo RACINE_SITE . '<hr>';

define("URL", 'http://localhost/PHP/le_9/');

foreach($_POST as $key => $value)
{
    $_POST[$key] = strip_tags(trim($value));
}