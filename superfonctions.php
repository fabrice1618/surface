<?php

function afficheEntete()
{
//  echo "  Longueur  |  Largeur  | Surface   |\n";
  printf("| %9s | %9s | %9s |\n", "Longueur", "Largeur", "Surface");
}

function afficheLigne($long, $larg)
{
  if ( is_numeric($long) && is_numeric($larg) ) {
    printf("| %9.2f | %9.2f | %9.2f |\n", $long, $larg, calculSurface($long, $larg));
  } else {
    echo "Erreur données:". var_dump($long). var_dump($larg) . "\n" ;
  }

//  echo " $long | $larg | ".calculSurface($long, $larg)." \n";

}

function calculSurface($long, $larg)
{

  if ( is_numeric($long) && is_numeric($larg) ) {
    $surface = $long * $larg;
  } else {
    echo "Erreur données:". var_dump($long). var_dump($larg) . "\n" ;
  }

  return($surface);
}
