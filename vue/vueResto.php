<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class='gauche'>

		</div>
		<div class='droite'>
      <?php
      echo "<table><tr><td>";
      foreach ($listeResto->getLesRestos() as $OBJ)
      {
        echo "<tr>";
        $correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getNom());
        $correct = strtolower($correct);
        echo "<div id='imgResto'><img src='image/" . $correct . "' alt='"
                . $correct . "'>" . $OBJ->getNom() . "</div>";
        echo "</tr>";
      }
      echo "</td></tr></table>";

      ?>
    </div>
  </main>
  <footer>
    <?php include 'bas.php' ;?>
  </footer>
</div>
