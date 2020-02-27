<?php
if ( !isset($_SERVER['DOCUMENT_ROOT'])) {
    throw new \Exception("Fatal error: This application must be run in a web environnement.", 1);
}
// Chemin de la base de l'application avec un slash final
$sBasepath=$_SERVER['DOCUMENT_ROOT'].'/';
require_once($sBasepath."core/autoload.php");

session_start();
$oRouter = new Router();
$oApp = new App();
// Gestion de la session
$oApp->user_session = new UserSession();
$oApp->app_root_url = "/logement";

//  Routeur
// Ajout des routes (request_path, controller, action)
$oRouter->addCoreRoutes();
$oRouter->addRoute('/',                    'HomeController',           'home');
$oRouter->addRoute('/logement',            'LogementController',       'logement');
$oRouter->addRoute('/logement-add',        'LogementController',       'logement-add');
$oRouter->addRoute('/logement-edit',       'LogementController',       'logement-edit');
$oRouter->addRoute('/logement-delete',     'LogementController',       'logement-delete');
$oRouter->addRoute('/logement-save',       'LogementController',       'logement-save');
$oRouter->addRoute('/piece',               'PieceController',          'piece');
$oRouter->addRoute('/piece-add',           'PieceController',          'piece-add');
$oRouter->addRoute('/piece-edit',          'PieceController',          'piece-edit');
$oRouter->addRoute('/piece-delete',        'PieceController',          'piece-delete');
$oRouter->addRoute('/piece-save',          'PieceController',          'piece-save');
$oRouter->addRoute('/contact',             'ContactController',        'contact');
$oRouter->addRoute('/eco',                 'EcoController',            'eco');
$oRouter->addRoute('/rgpd',                'RgpdController',           'rgpd');

// Recherche de la route dans request_path et initialise controller_name et controller_action
$oRouter->matchRoute();

// Initialise le controller et execute l'action
$oApp->runController($oRouter->controller_name, $oRouter->controller_action);

if ($oApp->exit_code === App::EXIT_REDIRECT) {
    header( "Location: http://".$_SERVER['HTTP_HOST'].$oApp->redirect_path );
    }

