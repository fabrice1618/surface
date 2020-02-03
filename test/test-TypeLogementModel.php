<?php
require_once("../config.php");

require_once("../TypeLogementModel.php");

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
$typeLogementModel = new TypeLogementModel($dbh);

// Ajout d'une piece
$iId = $typeLogementModel->create("chateau");

echo "Lecture d un type logement Cree $iId" . PHP_EOL;
print_r( $typeLogementModel->read($iId) );

echo "\nUpdate de typeLogement $iId" . PHP_EOL;
$typeLogementModel->update($iId, "Chateau fort");
print_r( $typeLogementModel->read($iId) );


// effacement d'un User
echo "\nEffacement d'un type logement' $iId\n";
$typeLogementModel->delete($iId);
print_r( $typeLogementModel->index() );


$dbh = null;
