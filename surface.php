<?php
require_once("superfonctions.php");

//afficheEntete();
/*
afficheLigne(4, 3);
afficheLigne(2.5, 5);
afficheLigne(6, 2);
*/

$unePiece['piece'] = 'Salle de bain';
$unePiece['largeur'] = 5;
$unePiece['longueur'] = 3;
$unePiece['surface'] = calculSurface($unePiece['largeur'],$unePiece['longueur']);

print_r($unePiece);

$uneAutrePiece['piece'] = 'Salon';
$uneAutrePiece['largeur'] = 7;
$uneAutrePiece['longueur'] = 8;
$uneAutrePiece['surface'] = calculSurface($uneAutrePiece['largeur'],$uneAutrePiece['longueur']);

print_r($uneAutrePiece);

$listePieces = array();
$listePieces[0] = $unePiece;
$listePieces[1] = $uneAutrePiece;
print_r($listePieces);
