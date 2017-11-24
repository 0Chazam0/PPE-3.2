
<?php
/*----------------------------------------------------------*/
/*--------Déclaration variable session----------------------*/
/*----------------------------------------------------------*/
$_SESSION['dernierePage'] = "Plat";
$_SESSION['listeTypePlats'] = new TypePlats(TypePlatDAO::selectListeTypePlat());
$_SESSION['listePlats'] = new Plats(PlatDAO::selectListePlat());
$_SESSION['listeRestos'] = new Restos(RestoDAO::selectListeResto());
$_SESSION['listeTypeRestos'] = new TypeRestos(TypeRestoDAO::selectListeTypeResto());
$_SESSION['lesFormsPlat'] = null;
$_SESSION['nbPlatResto'] = 1;
$_SESSION['prixTotal'] = 0;
if(!isset($_SESSION['nbPlatPanier'])){
$_SESSION['nbPlatPanier']= 0;
}

if(!isset($_SESSION['prixPourboir'])){
	$_SESSION['prixPourboir'] = 0;
}
/*----------------------------------------------------------*/
/*--------Affichage  des plats selon leur type selectionné-----*/
/*----------------------------------------------------------*/
if(isset($_GET['TypePlat'])){
	$_SESSION['TypePlat']= $_GET['TypePlat'];
}
else
{
	if(!isset($_SESSION['TypePlat'])){
		$_SESSION['TypePlat']="All";
	}
}
/*----------------------------------------------------------*/
/*--------Créer menu type PLAT-----*/
/*----------------------------------------------------------*/
$menuTypePlat = new menu("menuTypePlat");
$menuTypePlat->ajouterComposant($menuTypePlat->creerItemLien("All" ,"Tous les types"));
foreach ($_SESSION['listeTypePlats']->getLesTypePlats() as $uneTypePlat){
	$menuTypePlat->ajouterComposant($menuTypePlat->creerItemLien($uneTypePlat->getCodeT() ,$uneTypePlat->getLibelle()));
}
$lemenuTypePlats = $menuTypePlat->creerMenuType('TypePlat',$_SESSION['TypePlat']);



/*----------------------------------------------------------*/
/*-------------------creation de La banniere resto----------------------*/
/*----------------------------------------------------------*/


foreach ($_SESSION['listeRestos']->getLesRestos() as $OBJ)
{
  if ($_SESSION['RestoSelected']==$OBJ->getId())
	{
		foreach ($_SESSION['listeTypeRestos']->getLesTypeRestos() as $OBJ2)
		{
			if ($OBJ2->getCodeT()==$OBJ->getCodeT()) {
				$laBanniereResto = new Formulaire("POST","index.php","formBaniereResto","baniereRestothis");
	 		 	$laBanniereResto->ajouterComposantLigne($laBanniereResto->concactComposants($laBanniereResto->creerLabelFor($OBJ->getNom(),"nomRestoB"),
																								$laBanniereResto->concactComposants($laBanniereResto->creerLabelFor($OBJ2->getLibelle(),"typeRestoB"),$laBanniereResto->creerLabelFor(" ~ 30 - 40 min","timeRestoB"),0),2));
	 		 	$laBanniereResto->ajouterComposantTab();
	 	 	 	$laBanniereResto->creerFormulaire();
			}
		}
	}
}

/*----------------------------------------------------------*/
/*--------creation des forms des plats du restaurants choisit-----*/
/*----------------------------------------------------------*/

if ($_SESSION['TypePlat']=="All") {
	foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
	{
	  if($OBJ->getIDResto() == $_SESSION['RestoSelected'] ){
	    $correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getCheminPhoto());
	    $correct = strtolower($correct);
	    $correct = 'image/'.$correct;

	    $formPlat = new Formulaire("POST","index.php","formPlat","platthis");
	    $formPlat->ajouterComposantLigne($formPlat->creerInputImage('imgPlat', 'imgPlat', $correct));
	    $formPlat->ajouterComposantLigne($formPlat->concactComposants($formPlat->creerLabelFor($OBJ->getNom(),"nomPlat"),
	                                    $formPlat->concactComposants($formPlat->creerLabelFor('Prix : ',"lblPrixPlat"),
	                                    $formPlat->concactComposants($formPlat->creerLabelFor($OBJ->getPrixClient()."€","prixPlat"),
	                                    $formPlat->concactComposants($formPlat->creerLabelFor('Description : ',"lblDescripPlat"),
	                                    $formPlat->creerLabelFor($OBJ->getDescription(),"descripPlat"),0),4),0),2));
			if (!isset($_SESSION['typeIdentite']) || $_SESSION['typeIdentite'] != 'R'){
	    	$formPlat->ajouterComposantLigne($formPlat->creerInputSubmitPanier($OBJ->getID(),"ajoutCommande-btn"," Ajouter au panier "));
			}
	    $formPlat->ajouterComposantTab();
	    $formPlat->creerFormulaire();
	    $_SESSION['lesFormsPlat'] .= $formPlat->afficherFormulaire();
			$_SESSION['nbPlatResto'] += 1;
	  }
	}
}
else {
	foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
	{
	  if($OBJ->getIDResto() == $_SESSION['RestoSelected'] ){
			if ($OBJ->getTypePlat()==$_SESSION['TypePlat']) {
		    $correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getCheminPhoto());
		    $correct = strtolower($correct);
		    $correct = 'image/'.$correct;

		    $formPlat = new Formulaire("POST","index.php","formPlat","platthis");
		    $formPlat->ajouterComposantLigne($formPlat->creerInputImage('imgPlat', 'imgPlat', $correct));
		    $formPlat->ajouterComposantLigne($formPlat->concactComposants($formPlat->creerLabelFor($OBJ->getNom(),"nomPlat"),
		                                    $formPlat->concactComposants($formPlat->creerLabelFor('Prix : ',"lblPrixPlat"),
		                                    $formPlat->concactComposants($formPlat->creerLabelFor($OBJ->getPrixClient()."€","prixPlat"),
		                                    $formPlat->concactComposants($formPlat->creerLabelFor('Description : ',"lblDescripPlat"),
		                                    $formPlat->creerLabelFor($OBJ->getDescription(),"descripPlat"),0),4),0),2));
				if (!isset($_SESSION['typeIdentite']) || $_SESSION['typeIdentite'] != 'R'){
		    	$formPlat->ajouterComposantLigne($formPlat->creerInputSubmitPanier($OBJ->getID(),"ajoutCommande-btn"," Ajouter au panier "));
				}
				$formPlat->ajouterComposantTab();
		    $formPlat->creerFormulaire();
		    $_SESSION['lesFormsPlat'] .= $formPlat->afficherFormulaire();
				$_SESSION['nbPlatResto'] += 1;
			}
	  }
	}
}
/*----------------------------------------------------------*/
/*--------Ajouter un plat au panier (liste de plat en obj)-----*/
/*----------------------------------------------------------*/

$lePlat = new Plat("","","","","","","","","");

foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
{
	if(isset($_POST[$OBJ->getID()])) {
		$lePlat->__construct($OBJ->getID(),$OBJ->getIDResto(),$OBJ->getTypePlat(),$OBJ->getNom(),$OBJ->getPrixFournisseur(),$OBJ->getPrixClient(),$OBJ->getPlatVisible(),$OBJ->getCheminPhoto(),$OBJ->getDescription());
		$_SESSION['lesPlats'][] =	serialize($lePlat);
		$_SESSION['nbPlatPanier']+=1;
	}
}
if ($_SESSION['nbPlatPanier']>0)
{
	foreach ($_SESSION['lesPlats'] as $OBJ)
	{
		$lesPlats[] = unserialize($OBJ);
	}
	$_SESSION['lePanier'] = new Plats($lesPlats);

}





/*----------------------------------------------------------*/
/*--------Suppression du formulaire du panier-----*/
/*----------------------------------------------------------*/

/*	foreach ($_SESSION['lePanier']->getLesPlats() as $OBJ) {
		if (isset($_POST[$OBJ->getID()]) && $_POST[$OBJ->getID()] == "X") {
			var_dump()$_SESSION['lePanier']->chercher($OBJ->getID()));
		}

	}
}*/


/*----------------------------------------------------------*/
/*--------Création du formulaire du panier-----*/
/*----------------------------------------------------------*/
// $j=0;
// foreach ($_SESSION['lePanier']->getLesPlats() as $OBJ){
// 	$i=0;
// 	if (!isset($_SESSION['cePanier'])) {
//
// 	}
// 		if ($OBJ->getID() == $OBJ2->getID()) {
// 			$i+=1;
// 		}
// 	}
// 	if ($i>1) {
// 		$_SESSION['cePanier'][] = array($OBJ,$i);
//
// 	}
//
// }
//var_dump($_SESSION['cePanier']);

/*----------------------------------------------------------*/
/*--------Ajout  ou enelever de l'argent du pourboir-----*/
/*----------------------------------------------------------*/
if (isset($_POST['btnMoinsPourboir'])) {
	if($_SESSION['prixPourboir']>0){
		$_SESSION['prixPourboir']-=1;
	}
}
if (isset($_POST['btnPlusPourboir'])) {
	$_SESSION['prixPourboir']+=1;
}
/*----------------------------------------------------------*/
/*--------Création du form panier-----*/
/*----------------------------------------------------------*/
$formPanier = new Formulaire("POST","index.php","formPanier","panierthis");

$formPanier->ajouterComposantLigne($formPanier->creerLabelFor('Votre Panier', 'lblPanier'));
$formPanier->ajouterComposantTab();

//Condition si le panier est remplit
if($_SESSION['nbPlatPanier']>0){
	foreach ($_SESSION['lePanier']->getLesPlats() as $OBJ)
	{
	 	$formPanier->ajouterComposantLigne($formPanier->concactComposants($formPanier->creerLabelFor($OBJ->getNom(),"nomP"),$formPanier->concactComposants($formPanier->creerLabelFor('x1','nbPlat'),$formPanier->concactComposants($formPanier->creerLabelFor($OBJ->getPrixClient()."€",'prixP'),$formPanier->creerInputSubmit($OBJ->getID(),'supprPlat',"X"),0),0),0));
		$formPanier->ajouterComposantTab();
		$_SESSION['prixTotal'] += $OBJ->getPrixClient();
	}
	$formPanier->ajouterComposantLigne($formPanier->concactComposants($formPanier->creerLabelFor("Pourboir au Livreur : ","lblPourboir"),
																		 $formPanier->concactComposants($formPanier->creerInputSubmit('btnMoinsPourboir','btnMoinsPourboir',"-"),
																		 $formPanier->concactComposants($formPanier->creerInputSubmit('btnPlusPourboir','btnPlusPourboir',"+"),
																		 $formPanier->creerLabelFor($_SESSION['prixPourboir']."€","prixTotal"),0),0),0));
	$formPanier->ajouterComposantTab();
}
//Condition si le panier est vide
else{
	$formPanier->ajouterComposantLigne($formPanier->creerLabelFor("Le panier est vide","lblVide"));
	$formPanier->ajouterComposantTab();
}

$formPanier->ajouterComposantLigne($formPanier->concactComposants($formPanier->creerLabelFor("Total : ","lbltotal"),$formPanier->creerLabelFor($_SESSION['prixTotal']+$_SESSION['prixPourboir']."€","prixTotal"),0));
$formPanier->ajouterComposantTab();
$formPanier->ajouterComposantLigne($formPanier->creerInputSubmit('validerCommande','validerCommande',"Valider votre commande"));
$formPanier->ajouterComposantTab();

$formPanier->creerFormulaire();
$_SESSION['leFormPlanier'] = $formPanier->afficherFormulaire();





/*--------------------------------------------------------------------------*/
include 'vue\vuePlat.php';
 ?>
