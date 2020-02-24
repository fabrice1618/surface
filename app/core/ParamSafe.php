<?php

class ParamSafe
{

    /*
    Lit une valeur dans $_SESSION et la valide avec $sValidateFunction
    Si la valeur n'est pas définie affecter $default_value
    Si la valeur n'est pas valide declenche une exception
    */
    public static function readSession($sKey, $sValidateFunction, $default_value )
    {
        if ( ! isset($_SESSION[$sKey]) ) {
            $_SESSION[$sKey] = $default_value;
        }

        $value = $_SESSION[$sKey];
        if ( ! $sValidateFunction($value) ) {
            throw new Exception(__CLASS__.":".__METHOD__.": Value ($value) is not valid");
        }

        return( $value );
    }

        /*
    Lit une valeur dans $_POST et la valide avec $sValidateFunction
    Si la valeur n'est pas définie affecter $default_value
    Si la valeur n'est pas valide declenche une exception
    */
    public static function readPost($sKey, $sValidateFunction, $default_value )
    {
        if ( ! isset($_POST[$sKey]) ) {
            $value = $default_value;
        } else {
            $value = $_POST[$sKey];
            if ( ! $sValidateFunction($value) ) {
                throw new Exception(__CLASS__.":".__METHOD__." Value ($value) is not valid");
            }
        }

        return( $value );
    }

}