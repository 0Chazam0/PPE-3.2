<?php
/*----------------------------------------------------------*/
/*--------Déclaration variable session----------------------*/
/*----------------------------------------------------------*/
$_SESSION['dernierePage'] = "Commande";
$_SESSION['listeRestos'] = new Restos(RestoDAO::selectListeResto());
foreach ($_SESSION['lesPlats'] as $OBJ) {
  $lesPlats[] = unserialize($OBJ);
}
$_SESSION['lePanier'] = new Plats($lesPlats);
/*----------------------------------------------------------*/
/*--------Le form de recap avant de commander-----*/
/*----------------------------------------------------------*/


$formCommande = new Formulaire("POST","index.php","formCommande","commandethis");
foreach ($_SESSION['listeRestos']->getLesRestos() as $OBJ)
{
  if ($_SESSION['RestoSelected']==$OBJ->getId()) {
    $formCommande->ajouterComposantLigne($formCommande->concactComposants($formCommande->creerLabelFor('Votre commande : ', 'lblcommande'),
                                         $formCommande->concactComposants($formCommande->creerLabelFor('Ville : ', 'lblville'),
                                         $formCommande->concactComposants($formCommande->creerLabelFor(ucfirst($_SESSION['VilleSelected']), 'laVille'),
                                         $formCommande->concactComposants($formCommande->creerLabelFor('Restaurant : ', 'lblresto'),
                                         $formCommande->creerLabelFor($OBJ->getNom(), 'leResto'),0),1),0),2));
  }
}
$formCommande->ajouterComposantTab();

$formCommande->ajouterComposantLigne($formCommande->concactComposants($formCommande->creerLabelFor('Type de règlement : ', 'lblTypeReglement'),
                                     $formCommande->creerLabelFor($_SESSION['modePaiement'], 'leReglement'),0));
$formCommande->ajouterComposantTab();

$formCommande->ajouterComposantLigne($formCommande->concactComposants($formCommande->creerLabelFor('Date de livraison : ', 'lblDateLivraison'),
                                     $formCommande->creerLabelFor($_SESSION['dateLivraison'], 'laDateLivraison'),0));
$formCommande->ajouterComposantTab();

$formCommande->ajouterComposantLigne($formCommande->concactComposants($formCommande->creerLabelFor('Lieu de livraison : ', 'lblLieuLivraison'),
                                     $formCommande->creerLabelFor($_SESSION['lieuLivraison'], 'leLieuLivraison'),0));
$formCommande->ajouterComposantTab();

$formCommande->ajouterComposantLigne($formCommande->creerLabelFor('Les plats : ', 'lesPlats'));
$formCommande->ajouterComposantTab();

foreach ($_SESSION['lePanier']->getLesPlats() as $OBJ){
  $formCommande->ajouterComposantLigne($formCommande->concactComposants($formCommande->creerLabelFor($OBJ->getNom(), 'nomPlatCommande'),
                                       $formCommande->concactComposants($formCommande->creerLabelFor('x1 : ', 'qtPlatCommande'),
                                       $formCommande->creerLabelFor($OBJ->getPrixClient()."€", 'prixPlatCommande'),0),0));
$formCommande->ajouterComposantTab();
}
$formCommande->ajouterComposantLigne($formCommande->concactComposants($formCommande->creerLabelFor('Pourboir : ', 'lblPourboirC'),
                                     $formCommande->creerLabelFor($_SESSION['prixPourboir']."€", 'lePourboir'),0));
$formCommande->ajouterComposantTab();

$formCommande->ajouterComposantLigne($formCommande->concactComposants($formCommande->creerLabelFor('Montant : ', 'lblmontant'),
                                     $formCommande->creerLabelFor($_SESSION['prixTotal']+$_SESSION['prixPourboir']."€", 'leMontant'),0));
$formCommande->ajouterComposantTab();

$formCommande->ajouterComposantLigne($formCommande->creerInputSubmit('confirmCommande','confirmCommande',"Confirmer la commande"));
$formCommande->ajouterComposantTab()
;
$formCommande->creerFormulaire();
$_SESSION['leformCommande'] = $formCommande->afficherFormulaire();




if (isset($_POST['confirmCommande'])) {
  $txt = "<div id='fin'>Nous vous remercions de votre commande <br><br> Merci à bientôt </div>";

  inCommande(4, $_SESSION['RestoSelected'], $_SESSION['identite'][0],date("Y-m-d"),$_SESSION['dateLivraisonMySql'], $_SESSION['modePaiement']);

}
/*--------------------------------------------------------------------------*/
  include 'vue/vueCommande.php' ;

?>
