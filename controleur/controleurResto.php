<?php

$listeRestos = new Restos(RestoDAO::selectListeResto());

include 'vue\vueResto.php';
 ?>
