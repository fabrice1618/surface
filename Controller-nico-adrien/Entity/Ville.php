<?php

class Ville
{
    private $id;
    private $VilDesc;

    public function __construct( $iId, $sVilDesc )
    {
        self::setiId($iId);
        self::setDesc($sVilDesc);

    }
    public function getVilleId()
    {
        return($this->id);
    }
    private function setLogId($iId)
    {
        if ( is_int($iId) && $iId > 0 ) {
            $this->id = $iId;
        }
    }
    public function getDesc()
    {
        return($this->VilDesc);
    }
    public function setNom($sVilDesc)
    {
        if ( is_string($sVilDesc) && !empty($sVilDesc) ) {
            $this->VilDesc = $sVilDesc;
        }
    }
}
