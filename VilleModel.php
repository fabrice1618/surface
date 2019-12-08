<?php

// Ajouter requetes
define('QUERY_INSERT', "" );
define('QUERY_SELECT', "" );
define('QUERY_UPDATE', "" );
define('QUERY_DELETE', "" );
define('QUERY_INDEX', "" );

class VilleModel
{
    private $dbh;     // connexion a la BDD

    public function __construct( $dbh )
    {
      $this->dbh = $dbh;
    }

    public function create( $sVilDesc)
    {
      $iIdCree = 0;

      // Executer la requete

      return($iIdCree);
    }

    public function read( $iId )
    {
      $sVilDesc = "";

      // Executer la requete

      return($sVilDesc);
    }

    public function update( $iId, $sVilDesc )
    {
        // Executer la requete
    }

    public function delete( $iId )
    {
        // Executer la requete
    }

    public function index()
    {
      $aVille = array();

      // Executer la requete

      return($aVille);
    }

}
