<div class="conteneur">
<header>
      <?php include 'haut.php' ;?>
  </header>
  <img src="image\background.jpg" width="100%" height="100%" style="position:absolute;">-->

  <div class="recherche_p">
    <?php
      $formRecherche = new Formulaire("get","controleur\controleurConnexion.php","formRecherche","searchthis");
      $formRecherche->ajouterComposantLigne($formLogo->concactComposants($formRecherche->creerInputTexte("search","search","","Entrez votre ville",1,"Rechercher"),$formRecherche->creerInputSubmit("search-btn","search-btn","Rechercher")));
      $formRecherche->ajouterComposantTab();
      $formRecherche->creerFormulaire();
      echo $formRecherche->afficherFormulaire();
    ?>
  </div>

</div>
