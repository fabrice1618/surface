<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO type_salle (typ_id, typ_name) VALUES (NULL, :typ_name);");
define('QUERY_SELECT', "SELECT * FROM type_salle WHERE typ_id=:typ_id");
define('QUERY_UPDATE', "UPDATE type_salle SET typ_name = :typ_name WHERE typ_id = :typ_id ");
define('QUERY_DELETE', "DELETE FROM type_salle WHERE typ_id= :typ_id ");
define('QUERY_INDEX', "SELECT * FROM type_salle");


class TypeSalle extends Model
{
    private const FIELD_LIST = [
        'typ_id' => 'validateId',
        'typ_name' => 'validateString',
    ];


    public function __construct()
    {
        parent::__construct();
    }


    public function create()
    {
        $iIdCree = 0;

        $stmt1 = $this->dbh->prepare(QUERY_INSERT);
        $stmt1->bindValue(':typ_id', $this->typ_id, PDO::PARAM_INT);
        $stmt1->bindValue(':typ_name', $this->typ_name, PDO::PARAM_STR);
        if ($stmt1->execute()) {
            // recuperation de l'ID de la ligne crée
            $iIdCree = $this->dbh->lastInsertId();
        }
        $this->typ_id = $iIdCree;

        return ($iIdCree);
    }

    public function read($iId)
    {

        $stmt1 = $this->dbh->prepare(QUERY_SELECT);
        $stmt1->bindValue(':typ_id', $iId, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
        }

    }

    public function update()
    {
        $stmt1 = $this->dbh->prepare(QUERY_UPDATE);
        $stmt1->bindValue(':typ_name', $this->typ_name, PDO::PARAM_STR);
        $stmt1->bindValue(':typ_id', $this->typ_id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            //  echo "Update réussi\n";
        }

    }

    public function delete($iId)
    {
        $stmt1 = $this->dbh->prepare(QUERY_DELETE);
        $stmt1->bindValue(':typ_id', $iId, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            //    echo "L'effacement est réussi\n";
        }
    }

    public function index()
    {
        $aTypeSalle = array();

        $stmt1 = $this->dbh->prepare(QUERY_INDEX);
        if ($stmt1->execute()) {
            $aTypeSalle = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($aTypeSalle);
    }

}
