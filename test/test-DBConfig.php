<?php
$sBasepath = "../";
require_once($sBasepath."app/core/autoload.php");

//print_r($_SERVER);

echo App::$base_path;

$oDBConfig = new DBConfig();

echo $oDBConfig->host, ' ',$oDBConfig->dsn, ' ',$oDBConfig->user;
