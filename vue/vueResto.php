<div class="conteneur">
	<header>

		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class='gauche'>
			<nav class="sidenav">
				<h3 class="titreListe">Les restaurants à <?php $recherche = strtolower($_POST['search']); echo ucfirst($recherche);?></h3>
				<ul>
					<?php
					foreach ($listeVilles->getLesVilles() as $OBJ2){
						if ($OBJ2->getNom()==ucfirst($recherche)){
							foreach ($listeRestos->getLesRestos() as $OBJ)
		      		{
								if ($OBJ->getCodeV() == $OBJ2->getCode()){
									echo '<li><a href="#'.$OBJ->getId().'">'.$OBJ->getNom().'</a></li>';
								}
							}
						}
					}
					 ?>
				</ul>
			</nav>
		</div>
		<div class='droite'>
      <?php
      echo "<table><tr><td>";
      foreach ($listeRestos->getLesRestos() as $OBJ)
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

</div>
