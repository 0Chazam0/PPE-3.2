<?php

$listeTypePlat = new TypePlats(TypePlatDAO::selectListeTypePlat());

include 'vue\vuePlat.php';
 ?>
