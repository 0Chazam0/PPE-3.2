<?php
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
                                      $formReglement->concactComposants($formReglement->creerInputCbx('jour'),
                                      $formReglement->concactComposants($formReglement->creerInputCbx('mois'),
                                      $formReglement->creerInputCbx("annee"),0),0),0));
$formReglement->ajouterComposantTab();
$formReglement->ajouterComposantTab();
$formReglement->ajouterComposantLigne($formReglement->concactComposants($formReglement->creerLabelFor('Horraire : ', 'lblHorraireLivraison'),
                                      $formReglement->concactComposants($formReglement->creerInputCbx("heure"),
                                      $formReglement->concactComposants($formReglement->creerLabelFor(' : ', 'lblHeureLivraison'),
                                      $formReglement->concactComposants($formReglement->creerInputCbx("minute"),
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
