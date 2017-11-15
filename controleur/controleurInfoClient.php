<?php

$menuProfil = new menu("menuProfil");
$menuProfil->ajouterComposant($menuProfil->creerItemLien('Profil','Profil'));
$menuProfil->ajouterComposant($menuProfil->creerItemLien('Historique','Historique'));
$menuProfil->ajouterComposant($menuProfil->creerItemLien('Deconnexion','Deconnexion'));
$leMenuProfil = $menuProfil->creerMenu("menuProfil");

if(isset($_GET['menuProfil'])){
	$_SESSION['menuProfil']= $_GET['menuProfil'];
}
else
{
	if(!isset($_SESSION['menuProfil'])){
		$_SESSION['menuProfil']="Profil";
	}

}
$formProfil = new Formulaire('post','index.php','formProfil','formProfil');
if ($_SESSION['menuProfil'] == "Deconnexion") {
  $formProfil->ajouterComposantLigne($formProfil->creerInputSubmit('deconnexion','deconnexion','Deconnecter'));
  $formProfil->ajouterComposantTab();
  $formProfil->ajouterComposantLigne($formProfil->creerInputSubmitHidden('deco','deco',''));
  $contentProfil=$formProfil->creerFormulaire();
  $contentProfil=$formProfil->afficherFormulaire();
  $test[0][0]=3;
  $test[0][1]=4;
  $test[1][0]=5;
  $test[0][2]=6;
  echo count($test[0]);
}

if ($_SESSION['menuProfil'] == "Historique") {
  $lesCommandes = CommandeDAO::commandesDunUser($_SESSION['identite'][0]);
    echo $lesCommandes[3][0] . "</br>";
    if (count($lesCommandes[0] > 1)) {
      foreach ($lesCommandes as $uneCommande) {
        echo $uneCommande;
        $formProfil->ajouterComposantLigne($formProfil->creerA($uneCommande[0]));
        $formProfil->ajouterComposantLigne($formProfil->creerA($uneCommande[3]));
        $formProfil->ajouterComposantTab();
        $lesPlats = PlatDAO::platsDuneCommande($uneCommande[0]);
        echo $lesPlats;
        if (count($lesPlats[0] > 1)) {
          foreach ($lesPlats as $unPlat) {
            $formProfil->ajouterComposantLigne($formProfil->creerA($unPlat[1]));
          }
        }
        else {
          $formProfil->ajouterComposantLigne($formProfil->creerA($unPlat[1]));
        }
        $formProfil->ajouterComposantTab();
      }
    }
    else {
      $formProfil->ajouterComposantLigne($formProfil->creerA($uneCommande[0]));
      $formProfil->ajouterComposantLigne($formProfil->creerA($uneCommande[3]));
      $formProfil->ajouterComposantTab();
      $lesPlats = PlatDAO::platsDuneCommande($uneCommande[0]);
      if (count($lesPlats[0])) {
        foreach ($lesPlats as $unPlat) {
          $formProfil->ajouterComposantLigne($formProfil->creerA($unPlat[1]));
        }
      }
      else {
        $formProfil->ajouterComposantLigne($formProfil->creerA($unPlat[1]));
      }
      $formProfil->ajouterComposantTab();
    }
  $contentProfil=$formProfil->creerFormulaire();
  $contentProfil=$formProfil->afficherFormulaire();
}

include "vue/vueProfil.php";
 ?>
