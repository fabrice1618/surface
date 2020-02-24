<?php 

class Validate
{

    public static function email($param)
    {
        if ( filter_var($param, FILTER_VALIDATE_EMAIL) === false ) {
          throw new Exception(__CLASS__.": email not valid ($param) ");
        }
        return(true);
    }
  
    public static function checkstring($param)
    {
      if (! is_string($param) ) {
        throw new Exception(__CLASS__.": string not valid ($param) ");
      }
      return( true );
    }

    public static function checkbool($param)
    {
      if (! is_bool($param) ) {
        throw new Exception(__CLASS__.": boolean not valid ($param) ");
      }
      return( true );
    }

    public static function checkint($param)
    {
      if (! is_int($param) ) {
        throw new Exception(__CLASS__.": integer not valid ($param) ");
      }
      return( true );
    }
    
    public static function alwaysTrue($param)
    {
      return(true);
    }
  
    public static function id($param)
    {
      if (! is_int($param) || ( $param < 0 ) ) {
        throw new Exception(__CLASS__.": id not valid ($param) ");
      }
      return( true );
    }
 
    public static function dateString($param)
    {
        // utilisation de l'operateur de transtypage (int) conversion de la valeur en integer
        if (
            ! is_string($param) ||
            strlen($param) !== 8 ||
            ! checkdate ( (int)substr($param, 4, 2), (int)substr($param, 6, 2), (int)substr($param, 0, 4) )
              ) {

          throw new Exception(__CLASS__.": dateString not valid ($param) ");
          }
      
        return(true);
    }
      
    public static function role($param)
    {
      if (
        ! Validate::checkstring($param) ||
        ! in_array( $param, ["user","admin", "devops"] )
        ) {
          throw new Exception(__CLASS__.": role not valid ($param) ");
      }
      return(true);
    }
  
  
}