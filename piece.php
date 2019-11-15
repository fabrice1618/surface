<?php

function newPiece( $nom, $longueur, $largeur )
{
  $piece = array();

  if (
    isset($nom, $longueur, $largeur) &&
    is_string($nom) &&
    is_numeric($longueur) &&
    is_numeric($largeur) &&
    $nom != "" &&
    $longueur < 20 &&
    $longueur > 0 &&
    $largeur < 20 &&
    $largeur > 0
  ) {

      $piece['piece'] = $nom;
      $piece['longueur'] = $longueur;
      $piece['largeur'] = $largeur;
      $piece['surface'] = calculSurface($longueur, $largeur);


    } else {
      echo "Erreur fonction newPiece() parametres incorrects\n";
    }

  return($piece);
}

function calculSurface($long, $larg)
{

  $surface = $long * $larg;

  return($surface);
}
