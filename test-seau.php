<?php
require_once("Seau.php");


// declaration d'une instance
$monSeau = new Seau( 'zinc', 'grise', 10 );
//$monSeau->contenance = 10;
//$monSeau->matiere = "zinc";
//$monSeau->couleur = "grise";

$monSeau->decrire();

// execution d'une methode
$monSeau->remplir(3);
$monSeau->decrire();

$monSeau->vider(5);
$monSeau->decrire();
