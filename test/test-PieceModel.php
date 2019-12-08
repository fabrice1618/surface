<?php
require_once("../config.php");

require_once("../PieceModel.php");

// Ouvre la connexion DB en mode persistant
try {
    $dbh = new PDO(
      "mysql:host=$db_host;dbname=$db_name;charset=utf8",
      $db_username,
      $db_password,
      array(PDO::ATTR_PERSISTENT => true)
    );
} catch (PDOException $e) {
    echo "Erreur PDO: " . $e->getMessage() . "\n";
    die();
}

// Tester le modele


$dbh = null;
