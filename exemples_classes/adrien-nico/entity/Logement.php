<?php

class Logement
{
    private $log_id;
    private $usr_id;
    private $log_nom;
    private $log_adresse;
    private $log_cp;
    private $vil_id;
    private $typ_id;

    public function __construct($iLog_id, $iUsr_id, $sLog_nom,$sLog_adresse, $iLog_cp, $iVil_id, $iTyp_id)
    {
        self::setLogId($iLog_id);
        self::setUserId($iUsr_id);
        self::setLogNom( $sLog_nom );
        self::setLogAdresse( $sLog_adresse );
        self::setLogCP( $iLog_cp );
        self::setVilleId( $iVil_id );
        self::setTypeId( $iTyp_id );

    }

    public function getLogId()
    {
        return($this->log_id);
    }
    private function setLogId($iLogId)
    {
        if ( is_int($iLogId) && $iLogId > 0 ) {
            $this->log_id = $iLogId;
        }
    }

    public function getUserId()
    {
        return($this->usr_id);
    }
    private function setUserId($iUsr_id)
    {
        if ( is_int($iUsr_id) && $iUsr_id > 0 ) {
            $this->usr_id = $iUsr_id;
        }
    }

    public function getLogNom()
    {
        return($this->log_nom);
    }
    private function setLogNom($sLog_nom)
    {
        if ( is_int($sLog_nom) && $sLog_nom > 0 ) {
            $this->log_nom = $sLog_nom;
        }
    }

    public function getLogAdresse()
    {
        return($this->log_adresse);
    }
    private function setLogAdresse($sLog_adresse)
    {
        if ( is_int($sLog_adresse) && $sLog_adresse > 0 ) {
            $this->log_adresse = $sLog_adresse;
        }
    }

    public function getLogCP()
    {
        return($this->log_cp);
    }
    private function setLogCP($iLog_cp)
    {
        if ( is_int($iLog_cp) && $iLog_cp > 0 ) {
            $this->log_cp = $iLog_cp;
        }
    }

    public function getVilleId()
    {
        return($this->vil_id);
    }
    private function setVilleId($iVil_id)
    {
        if ( is_int($iVil_id) && $iVil_id > 0 ) {
            $this->vil_id = $iVil_id;
        }
    }

    public function getTypeId()
    {
        return($this->typ_id);
    }
    private function setTypeId($iTyp_id)
    {
        if ( is_int($iTyp_id) && $iTyp_id > 0 ) {
            $this->typ_id = $iTyp_id;
        }
    }

}
