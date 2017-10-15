<div class="conteneur">
  <header>
      <?php include 'haut.php' ;?>
  </header>

  <main>
    <div class='gauche'>
      <nav class="sidenav">
        <h3 class="titreListe">Les types de plats <?php ;?></h3>
        <ul>
          <?php
          foreach ($_SESSION['listeTypePlats']->getLesTypePlats() as $OBJ)
          {
            echo '<li><a href="#'.$OBJ->getCodeT().'">'.$OBJ->getLibelle().'</a></li>';
          }

           ?>
        </ul>
      </nav>
    </div>
    <div class='droite'>
      <?php
      foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
      {
        if($OBJ->getIDResto() == $_POST['idResto'] ){
          $correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getCheminPhoto());
          $correct = strtolower($correct);
          $correct = 'image/'.$correct;

          $formPlat = new Formulaire("POST","","formPlat","platthis");
          $formPlat->ajouterComposantLigne($formPlat->creerInputImage($OBJ->getNom(), $OBJ->getNom(), $correct));
          $formPlat->ajouterComposantLigne($formPlat->concactComposants($formPlat->creerLabelFor($OBJ->getNom(),"nomPlat"),$formPlat->creerLabelFor($OBJ->getPrixClient(),"prixPlat"),2));
          $formPlat->ajouterComposantLigne($formPlat->creerInputSubmit("ajoutCommande-btn","ajoutCommande-btn","    +    "));
          $formPlat->ajouterComposantTab();
          $formPlat->creerFormulaire();
          echo $formPlat->afficherFormulaire();

        }
      }
    ?>
    </div>
  </main>


</div>
