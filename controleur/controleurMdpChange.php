<?php
if (isset($_POST['inscrmdpPrec']) and isset($_POST['inscrmdp']) and isset($_POST['inscrValid'])) {
  if ($_POST['inscrmdpPrec'] == $_SESSION['identite'][4]) {
    if ($_POST['inscrmdp'] == $_POST['inscrmdpconf']) {
        UserDAO::changeMDP($_SESSION['identite'][0],$_SESSION['typeIdentite'],$_POST['inscrmdp']);
        echo '<script type="text/javascript">';
        echo 'window.location.href = "index.php?menuPrincipal='.$_SESSION['dernierePage'].'";';
        echo '</script>';
    }
  }
}
$formChange = new Formulaire('post','index.php','formChange','formChange');
$formChange->ajouterComposantLigne($formChange->creerInputPassPattern('inscrmdpPrec', 'inscrmdpPrec', '','',1,'saisir précédent mot de passe', '[a-zA-Z0-9]{4,20}' ));
$formChange->ajouterComposantTab();
$formChange->ajouterComposantLigne($formChange->creerInputPassPattern('inscrmdp', 'inscrmdp', '','',1,'saisir votre nouveau mot de passe', '[a-zA-Z0-9]{4,20}' ));
$formChange->ajouterComposantTab();
$formChange->ajouterComposantLigne($formChange->creerInputPassPattern('inscrmdpconf', 'inscrmdpconf', '','',1,'confirmer votre nouveau mot de passe','[a-zA-Z0-9]{4,20}' ));
$formChange->ajouterComposantTab();
$formChange->ajouterComposantLigne($formChange->creerInputSubmit('inscrValid', 'inscrValid', "Valider inscription"));
$formChange->ajouterComposantTab();
$formChange->creerFormulaire();
include "vue/vueMdpChange.php"; ?>
