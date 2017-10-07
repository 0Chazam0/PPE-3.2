<?php

class Menu{
	private $style;
	private $composants = array();

	
	public function __construct($unStyle ){
		$this->style = $unStyle;
	}


	public function ajouterComposant($unComposant){
		$this->composants[] = $unComposant;
	}



	public function creerItemLien($unLien,$uneValeur){
		$composant = array();
		$composant[0] = $unLien ;
		$composant[1] = $uneValeur ;
		return $composant;
	}


	public function creerMenu($nomMenu){
		$menu = "<ul class = '" .  $this->style . "'>";
		foreach($this->composants as $composant){
				$menu .= "<li>";
				$menu .= "<a href='index.php?" . $nomMenu ;
				$menu .= "=" . $composant[0] . "' >";
				$menu .= "<span>" . $composant[1] ."</span>";
				$menu .= "</a>";
			$menu .= "</li>";
		}
		$menu .= "</ul>";
		return $menu ;
	}



}
