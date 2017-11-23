<?php

if (isset($_POST['accepter'])){

}
else{
  $noteAMode = NoteDAO::selectModeNote();
  $nomR = $noteAMode[0]['NOMR'];
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
}

include_once 'vue/vueModo.php';
?>
