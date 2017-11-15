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

	public function ajouterImage($a, $b, $c)
	{
		$menu = $a;
		$menu .= $b;
		$menu .= $c;
		return $menu;
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
				$menu .= "<a href='index.php?". $nomMenu ;
				$menu .= "=" . $composant[0] . "' >";
				$menu .= "<span>" . $composant[1] ."</span>";
				$menu .= "</a>";
			$menu .= "</li>";
		}
		$menu .= "</ul>";
		return $menu ;
	}
	
	public function creerMenuType($composantActif){
		$menu = "<ul class = '" .  $this->style . "'>";
		foreach($this->composants as $composant){
			if($composant[0] == $composantActif){
				$menu .= "<li class='actif'>";
				$menu .=  $composant[1] ;
			}
			else{
				$menu .= "<li>";
				$menu .= "<a href='index.php?action=afficher" ;
				$menu .= "&TypePlat=" . $composant[0] . "' >";
				$menu .= $composant[1] ;
				$menu .= "</a>";
			}
			$menu .= "</li>";
		}
		$menu .= "</ul>";
		return $menu ;
	}

	}
