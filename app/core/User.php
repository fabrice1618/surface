<?php
//require_once("PasswordGenerator.php");

// Les requetes sont regroupées en haut du script pour faciliter la maintenance
// Utilisation de define pour définir les requetes
define('QUERY_INSERT', "INSERT INTO user (usr_id, usr_email, usr_password, usr_date_connexion, usr_role) VALUES (NULL, :usr_email, :usr_password, :usr_date_connexion, :usr_role) " );
define('QUERY_SELECT', "SELECT * FROM user WHERE usr_id = :usr_id LIMIT 1" );
define('QUERY_SELECT_EMAIL',  "SELECT * FROM user WHERE usr_email = :usr_email LIMIT 1" );
define('QUERY_UPDATE', "UPDATE user SET usr_email = :usr_email, usr_password = :usr_password, usr_date_connexion = :usr_date_connexion, usr_role = :usr_role WHERE usr_id = :usr_id" );
define('QUERY_DELETE', "DELETE FROM user WHERE usr_id = :usr_id " );
define('QUERY_INDEX',  "SELECT * FROM user" );

class User extends Model
{
// Temporaire pendant les tests: impossible d'envoyer email alors on stocke password dans date_connexion
//    'usr_date_connexion'=>'validateUsr_date_connexion',


  public function __construct()
  {
    $this->field_list = [
      'usr_id'=>'validateId',
      'usr_email'=>'validateUsr_email',
      'usr_password'=>'validateString',
      'usr_date_connexion'=>'alwaysTrue',
      'usr_role'=>'validateUsr_role'
  ];
  
    parent::__construct();
  }


    protected function validateUsr_email($sEmail)
    {
        $lReturn = false;
        if (filter_var($sEmail, FILTER_DEFAULT) !== false) {
            $lReturn = true;
        }

        return ($lReturn);
    }

    protected function validateUsr_date_connexion($sDate)
    {
        $lReturn = false;
        // utilisation de l'operateur de transtypage (int) conversion de la valeur en integer
        if (
            is_string($sDate) &&
            strlen($sDate) == 8 &&
            checkdate((int)substr($sDate, 4, 2), (int)substr($sDate, 6, 2), (int)substr($sDate, 0, 4))
        ) {
            $lReturn = true;
        }

        return ($lReturn);
    }

    protected function validateUsr_role($sRole)
    {
        $lReturn = false;
        if (
            is_string($sRole) &&
            in_array($sRole, ["user", "admin"])
        ) {
            $lReturn = true;
        }

        return ($lReturn);
    }

    public function newPassword()
    {
        $sNewPassword = Auth::generatePassword();
      $this->usr_password = Auth::hashPassword( $sNewPassword );

      return($sNewPassword);
  }


  public function create()
  {
    $iIdCree = 0;

    // Prepare SQL statement
    $stmt1 = $this->dbh->prepare( QUERY_INSERT );
    $stmt1->bindValue(':usr_email', $this->usr_email, PDO::PARAM_STR);
    $stmt1->bindValue(':usr_password', $this->usr_password, PDO::PARAM_STR);
    $stmt1->bindValue(':usr_date_connexion', $this->usr_date_connexion, PDO::PARAM_STR);
    $stmt1->bindValue(':usr_role', $this->usr_role, PDO::PARAM_STR);
    if ( $stmt1->execute() ) {
      // recuperation de l'ID de la ligne crée
      $iIdCree = $this->dbh->lastInsertId();
    }

    // MAJ de l'instance avec le usr_id de la database
    $this->usr_id = $iIdCree;

    return($iIdCree);
  }

  public function read( $iId )
  {
    $stmt1 = $this->dbh->prepare( QUERY_SELECT );
    $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
    if ( $stmt1->execute() ) {
        $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
    }
  }

  public function readByEmail( $sEmail )
  {
      $stmt1 = $this->dbh->prepare( QUERY_SELECT_EMAIL );
      $stmt1->bindValue(':usr_email', $sEmail, PDO::PARAM_STR);
      if ( $stmt1->execute() ) {
          $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
      }
  }

  public function update()
  {
    $stmt1 = $this->dbh->prepare( QUERY_UPDATE );
    $stmt1->bindValue(':usr_email', $this->usr_email, PDO::PARAM_STR);
    $stmt1->bindValue(':usr_password', $this->usr_password, PDO::PARAM_STR);
    $stmt1->bindValue(':usr_date_connexion', $this->usr_date_connexion, PDO::PARAM_STR);
    $stmt1->bindValue(':usr_role', $this->usr_role, PDO::PARAM_STR);
    $stmt1->bindValue(':usr_id', $this->usr_id, PDO::PARAM_INT);
    if ( $stmt1->execute() ) {
    //  echo "Update réussi\n";
    }

  }

  public function delete( $iId )
  {

    $stmt1 = $this->dbh->prepare( QUERY_DELETE );
    $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
    if ( $stmt1->execute() ) {
  //    echo "L'effacement est réussi\n";
    }

  }


}
