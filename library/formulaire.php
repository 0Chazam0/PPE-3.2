

</script>
<?php
class Formulaire{
	private $method;
	private $action;
	private $nom;
	private $style;
	private $formulaireToPrint;

	private $ligneComposants = array();
	private $tabComposants = array();

	public function __construct($uneMethode, $uneAction , $unNom,$unStyle ){
		$this->method = $uneMethode;
		$this->action =$uneAction;
		$this->nom = $unNom;
		$this->style = $unStyle;
	}
	public function concactComposants($unComposant , $autreComposant ,$nbRetourLigne){
		for ($i=0; $i < $nbRetourLigne ; $i++) {
			$unComposant .= '<br>';
		}
		$unComposant .=  $autreComposant;
		return $unComposant ;
	}

	public function ajouterComposantLigne($unComposant){
		$this->ligneComposants[] = $unComposant;
	}

	public function ajouterComposantTab(){
		$this->tabComposants[] = $this->ligneComposants;
		$this->ligneComposants = array();
	}

	public function creerRange($max, $step, $id)
	{
		$composant = '
		<div id="slidecontainer">
		<input type="range" class="slider" value="0" id="' . $id . '"
		max="' . $max . '" min="0" step="' . $step . '">
		</div>';
		return $composant;
	}

	public function creerA($value)
	{
		$composant = "<a>" . $value . "</a>";
		return $composant;
	}

	public function creerLabelFor($unLabel,$unNom){
		$composant = "<label style='width: 10px;height: 10px;' class = '" . $unNom . "' />" . $unLabel . "</label>";
		return $composant;
	}

	public function creerInputTexte($unNom, $unId, $unLabel, $uneValue , $required , $placeholder){
		$composant = "<input type = 'text' name = '" . $unNom . "' id = '" . $unId . "' ";
		if (!empty($uneValue)){
			$composant .= "value = '" . $uneValue . "' ";
		}
		if (!empty($placeholder)){
			$composant .= "placeholder = '" . $placeholder . "' ";
		}
		if ( $required == 1){
			$composant .= "required";
		}
		$composant .= "/>";
		return $composant;
	}

	public function creerInputGrandTexte($name, $rows, $cols, $message)
	{
		$composant = '
		<textarea name="' . $name . '" rows="' . $rows . '" cols="' . $cols . '">
		' . $message . '
		</textarea>';
		return $composant;
	}

	public function creerInputPassword($unNom, $unId, $unLabel, $uneValue , $required , $placeholder){
		$composant = "<tr><td><label for = '" . $unNom . "' />" . $unLabel . "</label></td>";
		$composant .= "<td><input type = 'password' name = '" . $unNom . "' id = '" . $unId . "' ";
		if (!empty($uneValue)){
			$composant .= "value = '" . $uneValue . "' ";
		}
		if (!empty($placeholder)){
			$composant .= "placeholder = '" . $placeholder . "' ";
		}
		if ( $required == 1){
			$composant .= "required";
		}
		$composant .= "/></td></tr>";
		return $composant;
	}
	

	public function creerSelect($unNom, $unId, $unLabel, $options){
		$composant = "<tr><td><label for = '" . $unNom . "' />" . $unLabel . "</label></td>";
		$composant .= "<td><select  name = '" . $unNom . "' id = '" . $unId . "' >";
		foreach ($options as $option){
			$composant .= "<option value = " ;
		}
		$composant .= "</select></td></tr>";
		return $composant;
	}

	public function creerInputSubmit($unNom, $unId, $uneValue){
		$composant = "<input type = 'submit' name = '" . $unNom . "' id = '" . $unId . "' ";
		$composant .= "value = '" . $uneValue . "'/> ";
		return $composant;
	}
	public function creerButtonOnClick($unId,$uneValue){
		$composant = "<button onclick='myFunction()' id = '" . $unId . "'> $uneValue </button> ";
		return $composant;
	}

	public function creerInputSubmitHidden($unNom, $unId, $uneValue){
		$composant = "<input type = 'hidden' name = '" . $unNom . "' id = '" . $unId . "' ";
		$composant .= "value = '" . $uneValue . "'/> ";
		return $composant;
	}
	public function creerInputLogo($unNom, $unId, $uneSource){
		$composant = "<a href='index.php?menuPrincipal=Accueil'><input style='width:90px;margin-top:-10px;margin-left:50px;'  type = 'image' name = '" . $unNom . "' id = '" . $unId . "' ";
		$composant .= "src = '" . $uneSource . "'/></a> ";
		return $composant;
	}
	public function creerInputImage($unNom, $uneClasse, $uneSource){
		$composant = "<input style='width:300px;' type = 'image' name = '" . $unNom . "' class= '" . $uneClasse . "' ";
		$composant .= "src = '" . $uneSource . "'/> ";
		return $composant;
	}


	public function creerFormulaire(){

		$this->formulaireToPrint = "<form method = '" .  $this->method . "' ";
		$this->formulaireToPrint .= "action = '" .  $this->action . "' ";
		$this->formulaireToPrint .= "name = '" .  $this->nom . "' ";
		$this->formulaireToPrint .= "class = '" .  $this->style . "' ><table>";


		foreach ($this->tabComposants as $uneLigneComposants){
			$this->formulaireToPrint .= "<tr><td><table>";
			foreach ($uneLigneComposants as $unComposant){
				$this->formulaireToPrint .= "<td>";
				$this->formulaireToPrint .= $unComposant ;
				$this->formulaireToPrint .= "</td>";
			}
			$this->formulaireToPrint .= "</table></td></tr>";
		}
		$this->formulaireToPrint .= "</table></form>";
		return $this->formulaireToPrint ;
	}

	public function afficherFormulaire(){
		return $this->formulaireToPrint ;
	}

}
