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
	public function concactComposants($unComposant , $autreComposant ){
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


	public function creerLabelFor($unLabel){
		$composant = "";
		return $composant;
	}

	public function creerInputTexte($unNom, $unId, $unLabel, $uneValue , $required , $placeholder){
		$composant = "<tr><td><label for = '" . $unNom . "' />" . $unLabel . "</label></td>";
		$composant .= "<td><input type = 'text' name = '" . $unNom . "' id = '" . $unId . "' ";
		if (!empty($uneValue)){
			$composant .= "value = '" . $uneValue . "' ";
		}
		if (!empty($placeholder)){
			$composant .= "placeholder = '" . $placeholder . "' ";
		}
		if ( $required = 1){
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

	public function creerInputLogo($unNom, $unId, $uneSource){
		$composant = "<input style='width:90px;margin-top:-10px;margin-left:50px;' type = 'image' name = '" . $unNom . "' id = '" . $unId . "' ";
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
