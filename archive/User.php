<?php
require_once("PasswordGenerator.php");

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

    $passwordGenerator = new PasswordGenerator();
    $this->password = $passwordGenerator->getPassword();
    $this->password_hash = $passwordGenerator->getPasswordHash();
    unset($passwordGenerator);
  }

  public function getEmail()
  {
    return($this->email);
  }

    public function getPassword()
    {
      return($this->password);
    }

    public function getPasswordHash()
    {
        return($this->password_hash);
    }

  public function newPassword()
  {
      $passwordGenerator = new PasswordGenerator();
      $this->password = $passwordGenerator->getPassword();
      $this->password_hash = $passwordGenerator->getPasswordHash();
      unset($passwordGenerator);
  }

  public function setDateConnexion( $sDate )
  {

      // utilisation de l'operateur de transtypage (int) conversion de la valeur en integer
    if (
      is_string($sDate) &&
      strlen($sDate) == 8 &&
      checkdate( (int)substr($sDate, 4, 2), (int)substr($sDate, 6, 2), (int)substr($sDate, 0, 4) )
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
      "email"           => $this->email,
      "password"        => $this->password,
      "password_hash"   => $this->password_hash,
      "date_connexion"  => $this->date_connexion
    ];

    return($aReturn);
  }

}
