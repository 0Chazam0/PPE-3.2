<div class="conteneur"> -->
  <header>
      <?php include 'haut.php' ;?>
  </header>

  <main>
    <img src="image\background.jpg" width="100%" height="100%" style="position:absolute;">

<div class="styleNote">
<?php require 'vote/_drawrating.php';?>
<!-- Including JS files | AJAX support -->
<script type="text/javascript" language="javascript" src="js/behavior.js"></script>
<script type="text/javascript" language="javascript" src="js/rating.js"></script>

</head>

<body>
  <?php
  echo "Rapidité:\n";
  echo rating_bar('Rapidite',5);
  echo "Qualité:\n";
  echo rating_bar('Qualite',5);
  echo "Temps de livraison:\n";
  echo rating_bar('Temps',5);
  echo "Cout:\n";
  echo rating_bar('Cout',5);
  echo "Commentaire: \n";
  echo $formRecherche->afficherFormulaire();
  ?>
</body>
</main>

</div>
