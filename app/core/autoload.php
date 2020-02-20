<?php
// autoloader des classes
// Remarquer que l'autoloader utilise une fonction anomyme
// voir documentation https://www.php.net/manual/en/language.oop5.autoload.php

define('DIRECTORY_LIST', [
  'app/core',
  'app/controller',
  'app/model',
  'app/view'
  ] );

spl_autoload_register( function ($sClassname) {
    global $sBasepath;

    if (!isset($sBasepath)) {
        throw new \Exception("Autoload: global \$sBasepath not defined", 1);
    }

    // Liste des dossiers où sont stockées les classes
    $aDirectoryList = [
        'app/core',
        'app/controller',
        'app/model',
        'app/view'
        ];
    $nIndexMax = count($aDirectoryList);

    $lLoaded = false;
    $nIndex = 0;
    while (!$lLoaded && ($nIndex<$nIndexMax)) {

        $sFile = $sBasepath. $aDirectoryList[$nIndex].'/'.$sClassname.'.php';
        if (file_exists($sFile)) {
            // Class file found
            $lLoaded = true;
            require_once($sFile);
        }

        $nIndex++;
    }
    if (! $lLoaded) {
        throw new \Exception("Autoload:( Unable to load class " . $sClassname, 1);
    }

} );
