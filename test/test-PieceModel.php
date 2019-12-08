<?php
require_once("../config.php");

require_once("../PieceModel.php");

// Ouvre la connexion DB en mode persistant
try {
    $dbh = new PDO(
      "mysql:host=$config_DBhost;dbname=$config_DBname;charset=utf8",
      $config_DBusername,
      $config_DBpassword,
      array(PDO::ATTR_PERSISTENT => true)
    );
} catch (PDOException $e) {
    echo "Erreur PDO: " . $e->getMessage() . "\n";
    die();
}

// Tester le modele


$dbh = null;
