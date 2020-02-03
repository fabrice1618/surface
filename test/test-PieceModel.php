<?php
require_once("../config.php");

require_once("../PieceModel.php");
require_once("../Piece.php");

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
// Creation de l'objet Piece
$unePiece = new Piece( 1, "chambre 2", 4, 3 );

// Creation de l'objet UserModel
$pieceModel = new PieceModel($dbh);

// Ajout d'une piece
$iId = $pieceModel->create($unePiece);

echo "Lecture d une piece Cree $iId" . PHP_EOL;
print_r( $pieceModel->read($iId) );

echo "\nUpdate de piece $iId" . PHP_EOL;
$unePiece->setLongueur(2.3);
$pieceModel->update($iId, $unePiece);
print_r( $pieceModel->read($iId) );


// effacement d'un User
echo "\nEffacement d'une piece' $iId\n";
$pieceModel->delete($iId);
print_r( $pieceModel->index() );

$dbh = null;
