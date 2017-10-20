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
    <div class='droitePlat'>
      <?php
      foreach ($_SESSION['listePlats']->getLesPlats() as $OBJ)
      {
        if($OBJ->getIDResto() == $_POST['idResto'] ){


          $correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getCheminPhoto());
          $correct = strtolower($correct);
          $correct = 'image/'.$correct;

          $formPlat = new Formulaire("POST","index.php","formPlat","platthis");
          $formPlat->ajouterComposantLigne($formPlat->creerInputImage('imgPlat', 'imgPlat', $correct));
          $formPlat->ajouterComposantLigne($formPlat->concactComposants($formPlat->creerLabelFor($OBJ->getNom(),"nomPlat"),
                                          $formPlat->concactComposants($formPlat->creerLabelFor('Prix : ',"lblPrixPlat"),
                                          $formPlat->concactComposants($formPlat->creerLabelFor($OBJ->getPrixClient()."€","prixPlat"),
                                          $formPlat->concactComposants($formPlat->creerLabelFor('Description : ',"lblDescripPlat"),
                                          $formPlat->creerLabelFor($OBJ->getDescription(),"descripPlat"),0),4),0),2));
          $formPlat->ajouterComposantLigne($formPlat->creerInputSubmit("ajoutCommande-btn","ajoutCommande-btn","    +    "));
          $formPlat->ajouterComposantTab();
          $formPlat->creerFormulaire();
          echo $formPlat->afficherFormulaire();

        }
      }

    ?>
    </div>
    <div class="panier">


    </div>
  </main>


</div>
