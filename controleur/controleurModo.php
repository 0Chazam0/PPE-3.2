<?php

if (isset($_POST['accepter'])){
  $noteAMode = NoteDAO::selectModeNote();
  $idCommande = $noteAMode[0]['IDC'];
  NoteDAO::updateModeSee($idCommande, 2);
  echo '<script type="text/javascript">';
  echo 'window.location.href = "index.php?menuPrincipal=Modo";';
  echo '</script>';
}
elseif (isset($_POST['refuser'])) {
  $noteAMode = NoteDAO::selectModeNote();
  $idCommande = $noteAMode[0]['IDC'];
  NoteDAO::updateModeSee($idCommande, 3);
  echo '<script type="text/javascript">';
  echo 'window.location.href = "index.php?menuPrincipal=Modo";';
  echo '</script>';
}
else{
  $noteAMode = NoteDAO::selectModeNote();
  if (empty($noteAMode)){
    echo '<script type="text/javascript">';
    echo 'window.location.href = "index.php?menuPrincipal=Accueil";';
    echo '</script>';
  }
  else {
    $nomR = $noteAMode[0]['NOMR'];
    //$idUser = $noteAMode
    $noteTemps = $noteAMode[0]['NOTETEMP'];
    $noteQualite = $noteAMode[0]['NOTEQUALITE'];
    $noteR = $noteAMode[0]['NOTERAPIDITE'];
    $noteCout = $noteAMode[0]['NOTECOUT'];
    $commentaire = $noteAMode[0]['COMMENTAIRE'];

    $formModo = new Formulaire("POST","index.php?menuPrincipal=Modo",
    "formModo","modo");
    $formModo->ajouterComposantLigne($formModo->creerA($nomR));
    $formModo->ajouterComposantTab();
    $formModo->ajouterComposantLigne($formModo->creerA("Note temps: " . $noteTemps));
    $formModo->ajouterComposantTab();
    $formModo->ajouterComposantLigne($formModo->creerA("Note qualit: " . $noteQualite));
    $formModo->ajouterComposantTab();
    $formModo->ajouterComposantLigne($formModo->creerA("Note sur la rapidite: " . $noteR));
    $formModo->ajouterComposantTab();
    $formModo->ajouterComposantLigne($formModo->creerA("Note sur le cout: " . $noteCout));
    $formModo->ajouterComposantTab();
    $formModo->ajouterComposantLigne($formModo->creerA("Commentaire: " . $commentaire));
    $formModo->ajouterComposantTab();
    $formModo->ajouterComposantLigne($formModo->creerInputSubmit("accepter", "accepter",
                "Accepter"));
    $formModo->ajouterComposantTab();
    $formModo->ajouterComposantLigne($formModo->creerInputSubmit("refuser", "refuser",
                "Refuser"));
    $formModo->ajouterComposantTab();
    $formModo->creerFormulaire();
    include_once 'vue/vueModo.php';
  }

}
?>
