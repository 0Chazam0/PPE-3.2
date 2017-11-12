<?php
if (isset($_POST['deco'])) {
	session_destroy();
	session_start();
}


/*----------------------------------------------------------*/
/*--------inclut les fichiers suivant une seule fois sans erreur----------*/
/*----------------------------------------------------------*/
require_once 'configs/param.php';
require_once 'library/menu.php';
require_once 'library/dispatcher.php';
require_once 'library/formulaire.php';
require_once 'modele/dao.php';


/*----------------------------------------------------------*/
/*--------inclut les fichiers DTO----------*/
/*----------------------------------------------------------*/
require_once 'modele/DTO/resto.php';
require_once 'modele/DTO/typeResto.php';
require_once 'modele/DTO/ville.php';
require_once 'modele/DTO/typePlat.php';
require_once 'modele/DTO/plat.php';
require_once 'modele/DTO/user.php';

/*----------------------------------------------------------*/
/*--------session du menu principal avec accueil par defaut----------------------*/
/*----------------------------------------------------------*/
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


/*----------------------------------------------------------*/
/*--------Récupère le controleur Inscription (si la condition est respectée)----------*/
/*----------------------------------------------------------*/
if (isset($_POST['inscr'])) {
	$_SESSION['menuPrincipal'] = 'Inscription';
}

/*----------------------------------------------------------*/
/*--------Récupère le controleur Resto et la ville choisit (si la condition est respectée)----------*/
/*----------------------------------------------------------*/
if (isset($_POST['search']) && $_POST['search']!=null) {
	$_SESSION['VilleSelected'] = strtolower($_POST['search']);
	$_SESSION['menuPrincipal'] = 'Resto';
}
/*----------------------------------------------------------*/
/*--------Récupère le controleur Plat (si la condition est respectée)----------*/
/*----------------------------------------------------------*/

if (isset($_POST['idResto'])){
	$_SESSION['RestoSelected'] = $_POST['idResto'];
	$_SESSION['menuPrincipal']="Plat";
}
/*----------------------------------------------------------*/
/*--------Récupère le controleur Reglement (si la condition est respectée) et si on est connecté----------*/
/*----------------------------------------------------------*/
if (isset($_POST['validerCommande'])){
	if (!isset($_SESSION['identite'])) {
		$_SESSION['menuPrincipal']= 'Connexion';
	}
	else{
		$_SESSION['lieuLivraison']= $_SESSION['identite'][5];
		$_SESSION['menuPrincipal']="Reglement";
	}

}
/*----------------------------------------------------------*/
/*--------Récupère le controleur Commande (si la condition est respectée)----------*/
/*----------------------------------------------------------*/
if (isset($_POST['suivantReglement'])){
	$_SESSION['modePaiement']= $_POST['typeReglement'];
	$_SESSION['dateLivraison']= $_POST['unJour']."/".$_POST['unMois']."/".$_POST['uneAnnee']." à ".$_POST['uneHeure']."h".$_POST['uneMinute'];
	$_SESSION['dateLivraisonMySql'] = $_POST['uneAnnee']."-".$_POST['unMois']."-".$_POST['unJour'];
	$_SESSION['menuPrincipal']="Commande";
}

/*----------------------------------------------------------*/
/*-------Affiche le controleur récupéré----------*/
/*----------------------------------------------------------*/
include_once dispatcher::dispatch($_SESSION['menuPrincipal']);

 ?>
