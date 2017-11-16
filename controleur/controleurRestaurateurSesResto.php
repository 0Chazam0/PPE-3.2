<?php
/*----------------------------------------------------------*/
/*--------Déclaration variable session----------------------*/
/*----------------------------------------------------------*/
$_SESSION['dernierePage'] = "RestaurteurSesResto";
$_SESSION['listeRestosRestaurateur'] = RestoDAO::selectListeRestoRestaurateur($_SESSION['identite'][0]);
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
/*--------Affichage type resto-----*/
/*----------------------------------------------------------*/
$menuTypeResto = new menu("menuTypeResto");

$menuTypeResto->ajouterComposant($menuTypeResto->creerItemLien("All" ,"Tous les types"));
foreach ($_SESSION['listeTypeRestos']->getLesTypeRestos() as $uneTypeResto){
	$menuTypeResto->ajouterComposant($menuTypeResto->creerItemLien($uneTypeResto->getCodeT() ,$uneTypeResto->getLibelle()));
}
$lemenuTypeRestos = $menuTypeResto->creerMenu('TypeResto');


/*----------------------------------------------------------*/
/*--------Les forms des restaurants de la ville choisit-----*/
/*----------------------------------------------------------*/
if ($_SESSION['TypeResto']=="All"){
  foreach ($_SESSION['listeRestos']->getLesRestos() as $OBJ)
  {
    foreach ($_SESSION['listeRestosRestaurateur'] as $OBJ2)
    {
    if ($OBJ->getId() == $OBJ2['IDR']){
			$compteurResto +=1;
      $correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getNom());
      $correct = strtolower($correct);
      $correct = 'image/'.$correct;

      $formResto = new Formulaire("POST","index.php","formResto","restothis");
      $formResto->ajouterComposantLigne($formResto->creerInputImage('imgResto', 'imgResto', $correct));
			$formResto->ajouterComposantTab();
      $formResto->ajouterComposantLigne($formResto->concactComposants($formResto->creerLabelFor($OBJ->getNom(),"nomResto"),$formResto->creerLabelFor($OBJ->getNumAdr()." ".$OBJ->getRueAdr() ." ". $OBJ->getCP(),'adrResto'),2));
      $formResto->ajouterComposantLigne($formResto->creerInputSubmitHidden("idRestoRestaurateur","idRestoRestaurateur",$OBJ->getId()));
      $formResto->ajouterComposantTab();
      $formResto->creerFormulaire();
      $_SESSION['lesFormsResto'] .= $formResto->afficherFormulaire();
    }
  }
}
}
else {
	foreach ($_SESSION['listeRestos']->getLesRestos() as $OBJ)
	{
    foreach ($_SESSION['listeRestosRestaurateur'] as $OBJ2)
    {
    if ($OBJ->getId() == $OBJ2['IDR']){
			if ($OBJ->getCodeT()==$_SESSION['TypeResto']){
				$compteurResto +=1;
				$correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getNom());
				$correct = strtolower($correct);
				$correct = 'image/'.$correct;

				$formResto = new Formulaire("POST","index.php","formResto","restothis");
				$formResto->ajouterComposantLigne($formResto->creerInputImage('imgResto', 'imgResto', $correct));
				$formResto->ajouterComposantLigne($formResto->concactComposants($formResto->creerLabelFor($OBJ->getNom(),"nomResto"),$formResto->creerLabelFor($OBJ->getNumAdr()." ".$OBJ->getRueAdr() ." ". $OBJ->getCP(),'adrResto'),2));
				$formResto->ajouterComposantLigne($formResto->creerInputSubmitHidden("idRestoRestaurateur","idRestoRestaurateur",$OBJ->getId()  ));
				$formResto->ajouterComposantTab();
				$formResto->creerFormulaire();
				$_SESSION['lesFormsResto'] .= $formResto->afficherFormulaire();
			}
		}
	}
}
}
/*-------------------------------------------*/
include "vue/vueRestaurateurSesResto.php";
 ?>
