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
  </main>


</div>
