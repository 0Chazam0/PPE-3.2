<?php

$listeResto = new Restos(RestoDAO::selectListeResto());
$menuResto = new menu("menuResto");

include 'vue\vueResto.php';
 ?>
