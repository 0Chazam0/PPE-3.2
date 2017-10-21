<?php
/*----------------------------------------------------------*/
/*--------Déclaration variable session----------------------*/
/*----------------------------------------------------------*/
$_SESSION['listeTypePlats'] = new TypePlats(TypePlatDAO::selectListeTypePlat());
$_SESSION['listePlats'] = new Plats(PlatDAO::selectListePlat());
$_SESSION['RestoSelected'] = $_POST['idResto'];
$_SESSION['lesFormsPlat'] = null;


/*----------------------------------------------------------*/
/*--------Affichage  des plats selon leur type-----*/
/*----------------------------------------------------------*/
if(isset($_GET['TypePlat'])){
	$_SESSION['TypePlat']= $_GET['TypePlat'];
}
else
{
	if(!isset($_SESSION['TypePlat'])){
		$_SESSION['TypePlat']="0";
	}
}

$menuTypePlat = new menu("menuTypePlat");
foreach ($_SESSION['listeTypePlats']->getLesTypePlats() as $uneTypePlat){
	$menuTypePlat->ajouterComposant($menuTypePlat->creerItemLien($uneTypePlat->getCodeT() ,$uneTypePlat->getLibelle()));
}
$lemenuTypePlats = $menuTypePlat->creerMenu($_SESSION['TypePlat']);

$TypePlatActive = $_SESSION['listeTypePlats']->chercher($_SESSION['TypePlat']);


/*----------------------------------------------------------*/
/*--------Les forms des plats durestaurants choisit-----*/
/*----------------------------------------------------------*/


foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
{
  if($OBJ->getIDResto() == $_SESSION['RestoSelected'] ){


    $correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getCheminPhoto());
    $correct = strtolower($correct);
    $correct = 'image/'.$correct;

    $formPlat = new Formulaire("POST","","formPlat","platthis");
    $formPlat->ajouterComposantLigne($formPlat->creerInputImage('imgPlat', 'imgPlat', $correct));
    $formPlat->ajouterComposantLigne($formPlat->concactComposants($formPlat->creerLabelFor($OBJ->getNom(),"nomPlat"),
                                    $formPlat->concactComposants($formPlat->creerLabelFor('Prix : ',"lblPrixPlat"),
                                    $formPlat->concactComposants($formPlat->creerLabelFor($OBJ->getPrixClient()."€","prixPlat"),
                                    $formPlat->concactComposants($formPlat->creerLabelFor('Description : ',"lblDescripPlat"),
                                    $formPlat->creerLabelFor($OBJ->getDescription(),"descripPlat"),0),4),0),2));
    $formPlat->ajouterComposantLigne($formPlat->creerButtonOnClick("ajoutCommande-btn","    +    "));
    $formPlat->ajouterComposantTab();
    $formPlat->creerFormulaire();
    $_SESSION['lesFormsPlat'] .= $formPlat->afficherFormulaire();

  }
}

/*--------------------------------------------------------------------------*/
include 'vue\vuePlat.php';
 ?>
