
<?php
$_SESSION['dernierePage'] = "Restaurateur";
$formRestaurateur = new Formulaire("POST","index.php","formRestaurateur","restaurateurthis");
$formResultat = new Formulaire("POST","","formResultat","resultatthis");


/*----------------------------------------------------------*/
/*--------Création du form de l'ajout et autoremplissage avec les données précédentes envoyées au formulaire-----*/
/*----------------------------------------------------------*/
if(isset($_POST['btnAjoutPlat'])){
  $formRestaurateur->ajouterComposantLigne($formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Ajouter un plat', 'lblajoutPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Icône du fichier (JPEG | max. 15 Ko) :', 'lblajoutPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerInputFile('uploadImg','uploadImg',"Parcourir"),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerSep('sepAjoutPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Type de plat : ', 'lblAjoutTypePlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerSelect('typeP','cbxTypeP'),
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
                                         $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Icône du fichier (JPEG | max. 15 Ko) :', 'lblajoutPlat'),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerInputFile('uploadImg','uploadImg',"Parcourir"),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerSep('sepAjoutPlat'),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Type de plat : ', 'lblAjoutTypePlat'),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerSelect('typeP','cbxTypeP'),
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
  $nomPhoto = $_POST['txtAjoutNomPlat'];
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
            $nom = "image/{$nomPhoto}.{$extension_upload}";
            $resultat = move_uploaded_file($_FILES['uploadImg']['tmp_name'],$nom);
            if ($resultat)
            {
              $_SESSION['resultatUpload'] ="Transfert réussi";
              /*----------------------------------------------------------*/
              /*--------Appel de la requete sql pour ajuter dans la bdd-----*/
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
              $lePlat = new Plat("P".($numeroPlat+1),"",$_POST['cbxTypeP'],$_POST['txtAjoutNomPlat'],$_POST['txtAjoutPrixPlat'],0,1,$cheminPhoto,$_POST['txtAjoutDescriptionPlat']);
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
/*----------------------------------------------------------*/
/*------Affiche un message de resultat (Succés de l'ajout ou l'erreur)-------*/
/*----------------------------------------------------------*/
if(isset($_SESSION['resultatUpload'])){
  $formResultat->ajouterComposantLigne($formResultat->creerLabelFor($_SESSION['resultatUpload'], 'lblMsgResult'));
  $formResultat->ajouterComposantTab();
  $formResultat->creerFormulaire();
}





/*-------------------------------------------*/
include "vue/vueRestaurateur.php";
 ?>
