<?php

if (isset($_POST['inscrIdentifiant'])
		&& isset($_POST['inscrNom'])
		&& isset($_POST['inscrPrenom'])
		&& isset($_POST['inscrAdresse'])
		&& isset($_POST['inscrmdp'])
		&& isset($_POST['inscrmdpconf'])){
	if ($_POST['inscrmdp'] == $_POST['inscrmdpconf']) {
		$id = UserDAO::definirIDU();
		$idU = "U" ;
		$idU.= $id[0] + 1;
		$leNewClient = new User($idU,$_POST['inscrNom'],$_POST['inscrPrenom'],$_POST['inscrIdentifiant'],$_POST['inscrmdp'],$_POST['inscrAdresse'],'Client');
		UserDAO::ajouterUnClient($leNewClient);
    $_SESSION['menuPrincipal']="Accueil";
	}
}
include_once dispatcher::dispatch($_SESSION['menuPrincipal']);
if (isset($_POST['inscrIdentifiant'])) {
	$inscrIdentifiant = $_POST['inscrIdentifiant'];
}
else {
	$inscrIdentifiant = '';
}
if (isset($_POST['inscrNom'])) {
	$inscrNom = $_POST['inscrNom'];
}
else {
	$inscrNom = '';
}
if (isset($_POST['inscrPrenom'])) {
	$inscrPrenom = $_POST['inscrPrenom'];
}
else {
	$inscrPrenom = '';
}
if (isset($_POST['inscrAdresse'])) {
	$inscrAdresse = $_POST['inscrAdresse'];
}
else {
	$inscrAdresse = '';
}
  $formInscription = new formulaire('post','index.php','formInscription','inscription');
  $formInscription->ajouterComposantLigne($formInscription->creerInputTextePattern('inscrIdentifiant', 'inscrIdentifiant', '',$inscrIdentifiant,1,'saisir votre mail','[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})' ));
  $formInscription->ajouterComposantTab();
  $formInscription->ajouterComposantLigne($formInscription->creerInputTextePattern('inscrNom', 'inscrNom', '',$inscrNom,1,'saisir votre nom','[a-zA-ZÀ-ÿ]{3,15}'));
  $formInscription->ajouterComposantTab();
  $formInscription->ajouterComposantLigne($formInscription->creerInputTextePattern('inscrPrenom', 'inscrPrenom', '',$inscrPrenom,1,'saisir votre prénom','[a-zA-ZÀ-ÿ]{3,15}'));
  $formInscription->ajouterComposantTab();
  $formInscription->ajouterComposantLigne($formInscription->creerInputTextePattern('inscrAdresse', 'inscrAdresse', '',$inscrAdresse,1,'saisir votre adresse','[a-zA-Z0-9]{5,20}'));
  $formInscription->ajouterComposantTab();
  $formInscription->ajouterComposantLigne($formInscription->creerInputPassPattern('inscrmdp', 'inscrmdp', '','',1,'saisir votre mot de passe', '[a-zA-Z0-9]{6,20}' ));
  $formInscription->ajouterComposantTab();
  $formInscription->ajouterComposantLigne($formInscription->creerInputPassPattern('inscrmdpconf', 'inscrmdpconf', '','',1,'confirmer votre mot de passe','[a-zA-Z0-9]{6,20}' ));
  $formInscription->ajouterComposantTab();
  $formInscription->ajouterComposantLigne($formInscription->creerInputSubmit('inscrValid', 'inscrValid', "Valider inscription"));
  $formInscription->ajouterComposantTab();
  $formInscription->creerFormulaire();

  include "vue/vueInscription.php";
 ?>
