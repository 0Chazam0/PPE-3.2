<?php
$formChange = new Formulaire('post','index.php','formChange','formChange');
$formChange->ajouterComposantLigne($formChange->creerInputPassPattern('inscrmdpPrec', 'inscrmdpPrec', '','',1,'saisir précédent mot de passe', '[a-zA-Z0-9]{6,20}' ));
$formChange->ajouterComposantTab();
$formChange->ajouterComposantLigne($formChange->creerInputPassPattern('inscrmdp', 'inscrmdp', '','',1,'saisir votre nouveau mot de passe', '[a-zA-Z0-9]{6,20}' ));
$formChange->ajouterComposantTab();
$formChange->ajouterComposantLigne($formChange->creerInputPassPattern('inscrmdpconf', 'inscrmdpconf', '','',1,'confirmer votre nouveau mot de passe','[a-zA-Z0-9]{6,20}' ));
$formChange->ajouterComposantTab();
$formChange->ajouterComposantLigne($formChange->creerInputSubmit('inscrValid', 'inscrValid', "Valider inscription"));
$formChange->ajouterComposantTab();
$formChange->creerFormulaire();
include "vue/vueMdpChange.php"; ?>
