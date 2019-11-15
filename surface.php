<?php

require_once("piece.php");
require_once("vue_listepieces.php");

$listePieces = array();
createListePieces( newPiece( 'Salle de bain', 5, 3 ) );
createListePieces( newPiece( 'Salon', 7, 8 ) );

vue_listePieces( $listePieces );
