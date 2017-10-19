<div class="noter">

<?php

  echo $formRecherche->afficherFormulaire();
?>
  <p>Value: <span id="demo"></span></p>
</div>

<script>
var slider = document.getElementById("noteRapidite");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>

</div>
