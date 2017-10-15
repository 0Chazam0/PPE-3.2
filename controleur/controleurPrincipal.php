<?php
if (isset($_POST['deco'])) {
	session_destroy();
	session_start();
}
require_once 'configs/param.php';
require_once 'library/menu.php';
require_once 'library/dispatcher.php';
require_once 'library/formulaire.php';
require_once 'modele/dao.php';
require_once 'modele/DAO/select.php';
require_once 'modele/DTO/resto.php';
require_once 'modele/DTO/ville.php';
require_once 'modele/DTO/typePlat.php';
require_once 'modele/DTO/plat.php';

//session du menu
if(isset($_GET['menuPrincipal'])){
	$_SESSION['menuPrincipal']= $_GET['menuPrincipal'];
}
else
{
	if(!isset($_SESSION['menuPrincipal'])){
		$_SESSION['menuPrincipal']="Accueil";
	}

}

$menuPrincipal = new Menu("menuP");


if (!isset($_SESSION['identite'])) {
	$menuPrincipal->ajouterComposant($menuPrincipal->creerItemLien('Connexion',"Connexion"));
}
else {
$menuPrincipal->ajouterComposant($menuPrincipal->creerItemLien('InfoClient',"Bienvenue : " . $_SESSION['identite'][2]));
}

$leMenuP = $menuPrincipal->creerMenu('menuPrincipal');

include_once dispatcher::dispatch($_SESSION['menuPrincipal']);






 ?>
