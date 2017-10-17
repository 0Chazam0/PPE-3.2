<?php

if (isset($_POST['inscrIdentifiant'])
		&& isset($_POST['inscrNom'])
		&& isset($_POST['inscrPrenom'])
		&& isset($_POST['inscrAdresse'])
		&& isset($_POST['inscrmdp'])
		&& isset($_POST['inscrmdpconf'])) {
	if ($_POST['inscrmdp'] == $_POST['inscrmdpconf']) {
		$id = UserDAO::definirIDU();
		$id = $id[0] + 1;
		$leNewClient = new User($id,$_POST['inscrNom'],$_POST['inscrPrenom'],$_POST['inscrIdentifiant'],$_POST['inscrmdp'],$_POST['inscrAdresse'],'Client');
		UserDAO::ajouterUnClient($leNewClient);
    $_SESSION['menuPrincipal']="Accueil";
    dispatcher::dispatch($_SESSION['menuPrincipal']);
	}
}

  $formInscription = new formulaire('post','index.php','formInscription','inscription');

  $formInscription->ajouterComposantLigne($formInscription->creerInputTexte('inscrIdentifiant', 'inscrIdentifiant', '','','','saisir votre mail' ));
  $formInscription->ajouterComposantTab();
  $formInscription->ajouterComposantLigne($formInscription->creerInputTexte('inscrNom', 'inscrNom', '','','','saisir votre nom' ));
  $formInscription->ajouterComposantTab();
  $formInscription->ajouterComposantLigne($formInscription->creerInputTexte('inscrPrenom', 'inscrPrenom', '','','','saisir votre prénom' ));
  $formInscription->ajouterComposantTab();
  $formInscription->ajouterComposantLigne($formInscription->creerInputTexte('inscrAdresse', 'inscrAdresse', '','','','saisir votre adresse' ));
  $formInscription->ajouterComposantTab();
  $formInscription->ajouterComposantLigne($formInscription->creerInputPassword('inscrmdp', 'inscrmdp', '','','','saisir votre mot de passe' ));
  $formInscription->ajouterComposantTab();
  $formInscription->ajouterComposantLigne($formInscription->creerInputPassword('inscrmdpconf', 'inscrmdpconf', '','','','confirmer votre mot de passe' ));
  $formInscription->ajouterComposantTab();
  $formInscription->ajouterComposantLigne($formInscription->creerInputSubmit('inscrValid', 'inscrValid', "Valider inscription"));
  $formInscription->ajouterComposantTab();
  $formInscription->creerFormulaire();

  include "vue/vueInscription.php";
 ?>
