<div class="conteneur">
<header>
    <?php include_once 'haut.php'; ?>
</header>
<img src="image\background.jpg" width="100%" height="100%"
style="position:absolute;">
<div id="txtModo">

</div>
<div class="styleNote">
    <?php
    if(isset($formUser))
    {
      echo $formUser->afficherFormulaire();
    }

    ?>

</div>
