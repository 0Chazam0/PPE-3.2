<?php

$menuProfil = new menu("menuProfil");
$menuProfil->ajouterComposant($menuProfil->creerItemLien('Profil','Profil'));
if ($_SESSION['typeIdentite'] == 'R') {
	$menuProfil->ajouterComposant($menuProfil->creerItemLien('Restaurateur','Restaurateur'));
}
if ($_SESSION['typeIdentite'] == 'M') {
	$menuProfil->ajouterComposant($menuProfil->creerItemLien('Moderateur','Moderateur'));
}
if ($_SESSION['typeIdentite'] == 'C') {
	$menuProfil->ajouterComposant($menuProfil->creerItemLien('Historique','Historique'));
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
	$formProfil->ajouterComposantLigne($formProfil->creerInputSubmit('mdpChange','mdpChange','Changer de mot de passe'));
	$formProfil->ajouterComposantTab();
}

if ($_SESSION['menuProfil'] == "Historique") {
  $lesCommandes = CommandeDAO::commandesDunUser($_SESSION['identite'][0]);
      foreach ($lesCommandes as $uneCommande) {
				$formProfil->ajouterComposantLigne($formProfil->creerLabelFor("Commande N° ","numeroCommande"));
				$formProfil->ajouterComposantLigne($formProfil->creerLabelFor($uneCommande['IDC'],$uneCommande['IDC']));
				$formProfil->ajouterComposantTab();
				$formProfil->ajouterComposantLigne($formProfil->creerLabelFor("Effectuée le ","dateCommande"));
        $formProfil->ajouterComposantLigne($formProfil->creerLabelFor($uneCommande['DATEC'],$uneCommande['DATEC']));
				$formProfil->ajouterComposantTab();

        $lesPlats = PlatDAO::platsDuneCommande($uneCommande['IDC']);
          foreach ($lesPlats as $unPlat) {
						$formProfil->ajouterComposantLigne($formProfil->creerInputImage($unPlat['NOMP'],'imgPlat','image/' .$unPlat['PHOTOP']));
						$formProfil->ajouterComposantLigne($formProfil->concactComposants($formProfil->creerA($unPlat['NOMP']),
																							 $formProfil->concactComposants($formProfil->creerA($unPlat['PRIXCLIENTP'] . " €"),
																							 $formProfil->creerA($unPlat['DESCRIPTIONP']),2),2));
						$formProfil->ajouterComposantTab();
          }
      $formProfil->ajouterComposantTab();
			$formProfil->ajouterComposantLigne($formProfil->creerSep(''));
			$formProfil->ajouterComposantTab();
    }

}
$photoProfil = new Formulaire('post','index.php','photoProfil','photoProfil');
$photoProfil->ajouterComposantLigne($photoProfil->creerInputImageProfil('photoProfil','photoDProfil',"image/" . $_SESSION['identite'][0]));
$photoProfil->ajouterComposantLigne($photoProfil->creerInputSubmit('deconnexion','deconnexion','Deconnecter'));
$photoProfil->ajouterComposantTab();
$laPhotoProfil = $photoProfil->creerFormulaire();
$laPhotoProfil = $photoProfil->afficherFormulaire();
$contentProfil=$formProfil->creerFormulaire();
$contentProfil=  '<nav class = "conteneurProfil">'. $formProfil->afficherFormulaire() . '</nav>';

include "vue/vueProfil.php";
 ?>
