<?php
$_SESSION['dernierePage'] = "Reglement";
/*----------------------------------------------------------*/
/*--------Le form de reglementation-----*/
/*----------------------------------------------------------*/
$formReglement = new Formulaire("POST","index.php","formReglement","reglementthis");
$formReglement->ajouterComposantLigne($formReglement->creerLabelFor('Votre mode de paiement : ', 'lblModePaiement'));
$formReglement->ajouterComposantTab();
$formReglement->ajouterComposantTab();
$formReglement->ajouterComposantTab();
$formReglement->ajouterComposantTab();
$formReglement->ajouterComposantLigne($formReglement->concactComposants($formReglement->creerInputRadio('typeReglement','espece',"Espèces"),
                                      $formReglement->concactComposants($formReglement->creerInputLogo('imgEspece','imgEspece',"image/espece.jpeg"),
                                      $formReglement->concactComposants($formReglement->creerInputRadio('typeReglement','cheque',"Chèque"),
                                      $formReglement->concactComposants($formReglement->creerInputLogo('imgCheque','imgCheque',"image/cheque.jpeg"),
                                      $formReglement->concactComposants($formReglement->creerInputRadio('typeReglement','carteBC',"Carte Bancaire"),
                                      $formReglement->creerInputLogo('imgCarteBC','imgCarteBC',"image/carteBancaire.jpeg"),0),0),0),0),0));
$formReglement->ajouterComposantTab();
$formReglement->ajouterComposantTab();
$formReglement->ajouterComposantTab();
$formReglement->ajouterComposantLigne($formReglement->concactComposants($formReglement->creerLabelFor('Date de livraison : ', 'lblDateLivraison'),
                                      $formReglement->concactComposants($formReglement->creerSelect('jour',"unJour"),
                                      $formReglement->concactComposants($formReglement->creerSelect('mois',"unMois"),
                                      $formReglement->creerSelect("annee","uneAnnee"),0),0),0));
$formReglement->ajouterComposantTab();
$formReglement->ajouterComposantTab();
$formReglement->ajouterComposantLigne($formReglement->concactComposants($formReglement->creerLabelFor('Horraire : ', 'lblHorraireLivraison'),
                                      $formReglement->concactComposants($formReglement->creerSelect("heure","uneHeure"),
                                      $formReglement->concactComposants($formReglement->creerLabelFor(' : ', 'lblHeureLivraison'),
                                      $formReglement->concactComposants($formReglement->creerSelect("minute","uneMinute"),
                                      $formReglement->creerLabelFor('minutes', 'lblMinuteLivraison')
                                      ,0),0),0),0));
$formReglement->ajouterComposantTab();
$formReglement->ajouterComposantLigne($formReglement->creerInputSubmit('suivantReglement','suivantReglement',"Suivant"));
$formReglement->ajouterComposantTab();
$formReglement->creerFormulaire();
$_SESSION['leFormReglement'] = $formReglement->afficherFormulaire();


/*--------------------------------------------------------------------------*/
include 'vue\vueReglement.php';
 ?>
