<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO messages (mes_id, mes_name) VALUES (NULL, :mes_name);");
define('QUERY_SELECT', "SELECT * FROM messages WHERE mes_id=:mes_id");
define('QUERY_UPDATE', "UPDATE messages SET mes_name = :mes_name WHERE mes_id = :mes_id ");
define('QUERY_DELETE', "DELETE FROM messages WHERE mes_id= :mes_id ");
define('QUERY_INDEX', "SELECT * FROM messages");

class Message extends Model
{
    private const FIELD_LIST = [
        'mes_id' => 'validateId',
        'mes_name' => 'validateString',
    ];


    public function __construct()
    {
        parent::__construct();
    }


    public function create()
    {
        $iIdCree = 0;

        $stmt1 = $this->dbh->prepare(QUERY_INSERT);
        $stmt1->bindValue(':mes_id', $this->mes_id, PDO::PARAM_INT);
        $stmt1->bindValue(':mes_name', $this->mes_name, PDO::PARAM_STR);
        if ($stmt1->execute()) {
            // recuperation de l'ID de la ligne crée
            $iIdCree = $this->dbh->lastInsertId();
        }
        $this->mes_id = $iIdCree;

        return ($iIdCree);
    }

    public function read($iId)
    {

        $stmt1 = $this->dbh->prepare(QUERY_SELECT);
        $stmt1->bindValue(':mes_id', $iId, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
        }

    }

    public function update()
    {
        $stmt1 = $this->dbh->prepare(QUERY_UPDATE);
        $stmt1->bindValue(':mes_name', $this->mes_name, PDO::PARAM_STR);
        $stmt1->bindValue(':mes_id', $this->mes_id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            //  echo "Update réussi\n";
        }

    }

    public function delete($iId)
    {
        $stmt1 = $this->dbh->prepare(QUERY_DELETE);
        $stmt1->bindValue(':mes_id', $iId, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            //    echo "L'effacement est réussi\n";
        }
    }

    public function index()
    {
        $aMessage = array();

        $stmt1 = $this->dbh->prepare(QUERY_INDEX);
        if ($stmt1->execute()) {
            $aMessage = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($aMessage);
    }

}
