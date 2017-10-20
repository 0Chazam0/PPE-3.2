<?php

$formRecherche = new Formulaire("POST","index.php?menuPrincipal=Noter","formNoter","note");

$formRecherche->creerFormulaire();
include_once "vue/vueNoter.php";
 ?>
