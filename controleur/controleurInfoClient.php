<?php

$contentConnex = "
  <div class='contentConnexion'>
    <div class='btn'>
      <form method='post' action='index.php'>
        <div class='ligne'>
          <input id = 'deconexion' type = 'submit' value = 'Deconnecter'/>
          <input id ='deco' type = 'hidden' name='deco' value=''/>
        </div>
      </form>
    </div>
  </div>";
include "vue/vueConnexion.php";
 ?>
