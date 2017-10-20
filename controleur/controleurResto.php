<?php

$_SESSION['listeVilles'] =new Villes(VilleDAO::selectListeVille());
$_SESSION['listeRestos'] = new Restos(RestoDAO::selectListeResto());
$_SESSION['VilleSelected'] = strtolower($_POST['search']);


include 'vue\vueResto.php';
 ?>
