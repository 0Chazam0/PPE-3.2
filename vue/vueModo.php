<div class="conteneur">
<header>
      <?php include 'haut.php' ;?>
  </header>
  <img src="image\background.jpg" width="100%" height="100%" style="position:absolute;">
  <div id="txtModo">

  </div>
  <!-- <div class="gestModo"> -->
    <div class="styleNote">
  <?php
  if(isset($formModo))
  {
    echo $formModo->afficherFormulaire();
  }
  else {
    echo '<script type="text/javascript">';
    echo 'window.location.href = "index.php?menuPrincipal=Accueil";';
    echo '</script>';
  }

  ?>
  </div>

</div>
