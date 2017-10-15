<?php

  $_SESSION['listeTypePlats'] = new TypePlats(TypePlatDAO::selectListeTypePlat());


include 'vue\vuePlat.php';
 ?>
