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
  (isset($_COOKIE[r]))?setcookie(r, 0):0;
  (isset($_COOKIE[q]))?setcookie(q, 0):0;
  (isset($_COOKIE[l]))?setcookie(l, 0):0;
  (isset($_COOKIE[c]))?setcookie(c, 0):0;
  if (NoteDAO::selectResto($_SESSION['identite'][0])){
    echo '<script type="text/javascript">';
    echo 'window.location.href = "index.php?menuPrincipal=Noter";';
    echo '</script>';
  }
  else {
    echo '<script type="text/javascript">';
    echo 'window.location.href = "index.php?menuPrincipal=Accueil";';
    echo '</script>';
  }
}


 ?>
