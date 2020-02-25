<?php
$sBasepath = isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] . '/' : '../';
require_once($sBasepath . "app/core/autoload.php");

session_start();
$oApp = new App();
$oApp->openDatabase();

//  Routeur

//echo "sRequestURI:$oApp->request_uri\n";
//echo "sRequestQuery:$oApp->request_query\n";


switch ($oApp->request_uri) {
    case '/affichage':
        $sControllerName = 'ScreenerController';
        break;
    case '/connexion':
    case '/checklogin':
    case '/forgotpasswd':
    case '/newpasswd':
    case '/logout':
        $sControllerName = 'LoginController';
        break;
    case '/inscription':
    case '/inscription-save':
        $sControllerName = 'InscriptionController';
        break;
    case '/tranche':
    case '/tranche-add':
    case '/tranche-edit':
    case '/tranche-delete':
    case '/tranche-save':
        $sControllerName = 'TrancheController';
        break;
    case '/typesalle':
    case '/typesalle-add':
    case '/typesalle-edit':
    case '/typesalle-delete':
    case '/typesalle-save':
        $sControllerName = 'TypeSalleController';
        break;
    case '/secteur':
    case '/secteur-add':
    case '/secteur-edit':
    case '/secteur-delete':
    case '/secteur-save':
        $sControllerName = 'SecteurController';
        break;
    case '/message':
    case '/message-add':
    case '/message-edit':
    case '/message-delete':
    case '/message-save':
        $sControllerName = 'MessageController';
        break;
    case '/filliere':
    case '/filliere-add':
    case '/filliere-edit':
    case '/filliere-delete':
    case '/filliere-save':
        $sControllerName = 'FilliereController';
        break;
    case '/occupation':
    case '/occupation-add':
    case '/occupation-edit':
    case '/occupation-delete':
    case '/occupation-save':
        $sControllerName = 'OccupationController';
        break;
    case '/salle':
    case '/salle-add':
    case '/salle-edit':
    case '/salle-delete':
    case '/salle-save':
        $sControllerName = 'SalleController';
        break;
    case '/contact':
        $sControllerName = 'ContactController';
        break;
    case '/eco':
        $sControllerName = 'EcoController';
        break;
    case '/rgpd':
        $sControllerName = 'RgpdController';
        break;

    default:
        $sControllerName = 'HomeController';
        break;
}

// transfert du controle au controller
$oController = new $sControllerName();
$oController->run();





?>
