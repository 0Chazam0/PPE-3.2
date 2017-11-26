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

	/********************************************************************/
	/*ajout ligne/ retour / concatenation des obj  formulaire   *************/
	/***********************************************************************/
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
	/****************************************************/
	/**********fonction qui crée un séparateur *************/
	/****************************************************/
	public function creerSep($id)
	{
		$composant = "<hr id=" . $id . ">";
		return $composant;
	}

	/****************************************************/
	/**********fonction qui crée un lien *************/
	/****************************************************/

	public function creerA($value)
	{
		$composant = "<a>" . $value . "</a>";
		return $composant;
	}
	/****************************************************/
	/**********fonction qui crée un label  *************/
	/****************************************************/
	public function creerLabelFor($unLabel,$unNom){
		$composant = "<label style='width: 10px;height: 10px;' class = '" . $unNom . "' />" . $unLabel . "</label>";
		return $composant;
	}


	/****************************************************/
	/***************fonction qui crée les input    *********************/
	/****************************************************/


	public function creerSelect($type,$id,$selected){
		$composant = "<select  name = '" . $id . "' id = '" . $id . "' >";
		if ($type=='jour') {
			for ($i=1; $i <= 31 ; $i++) {
				$composant .="<option>" . $i;
			}
		}
		if ($type=='mois') {
			for ($i=1; $i <= 12 ; $i++) {
				$composant .="<option>" . $i;
			}
		}
		if ($type=='annee') {
			for ($i=2017; $i <= 2019 ; $i++) {
				$composant .="<option>" . $i;
			}
		}
		if ($type=='heure') {
			for ($i=1; $i <= 24 ; $i++) {
				$composant .="<option>" . $i;
			}
		}
		if ($type=='minute') {
			for ($i=0; $i <= 59 ; $i++) {
				$composant .="<option>" . $i;
			}
		}
		if ($type=='typeP') {
			for ($i=1; $i <= 5 ; $i++) {
				$composant .="<option ";
				if("TP".$i == $selected) {$composant .="selected ";}
				$composant .=">TP" . $i;
			}
		}
		$composant .= "</select>";
		return $composant;
	}

	public function creerInputRadio($unNom, $unId, $uneValue){
		$composant = "<input type = 'radio' name = '" . $unNom . "' id = '" . $unId . "' ";
		$composant .= "value = '" . $uneValue . "' required />$uneValue ";
		return $composant;
	}
	public function creerInputSubmit($unNom, $unId, $uneValue){
		$composant = "<input type = 'submit' name = '" . $unNom . "' id = '" . $unId . "' ";
		$composant .= "value = '" . $uneValue . "'/> ";
		return $composant;
	}

	public function creerInputSubmitOnClick($unNom, $unId, $uneValue,$erreur){
		$composant = "<input type = 'submit' name = '" . $unNom . "' id = '" . $unId . "' ";
		$composant .= "onclick='myFunction($erreur)' value = '" . $uneValue . "'/> ";
		return $composant;
	}
	public function creerInputSubmitPanier($unName,$uneClasse,$uneValue){
		$composant = "<input type = 'submit' id = '" . $unName . "'  name = '" . $unName . "' class = '" . $uneClasse . "' ";
		$composant .= "value = '" . $uneValue . "'/> ";
		return $composant;
	}

	public function creerInputSubmitHidden($unNom, $unId, $uneValue){
		$composant = "<input type = 'hidden' name = '" . $unNom . "' id = '" . $unId . "' ";
		$composant .= "value = '" . $uneValue . "'/> ";
		return $composant;
	}
	public function creerInputLogo($unNom, $unId, $uneSource){
		$composant = "<input  type = 'image' name = '" . $unNom . "' id = '" . $unId . "' ";
		$composant .= "src = '" . $uneSource . "'/>";
		return $composant;
	}
	public function creerInputImage($unNom, $uneClasse, $uneSource){
		$composant = "<input style='width:300px;' type = 'image' name = '" . $unNom . "' class= '" . $uneClasse . "' ";
		$composant .= "src = '" . $uneSource . "'/> ";
		return $composant;
	}
	public function creerInputImageStar($unNom, $uneClasse, $uneSource){
		$composant = "<input type = 'image' name = '" . $unNom . "' class= '" . $uneClasse . "' ";
		$composant .= "src = '" . $uneSource . "'/> ";
		return $composant;
	}
	public function creerInputImageProfil($unNom, $uneClasse, $uneSource){
		$composant = "<input type = 'image' name = '" . $unNom . "' class= '" . $uneClasse . "' ";
		$composant .= "src = '" . $uneSource . "'/> ";
		return $composant;
	}
	public function creerInputBanniere($unNom, $uneClasse, $uneSource){
		$composant = "<input style='width:100%;height:400px' type = 'image' name = '" . $unNom . "' class= '" . $uneClasse . "' ";
		$composant .= "src = '" . $uneSource . "'/> ";
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
		$composant .= " autocomplete='off'/>";
		return $composant;
	}
	public function creerInputFile($unName,$uneClasse){
		$composant = "<input type = 'file' id = '" . $unName . "'  name = '" . $unName . "' class = '" . $uneClasse . "'/> ";
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

	public function creerRange($max, $step, $id)
	{
		$composant = '
		<div id="slidecontainer">
		<input type="range" class="slider" value="0" id="' . $id . '"
		max="' . $max . '" min="0" step="' . $step . '">
		</div>';
		return $composant;
	}

	public function creerDebutTabl()
	{
		echo "[aaaa]";
		$composant = '<table id="tabloUser">';
		$composant .= "<tr>
    							<th>ID</th>
    							<th>Nom</th>
									<th>Prenom</th>
  								</tr>";
		return $composant;
	}

	public function creerTabl($id, $nom, $prenom)
	{
		$composant = "<tr>";
	  $composant .= "<td>" . $id . "</td><td>" . $nom . "</td><td>" . $prenom . "</td>";
	  $composant .= "</tr>";
		return $composant;
	}

	public function creerFinTabl()
	{
		return ("</table>");
	}

	/****************************************************/
	/**********Creation et affichage du formulaire   *************/
	/****************************************************/
	public function creerFormulaire(){

		$this->formulaireToPrint = "<form method = '" .  $this->method . "' ";
		$this->formulaireToPrint .= "action = '" .  $this->action . "' enctype='multipart/form-data' ";
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
