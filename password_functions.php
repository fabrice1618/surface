<?php

function checkPassword( $sPassword)
{
  $bPasswordOK = false;

  $bCondition1 = false;  // Chiffres
  $bCondition2 = false;  // Symboles presents
  $bCondition3 = false;  // Minuscules
  $bCondition4 = false;  // Majuscules
  $bCaractereInterdit = false;

  $iPointeur = 0;
  $iLongueurPassword = 0;

  while ( ($iPointeur < strlen($sPassword)) && ($bCaractereInterdit==false)) {
    // Lire le caractere pointé par pointeur
    $sCaractere = $sPassword[$iPointeur];
    $iLongueurPassword++;              // Et j'ajoute un a la Longueur du mot de passe
    $bCaractereInterdit = true;

    // Verifier si le caractere est un chiffre
    if (isChiffre($sCaractere)) {        // Si le caractere est un chiffre
      $bCondition1 = true;               // Alors la condition1 est vraie
      $bCaractereInterdit = false;
    }

    // Verifier si le caractere est un symbole
    if (isSymbole($sCaractere)) {
      $bCondition2 = true;
      $bCaractereInterdit = false;
    }

    // Verifier si le caractere est une lettre minuscule
    if (isLettreMinuscule($sCaractere)) {
      $bCondition3 = true;
      $bCaractereInterdit = false;
    }

    // Verifier si le caractere est un chiffre majuscule
    if (isLettreMajuscule($sCaractere)) {
      $bCondition4 = true;
      $bCaractereInterdit = false;
    }

    $iPointeur++;
  }

  if ( ($iLongueurPassword>=8) && $bCondition1 && $bCondition2 && $bCondition3 && $bCondition4 ) {
      $bPasswordOK = true;
  }

  return($bPasswordOK);
}

function isChiffre($sCaractere)
{
  $bReturn = false;

  if ( ($sCaractere>='0') && ($sCaractere<='9')) {
    $bReturn = true;
  }

  return($bReturn);
}

// Verifier si le caractere est un symbole
function isSymbole($sCaractere)
{
  $bReturn = false;

  $aSymbole = ['@', '/', '-', ':', '='];

  if ( in_array($sCaractere, $aSymbole) ) {
    $bReturn = true;
  }

  return($bReturn);
}


// Verifier si le caractere est une lettre minuscule
function isLettreMinuscule($sCaractere)
{
  $bReturn = false;

  if ( ($sCaractere>='a') && ($sCaractere<='z')) {
    $bReturn = true;
  }

  return($bReturn);
}

// Verifier si le caractere est un chiffre majuscule
function isLettreMajuscule($sCaractere)
{
  $bReturn = false;

  if ( ($sCaractere>='A') && ($sCaractere<='Z')) {
    $bReturn = true;
  }

  return($bReturn);
}
