<?php 

class Validate
{

    public static function email($sEmail)
    {
        $lReturn = false;
        if ( filter_var($sEmail, FILTER_VALIDATE_EMAIL) !== false ) {
          $lReturn = true;
        }
  
        return($lReturn);
    }
  
    public static function checkstring($sString)
    {
        $lReturn = false;
        if ( is_string($sString) && !empty($sString) ) {
          $lReturn = true;
        }
  
        return($lReturn);
    }
  
    public static function alwaysTrue($value)
    {
        return(true);
    }
  
    public static function id($iId)
    {
        $lReturn = false;
  
        if ( is_int($iId) && $iId > 0 ) {
          $lReturn = true;
        }
  
        return($lReturn);
    }
 
    public static function dateString($sDate)
    {
        $lReturn = false;
        // utilisation de l'operateur de transtypage (int) conversion de la valeur en integer
        if (
            is_string($sDate) &&
            strlen($sDate) == 8 &&
            checkdate ( (int)substr($sDate, 4, 2), (int)substr($sDate, 6, 2), (int)substr($sDate, 0, 4) )
              ) {
              $lReturn = true;
          }
      
        return($lReturn);
    }
      
    public static function role($sRole)
    {
      $lReturn = false;
      if (
        Validate::checkstring($sRole) &&
        in_array( $sRole, ["user","admin"] )
        ) {
          $lReturn = true;
      }
  
      return($lReturn);
    }
  
  
}