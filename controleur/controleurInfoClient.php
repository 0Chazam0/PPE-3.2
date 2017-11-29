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
$photoProfil->ajouterComposantLigne($photoProfil->creerInputImageProfil('photoProfil','photoDProfil',"image/" . ucfirst($_SESSION['identite'][0])));
$photoProfil->ajouterComposantLigne($photoProfil->creerInputSubmit('deconnexion','deconnexion','Deconnecter'));
$photoProfil->ajouterComposantTab();
$photoProfil->ajouterComposantLigne($formProfil->concactComposants($photoProfil->creerLabelFor('Icône du fichier (JPEG | max. 1 Mo) : ', 'fileAjoutPlatP'),
																	  $photoProfil->creerInputFile('uploadImgP','uploadImgP',"Parcourir"),0));
$photoProfil->ajouterComposantTab();
$photoProfil->ajouterComposantLigne($photoProfil->creerInputSubmit('btnUploadP','btnUploadP','Upload'));
$photoProfil->ajouterComposantTab();
$laPhotoProfil = $photoProfil->creerFormulaire();
$laPhotoProfil = $photoProfil->afficherFormulaire();

$contentProfil=$formProfil->creerFormulaire();
$contentProfil=  '<nav class = "conteneurProfil">'. $formProfil->afficherFormulaire() . '</nav>';

/*----------------------------------------------------------*/
/*--------Upload une image (conforme) dans le dossier image-----*/
/*----------------------------------------------------------*/
if(isset($_POST['btnUploadP'])){
	if (isset($_FILES['uploadImgP']['name']) && !empty($_FILES['uploadImgP']['name'])){
		$extensions_valides = array('jpeg');
		$image_sizes = getimagesize($_FILES['uploadImgP']['tmp_name']);
		$nomPhoto = str_replace(CHR(32),"",strtolower($_SESSION['identite'][0]));
		//La taille du fichier en octets.
		if ($_FILES['uploadImgP']['size'] > 1000000) {
			$_SESSION['resultatUploadP'] = "Le fichier est trop gros";
		}
		else{
			if ($_FILES['uploadImgP']['error'] > 0) {
				$_SESSION['resultatUploadP'] = "Erreur lors du transfert";
			}
				else{
					$extension_upload = strtolower(  substr(  strrchr($_FILES['uploadImgP']['name'], '.')  ,1)  );
					//Parcourt le tableau de possibilité d'extention
					if (in_array($extension_upload,$extensions_valides) ){
						if ($image_sizes[0] > 300 OR $image_sizes[1] > 300) {
								$_SESSION['resultatUploadP'] = "Image trop grande";
						}
						else{
								/*----------------------------------------------------------*/
								/*--------upload de la photo a l'emplacement----*/
								/*----------------------------------------------------------*/
								$nom = "image/{$nomPhoto}.{$extension_upload}";
								$resultat = move_uploaded_file($_FILES['uploadImgP']['tmp_name'],$nom);
								if ($resultat)
								{
									$_SESSION['resultatUploadP'] ="Transfert réussi";
								}
								else{
									$_SESSION['resultatUploadP'] = "Erreur non identifée";
								}

					}
				}
				else{
					$_SESSION['resultatUploadP'] = "Extension incorecte";
				}
		}
	}
}
else {
	$_SESSION['resultatUploadP'] = "Choisir une image";
}
echo $_SESSION['resultatUploadP'];
}




include "vue/vueProfil.php";
 ?>
