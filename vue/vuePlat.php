<script>
function myFunction() {
	document.getElementById("panier").style.background = "red";
	}
</script>
<div class="conteneur">
  <header>
      <?php include 'haut.php' ;?>
  </header>

  <main>

		<div id="baniereResto">
			<?php
			//affiche la banniere avec les infos du resto
				echo $laBanniereResto->afficherFormulaire();
			 ?>
		</div>
    <div id='typePlat'>
        <h3 class="titreListe">Les types de plats |</h3>
        <ul>
          <?php
            echo $lemenuTypePlats;
           ?>
        </ul>

    </div>
    <div class='droitePlat'>
      <?php
      echo $_SESSION['lesFormsPlat'];
    ?>
    </div>
    <div id="panier">
			<?php
			//affiche le panier si il n'y a pas d'utilisateur connecté ou que l'utilisateur n'est pas un restaurateur
			if (!isset($_SESSION['typeIdentite']) || $_SESSION['typeIdentite'] != 'R'){
			  echo $_SESSION['leFormPlanier'];
			}
			 ?>

    </div>
  </main>


</div>
