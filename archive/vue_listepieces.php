<?php

function vue_listePieces( $listePieces )
{
  afficheEntete();

  foreach ($listePieces as $key => $pieceCourante) {
    afficheLigne($pieceCourante);
  }

}

function afficheEntete()
{
  printf("| %20s | %9s | %9s | %9s |\n", "piece", "Longueur", "Largeur", "Surface");
}

function afficheLigne($unePiece)
{

  printf(
      "| %20s | %9.2f | %9.2f | %9.2f |\n",
      $unePiece['piece'],
      $unePiece['longueur'],
      $unePiece['largeur'],
      $unePiece['surface']
    );

}
