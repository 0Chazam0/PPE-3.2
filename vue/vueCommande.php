<div class="conteneur">
  <header>
      <?php include 'haut.php' ;?>
  </header>

    <div id='commande'>
      <?php
      if (isset($_POST['confirmCommande'])) {
        echo $txt;
      }
      else{
        echo $_SESSION['leformCommande'];
      }

      ?>
    </div>

</div>
