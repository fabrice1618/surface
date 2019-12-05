<?php
require_once("password_functions.php");

class User
{
  private $email;
  private $password;
  private $date_connexion;
  private $password_hash;

  function __construct($sEmail)
  {
    if ( filter_var($sEmail, FILTER_VALIDATE_EMAIL) !== false ) {
      $this->email = $sEmail;
    }

  }

  public function getEmail()
  {
    return($this->email);
  }

  public function setPassword( $sPassword )
  {
    if (checkPassword($sPassword)) {
      $this->password = $sPassword;
      $this->password_hash = password_hash($sPassword, PASSWORD_DEFAULT);
    }

  }

  public function getPasswordHash()
  {
    return($this->password_hash);
  }

  public function setDateConnexion( $sDate )
  {

    if (
      is_string($sDate) &&
      strlen($sDate) == 8 &&
      checkdate ( (int)substr($sDate, 4, 2), (int)substr($sDate, 6, 2), (int)substr($sDate, 0, 4) )
    ) {
      $this->date_connexion = $sDate;
    }

  }

  public function getDateConnexion()
  {
      return($this->date_connexion);
  }

  public function toArray()
  {
    $aReturn = [
      "email" => $this->email,
      "password_hash" => $this->password_hash,
      "date_connexion" => $this->date_connexion
    ];

    return($aReturn);
  }

}
