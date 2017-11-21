<?php
/*----------------------------------------------------------*/
/*--------Déclaration variable session----------------------*/
/*----------------------------------------------------------*/
$_SESSION['dernierePage'] = "RestaurateurChgResto";
$_SESSION['listeRestos'] = new Restos(RestoDAO::selectListeResto());
$_SESSION['listeTypeRestos'] = new TypeRestos(TypeRestoDAO::selectListeTypeResto());
$_SESSION['listeVilles'] =new Villes(VilleDAO::selectListeVille());
$_SESSION['listePlats'] = new Plats(PlatDAO::selectListePlat());
$_SESSION['listeTypePlats'] = new TypePlats(TypePlatDAO::selectListeTypePlat());
$_SESSION['lesFormsPlatR'] = null;

/*----------------------------------------------------------*/
/*--------Créer le menu et le formulaire detail resto----*/
/*----------------------------------------------------------*/
$formDetailsResto = new Formulaire("POST","","formDetailsResto","detailRestothis");
$menuDetailResto = new menu("menuDetailResto");


$menuDetailResto->ajouterComposant($menuDetailResto->creerItemLien('profil','Profil'));
$menuDetailResto->ajouterComposant($menuDetailResto->creerItemLien('insert','Ajouter un plat'));
$menuDetailResto->ajouterComposant($menuDetailResto->creerItemLien('insertTP','Ajouter un type de plat'));
$menuDetailResto->ajouterComposant($menuDetailResto->creerItemLien('update','Modifier un plat'));
$menuDetailResto->ajouterComposant($menuDetailResto->creerItemLien('delete','Supprimer un plat'));
$menuDetailResto = $menuDetailResto->creerMenu("menuDetailResto");

$formDetailsResto->ajouterComposantLigne($formDetailsResto->concactComposants($formDetailsResto->creerLabelFor('Details du restaurant', 'lbltitreDetailResto'),
$menuDetailResto,0));

$formDetailsResto->ajouterComposantTab();
$formDetailsResto->creerFormulaire();

/*----------------------------------------------------------*/
/*--------Gestion du menu detail resto selon l'onglet selectionné----------------------*/
/*----------------------------------------------------------*/
if(isset($_GET['menuDetailResto'])){
	$_SESSION['menuDetailResto']= $_GET['menuDetailResto'];
}
else
{
	if(!isset($_SESSION['menuDetailResto'])){
		$_SESSION['menuDetailResto']="profil";
	}
}

/***********************************************************************************************************************************************************************/


/*----------------------------------------------------------*/
/*--------Affiche la profil du resto avec quelques caracteristiques propres-----*/
/*----------------------------------------------------------*/
if ($_SESSION['menuDetailResto']== "profil"){
	$formProfil = new Formulaire("POST","index.php","formProfil","formProfilRthis");
	foreach ($_SESSION['listeRestos']->getLesRestos() as $OBJ)
	{
	  if ($_SESSION['RestoRestaurateurSelected']==$OBJ->getId())
		{
			foreach ($_SESSION['listeTypeRestos']->getLesTypeRestos() as $OBJ2)
			{
				if ($OBJ2->getCodeT()==$OBJ->getCodeT())
				{
					foreach ($_SESSION['listeVilles']->getLesVilles() as $OBJ3)
					{
						if ($OBJ->getCodeV() == $OBJ3->getCode())
						{
							$correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getNom());
			        $correct = strtolower($correct);
			        $correct = 'image/'.$correct;

							$formProfil->ajouterComposantLigne($formProfil->creerInputImage('imgRestoP', 'imgRestoP', $correct));
							$formProfil->ajouterComposantTab();
			        $formProfil->ajouterComposantLigne($formProfil->concactComposants($formProfil->creerLabelFor($OBJ->getNom(),"nomRestoP"),
																								 $formProfil->concactComposants($formProfil->creerLabelFor("Restaurant - ".$OBJ2->getLibelle(),"typeRestoP"),
																								 $formProfil->concactComposants($formProfil->creerLabelFor("Localisation : ".$OBJ3->getNom(),"VilleRestoP"),
																								 $formProfil->creerLabelFor("Adresse : ".$OBJ->getNumAdr()." ".$OBJ->getRueAdr() ." ". $OBJ->getCP(),'adrRestoP'),2),2),2));
							$formProfil->ajouterComposantTab();
							$formProfil->creerFormulaire();
						}
					}
				}
			}
		}
	}
}





/***********************************************************************************************************************************************************************/

/*----------------------------------------------------------*/
/*--------Affiche la vue Upload si l'on choix le menu ajouter plat-----*/
/*----------------------------------------------------------*/
if ($_SESSION['menuDetailResto']== "insert"){
  $formRestaurateur = new Formulaire("POST","index.php","formRestaurateur","restaurateurthis");
  if(isset($_SESSION['resultatUpload']) && $_SESSION['resultatUpload'] == "Transfert réussi" ){
    $style = "resultatthisSucces";

  }
  else{
    $style = "resultatthisErreur";
  }
  $formResultat = new Formulaire("POST","","formResultat",$style);


  /*----------------------------------------------------------*/
  /*--------Création du form de l'ajout et autoremplissage avec les données précédentes envoyées au formulaire-----*/
  /*----------------------------------------------------------*/
  if(isset($_POST['btnAjoutPlat'])){
    $formRestaurateur->ajouterComposantLigne($formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Ajouter un plat', 'lblajoutPlat'),
                                             $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Icône du fichier (JPEG | max. 1 Mo) :', 'fileAjoutPlat'),
                                             $formRestaurateur->concactComposants($formRestaurateur->creerInputFile('uploadImg','uploadImg',"Parcourir"),
                                             $formRestaurateur->concactComposants($formRestaurateur->creerSep('sepAjoutPlat'),
                                             $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Type de plat : ', 'lblAjoutTypePlat'),
                                             $formRestaurateur->concactComposants($formRestaurateur->creerSelect('typeP','cbxTypeP',""),
                                             $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Nom du Plat : ', 'lblAjoutNomPlat'),
                                             $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutNomPlat","txtAjoutNomPlat","",$_POST['txtAjoutNomPlat'],1,"Entrez le nom du plat"),
                                             $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Prix du Plat : ', 'lblAjoutPrixPlat'),
                                             $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutPrixPlat","txtAjoutPrixPlat","",$_POST['txtAjoutPrixPlat'],1,"Entrez le prix du plat"),
                                             $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Desciption du plat : ', 'lblAjoutDescriptionPlat'),
                                             $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutDescriptionPlat","txtAjoutDescriptionPlat","",$_POST['txtAjoutDescriptionPlat'],1,"Entrez la description du plat"),
                                             $formRestaurateur->creerInputSubmit("btnAjoutPlat","btnAjoutPlat","Ajouter le plat"),
                                             2),0),2),0),2),0),2),0),2),3),0),3));
    $formRestaurateur->ajouterComposantTab();
    $formRestaurateur->creerFormulaire();

  }



  /*----------------------------------------------------------*/
  /*--------Création du form de l'ajout de base-----*/
  /*----------------------------------------------------------*/
  else{

  $formRestaurateur->ajouterComposantLigne($formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Ajouter un plat', 'lblajoutPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Icône du fichier (JPEG | max. 1 Mo) :', 'fileAjoutPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerInputFile('uploadImg','uploadImg',"Parcourir"),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerSep('sepAjoutPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Type de plat : ', 'lblAjoutTypePlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerSelect('typeP','cbxTypeP',""),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Nom du Plat : ', 'lblAjoutNomPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutNomPlat","txtAjoutNomPlat","","",1,"Entrez le nom du plat"),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Prix du Plat : ', 'lblAjoutPrixPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutPrixPlat","txtAjoutPrixPlat","","",1,"Entrez le prix du plat"),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Desciption du plat : ', 'lblAjoutDescriptionPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutDescriptionPlat","txtAjoutDescriptionPlat","","",1,"Entrez la description du plat"),
                                           $formRestaurateur->creerInputSubmit("btnAjoutPlat","btnAjoutPlat","Ajouter le plat"),
                                           2),0),2),0),2),0),2),0),2),3),0),3));
  $formRestaurateur->ajouterComposantTab();
  $formRestaurateur->creerFormulaire();
  }
  /*----------------------------------------------------------*/
  /*--------Upload une image (conforme) dans le dossier image-----*/
  /*----------------------------------------------------------*/
  if (isset($_FILES['uploadImg']['name']) && !empty($_FILES['uploadImg']['name'])){
    $extensions_valides = array('jpeg');
    $image_sizes = getimagesize($_FILES['uploadImg']['tmp_name']);
    $nomPhoto = str_replace(CHR(32),"",strtolower($_POST['txtAjoutNomPlat']));
    //La taille du fichier en octets.
    if ($_FILES['uploadImg']['size'] > 1000000) {
      $_SESSION['resultatUpload'] = "Le fichier est trop gros";
    }
    else{
      if ($_FILES['uploadImg']['error'] > 0) {
        $_SESSION['resultatUpload'] = "Erreur lors du transfert";
      }
        else{
          $extension_upload = strtolower(  substr(  strrchr($_FILES['uploadImg']['name'], '.')  ,1)  );
          //Parcourt le tableau de possibilité d'extention
          if (in_array($extension_upload,$extensions_valides) ){
            if ($image_sizes[0] > 300 OR $image_sizes[1] > 300) {
                $_SESSION['resultatUpload'] = "Image trop grande";
            }
            else{
							/*----------------------------------------------------------*/
							/*--------upload de la photo a l'emplacement----*/
							/*----------------------------------------------------------*/
              $nom = "image/{$nomPhoto}.{$extension_upload}";
              $resultat = move_uploaded_file($_FILES['uploadImg']['tmp_name'],$nom);
              if ($resultat)
              {
                $_SESSION['resultatUpload'] ="Transfert réussi";
                /*----------------------------------------------------------*/
                /*--------Appel de la requete sql pour ajouter dans la bdd (plat)-----*/
                /*----------------------------------------------------------*/
                $numeroPlat = 1;
                $_SESSION['listePlats'] = new Plats(PlatDAO::selectListePlat());
                foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
                {
                  $idP = substr($OBJ->getID(), 1) ;
                  if ($numeroPlat < $idP) {
                    $numeroPlat = substr($OBJ->getID(), 1);
                  }
                }

                $cheminPhoto = str_replace(CHR(32),"",strtolower($_POST['txtAjoutNomPlat']));
                $lePlat = new Plat("P".($numeroPlat+1),$_SESSION['RestoRestaurateurSelected'],$_POST['cbxTypeP'],$_POST['txtAjoutNomPlat'],$_POST['txtAjoutPrixPlat'],0,1,$cheminPhoto,$_POST['txtAjoutDescriptionPlat']);
                PlatDAO::ajouterPlat($lePlat);
              }
              else{
                $_SESSION['resultatUpload'] = "Erreur non identifée";
              }
            }
          }
          else{
            $_SESSION['resultatUpload'] = "Extension incorecte";
          }
      }
    }
  }
  else {
    $_SESSION['resultatUpload'] = "Choisir une image";

  }









	/***********************************************************************************************************************************************************************/
  /*----------------------------------------------------------*/
  /*------Affiche un message de resultat (Succés de l'ajout ou l'erreur)-------*/
  /*----------------------------------------------------------*/
  if(isset($_SESSION['resultatUpload'])){
    $formResultat->ajouterComposantLigne($formResultat->creerLabelFor($_SESSION['resultatUpload'], 'lblMsgResult'));
    $formResultat->ajouterComposantTab();
    $formResultat->creerFormulaire();
  }


}


/***********************************************************************************************************************************************************************/

/*----------------------------------------------------------*/
/*--------Affiche la vue Upload typePlat si l'on choix le menu ajouter  type plat-----*/
/*----------------------------------------------------------*/

$formTypePlat = new Formulaire("POST","index.php","formPlat","typeplatRthis");
$numeroTP = 0;
if ($_SESSION['menuDetailResto']== "insertTP"){

	$formTypePlat->ajouterComposantLigne($formTypePlat->concactComposants($formTypePlat->creerLabelFor('Type de Plat : ',"lblTypePlatATP"),
																																				$formTypePlat->creerInputTexte("txtATP","txtATP","","",1,"Entrez le libelle du type de plat"),0));
	$formTypePlat->ajouterComposantTab();
	$formTypePlat->ajouterComposantLigne($formTypePlat->creerInputSubmitPanier("insertTypePlat-btn","insertTypePlat-btn"," Ajouter un type de plat"));
	$formTypePlat->ajouterComposantTab();
	$formTypePlat->creerFormulaire();
	$_SESSION['lesFormsPlatR'] .= $formTypePlat->afficherFormulaire();

	/*----------------------------------------------------------*/
	/*--------Appel de la requete sql pour ajouter dans la bdd (TypePlat)-----*/
	/*----------------------------------------------------------*/
	if(isset($_POST['insertTypePlat-btn'])){
		foreach ($_SESSION['listeTypePlats']->getLesTypePlats() as $OBJ)
		{
			$numeroTP += 1;
		}
		$unTP = new typePlat('TP'.($numeroTP+1),$_POST['txtATP']);
		TypePlatDAO::ajouterTypePlat($unTP);
		$_SESSION['lesFormsPlatR'] = null;
		$formResult = new Formulaire("POST","#","formPlat","resultatthisSucces");
		$formResult->ajouterComposantLigne($formResult->creerLabelFor("Le type de plat a été correctement ajouté","resultatSuppri"));
		$formResult->ajouterComposantTab();
		$formResult->creerFormulaire();
	}
}





/***********************************************************************************************************************************************************************/


/*----------------------------------------------------------*/
/*--------Affiche la vue Modif si l'on choix le menu modifier plat-----*/
/*----------------------------------------------------------*/
if ($_SESSION['menuDetailResto']== "update"){
	foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
	{
		if($OBJ->getIDResto() == $_SESSION['RestoRestaurateurSelected'] ){
			$correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getCheminPhoto());
			$correct = strtolower($correct);
			$correct = 'image/'.$correct;

			$formPlat = new Formulaire("POST","index.php","formPlat","platRthis");
			$formPlat->ajouterComposantLigne($formPlat->creerInputImage('imgPlat', 'imgPlat', $correct));
			$formPlat->ajouterComposantLigne($formPlat->concactComposants($formPlat->creerInputTexte("nomPlatM","nomPlatM","",$OBJ->getNom(),1,"Entrez le nom du plat"),
																			$formPlat->concactComposants($formPlat->creerLabelFor('Type de Plat : ',"lblTypePlatM"),
																			$formPlat->concactComposants($formPlat->creerSelect('typeP','cbxTypeP',$OBJ->getTypePlat()),
																			$formPlat->concactComposants($formPlat->creerLabelFor('Prix : ',"lblPrixPlat"),
																			$formPlat->concactComposants($formPlat->creerInputTexte("prixPlat","prixPlat","",$OBJ->getPrixFournisseur(),1,"Entrez le nom du plat"),
																			$formPlat->concactComposants($formPlat->creerLabelFor('Description : ',"lblDescripPlat"),
																			$formPlat->creerInputTexte("descripPlat","descripPlat","",$OBJ->getDescription(),1,"Entrez le nom du plat"),
																			0),2),0),2),0),2));
			$formPlat->ajouterComposantLigne($formPlat->creerInputSubmitPanier($OBJ->getID(),"updatePlat-btn"," Modifier le plat"));
			$formPlat->ajouterComposantTab();
			$formPlat->creerFormulaire();
			$_SESSION['lesFormsPlatR'] .= $formPlat->afficherFormulaire();
		}
	}
	/*----------------------------------------------------------*/
	/*--------Appel de la requete sql pour modifier dans la bdd(plat)-----*/
	/*----------------------------------------------------------*/
	foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
	{
		if(isset($_POST[$OBJ->getID()])) {
			$lePlat = new Plat($OBJ->getID(),$_SESSION['RestoRestaurateurSelected'],$_POST['cbxTypeP'],$_POST['nomPlatM'],$_POST['prixPlat'],$OBJ->getPrixClient(),1,$OBJ->getCheminPhoto(),$_POST['descripPlat']);
			PlatDAO::updatePlat($lePlat);
			$_SESSION['lesFormsPlatR'] = null;
			$formResult = new Formulaire("POST","#","formPlat","resultatthisSucces");
			$formResult->ajouterComposantLigne($formResult->creerLabelFor("Le plat a été correctement modifié","resultatSuppri"));
			$formResult->ajouterComposantTab();
			$formResult->creerFormulaire();
		}
	}
}








/***********************************************************************************************************************************************************************/

/*----------------------------------------------------------*/
/*--------Affiche les plat pour Delete si l'on choix le menu supprimer  plat-----*/
/*----------------------------------------------------------*/

if ($_SESSION['menuDetailResto']== "delete"){
	foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
	{
		if($OBJ->getIDResto() == $_SESSION['RestoRestaurateurSelected'] ){
			$correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getCheminPhoto());
			$correct = strtolower($correct);
			$correct = 'image/'.$correct;

			$formPlat = new Formulaire("POST","#","formPlat","platRthis");
			$formPlat->ajouterComposantLigne($formPlat->creerInputImage('imgPlat', 'imgPlat', $correct));
			$formPlat->ajouterComposantLigne($formPlat->concactComposants($formPlat->creerLabelFor($OBJ->getNom(),"nomPlat"),
																			$formPlat->concactComposants($formPlat->creerLabelFor('Prix : ',"lblPrixPlat"),
																			$formPlat->concactComposants($formPlat->creerLabelFor($OBJ->getPrixFournisseur()."€","prixPlat"),
																			$formPlat->concactComposants($formPlat->creerLabelFor('Description : ',"lblDescripPlat"),
																			$formPlat->creerLabelFor($OBJ->getDescription(),"descripPlat"),0),4),0),2));
			$formPlat->ajouterComposantLigne($formPlat->creerInputSubmitPanier($OBJ->getID(),"updatePlat-btn"," Supprimer le plat"));
			$formPlat->ajouterComposantTab();
			$formPlat->creerFormulaire();
			$_SESSION['lesFormsPlatR'] .= $formPlat->afficherFormulaire();
		}
	}
	/*----------------------------------------------------------*/
	/*--------Appel de la requete sql pour supprimer dans la bdd-----*/
	/*----------------------------------------------------------*/
	foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
	{
		if(isset($_POST[$OBJ->getID()])) {
			PlatDAO::delPlat($_SESSION['RestoRestaurateurSelected'],$OBJ->getID() );
			$_SESSION['lesFormsPlatR'] = null;
			$formResult = new Formulaire("POST","#","formPlat","resultatthisSucces");
			$formResult->ajouterComposantLigne($formResult->creerLabelFor("Le plat a été correctement supprimé","resultatSuppri"));
			$formResult->ajouterComposantTab();
			$formResult->creerFormulaire();

			/*----------------------------------------------------------*/
			/*--------supprime la photo dans le repertoire image-----*/
			/*----------------------------------------------------------*/
			$dossier_traite = "image";
			$repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
			while (false !== ($fichier = readdir($repertoire))) // On lit chaque fichier du répertoire dans la boucle.
			{
				$chemin = $dossier_traite."/".$fichier; // On définit le chemin du fichier à effacer.
				// Si le fichier n'est pas un répertoire…
				$fichierSelected = $OBJ->getCheminPhoto().".jpeg";
				if ($fichier == $fichierSelected)
	     {
	     	unlink($chemin); // On efface.
	     }
		 	}
		 	closedir($repertoire); // Ne pas oublier de fermer le dossier ***EN DEHORS de la boucle*** ! Ce qui évitera à PHP beaucoup de calculs et des problèmes liés à l'ouverture du dossie
		}
	}



}

/*-------------------------------------------*/
include "vue/vueRestaurateurChgResto.php";
 ?>
