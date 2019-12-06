<?php

// Definition de la classe Seau
class Seau
{
  // Les proprietes
  private $matiere;
  private $couleur;
  private $contenance;
  private $contenu;

  // Ce tableau sert a paramétrer les contenances admissibles
  // Ce tableau est utilisé avec la fonction filter_var
  // Entier entre 1 et 10 litres
  const OPTIONS_CONTENANCE = array(
    'options' => array(
        'default' => 10,    // Valeur par defaut si parametre errone
        'min_range' => 1,   // Valeur minimale
        'max_range' => 10   // Valeur maximale
        )
    );

      const OPTIONS_QUANTITE = array(
        'options' => array(
            'default' => 2,    // Valeur par defaut si parametre errone
            'min_range' => 0,   // Valeur minimale
            'max_range' => 10   // Valeur maximale
            )
        );

    // Valeurs par défaut
    const COULEUR_DEFAUT = "gris";
    const MATIERE_DEFAUT = "acier";

  // Le constructeur
  public function __construct( $sMatiere, $sCouleur, $iContenance )
  {
    echo "Execution du constructeur\n";

    $this->contenu = 0;
    // Utilisation de l'operateur ternaire
    // RTFM https://www.php.net/manual/fr/language.operators.comparison.php
    $this->matiere = is_string($sMatiere) ? $sMatiere: self::MATIERE_DEFAUT;
    $this->couleur = is_string($sCouleur) ? $sCouleur: self::COULEUR_DEFAUT;
    $this->contenance = filter_var($iContenance, FILTER_VALIDATE_INT, self::OPTIONS_CONTENANCE);
  }

  // Les methodes
  public function remplir( $iLitre )
  {
      $iLitre = filter_var($iLitre, FILTER_VALIDATE_INT, self::OPTIONS_QUANTITE);
      echo "Execution de la methode remplir $iLitre litres\n";

      if ($this->contenu + $iLitre > $this->contenance) {
          // On ne peut pas mettre plus que ce que le seau contient
          $this->contenu = $this->contenance;
          echo "Warning: la quantité dépasse la quantité maximale. Le seau a debordé.\n";
      } else {
          // On ajoute la quantite demandee dans le seau
          $this->contenu += $iLitre;
      }

  }

  public function vider( $iLitre )
  {
      $iLitre = filter_var($iLitre, FILTER_VALIDATE_INT, self::OPTIONS_QUANTITE);
      echo "Execution de la methode vider $iLitre litres\n";

      $iLitreVide = 0;
      if ($iLitre > $this->contenu) {
          // On ne peut pas prendre plus que ce qu'il y a d'eau dans le seau
          $iLitreVide = $this->contenu;
          $this->contenu = 0;
      } else {
          // On prends la quantité demandée
          $iLitreVide = $iLitre;
          $this->contenu -= $iLitre;
      }

      return($iLitreVide);
  }

  public function decrire()
  {
    echo  "Le seau en " . $this->matiere .
          " de couleur " . $this->couleur .
          " de contenance " . $this->contenance . " litres. ";
    echo "contenu = " . $this->contenu . " litres" . PHP_EOL;
  }

}
