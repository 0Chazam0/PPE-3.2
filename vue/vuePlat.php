<script>
function myFunction() {
	document.getElementById("panier").style.background = "red";
	}
</script>
<div class="conteneur">
  <header>
      <?php //include 'haut.php' ;?>
  </header>

  <main>
    <div class='gauche'>
      <nav class="sidenav">
        <h3 class="titreListe">Les types de plats</h3>
        <ul>
          <?php
            echo $lemenuTypePlats;
           ?>
        </ul>
      </nav>
    </div>
    <div class='droitePlat'>
      <?php
      echo $_SESSION['lesFormsPlat'];
    ?>
    </div>
    <div id="panier">
			<?php
			foreach ($_SESSION['lePanier']->getLesPlats() as $OBJ){
				echo $OBJ->getNom();
			}
			 ?>

    </div>
  </main>


</div>
