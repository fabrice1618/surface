<?php
class Piece
{
    private $log_id;
    private $nom;
    private $longueur;
    private $largeur;
    public function __construct( $iLogId, $sNom, $nLongueur, $nLargeur )
    {
        self::setLogId($iLogId);
        self::setNom($sNom);
        self::setLongueur( $nLongueur );
        self::setLargeur( $nLargeur );
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
    public function getNom()
    {
        return($this->nom);
    }
    public function setNom($sNom)
    {
        if ( is_string($sNom) && !empty($sNom) ) {
            $this->nom = $sNom;
        }
    }
    public function getLongueur()
    {
        return($this->longueur);
    }
    public function setLongueur( $nLongueur )
    {
        if ( is_numeric($nLongueur) && $nLongueur < 20 && $nLongueur > 0 ) {
            $this->longueur = $nLongueur;
        }
    }
    public function getLargeur()
    {
        return($this->largeur);
    }
    public function setLargeur( $nLargeur )
    {
        if ( is_numeric($nLargeur) && $nLargeur < 20 && $nLargeur > 0 ) {
            $this->largeur = $nLargeur;
        }
    }
    public function getSurface()
    {
        $surface = $this->longueur * $this->largeur;
        return($surface);
    }
}
