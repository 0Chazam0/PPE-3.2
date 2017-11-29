<div class="conteneur">
  <header>
      <?php include 'haut.php' ;?>
  </header>

  <main>

      <nav class = "menuProfil">
        <nav class = "photoProfil">
          <?php echo $laPhotoProfil ?>
        </nav>
          <?php
          if(isset($_SESSION['resultatUploadP']) && $_SESSION['resultatUploadP']!=null){
            if($_SESSION['resultatUploadP'] == "Transfert réussi"){
              echo $formResult->afficherFormulaire();
            }
            else{
              echo $formResultat->afficherFormulaire();
            }
          }
          echo $leMenuProfil;

          ?>
      </nav>

          <?php echo $contentProfil;  ?>



  </main>


</div>
