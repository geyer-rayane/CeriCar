<?php
//nom de l'application
$nameApp = "monApplication";

//action par dé"faut
$action = "index";

if(key_exists("action", $_REQUEST))
	$action =  $_REQUEST['action'];

require_once 'lib/core.php';
require_once $nameApp.'/controller/mainController.php';

foreach(glob($nameApp.'/model/*.class.php') as $model)
	include_once $model ;   



session_start();

if(isset($_POST['idVoyage']) && $_POST['action'] === 'resultatReservation') 
{
    $_SESSION['idVoyage'] = $_POST['idVoyage'];
}

if(isset($_POST['identifiantInscription']) && $_POST['action'] === 'resultatInscription') 
{
    $_SESSION['identifiantInscription'] = $_POST['identifiantInscription']; 
}

if(isset($_POST['identifiant']) && $_POST['action'] === 'resultatConnexion') 
{
    $_SESSION['identifiant'] = $_POST['identifiant']; 
}

/* Variable de session pour ajouter le bon nombre de reservation */
if(isset($_POST['nbrePlaces']) && $_POST['action'] === 'resultatReservation') 
{
    $_SESSION['nbrePlaces'] = $_POST['nbrePlaces']; 
}

/* Variable de session pour retenir l'id de reservation a supprimer */
if(isset($_POST['idReservation']) && $_POST['action'] === 'afficherProfil') 
{
    $_SESSION['idReservation'] = $_POST['idReservation']; 
	afficherProfil($request,$context) ;
}


$context = context::getInstance();
$context->init($nameApp);

$view=$context->executeAction($action, $_REQUEST);

//traitement des erreurs de bases, reste a traiter les erreurs d'inclusion
if($view===false)
{
	echo "Une grave erreur s'est produite, il est probable que l'action ".$action." n'existe pas...";
	die;
}

//Modification pour retourner la vue
$template_view=$nameApp."/view/".$action.$view.".php";
include($template_view);

?>
