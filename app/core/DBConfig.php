<?php

/* Classe DBConfig: configuration database avec un fichier JSON
*/

class DBConfig
{
    // Constantes - valeurs par défaut
    private const DBCONFIG_FILE = 'dbconfig.json';
    private const DBCONFIG_HOST = 'localhost';
    private const DBCONFIG_DBNAME = 'databasename';
    private const DBCONFIG_CHARSET = 'utf8';
    private const DBCONFIG_USER = 'user';
    private const DBCONFIG_PASSWORD = 'password';
    private const DBCONFIG_OPTIONS = array(PDO::ATTR_PERSISTENT => true);

    private const DBCONFIG_FIELDLIST = array('host', 'databasename', 'charset', 'user', 'password', 'options');

    private $dbconfig = array();

    public function __construct($sDBConfigFile = '')
    {
        global $oApp;

        if ($sDBConfigFile === '') {
            $sDBConfigFile = $oApp->base_path . self::DBCONFIG_FILE;
        } else {
            $sDBConfigFile = $oApp->base_path . $sDBConfigFile;
        }

        if (file_exists($sDBConfigFile)) {
            $this->dbconfig = $this->readJSONConfig($sDBConfigFile);
        } else {
            self::writeJSONConfigDefault($sDBConfigFile);
            throw new \Exception("DBConfig: config file not exist $sDBConfigFile", 1);
        }
    }

    private function readJSONConfig(string $sDBConfigFile)
    {
        $aReturn = array();

        $sConfig = file_get_contents($sDBConfigFile);
        $aConfigDB = json_decode($sConfig, true);

        if ( ! is_null($aConfigDB) && self::checkParameters($aConfigDB) ) {
            $aReturn = $aConfigDB;
        }

        return($aReturn);
    }

    // Verifie que les champs nécessaires sont configurés
    private function checkParameters($aConfig)
    {
        $lReturn = false;

        foreach(self::DBCONFIG_FIELDLIST as $sField) {
            if ( isset($aConfig[$sField]) ) {
                $lReturn = true;
            } else {
                throw new \Exception("DBConfig: parameter $sField is null", 1);
            }
        }

        return($lReturn);
    }

    // Ecris un fichier contenant une configuration type
    private function writeJSONConfigDefault(string $sDBConfigFile)
    {

        $aConfigDB['host'] = self::DBCONFIG_HOST;
        $aConfigDB['databasename'] = self::DBCONFIG_DBNAME;
        $aConfigDB['charset'] = self::DBCONFIG_CHARSET;
        $aConfigDB['user'] = self::DBCONFIG_USER;
        $aConfigDB['password'] = self::DBCONFIG_PASSWORD;
        $aConfigDB['options'] = self::DBCONFIG_OPTIONS;

        $sConfig = json_encode($aConfigDB,JSON_PRETTY_PRINT);
        file_put_contents($sDBConfigFile, $sConfig );
    }

    public function __get($sName)
    {
        $value = '';
        if (array_key_exists($sName, $this->dbconfig)) {
            $value = $this->dbconfig[$sName];
        } elseif ($sName === 'dsn') {
            $value = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                $this->dbconfig['host'],
                $this->dbconfig['databasename'],
                $this->dbconfig['charset']
                );
        }

        return($value);
    }

}
