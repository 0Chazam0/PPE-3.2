<script type="text/javascript" src="fonction\fonction.js"></script>
<div class="conteneur">
	<header>

		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class='gauche'>
			<nav class="sidenav">
				<h3 class="titreListe">Les restaurants à <?php  echo ucfirst($_SESSION['VilleSelected']);?></h3>
				<ul>
					<?php
					foreach ($_SESSION['listeVilles']->getLesVilles() as $OBJ2){
						if ($OBJ2->getNom()==ucfirst($_SESSION['VilleSelected'])){
							foreach ($_SESSION['listeRestos']->getLesRestos() as $OBJ)
		      		{
								if ($OBJ->getCodeV() == $OBJ2->getCode()){
									echo '<li><a href="#'.$OBJ->getId().'">'.$OBJ->getNom().'</a></li>';
								}
							}
						}
					}
					 ?>
				</ul>
			</nav>
		</div>
		<div class='droite'>
      <?php
			foreach ($_SESSION['listeVilles']->getLesVilles() as $OBJ2){
			  if ($OBJ2->getNom()==ucfirst($_SESSION['VilleSelected'])){
			    foreach ($_SESSION['listeRestos']->getLesRestos() as $OBJ)
			    {
			      if ($OBJ->getCodeV() == $OBJ2->getCode()){
			          $correct = preg_replace('#[\\/\'" éàâäêçèë]#', "", $OBJ->getNom());
			          $correct = strtolower($correct);
			          $correct = 'image/'.$correct;

			          if (!isset($_SESSION['identite'])) {
			            $page = 'Connexion';
			          }
			          else{
			            $page = 'Plat';
			          }

			          $formResto = new Formulaire("POST","index.php?menuPrincipal=".$page."","formResto","restothis");
			          $formResto->ajouterComposantLigne($formResto->creerInputImage('imgResto', 'imgResto', $correct));
			          $formResto->ajouterComposantLigne($formResto->concactComposants($formResto->creerLabelFor($OBJ->getNom(),"nomResto"),$formResto->creerLabelFor($OBJ->getNumAdr()." ".$OBJ->getRueAdr() ." ". $OBJ->getCP(),'adrResto'),2));
			          $formResto->ajouterComposantLigne($formResto->creerInputSubmit("plat-btn","plat-btn","    Nos Plats   "));
			          $formResto->ajouterComposantLigne($formResto->creerInputSubmitHidden("idResto","idResto",$OBJ->getId()  ));
			          $formResto->ajouterComposantTab();
			          $formResto->creerFormulaire();
								echo $formResto->afficherFormulaire();
			        }
			      }
			    }
			}

    ?>
    </div>
  </main>

</div>
