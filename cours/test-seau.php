<?php
require_once("Seau.php");

// declaration d'une instance
$monSeau = new Seau( 'zinc', 'grise', 10 );
$monSeau->decrire();

$monDeuxiemeSeau = new Seau( 'plastique', 'rouge', 5 );
$monDeuxiemeSeau->decrire();

// execution d'une methode
$monSeau->remplir(3);
$monSeau->decrire();
echo PHP_EOL;

$monDeuxiemeSeau->remplir( $monSeau->vider(5) );
$monSeau->decrire();
$monDeuxiemeSeau->decrire();
echo PHP_EOL;
