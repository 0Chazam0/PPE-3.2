<script type="text/javascript" src="fonction\fonction.js"></script>
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
			foreach ($listeVilles->getLesVilles() as $OBJ2){
				if ($OBJ2->getNom()==ucfirst($recherche)){
					foreach ($listeRestos->getLesRestos() as $OBJ)
					{
						if ($OBJ->getCodeV() == $OBJ2->getCode()){
				        echo "<tr>";
				        $correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getNom());
				        $correct = strtolower($correct);
				        echo "
								<div class='afficheResto'>
									<span>
										<div class='imgResto'>
											<img style='width=300px;' src='image/" . $correct . "' alt='". $correct . "'>
										</div>

										<div class='infoResto'>

											<label for='nomResto'>". $OBJ->getNom() . "</label>
											<br>
											<label for='adrResto'>". $OBJ->getNumAdr()." ".$OBJ->getRueAdr() ." ". $OBJ->getCP() . "</label>
											<br>
											<br>
											<br>
											<br>
											<br>
											<br>

											<button onclick='lienPlat()'>Click me</button>

										</div>
									</span>
								</div>";
				        echo "</tr>";
							}
						}
					}
      }
      echo "</td></tr></table>";

      ?>
    </div>
  </main>

</div>
