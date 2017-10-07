<div class="conteneur">
<header>
      <?php include 'haut.php' ;?>
  </header>
  <img src="image\background.jpg" width="100%" height="100%" style="position:absolute;">-->
  <div id="txtAccueil">
    <p>Régalez-vous d'un toucher</p>
    <br>
    Plus de 5 000 restaurants vous attendent avec des offres exclusives
  </div>
  <div class="recherche_p">
    <?php
      $formRecherche = new Formulaire("get","controleur\controleurResto.php","formRecherche","searchthis");
      $formRecherche->ajouterComposantLigne($formLogo->concactComposants($formRecherche->creerInputTexte("search","search","","",1,"Entrez votre ville"),$formRecherche->creerInputSubmit("search-btn","search-btn","Rechercher")));
      $formRecherche->ajouterComposantTab();
      $formRecherche->creerFormulaire();
      echo $formRecherche->afficherFormulaire();
    ?>
    <script type="text/javascript" src="fonction\autocomplete.js"></script>
  </div>

</div>
