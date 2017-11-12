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
			  echo $_SESSION['leFormPlanier'];
			 ?>

    </div>
  </main>


</div>
