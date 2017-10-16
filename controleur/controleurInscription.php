<?php

  $formInscription = new formulaire('post','index.php','formInscription','inscription');

  $formInscription->ajouterComposantLigne($formInscription->creerInputTexte('identifiant', 'identifiant', 'Identifiant (mail) :','yolo','','saisir identifiant' ));
  $formInscription->ajouterComposantTab();
  $formInscription->creerFormulaire();

  include "vue/vueInscription.php";
 ?>
