<?php

class Model
{
  protected const FIELD_LIST = ['example_field'=>'validate_function'];

  protected $data = null;

  protected $dbh;

  public function __construct()
  {
      global $oApp;

      $this->dbh = $oApp->database;
  }

  public function __set($sName, $value)
  {
      if (! array_key_exists($sName, self::FIELD_LIST)) {
          throw new \Exception("User: error property $sName not found", 1);
      }
      $sValidator = self::FIELD_LIST[$sName];
      if (empty($sValidator) ) {
          $this->data[$sName] = $value;
      } else {
          if ( $this->$sValidator($value) ) {
              $this->data[$sName] = $value;
          } else {
              throw new \Exception("User: error property $sName incorrect value $value", 1);
          }
      }

  }

  public function __get($sName)
  {
      if (! array_key_exists($sName, self::FIELD_LIST )) {
          throw new \Exception("User: undefined property $sName", 1);
      }
      if (! array_key_exists($sName, $this->data)) {
        $this->data[$sName] = null;
    }

      return($this->data[$sName]);
  }

  public function toArray()
  {
    return($this->data);
  }

  public function validateString($sString)
  {
      $lReturn = false;
      if ( is_string($sString) && !empty($sString) ) {
        $lReturn = true;
      }

      return($lReturn);
  }

  public function alwaysTrue($value)
  {
      return($true);
  }

  private function validateId($iId)
  {
      $lReturn = false;

      if ( is_int($iId) && $iId > 0 ) {
        $lReturn = true;
      }

      return($lReturn);
  }


}
