<nav class="menuPrincipal">
	<?php

	$formLogo = new Formulaire("post","index.php?menuPrincipal=Accueil","formLogo","formLogo");
	$formLogo->ajouterComposantLigne($formLogo->creerInputLogo("logo","logo","image\logo.jpeg"));
	$formLogo->ajouterComposantTab();
	$formLogo->creerFormulaire();

	echo $leMenuP;
	echo $formLogo->afficherFormulaire();


	?>
	<hr id="separateur_menuP">
</nav>
