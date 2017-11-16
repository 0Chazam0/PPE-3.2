<?php

if (empty($_GET['valider']))
{
  $formCom = new Formulaire("POST","index.php?menuPrincipal=Noter&valider=1","formNoter","note");
  $formCom->ajouterComposantLigne($formCom->creerInputGrandTexte("descrip", 8, 40, ""));
  $formCom->ajouterComposantTab();
  $formCom->ajouterComposantLigne($formCom->creerInputSubmit("note", "note", "Noter"));
  $formCom->ajouterComposantTab();
  $formCom->creerFormulaire();
  include_once "vue/vueNoter.php";
}
else
{
  $nomResto = NoteDAO::selectResto($_SESSION['identite'][0]);
  $nomCommand = NoteDAO::selectIDCommand($_SESSION['identite'][0] , $nomResto);
  $commentaire = $_POST['descrip'];
  NoteDAO::updateNote($_COOKIE['r'], $_COOKIE['q'], $_COOKIE['l'],
                            $_COOKIE['c'], $nomCommand, $commentaire);
  setcookie(r, 0);
  setcookie(q, 0);
  setcookie(l, 0);
  setcookie(c, 0);
  echo '<script type="text/javascript">';
  echo 'window.location.href = "http://127.0.0.1/eclipse-workspace/PPE-3.2/index.php?menuPrincipal=Accueil";';
  echo '</script>';
}


 ?>
