<?php
$formRecherche = new Formulaire("POST","index.php?menuPrincipal=Noter","formNoter","note");
$formRecherche->ajouterComposantLigne($formRecherche->creerInputGrandTexte("descrip", 8, 40, ""));
$formRecherche->ajouterComposantTab();
$formRecherche->creerFormulaire();

include_once "vue/vueNoter.php";
 ?>
