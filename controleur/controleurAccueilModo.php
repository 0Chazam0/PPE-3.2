<?php

$listeUser = AccueilModoDAO::selectUser();
$formUser = new Formulaire("POST","index.php?menuPrincipal=AccueilModo",
"formUser","user");
$test = "<table>";
foreach ($listeUser as $unUser) {
  // $formModo->ajouterComposantLigne($formModo->creerA($nomR));
  // $formModo->ajouterComposantTab();
  print_r($unUser);
  print_r($unUser['IDU']);
  echo "[---->" . $unUser . "]";
  $test = "<tr>";
  $test = "<td>" . $unUser['id'] . "</td><td>" . $unUser['nom'] . "</td>";
  $test = "</tr>";

}
$test = "</table>";
$formModo->creerFormulaire();

//require_once 'vue/vueAccueilModo.php';

?>
