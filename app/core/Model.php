<?php

class Model
{
  protected $field_list = ['example_field'=>'validate_function'];

  protected $data = null;

  protected $dbh;

  public function __construct()
  {
      global $oApp;

      $this->dbh = $oApp->database;
  }

  public function __set($sName, $value)
  {
      if (! array_key_exists($sName, $this->field_list)) {
          throw new \Exception("User: error property $sName not found", 1);
      }
      $sValidator = $this->field_list[$sName];
      if (empty($sValidator) ) {
          $this->data[$sName] = $value;
      } else {
          if ( $sValidator($value) ) {
              $this->data[$sName] = $value;
          } else {
              throw new \Exception("User: error property $sName incorrect value $value", 1);
          }
      }
  }

  public function __get($sName)
  {
      if (! array_key_exists($sName, $this->field_list )) {
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

}
