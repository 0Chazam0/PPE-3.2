<?php

$menuProfil = new menu("menuProfil");
$menuProfil->ajouterComposant($menuProfil->creerItemLien('Profil','Profil'));
$menuProfil->ajouterComposant($menuProfil->creerItemLien('Historique','Historique'));
if ($_SESSION['typeIdentite'] == 'R') {
	$menuProfil->ajouterComposant($menuProfil->creerItemLien('Restaurateur','Restaurateur'));
}
if ($_SESSION['typeIdentite'] == 'M') {
	$menuProfil->ajouterComposant($menuProfil->creerItemLien('Moderateur','Moderateur'));
}
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
if ($_SESSION['menuProfil'] == "Restaurateur") {
	$formProfil->ajouterComposantLigne($formProfil->creerInputSubmit('redirectionRestaurateur','redirectionRestaurateur','Votre espace restaurateur'));
	$formProfil->ajouterComposantTab();

}
if ($_SESSION['menuProfil'] == "Moderateur") {
	$formProfil->ajouterComposantLigne($formProfil->creerInputSubmit('redirectionModo','redirectionModo','Votre espace Moderateur'));
	$formProfil->ajouterComposantTab();

}

if ($_SESSION['menuProfil'] == "Profil") {
	$formProfil->ajouterComposantLigne($formProfil->creerLabelFor($_SESSION['identite'][1],'nom'));
	$formProfil->ajouterComposantTab();
	$formProfil->ajouterComposantLigne($formProfil->creerLabelFor($_SESSION['identite'][2],'prenom'));
	$formProfil->ajouterComposantTab();
	$formProfil->ajouterComposantLigne($formProfil->creerLabelFor($_SESSION['identite'][5],'adresse'));
	$formProfil->ajouterComposantTab();
	$formProfil->ajouterComposantLigne($formProfil->creerInputSubmit('deconnexion','deconnexion','Deconnecter'));
	$formProfil->ajouterComposantTab();
	$formProfil->ajouterComposantLigne($formProfil->creerInputSubmitHidden('deco','deco','deco'));
	$formProfil->ajouterComposantTab();
}

if ($_SESSION['menuProfil'] == "Historique") {
  $lesCommandes = CommandeDAO::commandesDunUser($_SESSION['identite'][0]);
      foreach ($lesCommandes as $uneCommande) {
				$formProfil->ajouterComposantLigne($formProfil->creerLabelFor("Commande N° ","numeroCommande"));
				$formProfil->ajouterComposantLigne($formProfil->creerLabelFor($uneCommande['IDC'],$uneCommande['IDC']));
				$formProfil->ajouterComposantLigne($formProfil->creerLabelFor("Effectuée le ","dateCommande"));
        $formProfil->ajouterComposantLigne($formProfil->creerLabelFor($uneCommande['DATEC'],$uneCommande['DATEC']));
				$formProfil->ajouterComposantTab();

        $lesPlats = PlatDAO::platsDuneCommande($uneCommande['IDC']);
          foreach ($lesPlats as $unPlat) {
						$formProfil->ajouterComposantLigne($formProfil->creerInputImage($unPlat['NOMP'],'imgPlat','image/' .$unPlat['PHOTOP'] . '.jpeg' ));
            $formProfil->ajouterComposantLigne($formProfil->creerA($unPlat['NOMP']));
						$formProfil->ajouterComposantLigne($formProfil->creerA($unPlat['PRIXCLIENTP']));
						$formProfil->ajouterComposantLigne($formProfil->creerA($unPlat['DESCRIPTIONP']));

          }
      $formProfil->ajouterComposantTab();
    }

}
$contentProfil=$formProfil->creerFormulaire();
$contentProfil=  '<nav class = "conteneurProfil">'. $formProfil->afficherFormulaire() . '</nav>';

include "vue/vueProfil.php";
 ?>
