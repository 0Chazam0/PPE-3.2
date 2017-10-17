<script type="text/javascript" src="fonction\fonction.js"></script>
<div class="conteneur">
	<header>

		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class='gauche'>
			<nav class="sidenav">
				<h3 class="titreListe">Les restaurants à <?php  echo ucfirst($_SESSION['VilleSelected']);?></h3>
				<ul>
					<?php
					foreach ($_SESSION['listeVilles']->getLesVilles() as $OBJ2){
						if ($OBJ2->getNom()==ucfirst($_SESSION['VilleSelected'])){
							foreach ($_SESSION['listeRestos']->getLesRestos() as $OBJ)
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
			echo $formResto->afficherFormulaire();
    ?>
    </div>
  </main>

</div>
