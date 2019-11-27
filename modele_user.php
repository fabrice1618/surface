<?php

// parametres de definition
function createUser( $sEmail, $sPassword, $sDateConnexion )
{
  global $dbh;

  $iIdCree = 0;

  // Prepare SQL statement
  $stmt1 = $dbh->prepare("INSERT INTO user (usr_id, usr_email, usr_password, usr_date_connexion) VALUES (NULL, :usr_email, :usr_password, :usr_date_connexion) ");
  $stmt1->bindValue(':usr_email', $sEmail, PDO::PARAM_STR);
  $stmt1->bindValue(':usr_password', $sPassword, PDO::PARAM_STR);
  $stmt1->bindValue(':usr_date_connexion', $sDateConnexion, PDO::PARAM_STR);
  if ( $stmt1->execute() ) {
    // recuperation de l'ID de la ligne crée
    $iIdCree = $dbh->lastInsertId();
  } else {
  }

  return($iIdCree);
}

function readUser($iId)
{
  global $dbh;

  $aUser = array();

  //echo "ID:$iId\n";

  $stmt1 = $dbh->prepare("SELECT * FROM user WHERE usr_id = :usr_id ");
  $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
  if ( $stmt1->execute() ) {
    while ($aRow = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $aUser = $aRow;
        }
  } else {
  }

  return($aUser);
}

function updateUser($iId, $sEmail, $sPassword, $sDateConnexion)
{

  global $dbh;
  $stmt1 = $dbh->prepare("UPDATE user SET usr_email = :usr_email, usr_password = :usr_password, usr_date_connexion = :usr_date_connexion WHERE usr_id = :usr_id");
  $stmt1->bindValue(':usr_email', $sEmail, PDO::PARAM_STR);
  $stmt1->bindValue(':usr_password', $sPassword, PDO::PARAM_STR);
  $stmt1->bindValue(':usr_date_connexion', $sDateConnexion, PDO::PARAM_STR);
  $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
  if ( $stmt1->execute() ) {
  //  echo "Update réussi\n";
  } else {
  //    echo "Update échoué\n";
  }
  echo "ID:$iId\n";
}

// Fonction ressemble beaucoup a readUser
function existUser($iId)
{
  global $dbh;

  $bExiste = array();

  //echo "ID:$iId\n";

  $stmt1 = $dbh->prepare("SELECT * FROM user WHERE usr_id = :usr_id ");
  $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
  if ( $stmt1->execute() ) {
    $bExiste = true;
  } else {
  }

  return($bExiste);
}


function deleteUser($iId)
{
  global $dbh;

  $stmt1 = $dbh->prepare("DELETE FROM user WHERE usr_id = :usr_id ");
  $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
  if ( $stmt1->execute() ) {
//    echo "L'effacement est réussi\n";
  } else {
//    echo "L'effacement est échoué\n";
  }

}

function indexUser()
{
  global $dbh;

  $aUser = array();

  $stmt1 = $dbh->prepare("SELECT * FROM user");
  if ( $stmt1->execute() ) {
    while ($aRow = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $aUser[] = $aRow;
        }
  }

  return($aUser);
}
