<?php

//require_once 'configs/param.php';

$listeResto = new Restos(RestoDAO::selectListeResto());
$menuResto = new menu("menuResto");

require_once 'vue/vueResto.php';
 ?>
