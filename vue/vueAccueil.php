<div class="conteneur">
<header>
      <?php include 'haut.php' ;?>
  </header>
  <?php

    echo '
  <img src="image\background.jpg" width="100%" height="100%" style="position:absolute;">-->
  <div id="txtAccueil">
    <p>Régalez-vous d\'un toucher</p>
    <br>
    Plus de 5 000 restaurants vous attendent avec des offres exclusives
  </div>
  <div class="recherche_p">';

    
      echo $formRecherche->afficherFormulaire();

    ?>

  </div>

</div>
