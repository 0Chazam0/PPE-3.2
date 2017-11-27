<?php
$photoTravail = new Formulaire('','','formTravail','formTravail');
$photoTravail->ajouterComposantLigne($photoTravail->creerInputImageProfil('photoTravail','photoTravail',"image/travailEnCours.jpg"));
$photoTravail->ajouterComposantTab();
$photoTravail->ajouterComposantLigne($photoTravail->creerA("Désolé le site est en cours d'avancement"));
$photoTravail->ajouterComposantTab();
$photoTravail->ajouterComposantLigne($photoTravail->creerA("Retenez votre mot de passe la prochaine fois !"));
$photoTravail->ajouterComposantTab();
$LaphotoTravail = $photoTravail->creerFormulaire();
$LaphotoTravail = $photoTravail->afficherFormulaire();
include "vue/vueMdpOublie.php"; ?>
