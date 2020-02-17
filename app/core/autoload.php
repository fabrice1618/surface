<?php
// autoloader des classes
// Remarquer que l'autoloader utilise une fonction anomyme
// voir documentation https://www.php.net/manual/en/language.oop5.autoload.php

// Liste des dossiers où sont stockées les classes
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

    $lLoaded = false;

    $nIndex = 0;
    $nIndexMax = count(DIRECTORY_LIST);
    while (!$lLoaded && ($nIndex<$nIndexMax)) {

        $sDir = $sBasepath. DIRECTORY_LIST[$nIndex];
        $sFile = $sDir.'/'.$sClassname.'.php';
//        echo "autoload: $sFile\n";
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
