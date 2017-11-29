<div class="conteneur">
  <header>
      <?php include 'haut.php' ;?>
  </header>

  <main>

      <nav class = "menuProfil">
        <nav class = "photoProfil">
          <?php echo $laPhotoProfil ?>
        </nav>
          <?php echo $leMenuProfil;
            if(isset($_SESSION['resultatUploadP']) && $_SESSION['resultatUploadP']=="Transfert réussi"){
              echo $formResult->afficherFormulaire();
            }
            else{
              echo $formResultat->afficherFormulaire();
            }

          ?>
      </nav>

          <?php echo $contentProfil;  ?>



  </main>


</div>
