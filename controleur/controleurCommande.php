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
$formCommande = new Formulaire("POST","index.php","formCommande","commandethis");

/*----------------------------------------------------------*/
/*--------Création du form de confirmation avant de commander-----*/
/*----------------------------------------------------------*/
foreach ($_SESSION['listeRestos']->getLesRestos() as $OBJ)
{
  //On utilise le restaurant selectioné, la ville, le type de règlement, date et lieu de livraison
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

// On ajoute les plats du panier et le pourboir
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



/*----------------------------------------------------------*/
/*--------Ajout des informations dans la bdd (table commande et quantite) + création d'objet -----*/
/*----------------------------------------------------------*/
// Condition respectée quand on utilise le btn confirmCommande
if (isset($_POST['confirmCommande'])) {

  $txt = "<div id='fin'>Nous vous remercions de votre commande <br><br> Merci à bientôt </div>";
  $pdf = new Formulaire('post','index.php','pdf','pdf');
  $pdf->ajouterComposantLigne($pdf->creerInputSubmit('pdf','pdf','Afficher pdf'));
  $pdf->ajouterComposantLigne($pdf->creerInputSubmitHidden('confirmCommande','confirmCommande',''));
  $pdf->ajouterComposantTab();
  $lepdf = $pdf->creerFormulaireNewOnglet();
  $lepdf = $pdf->afficherFormulaire();
  $numeroCommande = 1;
  $_SESSION['listeCommande'] = new Commandes(CommandeDAO::selectListeCommande());
  // recuperer le num de la prochaine commande
  foreach ($_SESSION['listeCommande']->getLesCommandes() as $OBJ)
  {
    $idC = substr($OBJ->getidCommande(), 1) ;
    if ($numeroCommande < $idC) {
      $numeroCommande = substr($OBJ->getidCommande(), 1);
    }
  }

  $_SESSION['compteurCommande']= "C".($numeroCommande+1);
  CommandeDAO::inCommande($_SESSION['compteurCommande'], $_SESSION['RestoSelected'], $_SESSION['identite'][0],date("Y-m-d"),$_SESSION['dateLivraisonMySql'], $_SESSION['modePaiement']);
  CommandeDAO::inEvaluer($_SESSION['identite'][0],$_SESSION['RestoSelected'],$_SESSION['compteurCommande'],0,0,0,0,0,0);
  foreach ($_SESSION['lePanier']->getLesPlats() as $OBJ)
	{
    CommandeDAO::inQte($OBJ->getID(),$_SESSION['compteurCommande'],1);
  }


//   foreach ($_SESSION['lePanier']->getLesPlats() as $OBJ)
// 	{
//     $qte = 0;
//     foreach ($_SESSION['lePanier']->getLesPlats() as $OBJ2)
//   	{
//       if($OBJ == $OBJ2){
//         $qte+=1;
//       }
//       $test[] = array($OBJ->getNom() => $qte);
//
//     }
//   }
//   foreach ($test as $i => $value) {
//       foreach ($test[$i] as $j => $value) {
//         if(key($value)){
//
//         }
//           print_r($test[0]);
//           print_r("-".$value."/");
//       }
//   }
//   var_dump($test);
//

 }


/*--------------------------------------------------------------------------*/
  include 'vue/vueCommande.php' ;

?>
