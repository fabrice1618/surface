<?php

class TypeLogement
{
    private $id;
    private $TypDesc;

    public function __construct( $iId, $sTypDesc )
    {
        self::setiId($iId);
        self::setDesc($sTypDesc);

    }
    public function getTypId()
    {
        return($this->id);
    }
    private function setTypId($iId)
    {
        if ( is_int($iId) && $iId > 0 ) {
            $this->id = $iId;
        }
    }
    public function getDesc()
    {
        return($this->TypDesc);
    }
    public function setDesc($sTypDesc)
    {
        if ( is_string($sTypDesc) && !empty($sTypDesc) ) {
            $this->TypDesc = $sTypDesc;
        }
    }
}
