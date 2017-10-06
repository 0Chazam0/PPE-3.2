<?php

require_once 'configs/param.php';
require_once 'library/menu.php';
require_once 'library/dispatcher.php';
require_once 'library/formulaire.php';
require_once 'modele/dao.php';

if (isset($_POST['deco'])) {
 session_destroy();
 session_start();
}

//session du menu
	if(isset($_GET['menuPrincipal'])){
		$_SESSION['menuPrincipal']= $_GET['menuPrincipal'];
	}
	else{
		if(!isset($_SESSION['menuPrincipal'])){
			$_SESSION['menuPrincipal']="E1";
		}
 	}




$menuPrincipal = new Menu("menuP");

$menuPrincipal->ajouterComposant($menuPrincipal->creerItemLien('E1',"Livraison Bordeaux"));
$menuPrincipal->ajouterComposant($menuPrincipal->creerItemLien('E2',"Spécialités"));
$menuPrincipal->ajouterComposant($menuPrincipal->creerItemLien('E3',"Votre Restaurant"));
$menuPrincipal->ajouterComposant($menuPrincipal->creerItemLien('E4',"Coordonnées et Paiement"));
$menuPrincipal->ajouterComposant($menuPrincipal->creerItemLien('E5',"Confirmation"));
$menuPrincipal->ajouterComposant($menuPrincipal->creerItemLien('Connexion',"Connexion"));
$leMenuP = $menuPrincipal->creerMenu('menuPrincipal');

include_once dispatcher::dispatch($_SESSION['menuPrincipal']);

 ?>
