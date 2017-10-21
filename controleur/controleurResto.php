<?php
/*----------------------------------------------------------*/
/*--------Déclaration variable session----------------------*/
/*----------------------------------------------------------*/

$_SESSION['listeVilles'] =new Villes(VilleDAO::selectListeVille());
$_SESSION['listeRestos'] = new Restos(RestoDAO::selectListeResto());
$_SESSION['listeTypeRestos'] = new TypeRestos(TypeRestoDAO::selectListeTypeResto());
$_SESSION['lesFormsResto']= null;


/*----------------------------------------------------------*/
/*--------Affichage  des restaurants selon leur type-----*/
/*----------------------------------------------------------*/
if(isset($_GET['TypeResto'])){
	$_SESSION['TypeResto']= $_GET['TypeResto'];
}
else
{
	if(!isset($_SESSION['TypeResto'])){
		$_SESSION['TypeResto']="TR1";
	}
}
/*----------------------------------------------------------*/
/*--------Affichage type resto-----*/
/*----------------------------------------------------------*/
$menuTypeResto = new menu("menuTypeResto");
foreach ($_SESSION['listeTypeRestos']->getLesTypeRestos() as $uneTypeResto){
	$menuTypeResto->ajouterComposant($menuTypeResto->creerItemLien($uneTypeResto->getCodeT() ,$uneTypeResto->getLibelle()));
}
$lemenuTypeRestos = $menuTypeResto->creerMenu($_SESSION['TypeResto']);

$TypeRestoActive = $_SESSION['listeTypeRestos']->chercher($_SESSION['TypeResto']);

/*----------------------------------------------------------*/
/*--------Les forms des restaurants de la ville choisit-----*/
/*----------------------------------------------------------*/

foreach ($_SESSION['listeVilles']->getLesVilles() as $OBJ2){
  if ($OBJ2->getNom()==ucfirst($_SESSION['VilleSelected'])){
    foreach ($_SESSION['listeRestos']->getLesRestos() as $OBJ)
    {
      if ($OBJ->getCodeV() == $OBJ2->getCode()){

        if (!isset($_SESSION['identite'])) {
          $page = 'Connexion';
        }
        else{
          $page = 'Plat';
        }

        $correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getNom());
        $correct = strtolower($correct);
        $correct = 'image/'.$correct;

        $formResto = new Formulaire("POST","index.php","formResto","restothis");
        $formResto->ajouterComposantLigne($formResto->creerInputImage('imgResto', 'imgResto', $correct));
        $formResto->ajouterComposantLigne($formResto->concactComposants($formResto->creerLabelFor($OBJ->getNom(),"nomResto"),$formResto->creerLabelFor($OBJ->getNumAdr()." ".$OBJ->getRueAdr() ." ". $OBJ->getCP(),'adrResto'),2));
        $formResto->ajouterComposantLigne($formResto->creerInputSubmit("plat-btn","plat-btn","    Nos Plats   "));
        $formResto->ajouterComposantLigne($formResto->creerInputSubmitHidden("idResto","idResto",$OBJ->getId()  ));
        $formResto->ajouterComposantTab();
        $formResto->creerFormulaire();
        $_SESSION['lesFormsResto'] .= $formResto->afficherFormulaire();
        }
      }

    }
}



/*--------------------------------------------------------------------------*/
include 'vue\vueResto.php';
 ?>
