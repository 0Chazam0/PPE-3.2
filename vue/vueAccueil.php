<div class="conteneur">
<header>
      <?php include 'haut.php' ;?>
  </header>
  <?php
  if (isset ($_GET['btn_hide']) && $_GET['btn_hide']=="recherche"){
    include 'controleur\controleurResto.php';
  }
  else{
    echo '
  <img src="image\background.jpg" width="100%" height="100%" style="position:absolute;">-->
  <div id="txtAccueil">
    <p>Régalez-vous d\'un toucher</p>
    <br>
    Plus de 5 000 restaurants vous attendent avec des offres exclusives
  </div>
  <div class="recherche_p">';

      $formRecherche = new Formulaire("GET","#","formRecherche","searchthis");
      $formRecherche->ajouterComposantLigne($formLogo->concactComposants($formRecherche->creerInputTexte("search","search","","",1,"Entrez votre ville"),$formRecherche->creerInputSubmit("search-btn","search-btn","Rechercher")));
      $formRecherche->ajouterComposantTab();
      $formRecherche->ajouterComposantLigne($formLogo->creerInputSubmitHidden("btn_hide","btn_hide","recherche"));
      $formRecherche->ajouterComposantTab();
      $formRecherche->creerFormulaire();
      echo $formRecherche->afficherFormulaire();
    }
    ?>
    <script type="text/javascript" src="fonction\autocomplete.js"></script>
  </div>

</div>
