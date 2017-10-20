<div class="conteneur">
  <header>
      <?php include 'haut.php' ;?>
  </header>

  <main>
<img src="image\background.jpg" width="100%" height="100%" style="position:absolute;">

<!-- <?php

  echo $formRecherche->afficherFormulaire();
?> -->
<div class="styleNote">
<?php require('vote/_drawrating.php'); ?>
<!-- Including JS files | AJAX support -->
<script type="text/javascript" language="javascript" src="js/behavior.js"></script>
<script type="text/javascript" language="javascript" src="js/rating.js"></script>

</head>

<body>
<div id="container">
  <?php echo rating_bar('Rapidite',5); ?>
  <?php echo rating_bar('Qualite',5); ?>
  <?php echo rating_bar('Temps',5); ?>
  <?php echo rating_bar('Cout',5); ?>
</div>
</body>
</main>

</div>
