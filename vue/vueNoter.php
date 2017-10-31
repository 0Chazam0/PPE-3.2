<div class="conteneur">
  <header>
      <?php include 'haut.php' ;?>
  </header>

  <main>
    <img src="image\background.jpg" width="100%" height="100%" style="position:absolute;">

<div class="styleNote">

</head>

<body>
  <a style="text-align:center;">Resto</a>
</br>
<?php
echo '<link rel="stylesheet" type="text/css" href="t.css">';

echo "Rapidite<br />";
$cp_star = "r";
if (empty($_COOKIE[$cp_star])) {
  setcookie("r", 0, time()+3000);
}
include "controleur/controleurStar.php";

echo "<br /><br />Qualite<br />";
if (empty($_COOKIE[$cp_star])) {
  setcookie("q", 0, time()+3000);
}
$cp_star = "q";
include "controleur/controleurStar.php";

echo "<br /><br />Temps de livraison<br />";
if (empty($_COOKIE[$cp_star])) {
  setcookie("l", 0, time()+3000);
}
$cp_star = "l";
include "controleur/controleurStar.php";

echo "<br /><br />Cout<br />";
if (empty($_COOKIE[$cp_star])) {
  setcookie("c", 0, time()+3000);
}
$cp_star = "c";
include "controleur/controleurStar.php";
 ?>
</br>
</br>
  <a href="image\left.png"><img src="image\left.png" width="10%" height="10%"></a>
  <a href="image\right.png"><img src="image\right.png" width="10%" height="10%"></a>
</body>
</main>

</div>
