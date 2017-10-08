<?php

require_once 'configs/param.php';
require_once 'library/menu.php';
require_once 'library/dispatcher.php';
require_once 'library/formulaire.php';
require_once 'modele/dao.php';
require_once 'modele/DAO/select.php';
require_once 'modele/DTO/resto.php';


//session du menu
if(isset($_GET['menuPrincipal'])){
	$_SESSION['menuPrincipal']= $_GET['menuPrincipal'];
}
else
{
	if(!isset($_SESSION['menuPrincipal'])){
		$_SESSION['menuPrincipal']="accueil";
	}
}





$menuPrincipal = new Menu("menuP");

$menuPrincipal->ajouterComposant($menuPrincipal->creerItemLien('Accueil',""));
$menuPrincipal->ajouterComposant($menuPrincipal->creerItemLien('Connexion',"Connexion"));
$leMenuP = $menuPrincipal->creerMenu('menuPrincipal');

include_once dispatcher::dispatch($_SESSION['menuPrincipal']);

 ?>
