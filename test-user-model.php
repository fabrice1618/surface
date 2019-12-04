<?php
require_once("User.php");
require_once("UserModel.php");

// Ouvre la connexion DB en mode persistant
try {
    $dbh = new PDO(
      'mysql:host=localhost;dbname=surface;charset=utf8',
      'root',
      '',
      array(PDO::ATTR_PERSISTENT => true)
    );
} catch (PDOException $e) {
    echo "Erreur PDO: " . $e->getMessage() . "\n";
    die();
}


$unUser = new User("bob@example.com");
$unUser->setPassword("Abcd12@:");
$unUser->setDateConnexion("20191204");

$userModel = new UserModel($dbh);



$dbh = null;
