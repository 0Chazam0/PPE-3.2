<div class="conteneur">
  <header>
    <?php include 'haut.php' ;?>
  </header>
  <?php
      if(isset($_SESSION['resultatUpload'])){
        echo $formResultat->afficherFormulaire();
      }
      echo $formRestaurateur->afficherFormulaire();

    ?>

</div>
