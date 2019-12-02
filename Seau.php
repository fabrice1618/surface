<?php

// Definition de la classe Seau
class Seau
{
  // Les proprietes
  private $matiere;
  private $couleur;
  private $contenance;
  private $contenu;

  // Le constructeur
  public function __construct( $sMatiere, $sCouleur, $iContenance )
  {
    echo "Execution du constructeur\n";
    $bErreur = false;

    if (is_string($sMatiere)) {
      $this->matiere = $sMatiere;
    } else {
      $bErreur = true;
    }

    if (is_string($sCouleur)) {
      $this->couleur = $sCouleur;
    } else {
      $bErreur = true;
    }

    if (is_int($iContenance) &&
        $iContenance > 0 &&
        $iContenance <= 10
      ) {
        $this->contenance = $iContenance;
    } else {
        $bErreur = true;
    }

    if ($bErreur) {
      echo "Il y a une erreur dans la creation de l'objet\n";
    }

    $this->contenu = 0;

  }

  // Les methodes
  public function remplir( $iLitre )
  {
    echo "Execution de la methode remplir $iLitre litres\n";
    if (
      is_int($iLitre) &&
      $iLitre > 0 &&
      $iLitre <= 10
    ) {
      $this->contenu += $iLitre;
      if ($this->contenu > $this->contenance) {
        $this->contenu = $this->contenance;
        echo "Tu t'es mouillé les pieds\n";
      }

    } else {
      echo "Il y a une erreur dans le parametre\n";
    }
  }

  public function vider( $iLitre )
  {
    echo "Execution de la methode vider $iLitre litres\n";

    $iLitreVide = 0;

    if (
      is_int($iLitre) &&
      $iLitre > 0 &&
      $iLitre <= 10
    ) {
      if ($iLitre > $this->contenu) {
        $iLitreVide = $this->contenu;
        $this->contenu = 0;
      } else {
        $iLitreVide = $iLitre;
        $this->contenu -= $iLitre;
      }
    } else {
      echo "Il y a une erreur dans le parametre\n";
    }

    return($iLitreVide);
  }

  public function decrire()
  {
    echo  "Le seau en " . $this->matiere .
          " de couleur " . $this->couleur .
          " contient " . $this->contenance . " litres. ";
    echo "Le contenu est " . $this->contenu . " litres." . PHP_EOL;
  }

}
