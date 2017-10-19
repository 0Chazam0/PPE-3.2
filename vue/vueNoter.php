<div class="noter">

<?php

  echo $formRecherche->afficherFormulaire();
?>
  <p>Value: <span id="voirRapid"></span></p>
  <p>Value: <span id="voirQual"></span></p>
  <p>Value: <span id="voirTemp"></span></p>
  <p>Value: <span id="voirCout"></span></p>
</div>

<script>
var slider = document.getElementById("noteRapidite");
var output = document.getElementById("voirRapid");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}

var sliQ = document.getElementById("noteQualite");
var seeQ = document.getElementById("voirQual");
seeQ.innerHTML = sliQ.value;

sliQ.oninput = function() {
  seeQ.innerHTML = this.value;
}

var sliT = document.getElementById("noteTemp");
var seeT = document.getElementById("voirTemp");
seeT.innerHTML = sliT.value;

sliT.oninput = function() {
  seeT.innerHTML = this.value;
}

var sliC = document.getElementById("noteCout");
var seeC = document.getElementById("voirCout");
seeC.innerHTML = sliC.value;

sliC.oninput = function() {
  seeC.innerHTML = this.value;
}

</script>

</div>
