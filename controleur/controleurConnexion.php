<?php //définition du formulaire

if (isset($_POST['id']) && isset($_POST['mdp'])) {
  $unUserC = UserDAO::unUserC($_POST['id']);
  $unUserA = UserDAO::unUserA($_POST['id']);
  $unUserM = UserDAO::unUserM($_POST['id']);
  $unUserR = UserDAO::unUserR($_POST['id']);
  if ($unUserA != NULL) {
    $unUser = $unUserA;
    $unUserType = 'A';
  }
  elseif ($unUserC != NULL) {
    $unUser = $unUserC;
    $unUserType = 'C';
  }
  elseif ($unUserM != NULL) {
    $unUser = $unUserM;
    $unUserType = 'M';
  }
  elseif ($unUserR != NULL) {
    $unUser = $unUserR;
    $unUserType = 'R';
  }
  else {
    $unUser ='';
  }
  if ($unUser != '') {
    if ($unUser[4]==$_POST['mdp'] ) {
      $_SESSION['identite'] = $unUser;
      $_SESSION['typeIdentite'] = $unUserType;
      $_SESSION['menuPrincipal']=$_SESSION['dernierePage'];
      $_SESSION['menuPrincipal']="Accueil";
      echo '<script type="text/javascript">';
      echo 'window.location.href = "index.php?menuPrincipal='.$_SESSION['dernierePage'].'";';
      echo '</script>';
    }
  }
}
if (isset($_POST['id'])) {
  $ident = $_POST['id'];
}
else {
  $ident = '';
}
$contentConnex="
  <form method='post' action='index.php'>
    <div class='contentConnexion'>
      <div class='btn'>
            <input id ='id' type = 'text' placeholder='Saisir votre identifiant' name='id' value='".$ident."' pattern='[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})'/>
            <br/>
            <br/>
            <input id='mdp' type = 'password' placeholder='Saisir votre code' name='mdp' value='' pattern='[a-zA-Z0-9]{4,20}'/><br/><br/>
            <input id = 'validCo' type = 'submit' value = 'Valider'/>
            <input type = 'reset' value ='Annuler'/><br>
      </div>
    </div>
  </form>
  <form action='index.php' method='post'>
    <div class='contentConnexion'>
      <div class='btn'>
            <input name ='inscr' type = 'hidden'/>
            <input id = 'inscription' type = 'submit' value ='Pas encore de compte ?'/>
      </div>
    </div>
  </form>
  ";

include "vue/vueConnexion.php";
?>
