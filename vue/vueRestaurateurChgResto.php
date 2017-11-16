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
      if ($_SESSION['menuDetailResto']== "profil"){
        echo $formProfil->afficherFormulaire();
      }
      if ($_SESSION['menuDetailResto']== "insert"){
        if(isset($_SESSION['resultatUpload'])){
          echo $formResultat->afficherFormulaire();
        }
        echo $formRestaurateur->afficherFormulaire();
      }
      if ($_SESSION['menuDetailResto']== "update"){
        echo $_SESSION['lesFormsPlatR'];
      }
      if ($_SESSION['menuDetailResto']== "delete"){
        echo $_SESSION['lesFormsPlatR'];
      }
    ?>

</div>
