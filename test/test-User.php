<?php
require_once("../User.php");

$unUser = new User("bob@example.com");
$unUser->setDateConnexion("20191204");

// Affichage des informations utilisateurs
echo "email=".$unUser->getEmail().PHP_EOL;
echo "password=".$unUser->getPassword().PHP_EOL;
echo "passwordHash=".$unUser->getPasswordHash().PHP_EOL;
echo "date_connexion=".$unUser->getDateConnexion().PHP_EOL;

// Modification des données utilisateur
$unUser->newPassword();
$unUser->setDateConnexion(date("Ymd"));
echo "\n";
print_r($unUser->toArray());
