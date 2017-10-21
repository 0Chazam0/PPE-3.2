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
            echo $lemenuTypeRestos;
					 ?>
				</ul>
			</nav>
		</div>
		<div class='droite'>
      <?php
			echo $_SESSION['lesFormsResto'];
    	?>
    </div>
  </main>

</div>
