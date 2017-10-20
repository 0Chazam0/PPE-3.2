<?php

$_SESSION['listeTypePlats'] = new TypePlats(TypePlatDAO::selectListeTypePlat());
$_SESSION['listePlats'] = new Plats(PlatDAO::selectListePlat());
$_SESSION['RestoSelected'] = $_POST['idResto'];

include 'vue\vuePlat.php';
 ?>
