<div class="conteneur">
  <header>
    <?php include 'haut.php' ;?>
  </header>
  <main>
		<div class='gauche'>
			<nav class="sidenav">
				<h3 class="titreListe">Les restaurants de <?php  echo ucfirst($_SESSION['identite'][1]);?></h3>
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
