<div class="conteneur">
  <header>
    <?php include 'haut.php' ;?>
  </header>
  <div class='gaucheRP'>
    <nav class="sidenavRP">

      <ul>
        <?php
          echo $formDetailsResto->afficherFormulaire();
         ?>
      </ul>
    </nav>
  </div>
    <?php
    //affichage de form differents selon le menu choisit
      if ($_SESSION['menuDetailResto']== "profil"){
        echo $formProfil->afficherFormulaire();
      }



      if ($_SESSION['menuDetailResto']== "insert"){
        if(isset($_POST['btnAjoutPlat']))
        {
          if(isset($formResult))
          {
            echo $formResult->afficherFormulaire();
          }
          else{
            echo $formResultat->afficherFormulaire();
            echo $formRestaurateur->afficherFormulaire();
          }
        }
        else {
          echo $formRestaurateur->afficherFormulaire();
        }
      }






      if ($_SESSION['menuDetailResto']== "insertTP"){
        if(isset($_POST['insertTypePlat-btn']))
        {
      		if(preg_match("/^[a-zA-Z]{0,25}$/",$_POST['txtATP']))
      		{
            echo $formResult->afficherFormulaire();
          }
          else{
            echo $formResultat->afficherFormulaire();
            echo $_SESSION['lesFormsPlatR'];
          }
        }
        else {
          echo $_SESSION['lesFormsPlatR'];
        }
      }

      if ($_SESSION['menuDetailResto']== "update"){
        if($_SESSION['lesFormsPlatR']!=null){
          echo $_SESSION['lesFormsPlatR'];
        }
        elseif (isset($formResult)) {
          echo $formResult->afficherFormulaire();
        }
      }
      if ($_SESSION['menuDetailResto']== "delete"){
        if($_SESSION['lesFormsPlatR']!=null){
          echo $_SESSION['lesFormsPlatR'];
        }
        elseif (isset($formResult)) {
          echo $formResult->afficherFormulaire();
        }
      }
    ?>

</div>
