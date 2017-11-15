<script>
function myFunction(i) {
  if(i ==null){
    alert("Choisir une image");
  }
  else if (i == 1) {
    alert("Transfert réussi");
  }
  else if (i == 2) {
    alert("Le fichier est trop gros");
  }
  else if (i == 3) {
    alert("Erreur lors du transfert");
  }
  else if (i == 4) {
    alert("Image trop grande");
  }
  else if (i == 5) {
    alert("Erreur non identifée");
  }
  else if (i == 6) {
    alert("Extension incorecte");
  }

}
</script>


<?php
$_SESSION['dernierePage'] = "Restaurateur";

$formRestaurateur = new Formulaire("POST","index.php","formRestaurateur","restaurateurthis");




/*----------------------------------------------------------*/
/*--------Upload une image (conforme) dans le dossier image-----*/
/*----------------------------------------------------------*/
if (isset($_FILES['uploadImg']['name']) && !empty($_FILES['uploadImg']['name'])) {
  $extensions_valides = array('jpeg');
  $image_sizes = getimagesize($_FILES['uploadImg']['tmp_name']);
  $nomPhoto = $_POST['txtTitreImage'];
  //La taille du fichier en octets.
  if ($_FILES['uploadImg']['size'] > 1000000) {
    $erreur = 2;
  }
  else{
    if ($_FILES['uploadImg']['error'] > 0) {
      $erreur = 3;
    }
      else{
        $extension_upload = strtolower(  substr(  strrchr($_FILES['uploadImg']['name'], '.')  ,1)  );
        //Parcourt le tableau de possibilité d'extention
        if (in_array($extension_upload,$extensions_valides) ){
          if ($image_sizes[0] > 300 OR $image_sizes[1] > 300) {
              $erreur = 4;
          }
          else{
            $nom = "image/{$nomPhoto}.{$extension_upload}";
            $resultat = move_uploaded_file($_FILES['uploadImg']['tmp_name'],$nom);
            if ($resultat)
            {
              $erreur = 1;
            }
            else{
              $erreur = 5;
            }
          }
        }
        else{
          $erreur = 6;
        }
    }
  }
}
else {
  $erreur = null;

}


/*----------------------------------------------------------*/
/*--------Création du form de l'ajout et autoremplissage avec les données précédentes envoyées au formulaire-----*/
/*----------------------------------------------------------*/
if(isset($_POST['btnAjoutPlat'])){
  $formRestaurateur->ajouterComposantLigne($formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Ajouter un plat', 'lblajoutPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Icône du fichier (JPEG | max. 15 Ko) :', 'lblajoutPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerInputFile('uploadImg','uploadImg',"Parcourir"),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Titre de l\'image : ', 'lblajoutPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtTitreImage","txtTitreImage","",$_POST['txtTitreImage'],1,"Entrez votre titre d'image"),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerSep('sepAjoutPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Type de plat : ', 'lblAjoutTypePlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutTypePlat","txtAjoutTypePlat","",$_POST['txtAjoutTypePlat'],1,"Entrez votre type de plat"),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Nom du Plat : ', 'lblAjoutNomPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutNomPlat","txtAjoutNomPlat","",$_POST['txtAjoutNomPlat'],1,"Entrez le nom du plat"),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Prix du Plat : ', 'lblAjoutPrixPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutPrixPlat","txtAjoutPrixPlat","",$_POST['txtAjoutPrixPlat'],1,"Entrez le prix du plat"),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Desciption du plat : ', 'lblAjoutDescriptionPlat'),
                                           $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutDescriptionPlat","txtAjoutDescriptionPlat","",$_POST['txtAjoutDescriptionPlat'],1,"Entrez la description du plat"),
                                           $formRestaurateur->creerInputSubmitOnClick("btnAjoutPlat","btnAjoutPlat","Ajouter le plat",$erreur),
                                           2),0),2),0),2),0),2),0),2),3),0),2),0),3));
  $formRestaurateur->ajouterComposantTab();
  $formRestaurateur->creerFormulaire();

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

$lePlat = new Plat("P".($numeroPlat+1),"",$_POST['txtAjoutTypePlat'],$_POST['txtAjoutNomPlat'],$_POST['txtAjoutPrixPlat'],0,1,$_POST['txtTitreImage'],$_POST['txtAjoutDescriptionPlat']);
PlatDAO::ajouterPlat($lePlat);

}



/*----------------------------------------------------------*/
/*--------Création du form de l'ajout de base-----*/
/*----------------------------------------------------------*/
else{

$formRestaurateur->ajouterComposantLigne($formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Ajouter un plat', 'lblajoutPlat'),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Icône du fichier (JPEG | max. 15 Ko) :', 'lblajoutPlat'),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerInputFile('uploadImg','uploadImg',"Parcourir"),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Titre de l\'image : ', 'lblajoutPlat'),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtTitreImage","txtTitreImage","","",1,"Entrez votre titre d'image"),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerSep('sepAjoutPlat'),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Type de plat : ', 'lblAjoutTypePlat'),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutTypePlat","txtAjoutTypePlat","","",1,"Entrez votre type de plat"),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Nom du Plat : ', 'lblAjoutNomPlat'),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutNomPlat","txtAjoutNomPlat","","",1,"Entrez le nom du plat"),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Prix du Plat : ', 'lblAjoutPrixPlat'),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutPrixPlat","txtAjoutPrixPlat","","",1,"Entrez le prix du plat"),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerLabelFor('Desciption du plat : ', 'lblAjoutDescriptionPlat'),
                                         $formRestaurateur->concactComposants($formRestaurateur->creerInputTexte("txtAjoutDescriptionPlat","txtAjoutDescriptionPlat","","",1,"Entrez la description du plat"),
                                         $formRestaurateur->creerInputSubmitOnClick("btnAjoutPlat","btnAjoutPlat","Ajouter le plat",$erreur),
                                         2),0),2),0),2),0),2),0),2),3),0),2),0),3));
$formRestaurateur->ajouterComposantTab();
$formRestaurateur->creerFormulaire();
}



/*-------------------------------------------*/
include "vue/vueRestaurateur.php";
 ?>
