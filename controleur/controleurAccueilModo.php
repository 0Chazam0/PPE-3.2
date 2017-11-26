<?php

$listeUser = AccueilModoDAO::selectUser();
$formUser = new Formulaire("POST","index.php?menuPrincipal=AccueilModo",
"formUser","user");
$formUser->ajouterComposantLigne($formUser->creerDebutTabl());
$formUser->ajouterComposantTab();
foreach ($listeUser as $unUser) {
  $id = $unUser->getID();
  $nom = $unUser->getNom();
  $prenom = $unUser->getPrenom();
  $formUser->ajouterComposantLigne($formUser->creerTabl($id, $nom, $prenom));
  $formUser->ajouterComposantTab();
}
$formUser->ajouterComposantLigne($formUser->creerFinTabl());
$formUser->ajouterComposantTab();
$formUser->creerFormulaire();

require_once 'vue/vueAccueilModo.php';

?>
