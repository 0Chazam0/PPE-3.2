<div class="conteneur">
  <header>
      <?php include 'haut.php' ;?>
  </header>

    <div id='commande'>
      <?php
      //affiche quand la commande est validée
      if (isset($_POST['confirmCommande'])) {
        echo $txt;
      }
      ///affiche le form pour valider la commande
      else{
        echo $_SESSION['leformCommande'];
      }

      ?>
    </div>

</div>
