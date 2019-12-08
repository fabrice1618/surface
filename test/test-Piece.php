<?php
require_once("../Piece.php");

$unePiece = new Piece( 2, "salon", 4.2, 3.5 );

// Affichage de la piece
echo "La piece id " . $unePiece->getLogId() . " " . $unePiece->getNom() . PHP_EOL .
    "mesure " . $unePiece->getLongueur() . " metres de longueur " . PHP_EOL .
    "et " . $unePiece->getLargeur() . " metres de largeur " . PHP_EOL.
    "la surface est " . $unePiece->getSurface() . " metres carrés" . PHP_EOL;

$unePiece->setNom("salon 2");
$unePiece->setLongueur( 4.3 );
$unePiece->setLargeur( 3.4 );
// Affichage de la piece
echo "\n";
echo "La piece id " . $unePiece->getLogId() . " " . $unePiece->getNom() . PHP_EOL .
    "mesure " . $unePiece->getLongueur() . " metres de longueur " . PHP_EOL .
    "et " . $unePiece->getLargeur() . " metres de largeur " . PHP_EOL .
    "la surface est " . $unePiece->getSurface() . " metres carrés" . PHP_EOL;
