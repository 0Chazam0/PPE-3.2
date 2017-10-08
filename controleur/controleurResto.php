<?php
$listeVilles =new Villes(VilleDAO::selectListeVille());
$listeRestos = new Restos(RestoDAO::selectListeResto());

include 'vue\vueResto.php';
 ?>
