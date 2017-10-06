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




if(isset($_GET['menuPrincipal'])){
	$_SESSION['menuPrincipal']= $_GET['menuPrincipal'];
}
else
{
	if(!isset($_SESSION['menuPrincipal'])){
		$_SESSION['menuPrincipal']="Accueil";
	}
}

$formLogo = new Formulaire("","","formLogo","logo");
$formLogo->ajouterComposantLigne($formLogo->creerInputImage("logo","logo","image\logo.jpeg"));
$formLogo->ajouterComposantTab();
$formLogo->creerFormulaire();


$menuPrincipal = new Menu("menuP");

$menuPrincipal->ajouterComposant($menuPrincipal->creerItemLien('Accueil',"Accueil"));
$menuPrincipal->ajouterComposant($menuPrincipal->creerItemLien('Connexion',"Connexion"));
$leMenuP = $menuPrincipal->creerMenu('menuPrincipal');

include_once dispatcher::dispatch($_SESSION['menuPrincipal']);

 ?>
