
<?php
/*----------------------------------------------------------*/
/*--------Déclaration variable session----------------------*/
/*----------------------------------------------------------*/
$_SESSION['listeTypePlats'] = new TypePlats(TypePlatDAO::selectListeTypePlat());
$_SESSION['listePlats'] = new Plats(PlatDAO::selectListePlat());
$_SESSION['lesFormsPlat'] = null;
$_SESSION['nbPlat'] = 1;


/*----------------------------------------------------------*/
/*--------Affichage  des plats selon leur type-----*/
/*----------------------------------------------------------*/
if(isset($_GET['TypePlat'])){
	$_SESSION['TypePlat']= $_GET['TypePlat'];
}
else
{
	if(!isset($_SESSION['TypePlat'])){
		$_SESSION['TypePlat']="menuPrincipal";
	}
}
/*----------------------------------------------------------*/
/*--------Affichage type PLAT-----*/
/*----------------------------------------------------------*/
$menuTypePlat = new menu("menuTypePlat");
foreach ($_SESSION['listeTypePlats']->getLesTypePlats() as $uneTypePlat){
	$menuTypePlat->ajouterComposant($menuTypePlat->creerItemLien($uneTypePlat->getCodeT() ,$uneTypePlat->getLibelle()));
}
$lemenuTypePlats = $menuTypePlat->creerMenuType($_SESSION['TypePlat']);

$TypePlatActif = $_SESSION['listeTypePlats']->chercher($_SESSION['TypePlat']);


/*----------------------------------------------------------*/
/*--------Les forms des plats durestaurants choisit-----*/
/*----------------------------------------------------------*/


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
    $formPlat->ajouterComposantLigne($formPlat->creerInputSubmitPanier($OBJ->getID(),"ajoutCommande-btn"," Commander "));
    $formPlat->ajouterComposantTab();
    $formPlat->creerFormulaire();
    $_SESSION['lesFormsPlat'] .= $formPlat->afficherFormulaire();
		$_SESSION['nbPlat'] += 1;
  }
}
/*Ajouter un plat a la commande*/
foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
{
	if(isset($_POST[$OBJ->getID()])){
					$lePlat = new Plat($OBJ->getID(),$OBJ->getIDResto(),$OBJ->getTypePlat(),$OBJ->getNom(),$OBJ->getPrixFournisseur(),$OBJ->getPrixClient(),$OBJ->getPlatVisible(),$OBJ->getCheminPhoto(),$OBJ->getDescription());
					$resultat = array($lePlat =>$i);
					$i+=1;
		}
	}

$_SESSION['lePanier'] = new Plats($_SESSION['lesPlats']);



var_dump($_SESSION["lesPlats"]);

/*--------------------------------------------------------------------------*/
include 'vue\vuePlat.php';
 ?>
