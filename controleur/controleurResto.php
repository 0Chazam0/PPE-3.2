<?php
/*----------------------------------------------------------*/
/*--------Déclaration variable session----------------------*/
/*----------------------------------------------------------*/
$_SESSION['dernierePage'] = "Resto";
$_SESSION['listeVilles'] =new Villes(VilleDAO::selectListeVille());
$_SESSION['listeRestos'] = new Restos(RestoDAO::selectListeResto());
$_SESSION['listeTypeRestos'] = new TypeRestos(TypeRestoDAO::selectListeTypeResto());
$_SESSION['lesFormsResto']= null;
$_SESSION['passagePlat']=0;
$compteurResto =0;

/*----------------------------------------------------------*/
/*--------Affichage  des restaurants selon leur type-----*/
/*----------------------------------------------------------*/
if(isset($_GET['TypeResto'])){
	$_SESSION['TypeResto']= $_GET['TypeResto'];
}
else
{
	if(!isset($_SESSION['TypeResto'])){
		$_SESSION['TypeResto']="All";
	}
}

/*----------------------------------------------------------*/
/*--------creation type resto-----*/
/*----------------------------------------------------------*/
$menuTypeResto = new menu("menuTypeResto");

$menuTypeResto->ajouterComposant($menuTypeResto->creerItemLien("All" ,"Tous les types"));
foreach ($_SESSION['listeTypeRestos']->getLesTypeRestos() as $uneTypeResto){
	$menuTypeResto->ajouterComposant($menuTypeResto->creerItemLien($uneTypeResto->getCodeT() ,$uneTypeResto->getLibelle()));
}
$lemenuTypeRestos = $menuTypeResto->creerMenuType('TypeResto',$_SESSION['TypeResto']);


/*----------------------------------------------------------*/
/*--------creation des forms des restaurants de la ville choisit pour tous les types-----*/
/*----------------------------------------------------------*/
$star = "image/star.png";
$notStar = "<img src='image/empty.png' width='5%' height='5%'>";
if ($_SESSION['TypeResto']=="All"){
	foreach ($_SESSION['listeVilles']->getLesVilles() as $OBJ2){
	  if ($OBJ2->getNom()==ucfirst($_SESSION['VilleSelected'])){
	    foreach ($_SESSION['listeRestos']->getLesRestos() as $OBJ)
	    {
	      if ($OBJ->getCodeV() == $OBJ2->getCode()){
					$compteurResto +=1;
	        $correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getNom());
	        $correct = strtolower($correct);
	        $correct = 'image/'.$correct;

	        $formResto = new Formulaire("POST","index.php","formResto","restothis");
	        $formResto->ajouterComposantLigne($formResto->creerInputImage('imgResto', 'imgResto', $correct));
					$formResto->ajouterComposantTab();
	        $formResto->ajouterComposantLigne($formResto->concactComposants($formResto->creerLabelFor($OBJ->getNom(),"nomResto"),
																						$formResto->concactComposants($formResto->creerInputImage('star', 'star', $star),
																						$formResto->concactComposants($formResto->creerInputImage('star', 'star', $star),
																						$formResto->concactComposants($formResto->creerInputImage('star', 'star', $star),
																						$formResto->concactComposants($formResto->creerInputImage('star', 'star', $star),
																						$formResto->concactComposants($formResto->creerInputImage('star', 'star', $star),
																						$formResto->creerLabelFor($OBJ->getNumAdr()." ".$OBJ->getRueAdr() ." ". $OBJ->getCP(),'adrResto'),2),0),0),0),0),0));
	        $formResto->ajouterComposantLigne($formResto->creerInputSubmitHidden("idResto","idResto",$OBJ->getId()));
	        $formResto->ajouterComposantTab();
	        $formResto->creerFormulaire();
	        $_SESSION['lesFormsResto'] .= $formResto->afficherFormulaire();
	      }
	    }
	  }
	}
}
/*----------------------------------------------------------*/
/*--------creation des forms des restaurants de la ville choisit pour le type selectionné-----*/
/*----------------------------------------------------------*/
else {
	foreach ($_SESSION['listeVilles']->getLesVilles() as $OBJ2){
		if ($OBJ2->getNom()==ucfirst($_SESSION['VilleSelected'])){
			foreach ($_SESSION['listeRestos']->getLesRestos() as $OBJ)
			{
				if ($OBJ->getCodeV() == $OBJ2->getCode()){
					if ($OBJ->getCodeT()==$_SESSION['TypeResto']){
						$compteurResto +=1;
						$correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getNom());
						$correct = strtolower($correct);
						$correct = 'image/'.$correct;

						$formResto = new Formulaire("POST","index.php","formResto","restothis");
						$formResto->ajouterComposantLigne($formResto->creerInputImage('imgResto', 'imgResto', $correct));
						$formResto->ajouterComposantLigne($formResto->concactComposants($formResto->creerLabelFor($OBJ->getNom(),"nomResto"),
																							$formResto->concactComposants($formResto->creerInputImage('star', 'star', $star),
																							$formResto->concactComposants($formResto->creerInputImage('star', 'star', $star),
																							$formResto->concactComposants($formResto->creerInputImage('star', 'star', $star),
																							$formResto->concactComposants($formResto->creerInputImage('star', 'star', $star),
																							$formResto->concactComposants($formResto->creerInputImage('star', 'star', $star),
																							$formResto->creerLabelFor($OBJ->getNumAdr()." ".$OBJ->getRueAdr() ." ". $OBJ->getCP(),'adrResto'),2),0),0),0),0),0));
						$formResto->ajouterComposantLigne($formResto->creerInputSubmitHidden("idResto","idResto",$OBJ->getId()  ));
						$formResto->ajouterComposantTab();
						$formResto->creerFormulaire();
						$_SESSION['lesFormsResto'] .= $formResto->afficherFormulaire();
					}
				}
			}
		}
	}
}
//affiche une erreur si la ville n'est pas connue
if ($compteurResto==0) {
	$txt = "<div id='erreurVille'>Désolé nous n'avons trouvé aucun restaurant situé dans cette ville</div>";
}


/*--------------------------------------------------------------------------*/
include 'vue\vueResto.php';
 ?>
