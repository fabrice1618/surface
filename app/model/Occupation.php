<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO occupation (fil_id, sal_id, tra_id, occ_date) VALUES (:fil_id, :sal_id, :tra_id, :occ_date);");
define('QUERY_SELECT', "SELECT * FROM occupation WHERE fil_id = :fil_id AND sal_id = :sal_id AND tra_id = :tra_id AND occ_date = :occ_date");
define('QUERY_UPDATE', "UPDATE `occupation` SET `fil_id` = :newfil_id, `sal_id` = :newsal_id, `tra_id` = :newtra_id, `occ_date` = :newocc_date WHERE `occupation`.`fil_id` = :fil_id AND `occupation`.`sal_id` = :sal_id AND `occupation`.`tra_id` = :tra_id AND `occupation`.`occ_date` = :occ_date");
define('QUERY_DELETE', "DELETE FROM occupation WHERE `occupation`.`fil_id` = :fil_id AND `occupation`.`sal_id` = :sal_id AND `occupation`.`tra_id` = :tra_id AND `occupation`.`occ_date` = :occ_date ");
define('QUERY_INDEX', "SELECT * FROM occupation");

class occupationModel extends Model
{
    private const FIELD_LIST = [
        'fil_id' => 'validateId',
        'sal_id' => 'validateId',
        'tra_id' => 'validateId',
        'occ_date' => 'validateDate',
    ];


    public function __construct()
    {
        parent::__construct();
    }


    public function create()
    {

        $stmt1 = $this->dbh->prepare(QUERY_INSERT);
        $stmt1->bindValue(':fil_id', $this->fil_id, PDO::PARAM_INT);
        $stmt1->bindValue(':sal_id', $this->sal_id, PDO::PARAM_INT);
        $stmt1->bindValue(':tra_id', $this->tra_id, PDO::PARAM_INT);
        $stmt1->bindValue(':occ_date', $this->occ_date, PDO::PARAM_STR);
        if ($stmt1->execute()) {
            // echo "insertion réussi";
        }

    }

    public function read($filliere, $salle, $tranche_horaire, $date)
    {

        $stmt1 = $this->dbh->prepare(QUERY_SELECT);
        $stmt1->bindValue(':fil_id', $filliere, PDO::PARAM_INT);
        $stmt1->bindValue(':sal_id', $salle, PDO::PARAM_INT);
        $stmt1->bindValue(':tra_id', $tranche_horaire, PDO::PARAM_INT);
        $stmt1->bindValue(':occ_date', $date, PDO::PARAM_STR);

        if ($stmt1->execute()) {
            $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
        }

    }

    public function update()
    {
        $stmt1 = $this->dbh->prepare(QUERY_UPDATE);
        $stmt1->bindValue(':fil_id', $this->fil_id, PDO::PARAM_INT);
        $stmt1->bindValue(':sal_id', $this->sal_id, PDO::PARAM_INT);
        $stmt1->bindValue(':tra_id', $this->tra_id, PDO::PARAM_INT);
        $stmt1->bindValue(':occ_date', $this->occ_date, PDO::PARAM_STR);
        $stmt1->bindValue(':newfil_id', $this->newfil_id, PDO::PARAM_INT);
        $stmt1->bindValue(':newsal_id', $this->newsal_id, PDO::PARAM_INT);
        $stmt1->bindValue(':newtra_id', $this->newtra_id, PDO::PARAM_INT);
        $stmt1->bindValue(':newocc_date', $this->newocc_date, PDO::PARAM_STR);
        if ($stmt1->execute()) {
            // echo "Update réussi\n";
        }
    }

    public function delete($filliere, $salle, $tranche_horaire, $date)
    {
        $stmt1 = $this->dbh->prepare(QUERY_DELETE);
        $stmt1->bindValue(':fil_id', $filliere, PDO::PARAM_INT);
        $stmt1->bindValue(':sal_id', $salle, PDO::PARAM_INT);
        $stmt1->bindValue(':tra_id', $tranche_horaire, PDO::PARAM_INT);
        $stmt1->bindValue(':occ_date', $date, PDO::PARAM_STR);
        if ($stmt1->execute()) {
            echo "L'effacement est réussi\n";
        }
    }

    public function index($filliere)
    {
        $filliere = array();

        $stmt1 = $this->dbh->prepare(QUERY_INDEX);
        if ($stmt1->execute()) {
            $filliere = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($filliere);
    }


}