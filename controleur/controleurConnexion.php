<?php //définition du formulaire

if (isset($_POST['id']) && isset($_POST['mdp'])) {
  $unUserC = UserDAO::unUserC($_POST['id']);
  $unUserA = UserDAO::unUserA($_POST['id']);
  $unUserM = UserDAO::unUserM($_POST['id']);
  $unUserR = UserDAO::unUserR($_POST['id']);
  if ($unUserA != NULL) {
    $unUser = $unUserA;
  }
  elseif ($unUserC != NULL) {
    $unUser = $unUserC;
  }
  elseif ($unUserM != NULL) {
    $unUser = $unUserM;
  }
  elseif ($unUserR != NULL) {
    $unUser = $unUserR;
  }
  else {
    $unUser ='';
  }
  if ($unUser != '') {
    if ($unUser[4]==$_POST['mdp'] ) {
      $_SESSION['identite'] = $unUser;
    }
  }
}


if (isset($_SESSION['identite'])) {
  $contentConnex = "
    <div class='contentConnexion'>
      <div class='btn'>
        <form method='post' action='index.php'>
          <div class='ligne'>
            <input type = 'submit' value = 'Deconnecter'/>
            <input id ='deco' type = 'hidden' name='deco' value=''/>
          </div>
        </form>
      </div>
    </div>";
}
else {
  $contentConnex="
    <form method='post' action='index.php'>
      <div class='contentConnexion'>
        <div class='btnIdent'>
              <input id ='id' type = 'text' placeholder='Saisir votre identifiant' name='id' value=''/>
              <br/>
              <br/>
              <input id='mdp' type = 'password' placeholder='Saisir votre code' name='mdp' value=''/><br/><br/>
              <input id = 'validCo' type = 'submit' value = 'Valider'/>
              <input type = 'reset' value ='Annuler'/>
        </div>
      </div>
    </form>
      <a class ='mdpOublie' href='controleur/controleurMdpOublie.php'>Mot depasse oublié ? </a>";
}
include "vue/vueConnexion.php";
?>
