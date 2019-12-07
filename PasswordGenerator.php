<?php
// Generation de password

class PasswordGenerator
{
    private $password;
    private $password_hash;

    // types de caracteres
    const MAJUSCULE = 0;
    const MINUSCULE = 1;
    const CHIFFRE = 2;
    const SYMBOLE = 3;

    // Structure du mot de passe a generer
    const PASSWORD_SCHEME = array(
        self::MAJUSCULE,
        self::MINUSCULE,
        self::MINUSCULE,
        self::MINUSCULE,
        self::CHIFFRE,
        self::CHIFFRE,
        self::CHIFFRE,
        self::SYMBOLE
    );

    // Liste des symboles utilisés
    const SYMBOLES = ['@', '/', '-', ':', '=', '!', '#', '+', '/', '?'];

    public function __construct()
    {
        $this->password = self::generatePassword();
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function getPassword()
    {
        return( $this->password );
    }

    public function getPasswordHash()
    {
        return( $this->password_hash );
    }

    // Generation d'un mot de passe suivant la constante PASSWORD_SCHEME
    private function generatePassword()
    {
        $sPassword = "";
        foreach(self::PASSWORD_SCHEME as $nTypeChar ) {
            switch ($nTypeChar) {
                case self::MAJUSCULE:
                    $sPassword .= self::majusculeAleatoire();
                    break;
                case self::MINUSCULE:
                    $sPassword .= self::minusculeAleatoire();
                    break;
                case self::CHIFFRE:
                    $sPassword .= self::chiffreAleatoire();
                    break;
                case self::SYMBOLE:
                    $sPassword .= self::symboleAleatoire();
                    break;
                default:
                    $sPassword .= self::symboleAleatoire();
                    break;
            }
        }

        return($sPassword);
    }

    private function majusculeAleatoire()
    {
        return( chr( ord('A') + rand(0, 25) ) );
    }

    private function minusculeAleatoire()
    {
        return( chr( ord('a') + rand(0, 25) ) );
    }

    private function chiffreAleatoire()
    {
        return( chr( ord('0') + rand(0, 9) ) );
    }

    private function symboleAleatoire()
    {
        return( self::SYMBOLES[rand(0, 9)] );
    }

}
