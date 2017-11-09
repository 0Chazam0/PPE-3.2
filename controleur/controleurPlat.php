
<?php
/*----------------------------------------------------------*/
/*--------Déclaration variable session----------------------*/
/*----------------------------------------------------------*/
$_SESSION['dernierePage'] = "Plat";
$_SESSION['listeTypePlats'] = new TypePlats(TypePlatDAO::selectListeTypePlat());
$_SESSION['listePlats'] = new Plats(PlatDAO::selectListePlat());
$_SESSION['lesFormsPlat'] = null;
$_SESSION['nbPlat'] = 1;
$_SESSION['nbPlatPanier']= 0;
$_SESSION['prixTotal'] = 0;
/*----------------------------------------------------------*/
/*--------Affichage  des plats selon leur type-----*/
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
/*--------Affichage type PLAT-----*/
/*----------------------------------------------------------*/
$menuTypePlat = new menu("menuTypePlat");
$menuTypePlat->ajouterComposant($menuTypePlat->creerItemLien("All" ,"Tous les types"));
foreach ($_SESSION['listeTypePlats']->getLesTypePlats() as $uneTypePlat){
	$menuTypePlat->ajouterComposant($menuTypePlat->creerItemLien($uneTypePlat->getCodeT() ,$uneTypePlat->getLibelle()));
}
$lemenuTypePlats = $menuTypePlat->creerMenu('TypePlat');




/*----------------------------------------------------------*/
/*--------Les forms des plats du restaurants choisit-----*/
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
	    $formPlat->ajouterComposantLigne($formPlat->creerInputSubmitPanier($OBJ->getID(),"ajoutCommande-btn"," Ajouter au panier "));
	    $formPlat->ajouterComposantTab();
	    $formPlat->creerFormulaire();
	    $_SESSION['lesFormsPlat'] .= $formPlat->afficherFormulaire();
			$_SESSION['nbPlat'] += 1;
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
		    $formPlat->ajouterComposantLigne($formPlat->creerInputSubmitPanier($OBJ->getID(),"ajoutCommande-btn"," Ajouter au panier "));
		    $formPlat->ajouterComposantTab();
		    $formPlat->creerFormulaire();
		    $_SESSION['lesFormsPlat'] .= $formPlat->afficherFormulaire();
				$_SESSION['nbPlat'] += 1;
			}
	  }
	}
}
/*----------------------------------------------------------*/
/*--------Ajouter un plat a la commande-----*/
/*----------------------------------------------------------*/


if ($_SESSION['passagePlat']>0) {

$lePlat = new Plat("","","","","","","","","");

	foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
	{

		if(isset($_POST[$OBJ->getID()]) && $_POST[$OBJ->getID()]==" Ajouter au panier "){
			$lePlat->__construct($OBJ->getID(),$OBJ->getIDResto(),$OBJ->getTypePlat(),$OBJ->getNom(),$OBJ->getPrixFournisseur(),$OBJ->getPrixClient(),$OBJ->getPlatVisible(),$OBJ->getCheminPhoto(),$OBJ->getDescription());
			$_SESSION['lesPlats'][] =	serialize($lePlat);
			$_SESSION['nbPlatPanier']+=1;
		}
	}

	foreach ($_SESSION['lesPlats'] as $OBJ) {
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

$formPanier = new Formulaire("POST","index.php","formPanier","panierthis");

$formPanier->ajouterComposantLigne($formPanier->creerLabelFor('Votre Panier', 'lblPanier'));
$formPanier->ajouterComposantTab();
$formPanier->ajouterComposantTab();
if ($_SESSION['passagePlat']>0) {
foreach ($_SESSION['lePanier']->getLesPlats() as $OBJ){
 	$formPanier->ajouterComposantLigne($formPanier->concactComposants($formPanier->creerLabelFor($OBJ->getNom(),"nomP"),$formPanier->concactComposants($formPanier->creerLabelFor('x1','nbPlat'),$formPanier->concactComposants($formPanier->creerLabelFor($OBJ->getPrixClient()."€",'prixP'),$formPanier->creerInputSubmit($OBJ->getID(),'supprPlat',"X"),0),0),0));
	$formPanier->ajouterComposantTab();
	$_SESSION['prixTotal'] += $OBJ->getPrixClient();
}

$formPanier->ajouterComposantLigne($formPanier->concactComposants($formPanier->creerLabelFor("Total : ","lbltotal"),$formPanier->creerLabelFor($_SESSION['prixTotal']."€","prixTotal"),0));
$formPanier->ajouterComposantTab();
$formPanier->ajouterComposantLigne($formPanier->creerInputSubmit('validerCommande','validerCommande',"Valider votre commande"));
$formPanier->ajouterComposantTab();
}
$formPanier->creerFormulaire();
$_SESSION['leFormPlanier'] = $formPanier->afficherFormulaire();









$_SESSION['passagePlat']+=1;
/*--------------------------------------------------------------------------*/
include 'vue\vuePlat.php';
 ?>
