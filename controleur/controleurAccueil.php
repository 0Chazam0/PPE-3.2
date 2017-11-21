<?php
/*----------------------------------------------------------*/
/*--------Déclaration variable session----------------------*/
/*----------------------------------------------------------*/
$_SESSION['dernierePage'] = "Accueil";
/*----------------------------------------------------------*/
/*--------Le form de l'accueil avec un champs de recherche et bouton-----*/
/*----------------------------------------------------------*/
$formRecherche = new Formulaire("POST","index.php","formRecherche","searchthis");
$formRecherche->ajouterComposantLigne($formRecherche->creerInputTexte("search","search","","",1,"Entrez votre ville"));
$formRecherche->ajouterComposantLigne($formRecherche->creerInputSubmit("search-btn","search-btn","Rechercher"));
$formRecherche->ajouterComposantTab();
$formRecherche->creerFormulaire();



/*--------------------------------------------------------------------------*/
include "vue/vueAccueil.php";
 ?>
