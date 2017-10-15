<?php

$_SESSION['listeVilles'] =new Villes(VilleDAO::selectListeVille());


$_SESSION['listeRestos'] = new Restos(RestoDAO::selectListeResto());

include 'vue\vueResto.php';
 ?>
