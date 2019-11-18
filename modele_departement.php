<?php

function createDepartement($depCode, $depNom)
{
  global $dbh;

  $stmt1 = $dbh->prepare("INSERT INTO departement (dep_code, dep_nom) VALUES (:dep_code, :dep_nom) ");
  $stmt1->bindValue(':dep_code', $depCode, PDO::PARAM_STR);
  $stmt1->bindValue(':dep_nom', $depNom, PDO::PARAM_STR);
  if ( $stmt1->execute() ) {
    echo "L'insertion est réussie\n";
  } else {
    echo "L'insertion est échouée\n";
  }

}

function readDepartement($depCode)
{
  global $dbh;

  $aDep = array();

  $stmt1 = $dbh->prepare("SELECT * FROM departement WHERE dep_code = :dep_code ");
  $stmt1->bindValue(':dep_code', $depCode, PDO::PARAM_STR);
  if ( $stmt1->execute() ) {
    while ($aRow = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $aDep = $aRow;
        }
  }

  return($aDep);
}

function updateDepartement($depCode, $depNom)
{

  global $dbh;
  $stmt1 = $dbh->prepare("UPDATE departement SET dep_nom=:dep_nom WHERE dep_code = :dep_code ");
  $stmt1->bindValue(':dep_code', $depCode, PDO::PARAM_STR);
  $stmt1->bindValue(':dep_nom', $depNom, PDO::PARAM_STR);
  if ( $stmt1->execute() ) {
    echo "Update réussi\n";
  } else {
    echo "Update échoué\n";
  }

}

function deleteDepartement($depCode)
{
  global $dbh;

  $stmt1 = $dbh->prepare("DELETE FROM departement WHERE dep_code=:dep_code ");
  $stmt1->bindValue(':dep_code', $depCode, PDO::PARAM_STR);
  if ( $stmt1->execute() ) {
    echo "L'effacement est réussi\n";
  } else {
    echo "L'effacement est échoué\n";
  }

}

function indexDepartement()
{
  global $dbh;

  $aDep = array();

  $stmt1 = $dbh->prepare("SELECT * FROM departement");
  if ( $stmt1->execute() ) {
    while ($aRow = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $aDep[] = $aRow;
        }
  }

  return($aDep);
}
