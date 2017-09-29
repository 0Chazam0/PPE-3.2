<?php

class dispatcher{

	public static function dispatch($unMenuP){
		$unMenuP = "controleur" . ucfirst($unMenuP) ;
		$unMenuP .= ".php";
		$unMenuP = "controleur/" . $unMenuP;
		return $unMenuP ;
	}
}
