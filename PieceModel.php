<?php

// Ajouter requetes
define('QUERY_INSERT', "" );
define('QUERY_SELECT', "" );
define('QUERY_UPDATE', "" );
define('QUERY_DELETE', "" );
define('QUERY_INDEX', "" );

class PieceModel
{
    private $dbh;     // connexion a la BDD

    public function __construct( $dbh )
    {
      $this->dbh = $dbh;
    }

    public function create( $oPiece )
    {
      $iIdCree = 0;

      // Executer la requete

      return($iIdCree);
    }

    public function read( $iId )
    {
      $aPiece = array();

      // Executer la requete

      return($aPiece);
    }

    public function update( $iId, $oPiece )
    {
        // Executer la requete
    }

    public function delete( $iId )
    {
        // Executer la requete
    }

    public function index()
    {
      $aPiece = array();

      // Executer la requete

      return($aPiece);
    }

}
