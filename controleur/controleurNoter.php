<?php

$formRecherche = new Formulaire("POST","index.php?menuPrincipal=Noter","formNoter","note");
$formRecherche->ajouterComposantLigne($formRecherche->creerA("Note sur la rapidité:"));
$formRecherche->ajouterComposantTab();
$formRecherche->ajouterComposantLigne($formRecherche->creerRange(20, 2, 'noteRapidite'));
$formRecherche->ajouterComposantTab();
$formRecherche->ajouterComposantLigne($formRecherche->creerA("Note sur la qualitee:"));
$formRecherche->ajouterComposantTab();
$formRecherche->ajouterComposantLigne($formRecherche->creerRange(20, 2, 'noteQualite'));
$formRecherche->ajouterComposantTab();
$formRecherche->ajouterComposantLigne($formRecherche->creerA("Note sur la temperature des plats:"));
$formRecherche->ajouterComposantTab();
$formRecherche->ajouterComposantLigne($formRecherche->creerRange(20, 2, 'noteTemp'));
$formRecherche->ajouterComposantTab();
$formRecherche->ajouterComposantLigne($formRecherche->creerA("Note sur le cout:"));
$formRecherche->ajouterComposantTab();
$formRecherche->ajouterComposantLigne($formRecherche->creerRange(20, 2, 'noteCout'));
$formRecherche->ajouterComposantTab();
$formRecherche->ajouterComposantLigne($formRecherche->creerA("Commentaire:"));
$formRecherche->ajouterComposantTab();
$formRecherche->ajouterComposantLigne($formRecherche->creerInputGrandTexte("commentaire", 1, 16, ""));
$formRecherche->ajouterComposantTab();
$formRecherche->ajouterComposantLigne($formRecherche->creerInputSubmit("noter-btn","noter-btn","Envoyer"));
$formRecherche->ajouterComposantTab();
$formRecherche->creerFormulaire();
include_once "vue/vueNoter.php";
 ?>
